<?php

// Developer-facing module catalog for the "Site Configuration" feature (see
// App\Models\ModuleSetting) — the fixed, code-known list of everything that
// can be toggled: `section` means it has a home.blade.php include worth
// hiding independently of the module being fully enabled; `route` means it
// has its own public route(s) (and, for most, an admin CRUD route group)
// that get killed with a 404 when disabled. A module can have either, both,
// or neither flag combination as long as it's true to what's actually built.
return [
    // Purely decorative homepage sections — SiteSetting-driven, no public
    // route of their own besides the homepage itself, no separate admin
    // page (they're tabs inside Website Options, which stays fully editable
    // regardless — a developer still needs to configure content even while
    // it's hidden from a given client).
    'slider' => ['label' => 'Hero Slider', 'section' => true, 'route' => false],
    'institute_info' => ['label' => 'Institute Info Strip', 'section' => true, 'route' => false],
    'counter' => ['label' => 'Counter / Stats Strip', 'section' => true, 'route' => false],
    'partner' => ['label' => 'Partner Logos', 'section' => true, 'route' => false],
    'video' => ['label' => 'Video Section', 'section' => true, 'route' => false],
    'offer' => ['label' => 'Offer Banner', 'section' => true, 'route' => false],
    'choose' => ['label' => 'Why Choose Us', 'section' => true, 'route' => false],
    'skill' => ['label' => 'Our Skills', 'section' => true, 'route' => false],

    // Content modules with both a homepage teaser section and their own
    // public list/detail routes + admin CRUD.
    'about' => ['label' => 'About Us', 'section' => true, 'route' => true],
    'courses' => ['label' => 'Courses', 'section' => true, 'route' => true],
    'teachers' => ['label' => 'Teachers', 'section' => true, 'route' => true],
    'gallery' => ['label' => 'Gallery', 'section' => true, 'route' => true],
    'events' => ['label' => 'News & Events', 'section' => true, 'route' => true],
    'departments' => ['label' => 'Departments', 'section' => true, 'route' => true],
    'blog' => ['label' => 'Blog', 'section' => true, 'route' => true],
    'testimonials' => ['label' => 'Testimonials', 'section' => true, 'route' => true],

    // Content modules with their own public routes + admin CRUD, but no
    // homepage teaser section.
    'facilities' => ['label' => 'Facilities', 'section' => false, 'route' => true],
    'portfolios' => ['label' => 'Portfolio', 'section' => false, 'route' => true],
    'faq' => ['label' => 'FAQ', 'section' => false, 'route' => true],
    'notices' => ['label' => 'Notices', 'section' => false, 'route' => true],
    'principal' => ['label' => 'Principal Page', 'section' => false, 'route' => true],
    'ex_principal' => ['label' => 'Ex-Principal Page', 'section' => false, 'route' => true],
    'contact' => ['label' => 'Contact Page', 'section' => false, 'route' => true],
    'founders_donors' => ['label' => 'Founder & Donor List', 'section' => false, 'route' => true],
];
