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
	(1, '2026-08-24', '{"ar": null, "en": "Hello world"}', 'academic_event', '{"ar": null, "en": "asdf asd"}', 1, '2026-08-22 06:26:17', '2026-08-22 06:40:31');
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
	(1, '{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}', '{"ar": "آخر الأخبار والمدونة", "bn": "সর্বশেষ সংবাদ ও ব্লগ", "en": "Latest News & Blog"}', '{"ar": "المدونة", "bn": "ব্লগ", "en": "Blog"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}', 'site/blog-breadcrumb.jpg', '{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}', '{"ar": "اقرأ آخر الأخبار والمقالات من مدرستنا.", "bn": "আমাদের স্কুলের সর্বশেষ সংবাদ ও নিবন্ধ পড়ুন।", "en": "Read the latest news and articles from our school."}', '{"ar": "مدونة، أخبار، مقالات، مدونة مدرسية", "bn": "ব্লগ, সংবাদ, নিবন্ধ, স্কুল ব্লগ", "en": "blog, news, articles, school blog"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, 'there-are-many-variations-passage-have-suffered-available', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة.", "bn": "অনেক ধরনের অনুচ্ছেদের ভিন্নতা রয়েছে যা পরিবর্তিত হয়েছে।", "en": "There are many variations passage have suffered available."}', '{"ar": "هناك العديد من الاختلافات في المقاطع التي عانت معظمها من بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় যার বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have suffered in some injected humour."}', 'site/blog/there-are-many-variations-passage-have-suffered-available.jpg', '2026-07-18', '{"ar": "أليشا ديفيس", "bn": "অ্যালিসিয়া ডেভিস", "en": "Alicia Davis"}', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه المقالة معلومات مهمة للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই নিবন্ধটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ তথ্য প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/blog-author.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 'site/blog-gallery-1.jpg', 'site/blog-gallery-2.jpg', '[{"tag": {"ar": "دورة", "bn": "কোর্স", "en": "Course"}}, {"tag": {"ar": "الطلاب", "bn": "শিক্ষার্থী", "en": "Students"}}, {"tag": {"ar": "أكاديمي", "bn": "একাডেমিক", "en": "Academics"}}]', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'a-reader-will-be-distracted-by-the-readable-content', '{"ar": "سيتشتت انتباه القارئ بالمحتوى القابل للقراءة.", "bn": "একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "A reader will be distracted by the readable content."}', '{"ar": "هناك العديد من الاختلافات في المقاطع التي عانت معظمها من بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় যার বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have suffered in some injected humour."}', 'site/blog/a-reader-will-be-distracted-by-the-readable-content.jpg', '2026-07-11', '{"ar": "أليشا ديفيس", "bn": "অ্যালিসিয়া ডেভিস", "en": "Alicia Davis"}', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه المقالة معلومات مهمة للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই নিবন্ধটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ তথ্য প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/blog-author.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 'site/blog-gallery-1.jpg', 'site/blog-gallery-2.jpg', '[{"tag": {"ar": "دورة", "bn": "কোর্স", "en": "Course"}}, {"tag": {"ar": "الطلاب", "bn": "শিক্ষার্থী", "en": "Students"}}, {"tag": {"ar": "أكاديمي", "bn": "একাডেমিক", "en": "Academics"}}]', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'many-desktop-publishing-packages-use-lorem-ipsum', '{"ar": "تستخدم العديد من حزم النشر المكتبي نص لوريم إيبسوم.", "bn": "অনেক ডেস্কটপ পাবলিশিং প্যাকেজ লরেম ইপসাম ব্যবহার করে।", "en": "Many desktop publishing packages use Lorem Ipsum."}', '{"ar": "هناك العديد من الاختلافات في المقاطع التي عانت معظمها من بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় যার বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have suffered in some injected humour."}', 'site/blog/many-desktop-publishing-packages-use-lorem-ipsum.jpg', '2026-07-03', '{"ar": "أليشا ديفيس", "bn": "অ্যালিসিয়া ডেভিস", "en": "Alicia Davis"}', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه المقالة معلومات مهمة للطلاب.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই নিবন্ধটি শিক্ষার্থীদের জন্য গুরুত্বপূর্ণ তথ্য প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>"}', 'site/blog-author.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 'site/blog-gallery-1.jpg', 'site/blog-gallery-2.jpg', '[{"tag": {"ar": "دورة", "bn": "কোর্স", "en": "Course"}}, {"tag": {"ar": "الطلاب", "bn": "শিক্ষার্থী", "en": "Students"}}, {"tag": {"ar": "أكاديمي", "bn": "একাডেমিক", "en": "Academics"}}]', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-blog_page_settings.current', 'a:12:{s:2:"id";i:1;s:15:"section_tagline";s:83:"{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}";s:13:"section_title";s:140:"{"ar": "آخر الأخبار والمدونة", "bn": "সর্বশেষ সংবাদ ও ব্লগ", "en": "Latest News & Blog"}";s:17:"section_highlight";s:60:"{"ar": "المدونة", "bn": "ব্লগ", "en": "Blog"}";s:19:"section_description";s:525:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}";s:16:"breadcrumb_title";s:83:"{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}";s:16:"breadcrumb_image";s:24:"site/blog-breadcrumb.jpg";s:9:"seo_title";s:83:"{"ar": "مدونتنا", "bn": "আমাদের ব্লগ", "en": "Our Blog"}";s:15:"seo_description";s:270:"{"ar": "اقرأ آخر الأخبار والمقالات من مدرستنا.", "bn": "আমাদের স্কুলের সর্বশেষ সংবাদ ও নিবন্ধ পড়ুন।", "en": "Read the latest news and articles from our school."}";s:12:"seo_keywords";s:206:"{"ar": "مدونة، أخبار، مقالات، مدونة مدرسية", "bn": "ব্লগ, সংবাদ, নিবন্ধ, স্কুল ব্লগ", "en": "blog, news, articles, school blog"}";s:10:"created_at";s:19:"2026-07-23 17:50:38";s:10:"updated_at";s:19:"2026-07-23 17:50:38";}', 2102753339),
	('laravel-cache-course_page_settings.current', 'a:12:{s:2:"id";i:1;s:15:"section_tagline";s:89:"{"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}";s:13:"section_title";s:143:"{"ar": "تحقق من دوراتنا", "bn": "আমাদের কোর্সগুলো দেখুন", "en": "Let\'s Check Our Courses"}";s:17:"section_highlight";s:62:"{"ar": "دورات", "bn": "কোর্স", "en": "Courses"}";s:19:"section_description";s:525:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}";s:16:"breadcrumb_title";s:89:"{"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}";s:16:"breadcrumb_image";s:27:"site/courses-breadcrumb.jpg";s:9:"seo_title";s:89:"{"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}";s:15:"seo_description";s:527:"{"ar": "تصفح الدورات التي تقدمها مدرستنا - المدة والرسوم والمقاعد ومتطلبات كل برنامج.", "bn": "আমাদের স্কুলের কোর্সসমূহ ব্রাউজ করুন — সময়কাল, ফি, আসন এবং প্রতিটি প্রোগ্রামের প্রয়োজনীয়তা।", "en": "Browse the courses offered by our school — duration, fees, seats, and requirements for each program."}";s:12:"seo_keywords";s:182:"{"ar": "دورات، القبول، دورات المدرسة", "bn": "কোর্স, ভর্তি, স্কুল কোর্স", "en": "courses, admission, school courses"}";s:10:"created_at";s:19:"2026-07-23 17:50:37";s:10:"updated_at";s:19:"2026-07-23 17:50:37";}', 2102753339),
	('laravel-cache-department_page_settings.current', 'a:12:{s:2:"id";i:1;s:15:"section_tagline";s:65:"{"ar": "القسم", "bn": "বিভাগ", "en": "Department"}";s:13:"section_title";s:136:"{"ar": "تصفح أقسامنا", "bn": "আমাদের বিভাগসমূহ দেখুন", "en": "Browse Our Department"}";s:17:"section_highlight";s:65:"{"ar": "القسم", "bn": "বিভাগ", "en": "Department"}";s:19:"section_description";s:525:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}";s:16:"breadcrumb_title";s:119:"{"ar": "القسم الأكاديمي", "bn": "একাডেমিক বিভাগ", "en": "Academics Department"}";s:16:"breadcrumb_image";s:31:"site/departments-breadcrumb.jpg";s:9:"seo_title";s:119:"{"ar": "القسم الأكاديمي", "bn": "একাডেমিক বিভাগ", "en": "Academics Department"}";s:15:"seo_description";s:302:"{"ar": "استكشف الأقسام الأكاديمية المتوفرة في مدرستنا.", "bn": "আমাদের স্কুলে প্রদত্ত একাডেমিক বিভাগসমূহ দেখুন।", "en": "Explore the academic departments offered at our school."}";s:12:"seo_keywords";s:163:"{"ar": "قسم، أكاديمي، هيئة تدريس", "bn": "বিভাগ, একাডেমিক, অনুষদ", "en": "department, academics, faculty"}";s:10:"created_at";s:19:"2026-07-23 17:50:38";s:10:"updated_at";s:19:"2026-07-23 17:50:38";}', 2102753339),
	('laravel-cache-event_page_settings.current', 'a:12:{s:2:"id";i:1;s:15:"section_tagline";s:78:"{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}";s:13:"section_title";s:153:"{"ar": "فعالياتنا القادمة", "bn": "আমাদের আসন্ন অনুষ্ঠানসমূহ", "en": "Our Upcoming Events"}";s:17:"section_highlight";s:78:"{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}";s:19:"section_description";s:525:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}";s:16:"breadcrumb_title";s:78:"{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}";s:16:"breadcrumb_image";s:26:"site/events-breadcrumb.jpg";s:9:"seo_title";s:153:"{"ar": "فعالياتنا القادمة", "bn": "আমাদের আসন্ন অনুষ্ঠানসমূহ", "en": "Our Upcoming Events"}";s:15:"seo_description";s:361:"{"ar": "اطلع على الفعاليات والبرامج والأنشطة القادمة في مدرستنا.", "bn": "আমাদের স্কুলের আসন্ন অনুষ্ঠান, প্রোগ্রাম এবং কার্যক্রম দেখুন।", "en": "See upcoming events, programs, and activities at our school."}";s:12:"seo_keywords";s:216:"{"ar": "فعاليات، برامج مدرسية، أنشطة", "bn": "অনুষ্ঠান, স্কুল প্রোগ্রাম, কার্যক্রম", "en": "events, school programs, activities"}";s:10:"created_at";s:19:"2026-07-23 17:50:38";s:10:"updated_at";s:19:"2026-07-23 17:50:38";}', 2102753339),
	('laravel-cache-gallery_page_settings.current', 'a:12:{s:2:"id";i:1;s:15:"section_tagline";s:80:"{"ar": "معرض الصور", "bn": "গ্যালারি", "en": "Gallery"}";s:13:"section_title";s:119:"{"ar": "معرض صورنا", "bn": "আমাদের ফটো গ্যালারি", "en": "Our Photo Gallery"}";s:17:"section_highlight";s:73:"{"ar": "المعرض", "bn": "গ্যালারি", "en": "Gallery"}";s:19:"section_description";s:525:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}";s:16:"breadcrumb_title";s:73:"{"ar": "المعرض", "bn": "গ্যালারি", "en": "Gallery"}";s:16:"breadcrumb_image";s:27:"site/gallery-breadcrumb.jpg";s:9:"seo_title";s:119:"{"ar": "معرض صورنا", "bn": "আমাদের ফটো গ্যালারি", "en": "Our Photo Gallery"}";s:15:"seo_description";s:399:"{"ar": "تصفح صور الحياة الجامعية والفعاليات والأنشطة في مدرستنا.", "bn": "আমাদের স্কুলের ক্যাম্পাস জীবন, অনুষ্ঠান এবং কার্যক্রমের ছবি ব্রাউজ করুন।", "en": "Browse photos from campus life, events, and activities at our school."}";s:12:"seo_keywords";s:184:"{"ar": "معرض، صور، فعاليات مدرسية", "bn": "গ্যালারি, ছবি, স্কুল অনুষ্ঠান", "en": "gallery, photos, school events"}";s:10:"created_at";s:19:"2026-07-23 17:50:38";s:10:"updated_at";s:19:"2026-07-23 17:50:38";}', 2102753339),
	('laravel-cache-languages.active', 'a:3:{i:0;a:10:{s:2:"id";i:1;s:4:"code";s:2:"en";s:4:"name";s:7:"English";s:11:"native_name";s:7:"English";s:9:"direction";s:3:"ltr";s:10:"is_default";b:1;s:9:"is_active";b:1;s:10:"sort_order";i:1;s:10:"created_at";s:27:"2026-07-23T17:50:37.000000Z";s:10:"updated_at";s:27:"2026-07-23T17:50:37.000000Z";}i:1;a:10:{s:2:"id";i:2;s:4:"code";s:2:"bn";s:4:"name";s:6:"Bangla";s:11:"native_name";s:15:"বাংলা";s:9:"direction";s:3:"ltr";s:10:"is_default";b:0;s:9:"is_active";b:1;s:10:"sort_order";i:2;s:10:"created_at";s:27:"2026-07-24T17:15:11.000000Z";s:10:"updated_at";s:27:"2026-07-24T17:15:11.000000Z";}i:2;a:10:{s:2:"id";i:3;s:4:"code";s:2:"ar";s:4:"name";s:6:"Arabic";s:11:"native_name";s:14:"العربية";s:9:"direction";s:3:"rtl";s:10:"is_default";b:0;s:9:"is_active";b:1;s:10:"sort_order";i:3;s:10:"created_at";s:27:"2026-07-25T15:43:42.000000Z";s:10:"updated_at";s:27:"2026-07-25T15:43:42.000000Z";}}', 2102753339),
	('laravel-cache-module_settings.all', 'a:36:{i:0;a:6:{s:2:"id";i:1;s:3:"key";s:6:"slider";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:50:01";}i:1;a:6:{s:2:"id";i:2;s:3:"key";s:14:"institute_info";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:2;a:6:{s:2:"id";i:3;s:3:"key";s:7:"counter";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:3;a:6:{s:2:"id";i:4;s:3:"key";s:7:"partner";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:4;a:6:{s:2:"id";i:5;s:3:"key";s:5:"video";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:5;a:6:{s:2:"id";i:6;s:3:"key";s:5:"offer";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:6;a:6:{s:2:"id";i:7;s:3:"key";s:6:"choose";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:7;a:6:{s:2:"id";i:8;s:3:"key";s:5:"skill";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:8;a:6:{s:2:"id";i:9;s:3:"key";s:5:"about";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:9;a:6:{s:2:"id";i:10;s:3:"key";s:7:"courses";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:44:58";}i:10;a:6:{s:2:"id";i:11;s:3:"key";s:8:"teachers";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:11;a:6:{s:2:"id";i:12;s:3:"key";s:7:"gallery";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:12;a:6:{s:2:"id";i:13;s:3:"key";s:6:"events";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:13;a:6:{s:2:"id";i:14;s:3:"key";s:11:"departments";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:14;a:6:{s:2:"id";i:15;s:3:"key";s:4:"blog";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:15;a:6:{s:2:"id";i:16;s:3:"key";s:12:"testimonials";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:16;a:6:{s:2:"id";i:17;s:3:"key";s:10:"facilities";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:0;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-08-16 14:08:41";}i:17;a:6:{s:2:"id";i:18;s:3:"key";s:10:"portfolios";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:18;a:6:{s:2:"id";i:19;s:3:"key";s:3:"faq";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:19;a:6:{s:2:"id";i:20;s:3:"key";s:7:"notices";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:20;a:6:{s:2:"id";i:21;s:3:"key";s:9:"principal";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:21;a:6:{s:2:"id";i:22;s:3:"key";s:12:"ex_principal";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:22;a:6:{s:2:"id";i:23;s:3:"key";s:7:"contact";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 06:35:51";s:10:"updated_at";s:19:"2026-07-25 06:35:51";}i:23;a:6:{s:2:"id";i:24;s:3:"key";s:15:"founders_donors";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-07-25 17:38:25";s:10:"updated_at";s:19:"2026-07-25 17:38:25";}i:24;a:6:{s:2:"id";i:25;s:3:"key";s:9:"namespace";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:25;a:6:{s:2:"id";i:26;s:3:"key";s:22:"vapor_maintenance_mode";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:26;a:6:{s:2:"id";i:27;s:3:"key";s:5:"stubs";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:27;a:6:{s:2:"id";i:28;s:3:"key";s:5:"paths";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:28;a:6:{s:2:"id";i:29;s:3:"key";s:13:"auto-discover";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:29;a:6:{s:2:"id";i:30;s:3:"key";s:8:"commands";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:30;a:6:{s:2:"id";i:31;s:3:"key";s:4:"scan";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:31;a:6:{s:2:"id";i:32;s:3:"key";s:8:"composer";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:32;a:6:{s:2:"id";i:33;s:3:"key";s:8:"register";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:33;a:6:{s:2:"id";i:34;s:3:"key";s:10:"activators";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:34;a:6:{s:2:"id";i:35;s:3:"key";s:9:"activator";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}i:35;a:6:{s:2:"id";i:36;s:3:"key";s:7:"inertia";s:10:"is_enabled";i:1;s:16:"show_on_homepage";i:1;s:10:"created_at";s:19:"2026-08-10 13:24:14";s:10:"updated_at";s:19:"2026-08-10 13:24:14";}}', 2102753339),
	('laravel-cache-notice_page_settings.current', 'a:9:{s:2:"id";i:1;s:13:"marquee_label";s:73:"{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}";s:16:"breadcrumb_title";s:73:"{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}";s:16:"breadcrumb_image";s:27:"site/notices-breadcrumb.jpg";s:9:"seo_title";s:73:"{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}";s:15:"seo_description";s:346:"{"ar": "اقرأ أحدث الإشعارات والجداول والإعلانات من مدرستنا.", "bn": "আমাদের স্কুলের সর্বশেষ বিজ্ঞপ্তি, রুটিন এবং ঘোষণা পড়ুন।", "en": "Read the latest notices, routines, and announcements from our school."}";s:12:"seo_keywords";s:233:"{"ar": "إشعار، إعلانات، لوحة إعلانات المدرسة", "bn": "বিজ্ঞপ্তি, ঘোষণা, স্কুল নোটিশ বোর্ড", "en": "notice, announcements, school notice board"}";s:10:"created_at";s:19:"2026-07-23 17:50:38";s:10:"updated_at";s:19:"2026-07-23 17:50:38";}', 2102753339),
	('laravel-cache-site_settings.current', 'a:167:{s:2:"id";i:1;s:9:"site_name";s:122:"{"ar": "مدرسة ويكسنيكس", "bn": "ওয়েক্সনিক্স স্কুল", "en": "WexNix School"}";s:17:"homepage_template";s:7:"index-2";s:4:"logo";s:13:"site/logo.png";s:11:"footer_logo";s:19:"site/logo-light.png";s:7:"address";s:140:"{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}";s:5:"phone";s:14:"+8801712345678";s:5:"email";s:16:"info@example.com";s:12:"facebook_url";s:20:"https://facebook.com";s:13:"instagram_url";s:21:"https://instagram.com";s:11:"youtube_url";s:19:"https://youtube.com";s:12:"whatsapp_url";s:27:"https://wa.me/8801712345678";s:12:"linkedin_url";s:20:"https://linkedin.com";s:12:"footer_about";s:654:"{"ar": "نحن ملتزمون برعاية كل طالب بتعليم جيد ومعلمين متفانين وحرم جامعي آمن وملهم.", "bn": "আমরা মানসম্মত শিক্ষা, নিবেদিতপ্রাণ শিক্ষক এবং একটি নিরাপদ, অনুপ্রেরণাদায়ক ক্যাম্পাসে প্রতিটি শিক্ষার্থীকে গড়ে তুলতে প্রতিশ্রুতিবদ্ধ।", "en": "We are dedicated to nurturing every student with quality education, dedicated teachers, and a safe, inspiring campus."}";s:14:"copyright_text";s:143:"{"ar": "جميع الحقوق محفوظة.", "bn": "সর্বস্বত্ব সংরক্ষিত।", "en": "All Rights Reserved."}";s:10:"created_at";s:19:"2026-07-23 17:50:37";s:10:"updated_at";s:19:"2026-08-17 18:23:04";s:14:"institute_info";s:727:"[{"label": {"ar": "رقم EIIN للمعهد", "bn": "ইনস্টিটিউট EIIN", "en": "Institute EIIN"}, "value": {"ar": "123456", "bn": "১২৩৪৫৬", "en": "123456"}}, {"label": {"ar": "رمز المؤسسة", "bn": "প্রতিষ্ঠান কোড", "en": "Institution Code"}, "value": {"ar": "987654321", "bn": "৯৮৭৬৫৪৩২১", "en": "987654321"}}, {"label": {"ar": "رمز المركز", "bn": "কেন্দ্র কোড", "en": "Center Code"}, "value": {"ar": "101", "bn": "১০১", "en": "101"}}, {"label": {"ar": "سنة التأسيس", "bn": "প্রতিষ্ঠার বছর", "en": "Estd Year"}, "value": {"ar": "1985", "bn": "১৯৮৫", "en": "1985"}}]";s:9:"cta_stats";s:727:"[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "إجمالي الدورات", "bn": "মোট কোর্স", "en": "Total Courses"}, "value": "500"}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "طلابنا", "bn": "আমাদের শিক্ষার্থী", "en": "Our Students"}, "value": "1900"}, {"icon": {"value": "users", "source": "lucide"}, "label": {"ar": "محاضرون مهرة", "bn": "দক্ষ প্রভাষক", "en": "Skilled Lecturers"}, "value": "750"}, {"icon": {"value": "award", "source": "lucide"}, "label": {"ar": "جوائز فائزة", "bn": "বিজয়ী পুরস্কার", "en": "Win Awards"}, "value": "30"}]";s:13:"partner_logos";s:105:"[{"image": "site/partners/02.png"}, {"image": "site/partners/03.png"}, {"image": "site/partners/04.png"}]";s:13:"video_tagline";s:107:"{"ar": "أحدث فيديو", "bn": "সাম্প্রতিক ভিডিও", "en": "Latest Video"}";s:11:"video_title";s:174:"{"ar": "شاهد أحدث فيديو لنا", "bn": "আমাদের সাম্প্রতিক ভিডিও দেখুন", "en": "Let\'s Check Our Latest Video"}";s:15:"video_highlight";s:74:"{"ar": "أحدث", "bn": "সাম্প্রতিক", "en": "Latest"}";s:17:"video_description";s:561:"{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات بشكل أو بآخر.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour look even slightly believable."}";s:17:"video_button_text";s:82:"{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}";s:16:"video_button_url";s:1:"#";s:17:"video_youtube_url";s:43:"https://www.youtube.com/watch?v=ckHzmP1evNU";s:15:"video_thumbnail";s:24:"site/video-thumbnail.jpg";s:11:"offer_title";s:268:"{"ar": "عرضنا بخصم 20% مستمر - انضم اليوم لدورتك", "bn": "আমাদের ২০% অফার চলছে - আজই আপনার কোর্সে যোগ দিন", "en": "Our 20% Offer Running - Join Today For Your Course"}";s:17:"offer_description";s:687:"{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable."}";s:17:"offer_button_text";s:95:"{"ar": "قدم الآن", "bn": "এখনই আবেদন করুন", "en": "Apply Now"}";s:16:"offer_button_url";s:1:"#";s:16:"offer_background";s:25:"site/offer-background.jpg";s:14:"choose_tagline";s:125:"{"ar": "لماذا تختارنا", "bn": "কেন আমাদের বেছে নেবেন", "en": "Why Choose Us"}";s:12:"choose_title";s:298:"{"ar": "نحن خبراء ونبذل قصارى جهدنا لتحقيق هدفك", "bn": "আমরা বিশেষজ্ঞ এবং আপনার লক্ষ্যের জন্য সর্বোচ্চ চেষ্টা করি", "en": "We Are Expert & Do Our Best For Your Goal"}";s:16:"choose_highlight";s:124:"{"ar": "نبذل قصارى جهدنا", "bn": "সর্বোচ্চ চেষ্টা করি", "en": "Do Our Best"}";s:18:"choose_description";s:591:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى المقروء للصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক একটি পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when many desktop and web page editors looking at its layout."}";s:12:"choose_image";s:21:"site/choose-image.jpg";s:15:"choose_features";s:1651:"[{"icon": {"value": "user-round", "source": "lucide"}, "title": {"ar": "معلمون خبراء", "bn": "বিশেষজ্ঞ শিক্ষক", "en": "Expert Teachers"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}, {"icon": {"value": "library", "source": "lucide"}, "title": {"ar": "مواد الدورة", "bn": "কোর্স উপকরণ", "en": "Courses Material"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}, {"icon": {"value": "monitor-play", "source": "lucide"}, "title": {"ar": "دورات عبر الإنترنت", "bn": "অনলাইন কোর্স", "en": "Online Courses"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}, {"icon": {"value": "wallet", "source": "lucide"}, "title": {"ar": "سعر معقول", "bn": "সাশ্রয়ী মূল্য", "en": "Affordable Price"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}]";s:18:"skill_enroll_title";s:147:"{"ar": "ابدأ التسجيل الخاص بك", "bn": "আপনার ভর্তি শুরু করুন", "en": "Start Your Enrollment"}";s:21:"skill_enroll_subtitle";s:240:"{"ar": "نحن اختلافات في المقاطع التي عانت.", "bn": "আমরা অনুচ্ছেদের বিভিন্নতা যা ভুগেছে।", "en": "We are variations of passages the have suffered."}";s:13:"skill_tagline";s:93:"{"ar": "مهاراتنا", "bn": "আমাদের দক্ষতা", "en": "Our Skills"}";s:11:"skill_title";s:255:"{"ar": "اكتشف إبداعك وموهبتك معنا", "bn": "আমাদের সাথে আপনার সৃজনশীলতা ও প্রতিভা অন্বেষণ করুন", "en": "Explore Your Creativity And Talent With Us"}";s:15:"skill_highlight";s:135:"{"ar": "الإبداع والموهبة", "bn": "সৃজনশীলতা ও প্রতিভা", "en": "Creativity And Talent"}";s:17:"skill_description";s:799:"{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable. If you are going to use passage you need sure there anything embarrassing first true generator on the Internet."}";s:17:"skill_button_text";s:82:"{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}";s:16:"skill_button_url";s:1:"#";s:11:"skill_items";s:384:"[{"label": {"ar": "طلابنا", "bn": "আমাদের শিক্ষার্থী", "en": "Our Students"}, "percentage": "85"}, {"label": {"ar": "معلمونا", "bn": "আমাদের শিক্ষক", "en": "Our Teachers"}, "percentage": "65"}, {"label": {"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}, "percentage": "75"}]";s:13:"about_tagline";s:92:"{"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}";s:11:"about_title";s:268:"{"ar": "نظام WexNix لدينا يلهمك أكثر.", "bn": "আমাদের ওয়েক্সনিক্স সিস্টেম আপনাকে আরও অনুপ্রাণিত করে।", "en": "Our WexNix Tion System Inspires You More."}";s:15:"about_highlight";s:88:"{"ar": "يلهمك", "bn": "অনুপ্রাণিত করে", "en": "Inspires"}";s:17:"about_description";s:720:"{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable. If you are going to use passage."}";s:11:"about_quote";s:547:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the content of a page when looking at its reader for the long words layout."}";s:17:"about_button_text";s:91:"{"ar": "اكتشف المزيد", "bn": "আরও জানুন", "en": "Discover More"}";s:16:"about_button_url";s:1:"#";s:16:"about_badge_icon";s:42:"{"value": "lightbulb", "source": "lucide"}";s:16:"about_badge_text";s:161:"{"ar": "30 عامًا من الخدمة الجيدة", "bn": "৩০ বছরের মানসম্মত সেবা", "en": "30 Years Of Quality Service"}";s:13:"about_image_1";s:16:"site/about-1.jpg";s:13:"about_image_2";s:16:"site/about-2.jpg";s:13:"about_image_3";s:16:"site/about-3.jpg";s:11:"about_items";s:880:"[{"icon": {"value": "book-open", "source": "lucide"}, "title": {"ar": "خدمات WexNix", "bn": "ওয়েক্সনিক্স সেবা", "en": "WexNix tion Services"}, "description": {"ar": "هذه حقيقة راسخة منذ زمن طويل.", "bn": "এটি একটি দীর্ঘদিনের প্রতিষ্ঠিত সত্য।", "en": "It is a long established fact that reader will to using content."}}, {"icon": {"value": "globe", "source": "lucide"}, "title": {"ar": "مراكز دولية", "bn": "আন্তর্জাতিক হাব", "en": "International Hubs"}, "description": {"ar": "هذه حقيقة راسخة منذ زمن طويل.", "bn": "এটি একটি দীর্ঘদিনের প্রতিষ্ঠিত সত্য।", "en": "It is a long established fact that reader will to using content."}}]";s:27:"about_page_breadcrumb_title";s:12:"{"ar": null}";s:27:"about_page_breadcrumb_image";N;s:20:"about_page_seo_title";s:12:"{"ar": null}";s:26:"about_page_seo_description";s:12:"{"ar": null}";s:23:"about_page_seo_keywords";s:12:"{"ar": null}";s:15:"principal_photo";N;s:14:"principal_name";s:12:"{"ar": null}";s:21:"principal_designation";s:12:"{"ar": null}";s:17:"principal_message";s:12:"{"ar": null}";s:31:"principal_page_breadcrumb_title";s:12:"{"ar": null}";s:31:"principal_page_breadcrumb_image";N;s:24:"principal_page_seo_title";s:12:"{"ar": null}";s:30:"principal_page_seo_description";s:12:"{"ar": null}";s:27:"principal_page_seo_keywords";s:12:"{"ar": null}";s:18:"ex_principal_photo";N;s:17:"ex_principal_name";s:12:"{"ar": null}";s:24:"ex_principal_designation";s:12:"{"ar": null}";s:20:"ex_principal_message";s:12:"{"ar": null}";s:34:"ex_principal_page_breadcrumb_title";s:12:"{"ar": null}";s:34:"ex_principal_page_breadcrumb_image";N;s:27:"ex_principal_page_seo_title";s:12:"{"ar": null}";s:33:"ex_principal_page_seo_description";s:12:"{"ar": null}";s:30:"ex_principal_page_seo_keywords";s:12:"{"ar": null}";s:17:"contact_open_time";s:12:"{"ar": null}";s:18:"contact_form_title";s:12:"{"ar": null}";s:24:"contact_form_description";s:12:"{"ar": null}";s:13:"contact_image";N;s:21:"contact_map_embed_url";N;s:29:"contact_page_breadcrumb_title";s:12:"{"ar": null}";s:29:"contact_page_breadcrumb_image";N;s:22:"contact_page_seo_title";s:12:"{"ar": null}";s:28:"contact_page_seo_description";s:12:"{"ar": null}";s:25:"contact_page_seo_keywords";s:12:"{"ar": null}";s:21:"contact_address_label";s:12:"{"ar": null}";s:21:"contact_address_value";s:12:"{"ar": null}";s:19:"contact_phone_label";s:12:"{"ar": null}";s:19:"contact_phone_value";s:12:"{"ar": null}";s:19:"contact_email_label";s:12:"{"ar": null}";s:19:"contact_email_value";s:12:"{"ar": null}";s:23:"contact_open_time_label";s:12:"{"ar": null}";s:24:"footer_quick_links_title";s:93:"{"ar": "روابط سريعة", "bn": "দ্রুত লিঙ্ক", "en": "Quick Links"}";s:18:"footer_quick_links";s:780:"[{"url": "/about", "label": {"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}}, {"url": "/faq", "label": {"ar": "الأسئلة الشائعة", "bn": "সাধারণ প্রশ্ন", "en": "FAQ\'s"}}, {"url": "/testimonials", "label": {"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}}, {"url": "#", "label": {"ar": "شروط الخدمة", "bn": "সেবার শর্তাবলী", "en": "Terms Of Service"}}, {"url": "#", "label": {"ar": "سياسة الخصوصية", "bn": "গোপনীয়তা নীতি", "en": "Privacy policy"}}, {"url": "#", "label": {"ar": "آخر الأخبار", "bn": "সাম্প্রতিক সংবাদ", "en": "Update News"}}]";s:19:"footer_campus_title";s:111:"{"ar": "حرمنا الجامعي", "bn": "আমাদের ক্যাম্পাস", "en": "Our Campus"}";s:19:"footer_campus_links";s:925:"[{"url": "#", "label": {"ar": "سلامة الحرم الجامعي", "bn": "ক্যাম্পাস নিরাপত্তা", "en": "Campus Safety"}}, {"url": "#", "label": {"ar": "أنشطة الطلاب", "bn": "শিক্ষার্থী কার্যক্রম", "en": "Student Activities"}}, {"url": "#", "label": {"ar": "القسم الأكاديمي", "bn": "একাডেমিক বিভাগ", "en": "Academic Department"}}, {"url": "#", "label": {"ar": "التخطيط والإدارة", "bn": "পরিকল্পনা ও প্রশাসন", "en": "Planning & Administration"}}, {"url": "#", "label": {"ar": "مكتب المستشار", "bn": "চ্যান্সেলরের কার্যালয়", "en": "Office Of The Chancellor"}}, {"url": "#", "label": {"ar": "خدمات المرافق", "bn": "সুবিধা পরিষেবা", "en": "Facility Services"}}]";s:23:"footer_newsletter_title";s:98:"{"ar": "النشرة الإخبارية", "bn": "নিউজলেটার", "en": "Newsletter"}";s:22:"footer_newsletter_text";s:323:"{"ar": "اشترك في نشرتنا الإخبارية للحصول على آخر التحديثات والأخبار", "bn": "সর্বশেষ আপডেট এবং সংবাদ পেতে আমাদের নিউজলেটার সাবস্ক্রাইব করুন", "en": "Subscribe now"}";s:19:"sidebar_notice_show";i:1;s:20:"sidebar_notice_title";s:12:"{"ar": null}";s:20:"sidebar_notice_limit";i:4;s:21:"sidebar_minister_show";i:1;s:22:"sidebar_minister_title";N;s:22:"sidebar_minister_photo";N;s:21:"sidebar_minister_name";s:12:"{"ar": null}";s:21:"sidebar_minister_role";s:12:"{"ar": null}";s:28:"sidebar_minister_button_text";s:12:"{"ar": null}";s:27:"sidebar_minister_button_url";N;s:22:"sidebar_secretary_show";i:1;s:23:"sidebar_secretary_title";N;s:23:"sidebar_secretary_photo";N;s:22:"sidebar_secretary_name";s:12:"{"ar": null}";s:22:"sidebar_secretary_role";s:12:"{"ar": null}";s:29:"sidebar_secretary_button_text";s:12:"{"ar": null}";s:28:"sidebar_secretary_button_url";N;s:22:"sidebar_principal_show";i:1;s:23:"sidebar_principal_title";N;s:29:"sidebar_principal_button_text";s:12:"{"ar": null}";s:27:"sidebar_vice_principal_show";i:1;s:28:"sidebar_vice_principal_title";N;s:28:"sidebar_vice_principal_photo";N;s:27:"sidebar_vice_principal_name";s:12:"{"ar": null}";s:27:"sidebar_vice_principal_role";s:12:"{"ar": null}";s:34:"sidebar_vice_principal_button_text";s:12:"{"ar": null}";s:33:"sidebar_vice_principal_button_url";N;s:21:"sidebar_calendar_show";i:1;s:22:"sidebar_calendar_title";s:12:"{"ar": null}";s:34:"student_list_page_breadcrumb_image";N;s:34:"student_list_page_breadcrumb_title";s:12:"{"ar": null}";s:27:"student_list_page_seo_title";s:12:"{"ar": null}";s:33:"student_list_page_seo_description";s:12:"{"ar": null}";s:30:"student_list_page_seo_keywords";s:12:"{"ar": null}";s:33:"tuition_fee_page_breadcrumb_image";N;s:33:"tuition_fee_page_breadcrumb_title";s:12:"{"ar": null}";s:26:"tuition_fee_page_seo_title";s:12:"{"ar": null}";s:32:"tuition_fee_page_seo_description";s:12:"{"ar": null}";s:29:"tuition_fee_page_seo_keywords";s:12:"{"ar": null}";s:24:"tuition_fee_page_content";s:12:"{"ar": null}";s:33:"exam_result_page_breadcrumb_image";N;s:33:"exam_result_page_breadcrumb_title";N;s:26:"exam_result_page_seo_title";N;s:32:"exam_result_page_seo_description";N;s:29:"exam_result_page_seo_keywords";N;s:37:"academic_result_page_breadcrumb_image";N;s:37:"academic_result_page_breadcrumb_title";N;s:30:"academic_result_page_seo_title";N;s:36:"academic_result_page_seo_description";N;s:33:"academic_result_page_seo_keywords";N;s:39:"evaluation_result_page_breadcrumb_image";N;s:39:"evaluation_result_page_breadcrumb_title";N;s:32:"evaluation_result_page_seo_title";N;s:38:"evaluation_result_page_seo_description";N;s:35:"evaluation_result_page_seo_keywords";N;s:39:"board_exam_result_page_breadcrumb_image";N;s:39:"board_exam_result_page_breadcrumb_title";N;s:32:"board_exam_result_page_seo_title";N;s:38:"board_exam_result_page_seo_description";N;s:35:"board_exam_result_page_seo_keywords";N;}', 2102753339),
	('laravel-cache-teacher_page_settings.current', 'a:12:{s:2:"id";i:1;s:15:"section_tagline";s:108:"{"ar": "معلمونا", "bn": "আমাদের শিক্ষকবৃন্দ", "en": "Our Teachers"}";s:13:"section_title";s:167:"{"ar": "تعرف على معلمينا", "bn": "আমাদের শিক্ষকদের সাথে পরিচিত হন", "en": "Meet With Our Teachers"}";s:17:"section_highlight";s:72:"{"ar": "المعلمين", "bn": "শিক্ষক", "en": "Teachers"}";s:19:"section_description";s:525:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}";s:16:"breadcrumb_title";s:87:"{"ar": "المعلمون", "bn": "শিক্ষকবৃন্দ", "en": "Teachers"}";s:16:"breadcrumb_image";s:28:"site/teachers-breadcrumb.jpg";s:9:"seo_title";s:108:"{"ar": "معلمونا", "bn": "আমাদের শিক্ষকবৃন্দ", "en": "Our Teachers"}";s:15:"seo_description";s:257:"{"ar": "تعرف على معلمي وموظفي مدرستنا.", "bn": "আমাদের স্কুলের শিক্ষক ও কর্মীদের সাথে পরিচিত হন।", "en": "Meet the teachers and staff of our school."}";s:12:"seo_keywords";s:178:"{"ar": "المعلمون، أعضاء هيئة التدريس، الموظفون", "bn": "শিক্ষক, অনুষদ, কর্মী", "en": "teachers, faculty, staff"}";s:10:"created_at";s:19:"2026-07-23 17:50:38";s:10:"updated_at";s:19:"2026-07-23 17:50:38";}', 2102753339),
	('laravel-cache-testimonial_page_settings.current', 'a:12:{s:2:"id";i:1;s:15:"section_tagline";s:91:"{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}";s:13:"section_title";s:155:"{"ar": "ماذا يقول طلابنا", "bn": "আমাদের শিক্ষার্থীরা যা বলে", "en": "What Our Students Say\'s"}";s:17:"section_highlight";s:52:"{"ar": "يقول", "bn": "বলে", "en": "Say\'s"}";s:19:"section_description";s:525:"{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}";s:16:"breadcrumb_title";s:91:"{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}";s:16:"breadcrumb_image";s:32:"site/testimonials-breadcrumb.jpg";s:9:"seo_title";s:91:"{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}";s:15:"seo_description";s:360:"{"ar": "اطلع على آراء طلابنا وأولياء الأمور حول مدرستنا.", "bn": "আমাদের শিক্ষার্থী ও অভিভাবকরা আমাদের স্কুল সম্পর্কে কী বলেন তা দেখুন।", "en": "See what our students and parents say about our school."}";s:12:"seo_keywords";s:238:"{"ar": "شهادات، تقييمات، آراء الطلاب", "bn": "প্রশংসাপত্র, পর্যালোচনা, শিক্ষার্থীর মতামত", "en": "testimonials, reviews, student feedback"}";s:10:"created_at";s:19:"2026-07-23 17:50:38";s:10:"updated_at";s:19:"2026-07-23 17:50:38";}', 2102753339);
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
	(1, 'acting-and-drama', '{"ar": "التمثيل والدراما", "bn": "অভিনয় ও নাটক", "en": "Acting And Drama"}', '{"ar": "دراما", "bn": "নাটক", "en": "Drama"}', 'site/courses/acting-and-drama.jpg', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 10, 4.0, 75, '{"ar": "4 سنوات", "bn": "৪ বছর", "en": "04 Years"}', '$750', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه الدورة للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই কোর্সটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>"}', 'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg', '{"ar": "فرانك ميتشل", "bn": "ফ্র্যাঙ্ক মিচেল", "en": "Frank Mitchel"}', 'site/courses-instructor.jpg', '{"ar": "50 طالبًا", "bn": "৫০ জন শিক্ষার্থী", "en": "50 Students"}', '{"ar": "متطلبات الدورة", "bn": "কোর্সের প্রয়োজনীয়তা", "en": "Course Requirement"}', '[{"text": {"ar": "شهادة مدرسة ثانوية معترف بها.", "bn": "একটি স্বীকৃত মাধ্যমিক বিদ্যালয়ের সার্টিফিকেট।", "en": "A recognized secondary school certificate."}}, {"text": {"ar": "إتقان أساسي للغة الإنجليزية.", "bn": "ইংরেজিতে প্রাথমিক দক্ষতা।", "en": "Basic proficiency in English."}}, {"text": {"ar": "استمارة قبول مكتملة وصورة جواز سفر.", "bn": "পূরণকৃত ভর্তি ফর্ম এবং পাসপোর্ট ছবি।", "en": "A completed admission form and passport photo."}}]', '{"ar": "الخبرة المهنية", "bn": "পেশাগত অভিজ্ঞতা", "en": "Professional Experience"}', '{"ar": "يلتحق خريجو هذا البرنامج بالتدريب الداخلي والوظائف المبتدئة لدى مؤسساتنا الشريكة.", "bn": "এই প্রোগ্রামের স্নাতকরা আমাদের অংশীদার প্রতিষ্ঠানে ইন্টার্নশিপ এবং এন্ট্রি-লেভেল ভূমিকায় যোগ দেয়।", "en": "Graduates of this program go on to internships and entry-level roles with our partner institutions, building real professional experience before they finish."}', '[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "محاضرات", "bn": "লেকচার", "en": "Lectures"}, "value": {"ar": "20", "bn": "20", "en": "20"}}, {"icon": {"value": "pencil", "source": "lucide"}, "label": {"ar": "اختبارات", "bn": "কুইজ", "en": "Quizes"}, "value": {"ar": "12", "bn": "12", "en": "12"}}, {"icon": {"value": "globe", "source": "lucide"}, "label": {"ar": "اللغة", "bn": "ভাষা", "en": "Language"}, "value": {"ar": "الإنجليزية", "bn": "ইংরেজি", "en": "English"}}, {"icon": {"value": "map-pin", "source": "lucide"}, "label": {"ar": "الموقع", "bn": "অবস্থান", "en": "Location"}, "value": {"ar": "في الحرم الجامعي", "bn": "ক্যাম্পাসে", "en": "On Campus"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "شهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}, {"icon": {"value": "circle-check", "source": "lucide"}, "label": {"ar": "تقييمات", "bn": "মূল্যায়ন", "en": "Assessments"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}]', 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:51:50'),
	(2, 'art-and-design', '{"ar": "الفن والتصميم", "bn": "শিল্প ও নকশা", "en": "Art And Design"}', '{"ar": "تصميم", "bn": "নকশা", "en": "Design"}', 'site/courses/art-and-design.jpg', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 10, 4.0, 75, '{"ar": "4 سنوات", "bn": "৪ বছর", "en": "04 Years"}', '$750', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه الدورة للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই কোর্সটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>"}', 'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg', '{"ar": "أنجيلا فيجيل", "bn": "অ্যাঞ্জেলা ভিজিল", "en": "Angela Vigil"}', 'site/courses-instructor.jpg', '{"ar": "50 طالبًا", "bn": "৫০ জন শিক্ষার্থী", "en": "50 Students"}', '{"ar": "متطلبات الدورة", "bn": "কোর্সের প্রয়োজনীয়তা", "en": "Course Requirement"}', '[{"text": {"ar": "شهادة مدرسة ثانوية معترف بها.", "bn": "একটি স্বীকৃত মাধ্যমিক বিদ্যালয়ের সার্টিফিকেট।", "en": "A recognized secondary school certificate."}}, {"text": {"ar": "إتقان أساسي للغة الإنجليزية.", "bn": "ইংরেজিতে প্রাথমিক দক্ষতা।", "en": "Basic proficiency in English."}}, {"text": {"ar": "استمارة قبول مكتملة وصورة جواز سفر.", "bn": "পূরণকৃত ভর্তি ফর্ম এবং পাসপোর্ট ছবি।", "en": "A completed admission form and passport photo."}}]', '{"ar": "الخبرة المهنية", "bn": "পেশাগত অভিজ্ঞতা", "en": "Professional Experience"}', '{"ar": "يلتحق خريجو هذا البرنامج بالتدريب الداخلي والوظائف المبتدئة لدى مؤسساتنا الشريكة.", "bn": "এই প্রোগ্রামের স্নাতকরা আমাদের অংশীদার প্রতিষ্ঠানে ইন্টার্নশিপ এবং এন্ট্রি-লেভেল ভূমিকায় যোগ দেয়।", "en": "Graduates of this program go on to internships and entry-level roles with our partner institutions, building real professional experience before they finish."}', '[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "محاضرات", "bn": "লেকচার", "en": "Lectures"}, "value": {"ar": "20", "bn": "20", "en": "20"}}, {"icon": {"value": "pencil", "source": "lucide"}, "label": {"ar": "اختبارات", "bn": "কুইজ", "en": "Quizes"}, "value": {"ar": "12", "bn": "12", "en": "12"}}, {"icon": {"value": "globe", "source": "lucide"}, "label": {"ar": "اللغة", "bn": "ভাষা", "en": "Language"}, "value": {"ar": "الإنجليزية", "bn": "ইংরেজি", "en": "English"}}, {"icon": {"value": "map-pin", "source": "lucide"}, "label": {"ar": "الموقع", "bn": "অবস্থান", "en": "Location"}, "value": {"ar": "في الحرم الجامعي", "bn": "ক্যাম্পাসে", "en": "On Campus"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "شهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}, {"icon": {"value": "circle-check", "source": "lucide"}, "label": {"ar": "تقييمات", "bn": "মূল্যায়ন", "en": "Assessments"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}]', 1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, 'biology-and-conservation', '{"ar": "الأحياء والحفاظ على البيئة", "bn": "জীববিজ্ঞান ও সংরক্ষণ", "en": "Biology And Conservation"}', '{"ar": "علوم", "bn": "বিজ্ঞান", "en": "Science"}', 'site/courses/biology-and-conservation.jpg', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 10, 4.0, 75, '{"ar": "4 سنوات", "bn": "৪ বছর", "en": "04 Years"}', '$750', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه الدورة للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই কোর্সটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>"}', 'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg', '{"ar": "سوزان لونسفورد", "bn": "সুসান লান্সফোর্ড", "en": "Susan Lunsford"}', 'site/courses-instructor.jpg', '{"ar": "50 طالبًا", "bn": "৫০ জন শিক্ষার্থী", "en": "50 Students"}', '{"ar": "متطلبات الدورة", "bn": "কোর্সের প্রয়োজনীয়তা", "en": "Course Requirement"}', '[{"text": {"ar": "شهادة مدرسة ثانوية معترف بها.", "bn": "একটি স্বীকৃত মাধ্যমিক বিদ্যালয়ের সার্টিফিকেট।", "en": "A recognized secondary school certificate."}}, {"text": {"ar": "إتقان أساسي للغة الإنجليزية.", "bn": "ইংরেজিতে প্রাথমিক দক্ষতা।", "en": "Basic proficiency in English."}}, {"text": {"ar": "استمارة قبول مكتملة وصورة جواز سفر.", "bn": "পূরণকৃত ভর্তি ফর্ম এবং পাসপোর্ট ছবি।", "en": "A completed admission form and passport photo."}}]', '{"ar": "الخبرة المهنية", "bn": "পেশাগত অভিজ্ঞতা", "en": "Professional Experience"}', '{"ar": "يلتحق خريجو هذا البرنامج بالتدريب الداخلي والوظائف المبتدئة لدى مؤسساتنا الشريكة.", "bn": "এই প্রোগ্রামের স্নাতকরা আমাদের অংশীদার প্রতিষ্ঠানে ইন্টার্নশিপ এবং এন্ট্রি-লেভেল ভূমিকায় যোগ দেয়।", "en": "Graduates of this program go on to internships and entry-level roles with our partner institutions, building real professional experience before they finish."}', '[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "محاضرات", "bn": "লেকচার", "en": "Lectures"}, "value": {"ar": "20", "bn": "20", "en": "20"}}, {"icon": {"value": "pencil", "source": "lucide"}, "label": {"ar": "اختبارات", "bn": "কুইজ", "en": "Quizes"}, "value": {"ar": "12", "bn": "12", "en": "12"}}, {"icon": {"value": "globe", "source": "lucide"}, "label": {"ar": "اللغة", "bn": "ভাষা", "en": "Language"}, "value": {"ar": "الإنجليزية", "bn": "ইংরেজি", "en": "English"}}, {"icon": {"value": "map-pin", "source": "lucide"}, "label": {"ar": "الموقع", "bn": "অবস্থান", "en": "Location"}, "value": {"ar": "في الحرم الجامعي", "bn": "ক্যাম্পাসে", "en": "On Campus"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "شهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}, {"icon": {"value": "circle-check", "source": "lucide"}, "label": {"ar": "تقييمات", "bn": "মূল্যায়ন", "en": "Assessments"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}]', 1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(4, 'science-and-engineering', '{"ar": "العلوم والهندسة", "bn": "বিজ্ঞান ও প্রকৌশল", "en": "Science And Engineering"}', '{"ar": "علوم", "bn": "বিজ্ঞান", "en": "Science"}', 'site/courses/science-and-engineering.jpg', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 10, 4.0, 75, '{"ar": "4 سنوات", "bn": "৪ বছর", "en": "04 Years"}', '$750', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه الدورة للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই কোর্সটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>"}', 'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg', '{"ar": "فرانك ميتشل", "bn": "ফ্র্যাঙ্ক মিচেল", "en": "Frank Mitchel"}', 'site/courses-instructor.jpg', '{"ar": "50 طالبًا", "bn": "৫০ জন শিক্ষার্থী", "en": "50 Students"}', '{"ar": "متطلبات الدورة", "bn": "কোর্সের প্রয়োজনীয়তা", "en": "Course Requirement"}', '[{"text": {"ar": "شهادة مدرسة ثانوية معترف بها.", "bn": "একটি স্বীকৃত মাধ্যমিক বিদ্যালয়ের সার্টিফিকেট।", "en": "A recognized secondary school certificate."}}, {"text": {"ar": "إتقان أساسي للغة الإنجليزية.", "bn": "ইংরেজিতে প্রাথমিক দক্ষতা।", "en": "Basic proficiency in English."}}, {"text": {"ar": "استمارة قبول مكتملة وصورة جواز سفر.", "bn": "পূরণকৃত ভর্তি ফর্ম এবং পাসপোর্ট ছবি।", "en": "A completed admission form and passport photo."}}]', '{"ar": "الخبرة المهنية", "bn": "পেশাগত অভিজ্ঞতা", "en": "Professional Experience"}', '{"ar": "يلتحق خريجو هذا البرنامج بالتدريب الداخلي والوظائف المبتدئة لدى مؤسساتنا الشريكة.", "bn": "এই প্রোগ্রামের স্নাতকরা আমাদের অংশীদার প্রতিষ্ঠানে ইন্টার্নশিপ এবং এন্ট্রি-লেভেল ভূমিকায় যোগ দেয়।", "en": "Graduates of this program go on to internships and entry-level roles with our partner institutions, building real professional experience before they finish."}', '[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "محاضرات", "bn": "লেকচার", "en": "Lectures"}, "value": {"ar": "20", "bn": "20", "en": "20"}}, {"icon": {"value": "pencil", "source": "lucide"}, "label": {"ar": "اختبارات", "bn": "কুইজ", "en": "Quizes"}, "value": {"ar": "12", "bn": "12", "en": "12"}}, {"icon": {"value": "globe", "source": "lucide"}, "label": {"ar": "اللغة", "bn": "ভাষা", "en": "Language"}, "value": {"ar": "الإنجليزية", "bn": "ইংরেজি", "en": "English"}}, {"icon": {"value": "map-pin", "source": "lucide"}, "label": {"ar": "الموقع", "bn": "অবস্থান", "en": "Location"}, "value": {"ar": "في الحرم الجامعي", "bn": "ক্যাম্পাসে", "en": "On Campus"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "شهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}, {"icon": {"value": "circle-check", "source": "lucide"}, "label": {"ar": "تقييمات", "bn": "মূল্যায়ন", "en": "Assessments"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}]', 1, 4, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(5, 'health-administration', '{"ar": "إدارة الصحة", "bn": "স্বাস্থ্য প্রশাসন", "en": "Health Administration"}', '{"ar": "صحة", "bn": "স্বাস্থ্য", "en": "Health"}', 'site/courses/health-administration.jpg', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 10, 4.0, 75, '{"ar": "4 سنوات", "bn": "৪ বছর", "en": "04 Years"}', '$750', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه الدورة للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই কোর্সটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>"}', 'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg', '{"ar": "أنجيلا فيجيل", "bn": "অ্যাঞ্জেলা ভিজিল", "en": "Angela Vigil"}', 'site/courses-instructor.jpg', '{"ar": "50 طالبًا", "bn": "৫০ জন শিক্ষার্থী", "en": "50 Students"}', '{"ar": "متطلبات الدورة", "bn": "কোর্সের প্রয়োজনীয়তা", "en": "Course Requirement"}', '[{"text": {"ar": "شهادة مدرسة ثانوية معترف بها.", "bn": "একটি স্বীকৃত মাধ্যমিক বিদ্যালয়ের সার্টিফিকেট।", "en": "A recognized secondary school certificate."}}, {"text": {"ar": "إتقان أساسي للغة الإنجليزية.", "bn": "ইংরেজিতে প্রাথমিক দক্ষতা।", "en": "Basic proficiency in English."}}, {"text": {"ar": "استمارة قبول مكتملة وصورة جواز سفر.", "bn": "পূরণকৃত ভর্তি ফর্ম এবং পাসপোর্ট ছবি।", "en": "A completed admission form and passport photo."}}]', '{"ar": "الخبرة المهنية", "bn": "পেশাগত অভিজ্ঞতা", "en": "Professional Experience"}', '{"ar": "يلتحق خريجو هذا البرنامج بالتدريب الداخلي والوظائف المبتدئة لدى مؤسساتنا الشريكة.", "bn": "এই প্রোগ্রামের স্নাতকরা আমাদের অংশীদার প্রতিষ্ঠানে ইন্টার্নশিপ এবং এন্ট্রি-লেভেল ভূমিকায় যোগ দেয়।", "en": "Graduates of this program go on to internships and entry-level roles with our partner institutions, building real professional experience before they finish."}', '[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "محاضرات", "bn": "লেকচার", "en": "Lectures"}, "value": {"ar": "20", "bn": "20", "en": "20"}}, {"icon": {"value": "pencil", "source": "lucide"}, "label": {"ar": "اختبارات", "bn": "কুইজ", "en": "Quizes"}, "value": {"ar": "12", "bn": "12", "en": "12"}}, {"icon": {"value": "globe", "source": "lucide"}, "label": {"ar": "اللغة", "bn": "ভাষা", "en": "Language"}, "value": {"ar": "الإنجليزية", "bn": "ইংরেজি", "en": "English"}}, {"icon": {"value": "map-pin", "source": "lucide"}, "label": {"ar": "الموقع", "bn": "অবস্থান", "en": "Location"}, "value": {"ar": "في الحرم الجامعي", "bn": "ক্যাম্পাসে", "en": "On Campus"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "شهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}, {"icon": {"value": "circle-check", "source": "lucide"}, "label": {"ar": "تقييمات", "bn": "মূল্যায়ন", "en": "Assessments"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}]', 1, 5, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(6, 'accounting-and-finance', '{"ar": "المحاسبة والتمويل", "bn": "হিসাববিজ্ঞান ও অর্থায়ন", "en": "Accounting And Finance"}', '{"ar": "تمويل", "bn": "অর্থায়ন", "en": "Finance"}', 'site/courses/accounting-and-finance.jpg', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages orem psum available but the majority have suffer alteration in some form by injected."}', 10, 4.0, 75, '{"ar": "4 سنوات", "bn": "৪ বছর", "en": "04 Years"}', '$750', '{"ar": "<p>من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.</p><p>توفر هذه الدورة للطلاب المعرفة العملية والنظرية على حد سواء.</p>", "bn": "<p>এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।</p><p>আমাদের এই কোর্সটি শিক্ষার্থীদের ব্যবহারিক ও তাত্ত্বিক জ্ঞান উভয়ই প্রদান করে।</p>", "en": "<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>"}', 'site/courses-gallery-1.jpg', 'site/courses-gallery-2.jpg', '{"ar": "سوزان لونسفورد", "bn": "সুসান লান্সফোর্ড", "en": "Susan Lunsford"}', 'site/courses-instructor.jpg', '{"ar": "50 طالبًا", "bn": "৫০ জন শিক্ষার্থী", "en": "50 Students"}', '{"ar": "متطلبات الدورة", "bn": "কোর্সের প্রয়োজনীয়তা", "en": "Course Requirement"}', '[{"text": {"ar": "شهادة مدرسة ثانوية معترف بها.", "bn": "একটি স্বীকৃত মাধ্যমিক বিদ্যালয়ের সার্টিফিকেট।", "en": "A recognized secondary school certificate."}}, {"text": {"ar": "إتقان أساسي للغة الإنجليزية.", "bn": "ইংরেজিতে প্রাথমিক দক্ষতা।", "en": "Basic proficiency in English."}}, {"text": {"ar": "استمارة قبول مكتملة وصورة جواز سفر.", "bn": "পূরণকৃত ভর্তি ফর্ম এবং পাসপোর্ট ছবি।", "en": "A completed admission form and passport photo."}}]', '{"ar": "الخبرة المهنية", "bn": "পেশাগত অভিজ্ঞতা", "en": "Professional Experience"}', '{"ar": "يلتحق خريجو هذا البرنامج بالتدريب الداخلي والوظائف المبتدئة لدى مؤسساتنا الشريكة.", "bn": "এই প্রোগ্রামের স্নাতকরা আমাদের অংশীদার প্রতিষ্ঠানে ইন্টার্নশিপ এবং এন্ট্রি-লেভেল ভূমিকায় যোগ দেয়।", "en": "Graduates of this program go on to internships and entry-level roles with our partner institutions, building real professional experience before they finish."}', '[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "محاضرات", "bn": "লেকচার", "en": "Lectures"}, "value": {"ar": "20", "bn": "20", "en": "20"}}, {"icon": {"value": "pencil", "source": "lucide"}, "label": {"ar": "اختبارات", "bn": "কুইজ", "en": "Quizes"}, "value": {"ar": "12", "bn": "12", "en": "12"}}, {"icon": {"value": "globe", "source": "lucide"}, "label": {"ar": "اللغة", "bn": "ভাষা", "en": "Language"}, "value": {"ar": "الإنجليزية", "bn": "ইংরেজি", "en": "English"}}, {"icon": {"value": "map-pin", "source": "lucide"}, "label": {"ar": "الموقع", "bn": "অবস্থান", "en": "Location"}, "value": {"ar": "في الحرم الجامعي", "bn": "ক্যাম্পাসে", "en": "On Campus"}}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "شهادة", "bn": "সার্টিফিকেট", "en": "Certificate"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}, {"icon": {"value": "circle-check", "source": "lucide"}, "label": {"ar": "تقييمات", "bn": "মূল্যায়ন", "en": "Assessments"}, "value": {"ar": "نعم", "bn": "হ্যাঁ", "en": "Yes"}}]', 1, 6, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}', '{"ar": "تحقق من دوراتنا", "bn": "আমাদের কোর্সগুলো দেখুন", "en": "Let\'s Check Our Courses"}', '{"ar": "دورات", "bn": "কোর্স", "en": "Courses"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}', 'site/courses-breadcrumb.jpg', '{"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}', '{"ar": "تصفح الدورات التي تقدمها مدرستنا - المدة والرسوم والمقاعد ومتطلبات كل برنامج.", "bn": "আমাদের স্কুলের কোর্সসমূহ ব্রাউজ করুন — সময়কাল, ফি, আসন এবং প্রতিটি প্রোগ্রামের প্রয়োজনীয়তা।", "en": "Browse the courses offered by our school — duration, fees, seats, and requirements for each program."}', '{"ar": "دورات، القبول، دورات المدرسة", "bn": "কোর্স, ভর্তি, স্কুল কোর্স", "en": "courses, admission, school courses"}', '2026-07-23 17:50:37', '2026-07-23 17:50:37');
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
	(1, '{"ar": "القسم", "bn": "বিভাগ", "en": "Department"}', '{"ar": "تصفح أقسامنا", "bn": "আমাদের বিভাগসমূহ দেখুন", "en": "Browse Our Department"}', '{"ar": "القسم", "bn": "বিভাগ", "en": "Department"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "القسم الأكاديمي", "bn": "একাডেমিক বিভাগ", "en": "Academics Department"}', 'site/departments-breadcrumb.jpg', '{"ar": "القسم الأكاديمي", "bn": "একাডেমিক বিভাগ", "en": "Academics Department"}', '{"ar": "استكشف الأقسام الأكاديمية المتوفرة في مدرستنا.", "bn": "আমাদের স্কুলে প্রদত্ত একাডেমিক বিভাগসমূহ দেখুন।", "en": "Explore the academic departments offered at our school."}', '{"ar": "قسم، أكاديمي، هيئة تدريس", "bn": "বিভাগ, একাডেমিক, অনুষদ", "en": "department, academics, faculty"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"en": "Haji Motiur Rahman"}', '{"en": "Land Donation"}', '1925', 1, 1, '2026-07-25 17:36:01', '2026-07-25 17:36:01'),
	(2, '{"en": "Amina Khatun Trust"}', '{"en": "Library Building"}', '1962', 1, 2, '2026-07-25 17:36:01', '2026-07-25 17:36:01'),
	(3, '{"en": "Md. Ismail Hossain"}', '{"en": "Science Lab Equipment"}', '1988', 1, 3, '2026-07-25 17:36:01', '2026-07-25 17:36:01'),
	(4, '{"en": "Sultana Begum Foundation"}', '{"en": "Scholarship Fund"}', '2005', 1, 4, '2026-07-25 17:36:01', '2026-07-25 17:36:01'),
	(5, '{"en": "Anwarul Azim"}', '{"en": "Auditorium Construction"}', '2012', 1, 5, '2026-07-25 17:36:01', '2026-07-25 17:36:01');
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
	(1, 'high-school-program-2024', '{"ar": "برنامج المدرسة الثانوية 2024", "bn": "হাই স্কুল প্রোগ্রাম ২০২৪", "en": "High School Program 2024"}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'site/events/high-school-program-2024.jpg', '2024-06-16', '10.00AM - 04.00PM', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', '[{"title": {"ar": "حول الفعالية", "bn": "অনুষ্ঠান সম্পর্কে", "en": "About The Event"}, "description": {"ar": "توفر هذه الفعالية للطلاب تجربة مهمة.", "bn": "এই অনুষ্ঠানটি শিক্ষার্থীদের জন্য একটি গুরুত্বপূর্ণ অভিজ্ঞতা প্রদান করে।", "en": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable."}}, {"title": {"ar": "أين تقام الفعالية؟", "bn": "অনুষ্ঠানটি কোথায়?", "en": "Where The Event?"}, "description": {"ar": "ستقام الفعالية في حرم مدرستنا.", "bn": "অনুষ্ঠানটি আমাদের স্কুল ক্যাম্পাসে অনুষ্ঠিত হবে।", "en": "All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}, {"title": {"ar": "لمن هذه الفعالية؟", "bn": "এই অনুষ্ঠানটি কাদের জন্য?", "en": "Who This Event Is For?"}, "description": {"ar": "هذه الفعالية مفتوحة لجميع الطلاب وأولياء الأمور والمعلمين.", "bn": "এই অনুষ্ঠানটি সকল শিক্ষার্থী, অভিভাবক এবং শিক্ষকদের জন্য উন্মুক্ত।", "en": "Generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}]', 'site/events-gallery-1.jpg', 'site/events-gallery-2.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى القابل للقراءة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted the readable content."}', '150', '{"ar": "احجز الآن", "bn": "বুক করুন", "en": "Book Now"}', '/contact', '{"ar": "ريتشارد إم بيل", "bn": "রিচার্ড এম বেল", "en": "Richard M Bell"}', 'site/events-organizer.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'annual-sports-day-2024', '{"ar": "يوم الرياضة السنوي 2024", "bn": "বার্ষিক ক্রীড়া দিবস ২০২৪", "en": "Annual Sports Day 2024"}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'site/events/annual-sports-day-2024.jpg', '2024-07-10', '10.00AM - 04.00PM', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', '[{"title": {"ar": "حول الفعالية", "bn": "অনুষ্ঠান সম্পর্কে", "en": "About The Event"}, "description": {"ar": "توفر هذه الفعالية للطلاب تجربة مهمة.", "bn": "এই অনুষ্ঠানটি শিক্ষার্থীদের জন্য একটি গুরুত্বপূর্ণ অভিজ্ঞতা প্রদান করে।", "en": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable."}}, {"title": {"ar": "أين تقام الفعالية؟", "bn": "অনুষ্ঠানটি কোথায়?", "en": "Where The Event?"}, "description": {"ar": "ستقام الفعالية في حرم مدرستنا.", "bn": "অনুষ্ঠানটি আমাদের স্কুল ক্যাম্পাসে অনুষ্ঠিত হবে।", "en": "All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}, {"title": {"ar": "لمن هذه الفعالية؟", "bn": "এই অনুষ্ঠানটি কাদের জন্য?", "en": "Who This Event Is For?"}, "description": {"ar": "هذه الفعالية مفتوحة لجميع الطلاب وأولياء الأمور والمعلمين.", "bn": "এই অনুষ্ঠানটি সকল শিক্ষার্থী, অভিভাবক এবং শিক্ষকদের জন্য উন্মুক্ত।", "en": "Generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}]', 'site/events-gallery-1.jpg', 'site/events-gallery-2.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى القابل للقراءة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted the readable content."}', '150', '{"ar": "احجز الآن", "bn": "বুক করুন", "en": "Book Now"}', '/contact', '{"ar": "ريتشارد إم بيل", "bn": "রিচার্ড এম বেল", "en": "Richard M Bell"}', 'site/events-organizer.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'science-fair-2024', '{"ar": "معرض العلوم 2024", "bn": "বিজ্ঞান মেলা ২০২৪", "en": "Science Fair 2024"}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'site/events/science-fair-2024.jpg', '2024-08-05', '10.00AM - 04.00PM', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', '[{"title": {"ar": "حول الفعالية", "bn": "অনুষ্ঠান সম্পর্কে", "en": "About The Event"}, "description": {"ar": "توفر هذه الفعالية للطلاب تجربة مهمة.", "bn": "এই অনুষ্ঠানটি শিক্ষার্থীদের জন্য একটি গুরুত্বপূর্ণ অভিজ্ঞতা প্রদান করে।", "en": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable."}}, {"title": {"ar": "أين تقام الفعالية؟", "bn": "অনুষ্ঠানটি কোথায়?", "en": "Where The Event?"}, "description": {"ar": "ستقام الفعالية في حرم مدرستنا.", "bn": "অনুষ্ঠানটি আমাদের স্কুল ক্যাম্পাসে অনুষ্ঠিত হবে।", "en": "All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}, {"title": {"ar": "لمن هذه الفعالية؟", "bn": "এই অনুষ্ঠানটি কাদের জন্য?", "en": "Who This Event Is For?"}, "description": {"ar": "هذه الفعالية مفتوحة لجميع الطلاب وأولياء الأمور والمعلمين.", "bn": "এই অনুষ্ঠানটি সকল শিক্ষার্থী, অভিভাবক এবং শিক্ষকদের জন্য উন্মুক্ত।", "en": "Generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}]', 'site/events-gallery-1.jpg', 'site/events-gallery-2.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى القابل للقراءة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted the readable content."}', '150', '{"ar": "احجز الآن", "bn": "বুক করুন", "en": "Book Now"}', '/contact', '{"ar": "ريتشارد إم بيل", "bn": "রিচার্ড এম বেল", "en": "Richard M Bell"}', 'site/events-organizer.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, 'cultural-festival-2024', '{"ar": "المهرجان الثقافي 2024", "bn": "সাংস্কৃতিক উৎসব ২০২৪", "en": "Cultural Festival 2024"}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'site/events/cultural-festival-2024.jpg', '2024-09-12', '10.00AM - 04.00PM', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', '[{"title": {"ar": "حول الفعالية", "bn": "অনুষ্ঠান সম্পর্কে", "en": "About The Event"}, "description": {"ar": "توفر هذه الفعالية للطلاب تجربة مهمة.", "bn": "এই অনুষ্ঠানটি শিক্ষার্থীদের জন্য একটি গুরুত্বপূর্ণ অভিজ্ঞতা প্রদান করে।", "en": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable."}}, {"title": {"ar": "أين تقام الفعالية؟", "bn": "অনুষ্ঠানটি কোথায়?", "en": "Where The Event?"}, "description": {"ar": "ستقام الفعالية في حرم مدرستنا.", "bn": "অনুষ্ঠানটি আমাদের স্কুল ক্যাম্পাসে অনুষ্ঠিত হবে।", "en": "All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}, {"title": {"ar": "لمن هذه الفعالية؟", "bn": "এই অনুষ্ঠানটি কাদের জন্য?", "en": "Who This Event Is For?"}, "description": {"ar": "هذه الفعالية مفتوحة لجميع الطلاب وأولياء الأمور والمعلمين.", "bn": "এই অনুষ্ঠানটি সকল শিক্ষার্থী, অভিভাবক এবং শিক্ষকদের জন্য উন্মুক্ত।", "en": "Generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}]', 'site/events-gallery-1.jpg', 'site/events-gallery-2.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى القابل للقراءة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted the readable content."}', '150', '{"ar": "احجز الآن", "bn": "বুক করুন", "en": "Book Now"}', '/contact', '{"ar": "ريتشارد إم بيل", "bn": "রিচার্ড এম বেল", "en": "Richard M Bell"}', 'site/events-organizer.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(5, 'parents-teacher-meeting', '{"ar": "اجتماع أولياء الأمور والمعلمين", "bn": "অভিভাবক শিক্ষক সভা", "en": "Parents Teacher Meeting"}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'site/events/parents-teacher-meeting.jpg', '2024-10-01', '10.00AM - 04.00PM', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', '[{"title": {"ar": "حول الفعالية", "bn": "অনুষ্ঠান সম্পর্কে", "en": "About The Event"}, "description": {"ar": "توفر هذه الفعالية للطلاب تجربة مهمة.", "bn": "এই অনুষ্ঠানটি শিক্ষার্থীদের জন্য একটি গুরুত্বপূর্ণ অভিজ্ঞতা প্রদান করে।", "en": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable."}}, {"title": {"ar": "أين تقام الفعالية؟", "bn": "অনুষ্ঠানটি কোথায়?", "en": "Where The Event?"}, "description": {"ar": "ستقام الفعالية في حرم مدرستنا.", "bn": "অনুষ্ঠানটি আমাদের স্কুল ক্যাম্পাসে অনুষ্ঠিত হবে।", "en": "All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}, {"title": {"ar": "لمن هذه الفعالية؟", "bn": "এই অনুষ্ঠানটি কাদের জন্য?", "en": "Who This Event Is For?"}, "description": {"ar": "هذه الفعالية مفتوحة لجميع الطلاب وأولياء الأمور والمعلمين.", "bn": "এই অনুষ্ঠানটি সকল শিক্ষার্থী, অভিভাবক এবং শিক্ষকদের জন্য উন্মুক্ত।", "en": "Generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}]', 'site/events-gallery-1.jpg', 'site/events-gallery-2.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى القابل للقراءة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted the readable content."}', '150', '{"ar": "احجز الآن", "bn": "বুক করুন", "en": "Book Now"}', '/contact', '{"ar": "ريتشارد إم بيل", "bn": "রিচার্ড এম বেল", "en": "Richard M Bell"}', 'site/events-organizer.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 1, 5, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(6, 'annual-prize-giving-ceremony', '{"ar": "حفل توزيع الجوائز السنوي", "bn": "বার্ষিক পুরস্কার বিতরণী অনুষ্ঠান", "en": "Annual Prize Giving Ceremony"}', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', 'site/events/annual-prize-giving-ceremony.jpg', '2024-12-20', '10.00AM - 04.00PM', '{"ar": "هناك العديد من الاختلافات في المقاطع، ومعظمها يحتوي على بعض الفكاهة المضافة.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages the majority have some injected humour."}', '[{"title": {"ar": "حول الفعالية", "bn": "অনুষ্ঠান সম্পর্কে", "en": "About The Event"}, "description": {"ar": "توفر هذه الفعالية للطلاب تجربة مهمة.", "bn": "এই অনুষ্ঠানটি শিক্ষার্থীদের জন্য একটি গুরুত্বপূর্ণ অভিজ্ঞতা প্রদান করে।", "en": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable."}}, {"title": {"ar": "أين تقام الفعالية؟", "bn": "অনুষ্ঠানটি কোথায়?", "en": "Where The Event?"}, "description": {"ar": "ستقام الفعالية في حرم مدرستنا.", "bn": "অনুষ্ঠানটি আমাদের স্কুল ক্যাম্পাসে অনুষ্ঠিত হবে।", "en": "All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}, {"title": {"ar": "لمن هذه الفعالية؟", "bn": "এই অনুষ্ঠানটি কাদের জন্য?", "en": "Who This Event Is For?"}, "description": {"ar": "هذه الفعالية مفتوحة لجميع الطلاب وأولياء الأمور والمعلمين.", "bn": "এই অনুষ্ঠানটি সকল শিক্ষার্থী, অভিভাবক এবং শিক্ষকদের জন্য উন্মুক্ত।", "en": "Generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet."}}]', 'site/events-gallery-1.jpg', 'site/events-gallery-2.jpg', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى القابل للقراءة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পঠনযোগ্য বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted the readable content."}', '150', '{"ar": "احجز الآن", "bn": "বুক করুন", "en": "Book Now"}', '/contact', '{"ar": "ريتشارد إم بيل", "bn": "রিচার্ড এম বেল", "en": "Richard M Bell"}', 'site/events-organizer.jpg', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', 1, 6, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}', '{"ar": "فعالياتنا القادمة", "bn": "আমাদের আসন্ন অনুষ্ঠানসমূহ", "en": "Our Upcoming Events"}', '{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "الفعاليات", "bn": "অনুষ্ঠান", "en": "Events"}', 'site/events-breadcrumb.jpg', '{"ar": "فعالياتنا القادمة", "bn": "আমাদের আসন্ন অনুষ্ঠানসমূহ", "en": "Our Upcoming Events"}', '{"ar": "اطلع على الفعاليات والبرامج والأنشطة القادمة في مدرستنا.", "bn": "আমাদের স্কুলের আসন্ন অনুষ্ঠান, প্রোগ্রাম এবং কার্যক্রম দেখুন।", "en": "See upcoming events, programs, and activities at our school."}', '{"ar": "فعاليات، برامج مدرسية، أنشطة", "bn": "অনুষ্ঠান, স্কুল প্রোগ্রাম, কার্যক্রম", "en": "events, school programs, activities"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"ar": "كيف يمكنني التقديم؟", "bn": "আমি কীভাবে আবেদন করতে পারি?", "en": "How Can do I apply ?"}', '{"ar": "يمكنك التقديم من خلال ملء استمارة الطلب عبر الإنترنت من صفحة القبول في موقعنا الإلكتروني، أو زيارة المكتب مباشرة.", "bn": "আপনি আমাদের ওয়েবসাইটের ভর্তি পৃষ্ঠা থেকে অনলাইন আবেদন ফর্ম পূরণ করে আবেদন করতে পারেন, অথবা সরাসরি অফিসে যোগাযোগ করতে পারেন।", "en": "We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis."}', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, '{"ar": "كيف يمكنني أن أصبح عضوًا؟", "bn": "আমি কীভাবে সদস্য হতে পারি?", "en": "How Can I Become A Member ?"}', '{"ar": "يمكن تأكيد العضوية بعد اجتياز اختبار القبول وتقديم المستندات المطلوبة.", "bn": "ভর্তি পরীক্ষায় উত্তীর্ণ হওয়ার পর প্রয়োজনীয় কাগজপত্র জমা দিয়ে সদস্যপদ নিশ্চিত করা যায়।", "en": "We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis."}', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, '{"ar": "ما هي بوابات الدفع التي تدعمونها؟", "bn": "আপনারা কোন পেমেন্ট গেটওয়ে সমর্থন করেন?", "en": "What Payment Gateway You Support ?"}', '{"ar": "ندعم الخدمات المصرفية عبر الهاتف المحمول والتحويل البنكي والدفع المباشر في المكتب.", "bn": "আমরা মোবাইল ব্যাংকিং, ব্যাংক ট্রান্সফার এবং সরাসরি অফিস পেমেন্ট সমর্থন করি।", "en": "We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis."}', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, '{"ar": "كيف يمكنني إلغاء طلبي؟", "bn": "আমি কীভাবে আমার অনুরোধ বাতিল করতে পারি?", "en": "How Can I Cancel My Request ?"}', '{"ar": "يمكنك إلغاء طلبك عن طريق الاتصال بالمكتب مباشرة أو عبر البريد الإلكتروني.", "bn": "আপনি অফিসে সরাসরি যোগাযোগ করে অথবা ইমেইলের মাধ্যমে আপনার অনুরোধ বাতিল করতে পারেন।", "en": "We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire ante odio dignissim quam vitae pulvinar turpis."}', 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"ar": "الأسئلة الشائعة", "bn": "সাধারণ জিজ্ঞাসা", "en": "Faq\'s"}', '{"ar": "الأسئلة الشائعة العامة", "bn": "সাধারণ জিজ্ঞাসিত প্রশ্নসমূহ", "en": "General frequently asked questions"}', '{"ar": "الشائعة", "bn": "জিজ্ঞাসিত", "en": "frequently"}', '{"ar": "يمكنكم العثور هنا على إجابات للأسئلة الشائعة المتعلقة بمدرستنا. لمزيد من المعلومات، يرجى الاتصال بنا.", "bn": "আমাদের স্কুল সম্পর্কিত সাধারণ প্রশ্নের উত্তর এখানে পাওয়া যাবে। আরও তথ্যের জন্য অনুগ্রহ করে আমাদের সাথে যোগাযোগ করুন।", "en": "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even."}', '{"ar": "هل لديك سؤال؟", "bn": "কোনো প্রশ্ন আছে ?", "en": "Have Any Question ?"}', '/search', '{"ar": "الأسئلة الشائعة", "bn": "সাধারণ জিজ্ঞাসা", "en": "Faq\'s"}', 'site/faq-breadcrumb.jpg', '{"ar": "الأسئلة الشائعة", "bn": "সাধারণ জিজ্ঞাসা", "en": "Faq\'s"}', '{"ar": "اعثر على إجابات للأسئلة الشائعة حول مدرستنا.", "bn": "আমাদের স্কুল সম্পর্কে সাধারণ জিজ্ঞাসিত প্রশ্নের উত্তর খুঁজুন।", "en": "Find answers to frequently asked questions about our school."}', '{"ar": "الأسئلة الشائعة، أسئلة، مساعدة", "bn": "সাধারণ জিজ্ঞাসা, প্রশ্ন, সাহায্য", "en": "faq, questions, help"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"en": "Md. Abdul Karim"}', '{"en": "Founder & Chairman"}', '1918', 1, 1, '2026-07-25 17:36:01', '2026-07-25 17:36:01'),
	(2, '{"en": "Abdur Rahman Talukder"}', '{"en": "Co-Founder"}', '1918', 1, 2, '2026-07-25 17:36:01', '2026-07-25 17:36:01'),
	(3, '{"en": "Kazi Nurul Islam"}', '{"en": "Founding Secretary"}', '1918', 1, 3, '2026-07-25 17:36:01', '2026-07-25 17:36:01'),
	(4, '{"en": "Md. Sirajul Haque"}', '{"en": "Founding Member"}', '1918', 1, 4, '2026-07-25 17:36:01', '2026-07-25 17:36:01');
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
	(1, '{"bn": "আমাদের অবদানকারী", "en": "Our Contributors"}', '{"bn": "প্রতিষ্ঠাতা ও দাতাদের তালিকা", "en": "Founder & Donor List"}', '{"bn": "দাতা", "en": "Donor"}', '{"bn": "যাদের দূরদর্শিতা ও উদার সহযোগিতায় এই প্রতিষ্ঠানের বিকাশ সম্ভব হয়েছে, আমরা কৃতজ্ঞতার সাথে সেই প্রতিষ্ঠাতা সদস্য ও দাতাদের স্মরণ করছি।", "en": "We gratefully acknowledge the founding members and generous donors whose vision and support made the growth of this institution possible."}', '{"bn": "প্রতিষ্ঠাতা সদস্যবৃন্দ", "en": "Founding Members"}', '{"bn": "সম্মানিত দাতাবৃন্দ", "en": "Honorable Donors"}', '{"bn": "প্রতিষ্ঠাতা ও দাতাদের তালিকা", "en": "Founder & Donor List"}', 'site/founders-donors-breadcrumb.jpg', '{"en": "Founder & Donor List"}', '{"en": "Meet the founding members and generous donors who made this institution possible."}', '{"en": "founders, donors, contributors"}', '2026-07-25 17:36:01', '2026-07-25 17:40:52');
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
	(1, '{"ar": "معرض الصور", "bn": "গ্যালারি", "en": "Gallery"}', '{"ar": "معرض صورنا", "bn": "আমাদের ফটো গ্যালারি", "en": "Our Photo Gallery"}', '{"ar": "المعرض", "bn": "গ্যালারি", "en": "Gallery"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "المعرض", "bn": "গ্যালারি", "en": "Gallery"}', 'site/gallery-breadcrumb.jpg', '{"ar": "معرض صورنا", "bn": "আমাদের ফটো গ্যালারি", "en": "Our Photo Gallery"}', '{"ar": "تصفح صور الحياة الجامعية والفعاليات والأنشطة في مدرستنا.", "bn": "আমাদের স্কুলের ক্যাম্পাস জীবন, অনুষ্ঠান এবং কার্যক্রমের ছবি ব্রাউজ করুন।", "en": "Browse photos from campus life, events, and activities at our school."}', '{"ar": "معرض، صور، فعاليات مدرسية", "bn": "গ্যালারি, ছবি, স্কুল অনুষ্ঠান", "en": "gallery, photos, school events"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, 'mid-term-examination-routine-2026', '{"ar": "جدول امتحانات منتصف الفصل الدراسي 2026", "bn": "মধ্যবর্তী পরীক্ষার রুটিন ২০২৬", "en": "Mid-Term Examination Routine 2026"}', '{"ar": "<p>يرجى الاطلاع على التفاصيل المتعلقة بهذا الإشعار. يُرجى من جميع الطلاب وأولياء الأمور والموظفين المعنيين مراعاة الجدول والمتطلبات المذكورة أعلاه.</p><p>لأي استفسارات، يرجى الاتصال بمكتب المدرسة خلال ساعات العمل.</p>", "bn": "<p>এই বিজ্ঞপ্তি সম্পর্কিত বিস্তারিত জানতে অনুরোধ করা হচ্ছে। সকল সংশ্লিষ্ট শিক্ষার্থী, অভিভাবক এবং কর্মীদের উপরে উল্লিখিত সময়সূচি ও প্রয়োজনীয়তা লক্ষ্য করার অনুরোধ করা হলো।</p><p>যেকোনো জিজ্ঞাসার জন্য, অনুগ্রহ করে কর্মঘণ্টার মধ্যে স্কুল অফিসে যোগাযোগ করুন।</p>", "en": "<p>Please be informed of the details regarding this notice. All concerned students, parents, and staff are requested to take note of the schedule and requirements mentioned above.</p><p>For any queries, please contact the school office during working hours.</p>"}', 'site/notices/mid-term-examination-routine-2026.pdf', '2026-07-10', 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, 'annual-sports-day-notice', '{"ar": "إشعار يوم الرياضة السنوي", "bn": "বার্ষিক ক্রীড়া দিবস বিজ্ঞপ্তি", "en": "Annual Sports Day Notice"}', '{"ar": "<p>يرجى الاطلاع على التفاصيل المتعلقة بهذا الإشعار. يُرجى من جميع الطلاب وأولياء الأمور والموظفين المعنيين مراعاة الجدول والمتطلبات المذكورة أعلاه.</p><p>لأي استفسارات، يرجى الاتصال بمكتب المدرسة خلال ساعات العمل.</p>", "bn": "<p>এই বিজ্ঞপ্তি সম্পর্কিত বিস্তারিত জানতে অনুরোধ করা হচ্ছে। সকল সংশ্লিষ্ট শিক্ষার্থী, অভিভাবক এবং কর্মীদের উপরে উল্লিখিত সময়সূচি ও প্রয়োজনীয়তা লক্ষ্য করার অনুরোধ করা হলো।</p><p>যেকোনো জিজ্ঞাসার জন্য, অনুগ্রহ করে কর্মঘণ্টার মধ্যে স্কুল অফিসে যোগাযোগ করুন।</p>", "en": "<p>Please be informed of the details regarding this notice. All concerned students, parents, and staff are requested to take note of the schedule and requirements mentioned above.</p><p>For any queries, please contact the school office during working hours.</p>"}', 'site/notices/annual-sports-day-notice.pdf', '2026-06-28', 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, 'summer-vacation-notice', '{"ar": "إشعار العطلة الصيفية", "bn": "গ্রীষ্মকালীন ছুটির বিজ্ঞপ্তি", "en": "Summer Vacation Notice"}', '{"ar": "<p>يرجى الاطلاع على التفاصيل المتعلقة بهذا الإشعار. يُرجى من جميع الطلاب وأولياء الأمور والموظفين المعنيين مراعاة الجدول والمتطلبات المذكورة أعلاه.</p><p>لأي استفسارات، يرجى الاتصال بمكتب المدرسة خلال ساعات العمل.</p>", "bn": "<p>এই বিজ্ঞপ্তি সম্পর্কিত বিস্তারিত জানতে অনুরোধ করা হচ্ছে। সকল সংশ্লিষ্ট শিক্ষার্থী, অভিভাবক এবং কর্মীদের উপরে উল্লিখিত সময়সূচি ও প্রয়োজনীয়তা লক্ষ্য করার অনুরোধ করা হলো।</p><p>যেকোনো জিজ্ঞাসার জন্য, অনুগ্রহ করে কর্মঘণ্টার মধ্যে স্কুল অফিসে যোগাযোগ করুন।</p>", "en": "<p>Please be informed of the details regarding this notice. All concerned students, parents, and staff are requested to take note of the schedule and requirements mentioned above.</p><p>For any queries, please contact the school office during working hours.</p>"}', 'site/notices/summer-vacation-notice.pdf', '2026-06-15', 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, 'admission-test-result-publication', '{"ar": "نشر نتائج اختبار القبول", "bn": "ভর্তি পরীক্ষার ফলাফল প্রকাশ", "en": "Admission Test Result Publication"}', '{"ar": "<p>يرجى الاطلاع على التفاصيل المتعلقة بهذا الإشعار. يُرجى من جميع الطلاب وأولياء الأمور والموظفين المعنيين مراعاة الجدول والمتطلبات المذكورة أعلاه.</p><p>لأي استفسارات، يرجى الاتصال بمكتب المدرسة خلال ساعات العمل.</p>", "bn": "<p>এই বিজ্ঞপ্তি সম্পর্কিত বিস্তারিত জানতে অনুরোধ করা হচ্ছে। সকল সংশ্লিষ্ট শিক্ষার্থী, অভিভাবক এবং কর্মীদের উপরে উল্লিখিত সময়সূচি ও প্রয়োজনীয়তা লক্ষ্য করার অনুরোধ করা হলো।</p><p>যেকোনো জিজ্ঞাসার জন্য, অনুগ্রহ করে কর্মঘণ্টার মধ্যে স্কুল অফিসে যোগাযোগ করুন।</p>", "en": "<p>Please be informed of the details regarding this notice. All concerned students, parents, and staff are requested to take note of the schedule and requirements mentioned above.</p><p>For any queries, please contact the school office during working hours.</p>"}', 'site/notices/admission-test-result-publication.pdf', '2026-06-02', 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(5, 'parents-teacher-meeting-schedule', '{"ar": "جدول اجتماع أولياء الأمور والمعلمين", "bn": "অভিভাবক-শিক্ষক সভার সময়সূচি", "en": "Parents-Teacher Meeting Schedule"}', '{"ar": "<p>يرجى الاطلاع على التفاصيل المتعلقة بهذا الإشعار. يُرجى من جميع الطلاب وأولياء الأمور والموظفين المعنيين مراعاة الجدول والمتطلبات المذكورة أعلاه.</p><p>لأي استفسارات، يرجى الاتصال بمكتب المدرسة خلال ساعات العمل.</p>", "bn": "<p>এই বিজ্ঞপ্তি সম্পর্কিত বিস্তারিত জানতে অনুরোধ করা হচ্ছে। সকল সংশ্লিষ্ট শিক্ষার্থী, অভিভাবক এবং কর্মীদের উপরে উল্লিখিত সময়সূচি ও প্রয়োজনীয়তা লক্ষ্য করার অনুরোধ করা হলো।</p><p>যেকোনো জিজ্ঞাসার জন্য, অনুগ্রহ করে কর্মঘণ্টার মধ্যে স্কুল অফিসে যোগাযোগ করুন।</p>", "en": "<p>Please be informed of the details regarding this notice. All concerned students, parents, and staff are requested to take note of the schedule and requirements mentioned above.</p><p>For any queries, please contact the school office during working hours.</p>"}', 'site/notices/parents-teacher-meeting-schedule.pdf', '2026-05-20', 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(6, 'half-yearly-exam-result-notice', '{"ar": "إشعار نتائج الامتحان نصف السنوي", "bn": "অর্ধ-বার্ষিক পরীক্ষার ফলাফল বিজ্ঞপ্তি", "en": "Half-Yearly Exam Result Notice"}', '{"ar": "<p>يرجى الاطلاع على التفاصيل المتعلقة بهذا الإشعار. يُرجى من جميع الطلاب وأولياء الأمور والموظفين المعنيين مراعاة الجدول والمتطلبات المذكورة أعلاه.</p><p>لأي استفسارات، يرجى الاتصال بمكتب المدرسة خلال ساعات العمل.</p>", "bn": "<p>এই বিজ্ঞপ্তি সম্পর্কিত বিস্তারিত জানতে অনুরোধ করা হচ্ছে। সকল সংশ্লিষ্ট শিক্ষার্থী, অভিভাবক এবং কর্মীদের উপরে উল্লিখিত সময়সূচি ও প্রয়োজনীয়তা লক্ষ্য করার অনুরোধ করা হলো।</p><p>যেকোনো জিজ্ঞাসার জন্য, অনুগ্রহ করে কর্মঘণ্টার মধ্যে স্কুল অফিসে যোগাযোগ করুন।</p>", "en": "<p>Please be informed of the details regarding this notice. All concerned students, parents, and staff are requested to take note of the schedule and requirements mentioned above.</p><p>For any queries, please contact the school office during working hours.</p>"}', 'site/notices/half-yearly-exam-result-notice.pdf', '2026-05-05', 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}', '{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}', 'site/notices-breadcrumb.jpg', '{"ar": "إشعار", "bn": "বিজ্ঞপ্তি", "en": "Notice"}', '{"ar": "اقرأ أحدث الإشعارات والجداول والإعلانات من مدرستنا.", "bn": "আমাদের স্কুলের সর্বশেষ বিজ্ঞপ্তি, রুটিন এবং ঘোষণা পড়ুন।", "en": "Read the latest notices, routines, and announcements from our school."}', '{"ar": "إشعار، إعلانات، لوحة إعلانات المدرسة", "bn": "বিজ্ঞপ্তি, ঘোষণা, স্কুল নোটিশ বোর্ড", "en": "notice, announcements, school notice board"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(8, 'history', '{"ar": null, "en": "History"}', '{"en": "<div class=\\"wexnix_terms-content\\">\\n    <h3 class=\\"mb-4\\">Our History & Heritage</h3>\\n    <p class=\\"lead mb-4\\">Founded with a vision to provide world-class education, our institution has grown into a pillar of academic distinction.</p>\\n    <p>Established with a dedicated team of educators, we have consistently expanded our academic horizons, modernizing laboratories, expanding campus facilities, and nurturing thousands of successful alumni across diverse fields.</p>\\n</div>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-07-25 16:31:03', '2026-08-05 07:44:40'),
	(9, 'class-schedule', '{"ar": null, "en": "Class Schedule"}', '{"en": "<div class=\\"wexnix_terms-content\\">\\n    <h3 class=\\"mb-4\\">Class Schedule & Timings</h3>\\n    <p class=\\"lead mb-4\\">View daily class hours, assembly times, and regular routines.</p>\\n    <div class=\\"p-4 bg-light rounded-3 mb-4 border\\">\\n        <div class=\\"d-flex justify-content-between border-bottom pb-2 mb-2\\">\\n            <span class=\\"fw-bold\\">Gate Closing</span>\\n            <span class=\\"text-primary font-monospace\\">8.15 A.M. (Regulars)</span>\\n        </div>\\n        <div class=\\"d-flex justify-content-between border-bottom pb-2 mb-2\\">\\n            <span class=\\"fw-bold\\">Assembly</span>\\n            <span class=\\"text-primary font-monospace\\">8.15 A.M. (Sat, Mon, Thu)</span>\\n        </div>\\n        <div class=\\"d-flex justify-content-between\\">\\n            <span class=\\"fw-bold\\">Class Starting</span>\\n            <span class=\\"text-primary font-monospace\\">8.30 A.M. (Regular)</span>\\n        </div>\\n    </div>\\n</div>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-07-25 17:50:49', '2026-08-05 07:44:40'),
	(10, 'why-study', '{"ar": null, "en": "Why Study ?"}', '{"en": "<div class=\\"wexnix_terms-content\\">\\n    <ul>\\n\\t\\t\\t\\t<li>1. Activities of Session start and finish in due time. </li>\\n\\t\\t\\t\\t<li>\\n2. Students are taught by experienced &amp; skillful teachers. </li>\\n\\t\\t\\t\\t<li>\\n3. Safe and enlarged campus. </li>\\n\\t\\t\\t\\t<li>\\n4. Clean, decorated and advanced classrooms.  hello</li>\\n\\t\\t\\t\\t<li>\\n5. Support of Sylhet gives us a full time security. </li>\\n\\t\\t\\t</ul>\\n    <p class=\\"lead mb-4 text-center\\" innerhtml=\\"1. Activities of Session start and finish in due time. \\n2. Students are taught by experienced &amp;amp; skillful teachers. \\n3. Safe and enlarged campus. \\n4. Clean, decorated and advanced classrooms. \\n5. Support of Sylhet gives us a full time security. \\n6. Advanced Science and computer lab. \\n7. A huge Library with ample of books. \\n8. Entirely smoke free and Politics free environment. \\n9. In every session a calendar is clisclosed. \\n10. Ensuring students’ presence with the help of related teachers. \\n11. Ensuring students’ 100% pass with GPA: 5 in the public exams and GPA: 5 holders are given warm reception and crest. \\n12. Ensuring students’ participation in scout/girls Guide and Rover scout. \\n13. After ten days of all semester progress report of the students are sent to the respective guardians for conversance. Progress report of first &amp;amp; second semesters are only taken back from the students. Besides, Answer scripts of the Annual examination are shown to the guardians with the permission of the Humble Principal (If Applicable). \\n14. There is arrangement of guardian’s Meeting for open discussion about study &amp;amp; Progress of the students. \\"></p>\\n    \\n    \\n</div>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-05 07:40:25', '2026-08-05 08:07:51'),
	(11, 'how-to-apply', '{"ar": null, "en": "how-to-apply"}', '{"en": "<h1>Comming Soon</h1>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-16 13:51:24', '2026-08-16 13:51:49'),
	(12, 'library', '{"ar": null, "en": "Library"}', '{"en": "<h1>Coming Soon</h1>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-16 13:57:45', '2026-08-16 13:58:06'),
	(14, 'mobile-banking', '{"ar": null, "en": "Mobile Banking"}', '{"en": "<h1>Mobile Banking</h1><p innerhtml=\\"Lorem ipsum\\">There are many variations of passages available but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage you need to be sure there isn\'t anything embarrassing hidden in the middle of text.\\n\\nThere are many variations of passages available but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-17 14:56:15', '2026-08-17 15:49:48'),
	(15, 'daily-activities', '{"ar": null, "en": "Daily Activities"}', '{"en": "<h1>Daily Activities</h1>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-17 15:54:19', '2026-08-17 15:54:40'),
	(16, 'exam-schedule', '{"ar": null, "en": "Exam Schedule"}', '{"en": "<h1>Exam Schedule</h1>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-17 15:55:17', '2026-08-17 15:55:33'),
	(18, 'student-uniform', '{"ar": null, "en": "Student Uniform"}', '{"en": "<h1>Student Uniform</h1>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-17 15:57:56', '2026-08-17 15:58:09'),
	(19, 'exam-system', '{"ar": null, "en": "Exam System"}', '{"en": "<h1>Exam System</h1>"}', NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-17 15:58:33', '2026-08-17 15:58:43'),
	(20, 'rules-and-regulation', '{"ar": null, "en": "Rules and Regulation"}', NULL, NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', 1, '2026-08-17 16:02:41', '2026-08-17 16:02:41');
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
	(1, '{"ar": "مدرسة ويكسنيكس", "bn": "ওয়েক্সনিক্স স্কুল", "en": "WexNix School"}', 'index-2', 'site/logo.png', 'site/logo-light.png', '{"ar": "شيتاغونغ، بنغلاديش", "bn": "চট্টগ্রাম, বাংলাদেশ", "en": "Chittagong, Bangladesh"}', '+8801712345678', 'info@example.com', 'https://facebook.com', 'https://instagram.com', 'https://youtube.com', 'https://wa.me/8801712345678', 'https://linkedin.com', '{"ar": "نحن ملتزمون برعاية كل طالب بتعليم جيد ومعلمين متفانين وحرم جامعي آمن وملهم.", "bn": "আমরা মানসম্মত শিক্ষা, নিবেদিতপ্রাণ শিক্ষক এবং একটি নিরাপদ, অনুপ্রেরণাদায়ক ক্যাম্পাসে প্রতিটি শিক্ষার্থীকে গড়ে তুলতে প্রতিশ্রুতিবদ্ধ।", "en": "We are dedicated to nurturing every student with quality education, dedicated teachers, and a safe, inspiring campus."}', '{"ar": "جميع الحقوق محفوظة.", "bn": "সর্বস্বত্ব সংরক্ষিত।", "en": "All Rights Reserved."}', '2026-07-23 17:50:37', '2026-08-17 18:23:04', '[{"label": {"ar": "رقم EIIN للمعهد", "bn": "ইনস্টিটিউট EIIN", "en": "Institute EIIN"}, "value": {"ar": "123456", "bn": "১২৩৪৫৬", "en": "123456"}}, {"label": {"ar": "رمز المؤسسة", "bn": "প্রতিষ্ঠান কোড", "en": "Institution Code"}, "value": {"ar": "987654321", "bn": "৯৮৭৬৫৪৩২১", "en": "987654321"}}, {"label": {"ar": "رمز المركز", "bn": "কেন্দ্র কোড", "en": "Center Code"}, "value": {"ar": "101", "bn": "১০১", "en": "101"}}, {"label": {"ar": "سنة التأسيس", "bn": "প্রতিষ্ঠার বছর", "en": "Estd Year"}, "value": {"ar": "1985", "bn": "১৯৮৫", "en": "1985"}}]', '[{"icon": {"value": "book-open", "source": "lucide"}, "label": {"ar": "إجمالي الدورات", "bn": "মোট কোর্স", "en": "Total Courses"}, "value": "500"}, {"icon": {"value": "graduation-cap", "source": "lucide"}, "label": {"ar": "طلابنا", "bn": "আমাদের শিক্ষার্থী", "en": "Our Students"}, "value": "1900"}, {"icon": {"value": "users", "source": "lucide"}, "label": {"ar": "محاضرون مهرة", "bn": "দক্ষ প্রভাষক", "en": "Skilled Lecturers"}, "value": "750"}, {"icon": {"value": "award", "source": "lucide"}, "label": {"ar": "جوائز فائزة", "bn": "বিজয়ী পুরস্কার", "en": "Win Awards"}, "value": "30"}]', '[{"image": "site/partners/02.png"}, {"image": "site/partners/03.png"}, {"image": "site/partners/04.png"}]', '{"ar": "أحدث فيديو", "bn": "সাম্প্রতিক ভিডিও", "en": "Latest Video"}', '{"ar": "شاهد أحدث فيديو لنا", "bn": "আমাদের সাম্প্রতিক ভিডিও দেখুন", "en": "Let\'s Check Our Latest Video"}', '{"ar": "أحدث", "bn": "সাম্প্রতিক", "en": "Latest"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات بشكل أو بآخر.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour look even slightly believable."}', '{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}', '#', 'https://www.youtube.com/watch?v=ckHzmP1evNU', 'site/video-thumbnail.jpg', '{"ar": "عرضنا بخصم 20% مستمر - انضم اليوم لدورتك", "bn": "আমাদের ২০% অফার চলছে - আজই আপনার কোর্সে যোগ দিন", "en": "Our 20% Offer Running - Join Today For Your Course"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable."}', '{"ar": "قدم الآن", "bn": "এখনই আবেদন করুন", "en": "Apply Now"}', '#', 'site/offer-background.jpg', '{"ar": "لماذا تختارنا", "bn": "কেন আমাদের বেছে নেবেন", "en": "Why Choose Us"}', '{"ar": "نحن خبراء ونبذل قصارى جهدنا لتحقيق هدفك", "bn": "আমরা বিশেষজ্ঞ এবং আপনার লক্ষ্যের জন্য সর্বোচ্চ চেষ্টা করি", "en": "We Are Expert & Do Our Best For Your Goal"}', '{"ar": "نبذل قصارى جهدنا", "bn": "সর্বোচ্চ চেষ্টা করি", "en": "Do Our Best"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بالمحتوى المقروء للصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক একটি পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when many desktop and web page editors looking at its layout."}', 'site/choose-image.jpg', '[{"icon": {"value": "user-round", "source": "lucide"}, "title": {"ar": "معلمون خبراء", "bn": "বিশেষজ্ঞ শিক্ষক", "en": "Expert Teachers"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}, {"icon": {"value": "library", "source": "lucide"}, "title": {"ar": "مواد الدورة", "bn": "কোর্স উপকরণ", "en": "Courses Material"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}, {"icon": {"value": "monitor-play", "source": "lucide"}, "title": {"ar": "دورات عبر الإنترنت", "bn": "অনলাইন কোর্স", "en": "Online Courses"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}, {"icon": {"value": "wallet", "source": "lucide"}, "title": {"ar": "سعر معقول", "bn": "সাশ্রয়ী মূল্য", "en": "Affordable Price"}, "description": {"ar": "هناك العديد من الاختلافات التي عانت.", "bn": "অনেক বৈচিত্র্য রয়েছে যা ভুগেছে।", "en": "There are many variation of the suffered."}}]', '{"ar": "ابدأ التسجيل الخاص بك", "bn": "আপনার ভর্তি শুরু করুন", "en": "Start Your Enrollment"}', '{"ar": "نحن اختلافات في المقاطع التي عانت.", "bn": "আমরা অনুচ্ছেদের বিভিন্নতা যা ভুগেছে।", "en": "We are variations of passages the have suffered."}', '{"ar": "مهاراتنا", "bn": "আমাদের দক্ষতা", "en": "Our Skills"}', '{"ar": "اكتشف إبداعك وموهبتك معنا", "bn": "আমাদের সাথে আপনার সৃজনশীলতা ও প্রতিভা অন্বেষণ করুন", "en": "Explore Your Creativity And Talent With Us"}', '{"ar": "الإبداع والموهبة", "bn": "সৃজনশীলতা ও প্রতিভা", "en": "Creativity And Talent"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable. If you are going to use passage you need sure there anything embarrassing first true generator on the Internet."}', '{"ar": "اعرف أكثر", "bn": "আরও জানুন", "en": "Learn More"}', '#', '[{"label": {"ar": "طلابنا", "bn": "আমাদের শিক্ষার্থী", "en": "Our Students"}, "percentage": "85"}, {"label": {"ar": "معلمونا", "bn": "আমাদের শিক্ষক", "en": "Our Teachers"}, "percentage": "65"}, {"label": {"ar": "دوراتنا", "bn": "আমাদের কোর্স", "en": "Our Courses"}, "percentage": "75"}]', '{"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}', '{"ar": "نظام WexNix لدينا يلهمك أكثر.", "bn": "আমাদের ওয়েক্সনিক্স সিস্টেম আপনাকে আরও অনুপ্রাণিত করে।", "en": "Our WexNix Tion System Inspires You More."}', '{"ar": "يلهمك", "bn": "অনুপ্রাণিত করে", "en": "Inspires"}', '{"ar": "هناك العديد من الاختلافات في المقاطع المتاحة، لكن معظمها قد خضع لتعديلات لا تبدو معقولة على الإطلاق.", "bn": "অনেক ধরনের অনুচ্ছেদ পাওয়া যায় তবে বেশিরভাগই কোনো না কোনো আকারে পরিবর্তিত হয়েছে যা বিশ্বাসযোগ্য মনে হয় না।", "en": "There are many variations of passages available but the majority have suffered alteration in some form by injected humour randomised words which don\'t look even slightly believable. If you are going to use passage."}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بمحتوى الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার বিষয়বস্তু দ্বারা বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the content of a page when looking at its reader for the long words layout."}', '{"ar": "اكتشف المزيد", "bn": "আরও জানুন", "en": "Discover More"}', '#', '{"value": "lightbulb", "source": "lucide"}', '{"ar": "30 عامًا من الخدمة الجيدة", "bn": "৩০ বছরের মানসম্মত সেবা", "en": "30 Years Of Quality Service"}', 'site/about-1.jpg', 'site/about-2.jpg', 'site/about-3.jpg', '[{"icon": {"value": "book-open", "source": "lucide"}, "title": {"ar": "خدمات WexNix", "bn": "ওয়েক্সনিক্স সেবা", "en": "WexNix tion Services"}, "description": {"ar": "هذه حقيقة راسخة منذ زمن طويل.", "bn": "এটি একটি দীর্ঘদিনের প্রতিষ্ঠিত সত্য।", "en": "It is a long established fact that reader will to using content."}}, {"icon": {"value": "globe", "source": "lucide"}, "title": {"ar": "مراكز دولية", "bn": "আন্তর্জাতিক হাব", "en": "International Hubs"}, "description": {"ar": "هذه حقيقة راسخة منذ زمن طويل.", "bn": "এটি একটি দীর্ঘদিনের প্রতিষ্ঠিত সত্য।", "en": "It is a long established fact that reader will to using content."}}]', '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, NULL, '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": "روابط سريعة", "bn": "দ্রুত লিঙ্ক", "en": "Quick Links"}', '[{"url": "/about", "label": {"ar": "من نحن", "bn": "আমাদের সম্পর্কে", "en": "About Us"}}, {"url": "/faq", "label": {"ar": "الأسئلة الشائعة", "bn": "সাধারণ প্রশ্ন", "en": "FAQ\'s"}}, {"url": "/testimonials", "label": {"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}}, {"url": "#", "label": {"ar": "شروط الخدمة", "bn": "সেবার শর্তাবলী", "en": "Terms Of Service"}}, {"url": "#", "label": {"ar": "سياسة الخصوصية", "bn": "গোপনীয়তা নীতি", "en": "Privacy policy"}}, {"url": "#", "label": {"ar": "آخر الأخبار", "bn": "সাম্প্রতিক সংবাদ", "en": "Update News"}}]', '{"ar": "حرمنا الجامعي", "bn": "আমাদের ক্যাম্পাস", "en": "Our Campus"}', '[{"url": "#", "label": {"ar": "سلامة الحرم الجامعي", "bn": "ক্যাম্পাস নিরাপত্তা", "en": "Campus Safety"}}, {"url": "#", "label": {"ar": "أنشطة الطلاب", "bn": "শিক্ষার্থী কার্যক্রম", "en": "Student Activities"}}, {"url": "#", "label": {"ar": "القسم الأكاديمي", "bn": "একাডেমিক বিভাগ", "en": "Academic Department"}}, {"url": "#", "label": {"ar": "التخطيط والإدارة", "bn": "পরিকল্পনা ও প্রশাসন", "en": "Planning & Administration"}}, {"url": "#", "label": {"ar": "مكتب المستشار", "bn": "চ্যান্সেলরের কার্যালয়", "en": "Office Of The Chancellor"}}, {"url": "#", "label": {"ar": "خدمات المرافق", "bn": "সুবিধা পরিষেবা", "en": "Facility Services"}}]', '{"ar": "النشرة الإخبارية", "bn": "নিউজলেটার", "en": "Newsletter"}', '{"ar": "اشترك في نشرتنا الإخبارية للحصول على آخر التحديثات والأخبار", "bn": "সর্বশেষ আপডেট এবং সংবাদ পেতে আমাদের নিউজলেটার সাবস্ক্রাইব করুন", "en": "Subscribe now"}', 1, '{"ar": null}', 4, 1, NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, 1, NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, 1, NULL, '{"ar": null}', 1, NULL, NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, 1, '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', '{"ar": null}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
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
	(1, 'sliders/slider-1.jpg', '{"ar": "مرحباً بكم في مدرستنا!", "bn": "আমাদের স্কুলে স্বাগতম!", "en": "Welcome To Our School !"}', '{"ar": "ابدأ مستقبلك الجميل والمشرق", "bn": "আপনার সুন্দর ও উজ্জ্বল ভবিষ্যৎ শুরু করুন", "en": "Start Your Beautiful And Bright Future"}', '{"ar": "المشرق", "bn": "উজ্জ্বল", "en": "Bright"}', '{"ar": "نرعى كل طالب بتعليم جيد ومعلمين متفانين وحرم جامعي آمن وملهم.", "bn": "মানসম্মত শিক্ষা, নিবেদিতপ্রাণ শিক্ষক এবং একটি নিরাপদ, অনুপ্রেরণাদায়ক ক্যাম্পাসে প্রতিটি শিক্ষার্থীকে গড়ে তোলা।", "en": "Nurturing every student with quality education, dedicated teachers, and a safe, inspiring campus."}', '{"ar": "المزيد عنا", "bn": "বিস্তারিত জানুন", "en": "About More"}', '/about', '{"ar": "تواصل معنا", "bn": "যোগাযোগ করুন", "en": "Contact Us"}', '/contact', 1, 1, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(2, 'sliders/slider-2.jpg', '{"ar": "التميز في التعليم", "bn": "শিক্ষায় উৎকর্ষতা", "en": "Excellence In Education"}', '{"ar": "تمكين العقول من أجل الغد", "bn": "আগামীর জন্য মনন তৈরি করছি", "en": "Empowering Minds For Tomorrow"}', '{"ar": "تمكين", "bn": "মনন", "en": "Empowering"}', '{"ar": "منهج حديث ممزوج بقيم راسخة لمساعدة كل طفل على تحقيق إمكاناته الكاملة.", "bn": "প্রতিটি শিশুর সম্পূর্ণ সম্ভাবনা বিকাশে আধুনিক পাঠ্যক্রম ও মূল্যবোধের সমন্বয়।", "en": "A modern curriculum blended with strong values to help every child reach their full potential."}', '{"ar": "برامجنا", "bn": "আমাদের প্রোগ্রাম", "en": "Our Programs"}', '/academic', '{"ar": "قدم الآن", "bn": "আবেদন করুন", "en": "Apply Now"}', '/admission', 1, 2, '2026-07-23 17:50:37', '2026-07-23 17:50:37'),
	(3, 'sliders/slider-3.jpg', '{"ar": "انضم إلى مجتمعنا", "bn": "আমাদের কমিউনিটিতে যোগ দিন", "en": "Join Our Community"}', '{"ar": "حيث ينتمي كل طالب حقاً", "bn": "যেখানে প্রতিটি শিক্ষার্থী সত্যিকারের আপন", "en": "Where Every Student Truly Belongs"}', '{"ar": "ينتمي", "bn": "আপন", "en": "Belongs"}', '{"ar": "مرافق حديثة ومعلمون مهتمون وحياة جامعية نابضة بالحياة في انتظار طفلك.", "bn": "অত্যাধুনিক সুযোগ-সুবিধা, যত্নশীল শিক্ষক এবং প্রাণবন্ত ক্যাম্পাস জীবন আপনার সন্তানের জন্য অপেক্ষা করছে।", "en": "State-of-the-art facilities, caring mentors, and a vibrant campus life await your child."}', '{"ar": "استكشف الحرم الجامعي", "bn": "ক্যাম্পাস দেখুন", "en": "Explore Campus"}', '/campus-tour', '{"ar": "اتصل بنا", "bn": "যোগাযোগ করুন", "en": "Contact Us"}', '/contact', 1, 3, '2026-07-23 17:50:37', '2026-07-23 17:50:37');
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
	(1, '{"ar": "معلمونا", "bn": "আমাদের শিক্ষকবৃন্দ", "en": "Our Teachers"}', '{"ar": "تعرف على معلمينا", "bn": "আমাদের শিক্ষকদের সাথে পরিচিত হন", "en": "Meet With Our Teachers"}', '{"ar": "المعلمين", "bn": "শিক্ষক", "en": "Teachers"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "المعلمون", "bn": "শিক্ষকবৃন্দ", "en": "Teachers"}', 'site/teachers-breadcrumb.jpg', '{"ar": "معلمونا", "bn": "আমাদের শিক্ষকবৃন্দ", "en": "Our Teachers"}', '{"ar": "تعرف على معلمي وموظفي مدرستنا.", "bn": "আমাদের স্কুলের শিক্ষক ও কর্মীদের সাথে পরিচিত হন।", "en": "Meet the teachers and staff of our school."}', '{"ar": "المعلمون، أعضاء هيئة التدريس، الموظفون", "bn": "শিক্ষক, অনুষদ, কর্মী", "en": "teachers, faculty, staff"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"ar": "لقد تحسن طفلي كثيرًا منذ التحاقه بهذه المدرسة. المعلمون مهتمون ومحترفون للغاية.", "bn": "আমার সন্তান এই স্কুলে ভর্তি হওয়ার পর থেকে অনেক উন্নতি করেছে। শিক্ষকরা অত্যন্ত যত্নশীল ও পেশাদার।", "en": "There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words."}', 5, '{"ar": "أنتوني نيكول", "bn": "অ্যান্থনি নিকোল", "en": "Anthony Nicoll"}', '{"ar": "طالب", "bn": "শিক্ষার্থী", "en": "Student"}', 'site/testimonials/1.jpg', 1, 1, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(2, '{"ar": "لقد تحسن طفلي كثيرًا منذ التحاقه بهذه المدرسة. المعلمون مهتمون ومحترفون للغاية.", "bn": "আমার সন্তান এই স্কুলে ভর্তি হওয়ার পর থেকে অনেক উন্নতি করেছে। শিক্ষকরা অত্যন্ত যত্নশীল ও পেশাদার।", "en": "There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words."}', 5, '{"ar": "ريتشارد لوك", "bn": "রিচার্ড লক", "en": "Richard Lock"}', '{"ar": "طالب", "bn": "শিক্ষার্থী", "en": "Student"}', 'site/testimonials/2.jpg', 1, 2, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(3, '{"ar": "لقد تحسن طفلي كثيرًا منذ التحاقه بهذه المدرسة. المعلمون مهتمون ومحترفون للغاية.", "bn": "আমার সন্তান এই স্কুলে ভর্তি হওয়ার পর থেকে অনেক উন্নতি করেছে। শিক্ষকরা অত্যন্ত যত্নশীল ও পেশাদার।", "en": "There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words."}', 5, '{"ar": "راندال جراند", "bn": "র‍্যান্ডাল গ্র্যান্ড", "en": "Randal Grand"}', '{"ar": "ولي أمر", "bn": "অভিভাবক", "en": "Parent"}', 'site/testimonials/3.jpg', 1, 3, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(4, '{"ar": "لقد تحسن طفلي كثيرًا منذ التحاقه بهذه المدرسة. المعلمون مهتمون ومحترفون للغاية.", "bn": "আমার সন্তান এই স্কুলে ভর্তি হওয়ার পর থেকে অনেক উন্নতি করেছে। শিক্ষকরা অত্যন্ত যত্নশীল ও পেশাদার।", "en": "There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words."}', 5, '{"ar": "إدوارد مايلز", "bn": "এডওয়ার্ড মাইলস", "en": "Edward Miles"}', '{"ar": "طالب", "bn": "শিক্ষার্থী", "en": "Student"}', 'site/testimonials/4.jpg', 1, 4, '2026-07-23 17:50:38', '2026-07-23 17:50:38'),
	(5, '{"ar": "لقد تحسن طفلي كثيرًا منذ التحاقه بهذه المدرسة. المعلمون مهتمون ومحترفون للغاية.", "bn": "আমার সন্তান এই স্কুলে ভর্তি হওয়ার পর থেকে অনেক উন্নতি করেছে। শিক্ষকরা অত্যন্ত যত্নশীল ও পেশাদার।", "en": "There are many variations of tend to repeat chunks some all form necessary injected for the going are humour words."}', 5, '{"ar": "نينال غوردون", "bn": "নিনাল গর্ডন", "en": "Ninal Gordon"}', '{"ar": "ولي أمر", "bn": "অভিভাবক", "en": "Parent"}', 'site/testimonials/5.jpg', 1, 5, '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}', '{"ar": "ماذا يقول طلابنا", "bn": "আমাদের শিক্ষার্থীরা যা বলে", "en": "What Our Students Say\'s"}', '{"ar": "يقول", "bn": "বলে", "en": "Say\'s"}', '{"ar": "من الحقائق الراسخة منذ زمن طويل أن القارئ سيتشتت انتباهه بتخطيط الصفحة.", "bn": "এটি দীর্ঘদিনের একটি প্রতিষ্ঠিত সত্য যে একজন পাঠক পৃষ্ঠার লেআউট দেখার সময় বিভ্রান্ত হবেন।", "en": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."}', '{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}', 'site/testimonials-breadcrumb.jpg', '{"ar": "الشهادات", "bn": "প্রশংসাপত্র", "en": "Testimonials"}', '{"ar": "اطلع على آراء طلابنا وأولياء الأمور حول مدرستنا.", "bn": "আমাদের শিক্ষার্থী ও অভিভাবকরা আমাদের স্কুল সম্পর্কে কী বলেন তা দেখুন।", "en": "See what our students and parents say about our school."}', '{"ar": "شهادات، تقييمات، آراء الطلاب", "bn": "প্রশংসাপত্র, পর্যালোচনা, শিক্ষার্থীর মতামত", "en": "testimonials, reviews, student feedback"}', '2026-07-23 17:50:38', '2026-07-23 17:50:38');
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
	(1, '{"en": "Our Vision"}', '{"en": "Shaping A Brighter Future For Every Student."}', '{"en": "Brighter Future"}', '{"en": "There are many variations of passages available but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable."}', '{"en": "30 Years Of Quality Service"}', '{"en": "Building strong values and knowledge for every learner."}', '{"en": "Discover More"}', '/about', NULL, NULL, NULL, '{"en": "Our Vision"}', NULL, NULL, NULL, NULL, '2026-08-07 05:49:07', '2026-08-07 05:49:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `vision_mission_page_settings` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
