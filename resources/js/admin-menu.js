// Sidebar navigation structure for the admin panel.
// Each group has a label and a list of items: { label, icon, route } or { label, icon, route, badge }.
export default [
    {
        label: null,
        items: [
            { label: 'Dashboard', icon: 'pi pi-home', route: 'admin.dashboard' },
        ],
    },
    /* Temporarily hidden — not built out yet.
    {
        label: 'Academic',
        items: [
            { label: 'Classes', icon: 'pi pi-sitemap', route: 'admin.academic.classes' },
            { label: 'Sections', icon: 'pi pi-th-large', route: 'admin.academic.sections' },
            { label: 'Subjects', icon: 'pi pi-book', route: 'admin.academic.subjects' },
            { label: 'Class Routine', icon: 'pi pi-calendar', route: 'admin.academic.routine' },
            { label: 'Exams', icon: 'pi pi-file-edit', route: 'admin.academic.exams' },
            { label: 'Results', icon: 'pi pi-chart-bar', route: 'admin.academic.results' },
            { label: 'Attendance', icon: 'pi pi-check-square', route: 'admin.academic.attendance' },
        ],
    },
    {
        label: 'People',
        items: [
            { label: 'Students', icon: 'pi pi-users', route: 'admin.people.students' },
            { label: 'Teachers', icon: 'pi pi-user', route: 'admin.people.teachers' },
            { label: 'Staff', icon: 'pi pi-id-card', route: 'admin.people.staff' },
            { label: 'Parents', icon: 'pi pi-user-plus', route: 'admin.people.parents' },
            { label: 'Admissions', icon: 'pi pi-inbox', route: 'admin.people.admissions' },
        ],
    },
    */
    {
        label: 'Website CMS',
        items: [
            { label: 'Pages', icon: 'pi pi-file', route: 'admin.cms.pages.index' },
            { label: 'Sliders & Banners', icon: 'pi pi-images', route: 'admin.cms.sliders.index', module: 'slider' },
            { label: 'Courses', icon: 'pi pi-graduation-cap', route: 'admin.cms.courses.index', module: 'courses' },
            { label: 'Teachers', icon: 'pi pi-user', route: 'admin.cms.teachers.index', module: 'teachers' },
            { label: 'Departments', icon: 'pi pi-sitemap', route: 'admin.cms.departments.index', module: 'departments' },
            { label: 'News & Events', icon: 'pi pi-calendar-plus', route: 'admin.cms.events.index', module: 'events' },
            { label: 'Notices', icon: 'pi pi-megaphone', route: 'admin.cms.notices.index', module: 'notices' },
            { label: 'Gallery', icon: 'pi pi-image', route: 'admin.cms.gallery.index', module: 'gallery' },
            { label: 'Facilities', icon: 'pi pi-building', route: 'admin.cms.facilities.index', module: 'facilities' },
            { label: 'Portfolio', icon: 'pi pi-briefcase', route: 'admin.cms.portfolios.index', module: 'portfolios' },
            { label: 'Blog', icon: 'pi pi-file-edit', route: 'admin.cms.blog.index', module: 'blog' },
            { label: 'Testimonials', icon: 'pi pi-comments', route: 'admin.cms.testimonials.index', module: 'testimonials' },
            { label: 'FAQ', icon: 'pi pi-question-circle', route: 'admin.cms.faq.index', module: 'faq' },
            { label: 'Downloads', icon: 'pi pi-download', route: 'admin.cms.downloads' },
            { label: 'Menus', icon: 'pi pi-bars', route: 'admin.cms.menus.index' },
            { label: 'Contact Messages', icon: 'pi pi-envelope', route: 'admin.cms.contact-messages.index', module: 'contact' },
        ],
    },
    /* Temporarily hidden — not built out yet.
    {
        label: 'Finance',
        items: [
            { label: 'Fee Structure', icon: 'pi pi-tags', route: 'admin.finance.fees' },
            { label: 'Invoices', icon: 'pi pi-file-invoice', route: 'admin.finance.invoices' },
            { label: 'Payments', icon: 'pi pi-wallet', route: 'admin.finance.payments' },
            { label: 'Expenses', icon: 'pi pi-money-bill', route: 'admin.finance.expenses' },
        ],
    },
    {
        label: 'Human Resources',
        items: [
            { label: 'Payroll', icon: 'pi pi-credit-card', route: 'admin.hr.payroll' },
            { label: 'Leave Requests', icon: 'pi pi-calendar-times', route: 'admin.hr.leave' },
        ],
    },
    {
        label: 'Communication',
        items: [
            { label: 'Announcements', icon: 'pi pi-bell', route: 'admin.communication.announcements' },
        ],
    },
    */
    {
        label: 'Settings',
        items: [
            { label: 'Website Options', icon: 'pi pi-globe', route: 'admin.settings.website.edit' },
            { label: 'Site Configuration', icon: 'pi pi-sliders-h', route: 'admin.settings.modules.edit' },
            { label: 'Languages', icon: 'pi pi-language', route: 'admin.settings.languages.index' },
            { label: 'Users & Roles', icon: 'pi pi-shield', route: 'admin.settings.users.index' },
            { label: 'Permissions', icon: 'pi pi-key', route: 'admin.settings.permissions.index' },
            { label: 'General Settings', icon: 'pi pi-cog', route: 'admin.settings.general' },
        ],
    },
];
