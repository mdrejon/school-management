-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table school_management.academic_calendars
CREATE TABLE IF NOT EXISTS `academic_calendars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` json NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'academic_event',
  `description` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.academic_calendars: ~0 rows (approximately)
/*!40000 ALTER TABLE `academic_calendars` DISABLE KEYS */;
INSERT INTO `academic_calendars` (`id`, `date`, `title`, `type`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, '2026-01-01', '{"ar": "عطلة رأس السنة", "bn": "নববর্ষের ছুটি", "en": "New Year Holiday"}', 'holiday', '{"ar": "عطلة رأس السنة — المؤسسة مغلقة.", "bn": "নববর্ষের ছুটি — প্রতিষ্ঠান বন্ধ।", "en": "New Year Holiday — Institution closed."}', 1, '2026-08-22 06:26:17', '2026-08-22 06:26:17'),
	(2, '2026-02-21', '{"ar": "اليوم الدولي للغة الأم", "bn": "আন্তর্জাতিক মাতৃভাষা দিবস", "en": "International Mother Language Day"}', 'academic_event', '{"ar": "احتفال باليوم الدولي للغة الأم في مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসায় আন্তর্জাতিক মাতৃভাষা দিবস উদযাপন।", "en": "Celebration of International Mother Language Day at Sitakund Kamil M.A Madrasah."}', 1, '2026-08-22 06:26:17', '2026-08-22 06:26:17'),
	(3, '2026-03-17', '{"ar": "بداية امتحانات منتصف العام", "bn": "অর্ধ-বার্ষিক পরীক্ষা শুরু", "en": "Mid-Term Examinations Begin"}', 'exam', '{"ar": "بدء امتحانات منتصف العام لجميع الصفوف.", "bn": "সকল শ্রেণীর অর্ধ-বার্ষিক পরীক্ষা শুরু।", "en": "Mid-term examinations begin for all classes."}', 1, '2026-08-22 06:26:17', '2026-08-22 06:26:17'),
	(4, '2026-06-01', '{"ar": "عطلة عيد الأضحى", "bn": "ঈদুল আজহার ছুটি", "en": "Eid-ul-Adha Holiday"}', 'holiday', '{"ar": "عطلة عيد الأضحى — المؤسسة مغلقة.", "bn": "ঈদুল আজহার ছুটি — প্রতিষ্ঠান বন্ধ।", "en": "Eid-ul-Adha Holiday — Institution closed."}', 1, '2026-08-22 06:26:17', '2026-08-22 06:26:17'),
	(5, '2026-08-15', '{"ar": "حفل توزيع الجوائز السنوي", "bn": "বার্ষিক পুরস্কার বিতরণ অনুষ্ঠান", "en": "Annual Prize Giving Ceremony"}', 'academic_event', '{"ar": "حفل توزيع الجوائز السنوي تكريماً لأوائل طلاب مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার শীর্ষ শিক্ষার্থীদের সম্মান জানিয়ে বার্ষিক পুরস্কার বিতরণ অনুষ্ঠান।", "en": "Annual prize giving ceremony honoring top students of Sitakund Kamil M.A Madrasah."}', 1, '2026-08-22 06:26:17', '2026-08-22 06:26:17'),
	(6, '2026-11-01', '{"ar": "بداية الامتحانات السنوية", "bn": "বার্ষিক পরীক্ষা শুরু", "en": "Annual Examinations Begin"}', 'exam', '{"ar": "بدء الامتحانات السنوية لجميع الصفوف.", "bn": "সকল শ্রেণীর বার্ষিক পরীক্ষা শুরু।", "en": "Annual examinations begin for all classes."}', 1, '2026-08-22 06:26:17', '2026-08-22 06:26:17');
/*!40000 ALTER TABLE `academic_calendars` ENABLE KEYS */;

-- Dumping structure for table school_management.academic_classes
CREATE TABLE IF NOT EXISTS `academic_classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.academic_classes: ~5 rows (approximately)
/*!40000 ALTER TABLE `academic_classes` DISABLE KEYS */;
INSERT INTO `academic_classes` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Class 6', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(2, 'Class 7', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(3, 'Class 8', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(4, 'Class 9', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(5, 'Class 10', '2026-08-15 02:33:32', '2026-08-15 02:33:32');
/*!40000 ALTER TABLE `academic_classes` ENABLE KEYS */;

-- Dumping structure for table school_management.academic_departments
CREATE TABLE IF NOT EXISTS `academic_departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.academic_departments: ~4 rows (approximately)
/*!40000 ALTER TABLE `academic_departments` DISABLE KEYS */;
INSERT INTO `academic_departments` (`id`, `name`, `priority`, `created_at`, `updated_at`) VALUES
	(1, 'Bangla', 0, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(2, 'English', 0, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(3, 'Math', 0, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(4, 'Science', 0, '2026-08-15 02:33:32', '2026-08-15 02:33:32');
/*!40000 ALTER TABLE `academic_departments` ENABLE KEYS */;

-- Dumping structure for table school_management.academic_groups
CREATE TABLE IF NOT EXISTS `academic_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.academic_groups: ~4 rows (approximately)
/*!40000 ALTER TABLE `academic_groups` DISABLE KEYS */;
INSERT INTO `academic_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Science', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(2, 'Commerce', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(3, 'Arts', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(4, 'General', '2026-08-15 02:33:32', '2026-08-15 02:33:32');
/*!40000 ALTER TABLE `academic_groups` ENABLE KEYS */;

-- Dumping structure for table school_management.academic_sessions
CREATE TABLE IF NOT EXISTS `academic_sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.academic_sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `academic_sessions` DISABLE KEYS */;
INSERT INTO `academic_sessions` (`id`, `name`, `year`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, '2026-2027', '2026', 1, '2026-08-15 02:32:19', '2026-08-15 02:32:19');
/*!40000 ALTER TABLE `academic_sessions` ENABLE KEYS */;

-- Dumping structure for table school_management.assignments
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deadline` date NOT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `files` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.assignments: ~0 rows (approximately)
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;

-- Dumping structure for table school_management.assignment_submissions
CREATE TABLE IF NOT EXISTS `assignment_submissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `assignment_id` bigint(20) unsigned NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `files` json DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assignment_submissions_assignment_id_foreign` (`assignment_id`),
  KEY `assignment_submissions_student_id_foreign` (`student_id`),
  CONSTRAINT `assignment_submissions_assignment_id_foreign` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assignment_submissions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.assignment_submissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `assignment_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `assignment_submissions` ENABLE KEYS */;

-- Dumping structure for table school_management.behaviors
CREATE TABLE IF NOT EXISTS `behaviors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.behaviors: ~0 rows (approximately)
/*!40000 ALTER TABLE `behaviors` DISABLE KEYS */;
/*!40000 ALTER TABLE `behaviors` ENABLE KEYS */;

-- Dumping structure for table school_management.blog_page_settings
CREATE TABLE IF NOT EXISTS `blog_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.blog_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `blog_page_settings` DISABLE KEYS */;
INSERT INTO `blog_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}', '{"ar": "آخر الأخبار والتحديثات", "bn": "সর্বশেষ সংবাদ ও আপডেট", "en": "Latest News & Updates"}', '{"ar": "المدونة", "bn": "ব্লগ", "en": "Blog"}', '{"ar": "ابق على اطلاع بأحدث الأخبار والإشعارات والفعاليات من مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার সর্বশেষ সংবাদ, বিজ্ঞপ্তি ও অনুষ্ঠান সম্পর্কে আপডেট থাকুন।", "en": "Stay updated with the latest news, notices, and events from Sitakund Kamil M.A Madrasah."}', '{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}', 'site/blog-breadcrumb.jpg', '{"ar": "المدونة - مدرسة الكامل الماجستير بسيتاكُند", "bn": "ব্লগ - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Blog - Sitakund Kamil M.A Madrasah"}', '{"ar": "اقرأ آخر الأخبار والمقالات من مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার সর্বশেষ সংবাদ ও নিবন্ধ পড়ুন।", "en": "Read the latest news and articles from Sitakund Kamil M.A Madrasah."}', '{"ar": "مدونة، أخبار، مدرسة سيتاكُند", "bn": "ব্লগ, সংবাদ, সীতাকুণ্ড মাদ্রাসা", "en": "blog, news, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `blog_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.blog_posts
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `short_description` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `author_name` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `author_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_bio` json DEFAULT NULL,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `blog_posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.blog_posts: ~3 rows (approximately)
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` (`id`, `slug`, `title`, `short_description`, `image`, `published_at`, `author_name`, `description`, `author_photo`, `author_bio`, `gallery_image_1`, `gallery_image_2`, `tags`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'history-of-sitakund-kamil-madrasah', '{"ar": "تاريخ مدرسة الكامل الماجستير بسيتاكُند", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার ইতিহাস", "en": "History of Sitakund Kamil M.A Madrasah"}', '{"ar": "تعرف على القصة المثيرة لمدرسة عمرها 138 عاماً أسسها مولانا عبيد الحق عام 1886.", "bn": "১৮৮৬ সালে মাওলানা ওবায়দুল হক (রহ.) কর্তৃক প্রতিষ্ঠিত ১৩৮ বছরের পুরনো মাদ্রাসার অসাধারণ ইতিহাস জানুন।", "en": "Discover the remarkable story of a 138-year-old institution founded by Maulana Obaidul Haq (R.) in 1886."}', 'site/blog/history-of-sitakund-kamil-madrasah.jpg', '2026-07-18', '{"ar": "إدارة المدرسة", "bn": "মাদ্রাসা প্রশাসন", "en": "Madrasah Administration"}', '{"ar": "<p>في عام 1886، أسس العالم الجليل مولانا عبيد الحق (رحمه الله) مدرسة سيتاكُند آلية (الكامل). وُلد في باربا كُند، سيتاكُند، في الثامن من يونيو 1856، وبعد إتمامه دراسته في كلكتا، عاد ليكرّس حياته للتعليم الإسلامي.</p><p>أُحرقت المدرسة مرتين من قِبل القوى الطائفية في سنواتها الأولى، غير أن مولانا عبيد الحق لم يستسلم. وقد أعاد بناءها في كل مرة، ليُرسي في نهاية المطاف صرحاً تعليمياً راسخاً على الضفة الغربية لبركة لالديغي.</p><p>حصلت المدرسة على الاعتراف الحكومي الدائم عام 1967، ونالت موافقة مستوى الكامل عام 1986 — بالضبط بعد مئة عام من تأسيسها.</p>", "bn": "<p>১৮৮৬ সালে, আলেমে দ্বীন মাওলানা ওবায়দুল হক (রহ.) সীতাকুণ্ড আলীয়া (কামিল) মাদ্রাসা প্রতিষ্ঠা করেন। ১৮৫৬ সালের ৮ জুন বাড়বকুণ্ড, সীতাকুণ্ডে জন্মগ্রহণ করে কলকাতায় শিক্ষা শেষে তিনি ইসলামী শিক্ষায় নিজেকে উৎসর্গ করেন।</p><p>মাদ্রাসাটি প্রাথমিক বছরগুলোতে সাম্প্রদায়িক শক্তির দ্বারা দুইবার পুড়িয়ে দেওয়া হয়েছিল, কিন্তু মাওলানা ওবায়দুল হক দমবার পাত্র ছিলেন না। তিনি বারবার মাদ্রাসা পুনর্নির্মাণ করেন এবং অবশেষে লালদিঘীর পশ্চিম পাড়ে একটি স্থায়ী শিক্ষা প্রতিষ্ঠান গড়ে তোলেন।</p><p>মাদ্রাসাটি ১৯৬৭ সালে স্থায়ী সরকারি স্বীকৃতি এবং ১৯৮৬ সালে — প্রতিষ্ঠার ঠিক ১০০ বছর পর — কামিল স্তরের অনুমোদন লাভ করে।</p>", "en": "<p>In 1886, the visionary scholar Maulana Obaidul Haq (R.) founded Sitakund Aliya (Kamil) Madrasah. Born in Barbakund, Sitakund on 8 June 1856, he returned from studies in Kolkata and dedicated his life to Islamic education.</p><p>The institution was burned down twice by communal forces in its early years, but Maulana Obaidul Haq persevered. He rebuilt it each time, eventually establishing a permanent structure on the western bank of the historic Laldigi pond.</p><p>The Madrasah received permanent government recognition in 1967 and Kamil-level approval in 1986 — exactly 100 years after its founding.</p>"}', 'site/blog-author.jpg', '{"ar": "إدارة مدرسة الكامل بسيتاكُند مسؤولة عن الرعاية الكاملة للطلاب.", "bn": "সীতাকুণ্ড কামিল মাদ্রাসা প্রশাসন শিক্ষার্থীদের সার্বিক কল্যাণের দায়িত্বে নিয়োজিত।", "en": "The Sitakund Kamil Madrasah administration is dedicated to the overall welfare of students."}', 'site/blog-gallery-1.jpg', 'site/blog-gallery-2.jpg', '[{"tag": {"ar": "التاريخ", "bn": "ইতিহাস", "en": "History"}}, {"tag": {"ar": "التأسيس", "bn": "প্রতিষ্ঠা", "en": "Foundation"}}, {"tag": {"ar": "الكامل", "bn": "কামিল", "en": "Kamil"}}]', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'kamil-approval-1986-centenary-milestone', '{"ar": "موافقة الكامل 1986 — مئة عام من العطاء", "bn": "১৯৮৬ সালে কামিল অনুমোদন — শতবর্ষী মাইলফলক", "en": "Kamil Approval 1986 — A Centenary Milestone"}', '{"ar": "بعد مئة عام بالضبط من التأسيس، نالت مدرسة سيتاكُند موافقة مستوى الكامل عام 1986.", "bn": "প্রতিষ্ঠার ঠিক ১০০ বছর পর, সীতাকুণ্ড মাদ্রাসা ১৯৮৬ সালে কামিল স্তরের অনুমোদন লাভ করে।", "en": "Exactly 100 years after its founding, Sitakund Madrasah received Kamil-level approval in 1986."}', 'site/blog/kamil-approval-1986-centenary-milestone.jpg', '2026-07-11', '{"ar": "إدارة المدرسة", "bn": "মাদ্রাসা প্রশাসন", "en": "Madrasah Administration"}', '{"ar": "<p>في عام 1978 بدأت مدرسة سيتاكُند تدريس صف الكامل. وبسبب عدم حصولها على موافقة المجلس آنذاك، كان الطلاب يتسجلون في مدرسة سبهانية آلية حتى عام 1985.</p><p>جاء عام 1986 ليُتوَّج مسيرة الكفاح: نالت المدرسة الموافقة الرسمية على مستوى الكامل، بعد مئة عام بالضبط من تأسيسها. كان ذلك يوماً من الفرحة العارمة للطلاب والمعلمين وأبناء المنطقة جميعاً.</p>", "bn": "<p>১৯৭৮ সালে এই মাদ্রাসায় কামিল ক্লাস চালু হয়। বোর্ডের অনুমোদন না থাকায় ১৯৮৫ পর্যন্ত শিক্ষার্থীরা সোবহানিয়া আলীয়া মাদ্রাসায় রেজিস্ট্রেশন করে পরীক্ষায় অংশ নিত।</p><p>১৯৮৬ সাল আসে সংগ্রামের মুকুট হয়ে: মাদ্রাসাটি আনুষ্ঠানিকভাবে কামিল স্তরের অনুমোদন লাভ করে, প্রতিষ্ঠার ঠিক ১০০ বছর পর। শিক্ষার্থী, শিক্ষক ও এলাকাবাসী সকলের জন্য সেদিন ছিল এক আনন্দের দিন।</p>", "en": "<p>In 1978, Sitakund Madrasah began Kamil-level classes. However, as Board approval was pending, students registered at Sobhaniya Aliya Madrasah to sit examinations until 1985.</p><p>Then came 1986 — the crowning of decades of struggle. The institution received its formal Kamil-level government approval, exactly 100 years after its founding. It was a day of immense joy for students, teachers, and the entire community.</p>"}', 'site/blog-author.jpg', '{"ar": "إدارة مدرسة الكامل بسيتاكُند مسؤولة عن الرعاية الكاملة للطلاب.", "bn": "সীতাকুণ্ড কামিল মাদ্রাসা প্রশাসন শিক্ষার্থীদের সার্বিক কল্যাণের দায়িত্বে নিয়োজিত।", "en": "The Sitakund Kamil Madrasah administration is dedicated to the overall welfare of students."}', 'site/blog-gallery-1.jpg', 'site/blog-gallery-2.jpg', '[{"tag": {"ar": "الكامل", "bn": "কামিল", "en": "Kamil"}}, {"tag": {"ar": "المعالم البارزة", "bn": "মাইলফলক", "en": "Milestone"}}, {"tag": {"ar": "الاعتراف", "bn": "স্বীকৃতি", "en": "Recognition"}}]', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'hafeziya-madrasah-founded-1976', '{"ar": "تأسيس مدرسة الحفظ عام 1976", "bn": "১৯৭৬ সালে হাফেজিয়া মাদ্রাসা প্রতিষ্ঠা", "en": "Hafeziya Madrasah Founded in 1976"}', '{"ar": "في الثالث والعشرين من أكتوبر 1976، أسّس الأستاذ مولانا محمد الحق مدرسة الحفظ داخل الحرم الجامعي.", "bn": "২৩ অক্টোবর ১৯৭৬ সালে, অধ্যক্ষ মাওলানা মুহম্মদুল হক ক্যাম্পাসে হাফেজিয়া মাদ্রাসা প্রতিষ্ঠা করেন।", "en": "On 23 October 1976, Principal Maulana Muhammdul Haq established the Hafeziya Madrasah within the campus."}', 'site/blog/hafeziya-madrasah-founded-1976.jpg', '2026-07-03', '{"ar": "إدارة المدرسة", "bn": "মাদ্রাসা প্রশাসন", "en": "Madrasah Administration"}', '{"ar": "<p>في الثالث والعشرين من أكتوبر 1976، أسس الأستاذ مولانا محمد الحق مدرسة الحفظ ضمن حرم مدرسة سيتاكُند الكامل. كان افتتاح مدرسة الحفظ وتدشين لوحتها التذكارية على يد المستشار الرئاسي آنذاك البروفيسور أبو الفضل، الذي كان قد درّس في المدرسة ذاتها لفترة من الزمن.</p><p>وجاء إنشاء هذا البرنامج إدراكاً من الإدارة لأهمية حفظ القرآن الكريم إلى جانب الدراسات الأكاديمية النظامية.</p>", "bn": "<p>২৩ অক্টোবর ১৯৭৬ সালে, অধ্যক্ষ মাওলানা মুহম্মদুল হক সীতাকুণ্ড কামিল মাদ্রাসার প্রাঙ্গণে হাফেজিয়া মাদ্রাসা প্রতিষ্ঠা করেন। হাফেজিয়া মাদ্রাসার ফলক উন্মোচন করেছিলেন তৎকালীন প্রেসিডেন্টের উপদেষ্টা অধ্যাপক আবুল ফজল, যিনি নিজেও এক সময় এই মাদ্রাসায় শিক্ষকতা করেছিলেন।</p><p>এই প্রোগ্রামটি নিয়মিত পাঠ্যক্রমের পাশাপাশি কুরআন হিফজের গুরুত্ব উপলব্ধি করে প্রশাসন কর্তৃক প্রতিষ্ঠিত হয়েছিল।</p>", "en": "<p>On 23 October 1976, Principal Maulana Muhammdul Haq established the Hafeziya Madrasah within the campus of Sitakund Kamil Madrasah. The plaque for the Hafeziya Madrasah was unveiled by then Presidential Advisor Professor Abul Fazal — who had himself taught at this very institution for a period.</p><p>The establishment of this program reflected the administration\'s recognition of the importance of Quran memorization alongside regular academic studies.</p>"}', 'site/blog-author.jpg', '{"ar": "إدارة مدرسة الكامل بسيتاكُند مسؤولة عن الرعاية الكاملة للطلاب.", "bn": "সীতাকুণ্ড কামিল মাদ্রাসা প্রশাসন শিক্ষার্থীদের সার্বিক কল্যাণের দায়িত্বে নিয়োজিত।", "en": "The Sitakund Kamil Madrasah administration is dedicated to the overall welfare of students."}', 'site/blog-gallery-1.jpg', 'site/blog-gallery-2.jpg', '[{"tag": {"ar": "حفظ القرآن", "bn": "কুরআন হিফজ", "en": "Quran Hafez"}}, {"tag": {"ar": "التقليد", "bn": "ঐতিহ্য", "en": "Tradition"}}, {"tag": {"ar": "الإسلام", "bn": "ইসলাম", "en": "Islam"}}]', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;

-- Dumping structure for table school_management.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.cache: ~11 rows (approximately)
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
-- Cache cleared. Laravel will regenerate from database.
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Dumping structure for table school_management.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.cache_locks: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;

-- Dumping structure for table school_management.campus_tour_page_settings
CREATE TABLE IF NOT EXISTS `campus_tour_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tagline` json DEFAULT NULL,
  `title` json DEFAULT NULL,
  `highlight` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.campus_tour_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `campus_tour_page_settings` DISABLE KEYS */;
INSERT INTO `campus_tour_page_settings` (`id`, `tagline`, `title`, `highlight`, `description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"en": "Campus Tour"}', '{"en": "Take A Look At Our Campus"}', '{"en": "Campus"}', '{"en": "Explore our state-of-the-art facilities, modern classrooms, and vibrant campus life."}', '{"en": "Campus Tour"}', NULL, NULL, NULL, NULL, '2026-08-07 05:48:51', '2026-08-07 05:48:51');
/*!40000 ALTER TABLE `campus_tour_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.class_exams
CREATE TABLE IF NOT EXISTS `class_exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint(20) unsigned NOT NULL,
  `global_exam_id` bigint(20) unsigned NOT NULL,
  `merit_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_exams_class_id_global_exam_id_unique` (`class_id`,`global_exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.class_exams: ~10 rows (approximately)
/*!40000 ALTER TABLE `class_exams` DISABLE KEYS */;
INSERT INTO `class_exams` (`id`, `class_id`, `global_exam_id`, `merit_type`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(2, 1, 4, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(3, 3, 3, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(4, 3, 4, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(5, 5, 3, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(6, 5, 4, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(7, 4, 3, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(8, 4, 4, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(9, 2, 3, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(10, 2, 4, 'GPA', '2026-08-15 02:36:58', '2026-08-15 02:36:58');
/*!40000 ALTER TABLE `class_exams` ENABLE KEYS */;

-- Dumping structure for table school_management.class_exam_codes
CREATE TABLE IF NOT EXISTS `class_exam_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint(20) unsigned NOT NULL,
  `global_exam_code_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_exam_codes_class_id_global_exam_code_id_unique` (`class_id`,`global_exam_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.class_exam_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `class_exam_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_exam_codes` ENABLE KEYS */;

-- Dumping structure for table school_management.class_exam_grades
CREATE TABLE IF NOT EXISTS `class_exam_grades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint(20) unsigned NOT NULL,
  `global_exam_grade_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_exam_grades_class_id_global_exam_grade_id_unique` (`class_id`,`global_exam_grade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.class_exam_grades: ~0 rows (approximately)
/*!40000 ALTER TABLE `class_exam_grades` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_exam_grades` ENABLE KEYS */;

-- Dumping structure for table school_management.class_lessons
CREATE TABLE IF NOT EXISTS `class_lessons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `session_id` bigint(20) unsigned DEFAULT NULL,
  `files` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.class_lessons: ~0 rows (approximately)
/*!40000 ALTER TABLE `class_lessons` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_lessons` ENABLE KEYS */;

-- Dumping structure for table school_management.class_routines
CREATE TABLE IF NOT EXISTS `class_routines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `teacher_id` bigint(20) unsigned NOT NULL,
  `day_of_week` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.class_routines: ~300 rows (approximately)
/*!40000 ALTER TABLE `class_routines` DISABLE KEYS */;
INSERT INTO `class_routines` (`id`, `class_id`, `section_id`, `subject_id`, `teacher_id`, `day_of_week`, `start_time`, `end_time`, `room`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 22, 26, 'Monday', '09:00:00', '09:45:00', 'Room 103', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(2, 1, 1, 18, 25, 'Monday', '10:00:00', '10:45:00', 'Room 147', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(3, 1, 1, 24, 25, 'Monday', '11:00:00', '11:45:00', 'Room 158', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(4, 1, 1, 20, 25, 'Monday', '12:00:00', '12:45:00', 'Room 170', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(5, 1, 1, 21, 25, 'Monday', '13:00:00', '13:45:00', 'Room 127', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(6, 1, 1, 13, 28, 'Monday', '14:00:00', '14:45:00', 'Room 186', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(7, 1, 1, 22, 29, 'Tuesday', '09:00:00', '09:45:00', 'Room 112', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(8, 1, 1, 25, 29, 'Tuesday', '10:00:00', '10:45:00', 'Room 144', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(9, 1, 1, 18, 26, 'Tuesday', '11:00:00', '11:45:00', 'Room 122', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(10, 1, 1, 13, 28, 'Tuesday', '12:00:00', '12:45:00', 'Room 110', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(11, 1, 1, 19, 28, 'Tuesday', '13:00:00', '13:45:00', 'Room 136', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(12, 1, 1, 2, 27, 'Tuesday', '14:00:00', '14:45:00', 'Room 149', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(13, 1, 1, 13, 26, 'Wednesday', '09:00:00', '09:45:00', 'Room 143', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(14, 1, 1, 23, 26, 'Wednesday', '10:00:00', '10:45:00', 'Room 181', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(15, 1, 1, 6, 26, 'Wednesday', '11:00:00', '11:45:00', 'Room 139', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(16, 1, 1, 17, 26, 'Wednesday', '12:00:00', '12:45:00', 'Room 176', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(17, 1, 1, 23, 29, 'Wednesday', '13:00:00', '13:45:00', 'Room 180', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(18, 1, 1, 25, 26, 'Wednesday', '14:00:00', '14:45:00', 'Room 197', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(19, 1, 1, 4, 26, 'Thursday', '09:00:00', '09:45:00', 'Room 196', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(20, 1, 1, 23, 27, 'Thursday', '10:00:00', '10:45:00', 'Room 154', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(21, 1, 1, 7, 27, 'Thursday', '11:00:00', '11:45:00', 'Room 117', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(22, 1, 1, 18, 25, 'Thursday', '12:00:00', '12:45:00', 'Room 104', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(23, 1, 1, 10, 25, 'Thursday', '13:00:00', '13:45:00', 'Room 182', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(24, 1, 1, 2, 25, 'Thursday', '14:00:00', '14:45:00', 'Room 151', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(25, 1, 1, 22, 27, 'Friday', '09:00:00', '09:45:00', 'Room 110', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(26, 1, 1, 24, 28, 'Friday', '10:00:00', '10:45:00', 'Room 131', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(27, 1, 1, 12, 26, 'Friday', '11:00:00', '11:45:00', 'Room 177', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(28, 1, 1, 8, 25, 'Friday', '12:00:00', '12:45:00', 'Room 135', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(29, 1, 1, 12, 29, 'Friday', '13:00:00', '13:45:00', 'Room 185', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(30, 1, 1, 17, 26, 'Friday', '14:00:00', '14:45:00', 'Room 163', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(31, 1, 2, 16, 26, 'Monday', '09:00:00', '09:45:00', 'Room 148', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(32, 1, 2, 19, 25, 'Monday', '10:00:00', '10:45:00', 'Room 169', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(33, 1, 2, 11, 27, 'Monday', '11:00:00', '11:45:00', 'Room 170', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(34, 1, 2, 25, 27, 'Monday', '12:00:00', '12:45:00', 'Room 168', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(35, 1, 2, 21, 28, 'Monday', '13:00:00', '13:45:00', 'Room 136', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(36, 1, 2, 13, 29, 'Monday', '14:00:00', '14:45:00', 'Room 184', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(37, 1, 2, 19, 26, 'Tuesday', '09:00:00', '09:45:00', 'Room 162', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(38, 1, 2, 2, 25, 'Tuesday', '10:00:00', '10:45:00', 'Room 117', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(39, 1, 2, 16, 26, 'Tuesday', '11:00:00', '11:45:00', 'Room 177', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(40, 1, 2, 22, 25, 'Tuesday', '12:00:00', '12:45:00', 'Room 194', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(41, 1, 2, 24, 27, 'Tuesday', '13:00:00', '13:45:00', 'Room 110', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(42, 1, 2, 25, 28, 'Tuesday', '14:00:00', '14:45:00', 'Room 118', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(43, 1, 2, 14, 28, 'Wednesday', '09:00:00', '09:45:00', 'Room 182', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(44, 1, 2, 16, 27, 'Wednesday', '10:00:00', '10:45:00', 'Room 187', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(45, 1, 2, 4, 29, 'Wednesday', '11:00:00', '11:45:00', 'Room 124', '2026-08-15 02:35:55', '2026-08-15 02:35:55'),
	(46, 1, 2, 23, 27, 'Wednesday', '12:00:00', '12:45:00', 'Room 182', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(47, 1, 2, 8, 29, 'Wednesday', '13:00:00', '13:45:00', 'Room 117', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(48, 1, 2, 5, 29, 'Wednesday', '14:00:00', '14:45:00', 'Room 161', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(49, 1, 2, 7, 25, 'Thursday', '09:00:00', '09:45:00', 'Room 192', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(50, 1, 2, 6, 28, 'Thursday', '10:00:00', '10:45:00', 'Room 129', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(51, 1, 2, 16, 29, 'Thursday', '11:00:00', '11:45:00', 'Room 160', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(52, 1, 2, 23, 29, 'Thursday', '12:00:00', '12:45:00', 'Room 155', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(53, 1, 2, 22, 26, 'Thursday', '13:00:00', '13:45:00', 'Room 112', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(54, 1, 2, 22, 26, 'Thursday', '14:00:00', '14:45:00', 'Room 142', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(55, 1, 2, 18, 28, 'Friday', '09:00:00', '09:45:00', 'Room 148', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(56, 1, 2, 7, 27, 'Friday', '10:00:00', '10:45:00', 'Room 174', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(57, 1, 2, 14, 27, 'Friday', '11:00:00', '11:45:00', 'Room 197', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(58, 1, 2, 9, 29, 'Friday', '12:00:00', '12:45:00', 'Room 103', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(59, 1, 2, 4, 28, 'Friday', '13:00:00', '13:45:00', 'Room 139', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(60, 1, 2, 3, 29, 'Friday', '14:00:00', '14:45:00', 'Room 141', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(61, 2, 3, 5, 29, 'Monday', '09:00:00', '09:45:00', 'Room 155', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(62, 2, 3, 12, 27, 'Monday', '10:00:00', '10:45:00', 'Room 131', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(63, 2, 3, 21, 25, 'Monday', '11:00:00', '11:45:00', 'Room 118', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(64, 2, 3, 22, 27, 'Monday', '12:00:00', '12:45:00', 'Room 139', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(65, 2, 3, 9, 27, 'Monday', '13:00:00', '13:45:00', 'Room 166', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(66, 2, 3, 4, 25, 'Monday', '14:00:00', '14:45:00', 'Room 136', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(67, 2, 3, 11, 25, 'Tuesday', '09:00:00', '09:45:00', 'Room 131', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(68, 2, 3, 19, 27, 'Tuesday', '10:00:00', '10:45:00', 'Room 199', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(69, 2, 3, 25, 25, 'Tuesday', '11:00:00', '11:45:00', 'Room 146', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(70, 2, 3, 8, 29, 'Tuesday', '12:00:00', '12:45:00', 'Room 162', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(71, 2, 3, 4, 29, 'Tuesday', '13:00:00', '13:45:00', 'Room 149', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(72, 2, 3, 12, 28, 'Tuesday', '14:00:00', '14:45:00', 'Room 177', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(73, 2, 3, 10, 25, 'Wednesday', '09:00:00', '09:45:00', 'Room 174', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(74, 2, 3, 11, 27, 'Wednesday', '10:00:00', '10:45:00', 'Room 144', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(75, 2, 3, 1, 28, 'Wednesday', '11:00:00', '11:45:00', 'Room 179', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(76, 2, 3, 3, 26, 'Wednesday', '12:00:00', '12:45:00', 'Room 102', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(77, 2, 3, 8, 26, 'Wednesday', '13:00:00', '13:45:00', 'Room 130', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(78, 2, 3, 12, 26, 'Wednesday', '14:00:00', '14:45:00', 'Room 164', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(79, 2, 3, 10, 27, 'Thursday', '09:00:00', '09:45:00', 'Room 163', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(80, 2, 3, 1, 27, 'Thursday', '10:00:00', '10:45:00', 'Room 174', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(81, 2, 3, 21, 27, 'Thursday', '11:00:00', '11:45:00', 'Room 198', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(82, 2, 3, 23, 28, 'Thursday', '12:00:00', '12:45:00', 'Room 196', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(83, 2, 3, 21, 25, 'Thursday', '13:00:00', '13:45:00', 'Room 151', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(84, 2, 3, 22, 29, 'Thursday', '14:00:00', '14:45:00', 'Room 199', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(85, 2, 3, 22, 25, 'Friday', '09:00:00', '09:45:00', 'Room 110', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(86, 2, 3, 18, 27, 'Friday', '10:00:00', '10:45:00', 'Room 152', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(87, 2, 3, 2, 27, 'Friday', '11:00:00', '11:45:00', 'Room 140', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(88, 2, 3, 16, 26, 'Friday', '12:00:00', '12:45:00', 'Room 181', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(89, 2, 3, 25, 28, 'Friday', '13:00:00', '13:45:00', 'Room 175', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(90, 2, 3, 10, 27, 'Friday', '14:00:00', '14:45:00', 'Room 193', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(91, 2, 4, 6, 25, 'Monday', '09:00:00', '09:45:00', 'Room 144', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(92, 2, 4, 23, 27, 'Monday', '10:00:00', '10:45:00', 'Room 124', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(93, 2, 4, 8, 25, 'Monday', '11:00:00', '11:45:00', 'Room 143', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(94, 2, 4, 17, 27, 'Monday', '12:00:00', '12:45:00', 'Room 136', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(95, 2, 4, 14, 25, 'Monday', '13:00:00', '13:45:00', 'Room 176', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(96, 2, 4, 7, 25, 'Monday', '14:00:00', '14:45:00', 'Room 117', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(97, 2, 4, 17, 27, 'Tuesday', '09:00:00', '09:45:00', 'Room 171', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(98, 2, 4, 12, 27, 'Tuesday', '10:00:00', '10:45:00', 'Room 128', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(99, 2, 4, 21, 29, 'Tuesday', '11:00:00', '11:45:00', 'Room 136', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(100, 2, 4, 18, 25, 'Tuesday', '12:00:00', '12:45:00', 'Room 185', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(101, 2, 4, 8, 29, 'Tuesday', '13:00:00', '13:45:00', 'Room 180', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(102, 2, 4, 13, 27, 'Tuesday', '14:00:00', '14:45:00', 'Room 180', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(103, 2, 4, 18, 28, 'Wednesday', '09:00:00', '09:45:00', 'Room 132', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(104, 2, 4, 25, 26, 'Wednesday', '10:00:00', '10:45:00', 'Room 109', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(105, 2, 4, 10, 29, 'Wednesday', '11:00:00', '11:45:00', 'Room 101', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(106, 2, 4, 17, 25, 'Wednesday', '12:00:00', '12:45:00', 'Room 179', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(107, 2, 4, 20, 29, 'Wednesday', '13:00:00', '13:45:00', 'Room 133', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(108, 2, 4, 25, 25, 'Wednesday', '14:00:00', '14:45:00', 'Room 177', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(109, 2, 4, 19, 26, 'Thursday', '09:00:00', '09:45:00', 'Room 117', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(110, 2, 4, 3, 29, 'Thursday', '10:00:00', '10:45:00', 'Room 130', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(111, 2, 4, 23, 26, 'Thursday', '11:00:00', '11:45:00', 'Room 178', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(112, 2, 4, 25, 25, 'Thursday', '12:00:00', '12:45:00', 'Room 165', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(113, 2, 4, 15, 26, 'Thursday', '13:00:00', '13:45:00', 'Room 133', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(114, 2, 4, 3, 27, 'Thursday', '14:00:00', '14:45:00', 'Room 192', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(115, 2, 4, 24, 28, 'Friday', '09:00:00', '09:45:00', 'Room 198', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(116, 2, 4, 3, 25, 'Friday', '10:00:00', '10:45:00', 'Room 177', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(117, 2, 4, 13, 28, 'Friday', '11:00:00', '11:45:00', 'Room 188', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(118, 2, 4, 19, 25, 'Friday', '12:00:00', '12:45:00', 'Room 128', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(119, 2, 4, 19, 25, 'Friday', '13:00:00', '13:45:00', 'Room 181', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(120, 2, 4, 24, 29, 'Friday', '14:00:00', '14:45:00', 'Room 188', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(121, 3, 5, 11, 29, 'Monday', '09:00:00', '09:45:00', 'Room 166', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(122, 3, 5, 21, 26, 'Monday', '10:00:00', '10:45:00', 'Room 174', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(123, 3, 5, 17, 28, 'Monday', '11:00:00', '11:45:00', 'Room 117', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(124, 3, 5, 2, 26, 'Monday', '12:00:00', '12:45:00', 'Room 135', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(125, 3, 5, 16, 25, 'Monday', '13:00:00', '13:45:00', 'Room 101', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(126, 3, 5, 6, 27, 'Monday', '14:00:00', '14:45:00', 'Room 128', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(127, 3, 5, 15, 26, 'Tuesday', '09:00:00', '09:45:00', 'Room 114', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(128, 3, 5, 8, 27, 'Tuesday', '10:00:00', '10:45:00', 'Room 119', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(129, 3, 5, 20, 29, 'Tuesday', '11:00:00', '11:45:00', 'Room 158', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(130, 3, 5, 6, 28, 'Tuesday', '12:00:00', '12:45:00', 'Room 177', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(131, 3, 5, 19, 25, 'Tuesday', '13:00:00', '13:45:00', 'Room 129', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(132, 3, 5, 15, 26, 'Tuesday', '14:00:00', '14:45:00', 'Room 109', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(133, 3, 5, 13, 27, 'Wednesday', '09:00:00', '09:45:00', 'Room 162', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(134, 3, 5, 20, 27, 'Wednesday', '10:00:00', '10:45:00', 'Room 145', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(135, 3, 5, 17, 28, 'Wednesday', '11:00:00', '11:45:00', 'Room 184', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(136, 3, 5, 7, 26, 'Wednesday', '12:00:00', '12:45:00', 'Room 101', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(137, 3, 5, 22, 25, 'Wednesday', '13:00:00', '13:45:00', 'Room 138', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(138, 3, 5, 1, 27, 'Wednesday', '14:00:00', '14:45:00', 'Room 137', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(139, 3, 5, 15, 26, 'Thursday', '09:00:00', '09:45:00', 'Room 175', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(140, 3, 5, 17, 25, 'Thursday', '10:00:00', '10:45:00', 'Room 103', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(141, 3, 5, 23, 27, 'Thursday', '11:00:00', '11:45:00', 'Room 131', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(142, 3, 5, 3, 26, 'Thursday', '12:00:00', '12:45:00', 'Room 169', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(143, 3, 5, 14, 28, 'Thursday', '13:00:00', '13:45:00', 'Room 135', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(144, 3, 5, 12, 25, 'Thursday', '14:00:00', '14:45:00', 'Room 174', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(145, 3, 5, 15, 29, 'Friday', '09:00:00', '09:45:00', 'Room 123', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(146, 3, 5, 21, 25, 'Friday', '10:00:00', '10:45:00', 'Room 170', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(147, 3, 5, 7, 28, 'Friday', '11:00:00', '11:45:00', 'Room 166', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(148, 3, 5, 24, 27, 'Friday', '12:00:00', '12:45:00', 'Room 121', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(149, 3, 5, 14, 28, 'Friday', '13:00:00', '13:45:00', 'Room 101', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(150, 3, 5, 5, 26, 'Friday', '14:00:00', '14:45:00', 'Room 159', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(151, 3, 6, 2, 26, 'Monday', '09:00:00', '09:45:00', 'Room 162', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(152, 3, 6, 25, 26, 'Monday', '10:00:00', '10:45:00', 'Room 146', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(153, 3, 6, 12, 26, 'Monday', '11:00:00', '11:45:00', 'Room 114', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(154, 3, 6, 18, 27, 'Monday', '12:00:00', '12:45:00', 'Room 175', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(155, 3, 6, 13, 26, 'Monday', '13:00:00', '13:45:00', 'Room 117', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(156, 3, 6, 20, 26, 'Monday', '14:00:00', '14:45:00', 'Room 116', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(157, 3, 6, 3, 27, 'Tuesday', '09:00:00', '09:45:00', 'Room 189', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(158, 3, 6, 11, 27, 'Tuesday', '10:00:00', '10:45:00', 'Room 178', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(159, 3, 6, 25, 29, 'Tuesday', '11:00:00', '11:45:00', 'Room 114', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(160, 3, 6, 12, 29, 'Tuesday', '12:00:00', '12:45:00', 'Room 116', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(161, 3, 6, 3, 26, 'Tuesday', '13:00:00', '13:45:00', 'Room 130', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(162, 3, 6, 13, 29, 'Tuesday', '14:00:00', '14:45:00', 'Room 165', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(163, 3, 6, 25, 29, 'Wednesday', '09:00:00', '09:45:00', 'Room 122', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(164, 3, 6, 17, 28, 'Wednesday', '10:00:00', '10:45:00', 'Room 138', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(165, 3, 6, 1, 29, 'Wednesday', '11:00:00', '11:45:00', 'Room 126', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(166, 3, 6, 23, 29, 'Wednesday', '12:00:00', '12:45:00', 'Room 152', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(167, 3, 6, 6, 29, 'Wednesday', '13:00:00', '13:45:00', 'Room 130', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(168, 3, 6, 21, 25, 'Wednesday', '14:00:00', '14:45:00', 'Room 119', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(169, 3, 6, 24, 28, 'Thursday', '09:00:00', '09:45:00', 'Room 150', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(170, 3, 6, 1, 27, 'Thursday', '10:00:00', '10:45:00', 'Room 170', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(171, 3, 6, 10, 25, 'Thursday', '11:00:00', '11:45:00', 'Room 189', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(172, 3, 6, 3, 28, 'Thursday', '12:00:00', '12:45:00', 'Room 177', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(173, 3, 6, 19, 25, 'Thursday', '13:00:00', '13:45:00', 'Room 195', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(174, 3, 6, 1, 29, 'Thursday', '14:00:00', '14:45:00', 'Room 107', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(175, 3, 6, 13, 25, 'Friday', '09:00:00', '09:45:00', 'Room 151', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(176, 3, 6, 1, 25, 'Friday', '10:00:00', '10:45:00', 'Room 195', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(177, 3, 6, 19, 25, 'Friday', '11:00:00', '11:45:00', 'Room 125', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(178, 3, 6, 19, 26, 'Friday', '12:00:00', '12:45:00', 'Room 186', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(179, 3, 6, 16, 29, 'Friday', '13:00:00', '13:45:00', 'Room 173', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(180, 3, 6, 24, 27, 'Friday', '14:00:00', '14:45:00', 'Room 177', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(181, 4, 7, 16, 26, 'Monday', '09:00:00', '09:45:00', 'Room 187', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(182, 4, 7, 23, 28, 'Monday', '10:00:00', '10:45:00', 'Room 139', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(183, 4, 7, 10, 28, 'Monday', '11:00:00', '11:45:00', 'Room 129', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(184, 4, 7, 23, 29, 'Monday', '12:00:00', '12:45:00', 'Room 134', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(185, 4, 7, 4, 25, 'Monday', '13:00:00', '13:45:00', 'Room 112', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(186, 4, 7, 7, 26, 'Monday', '14:00:00', '14:45:00', 'Room 118', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(187, 4, 7, 6, 26, 'Tuesday', '09:00:00', '09:45:00', 'Room 112', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(188, 4, 7, 16, 28, 'Tuesday', '10:00:00', '10:45:00', 'Room 154', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(189, 4, 7, 2, 29, 'Tuesday', '11:00:00', '11:45:00', 'Room 139', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(190, 4, 7, 10, 29, 'Tuesday', '12:00:00', '12:45:00', 'Room 157', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(191, 4, 7, 8, 26, 'Tuesday', '13:00:00', '13:45:00', 'Room 121', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(192, 4, 7, 21, 26, 'Tuesday', '14:00:00', '14:45:00', 'Room 195', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(193, 4, 7, 6, 27, 'Wednesday', '09:00:00', '09:45:00', 'Room 151', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(194, 4, 7, 25, 28, 'Wednesday', '10:00:00', '10:45:00', 'Room 113', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(195, 4, 7, 9, 25, 'Wednesday', '11:00:00', '11:45:00', 'Room 189', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(196, 4, 7, 23, 26, 'Wednesday', '12:00:00', '12:45:00', 'Room 116', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(197, 4, 7, 16, 28, 'Wednesday', '13:00:00', '13:45:00', 'Room 144', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(198, 4, 7, 19, 25, 'Wednesday', '14:00:00', '14:45:00', 'Room 176', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(199, 4, 7, 20, 29, 'Thursday', '09:00:00', '09:45:00', 'Room 139', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(200, 4, 7, 17, 25, 'Thursday', '10:00:00', '10:45:00', 'Room 139', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(201, 4, 7, 16, 26, 'Thursday', '11:00:00', '11:45:00', 'Room 126', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(202, 4, 7, 16, 26, 'Thursday', '12:00:00', '12:45:00', 'Room 136', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(203, 4, 7, 1, 26, 'Thursday', '13:00:00', '13:45:00', 'Room 165', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(204, 4, 7, 16, 29, 'Thursday', '14:00:00', '14:45:00', 'Room 165', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(205, 4, 7, 12, 26, 'Friday', '09:00:00', '09:45:00', 'Room 108', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(206, 4, 7, 4, 26, 'Friday', '10:00:00', '10:45:00', 'Room 125', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(207, 4, 7, 8, 25, 'Friday', '11:00:00', '11:45:00', 'Room 154', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(208, 4, 7, 24, 28, 'Friday', '12:00:00', '12:45:00', 'Room 122', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(209, 4, 7, 8, 28, 'Friday', '13:00:00', '13:45:00', 'Room 142', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(210, 4, 7, 21, 26, 'Friday', '14:00:00', '14:45:00', 'Room 165', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(211, 4, 8, 15, 26, 'Monday', '09:00:00', '09:45:00', 'Room 136', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(212, 4, 8, 3, 26, 'Monday', '10:00:00', '10:45:00', 'Room 119', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(213, 4, 8, 6, 25, 'Monday', '11:00:00', '11:45:00', 'Room 188', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(214, 4, 8, 17, 25, 'Monday', '12:00:00', '12:45:00', 'Room 143', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(215, 4, 8, 4, 27, 'Monday', '13:00:00', '13:45:00', 'Room 194', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(216, 4, 8, 13, 28, 'Monday', '14:00:00', '14:45:00', 'Room 148', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(217, 4, 8, 11, 26, 'Tuesday', '09:00:00', '09:45:00', 'Room 188', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(218, 4, 8, 15, 27, 'Tuesday', '10:00:00', '10:45:00', 'Room 128', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(219, 4, 8, 5, 27, 'Tuesday', '11:00:00', '11:45:00', 'Room 186', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(220, 4, 8, 2, 29, 'Tuesday', '12:00:00', '12:45:00', 'Room 193', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(221, 4, 8, 6, 28, 'Tuesday', '13:00:00', '13:45:00', 'Room 171', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(222, 4, 8, 3, 27, 'Tuesday', '14:00:00', '14:45:00', 'Room 123', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(223, 4, 8, 5, 27, 'Wednesday', '09:00:00', '09:45:00', 'Room 196', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(224, 4, 8, 22, 26, 'Wednesday', '10:00:00', '10:45:00', 'Room 121', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(225, 4, 8, 14, 26, 'Wednesday', '11:00:00', '11:45:00', 'Room 106', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(226, 4, 8, 14, 28, 'Wednesday', '12:00:00', '12:45:00', 'Room 150', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(227, 4, 8, 19, 29, 'Wednesday', '13:00:00', '13:45:00', 'Room 126', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(228, 4, 8, 9, 26, 'Wednesday', '14:00:00', '14:45:00', 'Room 149', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(229, 4, 8, 19, 29, 'Thursday', '09:00:00', '09:45:00', 'Room 124', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(230, 4, 8, 9, 28, 'Thursday', '10:00:00', '10:45:00', 'Room 117', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(231, 4, 8, 25, 27, 'Thursday', '11:00:00', '11:45:00', 'Room 160', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(232, 4, 8, 24, 26, 'Thursday', '12:00:00', '12:45:00', 'Room 172', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(233, 4, 8, 2, 29, 'Thursday', '13:00:00', '13:45:00', 'Room 147', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(234, 4, 8, 1, 27, 'Thursday', '14:00:00', '14:45:00', 'Room 149', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(235, 4, 8, 15, 25, 'Friday', '09:00:00', '09:45:00', 'Room 146', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(236, 4, 8, 17, 26, 'Friday', '10:00:00', '10:45:00', 'Room 193', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(237, 4, 8, 1, 26, 'Friday', '11:00:00', '11:45:00', 'Room 128', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(238, 4, 8, 12, 26, 'Friday', '12:00:00', '12:45:00', 'Room 153', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(239, 4, 8, 1, 26, 'Friday', '13:00:00', '13:45:00', 'Room 136', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(240, 4, 8, 21, 28, 'Friday', '14:00:00', '14:45:00', 'Room 119', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(241, 5, 9, 22, 28, 'Monday', '09:00:00', '09:45:00', 'Room 128', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(242, 5, 9, 9, 28, 'Monday', '10:00:00', '10:45:00', 'Room 189', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(243, 5, 9, 9, 28, 'Monday', '11:00:00', '11:45:00', 'Room 113', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(244, 5, 9, 16, 25, 'Monday', '12:00:00', '12:45:00', 'Room 120', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(245, 5, 9, 16, 27, 'Monday', '13:00:00', '13:45:00', 'Room 170', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(246, 5, 9, 15, 25, 'Monday', '14:00:00', '14:45:00', 'Room 196', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(247, 5, 9, 6, 25, 'Tuesday', '09:00:00', '09:45:00', 'Room 141', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(248, 5, 9, 4, 26, 'Tuesday', '10:00:00', '10:45:00', 'Room 182', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(249, 5, 9, 15, 27, 'Tuesday', '11:00:00', '11:45:00', 'Room 168', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(250, 5, 9, 5, 29, 'Tuesday', '12:00:00', '12:45:00', 'Room 106', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(251, 5, 9, 20, 26, 'Tuesday', '13:00:00', '13:45:00', 'Room 180', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(252, 5, 9, 13, 27, 'Tuesday', '14:00:00', '14:45:00', 'Room 145', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(253, 5, 9, 15, 27, 'Wednesday', '09:00:00', '09:45:00', 'Room 143', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(254, 5, 9, 3, 26, 'Wednesday', '10:00:00', '10:45:00', 'Room 154', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(255, 5, 9, 1, 25, 'Wednesday', '11:00:00', '11:45:00', 'Room 131', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(256, 5, 9, 10, 29, 'Wednesday', '12:00:00', '12:45:00', 'Room 181', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(257, 5, 9, 22, 29, 'Wednesday', '13:00:00', '13:45:00', 'Room 157', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(258, 5, 9, 24, 25, 'Wednesday', '14:00:00', '14:45:00', 'Room 113', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(259, 5, 9, 14, 25, 'Thursday', '09:00:00', '09:45:00', 'Room 194', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(260, 5, 9, 18, 29, 'Thursday', '10:00:00', '10:45:00', 'Room 125', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(261, 5, 9, 10, 26, 'Thursday', '11:00:00', '11:45:00', 'Room 109', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(262, 5, 9, 21, 28, 'Thursday', '12:00:00', '12:45:00', 'Room 109', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(263, 5, 9, 21, 26, 'Thursday', '13:00:00', '13:45:00', 'Room 177', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(264, 5, 9, 12, 29, 'Thursday', '14:00:00', '14:45:00', 'Room 166', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(265, 5, 9, 10, 27, 'Friday', '09:00:00', '09:45:00', 'Room 181', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(266, 5, 9, 23, 27, 'Friday', '10:00:00', '10:45:00', 'Room 169', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(267, 5, 9, 17, 26, 'Friday', '11:00:00', '11:45:00', 'Room 101', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(268, 5, 9, 1, 25, 'Friday', '12:00:00', '12:45:00', 'Room 153', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(269, 5, 9, 10, 29, 'Friday', '13:00:00', '13:45:00', 'Room 102', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(270, 5, 9, 23, 27, 'Friday', '14:00:00', '14:45:00', 'Room 183', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(271, 5, 10, 15, 28, 'Monday', '09:00:00', '09:45:00', 'Room 116', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(272, 5, 10, 16, 25, 'Monday', '10:00:00', '10:45:00', 'Room 112', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(273, 5, 10, 23, 29, 'Monday', '11:00:00', '11:45:00', 'Room 158', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(274, 5, 10, 23, 25, 'Monday', '12:00:00', '12:45:00', 'Room 166', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(275, 5, 10, 18, 26, 'Monday', '13:00:00', '13:45:00', 'Room 178', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(276, 5, 10, 13, 29, 'Monday', '14:00:00', '14:45:00', 'Room 101', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(277, 5, 10, 11, 27, 'Tuesday', '09:00:00', '09:45:00', 'Room 164', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(278, 5, 10, 20, 28, 'Tuesday', '10:00:00', '10:45:00', 'Room 167', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(279, 5, 10, 7, 26, 'Tuesday', '11:00:00', '11:45:00', 'Room 138', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(280, 5, 10, 14, 29, 'Tuesday', '12:00:00', '12:45:00', 'Room 145', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(281, 5, 10, 14, 26, 'Tuesday', '13:00:00', '13:45:00', 'Room 147', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(282, 5, 10, 25, 29, 'Tuesday', '14:00:00', '14:45:00', 'Room 141', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(283, 5, 10, 3, 28, 'Wednesday', '09:00:00', '09:45:00', 'Room 134', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(284, 5, 10, 13, 27, 'Wednesday', '10:00:00', '10:45:00', 'Room 108', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(285, 5, 10, 18, 29, 'Wednesday', '11:00:00', '11:45:00', 'Room 112', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(286, 5, 10, 14, 28, 'Wednesday', '12:00:00', '12:45:00', 'Room 156', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(287, 5, 10, 1, 29, 'Wednesday', '13:00:00', '13:45:00', 'Room 167', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(288, 5, 10, 22, 28, 'Wednesday', '14:00:00', '14:45:00', 'Room 136', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(289, 5, 10, 5, 29, 'Thursday', '09:00:00', '09:45:00', 'Room 124', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(290, 5, 10, 5, 25, 'Thursday', '10:00:00', '10:45:00', 'Room 103', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(291, 5, 10, 6, 27, 'Thursday', '11:00:00', '11:45:00', 'Room 163', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(292, 5, 10, 16, 25, 'Thursday', '12:00:00', '12:45:00', 'Room 110', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(293, 5, 10, 17, 28, 'Thursday', '13:00:00', '13:45:00', 'Room 162', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(294, 5, 10, 17, 28, 'Thursday', '14:00:00', '14:45:00', 'Room 141', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(295, 5, 10, 5, 28, 'Friday', '09:00:00', '09:45:00', 'Room 151', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(296, 5, 10, 9, 29, 'Friday', '10:00:00', '10:45:00', 'Room 165', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(297, 5, 10, 2, 28, 'Friday', '11:00:00', '11:45:00', 'Room 146', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(298, 5, 10, 9, 26, 'Friday', '12:00:00', '12:45:00', 'Room 128', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(299, 5, 10, 16, 25, 'Friday', '13:00:00', '13:45:00', 'Room 148', '2026-08-15 02:35:56', '2026-08-15 02:35:56'),
	(300, 5, 10, 20, 27, 'Friday', '14:00:00', '14:45:00', 'Room 118', '2026-08-15 02:35:56', '2026-08-15 02:35:56');
/*!40000 ALTER TABLE `class_routines` ENABLE KEYS */;

-- Dumping structure for table school_management.class_schedules
CREATE TABLE IF NOT EXISTS `class_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` json NOT NULL,
  `time_info` json NOT NULL,
  `is_bullet` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.class_schedules: ~9 rows (approximately)
/*!40000 ALTER TABLE `class_schedules` DISABLE KEYS */;
INSERT INTO `class_schedules` (`id`, `title`, `time_info`, `is_bullet`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, '{"en": "Gate Closing"}', '{"en": "8.15 A.M. (Regulars)"}', 0, 10, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(2, '{"en": "Assembly"}', '{"en": "8.15 A.M. (Saturday, Monday, Thursday)"}', 0, 20, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(3, '{"en": "Class Starting"}', '{"en": "8.30 A.M. (Regular)"}', 0, 30, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(4, '{"en": "Class Closing"}', '{"en": ""}', 0, 40, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(5, '{"en": "Baby & Class 1"}', '{"en": "11.15 A.M. (Regular)"}', 1, 50, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(6, '{"en": "Class-2"}', '{"en": "1.05 P.M. (Saturday to Wednesday)"}', 1, 60, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(7, '{"en": "Class-2"}', '{"en": "11.15 A.M. (Thursday)"}', 1, 70, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(8, '{"en": "Class-3 to 12"}', '{"en": "1.45 A.M. (Sat to Wed)"}', 1, 80, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17'),
	(9, '{"en": "Class-3 to Class 12"}', '{"en": "11.55 A.M. (Thursday)"}', 1, 90, 1, '2026-08-05 06:15:17', '2026-08-05 06:15:17');
/*!40000 ALTER TABLE `class_schedules` ENABLE KEYS */;

-- Dumping structure for table school_management.class_schedule_page_settings
CREATE TABLE IF NOT EXISTS `class_schedule_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_title` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.class_schedule_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `class_schedule_page_settings` DISABLE KEYS */;
INSERT INTO `class_schedule_page_settings` (`id`, `section_title`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"en": "Daily Activities"}', NULL, '{"en": "Class Schedule"}', NULL, NULL, NULL, NULL, '2026-08-07 05:49:08', '2026-08-07 05:49:08');
/*!40000 ALTER TABLE `class_schedule_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.contact_messages
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.contact_messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;

-- Dumping structure for table school_management.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `category` json DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` json DEFAULT NULL,
  `lessons_count` int(10) unsigned DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `seats` int(10) unsigned DEFAULT NULL,
  `duration` json DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` json DEFAULT NULL,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructor_name` json DEFAULT NULL,
  `instructor_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrolled_text` json DEFAULT NULL,
  `requirement_title` json DEFAULT NULL,
  `requirement_items` json DEFAULT NULL,
  `experience_title` json DEFAULT NULL,
  `experience_description` json DEFAULT NULL,
  `features` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.courses: ~6 rows (approximately)
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `slug`, `title`, `category`, `thumbnail`, `short_description`, `lessons_count`, `rating`, `seats`, `duration`, `price`, `description`, `gallery_image_1`, `gallery_image_2`, `instructor_name`, `instructor_image`, `enrolled_text`, `requirement_title`, `requirement_items`, `experience_title`, `experience_description`, `features`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'dakhil',
	'{"ar": "الداخل (المرحلة الثانوية)", "bn": "দাখিল (মাধ্যমিক স্তর)", "en": "Dakhil (Secondary Level)"}',
	'{"ar": "ثانوي", "bn": "মাধ্যমিক", "en": "Secondary"}',
	'site/courses/dakhil.jpg',
	'{"ar": "مكافئ لـ SSC. برنامج مدته سنتان يشمل الدراسات الإسلامية والبنغالية والإنجليزية والرياضيات والمواد العامة.", "bn": "এসএসসি সমতুল্য। ইসলামী পড়াশোনা, বাংলা, ইংরেজি, গণিত ও সাধারণ বিষয় সমন্বিত ২ বছরের প্রোগ্রাম।", "en": "Equivalent to SSC. A 2-year program covering Islamic studies, Bangla, English, Mathematics, and general subjects."}',
	10, 5.0, 200, '{"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}', 'Free',
	'{"ar": "<p>برنامج الداخل في مدرسة الكامل الماجستير بسيتاكُند مكافئ لـ SSC (شهادة المدرسة الثانوية) ومعترف به من مجلس تعليم المدارس في بنغلاديش. يتلقى الطلاب تعليماً متوازناً يجمع بين العلوم الإسلامية والمواد الأكاديمية الحديثة.</p><p>تشمل المواد القرآن الكريم والحديث والفقه واللغة العربية والبنغالية والإنجليزية والرياضيات والعلوم والدراسات الاجتماعية.</p>", "bn": "<p>সীতাকুণ্ড কামিল এম.এ মাদ্রাসার দাখিল প্রোগ্রাম এসএসসি (মাধ্যমিক স্কুল সার্টিফিকেট) সমতুল্য এবং বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড কর্তৃক স্বীকৃত। শিক্ষার্থীরা ইসলামী বিজ্ঞান ও আধুনিক একাডেমিক বিষয় মিলিয়ে সুষম শিক্ষা পায়।</p><p>বিষয়গুলোতে আল-কুরআন, হাদিস, ফিকহ, আরবি, বাংলা, ইংরেজি, গণিত, বিজ্ঞান ও সামাজিক বিজ্ঞান অন্তর্ভুক্ত।</p>", "en": "<p>The Dakhil program at Sitakund Kamil M.A Madrasah is equivalent to the SSC (Secondary School Certificate) and is recognized by the Bangladesh Madrasah Education Board. Students receive a balanced education combining Islamic sciences with modern academic subjects.</p><p>Subjects include Al-Quran, Hadith, Fiqh, Arabic, Bangla, English, Mathematics, Science, and Social Studies.</p>"}',
	'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg',
	'{"ar": "د. أ.ت.م. طاهر (المدير)", "bn": "ড. এ.টি.এম. তাহের (অধ্যক্ষ)", "en": "Dr. A.T.M. Taher (Principal)"}',
	'site/courses-instructor.jpg',
	'{"ar": "200 طالب", "bn": "২০০ জন শিক্ষার্থী", "en": "200 Students"}',
	'{"ar": "متطلبات القبول", "bn": "ভর্তির প্রয়োজনীয়তা", "en": "Admission Requirements"}',
	'[{"text": {"ar": "شهادة JSC/JDC أو ما يعادلها", "bn": "জেএসসি/জেডিসি সার্টিফিকেট বা সমতুল্য", "en": "JSC/JDC certificate or equivalent"}}, {"text": {"ar": "نموذج القبول مكتمل", "bn": "পূরণকৃত ভর্তি ফর্ম", "en": "Completed admission form"}}, {"text": {"ar": "صورة جواز سفر حديثة وشهادة الميلاد", "bn": "সাম্প্রতিক পাসপোর্ট ছবি ও জন্ম নিবন্ধন সনদ", "en": "Recent passport photo and birth certificate"}}]',
	'{"ar": "فرص المهنة", "bn": "ক্যারিয়ারের সুযোগ", "en": "Career Opportunities"}',
	'{"ar": "يواصل الخريجون إلى مستوى العالم أو يمكنهم دخول امتحان SSC المجلسي المكافئ.", "bn": "স্নাতকরা আলিম স্তরে অগ্রসর হন বা সমতুল্য এসএসসি বোর্ড পরীক্ষায় বসতে পারেন।", "en": "Graduates proceed to Alim level or can sit for the equivalent SSC board examination."}',
	'[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "المدة", "bn": "মেয়াদ", "en": "Duration"}, "value": {"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}}, {"icon": {"value": "globe", "source": "lucide"}, "label": {"ar": "اللغة", "bn": "ভাষা", "en": "Language"}, "value": {"ar": "البنغالية والعربية والإنجليزية", "bn": "বাংলা, আরবি, ইংরেজি", "en": "Bangla, Arabic, English"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "الشهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "شهادة الداخل (المجلس)", "bn": "দাখিল (বোর্ড)", "en": "Dakhil (Board)"}}]',
	1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, 'alim',
	'{"ar": "العالم (المرحلة الثانوية العليا)", "bn": "আলিম (উচ্চ মাধ্যমিক স্তর)", "en": "Alim (Higher Secondary Level)"}',
	'{"ar": "ثانوي عالٍ", "bn": "উচ্চ মাধ্যমিক", "en": "Higher Secondary"}',
	'site/courses/alim.jpg',
	'{"ar": "مكافئ لـ HSC. برنامج متقدم مدته سنتان في العلوم الإسلامية والمواد الحديثة.", "bn": "এইচএসসি সমতুল্য। ইসলামী বিজ্ঞান ও আধুনিক বিষয়ে ২ বছরের উন্নত প্রোগ্রাম।", "en": "Equivalent to HSC. A 2-year advanced program in Islamic sciences and modern subjects."}',
	10, 5.0, 150, '{"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}', 'Free',
	'{"ar": "<p>برنامج العالم مكافئ لـ HSC (شهادة الثانوية العليا). يوفر تعليماً إسلامياً معمقاً إلى جانب المواد الأكاديمية الحديثة، مُعدّاً الطلاب لمرحلة الفاضل أو المسارات المهنية.</p><p>تشمل المواد التفسير والحديث والفقه وآداب اللغة العربية والمنطق والعلوم الحديثة.</p>", "bn": "<p>আলিম প্রোগ্রাম এইচএসসি (উচ্চ মাধ্যমিক সার্টিফিকেট) সমতুল্য। এটি ফাজিল-স্তরের পড়াশোনা বা পেশাদার ক্যারিয়ারের জন্য শিক্ষার্থীদের প্রস্তুত করতে আধুনিক একাডেমিক বিষয়ের পাশাপাশি গভীর ইসলামী শিক্ষা প্রদান করে।</p><p>বিষয়গুলোতে তাফসির, হাদিস, ফিকহ, আরবি সাহিত্য, যুক্তিবিদ্যা ও আধুনিক বিজ্ঞান অন্তর্ভুক্ত।</p>", "en": "<p>The Alim program is equivalent to HSC (Higher Secondary Certificate). It provides in-depth Islamic education alongside modern academic subjects, preparing students for Fazil-level studies or professional career paths.</p><p>Subjects include Tafseer, Hadith, Fiqh, Arabic Literature, Logic, and modern sciences.</p>"}',
	'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg',
	'{"ar": "د. أ.ت.م. طاهر (المدير)", "bn": "ড. এ.টি.এম. তাহের (অধ্যক্ষ)", "en": "Dr. A.T.M. Taher (Principal)"}',
	'site/courses-instructor.jpg',
	'{"ar": "150 طالب", "bn": "১৫০ জন শিক্ষার্থী", "en": "150 Students"}',
	'{"ar": "متطلبات القبول", "bn": "ভর্তির প্রয়োজনীয়তা", "en": "Admission Requirements"}',
	'[{"text": {"ar": "شهادة الداخل بحد أدنى GPA 2.5", "bn": "ন্যূনতম জিপিএ ২.৫ সহ দাখিল সার্টিফিকেট", "en": "Dakhil certificate with minimum GPA 2.5"}}, {"text": {"ar": "نموذج القبول مكتمل", "bn": "পূরণকৃত ভর্তি ফর্ম", "en": "Completed admission form"}}, {"text": {"ar": "صورة جواز سفر حديثة وشهادة سابقة", "bn": "সাম্প্রতিক পাসপোর্ট ছবি ও পূর্ববর্তী সার্টিফিকেট", "en": "Recent passport photo and previous certificate"}}]',
	'{"ar": "فرص المهنة", "bn": "ক্যারিয়ারের সুযোগ", "en": "Career Opportunities"}',
	'{"ar": "يواصل الخريجون دراسة الفاضل أو يعملون في المؤسسات الإسلامية أو الخدمة الحكومية أو مؤسسات التعليم العالي.", "bn": "স্নাতকরা ফাজিল পড়াশোনায় অগ্রসর হন বা ইসলামী প্রতিষ্ঠান, সরকারি চাকরি বা উচ্চ শিক্ষা প্রতিষ্ঠানে চাকরি করতে পারেন।", "en": "Graduates proceed to Fazil studies or may seek employment in Islamic institutions, government service, or higher education institutions."}',
	'[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "المدة", "bn": "মেয়াদ", "en": "Duration"}, "value": {"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "الشهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "شهادة العالم (المجلس)", "bn": "আলিম (বোর্ড)", "en": "Alim (Board)"}}]',
	1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, 'fazil',
	'{"ar": "الفاضل (مرحلة البكالوريوس)", "bn": "ফাজিল (স্নাতক স্তর)", "en": "Fazil (Graduate Level)"}',
	'{"ar": "بكالوريوس", "bn": "স্নাতক", "en": "Graduate"}',
	'site/courses/fazil.jpg',
	'{"ar": "مكافئ للبكالوريوس. برنامج دراسي جامعي مدته سنتان في الدراسات الإسلامية.", "bn": "বিএ সমতুল্য। ইসলামী পড়াশোনায় ২ বছরের স্নাতক প্রোগ্রাম।", "en": "Equivalent to BA. A 2-year undergraduate program in Islamic studies."}',
	10, 5.0, 100, '{"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}', 'Free',
	'{"ar": "<p>برنامج الفاضل مكافئ للبكالوريوس (بكالوريوس الآداب) ويُعدّ الطلاب لدراسة الكامل الماجستير أو العمل في المؤسسات الإسلامية والتعليم والخدمة الحكومية.</p>", "bn": "<p>ফাজিল প্রোগ্রাম বিএ (ব্যাচেলর অব আর্টস) সমতুল্য এবং কামিল এম.এ পড়াশোনা বা ইসলামী প্রতিষ্ঠান, শিক্ষা ও সরকারি সেবায় কর্মসংস্থানের জন্য শিক্ষার্থীদের প্রস্তুত করে।</p>", "en": "<p>The Fazil program is equivalent to a BA (Bachelor of Arts) and prepares students for Kamil M.A studies or employment in Islamic institutions, education, and government service.</p>"}',
	'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg',
	'{"ar": "د. أ.ت.م. طاهر (المدير)", "bn": "ড. এ.টি.এম. তাহের (অধ্যক্ষ)", "en": "Dr. A.T.M. Taher (Principal)"}',
	'site/courses-instructor.jpg',
	'{"ar": "100 طالب", "bn": "১০০ জন শিক্ষার্থী", "en": "100 Students"}',
	'{"ar": "متطلبات القبول", "bn": "ভর্তির প্রয়োজনীয়তা", "en": "Admission Requirements"}',
	'[{"text": {"ar": "شهادة العالم بحد أدنى GPA 2.5", "bn": "ন্যূনতম জিপিএ ২.৫ সহ আলিম সার্টিফিকেট", "en": "Alim certificate with minimum GPA 2.5"}}, {"text": {"ar": "نموذج القبول مكتمل", "bn": "পূরণকৃত ভর্তি ফর্ম", "en": "Completed admission form"}}]',
	'{"ar": "فرص المهنة", "bn": "ক্যারিয়ারের সুযোগ", "en": "Career Opportunities"}',
	'{"ar": "يمكن للخريجين متابعة الكامل الماجستير أو مزاولة مهن في التعليم الإسلامي والخدمة الحكومية والقيادة المجتمعية.", "bn": "স্নাতকরা কামিল এম.এ-তে অগ্রসর হতে পারেন বা ইসলামী শিক্ষা, সরকারি সেবা ও সামাজিক নেতৃত্বে ক্যারিয়ার গড়তে পারেন।", "en": "Graduates may proceed to Kamil M.A or pursue careers in Islamic education, government service, and community leadership."}',
	'[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "المدة", "bn": "মেয়াদ", "en": "Duration"}, "value": {"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "الشهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "شهادة الفاضل (المجلس)", "bn": "ফাজিল (বোর্ড)", "en": "Fazil (Board)"}}]',
	1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(4, 'kamil-ma',
	'{"ar": "الكامل الماجستير (مرحلة الدراسات العليا)", "bn": "কামিল এম.এ (স্নাতকোত্তর স্তর)", "en": "Kamil M.A (Postgraduate Level)"}',
	'{"ar": "دراسات عليا", "bn": "স্নাতকোত্তর", "en": "Postgraduate"}',
	'site/courses/kamil-ma.jpg',
	'{"ar": "أعلى مستوى في تعليم المدارس، مكافئ للماجستير. متخصص في علم الكلام والفقه والحديث أو الأدب العربي.", "bn": "মাদ্রাসা শিক্ষার সর্বোচ্চ স্তর, এম.এ সমতুল্য। ইসলামী ধর্মতত্ত্ব, আইনশাস্ত্র, হাদিস বা আরবি সাহিত্যে বিশেষজ্ঞ।", "en": "The highest level in Madrasah education, equivalent to M.A. Specialized in Islamic theology, jurisprudence, Hadith, or Arabic literature."}',
	10, 5.0, 60, '{"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}', 'Free',
	'{"ar": "<p>برنامج الكامل الماجستير هو قمة تعليم المدارس في بنغلاديش، مكافئ لدرجة الماجستير في الآداب. حصلت مدرسة الكامل الماجستير بسيتاكُند على موافقة رسمية بمستوى الكامل عام 1986 — بعد 100 عام من تأسيسها.</p><p>تشمل التخصصات المتاحة الحديث والتفسير والفقه والأدب العربي. الخريجون من أكثر العلماء والمعلمين طلباً في المنطقة.</p>", "bn": "<p>কামিল এম.এ প্রোগ্রাম বাংলাদেশে মাদ্রাসা শিক্ষার শীর্ষে, মাস্টার অব আর্টস ডিগ্রির সমতুল্য। সীতাকুণ্ড কামিল এম.এ মাদ্রাসা ১৯৮৬ সালে — প্রতিষ্ঠার ১০০ বছর পর — আনুষ্ঠানিক কামিল-স্তরের অনুমোদন পেয়েছে।</p><p>উপলব্ধ বিশেষায়ন অন্তর্ভুক্ত করে হাদিস, তাফসির, ফিকহ এবং আরবি সাহিত্য। স্নাতকরা অঞ্চলের সর্বাধিক চাওয়া আলেম ও শিক্ষকদের মধ্যে।</p>", "en": "<p>The Kamil M.A program is the pinnacle of Madrasah education in Bangladesh, equivalent to a Master of Arts degree. Sitakund Kamil M.A Madrasah received official Kamil-level approval in 1986 — 100 years after its founding.</p><p>Available specializations include Hadith, Tafsir, Fiqh, and Arabic Literature. Graduates are among the most sought-after scholars and educators in the region.</p>"}',
	'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg',
	'{"ar": "د. أ.ت.م. طاهر (المدير)", "bn": "ড. এ.টি.এম. তাহের (অধ্যক্ষ)", "en": "Dr. A.T.M. Taher (Principal)"}',
	'site/courses-instructor.jpg',
	'{"ar": "60 طالب", "bn": "৬০ জন শিক্ষার্থী", "en": "60 Students"}',
	'{"ar": "متطلبات القبول", "bn": "ভর্তির প্রয়োজনীয়তা", "en": "Admission Requirements"}',
	'[{"text": {"ar": "شهادة الفاضل بحد أدنى الفئة الثانية", "bn": "ন্যূনতম দ্বিতীয় শ্রেণী সহ ফাজিল সার্টিফিকেট", "en": "Fazil certificate with minimum Second Class"}}, {"text": {"ar": "نموذج القبول مكتمل والوثائق ذات الصلة", "bn": "পূরণকৃত ভর্তি ফর্ম ও প্রাসঙ্গিক নথিপত্র", "en": "Completed admission form and relevant documents"}}]',
	'{"ar": "فرص المهنة", "bn": "ক্যারিয়ারের সুযোগ", "en": "Career Opportunities"}',
	'{"ar": "يعمل خريجو الكامل الماجستير أئمةً وعلماءَ إسلاميين ومعلمين وباحثين ويشغلون مناصب في إدارات الشؤون الإسلامية الحكومية والمؤسسات التعليمية في جميع أنحاء بنغلاديش.", "bn": "কামিল এম.এ স্নাতকরা সারা বাংলাদেশে ইমাম, ইসলামী পণ্ডিত, শিক্ষাবিদ, গবেষক হিসেবে কাজ করেন এবং সরকারি ইসলামিক বিষয় বিভাগ ও শিক্ষা প্রতিষ্ঠানে পদ অধিষ্ঠান করেন।", "en": "Kamil M.A graduates serve as Imams, Islamic scholars, educators, researchers, and hold positions in government Islamic affairs departments and educational institutions throughout Bangladesh."}',
	'[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "المدة", "bn": "মেয়াদ", "en": "Duration"}, "value": {"ar": "سنتان", "bn": "২ বছর", "en": "2 Years"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "الشهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "الكامل الماجستير (المجلس)", "bn": "কামিল এম.এ (বোর্ড)", "en": "Kamil M.A (Board)"}}]',
	1, 4, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(5, 'hafeziya-quran-memorization',
	'{"ar": "الحفظ (حفظ القرآن الكريم)", "bn": "হাফেজিয়া (কুরআন মুখস্থ)", "en": "Hafeziya (Quran Memorization)"}',
	'{"ar": "القرآن", "bn": "কুরআন", "en": "Quran"}',
	'site/courses/hafeziya.jpg',
	'{"ar": "برنامج حفظ قرآن متخصص تأسس عام 1976. يُنتج حفاظ القرآن من خلال الحفظ اليومي المكثف والتدريب على التجويد.", "bn": "১৯৭৬ সালে প্রতিষ্ঠিত একটি নিবেদিত কুরআন মুখস্থ প্রোগ্রাম। কঠোর দৈনিক মুখস্থ ও তাজওয়িদ প্রশিক্ষণের মাধ্যমে হাফিজে কুরআন তৈরি করে।", "en": "A dedicated Quran memorization program established in 1976. Produces Hafiz-e-Quran through rigorous daily memorization and Tajweed training."}',
	NULL, 5.0, 50, '{"ar": "3-5 سنوات", "bn": "৩-৫ বছর", "en": "3-5 Years"}', 'Free',
	'{"ar": "<p>أُسس برنامج الحفظ في مدرسة الكامل الماجستير بسيتاكُند في 23 أكتوبر 1976 في عهد المدير مولانا محمد الحق. يركز البرنامج على الحفظ الكامل للقرآن الكريم مع التجويد الصحيح.</p><p>يتلقى طلاب هذا البرنامج تعليماً فردياً يومياً من معلمين حفاظ مؤهلين، مع جلسات مراجعة مكثفة على مدار السنة.</p>", "bn": "<p>সীতাকুণ্ড কামিল এম.এ মাদ্রাসার হাফেজিয়া প্রোগ্রাম অধ্যক্ষ মাওলানা মুহম্মদুল হকের নেতৃত্বে ২৩ অক্টোবর ১৯৭৬ সালে প্রতিষ্ঠিত হয়েছিল। প্রোগ্রামটি সঠিক তাজওয়িদ (তেলাওয়াতের নিয়ম) সহ পবিত্র কুরআনের সম্পূর্ণ মুখস্থের উপর দৃষ্টি নিবদ্ধ করে।</p><p>এই প্রোগ্রামের শিক্ষার্থীরা যোগ্য হুফফাজ শিক্ষকদের কাছ থেকে দৈনিক ব্যক্তিগত নির্দেশনা পায়, সারা বছর নিবিড় পুনরাবৃত্তি সেশন সহ।</p>", "en": "<p>The Hafeziya program at Sitakund Kamil M.A Madrasah was established on 23 October 1976 under Principal Maulana Muhammdul Haq. The program focuses on complete memorization of the Holy Quran with proper Tajweed (recitation rules).</p><p>Students in this program receive daily one-on-one instruction from qualified Huffaz teachers, with intensive revision sessions throughout the year.</p>"}',
	'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg',
	'{"ar": "معلمون حفاظ مؤهلون", "bn": "যোগ্য হুফফাজ শিক্ষকবৃন্দ", "en": "Qualified Huffaz Teachers"}',
	'site/courses-instructor.jpg',
	'{"ar": "50 طالب", "bn": "৫০ জন শিক্ষার্থী", "en": "50 Students"}',
	'{"ar": "متطلبات القبول", "bn": "ভর্তির প্রয়োজনীয়তা", "en": "Admission Requirements"}',
	'[{"text": {"ar": "العمر بين 7-15 سنة (للطلاب الجدد)", "bn": "নতুন ভর্তির জন্য ৭-১৫ বছর বয়স", "en": "Age between 7-15 years (for new entrants)"}}, {"text": {"ar": "القدرة الأساسية على قراءة القرآن (النظرة)", "bn": "প্রাথমিক কুরআন পাঠের দক্ষতা (নাজেরা)", "en": "Basic Quran reading ability (Nazera)"}}, {"text": {"ar": "نموذج القبول مكتمل وموافقة ولي الأمر", "bn": "পূরণকৃত ভর্তি ফর্ম ও অভিভাবকের সম্মতি", "en": "Completed admission form and guardian consent"}}]',
	'{"ar": "بعد الاكتمال", "bn": "সম্পন্ন হওয়ার পর", "en": "After Completion"}',
	'{"ar": "يحمل الخريجون اللقب المرموق لحافظ القرآن ويُطلب بهم كأئمة ومعلمين للقرآن وعلماء إسلاميين. كثيرون يتابعون أيضاً البرامج الأكاديمية الرسمية للمدارس جنباً إلى جنب أو بعد الحفظ.", "bn": "স্নাতকরা প্রতিষ্ঠিত হাফিজে কুরআন খেতাব পান এবং ইমাম, কুরআন শিক্ষক ও ইসলামী পণ্ডিত হিসেবে চাহিদাসম্পন্ন হন। অনেকেই হিফজের পাশাপাশি বা পরে আনুষ্ঠানিক মাদ্রাসা একাডেমিক প্রোগ্রামেও অংশগ্রহণ করেন।", "en": "Graduates receive the prestigious title of Hafiz-e-Quran and are sought after as Imams, Quran teachers, and Islamic scholars. Many also pursue formal Madrasah academic programs alongside or after Hifz."}',
	'[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "المدة", "bn": "মেয়াদ", "en": "Duration"}, "value": {"ar": "3-5 سنوات", "bn": "৩-৫ বছর", "en": "3-5 Years"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "اللقب المكتسب", "bn": "অর্জিত উপাধি", "en": "Title Earned"}, "value": {"ar": "حافظ القرآن", "bn": "হাফিজে কুরআন", "en": "Hafiz-e-Quran"}}]',
	1, 5, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

-- Dumping structure for table school_management.course_page_settings
CREATE TABLE IF NOT EXISTS `course_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.course_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `course_page_settings` DISABLE KEYS */;
INSERT INTO `course_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "برامجنا", "bn": "আমাদের প্রোগ্রামসমূহ", "en": "Our Programs"}', '{"ar": "البرامج الأكاديمية المقدمة", "bn": "প্রদত্ত একাডেমিক প্রোগ্রামসমূহ", "en": "Academic Programs Offered"}', '{"ar": "البرامج", "bn": "প্রোগ্রামসমূহ", "en": "Programs"}', '{"ar": "تقدم مدرسة الكامل الماجستير بسيتاكُند تعليماً إسلامياً وحديثاً شاملاً من الداخل إلى مستوى الكامل الماجستير.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা দাখিল থেকে কামিল এম.এ স্তর পর্যন্ত ব্যাপক ইসলামী ও আধুনিক শিক্ষা অফার করে।", "en": "Sitakund Kamil M.A Madrasah offers comprehensive Islamic and modern education from Dakhil to Kamil M.A level."}', '{"ar": "البرامج", "bn": "প্রোগ্রামসমূহ", "en": "Programs"}', 'site/course-breadcrumb.jpg', '{"ar": "البرامج - مدرسة الكامل الماجستير بسيتاكُند", "bn": "প্রোগ্রামসমূহ - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Programs - Sitakund Kamil M.A Madrasah"}', '{"ar": "تصفح البرامج المقدمة من مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার প্রদত্ত প্রোগ্রামসমূহ ব্রাউজ করুন।", "en": "Browse programs offered by Sitakund Kamil M.A Madrasah."}', '{"ar": "برامج، دورات، مدرسة سيتاكُند", "bn": "প্রোগ্রাম, কোর্স, সীতাকুণ্ড মাদ্রাসা", "en": "programs, courses, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `course_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` json DEFAULT NULL,
  `title` json NOT NULL,
  `short_description` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` json DEFAULT NULL,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement_title` json DEFAULT NULL,
  `requirement_items` json DEFAULT NULL,
  `downloads` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.departments: ~8 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`id`, `slug`, `icon`, `title`, `short_description`, `image`, `description`, `gallery_image_1`, `gallery_image_2`, `requirement_title`, `requirement_items`, `downloads`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'business-and-finance', '{"value": "briefcase", "source": "lucide"}', '{"ar": "الأعمال والتمويل", "bn": "ব্যবসা ও অর্থায়ন", "en": "Business And Finance"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'law-and-criminology', '{"value": "scale", "source": "lucide"}', '{"ar": "القانون وعلم الجريمة", "bn": "আইন ও অপরাধবিজ্ঞান", "en": "Law And Criminology"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'it-and-data-science', '{"value": "database", "source": "lucide"}', '{"ar": "تكنولوجيا المعلومات وعلوم البيانات", "bn": "আইটি ও ডেটা সায়েন্স", "en": "IT And Data Science"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, 'health-and-medicine', '{"value": "heart-pulse", "source": "lucide"}', '{"ar": "الصحة والطب", "bn": "স্বাস্থ্য ও চিকিৎসা", "en": "Health And Medicine"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(5, 'art-and-design', '{"value": "palette", "source": "lucide"}', '{"ar": "الفن والتصميم", "bn": "শিল্প ও নকশা", "en": "Art And Design"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 5, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(6, 'information-technology', '{"value": "monitor", "source": "lucide"}', '{"ar": "تكنولوجيا المعلومات", "bn": "তথ্য প্রযুক্তি", "en": "Information Technology"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 6, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(7, 'acting-and-drama', '{"value": "drama", "source": "lucide"}', '{"ar": "التمثيل والدراما", "bn": "অভিনয় ও নাটক", "en": "Acting And Drama"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 7, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(8, 'human-resource', '{"value": "users", "source": "lucide"}', '{"ar": "الموارد البشرية", "bn": "মানব সম্পদ", "en": "Human Resource"}', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', 'site/departments-detail.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يوفر هذا القسم للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই বিভাগটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/departments-gallery-1.jpg', 'site/departments-gallery-2.jpg', '{"ar": "كيفية الاستعداد للامتحان", "bn": "পরীক্ষার জন্য কীভাবে প্রস্তুতি নেবেন", "en": "How To Prepare For The Exam"}', '[{"text": {"ar": "يتطلب من الطلاب حد أدنى من المعدل التراكمي.", "bn": "শিক্ষার্থীদের ন্যূনতম জিপিএ প্রয়োজন।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "يجب اجتياز امتحان القبول.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হতে হবে।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "يجب تقديم المستندات المطلوبة.", "bn": "প্রয়োজনীয় কাগজপত্র জমা দিতে হবে।", "en": "Nullam rhoncus dictum diam quis ultrices."}}, {"text": {"ar": "يجب حضور المقابلة الشخصية.", "bn": "সাক্ষাৎকারে উপস্থিত থাকতে হবে।", "en": "Integer quis lorem est suspendisse eu augue porta ullamcorper dictum."}}]', '[]', 1, 8, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping structure for table school_management.department_page_settings
CREATE TABLE IF NOT EXISTS `department_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.department_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `department_page_settings` DISABLE KEYS */;
INSERT INTO `department_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "القسم", "bn": "বিভাগ", "en": "Department"}', '{"ar": "تصفح أقسامنا", "bn": "আমাদের বিভাগসমূহ দেখুন", "en": "Browse Our Departments"}', '{"ar": "الأقسام", "bn": "বিভাগসমূহ", "en": "Departments"}', '{"ar": "استكشف الأقسام الأكاديمية لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার একাডেমিক বিভাগসমূহ দেখুন।", "en": "Explore the academic departments of Sitakund Kamil M.A Madrasah."}', '{"ar": "الأقسام الأكاديمية", "bn": "একাডেমিক বিভাগসমূহ", "en": "Academic Departments"}', 'site/department-breadcrumb.jpg', '{"ar": "الأقسام - مدرسة الكامل الماجستير بسيتاكُند", "bn": "বিভাগসমূহ - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Departments - Sitakund Kamil M.A Madrasah"}', '{"ar": "استكشف الأقسام الأكاديمية لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার একাডেমিক বিভাগসমূহ দেখুন।", "en": "Explore academic departments of Sitakund Kamil M.A Madrasah."}', '{"ar": "أقسام، مدرسة سيتاكُند", "bn": "বিভাগ, সীতাকুণ্ড মাদ্রাসা", "en": "departments, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `department_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.donors
CREATE TABLE IF NOT EXISTS `donors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `contribution` json DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.donors: ~5 rows (approximately)
/*!40000 ALTER TABLE `donors` DISABLE KEYS */;
INSERT INTO `donors` (`id`, `name`, `contribution`, `year`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "مولانا عبيد الحق (رحمه الله)", "bn": "মাওলানা ওবায়দুল হক (রহ.)", "en": "Maulana Obaidul Haq (R.)"}', '{"ar": "المؤسس — أسس المؤسسة بأموال وجهود شخصية", "bn": "প্রতিষ্ঠাতা — ব্যক্তিগত তহবিল ও প্রচেষ্টায় প্রতিষ্ঠান গড়ে তোলেন", "en": "Founder — established the institution with personal funds and efforts"}', '1886', 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, '{"ar": "المجتمع المحلي (سيتاكُند)", "bn": "স্থানীয় সম্প্রদায় (সীতাকুণ্ড)", "en": "Local Community (Sitakund)"}', '{"ar": "المساهمة الجماعية في إعادة البناء والتوسعة بعد الهجمات الطائفية", "bn": "সাম্প্রদায়িক আক্রমণের পর পুনর্নির্মাণ ও সম্প্রসারণে সম্মিলিত অবদান", "en": "Collective contribution to rebuilding and expansion after communal attacks"}', '1892', 1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, '{"ar": "شفيق الرحمن (تيريايل)", "bn": "শফিকুর রহমান (টেরিয়াইল)", "en": "Shafiqur Rahman (Teriyail)"}', '{"ar": "أمين لجنة إدارة المدرسة — مساهمات إدارية رئيسية", "bn": "মাদ্রাসা পরিচালনা কমিটির সেক্রেটারী — মূল প্রশাসনিক অবদান", "en": "Secretary of the Madrasah Management Committee — key administrative contributions"}', '1921', 1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `donors` ENABLE KEYS */;

-- Dumping structure for table school_management.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `location` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` json DEFAULT NULL,
  `content_blocks` json DEFAULT NULL,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_embed_url` text COLLATE utf8mb4_unicode_ci,
  `sidebar_intro` json DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` json DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizer_name` json DEFAULT NULL,
  `organizer_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizer_bio` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.events: ~6 rows (approximately)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `slug`, `title`, `location`, `image`, `event_date`, `event_time`, `short_description`, `content_blocks`, `gallery_image_1`, `gallery_image_2`, `map_embed_url`, `sidebar_intro`, `cost`, `button_text`, `button_url`, `organizer_name`, `organizer_photo`, `organizer_bio`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'annual-prize-giving-ceremony-2026', '{"ar": "حفل توزيع الجوائز السنوي 2026", "bn": "বার্ষিক পুরস্কার বিতরণ অনুষ্ঠান ২০২৬", "en": "Annual Prize Giving Ceremony 2026"}', '{"ar": "القاعة الرئيسية لمدرسة الكامل الماجستير بسيتاكُند", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা প্রধান হলরুম", "en": "Sitakund Kamil M.A Madrasah Main Hall"}', 'site/events/annual-prize-giving-2026.jpg', '2026-08-15', '09:00:00', '{"ar": "انضم إلينا في حفل توزيع الجوائز السنوي حيث نكرم طلابنا المتميزين للعام الدراسي 2025-26.", "bn": "বার্ষিক পুরস্কার বিতরণ অনুষ্ঠানে আমাদের সাথে যোগ দিন যেখানে আমরা ২০২৫-২৬ শিক্ষাবর্ষের আমাদের অসাধারণ শিক্ষার্থীদের সম্মান জানাব।", "en": "Join us for the Annual Prize Giving Ceremony where we honor our outstanding students of the year 2025-26."}', '[{"type": "paragraph", "content": {"ar": "حفل توزيع الجوائز السنوي هو أحد أبرز تقاليد مدرسة الكامل الماجستير بسيتاكُند. يكرّم هذا الحفل التميز الأكاديمي والشخصية والقيادة بين طلابنا.", "bn": "বার্ষিক পুরস্কার বিতরণ অনুষ্ঠান সীতাকুণ্ড কামিল এম.এ মাদ্রাসার অন্যতম উদযাপিত ঐতিহ্য। এই অনুষ্ঠানে আমাদের শিক্ষার্থীদের মধ্যে একাডেমিক শ্রেষ্ঠত্ব, চরিত্র ও নেতৃত্ব স্বীকৃতি দেওয়া হয়।", "en": "The Annual Prize Giving Ceremony is one of the most celebrated traditions of Sitakund Kamil M.A Madrasah. This event recognizes academic excellence, character, and leadership among our students."}}]', 'site/events/gallery-1.jpg', 'site/events/gallery-2.jpg', 'https://maps.google.com/maps?q=Sitakund+Kamil+Madrasah&output=embed', '{"ar": "يُدعى بحرارة جميع الطلاب وأولياء الأمور والخريجين والمتمنين للخير.", "bn": "সকল শিক্ষার্থী, অভিভাবক, প্রাক্তন ছাত্রছাত্রী এবং শুভানুধ্যায়ীদের আন্তরিকভাবে আমন্ত্রণ জানানো হচ্ছে।", "en": "All students, parents, alumni and well-wishers are warmly invited."}', '{"ar": "دخول مجاني", "bn": "বিনামূল্যে প্রবেশ", "en": "Free Entry"}', '{"ar": "احضر", "bn": "অংশগ্রহণ করুন", "en": "Attend"}', '#', '{"ar": "إدارة المدرسة", "bn": "মাদ্রাসা প্রশাসন", "en": "Madrasah Administration"}', 'site/events/organizer.jpg', '{"ar": "اللجنة المنظمة لليوم السنوي لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা বার্ষিক দিবসের আয়োজক কমিটি।", "en": "The organizing committee of Sitakund Kamil M.A Madrasah Annual Day."}', 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Dumping structure for table school_management.event_page_settings
CREATE TABLE IF NOT EXISTS `event_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.event_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `event_page_settings` DISABLE KEYS */;
INSERT INTO `event_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}', '{"ar": "فعالياتنا القادمة", "bn": "আমাদের আসন্ন অনুষ্ঠানসমূহ", "en": "Our Upcoming Events"}', '{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}', '{"ar": "ابق على اطلاع بالفعاليات والبرامج والأنشطة القادمة في مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার আসন্ন অনুষ্ঠান, প্রোগ্রাম ও কার্যক্রম সম্পর্কে অবহিত থাকুন।", "en": "Stay informed about upcoming events, programs, and activities at Sitakund Kamil M.A Madrasah."}', '{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}', 'site/event-breadcrumb.jpg', '{"ar": "الفعاليات - مدرسة الكامل الماجستير بسيتاكُند", "bn": "অনুষ্ঠান - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Events - Sitakund Kamil M.A Madrasah"}', '{"ar": "اكتشف الفعاليات والبرامج القادمة في مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার আসন্ন অনুষ্ঠান ও প্রোগ্রাম আবিষ্কার করুন।", "en": "Discover upcoming events and programs at Sitakund Kamil M.A Madrasah."}', '{"ar": "فعاليات، برامج، مدرسة سيتاكُند", "bn": "অনুষ্ঠান, প্রোগ্রাম, সীতাকুণ্ড মাদ্রাসা", "en": "events, programs, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `event_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.exams
CREATE TABLE IF NOT EXISTS `exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.exams: ~0 rows (approximately)
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;

-- Dumping structure for table school_management.exam_attendances
CREATE TABLE IF NOT EXISTS `exam_attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned NOT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `exam_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `exam_attendances_student_id_exam_id_subject_id_unique` (`student_id`,`exam_id`,`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.exam_attendances: ~0 rows (approximately)
/*!40000 ALTER TABLE `exam_attendances` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_attendances` ENABLE KEYS */;

-- Dumping structure for table school_management.exam_marks
CREATE TABLE IF NOT EXISTS `exam_marks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.exam_marks: ~2 rows (approximately)
/*!40000 ALTER TABLE `exam_marks` DISABLE KEYS */;
INSERT INTO `exam_marks` (`id`, `title`, `created_at`, `updated_at`) VALUES
	(1, 'Written', '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(2, 'MCQ', '2026-08-15 02:36:58', '2026-08-15 02:36:58');
/*!40000 ALTER TABLE `exam_marks` ENABLE KEYS */;

-- Dumping structure for table school_management.exam_remarks
CREATE TABLE IF NOT EXISTS `exam_remarks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.exam_remarks: ~0 rows (approximately)
/*!40000 ALTER TABLE `exam_remarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_remarks` ENABLE KEYS */;

-- Dumping structure for table school_management.exam_student_marks
CREATE TABLE IF NOT EXISTS `exam_student_marks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned NOT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned DEFAULT NULL,
  `exam_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `exam_mark_id` bigint(20) unsigned NOT NULL,
  `marks_obtained` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.exam_student_marks: ~210 rows (approximately)
/*!40000 ALTER TABLE `exam_student_marks` DISABLE KEYS */;
INSERT INTO `exam_student_marks` (`id`, `student_id`, `class_id`, `section_id`, `exam_id`, `subject_id`, `exam_mark_id`, `marks_obtained`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 33.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(2, 1, 1, 1, 1, 1, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(3, 1, 1, 1, 1, 2, 1, 57.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(4, 1, 1, 1, 1, 2, 2, 24.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(5, 1, 1, 1, 1, 3, 1, 45.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(6, 1, 1, 1, 1, 3, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(7, 1, 1, 1, 1, 4, 1, 54.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(8, 1, 1, 1, 1, 4, 2, 14.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(9, 1, 1, 1, 1, 5, 1, 42.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(10, 1, 1, 1, 1, 5, 2, 11.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(11, 4, 1, 1, 1, 1, 1, 62.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(12, 4, 1, 1, 1, 1, 2, 12.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(13, 4, 1, 1, 1, 2, 1, 46.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(14, 4, 1, 1, 1, 2, 2, 20.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(15, 4, 1, 1, 1, 3, 1, 57.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(16, 4, 1, 1, 1, 3, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(17, 4, 1, 1, 1, 4, 1, 60.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(18, 4, 1, 1, 1, 4, 2, 26.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(19, 4, 1, 1, 1, 5, 1, 37.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(20, 4, 1, 1, 1, 5, 2, 26.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(21, 8, 1, 1, 1, 1, 1, 37.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(22, 8, 1, 1, 1, 1, 2, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(23, 8, 1, 1, 1, 2, 1, 36.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(24, 8, 1, 1, 1, 2, 2, 17.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(25, 8, 1, 1, 1, 3, 1, 65.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(26, 8, 1, 1, 1, 3, 2, 16.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(27, 8, 1, 1, 1, 4, 1, 64.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(28, 8, 1, 1, 1, 4, 2, 29.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(29, 8, 1, 1, 1, 5, 1, 59.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(30, 8, 1, 1, 1, 5, 2, 12.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(31, 12, 1, 2, 1, 1, 1, 70.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(32, 12, 1, 2, 1, 1, 2, 27.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(33, 12, 1, 2, 1, 2, 1, 32.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(34, 12, 1, 2, 1, 2, 2, 25.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(35, 12, 1, 2, 1, 3, 1, 50.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(36, 12, 1, 2, 1, 3, 2, 23.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(37, 12, 1, 2, 1, 4, 1, 67.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(38, 12, 1, 2, 1, 4, 2, 14.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(39, 12, 1, 2, 1, 5, 1, 40.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(40, 12, 1, 2, 1, 5, 2, 29.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(41, 18, 1, 2, 1, 1, 1, 68.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(42, 18, 1, 2, 1, 1, 2, 21.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(43, 18, 1, 2, 1, 2, 1, 37.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(44, 18, 1, 2, 1, 2, 2, 23.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(45, 18, 1, 2, 1, 3, 1, 52.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(46, 18, 1, 2, 1, 3, 2, 27.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(47, 18, 1, 2, 1, 4, 1, 39.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(48, 18, 1, 2, 1, 4, 2, 11.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(49, 18, 1, 2, 1, 5, 1, 46.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(50, 18, 1, 2, 1, 5, 2, 27.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(51, 2, 3, 5, 3, 11, 1, 35.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(52, 2, 3, 5, 3, 11, 2, 29.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(53, 2, 3, 5, 3, 12, 1, 55.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(54, 2, 3, 5, 3, 12, 2, 19.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(55, 2, 3, 5, 3, 13, 1, 47.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(56, 2, 3, 5, 3, 13, 2, 16.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(57, 2, 3, 5, 3, 14, 1, 44.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(58, 2, 3, 5, 3, 14, 2, 12.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(59, 2, 3, 5, 3, 15, 1, 42.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(60, 2, 3, 5, 3, 15, 2, 20.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(61, 9, 3, 6, 3, 11, 1, 43.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(62, 9, 3, 6, 3, 11, 2, 22.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(63, 9, 3, 6, 3, 12, 1, 33.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(64, 9, 3, 6, 3, 12, 2, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(65, 9, 3, 6, 3, 13, 1, 39.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(66, 9, 3, 6, 3, 13, 2, 21.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(67, 9, 3, 6, 3, 14, 1, 35.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(68, 9, 3, 6, 3, 14, 2, 27.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(69, 9, 3, 6, 3, 15, 1, 35.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(70, 9, 3, 6, 3, 15, 2, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(71, 13, 3, 5, 3, 11, 1, 60.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(72, 13, 3, 5, 3, 11, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(73, 13, 3, 5, 3, 12, 1, 52.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(74, 13, 3, 5, 3, 12, 2, 16.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(75, 13, 3, 5, 3, 13, 1, 42.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(76, 13, 3, 5, 3, 13, 2, 15.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(77, 13, 3, 5, 3, 14, 1, 57.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(78, 13, 3, 5, 3, 14, 2, 29.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(79, 13, 3, 5, 3, 15, 1, 64.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(80, 13, 3, 5, 3, 15, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(81, 21, 3, 5, 3, 11, 1, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(82, 21, 3, 5, 3, 11, 2, 21.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(83, 21, 3, 5, 3, 12, 1, 44.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(84, 21, 3, 5, 3, 12, 2, 22.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(85, 21, 3, 5, 3, 13, 1, 51.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(86, 21, 3, 5, 3, 13, 2, 15.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(87, 21, 3, 5, 3, 14, 1, 34.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(88, 21, 3, 5, 3, 14, 2, 26.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(89, 21, 3, 5, 3, 15, 1, 60.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(90, 21, 3, 5, 3, 15, 2, 28.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(91, 3, 5, 9, 5, 21, 1, 54.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(92, 3, 5, 9, 5, 21, 2, 18.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(93, 3, 5, 9, 5, 22, 1, 57.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(94, 3, 5, 9, 5, 22, 2, 17.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(95, 3, 5, 9, 5, 23, 1, 70.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(96, 3, 5, 9, 5, 23, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(97, 3, 5, 9, 5, 24, 1, 32.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(98, 3, 5, 9, 5, 24, 2, 13.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(99, 3, 5, 9, 5, 25, 1, 54.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(100, 3, 5, 9, 5, 25, 2, 23.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(101, 5, 5, 10, 5, 21, 1, 36.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(102, 5, 5, 10, 5, 21, 2, 12.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(103, 5, 5, 10, 5, 22, 1, 53.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(104, 5, 5, 10, 5, 22, 2, 13.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(105, 5, 5, 10, 5, 23, 1, 63.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(106, 5, 5, 10, 5, 23, 2, 21.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(107, 5, 5, 10, 5, 24, 1, 41.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(108, 5, 5, 10, 5, 24, 2, 13.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(109, 5, 5, 10, 5, 25, 1, 57.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(110, 5, 5, 10, 5, 25, 2, 23.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(111, 15, 5, 10, 5, 21, 1, 52.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(112, 15, 5, 10, 5, 21, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(113, 15, 5, 10, 5, 22, 1, 56.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(114, 15, 5, 10, 5, 22, 2, 21.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(115, 15, 5, 10, 5, 23, 1, 52.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(116, 15, 5, 10, 5, 23, 2, 17.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(117, 15, 5, 10, 5, 24, 1, 61.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(118, 15, 5, 10, 5, 24, 2, 29.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(119, 15, 5, 10, 5, 25, 1, 64.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(120, 15, 5, 10, 5, 25, 2, 13.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(121, 6, 4, 7, 7, 16, 1, 54.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(122, 6, 4, 7, 7, 16, 2, 12.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(123, 6, 4, 7, 7, 17, 1, 31.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(124, 6, 4, 7, 7, 17, 2, 27.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(125, 6, 4, 7, 7, 18, 1, 55.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(126, 6, 4, 7, 7, 18, 2, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(127, 6, 4, 7, 7, 19, 1, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(128, 6, 4, 7, 7, 19, 2, 13.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(129, 6, 4, 7, 7, 20, 1, 52.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(130, 6, 4, 7, 7, 20, 2, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(131, 7, 4, 8, 7, 16, 1, 51.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(132, 7, 4, 8, 7, 16, 2, 12.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(133, 7, 4, 8, 7, 17, 1, 63.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(134, 7, 4, 8, 7, 17, 2, 16.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(135, 7, 4, 8, 7, 18, 1, 55.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(136, 7, 4, 8, 7, 18, 2, 13.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(137, 7, 4, 8, 7, 19, 1, 65.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(138, 7, 4, 8, 7, 19, 2, 19.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(139, 7, 4, 8, 7, 20, 1, 68.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(140, 7, 4, 8, 7, 20, 2, 15.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(141, 11, 4, 8, 7, 16, 1, 61.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(142, 11, 4, 8, 7, 16, 2, 15.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(143, 11, 4, 8, 7, 17, 1, 70.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(144, 11, 4, 8, 7, 17, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(145, 11, 4, 8, 7, 18, 1, 49.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(146, 11, 4, 8, 7, 18, 2, 12.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(147, 11, 4, 8, 7, 19, 1, 47.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(148, 11, 4, 8, 7, 19, 2, 24.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(149, 11, 4, 8, 7, 20, 1, 67.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(150, 11, 4, 8, 7, 20, 2, 17.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(151, 16, 4, 8, 7, 16, 1, 60.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(152, 16, 4, 8, 7, 16, 2, 24.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(153, 16, 4, 8, 7, 17, 1, 48.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(154, 16, 4, 8, 7, 17, 2, 15.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(155, 16, 4, 8, 7, 18, 1, 61.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(156, 16, 4, 8, 7, 18, 2, 23.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(157, 16, 4, 8, 7, 19, 1, 39.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(158, 16, 4, 8, 7, 19, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(159, 16, 4, 8, 7, 20, 1, 46.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(160, 16, 4, 8, 7, 20, 2, 24.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(161, 17, 4, 8, 7, 16, 1, 56.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(162, 17, 4, 8, 7, 16, 2, 24.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(163, 17, 4, 8, 7, 17, 1, 48.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(164, 17, 4, 8, 7, 17, 2, 19.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(165, 17, 4, 8, 7, 18, 1, 61.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(166, 17, 4, 8, 7, 18, 2, 26.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(167, 17, 4, 8, 7, 19, 1, 53.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(168, 17, 4, 8, 7, 19, 2, 29.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(169, 17, 4, 8, 7, 20, 1, 61.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(170, 17, 4, 8, 7, 20, 2, 16.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(171, 19, 4, 7, 7, 16, 1, 36.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(172, 19, 4, 7, 7, 16, 2, 15.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(173, 19, 4, 7, 7, 17, 1, 46.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(174, 19, 4, 7, 7, 17, 2, 29.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(175, 19, 4, 7, 7, 18, 1, 70.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(176, 19, 4, 7, 7, 18, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(177, 19, 4, 7, 7, 19, 1, 52.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(178, 19, 4, 7, 7, 19, 2, 18.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(179, 19, 4, 7, 7, 20, 1, 36.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(180, 19, 4, 7, 7, 20, 2, 23.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(181, 10, 2, 3, 9, 6, 1, 55.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(182, 10, 2, 3, 9, 6, 2, 11.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(183, 10, 2, 3, 9, 7, 1, 52.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(184, 10, 2, 3, 9, 7, 2, 18.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(185, 10, 2, 3, 9, 8, 1, 51.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(186, 10, 2, 3, 9, 8, 2, 16.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(187, 10, 2, 3, 9, 9, 1, 57.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(188, 10, 2, 3, 9, 9, 2, 15.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(189, 10, 2, 3, 9, 10, 1, 56.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(190, 10, 2, 3, 9, 10, 2, 17.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(191, 14, 2, 3, 9, 6, 1, 56.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(192, 14, 2, 3, 9, 6, 2, 27.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(193, 14, 2, 3, 9, 7, 1, 50.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(194, 14, 2, 3, 9, 7, 2, 30.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(195, 14, 2, 3, 9, 8, 1, 48.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(196, 14, 2, 3, 9, 8, 2, 11.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(197, 14, 2, 3, 9, 9, 1, 61.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(198, 14, 2, 3, 9, 9, 2, 17.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(199, 14, 2, 3, 9, 10, 1, 32.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(200, 14, 2, 3, 9, 10, 2, 16.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(201, 20, 2, 3, 9, 6, 1, 49.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(202, 20, 2, 3, 9, 6, 2, 10.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(203, 20, 2, 3, 9, 7, 1, 54.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(204, 20, 2, 3, 9, 7, 2, 27.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(205, 20, 2, 3, 9, 8, 1, 65.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(206, 20, 2, 3, 9, 8, 2, 11.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(207, 20, 2, 3, 9, 9, 1, 59.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(208, 20, 2, 3, 9, 9, 2, 11.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(209, 20, 2, 3, 9, 10, 1, 64.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58'),
	(210, 20, 2, 3, 9, 10, 2, 11.00, '2026-08-15 02:36:58', '2026-08-15 02:36:58');
/*!40000 ALTER TABLE `exam_student_marks` ENABLE KEYS */;

-- Dumping structure for table school_management.facilities
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `short_description` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` json DEFAULT NULL,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `facilities_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.facilities: ~6 rows (approximately)
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` (`id`, `slug`, `title`, `short_description`, `image`, `description`, `gallery_image_1`, `gallery_image_2`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'library-facility', '{"ar": "مرفق المكتبة", "bn": "গ্রন্থাগার সুবিধা", "en": "Library Facility"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 'site/facilities/library-facility.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المرفق دورًا مهمًا للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই সুবিধাটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>"}', 'site/facilities-gallery-1.jpg', 'site/facilities-gallery-2.jpg', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'hall-facility', '{"ar": "مرفق القاعة", "bn": "হল সুবিধা", "en": "Hall Facility"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 'site/facilities/hall-facility.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المرفق دورًا مهمًا للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই সুবিধাটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>"}', 'site/facilities-gallery-1.jpg', 'site/facilities-gallery-2.jpg', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'canteen-food-facility', '{"ar": "مرفق مقصف الطعام", "bn": "ক্যান্টিন খাদ্য সুবিধা", "en": "Canteen Food Facility"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 'site/facilities/canteen-food-facility.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المرفق دورًا مهمًا للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই সুবিধাটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>"}', 'site/facilities-gallery-1.jpg', 'site/facilities-gallery-2.jpg', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, 'transport-facility', '{"ar": "مرفق النقل", "bn": "পরিবহন সুবিধা", "en": "Transport Facility"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 'site/facilities/transport-facility.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المرفق دورًا مهمًا للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই সুবিধাটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>"}', 'site/facilities-gallery-1.jpg', 'site/facilities-gallery-2.jpg', 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(5, 'lab-facility', '{"ar": "مرفق المختبر", "bn": "ল্যাব সুবিধা", "en": "Lab Facility"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 'site/facilities/lab-facility.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المرفق دورًا مهمًا للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই সুবিধাটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>"}', 'site/facilities-gallery-1.jpg', 'site/facilities-gallery-2.jpg', 1, 5, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(6, 'sports-facility', '{"ar": "المرفق الرياضي", "bn": "ক্রীড়া সুবিধা", "en": "Sports Facility"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 'site/facilities/sports-facility.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المرفق دورًا مهمًا للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই সুবিধাটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>"}', 'site/facilities-gallery-1.jpg', 'site/facilities-gallery-2.jpg', 1, 6, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;

-- Dumping structure for table school_management.facility_page_settings
CREATE TABLE IF NOT EXISTS `facility_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.facility_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `facility_page_settings` DISABLE KEYS */;
INSERT INTO `facility_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "مرافقنا", "bn": "আমাদের সুযোগ-সুবিধা", "en": "Our Facilities"}', '{"ar": "تحقق من مرافقنا", "bn": "আমাদের সুযোগ-সুবিধা দেখুন", "en": "Let\'s Check Our Facilities"}', '{"ar": "المرافق", "bn": "সুযোগ-সুবিধা", "en": "Facilities"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "مرافقنا", "bn": "আমাদের সুযোগ-সুবিধা", "en": "Our Facilities"}', 'site/facilities-breadcrumb.jpg', '{"ar": "مرافقنا", "bn": "আমাদের সুযোগ-সুবিধা", "en": "Our Facilities"}', '{"ar": "تصفح مرافق الحرم الجامعي المتاحة في مدرستنا.", "bn": "আমাদের স্কুলের ক্যাম্পাস সুযোগ-সুবিধা ব্রাউজ করুন।", "en": "Browse the campus facilities available at our school."}', '{"ar": "مرافق، حرم جامعي، مرافق مدرسية", "bn": "সুযোগ-সুবিধা, ক্যাম্পাস, স্কুল সুবিধা", "en": "facilities, campus, school facilities"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `facility_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table school_management.faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question` json NOT NULL,
  `answer` json NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.faqs: ~4 rows (approximately)
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` (`id`, `question`, `answer`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "متى تأسست مدرسة الكامل الماجستير بسيتاكُند؟", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা কখন প্রতিষ্ঠিত হয়েছিল?", "en": "When was Sitakund Kamil M.A Madrasah founded?"}', '{"ar": "تأسست المؤسسة عام 1886 على يد العالم الإسلامي الجليل مولانا عبيد الحق (رحمه الله)، مما يجعلها واحدة من أقدم المدارس في تشيتاغونغ.", "bn": "প্রতিষ্ঠানটি ১৮৮৬ সালে দূরদৃষ্টিসম্পন্ন ইসলামী পণ্ডিত মাওলানা ওবায়দুল হক (রহ.) কর্তৃক প্রতিষ্ঠিত হয়েছিল, যা এটিকে চট্টগ্রামের প্রাচীনতম মাদ্রাসাগুলির মধ্যে একটি করে তোলে।", "en": "The institution was founded in 1886 by the visionary Islamic scholar Maulana Obaidul Haq (R.), making it one of the oldest Madrasahs in Chattogram."}', 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, '{"ar": "ما البرامج المتاحة؟", "bn": "কোন প্রোগ্রামগুলো অফার করা হয়?", "en": "What programs are offered?"}', '{"ar": "نقدم برامج الداخل (مكافئ SSC) والعالم (مكافئ HSC) والفاضل (مكافئ البكالوريوس) والكامل الماجستير (مكافئ الماجستير)، فضلاً عن برنامج حفظ القرآن المتخصص المؤسَّس عام 1976.", "bn": "আমরা দাখিল (এসএসসি সমতুল্য), আলিম (এইচএসসি সমতুল্য), ফাজিল (বিএ সমতুল্য) এবং কামিল এম.এ (এমএ সমতুল্য) প্রোগ্রাম অফার করি, পাশাপাশি ১৯৭৬ সালে প্রতিষ্ঠিত একটি নিবেদিত হাফেজিয়া (কুরআন হিফজ) প্রোগ্রামও রয়েছে।", "en": "We offer Dakhil (SSC equivalent), Alim (HSC equivalent), Fazil (BA equivalent), and Kamil M.A (MA equivalent) programs, as well as a dedicated Hafeziya (Quran memorization) program established in 1976."}', 1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, '{"ar": "أين تقع المدرسة؟", "bn": "মাদ্রাসাটি কোথায় অবস্থিত?", "en": "Where is the Madrasah located?"}', '{"ar": "نقع على طريق داكا-تشيتاغونغ الرئيسي، سيتاكُند - 4310، تشيتاغونغ، بنغلاديش. الحرم الجامعي بجانب بركة لالديغي التاريخية في مدينة سيتاكُند.", "bn": "আমরা ঢাকা-চট্টগ্রাম ট্রাংক রোড, সীতাকুণ্ড - ৪৩১০, চট্টগ্রাম, বাংলাদেশে অবস্থিত। ক্যাম্পাসটি সীতাকুণ্ড শহরের ঐতিহাসিক লালদিঘীর পাশে।", "en": "We are located on the Dhaka-Chattogram Trunk Road, Sitakund - 4310, Chattogram, Bangladesh. The campus is beside the historic Laldigi pond in Sitakund town."}', 1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(4, '{"ar": "هل توجد مرافق للسكن؟", "bn": "কি হোস্টেল সুবিধা আছে?", "en": "Is there a hostel facility?"}', '{"ar": "نعم، لدينا مهجع داخل الحرم الجامعي للطلاب القادمين من مناطق بعيدة. تأسس المهجع رسمياً في 13 فبراير 1948، ثم طُوّر لاحقاً إلى مبنى من طابقين في عهد المدير مولانا محمد الحق.", "bn": "হ্যাঁ, দূরদূরান্তের শিক্ষার্থীদের জন্য আমাদের ক্যাম্পাসে একটি হোস্টেল রয়েছে। হোস্টেলটি আনুষ্ঠানিকভাবে ১৩ ফেব্রুয়ারি ১৯৪৮ সালে প্রতিষ্ঠিত হয়েছিল এবং পরে অধ্যক্ষ মাওলানা মুহম্মদুল হকের অধীনে দ্বিতল ভবনে উন্নীত হয়।", "en": "Yes, we have an on-campus hostel for students from distant areas. The hostel was formally established on 13 February 1948 and was later upgraded to a two-storey building under Principal Maulana Muhammdul Haq."}', 1, 4, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(5, '{"ar": "متى حصلت المدرسة على الاعتراف الحكومي؟", "bn": "মাদ্রাসাটি কখন সরকারি স্বীকৃতি পেয়েছিল?", "en": "When did the Madrasah receive government recognition?"}', '{"ar": "حصلت مدرسة الكامل الماجستير بسيتاكُند على الاعتراف الحكومي الدائم عام 1967. وحصلت على موافقة مستوى الكامل الماجستير عام 1986 — بعد مئة عام بالضبط من تأسيسها.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা ১৯৬৭ সালে স্থায়ী সরকারি স্বীকৃতি পেয়েছে। এটি ১৯৮৬ সালে — প্রতিষ্ঠার ঠিক ১০০ বছর পর — কামিল এম.এ স্তরের অনুমোদন পেয়েছে।", "en": "Sitakund Kamil M.A Madrasah received permanent government recognition in 1967. It received Kamil M.A level approval in 1986 — exactly 100 years after its establishment."}', 1, 5, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;

-- Dumping structure for table school_management.faq_page_settings
CREATE TABLE IF NOT EXISTS `faq_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `cta_button_text` json DEFAULT NULL,
  `cta_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.faq_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `faq_page_settings` DISABLE KEYS */;
INSERT INTO `faq_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `cta_button_text`, `cta_button_url`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "الأسئلة الشائعة", "bn": "সাধারণ প্রশ্ন", "en": "FAQ"}', '{"ar": "الأسئلة المتكررة", "bn": "প্রায়শই জিজ্ঞাসিত প্রশ্নসমূহ", "en": "Frequently Asked Questions"}', '{"ar": "الأسئلة", "bn": "প্রশ্নসমূহ", "en": "Questions"}', '{"ar": "ابحث عن إجابات للأسئلة الشائعة حول مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা সম্পর্কে সাধারণ প্রশ্নের উত্তর খুঁজুন।", "en": "Find answers to common questions about Sitakund Kamil M.A Madrasah."}', '{"ar": "تواصل معنا", "bn": "আমাদের সাথে যোগাযোগ করুন", "en": "Contact Us"}', '/contact', '{"ar": "الأسئلة الشائعة", "bn": "সাধারণ প্রশ্ন", "en": "FAQ"}', 'site/faq-breadcrumb.jpg', '{"ar": "الأسئلة الشائعة - مدرسة الكامل الماجستير بسيتاكُند", "bn": "সাধারণ প্রশ্ন - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "FAQ - Sitakund Kamil M.A Madrasah"}', '{"ar": "ابحث عن إجابات للأسئلة الشائعة حول مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা সম্পর্কে সাধারণ প্রশ্নের উত্তর খুঁজুন।", "en": "Find answers to common questions about Sitakund Kamil M.A Madrasah."}', '{"ar": "الأسئلة الشائعة، مدرسة سيتاكُند", "bn": "সাধারণ প্রশ্ন, সীতাকুণ্ড মাদ্রাসা", "en": "faq, questions, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `faq_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.founders
CREATE TABLE IF NOT EXISTS `founders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `designation` json DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.founders: ~4 rows (approximately)
/*!40000 ALTER TABLE `founders` DISABLE KEYS */;
INSERT INTO `founders` (`id`, `name`, `designation`, `year`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "مولانا عبيد الحق (رحمه الله)", "bn": "মাওলানা ওবায়দুল হক (রহ.)", "en": "Maulana Obaidul Haq (R.)"}', '{"ar": "المؤسس والمشرف الأول", "bn": "প্রতিষ্ঠাতা ও প্রথম সুপার", "en": "Founder & First Superintendent"}', '1886', 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, '{"ar": "مولانا جمال الله (رحمه الله)", "bn": "মাওলানা জামাল উল্লাহ (রহ.)", "en": "Maulana Jamal Ullah (R.)"}', '{"ar": "المشرف الثاني (1921–1950)", "bn": "দ্বিতীয় সুপার (১৯২১–১৯৫০)", "en": "2nd Superintendent (1921–1950)"}', '1921', 1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, '{"ar": "مولانا محمد الحق (رحمه الله)", "bn": "মাওলানা মুহম্মদুল হক (রহ.)", "en": "Maulana Muhammdul Haq (R.)"}', '{"ar": "المدير الثالث والمدير العام (1950–1988)", "bn": "তৃতীয় অধ্যক্ষ ও রেক্টর (১৯৫০–১৯৮৮)", "en": "3rd Principal & Rector (1950–1988)"}', '1950', 1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `founders` ENABLE KEYS */;

-- Dumping structure for table school_management.founder_donor_page_settings
CREATE TABLE IF NOT EXISTS `founder_donor_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `founders_table_title` json DEFAULT NULL,
  `donors_table_title` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.founder_donor_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `founder_donor_page_settings` DISABLE KEYS */;
INSERT INTO `founder_donor_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `founders_table_title`, `donors_table_title`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "المؤسسون والمتبرعون", "bn": "প্রতিষ্ঠাতা ও দাতা", "en": "Founders & Donors"}', '{"ar": "من بنوا إرثنا", "bn": "যারা আমাদের উত্তরাধিকার গড়েছেন", "en": "Those Who Built Our Legacy"}', '{"ar": "الإرث", "bn": "উত্তরাধিকার", "en": "Legacy"}', '{"ar": "تكريم المؤسسين والمتبرعين الكرماء الذين جعلوا مدرسة الكامل الماجستير بسيتاكُند ممكنة.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসাকে সম্ভব করে তোলা প্রতিষ্ঠাতা ও উদার দাতাদের সম্মান জানানো।", "en": "Honoring the founders and generous donors who made Sitakund Kamil M.A Madrasah possible."}', '{"ar": "المؤسسون", "bn": "প্রতিষ্ঠাতাগণ", "en": "Founders"}', '{"ar": "المتبرعون والمساهمون", "bn": "দাতা ও অবদানকারীগণ", "en": "Donors & Contributors"}', '{"ar": "المؤسسون والمتبرعون", "bn": "প্রতিষ্ঠাতা ও দাতা", "en": "Founders & Donors"}', 'site/founders-breadcrumb.jpg', '{"ar": "المؤسسون والمتبرعون - مدرسة الكامل الماجستير بسيتاكُند", "bn": "প্রতিষ্ঠাতা ও দাতা - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Founders & Donors - Sitakund Kamil M.A Madrasah"}', '{"ar": "تعرف على مؤسسي ومتبرعي مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার প্রতিষ্ঠাতা ও দাতাদের সম্পর্কে জানুন।", "en": "Learn about the founders and donors of Sitakund Kamil M.A Madrasah."}', '{"ar": "مؤسسون، متبرعون، مدرسة سيتاكُند", "bn": "প্রতিষ্ঠাতা, দাতা, সীতাকুণ্ড মাদ্রাসা", "en": "founders, donors, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `founder_donor_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.gallery_images
CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.gallery_images: ~6 rows (approximately)
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
INSERT INTO `gallery_images` (`id`, `image`, `caption`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'site/gallery/01.jpg', '{"ar": "الحياة الجامعية 1", "bn": "ক্যাম্পাস জীবন 1", "en": "Campus Life 1"}', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'site/gallery/02.jpg', '{"ar": "الحياة الجامعية 2", "bn": "ক্যাম্পাস জীবন 2", "en": "Campus Life 2"}', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'site/gallery/03.jpg', '{"ar": "الحياة الجامعية 3", "bn": "ক্যাম্পাস জীবন 3", "en": "Campus Life 3"}', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, 'site/gallery/04.jpg', '{"ar": "الحياة الجامعية 4", "bn": "ক্যাম্পাস জীবন 4", "en": "Campus Life 4"}', 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(5, 'site/gallery/05.jpg', '{"ar": "الحياة الجامعية 5", "bn": "ক্যাম্পাস জীবন 5", "en": "Campus Life 5"}', 1, 5, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(6, 'site/gallery/06.jpg', '{"ar": "الحياة الجامعية 6", "bn": "ক্যাম্পাস জীবন 6", "en": "Campus Life 6"}', 1, 6, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;

-- Dumping structure for table school_management.gallery_page_settings
CREATE TABLE IF NOT EXISTS `gallery_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.gallery_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `gallery_page_settings` DISABLE KEYS */;
INSERT INTO `gallery_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "معرض الصور", "bn": "গ্যালারি", "en": "Gallery"}', '{"ar": "معرض صورنا", "bn": "আমাদের ফটো গ্যালারি", "en": "Our Photo Gallery"}', '{"ar": "المعرض", "bn": "গ্যালারি", "en": "Gallery"}', '{"ar": "تصفح صور الحياة الجامعية والفعاليات والأنشطة في مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার ক্যাম্পাস জীবন, অনুষ্ঠান ও কার্যক্রমের ছবি ব্রাউজ করুন।", "en": "Browse photos from campus life, events, and activities at Sitakund Kamil M.A Madrasah."}', '{"ar": "المعرض", "bn": "গ্যালারি", "en": "Gallery"}', 'site/gallery-breadcrumb.jpg', '{"ar": "المعرض - مدرسة الكامل الماجستير بسيتاكُند", "bn": "গ্যালারি - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Gallery - Sitakund Kamil M.A Madrasah"}', '{"ar": "تصفح صور من حرم مدرسة الكامل الماجستير بسيتاكُند والفعاليات والأنشطة.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার ক্যাম্পাস, অনুষ্ঠান ও কার্যক্রমের ছবি ব্রাউজ করুন।", "en": "Browse photos from Sitakund Kamil M.A Madrasah campus, events, and activities."}', '{"ar": "معرض، صور، مدرسة سيتاكُند", "bn": "গ্যালারি, ছবি, সীতাকুণ্ড মাদ্রাসা", "en": "gallery, photos, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `gallery_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.global_exams
CREATE TABLE IF NOT EXISTS `global_exams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.global_exams: ~4 rows (approximately)
/*!40000 ALTER TABLE `global_exams` DISABLE KEYS */;
INSERT INTO `global_exams` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, '1st Term', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(2, '2nd Term', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(3, 'Half Yearly Exam', '2026-08-15 02:36:57', '2026-08-15 02:36:57'),
	(4, 'Annual Exam', '2026-08-15 02:36:57', '2026-08-15 02:36:57');
/*!40000 ALTER TABLE `global_exams` ENABLE KEYS */;

-- Dumping structure for table school_management.global_exam_codes
CREATE TABLE IF NOT EXISTS `global_exam_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_marks` decimal(8,2) NOT NULL DEFAULT '100.00',
  `pass_marks` decimal(8,2) NOT NULL DEFAULT '0.00',
  `acceptance` decimal(8,2) NOT NULL DEFAULT '1.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.global_exam_codes: ~6 rows (approximately)
/*!40000 ALTER TABLE `global_exam_codes` DISABLE KEYS */;
INSERT INTO `global_exam_codes` (`id`, `title`, `total_marks`, `pass_marks`, `acceptance`, `created_at`, `updated_at`) VALUES
	(1, 'SC-1', 100.00, 0.00, 1.00, '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(2, 'SC-2', 100.00, 0.00, 1.00, '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(3, 'SC-3', 100.00, 0.00, 1.00, '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(4, 'SC-4', 100.00, 0.00, 1.00, '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(5, 'SC-5', 100.00, 0.00, 1.00, '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(6, 'SC-6', 100.00, 0.00, 1.00, '2026-08-10 15:07:54', '2026-08-10 15:07:54');
/*!40000 ALTER TABLE `global_exam_codes` ENABLE KEYS */;

-- Dumping structure for table school_management.global_exam_grades
CREATE TABLE IF NOT EXISTS `global_exam_grades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade_range` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.global_exam_grades: ~7 rows (approximately)
/*!40000 ALTER TABLE `global_exam_grades` DISABLE KEYS */;
INSERT INTO `global_exam_grades` (`id`, `grade`, `grade_range`, `created_at`, `updated_at`) VALUES
	(1, 'A+', '80-100', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(2, 'A', '70-79', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(3, 'A-', '60-69', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(4, 'B', '50-59', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(5, 'C', '40-49', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(6, 'D', '33-39', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(7, 'F', '00-32', '2026-08-10 15:07:54', '2026-08-10 15:07:54'),
	(8, 'F', '0-32', '2026-08-15 02:36:58', '2026-08-15 02:36:58');
/*!40000 ALTER TABLE `global_exam_grades` ENABLE KEYS */;

-- Dumping structure for table school_management.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Dumping structure for table school_management.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.job_batches: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;

-- Dumping structure for table school_management.languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `native_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` enum('ltr','rtl') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.languages: ~0 rows (approximately)
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` (`id`, `code`, `name`, `native_name`, `direction`, `is_default`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'en', 'English', 'English', 'ltr', 1, 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, 'bn', 'Bangla', 'বাংলা', 'ltr', 0, 1, 2, '2026-07-24 17:15:11', '2026-07-24 17:15:11'),
	(3, 'ar', 'Arabic', 'العربية', 'rtl', 0, 1, 3, '2026-07-25 15:43:42', '2026-07-25 15:43:42');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;

-- Dumping structure for table school_management.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.menus: ~0 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Main Menu', 'header', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table school_management.menu_items
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
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  KEY `menu_items_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.menu_items: ~58 rows (approximately)
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `type`, `label`, `url`, `route_name`, `linkable_type`, `linkable_id`, `target`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 'custom', '{"ar": "????????", "bn": "???", "en": "Home"}', '/', NULL, NULL, NULL, '_self', 0, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(2, 1, NULL, 'custom', '{"ar": "حول", "bn": "সম্পর্কে", "en": "About"}', '#', NULL, NULL, NULL, '_self', 1, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(3, 1, 2, 'custom', '{"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}', 'about', NULL, NULL, NULL, '_self', 0, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(4, 1, 2, 'custom', '{"ar": "التاريخ", "bn": "ইতিহাস", "en": "History"}', 'history', NULL, NULL, NULL, '_self', 1, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(5, 1, 2, 'custom', '{"ar": "قائمة المؤسسين والمتبرعين", "bn": "প্রতিষ্ঠাতা ও দাতা তালিকা", "en": "Founder & Doner List"}', 'founders-donors', NULL, NULL, NULL, '_self', 2, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(6, 1, 2, 'custom', '{"ar": "رؤيتنا", "bn": "আমাদের লক্ষ্য", "en": "Our Vision"}', 'mission-vision', NULL, NULL, NULL, '_self', 3, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(7, 1, 2, 'custom', '{"ar": "جولة الحرم الجامعي", "bn": "ক্যাম্পাস ভ্রমণ", "en": "Campus Tour"}', 'campus-tour', NULL, NULL, NULL, '_self', 4, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(9, 1, 2, 'custom', '{"ar": "الرئيس الموقر", "bn": "সম্মানিত চেয়ারম্যান", "en": "Honorable Chairman"}', 'chairman-speech.html', NULL, NULL, NULL, '_self', 5, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(12, 1, 2, 'custom', '{"ar": "مديرنا", "bn": "আমাদের অধ্যক্ষ", "en": "Our Principal"}', 'principal', NULL, NULL, NULL, '_self', 6, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(13, 1, 2, 'custom', '{"ar": "مديرنا السابق", "bn": "আমাদের সাবেক অধ্যক্ষ", "en": "Our EX Principal"}', 'ex-principals', NULL, NULL, NULL, '_self', 7, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(20, 1, NULL, 'custom', '{"ar": "أكاديمي", "bn": "একাডেমিক", "en": "Academic"}', '#', NULL, NULL, NULL, '_self', 2, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(22, 1, 20, 'custom', '{"ar": "معلمونا", "bn": "আমাদের শিক্ষকবৃন্দ", "en": "Our Teachers"}', 'teachers', NULL, NULL, NULL, '_self', 0, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(26, 1, 20, 'custom', '{"ar": "القواعد الأكاديمية", "bn": "একাডেমিক নিয়মাবলী", "en": "Academic Rules"}', 'academic-rules.html', NULL, NULL, NULL, '_self', 1, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(27, 1, 20, 'custom', '{"ar": "التقويم الأكاديمي", "bn": "একাডেমিক ক্যালেন্ডার", "en": "Academic Calendar"}', 'academic-calendar.html', NULL, NULL, NULL, '_self', 2, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(29, 1, 20, 'custom', '{"ar": "معلومات الإجازة", "bn": "ছুটির তথ্য", "en": "Leave Information"}', '#', NULL, NULL, NULL, '_self', 3, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(30, 1, NULL, 'custom', '{"ar": "القبول", "bn": "ভর্তি", "en": "Admission"}', '#', NULL, NULL, NULL, '_self', 7, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(31, 1, 30, 'custom', '{"ar": "لماذا الدراسة؟", "bn": "কেন পড়বেন?", "en": "Why Study ?"}', 'class-schedule', NULL, NULL, NULL, '_self', 0, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(32, 1, 30, 'custom', '{"ar": "كيفية التقديم", "bn": "কীভাবে আবেদন করবেন", "en": "How to apply"}', 'how-to-apply', NULL, NULL, NULL, '_self', 1, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(33, 1, 30, 'custom', '{"ar": "اختبار القبول", "bn": "ভর্তি পরীক্ষা", "en": "Admission Test"}', 'admission-test.html', NULL, NULL, NULL, '_self', 2, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(34, 1, 30, 'custom', '{"ar": "سياسة القبول", "bn": "ভর্তি নীতি", "en": "Admission Policy"}', 'admission-policy.html', NULL, NULL, NULL, '_self', 3, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(35, 1, 30, 'custom', '{"ar": "نظام التسجيل", "bn": "নিবন্ধন পদ্ধতি", "en": "Registration System"}', 'registration-system.html', NULL, NULL, NULL, '_self', 4, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(36, 1, NULL, 'custom', '{"ar": "الطالب", "bn": "শিক্ষার্থী", "en": "Student"}', '#', NULL, NULL, NULL, '_self', 8, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(37, 1, 36, 'custom', '{"ar": "قائمة الطلاب", "bn": "শিক্ষার্থী তালিকা", "en": "Student List"}', 'students', NULL, NULL, NULL, '_self', 0, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(38, 1, 36, 'custom', '{"ar": "الرسوم الدراسية", "bn": "টিউশন ফি", "en": "Tution Fees"}', 'tuition-fees', NULL, NULL, NULL, '_self', 1, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(39, 1, 36, 'custom', '{"ar": "الخدمات المصرفية عبر الهاتف المحمول", "bn": "মোবাইল ব্যাংকিং", "en": "Mobile Banking"}', 'mobile-banking', NULL, NULL, NULL, '_self', 2, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(40, 1, 36, 'custom', '{"ar": "الأنشطة اليومية", "bn": "দৈনন্দিন কার্যক্রম", "en": "Daily Activities"}', 'daily-activities', NULL, NULL, NULL, '_self', 3, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(41, 1, 36, 'custom', '{"ar": "جدول الامتحانات", "bn": "পরীক্ষার সময়সূচি", "en": "Exam Schedule"}', 'exam-schedule', NULL, NULL, NULL, '_self', 4, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(42, 1, 36, 'custom', '{"ar": "زي الطلاب", "bn": "শিক্ষার্থী ইউনিফর্ম", "en": "Student Uniform"}', 'student-uniform', NULL, NULL, NULL, '_self', 5, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(43, 1, 36, 'custom', '{"ar": "نظام الامتحان", "bn": "পরীক্ষা পদ্ধতি", "en": "Exam System"}', 'exam-system', NULL, NULL, NULL, '_self', 6, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(44, 1, 36, 'custom', '{"ar": "القواعد واللوائح", "bn": "নিয়ম ও প্রবিধান", "en": "Rules and Regulation"}', 'rules-and-regulation', NULL, NULL, NULL, '_self', 7, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(53, 1, NULL, 'custom', '{"ar": "النتيجة", "bn": "ফলাফল", "en": "Result"}', '#', NULL, NULL, NULL, '_self', 9, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(54, 1, 53, 'custom', '{"ar": "نتيجة الامتحان", "bn": "পরীক্ষার ফলাফল", "en": "Exam Result"}', 'results', NULL, NULL, NULL, '_self', 0, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(55, 1, 53, 'custom', '{"ar": "النتيجة الأكاديمية", "bn": "একাডেমিক ফলাফল", "en": "Academic Result"}', 'academic-results', NULL, NULL, NULL, '_self', 1, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(56, 1, 53, 'custom', '{"ar": "نتيجة التقييم", "bn": "মূল্যায়ন ফলাফল", "en": "Evaluation Result"}', 'evaluation-results', NULL, NULL, NULL, '_self', 2, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(57, 1, 53, 'custom', '{"ar": "نتيجة امتحان المجلس", "bn": "বোর্ড পরীক্ষার ফলাফল", "en": "Board Exam Result"}', 'board-exam-results', NULL, NULL, NULL, '_self', 3, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(58, 1, NULL, 'custom', '{"ar": "أخرى", "bn": "অন্যান্য", "en": "Others"}', '#', NULL, NULL, NULL, '_self', 15, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(59, 1, 58, 'custom', '{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}', 'notice.html', NULL, NULL, NULL, '_self', 0, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(60, 1, 58, 'custom', '{"ar": "أخبار", "bn": "সংবাদ", "en": "News"}', 'news.html', NULL, NULL, NULL, '_self', 1, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(61, 1, 58, 'custom', '{"ar": "معرض الصور", "bn": "গ্যালারি", "en": "Gallery"}', 'gallery.html', NULL, NULL, NULL, '_self', 2, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(62, 1, 58, 'custom', '{"ar": "الفعالية", "bn": "অনুষ্ঠান", "en": "Event"}', 'event.html', NULL, NULL, NULL, '_self', 3, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(63, 1, 58, 'custom', '{"ar": "الجدول", "bn": "রুটিন", "en": "Routine"}', 'routine.html', NULL, NULL, NULL, '_self', 4, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(64, 1, 58, 'custom', '{"ar": "تحميل", "bn": "ডাউনলোড", "en": "Download"}', 'download.html', NULL, NULL, NULL, '_self', 5, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(65, 1, NULL, 'custom', '{"ar": "الصفحات", "bn": "পৃষ্ঠাসমূহ", "en": "Pages"}', '#', NULL, NULL, NULL, '_self', 13, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(66, 1, NULL, 'custom', '{"ar": "الدورات", "bn": "কোর্সসমূহ", "en": "Courses"}', 'courses', NULL, NULL, NULL, '_self', 3, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(73, 1, NULL, 'custom', '{"ar": "ملف الأعمال", "bn": "পোর্টফোলিও", "en": "Portfolio"}', 'portfolio', NULL, NULL, NULL, '_self', 6, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(75, 1, NULL, 'custom', '{"ar": "المدونة", "bn": "ব্লগ", "en": "Blog"}', 'blog', NULL, NULL, NULL, '_self', 10, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(77, 1, 65, 'custom', '{"ar": "استمارة الطلب", "bn": "আবেদন ফর্ম", "en": "Application Form"}', 'application-form.html', NULL, NULL, NULL, '_self', 0, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(78, 1, 65, 'custom', '{"ar": "خطة الأسعار", "bn": "মূল্য পরিকল্পনা", "en": "Pricing Plan"}', 'pricing.html', NULL, NULL, NULL, '_self', 1, 0, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(79, 1, NULL, 'custom', '{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}', 'testimonial.html', NULL, NULL, NULL, '_self', 12, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(80, 1, NULL, 'custom', '{"ar": "الأسئلة الشائعة", "bn": "সাধারণ জিজ্ঞাসা", "en": "FAQ\'s"}', 'faq', NULL, NULL, NULL, '_self', 11, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(81, 1, 65, 'custom', '{"ar": "تسجيل الدخول", "bn": "লগইন", "en": "Login"}', 'login.html', NULL, NULL, NULL, '_self', 2, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(82, 1, 65, 'custom', '{"ar": "التسجيل", "bn": "নিবন্ধন করুন", "en": "Register"}', 'register.html', NULL, NULL, NULL, '_self', 3, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(83, 1, 65, 'custom', '{"ar": "شروط الخدمة", "bn": "সেবার শর্তাবলী", "en": "Terms Of Service"}', 'terms.html', NULL, NULL, NULL, '_self', 4, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(84, 1, 65, 'custom', '{"ar": "سياسة الخصوصية", "bn": "গোপনীয়তা নীতি", "en": "Privacy Policy"}', 'privacy.html', NULL, NULL, NULL, '_self', 5, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(85, 1, 65, 'custom', '{"ar": "خطأ 404", "bn": "৪০৪ ত্রুটি", "en": "404 Error"}', '404.html', NULL, NULL, NULL, '_self', 6, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(86, 1, NULL, 'custom', '{"ar": "اتصل بنا", "bn": "যোগাযোগ", "en": "Contact"}', '#', NULL, NULL, NULL, '_self', 14, 1, '2026-07-23 17:50:38', '2026-08-22 04:53:17'),
	(87, 1, NULL, 'custom', '{"ar": "مرافق", "bn": "সুবিধা", "en": "Facilities"}', 'facilities', NULL, NULL, NULL, '_self', 4, 1, '2026-08-16 14:18:07', '2026-08-22 04:53:17'),
	(88, 1, NULL, 'custom', '{"ar": "الأقسام", "bn": "বিভাগ", "en": "Departments"}', 'departments', NULL, NULL, NULL, '_self', 5, 1, '2026-08-16 14:32:20', '2026-08-22 04:53:17');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;

-- Dumping structure for table school_management.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.migrations: ~90 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_07_19_130902_add_two_factor_columns_to_users_table', 1),
	(5, '2026_07_19_130903_create_passkeys_table', 1),
	(6, '2026_07_19_130934_create_personal_access_tokens_table', 1),
	(7, '2026_07_19_164125_create_languages_table', 1),
	(8, '2026_07_19_180723_create_sliders_table', 1),
	(9, '2026_07_20_142403_create_site_settings_table', 1),
	(10, '2026_07_20_145448_add_institute_info_to_site_settings_table', 1),
	(11, '2026_07_20_155458_add_cta_stats_to_site_settings_table', 1),
	(12, '2026_07_20_165507_add_partner_logos_to_site_settings_table', 1),
	(13, '2026_07_20_170705_add_video_section_to_site_settings_table', 1),
	(14, '2026_07_20_171842_add_offer_banner_to_site_settings_table', 1),
	(15, '2026_07_20_173313_add_choose_and_skill_sections_to_site_settings_table', 1),
	(16, '2026_07_21_134759_add_about_section_to_site_settings_table', 1),
	(17, '2026_07_21_142525_create_courses_table', 1),
	(18, '2026_07_21_142526_create_course_page_settings_table', 1),
	(19, '2026_07_21_161834_create_teachers_table', 1),
	(20, '2026_07_21_161835_create_teacher_page_settings_table', 1),
	(21, '2026_07_21_161927_create_gallery_images_table', 1),
	(22, '2026_07_21_161928_create_gallery_page_settings_table', 1),
	(23, '2026_07_21_161929_create_events_table', 1),
	(24, '2026_07_21_161930_create_event_page_settings_table', 1),
	(25, '2026_07_21_161931_create_departments_table', 1),
	(26, '2026_07_21_161932_create_department_page_settings_table', 1),
	(27, '2026_07_22_143201_create_notices_table', 1),
	(28, '2026_07_22_143202_create_notice_page_settings_table', 1),
	(29, '2026_07_22_165851_create_menus_table', 1),
	(30, '2026_07_22_165852_create_menu_items_table', 1),
	(31, '2026_07_23_161339_create_facilities_table', 1),
	(32, '2026_07_23_161340_create_facility_page_settings_table', 1),
	(33, '2026_07_23_162345_create_portfolios_table', 1),
	(34, '2026_07_23_162346_create_portfolio_page_settings_table', 1),
	(35, '2026_07_23_164231_create_blog_posts_table', 1),
	(36, '2026_07_23_164232_create_blog_page_settings_table', 1),
	(37, '2026_07_23_165559_create_testimonials_table', 1),
	(38, '2026_07_23_165600_create_testimonial_page_settings_table', 1),
	(39, '2026_07_23_170703_create_faqs_table', 1),
	(40, '2026_07_23_170704_create_faq_page_settings_table', 1),
	(41, '2026_07_23_194340_create_pages_table', 2),
	(42, '2026_07_24_162510_alter_pages_table_replace_blocks_with_content', 3),
	(43, '2026_07_24_182055_add_about_page_settings_to_site_settings_table', 4),
	(44, '2026_07_24_184601_add_principal_pages_to_site_settings_table', 5),
	(45, '2026_07_25_050045_create_contact_messages_table', 6),
	(46, '2026_07_25_050548_add_contact_page_to_site_settings_table', 6),
	(47, '2026_07_25_052721_add_contact_info_cards_to_site_settings_table', 7),
	(48, '2026_07_25_061941_create_module_settings_table', 8),
	(49, '2026_07_25_070657_create_permission_tables', 9),
	(50, '2026_07_25_082535_add_footer_structure_fields_to_site_settings_table', 10),
	(51, '2026_07_25_172136_create_founders_table', 11),
	(52, '2026_07_25_172137_create_donors_table', 11),
	(53, '2026_07_25_172138_create_founder_donor_page_settings_table', 11),
	(54, '2026_08_05_100000_add_homepage_template_to_site_settings_table', 12),
	(55, '2026_08_05_110000_add_sidebar_fields_to_site_settings_table', 13),
	(56, '2026_08_05_120000_create_class_schedules_table', 14),
	(57, '2026_08_05_120001_create_class_schedule_page_settings_table', 14),
	(58, '2026_08_05_130000_create_vision_mission_page_settings_table', 15),
	(59, '2026_08_05_130001_create_campus_tour_page_settings_table', 15),
	(60, '2026_08_07_130000_add_mission_and_values_to_vision_mission_page_settings_table', 16),
	(61, '2026_08_09_140609_create_students_table', 17),
	(62, '2026_08_09_143039_create_student_migrations_table', 18),
	(63, '2026_08_09_151351_add_hr_fields_to_teachers_table', 19),
	(64, '2026_08_09_151352_create_staffs_table', 19),
	(65, '2026_08_09_160551_change_staffs_columns_to_json', 20),
	(66, '2026_08_09_165138_create_academic_sessions_table', 21),
	(67, '2026_08_09_165139_create_academic_classes_table', 21),
	(68, '2026_08_09_165139_create_shifts_table', 21),
	(69, '2026_08_09_165140_create_academic_groups_table', 21),
	(70, '2026_08_09_165140_create_sections_table', 21),
	(71, '2026_08_09_171206_create_periods_table', 22),
	(72, '2026_08_09_171207_create_subjects_table', 22),
	(73, '2026_08_09_171208_create_optional_subject_configs_table', 22),
	(74, '2026_08_09_171208_create_subject_configs_table', 22),
	(75, '2026_08_09_171209_create_optional_subject_config_subjects_table', 22),
	(76, '2026_08_09_173241_create_student_optional_subjects_table', 23),
	(77, '2026_08_09_173242_create_exams_table', 23),
	(78, '2026_08_09_173242_create_student_categories_table', 23),
	(79, '2026_08_09_173243_create_departments_table', 24),
	(80, '2026_08_09_173243_create_signatures_table', 24),
	(81, '2026_08_10_134106_create_student_attendances_table', 25),
	(82, '2026_08_10_134119_create_exam_attendances_table', 25),
	(83, '2026_08_10_140202_create_assignments_table', 26),
	(84, '2026_08_10_140818_create_syllabi_table', 27),
	(85, '2026_08_10_142539_create_resources_table', 28),
	(86, '2026_08_10_143624_create_class_lessons_table', 29),
	(87, '2026_08_10_144937_create_prayers_table', 30),
	(88, '2026_08_10_145502_create_behaviors_table', 31),
	(89, '2026_08_10_150450_create_global_exam_codes_table', 32),
	(90, '2026_08_10_150451_create_global_exam_grades_table', 32),
	(91, '2026_08_10_150452_create_global_exams_table', 32),
	(92, '2026_08_10_150533_create_class_exam_codes_table', 32),
	(93, '2026_08_10_150534_create_class_exam_grades_table', 32),
	(94, '2026_08_10_150535_create_class_exams_table', 32),
	(95, '2026_08_10_152018_create_exam_remarks_table', 33),
	(96, '2026_08_10_152019_create_exam_marks_table', 33),
	(97, '2026_08_10_153155_create_exam_student_marks_table', 34),
	(98, '2026_08_10_154946_create_class_routines_table', 35),
	(99, '2026_08_12_145638_create_assignment_submissions_table', 36),
	(100, '2026_08_16_163314_create_notifications_table', 37),
	(101, '2026_08_16_163315_add_status_to_students_table', 37),
	(102, '2026_08_17_141517_add_student_list_page_settings_to_site_settings_table', 38),
	(103, '2026_08_17_144850_add_tuition_fee_settings_to_site_settings_table', 39),
	(104, '2026_08_17_162642_add_result_pages_to_site_settings', 40),
	(105, '2026_08_22_051250_add_sidebar_widget_titles_to_site_settings_table', 41),
	(106, '2026_08_22_053429_create_academic_calendars_table', 42);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table school_management.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table school_management.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.model_has_roles: ~31 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(1, 'App\\Models\\User', 2),
	(3, 'App\\Models\\User', 3),
	(4, 'App\\Models\\User', 3),
	(5, 'App\\Models\\User', 4),
	(5, 'App\\Models\\User', 5),
	(5, 'App\\Models\\User', 6),
	(5, 'App\\Models\\User', 7),
	(5, 'App\\Models\\User', 8),
	(5, 'App\\Models\\User', 9),
	(5, 'App\\Models\\User', 10),
	(5, 'App\\Models\\User', 11),
	(5, 'App\\Models\\User', 12),
	(5, 'App\\Models\\User', 13),
	(5, 'App\\Models\\User', 14),
	(5, 'App\\Models\\User', 15),
	(5, 'App\\Models\\User', 16),
	(5, 'App\\Models\\User', 17),
	(5, 'App\\Models\\User', 18),
	(5, 'App\\Models\\User', 19),
	(5, 'App\\Models\\User', 20),
	(5, 'App\\Models\\User', 21),
	(5, 'App\\Models\\User', 22),
	(5, 'App\\Models\\User', 23),
	(5, 'App\\Models\\User', 24),
	(6, 'App\\Models\\User', 25),
	(6, 'App\\Models\\User', 26),
	(6, 'App\\Models\\User', 27),
	(6, 'App\\Models\\User', 28),
	(6, 'App\\Models\\User', 29);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table school_management.module_settings
CREATE TABLE IF NOT EXISTS `module_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `show_on_homepage` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.module_settings: ~36 rows (approximately)
/*!40000 ALTER TABLE `module_settings` DISABLE KEYS */;
INSERT INTO `module_settings` (`id`, `key`, `is_enabled`, `show_on_homepage`, `created_at`, `updated_at`) VALUES
	(1, 'slider', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:50:01'),
	(2, 'institute_info', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(3, 'counter', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(4, 'partner', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(5, 'video', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(6, 'offer', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(7, 'choose', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(8, 'skill', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(9, 'about', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(10, 'courses', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:44:58'),
	(11, 'teachers', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(12, 'gallery', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(13, 'events', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(14, 'departments', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(15, 'blog', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(16, 'testimonials', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(17, 'facilities', 1, 0, '2026-07-25 06:35:51', '2026-08-16 14:08:41'),
	(18, 'portfolios', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(19, 'faq', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(20, 'notices', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(21, 'principal', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(22, 'ex_principal', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(23, 'contact', 1, 1, '2026-07-25 06:35:51', '2026-07-25 06:35:51'),
	(24, 'founders_donors', 1, 1, '2026-07-25 17:38:25', '2026-07-25 17:38:25'),
	(25, 'namespace', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(26, 'vapor_maintenance_mode', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(27, 'stubs', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(28, 'paths', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(29, 'auto-discover', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(30, 'commands', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(31, 'scan', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(32, 'composer', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(33, 'register', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(34, 'activators', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(35, 'activator', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14'),
	(36, 'inertia', 1, 1, '2026-08-10 13:24:14', '2026-08-10 13:24:14');
/*!40000 ALTER TABLE `module_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.notices
CREATE TABLE IF NOT EXISTS `notices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `description` json DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notices_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.notices: ~6 rows (approximately)
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` (`id`, `slug`, `title`, `description`, `pdf`, `published_at`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'admission-notice-2026', '{"ar": "إعلان القبول 2026 — من الداخل إلى الكامل الماجستير", "bn": "ভর্তি বিজ্ঞপ্তি ২০২৬ — দাখিল থেকে কামিল এম.এ", "en": "Admission Notice 2026 — Dakhil to Kamil M.A"}', '{"ar": "يُفتح القبول الآن للعام الدراسي 2026-27 في مدرسة الكامل الماجستير بسيتاكُند لجميع البرامج من الداخل إلى الكامل الماجستير. المرشحون المهتمون يتصلوا بالمكتب خلال ساعات العمل (السبت–الخميس، 8 صباحاً–2 مساءً).", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসায় শিক্ষাবর্ষ ২০২৬-২৭-এর জন্য দাখিল থেকে কামিল এম.এ পর্যন্ত সকল প্রোগ্রামে ভর্তি চলছে। আগ্রহী প্রার্থীরা অফিস সময়ে (শনি–বৃহস্পতি, সকাল ৮টা–দুপুর ২টা) অফিসে যোগাযোগ করুন।", "en": "Admission is now open for the academic year 2026-27 at Sitakund Kamil M.A Madrasah for all programs from Dakhil to Kamil M.A. Interested candidates should contact the office during office hours (Saturday–Thursday, 8 AM–2 PM)."}', NULL, '2026-08-01', 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, 'annual-exam-schedule-2026', '{"ar": "جدول الامتحانات السنوية 2026", "bn": "বার্ষিক পরীক্ষার সময়সূচি ২০২৬", "en": "Annual Examination Schedule 2026"}', '{"ar": "تبدأ الامتحانات السنوية للعام الدراسي 2026 في 1 نوفمبر 2026. يُطلب من جميع الطلاب الحصول على بطاقات دخولهم من المكتب. الحضور في الامتحانات إلزامي.", "bn": "শিক্ষাবর্ষ ২০২৬-এর বার্ষিক পরীক্ষা ১ নভেম্বর ২০২৬ থেকে শুরু হবে। সকল শিক্ষার্থীদের অফিস থেকে প্রবেশপত্র সংগ্রহ করতে হবে। পরীক্ষায় উপস্থিতি বাধ্যতামূলক।", "en": "The annual examinations for the academic year 2026 will commence on 1 November 2026. All students are required to collect their admit cards from the office. Attendance during examinations is mandatory."}', NULL, '2026-09-01', 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, 'prize-giving-ceremony-2026', '{"ar": "حفل توزيع الجوائز السنوي — 15 أغسطس 2026", "bn": "বার্ষিক পুরস্কার বিতরণ অনুষ্ঠান — ১৫ আগস্ট ২০২৬", "en": "Annual Prize Giving Ceremony — 15 August 2026"}', '{"ar": "سيُعقد حفل توزيع الجوائز السنوي لمدرسة الكامل الماجستير بسيتاكُند في 15 أغسطس 2026. يُدعى بحرارة جميع الطلاب وأولياء الأمور والخريجين والمتمنين للخير للحضور.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার বার্ষিক পুরস্কার বিতরণ অনুষ্ঠান ১৫ আগস্ট ২০২৬ তারিখে অনুষ্ঠিত হবে। সকল শিক্ষার্থী, অভিভাবক, প্রাক্তন ছাত্রছাত্রী এবং শুভানুধ্যায়ীদের উপস্থিত থাকার জন্য আন্তরিকভাবে আমন্ত্রণ জানানো হচ্ছে।", "en": "The Annual Prize Giving Ceremony of Sitakund Kamil M.A Madrasah will be held on 15 August 2026. All students, parents, alumni, and well-wishers are cordially invited to attend."}', NULL, '2026-07-15', 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;

-- Dumping structure for table school_management.notice_page_settings
CREATE TABLE IF NOT EXISTS `notice_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `marquee_label` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.notice_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `notice_page_settings` DISABLE KEYS */;
INSERT INTO `notice_page_settings` (`id`, `marquee_label`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}', '{"ar": "لوحة الإشعارات", "bn": "বিজ্ঞপ্তি বোর্ড", "en": "Notice Board"}', 'site/notices-breadcrumb.jpg', '{"ar": "لوحة الإشعارات - مدرسة الكامل الماجستير بسيتاكُند", "bn": "বিজ্ঞপ্তি বোর্ড - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Notice Board - Sitakund Kamil M.A Madrasah"}', '{"ar": "اقرأ أحدث الإشعارات والجداول والإعلانات من مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার সর্বশেষ বিজ্ঞপ্তি, রুটিন ও ঘোষণা পড়ুন।", "en": "Read the latest notices, routines, and announcements from Sitakund Kamil M.A Madrasah."}', '{"ar": "إشعار، إعلانات، مدرسة سيتاكُند", "bn": "বিজ্ঞপ্তি, ঘোষণা, সীতাকুণ্ড মাদ্রাসা", "en": "notice, announcements, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `notice_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table school_management.optional_subject_configs
CREATE TABLE IF NOT EXISTS `optional_subject_configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `academic_class_id` bigint(20) unsigned DEFAULT NULL,
  `academic_group_id` bigint(20) unsigned DEFAULT NULL,
  `limit` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `optional_subject_configs_academic_class_id_foreign` (`academic_class_id`),
  KEY `optional_subject_configs_academic_group_id_foreign` (`academic_group_id`),
  CONSTRAINT `optional_subject_configs_academic_class_id_foreign` FOREIGN KEY (`academic_class_id`) REFERENCES `academic_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `optional_subject_configs_academic_group_id_foreign` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.optional_subject_configs: ~0 rows (approximately)
/*!40000 ALTER TABLE `optional_subject_configs` DISABLE KEYS */;
/*!40000 ALTER TABLE `optional_subject_configs` ENABLE KEYS */;

-- Dumping structure for table school_management.optional_subject_config_subjects
CREATE TABLE IF NOT EXISTS `optional_subject_config_subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `optional_subject_config_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `optional_subject_config_subjects_subject_id_foreign` (`subject_id`),
  CONSTRAINT `optional_subject_config_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.optional_subject_config_subjects: ~0 rows (approximately)
/*!40000 ALTER TABLE `optional_subject_config_subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `optional_subject_config_subjects` ENABLE KEYS */;

-- Dumping structure for table school_management.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `content` json DEFAULT NULL,
  `custom_css` text COLLATE utf8mb4_unicode_ci,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.pages: ~9 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `custom_css`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'history', '{"ar": "تاريخ مدرسة الكامل الماجستير بسيتاكُند", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার ইতিহাস", "en": "History of Sitakund Kamil M.A Madrasah"}', '{"ar": "<p>تقع مدرسة الكامل الماجستير بسيتاكُند على الضفة الغربية لبركة لالديغي التاريخية في سيتاكُند، بمحاذاة الطريق الرئيسي داكا-تشيتاغونغ، وهي واحدة من أعرق المؤسسات التعليمية الإسلامية وأكثرها مكانةً في تشيتاغونغ ببنغلاديش.</p><p>تأسست عام 1886 على يد العالم الجليل مولانا عبيد الحق (رحمه الله) — المولود في باربا كُند، سيتاكُند في الثامن من يونيو 1856 — وقد نجت المدرسة من هجومين حرقييْن طائفييْن في سنواتها الأولى، لترتفع لتصبح معلمةً بارزةً للعلم الإسلامي. وبعد إتمامه دراسته الدينية في كلكتا، عاد مولانا عبيد الحق وكرّس حياته لبناء هذه المؤسسة مركزاً للتعليم الديني والحديث معاً.</p><p>حصلت المدرسة على الاعتراف الحكومي الدائم عام 1967، وعلى موافقة مستوى الكامل عام 1986 — بالضبط بعد مئة عام من تأسيسها. وعلى مدى تاريخها، أنجبت علماءَ ومعلمين وسياسيين وقادةً مجتمعيين تركوا بصماتٍ لا تُمحى في المجتمع. كما أسست المدرسة عام 1976 مدرسةً للحفظ، وتُدير مهجعاً متكاملاً للطلاب القادمين من مناطق بعيدة.</p>", "bn": "<p>সীতাকুণ্ড কামিল এম.এ মাদ্রাসা, সীতাকুণ্ডের ঐতিহাসিক লালদিঘীর পশ্চিম পাড়ে ঢাকা-চট্টগ্রাম মহাসড়কের পাশে অবস্থিত, বাংলাদেশের চট্টগ্রামের অন্যতম প্রাচীন ও সম্মানিত ইসলামী শিক্ষা প্রতিষ্ঠান।</p><p>১৮৮৬ সালে দূরদৃষ্টিসম্পন্ন আলেমে দ্বীন মাওলানা ওবায়দুল হক (রহ.) — যিনি ১৮৫৬ সালের ৮ জুন সীতাকুণ্ডের বাড়বকুণ্ডে জন্মগ্রহণ করেন — কর্তৃক প্রতিষ্ঠিত এই প্রতিষ্ঠানটি প্রথম বছরগুলোতে দুইবার সাম্প্রদায়িক অগ্নিসংযোগের শিকার হয়েও ইসলামী শিক্ষার একটি মাইলফলক হিসেবে প্রতিষ্ঠিত হয়েছে। কলকাতায় দ্বীনি শিক্ষা সমাপ্ত করে মাওলানা ওবায়দুল হক ফিরে এসে এই প্রতিষ্ঠানকে ধর্মীয় ও আধুনিক শিক্ষার কেন্দ্র হিসেবে গড়ে তুলতে নিজের জীবন উৎসর্গ করেন।</p><p>মাদ্রাসাটি ১৯৬৭ সালে স্থায়ী সরকারি স্বীকৃতি এবং ১৯৮৬ সালে — প্রতিষ্ঠার ঠিক ১০০ বছর পর — কামিল স্তরের অনুমোদন লাভ করে। এর দীর্ঘ ইতিহাসে আলেম, শিক্ষাবিদ, রাজনীতিবিদ এবং সমাজনেতা তৈরি করেছে যারা সমাজে অমোঘ ছাপ ফেলেছেন। প্রতিষ্ঠানটি ১৯৭৬ সালে একটি হাফেজিয়া মাদ্রাসাও প্রতিষ্ঠা করেছে এবং দূরদূরান্তের শিক্ষার্থীদের জন্য একটি পূর্ণাঙ্গ হোস্টেল পরিচালনা করে।</p>", "en": "<p>Sitakund Kamil M.A Madrasah, nestled along the Dhaka-Chattogram Trunk Road on the banks of Sitakund\'s historic Laldigi pond, is one of the oldest and most prestigious Islamic educational institutions of Chattogram, Bangladesh.</p><p>Founded in 1886 by the visionary scholar Maulana Obaidul Haq (R.) — born in Barbakund, Sitakund on 8 June 1856 — the institution survived two communal arson attacks in its early years and rose to become a landmark of Islamic learning. After completing his religious studies in Kolkata, Maulana Obaidul Haq returned and dedicated his life to establishing this institution as a centre of both religious and modern education.</p><p>The Madrasah received permanent government recognition in 1967 and Kamil-level approval in 1986 — exactly 100 years after its founding. Over its history, it has produced scholars, educators, politicians, and community leaders who have left an indelible mark on society. The institution also established a Hafeziya Madrasah in 1976 and operates a full-fledged hostel for students from distant areas.</p>"}', NULL, 'site/history-breadcrumb.jpg', '{"ar": "التاريخ - مدرسة الكامل الماجستير بسيتاكُند", "bn": "ইতিহাস - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "History - Sitakund Kamil M.A Madrasah"}', '{"ar": "اقرأ تاريخ مدرسة الكامل الماجستير بسيتاكُند الممتد لـ 138 عاماً، التي أسسها مولانا عبيد الحق عام 1886.", "bn": "১৮৮৬ সালে মাওলানা ওবায়দুল হক (রহ.) কর্তৃক প্রতিষ্ঠিত সীতাকুণ্ড কামিল এম.এ মাদ্রাসার ১৩৮ বছরের ইতিহাস পড়ুন।", "en": "Read the 138-year history of Sitakund Kamil M.A Madrasah, founded in 1886 by Maulana Obaidul Haq."}', '{"ar": "التاريخ، مدرسة سيتاكُند، 1886، مولانا عبيد الحق", "bn": "ইতিহাস, সীতাকুণ্ড মাদ্রাসা, ১৮৮৬, মাওলানা ওবায়দুল হক", "en": "history, sitakund madrasah, 1886, maulana obaidul haq"}', 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table school_management.passkeys
CREATE TABLE IF NOT EXISTS `passkeys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credential_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credential` json NOT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `passkeys_credential_id_unique` (`credential_id`),
  KEY `passkeys_user_id_index` (`user_id`),
  CONSTRAINT `passkeys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.passkeys: ~0 rows (approximately)
/*!40000 ALTER TABLE `passkeys` DISABLE KEYS */;
/*!40000 ALTER TABLE `passkeys` ENABLE KEYS */;

-- Dumping structure for table school_management.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.password_reset_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Dumping structure for table school_management.periods
CREATE TABLE IF NOT EXISTS `periods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.periods: ~6 rows (approximately)
/*!40000 ALTER TABLE `periods` DISABLE KEYS */;
INSERT INTO `periods` (`id`, `name`, `serial_no`, `created_at`, `updated_at`) VALUES
	(1, '1th Period', '1', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(2, '2th Period', '2', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(3, '3th Period', '3', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(4, '4th Period', '4', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(5, '5th Period', '5', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(6, '6th Period', '6', '2026-08-15 02:33:33', '2026-08-15 02:33:33');
/*!40000 ALTER TABLE `periods` ENABLE KEYS */;

-- Dumping structure for table school_management.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.permissions: ~75 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'slider.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(2, 'slider.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(3, 'slider.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(4, 'slider.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(5, 'courses.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(6, 'courses.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(7, 'courses.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(8, 'courses.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(9, 'teachers.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(10, 'teachers.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(11, 'teachers.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(12, 'teachers.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(13, 'departments.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(14, 'departments.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(15, 'departments.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(16, 'departments.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(17, 'events.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(18, 'events.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(19, 'events.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(20, 'events.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(21, 'notices.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(22, 'notices.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(23, 'notices.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(24, 'notices.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(25, 'gallery.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(26, 'gallery.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(27, 'gallery.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(28, 'gallery.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(29, 'facilities.view', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(30, 'facilities.create', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(31, 'facilities.edit', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(32, 'facilities.delete', 'web', '2026-07-25 07:08:57', '2026-07-25 07:08:57'),
	(33, 'portfolios.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(34, 'portfolios.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(35, 'portfolios.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(36, 'portfolios.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(37, 'blog.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(38, 'blog.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(39, 'blog.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(40, 'blog.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(41, 'testimonials.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(42, 'testimonials.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(43, 'testimonials.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(44, 'testimonials.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(45, 'faq.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(46, 'faq.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(47, 'faq.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(48, 'faq.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(49, 'pages.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(50, 'pages.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(51, 'pages.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(52, 'pages.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(53, 'menus.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(54, 'menus.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(55, 'menus.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(56, 'menus.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(57, 'contact_messages.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(58, 'contact_messages.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(59, 'contact_messages.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(60, 'languages.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(61, 'languages.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(62, 'languages.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(63, 'languages.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(64, 'website_options.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(65, 'website_options.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(66, 'site_configuration.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(67, 'site_configuration.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(68, 'users.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(69, 'users.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(70, 'users.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(71, 'users.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(72, 'roles.view', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(73, 'roles.create', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(74, 'roles.edit', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(75, 'roles.delete', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(76, 'founders_donors.view', 'web', '2026-07-25 17:36:23', '2026-07-25 17:36:23'),
	(77, 'founders_donors.create', 'web', '2026-07-25 17:36:23', '2026-07-25 17:36:23'),
	(78, 'founders_donors.edit', 'web', '2026-07-25 17:36:23', '2026-07-25 17:36:23'),
	(79, 'founders_donors.delete', 'web', '2026-07-25 17:36:23', '2026-07-25 17:36:23');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table school_management.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table school_management.portfolios
CREATE TABLE IF NOT EXISTS `portfolios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` json NOT NULL,
  `category` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` json DEFAULT NULL,
  `gallery_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highlight_title` json DEFAULT NULL,
  `highlight_items` json DEFAULT NULL,
  `overview_title` json DEFAULT NULL,
  `overview_description` json DEFAULT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint(3) unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolios_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.portfolios: ~6 rows (approximately)
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` (`id`, `slug`, `title`, `category`, `image`, `description`, `gallery_image_1`, `gallery_image_2`, `highlight_title`, `highlight_items`, `overview_title`, `overview_description`, `client_name`, `event_date`, `cost`, `manager_name`, `location`, `website_url`, `rating`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'student-health-care', '{"ar": "الرعاية الصحية للطلاب", "bn": "শিক্ষার্থী স্বাস্থ্য সেবা", "en": "Student Health Care"}', '{"ar": "الصحة", "bn": "স্বাস্থ্য", "en": "Health"}', 'site/portfolios/student-health-care.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المشروع دورًا مهمًا لمؤسستنا.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই প্রকল্পটি প্রতিষ্ঠানের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/portfolios-gallery-1.jpg', 'site/portfolios-gallery-2.jpg', '{"ar": "أبرز النقاط", "bn": "মূল বৈশিষ্ট্য", "en": "Key Highlights"}', '[{"text": {"ar": "يتم ترتيب فحوصات صحية منتظمة للطلاب.", "bn": "শিক্ষার্থীদের জন্য নিয়মিত স্বাস্থ্য পরীক্ষার ব্যবস্থা করা হয়।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "الرعاية الطبية الطارئة متاحة على مدار الساعة.", "bn": "জরুরি চিকিৎসা সেবা সার্বক্ষণিক পাওয়া যায়।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "تُقدَّم استشارات التغذية بانتظام.", "bn": "পুষ্টি সম্পর্কিত পরামর্শ নিয়মিত প্রদান করা হয়।", "en": "Nullam rhoncus dictum diam quis ultrices."}}]', '{"ar": "نظرة عامة والتحدي", "bn": "সংক্ষিপ্ত বিবরণ ও চ্যালেঞ্জ", "en": "Overview And Challenge"}', '{"ar": "واجه هذا المشروع عدة تحديات أثناء التنفيذ، تم التغلب عليها بنجاح.", "bn": "এই প্রকল্পটি বাস্তবায়নের সময় বেশ কিছু চ্যালেঞ্জ মোকাবিলা করতে হয়েছে, যা সফলভাবে সমাধান করা হয়েছে।", "en": "Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue ligula. Orci varius natoque penatibus et magnis dis parturient montes."}', 'Roger M Collins', '2026-06-23', '$1250.00', 'Doseph Brehmer', 'Chittagong, Bangladesh', 'example.com', 5, 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'digital-learning-program', '{"ar": "برنامج التعلم الرقمي", "bn": "ডিজিটাল লার্নিং প্রোগ্রাম", "en": "Digital Learning Program"}', '{"ar": "التعليم", "bn": "শিক্ষা", "en": "Education"}', 'site/portfolios/digital-learning-program.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المشروع دورًا مهمًا لمؤسستنا.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই প্রকল্পটি প্রতিষ্ঠানের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/portfolios-gallery-1.jpg', 'site/portfolios-gallery-2.jpg', '{"ar": "أبرز النقاط", "bn": "মূল বৈশিষ্ট্য", "en": "Key Highlights"}', '[{"text": {"ar": "يتم ترتيب فحوصات صحية منتظمة للطلاب.", "bn": "শিক্ষার্থীদের জন্য নিয়মিত স্বাস্থ্য পরীক্ষার ব্যবস্থা করা হয়।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "الرعاية الطبية الطارئة متاحة على مدار الساعة.", "bn": "জরুরি চিকিৎসা সেবা সার্বক্ষণিক পাওয়া যায়।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "تُقدَّم استشارات التغذية بانتظام.", "bn": "পুষ্টি সম্পর্কিত পরামর্শ নিয়মিত প্রদান করা হয়।", "en": "Nullam rhoncus dictum diam quis ultrices."}}]', '{"ar": "نظرة عامة والتحدي", "bn": "সংক্ষিপ্ত বিবরণ ও চ্যালেঞ্জ", "en": "Overview And Challenge"}', '{"ar": "واجه هذا المشروع عدة تحديات أثناء التنفيذ، تم التغلب عليها بنجاح.", "bn": "এই প্রকল্পটি বাস্তবায়নের সময় বেশ কিছু চ্যালেঞ্জ মোকাবিলা করতে হয়েছে, যা সফলভাবে সমাধান করা হয়েছে।", "en": "Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue ligula. Orci varius natoque penatibus et magnis dis parturient montes."}', 'Roger M Collins', '2026-05-23', '$1250.00', 'Doseph Brehmer', 'Chittagong, Bangladesh', 'example.com', 5, 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'campus-renovation-project', '{"ar": "مشروع تجديد الحرم الجامعي", "bn": "ক্যাম্পাস সংস্কার প্রকল্প", "en": "Campus Renovation Project"}', '{"ar": "البنية التحتية", "bn": "অবকাঠামো", "en": "Infrastructure"}', 'site/portfolios/campus-renovation-project.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المشروع دورًا مهمًا لمؤسستنا.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই প্রকল্পটি প্রতিষ্ঠানের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/portfolios-gallery-1.jpg', 'site/portfolios-gallery-2.jpg', '{"ar": "أبرز النقاط", "bn": "মূল বৈশিষ্ট্য", "en": "Key Highlights"}', '[{"text": {"ar": "يتم ترتيب فحوصات صحية منتظمة للطلاب.", "bn": "শিক্ষার্থীদের জন্য নিয়মিত স্বাস্থ্য পরীক্ষার ব্যবস্থা করা হয়।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "الرعاية الطبية الطارئة متاحة على مدار الساعة.", "bn": "জরুরি চিকিৎসা সেবা সার্বক্ষণিক পাওয়া যায়।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "تُقدَّم استشارات التغذية بانتظام.", "bn": "পুষ্টি সম্পর্কিত পরামর্শ নিয়মিত প্রদান করা হয়।", "en": "Nullam rhoncus dictum diam quis ultrices."}}]', '{"ar": "نظرة عامة والتحدي", "bn": "সংক্ষিপ্ত বিবরণ ও চ্যালেঞ্জ", "en": "Overview And Challenge"}', '{"ar": "واجه هذا المشروع عدة تحديات أثناء التنفيذ، تم التغلب عليها بنجاح.", "bn": "এই প্রকল্পটি বাস্তবায়নের সময় বেশ কিছু চ্যালেঞ্জ মোকাবিলা করতে হয়েছে, যা সফলভাবে সমাধান করা হয়েছে।", "en": "Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue ligula. Orci varius natoque penatibus et magnis dis parturient montes."}', 'Roger M Collins', '2026-04-23', '$1250.00', 'Doseph Brehmer', 'Chittagong, Bangladesh', 'example.com', 5, 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, 'community-outreach-initiative', '{"ar": "مبادرة التواصل المجتمعي", "bn": "কমিউনিটি আউটরিচ উদ্যোগ", "en": "Community Outreach Initiative"}', '{"ar": "المجتمع", "bn": "কমিউনিটি", "en": "Community"}', 'site/portfolios/community-outreach-initiative.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المشروع دورًا مهمًا لمؤسستنا.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই প্রকল্পটি প্রতিষ্ঠানের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/portfolios-gallery-1.jpg', 'site/portfolios-gallery-2.jpg', '{"ar": "أبرز النقاط", "bn": "মূল বৈশিষ্ট্য", "en": "Key Highlights"}', '[{"text": {"ar": "يتم ترتيب فحوصات صحية منتظمة للطلاب.", "bn": "শিক্ষার্থীদের জন্য নিয়মিত স্বাস্থ্য পরীক্ষার ব্যবস্থা করা হয়।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "الرعاية الطبية الطارئة متاحة على مدار الساعة.", "bn": "জরুরি চিকিৎসা সেবা সার্বক্ষণিক পাওয়া যায়।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "تُقدَّم استشارات التغذية بانتظام.", "bn": "পুষ্টি সম্পর্কিত পরামর্শ নিয়মিত প্রদান করা হয়।", "en": "Nullam rhoncus dictum diam quis ultrices."}}]', '{"ar": "نظرة عامة والتحدي", "bn": "সংক্ষিপ্ত বিবরণ ও চ্যালেঞ্জ", "en": "Overview And Challenge"}', '{"ar": "واجه هذا المشروع عدة تحديات أثناء التنفيذ، تم التغلب عليها بنجاح.", "bn": "এই প্রকল্পটি বাস্তবায়নের সময় বেশ কিছু চ্যালেঞ্জ মোকাবিলা করতে হয়েছে, যা সফলভাবে সমাধান করা হয়েছে।", "en": "Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue ligula. Orci varius natoque penatibus et magnis dis parturient montes."}', 'Roger M Collins', '2026-03-23', '$1250.00', 'Doseph Brehmer', 'Chittagong, Bangladesh', 'example.com', 5, 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(5, 'sports-development-program', '{"ar": "برنامج تطوير الرياضة", "bn": "ক্রীড়া উন্নয়ন প্রোগ্রাম", "en": "Sports Development Program"}', '{"ar": "الرياضة", "bn": "ক্রীড়া", "en": "Sports"}', 'site/portfolios/sports-development-program.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المشروع دورًا مهمًا لمؤسستنا.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই প্রকল্পটি প্রতিষ্ঠানের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/portfolios-gallery-1.jpg', 'site/portfolios-gallery-2.jpg', '{"ar": "أبرز النقاط", "bn": "মূল বৈশিষ্ট্য", "en": "Key Highlights"}', '[{"text": {"ar": "يتم ترتيب فحوصات صحية منتظمة للطلاب.", "bn": "শিক্ষার্থীদের জন্য নিয়মিত স্বাস্থ্য পরীক্ষার ব্যবস্থা করা হয়।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "الرعاية الطبية الطارئة متاحة على مدار الساعة.", "bn": "জরুরি চিকিৎসা সেবা সার্বক্ষণিক পাওয়া যায়।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "تُقدَّم استشارات التغذية بانتظام.", "bn": "পুষ্টি সম্পর্কিত পরামর্শ নিয়মিত প্রদান করা হয়।", "en": "Nullam rhoncus dictum diam quis ultrices."}}]', '{"ar": "نظرة عامة والتحدي", "bn": "সংক্ষিপ্ত বিবরণ ও চ্যালেঞ্জ", "en": "Overview And Challenge"}', '{"ar": "واجه هذا المشروع عدة تحديات أثناء التنفيذ، تم التغلب عليها بنجاح.", "bn": "এই প্রকল্পটি বাস্তবায়নের সময় বেশ কিছু চ্যালেঞ্জ মোকাবিলা করতে হয়েছে, যা সফলভাবে সমাধান করা হয়েছে।", "en": "Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue ligula. Orci varius natoque penatibus et magnis dis parturient montes."}', 'Roger M Collins', '2026-02-23', '$1250.00', 'Doseph Brehmer', 'Chittagong, Bangladesh', 'example.com', 5, 1, 5, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(6, 'environmental-awareness-project', '{"ar": "مشروع التوعية البيئية", "bn": "পরিবেশ সচেতনতা প্রকল্প", "en": "Environmental Awareness Project"}', '{"ar": "البيئة", "bn": "পরিবেশ", "en": "Environment"}', 'site/portfolios/environmental-awareness-project.jpg', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>يلعب هذا المشروع دورًا مهمًا لمؤسستنا.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই প্রকল্পটি প্রতিষ্ঠানের জন্য গুরুত্বপূর্ণ ভূমিকা পালন করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/portfolios-gallery-1.jpg', 'site/portfolios-gallery-2.jpg', '{"ar": "أبرز النقاط", "bn": "মূল বৈশিষ্ট্য", "en": "Key Highlights"}', '[{"text": {"ar": "يتم ترتيب فحوصات صحية منتظمة للطلاب.", "bn": "শিক্ষার্থীদের জন্য নিয়মিত স্বাস্থ্য পরীক্ষার ব্যবস্থা করা হয়।", "en": "Fusce justo risus placerat in risus eget tincidunt consequat elit."}}, {"text": {"ar": "الرعاية الطبية الطارئة متاحة على مدار الساعة.", "bn": "জরুরি চিকিৎসা সেবা সার্বক্ষণিক পাওয়া যায়।", "en": "Nunc fermentum sem sit amet dolor laoreet placerat."}}, {"text": {"ar": "تُقدَّم استشارات التغذية بانتظام.", "bn": "পুষ্টি সম্পর্কিত পরামর্শ নিয়মিত প্রদান করা হয়।", "en": "Nullam rhoncus dictum diam quis ultrices."}}]', '{"ar": "نظرة عامة والتحدي", "bn": "সংক্ষিপ্ত বিবরণ ও চ্যালেঞ্জ", "en": "Overview And Challenge"}', '{"ar": "واجه هذا المشروع عدة تحديات أثناء التنفيذ، تم التغلب عليها بنجاح.", "bn": "এই প্রকল্পটি বাস্তবায়নের সময় বেশ কিছু চ্যালেঞ্জ মোকাবিলা করতে হয়েছে, যা সফলভাবে সমাধান করা হয়েছে।", "en": "Quisque a nisl id sem sollicitudin volutpat. Cras et commodo quam, vel congue ligula. Orci varius natoque penatibus et magnis dis parturient montes."}', 'Roger M Collins', '2026-01-23', '$1250.00', 'Doseph Brehmer', 'Chittagong, Bangladesh', 'example.com', 5, 1, 6, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;

-- Dumping structure for table school_management.portfolio_page_settings
CREATE TABLE IF NOT EXISTS `portfolio_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.portfolio_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `portfolio_page_settings` DISABLE KEYS */;
INSERT INTO `portfolio_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "ملف الأعمال", "bn": "পোর্টফোলিও", "en": "Portfolio"}', '{"ar": "استكشف ملف أعمالنا", "bn": "আমাদের পোর্টফোলিও দেখুন", "en": "Explore Our Portfolio"}', '{"ar": "ملف الأعمال", "bn": "পোর্টফোলিও", "en": "Portfolio"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "ملف الأعمال", "bn": "পোর্টফোলিও", "en": "Portfolio"}', 'site/portfolios-breadcrumb.jpg', '{"ar": "ملف الأعمال", "bn": "পোর্টফোলিও", "en": "Portfolio"}', '{"ar": "تصفح مشاريع ومبادرات مدرستنا البارزة.", "bn": "আমাদের স্কুলের উল্লেখযোগ্য প্রকল্প ও উদ্যোগ ব্রাউজ করুন।", "en": "Browse our school\'s notable projects and initiatives."}', '{"ar": "ملف الأعمال، مشاريع، مبادرات مدرسية", "bn": "পোর্টফোলিও, প্রকল্প, স্কুল উদ্যোগ", "en": "portfolio, projects, school initiatives"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `portfolio_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.prayers
CREATE TABLE IF NOT EXISTS `prayers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `session_id` bigint(20) unsigned DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.prayers: ~0 rows (approximately)
/*!40000 ALTER TABLE `prayers` DISABLE KEYS */;
/*!40000 ALTER TABLE `prayers` ENABLE KEYS */;

-- Dumping structure for table school_management.resources
CREATE TABLE IF NOT EXISTS `resources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `session_id` bigint(20) unsigned DEFAULT NULL,
  `files` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.resources: ~0 rows (approximately)
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;

-- Dumping structure for table school_management.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.roles: ~5 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'system_admin', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(2, 'admin', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(3, 'operator', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(4, 'teacher', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(5, 'student', 'web', '2026-07-25 07:08:58', '2026-07-25 07:08:58'),
	(6, 'staff', 'web', '2026-08-09 15:25:48', '2026-08-09 15:25:48');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table school_management.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.role_has_permissions: ~79 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 2),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 2),
	(7, 2),
	(8, 2),
	(9, 2),
	(10, 2),
	(11, 2),
	(12, 2),
	(13, 2),
	(14, 2),
	(15, 2),
	(16, 2),
	(17, 2),
	(18, 2),
	(19, 2),
	(20, 2),
	(21, 2),
	(22, 2),
	(23, 2),
	(24, 2),
	(25, 2),
	(26, 2),
	(27, 2),
	(28, 2),
	(29, 2),
	(30, 2),
	(31, 2),
	(32, 2),
	(33, 2),
	(34, 2),
	(35, 2),
	(36, 2),
	(37, 2),
	(38, 2),
	(39, 2),
	(40, 2),
	(41, 2),
	(42, 2),
	(43, 2),
	(44, 2),
	(45, 2),
	(46, 2),
	(47, 2),
	(48, 2),
	(49, 2),
	(50, 2),
	(51, 2),
	(52, 2),
	(53, 2),
	(54, 2),
	(55, 2),
	(56, 2),
	(57, 2),
	(58, 2),
	(59, 2),
	(60, 2),
	(61, 2),
	(62, 2),
	(63, 2),
	(64, 2),
	(65, 2),
	(66, 2),
	(67, 2),
	(68, 2),
	(69, 2),
	(70, 2),
	(71, 2),
	(72, 2),
	(73, 2),
	(74, 2),
	(75, 2),
	(76, 2),
	(77, 2),
	(78, 2),
	(79, 2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table school_management.sections
CREATE TABLE IF NOT EXISTS `sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_class_id` bigint(20) unsigned NOT NULL,
  `academic_group_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sections_academic_class_id_foreign` (`academic_class_id`),
  KEY `sections_academic_group_id_foreign` (`academic_group_id`),
  CONSTRAINT `sections_academic_class_id_foreign` FOREIGN KEY (`academic_class_id`) REFERENCES `academic_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sections_academic_group_id_foreign` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.sections: ~10 rows (approximately)
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` (`id`, `academic_class_id`, `academic_group_id`, `name`, `room_no`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 'A', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(2, 1, 4, 'B', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(3, 2, 4, 'A', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(4, 2, 4, 'B', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(5, 3, 4, 'A', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(6, 3, 4, 'B', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(7, 4, 4, 'A', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(8, 4, 4, 'B', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(9, 5, 4, 'A', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(10, 5, 4, 'B', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;

-- Dumping structure for table school_management.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('NpnmRvMBH9zKZ0fvOJguWKiG9usQ2i50lbEu6jn7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'eyJfdG9rZW4iOiJ3NjRhUkdFaWd1VU1KaXQ2bmlOY00ybDBTNFBqY3hFUUhKRjR5TDVwIiwibG9jYWxlIjoiYXIiLCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1787509340);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping structure for table school_management.shifts
CREATE TABLE IF NOT EXISTS `shifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.shifts: ~2 rows (approximately)
/*!40000 ALTER TABLE `shifts` DISABLE KEYS */;
INSERT INTO `shifts` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Morning', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(2, 'Day', '2026-08-15 02:33:32', '2026-08-15 02:33:32');
/*!40000 ALTER TABLE `shifts` ENABLE KEYS */;

-- Dumping structure for table school_management.signatures
CREATE TABLE IF NOT EXISTS `signatures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `place_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.signatures: ~0 rows (approximately)
/*!40000 ALTER TABLE `signatures` DISABLE KEYS */;
/*!40000 ALTER TABLE `signatures` ENABLE KEYS */;

-- Dumping structure for table school_management.site_settings
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` json DEFAULT NULL,
  `homepage_template` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` json DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_about` json DEFAULT NULL,
  `copyright_text` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `institute_info` json DEFAULT NULL,
  `cta_stats` json DEFAULT NULL,
  `partner_logos` json DEFAULT NULL,
  `video_tagline` json DEFAULT NULL,
  `video_title` json DEFAULT NULL,
  `video_highlight` json DEFAULT NULL,
  `video_description` json DEFAULT NULL,
  `video_button_text` json DEFAULT NULL,
  `video_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_title` json DEFAULT NULL,
  `offer_description` json DEFAULT NULL,
  `offer_button_text` json DEFAULT NULL,
  `offer_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choose_tagline` json DEFAULT NULL,
  `choose_title` json DEFAULT NULL,
  `choose_highlight` json DEFAULT NULL,
  `choose_description` json DEFAULT NULL,
  `choose_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choose_features` json DEFAULT NULL,
  `skill_enroll_title` json DEFAULT NULL,
  `skill_enroll_subtitle` json DEFAULT NULL,
  `skill_tagline` json DEFAULT NULL,
  `skill_title` json DEFAULT NULL,
  `skill_highlight` json DEFAULT NULL,
  `skill_description` json DEFAULT NULL,
  `skill_button_text` json DEFAULT NULL,
  `skill_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skill_items` json DEFAULT NULL,
  `about_tagline` json DEFAULT NULL,
  `about_title` json DEFAULT NULL,
  `about_highlight` json DEFAULT NULL,
  `about_description` json DEFAULT NULL,
  `about_quote` json DEFAULT NULL,
  `about_button_text` json DEFAULT NULL,
  `about_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_badge_icon` json DEFAULT NULL,
  `about_badge_text` json DEFAULT NULL,
  `about_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_items` json DEFAULT NULL,
  `about_page_breadcrumb_title` json DEFAULT NULL,
  `about_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_page_seo_title` json DEFAULT NULL,
  `about_page_seo_description` json DEFAULT NULL,
  `about_page_seo_keywords` json DEFAULT NULL,
  `principal_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_name` json DEFAULT NULL,
  `principal_designation` json DEFAULT NULL,
  `principal_message` json DEFAULT NULL,
  `principal_page_breadcrumb_title` json DEFAULT NULL,
  `principal_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `principal_page_seo_title` json DEFAULT NULL,
  `principal_page_seo_description` json DEFAULT NULL,
  `principal_page_seo_keywords` json DEFAULT NULL,
  `ex_principal_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ex_principal_name` json DEFAULT NULL,
  `ex_principal_designation` json DEFAULT NULL,
  `ex_principal_message` json DEFAULT NULL,
  `ex_principal_page_breadcrumb_title` json DEFAULT NULL,
  `ex_principal_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ex_principal_page_seo_title` json DEFAULT NULL,
  `ex_principal_page_seo_description` json DEFAULT NULL,
  `ex_principal_page_seo_keywords` json DEFAULT NULL,
  `contact_open_time` json DEFAULT NULL,
  `contact_form_title` json DEFAULT NULL,
  `contact_form_description` json DEFAULT NULL,
  `contact_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_map_embed_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_page_breadcrumb_title` json DEFAULT NULL,
  `contact_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_page_seo_title` json DEFAULT NULL,
  `contact_page_seo_description` json DEFAULT NULL,
  `contact_page_seo_keywords` json DEFAULT NULL,
  `contact_address_label` json DEFAULT NULL,
  `contact_address_value` json DEFAULT NULL,
  `contact_phone_label` json DEFAULT NULL,
  `contact_phone_value` json DEFAULT NULL,
  `contact_email_label` json DEFAULT NULL,
  `contact_email_value` json DEFAULT NULL,
  `contact_open_time_label` json DEFAULT NULL,
  `footer_quick_links_title` json DEFAULT NULL,
  `footer_quick_links` json DEFAULT NULL,
  `footer_campus_title` json DEFAULT NULL,
  `footer_campus_links` json DEFAULT NULL,
  `footer_newsletter_title` json DEFAULT NULL,
  `footer_newsletter_text` json DEFAULT NULL,
  `sidebar_notice_show` tinyint(1) NOT NULL DEFAULT '1',
  `sidebar_notice_title` json DEFAULT NULL,
  `sidebar_notice_limit` int(11) NOT NULL DEFAULT '4',
  `sidebar_minister_show` tinyint(1) NOT NULL DEFAULT '1',
  `sidebar_minister_title` json DEFAULT NULL,
  `sidebar_minister_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_minister_name` json DEFAULT NULL,
  `sidebar_minister_role` json DEFAULT NULL,
  `sidebar_minister_button_text` json DEFAULT NULL,
  `sidebar_minister_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_secretary_show` tinyint(1) NOT NULL DEFAULT '1',
  `sidebar_secretary_title` json DEFAULT NULL,
  `sidebar_secretary_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_secretary_name` json DEFAULT NULL,
  `sidebar_secretary_role` json DEFAULT NULL,
  `sidebar_secretary_button_text` json DEFAULT NULL,
  `sidebar_secretary_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_principal_show` tinyint(1) NOT NULL DEFAULT '1',
  `sidebar_principal_title` json DEFAULT NULL,
  `sidebar_principal_button_text` json DEFAULT NULL,
  `sidebar_vice_principal_show` tinyint(1) NOT NULL DEFAULT '1',
  `sidebar_vice_principal_title` json DEFAULT NULL,
  `sidebar_vice_principal_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_vice_principal_name` json DEFAULT NULL,
  `sidebar_vice_principal_role` json DEFAULT NULL,
  `sidebar_vice_principal_button_text` json DEFAULT NULL,
  `sidebar_vice_principal_button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_calendar_show` tinyint(1) NOT NULL DEFAULT '1',
  `sidebar_calendar_title` json DEFAULT NULL,
  `student_list_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_list_page_breadcrumb_title` json DEFAULT NULL,
  `student_list_page_seo_title` json DEFAULT NULL,
  `student_list_page_seo_description` json DEFAULT NULL,
  `student_list_page_seo_keywords` json DEFAULT NULL,
  `tuition_fee_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuition_fee_page_breadcrumb_title` json DEFAULT NULL,
  `tuition_fee_page_seo_title` json DEFAULT NULL,
  `tuition_fee_page_seo_description` json DEFAULT NULL,
  `tuition_fee_page_seo_keywords` json DEFAULT NULL,
  `tuition_fee_page_content` json DEFAULT NULL,
  `exam_result_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_result_page_breadcrumb_title` json DEFAULT NULL,
  `exam_result_page_seo_title` json DEFAULT NULL,
  `exam_result_page_seo_description` json DEFAULT NULL,
  `exam_result_page_seo_keywords` json DEFAULT NULL,
  `academic_result_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_result_page_breadcrumb_title` json DEFAULT NULL,
  `academic_result_page_seo_title` json DEFAULT NULL,
  `academic_result_page_seo_description` json DEFAULT NULL,
  `academic_result_page_seo_keywords` json DEFAULT NULL,
  `evaluation_result_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `evaluation_result_page_breadcrumb_title` json DEFAULT NULL,
  `evaluation_result_page_seo_title` json DEFAULT NULL,
  `evaluation_result_page_seo_description` json DEFAULT NULL,
  `evaluation_result_page_seo_keywords` json DEFAULT NULL,
  `board_exam_result_page_breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `board_exam_result_page_breadcrumb_title` json DEFAULT NULL,
  `board_exam_result_page_seo_title` json DEFAULT NULL,
  `board_exam_result_page_seo_description` json DEFAULT NULL,
  `board_exam_result_page_seo_keywords` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.site_settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` (`id`, `site_name`, `homepage_template`, `logo`, `footer_logo`, `address`, `phone`, `email`, `facebook_url`, `instagram_url`, `youtube_url`, `whatsapp_url`, `linkedin_url`, `footer_about`, `copyright_text`, `created_at`, `updated_at`, `institute_info`, `cta_stats`, `partner_logos`, `video_tagline`, `video_title`, `video_highlight`, `video_description`, `video_button_text`, `video_button_url`, `video_youtube_url`, `video_thumbnail`, `offer_title`, `offer_description`, `offer_button_text`, `offer_button_url`, `offer_background`, `choose_tagline`, `choose_title`, `choose_highlight`, `choose_description`, `choose_image`, `choose_features`, `skill_enroll_title`, `skill_enroll_subtitle`, `skill_tagline`, `skill_title`, `skill_highlight`, `skill_description`, `skill_button_text`, `skill_button_url`, `skill_items`, `about_tagline`, `about_title`, `about_highlight`, `about_description`, `about_quote`, `about_button_text`, `about_button_url`, `about_badge_icon`, `about_badge_text`, `about_image_1`, `about_image_2`, `about_image_3`, `about_items`, `about_page_breadcrumb_title`, `about_page_breadcrumb_image`, `about_page_seo_title`, `about_page_seo_description`, `about_page_seo_keywords`, `principal_photo`, `principal_name`, `principal_designation`, `principal_message`, `principal_page_breadcrumb_title`, `principal_page_breadcrumb_image`, `principal_page_seo_title`, `principal_page_seo_description`, `principal_page_seo_keywords`, `ex_principal_photo`, `ex_principal_name`, `ex_principal_designation`, `ex_principal_message`, `ex_principal_page_breadcrumb_title`, `ex_principal_page_breadcrumb_image`, `ex_principal_page_seo_title`, `ex_principal_page_seo_description`, `ex_principal_page_seo_keywords`, `contact_open_time`, `contact_form_title`, `contact_form_description`, `contact_image`, `contact_map_embed_url`, `contact_page_breadcrumb_title`, `contact_page_breadcrumb_image`, `contact_page_seo_title`, `contact_page_seo_description`, `contact_page_seo_keywords`, `contact_address_label`, `contact_address_value`, `contact_phone_label`, `contact_phone_value`, `contact_email_label`, `contact_email_value`, `contact_open_time_label`, `footer_quick_links_title`, `footer_quick_links`, `footer_campus_title`, `footer_campus_links`, `footer_newsletter_title`, `footer_newsletter_text`, `sidebar_notice_show`, `sidebar_notice_title`, `sidebar_notice_limit`, `sidebar_minister_show`, `sidebar_minister_title`, `sidebar_minister_photo`, `sidebar_minister_name`, `sidebar_minister_role`, `sidebar_minister_button_text`, `sidebar_minister_button_url`, `sidebar_secretary_show`, `sidebar_secretary_title`, `sidebar_secretary_photo`, `sidebar_secretary_name`, `sidebar_secretary_role`, `sidebar_secretary_button_text`, `sidebar_secretary_button_url`, `sidebar_principal_show`, `sidebar_principal_title`, `sidebar_principal_button_text`, `sidebar_vice_principal_show`, `sidebar_vice_principal_title`, `sidebar_vice_principal_photo`, `sidebar_vice_principal_name`, `sidebar_vice_principal_role`, `sidebar_vice_principal_button_text`, `sidebar_vice_principal_button_url`, `sidebar_calendar_show`, `sidebar_calendar_title`, `student_list_page_breadcrumb_image`, `student_list_page_breadcrumb_title`, `student_list_page_seo_title`, `student_list_page_seo_description`, `student_list_page_seo_keywords`, `tuition_fee_page_breadcrumb_image`, `tuition_fee_page_breadcrumb_title`, `tuition_fee_page_seo_title`, `tuition_fee_page_seo_description`, `tuition_fee_page_seo_keywords`, `tuition_fee_page_content`, `exam_result_page_breadcrumb_image`, `exam_result_page_breadcrumb_title`, `exam_result_page_seo_title`, `exam_result_page_seo_description`, `exam_result_page_seo_keywords`, `academic_result_page_breadcrumb_image`, `academic_result_page_breadcrumb_title`, `academic_result_page_seo_title`, `academic_result_page_seo_description`, `academic_result_page_seo_keywords`, `evaluation_result_page_breadcrumb_image`, `evaluation_result_page_breadcrumb_title`, `evaluation_result_page_seo_title`, `evaluation_result_page_seo_description`, `evaluation_result_page_seo_keywords`, `board_exam_result_page_breadcrumb_image`, `board_exam_result_page_breadcrumb_title`, `board_exam_result_page_seo_title`, `board_exam_result_page_seo_description`, `board_exam_result_page_seo_keywords`) VALUES
	(1,
	'{"ar": "مدرسة الكامل الماجستير بسيتاكُند", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Sitakund Kamil M.A Madrasah"}',
	'index-2',
	'site/logo.png',
	'site/logo-light.png',
	'{"ar": "طريق داكا-تشيتاغونغ الرئيسي، سيتاكُند - 4310، تشيتاغونغ، بنغلاديش", "bn": "ঢাকা-চট্টগ্রাম মহাসড়ক, সীতাকুণ্ড - ৪৩১০, চট্টগ্রাম, বাংলাদেশ", "en": "Dhaka-Chattogram Trunk Road, Sitakund - 4310, Chattogram, Bangladesh"}',
	'+8801819-000000',
	'info@sitakundmadrasah.edu.bd',
	'https://facebook.com/sitakundmadrasah',
	'https://instagram.com',
	'https://youtube.com/@sitakundmadrasah',
	'https://wa.me/8801819000000',
	'https://linkedin.com',
	'{"ar": "تُعدّ مدرسة الكامل الماجستير بسيتاكُند منارةً للتعليم الإسلامي منذ عام 1886، تُشكّل أجيالاً من العلماء والقادة. نحن ملتزمون برعاية كل طالب بتعليم جيد ومعلمين متفانين وبيئة حرم ملهمة.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা ১৮৮৬ সাল থেকে ইসলামী শিক্ষার আলোকবর্তিকা হয়ে আলেম ও নেতৃবৃন্দের প্রজন্ম গড়ে তুলছে। মানসম্মত শিক্ষা, নিবেদিতপ্রাণ শিক্ষক ও অনুপ্রেরণাদায়ক ক্যাম্পাস পরিবেশে প্রতিটি শিক্ষার্থীকে গড়ে তুলতে আমরা প্রতিশ্রুতিবদ্ধ।", "en": "Sitakund Kamil M.A Madrasah has been a beacon of Islamic education since 1886, shaping generations of scholars and leaders. We are dedicated to nurturing every student with quality education, devoted teachers, and an inspiring campus environment."}',
	'{"ar": "جميع الحقوق محفوظة.", "bn": "সর্বস্বত্ব সংরক্ষিত।", "en": "All Rights Reserved."}',
	'2026-07-23 17:50:37',
	'2026-08-17 18:23:04',
	'[{"label": {"ar": "رقم EIIN للمعهد", "bn": "ইনস্টিটিউট EIIN", "en": "Institute EIIN"}, "value": {"ar": "136052", "bn": "136052", "en": "136052"}}, {"label": {"ar": "رمز المؤسسة", "bn": "প্রতিষ্ঠান কোড", "en": "Institution Code"}, "value": {"ar": "4001", "bn": "4001", "en": "4001"}}, {"label": {"ar": "رمز المركز", "bn": "কেন্দ্র কোড", "en": "Center Code"}, "value": {"ar": "4001", "bn": "4001", "en": "4001"}}, {"label": {"ar": "سنة التأسيس", "bn": "প্রতিষ্ঠার বছর", "en": "Estd Year"}, "value": {"ar": "١٨٨٦", "bn": "১৮৮৬", "en": "1886"}}]',
	'[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "إجمالي البرامج", "bn": "মোট প্রোগ্রাম", "en": "Total Programs"}, "value": "12"}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "طلابنا", "bn": "আমাদের শিক্ষার্থী", "en": "Our Students"}, "value": "3000+"}, {"icon": {"value": "users", "source": "lucide"}, "label": {"ar": "معلمون مهرة", "bn": "দক্ষ শিক্ষকবৃন্দ", "en": "Skilled Teachers"}, "value": "80+"}, {"icon": {"value": "award", "source": "lucide"}, "label": {"ar": "سنوات التميز", "bn": "উৎকর্ষতার বছর", "en": "Years of Excellence"}, "value": "138+"}]',
	'[{"image": "site/partners/02.png"}, {"image": "site/partners/03.png"}, {"image": "site/partners/04.png"}]',
	'{"ar": "فيديوهاتنا", "bn": "আমাদের ভিডিও", "en": "Our Video"}',
	'{"ar": "استكشف مدرسة الكامل الماجستير بسيتاكُند", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা অন্বেষণ করুন", "en": "Explore Sitakund Kamil M.A Madrasah"}',
	'{"ar": "استكشف", "bn": "অন্বেষণ", "en": "Explore"}',
	'{"ar": "قم بجولة افتراضية في حرمنا الجامعي واكتشف إرثنا الذي امتد لـ 138 عاماً من التميز الإسلامي والمرافق الحديثة والمجتمع النابض بالحياة.", "bn": "আমাদের ক্যাম্পাসের ভার্চুয়াল সফর করুন এবং ইসলামী শ্রেষ্ঠত্ব, আধুনিক সুবিধা ও প্রাণবন্ত সম্প্রদায়ের ১৩৮ বছরের উত্তরাধিকার আবিষ্কার করুন।", "en": "Take a virtual tour of our campus and discover our 138-year legacy of Islamic excellence, modern facilities, and vibrant community."}',
	'{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}',
	'#',
	'https://www.youtube.com/watch?v=ckHzmP1evNU',
	'site/video-thumbnail.jpg',
	'{"ar": "القبول مفتوح 2026 — تقدم لمرحلة الدورة والكامل والفاضل والعالم والداخل", "bn": "ভর্তি চলছে ২০২৬ — দাওরা, কামিল, ফাজিল, আলিম ও দাখিলে আবেদন করুন", "en": "Admission Open 2026 — Apply for Daura, Kamil, Fazil, Alim & Dakhil"}',
	'{"ar": "ابدأ رحلتك نحو التميز الإسلامي. مقاعد محدودة — تقدم قبل الموعد النهائي.", "bn": "ইসলামী শ্রেষ্ঠত্বের যাত্রা শুরু করুন। সীমিত আসন পাওয়া যাচ্ছে — সময়সীমার আগেই আবেদন করুন।", "en": "Begin your journey of Islamic excellence. Limited seats available — apply before the deadline."}',
	'{"ar": "قدم الآن", "bn": "এখনই আবেদন করুন", "en": "Apply Now"}',
	'#',
	'site/offer-background.jpg',
	'{"ar": "لماذا تختارنا", "bn": "কেন আমাদের বেছে নেবেন", "en": "Why Choose Us"}',
	'{"ar": "138 عاماً من التميز الإسلامي والتعليم الحديث", "bn": "ইসলামী শ্রেষ্ঠত্ব ও আধুনিক শিক্ষার ১৩৮ বছর", "en": "138 Years of Islamic Excellence & Modern Education"}',
	'{"ar": "138 عاماً", "bn": "১৩৮ বছর", "en": "138 Years"}',
	'{"ar": "تجمع مدرسة الكامل بين المنهج الإسلامي الراسخ والبرامج الأكاديمية الحديثة لإعداد خريجين متكاملين على أهبة الاستعداد لتحديات الحاضر والمستقبل.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা গভীর-মূল ইসলামী জ্ঞানের সাথে আধুনিক একাডেমিক প্রোগ্রাম একত্রিত করে সুষম স্নাতক তৈরি করে যারা আজ ও আগামীর চ্যালেঞ্জ মোকাবেলায় প্রস্তুত।", "en": "Sitakund Kamil M.A Madrasah combines deep-rooted Islamic scholarship with modern academic programs to produce well-rounded graduates ready for the challenges of today and tomorrow."}',
	'site/choose-image.jpg',
	'[{"icon": {"value": "user-round", "source": "lucide"}, "title": {"ar": "معلمون متخصصون", "bn": "বিশেষজ্ঞ শিক্ষকবৃন্দ", "en": "Expert Teachers"}, "description": {"ar": "يجمع أعضاء هيئة التدريس بين علماء إسلاميين متمرسين ومعلمين حديثين مؤهلين.", "bn": "আমাদের শিক্ষকমণ্ডলী অভিজ্ঞ ইসলামী পণ্ডিত ও যোগ্য আধুনিক শিক্ষকদের সমন্বয়ে গঠিত।", "en": "Our faculty combines seasoned Islamic scholars with qualified modern educators."}}, {"icon": {"value": "library", "source": "lucide"}, "title": {"ar": "منهج دراسي غني", "bn": "সমৃদ্ধ পাঠ্যক্রম", "en": "Rich Curriculum"}, "description": {"ar": "من الداخل إلى الكامل — تعليم إسلامي وحديث شامل تحت سقف واحد.", "bn": "দাখিল থেকে কামিল — এক ছাদের নিচে ব্যাপক ইসলামী ও আধুনিক শিক্ষা।", "en": "From Dakhil to Kamil — comprehensive Islamic and modern education under one roof."}}, {"icon": {"value": "monitor-play", "source": "lucide"}, "title": {"ar": "القرآن والحفظ", "bn": "কুরআন ও হাফেজিয়া", "en": "Quran & Hafeziya"}, "description": {"ar": "برنامج حفظ القرآن المتخصص منذ عام 1976.", "bn": "১৯৭৬ সাল থেকে কুরআন হিফজের জন্য নিবেদিত হাফেজিয়া প্রোগ্রাম।", "en": "Dedicated Hafeziya program for Quran memorization since 1976."}}, {"icon": {"value": "home", "source": "lucide"}, "title": {"ar": "مرافق السكن", "bn": "হোস্টেল সুবিধা", "en": "Hostel Facility"}, "description": {"ar": "مهجع داخل الحرم الجامعي للطلاب القادمين من مناطق بعيدة.", "bn": "দূরদূরান্তের শিক্ষার্থীদের জন্য ক্যাম্পাসে হোস্টেল।", "en": "On-campus hostel for students from distant areas."}}]',
	'{"ar": "ابدأ تسجيلك", "bn": "আপনার ভর্তি শুরু করুন", "en": "Start Your Enrollment"}',
	'{"ar": "انضم إلى تقليد عمره 138 عاماً من الفكر الإسلامي والتميز الحديث.", "bn": "ইসলামী পাণ্ডিত্য ও আধুনিক শ্রেষ্ঠত্বের ১৩৮ বছরের ঐতিহ্যে যোগ দিন।", "en": "Join a 138-year tradition of Islamic scholarship and modern excellence."}',
	'{"ar": "برامجنا", "bn": "আমাদের প্রোগ্রামসমূহ", "en": "Our Programs"}',
	'{"ar": "استكشف برامجنا الأكاديمية", "bn": "আমাদের একাডেমিক প্রোগ্রামগুলো অন্বেষণ করুন", "en": "Explore Our Academic Programs"}',
	'{"ar": "البرامج الأكاديمية", "bn": "একাডেমিক প্রোগ্রাম", "en": "Academic Programs"}',
	'{"ar": "نقدم مجموعة واسعة من البرامج من الداخل حتى الكامل الماجستير، جامعةً بين المنهج الإسلامي الصارم ومعايير التعليم الحديث.", "bn": "আমরা দাখিল থেকে কামিল এম.এ পর্যন্ত বিস্তৃত প্রোগ্রাম অফার করি, কঠোর ইসলামী পাণ্ডিত্যকে আধুনিক শিক্ষার মানদণ্ডের সাথে একত্রিত করে।", "en": "We offer a wide range of programs from Dakhil through Kamil M.A, combining rigorous Islamic scholarship with modern education standards."}',
	'{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}',
	'#',
	'[{"label": {"ar": "طلابنا", "bn": "আমাদের শিক্ষার্থী", "en": "Our Students"}, "percentage": "90"}, {"label": {"ar": "معلمونا", "bn": "আমাদের শিক্ষকবৃন্দ", "en": "Our Teachers"}, "percentage": "85"}, {"label": {"ar": "برامج القرآن", "bn": "কুরআন প্রোগ্রাম", "en": "Quran Programs"}, "percentage": "95"}]',
	'{"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}',
	'{"ar": "138 عاماً من التعليم الإسلامي والتميز الأكاديمي", "bn": "ইসলামী শিক্ষা ও একাডেমিক শ্রেষ্ঠত্বের ১৩৮ বছর", "en": "138 Years of Islamic Education & Academic Excellence"}',
	'{"ar": "138 عاماً", "bn": "১৩৮ বছর", "en": "138 Years"}',
	'{"ar": "تأسست مدرسة الكامل الماجستير بسيتاكُند عام 1886 على يد مولانا عبيد الحق (رحمه الله)، وظلت ركيزةً أساسيةً للتعليم الإسلامي في تشيتاغونغ. من الصمود أمام الهجمات الطائفية إلى نيل الاعتراف الحكومي بمستوى الكامل عام 1986 — إرثنا إرث مثابرة وعلم وخدمة للأمة.", "bn": "১৮৮৬ সালে মাওলানা ওবায়দুল হক (রহ.) কর্তৃক প্রতিষ্ঠিত সীতাকুণ্ড কামিল এম.এ মাদ্রাসা চট্টগ্রামে ইসলামী শিক্ষার একটি মূল ভিত্তি। সাম্প্রদায়িক অগ্নিসংযোগ থেকে বেঁচে উঠে ১৯৮৬ সালে কামিল স্তরের সরকারি স্বীকৃতি পর্যন্ত — আমাদের উত্তরাধিকার হলো স্থিতিশীলতা, পাণ্ডিত্য এবং উম্মাহর সেবার।", "en": "Founded in 1886 by Maulana Obaidul Haq (R.), Sitakund Kamil M.A Madrasah has been a cornerstone of Islamic education in Chattogram. From surviving communal arson attacks to receiving Kamil-level government recognition in 1986 — our legacy is one of resilience, scholarship, and service to the Ummah."}',
	'{"ar": "العلم ميراث الأنبياء، والعلماء ورثة الأنبياء. — حديث شريف", "bn": "জ্ঞান নবীদের উত্তরাধিকার। আলেমরা নবীদের উত্তরসুরী। — হাদিস", "en": "Knowledge is the inheritance of the Prophets. The scholars are the heirs of the Prophets. — Hadith"}',
	'{"ar": "اكتشف المزيد", "bn": "আরও জানুন", "en": "Discover More"}',
	'/about',
	'{"value": "book-open", "source": "lucide"}',
	'{"ar": "138+ عاماً من التميز", "bn": "১৩৮+ বছরের শ্রেষ্ঠত্ব", "en": "138+ Years of Excellence"}',
	'site/about-1.jpg',
	'site/about-2.jpg',
	'site/about-3.jpg',
	'[{"icon": {"value": "book-open", "source": "lucide"}, "title": {"ar": "دراسات إسلامية شاملة", "bn": "ব্যাপক ইসলামী অধ্যয়ন", "en": "Comprehensive Islamic Studies"}, "description": {"ar": "الداخل، العالم، الفاضل، الكامل الماجستير — طيف كامل من البرامج الأكاديمية الإسلامية.", "bn": "দাখিল, আলিম, ফাজিল, কামিল এম.এ — ইসলামী একাডেমিক প্রোগ্রামের পূর্ণ বর্ণালী।", "en": "Dakhil, Alim, Fazil, Kamil M.A — full spectrum of Islamic academic programs."}}, {"icon": {"value": "globe", "source": "lucide"}, "title": {"ar": "اعتراف وطني", "bn": "জাতীয় স্বীকৃতি", "en": "National Recognition"}, "description": {"ar": "مؤسسة معترف بها وطنياً بموافقة حكومية منذ 1967.", "bn": "১৯৬৭ সাল থেকে সরকারি অনুমোদনে জাতীয়ভাবে স্বীকৃত প্রতিষ্ঠান।", "en": "Nationally recognized institution with government approval since 1967."}}]',
	'{"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}',
	'site/about-breadcrumb.jpg',
	'{"ar": "عن مدرسة الكامل الماجستير بسيتاكُند", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা সম্পর্কে", "en": "About Sitakund Kamil M.A Madrasah"}',
	'{"ar": "تعرف على تاريخ مدرسة الكامل الماجستير بسيتاكُند الممتد لـ 138 عاماً ومهمتها ورؤيتها وهيئة تدريسها.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার ১৩৮ বছরের ইতিহাস, লক্ষ্য, দৃষ্টিভঙ্গি ও শিক্ষকমণ্ডলী সম্পর্কে জানুন।", "en": "Learn about the 138-year history, mission, vision, and faculty of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "مدرسة سيتاكُند، من نحن، التاريخ، الكامل، تشيتاغونغ", "bn": "সীতাকুণ্ড মাদ্রাসা, পরিচিতি, ইতিহাস, কামিল, চট্টগ্রাম", "en": "sitakund madrasah, about, history, kamil, chattogram"}',
	NULL,
	'{"ar": "د. أ.ت.م. طاهر", "bn": "ড. এ.টি.এম. তাহের", "en": "Dr. A.T.M. Taher"}',
	'{"ar": "المدير", "bn": "অধ্যক্ষ", "en": "Principal"}',
	'{"ar": "<p>تأسست مدرسة الكامل الماجستير بسيتاكُند عام 1886 على يد العالم الجليل مولانا عبيد الحق (رحمه الله)، وظلت منارةً للتعليم الإسلامي على مدى أكثر من 138 عاماً. مهمتنا إعداد خريجين متكاملين متجذرين في القيم الإسلامية، مزودين بالمعرفة الحديثة، ومستعدين لخدمة الوطن والأمة.</p><p>أرحب بحرارة بالطلاب وأولياء الأمور والزوار في مؤسستنا، وأدعوكم للاطلاع على تراثنا العريق في التميز الأكاديمي والتنمية الروحية.</p>", "bn": "<p>সীতাকুণ্ড কামিল এম.এ মাদ্রাসা ১৮৮৬ সালে মহান আলেমে দ্বীন মাওলানা ওবায়দুল হক (রহ.) কর্তৃক প্রতিষ্ঠিত হয়ে ১৩৮ বছরেরও বেশি সময় ধরে ইসলামী শিক্ষার আলোকবর্তিকা হয়ে আসছে। আমাদের লক্ষ্য হলো এমন সুষম স্নাতক তৈরি করা যারা ইসলামী মূল্যবোধে দৃঢ়, আধুনিক জ্ঞানে সজ্জিত এবং দেশ ও উম্মাহর সেবায় প্রস্তুত।</p><p>আমি উষ্ণভাবে শিক্ষার্থী, অভিভাবক এবং পরিদর্শকদের আমাদের প্রতিষ্ঠানে স্বাগত জানাই এবং আমাদের দীর্ঘ একাডেমিক উৎকর্ষতা ও আধ্যাত্মিক বিকাশের ঐতিহ্য অন্বেষণ করতে আমন্ত্রণ জানাই।</p>", "en": "<p>Sitakund Kamil M.A Madrasah, founded in 1886 by the great scholar Maulana Obaidul Haq (R.), has been a beacon of Islamic education for over 138 years. Our mission is to produce well-rounded graduates who are grounded in Islamic values, equipped with modern knowledge, and ready to serve the nation and the Ummah.</p><p>I warmly welcome students, parents, and visitors to our institution and invite you to explore our long heritage of academic excellence and spiritual development.</p>"}',
	'{"ar": "كلمة المدير", "bn": "অধ্যক্ষের বার্তা", "en": "Principal\'s Message"}',
	'site/principal-breadcrumb.jpg',
	'{"ar": "كلمة المدير - مدرسة الكامل الماجستير بسيتاكُند", "bn": "অধ্যক্ষের বার্তা - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Principal\'s Message - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "اقرأ رسالة مدير مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার অধ্যক্ষের বার্তা পড়ুন।", "en": "Read the message from the Principal of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "المدير، رسالة، مدرسة سيتاكُند", "bn": "অধ্যক্ষ, বার্তা, সীতাকুণ্ড মাদ্রাসা", "en": "principal, message, sitakund madrasah"}',
	NULL,
	'{"ar": "مولانا محمد الحق (رحمه الله)", "bn": "মাওলানা মুহম্মদুল হক (রহ.)", "en": "Maulana Muhammad Obaidul Haq (R.)"}',
	'{"ar": "المدير العام (1950–1988)", "bn": "রেক্টর (১৯৫০–১৯৮৮)", "en": "Rector (1950–1988)"}',
	'{"ar": "<p>خدم مولانا محمد الحق بوصفه مشرفاً ومديراً من 28 مارس 1950 حتى 30 يناير 1981، ثم مديراً عاماً حتى 28 نوفمبر 1988. وفي عهده الحافل، نالت المدرسة الاعتراف الحكومي الدائم عام 1967، وبُني مهجع من طابقين للطلاب، وأُسست مدرسة الحفظ عام 1976. يرقد أمام المدرسة جنباً إلى جنب مع مؤسسها.</p>", "bn": "<p>মাওলানা মুহম্মদুল হক ২৮ মার্চ ১৯৫০ থেকে ৩০ জানুয়ারি ১৯৮১ পর্যন্ত সুপার ও অধ্যক্ষ এবং ২৮ নভেম্বর ১৯৮৮ পর্যন্ত রেক্টরের দায়িত্ব পালন করেন। তাঁর নিষ্ঠাবান কার্যকালে মাদ্রাসা ১৯৬৭ সালে স্থায়ী সরকারি স্বীকৃতি পায়, শিক্ষার্থীদের জন্য দ্বিতল হোস্টেল নির্মিত হয় এবং ১৯৭৬ সালে হাফেজিয়া মাদ্রাসা প্রতিষ্ঠিত হয়। তিনি মাদ্রাসার প্রতিষ্ঠাতার পাশে মাদ্রাসার সামনে শায়িত আছেন।</p>", "en": "<p>Maulana Muhammad Haq served as Superintendent and Principal from March 28, 1950 to January 30, 1981, and as Rector until November 28, 1988. Under his dedicated tenure, the Madrasah received permanent government recognition in 1967, a two-storey hostel was built for students, and the Hafeziya Madrasah was established in 1976. He rests in front of the Madrasah alongside its founder.</p>"}',
	'{"ar": "كلمة المدير العام السابق", "bn": "প্রাক্তন রেক্টরের বার্তা", "en": "Former Rector\'s Message"}',
	'site/ex-principal-breadcrumb.jpg',
	'{"ar": "المدير العام السابق - مدرسة الكامل الماجستير بسيتاكُند", "bn": "প্রাক্তন রেক্টর - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Former Rector - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "تعرف على المدير العام السابق لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার প্রাক্তন রেক্টর সম্পর্কে জানুন।", "en": "Learn about the former Rector of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "المدير العام السابق، مدرسة سيتاكُند", "bn": "প্রাক্তন রেক্টর, সীতাকুণ্ড মাদ্রাসা", "en": "former rector, sitakund madrasah"}',
	'{"ar": "السبت–الخميس: 8:00 صباحاً – 2:00 مساءً", "bn": "শনি–বৃহস্পতি: সকাল ৮:০০ – দুপুর ২:০০", "en": "Saturday–Thursday: 8:00 AM – 2:00 PM"}',
	'{"ar": "تواصل معنا", "bn": "যোগাযোগ করুন", "en": "Get In Touch"}',
	'{"ar": "هل لديك أسئلة حول القبول أو البرامج أو الحياة الجامعية؟ نحن هنا للمساعدة.", "bn": "ভর্তি, প্রোগ্রাম বা ক্যাম্পাস জীবন সম্পর্কে প্রশ্ন আছে? আমরা সাহায্য করতে এখানে আছি।", "en": "Have questions about admissions, programs, or campus life? We are here to help."}',
	'site/contact-image.jpg',
	'https://maps.google.com/maps?q=Sitakund+Kamil+Madrasah&output=embed',
	'{"ar": "اتصل بنا", "bn": "যোগাযোগ করুন", "en": "Contact Us"}',
	'site/contact-breadcrumb.jpg',
	'{"ar": "اتصل - مدرسة الكامل الماجستير بسيتاكُند", "bn": "যোগাযোগ - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Contact - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "ابحث عن معلومات الاتصال وموقع مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার যোগাযোগ তথ্য ও অবস্থান খুঁজুন।", "en": "Find the contact information and location of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "الاتصال، مدرسة سيتاكُند، العنوان، الهاتف", "bn": "যোগাযোগ, সীতাকুণ্ড মাদ্রাসা, ঠিকানা, ফোন", "en": "contact, sitakund madrasah, address, phone"}',
	'{"ar": "العنوان", "bn": "ঠিকানা", "en": "Address"}',
	'{"ar": "طريق داكا-تشيتاغونغ الرئيسي، سيتاكُند - 4310، تشيتاغونغ، بنغلاديش", "bn": "ঢাকা-চট্টগ্রাম মহাসড়ক, সীতাকুণ্ড - ৪৩১০, চট্টগ্রাম, বাংলাদেশ", "en": "Dhaka-Chattogram Trunk Road, Sitakund - 4310, Chattogram, Bangladesh"}',
	'{"ar": "الهاتف", "bn": "ফোন", "en": "Phone"}',
	'{"ar": "+8801819-000000", "bn": "+8801819-000000", "en": "+8801819-000000"}',
	'{"ar": "البريد الإلكتروني", "bn": "ইমেইল", "en": "Email"}',
	'{"ar": "info@sitakundmadrasah.edu.bd", "bn": "info@sitakundmadrasah.edu.bd", "en": "info@sitakundmadrasah.edu.bd"}',
	'{"ar": "ساعات العمل", "bn": "অফিস সময়", "en": "Office Hours"}',
	'{"ar": "روابط سريعة", "bn": "দ্রুত লিঙ্ক", "en": "Quick Links"}',
	'[{"url": "/about", "label": {"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}}, {"url": "/faq", "label": {"ar": "الأسئلة الشائعة", "bn": "সাধারণ প্রশ্ন", "en": "FAQ\'s"}}, {"url": "/testimonials", "label": {"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}}, {"url": "#", "label": {"ar": "سياسة القبول", "bn": "ভর্তি নীতি", "en": "Admission Policy"}}, {"url": "#", "label": {"ar": "سياسة الخصوصية", "bn": "গোপনীয়তা নীতি", "en": "Privacy Policy"}}, {"url": "/notices", "label": {"ar": "آخر الإشعارات", "bn": "সর্বশেষ বিজ্ঞপ্তি", "en": "Latest Notices"}}]',
	'{"ar": "حرمنا الجامعي", "bn": "আমাদের ক্যাম্পাস", "en": "Our Campus"}',
	'[{"url": "#", "label": {"ar": "سلامة الحرم الجامعي", "bn": "ক্যাম্পাস নিরাপত্তা", "en": "Campus Safety"}}, {"url": "#", "label": {"ar": "أنشطة الطلاب", "bn": "শিক্ষার্থী কার্যক্রম", "en": "Student Activities"}}, {"url": "#", "label": {"ar": "القسم الأكاديمي", "bn": "একাডেমিক বিভাগ", "en": "Academic Department"}}, {"url": "#", "label": {"ar": "المهجع والإقامة", "bn": "হোস্টেল ও আবাসন", "en": "Hostel & Accommodation"}}, {"url": "#", "label": {"ar": "المكتبة", "bn": "পাঠাগার", "en": "Library"}}, {"url": "#", "label": {"ar": "برنامج الحفظ", "bn": "হাফেজিয়া প্রোগ্রাম", "en": "Hafeziya Program"}}]',
	'{"ar": "النشرة الإخبارية", "bn": "নিউজলেটার", "en": "Newsletter"}',
	'{"ar": "اشترك لتلقي آخر الأخبار والإشعارات والتحديثات من مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার সর্বশেষ সংবাদ, বিজ্ঞপ্তি ও আপডেট পেতে সাবস্ক্রাইব করুন।", "en": "Subscribe to receive the latest news, notices, and updates from Sitakund Kamil M.A Madrasah."}',
	1,
	'{"ar": "آخر الإشعارات", "bn": "সর্বশেষ বিজ্ঞপ্তি", "en": "Latest Notices"}',
	5,
	1,
	'{"ar": "وزير التعليم", "bn": "শিক্ষামন্ত্রী", "en": "Education Minister"}',
	NULL,
	'{"ar": "معالي وزير التعليم", "bn": "মাননীয় শিক্ষামন্ত্রী", "en": "Honorable Education Minister"}',
	'{"ar": "وزير التعليم", "bn": "শিক্ষামন্ত্রী", "en": "Minister of Education"}',
	'{"ar": "عرض الملف", "bn": "প্রোফাইল দেখুন", "en": "View Profile"}',
	NULL,
	1,
	'{"ar": "أمين التعليم", "bn": "শিক্ষা সচিব", "en": "Education Secretary"}',
	NULL,
	'{"ar": "معالي أمين التعليم", "bn": "মাননীয় শিক্ষা সচিব", "en": "Honorable Education Secretary"}',
	'{"ar": "أمين وزارة التعليم", "bn": "শিক্ষা মন্ত্রণালয়ের সচিব", "en": "Secretary, Ministry of Education"}',
	'{"ar": "عرض الملف", "bn": "প্রোফাইল দেখুন", "en": "View Profile"}',
	NULL,
	1,
	'{"ar": "المدير", "bn": "অধ্যক্ষ", "en": "Principal"}',
	'{"ar": "عرض الملف", "bn": "প্রোফাইল দেখুন", "en": "View Profile"}',
	1,
	'{"ar": "نائب المدير", "bn": "উপাধ্যক্ষ", "en": "Vice Principal"}',
	NULL,
	'{"ar": "نائب المدير", "bn": "উপাধ্যক্ষ", "en": "Vice Principal"}',
	'{"ar": "نائب المدير", "bn": "উপাধ্যক্ষ", "en": "Vice Principal"}',
	'{"ar": "عرض الملف", "bn": "প্রোফাইল দেখুন", "en": "View Profile"}',
	NULL,
	1,
	'{"ar": "التقويم الأكاديمي", "bn": "একাডেমিক ক্যালেন্ডার", "en": "Academic Calendar"}',
	NULL,
	'{"ar": "قائمة الطلاب", "bn": "শিক্ষার্থী তালিকা", "en": "Student List"}',
	'{"ar": "قائمة الطلاب - مدرسة الكامل الماجستير بسيتاكُند", "bn": "শিক্ষার্থী তালিকা - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Student List - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "اطلع على قائمة الطلاب الكاملة لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার সম্পূর্ণ শিক্ষার্থী তালিকা দেখুন।", "en": "View the complete student list of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "قائمة الطلاب، مدرسة سيتاكُند", "bn": "শিক্ষার্থী তালিকা, সীতাকুণ্ড মাদ্রাসা", "en": "student list, sitakund madrasah"}',
	NULL,
	'{"ar": "الرسوم الدراسية", "bn": "বেতন ও ফি", "en": "Tuition Fees"}',
	'{"ar": "الرسوم الدراسية - مدرسة الكامل الماجستير بسيتاكُند", "bn": "বেতন ও ফি - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Tuition Fees - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "اطلع على هيكل الرسوم الدراسية لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার বেতন ও ফি কাঠামো দেখুন।", "en": "View the tuition fee structure of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "الرسوم الدراسية، مدرسة سيتاكُند", "bn": "বেতন ও ফি, সীতাকুণ্ড মাদ্রাসা", "en": "tuition fees, sitakund madrasah"}',
	'{"ar": "<p>يتفاوت هيكل الرسوم الدراسية لمدرسة الكامل الماجستير بسيتاكُند حسب مستوى البرنامج. يُرجى التواصل مع المكتب للحصول على أحدث جدول للرسوم أو زيارتنا خلال ساعات العمل.</p>", "bn": "<p>সীতাকুণ্ড কামিল এম.এ মাদ্রাসার বেতন ও ফি কাঠামো প্রোগ্রামের স্তর অনুযায়ী পরিবর্তিত হয়। সর্বশেষ ফি তফসিলের জন্য অফিসে যোগাযোগ করুন বা অফিস সময়ে আমাদের কাছে আসুন।</p>", "en": "<p>The tuition fee structure for Sitakund Kamil M.A Madrasah varies by program level. Please contact the office for the latest fee schedule or visit us during office hours.</p>"}',
	NULL,
	'{"ar": "نتائج الامتحانات", "bn": "পরীক্ষার ফলাফল", "en": "Exam Results"}',
	'{"ar": "نتائج الامتحانات - مدرسة الكامل الماجستير بسيتاكُند", "bn": "পরীক্ষার ফলাফল - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Exam Results - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "تحقق من نتائج امتحانات مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার পরীক্ষার ফলাফল দেখুন।", "en": "Check exam results of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "نتائج الامتحانات، مدرسة سيتاكُند", "bn": "পরীক্ষার ফলাফল, সীতাকুণ্ড মাদ্রাসা", "en": "exam results, sitakund madrasah"}',
	NULL,
	'{"ar": "النتائج الأكاديمية", "bn": "একাডেমিক ফলাফল", "en": "Academic Results"}',
	'{"ar": "النتائج الأكاديمية - مدرسة الكامل الماجستير بسيتاكُند", "bn": "একাডেমিক ফলাফল - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Academic Results - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "اطلع على النتائج الأكاديمية لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার একাডেমিক ফলাফল দেখুন।", "en": "View academic results of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "النتائج الأكاديمية، مدرسة سيتاكُند", "bn": "একাডেমিক ফলাফল, সীতাকুণ্ড মাদ্রাসা", "en": "academic results, sitakund madrasah"}',
	NULL,
	'{"ar": "نتائج التقييم", "bn": "মূল্যায়ন ফলাফল", "en": "Evaluation Results"}',
	'{"ar": "نتائج التقييم - مدرسة الكامل الماجستير بسيتاكُند", "bn": "মূল্যায়ন ফলাফল - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Evaluation Results - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "اطلع على نتائج التقييم لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার মূল্যায়ন ফলাফল দেখুন।", "en": "View evaluation results of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "نتائج التقييم، مدرسة سيتاكُند", "bn": "মূল্যায়ন ফলাফল, সীতাকুণ্ড মাদ্রাসা", "en": "evaluation results, sitakund madrasah"}',
	NULL,
	'{"ar": "نتائج امتحانات المجلس", "bn": "বোর্ড পরীক্ষার ফলাফল", "en": "Board Exam Results"}',
	'{"ar": "نتائج امتحانات المجلس - مدرسة الكامل الماجستير بسيتاكُند", "bn": "বোর্ড পরীক্ষার ফলাফল - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Board Exam Results - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "تحقق من نتائج امتحانات المجلس لمدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার বোর্ড পরীক্ষার ফলাফল দেখুন।", "en": "Check board exam results of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "امتحانات المجلس، مدرسة سيتاكُند", "bn": "বোর্ড পরীক্ষা, সীতাকুণ্ড মাদ্রাসা", "en": "board exam, sitakund madrasah"}');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.sliders
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` json DEFAULT NULL,
  `title` json NOT NULL,
  `highlight` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `button_text` json DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button2_text` json DEFAULT NULL,
  `button2_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.sliders: ~3 rows (approximately)
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` (`id`, `image`, `sub_title`, `title`, `highlight`, `description`, `button_text`, `button_url`, `button2_text`, `button2_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, 'site/sliders/slider-1.jpg',
	'{"ar": "تأسست 1886 | سيتاكُند، تشيتاغونغ", "bn": "প্রতিষ্ঠিত ১৮৮৬ | সীতাকুণ্ড, চট্টগ্রাম", "en": "Est. 1886 | Sitakund, Chattogram"}',
	'{"ar": "138 عاماً من التميز الإسلامي", "bn": "ইসলামী শ্রেষ্ঠত্বের ১৩৮ বছর", "en": "138 Years of Islamic Excellence"}',
	'{"ar": "138 عاماً", "bn": "১৩৮ বছর", "en": "138 Years"}',
	'{"ar": "مدرسة الكامل الماجستير بسيتاكُند — تُخرّج العلماء والقادة منذ 1886. انضم إلى عائلتنا وانطلق في رحلة من الإيمان والعلم والتميز.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা — ১৮৮৬ সাল থেকে আলেম ও নেতৃবৃন্দ গড়ে তুলছে। আমাদের পরিবারে যোগ দিন এবং বিশ্বাস, জ্ঞান ও শ্রেষ্ঠত্বের যাত্রায় অংশ নিন।", "en": "Sitakund Kamil M.A Madrasah — nurturing scholars and leaders since 1886. Join our family and embark on a journey of faith, knowledge, and excellence."}',
	'{"ar": "قدم الآن", "bn": "এখনই আবেদন করুন", "en": "Apply Now"}',
	'#',
	'{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}',
	'/about',
	1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, 'site/sliders/slider-2.jpg',
	'{"ar": "الداخل | العالم | الفاضل | الكامل الماجستير", "bn": "দাখিল | আলিম | ফাজিল | কামিল এম.এ", "en": "Dakhil | Alim | Fazil | Kamil M.A"}',
	'{"ar": "برامج التعليم الإسلامي الشاملة", "bn": "ব্যাপক ইসলামী শিক্ষা প্রোগ্রাম", "en": "Comprehensive Islamic Education Programs"}',
	'{"ar": "برامج التعليم", "bn": "শিক্ষা প্রোগ্রাম", "en": "Education Programs"}',
	'{"ar": "من الداخل إلى الكامل الماجستير — نقدم طيفاً كاملاً من التعليم الإسلامي والحديث المعترف به من قِبل مجلس تعليم المدارس في بنغلاديش.", "bn": "দাখিল থেকে কামিল এম.এ — আমরা বাংলাদেশ মাদ্রাসা শিক্ষা বোর্ড কর্তৃক স্বীকৃত ইসলামী ও আধুনিক শিক্ষার সম্পূর্ণ বর্ণালী প্রদান করি।", "en": "From Dakhil to Kamil M.A — we offer a complete spectrum of Islamic and modern education recognized by the Bangladesh Madrasah Education Board."}',
	'{"ar": "استكشف البرامج", "bn": "প্রোগ্রাম দেখুন", "en": "Explore Programs"}',
	'/courses',
	'{"ar": "اتصل بنا", "bn": "যোগাযোগ করুন", "en": "Contact Us"}',
	'/contact',
	1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, 'site/sliders/slider-3.jpg',
	'{"ar": "منذ 1976 | برنامج حفظ القرآن", "bn": "১৯৭৬ থেকে | কুরআন হিফজ প্রোগ্রাম", "en": "Since 1976 | Quran Memorization Program"}',
	'{"ar": "حفظ القرآن وبرنامج الحفظ", "bn": "কুরআন হিফজ ও হাফেজিয়া প্রোগ্রাম", "en": "Quran Memorization & Hafeziya Program"}',
	'{"ar": "برنامج الحفظ", "bn": "হাফেজিয়া প্রোগ্রাম", "en": "Hafeziya Program"}',
	'{"ar": "أنتج برنامج الحفظ المتخصص لدينا، الذي تأسس عام 1976، مئات الحفاظ — حافظي القرآن الكريم — يحملون نور الوحي الإلهي.", "bn": "আমাদের নিবেদিত হাফেজিয়া প্রোগ্রাম, ১৯৭৬ সালে প্রতিষ্ঠিত, শত শত হাফেজ তৈরি করেছে — পবিত্র কুরআনের মুখস্থকারী — যারা ঐশী বাণীর আলো বহন করছেন।", "en": "Our dedicated Hafeziya program, established in 1976, has produced hundreds of Huffaz — memorizers of the Holy Quran — carrying on the light of the divine word."}',
	'{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}',
	'/about',
	'{"ar": "قدم الآن", "bn": "এখনই আবেদন করুন", "en": "Apply Now"}',
	'#',
	1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;

-- Dumping structure for table school_management.staffs
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staffs_user_id_foreign` (`user_id`),
  KEY `staffs_department_id_foreign` (`department_id`),
  CONSTRAINT `staffs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `staffs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.staffs: ~5 rows (approximately)
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
INSERT INTO `staffs` (`id`, `user_id`, `department_id`, `name`, `designation`, `email`, `phone`, `gender`, `religion`, `blood_group`, `serial_no`, `joining_date`, `address`, `photo`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 25, 6, '{"en":"Staff Name 1"}', '{"en":"Administrative Assistant"}', 'staff1@example.com', '01800000001', 'Male', 'Islam', 'O+', '1', '2024-08-15', '{"en":"Staff Address 1"}', NULL, 1, '2026-08-15 02:35:12', '2026-08-15 02:35:12'),
	(2, 26, 6, '{"en":"Staff Name 2"}', '{"en":"Administrative Assistant"}', 'staff2@example.com', '01800000002', 'Male', 'Islam', 'O+', '2', '2024-08-15', '{"en":"Staff Address 2"}', NULL, 1, '2026-08-15 02:35:12', '2026-08-15 02:35:12'),
	(3, 27, 1, '{"en":"Staff Name 3"}', '{"en":"Administrative Assistant"}', 'staff3@example.com', '01800000003', 'Male', 'Islam', 'O+', '3', '2024-08-15', '{"en":"Staff Address 3"}', NULL, 1, '2026-08-15 02:35:12', '2026-08-15 02:35:12'),
	(4, 28, 6, '{"en":"Staff Name 4"}', '{"en":"Administrative Assistant"}', 'staff4@example.com', '01800000004', 'Male', 'Islam', 'O+', '4', '2024-08-15', '{"en":"Staff Address 4"}', NULL, 1, '2026-08-15 02:35:13', '2026-08-15 02:35:13'),
	(5, 29, 4, '{"en":"Staff Name 5"}', '{"en":"Administrative Assistant"}', 'staff5@example.com', '01800000005', 'Male', 'Islam', 'O+', '5', '2024-08-15', '{"en":"Staff Address 5"}', NULL, 1, '2026-08-15 02:35:13', '2026-08-15 02:35:13');
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;

-- Dumping structure for table school_management.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` bigint(20) unsigned DEFAULT NULL,
  `section_id` bigint(20) unsigned DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_relationship` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_address` text COLLATE utf8mb4_unicode_ci,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  PRIMARY KEY (`id`),
  KEY `students_user_id_foreign` (`user_id`),
  CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.students: ~21 rows (approximately)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `user_id`, `first_name`, `last_name`, `father_name`, `mother_name`, `class_id`, `section_id`, `group`, `gender`, `roll_no`, `registration_no`, `blood_group`, `religion`, `admission_number`, `address`, `guardian_name`, `guardian_email`, `guardian_phone`, `guardian_relationship`, `guardian_address`, `picture`, `created_at`, `updated_at`, `status`) VALUES
	(1, 4, 'Quail', 'Sanford', 'Graham Tate', 'Alyssa Hyde', 1, 1, 'A ut molestiae dolor', NULL, 'Nobis et aliquid sun', '114', 'Aperiam eum non labo', 'Reprehenderit qui od', '280', 'Eos earum nesciunt', 'Patricia Valencia', 'dixox@mailinator.com', '+1 (163) 129-7904', 'Odio mollitia harum', NULL, NULL, '2026-08-12 14:33:06', '2026-08-12 14:33:06', 'approved'),
	(2, 5, 'Student', 'Name 1', 'Father Name 1', 'Mother Name 1', 3, 5, 'Science', 'Female', '1', 'REG1001', 'A+', 'Islam', 'ADM1001', 'Address 1', 'Guardian 1', 'guardian1@example.com', '01700000001', 'Father', NULL, NULL, '2026-08-15 02:34:37', '2026-08-15 02:34:37', 'approved'),
	(3, 6, 'Student', 'Name 2', 'Father Name 2', 'Mother Name 2', 5, 9, 'Science', 'Male', '2', 'REG1002', 'A+', 'Islam', 'ADM1002', 'Address 2', 'Guardian 2', 'guardian2@example.com', '01700000002', 'Father', NULL, NULL, '2026-08-15 02:34:37', '2026-08-15 02:34:37', 'approved'),
	(4, 7, 'Student', 'Name 3', 'Father Name 3', 'Mother Name 3', 1, 1, 'Science', 'Female', '3', 'REG1003', 'A+', 'Islam', 'ADM1003', 'Address 3', 'Guardian 3', 'guardian3@example.com', '01700000003', 'Father', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38', 'approved'),
	(5, 8, 'Student', 'Name 4', 'Father Name 4', 'Mother Name 4', 5, 10, 'Science', 'Male', '4', 'REG1004', 'A+', 'Islam', 'ADM1004', 'Address 4', 'Guardian 4', 'guardian4@example.com', '01700000004', 'Father', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38', 'approved'),
	(6, 9, 'Student', 'Name 5', 'Father Name 5', 'Mother Name 5', 4, 7, 'Science', 'Female', '5', 'REG1005', 'A+', 'Islam', 'ADM1005', 'Address 5', 'Guardian 5', 'guardian5@example.com', '01700000005', 'Father', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38', 'approved'),
	(7, 10, 'Student', 'Name 6', 'Father Name 6', 'Mother Name 6', 4, 8, 'Science', 'Male', '6', 'REG1006', 'A+', 'Islam', 'ADM1006', 'Address 6', 'Guardian 6', 'guardian6@example.com', '01700000006', 'Father', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38', 'approved'),
	(8, 11, 'Student', 'Name 7', 'Father Name 7', 'Mother Name 7', 1, 1, 'Science', 'Female', '7', 'REG1007', 'A+', 'Islam', 'ADM1007', 'Address 7', 'Guardian 7', 'guardian7@example.com', '01700000007', 'Father', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39', 'approved'),
	(9, 12, 'Student', 'Name 8', 'Father Name 8', 'Mother Name 8', 3, 6, 'Science', 'Male', '8', 'REG1008', 'A+', 'Islam', 'ADM1008', 'Address 8', 'Guardian 8', 'guardian8@example.com', '01700000008', 'Father', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39', 'approved'),
	(10, 13, 'Student', 'Name 9', 'Father Name 9', 'Mother Name 9', 2, 3, 'Science', 'Female', '9', 'REG1009', 'A+', 'Islam', 'ADM1009', 'Address 9', 'Guardian 9', 'guardian9@example.com', '01700000009', 'Father', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39', 'approved'),
	(11, 14, 'Student', 'Name 10', 'Father Name 10', 'Mother Name 10', 4, 8, 'Science', 'Male', '10', 'REG1010', 'A+', 'Islam', 'ADM1010', 'Address 10', 'Guardian 10', 'guardian10@example.com', '01700000010', 'Father', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39', 'approved'),
	(12, 15, 'Student', 'Name 11', 'Father Name 11', 'Mother Name 11', 1, 2, 'Science', 'Female', '11', 'REG1011', 'A+', 'Islam', 'ADM1011', 'Address 11', 'Guardian 11', 'guardian11@example.com', '01700000011', 'Father', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40', 'approved'),
	(13, 16, 'Student', 'Name 12', 'Father Name 12', 'Mother Name 12', 3, 5, 'Science', 'Male', '12', 'REG1012', 'A+', 'Islam', 'ADM1012', 'Address 12', 'Guardian 12', 'guardian12@example.com', '01700000012', 'Father', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40', 'approved'),
	(14, 17, 'Student', 'Name 13', 'Father Name 13', 'Mother Name 13', 2, 3, 'Science', 'Female', '13', 'REG1013', 'A+', 'Islam', 'ADM1013', 'Address 13', 'Guardian 13', 'guardian13@example.com', '01700000013', 'Father', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40', 'approved'),
	(15, 18, 'Student', 'Name 14', 'Father Name 14', 'Mother Name 14', 5, 10, 'Science', 'Male', '14', 'REG1014', 'A+', 'Islam', 'ADM1014', 'Address 14', 'Guardian 14', 'guardian14@example.com', '01700000014', 'Father', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40', 'approved'),
	(16, 19, 'Student', 'Name 15', 'Father Name 15', 'Mother Name 15', 4, 8, 'Science', 'Female', '15', 'REG1015', 'A+', 'Islam', 'ADM1015', 'Address 15', 'Guardian 15', 'guardian15@example.com', '01700000015', 'Father', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41', 'approved'),
	(17, 20, 'Student', 'Name 16', 'Father Name 16', 'Mother Name 16', 4, 8, 'Science', 'Male', '16', 'REG1016', 'A+', 'Islam', 'ADM1016', 'Address 16', 'Guardian 16', 'guardian16@example.com', '01700000016', 'Father', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41', 'approved'),
	(18, 21, 'Student', 'Name 17', 'Father Name 17', 'Mother Name 17', 1, 2, 'Science', 'Female', '17', 'REG1017', 'A+', 'Islam', 'ADM1017', 'Address 17', 'Guardian 17', 'guardian17@example.com', '01700000017', 'Father', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41', 'approved'),
	(19, 22, 'Student', 'Name 18', 'Father Name 18', 'Mother Name 18', 4, 7, 'Science', 'Male', '18', 'REG1018', 'A+', 'Islam', 'ADM1018', 'Address 18', 'Guardian 18', 'guardian18@example.com', '01700000018', 'Father', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41', 'approved'),
	(20, 23, 'Student', 'Name 19', 'Father Name 19', 'Mother Name 19', 2, 3, 'Science', 'Female', '19', 'REG1019', 'A+', 'Islam', 'ADM1019', 'Address 19', 'Guardian 19', 'guardian19@example.com', '01700000019', 'Father', NULL, NULL, '2026-08-15 02:34:42', '2026-08-15 02:34:42', 'approved'),
	(21, 24, 'Student', 'Name 20', 'Father Name 20', 'Mother Name 20', 3, 5, 'Science', 'Male', '20', 'REG1020', 'A+', 'Islam', 'ADM1020', 'Address 20', 'Guardian 20', 'guardian20@example.com', '01700000020', 'Father', NULL, NULL, '2026-08-15 02:34:42', '2026-08-15 02:34:42', 'approved');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table school_management.student_attendances
CREATE TABLE IF NOT EXISTS `student_attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned NOT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `section_id` bigint(20) unsigned NOT NULL,
  `period_id` bigint(20) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_sent` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_attendances_student_id_date_period_id_unique` (`student_id`,`date`,`period_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.student_attendances: ~0 rows (approximately)
/*!40000 ALTER TABLE `student_attendances` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_attendances` ENABLE KEYS */;

-- Dumping structure for table school_management.student_categories
CREATE TABLE IF NOT EXISTS `student_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.student_categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `student_categories` DISABLE KEYS */;
INSERT INTO `student_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Regular', '2026-08-15 02:34:37', '2026-08-15 02:34:37'),
	(2, 'Irregular', '2026-08-15 02:34:37', '2026-08-15 02:34:37'),
	(3, 'Scholarship', '2026-08-15 02:34:37', '2026-08-15 02:34:37');
/*!40000 ALTER TABLE `student_categories` ENABLE KEYS */;

-- Dumping structure for table school_management.student_migrations
CREATE TABLE IF NOT EXISTS `student_migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned NOT NULL,
  `from_class_id` bigint(20) unsigned DEFAULT NULL,
  `from_section_id` bigint(20) unsigned DEFAULT NULL,
  `to_class_id` bigint(20) unsigned DEFAULT NULL,
  `to_section_id` bigint(20) unsigned DEFAULT NULL,
  `academic_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `migration_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_migrations_student_id_foreign` (`student_id`),
  CONSTRAINT `student_migrations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.student_migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `student_migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_migrations` ENABLE KEYS */;

-- Dumping structure for table school_management.student_optional_subjects
CREATE TABLE IF NOT EXISTS `student_optional_subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint(20) unsigned NOT NULL,
  `optional_subject_config_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_optional_subjects_student_id_foreign` (`student_id`),
  KEY `student_optional_subjects_subject_id_foreign` (`subject_id`),
  CONSTRAINT `student_optional_subjects_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  CONSTRAINT `student_optional_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.student_optional_subjects: ~0 rows (approximately)
/*!40000 ALTER TABLE `student_optional_subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_optional_subjects` ENABLE KEYS */;

-- Dumping structure for table school_management.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_class_id` bigint(20) unsigned DEFAULT NULL,
  `academic_group_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_form` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Compulsory',
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subjects_academic_class_id_foreign` (`academic_class_id`),
  KEY `subjects_academic_group_id_foreign` (`academic_group_id`),
  CONSTRAINT `subjects_academic_class_id_foreign` FOREIGN KEY (`academic_class_id`) REFERENCES `academic_classes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `subjects_academic_group_id_foreign` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.subjects: ~25 rows (approximately)
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`id`, `academic_class_id`, `academic_group_id`, `name`, `code`, `short_form`, `type`, `serial_no`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 'Bangla 1st Paper', '101', 'BNG1', 'mandatory', '1', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(2, 1, 4, 'English 1st Paper', '107', 'ENG1', 'mandatory', '2', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(3, 1, 4, 'General Math', '109', 'MATH', 'mandatory', '3', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(4, 1, 4, 'Physics', '136', 'PHY', 'mandatory', '4', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(5, 1, 4, 'Chemistry', '137', 'CHEM', 'mandatory', '5', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(6, 2, 4, 'Bangla 1st Paper', '101', 'BNG1', 'mandatory', '1', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(7, 2, 4, 'English 1st Paper', '107', 'ENG1', 'mandatory', '2', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(8, 2, 4, 'General Math', '109', 'MATH', 'mandatory', '3', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(9, 2, 4, 'Physics', '136', 'PHY', 'mandatory', '4', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(10, 2, 4, 'Chemistry', '137', 'CHEM', 'mandatory', '5', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(11, 3, 4, 'Bangla 1st Paper', '101', 'BNG1', 'mandatory', '1', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(12, 3, 4, 'English 1st Paper', '107', 'ENG1', 'mandatory', '2', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(13, 3, 4, 'General Math', '109', 'MATH', 'mandatory', '3', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(14, 3, 4, 'Physics', '136', 'PHY', 'mandatory', '4', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(15, 3, 4, 'Chemistry', '137', 'CHEM', 'mandatory', '5', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(16, 4, 4, 'Bangla 1st Paper', '101', 'BNG1', 'mandatory', '1', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(17, 4, 4, 'English 1st Paper', '107', 'ENG1', 'mandatory', '2', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(18, 4, 4, 'General Math', '109', 'MATH', 'mandatory', '3', '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(19, 4, 4, 'Physics', '136', 'PHY', 'mandatory', '4', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(20, 4, 4, 'Chemistry', '137', 'CHEM', 'mandatory', '5', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(21, 5, 4, 'Bangla 1st Paper', '101', 'BNG1', 'mandatory', '1', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(22, 5, 4, 'English 1st Paper', '107', 'ENG1', 'mandatory', '2', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(23, 5, 4, 'General Math', '109', 'MATH', 'mandatory', '3', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(24, 5, 4, 'Physics', '136', 'PHY', 'mandatory', '4', '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(25, 5, 4, 'Chemistry', '137', 'CHEM', 'mandatory', '5', '2026-08-15 02:33:33', '2026-08-15 02:33:33');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;

-- Dumping structure for table school_management.subject_configs
CREATE TABLE IF NOT EXISTS `subject_configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_class_id` bigint(20) unsigned NOT NULL,
  `academic_group_id` bigint(20) unsigned DEFAULT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_configs_academic_class_id_foreign` (`academic_class_id`),
  KEY `subject_configs_academic_group_id_foreign` (`academic_group_id`),
  KEY `subject_configs_subject_id_foreign` (`subject_id`),
  CONSTRAINT `subject_configs_academic_class_id_foreign` FOREIGN KEY (`academic_class_id`) REFERENCES `academic_classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_configs_academic_group_id_foreign` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_configs_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.subject_configs: ~25 rows (approximately)
/*!40000 ALTER TABLE `subject_configs` DISABLE KEYS */;
INSERT INTO `subject_configs` (`id`, `academic_class_id`, `academic_group_id`, `subject_id`, `subject_type`, `serial_no`, `merge_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 1, 'mandatory', '1', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(2, 1, 4, 2, 'mandatory', '2', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(3, 1, 4, 3, 'mandatory', '3', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(4, 1, 4, 4, 'mandatory', '4', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(5, 1, 4, 5, 'mandatory', '5', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(6, 2, 4, 6, 'mandatory', '1', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(7, 2, 4, 7, 'mandatory', '2', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(8, 2, 4, 8, 'mandatory', '3', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(9, 2, 4, 9, 'mandatory', '4', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(10, 2, 4, 10, 'mandatory', '5', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(11, 3, 4, 11, 'mandatory', '1', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(12, 3, 4, 12, 'mandatory', '2', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(13, 3, 4, 13, 'mandatory', '3', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(14, 3, 4, 14, 'mandatory', '4', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(15, 3, 4, 15, 'mandatory', '5', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(16, 4, 4, 16, 'mandatory', '1', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(17, 4, 4, 17, 'mandatory', '2', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(18, 4, 4, 18, 'mandatory', '3', NULL, '2026-08-15 02:33:32', '2026-08-15 02:33:32'),
	(19, 4, 4, 19, 'mandatory', '4', NULL, '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(20, 4, 4, 20, 'mandatory', '5', NULL, '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(21, 5, 4, 21, 'mandatory', '1', NULL, '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(22, 5, 4, 22, 'mandatory', '2', NULL, '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(23, 5, 4, 23, 'mandatory', '3', NULL, '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(24, 5, 4, 24, 'mandatory', '4', NULL, '2026-08-15 02:33:33', '2026-08-15 02:33:33'),
	(25, 5, 4, 25, 'mandatory', '5', NULL, '2026-08-15 02:33:33', '2026-08-15 02:33:33');
/*!40000 ALTER TABLE `subject_configs` ENABLE KEYS */;

-- Dumping structure for table school_management.syllabi
CREATE TABLE IF NOT EXISTS `syllabi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) unsigned DEFAULT NULL,
  `class_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.syllabi: ~0 rows (approximately)
/*!40000 ALTER TABLE `syllabi` DISABLE KEYS */;
/*!40000 ALTER TABLE `syllabi` ENABLE KEYS */;

-- Dumping structure for table school_management.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` json NOT NULL,
  `designation` json DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_intro` json DEFAULT NULL,
  `address` json DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `behance_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` json DEFAULT NULL,
  `skills` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_slug_unique` (`slug`),
  KEY `teachers_user_id_foreign` (`user_id`),
  KEY `teachers_department_id_foreign` (`department_id`),
  CONSTRAINT `teachers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.teachers: ~4 rows (approximately)
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` (`id`, `slug`, `name`, `designation`, `photo`, `short_intro`, `address`, `email`, `phone`, `facebook_url`, `whatsapp_url`, `behance_url`, `pinterest_url`, `linkedin_url`, `biography`, `skills`, `is_active`, `sort_order`, `created_at`, `updated_at`, `user_id`, `department_id`, `gender`, `religion`, `blood_group`, `serial_no`, `joining_date`) VALUES
	(1, 'angela-t-vigil', '{"ar": "أنجيلا تي. فيجيل", "bn": "অ্যাঞ্জেলা টি. ভিজিল", "en": "Angela T. Vigil"}', '{"ar": "أستاذ مشارك", "bn": "সহযোগী অধ্যাপক", "en": "Associate Professor"}', 'site/teachers/angela-t-vigil.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'angela@example.com', '+880 1812-345671', 'https://facebook.com', 'https://wa.me/8801812345678', 'https://behance.net', 'https://pinterest.com', 'https://linkedin.com', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>لقد خدم بإخلاص في مؤسستنا لسنوات عديدة.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>তিনি দীর্ঘদিন ধরে আমাদের প্রতিষ্ঠানে নিষ্ঠার সাথে দায়িত্ব পালন করে আসছেন।</p>", "en": "<p>Sed ut perspiciatis unde omnis totam rem chitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>"}', '[{"label": {"ar": "التواصل", "bn": "যোগাযোগ", "en": "Communication"}, "percentage": "85"}, {"label": {"ar": "العلاقات", "bn": "সম্পর্ক", "en": "Relationship"}, "percentage": "65"}, {"label": {"ar": "العمل الإبداعي", "bn": "সৃজনশীল কাজ", "en": "Creative Work"}, "percentage": "75"}]', 1, 1, '2026-07-23 17:50:38', '2026-08-16 15:12:56', 3, 1, NULL, NULL, 'A+', NULL, NULL),
	(2, 'frank-a-mitchell', '{"ar": "فرانك إيه. ميتشل", "bn": "ফ্র্যাঙ্ক এ. মিচেল", "en": "Frank A. Mitchell"}', '{"ar": "أستاذ مشارك", "bn": "সহযোগী অধ্যাপক", "en": "Associate Professor"}', 'site/teachers/frank-a-mitchell.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'frank@example.com', '+880 1812-345672', 'https://facebook.com', 'https://wa.me/8801812345678', 'https://behance.net', 'https://pinterest.com', 'https://linkedin.com', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>لقد خدم بإخلاص في مؤسستنا لسنوات عديدة.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>তিনি দীর্ঘদিন ধরে আমাদের প্রতিষ্ঠানে নিষ্ঠার সাথে দায়িত্ব পালন করে আসছেন।</p>", "en": "<p>Sed ut perspiciatis unde omnis totam rem chitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>"}', '[{"label": {"ar": "التواصل", "bn": "যোগাযোগ", "en": "Communication"}, "percentage": 85}, {"label": {"ar": "العلاقات", "bn": "সম্পর্ক", "en": "Relationship"}, "percentage": 65}, {"label": {"ar": "العمل الإبداعي", "bn": "সৃজনশীল কাজ", "en": "Creative Work"}, "percentage": 75}]', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 'susan-d-lunsford', '{"ar": "سوزان دي. لونسفورد", "bn": "সুসান ডি. লান্সফোর্ড", "en": "Susan D. Lunsford"}', '{"ar": "الرئيس التنفيذي والمؤسس", "bn": "সিইও ও প্রতিষ্ঠাতা", "en": "CEO & Founder"}', 'site/teachers/susan-d-lunsford.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'susan@example.com', '+880 1812-345673', 'https://facebook.com', 'https://wa.me/8801812345678', 'https://behance.net', 'https://pinterest.com', 'https://linkedin.com', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>لقد خدم بإخلاص في مؤسستنا لسنوات عديدة.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>তিনি দীর্ঘদিন ধরে আমাদের প্রতিষ্ঠানে নিষ্ঠার সাথে দায়িত্ব পালন করে আসছেন।</p>", "en": "<p>Sed ut perspiciatis unde omnis totam rem chitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>"}', '[{"label": {"ar": "التواصل", "bn": "যোগাযোগ", "en": "Communication"}, "percentage": 85}, {"label": {"ar": "العلاقات", "bn": "সম্পর্ক", "en": "Relationship"}, "percentage": 65}, {"label": {"ar": "العمل الإبداعي", "bn": "সৃজনশীল কাজ", "en": "Creative Work"}, "percentage": 75}]', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 'dennis-a-pruitt', '{"ar": "دينيس إيه. برويت", "bn": "ডেনিস এ. প্রুইট", "en": "Dennis A. Pruitt"}', '{"ar": "أستاذ مشارك", "bn": "সহযোগী অধ্যাপক", "en": "Associate Professor"}', 'site/teachers/dennis-a-pruitt.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'dennis@example.com', '+880 1812-345674', 'https://facebook.com', 'https://wa.me/8801812345678', 'https://behance.net', 'https://pinterest.com', 'https://linkedin.com', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>لقد خدم بإخلاص في مؤسستنا لسنوات عديدة.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>তিনি দীর্ঘদিন ধরে আমাদের প্রতিষ্ঠানে নিষ্ঠার সাথে দায়িত্ব পালন করে আসছেন।</p>", "en": "<p>Sed ut perspiciatis unde omnis totam rem chitecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p><p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>"}', '[{"label": {"ar": "التواصل", "bn": "যোগাযোগ", "en": "Communication"}, "percentage": 85}, {"label": {"ar": "العلاقات", "bn": "সম্পর্ক", "en": "Relationship"}, "percentage": 65}, {"label": {"ar": "العمل الإبداعي", "bn": "সৃজনশীল কাজ", "en": "Creative Work"}, "percentage": 75}]', 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;

-- Dumping structure for table school_management.teacher_page_settings
CREATE TABLE IF NOT EXISTS `teacher_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.teacher_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `teacher_page_settings` DISABLE KEYS */;
INSERT INTO `teacher_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "معلمونا", "bn": "আমাদের শিক্ষকবৃন্দ", "en": "Our Teachers"}', '{"ar": "تعرف على هيئة تدريسنا المتفانية", "bn": "আমাদের নিবেদিতপ্রাণ শিক্ষকমণ্ডলীর সাথে পরিচিত হন", "en": "Meet Our Dedicated Faculty"}', '{"ar": "هيئة التدريس", "bn": "শিক্ষকমণ্ডলী", "en": "Faculty"}', '{"ar": "معلمونا المؤهلون والمتمرسون مكرسون للتطوير الأكاديمي والروحي لكل طالب.", "bn": "আমাদের যোগ্য ও অভিজ্ঞ শিক্ষকরা প্রতিটি শিক্ষার্থীর একাডেমিক ও আধ্যাত্মিক বিকাশে নিবেদিত।", "en": "Our qualified and experienced teachers are dedicated to the academic and spiritual development of every student."}', '{"ar": "المعلمون", "bn": "শিক্ষকবৃন্দ", "en": "Teachers"}', 'site/teacher-breadcrumb.jpg', '{"ar": "المعلمون - مدرسة الكامل الماجستير بسيتاكُند", "bn": "শিক্ষকবৃন্দ - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Teachers - Sitakund Kamil M.A Madrasah"}', '{"ar": "تعرف على معلمي وموظفي مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার শিক্ষক ও কর্মীদের সাথে পরিচিত হন।", "en": "Meet the teachers and staff of Sitakund Kamil M.A Madrasah."}', '{"ar": "معلمون، أعضاء هيئة التدريس، مدرسة سيتاكُند", "bn": "শিক্ষক, অনুষদ, সীতাকুণ্ড মাদ্রাসা", "en": "teachers, faculty, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `teacher_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quote` json NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL DEFAULT '5',
  `author_name` json NOT NULL,
  `author_role` json DEFAULT NULL,
  `author_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.testimonials: ~5 rows (approximately)
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` (`id`, `quote`, `rating`, `author_name`, `author_role`, `author_photo`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "أعطتني مدرسة الكامل الماجستير بسيتاكُند ليس المعرفة فحسب، بل الحكمة والشخصية أيضاً. والأساس الإسلامي الذي تلقيته هنا وجّه كل قرار في حياتي.", "bn": "সীতাকuণ্ড কামিল এম.এ মাদ্রাসা আমাকে শুধু জ্ঞান নয়, জ্ঞান ও চরিত্র দিয়েছে। এখান থেকে পাওয়া ইসলামী ভিত্তি আমার জীবনের প্রতিটি সিদ্ধান্তকে পথ দেখিয়েছে।", "en": "Sitakund Kamil M.A Madrasah gave me not just knowledge, but wisdom and character. The Islamic foundation I received here has guided every decision in my life."}', 5, '{"ar": "محمد إقبال حسين", "bn": "মোহাম্মদ ইকবাল হোসাইন", "en": "Mohammad Ikbal Hossain"}', '{"ar": "خريج، حامل كامل الماجستير", "bn": "প্রাক্তন ছাত্র, কামিল এম.এ স্নাতক", "en": "Alumni, Kamil M.A Graduate"}', 'site/testimonials/alumni-1.jpg', 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, '{"ar": "المعلمون هنا استثنائيون — متعمقون في العلوم الإسلامية ومتفانون في دعم نجاح كل طالب.", "bn": "এখানকার শিক্ষকরা অসাধারণ — ইসলামী বিজ্ঞানে গভীরভাবে জ্ঞানী এবং প্রতিটি শিক্ষার্থীর সাফল্যের প্রতি নিবেদিতপ্রাণ।", "en": "The teachers here are extraordinary — deeply knowledgeable in Islamic sciences yet approachable and dedicated to every student\\\'s success."}', 5, '{"ar": "فاطمة أختر", "bn": "ফাতেমা আক্তার", "en": "Fatema Akter"}', '{"ar": "ولي أمر طالب حالي", "bn": "বর্তমান শিক্ষার্থীর অভিভাবক", "en": "Parent of Current Student"}', 'site/testimonials/parent-1.jpg', 1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, '{"ar": "أنا فخور بأنني حفظت القرآن في برنامج الحفظ بهذه المؤسسة. البيئة الروحية هنا لا مثيل لها في أي مكان آخر.", "bn": "এই প্রতিষ্ঠানের হাফেজিয়া প্রোগ্রামে কুরআন মুখস্থ করতে পেরে আমি গর্বিত। এখানকার আধ্যাত্মিক পরিবেশ অন্য কোথাও নেই।", "en": "I am proud to have memorized the Quran at the Hafeziya program of this institution. The spiritual environment here is unlike anywhere else."}', 5, '{"ar": "حافظ عبدالله المأمون", "bn": "হাফেজ আবদুল্লাহ আল-মামুন", "en": "Hafez Abdullah Al-Mamun"}', '{"ar": "خريج برنامج الحفظ", "bn": "হাফেজিয়া স্নাতক", "en": "Hafeziya Graduate"}', 'site/testimonials/alumni-2.jpg', 1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;

-- Dumping structure for table school_management.testimonial_page_settings
CREATE TABLE IF NOT EXISTS `testimonial_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_tagline` json DEFAULT NULL,
  `section_title` json DEFAULT NULL,
  `section_highlight` json DEFAULT NULL,
  `section_description` json DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.testimonial_page_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `testimonial_page_settings` DISABLE KEYS */;
INSERT INTO `testimonial_page_settings` (`id`, `section_tagline`, `section_title`, `section_highlight`, `section_description`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
	(1, '{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}', '{"ar": "ماذا يقول خريجونا", "bn": "আমাদের প্রাক্তনীরা কী বলেন", "en": "What Our Alumni Say"}', '{"ar": "الخريجون", "bn": "প্রাক্তনী", "en": "Alumni"}', '{"ar": "استمع إلى خريجينا وأولياء الأمور حول تجربتهم في مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসায় তাদের অভিজ্ঞতা সম্পর্কে আমাদের স্নাতক ও অভিভাবকদের কাছ থেকে শুনুন।", "en": "Hear from our graduates and parents about their experience at Sitakund Kamil M.A Madrasah."}', '{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}', 'site/testimonial-breadcrumb.jpg', '{"ar": "الشهادات - مدرسة الكامل الماجستير بسيتاكُند", "bn": "প্রশংসাপত্র - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Testimonials - Sitakund Kamil M.A Madrasah"}', '{"ar": "انظر ما يقوله الخريجون وأولياء الأمور عن مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসা সম্পর্কে প্রাক্তনী ও অভিভাবকরা কী বলেন তা দেখুন।", "en": "See what alumni and parents say about Sitakund Kamil M.A Madrasah."}', '{"ar": "شهادات، خريجون، مدرسة سيتاكُند", "bn": "প্রশংসাপত্র, প্রাক্তনী, সীতাকুণ্ড মাদ্রাসা", "en": "testimonials, alumni, sitakund madrasah"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
/*!40000 ALTER TABLE `testimonial_page_settings` ENABLE KEYS */;

-- Dumping structure for table school_management.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.users: ~29 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', '2026-07-23 17:50:37', '$2y$12$oXjBEyXKPO1O3UnTfX2F5.0XKS/T0ft3/vyg.5zso06tuJ7jaYC4i', NULL, NULL, NULL, 'kYzMzdT6hi8rOIVkDcyHkjrBwUy6tNJuhdfdOwQiWMmoXFRC1xaOOzxJcKml', NULL, NULL, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, 'Sydur', 'admin@admin.com', NULL, '$2y$12$JSgpvCUWgCw2lr8tYG2VY.lhgPnYoZX0rTFUO5BaYnC1fnE9fTx12', NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-24 14:15:02', '2026-07-24 14:15:02'),
	(3, 'Angela T. Vigil', 'angela@example.com', NULL, '$2y$12$dlmiEyXPWwVPp8FoXyKpZeD0u0GvzaDouIiCCyakNu3he0qwrUqIS', NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-10 13:25:46', '2026-08-16 15:12:56'),
	(4, 'Quail Sanford', 'student@admin.com', NULL, '$2y$12$I10oQQboWkW304BoWyuqGeWBi8BeLMclU5ImzSLy6NvOmqEea5Bse', NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-12 14:33:06', '2026-08-16 15:12:00'),
	(5, 'Student Name 1', 'student1@example.com', '2026-08-15 02:34:37', '$2y$12$M7mKo1PSofByZpIovJqJ4O/KykmtdUI9OqT8PUEBBojQUEvpotFmC', NULL, NULL, NULL, 'OZHSFdUf2M', NULL, NULL, '2026-08-15 02:34:37', '2026-08-15 02:34:37'),
	(6, 'Student Name 2', 'student2@example.com', '2026-08-15 02:34:37', '$2y$12$0UmCq9wXItLtr0FdrZ16z.Flg//JSQTdmXTo50Kkvo788L3qVAF7i', NULL, NULL, NULL, 'qE77qPThDS', NULL, NULL, '2026-08-15 02:34:37', '2026-08-15 02:34:37'),
	(7, 'Student Name 3', 'student3@example.com', '2026-08-15 02:34:38', '$2y$12$mO3PuZ9RjUprHF3dOaZrJ./ZmHC1p1LSB2j6dyxCXJfAnyvtoxkhi', NULL, NULL, NULL, 'kMizOkvUDf', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38'),
	(8, 'Student Name 4', 'student4@example.com', '2026-08-15 02:34:38', '$2y$12$lfe3GqZZ9cUjbxQdMx.MyOVb2mzOHiEvibCbzWFRJ9k9i61Gi409e', NULL, NULL, NULL, '07ygDYg9Bc', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38'),
	(9, 'Student Name 5', 'student5@example.com', '2026-08-15 02:34:38', '$2y$12$UmRrVfSDOxsygEc74deM3.x/5pJrUnbPcuyn44t4XBHrkLmYC.YVW', NULL, NULL, NULL, '5iG7siABXi', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38'),
	(10, 'Student Name 6', 'student6@example.com', '2026-08-15 02:34:38', '$2y$12$cgjRfJIMGQ90ho5Ze3Cx9uTZcrGrqs42HJ9GaE4vPXQiRPyncm/iW', NULL, NULL, NULL, 'T2HU1xcaHY', NULL, NULL, '2026-08-15 02:34:38', '2026-08-15 02:34:38'),
	(11, 'Student Name 7', 'student7@example.com', '2026-08-15 02:34:39', '$2y$12$u1cLtcR3UHTvHigcDOt02OPcckSH17jcPlvTkf1yitD4QvZlnl5Z2', NULL, NULL, NULL, 'vw9Pjf6mFE', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39'),
	(12, 'Student Name 8', 'student8@example.com', '2026-08-15 02:34:39', '$2y$12$ATh8Lretqlc8r6mp.88lu.Www9eZCnoRComrQuVX8gGyTNGJyTl7u', NULL, NULL, NULL, 'w9N5BiXpy8', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39'),
	(13, 'Student Name 9', 'student9@example.com', '2026-08-15 02:34:39', '$2y$12$hBQ1naFkc.MJ4MuKLnElG.J/M9BaOhuIdvy3fBKdzcyp3wIaUknx.', NULL, NULL, NULL, '4FhesyVnqJ', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39'),
	(14, 'Student Name 10', 'student10@example.com', '2026-08-15 02:34:39', '$2y$12$yKcGpPe008Ku2wZOhYVKhO4R13zuMcEJw5qrohOs..yvyP.26j7dy', NULL, NULL, NULL, 'lfUVNdiqDh', NULL, NULL, '2026-08-15 02:34:39', '2026-08-15 02:34:39'),
	(15, 'Student Name 11', 'student11@example.com', '2026-08-15 02:34:40', '$2y$12$Y8d0GtDZLThGAEUzTxc8lugaDZ0gX6evX8Y8ce3P6rur8glFhOP0a', NULL, NULL, NULL, 'bOqspaN9mP', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40'),
	(16, 'Student Name 12', 'student12@example.com', '2026-08-15 02:34:40', '$2y$12$zoBS6lCih3OrzDbuYq0beOD.eCryT1ujYBOl4aZEFxh4Kw4/uvM5C', NULL, NULL, NULL, 'AvmIynJZpZ', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40'),
	(17, 'Student Name 13', 'student13@example.com', '2026-08-15 02:34:40', '$2y$12$4KfsYL.CKLB08Q8Dj853R.CH7rbAkGCJPfXA02K9cE1vUMPqaU0Cu', NULL, NULL, NULL, 'p0es6wQ3Gr', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40'),
	(18, 'Student Name 14', 'student14@example.com', '2026-08-15 02:34:40', '$2y$12$MjecvXGmofloK6Hq.wEgy.kAaBHCZbXyBbWZttZd5leFPJUKWDvmu', NULL, NULL, NULL, 'mtp0oF3weT', NULL, NULL, '2026-08-15 02:34:40', '2026-08-15 02:34:40'),
	(19, 'Student Name 15', 'student15@example.com', '2026-08-15 02:34:41', '$2y$12$4zdIqXZ2LrWr0t7Ywd.Rpub4WWNfv3RQf7xq3jLtHnXoMCETUf70m', NULL, NULL, NULL, 'n4geJMMdYx', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41'),
	(20, 'Student Name 16', 'student16@example.com', '2026-08-15 02:34:41', '$2y$12$Dkws9bYOvDtDf/nvQo9.rODDsbr3k7ZJOM3MmHe3KSUa4treqgZwG', NULL, NULL, NULL, 'nLZg0ek9bo', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41'),
	(21, 'Student Name 17', 'student17@example.com', '2026-08-15 02:34:41', '$2y$12$PwJVZwFEFHIQ9QG.H7TJzOGxyG5tjBVXwi5YCsKJMEvsWWkX4Movi', NULL, NULL, NULL, 'i9Q72SNWJv', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41'),
	(22, 'Student Name 18', 'student18@example.com', '2026-08-15 02:34:41', '$2y$12$YsohMpfUTXx0g00nqz8pkeo5Q1WVXX7I5btWt9nH217V7.qzRodSm', NULL, NULL, NULL, 'jWrhABpWcW', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41'),
	(23, 'Student Name 19', 'student19@example.com', '2026-08-15 02:34:41', '$2y$12$qEoC4MLP5ks91wbKzu6qc.T8n1vm7WJq5ljE1GzHKDKkS4tmVw2xe', NULL, NULL, NULL, 'QRDv83isDl', NULL, NULL, '2026-08-15 02:34:41', '2026-08-15 02:34:41'),
	(24, 'Student Name 20', 'student20@example.com', '2026-08-15 02:34:42', '$2y$12$/KPSHpQRvu8hgrKhE76RGePdIm0j6GxZq3g0Og3pDDXhrJ6/RP/Bi', NULL, NULL, NULL, 'HeHV7tdU35', NULL, NULL, '2026-08-15 02:34:42', '2026-08-15 02:34:42'),
	(25, 'Staff Name 1', 'staff1@example.com', '2026-08-15 02:35:12', '$2y$12$w77bAKzzhnK8yYdbCIOosO1bFgSiV4OZEulVsGYCg8x2Hsi.bBUAe', NULL, NULL, NULL, 'PgWjJtFxZ0', NULL, NULL, '2026-08-15 02:35:12', '2026-08-15 02:35:12'),
	(26, 'Staff Name 2', 'staff2@example.com', '2026-08-15 02:35:12', '$2y$12$Cr1OQoratDHZAn/fBsUBpOCNG5P9B5g7INAUsUbvpv43L4fovP/cq', NULL, NULL, NULL, 'fFbSEjbPna', NULL, NULL, '2026-08-15 02:35:12', '2026-08-15 02:35:12'),
	(27, 'Staff Name 3', 'staff3@example.com', '2026-08-15 02:35:12', '$2y$12$b.hniKmtHwaaA4n2cD5Grem7UCJDpQHlrAQZjLAaeuAhtHnxC/qAm', NULL, NULL, NULL, '5koOAjNOlO', NULL, NULL, '2026-08-15 02:35:12', '2026-08-15 02:35:12'),
	(28, 'Staff Name 4', 'staff4@example.com', '2026-08-15 02:35:13', '$2y$12$B2DtwBn6Dx5KT7V6h934oeL7CZE.T.ftJe8vSxK3xTSx7i47.SiXi', NULL, NULL, NULL, 'TOH80bUkxf', NULL, NULL, '2026-08-15 02:35:13', '2026-08-15 02:35:13'),
	(29, 'Staff Name 5', 'staff5@example.com', '2026-08-15 02:35:13', '$2y$12$JHfv8tZzLT.TTYE2we629.XqCCZQ2h2Q6DFxriYTwuNCpbq1xvxNO', NULL, NULL, NULL, 'ownfnLmjld', NULL, NULL, '2026-08-15 02:35:13', '2026-08-15 02:35:13'),
	(30, 'Admin Test', 'admin@test.com', NULL, '$2y$12$mRM2vbLRsJC5fswQUXpwp.x4Z72FxlrmZca1aU4hDhieCAJ7Ka2Qq', NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-17 16:36:23', '2026-08-17 16:36:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table school_management.vision_mission_page_settings
CREATE TABLE IF NOT EXISTS `vision_mission_page_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tagline` json DEFAULT NULL,
  `title` json DEFAULT NULL,
  `highlight` json DEFAULT NULL,
  `description` json DEFAULT NULL,
  `experience_text` json DEFAULT NULL,
  `quote` json DEFAULT NULL,
  `button_text` json DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcrumb_title` json DEFAULT NULL,
  `breadcrumb_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` json DEFAULT NULL,
  `seo_description` json DEFAULT NULL,
  `seo_keywords` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mission_tagline` json DEFAULT NULL,
  `mission_title` json DEFAULT NULL,
  `mission_highlight` json DEFAULT NULL,
  `mission_description` json DEFAULT NULL,
  `mission_experience_text` json DEFAULT NULL,
  `mission_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission_image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `values_tagline` json DEFAULT NULL,
  `values_title` json DEFAULT NULL,
  `values_highlight` json DEFAULT NULL,
  `values_description` json DEFAULT NULL,
  `values_experience_text` json DEFAULT NULL,
  `values_image_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `values_image_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `values_image_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table school_management.vision_mission_page_settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `vision_mission_page_settings` DISABLE KEYS */;
INSERT INTO `vision_mission_page_settings` (`id`, `tagline`, `title`, `highlight`, `description`, `experience_text`, `quote`, `button_text`, `button_url`, `image_1`, `image_2`, `image_3`, `breadcrumb_title`, `breadcrumb_image`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`, `mission_tagline`, `mission_title`, `mission_highlight`, `mission_description`, `mission_experience_text`, `mission_image_1`, `mission_image_2`, `mission_image_3`, `values_tagline`, `values_title`, `values_highlight`, `values_description`, `values_experience_text`, `values_image_1`, `values_image_2`, `values_image_3`) VALUES
	(1,
	'{"ar": "رؤيتنا", "bn": "আমাদের দৃষ্টিভঙ্গি", "en": "Our Vision"}',
	'{"ar": "الريادة في التعليم الإسلامي بتشيتاغونغ", "bn": "চট্টগ্রামে ইসলামী শিক্ষার নেতৃত্ব", "en": "Leading Islamic Education in Chattogram"}',
	'{"ar": "الريادة", "bn": "নেতৃত্ব", "en": "Leading"}',
	'{"ar": "أن تكون المركز الرائد للتعليم الإسلامي والحديث في تشيتاغونغ، مُنتجةً خريجين أتقياءَ عالِمين مسؤولين يقودون المجتمع بحكمة وفضيلة.", "bn": "চট্টগ্রামে ইসলামী ও আধুনিক শিক্ষার শীর্ষ কেন্দ্র হওয়া, যেখানে আল্লাহভীরু, জ্ঞানী ও দায়িত্বশীল স্নাতক তৈরি হবে যারা জ্ঞান ও সৎচরিত্র দিয়ে সমাজকে নেতৃত্ব দেবে।", "en": "To be the premier centre of Islamic and modern education in Chattogram, producing God-fearing, knowledgeable, and responsible graduates who lead society with wisdom and virtue."}',
	'{"ar": "138+ عام", "bn": "১৩৮+ বছর", "en": "138+ Years"}',
	'{"ar": "العلم ميراث الأنبياء، والعلماء ورثة الأنبياء.", "bn": "জ্ঞান নবীদের উত্তরাধিকার। আলেমরা নবীদের উত্তরসুরী।", "en": "Knowledge is the inheritance of the Prophets. The scholars are the heirs of the Prophets."}',
	'{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}',
	'/about',
	'site/about-1.jpg', 'site/about-2.jpg', 'site/about-3.jpg',
	'{"ar": "الرؤية والمهمة", "bn": "দৃষ্টিভঙ্গি ও লক্ষ্য", "en": "Vision & Mission"}',
	'site/vision-breadcrumb.jpg',
	'{"ar": "الرؤية والمهمة - مدرسة الكامل الماجستير بسيتاكُند", "bn": "দৃষ্টিভঙ্গি ও লক্ষ্য - সীতাকুণ্ড কামিল এম.এ মাদ্রাসা", "en": "Vision & Mission - Sitakund Kamil M.A Madrasah"}',
	'{"ar": "تعرف على رؤية ومهمة وقيم مدرسة الكامل الماجستير بسيتاكُند.", "bn": "সীতাকুণ্ড কামিল এম.এ মাদ্রাসার দৃষ্টিভঙ্গি, লক্ষ্য ও মূল্যবোধ সম্পর্কে জানুন।", "en": "Learn about the vision, mission, and values of Sitakund Kamil M.A Madrasah."}',
	'{"ar": "الرؤية، المهمة، مدرسة سيتاكُند، القيم", "bn": "দৃষ্টিভঙ্গি, লক্ষ্য, সীতাকুণ্ড মাদ্রাসা, মূল্যবোধ", "en": "vision, mission, sitakund madrasah, values"}',
	'2026-07-23 17:50:38', '2026-07-23 17:50:38',
	'{"ar": "مهمتنا", "bn": "আমাদের লক্ষ্য", "en": "Our Mission"}',
	'{"ar": "تثقيف القلوب والعقول لخدمة الأمة", "bn": "উম্মাহর জন্য হৃদয় ও মস্তিষ্ক গড়ে তোলা", "en": "Educating Hearts & Minds for the Ummah"}',
	'{"ar": "تثقيف", "bn": "গড়ে তোলা", "en": "Educating"}',
	'{"ar": "تقديم تعليم إسلامي راسخ مدمجاً بالمعرفة الحديثة، لرعاية الطلاب روحياً وفكرياً وأخلاقياً، ليخدموا الإسلام والإنسانية بتميز واقتدار.", "bn": "আধুনিক জ্ঞানের সাথে একীভূত মানসম্মত ইসলামী শিক্ষা প্রদান করা, যাতে শিক্ষার্থীরা আধ্যাত্মিক, বুদ্ধিবৃত্তিক ও নৈতিকভাবে গড়ে উঠে ইসলাম ও মানবতার সেবায় শ্রেষ্ঠত্বের সাথে অবদান রাখতে পারে।", "en": "To provide quality Islamic education integrated with modern knowledge, nurturing students spiritually, intellectually, and morally, so they can serve Islam and humanity with excellence."}',
	'{"ar": "منذ 1886", "bn": "১৮৮৬ থেকে", "en": "Since 1886"}',
	'site/about-1.jpg', 'site/about-2.jpg', 'site/about-3.jpg',
	'{"ar": "قيمنا الجوهرية", "bn": "আমাদের মূল মূল্যবোধ", "en": "Our Core Values"}',
	'{"ar": "الإيمان والعلم والنزاهة والخدمة", "bn": "বিশ্বাস, জ্ঞান, সততা ও সেবা", "en": "Faith, Knowledge, Integrity & Service"}',
	'{"ar": "القيم", "bn": "মূল্যবোধ", "en": "Values"}',
	'{"ar": "مؤسستنا مبنية على أربعة أركان: الإيمان الثابت بالله، والسعي نحو العلم، والنزاهة في كل الأعمال، والخدمة المخلصة للمجتمع والأمة.", "bn": "আমাদের প্রতিষ্ঠান চারটি স্তম্ভের উপর নির্মিত: আল্লাহতে অটল বিশ্বাস, জ্ঞানের অন্বেষণ, সকল কার্যক্রমে সততা এবং সমাজ ও উম্মাহর নিঃস্বার্থ সেবা।", "en": "Our institution is built on four pillars: unwavering faith in Allah, pursuit of knowledge, integrity in all actions, and selfless service to the community and Ummah."}',
	'{"ar": "منذ 1886", "bn": "১৮৮৬ থেকে", "en": "Since 1886"}',
	'site/about-1.jpg', 'site/about-2.jpg', 'site/about-3.jpg');
/*!40000 ALTER TABLE `vision_mission_page_settings` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
