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

        $page->setTranslation('content', $lang, $this->extractSavableContent((string) $request->input('html', '')));
        $page->save();

        return response('Page saved!');
    }

    /**
     * Vvveb.Builder.getHtml() (vendored builder.js) always returns the
     * WHOLE captured document — doctype + <html><head>...</head><body>...
     * </body></html> — even though `content()` only ever gave it a body
     * fragment to edit (vvveb-content-document.blade.php wraps it in a
     * throwaway document just so the iframe can load the real theme
     * stylesheets). That's Vvveb's own save contract, not something to
     * patch in the vendored file — so this bridge has to pull just the
     * real content back out before persisting it. Storing the whole
     * document verbatim (as this used to do) means `pages/show.blade.php`'s
     * `{!! $page->content !!}` dumps a second nested <html>/<body> inside
     * the real one; browsers merge/hoist those per the HTML5 parsing spec,
     * which is exactly how the editing canvas's own
     * `<style>body { padding: 24px }</style>` helper rule (also added by
     * vvveb-content-document.blade.php, meant only to give the WYSIWYG
     * canvas breathing room) ends up styling the real, live page's <body>.
     *
     * Extracts from `[data-page-content-root]` (the `.container` div
     * vvveb-content-document.blade.php wraps the editable content in,
     * mirroring pages/show.blade.php's `.wexnix_page-builder.py-120 >
     * .container` wrapper) rather than `<body>`'s direct children —
     * without matching that wrapper depth, any selector Vvveb's style
     * panel writes based on the live DOM position (e.g. "body > p", which
     * IS true inside the editing iframe where content sits right in
     * <body>) silently stops matching once the same content is rendered
     * one level deeper inside that wrapper on the real page — a real case
     * hit and fixed in this session. A data-attribute rather than an id:
     * builder.js's getSelectorForElement() stops walking ancestors and
     * anchors on "#id" the moment it finds one, so an id here would get
     * baked into every selector as an anchor that only ever exists in
     * this editing iframe. Falls back to `<body>`'s children if the
     * marker isn't present (content saved before this fix existed).
     */
    protected function extractSavableContent(string $html): string
    {
        $html = trim($html);

        if ($html === '') {
            return '';
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$html, LIBXML_NOERROR | LIBXML_NOWARNING);
        libxml_clear_errors();

        // Vvveb's own style panel writes real, admin-authored CSS into this
        // one <style id="vvvebjs-styles"> tag (see builder.js's
        // StyleManager) — pull it out from wherever it currently sits (a
        // fresh document has it in <head>; a page saved by this same method
        // before will have it inside the extracted root already) so it's
        // captured exactly once, never duplicated or silently dropped.
        $customCss = '';
        foreach (iterator_to_array($dom->getElementsByTagName('style')) as $styleNode) {
            if ($styleNode->getAttribute('id') === 'vvvebjs-styles') {
                $customCss = trim($styleNode->textContent);
                $styleNode->parentNode->removeChild($styleNode);
            }
        }

        $xpath = new \DOMXPath($dom);
        $root = $xpath->query('//*[@data-page-content-root]')->item(0)
            ?? $dom->getElementsByTagName('body')->item(0);

        $rootHtml = $html;

        if ($root) {
            $rootHtml = '';
            foreach ($root->childNodes as $child) {
                $rootHtml .= $dom->saveHTML($child);
            }
        }

        $styleTag = $customCss !== '' ? "<style id=\"vvvebjs-styles\">{$customCss}</style>\n" : '';

        return trim($styleTag.trim($rootHtml));
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
