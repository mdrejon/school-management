<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateModuleSettingsRequest;
use App\Models\ModuleSetting;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ModuleSettingController extends Controller
{
    public function edit(): Response
    {
        $settings = ModuleSetting::allKeyed();

        $modules = collect(ModuleSetting::catalog())->map(function (array $meta, string $key) use ($settings) {
            $setting = $settings->get($key);

            return [
                'key' => $key,
                'label' => $meta['label'],
                'section' => $meta['section'],
                'route' => $meta['route'],
                'is_enabled' => (bool) ($setting?->is_enabled ?? true),
                'show_on_homepage' => (bool) ($setting?->show_on_homepage ?? true),
            ];
        })->values();

        return Inertia::render('Admin/Settings/SiteConfiguration', [
            'modules' => $modules,
        ]);
    }

    public function update(UpdateModuleSettingsRequest $request): RedirectResponse
    {
        foreach ($request->validated()['modules'] as $module) {
            ModuleSetting::query()->updateOrCreate(
                ['key' => $module['key']],
                [
                    'is_enabled' => $module['is_enabled'],
                    'show_on_homepage' => $module['show_on_homepage'],
                ]
            );
        }

        return back()->with('success', 'Site configuration updated successfully.');
    }
}
