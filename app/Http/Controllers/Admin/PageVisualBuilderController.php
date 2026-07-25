<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Bridges the vendored Vvveb.js visual builder (public/vendor/vvvebjs — a
 * standalone third-party editor that talks to a `save.php`/`upload.php`
 * style backend, not Inertia) to this app's Page model. Vvveb edits one
 * full HTML document at a time; each of this Page's active languages is
 * modelled as a pseudo "page" in Vvveb's own file-manager/page-switcher UI
 * (see the `edit` view), saved into Page::content — a translatable JSON
 * column holding one HTML string per language, not the structured block
 * tree the admin builder used before.
 */
class PageVisualBuilderController extends Controller
{
    public function edit(Page $page): View
    {
        return view('admin.pages.vvveb-editor', [
            'page' => $page,
            'languages' => Language::active(),
        ]);
    }

    /**
     * Returns a full HTML document (loaded directly into Vvveb's iframe via
     * a normal navigation) wrapping this page's stored content for the
     * given language — linking the real frontend theme stylesheets so
     * editing happens against the site's actual look. Reads the raw stored
     * value with no locale fallback (blank if this language has no content
     * yet), unlike the public-facing accessor, so gaps are visible to the
     * editor rather than silently showing another language's html.
     */
    public function content(Page $page, Request $request): Response
    {
        $lang = $request->query('lang', '');
        $html = $this->isActiveLanguage($lang) ? ($page->getTranslation('content', $lang, false) ?: '') : '';

        $document = view('admin.pages.vvveb-content-document', [
            'bodyHtml' => $html,
        ])->render();

        return response($document)->header('Content-Type', 'text/html; charset=UTF-8');
    }

    /**
     * Mirrors Vvveb's save.php contract: {file, html} over POST. `file` is
     * one of the pseudo-page filenames the `edit` view registers per
     * language (e.g. "content-en.html") — never a real path on disk.
     */
    public function save(Page $page, Request $request): Response
    {
        $lang = $this->langFromFile((string) $request->input('file', ''));

        if (! $lang || ! $this->isActiveLanguage($lang)) {
            return response('Invalid language file!', 422);
        }

        $page->setTranslation('content', $lang, (string) $request->input('html', ''));
        $page->save();

        return response('Page saved!');
    }

    /**
     * Mirrors Vvveb's upload.php contract: a multipart `file`, an optional
     * `onlyFilename` flag (used by the media library modal, which wants
     * just the stored filename back) — otherwise the full response body
     * is used verbatim as the new <img src>, so it must be a real URL.
     */
    public function upload(Request $request): Response
    {
        // Deliberately not $request->validate() — Vvveb's fetch() call sets
        // no Accept: application/json header, so a failed validate() would
        // trigger Laravel's default redirect-back response (expectsJson()
        // is false) instead of a clean error; fetch() silently follows that
        // redirect and would treat whatever page it lands on as "success".
        $validator = validator($request->all(), [
            'file' => ['required', 'image', 'max:8192'],
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->first('file') ?? 'Invalid file!', 422);
        }

        $path = $request->file('file')->store('pages/content', 'public');

        if ($request->boolean('onlyFilename')) {
            return response(basename($path));
        }

        return response('/storage/'.$path);
    }

    /**
     * Best-effort stand-in for Vvveb's scan.php (media library folder
     * listing) — returns an empty folder rather than implementing full
     * browsing of previously-uploaded images. Uploading still works and
     * inserts the new image immediately regardless of this list.
     */
    public function scan(): JsonResponse
    {
        return response()->json(['folders' => [], 'files' => []]);
    }

    protected function langFromFile(string $file): ?string
    {
        if (preg_match('/^content-([a-zA-Z_-]+)\.html$/', basename($file), $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Guards content()/save() against an arbitrary ?lang= or crafted `file`
     * value writing into (or reading out) a translation key that isn't one
     * of this page's real, currently-active languages.
     */
    protected function isActiveLanguage(string $lang): bool
    {
        return $lang !== '' && Language::active()->pluck('code')->contains($lang);
    }
}
