-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2017 at 10:09 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `created_at`, `updated_at`, `remember_token`, `email`, `password`) VALUES
(1, '2017-05-07 03:22:30', '2017-05-07 03:22:30', NULL, 'amirengg15@gmail.com', '$2y$10$L9jr5acQ8INV4LVWXuvZ7.uSe1eF53/oFj79EldgHH/3gpeAQ63Jy'),
(2, '2017-05-07 03:34:53', '2017-05-07 03:34:53', NULL, 'amirengg15@gmail.com', '$2y$10$vVsGNnG4LKDhUuzlcMNuY.m7mfuz1LGiosulnktJYUwrkDdeGZvHK');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`) VALUES
(2, '2017-05-07 03:34:53', '2017-05-07 03:34:53', 'Sports'),
(3, '2017-05-07 03:34:53', '2017-05-07 03:34:53', 'Food'),
(8, '2017-05-11 12:40:36', '2017-05-11 12:40:36', 'education'),
(9, '2017-05-19 21:59:58', '2017-05-19 21:59:58', 'Celebrity');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2017_05_05_161302_create_posts_table', 1),
('2017_05_05_161440_create_categories_table', 1),
('2017_05_05_161540_create_contact_messages_table', 1),
('2017_05_05_162402_create_post_category_table', 1),
('2017_05_05_162452_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `created_at`, `updated_at`, `title`, `author`, `body`) VALUES
(1, '2017-05-19 21:42:19', '2017-05-19 21:42:19', 'It happens for a reason author', 'Preeti Shenoy', 'It Happens for a Reason. When Vipasha, Vee to friends, eighteen and single, makes the decision to have her baby, she does more than give up her promising modeling career. She ends up cutting ties with her family and with Ankush, the man she thought she was in love with.'),
(2, '2017-05-19 21:44:50', '2017-05-19 21:44:50', 'Dream with your Eyes Open: An Entrepreneurial Journey', 'Ronnie Screwvala', 'The preface offers a promise to the reader: "This book hopes to demystify failure, inspire success, raise ambitions and help you think big." And Screwvala, or Ronnie as he is better known as, does full justice to this in the 13 chapters that follow.'),
(3, '2017-05-19 21:46:16', '2017-05-19 21:46:16', 'Falling In Love...', 'Neeraj Mishra', 'Molly, (Meryl Streep) is a beautiful housewife who is married to a doctor and lives in upstate NY. While out Christmas shopping she accidentally gets her packages mixed up in a Manhattan bookstore with a handsome young man named Frank (Rober De Niro).'),
(4, '2017-05-19 21:48:44', '2017-05-19 21:48:44', ' Chicken Dhansak', 'Indian Food', 'Stir in the garlic, ginger, garam masala and chilli powder and cook for a few seconds, stirring constantly. Tip the tomatoes into the pan and add the chicken stock, lentils and bay leaves.'),
(5, '2017-05-19 21:51:11', '2017-05-19 21:51:11', 'Chilli chicken', 'Food', 'Chilli Chicken is a mouth-watering Indo Chinese chicken recipe, here fried chicken is cooked in the combination of Indian vegetables and Chinese flavors and turned into delicious and simply irresistible main course dish, which can be also served as a starter.\r\n\r\n\r\n \r\nChilli Chicken Recipe is a popular Chicken Starter or Appetizer from the Indo-chinese cuisine. Here boneless chicken (fillets or cubes) are marinated in Egg, Cornflour, Maida and Salt and then deep fried and seasoned in sauces to get the best Chinese chilli chicken.\r\n\r\nChilli Chicken tastes hot, sweet and sour, because of Soy Sauce, Chilli Sauce and Vinegar. This famous Chinese Dish is best to serve with Fried rice and Hakka noodles. You can browse several Indo-Chinese Recipes and Chicken Recipes in my blog, this one is one of my favorites. This Chili Chicken Recipe is famous in restaurants and there they usually use Ajjinomotto (Monosodium glutamate) to give a unique flavor, but I haven’t used Ajinomotto and my chilli chicken recipe still it tastes great.\r\n\r\nEggs are very necessary to add during marination, it helps to keep the chicken moist and tender. Eggs also helps in binding the flour well and gives a good crust. An alternate to food color is using a good red chili powder like kashmiri or bedgi.  Lets start making chilli chicken recipe.\r\n\r\nChilli Chicken Recipe – Step by Step\r\n\r\nFollowing are the ingredients required for making Chilli Chicken Recipe. Boneless Chicken, All purpose Flour (Cornflour), Maida, Spring Onion White, Spring Onion Greens, Capsicum, Green Chilies, Curry Leaves, Ginger, Garlic, Soy Sauce, Red Chili Sauce.');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE IF NOT EXISTS `post_categories` (
`id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_id` int(11) NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `created_at`, `updated_at`, `post_id`, `category_id`) VALUES
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 11, '4'),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
