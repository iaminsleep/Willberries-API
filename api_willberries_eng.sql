-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: api_willberries
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `shopping_cart_id` int(11) NOT NULL,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(20) NOT NULL,
  `img` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`product_id`,`shopping_cart_id`),
  KEY `fk_cart_item_product1_idx` (`name`),
  KEY `fk_cart_item_shopping_cart1_idx` (`shopping_cart_id`),
  KEY `fk_cart_item_product1_idx1` (`product_id`),
  CONSTRAINT `fk_cart_item_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cart_item_shopping_cart1` FOREIGN KEY (`shopping_cart_id`) REFERENCES `shopping_cart` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_item`
--

LOCK TABLES `cart_item` WRITE;
/*!40000 ALTER TABLE `cart_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Clothing'),(2,'Accessories'),(3,'Shoes');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gender` (
  `id` int(5) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'Mens'),(2,'Womens');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) NOT NULL,
  `created_at` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`product_id`,`order_id`),
  KEY `fk_order_item_order1_idx` (`order_id`),
  KEY `fk_order_item_product1_idx` (`product_id`),
  CONSTRAINT `fk_order_item_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_item_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(5) NOT NULL,
  `gender_id` int(5) NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(100) NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_goods_category1_idx` (`category_id`),
  KEY `fk_goods_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_goods_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_goods_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Striped Long Sleeve Shirt',1,2,'Red/Sky Blue',119,'image-122.jpg','New'),(2,'Poplin Top With Sleeve Bow',1,2,'Bright Blue',129,'201mt210e.jpg','Bestseller'),(3,'TOMS Women\'s Alpargata Loafer',3,2,'Red',219,'61SVZdHi1SL.jpg','Bestseller'),(4,'Text T-Shirt',1,2,'Pink and dogs',119,'thR2gxLUL1152.jpg','Bestseller'),(5,'Sweater Choker Neck',1,2,'Dustyolive',319,'81ecpN8bKL.jpg','Bestseller'),(6,'SJP by Sarah Jessica Parker',3,2,'Black/Nude Patent',242,'61xZxTBffZL.jpg',''),(7,'ECCO Biom Aex Luxe Hydromax Water-Resistant Cross Trainer',3,1,'Black',199,'71AogkKMguL.jpg',''),(8,'Nike Air Max Torch 3 Men\'s Running Shoes',3,1,'Black/White',153,'71wbXtpEwQL.jpg',''),(9,'Printed Shirt with a Bow',1,2,'Pink/Sky Blue/Yellow',119,'71Ka10xx6.jpg',''),(10,'Text T-Shirt',1,2,'White',59,'image-121.jpg','New'),(11,'Faded Beach Trousers',1,2,'Ochre',139,'image-120.jpg','New'),(12,'Embroidered Hoodie',1,2,'Lilac',89,'image-119.jpg','New'),(13,'Bugatchi Men\'s Long Sleeve Printed Cotton Pointed Collar Shirt',1,1,'Periwinkle',109,'A1GFd9I31.jpg','New'),(14,'SITKA Gear Men\'s Hunting Windproof Optifade',1,1,'Elevated Ii',299,'819MP6k4E6L.jpg',''),(15,'Derek Rose Men\'s Short Sleeve T-Shirt',1,1,'Charcoal',149,'713S476iemL.jpg',''),(16,'LEKODE Men Beach Shorts Drawstring Print Pocket Fashion Casual Swim Pants',1,1,'Red-Cola',19,'61BjZJm0AaL.jpg',''),(17,'Anna by Anuschka Women\'s Genuine Leather Large Hobo Handbag',2,2,'Tuscan Tiles',199,'91DXANwJ63L.jpg',''),(18,'Prada Trick Pelle Saffiano Dog',2,2,'White / White Chihuahua Gold Keychain',450,'61vHzipbVL.jpg',''),(19,'Willberries Essentials Women\'s Faux Fur Ear Muffs',2,2,'Leopard',19,'81zhsxFeEJL.jpg','Bestseller'),(20,'Purse Organizer Insert, Felt Bag organizer with zipper',2,2,'Black / Felt',29,'61-25976rtL.jpg',''),(21,'Spyder Mens Pinnacle GTX Ski Glove',2,1,'Black',239,'51xrpCz0wuL.jpg',''),(22,'Salvatore Ferragamo Double Gancini Glossy Buckle',2,1,'Black/Brown Reversible Belt',417,'51EeCDi3G9L.jpg',''),(23,'American Hat Makers Sierra Cowboy Hat',2,1,'Handcrafted, Genuine Leather, Breathable / Latte',217,'61qMUpjOx7L.jpg','New'),(24,'Oakley Men\'s Flak 2.0 XL OO9188 Sunglasses Bundle',2,1,'Matte Black/Prizm Deep Water Polarized',206,'41heUmYaMGL.jpg','');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shopping_cart_user1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopping_cart`
--

LOCK TABLES `shopping_cart` WRITE;
/*!40000 ALTER TABLE `shopping_cart` DISABLE KEYS */;
INSERT INTO `shopping_cart` VALUES (3,22),(4,23),(5,24),(6,25),(7,26),(8,27);
/*!40000 ALTER TABLE `shopping_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(15) NOT NULL AUTO_INCREMENT COMMENT 'User Id',
  `name` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'User Name',
  `email` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'User Email',
  `password` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'User password',
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'User Phone',
  `avatar` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'User Avatar',
  `registered_at` date NOT NULL COMMENT 'The exact date when user was registered',
  `manager` tinyint(1) DEFAULT NULL COMMENT 'If user is a manager (can manage orders)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-22 20:10:55
