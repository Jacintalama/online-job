-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 01:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant_records`
--

CREATE TABLE `applicant_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('hired','not_hired') NOT NULL DEFAULT 'not_hired',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicant_records`
--

INSERT INTO `applicant_records` (`id`, `user_id`, `job_id`, `status`, `created_at`, `updated_at`) VALUES

(9, 4, 99, 'hired', '2023-11-02 16:24:11', '2023-11-02 16:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Office of the Building Official', NULL, NULL),
(2, 'City Mayor\'s Office', NULL, NULL),
(3, 'City Accountant\'s Office', NULL, NULL),
(4, 'City Administrator\'s Office', NULL, NULL),
(5, 'City Agriculturist\'s Office', NULL, NULL),
(6, 'City Assessor\'s Office', NULL, NULL),
(7, 'City Budget Office', NULL, NULL),
(8, 'City Engineer\'s Office', NULL, NULL),
(9, 'City Envi & Natural Resources', NULL, NULL),
(10, 'City General Services Office', NULL, NULL),
(11, 'City Health Office', NULL, NULL),
(12, 'City Housing & Land Mgt Office', NULL, NULL),
(13, 'City Internal Audit Services', NULL, NULL),
(14, 'City Legal Office', NULL, NULL),
(15, 'City Planning And Devt Office', NULL, NULL),
(16, 'City Population Mgt Office', NULL, NULL),
(17, 'City Public Library', NULL, NULL),
(18, 'City Social Welfare & Devt', NULL, NULL),
(19, 'City Treasurer\'s Office', NULL, NULL),
(20, 'City Veterinarian\'s Office', NULL, NULL),
(21, 'Doctor Jorge P. Royeca Hospital', NULL, NULL),
(22, 'Local Civil Registrar\'s Office', NULL, NULL),
(23, 'Public Safety Office', NULL, NULL),
(24, 'Sangguniang Panlunsod', NULL, NULL),
(25, 'Strategic Performance|Compliance', NULL, NULL),
(26, 'Waste Management Office', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eligibilities`
--

CREATE TABLE `eligibilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eligibilities`
--

INSERT INTO `eligibilities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Career Service (subprofessional) First level Eligibility', NULL, NULL),
(2, 'Career Service (subprofessional) Second level Eligibility', NULL, NULL),
(3, 'Career Service (Professional) Second Level Eligibility', NULL, NULL),
(4, 'Career Service (Professional) First Level Eligibility', NULL, NULL),
(5, 'Mason(MC 11, s. 96 - Cat. III)', NULL, NULL),
(6, 'Driver\'s License', NULL, NULL),
(7, 'RA 1080', NULL, NULL),
(8, 'RA 1080 (Veterinarian)', NULL, NULL),
(9, 'Electrician (MC 11, s. 1996-Cat. II)', NULL, NULL),
(10, 'Heavy Equipment Operator', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eligibility_job`
--

CREATE TABLE `eligibility_job` (
  `eligibility_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eligibility_job`
--

INSERT INTO `eligibility_job` (`eligibility_id`, `job_id`) VALUES
(4, 99);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','published','unpublished','rejected') NOT NULL DEFAULT 'pending',
  `position_title` varchar(255) DEFAULT NULL,
  `competency` longtext DEFAULT NULL,
  `training` varchar(255) DEFAULT NULL,
  `eligibility` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `job_deadline` date NOT NULL,
  `gender_requirement` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date_job` date DEFAULT NULL,
  `has_start_date` varchar(255) NOT NULL DEFAULT 'no',
  `monthly_salary` decimal(10,2) NOT NULL,
  `is_closed` tinyint(1) DEFAULT 0,
  `salary_grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `department_id`, `department_head_id`, `status`, `position_title`, `competency`, `training`, `eligibility`, `contact_email`, `contact_phone`, `job_deadline`, `gender_requirement`, `created_at`, `updated_at`, `start_date_job`, `has_start_date`, `monthly_salary`, `is_closed`, `salary_grade`) VALUES
(99, 17, 28, 'published', 'Adminstrative Aide VI (Clerk III)', '<p>not required</p>', '<p>not required</p>', NULL, 'alamajacint@gmail.com', '09511106262', '2023-12-09', 'male/female', '2023-11-02 16:21:21', '2023-11-02 16:24:43', '2023-12-02', 'yes', 21211.00, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `matching_score` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('qualified','nonqualified') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `user_id`, `job_id`, `matching_score`, `created_at`, `updated_at`, `status`) VALUES
(71, 4, 99, 104, '2023-11-02 16:23:10', '2023-11-02 16:23:10', 'qualified');

-- --------------------------------------------------------

--
-- Table structure for table `job_job_schedule`
--

CREATE TABLE `job_job_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `job_schedule_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_job_schedule`
--

INSERT INTO `job_job_schedule` (`id`, `job_id`, `job_schedule_id`, `created_at`, `updated_at`) VALUES
(105, 99, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_job_type`
--

CREATE TABLE `job_job_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `job_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_job_type`
--

INSERT INTO `job_job_type` (`id`, `job_id`, `job_type_id`, `created_at`, `updated_at`) VALUES
(120, 99, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_schedules`
--

CREATE TABLE `job_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_schedules`
--

INSERT INTO `job_schedules` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Flextime', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(2, '8 hours shift', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(3, '10 hours shift', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(4, '12 hours shift', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(5, 'Shift system', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(6, 'Day shift', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(7, 'Afternoon shift', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(8, 'Evening shift', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(9, 'Monday to Friday', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(10, 'Weekends', '2023-09-30 02:53:57', '2023-09-30 02:53:57'),
(11, 'Overtime', '2023-09-30 02:53:57', '2023-09-30 02:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `job_time`
--

CREATE TABLE `job_time` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `time_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Full-time', '2023-09-30 02:54:00', '2023-09-30 02:54:00'),
(2, 'Part-time', '2023-09-30 02:54:00', '2023-09-30 02:54:00'),
(3, 'Permanent', '2023-09-30 02:54:00', '2023-09-30 02:54:00'),
(4, 'Fixed term', '2023-09-30 02:54:00', '2023-09-30 02:54:00'),
(5, 'Temporary', '2023-09-30 02:54:00', '2023-09-30 02:54:00'),
(6, 'OJT(On the Job Training)', '2023-09-30 02:54:00', '2023-09-30 02:54:00'),
(7, 'Fresh Graduate', '2023-09-30 02:54:00', '2023-09-30 02:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `recipient_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('admin','lguhrmo','applicant') DEFAULT NULL,
  `content` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `subject` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `recipient_id`, `sender_type`, `content`, `read_at`, `is_read`, `subject`, `created_at`, `updated_at`, `deleted_at`) VALUES
(33, 9, 28, NULL, 'Welcome Mabuhay GenSan! You may change your password.', NULL, 0, NULL, '2023-10-23 18:40:21', '2023-10-23 18:40:21', NULL),
(34, 28, 8, NULL, 'Congratulations, mae Alama!You have been hired for the position and rest asure one our HR will contact you for further processing.', NULL, 1, NULL, '2023-10-25 17:34:14', '2023-10-25 23:32:14', '2023-10-25 23:32:14'),
(37, 28, 4, NULL, 'We regret to inform you, Jacints Alama, that your application was not successful this time.', NULL, 1, NULL, '2023-10-25 23:19:09', '2023-10-25 23:20:25', NULL),
(38, 28, 8, NULL, 'Congratulations, mae Alama!You have been hired for the position and rest asure one our HR will contact you for further processing.', NULL, 1, NULL, '2023-10-25 23:29:41', '2023-10-25 23:32:06', '2023-10-25 23:32:06'),
(39, 28, 4, NULL, 'We regret to inform you, Jacints Alama, that your application was not successful this time.', NULL, 0, NULL, '2023-10-25 23:29:43', '2023-10-25 23:29:43', NULL),
(40, 28, 4, NULL, 'We regret to inform you, Jacints Alama, that your application was not successful this time.', NULL, 0, NULL, '2023-10-25 23:31:19', '2023-10-25 23:31:19', NULL),
(41, 28, 4, NULL, 'We regret to inform you, Jacints Alama, that your application was not successful this time.', NULL, 0, NULL, '2023-10-25 23:47:02', '2023-10-25 23:47:02', NULL),
(42, 9, 31, NULL, 'Welcome Mabuhay GenSan! You may change your password.', NULL, 0, NULL, '2023-10-26 20:16:20', '2023-10-26 20:16:20', NULL),
(45, 9, 35, NULL, 'Welcome Mabuhay GenSan! You may change your password.', NULL, 0, NULL, '2023-10-26 21:58:02', '2023-10-26 21:58:02', NULL),
(46, 35, 34, NULL, 'Congratulations, Nathaniel Labis!You have been hired for the position and rest asure one our HR will contact you for further processing.', NULL, 0, NULL, '2023-10-26 22:11:27', '2023-10-26 22:11:27', NULL),
(47, 28, 4, NULL, 'Congratulations, Jacints Alama!You have been hired for the position and rest asure one our HR will contact you for further processing.', NULL, 0, NULL, '2023-11-02 16:24:11', '2023-11-02 16:24:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_30_100938_create_sessions_table', 1),
(7, '2023_09_30_104732_create_jobs_table', 2),
(8, '2023_09_30_104926_create_job_schedules_table', 3),
(9, '2023_09_30_104930_create_job_types_table', 3),
(10, '2023_09_30_105019_create_departments_table', 3),
(11, '2023_09_30_105119_add_department_id_to_jobs_table', 4),
(12, '2023_09_30_105518_create_job_job_schedule_table', 5),
(13, '2023_09_30_105522_create_job_job_type_table', 5),
(14, '2023_09_30_105621_modify_jobs_table', 6),
(15, '2023_09_30_105626_add_start_date_job_to_jobs_table', 6),
(16, '2023_09_30_105720_modify_jobs_table_add_has_start_date', 7),
(17, '2023_09_30_105726_create_times_table', 7),
(18, '2023_09_30_105732_create_job_time_table', 7),
(19, '2023_09_30_105836_add_salary_to_jobs_table', 8),
(20, '2023_09_30_105933_change_salary_max_column_in_jobs_table', 9),
(26, '2023_09_30_154244_add_is_approved_to_users_table', 10),
(27, '2023_09_30_163315_add_reject_reason_to_users_table', 10),
(35, '2023_10_01_001403_create_eligibilities_table', 11),
(36, '2023_10_01_001541_create_eligibility_job_table', 11),
(38, '2023_10_01_053407_add_status_to_jobs_table', 12),
(39, '2023_10_01_111537_create_information_data_employer_table', 13),
(40, '2023_10_01_233959_add_employer_fields_to_users_table', 14),
(43, '2023_10_02_012227_add_name_fields_to_users_table', 15),
(44, '2023_10_02_224345_create_job_applications_table', 16),
(45, '2023_10_03_045803_add_cv_name_and_extension_to_job_applications_table', 17),
(46, '2023_10_05_043314_create_bookmarks_table', 18),
(47, '2023_10_07_042512_create_messages_table', 19),
(48, '2023_10_07_082621_add_read_at_to_messages_table', 20),
(49, '2023_10_08_021410_create_regions_table', 21),
(53, '2023_10_08_023537_create_regions_table', 22),
(54, '2023_10_08_023559_create_provinces_table', 23),
(55, '2023_10_08_023617_create_municipalities_table', 24),
(56, '2023_10_08_023635_create_barangays_table', 25),
(58, '2023_10_08_094600_create_regions_table', 26),
(59, '2023_10_08_094655_create_provinces_table', 27),
(60, '2023_10_08_094714_create_municipalities_table', 28),
(61, '2023_10_08_094731_create_barangays_table', 29),
(62, '2023_10_08_095602_create_regions_table', 30),
(63, '2023_10_08_095624_create_provinces_table', 31),
(64, '2023_10_08_095640_create_municipalities_table', 32),
(65, '2023_10_08_095655_create_barangays_table', 33),
(67, '2023_10_08_104116_add_address_fields_to_users_table', 34),
(68, '2023_10_08_112047_add_status_to_job_applications_table', 35),
(69, '2023_10_10_003203_modify_name_column_in_users_table', 36),
(70, '2023_10_10_005336_allow_null_sender_id_in_messages', 36),
(71, '2023_10_10_041501_modify_name_column_in_users_table', 36),
(73, '2023_10_10_044524_remove_education_experience_fields_from_users', 37),
(74, '2023_10_10_044622_add_education_experience_fields_to_users', 38),
(75, '2023_10_10_053605_create_qualifications_table', 39),
(76, '2023_10_11_043936_remove_cv_columns_from_job_applications_table', 40),
(78, '2023_10_11_051420_drop_matching_score_from_job_applications_table', 41),
(79, '2023_10_11_051446_add_matching_score_to_job_applications_table', 42),
(80, '2023_10_12_021837_rename_rate_type_column_in_jobs_table', 43),
(81, '2023_10_14_104706_update_role_enum_in_users_table', 44),
(82, '2023_10_14_112030_add_foreign_key_to_jobs_table', 45),
(83, '2023_10_14_121753_alter_messages_table_for_cascade_delete', 46),
(84, '2023_10_14_122207_drop_front_and_back_id_columns', 47),
(85, '2023_10_14_234249_rename_employer_id_to_lguhrmo_id_in_jobs_table', 48),
(87, '2023_10_15_130511_add_eligibility_to_users_table', 49),
(88, '2023_10_24_030458_create_applicant_records_table', 50),
(89, '2023_11_01_115704_replace_salary_min_max_with_monthly_salary', 51),
(90, '2023_11_01_120743_create_salary_grades_table', 52);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `requirement` varchar(255) NOT NULL,
  `priority_score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `job_id`, `type`, `requirement`, `priority_score`, `created_at`, `updated_at`) VALUES
(413, 99, 'eligibility', 'Career Service (subprofessional) First level Eligibility', 31, '2023-11-02 16:21:22', '2023-11-02 16:21:22'),
(414, 99, 'certifications', 'Master of Library and Information Science (MLIS)', 31, '2023-11-02 16:21:22', '2023-11-02 16:21:22'),
(415, 99, 'degree', 'Bachelor\'s Degree', 21, '2023-11-02 16:21:22', '2023-11-02 16:21:22'),
(416, 99, 'experience', '1 year', 21, '2023-11-02 16:21:22', '2023-11-02 16:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `salary_grades`
--

CREATE TABLE `salary_grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_grades`
--

INSERT INTO `salary_grades` (`id`, `grade`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 13000.00, NULL, NULL),
(2, 2, 13819.00, NULL, NULL),
(3, 3, 14678.00, NULL, NULL),
(4, 4, 15586.00, NULL, NULL),
(5, 5, 16543.00, NULL, NULL),
(6, 6, 17553.00, NULL, NULL),
(7, 7, 18620.00, NULL, NULL),
(8, 8, 19744.00, NULL, NULL),
(9, 9, 21211.00, NULL, NULL),
(10, 10, 23176.00, NULL, NULL),
(11, 11, 27000.00, NULL, NULL),
(12, 12, 29165.00, NULL, NULL),
(13, 13, 31320.00, NULL, NULL),
(14, 14, 33843.00, NULL, NULL),
(15, 15, 36619.00, NULL, NULL),
(16, 16, 39672.00, NULL, NULL),
(17, 17, 43030.00, NULL, NULL),
(18, 18, 46725.00, NULL, NULL),
(19, 19, 51357.00, NULL, NULL),
(20, 20, 57347.00, NULL, NULL),
(21, 21, 63997.00, NULL, NULL),
(22, 22, 71511.00, NULL, NULL),
(23, 23, 80003.00, NULL, NULL),
(24, 24, 90078.00, NULL, NULL),
(25, 25, 102690.00, NULL, NULL),
(26, 26, 116040.00, NULL, NULL),
(27, 27, 131124.00, NULL, NULL),
(28, 28, 148171.00, NULL, NULL),
(29, 29, 167432.00, NULL, NULL),
(30, 30, 189199.00, NULL, NULL),
(31, 31, 278434.00, NULL, NULL),
(32, 32, 331954.00, NULL, NULL),
(33, 33, 419144.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time_value` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `street_no` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `highest_education` varchar(255) DEFAULT NULL,
  `school_location` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `job_experience` text DEFAULT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `certifications` text DEFAULT NULL,
  `eligibility` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `role` enum('admin','department_head','applicant') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `is_rejected` tinyint(1) NOT NULL DEFAULT 0,
  `department_head_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_initial`, `last_name`, `gender`, `name`, `email`, `email_verified_at`, `password`, `street_no`, `barangay`, `municipality`, `province`, `city`, `highest_education`, `school_location`, `degree`, `skills`, `job_experience`, `job_location`, `company_name`, `achievements`, `certifications`, `eligibility`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `role`, `created_at`, `updated_at`, `is_approved`, `is_rejected`, `department_head_name`, `dob`) VALUES
(4, 'Jacints', 'A', 'Alama', 'male', 'jacint', 'jacint@gmail.com', NULL, '$2y$10$qx7F2IrPboMfFSrgMPU5be.J6ZU38uGVYW1Cvu67qoGKQsvgQAW1S', 'Poruk 5A', 'Colon', 'Maasim', 'Sarangani', 'sarangani', 'College Graduate', 'Holy Trinity College of General Santos City', 'Master\'s Degree', 'PHP Master', '2 years', 'General Santos City', 'KCC MALL OF GENSAN', 'Cum Laudes', 'Master of Library and Information Science (MLIS)', 'Career Service (subprofessional) First level Eligibility', NULL, NULL, NULL, NULL, NULL, 'profile-photos/PHByQSOIlogOue2EYo0h9PHxvbGZnuXEh2LOxvxx.jpg', 'applicant', '2023-09-30 03:42:41', '2023-11-02 16:22:58', 0, 0, NULL, '2000-12-14'),
(5, 'majester', 'm', 'alama', 'male', 'alama', 'alama@gmail.com', NULL, '$2y$10$EMg2n0V51ZRkyLpm4L9IkO68cV/IqCS.CKNVfThVuxejsVTlJa/4S', 'asdasd', 'asdasd', 'asdas', 'asdas', 'dasd', 'HighSchool Graduate', 'asdasd', 'HighSchool Graduate', 'asdasd', '3 years', 'asdasd', 'asdasd', 'asdasd', 'hjkhjk', 'khjkjk', NULL, NULL, NULL, NULL, NULL, NULL, 'applicant', '2023-09-30 04:09:17', '2023-10-22 17:07:16', 0, 0, NULL, '1999-02-18'),
(6, 'minka', 'm', 'minka', NULL, 'ja', 'ja@gmail.com', NULL, '$2y$10$UUTQvmHK02oJ4Q3fxCnrKe483OD/jFRKqofbaN3knWykXeoGEGnye', '2asd', 'asd', 'asd', 'asdas', 'asd', 'HighSchool Graduate', 'asdasd', 'HighSchool Graduate', 'asd', '3 years', 'asdasd', 'asdasd', 'asdas', 'NCIII Driving', 'Driver\'s License', NULL, NULL, NULL, NULL, NULL, 'profile-photos/goFCupQ6kykG9HoXyBnETSmBSLTZGxeKvvWiWOqz.jpg', 'applicant', '2023-09-30 04:11:07', '2023-10-22 03:37:14', 0, 0, NULL, '1999-07-02'),
(7, 'asdasd', 's', 'asdasd', 'female', 'jac', 'jac@gmail.com', NULL, '$2y$10$q5NKg.a92wH5X/pNf6dv8./SfWlXQIlIsDksqcITkZyYsKDgTfkIm', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsdf', NULL, 'sdfsd', 'SeniorHighSchool Graduate', 'sdfsdf', '3 years', 'sdfsdf', 'sdfsdf', 'sdf', 'NCIII Driving', NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/Yj4WzLI1u4oHdB8e8geL6Sr8KDjyU4jHvyHpGl9a.jpg', 'applicant', '2023-09-30 04:12:52', '2023-10-10 21:32:10', 0, 0, NULL, '2000-12-22'),
(8, 'mae', 'A', 'Alama', 'female', 'jacinto', 'jacinto@gmail.com', NULL, '$2y$10$RbWQNZe4rtqm3no72SMbWODaqSxs.7/dkcr/ketK41mk2in5tTj3W', 'maasim', 'colon', 'maasim', 'sarangani', 'province', 'HighSchool Graduate', 'maasim', 'College Graduate', 'Microsoft Office Expert', '6 months', 'Maasim Central Elementary School', 'Dep Ed', 'Civil Service Passer', 'Certified Public Accountant (CPA) ', 'Career Service Professional second level eligibility', NULL, NULL, NULL, NULL, NULL, 'profile-photos/ryGWN2oZtAIUAiKIDOaMH33VwVe6wf2zBPYYeCEL.jpg', 'applicant', '2023-09-30 04:22:55', '2023-10-27 00:17:55', 0, 0, NULL, '1999-02-17'),
(9, NULL, NULL, NULL, NULL, 'Admin Name', 'admin@example.com', NULL, '$2y$10$XqXOAnyEBOFrdX9QnhTuI.9ptzpEozw9dJrc57BwZ42WIXotnh./a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'profile-photos/2sCfZ5BF6weoXq0npe472bPP3B5tc6FoeigrryNi.jpg', 'admin', '2023-09-30 04:57:12', '2023-09-30 06:42:07', 0, 0, NULL, NULL),
(14, 'sikwa', 's', 'sikwa', 'male', 'sikwa', 'sikwa@gmail.com', NULL, '$2y$10$B.IbU6ukFxVhvxOJyZF0JurLfwdMRNdCWR3mbOq7pk75qdcv9Hw.e', 'sikwa', 'sikwa', 'sikwa', 'sikwa', 'sikwa', 'HighSchool Graduate', 'siwka', 'asdasd', 'sikwa', '6 years', 'sikwa', 'sikwa', 'asdasd', 'asdasd', 'sdasd', NULL, NULL, NULL, NULL, NULL, NULL, 'applicant', '2023-10-12 01:35:59', '2023-10-22 17:13:22', 0, 0, NULL, '1999-02-11'),
(15, 'KIYOMI', 'S', 'SKIBIDI', 'male', 'kiyomi', 'kiyomi@gmail.com', NULL, '$2y$10$UwYrE7MZLAe9lzDlgjaqlesKyzAakhJ/Gt.Xj2eEalsnI.hQYBaR.', 'ASDASD', 'ASDASD', 'ASDASD', 'ASDASD', 'asdasd', 'HighSchool Graduate', 'asdasd', 'HighSchool Graduate', 'nothing', '3 years', 'asdasdasd', 'asdasd', 'asda', 'NCIII Driving', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'applicant', '2023-10-12 02:23:09', '2023-10-15 05:11:03', 0, 0, NULL, '1995-06-13'),
(16, 'nigga', 'n', 'alama', 'male', 'real', 'nigga@gmail.com', NULL, '$2y$10$c2/0LS0ojwV3UfBg1ujMXuPXB84Dy5/zOWqiaBK4zxQspl/zBkYjG', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'Driver\'s License', NULL, NULL, NULL, NULL, NULL, 'profile-photos/dcGgML20XyMXe0b8hgOUWfSi2OTeZd9tNwvOIJu4.jpg', 'applicant', '2023-10-12 03:40:36', '2023-10-22 17:01:02', 0, 0, NULL, '1999-04-30'),
(17, 'batsi', 'b', 'batsis', 'male', 'batsi', 'batsi@gmail.com', NULL, '$2y$10$ueOtuFFIZjIhnRpSp9Zeh.p0qrzryVkVZnP5V3F9axTi7lwoMhfIO', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasdasd', 'asasd', 'asdasd', 'nothing', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'NCIII Driving', 'Driver\'s License', NULL, NULL, NULL, NULL, NULL, NULL, 'applicant', '2023-10-12 03:48:01', '2023-10-22 17:14:05', 0, 0, NULL, '1998-02-27'),
(27, 'bikini', 'b', 'one', 'female', 'bikini', 'bikini@gmail.com', NULL, '$2y$10$WpV8lquZUv.R6Qdn.0h9sul4LQsyNam7dhgN1yrMzWvBalNjQUuPy', 'asdasd', 'asdas', 'asdas', 'dasdas', 'asdasd', 'HighSchool Graduate', 'asdasd', 'HighSchool Graduate', 'asdasd', '5 years', 'asdas', 'asdasd', 'asdasd', 'NCIII Driving', 'Driver\'s License', NULL, NULL, NULL, NULL, NULL, NULL, 'applicant', '2023-10-17 06:54:13', '2023-10-17 06:56:18', 0, 0, NULL, '2000-12-22'),
(28, 'Atty.Leo', 'A', 'Alama', NULL, NULL, 'leo@gmail.com', NULL, '$2y$10$KtH5RcpWsh6iJNFoW1utq.akC1/jqXbp5345f9M3YkGN3Mb0bf/M.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'department_head', '2023-10-23 18:40:21', '2023-10-23 18:40:21', 0, 0, 'City Public Library', NULL),
(31, 'Juliet', 'F', 'Maratas', NULL, NULL, 'juliet@gensan.gov.ph', NULL, '$2y$10$csIiCQ/WNLIWsM/I9XRBM.W49MXzkQYjFFbReAMkZJPWlyqbmelKq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'department_head', '2023-10-26 20:16:20', '2023-10-26 20:16:20', 0, 0, 'City Health Office', NULL),
(34, 'Nathaniel', 'A', 'Labis', 'male', 'Nathaniel', 'nathnaiel@gmail.com', NULL, '$2y$10$TQV7hIS1O/IxQZm16vgOCeU1sOB/wne/ptEuVbnLezJUvk/JomSPG', 'Purok5A', 'Colon', 'Maasim', 'Sarangani', 'sarangani', 'College Graduate', 'Holy Trinity College of General Santos City', 'Bachelor\'s Degree', 'Microsoft Office Expert', '6 months', 'General Santos City', 'KCC MALL OF GENSAN', 'Suma Cum Laude', 'Professional Teacher', 'Career Service Professional second level eligibility', NULL, NULL, NULL, NULL, NULL, NULL, 'applicant', '2023-10-26 21:42:22', '2023-10-26 21:51:37', 0, 0, NULL, '1999-02-28'),
(35, 'phoebe', 'a', 'labis', NULL, NULL, 'phoebe@gensan.gov.ph', NULL, '$2y$10$ly2JG/06TBwbdfPkY2GTseEdPbAcMVtrPHZCJ2N4OFX6yF1vHLwVy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'department_head', '2023-10-26 21:58:02', '2023-10-26 21:58:02', 0, 0, 'City Accountant\'s Office', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant_records`
--
ALTER TABLE `applicant_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_records_user_id_foreign` (`user_id`),
  ADD KEY `applicant_records_job_id_foreign` (`job_id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookmarks_user_id_foreign` (`user_id`),
  ADD KEY `bookmarks_job_id_foreign` (`job_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `eligibilities`
--
ALTER TABLE `eligibilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eligibility_job`
--
ALTER TABLE `eligibility_job`
  ADD PRIMARY KEY (`eligibility_id`,`job_id`),
  ADD KEY `eligibility_job_job_id_foreign` (`job_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_employer_id_foreign` (`department_head_id`),
  ADD KEY `jobs_department_id_foreign` (`department_id`),
  ADD KEY `fk_salary_grade` (`salary_grade`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_user_id_foreign` (`user_id`),
  ADD KEY `job_applications_job_id_foreign` (`job_id`);

--
-- Indexes for table `job_job_schedule`
--
ALTER TABLE `job_job_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_job_schedule_job_id_foreign` (`job_id`),
  ADD KEY `job_job_schedule_job_schedule_id_foreign` (`job_schedule_id`);

--
-- Indexes for table `job_job_type`
--
ALTER TABLE `job_job_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_job_type_job_id_foreign` (`job_id`),
  ADD KEY `job_job_type_job_type_id_foreign` (`job_type_id`);

--
-- Indexes for table `job_schedules`
--
ALTER TABLE `job_schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_schedules_name_unique` (`name`);

--
-- Indexes for table `job_time`
--
ALTER TABLE `job_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_time_job_id_foreign` (`job_id`),
  ADD KEY `job_time_time_id_foreign` (`time_id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_types_name_unique` (`name`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_recipient_id_foreign` (`recipient_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qualifications_job_id_foreign` (`job_id`);

--
-- Indexes for table `salary_grades`
--
ALTER TABLE `salary_grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salary_grades_grade_unique` (`grade`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant_records`
--
ALTER TABLE `applicant_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `eligibilities`
--
ALTER TABLE `eligibilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `job_job_schedule`
--
ALTER TABLE `job_job_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `job_job_type`
--
ALTER TABLE `job_job_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `job_schedules`
--
ALTER TABLE `job_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `job_time`
--
ALTER TABLE `job_time`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=417;

--
-- AUTO_INCREMENT for table `salary_grades`
--
ALTER TABLE `salary_grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_records`
--
ALTER TABLE `applicant_records`
  ADD CONSTRAINT `applicant_records_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applicant_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `eligibility_job`
--
ALTER TABLE `eligibility_job`
  ADD CONSTRAINT `eligibility_job_eligibility_id_foreign` FOREIGN KEY (`eligibility_id`) REFERENCES `eligibilities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `eligibility_job_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `fk_salary_grade` FOREIGN KEY (`salary_grade`) REFERENCES `salary_grades` (`grade`) ON DELETE CASCADE,
  ADD CONSTRAINT `jobs_department_head_id_foreign` FOREIGN KEY (`department_head_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`department_head_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_job_schedule`
--
ALTER TABLE `job_job_schedule`
  ADD CONSTRAINT `job_job_schedule_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_job_schedule_job_schedule_id_foreign` FOREIGN KEY (`job_schedule_id`) REFERENCES `job_schedules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_job_type`
--
ALTER TABLE `job_job_type`
  ADD CONSTRAINT `job_job_type_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_job_type_job_type_id_foreign` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_time`
--
ALTER TABLE `job_time`
  ADD CONSTRAINT `job_time_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_time_time_id_foreign` FOREIGN KEY (`time_id`) REFERENCES `times` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `qualifications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
