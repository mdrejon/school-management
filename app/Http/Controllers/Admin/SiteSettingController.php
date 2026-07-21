<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingController extends Controller
{
    public function edit(): Response
    {
        return Inertia::render('Admin/Settings/WebsiteOptions', [
            'settings' => SiteSetting::current(),
        ]);
    }

    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        $settings = SiteSetting::current();
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $data['logo'] = $request->file('logo')->store('site', 'public');
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('footer_logo')) {
            if ($settings->footer_logo) {
                Storage::disk('public')->delete($settings->footer_logo);
            }
            $data['footer_logo'] = $request->file('footer_logo')->store('site', 'public');
        } else {
            unset($data['footer_logo']);
        }

        if (array_key_exists('partner_logos', $data)) {
            $data['partner_logos'] = $this->resolvePartnerLogos($settings, $data['partner_logos']);
        }

        if (array_key_exists('cta_stats', $data)) {
            $data['cta_stats'] = $this->resolveIconRepeater($data['cta_stats'], $settings->cta_stats ?? []);
        }

        if (array_key_exists('choose_features', $data)) {
            $data['choose_features'] = $this->resolveIconRepeater($data['choose_features'], $settings->choose_features ?? []);
        }

        if ($request->hasFile('video_thumbnail')) {
            if ($settings->video_thumbnail) {
                Storage::disk('public')->delete($settings->video_thumbnail);
            }
            $data['video_thumbnail'] = $request->file('video_thumbnail')->store('site', 'public');
        } else {
            unset($data['video_thumbnail']);
        }

        if ($request->hasFile('offer_background')) {
            if ($settings->offer_background) {
                Storage::disk('public')->delete($settings->offer_background);
            }
            $data['offer_background'] = $request->file('offer_background')->store('site', 'public');
        } else {
            unset($data['offer_background']);
        }

        if ($request->hasFile('choose_image')) {
            if ($settings->choose_image) {
                Storage::disk('public')->delete($settings->choose_image);
            }
            $data['choose_image'] = $request->file('choose_image')->store('site', 'public');
        } else {
            unset($data['choose_image']);
        }

        foreach (['about_image_1', 'about_image_2', 'about_image_3'] as $field) {
            if ($request->hasFile($field)) {
                if ($settings->{$field}) {
                    Storage::disk('public')->delete($settings->{$field});
                }
                $data[$field] = $request->file($field)->store('site', 'public');
            } else {
                unset($data[$field]);
            }
        }

        if (array_key_exists('about_badge_icon', $data)) {
            $data['about_badge_icon'] = $this->resolveIconField($data['about_badge_icon'], $settings->about_badge_icon);
        }

        if (array_key_exists('about_items', $data)) {
            $data['about_items'] = $this->resolveIconRepeater($data['about_items'], $settings->about_items ?? []);
        }

        $settings->update($data);

        return back()->with('success', 'Website options updated.');
    }

    /**
     * Each submitted row's `image` is either a freshly-picked UploadedFile
     * (new/replaced logo — store it) or the existing storage path string
     * (row left untouched — keep as-is). Rows removed on the client no
     * longer appear here at all, so their files are cleaned up too.
     *
     * @param  array<int, array{image: \Illuminate\Http\UploadedFile|string}>  $submitted
     * @return array<int, array{image: string}>
     */
    protected function resolvePartnerLogos(SiteSetting $settings, array $submitted): array
    {
        $resolved = collect($submitted)
            ->map(fn (array $item) => [
                'image' => $item['image'] instanceof \Illuminate\Http\UploadedFile
                    ? $item['image']->store('site/partners', 'public')
                    : $item['image'],
            ])
            ->values()
            ->all();

        $kept = collect($resolved)->pluck('image')->all();
        $previous = collect($settings->partner_logos ?? [])->pluck('image')->all();

        foreach (array_diff($previous, $kept) as $orphaned) {
            Storage::disk('public')->delete($orphaned);
        }

        return $resolved;
    }

    /**
     * Shared by cta_stats/choose_features: each row's `icon` is either
     * `{source: 'lucide', value: <icon name>}` (nothing to store — the name
     * itself is the value) or `{source: 'upload', value: <UploadedFile|path>}`,
     * same freshly-picked-vs-kept-path pattern as resolvePartnerLogos().
     * Uploaded icon files no longer referenced after this save are cleaned up.
     *
     * @param  array<int, array{icon: array{source: string, value: mixed}}>  $submitted
     * @param  array<int, array{icon: array{source: string, value: mixed}}>  $previousItems
     */
    protected function resolveIconRepeater(array $submitted, array $previousItems): array
    {
        $resolved = collect($submitted)
            ->map(function (array $item) {
                $icon = $item['icon'];

                if ($icon['source'] === 'upload' && $icon['value'] instanceof \Illuminate\Http\UploadedFile) {
                    $icon['value'] = $icon['value']->store('site/icons', 'public');
                }

                $item['icon'] = $icon;

                return $item;
            })
            ->values()
            ->all();

        $uploadPaths = fn (array $items) => collect($items)
            ->filter(fn (array $item) => ($item['icon']['source'] ?? null) === 'upload')
            ->pluck('icon.value')
            ->all();

        foreach (array_diff($uploadPaths($previousItems), $uploadPaths($resolved)) as $orphaned) {
            Storage::disk('public')->delete($orphaned);
        }

        return $resolved;
    }

    /**
     * Single-icon counterpart to resolveIconRepeater() — for a lone icon
     * field (about_badge_icon) rather than an array of rows. Stores a fresh
     * upload and deletes the previous uploaded file when it's being
     * replaced or the source switched away from 'upload'.
     *
     * @param  array{source: string, value: mixed}  $icon
     * @param  array{source: string, value: mixed}|null  $previous
     * @return array{source: string, value: string}
     */
    protected function resolveIconField(array $icon, ?array $previous): array
    {
        if ($icon['source'] === 'upload' && $icon['value'] instanceof \Illuminate\Http\UploadedFile) {
            $icon['value'] = $icon['value']->store('site/icons', 'public');
        }

        $previousPath = ($previous['source'] ?? null) === 'upload' ? ($previous['value'] ?? null) : null;
        $newPath = $icon['source'] === 'upload' ? $icon['value'] : null;

        if ($previousPath && $previousPath !== $newPath) {
            Storage::disk('public')->delete($previousPath);
        }

        return $icon;
    }
}
