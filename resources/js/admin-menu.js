// Sidebar navigation structure for the admin panel.
// Each group has a label and a list of items: { label, icon, route } or { label, icon, route, badge }.
export default [
    {
        label: 'Dashboard',
        icon: 'pi pi-home',
        route: 'admin.dashboard',
    },
    {
        label: 'Academic Configuration',
        icon: 'pi pi-book',
        items: [
            { label: 'Academic Session', icon: 'pi pi-calendar', route: 'admin.academic.sessions.index' },
            { label: 'Shift', icon: 'pi pi-clock', route: 'admin.academic.shifts.index' },
            { label: 'Class', icon: 'pi pi-sitemap', route: 'admin.academic.classes.index' },
            { label: 'Sections', icon: 'pi pi-th-large', route: 'admin.academic.sections.index' },
            { label: 'Groups', icon: 'pi pi-users', route: 'admin.academic.groups.index' },
            { label: 'Periods', icon: 'pi pi-clock', route: 'admin.academic.periods.index' },
            { label: 'Subjects', icon: 'pi pi-book', route: 'admin.academic.subjects.index' },
            { label: 'Subject Config', icon: 'pi pi-cog', route: 'admin.academic.subject-configs.create' },
            { label: 'Optional Subject Configs', icon: 'pi pi-sliders-h', route: 'admin.academic.optional-subject-configs.index' },
            { label: 'Student Optional Subjects', icon: 'pi pi-book', route: 'admin.academic.student-optional-subjects.index' },
            { label: 'Exam', icon: 'pi pi-file-edit', route: 'admin.academic.exams.index' },
            { label: 'Student Categories', icon: 'pi pi-users', route: 'admin.academic.student-categories.index' },
            { label: 'Departments', icon: 'pi pi-building', route: 'admin.academic.departments.index' },
            { label: 'Principal Signature', icon: 'pi pi-pencil', route: 'admin.academic.signatures.index' },
        ],
    },
    {
        label: 'Students Information',
        icon: 'pi pi-users',
        items: [
            { label: 'Students List', icon: 'pi pi-users', route: 'admin.students.index' },
            { label: 'Student Migration', icon: 'pi pi-arrow-right-arrow-left', route: 'admin.students.migration' },
            { label: 'Migration Pushback', icon: 'pi pi-history', route: 'admin.students.migration.pushback' },
            { label: 'Migrated List', icon: 'pi pi-list', route: 'admin.students.migrated-list' },
            { label: 'All Students view list', icon: 'pi pi-eye', route: 'admin.students.at-a-glance' },
            { label: 'Student Attendance', icon: 'pi pi-calendar', route: 'admin.students.attendance.index' },
            { label: 'Exam Attendance', icon: 'pi pi-calendar-times', route: 'admin.students.exam-attendance.index' },
            { label: 'Attendance Report', icon: 'pi pi-chart-bar', route: 'admin.students.attendance-report.index' },
        ],
    },
    {
        label: 'Staffs Information',
        icon: 'pi pi-id-card',
        items: [
            { label: 'Staff Attendance', icon: 'pi pi-calendar-times', route: 'admin.staff.attendance.index' },
            { label: 'Teachers List', icon: 'pi pi-users', route: 'admin.staff.teachers.index' },
            { label: 'Staffs List', icon: 'pi pi-users', route: 'admin.staff.staffs.index' },
        ],
    },
    {
        label: 'Website CMS',
        icon: 'pi pi-globe',
        items: [
            { label: 'Pages', icon: 'pi pi-file', route: 'admin.cms.pages.index' },
            { label: 'Sliders & Banners', icon: 'pi pi-images', route: 'admin.cms.sliders.index', module: 'slider' },
            { label: 'Courses', icon: 'pi pi-graduation-cap', route: 'admin.cms.courses.index', module: 'courses' },
            { label: 'Departments', icon: 'pi pi-sitemap', route: 'admin.cms.departments.index', module: 'departments' },
            { label: 'News & Events', icon: 'pi pi-calendar-plus', route: 'admin.cms.events.index', module: 'events' },
            { label: 'Academic Calendar', icon: 'pi pi-calendar', route: 'admin.cms.academic-calendars.index' },
            { label: 'Notices', icon: 'pi pi-megaphone', route: 'admin.cms.notices.index', module: 'notices' },
            { label: 'Gallery', icon: 'pi pi-image', route: 'admin.cms.gallery.index', module: 'gallery' },
            { label: 'Facilities', icon: 'pi pi-building', route: 'admin.cms.facilities.index', module: 'facilities' },
            { label: 'Portfolio', icon: 'pi pi-briefcase', route: 'admin.cms.portfolios.index', module: 'portfolios' },
            { label: 'Blog', icon: 'pi pi-file-edit', route: 'admin.cms.blog.index', module: 'blog' },
            { label: 'Testimonials', icon: 'pi pi-comments', route: 'admin.cms.testimonials.index', module: 'testimonials' },
            { label: 'FAQ', icon: 'pi pi-question-circle', route: 'admin.cms.faq.index', module: 'faq' },
            { label: 'Founder & Donor List', icon: 'pi pi-heart', route: 'admin.cms.founders-donors.index', module: 'founders_donors' },
            { label: 'Class Schedule', icon: 'pi pi-clock', route: 'admin.cms.class-schedules.index' },
            { label: 'Vision & Mission', icon: 'pi pi-eye', route: 'admin.cms.vision-mission.edit' },
            { label: 'Campus Tour', icon: 'pi pi-compass', route: 'admin.cms.campus-tour.edit' },
            // { label: 'Downloads', icon: 'pi pi-download', route: 'admin.cms.downloads' },

            { label: 'Contact Messages', icon: 'pi pi-envelope', route: 'admin.cms.contact-messages.index', module: 'contact' },
        ],
    },
    /* Temporarily hidden — not built out yet.
    {
        label: 'Finance',
        icon: 'pi pi-money-bill',
        items: [
            { label: 'Fee Structure', icon: 'pi pi-tags', route: 'admin.finance.fees' },
            { label: 'Invoices', icon: 'pi pi-file-invoice', route: 'admin.finance.invoices' },
            { label: 'Payments', icon: 'pi pi-wallet', route: 'admin.finance.payments' },
            { label: 'Expenses', icon: 'pi pi-money-bill', route: 'admin.finance.expenses' },
        ],
    },
    {
        label: 'Human Resources',
        icon: 'pi pi-id-card',
        items: [
            { label: 'Payroll', icon: 'pi pi-credit-card', route: 'admin.hr.payroll' },
            { label: 'Leave Requests', icon: 'pi pi-calendar-times', route: 'admin.hr.leave' },
        ],
    },
    {
        label: 'Communication',
        icon: 'pi pi-comments',
        items: [
            { label: 'Announcements', icon: 'pi pi-bell', route: 'admin.communication.announcements' },
        ],
    },
    */
    {
        label: 'Academic',
        icon: 'pi pi-calendar',
        items: [
            { label: 'Syllabus', icon: 'pi pi-caret-right', route: 'admin.academic.syllabuses.index' },
            { label: 'Assignments', icon: 'pi pi-caret-right', route: 'admin.academic.assignments.index' },
            { label: 'Class Routine', icon: 'pi pi-caret-right', route: 'admin.class-routine.index' },
            { label: 'Resources', icon: 'pi pi-caret-right', route: 'admin.academic.resources.index' },
            { label: 'Class Lessons', icon: 'pi pi-caret-right', route: 'admin.academic.class-lessons.index' },
            { label: 'Prayers', icon: 'pi pi-caret-right', route: 'admin.academic.prayers.index' },
            { label: 'Behaviors', icon: 'pi pi-caret-right', route: 'admin.academic.behaviors.index' },
        ],
    },
    {
        label: 'Exam Module',
        icon: 'pi pi-file-edit',
        items: [
            { label: 'Exam StartUp', icon: 'pi pi-caret-right', route: 'admin.exam-startup.index' },
            { label: 'Mark Config', icon: 'pi pi-caret-right', route: 'admin.exam-marks.index' },
            { label: 'Remarks Config', icon: 'pi pi-caret-right', route: 'admin.exam-remarks.index' },
            { label: 'Mark Input', icon: 'pi pi-caret-right', route: 'admin.mark-input.index' },
            { label: 'Exam Result', icon: 'pi pi-caret-right', route: 'admin.exam-result.index' },
            { label: 'Grand Final Result', icon: 'pi pi-caret-right', route: 'admin.grand-final-result.index' },
        ],
    },
    {
        label: 'Settings',
        icon: 'pi pi-cog',
        items: [
            { label: 'Website Options', icon: 'pi pi-globe', route: 'admin.settings.website.edit' },
            { label: 'Site Configuration', icon: 'pi pi-sliders-h', route: 'admin.settings.modules.edit' },
            { label: 'Languages', icon: 'pi pi-language', route: 'admin.settings.languages.index' },
            { label: 'Users & Roles', icon: 'pi pi-shield', route: 'admin.settings.users.index' },
            { label: 'Permissions', icon: 'pi pi-key', route: 'admin.settings.permissions.index' },
            { label: 'Menus', icon: 'pi pi-bars', route: 'admin.cms.menus.index' },
        ],
    },
];
