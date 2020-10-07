-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Generation Time: Oct 06, 2020 at 11:42 PM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Database: `mafsdb`
--
-- --------------------------------------------------------
--
-- Table structure for table `admin`
--
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `location` int(11) NOT NULL,
  `username` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `record_paging` int(11) DEFAULT NULL,
  `invoice_start` int(11) DEFAULT NULL,
  `lpo_start` int(11) DEFAULT NULL,
  `address` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `bank_details` varchar(500) COLLATE latin1_general_ci DEFAULT NULL,
  `terms` varchar(500) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `admin`
--
INSERT INTO `admin` (`id`, `roles_id`, `name`, `email`, `location`, `username`, `password`, `status`, `record_paging`, `invoice_start`, `lpo_start`, `address`, `bank_details`, `terms`) VALUES
(1, 1, 'Super Admin', 'mail2yamunav@gmail.com', 0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Y', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Yamuna', 'mail2yamunav@yahoo.co.in', 0, 'yamuna', '21232f297a57a5a743894a0e4a801fc3', 'Y', NULL, NULL, NULL, NULL, NULL, NULL);
-- --------------------------------------------------------
--
-- Table structure for table `admin_logins`
--
CREATE TABLE `admin_logins` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `login_date` datetime NOT NULL,
  `login_ip` varchar(300) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `admin_logins`
--
INSERT INTO `admin_logins` (`id`, `admin_id`, `login_date`, `login_ip`) VALUES
(1, 1, '2020-10-04 15:38:41', '::1'),
(2, 1, '2020-10-04 15:38:52', '::1'),
(3, 1, '2020-10-05 05:07:25', '::1'),
(4, 1, '2020-10-05 19:05:59', '::1'),
(5, 1, '2020-10-06 05:21:18', '::1'),
(6, 1, '2020-10-06 03:12:46', '5.193.27.176'),
(7, 1, '2020-10-06 07:14:44', '5.193.27.176'),
(8, 1, '2020-10-06 07:17:01', '5.193.27.176'),
(9, 1, '2020-10-06 08:35:45', '5.193.27.176'),
(10, 1, '2020-10-06 08:39:06', '217.165.23.2'),
(11, 1, '2020-10-06 09:36:37', '5.193.27.176');
-- --------------------------------------------------------
--
-- Table structure for table `admin_menu`
--
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL,
  `class` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `sort_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `admin_menu`
--
INSERT INTO `admin_menu` (`id`, `class`, `name`, `link`, `parent_id`, `status`, `sort_order`) VALUES
(1, '', 'Dashboard', 'admin/home', 0, 'Y', 1),
(2, 'view_page', 'View Site', 'home', 1, 'Y', 1),
(3, 'block_users', 'Logout', 'admin/home/logout', 1, 'Y', 4),
(8, '', 'Contents', 'admin/contents', 0, 'Y', 3),
(9, '', 'Menus', 'admin/menus', 0, 'Y', 2),
(10, '', 'FAQs', 'admin/faqs', 0, 'N', 19),
(11, '', 'Contacts', 'admin/contacts', 0, 'Y', 11),
(12, '', 'Careers', 'admin/careers', 0, 'N', 10),
(13, 'config', 'Site Settings', 'admin/home/settings', 1, 'Y', 2),
(14, 'page', 'Menus', 'admin/menus/lists', 9, 'Y', 0),
(15, 'add_page', 'Add Menu', 'admin/menus/add', 9, 'Y', 1),
(16, 'page', 'Menu Items', 'admin/menus/menuitems', 9, 'N', 2),
(17, 'add_page', 'Add Menu Item', 'admin/menu/addmenuitem', 9, 'N', 3),
(18, 'page', 'Contents', 'admin/contents/lists', 8, 'Y', 1),
(19, 'add_page', 'Add Content', 'admin/contents/add', 8, 'Y', 2),
(26, 'page', 'FAQs', 'admin/faqs/lists', 10, 'Y', 1),
(27, 'add_page', 'Add FAQ', 'admin/faqs/add', 10, 'Y', 2),
(28, 'category', 'Categories', 'admin/faqs/categories', 10, 'Y', 3),
(29, 'category', 'Add Category', 'admin/faqs/addcategory', 10, 'Y', 4),
(30, 'page', 'Contacts', 'admin/contacts/lists', 11, 'Y', 1),
(31, 'add_page', 'Add Contact', 'admin/contacts/add', 11, 'Y', 2),
(32, 'category', 'Categories', 'admin/contacts/categories', 11, 'Y', 3),
(33, 'category', 'Add Category', 'admin/contacts/addcategory', 11, 'Y', 4),
(34, 'report', 'Jobs', 'admin/careers/jobs', 12, 'Y', 1),
(35, 'users', 'Applications', 'admin/careers/applications', 12, 'Y', 3),
(36, '', 'Languages', 'admin/languages', 0, 'N', 12),
(37, 'page', 'Languages', 'admin/languages/lists', 36, 'Y', 1),
(38, 'add_page', 'Add Language', 'admin/languages/add', 36, 'Y', 2),
(39, '', 'Users', 'admin/users', 0, 'N', 13),
(40, 'users', 'Users', 'admin/users/lists', 39, 'Y', 3),
(41, 'add_user', 'Add User', 'admin/users/add', 39, 'Y', 4),
(42, 'config', 'Change Password', 'admin/home/changepwd', 1, 'Y', 3),
(44, 'page', 'Glossary', 'admin/glossary/lists', 43, 'Y', 1),
(45, 'add_page', 'Add Glossary', 'admin/glossary/add', 43, 'Y', 2),
(47, 'page', 'Seminars', 'admin/seminars/lists', 46, 'Y', 1),
(48, 'add_page', 'Add Seminar', 'admin/seminars/add', 46, 'Y', 2),
(49, 'page', 'Webinars', 'admin/seminars/lists/webinars', 46, 'Y', 3),
(50, 'add_page', 'Add Webinar', 'admin/seminars/add/webinars', 46, 'Y', 4),
(51, 'report', 'Add Job', 'admin/careers/add', 12, 'Y', 2),
(56, 'category', 'Categories', 'admin/contents/categories', 8, 'Y', 3),
(57, 'category', 'Add Category', 'admin/contents/addcategory', 8, 'Y', 4),
(58, 'config', 'Localization', 'admin/home/localization', 1, 'Y', 2),
(59, '', 'Downloads', 'admin/downloads', 0, 'Y', 11),
(60, 'page', 'Downloads', 'admin/downloads/lists', 59, 'Y', 1),
(61, 'add_page', 'Add Download', 'admin/downloads/add', 59, 'Y', 2),
(88, 'page', 'Permission', 'admin/users/permission', 39, 'N', 2),
(63, 'category', 'Callback Request', 'admin/enquires/lists', 62, 'Y', 1),
(64, '', 'Widgets', 'admin/widgets', 0, 'N', 10),
(65, 'page', 'Widgets', 'admin/widgets/lists', 64, 'Y', 1),
(66, 'add_page', 'Add Widget', 'admin/widgets/add', 64, 'Y', 2),
(67, 'page', 'Banners', 'admin/banners/lists', 69, 'Y', 11),
(68, 'add_page', 'Add Banner', 'admin/banners/add', 69, 'Y', 12),
(69, '', 'Home Banners', 'admin/banners', 0, 'Y', 10),
(87, 'users', 'Roles', 'admin/users/roles', 39, 'N', 1),
(73, '', 'Pages', 'admin/pages', 0, 'N', 10),
(74, 'page', 'Page Metas', 'admin/pages/lists', 73, 'Y', 1),
(75, 'add_page', 'Add Page Meta', 'admin/pages/add', 73, 'Y', 2),
(79, 'category', 'Categories', 'admin/downloads/categories', 59, 'Y', 3),
(80, 'category', 'Add Category', 'admin/downloads/addcategory', 59, 'Y', 4),
(90, 'page', 'Students', 'admin/students/lists', 89, 'Y', 1),
(91, 'add_page', 'Add Students', 'admin/students/add', 89, 'Y', 2),
(92, '', 'Courses', 'admin/courses', 0, 'N', 17),
(93, 'add_page', 'Add Courses', 'admin/courses/add', 92, 'N', 2),
(94, 'page', 'Courses', 'admin/courses/lists', 92, 'Y', 1),
(95, '', 'Faculty', 'admin/faculty', 0, 'N', 15),
(96, 'page', 'Faculty', 'admin/faculty/lists', 95, 'Y', 1),
(97, 'add_page', 'Add Faculty', 'admin/faculty/add', 95, 'Y', 2),
(98, '', 'Events', 'admin/events/lists', 0, 'N', 16),
(99, 'page', 'Instructors', 'admin/instructors/lists', 98, 'N', 1),
(100, 'add_page', 'Add Instructors', 'admin/instructors/add', 98, 'Y', 2),
(101, '', 'News & Events', 'admin/news', 0, 'Y', 17),
(102, 'page', 'List All', 'admin/news/lists', 101, 'Y', 1),
(103, 'add_page', 'Add New', 'admin/news/add', 101, 'Y', 2),
(104, '', 'Apply', 'admin/apply', 0, 'N', 18),
(105, 'page', 'Apply', 'admin/apply/lists', 104, 'Y', 1),
(106, 'add_page', 'Add Form', 'admin/apply/add', 104, 'Y', 2),
(107, 'category', 'Categories', 'admin/news/categories', 101, 'Y', 3),
(108, 'category', 'Add Category', 'admin/news/addcategory', 101, 'Y', 4),
(109, '', 'Products', 'admin/products', 0, 'N', 9),
(110, 'page', 'Products', 'admin/products/lists', 109, 'Y', 1),
(111, 'add_page', 'Add Products', 'admin/products/add', 109, 'Y', 2),
(112, 'category', 'Categories', 'admin/products/categories', 109, 'Y', 3),
(113, 'category', 'Add Category', 'admin/products/addcategory', 109, 'Y', 4),
(114, '', 'Gallery', 'admin/gallery', 0, 'N', 8),
(115, 'page', 'Imagegallery', 'admin/gallery/lists', 114, 'N', 1),
(116, 'add_page', 'Add Gallery', 'admin/gallery/add', 114, 'Y', 2),
(117, '', 'Enquiries', 'admin/enquiries', 0, 'Y', 19),
(118, 'users', 'Enquiries', 'admin/enquires/lists', 117, 'Y', 1),
(119, '', 'Newsletter', 'admin/newsletter', 0, 'N', 20),
(120, 'users', 'Newsletter', 'admin/newsletter/lists', 119, 'Y', 1),
(122, 'add_page', 'Add Videos', 'admin/videos/add', 121, 'Y', 1),
(123, 'page', 'Videos', 'admin/videos/lists', 121, 'Y', 2),
(129, 'page', 'Add Gallery', 'admin/gallery/add', 127, 'Y', 0),
(128, 'page', 'Gallery', 'admin/gallery/lists', 127, 'Y', 0),
(127, '', 'Gallery', 'admin/gallery/lists', 0, 'Y', 12),
(130, 'category', 'Categories', 'admin/gallery/categories', 127, 'Y', 0),
(131, 'category', 'Add Category', 'admin/gallery/addcategory', 127, 'Y', 0),
(132, '', 'Videos', 'admin/video/lists', 0, 'Y', 13),
(133, 'page', 'Video', 'admin/video/lists', 132, 'Y', 0),
(134, 'page', 'Add Video', 'admin/video/add', 132, 'Y', 0),
(135, 'category', 'Categories', 'admin/video/categories', 132, 'Y', 0),
(136, 'category', 'Add Category', 'admin/video/addcategory', 132, 'Y', 0),
(138, 'page', 'Team', 'admin/team/lists', 137, 'Y', 0),
(139, 'page', 'Add Team', 'admin/team/add', 137, 'Y', 0),
(140, 'category', 'Categories', 'admin/team/categories', 137, 'Y', 0),
(141, 'category', 'Add Category', 'admin/team/addcategory', 137, 'Y', 0),
(143, 'page', 'Suppliers', 'admin/format/lists', 142, 'Y', 0),
(144, 'page', 'Add Supplier', 'admin/format/add', 142, 'Y', 0),
(145, '', 'Events', 'admin/events', 0, 'N', 15),
(146, 'page', 'Events', 'admin/events/lists', 145, 'Y', 0),
(147, 'add_page', 'Add Events', 'admin/events/add', 145, 'Y', 0),
(148, 'category', 'Categories', 'admin/events/categories', 145, 'Y', 0),
(149, 'category', 'Add Categories', 'admin/events/addcategory', 145, 'Y', 0),
(150, '', 'Locations', 'admin/location/lists', 0, 'N', 16),
(151, 'page', 'Locations', 'admin/location/lists', 150, 'N', 0),
(152, 'page', 'Add Location', 'admin/location/add', 150, 'Y', 0),
(153, '', 'Makes', 'admin/makes/lists', 0, 'N', 17),
(154, 'page', 'Makes', 'admin/makes/lists', 153, 'Y', 0),
(155, 'page', 'Add Make', 'admin/makes/add', 153, 'Y', 0),
(157, 'page', 'Career Development', 'admin/careerdevelop/lists', 156, 'Y', 0),
(158, 'page', 'Add Files', 'admin/careerdevelop/add', 156, 'Y', 0),
(160, 'page', 'Models', 'admin/model/lists', 159, 'Y', 0),
(161, 'page', 'Add Model', 'admin/model/add', 159, 'Y', 0),
(163, 'page', 'Members', 'admin/clients/lists', 162, 'Y', 0),
(165, 'page', 'Supplier Category', 'admin/types/lists', 164, 'Y', 0),
(166, 'page', 'Add Supplier Category', 'admin/types/add', 164, 'Y', 0),
(167, 'report', 'Job Category', 'admin/category/lists', 12, 'N', 0),
(168, 'report', 'Job Location', 'admin/location/lists', 12, 'N', 0),
(169, 'report', 'Short Listed Application', 'admin/careers/applications/Y', 12, 'N', 10),
(170, 'report', 'Suspended', 'admin/careers/suspend', 12, 'N', 11),
(172, 'user', 'Sub Users', 'admin/subusers/lists', 171, 'Y', 0),
(173, 'user', 'Add Sub User', 'admin/subusers/add', 171, 'Y', 0),
(175, 'add_page', 'Add Report', 'admin/reports/add', 174, 'Y', 2),
(176, 'page', 'Reports', 'admin/reports/lists', 174, 'Y', 1),
(177, 'category', 'Categories', 'admin/reports/categories', 174, 'Y', 3),
(178, 'category', 'Add Category', 'admin/reports/addcategory', 174, 'Y', 4),
(180, 'page', 'Blogs', 'admin/blogs/lists/N', 179, 'Y', 0),
(181, 'add_page', 'Add Blogs', 'admin/blogs/add/N', 179, 'Y', 0),
(182, 'category', 'Add Category', 'admin/blogs/addcategory', 179, 'Y', 0),
(183, 'category', 'Categories', 'admin/blogs/categories', 179, 'Y', 0),
(184, '', 'Archieves', 'admin/blogs/lists/Y', 179, 'N', 0),
(186, 'page', 'Newsletter Gallery', 'admin/newsgallery/lists', 185, 'Y', 0),
(187, 'page', 'Add Newsletter Gallery Images', 'admin/newsgallery/add', 185, 'Y', 0),
(188, 'category', 'Categories', 'admin/newsgallery/categories', 185, 'Y', 0),
(189, 'category', 'Add Category', 'admin/newsgallery/addcategory', 185, 'Y', 0),
(191, '', 'Endorsement Registration', 'admin/endorsement/lists', 190, 'Y', 0),
(192, '', 'Testimonials', 'admin/testimonial', 0, 'N', 26),
(193, '', 'Testimonial', 'admin/testimonial/lists', 192, 'Y', 0),
(194, '', 'Add Testimonial', 'admin/testimonial/add', 192, 'Y', 0),
(195, '', 'Brands', 'admin/brands/lists', 0, 'N', 27),
(196, '', 'Brands', 'admin/brands/lists', 195, 'Y', 0),
(197, '', 'Add Brand', 'admin/brands/add', 195, 'Y', 0),
(198, '', 'Services', 'admin/services', 0, 'Y', 3),
(199, 'page', 'Services', 'admin/services/lists', 198, 'Y', 0),
(200, 'add_page', 'Add Services', 'admin/services/add', 198, 'Y', 0),
(201, 'category', 'Categories', 'admin/services/categories', 198, 'Y', 0),
(202, 'category', 'Add Category', 'admin/services/addcategory', 198, 'Y', 0),
(203, '', 'Clients', 'admin/clients', 0, 'Y', 29),
(204, '', 'Add Client', 'admin/clients/add', 203, 'N', 0),
(205, '', 'Clients', 'admin/clients/lists', 203, 'Y', 0),
(206, 'page', 'Sectors', 'admin/sectors', 0, 'N', 3),
(207, 'page', 'Sectors', 'admin/sectors/lists', 206, 'Y', 1),
(208, 'page', 'Add Sectors', 'admin/sectors/add', 206, 'Y', 2),
(209, 'page', 'Categories', 'admin/sectors/categories', 206, 'Y', 3),
(210, 'page', 'Add Category', 'admin/sectors/addcategory', 206, 'Y', 4);
-- --------------------------------------------------------
--
-- Table structure for table `admin_reset`
--
CREATE TABLE `admin_reset` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_key` varchar(300) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `applications`
--
CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `jobs_id` int(11) NOT NULL,
  `jobs_shortlist_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nationality` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `language2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `language3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `visa` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `education` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `studyfield` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `employer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `experience` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `department` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `hearabout` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `uaelicense` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `expiry` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `noticeperiod` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `coverletter` text CHARACTER SET utf8 NOT NULL,
  `resume` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `rating` int(11) NOT NULL DEFAULT '6',
  `suspend` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `read` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `banners`
--
CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `sort_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `banners`
--
INSERT INTO `banners` (`id`, `status`, `sort_order`) VALUES
(1, 'Y', NULL),
(2, 'Y', NULL);
-- --------------------------------------------------------
--
-- Table structure for table `banners_desc`
--
CREATE TABLE `banners_desc` (
  `desc_id` int(11) NOT NULL,
  `banners_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `short_desc` text CHARACTER SET utf8,
  `link` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `banners_desc`
--
INSERT INTO `banners_desc` (`desc_id`, `banners_id`, `title`, `short_desc`, `link`, `icon`, `image`, `language`) VALUES
(1, 1, 'Service You Deserve', '<p>&nbsp;</p>\r\n\r\n<p>People You trust</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', '', 'banner_mafs_homepage_21.jpg', 'en'),
(2, 1, '1', '<p>Service You Deserve. People You trust</p>\r\n', '', '', '', 'ar'),
(3, 2, 'Bringing Innovative Solutions', '<p><br />\r\nFor Your Building Systems</p>\r\n', '', '', 'hero.png', 'en'),
(4, 2, '2', 'Bringing innovative solutions for your building systems', '2', '', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `captcha`
--
CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Table structure for table `client`
--
CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `client`
--
INSERT INTO `client` (`id`, `status`, `image`, `sort_order`) VALUES
(1, 'Y', 'al_otaiba.png', 1),
(2, 'Y', 'al_otaiba_g_t.png', 2),
(3, 'Y', 'bright_spark.png', 3),
(4, 'Y', 'homewide.png', 4);
-- --------------------------------------------------------
--
-- Table structure for table `contacts`
--
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `latitude` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `longitude` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `contacts`
--
INSERT INTO `contacts` (`id`, `category_id`, `latitude`, `longitude`, `status`, `sort_order`) VALUES
(1, 1, '12', '12', 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `contacts_desc`
--
CREATE TABLE `contacts_desc` (
  `desc_id` int(11) NOT NULL,
  `contacts_id` int(11) NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL,
  `address2` text COLLATE latin1_general_ci,
  `style` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `contacts_desc`
--
INSERT INTO `contacts_desc` (`desc_id`, `contacts_id`, `location`, `address`, `address2`, `style`, `image`, `language`) VALUES
(1, 1, 'Dubai', '<p>Office 2004, API Trio Tower,<br />\r\nAl Barsha1, Dubai-UAE<br />\r\n<a href=\"tel:%208006237\">Toll Free: 800MAFS (6237)</a><br />\r\n<a href=\"mailto:%20info@mafsuae.ae\" target=\"_blank\">info@mafsuae.ae </a></p>\r\n', NULL, NULL, '', 'en'),
(2, 1, 'Dubai', '<ul>\r\n	<li>\r\n	<p>Office 2004, API Trio Tower, Al Barsha1, Dubai-UAE</p>\r\n	</li>\r\n	<li>\r\n	<p><a href=\"tel:%208006237\">Toll Free: 800MAFS (6237)</a></p>\r\n	</li>\r\n	<li>\r\n	<p><a href=\"mailto:%20info@mafsuae.ae\" target=\"_blank\">info@mafsuae.ae</a></p>\r\n	</li>\r\n</ul>\r\n', NULL, '', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `contact_category`
--
CREATE TABLE `contact_category` (
  `id` int(11) NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `slug` char(200) COLLATE latin1_general_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `contact_category`
--
INSERT INTO `contact_category` (`id`, `status`, `slug`, `sort_order`) VALUES
(1, 'Y', 'head-office', NULL);
-- --------------------------------------------------------
--
-- Table structure for table `contact_category_desc`
--
CREATE TABLE `contact_category_desc` (
  `desc_id` int(11) NOT NULL,
  `contact_category_id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `contact_category_desc`
--
INSERT INTO `contact_category_desc` (`desc_id`, `contact_category_id`, `name`, `language`) VALUES
(1, 1, 'Head Office', 'en'),
(2, 1, 'Head Office', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `contents`
--
CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `widgets` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `contents`
--
INSERT INTO `contents` (`id`, `category_id`, `slug`, `widgets`, `status`, `sort_order`) VALUES
(1, 1, 'mafs', '', 'Y', 0),
(2, 1, 'mhao-group', '', 'Y', 0),
(3, 2, 'terms-conditions', '', 'Y', 0),
(4, 2, 'privacy-policy', '', 'Y', 0),
(5, 1, 'about-us', '', 'Y', 0),
(6, 3, 'comingsoon', '', 'Y', 0),
(7, 2, 'careers', '', 'Y', 0),
(8, 3, 'news-events', '', 'Y', 0),
(9, 3, 'videos', '', 'Y', 0),
(10, 3, 'pagenotfound', '', 'Y', 0),
(11, 3, 'references', '', 'Y', 0),
(12, 3, 'our-packages', '', 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `contents_desc`
--
CREATE TABLE `contents_desc` (
  `desc_id` int(11) NOT NULL,
  `contents_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `short_desc` text CHARACTER SET utf8 NOT NULL,
  `desc` text CHARACTER SET utf8 NOT NULL,
  `keywords` text COLLATE latin1_general_ci NOT NULL,
  `meta_desc` text COLLATE latin1_general_ci NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pdf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `banner_text` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `banner_image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `contents_desc`
--
INSERT INTO `contents_desc` (`desc_id`, `contents_id`, `title`, `meta_title`, `short_desc`, `desc`, `keywords`, `meta_desc`, `date_time`, `image`, `image2`, `pdf`, `banner_text`, `banner_image`, `language`) VALUES
(1, 1, 'MAFS', 'MAFS', 'MAFS', '<div class=\"row\">\r\n<div class=\"col-lg-6\">\r\n<div class=\"about-img\">\r\n<figure><img class=\"img-fluid w-100 rounded\" src=\"https://mafsuae.ae/wp-content/uploads/2018/05/about_image_2.jpg\" /></figure>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-6 pt-5 pt-lg-0\">\r\n<div class=\"about-content\">\r\n<h3 class=\"font-weight-bold\">WHO WE ARE</h3>\r\n\r\n<h4>Service you deserve. People You Trust!</h4>\r\n\r\n<p>Mohamed Al Otaiba Facilities Management Services LLC, a subsidiary of Mohamed Hareb Al Otaiba Group, is distinctive among its peers and brings together the tailored facility management services that fits your specific working environment and corporate culture. Our facility management services are focused on enhancing your corporate workspace with an innovative approach.</p>\r\n\r\n<p>Our facility management services are focused on enhancing your corporate workspace, with an innovative approach. For clients seeking premium integrated facilities we establish a transparency and look through the needs of the customers to deliver services that can positively impact the customer experience within their business.</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 pt-5 pt-lg-0\">\r\n<div class=\"about-content\">\r\n<h3 class=\"font-weight-bold\">CORPORATE CULTURE</h3>\r\n\r\n<h4>Our Drive</h4>\r\n\r\n<p>To be adept and alert with the conviction to improve our performance and to seek new ways to deliver ingenious and cost-effective solutions.</p>\r\n\r\n<h4>Our Daring</h4>\r\n\r\n<p>We are resolute, progressive and astute, living in the present with optimism in providing standalone facility management that deliver mould-breaking services and solutions</p>\r\n\r\n<h4>Our Commitment</h4>\r\n\r\n<p>We focus on offering the highest level of service in the industry and deliver real &lsquo;solutions with a soul&rsquo; that truly enhance the value of your investment. We are committed to keep a sight of the constantly changing needs of our customers.</p>\r\n\r\n<h4>Our Cohesion</h4>\r\n\r\n<p>Exchanging knowledge and skills to generate a strong spirit of teamwork, we unite towards a sustainable progress and development. We are always there for each other, working together as one team.</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-6\">\r\n<div class=\"about-img\">\r\n<figure><img class=\"img-fluid w-100 rounded\" src=\"https://mafsuae.ae/wp-content/uploads/2018/05/corporate_culture-1.jpg\" /></figure>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 pt-5 pt-lg-0\">\r\n<div class=\"about-content\">\r\n<h3 class=\"font-weight-bold\">THE LEGACY</h3>\r\n\r\n<h4>History</h4>\r\n\r\n<p>It is impossible to talk about MAFS without mentioning the importance of the Al Otaiba Family. Al Otaiba is one of the oldest names in the history of the UAE and over the years has had great influence on political, economic and social life in the Emirates. Despite a long family tradition of trading high-quality goods around the world, it was not until 1946 that the MHAO Group was officially formed as a general trading and offshore services establishment. The company would diversify in the 1970s however, under the guidance of the late Mr. Hareb Al Otaiba. The early 70s also saw the opening of the company&rsquo;s prestigious Dubai showroom, which cemented MHAO&rsquo;s name as the watchword for high-end goods. Some of the oldest divisions of the group that still exist today are Food Service Equipment, Leisure &amp; Sports, Bowling, Domestic Appliances, Office Equipment and Customer Service</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-6 pt-5 pt-lg-0\">\r\n<h4>Expansion and Growth</h4>\r\n\r\n<div class=\"about-content\">\r\n<p>The expanding of the company&rsquo;s portfolio that started with food-service equipment has now lead to the launching of Mohamed Al Otaiba Facilities Management Services LLC, a subsidiary of Mohamed Hareb Al Otaiba Group, that enables us to deliver sustainable customer solutions in energy efficiency, asset efficiency and human comfort. We measure our success by looking into the future and chiselling out new niches within the markets that we serve.</p>\r\n\r\n<p>We constantly seek out for cost-effective solutions that fully streamlines budgeting, communications and accountability. This gives our clients both peace-of-mind and the advantage of clearer planning. With more than 1000+ employees working for us we have now made tremendous progress since our inception and look forward to many more decades of success with our team by our side.</p>\r\n</div>\r\n</div>\r\n</div>\r\n', 'MAFS', 'MAFS', '1970-01-01 01:00:00', '', '', '', '', '', 'en'),
(2, 1, 'MAFS', 'MAFS', 'MAFS', '<p>Mohamed Al Otaiba Facilities Management Services LLC, a subsidiary of Mohamed Hareb Al Otaiba Group, is distinctive among its peers and brings together the tailored facility management services that fits your specific working environment and corporate culture. Our facility management services are focused on enhancing your corporate workspace with an innovative approach. Our facility management services are focused on enhancing your corporate workspace, with an innovative approach. For clients seeking premium integrated facilities we establish a transparency and look through the needs of the customers to deliver services that can positively impact the customer experience within their business.</p>\r\n', 'MAFS', 'MAFS', '2020-10-04 16:21:25', '', '', '', '', '', 'ar'),
(3, 2, 'MHAO Group', 'MHAO Group', 'MHAO Group', '<p>It is impossible to talk about MAFS without mentioning the importance of the Al Otaiba Family. Al Otaiba is one of the oldest names in the history of the UAE and over the years has had great influence on political, economic and social life in the Emirates.&nbsp;</p>\r\n\r\n<p>Despite a long family tradition of trading high-quality goods around the world, it was not until 1946 that the MHAO Group was officially formed as a general trading and offshore services establishment. The company would diversify in the 1970s however, under the guidance of the late Mr. Hareb Al Otaiba.</p>\r\n\r\n<p>In the period that followed, MHAO expanded its trading operations to include internationally recognized, high-quality brands. The early 70s also saw the opening of the company&rsquo;s prestigious Dubai showroom, which cemented MHAO&rsquo;s name as the watchword for high-end goods.</p>\r\n\r\n<p>The expanding of the company&rsquo;s portfolio that started with food-service equipment and domestic appliances has blossomed over the years, as more and more international brands were added to the fold.</p>\r\n\r\n<p>However, under the leadership of Mr. Mohamed Hareb Al Otaiba, they sit alongside modern counterparts that encompass some of the business world&rsquo;s most recognizable names &ndash; including Xerox Emirates, Avis Rent a Car, and Homewide.</p>\r\n', 'MHAO Group', 'MHAO Group', '1970-01-01 01:00:00', '', '', '', '', '', 'en'),
(4, 2, 'MHAO Group', 'MHAO Group', 'MHAO Group', 'It is impossible to talk about MAFS without mentioning the importance of the Al Otaiba Family. Al Otaiba is one of the oldest names in the history of the UAE and over the years has had great influence on political, economic and social life in the Emirates. Despite a long family tradition of trading high-quality goods around the world, it was not until 1946 that the MHAO Group was officially formed as a general trading and offshore services establishment. The company would diversify in the 1970s however, under the guidance of the late Mr. Hareb Al Otaiba. The early 70s also saw the opening of the company’s prestigious Dubai showroom, which cemented MHAO’s name as the watchword for high-end goods. Some of the oldest divisions of the group that still exist today are Food Service Equipment, Leisure & Sports, Bowling, Domestic Appliances, Office Equipment and Customer Service', 'MHAO Group', 'MHAO Group', '2020-10-04 16:22:01', '', '', '', '', '', 'ar'),
(5, 3, 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '<p>Please read these Terms and Conditions of Use (&quot;Terms&quot;) carefully before using www.mhao.com (&quot;Website&quot;). These Terms apply to all users of this Website including casual browsers. Please read these Terms carefully before using the Website.</p>\r\n\r\n<p>In these Terms, &quot;we&quot;, &quot;us&quot; and &quot;MHAO&quot; means &quot;MHAO&quot;, an organization existing under the laws of the UAE.</p>\r\n\r\n<p>Mohamed Hareb Al Otaiba (&quot;MHAO&quot;) authorizes you to view and download the material present on the Website only for your personal, non-commercial use, provided that you retain all copyright and other proprietary notices contained in the original material on any copies of the materials. Permission is hereby granted to use, copy and distribute the material as presented on the Website and without alteration for non-commercial purposes only; provided that all copyright and other proprietary notices appear in all copies in the same manner as the original. All other uses are prohibited. Any use of the material on any other website or networked computer environment for any purpose is prohibited.</p>\r\n\r\n<p>Copyright / Trademark</p>\r\n\r\n<p>Except where otherwise indicated, all material contained on this Website is the copyrighted property of MHAO, its affiliated companies and/or third party licensors.</p>\r\n\r\n<p>Any unauthorized use of any material may violate copyright, trademark and other laws. If you breach any of these Terms, your authorization to use the Website automatically terminates and you must immediately destroy any downloaded or printed material.</p>\r\n\r\n<p>Except as expressly provided herein, you shall not use any portion of this Website or any other intellectual property of MHAO on any other website, in the source code of any other website, or in any other printed or electronic material. Except as expressly provided herein, you shall not modify, publish, reproduce, republish, create derivative works, copy, upload, post, transmit, distribute, or otherwise use any of this Website&#39;s content or frame this Website within any other Website without our prior written permission. Systematic retrieval of data or other content from this Website to create or compile, directly or indirectly, a collection, compilation, database or directory, without prior written permission from MHAO, is prohibited.</p>\r\n', 'Terms & Conditions', 'Terms & Conditions', '2020-10-04 16:24:53', '', '', '', '', '', 'en'),
(6, 3, 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '<p>Please read these Terms and Conditions of Use (&quot;Terms&quot;) carefully before using www.mhao.com (&quot;Website&quot;). These Terms apply to all users of this Website including casual browsers. Please read these Terms carefully before using the Website.</p>\r\n\r\n<p>In these Terms, &quot;we&quot;, &quot;us&quot; and &quot;MHAO&quot; means &quot;MHAO&quot;, an organization existing under the laws of the UAE.</p>\r\n\r\n<p>Mohamed Hareb Al Otaiba (&quot;MHAO&quot;) authorizes you to view and download the material present on the Website only for your personal, non-commercial use, provided that you retain all copyright and other proprietary notices contained in the original material on any copies of the materials. Permission is hereby granted to use, copy and distribute the material as presented on the Website and without alteration for non-commercial purposes only; provided that all copyright and other proprietary notices appear in all copies in the same manner as the original. All other uses are prohibited. Any use of the material on any other website or networked computer environment for any purpose is prohibited.</p>\r\n\r\n<p>Copyright / Trademark</p>\r\n\r\n<p>Except where otherwise indicated, all material contained on this Website is the copyrighted property of MHAO, its affiliated companies and/or third party licensors.</p>\r\n\r\n<p>Any unauthorized use of any material may violate copyright, trademark and other laws. If you breach any of these Terms, your authorization to use the Website automatically terminates and you must immediately destroy any downloaded or printed material.</p>\r\n\r\n<p>Except as expressly provided herein, you shall not use any portion of this Website or any other intellectual property of MHAO on any other website, in the source code of any other website, or in any other printed or electronic material. Except as expressly provided herein, you shall not modify, publish, reproduce, republish, create derivative works, copy, upload, post, transmit, distribute, or otherwise use any of this Website&#39;s content or frame this Website within any other Website without our prior written permission. Systematic retrieval of data or other content from this Website to create or compile, directly or indirectly, a collection, compilation, database or directory, without prior written permission from MHAO, is prohibited.</p>\r\n', 'Terms & Conditions', 'Terms & Conditions', '2020-10-04 16:24:53', '', '', '', '', '', 'ar'),
(7, 4, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '<p>Mohammed Hareb Al Otaiba Group and its subsidiaries or affiliated companies are committed to respect the&nbsp;&nbsp;privacy of the visitor while using our website. This policy applies to information collected by us on our website.</p>\r\n\r\n<p>Your privacy is important to us.</p>\r\n\r\n<p><b>The information we collect</b></p>\r\n\r\n<p>We do not collect personally identifiable information about you, unless you choose to fill out your information on this website. In general, you may browse our website without providing any personally identifiable information about yourself. We do automatically collect certain non-personally identifiable information when you visit our website such as the type of operating system, the type of browser you are using, your IP address in order to provide better usability.</p>\r\n', 'Privacy Policy', 'Privacy Policy', '2020-10-04 16:25:28', '', '', '', '', '', 'en'),
(8, 4, 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '<p>Mohammed Hareb Al Otaiba Group and its subsidiaries or affiliated companies are committed to respect the&nbsp;&nbsp;privacy of the visitor while using our website. This policy applies to information collected by us on our website.</p>\r\n\r\n<p>Your privacy is important to us.</p>\r\n\r\n<p><b>The information we collect</b></p>\r\n\r\n<p>We do not collect personally identifiable information about you, unless you choose to fill out your information on this website. In general, you may browse our website without providing any personally identifiable information about yourself. We do automatically collect certain non-personally identifiable information when you visit our website such as the type of operating system, the type of browser you are using, your IP address in order to provide better usability.</p>\r\n', 'Privacy Policy', 'Privacy Policy', '2020-10-04 16:25:28', '', '', '', '', '', 'ar'),
(9, 5, 'About Us', 'About Us', 'About Us', '<div class=\"row\">\r\n<div class=\"col-lg-6\">\r\n<div class=\"about-img\">\r\n<figure><img class=\"img-fluid w-100 rounded\" src=\"https://mafsuae.ae/wp-content/uploads/2018/05/about_image_2.jpg\" /></figure>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-6 pt-5 pt-lg-0\">\r\n<div class=\"about-content\">\r\n<h3 class=\"font-weight-bold\">WHO WE ARE</h3>\r\n\r\n<p>Mohamed Al Otaiba Facilities Management Services LLC, a subsidiary of Mohamed Hareb Al Otaiba Group, is distinctive among its peers and brings together the tailored facility management services that fits your specific working environment and corporate culture. Our facility management services are focused on enhancing your corporate workspace with an innovative approach.</p>\r\n\r\n<p>Our facility management services are focused on enhancing your corporate workspace, with an innovative approach. For clients seeking premium integrated facilities we establish a transparency and look through the needs of the customers to deliver services that can positively impact the customer experience within their business.</p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 pt-5 pt-lg-0\">\r\n<div class=\"about-content\">\r\n<h3 class=\"font-weight-bold\">CORPORATE CULTURE</h3>\r\n\r\n<p>To be adept and alert with the conviction to improve our performance and to seek new ways to deliver ingenious and cost-effective solutions.</p>\r\n\r\n<p>We are resolute, progressive and astute, living in the present with optimism in providing standalone facility management that deliver mould-breaking services and solutions</p>\r\n\r\n<p>We focus on offering the highest level of service in the industry and deliver real &lsquo;solutions with a soul&rsquo; that truly enhance the value of your investment. We are committed to keep a sight of the constantly changing needs of our customers.</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-lg-6\">\r\n<div class=\"about-img\">\r\n<figure><img class=\"img-fluid w-100 rounded\" src=\"https://mafsuae.ae/wp-content/uploads/2018/05/corporate_culture-1.jpg\" /></figure>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 pt-5 pt-lg-0\">\r\n<div class=\"about-content\">\r\n<h3 class=\"font-weight-bold\">&nbsp;</h3>\r\n</div>\r\n</div>\r\n</div>\r\n', 'About Us', 'About Us', '1970-01-01 01:00:00', '', '', '', '', '', 'en'),
(10, 5, 'About Us', 'About Us', 'About Us', '<h2>WHO WE ARE</h2>\r\n\r\n<h4>Service you deserve. People You Trust!</h4>\r\n\r\n<p>Mohamed Al Otaiba Facilities Management Services LLC, a subsidiary of Mohamed Hareb Al Otaiba Group, is distinctive among its peers and brings together the tailored facility management services that fits your specific working environment and corporate culture. Our facility management services are focused on enhancing your corporate workspace with an innovative approach.</p>\r\n\r\n<p>Our facility management services are focused on enhancing your corporate workspace, with an innovative approach. For clients seeking premium integrated facilities we establish a transparency and look through the needs of the customers to deliver services that can positively impact the customer experience within their business.</p>\r\n\r\n<h4>Why MAFS</h4>\r\n\r\n<ul>\r\n	<li>Speedy Response</li>\r\n	<li>Innovative Technology</li>\r\n	<li>Advanced Equipment&rsquo;s and Tools</li>\r\n	<li>Quick solutions</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>Professional Supervision</li>\r\n	<li>Customer satisfaction program</li>\r\n	<li>Emergency Team</li>\r\n	<li>Toll Free 24/7</li>\r\n</ul>\r\n', 'About Us', 'About Us', '2020-10-04 20:57:58', '', '', '', '', '', 'ar'),
(11, 6, 'Coming soon', '', 'pagenotfound', '<p>Coming soon</p>\r\n', '', '', '1970-01-01 01:00:00', '', '', '', '', '', 'en'),
(12, 6, 'pagenotfound', '', 'pagenotfound', 'pagenotfound', '', '', '2020-10-05 11:29:15', '', '', '', '', '', 'ar'),
(13, 7, 'careers', 'careers', 'Together Let\'s Make Business History', '<h3>Together Let&#39;s Make Business History</h3>\r\n\r\n<p>We would not be where we are today -- celebrating 73 years of unmatched business excellence -- if it were not for the determination and hard work of our experienced employees and reputed business partners. They are the lifeblood of the Mohamed Hareb Al Otaiba Group, and what makes us one of the most successful business houses in the UAE.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a class=\"btn btn-primary\" href=\"https://oss.menaitechsystems.com/mhao/onlineapp/onlineapplication/mhao/mhao/1\" target=\"_blank\">Visit Career Portal</a></p>\r\n', '', 'careers', '1970-01-01 01:00:00', '', '', '', '', '', 'en'),
(15, 8, 'News & Events', 'News & Events', 'News & Events', '', 'News & Events', 'News & Events', '2020-10-05 12:58:37', '', '', '', '', '', 'en'),
(16, 8, 'News & Events', 'News & Events', 'News & Events', '', 'News & Events', 'News & Events', '2020-10-05 12:58:37', '', '', '', '', '', 'ar'),
(17, 9, 'Videos', 'Videos', 'Videos', '', 'Videos', 'Videos', '2020-10-05 14:44:05', '', '', '', '', '', 'en'),
(18, 9, 'Videos', 'Videos', 'Videos', '', 'Videos', 'Videos', '2020-10-05 14:44:05', '', '', '', '', '', 'ar'),
(19, 10, '404', '', 'pagenotfound', '<h1>Oops</h1>\r\n\r\n<p>Something went wrong,we can&#39;t find the page that you are looking for :(But there is a lot more for you!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a class=\"btn btn-primary\" href=\"home\">GO HOME</a></p>\r\n', '', '', '1970-01-01 01:00:00', '', '', '', '', '', 'en'),
(20, 10, 'pagenotfound', '', 'pagenotfound', '<h1>Oops</h1>\r\n\r\n<p>Something went wrong,we can&#39;t find the page that you are looking for :(But there is a lot more for you!</p>\r\n\r\n<p>&nbsp;</p>\r\n<a href=\"/home\" class=\"btn btn-primary\">GO HOME</a>\r\n', '', '', '2020-10-05 15:51:03', '', '', '', '', '', 'ar'),
(21, 11, 'References', 'References', 'References', '<p>Coming soon</p>\r\n', 'References', 'References', '1969-12-31 19:00:00', '', '', '', '', '', 'en'),
(22, 11, 'Referances', 'Referances', 'Referances', 'Coming soon', 'Referances', 'Referances', '2020-10-05 19:08:36', '', '', '', '', '', 'ar'),
(23, 12, 'Our Packages', 'Our Packages', 'Our Packages', 'Coming soon', '', 'Our Packages', '2020-10-05 19:09:15', '', '', '', '', '', 'en'),
(24, 12, 'Our Packages', 'Our Packages', 'Our Packages', 'Coming soon', '', 'Our Packages', '2020-10-05 19:09:15', '', '', '', '', '', 'ar'),
(14, 7, 'Terms & Conditions', 'Terms & Conditions', 'Terms & Conditions', '<p>Please read these Terms and Conditions of Use (&quot;Terms&quot;) carefully before using www.mhao.com (&quot;Website&quot;). These Terms apply to all users of this Website including casual browsers. Please read these Terms carefully before using the Website.</p>\r\n\r\n<p>In these Terms, &quot;we&quot;, &quot;us&quot; and &quot;MHAO&quot; means &quot;MHAO&quot;, an organization existing under the laws of the UAE.</p>\r\n\r\n<p>Mohamed Hareb Al Otaiba (&quot;MHAO&quot;) authorizes you to view and download the material present on the Website only for your personal, non-commercial use, provided that you retain all copyright and other proprietary notices contained in the original material on any copies of the materials. Permission is hereby granted to use, copy and distribute the material as presented on the Website and without alteration for non-commercial purposes only; provided that all copyright and other proprietary notices appear in all copies in the same manner as the original. All other uses are prohibited. Any use of the material on any other website or networked computer environment for any purpose is prohibited.</p>\r\n\r\n<p>Copyright / Trademark</p>\r\n\r\n<p>Except where otherwise indicated, all material contained on this Website is the copyrighted property of MHAO, its affiliated companies and/or third party licensors.</p>\r\n\r\n<p>Any unauthorized use of any material may violate copyright, trademark and other laws. If you breach any of these Terms, your authorization to use the Website automatically terminates and you must immediately destroy any downloaded or printed material.</p>\r\n\r\n<p>Except as expressly provided herein, you shall not use any portion of this Website or any other intellectual property of MHAO on any other website, in the source code of any other website, or in any other printed or electronic material. Except as expressly provided herein, you shall not modify, publish, reproduce, republish, create derivative works, copy, upload, post, transmit, distribute, or otherwise use any of this Website&#39;s content or frame this Website within any other Website without our prior written permission. Systematic retrieval of data or other content from this Website to create or compile, directly or indirectly, a collection, compilation, database or directory, without prior written permission from MHAO, is prohibited.</p>\r\n', '', 'Terms & Conditions', '2020-10-05 11:41:39', '', '', '', '', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `content_category`
--
CREATE TABLE `content_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `widgets` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `breadcrumb_status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'Y',
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `content_category`
--
INSERT INTO `content_category` (`id`, `parent_id`, `slug`, `widgets`, `breadcrumb_status`, `status`) VALUES
(1, 0, 'about-us', '', 'Y', 'Y'),
(2, 0, 'copyrights', '', 'Y', 'Y'),
(3, 0, 'general', '', 'Y', 'Y');
-- --------------------------------------------------------
--
-- Table structure for table `content_category_desc`
--
CREATE TABLE `content_category_desc` (
  `desc_id` int(11) NOT NULL,
  `content_category_id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `short_desc` text COLLATE latin1_general_ci NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `keywords` text COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `content_category_desc`
--
INSERT INTO `content_category_desc` (`desc_id`, `content_category_id`, `name`, `short_desc`, `image`, `keywords`, `language`) VALUES
(1, 1, 'About Us', 'About Us', NULL, 'About Us', 'en'),
(2, 1, 'About Us', 'About Us', NULL, 'About Us', 'ar'),
(3, 2, 'Copyrights', '', NULL, '', 'en'),
(4, 2, 'References ', 'References ', NULL, '', 'ar'),
(5, 3, 'General', '', NULL, '', 'en'),
(6, 3, 'General', '', NULL, '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `countries`
--
CREATE TABLE `countries` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `isocode` varchar(20) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `language` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- Dumping data for table `countries`
--
INSERT INTO `countries` (`id`, `name`, `isocode`, `status`, `language`) VALUES
(1, 'Afghanistan', 'AF', 'Y', 'en'),
(2, 'Albania', 'AL', 'Y', 'en'),
(3, 'Algeria', 'DZ', 'Y', 'en'),
(4, 'Andorra', 'AD', 'Y', 'en'),
(5, 'Angola', 'AO', 'Y', 'en'),
(6, 'Anguilla', 'AI', 'Y', 'en'),
(7, 'Antarctica', 'AQ', 'Y', 'en'),
(8, 'Antigua and Barbuda', 'AG', 'Y', 'en'),
(9, 'Argentina', 'AR', 'Y', 'en'),
(10, 'Armenia', 'AM', 'Y', 'en'),
(11, 'Aruba', 'AW', 'Y', 'en'),
(12, 'Australia', 'AU', 'Y', 'en'),
(13, 'Austria', 'AT', 'Y', 'en'),
(14, 'Azerbaidjan', 'AZ', 'Y', 'en'),
(15, 'Bahamas', 'BS', 'Y', 'en'),
(16, 'Bahrain', 'BH', 'Y', 'en'),
(17, 'Bangladesh', 'BD', 'Y', 'en'),
(18, 'Barbados', 'BB', 'Y', 'en'),
(19, 'Belarus', 'BY', 'Y', 'en'),
(20, 'Belgium', 'BE', 'Y', 'en'),
(21, 'Belize', 'BZ', 'Y', 'en'),
(22, 'Benin', 'BJ', 'Y', 'en'),
(23, 'Bermuda', 'BM', 'Y', 'en'),
(24, 'Bhutan', 'BT', 'Y', 'en'),
(25, 'Bolivia', 'BO', 'Y', 'en'),
(26, 'Bosnia-Herzegovina', 'BA', 'Y', 'en'),
(27, 'Botswana', 'BW', 'Y', 'en'),
(28, 'Bouvet Island', 'BV', 'Y', 'en'),
(29, 'Brazil', 'BR', 'Y', 'en'),
(30, 'Brunei Darussalam', 'BN', 'Y', 'en'),
(31, 'Bulgaria', 'BG', 'Y', 'en'),
(32, 'Burkina Faso', 'BF', 'Y', 'en'),
(33, 'Burundi', 'BI', 'Y', 'en'),
(34, 'Cambodia', 'KH', 'Y', 'en'),
(35, 'Cameroon', 'CM', 'Y', 'en'),
(36, 'Cape Verde', 'CV', 'Y', 'en'),
(37, 'Cayman Islands', 'KY', 'Y', 'en'),
(38, 'Central African Republic', 'CF', 'Y', 'en'),
(39, 'Chad', 'TD', 'Y', 'en'),
(40, 'Chile', 'CL', 'Y', 'en'),
(41, 'China', 'CN', 'Y', 'en'),
(42, 'Christmas Island', 'CX', 'Y', 'en'),
(43, 'Cocos (Keeling) Islands', 'CC', 'Y', 'en'),
(44, 'Colombia', 'CO', 'Y', 'en'),
(45, 'Commercial', 'COM', 'Y', 'en'),
(46, 'Comoros', 'KM', 'Y', 'en'),
(47, 'Congo', 'CG', 'Y', 'en'),
(48, 'Cook Islands', 'CK', 'Y', 'en'),
(49, 'Costa Rica', 'CR', 'Y', 'en'),
(50, 'Croatia', 'HR', 'Y', 'en'),
(51, 'Cuba', 'CU', 'Y', 'en'),
(52, 'Cyprus', 'CY', 'Y', 'en'),
(53, 'Czech Republic', 'CZ', 'Y', 'en'),
(54, 'Denmark', 'DK', 'Y', 'en'),
(55, 'Djibouti', 'DJ', 'Y', 'en'),
(56, 'Dominica', 'DM', 'Y', 'en'),
(57, 'East Timor', 'TP', 'Y', 'en'),
(58, 'Ecuador', 'EC', 'Y', 'en'),
(59, 'Egypt', 'EG', 'Y', 'en'),
(60, 'El Salvador', 'SV', 'Y', 'en'),
(61, 'Equatorial Guinea', 'GQ', 'Y', 'en'),
(62, 'Eritrea', 'ER', 'Y', 'en'),
(63, 'Estonia', 'EE', 'Y', 'en'),
(64, 'Ethiopia', 'ET', 'Y', 'en'),
(65, 'Falkland Islands', 'FK', 'Y', 'en'),
(66, 'Faroe Islands', 'FO', 'Y', 'en'),
(67, 'Fiji', 'FJ', 'Y', 'en'),
(68, 'Finland', 'FI', 'Y', 'en'),
(69, 'France', 'FR', 'Y', 'en'),
(70, 'Gabon', 'GA', 'Y', 'en'),
(71, 'Gambia', 'GM', 'Y', 'en'),
(72, 'Georgia', 'GE', 'Y', 'en'),
(73, 'Germany', 'DE', 'Y', 'en'),
(74, 'Ghana', 'GH', 'Y', 'en'),
(75, 'Gibraltar', 'GI', 'Y', 'en'),
(76, 'Great Britain', 'GB', 'Y', 'en'),
(77, 'Greece', 'GR', 'Y', 'en'),
(78, 'Greenland', 'GL', 'Y', 'en'),
(79, 'Grenada', 'GD', 'Y', 'en'),
(80, 'Guatemala', 'GT', 'Y', 'en'),
(81, 'Guinea', 'GN', 'Y', 'en'),
(82, 'Guinea Bissau', 'GW', 'Y', 'en'),
(83, 'Guyana', 'GY', 'Y', 'en'),
(84, 'Haiti', 'HT', 'Y', 'en'),
(85, 'Honduras', 'HN', 'Y', 'en'),
(86, 'Hong Kong', 'HK', 'Y', 'en'),
(87, 'Hungary', 'HU', 'Y', 'en'),
(88, 'Iceland', 'IS', 'Y', 'en'),
(89, 'India', 'IN', 'Y', 'en'),
(90, 'Indonesia', 'ID', 'Y', 'en'),
(91, 'International', 'INT', 'Y', 'en'),
(92, 'Iran', 'IR', 'Y', 'en'),
(93, 'Iraq', 'IQ', 'Y', 'en'),
(94, 'Ireland', 'IE', 'Y', 'en'),
(95, 'Italy', 'IT', 'Y', 'en'),
(96, 'Ivory Coast', 'CI', 'Y', 'en'),
(97, 'Jamaica', 'JM', 'Y', 'en'),
(98, 'Japan', 'JP', 'Y', 'en'),
(99, 'Jordan', 'JO', 'Y', 'en'),
(100, 'Kazakhstan', 'KZ', 'Y', 'en'),
(101, 'Kenya', 'KE', 'Y', 'en'),
(102, 'Kiribati', 'KI', 'Y', 'en'),
(103, 'Kuwait', 'KW', 'Y', 'en'),
(104, 'Kyrgyzstan', 'KG', 'Y', 'en'),
(105, 'Laos', 'LA', 'Y', 'en'),
(106, 'Latvia', 'LV', 'Y', 'en'),
(107, 'Lebanon', 'LB', 'Y', 'en'),
(108, 'Lesotho', 'LS', 'Y', 'en'),
(109, 'Liberia', 'LR', 'Y', 'en'),
(110, 'Libya', 'LY', 'Y', 'en'),
(111, 'Liechtenstein', 'LI', 'Y', 'en'),
(112, 'Lithuania', 'LT', 'Y', 'en'),
(113, 'Luxembourg', 'LU', 'Y', 'en'),
(114, 'Macau', 'MO', 'Y', 'en'),
(115, 'Macedonia', 'MK', 'Y', 'en'),
(116, 'Madagascar', 'MG', 'Y', 'en'),
(117, 'Malawi', 'MW', 'Y', 'en'),
(118, 'Malaysia', 'MY', 'Y', 'en'),
(119, 'Maldives', 'MV', 'Y', 'en'),
(120, 'Malii', 'ML', 'Y', 'en'),
(121, 'Malta', 'MT', 'Y', 'en'),
(122, 'Marshall Islands', 'MH', 'Y', 'en'),
(123, 'Mauritania', 'MR', 'Y', 'en'),
(124, 'Mauritius', 'MU', 'Y', 'en'),
(125, 'Mayotte', 'YT', 'Y', 'en'),
(126, 'Mexico', 'MX', 'Y', 'en'),
(127, 'Micronesia', 'FM', 'Y', 'en'),
(128, 'Moldavia', 'MD', 'Y', 'en'),
(129, 'Monaco', 'MC', 'Y', 'en'),
(130, 'Mongolia', 'MN', 'Y', 'en'),
(131, 'Montserrat', 'MS', 'Y', 'en'),
(132, 'Morocco', 'MA', 'Y', 'en'),
(133, 'Mozambique', 'MZ', 'Y', 'en'),
(134, 'Myanmar', 'MM', 'Y', 'en'),
(135, 'Namibia', 'NA', 'Y', 'en'),
(136, 'Nauru', 'NR', 'Y', 'en'),
(137, 'Nepal', 'NP', 'Y', 'en'),
(138, 'Netherlands', 'NL', 'Y', 'en'),
(139, 'New Zealand', 'NZ', 'Y', 'en'),
(140, 'Nicaragua', 'NI', 'Y', 'en'),
(141, 'Niger', 'NE', 'Y', 'en'),
(142, 'Nigeria', 'NG', 'Y', 'en'),
(143, 'Niue', 'NU', 'Y', 'en'),
(144, 'Norfolk Island', 'NF', 'Y', 'en'),
(145, 'North Korea', 'KP', 'Y', 'en'),
(146, 'Norway', 'NO', 'Y', 'en'),
(147, 'Oman', 'OM', 'Y', 'en'),
(148, 'Pakistan', 'PK', 'Y', 'en'),
(149, 'Palau', 'PW', 'Y', 'en'),
(150, 'Panama', 'PA', 'Y', 'en'),
(151, 'Papua New Guinea', 'PG', 'Y', 'en'),
(152, 'Paraguay', 'PY', 'Y', 'en'),
(153, 'Peru', 'PE', 'Y', 'en'),
(154, 'Philippines', 'PH', 'Y', 'en'),
(155, 'Pitcairn Island', 'PN', 'Y', 'en'),
(156, 'Poland', 'PL', 'Y', 'en'),
(157, 'Portugal', 'PT', 'Y', 'en'),
(158, 'Puerto Rico', 'PR', 'Y', 'en'),
(159, 'Qatar', 'QA', 'Y', 'en'),
(160, 'Romania', 'RO', 'Y', 'en'),
(161, 'Russian Federation', 'RU', 'Y', 'en'),
(162, 'Rwanda', 'RW', 'Y', 'en'),
(163, 'Samoa', 'WS', 'Y', 'en'),
(164, 'San Marino', 'SM', 'Y', 'en'),
(165, 'Saudi Arabia', 'SA', 'Y', 'en'),
(166, 'Senegal', 'SN', 'Y', 'en'),
(167, 'Seychelles', 'SC', 'Y', 'en'),
(168, 'Sierra Leone', 'SL', 'Y', 'en'),
(169, 'Singapore', 'SG', 'Y', 'en'),
(170, 'Slovak Republic', 'SK', 'Y', 'en'),
(171, 'Slovenia', 'SI', 'Y', 'en'),
(172, 'Solomon Islands', 'SB', 'Y', 'en'),
(173, 'Somalia', 'SO', 'Y', 'en'),
(174, 'South Africa', 'ZA', 'Y', 'en'),
(175, 'South Korea', 'KR', 'Y', 'en'),
(176, 'Spain', 'ES', 'Y', 'en'),
(177, 'Sri Lanka', 'LK', 'Y', 'en'),
(178, 'Sudan', 'SD', 'Y', 'en'),
(179, 'Suriname', 'SR', 'Y', 'en'),
(180, 'Swaziland', 'SZ', 'Y', 'en'),
(181, 'Sweden', 'SE', 'Y', 'en'),
(182, 'Switzerland', 'CH', 'Y', 'en'),
(183, 'Syria', 'SY', 'Y', 'en'),
(184, 'Tadjikistan', 'TJ', 'Y', 'en'),
(185, 'Taiwan', 'TW', 'Y', 'en'),
(186, 'Tanzania', 'TZ', 'Y', 'en'),
(187, 'Thailand', 'TH', 'Y', 'en'),
(188, 'Togo', 'TG', 'Y', 'en'),
(189, 'Tokelau', 'TK', 'Y', 'en'),
(190, 'Tonga', 'TO', 'Y', 'en'),
(191, 'Trinidad and Tobago', 'TT', 'Y', 'en'),
(192, 'Tunisia', 'TN', 'Y', 'en'),
(193, 'Turkey', 'TR', 'Y', 'en'),
(194, 'Turkmenistan', 'TM', 'Y', 'en'),
(195, 'Tuvalu', 'TV', 'Y', 'en'),
(196, 'Uganda', 'UG', 'Y', 'en'),
(197, 'Ukraine', 'UA', 'Y', 'en'),
(198, 'UAE', 'AE', 'Y', 'en'),
(199, 'United Kingdom', 'UK', 'Y', 'en'),
(200, 'United States', 'US', 'Y', 'en'),
(201, 'Uruguay', 'UY', 'Y', 'en'),
(202, 'Uzbekistan', 'UZ', 'Y', 'en'),
(203, 'Vanuatu', 'VU', 'Y', 'en'),
(204, 'Vatican City State', 'VA', 'Y', 'en'),
(205, 'Venezuela', 'VE', 'Y', 'en'),
(206, 'Vietnam', 'VN', 'Y', 'en'),
(207, 'Palestine', 'PAL', 'Y', 'en'),
(208, 'Western Sahara', 'EH', 'Y', 'en'),
(209, 'Yemen', 'YE', 'Y', 'en'),
(210, 'Yugoslavia', 'YU', 'Y', 'en'),
(211, 'Zaire', 'ZR', 'Y', 'en'),
(212, 'Zambia', 'ZM', 'Y', 'en'),
(213, 'Zimbabwe', 'ZW', 'Y', 'en'),
(215, 'Canada', NULL, 'Y', 'en'),
(801, 'Puerto Rico', 'PR', 'Y', 'ar'),
(800, 'Portugal', 'PT', 'Y', 'ar'),
(799, 'Poland', 'PL', 'Y', 'ar'),
(798, 'Pitcairn Island', 'PN', 'Y', 'ar'),
(797, 'Philippines', 'PH', 'Y', 'ar'),
(796, 'Peru', 'PE', 'Y', 'ar'),
(795, 'Paraguay', 'PY', 'Y', 'ar'),
(794, 'Papua New Guinea', 'PG', 'Y', 'ar'),
(793, 'Panama', 'PA', 'Y', 'ar'),
(792, 'Palau', 'PW', 'Y', 'ar'),
(791, 'Pakistan', 'PK', 'Y', 'ar'),
(790, 'Oman', 'OM', 'Y', 'ar'),
(789, 'Norway', 'NO', 'Y', 'ar'),
(788, 'North Korea', 'KP', 'Y', 'ar'),
(787, 'Norfolk Island', 'NF', 'Y', 'ar'),
(786, 'Niue', 'NU', 'Y', 'ar'),
(785, 'Nigeria', 'NG', 'Y', 'ar'),
(784, 'Niger', 'NE', 'Y', 'ar'),
(783, 'Nicaragua', 'NI', 'Y', 'ar'),
(782, 'New Zealand', 'NZ', 'Y', 'ar'),
(781, 'Netherlands', 'NL', 'Y', 'ar'),
(780, 'Nepal', 'NP', 'Y', 'ar'),
(779, 'Nauru', 'NR', 'Y', 'ar'),
(778, 'Namibia', 'NA', 'Y', 'ar'),
(777, 'Myanmar', 'MM', 'Y', 'ar'),
(776, 'Mozambique', 'MZ', 'Y', 'ar'),
(775, 'Morocco', 'MA', 'Y', 'ar'),
(774, 'Montserrat', 'MS', 'Y', 'ar'),
(773, 'Mongolia', 'MN', 'Y', 'ar'),
(772, 'Monaco', 'MC', 'Y', 'ar'),
(771, 'Moldavia', 'MD', 'Y', 'ar'),
(770, 'Micronesia', 'FM', 'Y', 'ar'),
(769, 'Mexico', 'MX', 'Y', 'ar'),
(768, 'Mayotte', 'YT', 'Y', 'ar'),
(767, 'Mauritius', 'MU', 'Y', 'ar'),
(766, 'Mauritania', 'MR', 'Y', 'ar'),
(765, 'Marshall Islands', 'MH', 'Y', 'ar'),
(764, 'Malta', 'MT', 'Y', 'ar'),
(763, 'Malii', 'ML', 'Y', 'ar'),
(762, 'Maldives', 'MV', 'Y', 'ar'),
(761, 'Malaysia', 'MY', 'Y', 'ar'),
(760, 'Malawi', 'MW', 'Y', 'ar'),
(759, 'Madagascar', 'MG', 'Y', 'ar'),
(758, 'Macedonia', 'MK', 'Y', 'ar'),
(757, 'Macau', 'MO', 'Y', 'ar'),
(756, 'Luxembourg', 'LU', 'Y', 'ar'),
(755, 'Lithuania', 'LT', 'Y', 'ar'),
(754, 'Liechtenstein', 'LI', 'Y', 'ar'),
(753, 'Libya', 'LY', 'Y', 'ar'),
(752, 'Liberia', 'LR', 'Y', 'ar'),
(751, 'Lesotho', 'LS', 'Y', 'ar'),
(750, 'Lebanon', 'LB', 'Y', 'ar'),
(749, 'Latvia', 'LV', 'Y', 'ar'),
(748, 'Laos', 'LA', 'Y', 'ar'),
(747, 'Kyrgyzstan', 'KG', 'Y', 'ar'),
(746, 'Kuwait', 'KW', 'Y', 'ar'),
(745, 'Kiribati', 'KI', 'Y', 'ar'),
(744, 'Kenya', 'KE', 'Y', 'ar'),
(743, 'Kazakhstan', 'KZ', 'Y', 'ar'),
(742, 'Jordan', 'JO', 'Y', 'ar'),
(741, 'Japan', 'JP', 'Y', 'ar'),
(740, 'Jamaica', 'JM', 'Y', 'ar'),
(739, 'Ivory Coast', 'CI', 'Y', 'ar'),
(738, 'Italy', 'IT', 'Y', 'ar'),
(737, 'Ireland', 'IE', 'Y', 'ar'),
(736, 'Iraq', 'IQ', 'Y', 'ar'),
(735, 'Iran', 'IR', 'Y', 'ar'),
(734, 'International', 'INT', 'Y', 'ar'),
(733, 'Indonesia', 'ID', 'Y', 'ar'),
(732, 'India', 'IN', 'Y', 'ar'),
(731, 'Iceland', 'IS', 'Y', 'ar'),
(730, 'Hungary', 'HU', 'Y', 'ar'),
(729, 'Hong Kong', 'HK', 'Y', 'ar'),
(728, 'Honduras', 'HN', 'Y', 'ar'),
(727, 'Haiti', 'HT', 'Y', 'ar'),
(726, 'Guyana', 'GY', 'Y', 'ar'),
(725, 'Guinea Bissau', 'GW', 'Y', 'ar'),
(724, 'Guinea', 'GN', 'Y', 'ar'),
(723, 'Guatemala', 'GT', 'Y', 'ar'),
(722, 'Grenada', 'GD', 'Y', 'ar'),
(721, 'Greenland', 'GL', 'Y', 'ar'),
(720, 'Greece', 'GR', 'Y', 'ar'),
(719, 'Great Britain', 'GB', 'Y', 'ar'),
(718, 'Gibraltar', 'GI', 'Y', 'ar'),
(717, 'Ghana', 'GH', 'Y', 'ar'),
(716, 'Germany', 'DE', 'Y', 'ar'),
(715, 'Georgia', 'GE', 'Y', 'ar'),
(714, 'Gambia', 'GM', 'Y', 'ar'),
(713, 'Gabon', 'GA', 'Y', 'ar'),
(712, 'France', 'FR', 'Y', 'ar'),
(711, 'Finland', 'FI', 'Y', 'ar'),
(710, 'Fiji', 'FJ', 'Y', 'ar'),
(709, 'Faroe Islands', 'FO', 'Y', 'ar'),
(708, 'Falkland Islands', 'FK', 'Y', 'ar'),
(707, 'Ethiopia', 'ET', 'Y', 'ar'),
(706, 'Estonia', 'EE', 'Y', 'ar'),
(705, 'Eritrea', 'ER', 'Y', 'ar'),
(704, 'Equatorial Guinea', 'GQ', 'Y', 'ar'),
(703, 'El Salvador', 'SV', 'Y', 'ar'),
(702, 'Egypt', 'EG', 'Y', 'ar'),
(701, 'Ecuador', 'EC', 'Y', 'ar'),
(700, 'East Timor', 'TP', 'Y', 'ar'),
(699, 'Dominica', 'DM', 'Y', 'ar'),
(698, 'Djibouti', 'DJ', 'Y', 'ar'),
(697, 'Denmark', 'DK', 'Y', 'ar'),
(696, 'Czech Republic', 'CZ', 'Y', 'ar'),
(695, 'Cyprus', 'CY', 'Y', 'ar'),
(694, 'Cuba', 'CU', 'Y', 'ar'),
(693, 'Croatia', 'HR', 'Y', 'ar'),
(692, 'Costa Rica', 'CR', 'Y', 'ar'),
(691, 'Cook Islands', 'CK', 'Y', 'ar'),
(690, 'Congo', 'CG', 'Y', 'ar'),
(689, 'Comoros', 'KM', 'Y', 'ar'),
(688, 'Commercial', 'COM', 'Y', 'ar'),
(687, 'Colombia', 'CO', 'Y', 'ar'),
(686, 'Cocos (Keeling) Islands', 'CC', 'Y', 'ar'),
(685, 'Christmas Island', 'CX', 'Y', 'ar'),
(684, 'China', 'CN', 'Y', 'ar'),
(683, 'Chile', 'CL', 'Y', 'ar'),
(682, 'Chad', 'TD', 'Y', 'ar'),
(681, 'Central African Republic', 'CF', 'Y', 'ar'),
(680, 'Cayman Islands', 'KY', 'Y', 'ar'),
(679, 'Cape Verde', 'CV', 'Y', 'ar'),
(678, 'Cameroon', 'CM', 'Y', 'ar'),
(677, 'Cambodia', 'KH', 'Y', 'ar'),
(676, 'Burundi', 'BI', 'Y', 'ar'),
(675, 'Burkina Faso', 'BF', 'Y', 'ar'),
(674, 'Bulgaria', 'BG', 'Y', 'ar'),
(673, 'Brunei Darussalam', 'BN', 'Y', 'ar'),
(672, 'Brazil', 'BR', 'Y', 'ar'),
(671, 'Bouvet Island', 'BV', 'Y', 'ar'),
(670, 'Botswana', 'BW', 'Y', 'ar'),
(669, 'Bosnia-Herzegovina', 'BA', 'Y', 'ar'),
(668, 'Bolivia', 'BO', 'Y', 'ar'),
(667, 'Bhutan', 'BT', 'Y', 'ar'),
(666, 'Bermuda', 'BM', 'Y', 'ar'),
(665, 'Benin', 'BJ', 'Y', 'ar'),
(664, 'Belize', 'BZ', 'Y', 'ar'),
(663, 'Belgium', 'BE', 'Y', 'ar'),
(662, 'Belarus', 'BY', 'Y', 'ar'),
(661, 'Barbados', 'BB', 'Y', 'ar'),
(660, 'Bangladesh', 'BD', 'Y', 'ar'),
(659, 'Bahrain', 'BH', 'Y', 'ar'),
(658, 'Bahamas', 'BS', 'Y', 'ar'),
(657, 'Azerbaidjan', 'AZ', 'Y', 'ar'),
(656, 'Austria', 'AT', 'Y', 'ar'),
(655, 'Australia', 'AU', 'Y', 'ar'),
(654, 'Aruba', 'AW', 'Y', 'ar'),
(653, 'Armenia', 'AM', 'Y', 'ar'),
(652, 'Argentina', 'AR', 'Y', 'ar'),
(651, 'Antigua and Barbuda', 'AG', 'Y', 'ar'),
(650, 'Antarctica', 'AQ', 'Y', 'ar'),
(649, 'Anguilla', 'AI', 'Y', 'ar'),
(648, 'Angola', 'AO', 'Y', 'ar'),
(647, 'Andorra', 'AD', 'Y', 'ar'),
(646, 'Algeria', 'DZ', 'Y', 'ar'),
(645, 'Albania', 'AL', 'Y', 'ar'),
(644, 'Afghanistan', 'AF', 'Y', 'ar'),
(802, 'Qatar', 'QA', 'Y', 'ar'),
(803, 'Romania', 'RO', 'Y', 'ar'),
(804, 'Russian Federation', 'RU', 'Y', 'ar'),
(805, 'Rwanda', 'RW', 'Y', 'ar'),
(806, 'Samoa', 'WS', 'Y', 'ar'),
(807, 'San Marino', 'SM', 'Y', 'ar'),
(808, 'Saudi Arabia', 'SA', 'Y', 'ar'),
(809, 'Senegal', 'SN', 'Y', 'ar'),
(810, 'Seychelles', 'SC', 'Y', 'ar'),
(811, 'Sierra Leone', 'SL', 'Y', 'ar'),
(812, 'Singapore', 'SG', 'Y', 'ar'),
(813, 'Slovak Republic', 'SK', 'Y', 'ar'),
(814, 'Slovenia', 'SI', 'Y', 'ar'),
(815, 'Solomon Islands', 'SB', 'Y', 'ar'),
(816, 'Somalia', 'SO', 'Y', 'ar'),
(817, 'South Africa', 'ZA', 'Y', 'ar'),
(818, 'South Korea', 'KR', 'Y', 'ar'),
(819, 'Spain', 'ES', 'Y', 'ar'),
(820, 'Sri Lanka', 'LK', 'Y', 'ar'),
(821, 'Sudan', 'SD', 'Y', 'ar'),
(822, 'Suriname', 'SR', 'Y', 'ar'),
(823, 'Swaziland', 'SZ', 'Y', 'ar'),
(824, 'Sweden', 'SE', 'Y', 'ar'),
(825, 'Switzerland', 'CH', 'Y', 'ar'),
(826, 'Syria', 'SY', 'Y', 'ar'),
(827, 'Tadjikistan', 'TJ', 'Y', 'ar'),
(828, 'Taiwan', 'TW', 'Y', 'ar'),
(829, 'Tanzania', 'TZ', 'Y', 'ar'),
(830, 'Thailand', 'TH', 'Y', 'ar'),
(831, 'Togo', 'TG', 'Y', 'ar'),
(832, 'Tokelau', 'TK', 'Y', 'ar'),
(833, 'Tonga', 'TO', 'Y', 'ar'),
(834, 'Trinidad and Tobago', 'TT', 'Y', 'ar'),
(835, 'Tunisia', 'TN', 'Y', 'ar'),
(836, 'Turkey', 'TR', 'Y', 'ar'),
(837, 'Turkmenistan', 'TM', 'Y', 'ar'),
(838, 'Tuvalu', 'TV', 'Y', 'ar'),
(839, 'Uganda', 'UG', 'Y', 'ar'),
(840, 'Ukraine', 'UA', 'Y', 'ar'),
(841, 'UAE', 'AE', 'Y', 'ar'),
(842, 'United Kingdom', 'UK', 'Y', 'ar'),
(843, 'United States', 'US', 'Y', 'ar'),
(844, 'Uruguay', 'UY', 'Y', 'ar'),
(845, 'Uzbekistan', 'UZ', 'Y', 'ar'),
(846, 'Vanuatu', 'VU', 'Y', 'ar'),
(847, 'Vatican City State', 'VA', 'Y', 'ar'),
(848, 'Venezuela', 'VE', 'Y', 'ar'),
(849, 'Vietnam', 'VN', 'Y', 'ar'),
(850, 'Palestine', 'PAL', 'Y', 'ar'),
(851, 'Western Sahara', 'EH', 'Y', 'ar'),
(852, 'Yemen', 'YE', 'Y', 'ar'),
(853, 'Yugoslavia', 'YU', 'Y', 'ar'),
(854, 'Zaire', 'ZR', 'Y', 'ar'),
(855, 'Zambia', 'ZM', 'Y', 'ar'),
(856, 'Zimbabwe', 'ZW', 'Y', 'ar'),
(857, 'Canada', NULL, 'Y', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `downloads`
--
CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT '0',
  `image` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `sort_order` int(11) DEFAULT '0',
  `downloads_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `downloads`
--
INSERT INTO `downloads` (`id`, `category_id`, `image`, `status`, `sort_order`, `downloads_date`) VALUES
(1, 1, 'al_otaiba.png', 'Y', 0, '2020-10-04 20:47:59'),
(2, 1, NULL, 'Y', 0, '2020-10-04 20:52:53');
-- --------------------------------------------------------
--
-- Table structure for table `downloads_desc`
--
CREATE TABLE `downloads_desc` (
  `desc_id` int(11) NOT NULL,
  `downloads_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `attachment` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `downloads_desc`
--
INSERT INTO `downloads_desc` (`desc_id`, `downloads_id`, `title`, `attachment`, `language`) VALUES
(1, 1, 'mafs brochure 1', 'logo_mafs.pdf', 'en'),
(2, 1, 'mafs brochure 1', '', 'ar'),
(3, 2, '2', 'logo_mafs1.pdf', 'en'),
(4, 2, '2', 'logo_mafs1.pdf', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `download_category`
--
CREATE TABLE `download_category` (
  `id` int(11) NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `download_category`
--
INSERT INTO `download_category` (`id`, `status`, `sort_order`) VALUES
(1, 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `download_category_desc`
--
CREATE TABLE `download_category_desc` (
  `desc_id` int(11) NOT NULL,
  `download_category_id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'en'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `download_category_desc`
--
INSERT INTO `download_category_desc` (`desc_id`, `download_category_id`, `name`, `language`) VALUES
(1, 1, 'Brochures', 'en'),
(2, 1, 'Brochures', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `enquiry_master`
--
CREATE TABLE `enquiry_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `refererurl` varchar(255) DEFAULT NULL,
  `enq_products` text,
  `enq_surname` varchar(200) DEFAULT NULL,
  `enq_name` varchar(255) DEFAULT NULL,
  `enq_email` varchar(255) NOT NULL,
  `enq_company` varchar(200) DEFAULT NULL,
  `enq_phone` varchar(50) DEFAULT NULL,
  `enq_mobile` varchar(30) DEFAULT NULL,
  `enq_country` varchar(100) DEFAULT NULL,
  `enq_city` varchar(255) DEFAULT NULL,
  `enq_subject` varchar(255) DEFAULT NULL,
  `enq_message` text,
  `enq_salutation` varchar(255) DEFAULT NULL,
  `enq_positions` varchar(255) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Dumping data for table `enquiry_master`
--
INSERT INTO `enquiry_master` (`id`, `refererurl`, `enq_products`, `enq_surname`, `enq_name`, `enq_email`, `enq_company`, `enq_phone`, `enq_mobile`, `enq_country`, `enq_city`, `enq_subject`, `enq_message`, `enq_salutation`, `enq_positions`, `is_active`, `added_on`) VALUES
(1, 'http://demo-mafs.epizy.com/cms/en/contactus', NULL, NULL, 'Yamnua V', 'mail2yamunav@gmail.com', NULL, '0501212345', NULL, NULL, NULL, 'Testing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elit dolor, blandit vel euismod ac, lentesque et dolor. Ut id tempus ipsum.', NULL, NULL, 'Y', '2020-10-06 09:00:39'),
(2, 'http://demo-mafs.epizy.com/cms/en/services/view/housekeeping', NULL, NULL, 'Yamnua V', 'mail2yamunav@gmail.com', NULL, '0501212345', NULL, NULL, NULL, 'Testing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elit dolor, blandit vel euismod ac, lentesque et dolor. Ut id tempus ipsum', NULL, NULL, 'Y', '2020-10-06 09:06:21');
-- --------------------------------------------------------
--
-- Table structure for table `events`
--
CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `widgets` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `archive` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `events_category`
--
CREATE TABLE `events_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `widgets` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `breadcrumb_status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `sort_order` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `events_category_desc`
--
CREATE TABLE `events_category_desc` (
  `desc_id` int(11) NOT NULL,
  `content_category_id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `short_desc` text COLLATE latin1_general_ci NOT NULL,
  `keywords` text COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `events_desc`
--
CREATE TABLE `events_desc` (
  `desc_id` int(11) NOT NULL,
  `contents_id` int(11) NOT NULL,
  `format_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `maplocation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `short_desc` text CHARACTER SET utf8 NOT NULL,
  `desc` text CHARACTER SET utf8 NOT NULL,
  `organisers` text COLLATE latin1_general_ci NOT NULL,
  `keywords` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `meta_desc` text COLLATE latin1_general_ci NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `end_time` datetime NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `detail_image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `banner_text` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `banner_image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `gallery`
--
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `gallery`
--
INSERT INTO `gallery` (`id`, `category_id`, `slug`, `status`, `sort_order`) VALUES
(1, 1, NULL, 'Y', 0),
(2, 1, NULL, 'Y', 0),
(3, 1, NULL, 'Y', 0),
(4, 1, NULL, 'Y', 0),
(5, 1, NULL, 'Y', 0),
(6, 1, NULL, 'Y', 0),
(7, 1, NULL, 'Y', 0),
(8, 1, NULL, 'Y', 0),
(9, 1, NULL, 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `gallery_category`
--
CREATE TABLE `gallery_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `gallery_category`
--
INSERT INTO `gallery_category` (`id`, `slug`, `status`, `sort_order`) VALUES
(1, 'oure-new-works', 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `gallery_category_desc`
--
CREATE TABLE `gallery_category_desc` (
  `desc_id` int(11) NOT NULL,
  `gallery_category_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `gallery_category_desc`
--
INSERT INTO `gallery_category_desc` (`desc_id`, `gallery_category_id`, `title`, `image`, `language`) VALUES
(1, 1, 'Oure New Works', '', 'en'),
(2, 1, 'Oure New Works', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `gallery_desc`
--
CREATE TABLE `gallery_desc` (
  `desc_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `author` int(11) DEFAULT NULL,
  `title` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `gallery_desc`
--
INSERT INTO `gallery_desc` (`desc_id`, `gallery_id`, `author`, `title`, `image`, `language`) VALUES
(1, 1, NULL, '1', '1.jpg', 'en'),
(2, 1, NULL, '1', '1.jpg', 'ar'),
(3, 2, NULL, '2', '2.jpg', 'en'),
(4, 2, NULL, '2', '2.jpg', 'ar'),
(5, 3, NULL, '3', '3.jpg', 'en'),
(6, 3, NULL, '3', '3.jpg', 'ar'),
(7, 4, NULL, '4', '4.jpg', 'en'),
(8, 4, NULL, '4', '4.jpg', 'ar'),
(9, 5, NULL, '5', '5.jpg', 'en'),
(10, 5, NULL, '5', '5.jpg', 'ar'),
(11, 6, NULL, NULL, '71.jpg', 'en'),
(12, 6, NULL, NULL, '71.jpg', 'ar'),
(13, 7, NULL, NULL, '81.jpg', 'en'),
(14, 7, NULL, NULL, '81.jpg', 'ar'),
(15, 8, NULL, NULL, '91.jpg', 'en'),
(16, 8, NULL, NULL, '91.jpg', 'ar'),
(17, 9, NULL, NULL, '101.jpg', 'en'),
(18, 9, NULL, NULL, '101.jpg', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `languages`
--
CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `class` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `code` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `languages`
--
INSERT INTO `languages` (`id`, `name`, `class`, `code`, `status`) VALUES
(1, 'English', '', 'en', 'Y'),
(2, 'Arabic', '', 'ar', 'Y');
-- --------------------------------------------------------
--
-- Table structure for table `localization`
--
CREATE TABLE `localization` (
  `id` int(11) NOT NULL,
  `lang_key` text CHARACTER SET utf8 NOT NULL,
  `lang_value` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `menuitems`
--
CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `link_type` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `link_object` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `show_subitems` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `target_type` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `icon` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `menuitems`
--
INSERT INTO `menuitems` (`id`, `menu_id`, `parent_id`, `link_type`, `link_object`, `show_subitems`, `target_type`, `sort_order`, `icon`, `status`) VALUES
(1, 1, 0, 'contents', '5', 'Y', '', 1, NULL, 'Y'),
(2, 1, 1, 'contents', '1', 'Y', '', 2, NULL, 'Y'),
(3, 1, 1, 'contents', '2', 'Y', '', 3, NULL, 'Y'),
(4, 1, 0, 'services', '1', 'Y', '', 4, NULL, 'Y'),
(5, 1, 0, 'services', '2', 'Y', '', 5, NULL, 'Y'),
(6, 1, 0, 'contents', '11', 'Y', '', 6, NULL, 'Y'),
(7, 2, 0, '', NULL, 'Y', '', 1, NULL, 'Y'),
(8, 2, 0, 'internal', '0', 'Y', '', 2, NULL, 'Y'),
(9, 2, 0, 'internal', '0', 'Y', '', 3, NULL, 'Y'),
(10, 2, 0, 'contents', '11', 'Y', '', 4, NULL, 'Y'),
(11, 2, 0, 'internal', '0', 'Y', '', 5, NULL, 'Y'),
(12, 2, 0, 'internal', '0', 'Y', '', 7, NULL, 'Y'),
(13, 2, 0, 'contents', '12', 'Y', '', 6, 'icon-news.png', 'Y'),
(14, 2, 0, 'internal', '0', 'Y', '', 8, NULL, 'Y'),
(20, 3, 0, 'contents', '17', 'N', '', 1, NULL, 'Y'),
(21, 3, 0, 'contents', '3', 'N', '', 2, NULL, 'Y'),
(22, 1, 0, 'internal', '0', 'N', '', 7, NULL, 'Y'),
(23, 1, 22, 'internal', '0', 'N', '', 1, NULL, 'Y'),
(24, 1, 22, 'internal', '0', 'N', '', 2, NULL, 'Y'),
(25, 1, 22, 'internal', '0', 'N', '', 3, NULL, 'Y'),
(26, 1, 0, 'contents', '12', 'N', '', 8, NULL, 'Y'),
(27, 1, 0, 'internal', '0', 'N', '', 9, NULL, 'Y'),
(28, 1, 0, 'internal', '0', 'N', '', 10, NULL, 'Y'),
(29, 1, 0, 'internal', '0', 'N', '', 0, NULL, 'Y');
-- --------------------------------------------------------
--
-- Table structure for table `menuitems_desc`
--
CREATE TABLE `menuitems_desc` (
  `desc_id` int(11) NOT NULL,
  `menuitems_id` int(11) NOT NULL,
  `class` varchar(300) CHARACTER SET utf8 NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `short_desc` text COLLATE latin1_general_ci,
  `link` varchar(500) CHARACTER SET utf8 NOT NULL,
  `attachment` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `menuitems_desc`
--
INSERT INTO `menuitems_desc` (`desc_id`, `menuitems_id`, `class`, `name`, `short_desc`, `link`, `attachment`, `language`) VALUES
(1, 1, '', 'About Us', '', '', '', 'en'),
(2, 1, '', 'Sectors', NULL, 'sectors', '', 'ar'),
(3, 2, '', 'MAFS', 'MAFS', '', '', 'en'),
(4, 2, '', 'Solutions & Services', NULL, '', '', 'ar'),
(5, 3, '', 'MAFS Group', 'MAFS Group', '', '', 'en'),
(6, 3, '', 'Sarralle Group', NULL, 'contents/group', '', 'ar'),
(7, 4, '', 'Hard Services ', 'Hard Services', '', '', 'en'),
(8, 4, '', 'Clients', NULL, 'clients', '', 'ar'),
(9, 5, '', 'Soft  Services', 'Soft  Services', '', '', 'en'),
(10, 5, '', 'Media Center', NULL, 'mediacenter', '', 'ar'),
(11, 6, '', 'References ', 'References', '', '', 'en'),
(12, 6, '', 'Contact us', NULL, 'contactus', '', 'ar'),
(13, 7, '', 'About Us', '', 'contents/view/about-us', '', 'en'),
(14, 7, '', 'Sectors', '', 'sectors', '', 'ar'),
(15, 8, '', 'Hard Services ', 'Hard Services', 'services/view/mep-amc', '', 'en'),
(16, 8, '', 'Solutions', 'Solutions', 'solutions', '', 'ar'),
(17, 9, '', 'Soft  Services', 'Soft  Services', 'services/view/deep-cleaning', '', 'en'),
(18, 9, '', 'Aftersales', 'Aftersales', '', '', 'ar'),
(19, 10, '', 'References', '', '', '', 'en'),
(20, 10, '', 'Sarralle Group', '', '', '', 'ar'),
(21, 11, '', 'Media Center', '', 'mediacenter', '', 'en'),
(22, 11, '', 'Media Center', '', 'mediacenter', '', 'ar'),
(23, 12, '', 'Contact us', '', 'contactus', '', 'en'),
(24, 12, '', 'Contact us', '', 'contactus', '', 'ar'),
(25, 13, '', 'Our Packages', 'Our Packages', '', '', 'en'),
(26, 13, '', 'Latest news', '', 'news', '', 'ar'),
(27, 14, '', 'Careers ', 'Careers', 'careers', '', 'en'),
(28, 14, '', 'Latest events', '', 'events', '', 'ar'),
(29, 15, '', 'Press releases', '', 'pressrelease', '', 'en'),
(30, 15, '', 'Press releases', '', 'pressrelease', '', 'ar'),
(31, 16, '', 'Media gallery', '', 'gallery', '', 'en'),
(32, 16, '', 'Media gallery', '', 'gallery', '', 'ar'),
(33, 17, '', 'Downloads', '', 'downloads', '', 'en'),
(34, 17, '', 'Newsletter', '', 'newsletter', '', 'ar'),
(35, 18, '', 'Our locations', '', 'contactus/locations', '', 'en'),
(36, 18, '', 'Our locations', '', 'contactus/locations', '', 'ar'),
(37, 19, '', 'Make an enquiry', '', 'contactus/make-enquiry', '', 'en'),
(38, 19, '', 'Make an enquiry', '', 'contactus/make-enquiry', '', 'ar'),
(39, 20, '', 'Privacy policy', '', '', '', 'en'),
(40, 20, '', 'Privacy policy', '', '', '', 'ar'),
(41, 21, '', 'Terms & Conditions', 'Terms & Conditions', '', '', 'en'),
(42, 21, '', 'Cookie policy', '', '', '', 'ar'),
(43, 22, '', 'Media Center', 'Media Center', 'news', '', 'en'),
(44, 22, '', 'Media Center', 'Media Center', 'javascript:void(0)', '', 'ar'),
(45, 23, '', 'Image Gallery', 'Image Gallery', 'gallery', '', 'en'),
(46, 23, '', 'Image Gallery', 'Image Gallery', 'gallery', '', 'ar'),
(47, 24, '', 'Video Gallery', 'Video Gallery', 'videos', '', 'en'),
(48, 24, '', 'Video Gallery', 'Video Gallery', 'videos', '', 'ar'),
(49, 25, '', 'News & Events', 'News & Events', 'news', '', 'en'),
(50, 25, '', 'News & Events', 'News & Events', 'news', '', 'ar'),
(51, 26, '', 'Our Packages', 'Our Packages', '', '', 'en'),
(52, 26, '', 'Our Packages', 'Our Packages', 'contents/view/comingsoon', '', 'ar'),
(53, 27, '', 'Contact ', 'Contact', 'contactus', '', 'en'),
(54, 27, '', 'Contact ', 'Contact', 'contact', '', 'ar'),
(55, 28, '', 'Careers ', 'Careers', 'careers', '', 'en'),
(56, 28, '', 'Careers ', 'Careers', 'careers', '', 'ar'),
(57, 29, '', 'Home', 'Home', 'home', '', 'en'),
(58, 29, '', 'Home', 'Home', 'home', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `menus`
--
CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `class` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `code` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `menus`
--
INSERT INTO `menus` (`id`, `name`, `class`, `code`, `status`) VALUES
(1, 'Main Menu', '', 'mainmenu', 'Y'),
(2, 'Footer Menu', '', 'footer', 'Y'),
(3, 'Policy Menu', '', 'policy', 'Y');
-- --------------------------------------------------------
--
-- Table structure for table `news`
--
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sectors_id` int(11) DEFAULT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `widgets` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `news`
--
INSERT INTO `news` (`id`, `category_id`, `sectors_id`, `slug`, `widgets`, `status`) VALUES
(1, 1, NULL, 'how-to-deep-clean-your-kitchen', NULL, 'Y'),
(2, 2, NULL, '10-ways-to-save-more-waste-less', NULL, 'Y'),
(3, 1, NULL, 'oure-new-works', NULL, 'Y'),
(4, 1, NULL, '10-ways-to-save-more-waste-less201005013922', NULL, 'Y');
-- --------------------------------------------------------
--
-- Table structure for table `newsletter`
--
CREATE TABLE `newsletter` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` char(100) DEFAULT NULL,
  `company` varchar(300) DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Dumping data for table `newsletter`
--
INSERT INTO `newsletter` (`id`, `fullname`, `email`, `phone`, `company`, `added_on`) VALUES
(1, 'Yamuna V', 'yamuna@webchannel.ae', '0501234567', 'Webchannel', '2017-12-12 11:43:54'),
(2, 'yamuna', 'yamuna@webchannel.ae', '01234567', 'abc', '2017-12-12 11:44:31'),
(3, 'yamuna', 'yamuna@webchannel.ae', '01234567', 'test', '2017-12-12 11:56:42'),
(4, 'yamuna', 'yamuna@webchannel.ae', '01234567', 'test', '2017-12-12 11:58:45'),
(5, 'Yamuna V', 'yamuna@webchannel.ae', '0501234567', 'Webchannel', '2017-12-12 12:00:24'),
(6, 'Yamuna V', 'yamuna@webchannel.ae', '0501234567', 'Webchannel', '2017-12-12 12:02:20'),
(7, 'Ganga', 'ganga@webchannel.ae', '', 'v', '2017-12-12 12:07:34');
-- --------------------------------------------------------
--
-- Table structure for table `news_category`
--
CREATE TABLE `news_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `breadcrumb_status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'Y',
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `news_category`
--
INSERT INTO `news_category` (`id`, `slug`, `icon`, `breadcrumb_status`, `status`, `sort_order`) VALUES
(1, 'news', NULL, NULL, 'Y', 0),
(2, 'events', NULL, NULL, 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `news_category_desc`
--
CREATE TABLE `news_category_desc` (
  `desc_id` int(11) NOT NULL,
  `content_category_id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `short_desc` text COLLATE latin1_general_ci,
  `keywords` text COLLATE latin1_general_ci,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'en'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `news_category_desc`
--
INSERT INTO `news_category_desc` (`desc_id`, `content_category_id`, `name`, `short_desc`, `keywords`, `language`) VALUES
(1, 1, 'News', NULL, NULL, 'en'),
(2, 1, 'News', NULL, NULL, 'ar'),
(3, 2, 'Events', NULL, NULL, 'en'),
(4, 2, 'Events', NULL, NULL, 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `news_desc`
--
CREATE TABLE `news_desc` (
  `desc_id` int(11) NOT NULL,
  `contents_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `short_desc` text CHARACTER SET utf8,
  `location` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `desc` text CHARACTER SET utf8,
  `keywords` text COLLATE latin1_general_ci,
  `meta_desc` text COLLATE latin1_general_ci,
  `date_time` datetime DEFAULT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `banner_text` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `news_desc`
--
INSERT INTO `news_desc` (`desc_id`, `contents_id`, `title`, `meta_title`, `short_desc`, `location`, `desc`, `keywords`, `meta_desc`, `date_time`, `image`, `banner_text`, `banner_image`, `language`) VALUES
(1, 1, 'How to deep clean your kitchen', 'How to deep clean your kitchen', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Dubai', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pulvinar urna a diam elementum, et bibendum diam ornare. Morbi gravida non ipsum in euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eleifend, ex at facilisis eleifend, est neque sodales purus, sit amet convallis nulla risus non arcu. Sed ullamcorper vitae justo&nbsp;</p>\r\n', 'How to deep clean your kitchen', 'How to deep clean your kitchen', '2020-10-04 14:33:00', '1.jpg', NULL, '', 'en'),
(2, 1, 'How to deep clean your kitchen', NULL, NULL, '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pulvinar urna a diam elementum, et bibendum diam ornare. Morbi gravida non ipsum in euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eleifend, ex at facilisis eleifend, est neque sodales purus, sit amet convallis nulla risus non arcu. Sed ullamcorper vitae justo&nbsp;</p>\r\n', NULL, NULL, '2020-10-04 14:33:22', '', NULL, '', 'ar'),
(3, 2, '10 ways to save more & waste less', '10 ways to save more & waste less', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Dubai', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pulvinar urna a diam elementum, et bibendum diam ornare. Morbi gravida non ipsum in euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eleifend, ex at facilisis eleifend, est neque sodales purus, sit amet convallis nulla risus non arcu. Sed ullamcorper vitae justo sit</p>\r\n', '10 ways to save more & waste less', '10 ways to save more & waste less', '2020-10-04 14:33:00', '2.jpg', NULL, '', 'en'),
(4, 2, '10 ways to save more & waste less', NULL, NULL, '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras pulvinar urna a diam elementum, et bibendum diam ornare. Morbi gravida non ipsum in euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eleifend, ex at facilisis eleifend, est neque sodales purus, sit amet convallis nulla risus non arcu. Sed ullamcorper vitae justo sit</p>\r\n', NULL, NULL, '2020-10-04 14:33:49', '', NULL, '', 'ar'),
(5, 3, 'Oure New Works', 'Oure New Works', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Dubai', '<p>We focus on offering the highest level of service in the industry and deliver real &lsquo;solutions with a soul&rsquo; that truly enhance the value of your investment. We are committed to keep a sight of the constantly changing needs of our customers.</p>\r\n', 'Oure New Works', 'Oure New Works', '2020-10-04 15:16:00', '3.jpg', NULL, '', 'en'),
(6, 3, 'Oure New Works', 'Oure New Works', NULL, 'Dubai', '<p>We focus on offering the highest level of service in the industry and deliver real &lsquo;solutions with a soul&rsquo; that truly enhance the value of your investment. We are committed to keep a sight of the constantly changing needs of our customers.</p>\r\n', 'Oure New Works', 'Oure New Works', '2020-10-04 15:16:58', '', NULL, '', 'ar'),
(7, 4, '10 ways to save more & waste less', '10 ways to save more & waste less', '10 ways to save more & waste less', 'Dubai', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n', '10 ways to save more & waste less', '10 ways to save more & waste less', '2020-10-01 00:00:00', '11.jpg', NULL, '', 'en'),
(8, 4, '10 ways to save more & waste less', '10 ways to save more & waste less', '10 ways to save more & waste less', 'Dubai', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n', '10 ways to save more & waste less', '10 ways to save more & waste less', '2020-10-01 00:00:00', '11.jpg', NULL, '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `pages`
--
CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `key` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `widgets` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `pages`
--
INSERT INTO `pages` (`id`, `key`, `widgets`, `status`) VALUES
(1, 'contactus', '', 'Y'),
(2, 'clients', NULL, 'Y'),
(3, 'news', NULL, 'Y'),
(4, 'sectors', NULL, 'Y'),
(5, 'events', NULL, 'Y'),
(6, 'pressrelease', NULL, 'Y'),
(7, 'downloads', NULL, 'Y'),
(8, 'gallery', NULL, 'Y'),
(9, 'services', NULL, 'Y');
-- --------------------------------------------------------
--
-- Table structure for table `pages_desc`
--
CREATE TABLE `pages_desc` (
  `desc_id` int(11) NOT NULL,
  `pages_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `short_desc` text CHARACTER SET utf8 NOT NULL,
  `desc` text CHARACTER SET utf8 NOT NULL,
  `keywords` text COLLATE latin1_general_ci NOT NULL,
  `banner_text` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `banner_image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `pages_desc`
--
INSERT INTO `pages_desc` (`desc_id`, `pages_id`, `title`, `meta_title`, `short_desc`, `desc`, `keywords`, `banner_text`, `banner_image`, `language`) VALUES
(1, 1, 'Contact Us', 'Contact Saralle', 'contactus', '<p>contactus</p>\r\n', 'contactus', '', 'spot-contact.jpg', 'en'),
(2, 1, 'Contact Us', NULL, 'contactus', '<p>contactus</p>\r\n', 'contactus', '', '', 'ar'),
(3, 2, 'Clients', 'clients', 'clients', 'We cast confident and delighted international clients', '', '', '', 'en'),
(4, 2, 'Clients', 'clients', 'clients', '', '', '', '', 'ar'),
(5, 3, 'Latest News', 'Latest News', '', '', '', '', '', 'en'),
(6, 3, 'News', 'News', '', '', '', '', '', 'ar'),
(7, 4, 'Sectors', 'Sectors', '', '', '', '', '', 'en'),
(8, 4, 'Sectors', 'Sectors', '', '', '', '', '', 'ar'),
(9, 5, 'Latest Events', 'Latest Events', 'Latest Events', 'Latest Events', '', '', '', 'en'),
(10, 5, 'Latest Events', 'Latest Events', 'Latest Events', 'Latest Events', '', '', '', 'ar'),
(11, 6, 'Press Releases', '', 'Press Releases', 'Press Releases', '', '', '', 'en'),
(12, 6, 'Press Releases', '', 'Press Releases', 'Press Releases', '', '', '', 'ar'),
(13, 7, 'Downloads', 'downloads', 'downloads', '\r\n', '', '', '', 'en'),
(14, 7, 'Downloads', 'downloads', 'downloads', 'downloads', '', '', '', 'ar'),
(15, 8, 'Gallery', 'gallery', '', '', '', '', '', 'en'),
(16, 8, 'Gallery', 'gallery', '', '', '', '', '', 'ar'),
(17, 9, 'Solutions & Services', 'Services', '', '', '', '', '', 'en'),
(18, 9, 'Services', 'Services', '', '', '', '', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `permissions`
--
CREATE TABLE `permissions` (
  `permissions_id` int(11) NOT NULL,
  `page` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `url` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `permissions`
--
INSERT INTO `permissions` (`permissions_id`, `page`, `url`) VALUES
(1, 'Dashboard', 'admin/home/settings'),
(2, 'Localizaton', 'admin/home/localization'),
(3, 'Add Localizaton', 'admin/home/addlocalization'),
(4, 'Change Password', 'admin/home/changepwd'),
(5, 'Menu List', 'admin/menus/lists'),
(6, 'Add Menu', 'admin/menus/add'),
(7, 'Edit Menu', 'admin/menus/edit'),
(8, 'Delete Menu', 'admin/menus/delete'),
(9, 'Menu Items', 'admin/menus/menuitems'),
(10, 'Add Menu Items', 'admin/menus/menuitemadd'),
(11, 'Edit Menu Items', 'admin/menus/menuitemedit'),
(12, 'Delete Menu items', 'admin/menus/menuitemdelete'),
(13, 'Content List ', 'admin/contents/lists'),
(14, 'Add Content', 'admin/contents/add'),
(15, 'Edit Content', 'admin/contents/edit'),
(16, 'Delete Content', 'admin/contents/delete'),
(17, 'Categories', 'admin/contents/categories'),
(18, 'Add Categories', 'admin/contents/addcategory'),
(19, 'Edit Categories', 'admin/contents/editcategory'),
(20, 'Delete categories', 'admin/contents/deletecategory'),
(21, 'Category Widgets', 'admin/contents/categorywidgets'),
(22, 'Faq List', 'admin/faqs/lists'),
(23, 'Add Faq', 'admin/faqs/add'),
(24, 'Edit Faq', 'admin/faqs/edit'),
(25, 'Delete faq', 'admin/faqs/delete'),
(26, 'Faq Categories', 'admin/faqs/categories'),
(27, 'Add Faq Categories', 'admin/faqs/addcategory'),
(28, 'Edit Faq Categories', 'admin/faqs/editcategory'),
(29, 'Delete Faq Cateories', 'admin/faqs/deletecategory'),
(30, 'Banner List', 'admin/banners/lists'),
(31, 'Add Banners', 'admin/banners/add'),
(32, 'Edit Banners', 'admin/banners/edit'),
(33, 'Delete Banners', 'admin/banners/delete'),
(34, 'Widget List', 'admin/widgets/lists'),
(35, 'Add Widget', 'admin/widgets/add'),
(36, 'Edit Widget', 'admin/widgets/edit'),
(37, 'List  Page Metas', 'admin/pages/lists'),
(38, 'Add  Page Metas', 'admin/pages/add'),
(39, 'Eidt  Page Metas', 'admin/pages/edit'),
(40, ' Page Meta Widgets', 'admin/pages/pagewidgets'),
(41, 'Jobs List', 'admin/careers/jobs'),
(42, 'Edit Jobs', 'admin/careers/edit'),
(43, 'Add Jobs', 'admin/careers/add'),
(44, 'Delete Jobs', 'admin/careers/delete'),
(45, 'Job Widgets', 'admin/careers/jobwidgets'),
(46, 'Job Applications', 'admin/careers/applications'),
(47, 'View Job Applications', 'admin/careers/viewapplication'),
(48, 'Delete Job Applications', 'admin/careers/deleteapplication'),
(49, 'View Resume', 'admin/careers/downloadresume'),
(50, 'Downloads List', 'admin/downloads/lists'),
(51, 'Add Downloads', 'admin/downloads/add'),
(52, 'Edit Downloads', 'admin/downloads/edit'),
(53, 'Delete Downloads', 'admin/downloads/delete'),
(54, 'Download Category List', 'admin/downloads/categories'),
(55, 'Add Download Category', 'admin/downloads/addcategory'),
(56, 'Edit Download Category', 'admin/downloads/editcategory'),
(57, 'Delete Download Category', 'admin/downloads/deletecategory'),
(58, 'Contacts List', 'admin/contacts/lists'),
(59, 'Add Contacts', 'admin/contacts/add'),
(60, 'Edit Contacts', 'admin/contacts/edit'),
(61, 'Delete Contats', 'admin/contacts/delete'),
(62, 'Contact Category List', 'admin/contacts/categories'),
(63, 'Add Contacts category', 'admin/contacts/addcategory'),
(64, 'Edit Contacts category', 'admin/contacts/editcategory'),
(65, 'Delete Contacts Category', 'admin/contacts/deletecategory'),
(66, 'Language List', 'admin/languages/lists'),
(67, 'Add Language', 'admin/languages/add'),
(68, 'Edit Language', 'admin/languages/edit'),
(69, 'Users List', 'admin/users/lists'),
(70, 'Add User', 'admin/users/add'),
(71, 'Edit User', 'admin/users/edit'),
(72, 'Delete User', 'admin/users/delete'),
(73, 'Permission', 'admin/users/permission'),
(74, 'Roles', 'admin/users/roles'),
(75, 'Menu Actions', 'admin/menus/actions'),
(76, 'Menu Item Actions', 'admin/menus/menuitemactions'),
(77, 'Contents Actions', 'admin/contents/actions'),
(78, 'Content Category Actons', 'admin/contents/categoryactions'),
(79, 'Faq Actions', 'admin/faqs/actions'),
(80, 'Faq Category Actions', 'admin/faqs/categoryactions'),
(81, 'Banner Action', 'admin/banners/actions'),
(82, 'Widget Action', 'admin/widgets/actions'),
(83, 'Page Meta Action', 'admin/pages/actions'),
(84, 'Job Action', 'admin/careers/action'),
(85, 'Job Application Action', 'admin/careers/applicationactions'),
(86, 'Download Action', 'admin/downloads/actions'),
(87, 'Download Category Action', 'admin/downloads/categoryactions'),
(88, 'Contacts Action', 'admin/contacts/action'),
(89, 'Contacts Category Action', 'admin/contacts/categoryactions'),
(90, 'Language Action', 'admin/languages/actions'),
(91, 'User Change Password', 'admin/users/changepwd'),
(92, 'Products List', 'admin/products/lists'),
(93, 'Add Product', 'admin/products/add'),
(94, 'Product Category', 'admin/products/categories'),
(95, 'Add Product Category', 'admin/products/addcategory'),
(96, 'Contact list', 'admin/contacts/lists'),
(97, 'Add Contact', 'admin/contacts/add'),
(98, 'Contact Category', 'admin/contacts/categories'),
(99, 'Add Contact Category', 'admin/contacts/addcategory'),
(100, 'Add Gallery', 'admin/gallery/add'),
(101, 'Gallery', 'admin/gallery/lists'),
(102, 'Gallery Category', 'admin/gallery/categories'),
(103, 'Add Gallery Category', 'admin/gallery/addcategory'),
(104, 'Supplier Lists', 'admin/format/lists'),
(105, 'Add Supplier', 'admin/format/add'),
(106, 'Make List', 'admin/makes/lists'),
(107, 'Add Make', 'admin/makes/add'),
(108, 'News List', 'admin/news/lists'),
(109, 'Add News', 'admin/news/add'),
(110, 'News Category', 'admin/news/categories'),
(111, 'Add News Category', 'admin/news/addcategory'),
(112, 'Model List', 'admin/model/lists'),
(113, 'Add Model', 'admin/model/add'),
(114, 'Supplier List', 'admin/types/lists'),
(115, 'Add Supplier', 'admin/types/add'),
(116, 'Enquiry List', 'admin/enquiry/lists'),
(117, 'Newsletter List', 'admin/newsletter/lists');
-- --------------------------------------------------------
--
-- Table structure for table `roles`
--
CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `role` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `roles`
--
INSERT INTO `roles` (`roles_id`, `role`, `status`) VALUES
(1, 'Super Admin', 'Y'),
(2, 'Admin', 'Y');
-- --------------------------------------------------------
--
-- Table structure for table `role_access`
--
CREATE TABLE `role_access` (
  `roles_id` int(11) NOT NULL DEFAULT '0',
  `permissions_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `role_access`
--
INSERT INTO `role_access` (`roles_id`, `permissions_id`) VALUES
(1, 91),
(1, 90),
(1, 89),
(1, 88),
(1, 87),
(1, 86),
(1, 85),
(1, 84),
(1, 83),
(1, 82),
(1, 81),
(1, 80),
(1, 79),
(1, 78),
(1, 77),
(1, 76),
(1, 75),
(1, 74),
(1, 73),
(1, 72),
(1, 71),
(1, 70),
(1, 69),
(1, 68),
(1, 67),
(1, 66),
(1, 65),
(1, 64),
(1, 63),
(1, 62),
(1, 61),
(1, 60),
(1, 59),
(1, 58),
(1, 57),
(1, 56),
(1, 55),
(1, 54),
(1, 53),
(1, 52),
(1, 51),
(1, 50),
(1, 49),
(1, 48),
(1, 47),
(1, 46),
(1, 45),
(1, 44),
(1, 43),
(1, 42),
(1, 41),
(1, 40),
(1, 39),
(1, 38),
(1, 37),
(1, 36),
(1, 35),
(1, 34),
(1, 33),
(1, 32),
(1, 31),
(1, 30),
(1, 29),
(1, 28),
(1, 27),
(1, 26),
(1, 25),
(1, 24),
(1, 23),
(1, 22),
(1, 21),
(1, 20),
(1, 19),
(1, 18),
(3, 85),
(3, 84),
(3, 49),
(3, 48),
(3, 47),
(3, 46),
(3, 45),
(3, 44),
(3, 43),
(3, 42),
(3, 41),
(3, 4),
(2, 4),
(1, 17),
(1, 16),
(1, 15),
(1, 14),
(1, 13),
(1, 12),
(1, 11),
(1, 10),
(1, 9),
(1, 8),
(1, 7),
(1, 6),
(1, 5),
(1, 4),
(1, 3),
(1, 2),
(1, 1);
-- --------------------------------------------------------
--
-- Table structure for table `services`
--
CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `category_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `price` float DEFAULT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `featured` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `services`
--
INSERT INTO `services` (`id`, `category_id`, `price`, `slug`, `status`, `featured`, `sort_order`) VALUES
(1, '1', 33320, 'mep-amc', 'Y', 'Y', 0),
(2, '1', 550, 'general-maintenance', 'Y', 'Y', 0),
(3, '1', 3320, 'renovations', 'Y', 'Y', 0),
(4, '1', 3320, 'water-proofing', 'Y', 'Y', 0),
(5, '2', 0, 'deep-cleaning', 'Y', 'Y', 0),
(6, '2', 1250, 'carpet-cleaning', 'Y', 'Y', 0),
(7, '1', 0, 'epoxy', 'Y', 'N', 0),
(8, '1', 0, 'painting-works', 'Y', 'N', 0),
(9, '1', 0, 'civil-works', 'Y', 'N', 0),
(10, '1', 0, 'gypsum-works', 'Y', 'N', 0),
(11, '2', 0, 'disinfection-and-sanitation', 'Y', 'N', 0),
(12, '2', 0, 'housekeeping', 'Y', 'N', 0),
(13, '2', 0, 'waste-removal', 'Y', 'N', 0),
(14, '2', 0, 'office-boy-commercial', 'Y', 'N', 0),
(15, '2', 0, 'cleaners-commercial-and-residential', 'Y', 'N', 0);
-- --------------------------------------------------------
--
-- Table structure for table `services_category`
--
CREATE TABLE `services_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `breadcrumb_status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `featured` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `services_category`
--
INSERT INTO `services_category` (`id`, `parent_id`, `slug`, `breadcrumb_status`, `status`, `featured`) VALUES
(1, 0, 'hard-services', 'Y', 'Y', 'N'),
(2, 0, 'soft-services', 'Y', 'Y', 'N');
-- --------------------------------------------------------
--
-- Table structure for table `services_category_desc`
--
CREATE TABLE `services_category_desc` (
  `desc_id` int(11) NOT NULL,
  `content_category_id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 NOT NULL,
  `desc` text COLLATE latin1_general_ci NOT NULL,
  `image` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `pdf` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `short_desc` text COLLATE latin1_general_ci NOT NULL,
  `keywords` text COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `services_category_desc`
--
INSERT INTO `services_category_desc` (`desc_id`, `content_category_id`, `name`, `desc`, `image`, `pdf`, `short_desc`, `keywords`, `language`) VALUES
(1, 1, 'Hard Services ', '<p>Hard Services&nbsp;</p>\r\n', '', NULL, 'Hard Services ', '', 'en'),
(2, 1, 'Hard Services ', '<p>Hard Services&nbsp;</p>\r\n', '', NULL, 'Hard Services ', '', 'ar'),
(3, 2, 'Soft Services ', '<p>Soft Services&nbsp;</p>\r\n', '', NULL, 'Soft Services ', '', 'en'),
(4, 2, 'Soft Services ', '<p>Soft Services&nbsp;</p>\r\n', '', NULL, 'Soft Services ', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `services_desc`
--
CREATE TABLE `services_desc` (
  `desc_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `short_desc` text,
  `desc` text,
  `keywords` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `meta_desc` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `meta_title` varchar(300) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pdf` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `banner_text` varchar(300) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `banner_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'en'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- Dumping data for table `services_desc`
--
INSERT INTO `services_desc` (`desc_id`, `services_id`, `title`, `short_desc`, `desc`, `keywords`, `meta_desc`, `meta_title`, `image`, `icon`, `pdf`, `banner_text`, `banner_image`, `language`) VALUES
(1, 1, 'MEP-AMC', 'MEP-AMC', '<p>The engineers at MAFS work across UAE to provide its customers, flexible MEP maintenance services to help maintain the investment that they&rsquo;ve made.</p>\r\n\r\n<p>MEP maintenance has more to it than just looking after and managing your building systems. Our bunch of multi-talented engineers cater to full range of mechanical construction services from elevators to HAVC ducting including design, manufacture, installation and maintenance. Our team of electrical and automation service individuals are armed with skills and expertise who can undertake your full scope of electrical works from CAD design, installation and maintenance of a project. Services we provide include complete hydraulics, plumbing and drainage solutions for a range of businesses and construction types, within the Residential, Commercial and Industrial sectors as per the property requirements.</p>\r\n\r\n<p>Our comprehensive MEP (mechanical, electrical and plumbing) maintenance capabilities are designed to give your assets uninterrupted and maximum performance through a schedule of planned preventative maintenance (PPM), routing breakdown callouts and emergency response services. We plan our maintenance programmers completely around managing your assets in the most efficient way. This includes assessing their effectiveness over time and making recommendations for replacement where applicable.</p>\r\n\r\n<p>At every stage we apply the most stringent QHSE (quality, health, safety and environmental) controls in line with our international accreditations. Our on-site QHSE team regularly audits our site operations and remains vigilant to anything that may in any way compromise safety or affect the quality of our service delivery.</p>\r\n\r\n<p>All our MEP and QHSE operations are managed through our computer-aided facilities management system, through which we can fully monitor our performance against the project-specific key performance indicators agreed with the client. The system also provides clients with complete transparency on our performance deliverables through a &lsquo;dashboard&rsquo; system which shows a complete status report on all aspects of our operations 24/7.</p>\r\n\r\n<p>Our highly skilled team know everything about your mechanical, electrical and plumbing maintenance needs and compliance, so that you can relax in the knowledge that you are in safe hands.</p>\r\n', 'MEP-AMC', 'MEP-AMC', 'MEP-AMC', 'mep-1-480x4801.jpg', NULL, NULL, '', NULL, 'en'),
(2, 1, 'MEP-AMC', 'MEP-AMC', '<p>The engineers at MAFS work across UAE to provide its customers, flexible MEP maintenance services to help maintain the investment that they&rsquo;ve made.</p>\r\n\r\n<p>MEP maintenance has more to it than just looking after and managing your building systems. Our bunch of multi-talented engineers cater to full range of mechanical construction services from elevators to HAVC ducting including design, manufacture, installation and maintenance. Our team of electrical and automation service individuals are armed with skills and expertise who can undertake your full scope of electrical works from CAD design, installation and maintenance of a project. Services we provide include complete hydraulics, plumbing and drainage solutions for a range of businesses and construction types, within the Residential, Commercial and Industrial sectors as per the property requirements.</p>\r\n\r\n<p>Our comprehensive MEP (mechanical, electrical and plumbing) maintenance capabilities are designed to give your assets uninterrupted and maximum performance through a schedule of planned preventative maintenance (PPM), routing breakdown callouts and emergency response services. We plan our maintenance programmers completely around managing your assets in the most efficient way. This includes assessing their effectiveness over time and making recommendations for replacement where applicable.</p>\r\n\r\n<p>At every stage we apply the most stringent QHSE (quality, health, safety and environmental) controls in line with our international accreditations. Our on-site QHSE team regularly audits our site operations and remains vigilant to anything that may in any way compromise safety or affect the quality of our service delivery.</p>\r\n\r\n<p>All our MEP and QHSE operations are managed through our computer-aided facilities management system, through which we can fully monitor our performance against the project-specific key performance indicators agreed with the client. The system also provides clients with complete transparency on our performance deliverables through a &lsquo;dashboard&rsquo; system which shows a complete status report on all aspects of our operations 24/7.</p>\r\n\r\n<p>Our highly skilled team know everything about your mechanical, electrical and plumbing maintenance needs and compliance, so that you can relax in the knowledge that you are in safe hands.</p>\r\n', 'MEP-AMC', 'MEP-AMC', 'MEP-AMC', NULL, NULL, NULL, '', NULL, 'ar'),
(3, 2, 'General Maintenance', 'General Maintenance', '<p>Our services are tailored to fit your needs. We have the flexibility to provide premium services, which we achieve by delivering a memorable customer experience. We conduct full inspection of all common areas, rectify any issues that need to be dealt with immediately and then design a project-specific preventative maintenance program at designated time intervals. Our civil scope includes interior and exterior, masonry, fit-outs, snagging and refurbishment. Building fabric elements include walls, floors, ceilings, roofs, and doors, ironmongeries, finishing or water-proofing. Within our initial and ongoing evaluations, we prepare a full report of the general condition of the structure and building fabric, noting the critical points of deterioration or concern.</p>\r\n\r\n<p>Whatever your preference we can work with you to build the right service to exceed your expectations. We focus on delivering all types of maintenance with quick solutions.</p>\r\n', 'General Maintenance', 'General Maintenance', 'General Maintenance', 'renovation-480x480.jpg', NULL, NULL, '', NULL, 'en'),
(4, 2, 'General Maintenance', 'General Maintenance', '<p>Our services are tailored to fit your needs. We have the flexibility to provide premium services, which we achieve by delivering a memorable customer experience. We conduct full inspection of all common areas, rectify any issues that need to be dealt with immediately and then design a project-specific preventative maintenance program at designated time intervals. Our civil scope includes interior and exterior, masonry, fit-outs, snagging and refurbishment. Building fabric elements include walls, floors, ceilings, roofs, and doors, ironmongeries, finishing or water-proofing. Within our initial and ongoing evaluations, we prepare a full report of the general condition of the structure and building fabric, noting the critical points of deterioration or concern.</p>\r\n\r\n<p>Whatever your preference we can work with you to build the right service to exceed your expectations. We focus on delivering all types of maintenance with quick solutions.</p>\r\n', 'General Maintenance', 'General Maintenance', 'General Maintenance', NULL, NULL, NULL, '', NULL, 'ar'),
(5, 3, 'Renovations', 'Renovations', '<p>The main objective of the company is to offer &lsquo;turn-key&rsquo; remodelling services to commercial (Offices) and residential (Flats and Houses) owners in the territory of Dubai. Our Team of professionals with great experience in the construction arena takes adequate care to ensure it&rsquo;s new from now. Whether you decide on a total renovation, bundles or standalone renovation services, we design a service which is visibly different, enhancing your business processes and productivity.</p>\r\n', 'Renovations', 'Renovations', 'Renovations', 'water_proofing-480x480.jpg', NULL, NULL, '', NULL, 'en'),
(6, 3, 'Renovations', 'Renovations', '<p>The main objective of the company is to offer &lsquo;turn-key&rsquo; remodelling services to commercial (Offices) and residential (Flats and Houses) owners in the territory of Dubai. Our Team of professionals with great experience in the construction arena takes adequate care to ensure it&rsquo;s new from now. Whether you decide on a total renovation, bundles or standalone renovation services, we design a service which is visibly different, enhancing your business processes and productivity.</p>\r\n', 'Renovations', 'Renovations', 'Renovations', NULL, NULL, NULL, '', NULL, 'ar'),
(7, 4, 'Water Proofing', 'Water Proofing', '<p>The experts at MAFS provide complete turnkey above and below ground protection solutions for all areas of residential, commercial and industrial. The objective of Waterproofing is to resist the ingress of water under specified conditions possibly under pressure, humidity, water vapour or dampness. Waterproofing is done to building structures; Substructure (Basement, Foundations etc.), Wet Areas (Bathrooms, Kitchens, Garbage rooms etc.) Roofing (Open terraces, balconies etc.). Waterproofing system used in wet areas and non-exposed situations subject to constantly wet Environments are to be waterproofed with compatible materials.<br />\r\nThe generally used waterproofing materials at MAFS include bituminous membrane, Liquid applied waterproofing systems such as Rubberized Bitumen, Poly Urethane Coatings, Cementitious products etc. Our specialized team aims at providing specialized waterproofing solutions, with innovative methodologies like Roofs Waterproofing Polyurethane Spray Foam System, APP/SBS Bitumastic Membranes, Capillary Crystalline Waterproofing, Polyurethane Membranes, Epoxy/Polyurethane resins, Elastomeric Coating, Anti-Fungal/ Anti-Corrosion Coatings and Green Buildings Systems etc&hellip;<br />\r\nApart from this MAFS also specializes in waterproofing the roofs of buildings, villas, warehouses etc. These ought to be waterproofed to give resistance against rain, air and vapour intrusion or leakages from such conditions to protect the structural Integrity of the buildings and at the same time be vapour resistant. With a specialist team we provide many types of waterproof membrane systems are available, including asphalt other bituminous waterproofing, liquid roofing, and more which gives protection to your expensive finishes and furnishings beneath.</p>\r\n', 'Water Proofing', 'Water Proofing', 'Water Proofing', 'general_meintenance-480x480.jpg', NULL, NULL, '', NULL, 'en'),
(8, 4, 'Water Proofing', 'Water Proofing', '<p>The experts at MAFS provide complete turnkey above and below ground protection solutions for all areas of residential, commercial and industrial. The objective of Waterproofing is to resist the ingress of water under specified conditions possibly under pressure, humidity, water vapour or dampness. Waterproofing is done to building structures; Substructure (Basement, Foundations etc.), Wet Areas (Bathrooms, Kitchens, Garbage rooms etc.) Roofing (Open terraces, balconies etc.). Waterproofing system used in wet areas and non-exposed situations subject to constantly wet Environments are to be waterproofed with compatible materials.<br />\r\nThe generally used waterproofing materials at MAFS include bituminous membrane, Liquid applied waterproofing systems such as Rubberized Bitumen, Poly Urethane Coatings, Cementitious products etc. Our specialized team aims at providing specialized waterproofing solutions, with innovative methodologies like Roofs Waterproofing Polyurethane Spray Foam System, APP/SBS Bitumastic Membranes, Capillary Crystalline Waterproofing, Polyurethane Membranes, Epoxy/Polyurethane resins, Elastomeric Coating, Anti-Fungal/ Anti-Corrosion Coatings and Green Buildings Systems etc&hellip;<br />\r\nApart from this MAFS also specializes in waterproofing the roofs of buildings, villas, warehouses etc. These ought to be waterproofed to give resistance against rain, air and vapour intrusion or leakages from such conditions to protect the structural Integrity of the buildings and at the same time be vapour resistant. With a specialist team we provide many types of waterproof membrane systems are available, including asphalt other bituminous waterproofing, liquid roofing, and more which gives protection to your expensive finishes and furnishings beneath.</p>\r\n', 'Water Proofing', 'Water Proofing', 'Water Proofing', NULL, NULL, NULL, '', NULL, 'ar'),
(9, 5, 'Deep Cleaning', 'Deep Cleaning', '<p>Our services are tailored to fit your needs. We have the flexibility to provide premium services, which we achieve by delivering a memorable customer experience. We conduct full inspection of all common areas, rectify any issues that need to be dealt with immediately and then design a project-specific preventative maintenance program at designated time intervals. Our civil scope includes interior and exterior, masonry, fit-outs, snagging and refurbishment. Building fabric elements include walls, floors, ceilings, roofs, and doors, ironmongeries, finishing or water-proofing. Within our initial and ongoing evaluations, we prepare a full report of the general condition of the structure and building fabric, noting the critical points of deterioration or concern.</p>\r\n', 'Deep Cleaning', 'Deep Cleaning', 'Deep Cleaning', 'general_meintenance-480x4801.jpg', NULL, NULL, '', NULL, 'en'),
(10, 5, 'Deep Cleaning', 'Deep Cleaning', '<p>Our services are tailored to fit your needs. We have the flexibility to provide premium services, which we achieve by delivering a memorable customer experience. We conduct full inspection of all common areas, rectify any issues that need to be dealt with immediately and then design a project-specific preventative maintenance program at designated time intervals. Our civil scope includes interior and exterior, masonry, fit-outs, snagging and refurbishment. Building fabric elements include walls, floors, ceilings, roofs, and doors, ironmongeries, finishing or water-proofing. Within our initial and ongoing evaluations, we prepare a full report of the general condition of the structure and building fabric, noting the critical points of deterioration or concern.</p>\r\n', 'Deep Cleaning', 'Deep Cleaning', 'Deep Cleaning', NULL, NULL, NULL, '', NULL, 'ar'),
(11, 6, 'Carpet cleaning', 'Carpet cleaning', '<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n', 'Carpet cleaning', 'Carpet cleaning', 'Carpet cleaning', 'water_proofing-480x4801.jpg', NULL, NULL, '', 'renovation-480x4801.jpg', 'en'),
(12, 6, 'Carpet cleaning', 'Carpet cleaning', '<p>Carpet cleaning</p>\r\n', 'Carpet cleaning', 'Carpet cleaning', 'Carpet cleaning', NULL, NULL, NULL, '', NULL, 'ar'),
(13, 7, 'Epoxy', 'Epoxy', '<p>Epoxy flooring and epoxy coating, polyurethane flooring / coating are used to on floor and wall surface. It gives higher abrasion resistant to surface. It is very easy to clean and wash.</p>\r\n\r\n<p>Out team of factory trained technicians cater to all your epoxy flooring requirements with quality, precision, and timely completions, no matter what the size or scope of your project.</p>\r\n\r\n<p>We offer long lasting anti corrosive coating, concrete epoxy flooring, industrial epoxy flooring and epoxy floor coating on floors and wall surface. We have expertise and experience of installing epoxy floors on most challenging substrates across UAE.</p>\r\n', 'Epoxy', 'Epoxy', 'Epoxy', NULL, NULL, NULL, '', NULL, 'en'),
(14, 7, 'Epoxy', 'Epoxy', '<p>Epoxy flooring and epoxy coating, polyurethane flooring / coating are used to on floor and wall surface. It gives higher abrasion resistant to surface. It is very easy to clean and wash.</p>\r\n\r\n<p>Out team of factory trained technicians cater to all your epoxy flooring requirements with quality, precision, and timely completions, no matter what the size or scope of your project.</p>\r\n\r\n<p>We offer long lasting anti corrosive coating, concrete epoxy flooring, industrial epoxy flooring and epoxy floor coating on floors and wall surface. We have expertise and experience of installing epoxy floors on most challenging substrates across UAE.</p>\r\n', 'Epoxy', 'Epoxy', 'Epoxy', NULL, NULL, NULL, '', NULL, 'ar'),
(15, 8, 'Painting Works', 'Painting Works', '<p>Jazz up your walls in every room of your home, office and studio and make them look stunningly beautiful. With extensive experience, our skilled painters and decorators offer full range of painting services.</p>\r\n\r\n<p>Starting from consultations and projects, we deal with wallpaper removal, professional preparation of the surface to be painted, emulsion paining, enamel, spray painting, gloss or eggshell painting, Wooden door, cabinets, cupboard, window frames, AC wends/grill etc. When you agree to have your project carried out by MAFS, you can expect the following:</p>\r\n\r\n<ul>\r\n	<li>A personalized and detailed proposal that clearly outlines our painting services.</li>\r\n	<li>Even small details are attended to.</li>\r\n	<li>Professionals who carry out a customer centric approach towards the services being offered.</li>\r\n	<li>Painting schedules that are convenient as per your schedules.</li>\r\n	<li>Professionals that are safety trained and background checked.</li>\r\n	<li>Minimal disruptions to your household while painting and decorating.</li>\r\n	<li>A safe and clean work area while the project is ongoing.</li>\r\n</ul>\r\n\r\n<p><em>Decorative Painting:&nbsp;</em>We also offer elegance, style and a splash of creativity. The ambition to create textures and decorative effects with the power to transform walls into works of art.</p>\r\n\r\n<p>These values have enabled to establish our service as one of the top companies worldwide, in the paint manufacturing industry, in both wood and decorative paints.</p>\r\n', 'Painting Works', 'Painting Works', 'Painting Works', NULL, NULL, NULL, '', NULL, 'en'),
(16, 8, 'Painting Works', 'Painting Works', '<p>Jazz up your walls in every room of your home, office and studio and make them look stunningly beautiful. With extensive experience, our skilled painters and decorators offer full range of painting services.</p>\r\n\r\n<p>Starting from consultations and projects, we deal with wallpaper removal, professional preparation of the surface to be painted, emulsion paining, enamel, spray painting, gloss or eggshell painting, Wooden door, cabinets, cupboard, window frames, AC wends/grill etc. When you agree to have your project carried out by MAFS, you can expect the following:</p>\r\n\r\n<ul>\r\n	<li>A personalized and detailed proposal that clearly outlines our painting services.</li>\r\n	<li>Even small details are attended to.</li>\r\n	<li>Professionals who carry out a customer centric approach towards the services being offered.</li>\r\n	<li>Painting schedules that are convenient as per your schedules.</li>\r\n	<li>Professionals that are safety trained and background checked.</li>\r\n	<li>Minimal disruptions to your household while painting and decorating.</li>\r\n	<li>A safe and clean work area while the project is ongoing.</li>\r\n</ul>\r\n\r\n<p><em>Decorative Painting:&nbsp;</em>We also offer elegance, style and a splash of creativity. The ambition to create textures and decorative effects with the power to transform walls into works of art.</p>\r\n\r\n<p>These values have enabled to establish our service as one of the top companies worldwide, in the paint manufacturing industry, in both wood and decorative paints.</p>\r\n', 'Painting Works', 'Painting Works', 'Painting Works', NULL, NULL, NULL, '', NULL, 'ar'),
(17, 9, 'Civil Works', 'Civil Works', '<p>Our dedicated maintenance team can restore and improve every part of a building, its services to a currently acceptable standard and to sustain the utility and value of the facility.</p>\r\n\r\n<p>MAFS provides professional advice on and technical support to all kinds of engineering and site surveys. The Division undertakes survey planning and design; prepares survey specifications and method statements; evaluates survey methods and products and manages survey contracts.</p>\r\n', 'Civil Works', 'Civil Works', 'Civil Works', NULL, NULL, NULL, '', NULL, 'en'),
(19, 10, 'Gypsum Works', 'Gypsum Works', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Gypsum Works', 'Gypsum Works', 'Gypsum Works', NULL, NULL, NULL, '', NULL, 'en'),
(18, 9, 'Painting Works', 'Painting Works', '<p>Jazz up your walls in every room of your home, office and studio and make them look stunningly beautiful. With extensive experience, our skilled painters and decorators offer full range of painting services.</p>\r\n\r\n<p>Starting from consultations and projects, we deal with wallpaper removal, professional preparation of the surface to be painted, emulsion paining, enamel, spray painting, gloss or eggshell painting, Wooden door, cabinets, cupboard, window frames, AC wends/grill etc. When you agree to have your project carried out by MAFS, you can expect the following:</p>\r\n\r\n<ul>\r\n	<li>A personalized and detailed proposal that clearly outlines our painting services.</li>\r\n	<li>Even small details are attended to.</li>\r\n	<li>Professionals who carry out a customer centric approach towards the services being offered.</li>\r\n	<li>Painting schedules that are convenient as per your schedules.</li>\r\n	<li>Professionals that are safety trained and background checked.</li>\r\n	<li>Minimal disruptions to your household while painting and decorating.</li>\r\n	<li>A safe and clean work area while the project is ongoing.</li>\r\n</ul>\r\n\r\n<p><em>Decorative Painting:&nbsp;</em>We also offer elegance, style and a splash of creativity. The ambition to create textures and decorative effects with the power to transform walls into works of art.</p>\r\n\r\n<p>These values have enabled to establish our service as one of the top companies worldwide, in the paint manufacturing industry, in both wood and decorative paints.</p>\r\n', 'Painting Works', 'Painting Works', 'Painting Works', NULL, NULL, NULL, '', NULL, 'ar'),
(20, 10, 'Gypsum Works', 'Gypsum Works', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Gypsum Works', 'Gypsum Works', 'Gypsum Works', NULL, NULL, NULL, '', NULL, 'ar'),
(21, 11, 'Disinfection and sanitation', 'Disinfection and sanitation', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', '', 'Disinfection and sanitation', 'Disinfection and sanitation', NULL, NULL, NULL, '', NULL, 'en'),
(22, 11, 'Disinfection and sanitation', 'Disinfection and sanitation', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', '', 'Disinfection and sanitation', 'Disinfection and sanitation', NULL, NULL, NULL, '', NULL, 'ar'),
(23, 12, 'Housekeeping', 'Housekeeping', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', '', 'Housekeeping', 'Housekeeping', NULL, NULL, NULL, '', NULL, 'en'),
(24, 12, 'Housekeeping', 'Housekeeping', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', '', 'Housekeeping', 'Housekeeping', NULL, NULL, NULL, '', NULL, 'ar'),
(25, 13, 'Waste removal', 'Waste removal', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Waste removal', 'Waste removal', 'Waste removal', NULL, NULL, NULL, '', NULL, 'en'),
(26, 13, 'Waste removal', 'Waste removal', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Waste removal', 'Waste removal', 'Waste removal', NULL, NULL, NULL, '', NULL, 'ar'),
(27, 14, 'Office boy - Commercial', 'Office boy-commercial', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Office boy-commercial', 'Office boy-commercial', 'Office boy-commercial', NULL, NULL, NULL, '', NULL, 'en'),
(28, 14, 'Office boy - Commercial', 'Office boy-commercial', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Office boy-commercial', 'Office boy-commercial', 'Office boy-commercial', NULL, NULL, NULL, '', NULL, 'ar'),
(29, 15, 'Cleaners - Commercial and Residential', 'Cleaners- commercial and residential\r\n', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Cleaners- commercial and residential', 'Cleaners- commercial and residential', 'Cleaners- commercial and residential', NULL, NULL, NULL, '', NULL, 'en'),
(30, 15, 'Cleaners - Commercial and Residential', 'Cleaners- commercial and residential\r\n', '<p>MAFS envisions to deliver the best gypsum works service a client can possible avail across UAE. Our gypsum masterpieces are utterly unique and successful in the gypsum market. Our services are customized, designed and well-crafted products of gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. The details of the gypsum are client-oriented as well as cost effective, of course, noting the quality. We make it a point to always grow as a company and improve our services to excellence especially when it comes to services for gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works.</p>\r\n\r\n<p>We make sure that every piece is intricately designed and made. Our gypsum decorations are created and made delicately by the team of experts. These gypsum works are conceived according to the most recent demands of gypsum in the market as well as based on the desires and wishes of the clients. In addition to this, only experts are doing all the gypsum, gypsum board, gypsum decoration, false ceiling and gypsum works. we are guaranteeing to provide with the best service they could possibly avail now in gypsum works.</p>\r\n\r\n<p>Such type pf services and assistance make us one of the top gypsum works companies across UAE. To emphasize more, we value client satisfaction in whatever way necessary, making it a highlight in every single project entrusted to us.</p>\r\n', 'Cleaners- commercial and residential', 'Cleaners- commercial and residential', 'Cleaners- commercial and residential', NULL, NULL, NULL, '', NULL, 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `settings`
--
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `settingkey` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `settingtype` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `settings`
--
INSERT INTO `settings` (`id`, `title`, `settingkey`, `settingtype`, `status`) VALUES
(1, 'Admin email address', 'ADMIN_EMAIL', 'text', 'Y'),
(2, 'From email address', 'FROM_EMAIL', 'text', 'Y'),
(3, 'Facebook Link. ', 'FACEBOOK_LINK', 'text', 'Y'),
(4, 'Twitter Link. ', 'TWITTER_LINK', 'text', 'Y'),
(5, 'YouTube Link. ', 'YOUTUBE_LINK', 'text', 'Y'),
(6, 'LinkedIn Link.', 'LINKEDIN_LINK', 'text', 'Y'),
(7, 'Instagram Link.', 'INSTAGRAM_LINK', 'text', 'Y'),
(8, 'Site Name', 'SITE_NAME', 'text', 'Y'),
(9, 'Default Meta Title', 'DEFAULT_META_TITLE', 'text', 'Y'),
(10, 'Default Meta Description', 'DEFAULT_META_DESCRIPTION', 'textarea', 'Y'),
(11, 'Default Meta Keywords', 'DEFAULT_META_KEYWORDS', 'textarea', 'Y'),
(12, 'Breadcrumb Start', 'BREADCRUMB_START', 'text', 'Y'),
(15, 'Welcome Widget Slug', 'WELCOME_SLUG', 'text', 'N'),
(16, 'Admission Widgets', 'ADMISSSION_SLUG', 'text', 'N'),
(17, 'Academic Menu Parent ', 'ACADEMIC_PARENT', 'text', 'N'),
(18, 'Academic Menu Limit', 'ACADEMIC_LIMIT', 'text', 'N'),
(19, 'Calendar Catgeory Slug', 'CALENDAR_SLUG', 'text', 'N'),
(20, 'The Company Slug', 'COMPANY_SLUG', 'text', 'Y'),
(21, 'Cache Time', 'CACHE_TIME', 'text', 'N'),
(22, 'Fax', 'FAX_SLUG', 'text', 'N'),
(23, 'Our Services', 'SERVICES_SLUG', 'text', 'N'),
(24, 'Careers', 'CAREERS_SLUG', 'text', 'N'),
(25, 'Contact Us', 'CONTACT_SLUG', 'text', 'Y'),
(26, 'Privacy Policy', 'PRIVACY_SLUG', 'text', 'N'),
(27, 'Terms and Conditions', 'TERMS_SLUG', 'text', 'N'),
(28, 'Welcome Together', 'WELCOME_SLUG', 'text', 'N'),
(29, 'Why are we here', 'WHY_SLUG', 'text', 'N'),
(30, 'My Profile', 'PROFILE_SLUG', 'text', 'N'),
(31, 'Our Mission', 'MISSION_SLUG', 'text', 'N'),
(32, 'Careers in Business Analysis', 'BUSINESS_SLUG', 'text', 'N'),
(33, 'Job in resume pool', 'RESUME_SLUG', 'text', 'N'),
(34, 'Phone Number', 'PHONE_SLUG', 'text', 'Y'),
(35, 'Testimonials', 'TESTMONIALS', 'text', 'N'),
(36, 'Our Vission', 'VISSION_SLUG', 'text', 'N'),
(38, 'Quality Policy', 'QUALITY_SLUG', 'text', 'N'),
(40, 'Instagram Link.', 'INSTAGRAM_LINK', 'text', 'N'),
(41, 'Pinterest Link.', 'PIN_LINK', 'text', 'N'),
(42, 'Facilities and Amenities', 'FACILITY_SLUG', 'text', 'N');
-- --------------------------------------------------------
--
-- Table structure for table `settings_desc`
--
CREATE TABLE `settings_desc` (
  `desc_id` int(11) NOT NULL,
  `settings_id` int(11) NOT NULL,
  `settingvalue` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `settings_desc`
--
INSERT INTO `settings_desc` (`desc_id`, `settings_id`, `settingvalue`, `language`) VALUES
(1, 1, 'mail2yamunav@gmail.com', 'en'),
(5, 2, 'mail2yamunav@gmail.com', 'en'),
(24, 7, 'https://www.instagram.com/mhaogroup/', 'en'),
(9, 3, 'https://www.facebook.com/MHAOGroup/', 'en'),
(13, 4, 'https://twitter.com/mhaogroup', 'en'),
(17, 5, 'https://www.youtube.com/channel/UCI4_EKMAiCkALKGSTKxJJ5g?view_as=subscriber', 'en'),
(21, 6, 'https://www.linkedin.com/in/mhao-group-7741a9181/', 'en'),
(27, 8, 'MAFS', 'en'),
(30, 9, 'Home', 'en'),
(33, 10, 'MAFS', 'en'),
(36, 11, 'MAFS', 'en'),
(39, 12, 'Home', 'en'),
(82, 15, 'quality-assurance', 'en'),
(84, 16, 'meida-news', 'en'),
(86, 17, '5:8', 'en'),
(88, 18, '4', 'en'),
(90, 19, 'academic-calender', 'en'),
(92, 20, 'about-us', 'en'),
(94, 21, '10', 'en'),
(96, 22, '', 'en'),
(98, 23, 'our-services', 'en'),
(100, 24, 'careers', 'en'),
(102, 25, 'contact-us', 'en'),
(104, 26, 'privacy-policy', 'en'),
(106, 27, 'terms-and-conditions', 'en'),
(108, 28, 'working-together', 'en'),
(110, 29, 'why-are-we-here', 'en'),
(112, 30, 'get-to-know-us', 'en'),
(116, 32, 'careers-in-business-analysis', 'en'),
(118, 33, 'join-our-resume-pool', 'en'),
(120, 34, '800MAFS (6237)', 'en'),
(122, 35, 'testimonials', 'en'),
(124, 31, 'our-mission', 'en'),
(126, 36, 'our-vision', 'en'),
(130, 38, 'quality-policy', 'en'),
(134, 40, 'https://www.instagram.com/', 'en'),
(136, 41, 'https://www.pinterest.com/', 'en'),
(138, 42, 'facilities-and-amenities', 'en'),
(139, 1, 'yamuna@webchannel.ae', 'ar'),
(140, 2, 'yamuna@webchannel.ae', 'ar'),
(141, 7, 'http://gplus.to/', 'ar'),
(142, 3, 'https://www.facebook.com/', 'ar'),
(143, 4, 'https://twitter.com/', 'ar'),
(144, 5, 'https://www.youtube.com/', 'ar'),
(145, 6, 'https://www.linkedin.com/', 'ar'),
(146, 8, 'Sarralle', 'ar'),
(147, 9, 'Home', 'ar'),
(148, 10, 'Sarralle', 'ar'),
(149, 11, 'Ezy Park ', 'ar'),
(150, 12, 'Home', 'ar'),
(151, 15, 'quality-assurance', 'ar'),
(152, 16, 'meida-news', 'ar'),
(153, 17, '5:8', 'ar'),
(154, 18, '4', 'ar'),
(155, 19, 'academic-calender', 'ar'),
(156, 20, 'the-company', 'ar'),
(157, 21, '10', 'ar'),
(158, 22, '+971 4 2234493', 'ar'),
(159, 23, 'our-services', 'ar'),
(160, 24, 'careers', 'ar'),
(161, 25, 'contact-us', 'ar'),
(162, 26, 'privacy-policy', 'ar'),
(163, 27, 'terms-and-conditions', 'ar'),
(164, 28, 'working-together', 'ar'),
(165, 29, 'why-are-we-here', 'ar'),
(166, 30, 'get-to-know-us', 'ar'),
(167, 32, 'careers-in-business-analysis', 'ar'),
(168, 33, 'join-our-resume-pool', 'ar'),
(169, 34, '+971 4 2217124', 'ar'),
(170, 35, 'testimonials', 'ar'),
(171, 31, 'our-mission', 'ar'),
(172, 36, 'our-vision', 'ar'),
(173, 38, 'quality-policy', 'ar'),
(174, 40, 'https://www.instagram.com/', 'ar'),
(175, 41, 'https://www.pinterest.com/', 'ar'),
(176, 42, 'facilities-and-amenities', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `university` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `address2` text NOT NULL,
  `state2` varchar(255) NOT NULL,
  `city2` varchar(255) NOT NULL,
  `zip2` varchar(30) NOT NULL,
  `country` varchar(255) NOT NULL,
  `country2` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `phone2` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `organizations` text NOT NULL,
  `membership_type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `passwordcopy` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'N',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Table structure for table `video`
--
CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci DEFAULT 'N',
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `video`
--
INSERT INTO `video` (`id`, `category_id`, `slug`, `status`, `sort_order`) VALUES
(1, 1, NULL, 'Y', 0),
(2, 1, NULL, 'Y', 0),
(3, 1, NULL, 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `video_category`
--
CREATE TABLE `video_category` (
  `id` int(11) NOT NULL,
  `slug` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `sort_order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `video_category`
--
INSERT INTO `video_category` (`id`, `slug`, `status`, `sort_order`) VALUES
(1, 'how-to-deep-clean-your-kitchen', 'Y', 0);
-- --------------------------------------------------------
--
-- Table structure for table `video_category_desc`
--
CREATE TABLE `video_category_desc` (
  `desc_id` int(11) NOT NULL,
  `gallery_category_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `video_category_desc`
--
INSERT INTO `video_category_desc` (`desc_id`, `gallery_category_id`, `title`, `image`, `language`) VALUES
(1, 1, 'How to deep clean your kitchen', '', 'en'),
(2, 1, 'How to deep clean your kitchen', '', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `video_desc`
--
CREATE TABLE `video_desc` (
  `desc_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `title` varchar(300) CHARACTER SET utf8 NOT NULL,
  `desc` text COLLATE latin1_general_ci NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `video` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `video_desc`
--
INSERT INTO `video_desc` (`desc_id`, `gallery_id`, `title`, `desc`, `image`, `video`, `language`) VALUES
(1, 1, 'How to deep clean your kitchen', '<p>We focus on offering the highest level of service in the industry and deliver real &lsquo;solutions with a soul&rsquo; that truly enhance the value of your investment. We are committed to keep a sight of the constantly changing needs of our customers.</p>\r\n', '', 'https://www.youtube.com/watch?v=DbFi2RrKWDo', 'en'),
(2, 1, 'How to deep clean your kitchen', '<p>We focus on offering the highest level of service in the industry and deliver real &lsquo;solutions with a soul&rsquo; that truly enhance the value of your investment. We are committed to keep a sight of the constantly changing needs of our customers.</p>\r\n', '', 'https://www.youtube.com/watch?v=DbFi2RrKWDo', 'ar'),
(3, 2, 'Oure New Works', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', '', 'https://www.youtube.com/watch?v=nNVMoQ_pPuE', 'en'),
(4, 2, 'Oure New Works', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', '', 'https://www.youtube.com/watch?v=nNVMoQ_pPuE', 'ar'),
(5, 3, 'Lorum epsum', '<p>Lorum epsum</p>\r\n', '', 'https://www.youtube.com/watch?v=nNVMoQ_pPuE', 'en'),
(6, 3, 'Lorum epsum', '<p>Lorum epsum</p>\r\n', '', 'https://www.youtube.com/watch?v=nNVMoQ_pPuE', 'ar');
-- --------------------------------------------------------
--
-- Table structure for table `widgets`
--
CREATE TABLE `widgets` (
  `id` int(11) NOT NULL,
  `key` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `widget_position` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `widget_type` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `content_category_id` int(15) NOT NULL,
  `parent_menu_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `widgets_desc`
--
CREATE TABLE `widgets_desc` (
  `desc_id` int(11) NOT NULL,
  `widgets_id` int(11) NOT NULL,
  `html` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(10) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Indexes for dumped tables
--
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `admin_logins`
--
ALTER TABLE `admin_logins`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `admin_reset`
--
ALTER TABLE `admin_reset`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `banners_desc`
--
ALTER TABLE `banners_desc`
  ADD PRIMARY KEY (`desc_id`),
  ADD KEY `banners_id` (`banners_id`);
--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);
--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `contacts_desc`
--
ALTER TABLE `contacts_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `contact_category`
--
ALTER TABLE `contact_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `contact_category_desc`
--
ALTER TABLE `contact_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `contents_desc`
--
ALTER TABLE `contents_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `content_category`
--
ALTER TABLE `content_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `content_category_desc`
--
ALTER TABLE `content_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `downloads_desc`
--
ALTER TABLE `downloads_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `download_category`
--
ALTER TABLE `download_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `download_category_desc`
--
ALTER TABLE `download_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `enquiry_master`
--
ALTER TABLE `enquiry_master`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `events_category`
--
ALTER TABLE `events_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `events_category_desc`
--
ALTER TABLE `events_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `events_desc`
--
ALTER TABLE `events_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `gallery_category`
--
ALTER TABLE `gallery_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `gallery_category_desc`
--
ALTER TABLE `gallery_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `gallery_desc`
--
ALTER TABLE `gallery_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `localization`
--
ALTER TABLE `localization`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `menuitems_desc`
--
ALTER TABLE `menuitems_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `news_category_desc`
--
ALTER TABLE `news_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `news_desc`
--
ALTER TABLE `news_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `pages_desc`
--
ALTER TABLE `pages_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissions_id`);
--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);
--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `services_category`
--
ALTER TABLE `services_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `services_category_desc`
--
ALTER TABLE `services_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `services_desc`
--
ALTER TABLE `services_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `settings_desc`
--
ALTER TABLE `settings_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `video_category`
--
ALTER TABLE `video_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `video_category_desc`
--
ALTER TABLE `video_category_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `video_desc`
--
ALTER TABLE `video_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `widgets_desc`
--
ALTER TABLE `widgets_desc`
  ADD PRIMARY KEY (`desc_id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admin_logins`
--
ALTER TABLE `admin_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
--
-- AUTO_INCREMENT for table `admin_reset`
--
ALTER TABLE `admin_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `banners_desc`
--
ALTER TABLE `banners_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contacts_desc`
--
ALTER TABLE `contacts_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact_category`
--
ALTER TABLE `contact_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contact_category_desc`
--
ALTER TABLE `contact_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `contents_desc`
--
ALTER TABLE `contents_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `content_category`
--
ALTER TABLE `content_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `content_category_desc`
--
ALTER TABLE `content_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=858;
--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `downloads_desc`
--
ALTER TABLE `downloads_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `download_category`
--
ALTER TABLE `download_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `download_category_desc`
--
ALTER TABLE `download_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enquiry_master`
--
ALTER TABLE `enquiry_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events_category`
--
ALTER TABLE `events_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events_category_desc`
--
ALTER TABLE `events_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events_desc`
--
ALTER TABLE `events_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `gallery_category`
--
ALTER TABLE `gallery_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gallery_category_desc`
--
ALTER TABLE `gallery_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gallery_desc`
--
ALTER TABLE `gallery_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `localization`
--
ALTER TABLE `localization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `menuitems_desc`
--
ALTER TABLE `menuitems_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `news_category`
--
ALTER TABLE `news_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news_category_desc`
--
ALTER TABLE `news_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `news_desc`
--
ALTER TABLE `news_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pages_desc`
--
ALTER TABLE `pages_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permissions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `services_category`
--
ALTER TABLE `services_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `services_category_desc`
--
ALTER TABLE `services_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `services_desc`
--
ALTER TABLE `services_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `settings_desc`
--
ALTER TABLE `settings_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `video_category`
--
ALTER TABLE `video_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `video_category_desc`
--
ALTER TABLE `video_category_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `video_desc`
--
ALTER TABLE `video_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `widgets_desc`
--
ALTER TABLE `widgets_desc`
  MODIFY `desc_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;