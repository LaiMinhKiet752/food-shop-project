-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table food_shop_project.advance_salaries
DROP TABLE IF EXISTS `advance_salaries`;
CREATE TABLE IF NOT EXISTS `advance_salaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advance_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.advance_salaries: ~0 rows (approximately)
DELETE FROM `advance_salaries`;
INSERT INTO `advance_salaries` (`id`, `employee_id`, `month`, `year`, `advance_salary`, `created_at`, `updated_at`) VALUES
	(2, 2, 'July', '2023', '0', '2023-07-15 09:20:57', NULL);

-- Dumping structure for table food_shop_project.attendances
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.attendances: ~0 rows (approximately)
DELETE FROM `attendances`;

-- Dumping structure for table food_shop_project.banners
DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.banners: ~3 rows (approximately)
DELETE FROM `banners`;
INSERT INTO `banners` (`id`, `banner_title`, `banner_image`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'The Best Organic Products Online', 'upload/banner/1817613662439842_banner.png', 'show', '2023-06-25 04:24:21', '2024-12-05 15:11:07'),
	(2, 'Everyday Fresh & Clean With Our Products', 'upload/banner/1817613536987090_banner.png', 'show', '2023-06-25 04:24:29', '2024-12-05 15:09:07'),
	(3, 'Make your Breakfast Healthy and Easy', 'upload/banner/1817613529953042_banner.png', 'show', '2023-06-25 04:24:36', '2024-12-05 15:09:01');

-- Dumping structure for table food_shop_project.blog_categories
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.blog_categories: ~3 rows (approximately)
DELETE FROM `blog_categories`;
INSERT INTO `blog_categories` (`id`, `blog_category_name`, `blog_category_slug`, `created_at`, `updated_at`) VALUES
	(1, 'Pet Foods', 'pet-foods', '2023-06-25 09:44:09', NULL),
	(6, 'Fresh Fruit', 'fresh-fruit', '2023-07-10 14:19:23', NULL),
	(7, 'Baking Material', 'baking-material', '2023-07-10 14:19:31', NULL);

-- Dumping structure for table food_shop_project.blog_comments
DROP TABLE IF EXISTS `blog_comments`;
CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_post_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.blog_comments: ~1 rows (approximately)
DELETE FROM `blog_comments`;
INSERT INTO `blog_comments` (`id`, `blog_post_id`, `user_id`, `parent_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
	(11, 10, 3, NULL, 'I just spent a great food shopping holiday on this newly discovered site. \r\nWith a simple and easy to use interface, the website has brought a great shopping experience to me!', 0, '2023-07-17 07:40:10', NULL);

-- Dumping structure for table food_shop_project.blog_posts
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `post_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_long_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.blog_posts: ~4 rows (approximately)
DELETE FROM `blog_posts`;
INSERT INTO `blog_posts` (`id`, `category_id`, `post_title`, `post_slug`, `post_image`, `post_short_description`, `post_long_description`, `views`, `created_at`, `updated_at`) VALUES
	(3, 1, 'I Tried 38 Different Bottles of Mustard — These Are the Ones I’ll Buy Again', 'i-tried-38-different-bottles-of-mustard-—-these-are-the-ones-i’ll-buy-again', 'upload/blog/1769667585655316.png', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nAnimi, quas veniam? Quisquam aliquid ipsum alias, ipsa quasi veritatis porro quidem, fuga deserunt magnam illum rem quod.', '<p class="single-excerpt">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class="mt-50">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>\r\n<p><img class="mb-30" src="assets/imgs/blog/blog-21.png" alt=""></p>\r\n<p>Tortor, lobortis semper viverra ac, molestie tortor laoreet amet euismod et diam quis aliquam consequat porttitor integer a nisl, in faucibus nunc et aenean turpis dui dignissim nec scelerisque ullamcorper eu neque, augue quam quis lacus pretium eros est amet turpis nunc in turpis massa et eget facilisis ante molestie penatibus dolor volutpat, porta pellentesque scelerisque at ornare dui tincidunt cras feugiat tempor lectus</p>\r\n<blockquote>\r\n<p>Integer eu faucibus&nbsp;<a href="#">dolor</a><sup><a href="#">[5]</a></sup>. Ut venenatis tincidunt diam elementum imperdiet. Etiam accumsan semper nisl eu congue. Sed aliquam magna erat, ac eleifend lacus rhoncus in.</p>\r\n</blockquote>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet id enim, libero sit. Est donec lobortis cursus amet, cras elementum libero convallis feugiat. Nulla faucibus facilisi tincidunt a arcu, sem donec sed sed. Tincidunt morbi scelerisque lectus non. At leo mauris, vel augue. Facilisi diam consequat amet, commodo lorem nisl, odio malesuada cras. Tempus lectus sed libero viverra ut. Facilisi rhoncus elit sit sit.</p>', 14, '2023-06-25 09:48:45', '2023-07-10 02:53:47'),
	(8, 7, 'The Easy Italian Chicken Dinner I Make Over and Over Again', 'the-easy-italian-chicken-dinner-i-make-over-and-over-again', 'upload/blog/1771043657873732.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '<p class="single-excerpt">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class="mt-50">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>\r\n<p><img class="mb-30" src="assets/imgs/blog/blog-21.png" alt=""></p>\r\n<p>Tortor, lobortis semper viverra ac, molestie tortor laoreet amet euismod et diam quis aliquam consequat porttitor integer a nisl, in faucibus nunc et aenean turpis dui dignissim nec scelerisque ullamcorper eu neque, augue quam quis lacus pretium eros est amet turpis nunc in turpis massa et eget facilisis ante molestie penatibus dolor volutpat, porta pellentesque scelerisque at ornare dui tincidunt cras feugiat tempor lectus</p>\r\n<blockquote>\r\n<p>Integer eu faucibus&nbsp;<a href="#">dolor</a><sup><a href="#">[5]</a></sup>. Ut venenatis tincidunt diam elementum imperdiet. Etiam accumsan semper nisl eu congue. Sed aliquam magna erat, ac eleifend lacus rhoncus in.</p>\r\n</blockquote>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Amet id enim, libero sit. Est donec lobortis cursus amet, cras elementum libero convallis feugiat. Nulla faucibus facilisi tincidunt a arcu, sem donec sed sed. Tincidunt morbi scelerisque lectus non. At leo mauris, vel augue. Facilisi diam consequat amet, commodo lorem nisl, odio malesuada cras. Tempus lectus sed libero viverra ut. Facilisi rhoncus elit sit sit.</p>', 9, '2023-07-10 14:20:50', '2024-12-02 03:04:09'),
	(9, 6, 'Best smartwatch 2022: the top wearables you can buy today', 'best-smartwatch-2022:-the-top-wearables-you-can-buy-today', 'upload/blog/1771043717813364.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '<p class="single-excerpt">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class="mt-50">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>', NULL, '2023-07-10 14:21:47', NULL),
	(10, 1, '9 Tasty Ideas That Will Inspire You to Grow a Home Herb Garden Today', '9-tasty-ideas-that-will-inspire-you-to-grow-a-home-herb-garden-today', 'upload/blog/1771043757006279.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '<p class="single-excerpt">Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>\r\n<p>We\'ve reviewed and ranked all of the best smartwatches on the market right now, and we\'ve made a definitive list of the top 10 devices you can buy today. One of the 10 picks below may just be your perfect next smartwatch.</p>\r\n<p>Those top-end wearables span from the Apple Watch to Fitbits, Garmin watches to Tizen-sporting Samsung watches. There\'s also Wear OS which is Google\'s own wearable operating system in the vein of Apple\'s watchOS - you&rsquo;ll see it show up in a lot of these devices.</p>\r\n<h5 class="mt-50">Lorem ipsum dolor sit amet cons</h5>\r\n<p>Throughout our review process, we look at the design, features, battery life, spec, price and more for each smartwatch, rank it against the competition and enter it into the list you\'ll find below.</p>', 20, '2023-07-10 14:22:24', '2024-12-02 07:35:34');

-- Dumping structure for table food_shop_project.brands
DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_brand_name_unique` (`brand_name`),
  UNIQUE KEY `brands_brand_email_unique` (`brand_email`),
  UNIQUE KEY `brands_brand_phone_unique` (`brand_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.brands: ~1 rows (approximately)
DELETE FROM `brands`;
INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `brand_image`, `brand_email`, `brand_phone`, `brand_address`, `created_at`, `updated_at`) VALUES
	(1, 'BẢO LINH', 'bẢo-linh', 'upload/brand/1771372104341326_brand.jpg', 'contact.baolinh@gmail.com', '0376707091', '123 Lý Thường Kiệt Phường 4, Quận Gò Vấp, Thành phố Hồ Chí Minh', '2023-07-14 05:21:20', '2024-12-03 07:52:49');

-- Dumping structure for table food_shop_project.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_category_name_unique` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.categories: ~1 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_image`, `created_at`, `updated_at`) VALUES
	(1, 'KHÔ CÁ CHAY', 'khÔ-cÁ-chay', 'upload/category/1814146321902002_category.svg', '2023-06-25 03:36:54', '2024-12-03 07:54:45');

-- Dumping structure for table food_shop_project.compares
DROP TABLE IF EXISTS `compares`;
CREATE TABLE IF NOT EXISTS `compares` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.compares: ~0 rows (approximately)
DELETE FROM `compares`;

-- Dumping structure for table food_shop_project.coupons
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_discount` int NOT NULL,
  `coupon_validity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.coupons: ~0 rows (approximately)
DELETE FROM `coupons`;
INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_discount`, `coupon_validity`, `status`, `created_at`, `updated_at`) VALUES
	(7, 'NEST', 50, '2025-11-01', 1, '2023-07-17 08:24:51', '2024-10-28 02:07:10');

-- Dumping structure for table food_shop_project.coupon_uses
DROP TABLE IF EXISTS `coupon_uses`;
CREATE TABLE IF NOT EXISTS `coupon_uses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.coupon_uses: ~0 rows (approximately)
DELETE FROM `coupon_uses`;
INSERT INTO `coupon_uses` (`id`, `coupon_code`, `user_id`, `created_at`, `updated_at`) VALUES
	(23, 'NEST', 3, '2024-12-05 14:34:34', NULL);

-- Dumping structure for table food_shop_project.employees
DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_code_unique` (`employee_code`),
  UNIQUE KEY `employees_employee_email_unique` (`employee_email`),
  UNIQUE KEY `employees_employee_phone_unique` (`employee_phone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.employees: ~1 rows (approximately)
DELETE FROM `employees`;
INSERT INTO `employees` (`id`, `employee_code`, `employee_name`, `employee_email`, `employee_phone`, `employee_address`, `employee_photo`, `position`, `experience`, `salary`, `created_at`, `updated_at`) VALUES
	(2, 'NEST100', 'David', 'david1122@gmail.com', '0567891234', 'No. 117, 8/32 Alley, 199 lane, 16 cluster, Ho Tung Mau street, Mai Dich ward, Cau Giay district, Ha Noi', 'upload/employee_images/1771477776365427_employee.png', 'Shipper', '1 Year', '1000', '2023-07-15 09:20:57', '2023-07-17 08:03:04');

-- Dumping structure for table food_shop_project.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table food_shop_project.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.migrations: ~38 rows (approximately)
DELETE FROM `migrations`;
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
	(67, '2023_07_16_222534_create_coupon_uses_table', 27),
	(68, '2024_12_05_142713_create_currencies_table', 28),
	(69, '2024_12_05_142820_create_exchange_rates_table', 29);

-- Dumping structure for table food_shop_project.model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.model_has_permissions: ~0 rows (approximately)
DELETE FROM `model_has_permissions`;

-- Dumping structure for table food_shop_project.model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.model_has_roles: ~2 rows (approximately)
DELETE FROM `model_has_roles`;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(8, 'App\\Models\\User', 4);

-- Dumping structure for table food_shop_project.multi_images
DROP TABLE IF EXISTS `multi_images`;
CREATE TABLE IF NOT EXISTS `multi_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `photo_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.multi_images: ~0 rows (approximately)
DELETE FROM `multi_images`;

-- Dumping structure for table food_shop_project.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.notifications: ~3 rows (approximately)
DELETE FROM `notifications`;
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `status`, `created_at`, `updated_at`) VALUES
	('35b1b5f8-c48a-4252-8ebe-96d57627b466', 'App\\Notifications\\OrderCompleteNotification', 'App\\Models\\User', 1, '{"message":"A new order has been placed","type":"new_order"}', '2024-12-05 14:35:35', 1, '2024-12-05 14:35:01', '2024-12-05 14:35:35'),
	('526c9ac7-9cca-452a-a7c2-fe022bd06076', 'App\\Notifications\\CancelOrderNotification', 'App\\Models\\User', 1, '{"message":"A request to cancel the order","type":"cancel_order"}', '2024-12-05 14:45:25', 0, '2024-12-05 14:44:22', '2024-12-05 14:45:25'),
	('aaa7a03e-5bbf-4324-9bdb-83e206884462', 'App\\Notifications\\ReturnOrderNotification', 'App\\Models\\User', 1, '{"message":"A request to return the order","type":"return_order"}', '2024-12-05 14:45:25', 1, '2024-12-05 14:45:13', '2024-12-05 14:45:25');

-- Dumping structure for table food_shop_project.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmed_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picked_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipped_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_day` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `return_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.orders: ~3 rows (approximately)
DELETE FROM `orders`;
INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `post_code`, `notes`, `payment_method`, `payment_type`, `transaction_id`, `order_number`, `invoice_number`, `amount`, `discount`, `currency`, `order_date`, `order_day`, `order_month`, `order_year`, `confirmed_date`, `processing_date`, `picked_date`, `shipped_date`, `delivered_date`, `delivered_day`, `delivered_month`, `delivered_year`, `cancel_date`, `cancel_order_status`, `return_date`, `return_reason`, `return_order_status`, `status`, `created_at`, `updated_at`) VALUES
	(15, 3, 'Minh Kiet', 'laiminhkiet07052002@gmail.com', '0793442309', '246, street 8, Ward 6, Vo Gap district, Ho Chi Minh city', '738000', NULL, 'Stripe', 'Thẻ tín dụng', 'cs_test_a1ZtjUo0UJLOZZMT182EooGckb8wBYaEQ33aau68IdOGEs1Fh7PZx9dzZE', '1817608180091258', 'BL1733406261687632', 77500.00, 52500.00, 'VND', '05-12-2024 20:44:21', '05', '12', '2024', '05-12-2024 21:39:39', '05-12-2024 21:39:44', NULL, NULL, '05-12-2024 21:39:50', '05', '12', '2024', NULL, '0', '05-12-2024 21:45:13', 'Sản phẩm bị vỡ', '2', 'delivered', '2024-12-05 13:44:21', '2024-12-05 14:45:34'),
	(16, 3, 'Minh Kiet', 'laiminhkiet07052002@gmail.com', '0793442309', '246, street 8, Ward 6, Vo Gap district, Ho Chi Minh city', '738000', NULL, 'Paypal', 'Thẻ tín dụng', '9KY37359KN999122X', '1817609839893180', 'BL1733407832997110', 100000.00, 75000.00, 'VND', '05-12-2024 21:10:32', '05', '12', '2024', '05-12-2024 21:40:03', '05-12-2024 21:40:07', NULL, NULL, '05-12-2024 21:40:11', '05', '12', '2024', NULL, '0', NULL, NULL, '0', 'delivered', '2024-12-05 14:10:32', '2024-12-05 14:40:11'),
	(17, 3, 'Minh Kiet', 'laiminhkiet07052002@gmail.com', '0793442309', '246, street 8, Ward 6, Vo Gap district, Ho Chi Minh city', '738000', NULL, 'Stripe', 'Thẻ tín dụng', 'cs_test_a1ylZziuVS7F9UwVTO3LcwgnGdLN7uE8JbGsyPxZaHtaz9LAkIuNvWMdkv', '1817611329865050', 'BL1733409274407215', 215000.00, 215000.00, 'VND', '05-12-2024 21:34:34', '05', '12', '2024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '05-12-2024 21:44:13', '1', NULL, NULL, '0', 'pending', '2024-12-05 14:34:34', '2024-12-05 14:44:13');

-- Dumping structure for table food_shop_project.order_details
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `brand_id` int DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.order_details: ~8 rows (approximately)
DELETE FROM `order_details`;
INSERT INTO `order_details` (`id`, `order_id`, `brand_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
	(41, 15, 1, 119, 25000.00, '1', '2024-12-05 13:44:21', NULL),
	(42, 15, 1, 118, 80000.00, '1', '2024-12-05 13:44:21', NULL),
	(43, 16, 1, 119, 25000.00, '1', '2024-12-05 14:10:32', NULL),
	(44, 16, 1, 120, 125000.00, '1', '2024-12-05 14:10:32', NULL),
	(45, 17, 1, 121, 50000.00, '1', '2024-12-05 14:34:34', NULL),
	(46, 17, 1, 120, 125000.00, '2', '2024-12-05 14:34:34', NULL),
	(47, 17, 1, 119, 25000.00, '2', '2024-12-05 14:34:34', NULL),
	(48, 17, 1, 118, 80000.00, '1', '2024-12-05 14:34:34', NULL);

-- Dumping structure for table food_shop_project.order_returns
DROP TABLE IF EXISTS `order_returns`;
CREATE TABLE IF NOT EXISTS `order_returns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_returns_order_id_foreign` (`order_id`),
  CONSTRAINT `order_returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.order_returns: ~2 rows (approximately)
DELETE FROM `order_returns`;
INSERT INTO `order_returns` (`id`, `order_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 15, 119, 25000.00, 1, '2024-12-05 14:45:34', NULL),
	(2, 15, 118, 80000.00, 1, '2024-12-05 14:45:34', NULL);

-- Dumping structure for table food_shop_project.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.password_resets: ~1 rows (approximately)
DELETE FROM `password_resets`;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('laiminhkiet07052002@gmail.com', '$2y$10$a/QdcqLzZGSKnHn.5HuSbOoxjk9iDbFIiMb2MYSEGMsfke1LoZ0C2', '2024-12-05 15:24:54');

-- Dumping structure for table food_shop_project.pay_salaries
DROP TABLE IF EXISTS `pay_salaries`;
CREATE TABLE IF NOT EXISTS `pay_salaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `salary_month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advance_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.pay_salaries: ~1 rows (approximately)
DELETE FROM `pay_salaries`;
INSERT INTO `pay_salaries` (`id`, `employee_id`, `salary_month`, `salary_year`, `paid_amount`, `advance_salary`, `due_salary`, `created_at`, `updated_at`) VALUES
	(2, 2, 'July', '2023', '1000', '0', '1000', '2023-07-17 05:35:04', NULL);

-- Dumping structure for table food_shop_project.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.permissions: ~74 rows (approximately)
DELETE FROM `permissions`;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
	(1, 'brand.menu', 'web', 'brand', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(2, 'brand.list', 'web', 'brand', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(3, 'brand.add', 'web', 'brand', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(4, 'brand.edit', 'web', 'brand', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(5, 'brand.delete', 'web', 'brand', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(6, 'category.menu', 'web', 'category', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(7, 'category.list', 'web', 'category', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(8, 'category.add', 'web', 'category', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(9, 'category.edit', 'web', 'category', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(10, 'category.delete', 'web', 'category', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(11, 'subcategory.menu', 'web', 'subcategory', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(12, 'subcategory.list', 'web', 'subcategory', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(13, 'subcategory.add', 'web', 'subcategory', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(14, 'subcategory.edit', 'web', 'subcategory', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(15, 'subcategory.delete', 'web', 'subcategory', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(16, 'product.menu', 'web', 'product', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(17, 'product.list', 'web', 'product', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(18, 'product.add', 'web', 'product', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(19, 'product.add.from.returned.orders', 'web', 'product', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(20, 'product.edit', 'web', 'product', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(21, 'product.delete', 'web', 'product', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(22, 'product.restore', 'web', 'product', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(23, 'inventory.menu', 'web', 'inventory', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(24, 'slider.menu', 'web', 'slider', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(25, 'slider.list', 'web', 'slider', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(26, 'slider.add', 'web', 'slider', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(27, 'slider.edit', 'web', 'slider', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(28, 'slider.delete', 'web', 'slider', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(29, 'banner.menu', 'web', 'banner', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(30, 'banner.list', 'web', 'banner', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(31, 'banner.add', 'web', 'banner', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(32, 'banner.edit', 'web', 'banner', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(33, 'banner.delete', 'web', 'banner', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(34, 'coupon.menu', 'web', 'coupon', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(35, 'coupon.list', 'web', 'coupon', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(36, 'coupon.add', 'web', 'coupon', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(37, 'coupon.edit', 'web', 'coupon', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(38, 'coupon.delete', 'web', 'coupon', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(39, 'order.menu', 'web', 'order', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(40, 'return.order.menu', 'web', 'return order', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(41, 'cancel.order.menu', 'web', 'cancel order', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(42, 'report.order.menu', 'web', 'report order', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(43, 'supplier.menu', 'web', 'supplier', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(44, 'supplier.list', 'web', 'supplier', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(45, 'supplier.add', 'web', 'supplier', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(46, 'supplier.edit', 'web', 'supplier', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(47, 'supplier.delete', 'web', 'supplier', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(48, 'purchase.menu', 'web', 'purchase', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(49, 'purchase.list', 'web', 'purchase', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(50, 'purchase.add', 'web', 'purchase', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(51, 'purchase.approve', 'web', 'purchase', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(52, 'purchase.report', 'web', 'purchase', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(53, 'contact.menu', 'web', 'contact', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(54, 'blog.menu', 'web', 'blog', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(55, 'review.menu', 'web', 'review', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(56, 'setting.menu', 'web', 'setting', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(57, 'subscriber.menu', 'web', 'subscriber', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(58, 'roles.permissions.menu', 'web', 'roles and permissions', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(59, 'admin.user.account.menu', 'web', 'admin user account', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(60, 'user.management.menu', 'web', 'user management', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(61, 'employee.menu', 'web', 'employee', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(62, 'employee.list', 'web', 'employee', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(63, 'employee.add', 'web', 'employee', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(64, 'employee.edit', 'web', 'employee', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(65, 'employee.delete', 'web', 'employee', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(66, 'employee.salary.menu', 'web', 'employee salary', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(67, 'employee.salary.list', 'web', 'employee salary', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(68, 'employee.salary.edit', 'web', 'employee salary', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(69, 'employee.pay.salary', 'web', 'employee salary', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(70, 'employee.search.pay.salary.by.month', 'web', 'employee salary', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(71, 'timekeeping.menu', 'web', 'timekeeping', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(72, 'timekeeping.by.day', 'web', 'timekeeping', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(73, 'timekeeping.by.month', 'web', 'timekeeping', '2023-07-19 16:12:03', '2023-07-19 16:12:03'),
	(74, 'database.backup', 'web', 'database backup', '2023-07-19 16:12:03', '2023-07-19 16:12:03');

-- Dumping structure for table food_shop_project.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table food_shop_project.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  `category_id` int NOT NULL,
  `subcategory_id` int NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_measure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_dimensions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturing_date` timestamp NULL DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `selling_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `hot_deals` int DEFAULT NULL,
  `featured` int DEFAULT NULL,
  `special_offer` int DEFAULT NULL,
  `special_deals` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_product_code_unique` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.products: ~4 rows (approximately)
DELETE FROM `products`;
INSERT INTO `products` (`id`, `supplier_id`, `brand_id`, `category_id`, `subcategory_id`, `product_code`, `product_name`, `product_slug`, `product_thumbnail`, `product_quantity`, `product_tags`, `product_weight`, `product_measure`, `product_dimensions`, `manufacturing_date`, `expiry_date`, `selling_price`, `discount_price`, `short_description`, `long_description`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(118, 1, 1, 1, 1, 'SP01', 'Product 1', 'product-1', 'upload/products/thumbnail/1817564162091204_product_thumbnail.png', '91', 'sản phẩm mới', '100', 'Gram', '20x20x10', '2024-12-04 17:00:00', '2024-12-30 17:00:00', '100000', '80000', 'abc', '<p>xyz</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2024-12-05 02:04:20', '2024-12-05 14:44:13', NULL),
	(119, 1, 1, 1, 1, 'SP02', 'Product 2Product 2Product 2Product 2', 'product-2product-2product-2product-2', 'upload/products/thumbnail/1817564251307262_product_thumbnail.png', '193', 'sản phẩm mới', '200', 'Mililiter', '10x15x10', '2024-12-04 17:00:00', '2024-12-30 17:00:00', '25000', NULL, 'sbc', '<p>xyz</p>', NULL, 1, NULL, NULL, 1, 1, NULL, '2024-12-05 02:05:45', '2024-12-05 14:44:13', NULL),
	(120, 1, 1, 1, 1, 'SP03', 'Product 3', 'product-3', 'upload/products/thumbnail/1817564330675692_product_thumbnail.png', '196', 'sản phẩm mới', '1.5', 'Kilogam', '5x10x15', '2024-12-04 17:00:00', '2024-12-30 17:00:00', '150000', '125000', 'abc', '<p>xyz</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2024-12-05 02:07:01', '2024-12-05 14:44:13', NULL),
	(121, 1, 1, 1, 1, 'SP04', 'Test 4', 'test-4', 'upload/products/thumbnail/1817566753012637_product_thumbnail.png', '118', 'sản phẩm mới', '1', 'Kilogam', '20x20x20', '2024-12-04 17:00:00', '2024-12-30 17:00:00', '50000', NULL, 'abc', '<p>xyz</p>', NULL, NULL, NULL, NULL, 1, NULL, NULL, '2024-12-05 02:45:31', '2024-12-05 14:44:13', NULL);

-- Dumping structure for table food_shop_project.purchases
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `category_id` int NOT NULL,
  `product_id` int NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_order_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `total_price` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Approved',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.purchases: ~0 rows (approximately)
DELETE FROM `purchases`;

-- Dumping structure for table food_shop_project.received_mails
DROP TABLE IF EXISTS `received_mails`;
CREATE TABLE IF NOT EXISTS `received_mails` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.received_mails: ~1 rows (approximately)
DELETE FROM `received_mails`;
INSERT INTO `received_mails` (`id`, `email`, `subject`, `message`, `seen`, `status`, `created_at`, `updated_at`) VALUES
	(5, 'hoangphuc270502@gmail.com', 'Hello', 'Green vegetables provide a variety of vitamins, minerals and fiber needed by the body such as vitamin A, vitamin C, vitamin K, folate and manganese. \r\nBesides, green vegetables also have a good effect on the digestive system, helping to reduce LDL (bad fat) and increase HDL (good fat), \r\nreduce the risk of cardiovascular disease and stabilize blood pressure.', 1, 1, '2023-07-14 06:14:48', '2024-10-28 01:23:44');

-- Dumping structure for table food_shop_project.reviews
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_product_id_foreign` (`product_id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.reviews: ~0 rows (approximately)
DELETE FROM `reviews`;

-- Dumping structure for table food_shop_project.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.roles: ~2 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'SuperAdmin', 'web', '2023-06-26 02:29:19', '2023-06-26 02:29:19'),
	(8, 'Admin', 'web', '2023-07-12 15:40:28', '2023-07-12 15:40:28');

-- Dumping structure for table food_shop_project.role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.role_has_permissions: ~74 rows (approximately)
DELETE FROM `role_has_permissions`;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1);

-- Dumping structure for table food_shop_project.seos
DROP TABLE IF EXISTS `seos`;
CREATE TABLE IF NOT EXISTS `seos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.seos: ~1 rows (approximately)
DELETE FROM `seos`;
INSERT INTO `seos` (`id`, `meta_title`, `meta_author`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
	(1, 'Nest', 'Nest', 'Nest', 'Nest Shop', '2023-06-25 04:39:43', '2023-07-01 15:19:47');

-- Dumping structure for table food_shop_project.site_settings
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_us_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `hours` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.site_settings: ~1 rows (approximately)
DELETE FROM `site_settings`;
INSERT INTO `site_settings` (`id`, `logo`, `support_phone`, `call_us_phone`, `email`, `company_address`, `hours`, `facebook`, `twitter`, `youtube`, `instagram`, `pinterest`, `copyright`, `created_at`, `updated_at`) VALUES
	(1, 'upload/logo/1817610504220465_logo.png', '1900 - 999', '1900 - 900', 'baolinhchay@gmail.com', '10 Lê Lai, Quận 1, Thành phố Hồ Chí Minh', '09:00 - 21:00, Thứ Hai - Chủ Nhật', 'https://www.facebook.com/laiminhkiet752', 'https://twitter.com/Kiet070502', 'https://www.youtube.com/channel/UCx7yneP9y9BDz776MzIkdqg', 'https://www.instagram.com/kiet_7522/', 'https://www.pinterest.com/kietminh070502/', 'Bao Linh. 2024 All rights reserved', '2023-06-25 04:34:30', '2024-12-05 14:20:55');

-- Dumping structure for table food_shop_project.sliders
DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('show','hide') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'show',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.sliders: ~2 rows (approximately)
DELETE FROM `sliders`;
INSERT INTO `sliders` (`id`, `slider_title`, `short_title`, `slider_image`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Fresh Vegetables Big Discount', 'Save up to 50% off on your first order', 'upload/slider/1769647113915006_slider.png', 'show', '2023-06-25 04:23:22', NULL),
	(2, 'Don’t Miss Amazing Grocery Deals', 'Sign up for the daily newsletter', 'upload/slider/1817613650627930_slider.png', 'show', '2023-06-25 04:23:30', '2024-12-05 15:10:56');

-- Dumping structure for table food_shop_project.smtp_settings
DROP TABLE IF EXISTS `smtp_settings`;
CREATE TABLE IF NOT EXISTS `smtp_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.smtp_settings: ~1 rows (approximately)
DELETE FROM `smtp_settings`;
INSERT INTO `smtp_settings` (`id`, `mailer`, `host`, `port`, `username`, `password`, `encryption`, `from_address`, `from_name`, `created_at`, `updated_at`) VALUES
	(1, 'smtp', 'smtp.gmail.com', '587', 'no.reply.nestshop@gmail.com', 'cakvhzwnbgksdjuk', 'tls', 'no.reply.nestshop@gmail.com', 'NestShop', '2023-07-01 15:24:08', '2023-07-03 14:02:02');

-- Dumping structure for table food_shop_project.subscribers
DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.subscribers: ~3 rows (approximately)
DELETE FROM `subscribers`;
INSERT INTO `subscribers` (`id`, `email`, `token`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'kietminh070502@gmail.com', '', 'Active', '2023-07-15 10:30:30', '2023-07-15 10:30:48'),
	(2, 'laiminhkiet07052002@gmail.com', '', 'active', '2023-07-15 10:31:54', '2023-07-15 10:31:54'),
	(3, 'hoangphuc270502@gmail.com', '', 'Active', '2023-07-15 10:32:17', '2023-07-15 10:32:49');

-- Dumping structure for table food_shop_project.sub_categories
DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `subcategory_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_categories_subcategory_name_unique` (`subcategory_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.sub_categories: ~1 rows (approximately)
DELETE FROM `sub_categories`;
INSERT INTO `sub_categories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `created_at`, `updated_at`) VALUES
	(1, 1, 'CÁ NƯỚC NGỌT', 'cÁ-nƯỚc-ngỌt', '2023-06-25 03:54:57', '2024-12-03 07:55:19');

-- Dumping structure for table food_shop_project.suppliers
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.suppliers: ~1 rows (approximately)
DELETE FROM `suppliers`;
INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Bảo Linh', '0775083587', 'baolinhkhochay@gmail.com', '123 Lý Thường Kiệt, Phường 24, Quận Gò Vấp, Thành phố Hồ Chí Minh', 1, 1, NULL, '2023-07-13 23:57:52', '2024-12-03 08:31:22');

-- Dumping structure for table food_shop_project.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `youtube_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_seen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `youtube_link`, `facebook_link`, `role`, `status`, `last_seen`, `token`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'SuperAdmin', 'superadmin', 'kietminh070502@gmail.com', '2023-06-25 04:38:43', '$2y$10$uu2EfLVbBPrcAbjdtWJQXuCpXcr/4LrjSVjTjmxn5gR8TtiuyU7T6', '1769826218799972_admin.jpg', '0376707091', 'Sailing Tower, 111A Pasteur Street, District 1, Ho Chi Minh City', NULL, NULL, 'admin', 'active', '2024-12-05 22:30:50', '', NULL, '2023-06-25 03:22:55', '2024-12-05 15:30:50'),
	(3, 'Minh Kiet', 'laiminhkiet', 'laiminhkiet07052002@gmail.com', '2023-07-15 04:40:34', '$2y$10$u4/aWCAb54dTcCN.3h5gTuEMY.S0qktFqgOJtLwpMXDMmoTg9kCn.', '1769648355286070_user.jpg', '0793442309', '246, street 8, Ward 6, Vo Gap district, Ho Chi Minh city', NULL, NULL, 'user', 'active', '2024-12-06 08:23:10', NULL, '2M0MB1BYUDRbyUV49bwWsaRHLzZfzLbdGKuI9m5WNrnTlAkCBcJoLfbkxQsR', '2023-06-25 03:22:56', '2024-12-06 01:23:10'),
	(19, 'Hoang Phuc', 'lenguyenhoangphuc', 'hoangphuc270502@gmail.com', '2023-07-14 05:29:34', '$2y$10$7NF27CFRA5TwdDQyt8oCQu8zqzGLVcgF0w6f0nrACl9z1/sKx.kfu', '1771372677495297_user.png', '0332964321', NULL, NULL, NULL, 'user', 'active', '2023-07-14 13:18:14', NULL, NULL, '2023-07-14 05:29:12', '2023-07-14 06:18:14');

-- Dumping structure for table food_shop_project.wishlists
DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table food_shop_project.wishlists: ~0 rows (approximately)
DELETE FROM `wishlists`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
