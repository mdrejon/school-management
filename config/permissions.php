<?php

// Fixed, code-defined catalog of every permission-gated admin resource (see
// App\Models\ModuleSetting / config/modules.php for the sibling "does this
// module exist at all" kill-switch — this is the finer-grained "who's
// allowed to touch it" layer on top). Each resource generates one
// Spatie permission per listed action, named "{resource}.{action}"
// (e.g. "courses.edit") — RoleAndPermissionSeeder is what actually creates
// the Permission rows from this list, and the Roles admin page renders it
// as a resource-by-action matrix. Resources only list the actions that are
// actually meaningful for them (e.g. Contact Messages has no "create" —
// visitors submit those, not admins; singletons like Website Options have
// no "create"/"delete" at all).
return [
    'slider' => ['label' => 'Sliders & Banners', 'actions' => ['view', 'create', 'edit', 'delete']],
    'courses' => ['label' => 'Courses', 'actions' => ['view', 'create', 'edit', 'delete']],
    'teachers' => ['label' => 'Teachers', 'actions' => ['view', 'create', 'edit', 'delete']],
    'departments' => ['label' => 'Departments', 'actions' => ['view', 'create', 'edit', 'delete']],
    'events' => ['label' => 'News & Events', 'actions' => ['view', 'create', 'edit', 'delete']],
    'notices' => ['label' => 'Notices', 'actions' => ['view', 'create', 'edit', 'delete']],
    'gallery' => ['label' => 'Gallery', 'actions' => ['view', 'create', 'edit', 'delete']],
    'facilities' => ['label' => 'Facilities', 'actions' => ['view', 'create', 'edit', 'delete']],
    'portfolios' => ['label' => 'Portfolio', 'actions' => ['view', 'create', 'edit', 'delete']],
    'blog' => ['label' => 'Blog', 'actions' => ['view', 'create', 'edit', 'delete']],
    'testimonials' => ['label' => 'Testimonials', 'actions' => ['view', 'create', 'edit', 'delete']],
    'faq' => ['label' => 'FAQ', 'actions' => ['view', 'create', 'edit', 'delete']],
    // Covers both Founder and Donor CRUD (they share one admin page) plus
    // that page's own settings — one resource, not two, since an admin
    // thinks of "who can manage the Founder & Donor list" as one capability.
    'founders_donors' => ['label' => 'Founder & Donor List', 'actions' => ['view', 'create', 'edit', 'delete']],
    'pages' => ['label' => 'Pages', 'actions' => ['view', 'create', 'edit', 'delete']],
    'menus' => ['label' => 'Menus', 'actions' => ['view', 'create', 'edit', 'delete']],
    'contact_messages' => ['label' => 'Contact Messages', 'actions' => ['view', 'edit', 'delete']],
    'languages' => ['label' => 'Languages', 'actions' => ['view', 'create', 'edit', 'delete']],
    'website_options' => ['label' => 'Website Options', 'actions' => ['view', 'edit']],
    'site_configuration' => ['label' => 'Site Configuration', 'actions' => ['view', 'edit']],
    'users' => ['label' => 'Users', 'actions' => ['view', 'create', 'edit', 'delete']],
    'roles' => ['label' => 'Roles & Permissions', 'actions' => ['view', 'create', 'edit', 'delete']],
];
