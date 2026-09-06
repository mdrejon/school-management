SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'custom',
  `label` json NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkable_id` bigint(20) unsigned DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  KEY `menu_items_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `menus` (`name`, `slug`, `created_at`, `updated_at`) 
SELECT 'Main Menu', 'header', NOW(), NOW()
FROM DUAL WHERE NOT EXISTS (SELECT * FROM `menus` WHERE `slug` = 'header' LIMIT 1);

SET @menu_id = (SELECT `id` FROM `menus` WHERE `slug` = 'header' LIMIT 1);

DELETE FROM `menu_items` WHERE `menu_id` = @menu_id;

-- 1. Home
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Home", "bn": "হোম", "ar": "الرئيسية"}', '/', 1, 1, NOW(), NOW());

-- 2. About
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "About", "bn": "পরিচিতি", "ar": "معلومات عنا"}', '#', 2, 1, NOW(), NOW());
SET @about_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @about_id, 'custom', '{"en": "About the Madrasa", "bn": "এক নজরে মাদরাসা", "ar": "عن المدرسة"}', '/about-us/about-madrasa', 1, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "History", "bn": "প্রতিষ্ঠানের ইতিহাস", "ar": "تاريخ المؤسسة"}', '/about-us/history', 2, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Mission and Vision", "bn": "মাদরাসার লক্ষ্য ও উদ্দেশ্য", "ar": "الرؤية والرسالة"}', '/about-us/mission-vision', 3, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Message Of Chairman", "bn": "সভাপতির বাণী", "ar": "رسالة الرئيس"}', '/about-us/chairman-message', 4, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Principal''s Message", "bn": "অধ্যক্ষ মহোদয়ের বাণী", "ar": "رسالة المدير"}', '/about-us/principal-message', 5, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Founders", "bn": "প্রতিষ্ঠাতাবৃন্দ", "ar": "المؤسسون"}', '/about-us/founders', 6, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Governing Body", "bn": "গভর্নিং বডি", "ar": "مجلس الإدارة"}', '/about-us/governing-body', 7, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Teachers Information", "bn": "শিক্ষকমন্ডলীর তথ্যাবলী", "ar": "معلومات المعلمين"}', '/about-us/teachers', 8, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Staff Information", "bn": "কর্মকর্তা ও কর্মচারী", "ar": "الموظفين والعاملين"}', '/about-us/staff', 9, 1, NOW(), NOW()),
(@menu_id, @about_id, 'custom', '{"en": "Achievements", "bn": "অর্জন সমূহ", "ar": "الإنجازات"}', '/about-us/achievements', 10, 1, NOW(), NOW());

-- 3. Branches
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Branches", "bn": "শাখা প্রতিষ্ঠান", "ar": "الفروع"}', '#', 3, 1, NOW(), NOW());
SET @branches_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @branches_id, 'custom', '{"en": "Hefzkhana", "bn": "হেফজখানা", "ar": "حفظ القرآن"}', '/branches/hefzkhana', 1, 1, NOW(), NOW()),
(@menu_id, @branches_id, 'custom', '{"en": "Orphanage", "bn": "এতিমখানা", "ar": "دار الأيتام"}', '/branches/orphanage', 2, 1, NOW(), NOW());

-- 4. Departments
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Departments", "bn": "বিভাগ সমূহ", "ar": "الأقسام"}', '#', 4, 1, NOW(), NOW());
SET @departments_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @departments_id, 'custom', '{"en": "Hefz", "bn": "হেফজ", "ar": "حفظ"}', '/departments/hefz', 1, 1, NOW(), NOW()),
(@menu_id, @departments_id, 'custom', '{"en": "Ebtedayee", "bn": "ইবতেদায়ী", "ar": "إبتدائي"}', '/departments/ebtedayee', 2, 1, NOW(), NOW()),
(@menu_id, @departments_id, 'custom', '{"en": "Dakhil", "bn": "দাখিল", "ar": "داخل"}', '/departments/dakhil', 3, 1, NOW(), NOW()),
(@menu_id, @departments_id, 'custom', '{"en": "Alim", "bn": "আলিম", "ar": "عالم"}', '/departments/alim', 4, 1, NOW(), NOW()),
(@menu_id, @departments_id, 'custom', '{"en": "Fazil", "bn": "ফাযিল", "ar": "فاضل"}', '/departments/fazil', 5, 1, NOW(), NOW()),
(@menu_id, @departments_id, 'custom', '{"en": "Honours", "bn": "অনার্স", "ar": "مرتبة الشرف"}', '/departments/honours', 6, 1, NOW(), NOW()),
(@menu_id, @departments_id, 'custom', '{"en": "Kamil", "bn": "কামিল", "ar": "كامل"}', '/departments/kamil', 7, 1, NOW(), NOW()),
(@menu_id, @departments_id, 'custom', '{"en": "Masters", "bn": "মাস্টার্স", "ar": "ماجستير"}', '/departments/masters', 8, 1, NOW(), NOW());

-- 5. Academic
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Academic", "bn": "একাডেমিক তথ্য", "ar": "معلومات أكاديمية"}', '#', 5, 1, NOW(), NOW());
SET @academic_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @academic_id, 'custom', '{"en": "Academic Calendar", "bn": "একাডেমিক ক্যালেন্ডার", "ar": "التقويم الأكاديمي"}', '/academic/calendar', 1, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Education Levels", "bn": "শিক্ষা স্তর", "ar": "المستويات التعليمية"}', '/academic/education-levels', 2, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Syllabus", "bn": "পাঠ্যক্রম", "ar": "المنهج"}', '/academic/syllabus', 3, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Co-Curriculum", "bn": "সহ-পাঠ্যক্রম", "ar": "المناهج المشتركة"}', '/academic/co-curriculum', 4, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Prospectus", "bn": "প্রসপেক্টাস", "ar": "نشرة إعلانية"}', '/academic/prospectus', 5, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Class Routine", "bn": "ক্লাস রুটিন", "ar": "روتين الفصل"}', '/academic/class-routine', 6, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Exam System", "bn": "পরীক্ষা পদ্ধতি", "ar": "نظام الامتحان"}', '/academic/exam-system', 7, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Holiday List", "bn": "ছুটির তালিকা", "ar": "قائمة العطلات"}', '/academic/holidays', 8, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Exam Notice", "bn": "পরীক্ষার নোটিশ", "ar": "إشعار الامتحان"}', '/academic/exam-notice', 9, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Exam Routine", "bn": "পরীক্ষার রুটিন", "ar": "روتين الامتحان"}', '/academic/exam-routine', 10, 1, NOW(), NOW()),
(@menu_id, @academic_id, 'custom', '{"en": "Exam Results", "bn": "পরীক্ষার ফলাফল", "ar": "نتائج الامتحان"}', '/academic/exam-results', 11, 1, NOW(), NOW());

-- 6. Admission
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Admission", "bn": "ভর্তি", "ar": "القبول"}', '#', 6, 1, NOW(), NOW());
SET @admission_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @admission_id, 'custom', '{"en": "Admission Rules", "bn": "ভর্তির নিয়মাবলী", "ar": "قواعد القبول"}', '/admission/rules', 1, 1, NOW(), NOW()),
(@menu_id, @admission_id, 'custom', '{"en": "Admission Circular", "bn": "ভর্তি বিজ্ঞপ্তি", "ar": "إشعار القبول"}', '/admission/circular', 2, 1, NOW(), NOW()),
(@menu_id, @admission_id, 'custom', '{"en": "Prospectus", "bn": "প্রসপেক্টাস", "ar": "نشرة إعلانية"}', '/admission/prospectus', 3, 1, NOW(), NOW()),
(@menu_id, @admission_id, 'custom', '{"en": "Admission Form", "bn": "ভর্তি ফরম", "ar": "استمارة القبول"}', '/admission/form', 4, 1, NOW(), NOW()),
(@menu_id, @admission_id, 'custom', '{"en": "Admission Result", "bn": "ভর্তি ফলাফল", "ar": "نتيجة القبول"}', '/admission/result', 5, 1, NOW(), NOW());

-- 7. Facilities
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Facilities", "bn": "বৈশিষ্ট্য", "ar": "المرافق"}', '#', 7, 1, NOW(), NOW());
SET @facilities_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @facilities_id, 'custom', '{"en": "Classrooms", "bn": "শ্রেণীকক্ষ", "ar": "الفصول الدراسية"}', '/facilities/classrooms', 1, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Computer Lab", "bn": "কম্পিউটার ল্যাব", "ar": "معمل الحاسوب"}', '/facilities/computer-lab', 2, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Science Lab", "bn": "বিজ্ঞানাগার", "ar": "مختبر العلوم"}', '/facilities/science-lab', 3, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Library", "bn": "পাঠাগার", "ar": "المكتبة"}', '/facilities/library', 4, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Laboratories", "bn": "গবেষণাগার", "ar": "المختبرات"}', '/facilities/laboratories', 5, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Hostel", "bn": "ছাত্রাবাস", "ar": "سكن الطلاب"}', '/facilities/hostel', 6, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Mosque", "bn": "মসজিদ", "ar": "المسجد"}', '/facilities/mosque', 7, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Play Ground", "bn": "খেলার মাঠ", "ar": "ملعب"}', '/facilities/play-ground', 8, 1, NOW(), NOW()),
(@menu_id, @facilities_id, 'custom', '{"en": "Canteen", "bn": "ক্যান্টিন", "ar": "مقصف"}', '/facilities/canteen', 9, 1, NOW(), NOW());

-- 8. Accommodation
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Accommodation", "bn": "আবাসন", "ar": "الإقامة"}', '#', 8, 1, NOW(), NOW());
SET @accommodation_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @accommodation_id, 'custom', '{"en": "Hostel Intro", "bn": "ছাত্রাবাস পরিচিতি", "ar": "مقدمة سكن الطلاب"}', '/accommodation/hostel-intro', 1, 1, NOW(), NOW()),
(@menu_id, @accommodation_id, 'custom', '{"en": "Halls & Directors", "bn": "আবাসিক হল ও পরিচালকবৃন্দ", "ar": "القاعات والمدراء"}', '/accommodation/halls-directors', 2, 1, NOW(), NOW()),
(@menu_id, @accommodation_id, 'custom', '{"en": "Accommodation Rules", "bn": "আবাসন প্রাপ্তির নিয়মাবলী", "ar": "قواعد الإقامة"}', '/accommodation/rules', 3, 1, NOW(), NOW()),
(@menu_id, @accommodation_id, 'custom', '{"en": "Accommodation Charges", "bn": "আবাসন চার্জ", "ar": "رسوم الإقامة"}', '/accommodation/charges', 4, 1, NOW(), NOW()),
(@menu_id, @accommodation_id, 'custom', '{"en": "Residential Policies", "bn": "আবাসিক নীতিমালা", "ar": "السياسات السكنية"}', '/accommodation/policies', 5, 1, NOW(), NOW()),
(@menu_id, @accommodation_id, 'custom', '{"en": "Daily Routine", "bn": "দৈনিক আবাসিক কার্যসূচি", "ar": "الروتين اليومي"}', '/accommodation/daily-routine', 6, 1, NOW(), NOW());

-- 9. Students
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Students", "bn": "শিক্ষার্থী", "ar": "الطلاب"}', '#', 9, 1, NOW(), NOW());
SET @students_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @students_id, 'custom', '{"en": "Student List", "bn": "শিক্ষার্থীর তালিকা", "ar": "قائمة الطلاب"}', '/students/list', 1, 1, NOW(), NOW()),
(@menu_id, @students_id, 'custom', '{"en": "Tuition Fees", "bn": "টিউশন ফি", "ar": "الرسوم الدراسية"}', '/students/tuition-fees', 2, 1, NOW(), NOW()),
(@menu_id, @students_id, 'custom', '{"en": "Daily Activities", "bn": "প্রাত্যহিক কার্যাবলী", "ar": "الأنشطة اليومية"}', '/students/daily-activities', 3, 1, NOW(), NOW()),
(@menu_id, @students_id, 'custom', '{"en": "Student Uniform", "bn": "শিক্ষার্থীর পোশাক", "ar": "الزي المدرسي"}', '/students/uniform', 4, 1, NOW(), NOW());

-- 10. Results
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Results", "bn": "ফলাফল", "ar": "النتائج"}', '#', 10, 1, NOW(), NOW());
SET @results_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @results_id, 'custom', '{"en": "Admission Results", "bn": "ভর্তির ফলাফল", "ar": "نتائج القبول"}', '/results/admission', 1, 1, NOW(), NOW()),
(@menu_id, @results_id, 'custom', '{"en": "Academic Exam Results", "bn": "একাডেমিক পরীক্ষার ফলাফল", "ar": "نتائج الامتحانات الأكاديمية"}', '/results/academic-exam', 2, 1, NOW(), NOW()),
(@menu_id, @results_id, 'custom', '{"en": "Board Exam Results", "bn": "বোর্ড পরীক্ষার ফলাফল", "ar": "نتائج امتحانات المجلس"}', '/results/board-exam', 3, 1, NOW(), NOW());

-- 11. Notice
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Notice", "bn": "নোটিশ", "ar": "إشعار"}', '/notices', 11, 1, NOW(), NOW());

-- 12. Gallery
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Gallery", "bn": "গ্যালারী", "ar": "معرض الصور"}', '#', 12, 1, NOW(), NOW());
SET @gallery_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @gallery_id, 'custom', '{"en": "Photo Gallery", "bn": "ফটোগ্যালারী", "ar": "معرض الصور"}', '/gallery/photo', 1, 1, NOW(), NOW()),
(@menu_id, @gallery_id, 'custom', '{"en": "Video Gallery", "bn": "ভিডিও গ্যালারী", "ar": "معرض الفيديو"}', '/gallery/video', 2, 1, NOW(), NOW()),
(@menu_id, @gallery_id, 'custom', '{"en": "Tutorials", "bn": "টিউটরিয়াল", "ar": "دروس"}', '/gallery/tutorials', 3, 1, NOW(), NOW());

-- 13. Contact
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Contact", "bn": "যোগাযোগ", "ar": "اتصل بنا"}', '/contact', 13, 1, NOW(), NOW());

-- 14. Others
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Others", "bn": "অন্যান্য", "ar": "أخرى"}', '#', 14, 1, NOW(), NOW());
SET @others_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @others_id, 'custom', '{"en": "Blog", "bn": "ব্লগ", "ar": "مدونة"}', '/others/blog', 1, 1, NOW(), NOW()),
(@menu_id, @others_id, 'custom', '{"en": "Our Courses", "bn": "আমাদের কোর্স সমূহ", "ar": "دوراتنا"}', '/others/courses', 2, 1, NOW(), NOW());

-- 15. Login
INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) 
VALUES (@menu_id, NULL, 'custom', '{"en": "Login", "bn": "লগইন", "ar": "تسجيل الدخول"}', '#', 15, 1, NOW(), NOW());
SET @login_id = LAST_INSERT_ID();

INSERT INTO `menu_items` (`menu_id`, `parent_id`, `type`, `label`, `url`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(@menu_id, @login_id, 'custom', '{"en": "Student/Parent", "bn": "শিক্ষার্থী/অভিভাবক", "ar": "طالب/ولي أمر"}', '/login/student', 1, 1, NOW(), NOW()),
(@menu_id, @login_id, 'custom', '{"en": "Teacher", "bn": "শিক্ষক", "ar": "معلم"}', '/login/teacher', 2, 1, NOW(), NOW()),
(@menu_id, @login_id, 'custom', '{"en": "Website Admin", "bn": "ওয়েবসাইট অ্যাডমিন", "ar": "مدير الموقع"}', '/admin/login', 3, 1, NOW(), NOW()),
(@menu_id, @login_id, 'custom', '{"en": "Software Login", "bn": "সফটওয়্যার লগইন", "ar": "دخول البرنامج"}', '/software/login', 4, 1, NOW(), NOW());
