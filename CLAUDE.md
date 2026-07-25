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

### Frontend locale switching (no URL prefix) and site search

The visitor's language is resolved by `App\Http\Middleware\SetLocale`
(registered in `bootstrap/app.php`, `web` group, before
`HandleInertiaRequests`): session `locale` if it's one of `Language::active()`'s
codes, else the `locale` cookie, else `Language::defaultLanguage()`. It calls
`App::setLocale()` and re-syncs the session every request — there is
deliberately **no `/en`/`/bn` URL prefix**; every route serves every
language at the same URL. `LocaleController@update` (`GET /language/{code}`,
named `language.switch`) is what the header switcher hits — it 404s on a
code that isn't active, sets the session, and queues a year-long cookie via
`back()->withCookie(...)`. `AppServiceProvider`'s `frontend.*` composer
shares `$languages` (`Language::active()`) and `$currentLanguage` (for
`<html lang dir>`) alongside `$siteSettings` — the header language links and
RTL `<html>` attribute in `layouts/app.blade.php` read from these, never a
hardcoded list.

The header search box (`wexnix_header-search-form` + the `wexnix_search-popup`
overlay) posts to `GET /search` (`SearchController`, named `search`,
`resources/views/frontend/search.blade.php`) — one combined results page
searching Notices/Courses/Teachers/Events/Departments by title (or `name`
for Teacher) in parallel, grouped by type. **Any LIKE search against a
translatable field must `whereRaw('CAST(column AS CHAR) LIKE ?', [...])`,
never a plain `where('column', 'like', ...)`** — MySQL's `json` column type
has no text collation, so a direct LIKE against it compares byte-for-byte
case-sensitively regardless of the table's `utf8mb4_unicode_ci` collation,
silently missing anything not matching the stored case exactly. This bit
`Notice::forList()`'s own search before the `CAST` fix; both it and
`SearchController` now do this correctly — copy that pattern for any new
translatable-field search rather than reintroducing the bug.

### Header menu builder (WordPress-style, admin-editable)

The header nav (`resources/views/frontend/layouts/app.blade.php`'s
`wexnix_main-navigation`) is no longer hardcoded — it's built in
Settings → Menus (`Admin\MenuController`, `resources/js/Pages/Admin/Cms/Menus.vue`)
and rendered recursively via `resources/views/frontend/partials/menu-item.blade.php`.

- **Schema**: `menus` (currently just one row, `slug = 'header'`, found via
  `Menu::header()`) has many `menu_items`, self-referencing via `parent_id`
  (`cascadeOnDelete` — deleting a parent deletes its whole submenu, same as
  WP) for arbitrary-depth nesting. Each item is one of three `type`s:
  `custom` (plain `url` string), `route` (a `route_name` from the curated
  `MenuItem::builtInRoutes()` list — the built-in listing pages), or `model`
  (`linkable_type` + `linkable_id`, a short key from `MenuItem::linkableTypes()`
  mapping to one real record — Course/Teacher/Event/Department/Notice).
  `MenuItem::resolvedUrl()` turns any of the three into an actual href,
  returning `null` if the target's gone (deleted record, renamed route) —
  callers skip rendering rather than link to a 404.
- **Tree loading**: `Menu::tree(onlyActive)` does one flat query per menu
  and nests it in PHP by grouping on `parent_id` (`Menu::nest()`), setting
  each item's `children` via `setRelation()` rather than a real eager-loaded
  relation — Eloquent still serializes it like one (both to the admin's
  Inertia JSON and to `$item->children` in the recursive Blade partial), but
  this sidesteps needing a recursive-CTE package for arbitrary depth.
  `onlyActive: true` (the public composer default) filters out disabled
  items *and* their entire subtree in one pass, since `nest()` only
  descends into what's already in the filtered flat list.
- **Recursive rendering**: `menu-item.blade.php` takes `$item` + `$depth`.
  Depth 0 renders a Bootstrap `.dropdown` nav-item; depth ≥ 1 renders
  `.wexnix_dropdown-submenu.dropdown` (a "14. Multi level dropdown menu"
  CSS block already in `style.css` and a matching click-toggle handler
  already in `main.js` — both unused by the original static template but
  present and ready, which is what makes unlimited-depth nesting render
  correctly without new CSS/JS).
- **Admin builder is real drag-and-drop** (`vuedraggable`, an added npm
  dependency) — `resources/js/Components/Admin/MenuItemNode.vue` recurses
  on itself via `<script setup>`'s implicit-filename self-reference (no
  explicit import needed) and nests a `<draggable>` per level, all sharing
  `group="menu-items"` so dragging works both for reordering siblings and
  for re-parenting by dropping an item into another's child list. Dragging
  only mutates local state; nothing persists until "Save Menu Structure" is
  clicked, which flattens the whole working tree to `{id, parent_id,
  sort_order}` rows and `PATCH`es them in one transaction
  (`MenuController::reorder()`) — deliberately one big save like WP's own
  menu screen, not a network round-trip per drag.
- **Adding items**: the left panel's module tabs (Course/Teacher/.../Notice)
  hit `GET admin/cms/menus/linkables?type=&q=` as a plain `fetch()`
  (debounced, not an Inertia visit — it fires on every keystroke) for a
  typeahead list; picking a "Pages" entry or a module record posts
  immediately via `storeItem`. Every add/edit/delete is a normal Inertia
  request that reloads the page's `items` prop — only reordering batches.
- **Seeding**: `MenuSeeder` carries the *original* static nav across as
  faithful `type: custom` items (literal old hrefs, including the
  `*.html`/`#` placeholders for pages that were never functional even in
  the static template) — deliberately not upgraded to `route`/`model`
  links. That was an explicit instruction: seed exactly what was already
  there so nothing about current behavior changes, and leave "point this
  at the real Courses page" etc. as something the admin does deliberately
  through the builder, not something a migration silently decided.

### Footer structure (SiteSetting fields, not the Menu builder)

The footer's "Quick Links" and "Our Campus" columns (`layouts/app.blade.php`)
are admin-editable from Website Options → Footer, but deliberately **don't**
reuse the header's Menu/MenuItem builder above — those two columns are
flat lists with no nesting/dropdown concept, so the added complexity of
per-item `type` (custom/route/model), drag-and-drop reparenting, and a
second menu-switcher UI wasn't worth it for "one heading + a list of
label+URL rows." Same shape/fallback pattern as `SiteSetting::instituteInfoItems()`
instead:

- **Schema**: `footer_quick_links_title`/`footer_campus_title`/
  `footer_newsletter_title`/`footer_newsletter_text` are plain translatable
  JSON columns (`HasTranslations`). `footer_quick_links`/`footer_campus_links`
  are JSON array columns, each row `{label: {en:..., bn:...}, url: string}`
  — `label` is translatable per row (same per-row-translatable shape as
  `institute_info`, which is why it can't go through `HasTranslations`
  directly — that only resolves flat locale-keyed columns, not translatable
  values nested inside an array), `url` is a single plain string the admin
  types directly (`/about`, `#`, or a full external URL) — not a
  route/model picker like `MenuItem::resolvedUrl()`.
- **Resolvers**: `SiteSetting::footerQuickLinkItems()`/
  `footerCampusLinkItems()` resolve each row to a plain `{label, url}` for
  the current locale, falling back to the default language — Blade calls
  these, never the raw `footer_quick_links`/`footer_campus_links`
  attribute directly, same convention as every other repeater resolver in
  this app.
- **Seeded content carries the original static template's links across
  faithfully** (`SiteSettingSeeder`) — `About Us`/`FAQ's`/`Testimonials`
  point at their now-real routes (`/about`, `/faq`, `/testimonials`) since
  those pages exist today, while `Terms Of Service`/`Privacy policy`/
  `Update News` and every "Our Campus" link stay `#` placeholders, exactly
  like `MenuSeeder`'s own precedent — seed what was already there, let an
  admin deliberately repoint a placeholder once that page exists.
- **Newsletter column**: only the heading/description text are dynamic —
  the subscribe form itself isn't wired to anything (same as the original
  static template, which also just posted to `#`); building an actual
  subscriber-capture backend wasn't part of this pass.
- **No new admin route/page** — these fields live in the existing Website
  Options → Footer tab (`WebsiteOptions.vue`) alongside `footer_about`/
  `copyright_text`, not a separate settings page.

### Pages module (Vvveb.js visual page builder)

`Page` (`app/Models/Page.php`) is a free-form content type for one-off pages
(About Us, Privacy Policy, ...) reached at their own top-level URL — a
different shape from every other content type in this app (Course, Notice,
etc.), which all have a fixed field set and a shared list/detail template.

This has gone through two prior iterations — a structured `{id, type,
data}` block tree edited via a custom `vuedraggable` list, then a
Shadow-DOM-based custom visual canvas — before landing on the current
approach: **`content` is edited by
[Vvveb.js](https://github.com/givanz/Vvvebjs)**, a vendored third-party
drag-and-drop HTML editor, not a bespoke in-house builder. That trade
(bigger third-party surface, much richer editing experience) was a
deliberate choice after the custom canvas didn't meet the bar wanted here.

- **Schema**: one `pages` table, no separate `PagePageSetting` singleton
  (there's no shared list page to configure — each Page is independently
  reached by its own slug). `title`/`content`/`seo_title`/`seo_description`/
  `seo_keywords` are all translatable JSON columns, same
  `spatie/laravel-translatable` pattern as every other module — but unlike
  every other module, `content` holds one **whole HTML string** per
  language rather than structured per-field data, because Vvveb.js
  fundamentally edits whole HTML documents, not database fields. This is a
  deliberate, coarser-grained exception to the usual per-field-translatable
  convention (see [docs/language-workflow.md](docs/language-workflow.md))
  — accepted specifically for this module because the alternative was
  reimplementing a chunk of Vvveb's own editing model just to keep
  field-level granularity. `custom_css` stays a plain (non-translatable)
  `text` column rendered raw via `@push('styles')` in `pages/show.blade.php`
  into `layouts/app.blade.php`'s `@stack('styles')`.
- **Public rendering** (`pages/show.blade.php`) is now just
  `{!! $page->content !!}` inside the same `wexnix_page-builder py-120`
  `.container` wrapper as before — `Page::content`'s normal translatable
  accessor falls back to the default language's HTML when the current
  locale's is empty, same fallback spirit as every other translatable
  field, just at whole-page granularity instead of per-field.
- **Vvveb.js is vendored, not npm-bundled into the Vite build**:
  `public/vendor/vvvebjs/` (~15MB — css/fonts/img/js/libs/media/resources
  copied from the `vvvebjs` npm package) is served as plain static assets,
  the same convention as `public/frontend/assets/`. It's vanilla JS with
  its own full UI (toolbar, components/blocks palette, style panel, code
  editor) that expects to own the whole browser tab — not an
  Inertia/Vue-embeddable component — so it's **not** part of the admin
  SPA. `scss/` (source, unneeded — precompiled `css/` is vendored instead)
  and `demo/` (isn't even in the npm package) were skipped;
  `plugin-ai-assistant.js` (calls OpenAI's completions API directly from
  the browser) was deliberately excluded rather than silently wiring in an
  external AI dependency; CKEditor's script tags were already
  commented-out in the upstream template and left that way (TinyMCE, also
  present, is disabled the same way — no rich-text plugin is currently
  enabled beyond Vvveb's own native contenteditable).
- **The bridge** (`app/Http/Controllers/Admin/PageVisualBuilderController.php`)
  reimplements Vvveb's own `save.php`/`upload.php`/`scan.php` server
  contract (documented in the vendored package) against this app's Page
  model instead of flat files:
  - `edit(Page $page)` — the full-screen editor shell
    (`resources/views/admin/pages/vvveb-editor.blade.php`, adapted from
    Vvveb's own `editor.html`), a **plain Blade view, not Inertia** —
    reached via a normal `<a target="_blank">` from `PageForm.vue` and the
    Pages list, not an Inertia `<Link>`, since it's a genuinely separate
    tool, not an SPA page.
  - `content(Page $page, Request $request)` — returns a full HTML document
    (`vvveb-content-document.blade.php`) linking the *real* frontend theme
    stylesheets (`bootstrap.min.css`/`all-fontawesome.min.css`/`style.css`),
    loaded directly into Vvveb's iframe via `iframe.src = url` (a genuine
    navigation, not `srcdoc`) — so editing happens against the site's
    actual look. Reads `getTranslation('content', $lang, false)` (fallback
    disabled) so an untranslated language shows blank in the editor rather
    than silently displaying another language's HTML.
  - `save(Page $page, Request $request)` — each of the page's active
    languages is registered as its own pseudo "page" in Vvveb's own
    file-manager/page-switcher UI (built in `vvveb-editor.blade.php`'s init
    script from `Language::active()`), named `content-{code}.html`;
    `langFromFile()` parses that back out of the `file` field Vvveb posts
    on save. This reuses Vvveb's own page-switcher as the language
    switcher rather than building a separate one.
  - `upload(Request $request)` — stores to `Storage::disk('public')`,
    returns either the stored filename (`onlyFilename` — used by Vvveb's
    MediaModal gallery) or a full `/storage/...` path (used directly as
    `<img src>` otherwise) — matching upload.php's exact two response
    shapes.
  - `scan()` — a stub returning an empty folder listing (Vvveb's media
    *browsing* isn't implemented — uploading still works and inserts
    immediately regardless).
  - **CSRF**: Vvveb is unaware of Laravel. `vvveb-editor.blade.php` wraps
    `window.fetch` globally (covers `builder.js`'s save + `media.js`'s
    MediaModal upload) to inject `X-CSRF-TOKEN` from a `<meta>` tag, rather
    than exempting these routes from CSRF verification or patching the
    vendored files directly. `media.js` only assigns its own
    `uploadUrl`/`mediaScanUrl` defaults `if (typeof ... === "undefined")`,
    so declaring those as globals *before* it loads repoints them at our
    routes with no vendored-file edits needed either.
  - **`<base href>`** points at the vendored asset directory so every
    relative script/link/img path in the adapted `editor.html` resolves
    correctly without having to rewrite each one individually — this app's
    own `route()`/`asset()`-generated URLs are root-relative and thus
    unaffected by `<base>`.
  - **Known, deliberately-accepted gaps**: Vvveb's own rename/delete
    actions on the language pseudo-pages aren't wired to anything (the
    "Add page" button is hidden via CSS since creating new pseudo-pages
    doesn't map to anything meaningful here; rename/delete were left
    pointing nowhere rather than built out, since neither is meaningful
    for a fixed set of languages) — clicking them fails harmlessly rather
    than corrupting anything. "Save as reusable block/section" and the
    oEmbed proxy (for pasting YouTube/Twitter URLs) are unimplemented for
    the same reason: `renameUrl`/`deleteUrl`/`saveReusableUrl`/
    `oEmbedProxyUrl` are all `null` in the init script.
- **`PageForm.vue`** (Inertia, `resources/js/Pages/Admin/Cms/PageForm.vue`)
  is what's left of the admin form now that Vvveb owns `content` — title,
  slug, `is_active`, SEO fields, and breadcrumb image only. A new page
  must be saved here first (so it has an id `content` can be keyed to)
  before its content can be built — `PageController::store()` redirects
  straight to `admin.cms.pages.builder.edit` rather than the index, and
  the "Open Visual Builder" button only renders when editing an existing
  page. **That redirect must be `Inertia::location()`, never a plain
  `redirect()->route()`** — Inertia's `form.post()` sends `X-Inertia: true`,
  a same-origin redirect keeps that header on the follow-up request, and
  the builder route's response never carries `X-Inertia` back (it's a
  plain Blade view); Inertia's client treats a 200 without that header as
  an "invalid response" and dumps the raw HTML into its error modal
  instead of navigating. `Inertia::location()` returns a 409 +
  `X-Inertia-Location` instead, which Inertia's client specifically
  detects and turns into a real `window.location` visit — the documented
  pattern for redirecting an Inertia action to a non-Inertia destination.
  Note its return type is `Symfony\Component\HttpFoundation\Response`, not
  `Illuminate\Http\RedirectResponse` — `store()`'s signature reflects that.
- **Public routing**: `Route::get('/{page:slug}', ...)->name('pages.show')`
  is a catch-all and must stay the **last** route registered in the whole
  of `routes/web.php` (after the `auth` middleware group's `/dashboard` and
  after `require __DIR__.'/admin.php'`) so it can never shadow a more
  specific single-segment route — Laravel resolves ambiguous matches by
  registration order, and `/dashboard` is single-segment too. Admin routes
  (including the Vvveb bridge, all under `admin/cms/pages/{page}/builder/*`)
  are all under the multi-segment `/admin/...` prefix so they're safe
  regardless of ordering relative to the catch-all.
- **Seeding**: `PageSeeder` (one "About Us" sample page, content seeded as
  raw HTML per language via `setTranslation('content', ...)` rather than a
  block array) is registered in `DatabaseSeeder` via the `seedIfEmpty()`
  guard like every other seeder — see the data-safety note in
  `DatabaseSeeder`'s own docblock.

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
`teacher`, `gallery`, `event`, `department`, `blog`, and `testimonial` have
been extracted this way. Facility, Portfolio, and FAQ have public list
(+ detail, for the first two) pages but **no** homepage section — they
weren't part of `home.blade.php`'s design to begin with, so none was added;
don't invent one a content type doesn't actually need on the homepage.

Some homepage sections use an owl-carousel in the original theme (`event`,
`department`) while their standalone list page uses a plain Bootstrap grid —
don't force one shared card partial with a grid-column wrapper onto both. Split
into a bare `partials/item.blade.php` (no column wrapper) plus a
`partials/card.blade.php` that just wraps `item` in `<div class="col-*">` for
the grid page; the homepage `-v1.blade.php` section includes `item` directly
inside `wexnix_{thing}-slider owl-carousel wexnix_owl-theme`. See
`resources/views/frontend/events/partials/` for the reference split.

### Single-profile pages folded into `SiteSetting` (About, Principal, Ex-Principal)

`/about`, `/principal`, and `/ex-principals` are each a route + Blade view
with **no dedicated model** — their content (and, for About, the homepage
sections it reuses) lives as plain columns on `SiteSetting`, following the
exact shape already established by `about_*`: a `{prefix}_page_breadcrumb_title`/
`{prefix}_page_breadcrumb_image`/`{prefix}_page_seo_title`/
`{prefix}_page_seo_description`/`{prefix}_page_seo_keywords` group per page,
edited in its own entry in `WebsiteOptions.vue`'s sidebar-nav `sections` array
(`Admin\SiteSettingController::update()`, one `UpdateSiteSettingRequest`).
This was a deliberate choice over a dedicated model each time — one-off pages
with no repeatable list and no homepage teaser of their own don't carry their
weight as a separate table+model+`::current()` singleton the way
`CoursePageSetting`-style content types do.

- **`about`**: no own content fields — `/about` just re-includes the
  existing `about`/`counter`/`teacher`/`testimonial`/`partner` homepage
  section partials (see `resources/views/frontend/about.blade.php`), only
  breadcrumb/SEO are page-specific.
- **`principal`**: `principal_photo`, `principal_name`, `principal_designation`,
  `principal_message` (plain `Textarea`, rendered via `nl2br(e(...))` for
  line breaks — not rich text) — a single current-principal profile.
  Contact info deliberately reuses the site's global `address`/`phone`/`email`
  rather than duplicating dedicated fields.
- **`ex-principal`**: same shape (`ex_principal_photo`/`_name`/`_designation`/
  `_message`), no contact info block at all (doesn't make sense for someone
  no longer in the role). **This is a single profile, not a repeatable
  list** — the reference template (`html/ex-principals.html`) itself only
  ever shows one former principal, and that was confirmed as the intended
  shape rather than assumed; if a real list of multiple former principals
  is wanted later, that's a bigger change (a proper `ExPrincipal` model,
  closer to the `Testimonial`/`Faq` shape — small repeatable content, own
  `sort_order`, admin CRUD via a Dialog rather than a page).
- **`contact`**: the four info cards (Office Address/Call Us/Email Us/Open
  Time) are **dedicated to this page**, deliberately *not* reusing the
  site's global `address`/`phone`/`email` (unlike Principal's contact
  block) — each card has its own `contact_{field}_label`/
  `contact_{field}_value` pair, **both translatable**, so a school can word
  a card differently per language rather than just translating a shared
  value (e.g. `contact_address_label`/`contact_address_value`,
  `contact_phone_label`/`contact_phone_value`,
  `contact_email_label`/`contact_email_value`,
  `contact_open_time_label`/`contact_open_time`). Each card only renders
  `@if` its *value* is present (falling back to a hardcoded English label
  like `'Office Address'` only if the label itself is blank) — leaving one
  value empty just drops that one card rather than showing an empty one.
  Plus the "Get In Touch" form's own
  `contact_form_title`/`contact_form_description`/`contact_image` and
  `contact_map_embed_url` (the `src` of a Google Maps embed iframe, pasted
  as-is — not a lat/lng pair) — the map `<iframe>` itself is wrapped in
  `@if ($siteSettings->contact_map_embed_url)`, no map section renders at
  all until an admin pastes one in, rather than embedding a placeholder
  location.
  Actual form **submissions** are a separate concern from this page's
  settings — see `ContactMessage` below.
- Every new image field added this way must be added in **four places** to
  actually persist — `$translatable` (if text) or plain, `$fillable` (easy
  to forget when adding to `$translatable` first — silently no-ops on save,
  no error, since Eloquent mass-assignment protection just drops unlisted
  keys), the `$appends`/`get{Field}UrlAttribute()` pair (images), and the
  upload-handling loop in `SiteSettingController::update()`. Verify a new
  field actually round-trips (save then re-fetch) before trusting it —
  don't assume `$fillable` was updated just because `$translatable` was.

### Contact form submissions (`ContactMessage`)

`/contact`'s "Get In Touch" form posts to `ContactController::store()`
(`StoreContactMessageRequest`), which just creates a `ContactMessage` row
and redirects back with a flash `success` message — rendered directly in
`contact.blade.php` (`session('success')`, into the same
`.wexnix_form-messege` div the original static template left as an empty
AJAX-response placeholder) since this is the only public-facing form on
the site so far and there was no existing flash-message convention in
`layouts/app.blade.php` to hook into.

- **Not translatable, no admin-authored content** — `name`/`email`/
  `subject`/`message` are plain `string`/`text` columns, unlike every other
  content type in this app; it's visitor input in whatever language they
  typed, not something an admin writes per-language.
- **No `sort_order`** — chronological like `Notice`, newest first
  (`orderByDesc('created_at')`), for the same reason: this is inherently
  time-ordered content, not curated.
- **Read state** is a nullable `read_at` timestamp (`markRead()` on the
  model, only sets it the first time — calling it again on an
  already-read message is a no-op) rather than a boolean, so "when" is
  preserved, not just "whether."
- **Admin UI** (`Admin/Cms/ContactMessages.vue`) is a single DataTable +
  view `Dialog` — no create/edit, since messages are visitor-submitted;
  opening the Dialog marks the message read via a `PATCH`. No page
  settings tab here — that's `SiteSetting`'s `contact_*` fields (see
  above), edited in Website Options, not on this list page.

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

### Content type with its own public list + detail pages (Course, Teacher, Event, Department, Facility, Portfolio, Blog)

`Course`/`CoursePageSetting` (`app/Models/Course.php`,
`app/Models/CoursePageSetting.php`) is the reference pair for any future
content type that needs a public listing page and a detail page (not just a
homepage teaser) — follow this shape rather than Notice/Slider's for those.
`Teacher`, `Event`, `Department`, `Facility`, `Portfolio`, and `BlogPost`
(each with their own `{Thing}PageSetting` singleton) follow this same
pattern; `GalleryImage`/`GalleryPageSetting` is the one exception — it gets
a homepage teaser and a list page but **no** detail route, since the
reference template (`gallery.html`) has no `gallery-single.html`
counterpart and each image just opens in the existing lightbox
(`wexnix_popup-img` / magnific-popup) instead. `Facility` is the same idea
one step further: the theme's `facility.html` doesn't even have a reference
*card* link target, let alone a single page — its detail page
(`resources/views/frontend/facilities/show.blade.php`) was designed from
scratch off the Course/Department single-page shape (image, rich
description, two gallery images, no sidebar) rather than copied from a
template file, the same way Notice's detail page was when this session
first needed a "make it dynamic" page the static theme never had.

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
  `Event::content_blocks`, `Department::requirement_items`/`downloads`,
  `Portfolio::highlight_items`, `BlogPost::tags`) are never resolved to the
  current locale by casting alone: each model gets a small resolver method
  (`requirementItems()`, `skillItems()`, `contentBlocks()`, `downloadItems()`,
  `highlightItems()`, `tagItems()`, ...) that maps the raw array to plain
  strings for `app()->getLocale()`, falling back to the default language
  per-field, the same shape/fallback logic as
  `SiteSetting::skillItems()`/`aboutItems()`. Blade views call the resolver,
  never `$model->requirement_items` directly. File-upload repeater rows
  (`Department::downloads`) resolve orphaned storage files on save the same
  way `CourseController::resolveIconRepeater()` does for icon repeaters —
  diff the old vs. new set of stored paths and delete what's no longer
  referenced.
- **Model naming avoids bare reserved-feeling words** — `BlogPost` (table
  `blog_posts`), not `Post`; routes are still the short `blog.index`/
  `blog.show` (`/blog`) though, and admin routes `admin.cms.blog.*` — only
  the PHP class/table got the longer name, not the URLs.
- **A sidebar "see also" list can be a live query instead of a stored
  field** when it's inherently derived from other rows of the same type —
  `Department`'s "Our Departments" sidebar and `BlogPost`'s "Recent Post"
  sidebar (`BlogPostController@show` passes `recentPosts` = other active
  posts, `latest('published_at')`, `limit(3)`, excluding the current one)
  both do this rather than persisting a redundant copy of the list.

### Notice (site-wide marquee teaser, not homepage-only)

`Notice`/`NoticePageSetting` (`app/Models/Notice.php`,
`app/Models/NoticePageSetting.php`) mostly follows the Course-family shape
(table, `HasTranslations`, admin CRUD on a dedicated `NoticeForm.vue` page,
public list + detail pages, slug auto-gen) but deviates in two ways worth
knowing before extending it:

- **No manual `sort_order`/drag-reordering.** Notices are inherently
  date-ordered content — the migration deliberately has no `sort_order`
  column and the admin `NoticeController` has no `moveUp`/`moveDown`. Both
  `Notice::forList()` (public list) and `Notice::forMarquee()` (ticker) sort
  by `published_at desc, id desc`; the admin `Notices.vue` table has no
  Order column either. If a future content type is similarly
  chronologically-ordered rather than curated, follow this precedent
  instead of bolting on unused reorder buttons.
- **Its "teaser" is a site-wide header marquee, not a homepage section.**
  Unlike Course/Teacher/Event/Department, Notice has no
  `config/frontend.php` entry and isn't included from `home.blade.php` —
  the ticker in `resources/views/frontend/layouts/app.blade.php`
  (`wexnix_notice-marquee`) renders on *every* page. It's fed by
  `App\Providers\AppServiceProvider`'s `frontend.*` wildcard composer
  (`$marqueeNotices` = `Notice::forMarquee()`, `$noticePageSettings` =
  `NoticePageSetting::current()`), the same mechanism that already supplies
  `$siteSettings` there — add to that composer, not to the `/` route
  closure, for anything that needs to appear on literally every frontend
  page rather than just the homepage. The marquee's underlying CSS marquee
  trick requires the notice list rendered twice back-to-back (see the two
  `@foreach` loops over `$marqueeNotices` in the layout) so the scrolling
  track wraps seamlessly — don't collapse that to one loop.
- **PDF attachment** (`Notice::pdf`) is a plain nullable storage path with
  a `pdf_url` append, uploaded via a bare `<input type="file" accept=".pdf">`
  in `NoticeForm.vue` (no dropzone component — that's image-only) and
  surfaced as a download link/button on both the list table and the detail
  page.
- **List page has a working search box** (`notice.html`'s search form isn't
  decorative) — `NoticeController@index` reads `?q=`, `Notice::forList()`
  does a `whereRaw('CAST(title AS CHAR) LIKE ?', [...])` against the raw
  JSON column (see the CAST note above — matches whichever locale the
  substring happens to appear under, case-insensitively; good enough for a
  simple notice board, not worth a real JSON-path search), and the
  paginator keeps `?q=` across pages via `->withQueryString()`.

### Small curated content with no detail page (Testimonial, FAQ)

`Testimonial`/`TestimonialPageSetting` and `Faq`/`FaqPageSetting` follow the
`{Thing}PageSetting` singleton half of the Course pattern (list-page
heading + breadcrumb + SEO, `::current()` cache-as-raw-attributes) but
**not** the dedicated-form-page half — each item is only 2–5 short fields
(a quote+rating+name+role, or a question+answer), so admin CRUD is a
`Dialog` on the list page (`Admin/Cms/Testimonials.vue`, `Admin/Cms/Faqs.vue`)
copied from the original `Sliders.vue` precedent, not a separate
`{Thing}Form.vue` route — reach for the dedicated-page pattern only once a
form actually has enough fields/sections to need one. Both keep manual
`sort_order`/`moveUp`/`moveDown` (curated display order, e.g. FAQ accordion
order), unlike Notice. Neither has a slug or a public detail route — a
testimonial or FAQ item isn't a "page" a visitor navigates to on its own,
just a repeated item on one page (`/testimonials`, `/faq`).

`FaqPageSetting` is the one `{Thing}PageSetting` so far with extra fields
beyond the standard shape: `cta_button_text`/`cta_button_url` for the
"Have Any Question?" button in `faq.html`'s left intro column — added
directly to the singleton rather than inventing a second settings model,
since it's still page-level (not per-item) config.

Testimonial's homepage teaser and its own `/testimonials` page render the
*exact* same owl-carousel markup (confirmed identical in `home.blade.php`
and `testimonial.html`) — so unlike the card/item split described above,
there's just one bare `resources/views/frontend/testimonials/partials/
item.blade.php`, included directly by both the section partial and the
list page's own carousel wrapper, no grid-column variant needed at all.

### Site Configuration (developer-level module kill switch)

`ModuleSetting` (`app/Models/ModuleSetting.php`) is deliberately **not** part
of the roles/permissions system above — it's a coarser, developer-facing
on/off switch for stripping a whole module out of a client's deployment
entirely (e.g. "this client didn't buy Portfolio"), not a per-user content
permission. Two independent toggles per module: `is_enabled` (kills the
module everywhere — public routes 404, admin routes 404, admin sidebar
entry and Website Options tab disappear) and `show_on_homepage` (only
matters for modules with a homepage teaser section — hides just the
teaser, the module's own list/detail pages stay reachable).

- **The catalog is fixed and code-defined** (`config/modules.php`), not
  DB-driven — a plain array of `key => ['label', 'section' (bool: has a
  home.blade.php include worth toggling separately), 'route' (bool: has
  its own public route(s))]`. All ~23 candidate modules are registered
  (8 decorative homepage-only sections + ~15 content modules with their
  own routes) — this was a deliberate "cover everything now" choice over
  registering only a subset, confirmed explicitly rather than assumed.
  The `module_settings` table only stores the two mutable booleans per
  key, lazily created with `is_enabled: true, show_on_homepage: true`
  defaults the first time a key is read (`ModuleSetting::allKeyed()`) —
  so adding a new key to the config catalog needs no migration/seeder.
- **Caching gotcha**: `allKeyed()` must cache raw attribute arrays and
  re-hydrate them, exactly like `SiteSetting::current()` — caching the
  Eloquent Collection object directly (`Cache::rememberForever(...,
  fn () => static::query()->get()->keyBy('key'))`) round-trips fine
  within the same PHP process but comes back as an
  `__PHP_Incomplete_Class` (a `TypeError` against the `Collection` return
  type) once the "database" cache driver actually serializes/unserializes
  it across a fresh process — i.e. it silently works in whatever request
  first populates the cache and breaks on the very next one. Verified via
  `php artisan tinker` across two separate process invocations before and
  after the fix — this is the same reason `SiteSetting::current()` never
  caches the hydrated model itself.
- **`App\Http\Middleware\EnsureModuleEnabled`** (aliased as `module` in
  `bootstrap/app.php`) — `abort_unless(ModuleSetting::isEnabled($key),
  404)`, applied as `->middleware('module:{key}')` on every gated route
  group in both `routes/web.php` (public) and `routes/admin.php` (admin
  CRUD) for every module with `route: true`. A disabled module 404s on
  both sides identically — there's no "public hidden, admin still
  reachable" half-state. `cms/pages` (the Vvveb catch-all builder) and
  `cms/menus` (drives the header nav, not a content module) are
  deliberately **not** gated.
- **Homepage section gating** is separate from route gating —
  `home.blade.php`'s `@include`s are each wrapped in
  `@if (\App\Models\ModuleSetting::showOnHomepage('key'))`, and the
  site-wide notice marquee in `layouts/app.blade.php` checks
  `ModuleSetting::isEnabled('notices')` (notices have no `home.blade.php`
  include to gate — the marquee renders on every page, not just home).
- **Admin-side hiding** ("hide from admin too" was the confirmed answer
  over "public-only"): `HandleInertiaRequests::share()` adds
  `'enabledModules' => fn () => ModuleSetting::enabledKeys()` alongside
  the existing `languages`/`flash` shared props.
  `resources/js/Components/Admin/SidebarNav.vue` filters `admin-menu.js`
  groups by an item's optional `module` key against that list (empty
  groups drop out entirely, e.g. if every item in "Website CMS" were
  disabled); `WebsiteOptions.vue`'s `visibleSections` computed does the
  same for its sidebar-nav-style settings tabs (About/Principal/
  Ex-Principal/Contact tabs each carry a `module` key). An item/section
  with no `module` key (Pages, Menus, Downloads, Site Configuration
  itself) is always visible regardless of what's toggled.
- **Admin UI**: `Admin\ModuleSettingController` (`admin/settings/modules`,
  `admin.settings.modules.edit`/`.update`, deliberately **not**
  module-gated itself) merges the static catalog with current DB state
  into one flat list for `Admin/Settings/SiteConfiguration.vue` — a single
  `useForm({ modules: [...] })` array submitted as one bulk PUT (same
  "one big save" spirit as the Menu builder's reorder, not a toggle-per-
  request round trip), split into two `DataTable`s in the UI ("Homepage
  Sections" show both toggles, "Standalone Modules" show only Enabled).
  Flipping a row's Enabled toggle off client-side also force-clears its
  Show-on-Homepage toggle (`onToggleEnabled()`) so the two can't drift
  inconsistent before save; `UpdateModuleSettingsRequest` validates each
  submitted key against `array_keys(config('modules'))`.

### Roles & permissions

Built on `spatie/laravel-permission` (guard `web`). Five roles: `system_admin`
(hidden — never shown in any role list/dropdown, only ever assigned via
`RoleAndPermissionSeeder`/console, bypasses every permission check via
`Gate::before()` in `AppServiceProvider::boot()`), `admin` (seeded with
every permission), `operator`, `teacher`, `student` (all seeded with zero
permissions — a developer grants what each actually needs via the
Permissions page). **Teacher/student row-level scoping (own classes, own
record, via `teacher_class_subject`/`teacher_profiles`/`student_profiles`
tables) is still not implemented** — those two roles exist and can be
assigned today, but there's no teacher/student-facing portal yet for
row-level scoping to matter to; this pass only covers permission-gating the
existing admin CMS.

- **Permission catalog is fixed and code-defined** (`config/permissions.php`),
  the same "config file lists the fixed catalog, DB only stores mutable
  state" shape as `config/modules.php`/`ModuleSetting`. Each entry is
  `key => ['label', 'actions' => [...]]` — every resource generates one
  Spatie `Permission` per listed action, named `"{key}.{action}"` (e.g.
  `courses.edit`). Actions are `view`/`create`/`edit`/`delete` for a normal
  CRUD resource, but a resource only lists the actions that actually apply
  — `contact_messages` has no `create` (visitors submit those, not admins),
  singletons like `website_options`/`site_configuration` have no
  `create`/`delete` at all. `RoleAndPermissionSeeder` is what turns this
  config into actual `Permission` rows (idempotent via `Permission::
  findOrCreate()`), registered in `DatabaseSeeder` via the `seedIfEmpty`
  guard keyed on `Role::class`.
- **Enforcement**: every real (non-stub) admin route carries
  `->middleware('permission:{key}.{action}')` at the individual-route
  level, not the group level — a `Route::prefix('cms/courses')` group's
  `index` needs `courses.view` but its `destroy` needs `courses.delete`,
  so the group-level `module:courses` middleware (the coarser kill-switch,
  see Site Configuration above) stays a group-wide `->middleware()` call
  while `permission:*` is attached per-route inside it. Settings/page
  routes (e.g. `cms/courses-settings`) are gated under the parent
  resource's `.edit` permission — editing page settings is still editing
  that module. Stub `ComingSoon` routes (`cms.downloads`,
  `settings.general`) are deliberately **not** permission-gated — there's
  no real resource behind them yet for a permission to mean anything.
- **`role`/`permission`/`role_or_permission` middleware aliases** are
  Spatie's own shipped middleware classes, aliased in `bootstrap/app.php`
  next to the existing `module` alias — not a custom-written middleware.
  This only works correctly with the `Gate::before()` system_admin bypass
  because Spatie's `PermissionMiddleware` checks `$user->canAny($permissions)`
  (Laravel's `Authorizable::canAny()`, which goes through `Gate`), not a
  direct `hasAnyPermission()` model call — confirmed by reading the
  vendored middleware source before wiring this up, since a direct model
  check would have silently bypassed `Gate::before()` entirely and locked
  out `system_admin` on every permission-gated route.
- **Users & Roles** (`Admin\UserController`, `admin/settings/users`,
  `resources/js/Pages/Admin/Settings/Users.vue`) is a Dialog-based CRUD
  (name/email/password/role — small enough not to need a dedicated form
  page, same call as Testimonials/FAQ) — the role `Select` never offers
  `system_admin` as an option (`UserController::index()`/`Store`/
  `UpdateUserRequest` all query `Role::where('name', '!=', 'system_admin')`),
  and editing a user who already *has* `system_admin` hides the role field
  entirely and skips `syncRoles()` for them server-side too — otherwise
  submitting the form (which can only ever pick a non-system_admin role)
  would silently strip it. `UserController::destroy()` blocks deleting
  your own account and blocks deleting the last remaining `system_admin`,
  both verified via `tinker` before considering this safe to ship.
- **Permissions** (`Admin\RoleController`, `admin/settings/permissions`,
  list page `Roles.vue` + dedicated `RoleForm.vue` for create/edit — a
  75-checkbox resource×action matrix is well past the "use a Dialog"
  threshold) — also excludes `system_admin` from the list/create/edit/
  delete entirely (`abort_if($role->name === 'system_admin', 404)` on
  edit/update/destroy). `RoleForm.vue` renders one fixed
  view/create/edit/delete column set and blanks the cell for any action a
  resource doesn't declare in `config('permissions')`, so the matrix stays
  visually aligned across singletons and full CRUD resources alike.
  `RoleController::destroy()` refuses to delete a role that still has
  users assigned (`$role->users()->count() > 0`) rather than silently
  orphaning them.
