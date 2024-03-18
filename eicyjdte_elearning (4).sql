-- Adminer 4.8.1 MySQL 5.7.23-23 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcoad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(55) COLLATE utf8_unicode_ci NOT NULL COMMENT 'admin=1,sub-admin=2',
  `wallet_amount` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_data` int(11) NOT NULL COMMENT '0-all,1-registered',
  `otp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering_id` int(11) unsigned zerofill DEFAULT NULL,
  `course_img` text,
  `title` varchar(150) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `student_enrolled` text,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_type_id` bigint(20) unsigned DEFAULT NULL,
  `question` text COLLATE utf8mb4_unicode_ci,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `correct_answer` text COLLATE utf8mb4_unicode_ci,
  `default_marks` float DEFAULT '1',
  `default_time` int(11) DEFAULT '60',
  `skill_id` bigint(20) unsigned DEFAULT NULL,
  `topic_id` bigint(20) unsigned DEFAULT NULL,
  `difficulty_level_id` bigint(20) unsigned DEFAULT '1',
  `preferences` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `quiz_idd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `question_analysis`;
CREATE TABLE `question_analysis` (
  `analysis_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `questions` text COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `options` text COLLATE utf8_unicode_ci NOT NULL,
  `correct_answer` text COLLATE utf8_unicode_ci NOT NULL,
  `student_answer` text COLLATE utf8_unicode_ci,
  `attempted_status` text COLLATE utf8_unicode_ci,
  `reference_id` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`analysis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `question_bank`;
CREATE TABLE `question_bank` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering_id` int(11) unsigned zerofill DEFAULT NULL,
  `q_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `quiz_exam` text COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `topic_id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `correct_answer_explanation` text COLLATE utf8_unicode_ci NOT NULL,
  `correct_answer` text COLLATE utf8_unicode_ci,
  `Options` text COLLATE utf8_unicode_ci NOT NULL,
  `time_length` text COLLATE utf8_unicode_ci NOT NULL,
  `difficulty_level` text COLLATE utf8_unicode_ci NOT NULL,
  `marks` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `quiz_sessions`;
CREATE TABLE `quiz_sessions` (
  `id` bigint(20) unsigned NOT NULL,
  `code` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quiz_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `quiz_schedule_id` bigint(20) unsigned DEFAULT NULL,
  `starts_at` datetime NOT NULL,
  `ends_at` datetime NOT NULL,
  `total_time_taken` int(11) NOT NULL DEFAULT '0',
  `current_question` int(11) NOT NULL DEFAULT '0',
  `results` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'started',
  `completed_at` datetime DEFAULT NULL,
  `completed_at_utc` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `quiz_session_questions`;
CREATE TABLE `quiz_session_questions` (
  `quiz_session_id` bigint(20) unsigned NOT NULL,
  `question_id` bigint(20) unsigned NOT NULL,
  `quiz_section_id` bigint(20) DEFAULT NULL,
  `original_question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` longtext COLLATE utf8mb4_unicode_ci,
  `user_answer` longtext COLLATE utf8mb4_unicode_ci,
  `correct_answer` longtext COLLATE utf8mb4_unicode_ci,
  `audiorecord` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unanswered',
  `teacher_feedback` longtext COLLATE utf8mb4_unicode_ci,
  `is_correct` tinyint(1) DEFAULT NULL,
  `time_taken` int(11) NOT NULL DEFAULT '0',
  `marks_earned` double(5,2) NOT NULL DEFAULT '0.00',
  `marks_deducted` double(5,2) NOT NULL DEFAULT '0.00',
  `section_order` int(11) DEFAULT NULL,
  `quizqunsorder` bigint(20) DEFAULT NULL,
  `sectionqunsorder` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `session_analysis`;
CREATE TABLE `session_analysis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `subtopic_id` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `attempted_questions` int(11) NOT NULL,
  `time_spent_seconds` float DEFAULT NULL,
  `reference_id` text COLLATE utf8_unicode_ci,
  `quiz_json` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone_number` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `subtopics`;
CREATE TABLE `subtopics` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering_id` int(11) unsigned zerofill DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `type` text,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `theory`;
CREATE TABLE `theory` (
  `theory_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(200) DEFAULT NULL,
  `course_id` bigint(11) NOT NULL,
  `topic_id` bigint(11) NOT NULL,
  `st_id` bigint(11) NOT NULL,
  `theory_pdf` varchar(200) NOT NULL,
  `pdf_path` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `status` bigint(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`theory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `theory` (`theory_id`, `ordering_id`, `title`, `course_id`, `topic_id`, `st_id`, `theory_pdf`, `pdf_path`, `slug`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1,	0,	'Theory 1',	2,	2,	3,	'Merchant  Dashboard.csv',	'http://localhost/storage/1',	'theory-1',	1,	'2024-03-04 18:32:36',	'2024-03-04 04:42:22',	'2024-03-04 18:32:36'),
(2,	0,	'Theory Second',	2,	1,	1,	'Merchant  Dashboard.csv',	'http://localhost/storage/1',	'theory-second',	1,	'2024-03-04 18:32:05',	'2024-03-04 18:07:57',	'2024-03-04 18:32:05'),
(3,	0,	'Theory 1',	2,	2,	3,	'Merchant  Dashboard.csv',	'http://localhost/storage/1',	'theory-1',	1,	'2024-03-11 18:14:28',	'2024-03-04 04:42:22',	'2024-03-11 18:14:28'),
(4,	0,	'Theory Second',	2,	1,	1,	'Merchant  Dashboard.csv',	'http://localhost/storage/1',	'theory-second',	1,	'2024-03-11 18:22:22',	'2024-03-04 18:07:57',	'2024-03-11 18:22:22'),
(6,	0,	'Theory 1',	2,	22,	102,	'kshama.jpg',	'http://localhost/storage/1',	'theory-1',	1,	'2024-03-11 18:19:12',	'2024-03-11 18:15:34',	'2024-03-11 18:19:12'),
(7,	0,	'Theory Second',	5,	6,	15,	'document.pdf',	'http://localhost/storage/1',	'theory-second',	1,	NULL,	'2024-03-11 18:20:20',	'2024-03-11 18:20:20'),
(8,	0,	'Functions Year 11 (I) Test',	5,	7,	22,	'Einstein_Relativity.pdf',	'Einstein_Relativity.pdf',	'functions-year-11-i-test',	1,	NULL,	'2024-03-15 18:48:22',	'2024-03-15 18:48:22'),
(9,	0,	'Functions Year 11 (II) Test',	5,	7,	24,	'Einstein_Relativity.pdf',	'http://localhost/storage/1',	'functions-year-11-ii-test',	1,	'2024-03-18 13:22:02',	'2024-03-16 10:42:10',	'2024-03-18 13:22:02'),
(10,	0,	'dsds',	5,	7,	26,	'Functions (Year 11) Question Bank.pdf',	'Functions (Year 11) Question Bank.pdf',	'dsds',	1,	'2024-03-16 14:30:10',	'2024-03-16 14:21:03',	'2024-03-16 14:30:10'),
(11,	0,	'fdfdf',	5,	7,	31,	'Functions (Year 11) Question Bank.pdf',	'Functions (Year 11) Question Bank.pdf',	'fdfdf',	1,	'2024-03-16 14:30:16',	'2024-03-16 14:25:43',	'2024-03-16 14:30:16'),
(12,	0,	'dsd',	5,	7,	32,	'Functions (Year 11) Question Bank.pdf',	'Functions (Year 11) Question Bank.pdf',	'dsd',	1,	'2024-03-16 14:30:27',	'2024-03-16 14:29:04',	'2024-03-16 14:30:27'),
(13,	0,	'cxvcv',	5,	7,	34,	'document.pdf',	'document.pdf',	'cxvcv',	1,	NULL,	'2024-03-16 14:37:12',	'2024-03-16 14:37:12'),
(14,	0,	'dsd',	5,	7,	24,	'document.pdf',	'document.pdf',	'dsd',	1,	NULL,	'2024-03-18 13:21:21',	'2024-03-18 13:21:21'),
(15,	0,	'asda',	5,	7,	32,	'document.pdf',	'document.pdf',	'asda',	1,	NULL,	'2024-03-18 13:32:15',	'2024-03-18 13:32:15'),
(16,	0,	'sdsd',	5,	6,	16,	'document.pdf',	'document.pdf',	'sdsd',	1,	NULL,	'2024-03-18 13:33:13',	'2024-03-18 13:33:13');

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering_id` int(11) unsigned zerofill DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temp_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_img` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2024-03-18 13:36:50
