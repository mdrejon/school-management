# Multi-language content workflow

Reference for how translation is handled across the project. This is the settled
approach — don't re-litigate JSON columns vs. translation tables vs. separate
databases per language; see "Why JSON columns" below for the reasoning already
worked through.

## Two separate systems — don't conflate them

1. **Interface text** (admin UI chrome — buttons, menu labels, validation
   messages). Developer-maintained, file-based: `lang/en.json`, `lang/bn.json`,
   `lang/ar.json`, served to Vue via `laravel-vue-i18n`. Adding an interface
   language means a developer translates a phrase file and ships it.

2. **Client content** (Notices, Pages, News & Events, Testimonials, FAQ,
   Downloads, etc.). Client-editable, database-driven, dynamic. This is what
   the rest of this doc covers.

No auto-translate anywhere in either system. The client types each language's
content themselves; that's what avoids the "translated wrong" problem.

## Why JSON columns (not translation tables, not separate databases)

- **Separate database per language** — rejected outright. That pattern exists
  for multi-tenancy (isolating one client's data from another's), not
  translation. It multiplies migrations, connections, and backups per
  language for zero benefit, and provisioning a new database is heavier than
  the "add a language with no deploy" requirement, not lighter.

- **Row-per-language translation table** (`notice_translations`:
  `notice_id, locale, title, body`) — a legitimate pattern, but doubles the
  table count (every content type needs its own `_translations` table) and
  needs joins/fallback logic on every read. Its one real advantage is
  per-translation metadata (`translated_by`, `reviewed_at`, `approved`) for a
  draft/review/approve workflow. **We don't need that yet.** If a translation
  approval workflow gets requested later, that specific content type can move
  to this pattern — it's not an all-or-nothing decision.

- **JSON column per translatable field** (current approach, via
  `spatie/laravel-translatable`) — one row per record, translatable fields
  stored as `{"en": "...", "bn": "...", "ar": "..."}`. No joins, no extra
  tables, and adding a language is a new JSON key, not a migration — same
  "dynamic add" property as the translation-table pattern, with much less
  schema overhead for a project this size.

## Status: the registry is implemented

The `languages` table and its admin screen (Settings → Languages) are built:

- `database/migrations/..._create_languages_table.php`, `app/Models/Language.php`
- `app/Http/Controllers/Admin/LanguageController.php` — index/store/update/
  toggleActive/makeDefault/moveUp/moveDown/destroy, routes in `routes/admin.php`
  under `admin.settings.languages.*`
- `resources/js/Pages/Admin/Settings/Languages.vue` — add/edit dialog with
  quick-fill presets (English/Bangla/Arabic/Hindi/Urdu/French/Spanish),
  active toggle, default toggle, reordering, delete
- `Language::active()` is cached (`languages.active`, forgotten on any
  save/delete) and shared to every Inertia page as the `languages` prop via
  `HandleInertiaRequests` — this is what any future translatable-content form
  should loop over for its language tabs, not a hardcoded list.
- Guardrails already enforced server-side: the default language can't be
  deactivated or deleted, and the last active language can't be deleted.

The first real content type is also built: **Sliders & Banners**
(`app/Models/Slider.php`, `app/Http/Controllers/Admin/SliderController.php`,
`resources/js/Pages/Admin/Cms/Sliders.vue`, routes under
`admin.cms.sliders.*`) — translatable `sub_title`/`title`/`highlight`/
`description`/`button_text`/`button2_text`, non-translatable image + URLs,
full CRUD with reordering/activate/delete, and the homepage
(`resources/views/frontend/home.blade.php`, via `Slider::forHomepage()`)
renders whichever language the visitor's locale resolves to, with the
`highlight` field wrapped in `<span>` to reproduce the theme's colored-word
styling. Use this as the second reference alongside Notice below when wiring
up the next content type (Pages, News & Events, Testimonials, FAQ, Downloads).

A third content type, **Courses** (`app/Models/Course.php`, `App\Http\
Controllers\CourseController` for the public list/detail pages, `Admin\
CourseController` for the CRUD, routes under `admin.cms.courses.*` and
`courses.index`/`courses.show`), is the one to copy instead when the new
content type needs its own public **list + detail** pages rather than just a
homepage teaser — see the "Content type with its own public list + detail
pages" note in `CLAUDE.md` for the specifics (slug routing, the
`CoursePageSetting` singleton, the Quill editor for long-form fields).

A **global settings singleton** is also built the same way: `SiteSetting`
(`app/Models/SiteSetting.php`) is a single-row table for header/footer
content — translatable `site_name`/`address`/`footer_about`/`copyright_text`,
non-translatable logo/phone/email/social URLs — edited via Settings →
Website Options (`resources/js/Pages/Admin/Settings/WebsiteOptions.vue`, a
left-tab/right-content layout: General, Header, Footer). It's shared to
every frontend page via a View Composer (`AppServiceProvider::boot()`) as
`$siteSettings`, consumed in `resources/views/frontend/layouts/app.blade.php`.

**Caching gotcha specific to translatable singletons:** `SiteSetting::current()`
caches `$settings->getAttributes()`, not `->toArray()`. `HasTranslations`
overrides attribute access so `toArray()` resolves every translatable field
down to just the current request's locale — caching that would silently
throw away every other language's text the next time it's read from cache.
`getAttributes()` returns the untouched raw values (translatable columns
still as JSON strings), which is both cache-safe and locale-agnostic. Follow
this pattern for any other translatable singleton; plain non-translatable
models (like `Language`) don't have this problem and can cache `toArray()`
directly.

What's still just the plan below for other content types: Notice itself
hasn't been built yet — the section below is the intended shape, follow it
the same way Sliders was done.

## The `languages` table (the registry)

Drives everything — which locales exist, which are active, which is default,
and text direction. Managed through the Language Management admin screen
(toggle active/inactive, reorder, set default — no deploy required).

| column | purpose |
|---|---|
| `code` | `en`, `bn`, `ar`, ... (ISO 639-1) |
| `name` | English label, e.g. "Bangla" |
| `native_name` | e.g. "বাংলা" |
| `direction` | `ltr` / `rtl` — `ar` sets this to `rtl` |
| `is_default` | fallback locale when a translation is missing |
| `is_active` | shown in admin tabs / frontend switcher when true |
| `sort_order` | display order |

Cached (invalidated on save) — not queried per request.

## Adding a new translatable content type — checklist

1. **Migration** — JSON column per translatable field, everything else a
   normal column (slug, status, dates, foreign keys stay plain).
2. **Model** — `use HasTranslations;` + `public array $translatable = [...]`.
3. **FormRequest** — default-locale value required, all other locales
   `nullable`.
4. **Controller** — `Model::create($request->validated())`, no manual
   `json_encode`.
5. **Vue form** — loop over the shared `languages` Inertia prop, one tab per
   language, bind `:dir="lang.direction"` on that tab's inputs.
6. **Reading** — `$model->getTranslation('field', app()->getLocale(), fallback: true)`
   so a missing translation shows the default language instead of blank.

## Reference implementation: Notice

```php
// migration
Schema::create('notices', function (Blueprint $table) {
    $table->id();
    $table->json('title');
    $table->json('body');
    $table->string('category')->nullable();
    $table->timestamp('publish_at')->nullable();
    $table->boolean('is_pinned')->default(false);
    $table->foreignId('created_by')->constrained('users');
    $table->timestamps();
});
```

```php
// app/Models/Notice.php
class Notice extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'body'];

    protected $casts = ['publish_at' => 'datetime'];
}
```

```php
// StoreNoticeRequest
public function rules(): array
{
    $default = Language::where('is_default', true)->value('code');

    return [
        "title.$default" => ['required', 'string', 'max:255'],
        'title.*'        => ['nullable', 'string', 'max:255'],
        "body.$default"  => ['required', 'string'],
        'body.*'         => ['nullable', 'string'],
    ];
}
```

```vue
<!-- form -->
<TabView>
    <TabPanel v-for="lang in languages" :key="lang.code" :header="lang.native_name">
        <InputText v-model="form.title[lang.code]" :dir="lang.direction"
                   :placeholder="lang.is_default ? 'Title (required)' : `Title in ${lang.name} — optional`" />
        <Textarea v-model="form.body[lang.code]" :dir="lang.direction" rows="6" />
    </TabPanel>
</TabView>
```

Every other translatable content type (Pages, News & Events, Testimonials,
FAQ, Downloads) follows this exact same shape.

## RTL

`direction = rtl` on a language row (Arabic) affects:

- The admin form tab for that language (`dir="rtl"` on its inputs).
- The public site's `<html dir="rtl">` when that locale is active.
- The admin sidebar/layout, which uses Tailwind logical spacing
  (`ms-`/`me-` instead of `ml-`/`mr-`) so it mirrors automatically rather than
  needing a separate RTL stylesheet.

## Fallback behavior

A record missing a translation for the visitor's locale silently falls back
to the default language via `spatie/laravel-translatable`'s fallback config —
never an empty field on the public site.

## Translatable repeaters (label/value pairs, both translated)

Some settings are a variable-length list where *each row* has more than one
translatable string — e.g. Settings → Website Options → School Profile tab
(EIIN, codes, established year, or any other row an admin adds/removes),
stored as `SiteSetting::institute_info` and edited alongside General/Header/
Footer in `WebsiteOptions.vue` (same page, same `SiteSettingController`/
`UpdateSiteSettingRequest`, just another section tab) rather than as a
separate settings page. `HasTranslations` only resolves flat
locale-keyed columns (`{"en": "...", "bn": "..."}`), so a list of
`{label, value}` pairs can't go through it directly. Instead:

- **Migration** — one plain `json` column holding an array of items, each
  shaped `{"label": {"en": ..., "bn": ...}, "value": {"en": ..., "bn": ...}}`.
  Not in the model's `$translatable`; cast as `'array'` instead.
- **Model** — a resolver method (see `SiteSetting::instituteInfoItems()`)
  that maps the raw array down to plain strings for a given locale, falling
  back to the default language per item exactly like `HasTranslations` would.
  Blade reads through this method, never the raw JSON column.
- **FormRequest** — `"institute_info.*.label.$default" => 'required'`,
  `'institute_info.*.label.*' => 'nullable'`, same shape for `.value.*`.
- **Vue form** — a repeater: add/remove buttons mutate a plain array on the
  Inertia form; each row's label/value inputs live inside the same
  shared-language `Tabs` used elsewhere on the page, keyed by row index so
  switching the language tab doesn't lose which rows exist.

Use this shape for any future "admin-defined list of translated
label/value" field — don't reach for a separate table unless the list needs
its own identity (sort order beyond array order, activate/deactivate,
references from elsewhere) the way Sliders does.
