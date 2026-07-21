# School Management CMS

Laravel 13 + Inertia + Vue 3 admin CMS for a school website, using Jetstream
for auth and PrimeVue for the admin dashboard UI. The public site started as
a static HTML theme (`html/`, the "WexNix" template) and is being migrated
page-by-page into Blade views behind the same backend.

- Admin panel lives under `admin/*` routes (`routes/admin.php`, required
  from `routes/web.php`), Inertia pages in `resources/js/Pages/Admin`,
  layout in `resources/js/Layouts/AdminLayout.vue`.
- Sidebar menu structure is defined in `resources/js/admin-menu.js` — route
  names there must match names registered in `routes/admin.php`.
- Frontend stack: PrimeVue 4.5.x (`primevue` + `@primevue/themes`, **not**
  the v5/`@primeuix/themes` line — v5 added a paid license-check banner to
  the core library; stay on 4.x).

### Public site migration (`html/` → Blade)

Only `index.html` has been converted so far, as the pattern for the rest:

- Original template source stays untouched in `html/*.html` for reference —
  don't edit those files, they're not served.
- Template assets (css/js/img/webfonts) were copied once to
  `public/frontend/assets/`. When converting another page, only add assets
  that aren't already there — don't recopy the whole folder.
- Shared chrome (head, header/nav, footer, script includes) lives in
  `resources/views/frontend/layouts/app.blade.php`; each page is
  `resources/views/frontend/{page}.blade.php` with `@extends(...)` +
  `@section('content')` holding just that page's `<main>` content.
- Converting a new page: copy the source `.html`, replace `assets/` →
  `/frontend/assets/` throughout, swap the `<head>`/header/footer for the
  shared layout, wrap the remaining `<main>` in `@extends`/`@section`, and
  route it in `routes/web.php`. Internal nav links still pointing at other
  un-converted `*.html` files are expected until those pages get done too —
  leave them as-is rather than guessing a route name that doesn't exist yet.
- The `/` route (`routes/web.php`) serves `frontend.home`, named `home`.

### Homepage sections as swappable Blade components

Each homepage section lives in its own file under
`resources/views/frontend/sections/{section}/{section}-v{n}.blade.php` —
e.g. the hero carousel is `sections/slider/slider-v1.blade.php`. A section
partial is self-contained: it only expects whatever data it needs passed in
(e.g. `$sliders`), never reaches into globals itself.

`config/frontend.php` (`sections.{name}`) says which version is currently
active; `home.blade.php` includes it via
`@include('frontend.sections.{name}.' . config('frontend.sections.{name}'), [...])`.
To add a new design for a section (e.g. a second slider layout), drop in
`slider-v2.blade.php` next to `slider-v1.blade.php` and point the config at
it — don't branch inside one file with conditionals. `slider`, `institute_info`,
`counter`, `partner`, `video`, `offer`, `choose`, `skill`, `about`, `course`,
`teacher`, `gallery`, `event`, and `department` have been extracted this way
so far; the rest of `home.blade.php`'s sections (testimonial, etc.) are still
inline and should follow this same pattern when they're pulled out.

Some homepage sections use an owl-carousel in the original theme (`event`,
`department`) while their standalone list page uses a plain Bootstrap grid —
don't force one shared card partial with a grid-column wrapper onto both. Split
into a bare `partials/item.blade.php` (no column wrapper) plus a
`partials/card.blade.php` that just wraps `item` in `<div class="col-*">` for
the grid page; the homepage `-v1.blade.php` section includes `item` directly
inside `wexnix_{thing}-slider owl-carousel wexnix_owl-theme`. See
`resources/views/frontend/events/partials/` for the reference split.

## Standing directions

### Multi-language content

Whenever asked to add or modify any content type that needs translation
(notices, pages, news & events, testimonials, FAQ, downloads, etc.), follow
[docs/language-workflow.md](docs/language-workflow.md) without re-asking:

- Translatable fields are JSON columns via `spatie/laravel-translatable`,
  one row per record — not a `_translations` table, not a separate database
  per language.
- The `languages` table is the single source of truth for which locales
  exist, which is default, and text direction (RTL for Arabic) — content
  forms and locale resolution both read from it, never a hardcoded list.
- No auto-translate. Client types each language's content themselves;
  missing translations fall back to the default language, never blank.

If a request specifically needs per-language draft/review/approve workflow
metadata, that's the one case worth revisiting the JSON-column choice for —
see the "Why JSON columns" section in the doc before changing anything.

### Icon fields (repeater icons: cta_stats, choose_features)

Any field that lets an admin pick an icon (not a fixed asset filename) uses
this shape: `{"source": "lucide", "value": "graduation-cap"}` or
`{"source": "upload", "value": "site/icons/xxxx.svg"}`. Two packages back it:

- `mallardduck/blade-lucide-icons` (Composer) — server-side, renders true
  inline `<svg>` in Blade via the `svg('lucide-{name}')` helper. This is
  what makes `source: lucide` render on the public site; icon names are
  validated against this package's own `resources/svg/*.svg` at save time
  (`UpdateSiteSettingRequest::iconValueRule()`) so a bad name can never
  reach `svg()` on the live homepage.
- `@lucide/vue` (npm) — admin-only, powers the searchable picker
  (`resources/js/Components/Admin/IconPicker.vue`). Lazy-loaded on mount
  (not a top-level import) since eagerly importing all ~2000 icon
  components blows up the page bundle by ~500kB.

`resources/js/data/lucide-icon-names.json` is the canonical kebab-case name
list both sides key off — regenerate it from the Composer package's SVG
files (`glob vendor/mallardduck/blade-lucide-icons/resources/svg/*.svg`) if
that package's version bumps meaningfully. Render either source through
`<x-dynamic-icon :icon="$item['icon']" />` (`resources/views/components/
dynamic-icon.blade.php`) — not `<x-icon>`, which collides with a component
the base `blade-ui-kit/blade-icons` package already registers globally.

### Content type with its own public list + detail pages (Course, Teacher, Event, Department)

`Course`/`CoursePageSetting` (`app/Models/Course.php`,
`app/Models/CoursePageSetting.php`) is the reference pair for any future
content type that needs a public listing page and a detail page (not just a
homepage teaser) — follow this shape rather than Notice/Slider's for those.
`Teacher`, `Event`, and `Department` (each with their own `{Thing}PageSetting`
singleton) follow this same pattern; `GalleryImage`/`GalleryPageSetting` is
the one exception — it gets a homepage teaser and a list page but **no**
detail route, since the reference template (`gallery.html`) has no
`gallery-single.html` counterpart and each image just opens in the existing
lightbox (`wexnix_popup-img` / magnific-popup) instead.

- **`Course`** — a normal repeatable content type (table, `HasTranslations`,
  `is_active`/`sort_order` reordering exactly like `Slider`), but also
  route-bound by slug on the public side only: `Route::get('/courses/
  {course:slug}', ...)` in `routes/web.php` — the `{model:column}` route
  syntax binds by that column for that one route, without touching the
  model's default (id-based) binding used everywhere else, including the
  admin CRUD routes (`{course}` there stays id-based, which is what
  `route('admin.cms.courses.update', course.id)` on the Vue side expects —
  don't add `getRouteKeyName()` to the model, it would make *every* implicit
  binding slug-based and break that).
- **`CoursePageSetting`** — a singleton exactly like `SiteSetting` (same
  `::current()` cache-as-raw-attributes pattern), holding the stuff that
  isn't per-course: the homepage teaser section heading, the list page's
  breadcrumb, and its SEO meta fields. Don't bloat `SiteSetting` itself with
  page-specific config — a new content type gets its own settings singleton.
- **Admin UI** — the list/CRUD lives on its own Inertia page
  (`Admin/Cms/Courses.vue`, two tabs: the `DataTable` and the
  `CoursePageSetting` form) but create/edit is a **separate page**
  (`Admin/Cms/CourseForm.vue`, routed via `.../create` and `.../{course}/edit`),
  not a `Dialog` — reach for a dedicated page instead of a modal once a
  form has this many fields/sections. Long-form rich content
  (`description`) uses PrimeVue's `Editor` (Quill — `npm install quill` is
  required alongside `primevue`, it's a runtime peer dependency the
  component dynamically imports, not bundled); short single-purpose text
  (SEO meta description, card teaser text) stays a plain `Textarea` —
  don't put rich text where it'll land inside a `<meta>` tag or a card
  blurb.
- **Public pages** share one card partial
  (`resources/views/frontend/courses/partials/card.blade.php`) between the
  homepage teaser and the full list page — don't duplicate the card markup
  per place it's shown (see the note above on the `item`/`card` split for
  sections that use an owl-carousel on the homepage). Pagination uses a real
  custom paginator view (`resources/views/frontend/pagination/wexnix.blade.php`)
  styled to the theme's markup instead of Bootstrap's default, via
  `$courses->links('frontend.pagination.wexnix')`.
- **Repeater fields** (a translatable list of sub-items stored as one JSON
  column — `Course::requirement_items`/`features`, `Teacher::skills`,
  `Event::content_blocks`, `Department::requirement_items`/`downloads`) are
  never resolved to the current locale by casting alone: each model gets a
  small resolver method (`requirementItems()`, `skillItems()`,
  `contentBlocks()`, `downloadItems()`, ...) that maps the raw array to
  plain strings for `app()->getLocale()`, falling back to the default
  language per-field, the same shape/fallback logic as
  `SiteSetting::skillItems()`/`aboutItems()`. Blade views call the resolver,
  never `$model->requirement_items` directly. File-upload repeater rows
  (`Department::downloads`) resolve orphaned storage files on save the same
  way `CourseController::resolveIconRepeater()` does for icon repeaters —
  diff the old vs. new set of stored paths and delete what's no longer
  referenced.

### Roles & permissions (planned, not yet implemented)

Five roles: `system_admin` (hidden — never shown in any role list/dropdown,
seeded via console only, bypassed via `Gate::before()`), `admin`, `operator`,
`teacher`, `student`. Teacher/student need row-level scoping (own classes,
own record), not just permission checks — via `teacher_class_subject`,
`teacher_profiles`, `student_profiles` tables. Package: `spatie/laravel-permission`.
