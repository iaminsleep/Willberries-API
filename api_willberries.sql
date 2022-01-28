-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2022 at 08:42 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_willberries`
--

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `img` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `name`, `description`, `category`, `gender`, `price`, `img`, `label`, `offer`) VALUES
(1, 'Striped Long Sleeve Shirt', 'Red/Sky Blue', 'Clothing', 'Womens', 119, 'image-122.jpg', 'New', 0),
(2, 'Poplin Top With Sleeve Bow', 'Bright Blue', 'Clothing', 'Womens', 129, '201mt210e.jpg', 'Bestseller', 0),
(3, 'TOMS Women\'s Alpargata Loafer', 'Red', 'Shoes', 'Womens', 219, '61SVZdHi1SL.jpg', 'Bestseller', 0),
(4, 'Text T-Shirt', 'Pink and dogs', 'Clothing', 'Womens', 119, 'thR2gxLUL1152.jpg', 'Bestseller', 0),
(5, 'Sweater Choker Neck', 'Dustyolive', 'Clothing', 'Womens', 319, '81ecpN8bKL.jpg', 'Bestseller', 0),
(6, 'SJP by Sarah Jessica Parker', 'Black/Nude Patent', 'Shoes', 'Womens', 242, '61xZxTBffZL.jpg', '', 0),
(7, 'ECCO Biom Aex Luxe Hydromax Water-Resistant Cross Trainer', 'Black', 'Shoes', 'Mens', 199, '71AogkKMguL.jpg', '', 0),
(8, 'Nike Air Max Torch 3 Men\'s Running Shoes', 'Black/White', 'Shoes', 'Mens', 153, '71wbXtpEwQL.jpg', '', 0),
(9, 'Printed Shirt with a Bow', 'Pink/Sky Blue/Yellow', 'Clothing', 'Womens', 119, '71Ka10xx6.jpg', '', 1),
(10, 'Text T-Shirt', 'White', 'Clothing', 'Womens', 59, 'image-121.jpg', 'New', 1),
(11, 'Faded Beach Trousers', 'Ochre', 'Clothing', 'Womens', 139, 'image-120.jpg', 'New', 1),
(12, 'Embroidered Hoodie', 'Lilac', 'Clothing', 'Womens', 89, 'image-119.jpg', 'New', 1),
(13, 'Bugatchi Men\'s Long Sleeve Printed Cotton Pointed Collar Shirt', 'Periwinkle', 'Clothing', 'Mens', 109, 'A1GFd9I31.jpg', 'New', 0),
(14, 'SITKA Gear Men\'s Hunting Windproof Optifade', 'Elevated Ii', 'Clothing', 'Mens', 299, '819MP6k4E6L.jpg', '', 0),
(15, 'Derek Rose Men\'s Short Sleeve T-Shirt', 'Charcoal', 'Clothing', 'Mens', 149, '713S476iemL.jpg', '', 0),
(16, 'LEKODE Men Beach Shorts Drawstring Print Pocket Fashion Casual Swim Pants', 'Red-Cola', 'Clothing', 'Mens', 19, '61BjZJm0AaL.jpg', '', 0),
(17, 'Anna by Anuschka Women\'s Genuine Leather Large Hobo Handbag', 'Tuscan Tiles', 'Accessories', 'Womens', 199, '91DXANwJ63L.jpg', '', 0),
(18, 'Prada Trick Pelle Saffiano Dog', 'White / White Chihuahua Gold Keychain', 'Accessories', 'Womens', 450, '61vHzipbVL.jpg', '', 0),
(19, 'Willberries Essentials Women\'s Faux Fur Ear Muffs', 'Leopard', 'Accessories', 'Womens', 19, '81zhsxFeEJL.jpg', 'Bestseller', 0),
(20, 'Purse Organizer Insert, Felt Bag organizer with zipper', 'Black / Felt', 'Accessories', 'Womens', 29, '61-25976rtL.jpg', NULL, 0),
(21, 'Spyder Mens Pinnacle GTX Ski Glove', 'Black', 'Accessories', 'Mens', 239, '51xrpCz0wuL.jpg', NULL, 0),
(22, 'Salvatore Ferragamo Double Gancini Glossy Buckle', 'Black/Brown Reversible Belt', 'Accessories', 'Mens', 417, '51EeCDi3G9L.jpg', '', 0),
(23, 'American Hat Makers Sierra Cowboy Hat', 'Handcrafted, Genuine Leather, Breathable / Latte', 'Accessories', 'Mens', 217, '61qMUpjOx7L.jpg', 'New', 0),
(24, 'Oakley Men\'s Flak 2.0 XL OO9188 Sunglasses Bundle', 'Matte Black/Prizm Deep Water Polarized', 'Accessories', 'Mens', 206, '41heUmYaMGL.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL COMMENT 'User Id',
  `password` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'User password',
  `email` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'User Email',
  `phone` int(50) DEFAULT NULL COMMENT 'User Phone',
  `name` text CHARACTER SET utf8 COMMENT 'User Name',
  `avatar` varchar(100) CHARACTER SET utf8 DEFAULT 'noavatar.png' COMMENT 'User Avatar',
  `registered_at` date NOT NULL COMMENT 'The exact date when user was registered',
  `manager` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'If user is a manager (can manage orders)',
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'If user is an admin (can manage users and managers)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'User Id', AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
