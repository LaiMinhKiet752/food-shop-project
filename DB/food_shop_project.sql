-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 02:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_shop_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_salaries`
--

CREATE TABLE IF NOT EXISTS `advance_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advance_salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advance_salaries`
--

INSERT INTO `advance_salaries` (`id`, `employee_id`, `month`, `year`, `advance_salary`, `created_at`, `updated_at`) VALUES
(2, 2, 'July', '2023', '0', '2023-07-15 09:20:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_title`, `banner_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The Best Organic Products Online', 'upload/banner/1769647176332299_banner.png', 'show', '2023-06-25 04:24:21', NULL),
(2, 'Everyday Fresh & Clean With Our Products', 'upload/banner/1769647185216280_banner.png', 'show', '2023-06-25 04:24:29', NULL),
(3, 'Make your Breakfast Healthy and Easy', 'upload/banner/1769647192479345_banner.png', 'show', '2023-06-25 04:24:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `blog_category_name`, `blog_category_slug`, `created_at`, `updated_at`) VALUES
(1, 'Pet Foods', 'pet-foods', '2023-06-25 09:44:09', NULL),
(6, 'Fresh Fruit', 'fresh-fruit', '2023-07-10 14:19:23', NULL),
(7, 'Baking Material', 'baking-material', '2023-07-10 14:19:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_post_id`, `user_id`, `parent_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(11, 10, 3, NULL, 'I just spent a great food shopping holiday on this newly discovered site. \r\nWith a simple and easy to use interface, the website has brought a great shopping experience to me!', 0, '2023-07-17 07:40:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `category_id`, `post_title`, `post_slug`, `post_image`, `post_short_description`, `post_long_description`, `views`, `created_at`, `updated_at`) VALUES
(3, 1, 'I Tried 38 Different Bottles of Mustard — These Are the Ones I’ll Buy Again', 'i-tried-38-different-bottles-of-mustard-—-these-are-the-ones-i’ll-buy-again', 'upload/blog/1769667585655316.png', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nAnimi, quas veniam? Quisquam aliquid ipsum alias, ipsa quasi veritatis porro quidem, fuga deserunt magnam illum rem quod.', '<p class=\"single-excerpt\">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class=\"mt-50\">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>\r\n<p><img class=\"mb-30\" src=\"assets/imgs/blog/blog-21.png\" alt=\"\"></p>\r\n<p>Tortor, lobortis semper viverra ac, molestie tortor laoreet amet euismod et diam quis aliquam consequat porttitor integer a nisl, in faucibus nunc et aenean turpis dui dignissim nec scelerisque ullamcorper eu neque, augue quam quis lacus pretium eros est amet turpis nunc in turpis massa et eget facilisis ante molestie penatibus dolor volutpat, porta pellentesque scelerisque at ornare dui tincidunt cras feugiat tempor lectus</p>\r\n<blockquote>\r\n<p>Integer eu faucibus&nbsp;<a href=\"#\">dolor</a><sup><a href=\"#\">[5]</a></sup>. Ut venenatis tincidunt diam elementum imperdiet. Etiam accumsan semper nisl eu congue. Sed aliquam magna erat, ac eleifend lacus rhoncus in.</p>\r\n</blockquote>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet id enim, libero sit. Est donec lobortis cursus amet, cras elementum libero convallis feugiat. Nulla faucibus facilisi tincidunt a arcu, sem donec sed sed. Tincidunt morbi scelerisque lectus non. At leo mauris, vel augue. Facilisi diam consequat amet, commodo lorem nisl, odio malesuada cras. Tempus lectus sed libero viverra ut. Facilisi rhoncus elit sit sit.</p>', 14, '2023-06-25 09:48:45', '2023-07-10 02:53:47'),
(8, 7, 'The Easy Italian Chicken Dinner I Make Over and Over Again', 'the-easy-italian-chicken-dinner-i-make-over-and-over-again', 'upload/blog/1771043657873732.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '<p class=\"single-excerpt\">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class=\"mt-50\">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>\r\n<p><img class=\"mb-30\" src=\"assets/imgs/blog/blog-21.png\" alt=\"\"></p>\r\n<p>Tortor, lobortis semper viverra ac, molestie tortor laoreet amet euismod et diam quis aliquam consequat porttitor integer a nisl, in faucibus nunc et aenean turpis dui dignissim nec scelerisque ullamcorper eu neque, augue quam quis lacus pretium eros est amet turpis nunc in turpis massa et eget facilisis ante molestie penatibus dolor volutpat, porta pellentesque scelerisque at ornare dui tincidunt cras feugiat tempor lectus</p>\r\n<blockquote>\r\n<p>Integer eu faucibus&nbsp;<a href=\"#\">dolor</a><sup><a href=\"#\">[5]</a></sup>. Ut venenatis tincidunt diam elementum imperdiet. Etiam accumsan semper nisl eu congue. Sed aliquam magna erat, ac eleifend lacus rhoncus in.</p>\r\n</blockquote>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet id enim, libero sit. Est donec lobortis cursus amet, cras elementum libero convallis feugiat. Nulla faucibus facilisi tincidunt a arcu, sem donec sed sed. Tincidunt morbi scelerisque lectus non. At leo mauris, vel augue. Facilisi diam consequat amet, commodo lorem nisl, odio malesuada cras. Tempus lectus sed libero viverra ut. Facilisi rhoncus elit sit sit.</p>', 2, '2023-07-10 14:20:50', '2023-07-14 06:12:12'),
(9, 6, 'Best smartwatch 2022: the top wearables you can buy today', 'best-smartwatch-2022:-the-top-wearables-you-can-buy-today', 'upload/blog/1771043717813364.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '<p class=\"single-excerpt\">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class=\"mt-50\">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>', NULL, '2023-07-10 14:21:47', NULL),
(10, 1, '9 Tasty Ideas That Will Inspire You to Grow a Home Herb Garden Today', '9-tasty-ideas-that-will-inspire-you-to-grow-a-home-herb-garden-today', 'upload/blog/1771043757006279.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '<p class=\"single-excerpt\">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class=\"mt-50\">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>', 10, '2023-07-10 14:22:24', '2023-07-17 07:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_brand_name_unique` (`brand_name`),
  UNIQUE KEY `brands_brand_email_unique` (`brand_email`),
  UNIQUE KEY `brands_brand_phone_unique` (`brand_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `brand_image`, `brand_email`, `brand_phone`, `brand_address`, `created_at`, `updated_at`) VALUES
(1, 'PEPSI', 'pepsi', 'upload/brand/1770565804964040_brand.png', 'pepsi@gmail.com', '0722334455', 'Number 930, Hoang Anh Gia Lai Apartment Block, Nguyen Thi Thap Street, District 7, Ho Chi Minh City', '2023-06-25 03:28:46', '2023-07-10 09:10:29'),
(2, 'OREO', 'oreo', 'upload/brand/1769937386676275_brand.png', 'oreo@gmail.com', '0344332211', 'No. 9128, 8th floor, Vinsmart city apartment, Nam Tu Liem district, Hanoi', '2023-06-28 09:17:07', '2023-07-11 05:53:08'),
(3, 'COCA COLA', 'coca-cola', 'upload/brand/1770945723186964_brand.png', 'cocacola@gmai.com', '0912345678', 'Room No.8, Keangnam Building, Pham Hung Street, Nam Tu Liem District, Ha Noi City', '2023-06-30 04:14:21', '2023-07-10 09:10:01'),
(4, 'ORGANICFOOD', 'organicfood', 'upload/brand/1770859603425982_brand.jpg', 'organicfood@gmail.com', '0932060314', '13, Road No. 10, Binh Chanh District', '2023-07-08 13:35:21', '2023-07-11 05:52:25'),
(5, 'FOOD', 'food', 'upload/brand/1770862313961324_brand.png', 'Food@gmail.com', '0934060314', '19, Road No. 10, Binh Chanh District, Ho Chi Minh city', '2023-07-08 14:18:15', '2023-07-10 09:09:48'),
(6, 'KITKAT', 'kitkat', 'upload/brand/1771024064775703_brand.png', 'kitkat@gmail.com', '0336622122', 'Number 930, Hoang Anh Gia Lai Apartment Block, Nguyen Thi Thap Street, District 7, Ho Chi Minh City', '2023-07-10 09:09:24', '2023-07-11 05:52:46'),
(7, 'VINAMILK', 'vinamilk', 'upload/brand/1771372104341326_brand.jpg', 'vinamilk@gmail.com', '0369258471', '253, street 35, Ward 25, Go Vap district, Ho Chi Minh city', '2023-07-14 05:21:20', '2023-07-14 05:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_category_name_unique` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'VEGETABLE', 'vegetable', 'upload/category/1769644191460967_category.svg', '2023-06-25 03:36:54', '2023-06-25 03:36:54'),
(2, 'FRUIT', 'fruit', 'upload/category/1769644295037590_category.svg', '2023-06-25 03:38:33', '2023-06-25 03:38:33'),
(3, 'SEAFOOD', 'seafood', 'upload/category/1770563457266912_category.svg', '2023-06-25 03:40:01', '2023-07-05 07:08:14'),
(4, 'SOFT DRINK', 'soft-drink', 'upload/category/1769644485532351_category.svg', '2023-06-25 03:41:35', '2023-07-09 12:49:21'),
(5, 'PET FOODS', 'pet-foods', 'upload/category/1769644645213784_category.svg', '2023-06-25 03:44:07', '2023-06-25 03:44:07'),
(6, 'CAKE', 'cake', 'upload/category/1769644789812491_category.svg', '2023-06-25 03:46:25', '2023-06-25 03:46:25'),
(7, 'EGGS', 'eggs', 'upload/category/1770565105826310_category.svg', '2023-06-25 03:47:19', '2023-07-05 07:34:27'),
(10, 'MILK', 'milk', 'upload/category/1771371944483580_category.svg', '2023-07-14 05:18:48', '2023-07-14 05:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `compares`
--

CREATE TABLE IF NOT EXISTS `compares` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_discount` int(11) NOT NULL,
  `coupon_validity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_discount`, `coupon_validity`, `status`, `created_at`, `updated_at`) VALUES
(5, 'NEST', 40, '2023-07-31', 1, '2023-07-16 14:54:26', NULL),
(6, 'NESTSHOP', 60, '2023-07-31', 1, '2023-07-17 08:24:33', NULL),
(7, 'NESTSHOP23', 55, '2023-07-31', 1, '2023-07-17 08:24:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_uses`
--

CREATE TABLE IF NOT EXISTS `coupon_uses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_code_unique` (`employee_code`),
  UNIQUE KEY `employees_employee_email_unique` (`employee_email`),
  UNIQUE KEY `employees_employee_phone_unique` (`employee_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_code`, `employee_name`, `employee_email`, `employee_phone`, `employee_address`, `employee_photo`, `position`, `experience`, `salary`, `created_at`, `updated_at`) VALUES
(2, 'NEST100', 'David', 'david1122@gmail.com', '0567891234', 'No. 117, 8/32 Alley, 199 lane, 16 cluster, Ho Tung Mau street, Mai Dich ward, Cau Giay district, Ha Noi', 'upload/employee_images/1771477776365427_employee.png', 'Shipper', '1 Year', '1000', '2023-07-15 09:20:57', '2023-07-17 08:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_02_184500_create_brands_table', 2),
(6, '2023_05_04_094822_create_categories_table', 3),
(7, '2023_05_05_010505_create_sub_categories_table', 3),
(8, '2023_05_09_160008_create_products_table', 4),
(9, '2023_05_09_161259_create_multi_images_table', 4),
(10, '2023_05_15_074747_create_sliders_table', 5),
(11, '2023_05_15_100021_create_banners_table', 5),
(12, '2023_05_27_063309_create_wishlists_table', 6),
(13, '2023_05_29_141018_create_compares_table', 7),
(14, '2023_06_03_082224_create_coupons_table', 8),
(15, '2023_06_03_133542_create_ship_cities_table', 9),
(16, '2023_06_03_133911_create_ship_districts_table', 9),
(17, '2023_06_03_134047_create_ship_communes_table', 9),
(20, '2023_06_18_105634_create_blog_posts_table', 10),
(21, '2023_06_18_151251_create_blog_categories_table', 10),
(22, '2023_06_19_114428_create_blog_comments_table', 10),
(23, '2023_06_20_205544_create_reviews_table', 11),
(24, '2023_06_21_222234_create_site_settings_table', 12),
(25, '2023_06_22_074303_create_seos_table', 13),
(26, '2023_06_24_082558_create_permission_tables', 14),
(35, '2023_06_06_210147_create_orders_table', 15),
(36, '2023_06_06_211501_create_order_details_table', 15),
(37, '2023_06_27_211102_create_notifications_table', 16),
(48, '2023_06_30_182951_create_advance_salaries_table', 18),
(49, '2023_06_30_200817_create_pay_salaries_table', 19),
(50, '2023_06_30_133652_create_employees_table', 17),
(52, '2023_07_01_221855_create_smtp_settings_table', 21),
(53, '2023_07_01_092824_create_attendances_table', 20),
(56, '2023_07_03_113421_create_received_mails_table', 22),
(57, '2023_07_03_195643_create_subscribers_table', 23),
(58, '2023_07_12_182430_create_order_returns_table', 24),
(59, '2023_07_13_212909_create_suppliers_table', 25),
(63, '2023_07_14_201733_create_purchases_table', 26),
(67, '2023_07_16_222534_create_coupon_uses_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(8, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `multi_images`
--

CREATE TABLE IF NOT EXISTS `multi_images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_images`
--

INSERT INTO `multi_images` (`id`, `product_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(19, 10, 'upload/products/multiple_images/1769937510319194_product.jpg', '2023-06-28 09:19:05', NULL),
(20, 10, 'upload/products/multiple_images/1769937510562920_product.jpg', '2023-06-28 09:19:05', NULL),
(30, 9, 'upload/products/multiple_images/1770662030486351_product.jpg', '2023-07-06 09:15:01', NULL),
(33, 7, 'upload/products/multiple_images/1770662139105313_product.jpg', '2023-07-06 09:16:45', NULL),
(34, 10, 'upload/products/multiple_images/1770856735040091_product.jpg', '2023-07-08 12:49:46', NULL),
(35, 10, 'upload/products/multiple_images/1770856853618261_product.jpg', '2023-07-08 12:51:39', NULL),
(37, 12, 'upload/products/multiple_images/1770858330428794_product.jpg', '2023-07-08 13:15:07', NULL),
(38, 13, 'upload/products/multiple_images/1770858742313948_product.jpg', '2023-07-08 13:21:40', NULL),
(39, 14, 'upload/products/multiple_images/1770858982209744_product.jpg', '2023-07-08 13:25:29', NULL),
(40, 15, 'upload/products/multiple_images/1770859413959124_product.jpg', '2023-07-08 13:32:21', NULL),
(41, 16, 'upload/products/multiple_images/1770859849933160_product.jpg', '2023-07-08 13:39:17', NULL),
(42, 17, 'upload/products/multiple_images/1770860067856012_product.jpg', '2023-07-08 13:42:44', NULL),
(43, 18, 'upload/products/multiple_images/1770860304965583_product.jpg', '2023-07-08 13:46:31', NULL),
(44, 19, 'upload/products/multiple_images/1770860661875608_product.jpg', '2023-07-08 13:52:11', NULL),
(45, 20, 'upload/products/multiple_images/1770861350202841_product.jpg', '2023-07-08 14:03:07', NULL),
(46, 21, 'upload/products/multiple_images/1770861555295148_product.jpg', '2023-07-08 14:06:23', NULL),
(47, 22, 'upload/products/multiple_images/1770861736600191_product.jpg', '2023-07-08 14:09:16', NULL),
(48, 23, 'upload/products/multiple_images/1770862037881701_product.jpg', '2023-07-08 14:14:03', NULL),
(49, 24, 'upload/products/multiple_images/1770862502455399_product.jpg', '2023-07-08 14:21:26', NULL),
(50, 25, 'upload/products/multiple_images/1770862973400744_product.jpg', '2023-07-08 14:28:55', NULL),
(51, 26, 'upload/products/multiple_images/1770863241370443_product.jpg', '2023-07-08 14:33:11', NULL),
(52, 27, 'upload/products/multiple_images/1770863699440575_product.jpg', '2023-07-08 14:40:28', NULL),
(53, 28, 'upload/products/multiple_images/1770864052440648_product.jpg', '2023-07-08 14:46:04', NULL),
(54, 29, 'upload/products/multiple_images/1770864412485060_product.jpg', '2023-07-08 14:51:48', NULL),
(55, 30, 'upload/products/multiple_images/1770864602947930_product.jpg', '2023-07-08 14:54:49', NULL),
(56, 31, 'upload/products/multiple_images/1770866620943260_product.jpg', '2023-07-08 15:26:54', NULL),
(57, 32, 'upload/products/multiple_images/1770868933409409_product.jpg', '2023-07-08 16:03:39', NULL),
(58, 33, 'upload/products/multiple_images/1770869250224143_product.jpg', '2023-07-08 16:08:41', NULL),
(59, 34, 'upload/products/multiple_images/1770869571854514_product.jpg', '2023-07-08 16:13:48', NULL),
(60, 35, 'upload/products/multiple_images/1770952592792527_product.jpg', '2023-07-09 14:13:23', NULL),
(61, 35, 'upload/products/multiple_images/1770952593037999_product.jpg', '2023-07-09 14:13:23', NULL),
(62, 36, 'upload/products/multiple_images/1770952696913598_product.jpg', '2023-07-09 14:15:02', NULL),
(63, 36, 'upload/products/multiple_images/1770952697163282_product.jpg', '2023-07-09 14:15:03', NULL),
(68, 40, 'upload/products/multiple_images/1771000267066363_product.jpg', '2023-07-10 02:51:09', NULL),
(69, 41, 'upload/products/multiple_images/1771182415996360_product.jpg', '2023-07-12 03:06:19', NULL),
(70, 42, 'upload/products/multiple_images/1771374784664563_product.jpg', '2023-07-14 06:03:57', NULL),
(71, 42, 'upload/products/multiple_images/1771374785051752_product.jpg', '2023-07-14 06:03:57', NULL),
(72, 43, 'upload/products/multiple_images/1771479743104052_product.png', '2023-07-15 09:52:13', NULL),
(73, 44, 'upload/products/multiple_images/1771594416707655_product.jpg', '2023-07-16 16:14:54', NULL),
(74, 44, 'upload/products/multiple_images/1771594416888377_product.jpg', '2023-07-16 16:14:54', NULL),
(75, 45, 'upload/products/multiple_images/1771594773694475_product.jpg', '2023-07-16 16:20:34', NULL),
(76, 45, 'upload/products/multiple_images/1771594773880396_product.jpg', '2023-07-16 16:20:35', NULL),
(77, 46, 'upload/products/multiple_images/1771594928847815_product.jpg', '2023-07-16 16:23:02', NULL),
(78, 46, 'upload/products/multiple_images/1771594929036714_product.jpg', '2023-07-16 16:23:03', NULL),
(79, 47, 'upload/products/multiple_images/1771595069757392_product.jpg', '2023-07-16 16:25:17', NULL),
(80, 47, 'upload/products/multiple_images/1771595069944240_product.jpg', '2023-07-16 16:25:17', NULL),
(81, 48, 'upload/products/multiple_images/1771595188871905_product.jpg', '2023-07-16 16:27:10', NULL),
(82, 48, 'upload/products/multiple_images/1771595189063729_product.jpg', '2023-07-16 16:27:11', NULL),
(83, 49, 'upload/products/multiple_images/1771596443948566_product.jpg', '2023-07-16 16:47:07', NULL),
(84, 49, 'upload/products/multiple_images/1771596444132901_product.jpg', '2023-07-16 16:47:07', NULL),
(85, 50, 'upload/products/multiple_images/1771596602329402_product.jpg', '2023-07-16 16:49:38', NULL),
(86, 50, 'upload/products/multiple_images/1771596602515275_product.jpg', '2023-07-16 16:49:39', NULL),
(87, 51, 'upload/products/multiple_images/1771596709928993_product.jpg', '2023-07-16 16:51:21', NULL),
(88, 51, 'upload/products/multiple_images/1771596710108101_product.jpg', '2023-07-16 16:51:21', NULL),
(89, 52, 'upload/products/multiple_images/1771596836437776_product.jpg', '2023-07-16 16:53:22', NULL),
(90, 52, 'upload/products/multiple_images/1771596836671656_product.jpg', '2023-07-16 16:53:22', NULL),
(91, 53, 'upload/products/multiple_images/1771597049089358_product.jpg', '2023-07-16 16:56:44', NULL),
(92, 53, 'upload/products/multiple_images/1771597049272471_product.jpg', '2023-07-16 16:56:45', NULL),
(93, 54, 'upload/products/multiple_images/1771597247419513_product.jpg', '2023-07-16 16:59:54', NULL),
(94, 54, 'upload/products/multiple_images/1771597247656406_product.jpg', '2023-07-16 16:59:54', NULL),
(95, 55, 'upload/products/multiple_images/1771597409683525_product.jpg', '2023-07-16 17:02:28', NULL),
(96, 55, 'upload/products/multiple_images/1771597409864867_product.jpg', '2023-07-16 17:02:29', NULL),
(97, 56, 'upload/products/multiple_images/1771597667865730_product.jpg', '2023-07-16 17:06:35', NULL),
(98, 56, 'upload/products/multiple_images/1771597668096449_product.jpg', '2023-07-16 17:06:35', NULL),
(99, 57, 'upload/products/multiple_images/1771597824691829_product.jpg', '2023-07-16 17:09:04', NULL),
(100, 57, 'upload/products/multiple_images/1771597824876000_product.jpg', '2023-07-16 17:09:04', NULL),
(101, 58, 'upload/products/multiple_images/1771597956311499_product.jpg', '2023-07-16 17:11:10', NULL),
(102, 58, 'upload/products/multiple_images/1771597956536610_product.jpg', '2023-07-16 17:11:10', NULL),
(103, 59, 'upload/products/multiple_images/1771598067572109_product.jpg', '2023-07-16 17:12:56', NULL),
(104, 59, 'upload/products/multiple_images/1771598067760278_product.jpg', '2023-07-16 17:12:56', NULL),
(105, 60, 'upload/products/multiple_images/1771598325792409_product.jpg', '2023-07-16 17:17:02', NULL),
(106, 60, 'upload/products/multiple_images/1771598325981084_product.jpg', '2023-07-16 17:17:02', NULL),
(107, 61, 'upload/products/multiple_images/1771598431611544_product.jpg', '2023-07-16 17:18:43', NULL),
(108, 61, 'upload/products/multiple_images/1771598431796445_product.jpg', '2023-07-16 17:18:43', NULL),
(109, 62, 'upload/products/multiple_images/1771598587715323_product.jpg', '2023-07-16 17:21:12', NULL),
(110, 62, 'upload/products/multiple_images/1771598587899991_product.jpg', '2023-07-16 17:21:12', NULL),
(111, 63, 'upload/products/multiple_images/1771598698280803_product.jpg', '2023-07-16 17:22:57', NULL),
(112, 64, 'upload/products/multiple_images/1771598798807681_product.jpg', '2023-07-16 17:24:33', NULL),
(113, 64, 'upload/products/multiple_images/1771598798993041_product.jpg', '2023-07-16 17:24:33', NULL),
(114, 65, 'upload/products/multiple_images/1771598911098211_product.jpg', '2023-07-16 17:26:20', NULL),
(115, 65, 'upload/products/multiple_images/1771598911280756_product.jpg', '2023-07-16 17:26:20', NULL),
(116, 66, 'upload/products/multiple_images/1771598999854484_product.jpg', '2023-07-16 17:27:45', NULL),
(117, 66, 'upload/products/multiple_images/1771599000034746_product.jpg', '2023-07-16 17:27:45', NULL),
(118, 67, 'upload/products/multiple_images/1771599099417696_product.jpg', '2023-07-16 17:29:20', NULL),
(119, 67, 'upload/products/multiple_images/1771599099609561_product.jpg', '2023-07-16 17:29:20', NULL),
(120, 68, 'upload/products/multiple_images/1771599231787646_product.jpg', '2023-07-16 17:31:26', NULL),
(121, 68, 'upload/products/multiple_images/1771599231975306_product.jpg', '2023-07-16 17:31:26', NULL),
(122, 69, 'upload/products/multiple_images/1771599335509837_product.jpg', '2023-07-16 17:33:05', NULL),
(123, 69, 'upload/products/multiple_images/1771599335690264_product.jpg', '2023-07-16 17:33:05', NULL),
(124, 70, 'upload/products/multiple_images/1771600024566978_product.jpg', '2023-07-16 17:44:02', NULL),
(125, 71, 'upload/products/multiple_images/1771600130656488_product.jpg', '2023-07-16 17:45:43', NULL),
(126, 71, 'upload/products/multiple_images/1771600130844562_product.jpg', '2023-07-16 17:45:43', NULL),
(127, 72, 'upload/products/multiple_images/1771600227039676_product.jpg', '2023-07-16 17:47:15', NULL),
(128, 72, 'upload/products/multiple_images/1771600227229529_product.jpg', '2023-07-16 17:47:15', NULL),
(129, 73, 'upload/products/multiple_images/1771600409100676_product.jpg', '2023-07-16 17:50:09', NULL),
(130, 73, 'upload/products/multiple_images/1771600409283652_product.jpg', '2023-07-16 17:50:09', NULL),
(131, 74, 'upload/products/multiple_images/1771600532945021_product.jpg', '2023-07-16 17:52:07', NULL),
(132, 75, 'upload/products/multiple_images/1771600683550320_product.jpg', '2023-07-16 17:54:31', NULL),
(133, 75, 'upload/products/multiple_images/1771600683780806_product.jpg', '2023-07-16 17:54:31', NULL),
(134, 76, 'upload/products/multiple_images/1771600819270620_product.jpg', '2023-07-16 17:56:40', NULL),
(135, 76, 'upload/products/multiple_images/1771600819454572_product.jpg', '2023-07-16 17:56:40', NULL),
(136, 77, 'upload/products/multiple_images/1771601020232915_product.jpg', '2023-07-16 17:59:52', NULL),
(137, 77, 'upload/products/multiple_images/1771601020461912_product.jpg', '2023-07-16 17:59:52', NULL),
(138, 78, 'upload/products/multiple_images/1771601141448233_product.jpg', '2023-07-16 18:01:47', NULL),
(139, 78, 'upload/products/multiple_images/1771601141635518_product.jpg', '2023-07-16 18:01:47', NULL),
(140, 79, 'upload/products/multiple_images/1771601246818636_product.jpg', '2023-07-16 18:03:28', NULL),
(141, 79, 'upload/products/multiple_images/1771601247012245_product.jpg', '2023-07-16 18:03:28', NULL),
(142, 80, 'upload/products/multiple_images/1771601361948529_product.jpg', '2023-07-16 18:05:18', NULL),
(143, 80, 'upload/products/multiple_images/1771601362182517_product.jpg', '2023-07-16 18:05:18', NULL),
(144, 81, 'upload/products/multiple_images/1771601467309623_product.jpg', '2023-07-16 18:06:58', NULL),
(145, 81, 'upload/products/multiple_images/1771601467506825_product.jpg', '2023-07-16 18:06:58', NULL),
(146, 82, 'upload/products/multiple_images/1771601680256931_product.jpg', '2023-07-16 18:10:21', NULL),
(147, 82, 'upload/products/multiple_images/1771601680444154_product.jpg', '2023-07-16 18:10:21', NULL),
(148, 83, 'upload/products/multiple_images/1771601828289259_product.jpg', '2023-07-16 18:12:42', NULL),
(149, 84, 'upload/products/multiple_images/1771601940022308_product.jpg', '2023-07-16 18:14:29', NULL),
(150, 85, 'upload/products/multiple_images/1771602067011254_product.jpg', '2023-07-16 18:16:30', NULL),
(151, 85, 'upload/products/multiple_images/1771602067194196_product.jpg', '2023-07-16 18:16:30', NULL),
(152, 86, 'upload/products/multiple_images/1771602399004144_product.jpg', '2023-07-16 18:21:47', NULL),
(153, 86, 'upload/products/multiple_images/1771602399237178_product.jpg', '2023-07-16 18:21:47', NULL),
(154, 87, 'upload/products/multiple_images/1771602501136925_product.jpg', '2023-07-16 18:23:24', NULL),
(155, 87, 'upload/products/multiple_images/1771602501322455_product.jpg', '2023-07-16 18:23:24', NULL),
(156, 88, 'upload/products/multiple_images/1771602608635012_product.jpg', '2023-07-16 18:25:06', NULL),
(157, 88, 'upload/products/multiple_images/1771602608819790_product.jpg', '2023-07-16 18:25:07', NULL),
(158, 89, 'upload/products/multiple_images/1771602749347607_product.jpg', '2023-07-16 18:27:21', NULL),
(159, 89, 'upload/products/multiple_images/1771602749602461_product.jpg', '2023-07-16 18:27:21', NULL),
(160, 90, 'upload/products/multiple_images/1771602872675915_product.jpg', '2023-07-16 18:29:18', NULL),
(161, 90, 'upload/products/multiple_images/1771602872863708_product.jpg', '2023-07-16 18:29:18', NULL),
(162, 91, 'upload/products/multiple_images/1771603012986390_product.jpg', '2023-07-16 18:31:32', NULL),
(163, 91, 'upload/products/multiple_images/1771603013167199_product.jpg', '2023-07-16 18:31:32', NULL),
(164, 92, 'upload/products/multiple_images/1771603152304397_product.jpg', '2023-07-16 18:33:45', NULL),
(165, 92, 'upload/products/multiple_images/1771603152486437_product.jpg', '2023-07-16 18:33:45', NULL),
(166, 93, 'upload/products/multiple_images/1771603271437576_product.jpg', '2023-07-16 18:35:39', NULL),
(167, 94, 'upload/products/multiple_images/1771603400501732_product.jpg', '2023-07-16 18:37:42', NULL),
(168, 95, 'upload/products/multiple_images/1771603517858359_product.jpg', '2023-07-16 18:39:34', NULL),
(169, 96, 'upload/products/multiple_images/1771603931402028_product.jpg', '2023-07-16 18:46:08', NULL),
(170, 96, 'upload/products/multiple_images/1771603931601614_product.jpg', '2023-07-16 18:46:08', NULL),
(171, 96, 'upload/products/multiple_images/1771603931793168_product.jpg', '2023-07-16 18:46:08', NULL),
(172, 97, 'upload/products/multiple_images/1771605132752445_product.jpg', '2023-07-16 19:05:14', NULL),
(173, 97, 'upload/products/multiple_images/1771605132987601_product.jpg', '2023-07-16 19:05:14', NULL),
(174, 98, 'upload/products/multiple_images/1771605248434799_product.jpg', '2023-07-16 19:07:04', NULL),
(175, 98, 'upload/products/multiple_images/1771605248622152_product.jpg', '2023-07-16 19:07:04', NULL),
(176, 99, 'upload/products/multiple_images/1771605327185846_product.jpg', '2023-07-16 19:08:19', NULL),
(177, 99, 'upload/products/multiple_images/1771605327373263_product.jpg', '2023-07-16 19:08:19', NULL),
(178, 100, 'upload/products/multiple_images/1771605853495646_product.jpg', '2023-07-16 19:16:41', NULL),
(179, 100, 'upload/products/multiple_images/1771605853683492_product.jpg', '2023-07-16 19:16:41', NULL),
(180, 100, 'upload/products/multiple_images/1771605853871688_product.jpg', '2023-07-16 19:16:41', NULL),
(181, 101, 'upload/products/multiple_images/1771606332557995_product.jpg', '2023-07-16 19:24:18', NULL),
(182, 101, 'upload/products/multiple_images/1771606332741271_product.jpg', '2023-07-16 19:24:18', NULL),
(183, 102, 'upload/products/multiple_images/1771606586610263_product.jpg', '2023-07-16 19:28:20', NULL),
(184, 103, 'upload/products/multiple_images/1771606816690615_product.jpg', '2023-07-16 19:32:00', NULL),
(185, 103, 'upload/products/multiple_images/1771606816933874_product.jpg', '2023-07-16 19:32:00', NULL),
(186, 104, 'upload/products/multiple_images/1771607012229158_product.jpg', '2023-07-16 19:35:06', NULL),
(187, 105, 'upload/products/multiple_images/1771607413438260_product.jpg', '2023-07-16 19:41:29', NULL),
(188, 105, 'upload/products/multiple_images/1771607413674483_product.jpg', '2023-07-16 19:41:29', NULL),
(189, 106, 'upload/products/multiple_images/1771608046245512_product.jpg', '2023-07-16 19:51:32', NULL),
(190, 106, 'upload/products/multiple_images/1771608046437694_product.jpg', '2023-07-16 19:51:32', NULL),
(191, 107, 'upload/products/multiple_images/1771608304531160_product.jpg', '2023-07-16 19:55:38', NULL),
(192, 108, 'upload/products/multiple_images/1771608489760007_product.jpg', '2023-07-16 19:58:35', NULL),
(193, 108, 'upload/products/multiple_images/1771608489958884_product.jpg', '2023-07-16 19:58:35', NULL),
(194, 109, 'upload/products/multiple_images/1771609014076011_product.jpg', '2023-07-16 20:06:55', NULL),
(195, 109, 'upload/products/multiple_images/1771609014259349_product.jpg', '2023-07-16 20:06:55', NULL),
(196, 109, 'upload/products/multiple_images/1771609014442653_product.jpg', '2023-07-16 20:06:56', NULL),
(197, 110, 'upload/products/multiple_images/1771609191450355_product.jpg', '2023-07-16 20:09:44', NULL),
(198, 110, 'upload/products/multiple_images/1771609191648010_product.jpg', '2023-07-16 20:09:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `status`, `created_at`, `updated_at`) VALUES
('128e5e58-60bc-49b3-a6d4-ae8e3b60b711', 'App\\Notifications\\OrderCompleteNotification', 'App\\Models\\User', 1, '{\"message\":\"A new order has been placed\",\"type\":\"new_order\"}', '2023-07-17 08:41:32', 1, '2023-07-17 08:40:37', '2023-07-17 08:41:32'),
('3fd26638-04af-411a-86b0-10aa6ec022cb', 'App\\Notifications\\OrderCompleteNotification', 'App\\Models\\User', 1, '{\"message\":\"A new order has been placed\",\"type\":\"new_order\"}', '2023-07-17 08:42:32', 1, '2023-07-17 08:42:26', '2023-07-17 08:42:32'),
('4644b9f9-26d5-48a5-a3fe-b5c802b7e875', 'App\\Notifications\\OrderCompleteNotification', 'App\\Models\\User', 1, '{\"message\":\"A new order has been placed\",\"type\":\"new_order\"}', '2023-07-17 08:50:52', 0, '2023-07-17 08:50:11', '2023-07-17 08:50:52'),
('85d45288-9776-4d0d-92b4-a8e672217bb6', 'App\\Notifications\\OrderCompleteNotification', 'App\\Models\\User', 1, '{\"message\":\"A new order has been placed\",\"type\":\"new_order\"}', '2023-07-17 08:50:52', 0, '2023-07-17 08:49:12', '2023-07-17 08:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picked_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipped_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `return_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_order_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `post_code`, `notes`, `payment_method`, `payment_type`, `transaction_id`, `order_number`, `invoice_number`, `amount`, `discount`, `currency`, `order_date`, `order_day`, `order_month`, `order_year`, `confirmed_date`, `processing_date`, `picked_date`, `shipped_date`, `delivered_date`, `delivered_day`, `delivered_month`, `delivered_year`, `cancel_date`, `cancel_order_status`, `return_date`, `return_reason`, `return_order_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Minh Kiet', 'laiminhkiet07052002@gmail.com', '0793442309', '246, street 8, Ward 6, Vo Gap district, Ho Chi Minh city', '738010', NULL, 'Cash On Delivery', 'Cash On Delivery', NULL, '1771656966960068', 'NFS1689583746826647', 150.00, 0.00, 'usd', '17-07-2023 15:49:06', '17', '07', '2023', '17-07-2023 15:51:01', '17-07-2023 15:51:05', NULL, NULL, '17-07-2023 15:51:09', '17', '07', '2023', NULL, '0', NULL, NULL, '0', 'delivered', '2023-07-17 08:49:06', '2023-07-17 08:51:09'),
(2, 3, 'Minh Kiet', 'laiminhkiet07052002@gmail.com', '0793442309', '246, street 8, Ward 6, Vo Gap district, Ho Chi Minh city', '738005', NULL, 'Stripe Payment', 'Credit Cards', 'cs_test_a14EzjF6VsYQmhH2doNoRojsan5hDpLNHfXYVtC8slLDFlVrUkgMOzSuZW', '1771657026253565', 'NFS1689583804140905', 150.00, 0.00, 'usd', '17-07-2023 15:50:04', '17', '07', '2023', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '0', 'pending', '2023-07-17 08:50:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `brand_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 76, 20.00, '5', '2023-07-17 08:49:06', NULL),
(2, 1, 5, 77, 10.00, '5', '2023-07-17 08:49:06', NULL),
(3, 2, 5, 78, 20.00, '5', '2023-07-17 08:50:04', NULL),
(4, 2, 5, 79, 10.00, '5', '2023-07-17 08:50:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_returns`
--

CREATE TABLE IF NOT EXISTS `order_returns` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_returns_order_id_foreign` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_salaries`
--

CREATE TABLE IF NOT EXISTS `pay_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `salary_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advance_salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_salaries`
--

INSERT INTO `pay_salaries` (`id`, `employee_id`, `salary_month`, `salary_year`, `paid_amount`, `advance_salary`, `due_salary`, `created_at`, `updated_at`) VALUES
(2, 2, 'July', '2023', '1000', '0', '1000', '2023-07-17 05:35:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_measure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_dimensions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturing_date` timestamp NULL DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot_deals` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `special_offer` int(11) DEFAULT NULL,
  `special_deals` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_product_code_unique` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `brand_id`, `category_id`, `subcategory_id`, `product_code`, `product_name`, `product_slug`, `product_thumbnail`, `product_quantity`, `product_tags`, `product_weight`, `product_measure`, `product_dimensions`, `manufacturing_date`, `expiry_date`, `selling_price`, `discount_price`, `short_description`, `long_description`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 4, 1, 2, 17, '11117', 'Watermelon 2.3kg or more', 'watermelon-2.3kg-or-more', 'upload/products/thumbnail/1770857820766929_product_thumbnail.jpg', '100', 'new product', '2', 'Kilogam', NULL, '2023-07-04 17:00:00', '2023-08-07 17:00:00', '30', NULL, 'Watermelon is a fruit rich in water and essential vitamins and minerals, especially low in calories and fat. Watermelon is considered an alternative to regular drinking water.', '<p>Watermelon is a fruit rich in water and essential vitamins and minerals, especially low in calories and fat. Watermelon is considered an alternative to regular drinking water. Sweet melon when the fruit is round, withered, dark green with a yellow tip.</p>', NULL, 1, NULL, NULL, 1, 1, 1, '2023-06-26 10:04:32', '2023-07-17 06:43:43', NULL),
(9, 1, 3, 2, 16, '11110', 'Set of 2 old South American bananas', 'set-of-2-old-south-american-bananas', 'upload/products/thumbnail/1770662009587809_product_thumbnail.jpg', '100', 'new product', '390', 'Mililiter', NULL, '2023-07-05 17:00:00', '2024-07-12 17:00:00', '20', '16', 'Old bananas are favored by many customers. Bananas contain many nutrients such as potassium, fiber, vitamins,... Bananas are best eaten when they are ripe, brown spots on the skin, then the bananas will be very sweet... Commitment to the right volume, packaging discreet, safe and hygienic.', '<p>Old bananas are favored by many customers. Bananas contain many nutrients such as potassium, fiber, vitamins,... Bananas are best eaten when they are ripe, brown spots on the skin, then the bananas will be very sweet... Commitment to the right volume, packaging discreet, safe and hygienic.</p>', NULL, NULL, 1, NULL, 1, 1, 1, '2023-06-26 10:11:40', '2023-07-11 06:24:11', NULL),
(12, 1, 1, 4, 26, '22223', 'Pepsi Cola soft drink bottle 390ml', 'pepsi-cola-soft-drink-bottle-390ml', 'upload/products/thumbnail/1770858330207367_product_thumbnail.jpg', '100', 'new product', '390', 'Mililiter', NULL, '2023-07-07 17:00:00', '2023-09-20 17:00:00', '10', '2', 'From the global famous Pepsi soft drink brand with delicious taste with a mixture of natural flavors and synthetic sweeteners, helping to dispel thirst and fatigue. Pepsi Cola soft drink 390ml replenishes working energy every day. Committed to genuine, quality and safe soft drinks', '<p>From the global famous Pepsi soft drink brand with delicious taste with a mixture of natural flavors and synthetic sweeteners, helping to dispel thirst and fatigue. Pepsi Cola soft drink 390ml replenishes working energy every day. Committed to genuine, quality and safe soft drinks</p>', NULL, NULL, 1, NULL, 1, 1, NULL, '2023-07-08 13:15:07', '2023-07-11 06:24:11', NULL),
(13, 1, 3, 4, 24, '9995', 'Coca Cola soft drink 600ml bottle', 'coca-cola-soft-drink-600ml-bottle', 'upload/products/thumbnail/1770858742096612_product_thumbnail.jpg', '100', 'new product', '600', 'Mililiter', NULL, '2023-06-27 17:00:00', '2023-11-15 17:00:00', '22', '19', 'Expiry date  more than 3 months', '<p>From the brand of soft drinks that are loved by many people with delicious and refreshing taste. Coca Cola soft drink 600ml genuine Coca Cola soft drink with a large amount of gas will help you dispel all feelings of fatigue, stress, bring a sense of comfort after outdoor activities</p>', NULL, NULL, NULL, 1, 1, 1, NULL, '2023-07-08 13:21:40', '2023-07-14 02:35:36', NULL),
(14, 1, 3, 4, 25, '9994', 'Mirinda soft drink with sassafras 390ml bottle', 'mirinda-soft-drink-with-sassafras-390ml-bottle', 'upload/products/thumbnail/1770858981971577_product_thumbnail.jpg', '100', 'new product', '390', 'Mililiter', NULL, '2023-06-28 17:00:00', '2023-12-07 17:00:00', '11', '10', 'Expiry date  more than 3 months', '<p>Soft drinks from the famous Mirinda soft drink brand are popular with many people with attractive flavor and taste. Mirinda sassafras soft drink 390ml bottle has a unique and natural sassafras flavor to help you quickly quench thirst, with a light gas taste, it is a great refreshment drink for all ages.</p>', NULL, NULL, NULL, 1, 1, 1, NULL, '2023-07-08 13:25:29', '2023-07-12 08:10:03', NULL),
(15, 4, 4, 7, 9, '9990', '4KFarm boiled duck eggs box of 4', '4kfarm-boiled-duck-eggs-box-of-4', 'upload/products/thumbnail/1770859413687311_product_thumbnail.jpg', '90', 'new product', '8', 'Gram', NULL, '2023-07-07 17:00:00', '2023-07-14 17:00:00', '15', '11', 'Use during the week', '<p>Box of 4 duck eggs 4KFarm is packed and preserved according to strict standards of hygiene and food safety, ensuring the quality of food. Duck eggs of 4K Farm are round and even. This product is suitable for cooking dishes such as fried eggs, duck egg porridge,...</p>', 1, NULL, 1, NULL, 1, 1, NULL, '2023-07-08 13:32:21', '2023-07-17 06:43:47', NULL),
(16, 1, 4, 7, 10, '7778', 'Fresh quail eggs 4KFarm box of 30 eggs', 'fresh-quail-eggs-4kfarm-box-of-30-eggs', 'upload/products/thumbnail/1770859849710828_product_thumbnail.jpg', '100', 'new product', '10', 'Gram', NULL, '2023-07-07 17:00:00', '2023-07-14 17:00:00', '10', NULL, 'Use during the week', '<p>Boxes of 30 fresh 4KFarm quail eggs from 4KFarm egg brand are packed and preserved according to strict standards of hygiene and food safety, ensuring the quality of food. Quail eggs are round and even. Quail eggs can be boiled and processed into a number of dishes such as smoked quail eggs,...</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-08 13:39:16', '2023-07-11 06:24:11', NULL),
(17, 1, 2, 5, 5, '99933', 'Pedigree Large Dog Food with Chicken Flavored with Sauce 130g', 'pedigree-large-dog-food-with-chicken-flavored-with-sauce-130g', 'upload/products/thumbnail/1770860067635831_product_thumbnail.jpg', '1000', 'new product', '130', 'Gram', NULL, '2023-07-07 17:00:00', '2024-07-07 17:00:00', '22', '14', 'Used for more than 1 year', '<p>Pedigree dog food contains many nutrients and vitamins to help strengthen the dog\'s immune system. Pedigree Large Dog Food with Chicken Flavor 130g is a dog food product with a paste form, you can feed it alone or mix it with your dog\'s current food.</p>', NULL, NULL, NULL, 1, 1, 1, NULL, '2023-07-08 13:42:44', '2023-07-16 14:55:43', NULL),
(18, 1, 2, 5, 5, '99768', 'Natural Core dog food with chicken and salmon 2kg pack', 'natural-core-dog-food-with-chicken-and-salmon-2kg-pack', 'upload/products/thumbnail/1770860304760429_product_thumbnail.jpg', '1000', 'new product', '2', 'Kilogam', NULL, '2023-06-30 17:00:00', '2023-09-08 17:00:00', '20', '10', 'Use more than 3 months', '<p>Natural Core dog food is a famous Korean brand, specializing in dog food products, giving your pet a complete and delicious source of nutrients. Natural Core Chicken and Salmon Dog Food 2kg pack is a great choice for your pet.</p>\r\n<p>Boneless meat (hydrolyzed chicken, hydrolysed salmon, chicken meal) brown rice, sweet potatoes, potatoes, cold seeds, chicken fat, beet pulp, sugar, Yucca extract, fish oil, red ginseng, salt dried, taurinee, sea buckthorn, evening primrose seeds, carrots, coriander, spinach, vitamins and minerals.</p>', 1, NULL, NULL, NULL, 1, 1, NULL, '2023-07-08 13:46:30', '2023-07-16 14:55:43', NULL),
(19, 1, 2, 5, 6, '2002', 'Minino tuna cat food 480g pack', 'minino-tuna-cat-food-480g-pack', 'upload/products/thumbnail/1770860661600586_product_thumbnail.jpg', '1000', 'new product', '10', 'Gram', NULL, '2023-07-07 17:00:00', '2023-11-22 17:00:00', '28', NULL, 'Expiry date more than 4 months', '<p>Product information<br>Cat food is an essential food source because of its convenience and completeness of nutrients. Minino tuna cat food 480g pack with delicious tuna flavor, bringing appetite for cats. Minino cat food is a brand trusted by many people.</p>', NULL, 1, 1, NULL, 1, NULL, NULL, '2023-07-08 13:52:11', '2023-07-16 14:12:29', NULL),
(20, 1, 2, 6, 11, '2003', 'AFC Nutritional Vegetable Cracker 193.8g', 'afc-nutritional-vegetable-cracker-193.8g', 'upload/products/thumbnail/1770861349977899_product_thumbnail.jpg', '100', 'new product', '193.8', 'Gram', NULL, '2023-07-07 17:00:00', '2024-01-25 17:00:00', '9', '8', 'Expiry date more than 6 months', '<p>AFC biscuits with added potatoes, provide energy, protein, fiber, especially vitamin D and calcium to help strengthen bones and at the same time strengthen the digestive system. AFC Nutritional Vegetable Cracker 193.8g is suitable as a nutritious snack cookie for busy people.</p>', 1, NULL, 1, NULL, 1, 1, NULL, '2023-07-08 14:03:07', '2023-07-11 06:24:11', NULL),
(21, 1, 2, 6, 12, '2004', 'Oreo Cookies Chocolate Cream Pack 119.6g', 'oreo-cookies-chocolate-cream-pack-119.6g', 'upload/products/thumbnail/1770861555027314_product_thumbnail.jpg', '100', 'new product', '119.6', 'Gram', NULL, '2023-07-07 17:00:00', '2023-12-13 17:00:00', '4', NULL, 'Expiry date is more than 5 months', '<p><a href=\"https://www.bachhoaxanh.com/banh-quy\">B&aacute;nh quy</a>&nbsp;kẹp kem socola thơm ngon, với lớp vỏ m&agrave;u đen, c&oacute; vị đắng nhẹ nhưng lại ngọt kh&ocirc;ng gắt k&iacute;ch th&iacute;ch vị gi&aacute;c.&nbsp;<a href=\"https://www.bachhoaxanh.com/banh-quy/banh-oreo-vi-kem-chocola-137g\">B&aacute;nh quy Oreo kem socola g&oacute;i 119.6g</a>&nbsp;dinh dưỡng, ngon miệng, vừa ăn vừa chơi.&nbsp;<a href=\"https://www.bachhoaxanh.com/banh-quy-oreo\">B&aacute;nh quy&nbsp;Oreo</a>&nbsp;c&oacute; thể chấm sữa ăn rất th&uacute; vị hoặc l&agrave;m nguy&ecirc;n liệu l&agrave;m b&aacute;nh</p>', 1, NULL, 1, NULL, 1, NULL, NULL, '2023-07-08 14:06:23', '2023-07-11 06:24:11', NULL),
(22, 1, 2, 6, 12, '2005', 'Malkist Crackers Roma Cake 140g', 'malkist-crackers-roma-cake-140g', 'upload/products/thumbnail/1770861736319173_product_thumbnail.jpg', '100', 'new product', '140', 'Gram', NULL, '2023-07-07 17:00:00', '2023-12-07 17:00:00', '13', '10', 'Expiry date is more than 5 months', '<p>Fragrant, crunchy, milky milk biscuits with a thin layer of sugar on top of the cake. Malkist Roma Cookies 140g pack is packed into convenient small packages, easy to carry out, suitable for snacking or enjoying tea. Roma biscuits are made in Indonesia with quality, delicious.</p>', NULL, NULL, NULL, 1, 1, 1, NULL, '2023-07-08 14:09:16', '2023-07-11 06:24:11', NULL),
(23, 1, 5, 3, 4, '2007', 'Squid tablets 5-star kitchen 200g', 'squid-tablets-5-star-kitchen-200g', 'upload/products/thumbnail/1770862037659165_product_thumbnail.jpg', '100', 'new product', '200', 'Gram', NULL, '2023-06-24 17:00:00', '2024-04-07 17:00:00', '50', '30', 'Expiry date is more than 10 months', '<p>The 5 Star Kitchen Squid Ball is made from delicious fresh fish and squid, well seasoned. In addition, the 5-star kitchen ink pellets 500g package also meet food hygiene and safety standards. Therefore, when using, you will feel the full aroma and rich taste in each piece of crispy squid.<br>Ball balls, squid balls, ... are one of the favorite snacks of many people, especially young people. In order to meet and conquer user\'s taste, the 5 Star Kitchen food brand has launched the product 5 Star Kitchen Squid with 200g package to help the menu in your family become richer and more delicious.</p>', 1, NULL, NULL, NULL, 1, 1, NULL, '2023-07-08 14:14:03', '2023-07-16 15:29:24', NULL),
(24, 1, 5, 3, 21, '2008', 'SG Food caviar individual fish balls 250g', 'sg-food-caviar-individual-fish-balls-250g', 'upload/products/thumbnail/1770862502028941_product_thumbnail.png', '100', 'new product', '250', 'Gram', NULL, '2023-07-07 17:00:00', '2024-02-07 17:00:00', '12', '8', 'Expiry date is more than 7 months', '<p>SG Food brand fish ball with a unique recipe, the product ensures to keep the delicious taste of each fish ball. SG Food Caviar Fish Balls 250g box is made from fresh fish ingredients combined with unique caviar filling, easy to prepare fried dishes, sauces, hot pot,...</p>', 1, NULL, NULL, NULL, 1, 1, NULL, '2023-07-08 14:21:26', '2023-07-16 15:29:24', NULL),
(25, 4, 5, 3, 21, '2009', 'Grilled Tuna 300g', 'grilled-tuna-300g', 'upload/products/thumbnail/1770862973179668_product_thumbnail.jpg', '80', 'new product', '300', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-19 17:00:00', '9', NULL, 'Use for 2 days', '<p>Tuna is lean, low in fat, rich in nutrients and essential minerals for health, so many people choose it. Ready-made grilled tuna is convenient, easy to use, delicious taste, suitable for the whole family<br>Advantages of buying grilled tuna at NestShop<br>Delicious grilled tuna, quality, chewy, sweet meat. Tuna is pre-baked, packed in 300g trays, vacuum sealed for easier storage.<br>Tuna is guaranteed of clear origin.<br>Order fast delivery</p>', NULL, NULL, 1, 1, 1, 1, NULL, '2023-07-08 14:28:55', '2023-07-17 06:44:10', NULL),
(26, 1, 4, 1, 13, '2010', 'Broccoli 300g (1 flower)', 'broccoli-300g-(1-flower)', 'upload/products/thumbnail/1770863241100374_product_thumbnail.jpg', '100', 'new product', '300', 'Gram', NULL, '2023-07-07 17:00:00', '2023-07-14 17:00:00', '22', '20', 'Use during the week', '<p>Broccoli is a familiar green vegetable and is loved by many people. Broccoli grown in China is not only delicious, easy to eat, but also brings a lot of health benefits. Broccoli can be processed into steamed broccoli, saut&eacute;ed broccoli, broccoli soup, ...<br>Advantages of buying broccoli at Bach Hoa Xanh<br>Broccoli is fresh, delicious, and is a popular vegetable. Broccoli has small green flowers that grow tightly together, surrounded by a protective layer of hard leaves. Broccoli is sweet, crispy and nutritious.<br>Broccoli is guaranteed to have a clear origin, selling in a 300g bag of about 1 flower.<br>Order fast delivery</p>', NULL, 1, NULL, NULL, 1, 1, NULL, '2023-07-08 14:33:11', '2023-07-16 14:43:24', NULL),
(27, 1, 4, 1, 13, '2011', 'Broccol white ready-made tray 300g', 'broccol-white-ready-made-tray-300g', 'upload/products/thumbnail/1770863699172020_product_thumbnail.jpg', '100', 'new product', '300', 'Gram', NULL, '2023-07-07 17:00:00', '2023-07-14 17:00:00', '16', '15', 'Use during the week', '<p>Cabbage ready-made tray 300g includes: Broccoli,... This is an extremely healthy vegetable, containing many important nutrients. Products are fresh, quality, ensure food safety, are packed in a clean pre-processing tray. Very suitable for busy families with no time, convenience.</p>', NULL, 1, NULL, NULL, 1, 1, NULL, '2023-07-08 14:40:28', '2023-07-16 14:43:24', NULL),
(28, 1, 4, 1, 14, '9998', 'Spinach 300g', 'spinach-300g', 'upload/products/thumbnail/1770864052219367_product_thumbnail.jpg', '100', 'new product', '300', 'Gram', NULL, '2023-07-09 17:00:00', '2023-07-10 17:00:00', '3', '2', 'Use for 3 days', '<p>Với c&ocirc;ng dụng tuyệt vời, rau cải b&oacute; x&ocirc;i c&oacute; thể chống ung thư, chống vi&ecirc;m, ngăn ngừa bệnh tuyến tiền liệt, hỗ trợ giảm c&acirc;n, l&agrave;m đẹp da, s&aacute;ng mắt,.... Cải b&oacute; x&ocirc;i của B&aacute;ch h&oacute;a xanh được trồng tại Đ&agrave; Lạt tự tin mang đến cho bạn những m&oacute;n ăn đầy đủ dinh dưỡng, hấp dẫn v&agrave; thanh m&aacute;t.<br>Ưu điểm khi mua cải b&oacute; x&ocirc;i tại NestShop</p>\r\n<p>Rau cải b&oacute; x&ocirc;i tươi ngon, chất lượng, được đ&oacute;ng trong t&uacute;i kh&iacute; gi&uacute;p bảo quản rau tốt hơn khi vận chuyển, kh&ocirc;ng bị dập, hư rau.<br>Rau cải được đảm bảo nguồn gốc xuất xứ r&otilde; r&agrave;ng, đ&oacute;ng g&oacute;i 300g.<br>Đặt giao h&agrave;ng nhanh</p>', NULL, NULL, NULL, 1, 1, 1, NULL, '2023-07-08 14:46:04', '2023-07-16 14:43:24', NULL),
(29, 1, 4, 2, 8, '33344', 'Strawberry 1kg', 'strawberry-1kg', 'upload/products/thumbnail/1770869004372000_product_thumbnail.jpg', '100', 'new product', '1', 'Kilogam', NULL, '2023-07-07 17:00:00', '2023-07-14 17:00:00', '45', '32', 'Use during the week', '<p>Strawberry (scientific name: Fragaria &times; ananassa) is a genus of angiosperms and flowering plants in the Rose family (Rosaceae). Strawberries originated in the Americas and were bred by European gardeners in the 18th century to create the variety of strawberry that is widely grown today. This shoulder was first scientifically described by (Weston) Duchesne in 1788. This fruit is appreciated by many people for its characteristic aroma, bright red color, succulent and sweet taste. It is consumed in large quantities, either consumed as fresh berries or made into jams, juices, pies, ice cream, lotions and chocolates. Artificial strawberry flavorings and ingredients are also widely used in products such as candy, soap, lip gloss, perfume, and many others.</p>', NULL, NULL, 1, NULL, 1, 1, 1, '2023-07-08 14:51:48', '2023-07-16 12:22:54', NULL),
(30, 1, 4, 2, 7, '99912', 'Ninh Thuan red grapes 500g', 'ninh-thuan-red-grapes-500g', 'upload/products/thumbnail/1770864602731225_product_thumbnail.jpg', '100', 'new product', '500', 'Gram', NULL, '2023-07-07 17:00:00', '2023-07-14 17:00:00', '25', '15', 'Use during the week', '<p>Product information<br>Red grapes have thick succulent flesh, sweet and sour taste in harmony, is a fruit that many people love on summer days. Ninh Thuan red grapes bring many health benefits, sweet grapes when they have purple-red, dark, evenly ripened, firm, berry skins.</p>', 1, NULL, NULL, NULL, 1, 1, NULL, '2023-07-08 14:54:49', '2023-07-16 14:31:10', NULL),
(31, 1, 1, 4, 27, '77645', 'C2 Green Tea Lemon Flavor 360ml', 'c2-green-tea-lemon-flavor-360ml', 'upload/products/thumbnail/1770866620467374_product_thumbnail.jpg', '100', 'new product', '360', 'Mililiter', NULL, '2023-07-07 17:00:00', '2024-03-07 17:00:00', '8', NULL, 'Expiry date more than 8 months', '<p>Extracted from natural green tea leaves from the highlands of Vietnam, blended with fresh lemon flavor, it gives you a great refreshing drink on hot days. Green tea contains high levels of antioxidants, which help you stay active and excited.<br>C2 is a brand of bottled tea very familiar to Vietnamese consumers, C2 Tea is distilled from 100% natural green tea in the highlands of Vietnam, processed and bottled on the same day according to international standards, helping ensure the freshness and purity of the tea. C2 tea has many delicious flavors and affordable price, is the first choice of consumers.</p>\r\n<p>C2 Green Tea Lemon Flavor 360ml is a bottled tea product from C2 tea brand. Extracted from natural green tea leaves from the highlands of Vietnam, blended with fresh lemon flavor, it gives you a great refreshing drink on hot days. Green tea contains high levels of antioxidants, which help you stay active and excited.</p>', NULL, 1, 1, NULL, 1, 1, NULL, '2023-07-08 15:26:54', '2023-07-16 14:31:10', NULL),
(32, 1, 4, 2, 7, '73432', 'American seedless black grapes 1kg', 'american-seedless-black-grapes-1kg', 'upload/products/thumbnail/1770868933243138_product_thumbnail.jpg', '100', 'new product', '1', 'Kilogam', NULL, '2023-07-07 17:00:00', '2023-07-14 17:00:00', '30', '22', 'Use during the week', '<p>Information<br>American seedless black currants are native to California, Oregon, and Washington, where the climate is warm and dry. With a variety of strains: Autumn royal, Midnight Beauty, Sugrathirteen, Summer Roya and Autumn royal are the tastier ones.</p>\r\n<p>American seedless black grapes have conquered and enjoyed worldwide popularity. In Vietnam, at imported fruit stores you will easily see it from May to January next year.<br>Characteristic</p>\r\n<p>Seedless black grapes are oblong, dark black, thin skinned. Eat very sweet but still have a cool taste, especially without seeds</p>\r\n<p>The characteristics are also a way for consumers to know how to distinguish from China\'s toxic grape products.</p>\r\n<p>3. Nutrition and health</p>\r\n<p>Black currant is a fruit that is very nutritious, has the effect of tonic, useful gas, helps the body healthy, good immunity and slows down the aging process.</p>\r\n<p>- Calcium, potassium, phosphorus, iron, vitamins B1, B2, B6, C and essential amino acids are good for people with neurasthenia and beneficial for digestion.</p>\r\n<p>- Resveratrol compound in American meatless black currant, especially the skin, helps detoxify well, reduce fatty blood, fight blood clots, prevent atherosclerosis and strengthen the body\'s immune system.</p>', 1, NULL, NULL, NULL, 1, 1, 1, '2023-07-08 16:03:39', '2023-07-16 14:31:10', NULL),
(33, 1, 1, 4, 26, '2705', 'Pepsi Cola soft drink can 320ml', 'pepsi-cola-soft-drink-can-320ml', 'upload/products/thumbnail/1770869250027177_product_thumbnail.jpg', '100', 'new product', '320', 'Mililiter', NULL, '2023-07-07 17:00:00', '2024-04-07 17:00:00', '3', NULL, 'Expiry date  more than 11 months', '<p>Product information<br>Products from the global famous Pepsi soft drink brand with delicious taste with a mixture of natural flavors and synthetic sweeteners, help dispel thirst and fatigue. Pepsi Cola soft drink 320ml can replenish working energy every day. Committed to genuine, quality and safe soft drinks<br>About Pepsi brand<br>Pepsi is a global famous beverage giant, the world\'s leading soft drink brand that almost everyone knows, this brand has a history of establishment since 1893 in North Carolina, USA.</p>\r\n<p>Pepsi is a globally famous brand of carbonated Cola-flavored beverage, which inherits many long-standing historical values. In Vietnam, proud to be a brand that represents the voice of young people with the message \"Stay young, keep quality, keep PEPSI\", we always seek to bring the ultimate refreshing experiences, encouraging encourage young people to capture and enjoy every exciting moment of life.</p>\r\n<p>Soft drinks with Gaz Pepsi with attractive cola flavor, bring refreshing feeling, instant cooling in hot days. Served directly, it tastes better when chilled, or served with ice.</p>\r\n<p>Pepsi officially entered the Vietnamese beverage market in 1994 and received the favorite wave of users, especially young people. Currently, Pepsi has many product lines with flavors suitable for many customers such as Pepsi Cola, Pepsi Light, Pepsi no calories, ...</p>', 1, NULL, NULL, NULL, 1, 1, 1, '2023-07-08 16:08:41', '2023-07-16 14:31:10', NULL),
(34, 4, 5, 3, 21, '77947', 'Dongwon Vegetable Tuna 150g', 'dongwon-vegetable-tuna-150g', 'upload/products/thumbnail/1770869571660050_product_thumbnail.jpg', '70', 'new product', '150', 'Gram', NULL, '2023-07-07 17:00:00', '2024-05-07 17:00:00', '10', '9', 'Expiry date is more than 10 months', '<p>Product information<br>Dongwon vegetable tuna canned 150g from Korea is a great combination of fresh vegetables with fatty tuna, the sweetness of tuna mixed with soft cooked vegetables to create a delicious dish. Tasty, delicious and full of nutrition.<br>Dongwon canned fish brand from Korea brings you Dongwon vegetable tuna canned 150g. This is a delicious and convenient canned fish combined with vegetables.</p>\r\n<p>Natural ingredients<br>Products are made with natural ingredients such as tuna, cabbage, potatoes, carrots, sweet corn, peas, red chili sauce, tomato sauce... safe for your family\'s health.<br>The snap-on tin can make it easier to use. The 150g small box is more convenient and economical, suitable for meals from 2-3 people.</p>', NULL, NULL, 1, NULL, 1, 1, 1, '2023-07-08 16:13:48', '2023-07-17 06:44:13', NULL),
(40, 1, 4, 1, 14, '171718', 'Onion 300g (2 - 3 bulbs)', 'onion-300g-(2---3-bulbs)', 'upload/products/thumbnail/1771000266668586_product_thumbnail.jpg', '100', 'new product', NULL, 'Gram', NULL, '2023-07-10 17:00:00', '2025-07-13 17:00:00', '30', '26', 'Onion originating in China is a common root used in many Vietnamese and worldwide dishes. This vegetable contains quite a lot of vitamins and minerals that are beneficial for health. Onions can be fried, sautéed, grilled or eaten raw.', '<p>Onions are tubers that grow underground, are grown worldwide, and are closely related to chives, garlic, and green onions. This is a key ingredient in many dishes, processed in a variety of ways, from baking, boiling, frying, roasting, stir-frying, rolling dough or even eating raw. Onions contain a lot of vitamins and minerals with health benefits such as: helping to regulate blood sugar, improve bone health, prevent cancer, strengthen the immune system, ...</p>\r\n<p>How to prepare onions<br>- Wash the onion with water.<br>- Use a peeler knife.<br>- Cut areca, circle, small sharp depending on the dish you prepare.<br>- To reduce the pungent taste, soak in a bowl of water mixed with a little lemon or vinegar for 15 minutes.<br>To make the onions crispy, soak the onions in cold water for 30 minutes.<br>Reference: Ways to cut onions without worrying about burning eyes.<br>Dishes made with onions<br>- Stir-fried chicken with onions in a strange mouth, bring rice.<br>- Crispy with fried squid with onion.<br>- Stir-fried beef with onions, soft and delicious.<br>- French onion soup.<br>In addition to being used as a dish, onions are also used to clean the house, clean the grill, remove all stains on the white shirt, ...<br>Note: The product received may be different from the picture in color and quantity, but it is still guaranteed in terms of volume and quality.</p>', 1, NULL, NULL, NULL, 1, 1, NULL, '2023-07-10 02:51:09', '2023-07-16 14:37:07', NULL),
(41, 1, 1, 4, 27, '1qa2ws', 'Box of 24 bottles of C2 peach red tea 455ml', 'box-of-24-bottles-of-c2-peach-red-tea-455ml', 'upload/products/thumbnail/1771182415866662_product_thumbnail.jpg', '100', 'new product', '455', 'Mililiter', NULL, '2023-07-11 17:00:00', '2025-07-11 17:00:00', '20', NULL, 'C2 tea is distilled from 100% natural tea, processed and bottled in the same day, providing a great tea flavor. The box of 24 bottles of C2 peach red tea 455ml gives you a new choice in enjoying tea, helping to quench thirst, replenishing energy for a long, active and refreshing day.', '<p>About the C2 . brand<br>C2 is a brand of bottled tea very familiar to Vietnamese consumers, C2 Tea is distilled from 100% natural green tea in the highlands of Vietnam, processed and bottled on the same day according to international standards, helping ensure the freshness and purity of the tea. C2 tea has many delicious flavors and affordable price, is the first choice of consumers.</p>\r\n<p>Box of 24 bottles of C2 peach red tea 455ml 0<br>Nutritional composition of C2 peach red tea 455ml<br>The product is made from naturally fermented tea leaves with a strong tea flavor mixed with the light, sweet taste of peaches.</p>\r\n<p>Ingredients contain protein, fat, protein, vitamin B, vitamin C, vitamin B1, and many minerals necessary for the body.</p>\r\n<p>The product\'s energy level is about 47 calories/100ml</p>\r\n<p>Uses of the product for health<br>Delicious beverage</p>\r\n<p>Fresh flavors for active days</p>\r\n<p>Rich in antioxidants to help beautify the skin, prevent aging,...</p>\r\n<p><br>How to store and note about products<br>To a dry, cool place</p>\r\n<p>Avoid exposure to direct sunlight</p>\r\n<p>Tastes better when cold, shake well before drinking</p>\r\n<p>Do not drink close to bedtime at night</p>\r\n<p>Do not use expired products with strange odors</p>', 1, NULL, NULL, NULL, 1, 1, NULL, '2023-07-12 03:06:19', '2023-07-16 15:29:24', NULL),
(42, 4, 7, 10, 28, '1221zx', 'TH true MILK pure fresh milk without sugar, 220ml bag', 'th-true-milk-pure-fresh-milk-without-sugar,-220ml-bag', 'upload/products/thumbnail/1771374784319698_product_thumbnail.jpg', '60', 'new product', '220', 'Mililiter', NULL, '2023-07-13 17:00:00', '2025-07-13 17:00:00', '20', '15', 'TH True Milk ensures no added flavoring, has the delicious taste of 100% pure fresh milk, contains many vitamins and minerals such as Vitamins A, D, B1, B2, calcium, zinc. TH true MILK pure fresh milk without sugar, 220ml, delicious taste from pure fresh milk', '<p class=\"MsoNormal\">About the brand</p>\r\n<p class=\"MsoNormal\">TH True Milk is one of the leading prominent dairy and dairy product manufacturers in Vietnam today. First launched to consumers in December 2010, TH True Milk is still proud of products that meet food safety standards, which are very popular with consumers thanks to providing a complete source of nutrition. entirely from fresh cow\'s milk, quality and safety.</p>\r\n<p class=\"MsoNormal\">Nutritional composition of the product</p>\r\n<p class=\"MsoNormal\">The product is made from 100% pure cow\'s milk. In addition, the product provides about 60 kcal per 100ml of milk.</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">TH True Milk is made entirely from clean fresh milk at TH\'s farms and does not use added sugar. Since then, the product not only retains the full delicious and greasy taste but also contains a lot of nutrients such as vitamins A, D, B1, B2, Calcium, zinc ... good for bones and the immune system.</p>\r\n<p class=\"MsoNormal\">TH true MILK pure fresh milk without sugar, 220ml bag</p>\r\n<p class=\"MsoNormal\">User manual</p>\r\n<p class=\"MsoNormal\">Drink it directly</p>\r\n<p class=\"MsoNormal\">Better when chilled</p>\r\n<p class=\"MsoNormal\">Use for 1 time drink</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Store in a cool, dry place, away from direct sunlight.</p>\r\n<p class=\"MsoNormal\">Should be used up after opening, if stored in the refrigerator, should be used up within 3 days</p>\r\n<p class=\"MsoNormal\">TH true MILK pure fresh milk without sugar, 220ml bag</p>\r\n<p class=\"MsoNormal\">Delicious dishes from the product</p>\r\n<p class=\"MsoNormal\">With unsweetened fresh milk, you can use it as the perfect source of ingredients for delicious and nutritious dishes and drinks such as:</p>\r\n<p class=\"MsoNormal\">Cheese yogurt dish</p>\r\n<p class=\"MsoNormal\">Italian panna cotta</p>\r\n<p class=\"MsoNormal\">Smooth potato soup</p>\r\n<p class=\"MsoNormal\">Milk tea dish</p>\r\n<p class=\"MsoNormal\">Fried ice cream</p>\r\n<p class=\"MsoNormal\">Hot milk cocoa</p>\r\n<p class=\"MsoNormal\">Advantages when buying products at Bach Hoa XANH</p>\r\n<p class=\"MsoNormal\">TH True Milk fresh milk product line is currently available for sale at Bach Hoa Xanh with good price, 100% guaranteed to be of origin from the manufacturer, safe for users. You can buy products online through the app or website to receive many incentives with fast delivery service.</p>', 1, 1, 1, 1, 1, 1, NULL, '2023-07-14 06:03:56', '2023-07-17 06:44:16', NULL),
(43, 4, 1, 4, 26, '1qwq12', 'Pepsi soft drink without calories lemon flavor bottle 390ml', 'pepsi-soft-drink-without-calories-lemon-flavor-bottle-390ml', 'upload/products/thumbnail/1771479742874320_product_thumbnail.png', '50', 'new product', '390', 'Mililiter', NULL, '2023-07-14 17:00:00', '2025-07-14 17:00:00', '5', NULL, 'The product is a harmonious combination of fresh lemon, delicious taste to bring an attractive cooling drink. Pepsi soft drink without calories lemon flavor genuine 390ml bottle Pepsi soft drink is the ideal soft drink choice for people with a frugal, low-sugar lifestyle', '<p>About Pepsi brand<br>Pepsi was born in 1893 in the US, invented by pharmacist Caleb Bradham with the original name Brand\'s Drink. Pepsi is world-famous for its humorous sweet and sour cola flavor, and a refreshing burst of gas. Pepsi is currently a popular soft drink in more than 200 countries and territories with more than 1 billion uses per day.</p>\r\n<p>In 1994, Pepsi officially entered the Vietnamese market and quickly gained a certain position in the market, now in addition to the traditional Pepsi flavor, Pepsi also launches many product lines with healthy and healthy trends. like Pepsi Light, Pepsi no calories, Pepsi no calories lemon flavor</p>', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-15 09:52:13', '2023-07-17 06:44:20', NULL),
(44, 1, 3, 4, 24, '43345', '6 bottles of Coca Cola Zero carbonated soft drink 390ml', '6-bottles-of-coca-cola-zero-carbonated-soft-drink-390ml', 'upload/products/thumbnail/1771594416208199_product_thumbnail.jpg', '80', 'new product', '390', 'Mililiter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '15', '5', 'Product used for more than 1 year', '<p class=\"MsoNormal\">World famous soft drinks are popular in many countries. 6 bottles of genuine Coca Cola Zero 390ml soft drink Coca Cola makes the body feel lighter, eats better, no sugar, no calories, suitable for those who love soft drinks but still want to keep healthy eating habits.Launched in 2005, the sugar that Coca Zero uses is Sucralose. This substance is about 600 times sweeter than regular sugar.</p>\r\n<p class=\"MsoNormal\">However, our body only absorbs 27% of sugar, the rest will be excreted. That\'s why you can safely relieve your sweet tooth without having to worry about the amount of sugar you absorb. According to drinkers, Coca Zero has a strong sweet taste that is almost the same as the original. After drinking, if the original left a slightly sour aftertaste in the mouth, Coca Zero is a sweet taste in the throat, so strange, isn\'t it?</p>', 1, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 16:14:54', NULL, NULL),
(45, 1, 3, 4, 24, '1876', '6 cans of Coca Cola soft drink 235ml', '6-cans-of-coca-cola-soft-drink-235ml', 'upload/products/thumbnail/1771594773496406_product_thumbnail.jpg', '90', 'new product', '235', 'Mililiter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '12', '10', 'Product used for more than 1 year', '<p class=\"MsoNormal\">From the brand of soft drinks that are loved by many people with delicious and refreshing taste. 6 cans of Coca Cola soft drink genuine 235ml Coca Cola soft drink with a large amount of gas will help you dispel all feelings of fatigue, stress, and bring comfort after outdoor activities.</p>\r\n<p class=\"MsoNormal\">Coca Cola is a world famous soft drink brand, was born in the US in 1886 and quickly developed into a powerful multinational corporation in the world soft drink market.</p>\r\n<p class=\"MsoNormal\">Currently, Coca Cola has been present and loved in more than 200 countries around the world with its sweet and sour taste, sweet and sour cola, attractive gas and pleasant aroma.</p>\r\n<p class=\"MsoNormal\">In addition to the Coca Original line, this brand also develops many new product lines that are suitable for the needs and concerns of users\' health and weight with low-sugar and lower-calorie products such as Coca Zero, Coca Light, Coca Plus,...</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Coca Cola\'s original location is made from dependent ingredients, including CO2 saturated water, sugar, sugar cane, natural colors, added caffeine and signature Coca flavor</p>\r\n<p class=\"MsoNormal\">The nutritional ingredients in Original Coca include sugar, carbohydrates and sodiumThe calorific value of the product is about 42 calories/100ml.</p>', NULL, 1, 1, NULL, 1, NULL, NULL, '2023-07-16 16:20:34', NULL, NULL),
(46, 1, 3, 4, 24, '2655', '6 bottles of Coca Cola soft drink 390ml', '6-bottles-of-coca-cola-soft-drink-390ml', 'upload/products/thumbnail/1771594928656767_product_thumbnail.jpg', '80', 'new product', '390', 'Mililiter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '40', '38', 'Product used for more than 1 year', '<p class=\"MsoNormal\">About the brand</p>\r\n<p class=\"MsoNormal\">Coca-Cola soft drink (also known as Coca, Coke) is the world\'s leading prestigious brand of the Coca-Cola Company. The company was established in 1893 in the US, with a long journey in the field of soft drinks, Coca-Cola is loved by many people with its delicious and attractive taste.</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">In 100ml of Coca-Cola soft drink there are:</p>\r\n<p class=\"MsoNormal\">10.5g carbohydrates</p>\r\n<p class=\"MsoNormal\">10.5g sugar</p>\r\n<p class=\"MsoNormal\">23mg Sodium</p>\r\n<p class=\"MsoNormal\">Provides the body 42 kcal</p>\r\n<p class=\"MsoNormal\">Health effects</p>\r\n<p class=\"MsoNormal\">6 bottles of Coca Cola 390ml soft drink not only help quench thirst but also provide energy and abundant mineral content, allowing you to rekindle your excitement from the first sip.</p>\r\n<p class=\"MsoNormal\">With a traditional Cola flavor that brings a feeling of refreshment and instant cooling, Coca Cola beverage with a large amount of gas will help you quickly dispel all feelings of fatigue and stress, especially suitable for use with activities. outdoor movement. In addition, the product is designed in a convenient can, easy to store as well as carry in picnics, competitions, sports training ...</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 16:23:02', NULL, NULL),
(47, 1, 3, 4, 25, '54344', '12 bottles of Mirinda orange flavored soft drink 390ml', '12-bottles-of-mirinda-orange-flavored-soft-drink-390ml', 'upload/products/thumbnail/1771595069519777_product_thumbnail.jpg', '70', 'new product', '390', 'Mililiter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '48', '40', 'Product used for more than 1 year', '<p class=\"MsoNormal\">About the product</p>\r\n<p class=\"MsoNormal\">In the ever-growing and diversified market of carbonated beverages, Mirinda is always proud of being a famous carbonated beverage brand that is always loved and trusted by all ages.</p>\r\n<p class=\"MsoNormal\">Produced on modern technological lines, ensuring hygiene and safety for consumers\' health. The product has a sweet taste and attractive orange flavor combined with a light gas taste. Mirinda orange is always a great choice to quench thirst, full of energy.</p>\r\n<p class=\"MsoNormal\">Design: 390ml bottle</p>\r\n<p class=\"MsoNormal\">Quantity: 24 bottles/carton</p>\r\n<p class=\"MsoNormal\">HSD: 12 months from date of manufacture</p>\r\n<p class=\"MsoNormal\">More delicious cold drink. Store in a clean, dry, cool place, away from sunlight.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 16:25:17', NULL, NULL),
(48, 1, 3, 4, 25, '76543', '12 bottles of Mirinda sassafrass soft drink 390ml', '12-bottles-of-mirinda-sassafrass-soft-drink-390ml', 'upload/products/thumbnail/1771595188681098_product_thumbnail.jpg', '60', 'new product', '390', 'Mililiter', NULL, NULL, NULL, '44', '40', 'Product used for more than 1 year', '<p class=\"MsoNormal\">About the product</p>\r\n<p class=\"MsoNormal\">In the ever-growing and diversified market of carbonated beverages, Mirinda is always proud of being a famous carbonated beverage brand that is always loved and trusted by all ages.</p>\r\n<p class=\"MsoNormal\">Produced on modern technological lines, ensuring hygiene and safety for consumers\' health. The product has a sweet taste and attractive orange flavor combined with a light gas taste. Mirinda orange is always a great choice to quench thirst, full of energy.</p>\r\n<p class=\"MsoNormal\">Design: 390ml bottle</p>\r\n<p class=\"MsoNormal\">Quantity: 24 bottles/carton</p>\r\n<p class=\"MsoNormal\">HSD: 12 months from date of manufacture</p>\r\n<p class=\"MsoNormal\">More delicious cold drink. Store in a clean, dry, cool place, away from sunlight.</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 16:27:10', NULL, NULL),
(49, 1, 1, 4, 26, '5434', 'Box of 24 cans of Pepsi Cola soft drink 320ml', 'box-of-24-cans-of-pepsi-cola-soft-drink-320ml', 'upload/products/thumbnail/1771596443745438_product_thumbnail.jpg', '50', 'new product', '320', 'Mililiter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '44', '40', 'Product used for more than 1 year', '<p class=\"MsoNormal\">About Pepsi brand</p>\r\n<p class=\"MsoNormal\">Pepsi is a globally famous brand of carbonated Cola-flavored beverage, which inherits many long-standing historical values. In Vietnam, proud to be a brand that represents the voice of young people with the message \"Stay young, keep quality, keep PEPSI\", we always seek to bring the ultimate refreshing experiences, encouraging encourage young people to capture and enjoy every exciting moment of life.</p>\r\n<p class=\"MsoNormal\">Soft drinks with Gaz Pepsi with attractive cola flavor, bring refreshing feeling, instant cooling in hot days. Served directly, it tastes better when chilled, or served with ice.</p>\r\n<p class=\"MsoNormal\">Pepsi has been present in Vietnam since 1994 and quickly gained popularity especially among children and young people. Pepsi is suitable as a refreshing drink, used when eating fried chicken, french fries, popcorn, ... or other foods that cause indigestion, ...</p>\r\n<p class=\"MsoNormal\">In addition to the traditional Pepsi cola flavor currently on the market, there are Pepsi Light lines, Pepsi no calories, Pepsi no calories lemon flavor, ... are very popular.</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Pepsi Cola is created from the main ingredients are CO2 saturated water, sugar, natural flavor,...adding sodium and carbohydrates to the body.</p>\r\n<p class=\"MsoNormal\">The energy in the product is about 140 calories</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Beverages</p>\r\n<p class=\"MsoNormal\">Stimulate your taste buds to make you feel more delicious</p>\r\n<p class=\"MsoNormal\">Beneficial for the digestive system, helping to lighten the stomach</p>\r\n<p class=\"MsoNormal\">Provide energy to the body, bring relaxation, refreshment</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Do not put in the freezer compartment</p>\r\n<p class=\"MsoNormal\">Served directly, it tastes better when chilled, or served with ice. More delicious cold drink.</p>\r\n<p class=\"MsoNormal\">Store in a clean, dry, cool place, away from sunlight.</p>\r\n<p class=\"MsoNormal\">HSD: 12 months from date of manufacture</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 16:47:07', NULL, NULL),
(50, 1, 1, 4, 26, '12654', '6 bottles of Pepsi Cola soft drink 390ml', '6-bottles-of-pepsi-cola-soft-drink-390ml', 'upload/products/thumbnail/1771596602140408_product_thumbnail.jpg', '40', 'new product', '390', 'Mililiter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '39', '35', 'Product used for more than 1 year', '<p class=\"MsoNormal\">: About Pepsi brand</p>\r\n<p class=\"MsoNormal\">Pepsi is a globally famous brand of carbonated Cola-flavored beverage, which inherits many long-standing historical values. In Vietnam, proud to be a brand that represents the voice of young people with the message \"Stay young, keep quality, keep PEPSI\", we always seek to bring the ultimate refreshing experiences, encouraging encourage young people to capture and enjoy every exciting moment of life.</p>\r\n<p class=\"MsoNormal\">Soft drinks with Gaz Pepsi with attractive cola flavor, bring refreshing feeling, instant cooling in hot days. Served directly, it tastes better when chilled, or served with ice.</p>\r\n<p class=\"MsoNormal\">Pepsi has been present in Vietnam since 1994 and quickly gained popularity especially among children and young people. Pepsi is suitable as a refreshing drink, used when eating fried chicken, french fries, popcorn, ... or other foods that cause indigestion, ...</p>\r\n<p class=\"MsoNormal\">In addition to the traditional Pepsi cola flavor currently on the market, there are Pepsi Light lines, Pepsi no calories, Pepsi no calories lemon flavor, ... are very popular.</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Pepsi Cola is created from the main ingredients are CO2 saturated water, sugar, natural flavor,...adding sodium and carbohydrates to the body.</p>\r\n<p class=\"MsoNormal\">The energy in the product is about 140 calories</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Beverages</p>\r\n<p class=\"MsoNormal\">Stimulate your taste buds to make you feel more delicious</p>\r\n<p class=\"MsoNormal\">Beneficial for the digestive system, helping to lighten the stomach</p>\r\n<p class=\"MsoNormal\">Provide energy to the body, bring relaxation, refreshment</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Do not put in the freezer compartment</p>\r\n<p class=\"MsoNormal\">Served directly, it tastes better when chilled, or served with ice. More delicious cold drink.</p>\r\n<p class=\"MsoNormal\">Store in a clean, dry, cool place, away from sunlight.</p>\r\n<p class=\"MsoNormal\">HSD: 12 months from date of manufacture</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 16:49:38', NULL, NULL),
(51, 4, 5, 1, 15, '125654', 'Jade Leaf Plain Rice Starch 400g pack', 'jade-leaf-plain-rice-starch-400g-pack', 'upload/products/thumbnail/1771596709740963_product_thumbnail.jpg', '40', 'new product', '400', 'Gram', NULL, '2023-07-15 17:00:00', '2025-07-15 17:00:00', '20', '19', 'Use more than 2 years', '<p class=\"MsoNormal\">Rice starch helps you process into porridge, tea, cake, ... very delicious and attractive. Jade Leaf Plain Rice Starch 400g convenient, high quality, clean, white powder. Jade Leaf Dry Powder is made in Thailand with quality rice, bringing you quality and safe products.</p>', NULL, 1, NULL, NULL, 1, 1, NULL, '2023-07-16 16:51:21', '2023-07-17 06:44:24', NULL),
(52, 1, 5, 1, 15, '12987', 'Tai Ky pancake flour 1kg pack', 'tai-ky-pancake-flour-1kg-pack', 'upload/products/thumbnail/1771596836243629_product_thumbnail.jpg', '30', 'new product', '1', 'Kilogam', NULL, '2023-07-15 17:00:00', '2025-07-15 17:00:00', '15', '10', 'Use more than 2 years', '<p><span style=\"font-size: 13.0pt; line-height: 150%; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Yu Mincho\'; mso-fareast-theme-font: minor-fareast; mso-ansi-language: EN-US; mso-fareast-language: JA; mso-bidi-language: AR-SA;\">Pancake flour with safe ingredients, familiar with rice starch, corn starch, wheat flour, coconut milk, tapioca starch, turmeric powder, iodized salt, ... safe and quality. Tai Ky pancake powder with coconut milk, packed in 1kg, is processed into scrumptious, delicious pancakes. </span></p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 16:53:21', NULL, NULL),
(53, 4, 3, 4, 24, '1265', '6 bottles of Coca Cola soft drink 1.5l', '6-bottles-of-coca-cola-soft-drink-1.5l', 'upload/products/thumbnail/1771597048902779_product_thumbnail.jpg', '30', 'new product', '1.5', 'Liter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '44', '4', 'Product used for more than 1 year', '<p class=\"MsoNormal\">About the brand</p>\r\n<p class=\"MsoNormal\">Famous for a long time and as one of the famous soft drink companies, Coca Cola offers users a variety of delicious soft drinks, a variety of choices. More specifically, Coca Cola also launched sugar-reduced, zero-calorie soft drinks,... to help protect the health and safety of consumers.</p>\r\n<p class=\"MsoNormal\">6 bottles of original Coca Cola soft drink (reduced sugar) 1.5 liter bottle 0</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Soft drinks are a source of energy, carbohydrates, sugar and some other substances for the body. According to the information on the ingredient list clearly printed on the body of the can, in 100ml of the product will provide about 31 kcal.</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Some of the outstanding health benefits of the product include:</p>\r\n<p class=\"MsoNormal\">Power supply</p>\r\n<p class=\"MsoNormal\">Added sugar</p>\r\n<p class=\"MsoNormal\">Digestive system support</p>\r\n<p class=\"MsoNormal\">Reduce feeling of fullness, indigestion</p>\r\n<p class=\"MsoNormal\">Improve mood</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Carbonated soft drinks are usually stored in a cool, dry place, avoiding placing the product in a place with high temperature. Soft drinks will taste better when you serve them cold or with ice. Avoid handling water cans with strong shocks.</p>\r\n<p class=\"MsoNormal\">Note: Do not use when you are allergic to product ingredients, expired products or show signs of damage.</p>', NULL, NULL, 1, NULL, 1, 1, NULL, '2023-07-16 16:56:44', '2023-07-17 06:43:59', NULL);
INSERT INTO `products` (`id`, `supplier_id`, `brand_id`, `category_id`, `subcategory_id`, `product_code`, `product_name`, `product_slug`, `product_thumbnail`, `product_quantity`, `product_tags`, `product_weight`, `product_measure`, `product_dimensions`, `manufacturing_date`, `expiry_date`, `selling_price`, `discount_price`, `short_description`, `long_description`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(54, 1, 3, 4, 25, '12432', 'Box of 24 cans of Mirinda soda ice cream 320ml', 'box-of-24-cans-of-mirinda-soda-ice-cream-320ml', 'upload/products/thumbnail/1771597247230706_product_thumbnail.jpg', '20', 'new product', '329', 'Mililiter', NULL, '2023-07-15 17:00:00', '2024-07-15 17:00:00', '50', '10', 'Product used for more than 1 year', '<p class=\"MsoNormal\">About the brand Mirinda</p>\r\n<p class=\"MsoNormal\">In the ever-growing and diversified market of carbonated beverages, Mirinda is always proud of being a famous carbonated beverage brand that is always loved and trusted by all ages.</p>\r\n<p class=\"MsoNormal\">Mirinda soft drink is delicious, has many unique flavors, helps you quickly quench your thirst, with a light gas taste, is a great refreshment drink for all ages.</p>\r\n<p class=\"MsoNormal\">Box of 24 cans of Mirinda soft drink with cream soda flavor 320ml 0</p>\r\n<p class=\"MsoNormal\">Produced on modern technological lines, ensuring hygiene and safety for consumers\' health. The product has a rich, creamy, sweet and creamy soda flavor combined with a light gas taste - Mirinda Soda Cream is always a great choice to quench thirst, full of energy, with you to spark creativity, enjoy all the fun.</p>\r\n<p class=\"MsoNormal\">Box of 24 cans of Mirinda soft drink with cream soda flavor 320ml</p>\r\n<p class=\"MsoNormal\">Effect of the product</p>\r\n<p class=\"MsoNormal\">Soft drink Mirinda soda cream not only helps you dispel your thirst immediately but also helps stimulate the taste buds, making meals more delicious. This is an indispensable drink in parties and outdoor activities, helping you to be full of energy, full of life and active in hot summer weather.</p>\r\n<p class=\"MsoNormal\">In addition, soft drinks also help to keep calcium in the blood and prevent some dangerous diseases such as cirrhosis, cancer</p>\r\n<p class=\"MsoNormal\">Box of 24 cans of Mirinda soft drink 320ml cream soda 2</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">More delicious cold drink. Store in a clean, dry, cool place, away from sunlight.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 16:59:53', NULL, NULL),
(55, 1, 3, 4, 25, '65456', '6 cans of Mirinda blueberry ice cream soda 320ml', '6-cans-of-mirinda-blueberry-ice-cream-soda-320ml', 'upload/products/thumbnail/1771597409489497_product_thumbnail.jpg', '10', 'new product', '320', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '38', '35', 'Product used for more than 1 year', '<p class=\"MsoNormal\">: About the brand Mirinda</p>\r\n<p class=\"MsoNormal\">In the ever-growing and diversified market of carbonated beverages, Mirinda is always proud of being a famous carbonated beverage brand that is always loved and trusted by all ages.</p>\r\n<p class=\"MsoNormal\">Mirinda soft drink is delicious, has many unique flavors, helps you quickly quench your thirst, with a light gas taste, is a great refreshment drink for all ages.</p>\r\n<p class=\"MsoNormal\">Box of 24 cans of Mirinda soft drink with cream soda flavor 320ml 0</p>\r\n<p class=\"MsoNormal\">Produced on modern technological lines, ensuring hygiene and safety for consumers\' health. The product has a rich, creamy, sweet and creamy soda flavor combined with a light gas taste - Mirinda Soda Cream is always a great choice to quench thirst, full of energy, with you to spark creativity, enjoy all the fun.</p>\r\n<p class=\"MsoNormal\">Box of 24 cans of Mirinda soft drink with cream soda flavor 320ml</p>\r\n<p class=\"MsoNormal\">Effect of the product</p>\r\n<p class=\"MsoNormal\">Soft drink Mirinda soda cream not only helps you dispel your thirst immediately but also helps stimulate the taste buds, making meals more delicious. This is an indispensable drink in parties and outdoor activities, helping you to be full of energy, full of life and active in hot summer weather.</p>\r\n<p class=\"MsoNormal\">In addition, soft drinks also help to keep calcium in the blood and prevent some dangerous diseases such as cirrhosis, cancer</p>\r\n<p class=\"MsoNormal\">Box of 24 cans of Mirinda soft drink 320ml cream soda 2</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">More delicious cold drink. Store in a clean, dry, cool place, away from sunlight.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 17:02:28', NULL, NULL),
(56, 1, 1, 4, 26, '87677', '6 bottles of Pepsi soft drink without calories 390ml', '6-bottles-of-pepsi-soft-drink-without-calories-390ml', 'upload/products/thumbnail/1771597667674235_product_thumbnail.jpg', '100', 'new product', '390', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '34', '30', 'Product used for more than 1 year', '<p class=\"MsoNormal\">About Pepsi brand</p>\r\n<p class=\"MsoNormal\">Pepsi is a globally famous brand of carbonated Cola-flavored beverage, which inherits many long-standing historical values. In Vietnam, proud to be a brand that represents the voice of young people with the message \"Stay young, keep quality, keep PEPSI\", we always seek to bring the ultimate refreshing experiences, encouraging encourage young people to capture and enjoy every exciting moment of life.</p>\r\n<p class=\"MsoNormal\">Soft drinks with Gaz Pepsi with attractive cola flavor, bring refreshing feeling, instant cooling in hot days. Served directly, it tastes better when chilled, or served with ice.</p>\r\n<p class=\"MsoNormal\">Pepsi has been present in Vietnam since 1994 and quickly gained popularity especially among children and young people. Pepsi is suitable as a refreshing drink, used when eating fried chicken, french fries, popcorn, ... or other foods that cause indigestion, ...</p>\r\n<p class=\"MsoNormal\">In addition to the traditional Pepsi cola flavor currently on the market, there are Pepsi Light lines, Pepsi no calories, Pepsi no calories lemon flavor, ... are very popular.</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Pepsi Cola is created from the main ingredients are CO2 saturated water, sugar, natural flavor,...adding sodium and carbohydrates to the body.</p>\r\n<p class=\"MsoNormal\">The energy in the product is about 140 calories</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Beverages</p>\r\n<p class=\"MsoNormal\">Stimulate your taste buds to make you feel more delicious</p>\r\n<p class=\"MsoNormal\">Beneficial for the digestive system, helping to lighten the stomach</p>\r\n<p class=\"MsoNormal\">Provide energy to the body, bring relaxation, refreshment</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Do not put in the freezer compartment</p>\r\n<p class=\"MsoNormal\">Served directly, it tastes better when chilled, or served with ice. More delicious cold drink.</p>\r\n<p class=\"MsoNormal\">Store in a clean, dry, cool place, away from sunlight.</p>\r\n<p class=\"MsoNormal\">HSD: 12 months from date of manufacture</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 17:06:34', NULL, NULL),
(57, 4, 5, 1, 15, '3765', 'Mr.Johnny Pure Oatmeal Powder 300g', 'mr.johnny-pure-oatmeal-powder-300g', 'upload/products/thumbnail/1771597824503226_product_thumbnail.jpg', '20', 'new product', '300', 'Gram', NULL, '2023-07-16 17:00:00', '2023-10-16 17:00:00', '22', '20', 'Product can be used for 3 months', '<p class=\"MsoNormal\">Oats and cereals bring many health benefits such as rich in nutritional value, provide a large amount of protein, vitamins, trace minerals, support weight loss. Mr.Johnny Pure Oatmeal 300g standard packaging is a safe, family-friendly product.</p>\r\n<p class=\"MsoNormal\">Since ancient times, cereals and oats have always been known and used as an important food for daily meals. Modern science has proven that oats and cereals bring many health benefits such as rich in nutritional value, providing a large amount of protein, vitamins, trace minerals, supporting weight loss, .</p>\r\n<p class=\"MsoNormal\">Mr.Johnny\'s cereals and oats are packaged as a safe, family-friendly product.</p>\r\n<p class=\"MsoNormal\">Provide an abundant source of energy</p>\r\n<p class=\"MsoNormal\">Contains ingredients rich in energy, many substances beneficial to the body, such as starch, fiber, protein, fat, vitamins and other plant compounds,...</p>\r\n<p class=\"MsoNormal\">Nutritious snacks for children</p>\r\n<p class=\"MsoNormal\">Oats in powder form are one of the suitable foods to be processed into nutritious and mineral-rich snacks for babies from 6 months old with a very simple and quick way of processing.</p>\r\n<p class=\"MsoNormal\">- Mix 30g of oatmeal with 110ml of water and soak for about 5 minutes.</p>\r\n<p class=\"MsoNormal\">- Put the soaked oatmeal into the cooking pot, when it is almost boiling, reduce the heat, stir for 3 minutes, then turn off the heat.</p>\r\n<p class=\"MsoNormal\">- Let the porridge cool to about 40 degrees, add breast milk or formula and stir well to feed the baby.</p>', NULL, 1, NULL, NULL, 1, 1, NULL, '2023-07-16 17:09:04', '2023-07-17 06:44:02', NULL),
(58, 1, 5, 1, 15, '12', 'Pure Pumpkin Powder 200g', 'pure-pumpkin-powder-200g', 'upload/products/thumbnail/1771597956133237_product_thumbnail.jpg', '100', 'new product', '200', 'Gram', NULL, '2023-07-16 17:00:00', '2024-01-16 17:00:00', '9', '8', 'Product can be used for 6 months', '<p class=\"MsoNormal\">Product can be used for 6 monthsLong: An effective source of vitamins and minerals:</p>\r\n<p class=\"MsoNormal\">Pumpkin powder contains a lot of vitamin C and substances such as potassium, phosphorus, calcium, iron, oleic, stearic acid, beta - carotene, ...</p>\r\n<p class=\"MsoNormal\">All these substances are necessary for the daily diet of an average person.</p>\r\n<p class=\"MsoNormal\">Daily supplementation of pumpkin powder or pumpkin powder (pumpkin powder) will help the muscles become more alert and full of energy.</p>\r\n<p class=\"MsoNormal\">2. Pumpkin powder\'s beneficial effects on the heart</p>\r\n<p class=\"MsoNormal\">Pumpkin powder contains a lot of omega 3 and omega 6 which have a positive effect in limiting the amount of cholesterol that is harmful to the body.</p>\r\n<p class=\"MsoNormal\">Moreover, inside the pumpkin powder, there are pumpkin seeds, which are the place that provide the most cholesterol-lowering substances.</p>\r\n<p class=\"MsoNormal\">This is very good because it will help the body to prevent diseases related to heart disease as well as blood pressure.</p>\r\n<p class=\"MsoNormal\">3.Pumpkin powder is very good for weight loss</p>\r\n<p class=\"MsoNormal\">Pumpkin powder is trusted by women for weight loss because pumpkin powder provides a lot of fiber.</p>\r\n<p class=\"MsoNormal\">Fiber helps the digestive system work better, eliminating waste products is also very good.</p>\r\n<p class=\"MsoNormal\">Not only that, the pumpkin powder contains a lot of calories and fast-dissolving fat that does not accumulate, which will give users a feeling of fullness for a long time but still fully replenish nutrients.</p>\r\n<p class=\"MsoNormal\">4.Helps the brain work better</p>\r\n<p class=\"MsoNormal\">This is not only an effect that is indirectly caused by better blood circulation but also due to glutamine acid.</p>\r\n<p class=\"MsoNormal\">This is a very important substance to help the brain work more efficiently.</p>\r\n<p class=\"MsoNormal\">And very good support for the metabolism of nerve cells and the brain that makes the brain not only work better, but also develop faster.Oats in powder form are one of the suitable foods to be processed into nutritious and mineral-rich snacks for babies from 6 months old with a very simple and quick way of processing.</p>\r\n<p class=\"MsoNormal\">- Mix 30g of oatmeal with 110ml of water and soak for about 5 minutes.</p>\r\n<p class=\"MsoNormal\">- Put the soaked oatmeal into the cooking pot, when it is almost boiling, reduce the heat, stir for 3 minutes, then turn off the heat.</p>\r\n<p class=\"MsoNormal\">- Let the porridge cool to about 40 degrees, add breast milk or formula and stir well to feed the baby.</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 17:11:09', NULL, NULL),
(59, 1, 5, 1, 15, '6546', 'Tai Ky Tapioca Powder 1kg', 'tai-ky-tapioca-powder-1kg', 'upload/products/thumbnail/1771598067323378_product_thumbnail.jpg', '100', 'new product', '1', 'Gram', NULL, '2023-07-16 17:00:00', '2025-07-16 17:00:00', '19', '17', 'Use more than 2 years', '<p class=\"MsoNormal\">Convenient, tapioca flour is seasoned moderately, smooth, delicious. Tai Ky Tapioca Powder 1kg can be used as an ingredient for many types of cakes such as filter cake, or as a thickener for tea and soup dishes. Quality and safe Talented Powder</p>\r\n<p class=\"MsoNormal\">Tai Ky powder is a very popular product line used today. Tai Ky is always considered as the leading food powder brand in our country.</p>\r\n<p class=\"MsoNormal\">Tai Ky brand belongs to Tai Ky Food Flour Joint Stock Company, with a history dating back to 1976. With more than 45 years of construction and development, Tai Ky\'s products are always improved and developed according to needs. demand of consumers but still maintain the tradition and culture of Vietnamese cuisine.</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in Tai Ky tamarind powder 1kg pack</p>\r\n<p class=\"MsoNormal\">Tapioca starch or many people also known as filtered flour, tapioca starch, tapioca starch, knife flour, ... is refined from tapioca tubers.</p>\r\n<p class=\"MsoNormal\">The product contains nutritional ingredients such as: Energy, carbohydrates, fiber,... According to the information on the package, in 100g of Tai Ky tamarind powder, there are about 355 kcal.</p>\r\n<p class=\"MsoNormal\">Tai Ky talent is made from natural, fresh tapioca raw materials, going through the stages of peeling, washing, grinding, centrifuging, separating starch, and drying. Finished products meet ISO 22000 - 9001 and HACCP standards, absolutely no preservatives, no cholesterol. In addition, tapioca flour also has many health benefits:</p>\r\n<p class=\"MsoNormal\">Power supply.</p>\r\n<p class=\"MsoNormal\">Tapioca starch does not contain cholesterol, so it does not affect heart health.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:12:56', NULL, NULL),
(60, 1, 6, 6, 12, '12333', 'Lotte Toppo Chocolate Vanilla Stick Cake 132g', 'lotte-toppo-chocolate-vanilla-stick-cake-132g', 'upload/products/thumbnail/1771598325597916_product_thumbnail.jpg', '100', 'new product', '132', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '14', '13', 'Product can be used for 12 months', '<p><span style=\"font-size: 13.0pt; line-height: 150%; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Yu Mincho\'; mso-fareast-theme-font: minor-fareast; mso-ansi-language: EN-US; mso-fareast-language: JA; mso-bidi-language: AR-SA;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span>It is a quality and delicious stick cake from Lotte stick cake brand. Lotte Toppo chocolate cake with vanilla flavor 132g box with crispy cake and attractive chocolate filling, sweet with a slight bitterness characteristic, not irritating, fragrant vanilla flavor creates an irresistible taste.</span></p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 17:17:02', NULL, NULL),
(61, 1, 6, 6, 12, '22145', 'Hai Ha longpie cake with nuggets 216g', 'hai-ha-longpie-cake-with-nuggets-216g', 'upload/products/thumbnail/1771598431423932_product_thumbnail.jpg', '100', 'new product', '216', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '13', '10', 'Product can be used for 12 months', '<p class=\"MsoNormal\">Hai Ha cake is delicious and attractive with the wonderful flavor of nuggets. Hai Ha longpie rice cake with 216g package for you, relatives and friends to enjoy this delicious cake. Sponge cake can be used as a snack, as a gift is also very meaningful and wonderful.</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 17:18:43', NULL, NULL),
(62, 4, 6, 6, 12, '12766', 'Chocky Bear Chocolate Sponge Cake 20g', 'chocky-bear-chocolate-sponge-cake-20g', 'upload/products/thumbnail/1771598587478490_product_thumbnail.jpg', '10', 'new product', '20', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '9', '8', 'Product can be used for 12 months', '<p class=\"MsoNormal\">Chocky Bear Chocolate Sponge Cake 20g pack has a sweet and fragrant chocolate flavor, sweet and crispy sponge cake that appeals to the taste buds. Chocky sponge cake is a cake product imported from Thailand made from safe ingredients for health.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:21:12', '2023-07-17 06:44:27', NULL),
(63, 4, 6, 6, 12, '44353', 'Sando Caramel Butter Cookies 53.5g pack', 'sando-caramel-butter-cookies-53.5g-pack', 'upload/products/thumbnail/1771598698093487_product_thumbnail.jpg', '100', 'new product', '53.5', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '22', '16', 'Product can be used for 12 months', '<p class=\"MsoNormal\">Crispy sponge cake, added with caramel butter cream - liquid or sugar or bitter candy, is a kind of brown water, by heating aromatic, fatty sugars. Sando caramel buttercream sponge cake 53.5g small, convenient package. Quality and delicious Sando sponge cake is trusted by many people.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:22:57', '2023-07-17 06:44:31', NULL),
(64, 4, 6, 6, 12, '21121', 'Dorkbua Shrimp Flavored Red Stick Cake 50g', 'dorkbua-shrimp-flavored-red-stick-cake-50g', 'upload/products/thumbnail/1771598798617390_product_thumbnail.jpg', '100', 'new product', '50', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '13', '12', 'Product can be used for 12 months', '<p class=\"MsoNormal\">Cake sticks eaten crispy, chewed a lot will feel delicious, bold and has a fragrant shrimp smell to stimulate the taste. Dorkbua shrimp stick cake 50g is convenient, watching movies and reading books is also very interesting and relaxing. Dorkbua sticks are made in Thailand with quality and safety.</p>\r\n<p class=\"MsoNormal\">Dorkbua is a brand originating from Thailand with delicious biscuits, cakes, and spicy crispy cakes. Modern production lines and selected raw materials make Dorkbua products safe for users\' health.</p>\r\n<p class=\"MsoNormal\">Red Dorkbua Shrimp Flavored Buns 50g 0</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Made from familiar ingredients such as flour, sugar, palm oil and other spices, the product provides the body with energy, protein, fat and some other substances. According to the information printed on the product packaging, 25g of cake provides about 130 kcal.</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Some of the salient features of the product include:</p>\r\n<p class=\"MsoNormal\">Power supply</p>\r\n<p class=\"MsoNormal\">Nutritional supplements</p>\r\n<p class=\"MsoNormal\">Quickly quench hunger</p>\r\n<p class=\"MsoNormal\">Stimulating the taste buds</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">The familiar cake has a crispy taste and aroma, so when you tear the package, you should use it soon, avoid leaving the product exposed to the air for a long time, affecting the quality of the product. Seal if not used all the time, store the cake in a cool, dry place, avoid high temperature and direct sunlight.</p>\r\n<p class=\"MsoNormal\">Note: Do not use when the product has expired, has a strange taste or signs of mold.</p>\r\n<p class=\"MsoNormal\">Red Dorkbua Shrimp Flavored Buns 50g 1</p>\r\n<p class=\"MsoNormal\">Advantages when buying products at Bach Hoa XANH</p>\r\n<p class=\"MsoNormal\">Bach Khoa Xanh is a place that provides many imported bakery products that are checked for quality, genuine products, ensuring the right origin. When shopping here, you will be quickly delivered to the place by the staff.</p>', 1, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:24:33', '2023-07-17 06:44:34', NULL),
(65, 1, 2, 6, 11, '125444', 'LU Butter Cookies 540g box', 'lu-butter-cookies-540g-box', 'upload/products/thumbnail/1771598910906120_product_thumbnail.jpg', '100', 'new product', '540', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '50', '49', 'Product can be used for 12 months', '<p class=\"MsoNormal\">: Delicious biscuits, bright yellow, looking at the crispiness of the cake, when eaten, it smells like butter. LU butter biscuits, box of 540g, with a variety of cakes inside the box, packaged in a luxurious box, is a premium cake of the LU biscuit brand from France.</p>\r\n<p class=\"MsoNormal\">About the brand</p>\r\n<p class=\"MsoNormal\">LU Biscuit is a very famous brand originating from France. This is a brand of biscuits with quite a long history and is highly appreciated by consumers for its quality. Crispy, fragrant biscuits are produced by modern technological lines, with selected raw materials to bring diverse flavors and safe products for consumers\' health.</p>\r\n<p class=\"MsoNormal\">LU butter biscuits box 540g 0</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">LU biscuits are completely made from familiar ingredients such as: flour, sugar, French butter, chocolate, cocoa, vanilla, ... creating a delicious fatty flavor for the cake. The product will provide energy for the body, the cake also adds protein, fat, fiber, sugar,... According to the information printed on the product packaging, 100g of LU biscuits provide the body with about 533 kcal.</p>\r\n<p class=\"MsoNormal\">LU butter biscuits box 540g 1</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Some of the health benefits of the product include:</p>\r\n<p class=\"MsoNormal\">Power supply</p>\r\n<p class=\"MsoNormal\">Add protein, fat,...</p>\r\n<p class=\"MsoNormal\">Quench your hunger</p>\r\n<p class=\"MsoNormal\">Improve mood</p>\r\n<p class=\"MsoNormal\">Regulate the amount of sugar</p>\r\n<p class=\"MsoNormal\">Laxative</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Biscuits are a product with a crispy, light fat, sweet taste, so when you open the package, you should use it soon, avoid leaving the product exposed to the air for a long time, affecting the crispness and quality of the product. When taking enough cake to use, you should close the lid of the box, store it in a cool, dry place, avoid high temperature.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 17:26:20', NULL, NULL),
(66, 1, 2, 6, 11, '545654', 'Lotte Koala\'s March strawberry ice cream bear cake 37g box', 'lotte-koala\'s-march-strawberry-ice-cream-bear-cake-37g-box', 'upload/products/thumbnail/1771598999616981_product_thumbnail.jpg', '100', 'new product', '37', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '8', NULL, 'Product can be used for 12 months', '<p class=\"MsoNormal\">Delicious bear biscuits with a delicious, thin crust that blends with the delicious strawberry cream inside. Lotte Koala\'s March strawberry ice cream bear cake, 37g box, delicious, stimulating taste, never tired of eating from Lotte biscuit brand.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:27:45', NULL, NULL),
(67, 1, 2, 6, 11, '12655', 'Glico Pocky Cookies & Cream Box 40g', 'glico-pocky-cookies-&-cream-box-40g', 'upload/products/thumbnail/1771599099169909_product_thumbnail.jpg', '100', 'new product', '40', 'Gram', NULL, NULL, NULL, '14', '10', 'Product can be used for 12 months', '<p class=\"MsoNormal\">Glico Pocky cookies &amp; cream 40g box is a cake with delicious crispy sticks combined with a tube of white chocolate cream to create a pleasant feeling when eating, and fully feel the harmony between the crispy crust and the cream filling. Products suitable for home and office snacks from the Glico stick brand.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 17:29:20', NULL, NULL),
(68, 1, 2, 6, 12, '433222', 'Poca pink guava cream waffles, pack 115g', 'poca-pink-guava-cream-waffles,-pack-115g', 'upload/products/thumbnail/1771599231591813_product_thumbnail.jpg', '100', 'new product', '115', 'Gram', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '5', '4', 'Product can be used for 12 months', '<p><span style=\"font-size: 13.0pt; line-height: 150%; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Yu Mincho\'; mso-fareast-theme-font: minor-fareast; mso-ansi-language: EN-US; mso-fareast-language: JA; mso-bidi-language: AR-SA;\">Poca Pink Guava Cream Waffles, pack 115g, is a new Poca waffle product with a new and explosive pink guava cream filling. Each layer of crispy waffles combined with cream filling is even more attractive and appealing to you.</span></p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:31:26', NULL, NULL),
(69, 1, 2, 6, 11, '6565', 'Nabati cheese sponge cake 150g box', 'nabati-cheese-sponge-cake-150g-box', 'upload/products/thumbnail/1771599335321351_product_thumbnail.jpg', '100', 'new product', '150', 'Gram', NULL, NULL, NULL, '11', '10', 'Product can be used for 10 months', '<p class=\"MsoNormal\">The thin, fragrant crispy sponge cake sandwiched between layers of cream cheese blends together perfectly. Nabati cheese sponge cake 150g is delicious, packed into many small packages that are easy to store and carry. Nabati sponge cake is trusted and chosen by many people.</p>\r\n<p class=\"MsoNormal\">About the brand Nabati</p>\r\n<p class=\"MsoNormal\">Nabati is a 100% Indonesian bakery brand founded in 1985, loved and chosen by many Vietnamese people. Nabati cake has many flavors for you to choose, meeting the diverse needs of users.</p>\r\n<p class=\"MsoNormal\">Nabati cheese sponge cake 150g box 0</p>\r\n<p class=\"MsoNormal\">Nutrition facts in Nabati cheese sponge cake 150g</p>\r\n<p class=\"MsoNormal\">Cheese sponge cake contains many nutrients such as protein, fat, vitamin A, vitamin B1, sugar, minerals such as iron, zinc, copper, ...</p>\r\n<p class=\"MsoNormal\">In 100g of cake, there are about 500 Kcal.</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Provides energy for the body to function</p>\r\n<p class=\"MsoNormal\">Add blood sugar</p>\r\n<p class=\"MsoNormal\">Add nutrients to the body</p>\r\n<p class=\"MsoNormal\">Substitute meals, nutrition</p>\r\n<p class=\"MsoNormal\">Nabati cheese sponge cake 150g 1</p>\r\n<p class=\"MsoNormal\">Notes when using and how to store Nabati cheese sponge cake 150g box</p>\r\n<p class=\"MsoNormal\">Storage: Store in a cool, dry place, away from direct sunlight</p>\r\n<p class=\"MsoNormal\">Note: Close the packaging tightly after use. Suitable for children over 3 years old and adults. Helps supplement micronutrients for a healthy body.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:33:05', NULL, NULL),
(70, 1, 4, 2, 8, '12761', 'Snow white strawberries 1kg', 'snow-white-strawberries-1kg', 'upload/products/thumbnail/1771600024403761_product_thumbnail.jpg', '100', 'new product', '1', 'Kilogam', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '10', '7', 'Product used for 1 week', '<p class=\"MsoNormal\">Product Code: White Strawberry Seeds</p>\r\n<p class=\"MsoNormal\">- Type of flower/plant: White strawberry seeds, strawberries, fruit tree seeds</p>\r\n<p class=\"MsoNormal\">- English name: White strawberry</p>\r\n<p class=\"MsoNormal\">- Color : White</p>\r\n<p class=\"MsoNormal\">- Number of seeds/pack: 30 seeds</p>\r\n<p class=\"MsoNormal\">- Covering seeds when sowing: No. Use a mist sprayer to water the seeds to adhere to the growing medium</p>\r\n<p class=\"MsoNormal\">- Germination time: 15-30 days</p>\r\n<p class=\"MsoNormal\">- Germination rate: &gt; 80%</p>\r\n<p class=\"MsoNormal\">- Effect: Plant as ornamental, as food.</p>\r\n<p class=\"MsoNormal\">- Made in Viet Nam</p>\r\n<p class=\"MsoNormal\">- Growing climate: Cold country, Hot country</p>\r\n<p class=\"MsoNormal\">- Time of sowing: All year round</p>\r\n<p class=\"MsoNormal\">- Plant height :15-30 cm</p>\r\n<p class=\"MsoNormal\">- Plant type: Perennial</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:44:02', NULL, NULL),
(71, 1, 4, 2, 8, '12545', 'Joy Farm Korean Strawberry 330g', 'joy-farm-korean-strawberry-330g', 'upload/products/thumbnail/1771600130465302_product_thumbnail.jpg', '100', 'new product', '330', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '23', '20', 'Product used for 1 week', '<p class=\"MsoNormal\">Strawberries are a delicious and nutritious fruit. Korean strawberries are packaged beautifully, carefully, fresh strawberries, large, red fruits are extremely beautiful and attractive to users. Strawberries can be eaten directly or processed into many delicious dishes and drinks.</p>\r\n<p class=\"MsoNormal\">Nutritional value of strawberries</p>\r\n<p class=\"MsoNormal\">Strawberries contain an abundant amount of vitamin C, in addition to vitamin A, vitamin B, protein, fiber, fat and many other minerals that are good for health.</p>\r\n<p class=\"MsoNormal\">In 100g of strawberries, there are about 32 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of strawberries</p>\r\n<p class=\"MsoNormal\">Strawberries help reduce stress, help improve blood oxygenation, improve brain function and help the digestive system be healthy and work more efficiently.</p>\r\n<p class=\"MsoNormal\">How to choose fresh strawberries</p>\r\n<p class=\"MsoNormal\">Should choose strawberries with bright red, plump, light skin. Do not choose fruits that are soft, mushy, have many spots or green spots.</p>\r\n<p class=\"MsoNormal\">Joy Farm Korean Strawberry 330g 1</p>\r\n<p class=\"MsoNormal\">Delicious dishes from strawberries</p>\r\n<p class=\"MsoNormal\">Delicious sweet and sour strawberry jam</p>\r\n<p class=\"MsoNormal\">Delicious strawberry smoothie</p>\r\n<p class=\"MsoNormal\">Strawberry milk tea</p>\r\n<p class=\"MsoNormal\">Strawberry ice cream</p>\r\n<p class=\"MsoNormal\">Oatmeal and Strawberry Porridge</p>\r\n<p class=\"MsoNormal\">How to preserve fresh strawberries</p>\r\n<p class=\"MsoNormal\">Strawberries should be stored in the refrigerator to help them stay fresh and keep their nutrients longer.</p>\r\n<p class=\"MsoNormal\">Note: The product received may be different from the picture in color and quantity, but it is still guaranteed in terms of volume and quality.</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 17:45:43', NULL, NULL),
(72, 1, 4, 2, 8, '12999', 'Golden Strawberry 1kg', 'golden-strawberry-1kg', 'upload/products/thumbnail/1771600226845401_product_thumbnail.jpg', '100', 'new product', '1', 'Kilogam', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '12', '10', 'Product used for 1 week', '<p><span style=\"font-size: 13.0pt; line-height: 150%; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Yu Mincho\'; mso-fareast-theme-font: minor-fareast; mso-ansi-language: EN-US; mso-fareast-language: JA; mso-bidi-language: AR-SA;\">Golden Strawberry<span style=\"mso-spacerun: yes;\">&nbsp; </span>is a fruit originating from the provinces in the western region: Can Tho, Soc Trang....with a very attractive sweet and slightly sour taste. Delicious, fragrant, and catching yellow strawberries are specialties not to be missed.</span></p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 17:47:15', NULL, NULL),
(73, 1, 4, 2, 7, '66543', 'Grape nail 500g', 'grape-nail-500g', 'upload/products/thumbnail/1771600408858787_product_thumbnail.jpg', '100', 'new product', '500', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '7', NULL, 'Product used for 1 week', '<p class=\"MsoNormal\">Nail grapes originated in Australia, cylindrical in shape, elongated like a finger. Grapes have a characteristic dark purple color, succulent, delicious, attractive flavor. Grapes also contain a lot of fruit sugar, fiber, vitamins C, A and B which are very good for health. Commitment to deliver the right volume, quality, clean and hygienic packaging</p>\r\n<p class=\"MsoNormal\">Nail grape is an imported fruit, this grape has a characteristic dark purple color. However, instead of having a round, flat shape like Vietnamese grapes, finger grapes are characterized by a large, long shape like a finger. This grape has a delicious taste, sweet but not harsh, succulent, very suitable for the taste of Vietnamese people.</p>\r\n<p class=\"MsoNormal\">Grape nail 500g</p>\r\n<p class=\"MsoNormal\">Nutrition from grapes</p>\r\n<p class=\"MsoNormal\">Grapes contain a lot of fruit sugar, fiber, vitamins C, A and B which are very good for health. Adding grapes to your daily menu can help improve a number of health-related problems such as:</p>\r\n<p class=\"MsoNormal\">Prevent the risk of arteriosclerosis, reduce inflammatory symptoms, reduce blood pressure.</p>\r\n<p class=\"MsoNormal\">Prevention of diseases of old age and prevention of cancer.</p>\r\n<p class=\"MsoNormal\">Strengthens the immune system, reduces the risk of respiratory diseases.</p>\r\n<p class=\"MsoNormal\">Note when eating grapes</p>\r\n<p class=\"MsoNormal\">Should not eat grapes with milk, fish ... will easily cause abdominal pain.</p>\r\n<p class=\"MsoNormal\">Because the sugar content in grapes is quite high, use too much.</p>\r\n<p class=\"MsoNormal\">Should wash off dirt, then soak for about 20-30 minutes and then rinse, should eat the peel to absorb maximum nutrients.</p>\r\n<p class=\"MsoNormal\">Do not wash grapes if not eating immediately. Washing grapes will remove the natural chalk layer that protects the fruit, causing the grapes to ripen quickly, and water penetrates inside, causing fruit rot.</p>\r\n<p class=\"MsoNormal\">Put the grapes in a plastic bag and tie it tightly, store it in the refrigerator at a temperature of 0 to 5 degrees Celsius, avoid placing it near foods that cause odors such as onions and garlic.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 17:50:09', NULL, NULL),
(74, NULL, 4, 2, 16, '32321', 'Areca bananas 800g', 'areca-bananas-800g', 'upload/products/thumbnail/1771600532750873_product_thumbnail.jpg', '100', 'new product', '800', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-19 17:00:00', '3', NULL, 'Product used for 3 days', '<p class=\"MsoNormal\">Banana is a familiar fruit, grown a lot in Vietnam. The fruit is small, round when ripe, has a beautiful golden color, characteristic light aroma, and a sweet taste. Areca bananas contain a lot of fiber, vitamins, minerals and less starch that have the effect of beautifying the skin, anti-aging, good for the heart, blood sugar, weight loss.</p>\r\n<p class=\"MsoNormal\">Nutritional value of areca bananas</p>\r\n<p class=\"MsoNormal\">The nutritional value of areca bananas brings many health benefits, containing a lot of fiber, vitamins, minerals and a little starch.</p>\r\n<p class=\"MsoNormal\">In 100g areca banana contains about 88 kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of areca bananas</p>\r\n<p class=\"MsoNormal\">Bananas help improve memory and mental well-being</p>\r\n<p class=\"MsoNormal\">Effective weight loss support</p>\r\n<p class=\"MsoNormal\">Reduce blood sugar.</p>', NULL, NULL, 1, NULL, 1, 1, NULL, '2023-07-16 17:52:07', '2023-07-17 06:56:43', NULL),
(75, 1, 5, 5, 6, '12888', 'Cat Pate with White Tuna and Anchovy Flavors 80g', 'cat-pate-with-white-tuna-and-anchovy-flavors-80g', 'upload/products/thumbnail/1771600683364340_product_thumbnail.jpg', '1000', 'new product', '80', 'Gram', NULL, '2023-07-16 17:00:00', '2024-04-27 17:00:00', '23', '20', 'Product used less than 1 year', '<p class=\"MsoNormal\">Pate for cats Meowow nutrition, nutrition, convenience. Pate for cats Meowow white tuna and anchovies 80g with a delicious, attractive taste, providing a lot of nutrition for cats. Pate for cats is chosen by many people for their pets.</p>\r\n<p class=\"MsoNormal\">Meowow is true to its name, this is a brand specializing in the production and supply of nutritious cat foods, famous for nutritional sauces, ice cream cakes, pate for cats, ... and also a variety of other products. other unique and impressive food.</p>\r\n<p class=\"MsoNormal\">Launched in 2014 in Korea, with nearly a decade of development, Meowow quickly became a popular brand not only in Korea\'s home turf but also in other countries in the region, including Vietnam. Products through a process of careful research, as well as selection of natural ingredients, production of current technology for high nutrition, suitable for pet\'s taste.</p>\r\n<p class=\"MsoNormal\">Meowow Cat Pate with White Tuna and Anchovy Flavors 80g</p>\r\n<p class=\"MsoNormal\">Nutrition facts in Meowow cat pate with white tuna and anchovy flavor 80g</p>\r\n<p class=\"MsoNormal\">Pate is considered a favorite food of cats, therefore indispensable in the pet\'s nutritional diet, made from ingredients: white tuna, anchovies, taurine, mineral water, vitamin E, thinking agent , road.</p>\r\n<p class=\"MsoNormal\">The product is completely made from natural ingredients with modern and exclusive processing technology, through a process of careful research and investigation, safety and hygiene standards for food containing essential healthy nutritional values such as: Crude protein 12%, crude fat 0.2%, calcium, phosphorus, crude ash, crude fiber, moisture, ... and many other essential nutrients suitable for the health and comprehensive development of pets.</p>\r\n<p class=\"MsoNormal\">Meowow Cat Pate with White Tuna and Anchovy Flavors 80g 1</p>\r\n<p class=\"MsoNormal\">Effects of Meowow cat\'s pate with taste of white tuna and anchovies 80g on health</p>\r\n<p class=\"MsoNormal\">Delicious dry grain food, with a full synthesis of nutrients, has been carefully researched by experts with outstanding uses such as:</p>\r\n<p class=\"MsoNormal\">Ingredients from white salmon and anchovies as well as a combination of natural ingredients, exclusive recipes that keep nutrients intact, delicious quality, rich in DHA and nutrition, help brighten eyes, smooth hair, good for the heart and blood vessels. brain development.</p>\r\n<p class=\"MsoNormal\">For quick meals, saving time but suitable, not adversely affecting health, soft pate is good for the digestive system in pets.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 17:54:30', NULL, NULL),
(76, 1, 5, 5, 6, '43433', '5 plants Cherman sardine complete cat food 12g', '5-plants-cherman-sardine-complete-cat-food-12g', 'upload/products/thumbnail/1771600819075210_product_thumbnail.jpg', '1000', 'new product', '12', 'Gram', NULL, '2023-07-16 17:00:00', '2024-02-16 17:00:00', '21', '20', 'Product used less than 1 year', '<p class=\"MsoNormal\">Cherman cat food is an essential product to supplement essential nutrients for cats. 5 plants of complete mixed food for cats Cherman sardines 12g has a delicious taste of sardines, bringing a sense of deliciousness to children. This is the most popular form of cat food.</p>\r\n<p class=\"MsoNormal\">About the brand Cherman</p>\r\n<p class=\"MsoNormal\">The problem of cats\' eating has never been easy, with being picky about taste as well as being quite picky, so it quite affects the selection of reasonable food for the baby. Understanding that problem, Bach Khoa Xanh will introduce to you Cherman - A brand of cat food originating from Thailand, the leading famous in this country with a variety of nutritional sauces, complete, pate For cats with ingredients from nature, rich in excellent nutrition to support cats against anorexia, saving time for owners.</p>\r\n<p class=\"MsoNormal\">5 plants of complete mixed cat food for cats Cherman sardines 12g 0</p>\r\n<p class=\"MsoNormal\">Nutritional composition of 5 plants Cherman sardines complete complete cat food 12g</p>\r\n<p class=\"MsoNormal\">Nutritious soft sauce based on natural ingredients with rich sardines flavor, made from ingredients: digestible herring, modified starch, chicken liver, flavor enhancer, soluble extract Tuna, glycerine, sugar, flavor enhancer, chicken, fish oil powder, goat\'s milk, taurine, food coloring, vitamins,...</p>\r\n<p class=\"MsoNormal\">The product is made entirely from natural ingredients, the exclusive formula for the product is really suitable for the development stage of the dog. Provides a full range of nutrients such as: Protein 8%, crude fat 1%, crude fiber 2%, crude ash 2.5%, moisture 86%</p>\r\n<p class=\"MsoNormal\">5 plants Cherman complete cat food sardines flavor 12g 1</p>\r\n<p class=\"MsoNormal\">Effects of 5 plants of complete mixed food for cats Cherman sardines 12g with health</p>\r\n<p class=\"MsoNormal\">The complete nutritional blend from natural ingredients with a delicious sardines flavor is a soft and palatable food that is loved by cats, and has been carefully researched by experts with various uses. Featured as:</p>\r\n<p class=\"MsoNormal\">The complete ready-to-eat sauce for a quick meal is more convenient than ever, easy to carry anywhere when going out with your pet, saving time.</p>\r\n<p class=\"MsoNormal\">From natural ingredients, unique recipes, provide adequate nutritional values for the body and comprehensive development in children, limit anorexia, and help absorb nutrients well. nutritious and easy to digest.</p>', 1, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 17:56:40', '2023-07-17 08:49:06', NULL),
(77, 1, 5, 5, 5, '54332', 'Pedigree dog snack with salted pork flavor 60g', 'pedigree-dog-snack-with-salted-pork-flavor-60g', 'upload/products/thumbnail/1771601020044680_product_thumbnail.jpg', '1000', 'new product', '60', 'Gram', NULL, '2023-07-16 17:00:00', '2024-04-10 17:00:00', '12', '10', 'Product used less than 1 year', '<p class=\"MsoNormal\">Both delicious and provide some nutrients for the development of dogs. Pedigree dog snack with salted pork flavor 60g bag with vitamins and minerals also helps to strengthen the immune system, enhance vision, and help the digestive system to be healthy.</p>\r\n<p class=\"MsoNormal\">Pedigree is a brand that specializes in providing pet care products that many people choose to choose in caring for their pet\'s health. Most of the products of this brand are made from high-quality ingredients, along with advanced technological processes, so they bring quality products that meet the nutritional needs of the human body. for pets.</p>\r\n<p class=\"MsoNormal\">Ingredients in the product</p>\r\n<p class=\"MsoNormal\">Pedigree dog snack with salted pork flavor 60g bag 0</p>\r\n<p class=\"MsoNormal\">Pedigree Pork Snacks 60g contains the following ingredients: Tapioca Starch, Wheat, Wheat Gluten, Corn Gluten, Glycerine, Poultry Liver Powder, Minerals, Preservative Potassium Sorbate, Chicken Flavoring Agent salted meat, colorants,.. most of these ingredients are safe for pets</p>\r\n<p class=\"MsoNormal\">The effect of the product on pet health</p>\r\n<p class=\"MsoNormal\">Pedigree dog snacks with pork flavor are ideal weaning foods, they have outstanding uses and advantages as follows:</p>\r\n<p class=\"MsoNormal\">With a delicious and attractive salt pork flavor, the uncles will love it. In addition, the product also contains a large amount of starch, supplementing energy for the dogs to work healthy.</p>\r\n<p class=\"MsoNormal\">With natural ingredients without chemicals, you can rest assured when giving your puppy to use.</p>\r\n<p class=\"MsoNormal\">In addition, the minerals in this snack also create enzyme reactions that help in good digestion, maintain and balance fluids, stabilize muscle spasms and nerve function, help teeth and bones. sturdy, healthy.</p>\r\n<p class=\"MsoNormal\">Pedigree dog snack also has vitamins and minerals that also help strengthen the immune system, enhance vision, help the digestive system healthy and absorb nutrients well. Vitamins and minerals.</p>\r\n<p class=\"MsoNormal\">Preservation and note when using the product</p>\r\n<p class=\"MsoNormal\">Pedigree dog snack with salted pork flavor 60g 1</p>\r\n<p class=\"MsoNormal\">Store the product in a cool, dry place, avoid direct sunlight or high temperature.</p>\r\n<p class=\"MsoNormal\">Close the cap tightly after each use</p>\r\n<p class=\"MsoNormal\">Keep out of reach of children</p>\r\n<p class=\"MsoNormal\">Read the expiration date carefully before using.</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 17:59:51', '2023-07-17 08:49:06', NULL),
(78, 1, 5, 5, 5, '46765', 'Bowwow dog food with duck meat roll with milk bar 80g', 'bowwow-dog-food-with-duck-meat-roll-with-milk-bar-80g', 'upload/products/thumbnail/1771601141255665_product_thumbnail.jpg', '100', 'new product', '80', 'Gram', NULL, '2023-07-16 17:00:00', '2023-10-16 17:00:00', '22', '20', 'Product can be used for 3 months', '<p class=\"MsoNormal\">Bowwow dog food is a brand specializing in providing reputable, high-quality dog food with an impressive variety of products. Bowwow dog food roll duck meat 80g package from quality duck meat, contains many nutrients for pets to grow.</p>\r\n<p class=\"MsoNormal\">Bowwow is a brand that specializes in providing safe, quality pet care products that many people choose for their pets. Trademark originated in Korea. Currently, the brand has exported products in over 10 countries with the business motto of always putting itself in the position of customers. Therefore, the brand is increasingly gaining the trust of users.</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Bowwow dog food duck meat roll milk bar 80g pack 0</p>\r\n<p class=\"MsoNormal\">Bowwow dog food with duck meat roll with milk bar 80g pack has the following outstanding uses and advantages: Duck meat, barb fish, flour, soybean meal, spices, vitamins, catalysts, substances.. All ingredients are quality, safe for your pet.</p>\r\n<p class=\"MsoNormal\">Uses for health</p>\r\n<p class=\"MsoNormal\">Bowwow dog food with duck meat roll with milk bar 80g 1</p>\r\n<p class=\"MsoNormal\">Cake is made from fresh milk, duck, fish and chicken breast, so it provides nutrients for the pet to develop comprehensively.</p>\r\n<p class=\"MsoNormal\">Supplement ingredients and nutrients to help keep bones strong</p>\r\n<p class=\"MsoNormal\">Essential vitamins and substances to keep your pet active</p>\r\n<p class=\"MsoNormal\">Preservation and note when using the product</p>\r\n<p class=\"MsoNormal\">Store the product in a cool, dry place, avoid direct sunlight or high temperature.</p>\r\n<p class=\"MsoNormal\">Close tightly after each use</p>\r\n<p class=\"MsoNormal\">Discontinue use if pet has allergy symbol.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 18:01:47', '2023-07-17 08:50:04', NULL);
INSERT INTO `products` (`id`, `supplier_id`, `brand_id`, `category_id`, `subcategory_id`, `product_code`, `product_name`, `product_slug`, `product_thumbnail`, `product_quantity`, `product_tags`, `product_weight`, `product_measure`, `product_dimensions`, `manufacturing_date`, `expiry_date`, `selling_price`, `discount_price`, `short_description`, `long_description`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(79, 1, 5, 5, 5, '76753', 'Bowwow dog sausage with cheddar cheese pack 7 x 10g', 'bowwow-dog-sausage-with-cheddar-cheese-pack-7-x-10g', 'upload/products/thumbnail/1771601246579030_product_thumbnail.jpg', '100', 'new product', '10', 'Gram', NULL, NULL, NULL, '11', '10', 'Product can be used for 3 months', '<p class=\"MsoNormal\">Delicious, nutritious dog food that helps your pet eat better, healthier. Bowwow dog sausage cheddar cheese 70g pack genuine Bowwow dog food contains cheese, rich in protein, vitamins and collagen to help improve skin and coat effectively</p>\r\n<p class=\"MsoNormal\">.Bowwow - A dog and cat food brand from Korea, it is known for its unique products such as sausages, chew bones, bonus cakes, cheese balls,... contributing to the diversification of sources. pet food.</p>\r\n<p class=\"MsoNormal\">Having many years of experience in the industry with the goal of bringing the best quality products for pets, the company quickly gained a great reputation because of its uniqueness, not only at home but also in the international market.</p>\r\n<p class=\"MsoNormal\">Bowwow dog sausage with cheddar cheese pack 7 x 10g 0</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Bowwow Dog Sausage with Cheddar Cheese Pack 7 x 10g made from ingredients: Cheddar Cheese, Tapioca Starch, Soybean Powder, Vegetable Collagen, Sorbitol, Lecithin, Sodium Phosphate,... have nutritional values such as: protein, vitamins, collagen, energy, ... suitable for the development of pets.</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Bowwow cheddar sausage for dogs, pack of 7 x 10g of cheddar cheese, excellent taste, super good taste stimulation, besides, the product is a unique soft sausage, easy to use as well as preserve, supplement Essential nutrients as well as collagen, omega good for hair, skin, support good digestion.</p>\r\n<p class=\"MsoNormal\">Bowwow dog sausage with cheddar cheese pack 7 x 10g 1</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Note: For dog food products, you should carefully read the instructions for use and ingredients to have the right amount of food for your dog on the package. Do not use products that have expired, are of unknown origin or have any abnormal signs.</p>\r\n<p class=\"MsoNormal\">Storage method: Store in a cool, dry place, avoid direct light, close the bag tightly immediately after using the product. Avoid damp places with many insect pests. Avoid fire and explosives.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 18:03:28', '2023-07-17 08:50:04', NULL),
(80, 1, 4, 2, 8, '54354', 'Thaifruitz Dried Strawberries 30g', 'thaifruitz-dried-strawberries-30g', 'upload/products/thumbnail/1771601361757568_product_thumbnail.jpg', '100', 'new product', '30', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '12', '10', 'Product used for 1 week', '<p class=\"MsoNormal\">Dried fruit is flexible, fragrant, sweet, chewy and very pleasant to eat. Thaifruitz freeze-dried strawberries, pack 30g, are dried by using high temperature (50 - 70 degrees Celsius) to lose some of the product\'s moisture and then cooling. Thaifruitz dried fruit quality, hygienic and attractive.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:05:17', NULL, NULL),
(81, 1, 4, 2, 8, '12111', 'Thaifruitz Dried Strawberries 100g', 'thaifruitz-dried-strawberries-100g', 'upload/products/thumbnail/1771601467122496_product_thumbnail.jpg', '100', 'new product', '100', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '13', '10', 'Product used for 1 week', '<p class=\"MsoNormal\">Dried fruit is flexible, fragrant, sweet, chewy and very pleasant to eat. Thaifruitz freeze-dried strawberries, pack 100g, are dried by using high temperature (50 - 70 degrees Celsius) to lose some of the product\'s moisture and then cooling. Thaifruitz dried fruit quality, hygienic and attractive.</p>\r\n<p class=\"MsoNormal\">About the brand</p>\r\n<p class=\"MsoNormal\">Thaifruitz is a brand of dried fruit imported directly from Thailand and is produced by modern technological lines from raw material selection to processing and packaging under strict supervision. Most of Thaifruitz\'s dried fruit products are selected from fresh natural fruits to ensure food safety and hygiene for users and bring delicious and rich flavors.</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">Thaifruitz dried strawberries 100g pack</p>\r\n<p class=\"MsoNormal\">Thaifruitz 100g flexible dried strawberries contains the following nutritional ingredients: 95% fresh strawberries, sugar is safe and good for users\' health.</p>\r\n<p class=\"MsoNormal\">Health effects</p>\r\n<p class=\"MsoNormal\">Contains vitamins, fiber and effective antioxidants</p>\r\n<p class=\"MsoNormal\">Strawberries reduce cancer risk</p>\r\n<p class=\"MsoNormal\">Maintains digestive health and boosts immunity</p>\r\n<p class=\"MsoNormal\">Ingredients safe for users</p>\r\n<p class=\"MsoNormal\">Thaifruitz Dried Strawberries 100g 1</p>\r\n<p class=\"MsoNormal\">Preservation and note when using the product</p>\r\n<p class=\"MsoNormal\">Store the product in a cool, dry place away from direct sunlight or in a humid place</p>\r\n<p class=\"MsoNormal\">Close tightly after each use</p>\r\n<p class=\"MsoNormal\">Do not use the product after the expiration date</p>\r\n<p class=\"MsoNormal\">Don\'t eat too much at once</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 18:06:58', NULL, NULL),
(82, 1, 4, 2, 7, '54329', 'Seedless green grapes 1 kg', 'seedless-green-grapes-1-kg', 'upload/products/thumbnail/1771601680068321_product_thumbnail.jpg', '100', 'new product', '1', 'Kilogam', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '16', '15', 'Product used for 1 week', '<p class=\"MsoNormal\">Nutritional value of green grapes</p>\r\n<p class=\"MsoNormal\">Grapes are rich in vitamin A, vitamin C and vitamin K that are good for the body and minerals such as iron, calcium, ... Especially grapes also contain anthocyanins, tannins and high antioxidant resveratrol.</p>\r\n<p class=\"MsoNormal\">In 100g green grapes from 65 - 68Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of green grapes</p>\r\n<p class=\"MsoNormal\">Green grapes help improve heart health very well</p>\r\n<p class=\"MsoNormal\">Effective cancer prevention</p>\r\n<p class=\"MsoNormal\">Enhance brain function</p>\r\n<p class=\"MsoNormal\">Help you get a good night\'s sleep</p>\r\n<p class=\"MsoNormal\">Helps improve vision better</p>\r\n<p class=\"MsoNormal\">Seedless green grapes 1 kg 1</p>\r\n<p class=\"MsoNormal\">Delicious dishes from green grapes</p>\r\n<p class=\"MsoNormal\">Grapes can process many delicious dishes such as grape syrup, fresh grape cake, grape juice, grape wine, grape jelly, ....</p>\r\n<p class=\"MsoNormal\">How to preserve fresh green grapes</p>\r\n<p class=\"MsoNormal\">When buying green grapes, they need to be washed with salt water, then drained, put in plastic bags or food containers and stored in the refrigerator compartment.</p>\r\n<p class=\"MsoNormal\">Note: The product received may be different from the picture in color and quantity, but it is still guaranteed in terms of volume and quality.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:10:21', NULL, NULL),
(83, 4, 4, 2, 17, '93663', 'Watermelon with yellow flesh 2kg bag', 'watermelon-with-yellow-flesh-2kg-bag', 'upload/products/thumbnail/1771601828094870_product_thumbnail.jpg', '100', 'new product', '2', 'Kilogam', NULL, '2023-07-16 17:00:00', '2023-08-06 17:00:00', '10', NULL, 'Product used for 3 week', '<p class=\"MsoNormal\">It is known that in the past few years, yellow watermelon has appeared and become a very popular fruit in Vietnam. Although yellow flesh watermelons are sold for 2-3 times more than traditional red watermelons, this type of watermelon is often sold out.</p>\r\n<p class=\"MsoNormal\">Features of yellow flesh watermelon</p>\r\n<p class=\"MsoNormal\">Yellow flesh watermelon is native to Africa, belongs to the cucurbit family. This type of watermelon has a thin, hard skin and a lot of water, so it is often chosen to cool off.</p>', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-16 18:12:42', '2023-07-17 06:44:37', NULL),
(84, 1, 4, 2, 16, '12298', 'Porcelain bananas 1.5kg', 'porcelain-bananas-1.5kg', 'upload/products/thumbnail/1771601939773478_product_thumbnail.jpg', '100', 'new product', '1', 'Kilogam', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '4', '1', 'Product used for 1 week', '<p class=\"MsoNormal\">Porcelain banana is a fruit that contains a lot of essential nutrients for the body, and has a very attractive soft fleshy taste. In addition to eating directly, porcelain bananas can also be used to process many delicious and attractive dishes such as smoothies, tea, cakes, ice cream, milk, ... Bananas are best when brown spots begin to appear.</p>\r\n<p class=\"MsoNormal\">Nutritional value of porcelain banana</p>\r\n<p class=\"MsoNormal\">Porcelain bananas are especially rich in vitamins, starch, protein, minerals such as magnesium, sodium, calcium, zinc, iron, potassium, phosphate, etc.</p>\r\n<p class=\"MsoNormal\">In 100g of porcelain banana contains about 88 kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of bananas</p>\r\n<p class=\"MsoNormal\">Bananas help improve memory and mental well-being</p>\r\n<p class=\"MsoNormal\">Effective weight loss support</p>\r\n<p class=\"MsoNormal\">Reduce blood sugar</p>\r\n<p class=\"MsoNormal\">How to preserve fresh porcelain bananas</p>\r\n<p class=\"MsoNormal\">Banana is a domestic fruit that is loved by many people. However, if bananas are not stored properly, they will spoil very quickly. NEST shows you this trick to keep bananas ripe for a long time.</p>\r\n<p class=\"MsoNormal\">Store bananas at room temperature until ripe</p>\r\n<p class=\"MsoNormal\">Hang bananas on hooks</p>\r\n<p class=\"MsoNormal\">Do not put bananas with other vegetables</p>\r\n<p class=\"MsoNormal\">Keep bananas in the fridge after ripening</p>\r\n<p class=\"MsoNormal\">Spread lemon juice on bananas</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:14:29', NULL, NULL),
(85, 1, 5, 5, 6, '43969', 'MARIA White Tuna and Salmon Pate for Cats 70g', 'maria-white-tuna-and-salmon-pate-for-cats-70g', 'upload/products/thumbnail/1771602066822058_product_thumbnail.jpg', '100', 'new product', '70', 'Gram', NULL, '2023-07-16 17:00:00', '2024-06-16 17:00:00', '12', '10', 'Product used less than 1 year', '<p class=\"MsoNormal\">MARIA cat food is a high quality cat food brand, originating from Thailand, which many customers care about and trust. Pate for cats MARIA white tuna and salmon 70g pack from quality ingredients, high nutritional content good for the growth of pets.</p>\r\n<p class=\"MsoNormal\">About the brand</p>\r\n<p class=\"MsoNormal\">Maria is a premium cat food brand from Thailand that is officially distributed through BMPet.vn. Maria\'s products provide an excellent source of nutrition, especially protein obtained from excellent sources of mackerel, salmon, tuna, squid, shrimp,...</p>\r\n<p class=\"MsoNormal\">Nutritional ingredients in the product</p>\r\n<p class=\"MsoNormal\">The product is made from white tuna meat, salmon, modified starch, emulsifier, ...</p>\r\n<p class=\"MsoNormal\">MARIA White Tuna and Salmon Pate for Cats 70g 0</p>\r\n<p class=\"MsoNormal\">Effect of the product</p>\r\n<p class=\"MsoNormal\">Delicious taste helps stimulate the taste buds</p>\r\n<p class=\"MsoNormal\">Provides the nutrition and energy your cat needs</p>\r\n<p class=\"MsoNormal\">Supplement with fatty acids and omega 3 good for the brain and skin</p>\r\n<p class=\"MsoNormal\">Improve digestion, strengthen resistance</p>\r\n<p class=\"MsoNormal\">Preservation and note when using the product</p>\r\n<p class=\"MsoNormal\">Feed the cat directly</p>\r\n<p class=\"MsoNormal\">Depending on the age and weight of the cat to use the right amount of food according to the instructions on the package</p>\r\n<p class=\"MsoNormal\">Store the product in a cool, dry place, away from direct sunlight</p>\r\n<p class=\"MsoNormal\">Keep cold after opening the bag</p>\r\n<p class=\"MsoNormal\">MARIA White Tuna and Salmon Pate for Cats 70g</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:16:30', NULL, NULL),
(86, 1, 5, 3, 21, '44533', 'Hoa Doanh young fish nuggets 200g', 'hoa-doanh-young-fish-nuggets-200g', 'upload/products/thumbnail/1771602398813607_product_thumbnail.jpg', '100', 'new product', '200', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '5', '4', 'Product can be used for 7 days', '<p class=\"MsoNormal\">Hoa Doanh fish balls always ensure the use of fresh and safe ingredients for health. Hoa Doanh young fish nuggets pack 200g with soft and chewy characteristics, along with young nuggets with a little crunchy taste. Fish balls are suitable for cooking hot pot, fried snacks or processed into other delicious dishes.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 18:21:46', NULL, NULL),
(87, 1, 5, 3, 21, '125443', 'Hoa Doanh Sea Fish Ball 300g', 'hoa-doanh-sea-fish-ball-300g', 'upload/products/thumbnail/1771602500945597_product_thumbnail.jpg', '100', 'new product', '300', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '8', '6', 'Product can be used for 7 days', '<p><span style=\"font-size: 13.0pt; line-height: 150%; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Yu Mincho\'; mso-fareast-theme-font: minor-fareast; mso-ansi-language: EN-US; mso-fareast-language: JA; mso-bidi-language: AR-SA;\">Hoa Doanh fish balls always ensure the use of fresh and safe ingredients for health. Hoa Doanh sea fish balls pack 300g with the characteristics of soft and delicious with the typical flavor of sea fish. Fish balls are suitable for cooking hot pot, fried snacks or processed into other delicious dishes.</span></p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:23:24', NULL, NULL),
(88, 1, 5, 3, 21, '34897', 'Frozen basa fish cut into pieces 500g', 'frozen-basa-fish-cut-into-pieces-500g', 'upload/products/thumbnail/1771602608438231_product_thumbnail.jpg', '100', 'new product', '500', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '17', '15', 'Product used for 1 week', '<p class=\"MsoNormal\">Standard EU export basa, fish meat is sweet, nutritious and can be eaten by anyone. Delicious dishes cannot be missed with basa such as deep-fried basa fish, basa fish dipped in vinegar, eaten with hot pot,... The fish is conveniently prepared and packaged, saving time going to the market.</p>\r\n<p class=\"MsoNormal\">Nutritional value of basa fish</p>\r\n<p class=\"MsoNormal\">Basa fish contains many minerals such as sodium, potassium, protein, protein, fat, ... necessary for the body.</p>\r\n<p class=\"MsoNormal\">In 100g of basa fish there is about 50 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of basa fish</p>\r\n<p class=\"MsoNormal\">Basa fish contains a lot of minerals and vitamins that are good for the body such as: bright eyes, good for the brain, good for the heart, good for the eyes, weight loss and keeping fit,...</p>\r\n<p class=\"MsoNormal\">How to prepare basa fish</p>\r\n<p class=\"MsoNormal\">Basa fish is cleaned, cut into pieces, when bought, just washed with salt water, it can be marinated and processed into many delicious dishes.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:25:06', NULL, NULL),
(89, 4, 5, 3, 21, '54687', 'Whole beef tuna cleaned.1kg', 'whole-beef-tuna-cleaned.1kg', 'upload/products/thumbnail/1771602749139353_product_thumbnail.jpg', '100', 'new product', '1', 'Kilogam', NULL, '2023-07-16 17:00:00', '2023-07-19 17:00:00', '12', NULL, 'Product can be used for 2 days', '<p class=\"MsoNormal\">Tuna is a sea fish with firm, chewy, delicious, quality meat. Tuna is ready-made, convenient, helping customers save time. Tuna can be processed into many delicious, nutritious and attractive dishes</p>\r\n<p class=\"MsoNormal\">Whole beef tuna, cleaned, convenient, quality. Tuna beef with firm, chewy, and sweet meat.</p>\r\n<p class=\"MsoNormal\">Tuna is guaranteed origin, packed in convenient vacuum bags.</p>\r\n<p class=\"MsoNormal\">Nutritional value of tuna</p>\r\n<p class=\"MsoNormal\">Tuna contains many minerals such as calcium, phosphorus, zinc, iron, copper, zinc, selenium, vitamins B1, vitamins B2, vitamins PP, ...</p>\r\n<p class=\"MsoNormal\">In 100g of tuna, there are about 107 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of tuna fish</p>\r\n<p class=\"MsoNormal\">Reduce the risk of cardiovascular disease</p>\r\n<p class=\"MsoNormal\">Reduce the risk of stroke</p>\r\n<p class=\"MsoNormal\">Enhance nutrients</p>\r\n<p class=\"MsoNormal\">Strengthen resistance</p>\r\n<p class=\"MsoNormal\">How to prepare beef tuna</p>\r\n<p class=\"MsoNormal\">Tuna has been cleaned and preliminarily processed before being delivered to customers. So, you just need to rinse with salt water and process into your favorite dishes.</p>\r\n<p class=\"MsoNormal\">Delicious dishes from beef tuna</p>\r\n<p class=\"MsoNormal\">Steamed tuna roll with rice paper</p>\r\n<p class=\"MsoNormal\">Fried tuna with fish sauce</p>\r\n<p class=\"MsoNormal\">Braised Tuna with Tomato</p>', NULL, NULL, NULL, NULL, 1, 1, NULL, '2023-07-16 18:27:20', '2023-07-17 06:44:55', NULL),
(90, 1, 5, 3, 4, '45687', 'Viet Sin Squid Ball Pack 500g', 'viet-sin-squid-ball-pack-500g', 'upload/products/thumbnail/1771602872481052_product_thumbnail.jpg', '100', 'new product', '500', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '11', '10', 'Product can be used for 7 days', '<p><span style=\"font-size: 13.0pt; line-height: 150%; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Yu Mincho\'; mso-fareast-theme-font: minor-fareast; mso-ansi-language: EN-US; mso-fareast-language: JA; mso-bidi-language: AR-SA;\">It is a familiar product to consumers from the brand of Viet Sin ink pellets. Viet Sin squid rolls 500g is made from fresh squid ingredients combined with spices, bringing a delicious, chewy and attractive flavor to squid rolls, used to prepare grilled, fried, hot pot dishes...</span></p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 18:29:18', NULL, NULL),
(91, 1, 5, 3, 4, '12524', 'Hoa Doanh Squid Ball Pack 200g', 'hoa-doanh-squid-ball-pack-200g', 'upload/products/thumbnail/1771603012794017_product_thumbnail.jpg', '100', 'new product', '200', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '13', '10', 'Product can be used for 7 days', '<p class=\"MsoNormal\">Hoa Doanh squid ball always ensures to use fresh and safe ingredients for health. Hoa Doanh squid ball 200g with the characteristics of soft, delicious with a typical squid flavor. Squid balls are suitable for cooking hot pot, frying snacks or processing into other delicious dishes.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:31:32', NULL, NULL),
(92, 1, 5, 3, 21, '19812', 'Whole Tuna, cleaned 800g (1-2 fish)', 'whole-tuna,-cleaned-800g-(1-2-fish)', 'upload/products/thumbnail/1771603152117063_product_thumbnail.jpg', '100', 'new product', '800', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-18 17:00:00', '11', '10', 'Product can be used for 2 days', '<p class=\"MsoNormal\">Product can be used for 2 days</p>\r\n<p class=\"MsoNormal\">Long: It is a fish with a lot of meat, little bones and a very attractive aroma. In addition, tuna also brings many health benefits such as preventing atherosclerosis, reducing blood fat... Frozen tuna still retains the firmness of sea fish, helping to preserve it longer, gills. for a richer taste to the dish.</p>\r\n<p class=\"MsoNormal\">Whole tuna from 600g - 800g about 1-2 fish, pre-cleaned, convenient tray. The fish meat is chewy, sweet and tender.</p>\r\n<p class=\"MsoNormal\">The fish is packed in a vacuum tray to help preserve the fresh fish and make it easier to transport.</p>\r\n<p class=\"MsoNormal\">Order fast delivery</p>\r\n<p class=\"MsoNormal\">Whole Tuna, cleaned 600g - 800g (1-2 fish) 0</p>\r\n<p class=\"MsoNormal\">Nutritional value of tuna</p>\r\n<p class=\"MsoNormal\">In tuna meat contains many minerals such as copper, iron, zinc, selenium, phosphorus, calcium, vitamin B, vitamin A, ...</p>\r\n<p class=\"MsoNormal\">In 100g of tuna there are about 130 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of tuna</p>\r\n<p class=\"MsoNormal\">Brain development</p>\r\n<p class=\"MsoNormal\">Development of the nervous system and retina</p>\r\n<p class=\"MsoNormal\">Prevent the risk of memory loss</p>\r\n<p class=\"MsoNormal\">Reduce the risk of obesity</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:33:45', NULL, NULL),
(93, 1, 5, 3, 21, '91221', 'Frozen salmon head 500g (1 - 2 heads)', 'frozen-salmon-head-500g-(1---2-heads)', 'upload/products/thumbnail/1771603271234586_product_thumbnail.jpg', '100', 'new product', '500', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-19 17:00:00', '12', '10', 'Product used for 3 days', '<p class=\"MsoNormal\">The salmon head has soft, fatty bones that can be used to cook sour soup, hot pot, ... bought fish heads can be used with salt and lemon to remove the fishy smell. Frozen fresh salmon head can extend the shelf life, suitable for family needs in processing and providing nutritious dishes.</p>\r\n<p class=\"MsoNormal\">Nutritional value of salmon head</p>\r\n<p class=\"MsoNormal\">In particular, salmon head is a type of fish that contains Omega-3 rich in EPA and DHA, protein and many other essential nutrients such as B vitamins, potassium and selenium, ... all essential nutrients for the body.</p>\r\n<p class=\"MsoNormal\">In 100g of salmon head, there are about 208 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of salmon head</p>\r\n<p class=\"MsoNormal\">Helps produce more collagen</p>\r\n<p class=\"MsoNormal\">Improve skin, help strengthen</p>\r\n<p class=\"MsoNormal\">Strong bones and joints</p>\r\n<p class=\"MsoNormal\">Good for the digestive system</p>\r\n<p class=\"MsoNormal\">Reduced risk of stroke and heart attack</p>\r\n<p class=\"MsoNormal\">How to prepare salmon head</p>\r\n<p class=\"MsoNormal\">Buy salmon head, cut into bite-sized pieces, wash with clean water, then drain and process into favorite dishes.</p>\r\n<p class=\"MsoNormal\">Delicious dishes from salmon heads</p>\r\n<p class=\"MsoNormal\">Salmon head hot pot</p>\r\n<p class=\"MsoNormal\">Fried salmon head with sweet and salty garlic sauce</p>\r\n<p class=\"MsoNormal\">Salmon head sour soup</p>\r\n<p class=\"MsoNormal\">Kimchi salmon head soup</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:35:38', NULL, NULL),
(94, 1, 5, 3, 3, '12599', 'Whole shrimp 250g (10 - 13 pieces)', 'whole-shrimp-250g-(10---13-pieces)', 'upload/products/thumbnail/1771603400314321_product_thumbnail.jpg', '100', 'new product', '250', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-19 17:00:00', '21', '20', 'Product used for 3 days', '<p class=\"MsoNormal\">The tray shrimp at NEST is extremely fresh, the shrimp is large, the meat is sweet and the hand is very firm, used as the main ingredient for many dishes. Vannamei contains a lot of energy and good protein for the body, from children to the elderly, anyone can eat white shrimp.</p>\r\n<p class=\"MsoNormal\">Nutritional value of white shrimp</p>\r\n<p class=\"MsoNormal\">Shrimp contains many sources of energy and nutrients necessary for the human body, including: Protein, fat, Potassium, Vitamin B12, vitamins A, D, calcium, ...</p>\r\n<p class=\"MsoNormal\">In 100g of white shrimp, there are about 99 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of white shrimp</p>\r\n<p class=\"MsoNormal\">Shrimp with outstanding nutritional value is very useful for the physical and brain development of children. At the same time, strengthen the resistance for the elderly.</p>\r\n<p class=\"MsoNormal\">Whole white shrimp 250g (10 - 13 pieces) 1</p>\r\n<p class=\"MsoNormal\">How to prepare white shrimp</p>\r\n<p class=\"MsoNormal\">Wash shrimp with clean water. Cut off the beard.</p>\r\n<p class=\"MsoNormal\">Peel shrimp quickly, you can dissolve a little alum with water and then let the shrimp soak for a while.</p>\r\n<p class=\"MsoNormal\">Khac gently separates the black thread on the back of the shrimp.</p>\r\n<p class=\"MsoNormal\">Marinate spices when cooking more delicious.</p>\r\n<p class=\"MsoNormal\">Delicious dishes from white shrimp</p>\r\n<p class=\"MsoNormal\">Steamed white shrimp with lemongrass beer.</p>\r\n<p class=\"MsoNormal\">Shrimp boiled in coconut water.</p>\r\n<p class=\"MsoNormal\">Some soups help to sweeten the water, stir-fried shrimp with vegetables,...</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:37:41', NULL, NULL),
(95, 1, 5, 3, 3, '12515', 'Crayfish 500g (8-15 heads)', 'crayfish-500g-(8-15-heads)', 'upload/products/thumbnail/1771603517669436_product_thumbnail.jpg', '100', 'new product', '500', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-19 17:00:00', '25', '23', 'Product used for 3 days', '<p class=\"MsoNormal\">Shrimp is a rich source of nutrients, providing very high levels of calcium and iron for the daily diet. When enjoying, you will feel the meat is juicy and slightly chewy. In addition, the large size crayfish is often used to decorate dishes in parties or family meals.</p>\r\n<p class=\"MsoNormal\">Nutritional value of crayfish</p>\r\n<p class=\"MsoNormal\">Crayfish contains many essential nutrients for the body such as protein, fat, calcium, phosphorus, iron, vitamin B1, vitamin B2, vitamin PP, ...</p>\r\n<p class=\"MsoNormal\">In 100g of crayfish, there are about 56 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of crayfish</p>\r\n<p class=\"MsoNormal\">It is one of the very few foods that are both low in calories and nutritious. The content of nutrients, especially protein, is very high in shrimp.</p>\r\n<p class=\"MsoNormal\">Adequately supplementing with omega 3 will have a good memory and the ability to develop the brain will be significantly superior.</p>\r\n<p class=\"MsoNormal\">Provides abundant calcium, promotes the formation of a healthy bone and joint system.</p>\r\n<p class=\"MsoNormal\">It has the ability to prevent cancer because it has the ability to stop cancer cells from growing.</p>\r\n<p class=\"MsoNormal\">Preliminary processing of crayfish</p>\r\n<p class=\"MsoNormal\">Depending on the dish, the crayfish can be processed differently. You can wash shrimp with water, keep the shell or peel it for processing.</p>\r\n<p class=\"MsoNormal\">Delicious dishes from crayfish</p>\r\n<p class=\"MsoNormal\">Crayfish can process many delicious dishes such as:</p>\r\n<p class=\"MsoNormal\">Boiled shrimp in coconut water</p>\r\n<p class=\"MsoNormal\">Stir-fried vermicelli with shrimp</p>\r\n<p class=\"MsoNormal\">Sauteed Shrimp with Garlic Butter</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:39:33', NULL, NULL),
(96, 1, 5, 7, 10, '12121', 'Box of 16 fresh quail eggs', 'box-of-16-fresh-quail-eggs', 'upload/products/thumbnail/1771603931195175_product_thumbnail.jpg', '100', 'new product', '20', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-23 17:00:00', '12', '11', 'Product used for 2 weeks', '<p class=\"MsoNormal\">Box of 16 quail eggs of T.Food is packed and preserved according to strict standards of hygiene and food safety, ensuring the quality of food. Eggs are big and round. Quail eggs can be boiled and processed into a number of other dishes such as braised meat with eggs, egg fried rice, ...</p>\r\n<p class=\"MsoNormal\">Quail eggs are a food containing many nutrients, providing a high amount of protein, providing fats and vitamins and minerals. T.Food quail egg products are produced on a clean and quality farm, with the criterion of \"free of disease and safe\", so customers can be assured of the product.</p>\r\n<p class=\"MsoNormal\">User manual</p>\r\n<p class=\"MsoNormal\">Quail eggs can be boiled and then enjoyed or can be processed into a number of other dishes such as: smoked quail eggs, quail egg shumai, tofu braised with quail eggs, quail eggs braised with coca,...</p>\r\n<p class=\"MsoNormal\">Storage instructions</p>\r\n<p class=\"MsoNormal\">The product should be stored in the refrigerator for a longer shelf life.</p>\r\n<p class=\"MsoNormal\">Eggs should not be used after the expiration date, the expiry date can be seen on the package.</p>\r\n<p class=\"MsoNormal\">Damaged eggs will have the following characteristics: Eggs are black, have an unpleasant smell.</p>\r\n<p class=\"MsoNormal\">Note: The product received may be different from the picture in color and quantity, but it is still guaranteed in terms of volume and quality.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 18:46:08', NULL, NULL),
(97, 1, 5, 7, 9, '270502', 'Eggs with duck and custard in box of 6', 'eggs-with-duck-and-custard-in-box-of-6', 'upload/products/thumbnail/1771605132555073_product_thumbnail.jpg', '100', 'new product', '20', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-30 17:00:00', '13', '12', 'Product used for 2 weeks', '<p class=\"MsoNormal\">Box of 6 duck eggs and ca cuong are packed and preserved according to strict standards of hygiene and food safety, ensuring the quality of food, clear origin. Duck eggs are round and round. This product is suitable for cooking dishes such as fried eggs, duck egg porridge,...</p>\r\n<p class=\"MsoNormal\">User manual</p>\r\n<p class=\"MsoNormal\">Eggs with egg cuong can be boiled and then enjoyed or can be processed into a number of other dishes such as: braised meat with eggs, fried rice with eggs, fried bitter melon with eggs, fried egg noodles, fried egg sausages, scrambled eggs ,...</p>\r\n<p class=\"MsoNormal\">Storage instructions</p>\r\n<p class=\"MsoNormal\">The product should be stored in the refrigerator for a longer shelf life.</p>\r\n<p class=\"MsoNormal\">Eggs should not be used after the expiration date, the expiry date can be seen on the package.</p>\r\n<p class=\"MsoNormal\">Damaged eggs will have the following characteristics: Eggs are black, have an unpleasant smell.</p>\r\n<p class=\"MsoNormal\">Note: The product received may be different from the picture in color and quantity, but it is still guaranteed in terms of volume and quality.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 19:05:13', NULL, NULL),
(98, 1, 5, 7, 9, '070502', 'Northern Thao Duck Eggs Box of 4', 'northern-thao-duck-eggs-box-of-4', 'upload/products/thumbnail/1771605248242025_product_thumbnail.jpg', '100', 'new product', '15', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-30 17:00:00', '12', '11', 'Product used for 2 weeks', '<p class=\"MsoNormal\">Boxes of 4 Northern Thao duck eggs are packed and preserved according to strict standards of hygiene and food safety, ensuring the quality of food. Duck eggs are round and even. Can be boiled or processed into other dishes such as: Bac Thao egg porridge, Bac Thao caviar, ...</p>\r\n<p class=\"MsoNormal\">Nutritional value of Northern herbal duck eggs</p>\r\n<p class=\"MsoNormal\">Bac Thao duck eggs contain many minerals such as sodium, potassium, calcium, protein, fat, ...</p>\r\n<p class=\"MsoNormal\">In 100g of Northern Thao duck eggs, there are about 183 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of duck eggs</p>\r\n<p class=\"MsoNormal\">Reduce body heat</p>\r\n<p class=\"MsoNormal\">Digestive system support</p>\r\n<p class=\"MsoNormal\">Protect blood vessels</p>\r\n<p class=\"MsoNormal\">Increase intelligence</p>\r\n<p class=\"MsoNormal\">Protect the brain</p>\r\n<p class=\"MsoNormal\">How to preserve fresh and delicious Bac Thao duck eggs</p>\r\n<p class=\"MsoNormal\">Preserved in dry, cool place.</p>\r\n<p class=\"MsoNormal\">Eggs should be stored in the refrigerator for longer shelf life.</p>\r\n<p class=\"MsoNormal\">Do not use broken or expired eggs.</p>\r\n<p class=\"MsoNormal\">Damaged eggs will have a dark green color, a very unpleasant smell.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 19:07:04', NULL, NULL),
(99, 1, 5, 7, 9, '12542', 'Box of 4 salted duck eggs 16g', 'box-of-4-salted-duck-eggs-16g', 'upload/products/thumbnail/1771605326990936_product_thumbnail.jpg', '100', 'new product', '16', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-30 17:00:00', '12', '11', 'Product used for 2 weeks', '<p class=\"MsoNormal\">The box of 4 salted duck eggs is packed and preserved according to strict standards of hygiene and food safety, ensuring the quality of the food, with a clear origin. Duck eggs are round and even. This is a ready-to-eat product, can be eaten with rice or eaten without, ..</p>\r\n<p class=\"MsoNormal\">Nutritional value of salted duck eggs</p>\r\n<p class=\"MsoNormal\">Salted duck eggs bring many health benefits, adding many nutrients such as vitamins, rich in antioxidants, and protein.</p>\r\n<p class=\"MsoNormal\">In 100g salted duck eggs, there are about 130 Kcal.</p>\r\n<p class=\"MsoNormal\">Health benefits of salted duck eggs</p>\r\n<p class=\"MsoNormal\">Blood circulation</p>\r\n<p class=\"MsoNormal\">Prevent cardiovascular spasms</p>\r\n<p class=\"MsoNormal\">Maintain and develop bones and joints</p>\r\n<p class=\"MsoNormal\">Prevent osteoporosis</p>\r\n<p class=\"MsoNormal\">Delicious dishes from salted duck eggs</p>\r\n<p class=\"MsoNormal\">Salted duck eggs are the ingredients to make many delicious and excellent dishes such as:</p>\r\n<p class=\"MsoNormal\">Snails fried with salted duck eggs are delicious and catchy, everyone loves them</p>\r\n<p class=\"MsoNormal\">Stir-fried fingernails with salted egg sauce to break the table</p>\r\n<p class=\"MsoNormal\">Delicious salted egg dumplings, nutritious breakfast</p>\r\n<p class=\"MsoNormal\">Chicken feet with salted egg sauce are delicious and flavorful</p>\r\n<p class=\"MsoNormal\">How to preserve fresh salted duck eggs</p>\r\n<p class=\"MsoNormal\">Preserved in dry, cool place.</p>\r\n<p class=\"MsoNormal\">Eggs should be stored in the refrigerator for longer shelf life.</p>\r\n<p class=\"MsoNormal\">Do not use broken or expired eggs.</p>\r\n<p class=\"MsoNormal\">Damaged eggs will have a dark green color, a very unpleasant smell.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 19:08:19', NULL, NULL),
(100, 1, 7, 10, 29, '65979', 'Box of 48 boxes of Vinamilk Happy Star Milk 220ml', 'box-of-48-boxes-of-vinamilk-happy-star-milk-220ml', 'upload/products/thumbnail/1771605853284407_product_thumbnail.jpg', '100', 'new product', '220', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '40', '38', 'Product used for 1 year', '<p class=\"MsoNormal\">About the brand</p>\r\n<p class=\"MsoNormal\">Referring to Vietnam\'s dairy industry, we certainly cannot help but mention the national name that is Vinamilk. With more than 45 years of experience in the establishment and development of the dairy industry, along with the constant improvement of the modern and safe production technology system, Vinamilk always brings milk and products made from pure delicious milk, the most quintessential to the user.</p>\r\n<p class=\"MsoNormal\">Nutritional composition of the product</p>\r\n<p class=\"MsoNormal\">The main ingredients of Vinamilk Happy Star milk with sugar include: Milk (93.1%) (water, powdered milk, milk fat), sugar (3.9%), vegetable oil, stabilizer (471,407.412), synthetic flavoring for food, vitamins (A, D3).</p>\r\n<p class=\"MsoNormal\">In addition, the product provides about 76 kcal per 100ml of milk.</p>\r\n<p class=\"MsoNormal\">The effect of the product on health</p>\r\n<p class=\"MsoNormal\">Vinamilk Star nutritional milk has sugar with delicious milk flavor, greasy, easy to drink. Milk also adds a variety of vitamins and minerals that are good for the body, ensuring a full supply of nutrients every day.</p>\r\n<p class=\"MsoNormal\">The product provides vitamin A and vitamin D3, zinc and iron to help bright eyes, strong bones and strengthen resistance every day.</p>\r\n<p class=\"MsoNormal\">Box of 48 bags of Vinamilk Happy Star sweetened nutritional milk 220ml</p>\r\n<p class=\"MsoNormal\">User manual</p>\r\n<p class=\"MsoNormal\">Shake well before drinking</p>\r\n<p class=\"MsoNormal\">More delicious cold drink</p>\r\n<p class=\"MsoNormal\">Should drink from 2-3 bags per day</p>\r\n<p class=\"MsoNormal\">Note when using and how to store the product</p>\r\n<p class=\"MsoNormal\">Store in a cool, dry place</p>\r\n<p class=\"MsoNormal\">Should be used up after opening</p>\r\n<p class=\"MsoNormal\">The product is not suitable for children under 1 year old and people who are allergic to milk ingredients.</p>', NULL, 1, NULL, NULL, 1, NULL, NULL, '2023-07-16 19:16:41', NULL, NULL),
(101, 1, 7, 10, 29, '32432', '48 cartons of sterilized fresh milk with sugar Vinamilk 180ml', '48-cartons-of-sterilized-fresh-milk-with-sugar-vinamilk-180ml', 'upload/products/thumbnail/1771606332308276_product_thumbnail.jpg', '100', 'new product', '180', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '33', '30', 'Product used for 1 year', '<p class=\"MsoNormal\">Made from 100% fresh milk containing many nutrients such as vitamins A, D3, calcium, ... good for bones and immune system, Vinamilk fresh milk is the top trusted brand with excellent quality. Box of 48 boxes of Vinamilk 100% Fresh Milk with sugar, 180ml, delicious and easy to drink.</p>\r\n<p class=\"MsoNormal\">Vinamilk 100% pasteurized fresh milk is made entirely from fresh cow\'s milk, brings a rich, aromatic milk taste, is easy to drink, supplemented with vitamins D3, A, C and selenium to support immunity, bone development and good vision.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 19:24:18', NULL, NULL),
(102, 1, 7, 10, 29, '43521', 'Milk box Vinamilk A&D3 strawberry flavor 220ml', 'milk-box-vinamilk-a&d3-strawberry-flavor-220ml', 'upload/products/thumbnail/1771606586419215_product_thumbnail.jpg', '99', 'new product', '220', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '24', '22', 'Product used for 1 year', '<p class=\"MsoNormal\">Made from 100% fresh milk containing many nutrients such as vitamins A, D3, calcium, ... good for bones and immune system. Vinamilk fresh milk is the leading trusted brand with excellent quality. Box of 48 bags of Vinamilk A&amp;D3 strawberry-flavored nutritional milk 220ml easy to drink.</p>\r\n<p class=\"MsoNormal\">Vinamilk A&amp;D3 pasteurized milk is delicious, easy to drink, and is fortified with many essential nutrients such as vitamins A, D3 and calcium, supporting the development of vision and strong bones.</p>\r\n<p class=\"MsoNormal\">Milk is produced by UTH pasteurization technology, which eliminates harmful bacteria while preserving nutrients.</p>\r\n<p class=\"MsoNormal\">User manual:</p>\r\n<p class=\"MsoNormal\">Direct use.</p>\r\n<p class=\"MsoNormal\">More delicious cold drink.</p>\r\n<p class=\"MsoNormal\">Preserve:</p>\r\n<p class=\"MsoNormal\">To a dry, cool place.</p>\r\n<p class=\"MsoNormal\">Should be used up after opening.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 19:28:20', '2023-07-17 06:39:07', NULL),
(103, 4, 7, 10, 28, '14321', 'TH true MILK low sugar milk 220ml box', 'th-true-milk-low-sugar-milk-220ml-box', 'upload/products/thumbnail/1771606816495269_product_thumbnail.jpg', '99', 'new product', '220', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '33', '30', 'Product used for 1 year', '<p class=\"MsoNormal\">TH True Milk is guaranteed to be free of flavorings, has a delicious taste of 100% pure fresh milk, contains many vitamins and minerals such as Vitamins A, D, B1, B2, calcium and zinc. Box of 48 bags of low-sugar pasteurized milk TH true MILK 220ml convenient, economical, can be used for a long time, low in sugar, easy to drink.</p>\r\n<p class=\"MsoNormal\">TH true MILK low-sugar fresh milk is made entirely from clean fresh milk at TH\'s dairy farm, with the best conditions for dairy cow breeds, barn standards, and care:</p>\r\n<p class=\"MsoNormal\">The cows are free to move in the shelter with a roof, fan, listen to music and cool off every day to stimulate natural milk production.</p>\r\n<p class=\"MsoNormal\">Chip each dairy cow to detect disease and antibiotic residues, eliminating the risk of early puberty in children. As a result, TH true MILK milk ensures \"fresh\" and \"clean\" standards.</p>\r\n<p class=\"MsoNormal\">In February 2015, the Asian Record Organization confirmed TH farm as \"Asia\'s largest concentrated dairy farm with high-tech application\".</p>', NULL, NULL, NULL, 1, 1, 1, NULL, '2023-07-16 19:31:59', '2023-07-17 06:44:52', NULL),
(104, 4, 7, 10, 28, '12912', 'Box of 12 boxes of TH true MILK Organic fresh milk 500ml', 'box-of-12-boxes-of-th-true-milk-organic-fresh-milk-500ml', 'upload/products/thumbnail/1771607012038698_product_thumbnail.jpg', '99', 'new product', '500', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '40', '38', 'Product used for 1 year', '<p class=\"MsoNormal\">Supplement essential vitamins and nutrients (DHA, Folic Acid, Calcium, Vitamins B1, B6, C, D). TH True Milk helps to support optimal brain development, height, resistance and absorption of children. Box of 12 boxes of TH true MILK Organic sterilized fresh milk 500ml delicious taste from pure milk</p>\r\n<p class=\"MsoNormal\">TH True Milk Organic is pure pasteurized fresh milk using fresh cow\'s milk raised according to strict European organic standards.</p>\r\n<p class=\"MsoNormal\">Organic products do not contain preservatives, very safe for health, in milk also contain many essential nutrients as well as delicious, greasy taste.</p>\r\n<p class=\"MsoNormal\">Nutritional value</p>\r\n<p class=\"MsoNormal\">Box of 12 boxes of TH true MILK Organic fresh milk 500ml 0</p>\r\n<p class=\"MsoNormal\">Instructions for use and maintenance</p>\r\n<p class=\"MsoNormal\">Use directly. More delicious cold drink.</p>\r\n<p class=\"MsoNormal\">Preserved in dry, cool place.</p>\r\n<p class=\"MsoNormal\">After opening the box, keep refrigerated at 4 degrees C - 10 degrees C and use up within 3 days.</p>', NULL, 1, NULL, NULL, 1, 1, NULL, '2023-07-16 19:35:06', '2023-07-17 06:44:49', NULL),
(105, 4, 4, 1, 13, '12112', 'Broccoli 600g (1 flower)', 'broccoli-600g-(1-flower)', 'upload/products/thumbnail/1771609242962228_product_thumbnail.jpg', '99', 'new product', '600', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-19 17:00:00', '10', NULL, 'Product is used for 3 days', '<p>NEST\'s broccoli is grown in China and packed according to strict standards, ensuring green - clean, quality and safe standards for users. High nutritional content, sweet and crispy taste, so it is often used to prepare stir-fried or boiled dishes, helping to strengthen immunity.</p>', NULL, NULL, 1, NULL, 1, 1, NULL, '2023-07-16 19:41:28', '2023-07-17 06:44:45', NULL),
(106, 1, 2, 6, 12, '15243', 'Oishi cheese-flavored corn snack 32g', 'oishi-cheese-flavored-corn-snack-32g', 'upload/products/thumbnail/1771608046052450_product_thumbnail.jpg', '99', 'new product', '32', 'Gram', NULL, '2023-07-16 17:00:00', '2023-10-16 17:00:00', '2', NULL, 'Product used for 3 months', '<p>Delicious crispy corn snack, fragrant cheese flavor stimulates the taste buds immensely. Oishi cheese-flavored corn snack 32g attractive package, suitable for watching movies, listening to music and enjoying. Snack Oishi is convenient, compact, easy to carry for outdoor activities.</p>', NULL, NULL, 1, NULL, 1, NULL, NULL, '2023-07-16 19:51:32', '2023-07-17 05:11:15', NULL),
(107, 1, 3, 4, 27, '56879', '6 bottles of C2 peach red tea 455ml', '6-bottles-of-c2-peach-red-tea-455ml', 'upload/products/thumbnail/1771608304337057_product_thumbnail.jpg', '100', 'new product', '455', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '33', '30', 'Product used for 1 year', '<p>Distilled from 100% natural tea processed and bottled in the same day by C2 tea water, providing a wonderfully rich tea flavor. 6 bottles of C2 455ml peach red tea gives you a new choice in enjoying tea, helping to quench thirst and replenish energy for a long active day.<br>C2 is a famous brand of bottled tea in Vietnam introduced by URC Group since 2006. Made from selected Thai Nguyen tea leaves, C2 is extracted and bottled on the same day to help keep the flavor. delicious and the nutrients in the leaves. Not only has the original green tea product lines, C2 also develops black tea, milk tea, and red tea lines, combined with fruit flavors to give users many attractive choices such as lemon, peach , fabric, mint, ....<br>Nutritional performance of the product<br>The product is made from water, refined sugar, fermented tea leaves combined with delicious fresh peach flavor<br>Energy in 100ml is about 47 calories<br>The effect of the product on health<br>Delicious taste, strong aroma of tea, fresh peach taste<br>It is an effective refreshment drink, bringing a feeling of coolness and refreshment<br>Provide vitamin C to the body<br>Strengthen resistance<br>Thanks to the antioxidant content from tea, the product has the effect of helping to beautify the skin, prevent aging, prevent cancer, ...</p>', NULL, NULL, NULL, 1, 1, NULL, NULL, '2023-07-16 19:55:38', NULL, NULL),
(108, 1, 1, 4, 27, '54543', '6 bottles of C2 Freeze mint black tea 455ml', '6-bottles-of-c2-freeze-mint-black-tea-455ml', 'upload/products/thumbnail/1771608489552710_product_thumbnail.jpg', '89', 'new product', '4455', 'Mililiter', NULL, '2023-07-16 17:00:00', '2024-07-16 17:00:00', '25', '23', 'Product used for 1 year', '<p>Refreshing tea, new flavor comes from C2 tea. 6 bottles of C2 Freeze C2 Freeze Mint Melon Black Tea 455ml are cold and refreshing, helping to cool down the body. A safe, quality product brewed from 100% natural tea, doubling the cool taste of cantaloupe and mint<br>C2 was introduced by URC in 2006 and has become a prestigious brand of bottled tea in the beverage market in Vietnam. Vwowsis sources premium ingredients from selected Thai Nguyen green tea leaves that are extracted and bottled on the same day to keep the flavor and nutrition intact in the tea leaves. Besides the traditional flavors such as lemon, apple, peach, C2 also pampers customers with unique and fresh flavors that are loved by young people such as cherry strawberry, snow mint lemon, mint cantaloupe melon ,...<br>Nutritional ingredients in the product<br>The product is made from water, fermented tea leaves with cool mint flavor,...<br>The energy of the product is about 48 cal/100ml<br>The effect of the product on health<br>Delicious refreshments<br>Helps to relax the mind, bring a feeling of refreshment<br>Relieve fatigue, cool down life<br>Rich in antioxidants to help beautify skin, fight aging, prevent cancer, and sleep better</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 19:58:35', '2023-07-17 06:45:42', NULL),
(109, 1, 4, 1, 14, '2468', 'Thai enoki mushrooms 150g', 'thai-enoki-mushrooms-150g', 'upload/products/thumbnail/1771609013886171_product_thumbnail.jpg', '99', 'new product', '150', 'Gram', NULL, '2023-07-16 17:00:00', '2023-07-30 17:00:00', '12', '10', 'Product used for 1 week', '<p>Thai enoki mushrooms are fresh, carefully packaged, quality and safe for users. The mycelium is chewy, crispy and sweet, when cooked, it is very fragrant, so it is often rolled in deep-fried dough, cooked in soup or served with grilled.<br>Nutritional value of enoki mushrooms<br>Enoki mushrooms contain a lot of fiber that is good for the digestive system, along with nutrients such as protein, lipid, calcium, and amino acids that are good for the body.<br>In 100g of enoki mushrooms, there are about 37 Kcal.<br>Health benefits of shiitake mushrooms<br>Mushrooms help lower blood cholesterol<br>Helps support brain development<br>Improves digestive system effectively<br>Delicious dishes from enoki mushrooms<br>Needle mushroom soup cooked with minced meat.<br>Mushroom beef soup.<br>Three beef rolls with enoki mushrooms.<br>Spinach with enoki mushroom sauce.<br>How to preserve fresh enoki mushrooms?<br>Needle mushrooms purchased should be used immediately to feel the sweetness and freshness of mushrooms. If not used in time, it should be stored at a temperature of 5-10 degrees Celsius, used within 7 days from the date of manufacture. Or store in the refrigerator for 2-3 days<br>Note: The product received may be different from the picture in color and quantity, but it is still guaranteed in terms of volume and quality.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 20:06:55', '2023-07-17 05:11:15', NULL);
INSERT INTO `products` (`id`, `supplier_id`, `brand_id`, `category_id`, `subcategory_id`, `product_code`, `product_name`, `product_slug`, `product_thumbnail`, `product_quantity`, `product_tags`, `product_weight`, `product_measure`, `product_dimensions`, `manufacturing_date`, `expiry_date`, `selling_price`, `discount_price`, `short_description`, `long_description`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(110, 1, 4, 1, 14, '12864', 'Vi Lam pickled cabbage 500g pack', 'vi-lam-pickled-cabbage-500g-pack', 'upload/products/thumbnail/1771609191259998_product_thumbnail.jpg', '99', 'new product', '500', 'Gram', NULL, '2023-07-16 17:00:00', '2023-08-16 17:00:00', '10', '5', 'Product used for 1 month', '<p>It is a product from Vi Lam sourdough brand, which is loved and trusted by many consumers. Vi Lam pickled cabbage 500g package is made from delicious fresh reed vegetables with a mixture of water and salt, providing a stimulating, crunchy, and sour dish.<br>Pickled cabbage, also known as pickled cabbage, sauerkraut is a long-standing rustic dish of the Vietnamese people that is prepared by making pickled vegetables. The product of 500g pickles from Vy Lam brand is vacuum-cleaned and extremely convenient for housewives.</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2023-07-16 20:09:44', '2023-07-17 05:11:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `received_mails`
--

CREATE TABLE IF NOT EXISTS `received_mails` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `received_mails`
--

INSERT INTO `received_mails` (`id`, `email`, `subject`, `message`, `seen`, `status`, `created_at`, `updated_at`) VALUES
(5, 'hoangphuc270502@gmail.com', 'Hello', 'Green vegetables provide a variety of vitamins, minerals and fiber needed by the body such as vitamin A, vitamin C, vitamin K, folate and manganese. \r\nBesides, green vegetables also have a good effect on the digestive system, helping to reduce LDL (bad fat) and increase HDL (good fat), \r\nreduce the risk of cardiovascular disease and stabilize blood pressure.', 1, 1, '2023-07-14 06:14:48', '2023-07-14 06:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  KEY `reviews_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(16, 40, 3, 'Good', '5', '1', '2023-07-13 10:50:16', '2023-07-13 10:51:20'),
(17, 31, 19, 'good product!', '5', '1', '2023-07-14 06:06:27', '2023-07-14 06:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'web', '2023-06-26 02:29:19', '2023-06-26 02:29:19'),
(8, 'Admin', 'web', '2023-07-12 15:40:28', '2023-07-12 15:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE IF NOT EXISTS `seos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `meta_title`, `meta_author`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Nest', 'Nest', 'Nest', 'Nest Shop', '2023-06-25 04:39:43', '2023-07-01 15:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_us_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `support_phone`, `call_us_phone`, `email`, `company_address`, `hours`, `facebook`, `twitter`, `youtube`, `instagram`, `pinterest`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'upload/logo/1769647990657590_logo.svg', '1900 - 999', '1900 900', 'nest@gmail.com', 'Ho Chi Minh city, Viet Nam.', '09:00 - 21:00, Mon - Sun', 'https://www.facebook.com/laiminhkiet752', 'https://twitter.com/Kiet070502', 'https://www.youtube.com/channel/UCx7yneP9y9BDz776MzIkdqg', 'https://www.instagram.com/kiet_7522/', 'https://www.pinterest.com/kietminh070502/', 'Nest. 2023 All rights reserved', '2023-06-25 04:34:30', '2023-06-25 04:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_title`, `short_title`, `slider_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fresh Vegetables Big Discount', 'Save up to 50% off on your first order', 'upload/slider/1769647113915006_slider.png', 'show', '2023-06-25 04:23:22', NULL),
(2, 'Don’t Miss Amazing Grocery Deals', 'Sign up for the daily newsletter', 'upload/slider/1769647122929714_slider.png', 'show', '2023-06-25 04:23:30', '2023-07-16 11:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE IF NOT EXISTS `smtp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smtp_settings`
--

INSERT INTO `smtp_settings` (`id`, `mailer`, `host`, `port`, `username`, `password`, `encryption`, `from_address`, `from_name`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', '587', 'no.reply.nestshop@gmail.com', 'cakvhzwnbgksdjuk', 'tls', 'no.reply.nestshop@gmail.com', 'NestShop', '2023-07-01 15:24:08', '2023-07-03 14:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kietminh070502@gmail.com', '', 'Active', '2023-07-15 10:30:30', '2023-07-15 10:30:48'),
(2, 'laiminhkiet07052002@gmail.com', '', 'active', '2023-07-15 10:31:54', '2023-07-15 10:31:54'),
(3, 'hoangphuc270502@gmail.com', '', 'Active', '2023-07-15 10:32:17', '2023-07-15 10:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_categories_subcategory_name_unique` (`subcategory_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `created_at`, `updated_at`) VALUES
(3, 3, 'SHRIMP', 'shrimp', '2023-06-25 03:54:57', '2023-07-16 15:58:49'),
(4, 3, 'INK', 'ink', '2023-06-25 03:55:14', '2023-07-16 15:57:49'),
(5, 5, 'DOG\'S FOOD', 'dog\'s-food', '2023-06-25 03:55:25', '2023-06-25 03:55:44'),
(6, 5, 'CAT\'S FOOD', 'cat\'s-food', '2023-06-25 03:55:53', '2023-06-25 03:55:53'),
(7, 2, 'GRAPE', 'grape', '2023-06-25 03:57:19', '2023-06-25 03:57:19'),
(8, 2, 'STRAWBERRY', 'strawberry', '2023-06-25 03:57:31', '2023-06-25 03:57:31'),
(9, 7, 'DUCK\'S EGG', 'duck\'s-egg', '2023-06-25 03:57:50', '2023-07-05 07:40:35'),
(10, 7, 'QUAIL\'S EGGS', 'quail\'s-eggs', '2023-06-25 03:58:13', '2023-07-16 15:58:13'),
(11, 6, 'BOX FORM', 'box-form', '2023-06-25 03:58:33', '2023-07-08 13:57:29'),
(12, 6, 'BAG FORM', 'bag-form', '2023-06-25 03:58:45', '2023-07-08 13:57:10'),
(13, 1, 'BROCCOLI', 'broccoli', '2023-06-25 07:01:24', '2023-06-25 07:01:24'),
(14, 1, 'SPINACH', 'spinach', '2023-06-25 07:01:44', '2023-06-25 07:01:44'),
(15, 1, 'POWDER FORM', 'powder-form', '2023-07-08 12:44:07', '2023-07-08 12:53:36'),
(16, 2, 'BANANA', 'banana', '2023-07-08 12:57:18', '2023-07-08 12:57:18'),
(17, 2, 'WATERMELON', 'watermelon', '2023-07-08 13:03:25', '2023-07-08 13:03:25'),
(21, 3, 'FISH', 'fish', '2023-07-08 14:25:17', '2023-07-16 15:59:13'),
(24, 4, 'COCA COLA', 'coca-cola', '2023-07-10 02:41:01', '2023-07-10 02:41:01'),
(25, 4, 'MIRINDA', 'mirinda', '2023-07-10 02:41:19', '2023-07-10 02:41:19'),
(26, 4, 'PEPSI', 'pepsi', '2023-07-10 02:41:41', '2023-07-10 02:41:41'),
(27, 4, 'C2', 'c2', '2023-07-10 02:42:16', '2023-07-10 02:42:16'),
(28, 10, 'TH TRUE MILK', 'th-true-milk', '2023-07-14 05:19:15', '2023-07-14 05:19:15'),
(29, 10, 'VINAMILK', 'vinamilk', '2023-07-16 19:09:23', '2023-07-16 19:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'John Cena', '0775083587', 'Jonhcena@gmail.com', 'Room No.5, Linh Dam Building, Hoang Liet Street, Hoang Mai District, Ha Noi City', 1, 1, NULL, '2023-07-13 23:57:52', '2023-07-17 06:59:31'),
(4, 'Azura', '0364545432', 'azura1990@gmail.com', 'No. 9128, 8th floor, Vinsmart city apartment, Nam Tu Liem district, Hanoi', 1, 1, NULL, '2023-07-17 07:00:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_seen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `youtube_link`, `facebook_link`, `role`, `status`, `last_seen`, `token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'superadmin', 'kietminh070502@gmail.com', '2023-06-25 04:38:43', '$2y$10$uu2EfLVbBPrcAbjdtWJQXuCpXcr/4LrjSVjTjmxn5gR8TtiuyU7T6', '1769826218799972_admin.jpg', '0376707091', 'Sailing Tower, 111A Pasteur Street, District 1, Ho Chi Minh City', NULL, NULL, 'admin', 'active', '2023-07-17 16:33:11', '', NULL, '2023-06-25 03:22:55', '2023-07-17 09:33:11'),
(3, 'Minh Kiet', 'laiminhkiet', 'laiminhkiet07052002@gmail.com', '2023-07-15 04:40:34', '$2y$10$u4/aWCAb54dTcCN.3h5gTuEMY.S0qktFqgOJtLwpMXDMmoTg9kCn.', '1769648355286070_user.jpg', '0793442309', '246, street 8, Ward 6, Vo Gap district, Ho Chi Minh city', NULL, NULL, 'user', 'active', '2023-07-17 17:23:52', NULL, 'hvEO6fnJDPXMcg4Lx1fmImp4QQXkWlgfbjoRuxar8gxC3v2379PpndqZT5Wk', '2023-06-25 03:22:56', '2023-07-17 10:23:52'),
(19, 'Hoang Phuc', 'lenguyenhoangphuc', 'hoangphuc270502@gmail.com', '2023-07-14 05:29:34', '$2y$10$7NF27CFRA5TwdDQyt8oCQu8zqzGLVcgF0w6f0nrACl9z1/sKx.kfu', '1771372677495297_user.png', '0332964321', NULL, NULL, NULL, 'user', 'active', '2023-07-14 13:18:14', NULL, NULL, '2023-07-14 05:29:12', '2023-07-14 06:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_returns`
--
ALTER TABLE `order_returns`
  ADD CONSTRAINT `order_returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
