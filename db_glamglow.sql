-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 11:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_glamglow`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `au_id` int(11) NOT NULL,
  `au_name` varchar(255) NOT NULL,
  `au_email` varchar(255) NOT NULL,
  `au_number` varchar(255) NOT NULL,
  `au_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`au_id`, `au_name`, `au_email`, `au_number`, `au_address`) VALUES
(1, 'Glam & Glow', 'glamnglow@gmail.com', '03XX-1234567', 'Aptech NN2, North Nazimabad, Karachi, Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_contact`, `admin_password`) VALUES
(1, 'Umair Ahmed', 'umair@gmail.com', '0321-2782593', '$2y$10$YUCq2k2xXDEO3n6lSabcTudAkbt5GrVp3FNAQNKdHtLsyyVy/MJ22'),
(2, 'Laiba Waqar', 'laiba@gmail.com', '0345-1234567', '$2y$10$QrMSixOoHZIP9AzSNlVTb.niuQDpRSjtmQka1CgYw1veD0.77Tusu'),
(3, 'Maryam Ali', 'maryam@gmail.com', '0333-1234567', '$2y$10$LJmYXwble4LrRM50em/mCOmFB2KXmwBEBL2A/NbVQgjI7zRRnaTRa'),
(4, 'Hamza Adnan', 'hamza@gmail.com', '0313-1234567', '$2y$10$Tzo3cryWC9DxeTiJz.MDreqf1K9oji7YkMwya3uawZfAni0lR3RCK'),
(5, 'Umair Ahmed', 'eng.umair.a@gmail.com', '0321-2782593', '$2y$10$MUkyZ8n3GCvHzfzcjw32YOAGdwkfvf8cMSLRGvV.1tvH3mzWbOUQK');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `delete_admin` BEFORE DELETE ON `admin` FOR EACH ROW BEGIN
    UPDATE audit_admin SET aud_adm_leavedate=CURRENT_TIMESTAMP, aud_adm_comments='Account Deleted';
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig_insert` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
    INSERT INTO audit_admin VALUES(NULL , NEW.admin_name,NEW.admin_email,NEW.admin_contact, CURRENT_TIMESTAMP, NULL,'admin added');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `audit_admin`
--

CREATE TABLE `audit_admin` (
  `aud_adm_id` int(255) NOT NULL,
  `aud_adm_name` varchar(255) NOT NULL,
  `aud_adm_email` varchar(255) NOT NULL,
  `aud_adm_contact` varchar(255) NOT NULL,
  `aud_adm_joindate` varchar(255) NOT NULL,
  `aud_adm_leavedate` varchar(255) DEFAULT NULL,
  `aud_adm_comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_admin`
--

INSERT INTO `audit_admin` (`aud_adm_id`, `aud_adm_name`, `aud_adm_email`, `aud_adm_contact`, `aud_adm_joindate`, `aud_adm_leavedate`, `aud_adm_comments`) VALUES
(1, 'Umair Ahmed', 'umair@gmail.com', '0321-2782593', '2023-06-01 14:27:09', NULL, 'admin added'),
(2, 'Laiba Waqar', 'laiba@gmail.com', '0345-1234567', '2023-06-03 00:42:21', NULL, 'admin added'),
(3, 'Maryam Ali', 'maryam@gmail.com', '0333-1234567', '2023-06-03 00:43:00', NULL, 'admin added'),
(4, 'Hamza Adnan', 'hamza@gmail.com', '0313-1234567', '2023-06-03 00:43:43', NULL, 'admin added'),
(5, 'Umair Ahmed', 'eng.umair.a@gmail.com', '0321-2782593', '2023-06-07 20:06:45', NULL, 'admin added');

-- --------------------------------------------------------

--
-- Table structure for table `audit_category`
--

CREATE TABLE `audit_category` (
  `aud_cat_id` int(255) NOT NULL,
  `aud_cat_name` varchar(255) NOT NULL,
  `aud_cat_createdate` varchar(255) NOT NULL,
  `aud_cat_deletedate` varchar(255) DEFAULT NULL,
  `aud_cat_updatedate` varchar(255) DEFAULT NULL,
  `aud_cat_comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_orders`
--

CREATE TABLE `audit_orders` (
  `aud_ord_id` int(255) NOT NULL,
  `aud_ord_user` int(255) NOT NULL,
  `aud_ord_product` int(255) NOT NULL,
  `aud_ord_quantity` varchar(255) NOT NULL,
  `au_ord_amount` varchar(255) NOT NULL,
  `aud_ord_receipt` varchar(255) NOT NULL,
  `aud_ord_createdate` varchar(255) NOT NULL,
  `aud_ord_deletedate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_orders`
--

INSERT INTO `audit_orders` (`aud_ord_id`, `aud_ord_user`, `aud_ord_product`, `aud_ord_quantity`, `au_ord_amount`, `aud_ord_receipt`, `aud_ord_createdate`, `aud_ord_deletedate`) VALUES
(1, 5, 18, '1', '0', '20230609/5/497', '2023-06-09 11:42:05', NULL),
(2, 5, 4, '1', '0', '20230609/5/497', '2023-06-09 11:42:05', NULL),
(3, 5, 6, '2', '0', '20230609/5/197', '2023-06-09 14:01:57', NULL),
(4, 5, 6, '2', '0', '20230609/5/132', '2023-06-09 14:07:51', NULL),
(5, 5, 3, '1', '0', '20230609/5/132', '2023-06-09 14:07:51', NULL),
(6, 5, 2, '2', '0', '20230609/5/250', '2023-06-09 14:10:50', NULL),
(7, 5, 3, '2', '0', '20230609/5/250', '2023-06-09 14:10:50', NULL),
(8, 5, 6, '1', '1500', '20230609/5/977', '2023-06-09 14:13:23', NULL),
(9, 5, 1, '2', '2000', '20230609/5/18', '2023-06-09 14:26:18', NULL),
(10, 5, 2, '3', '3000', '20230609/5/18', '2023-06-09 14:26:18', NULL),
(11, 5, 3, '1', '400', '20230609/5/18', '2023-06-09 14:26:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_product`
--

CREATE TABLE `audit_product` (
  `aud_prod_id` int(255) NOT NULL,
  `aud_prod_name` varchar(255) NOT NULL,
  `aud_prod_brand` int(11) NOT NULL,
  `aud_prod_price` varchar(255) NOT NULL,
  `aud_prod_createdate` varchar(255) DEFAULT NULL,
  `aud_prod_deletedate` varchar(255) DEFAULT NULL,
  `aud_prod_updatedate` varchar(255) DEFAULT NULL,
  `aud_prod_comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_product`
--

INSERT INTO `audit_product` (`aud_prod_id`, `aud_prod_name`, `aud_prod_brand`, `aud_prod_price`, `aud_prod_createdate`, `aud_prod_deletedate`, `aud_prod_updatedate`, `aud_prod_comment`) VALUES
(1, 'Mascara', 5, '400', '2023-05-14 20:55:28', NULL, NULL, 'Product added'),
(2, 'Eye Liner', 1, '500', '2023-05-17 02:02:22', NULL, NULL, 'Product added'),
(3, 'Miss Rose Blushon', 1, '2000', '2023-05-20 01:39:34', NULL, NULL, 'Product added'),
(4, 'Foundation', 1, '1500', '2023-06-01 01:30:36', NULL, NULL, 'Product added'),
(5, 'Foundation', 4, '2000', '2023-06-01 01:31:36', NULL, NULL, 'Product added'),
(6, 'Bangles', 9, '1000', '2023-06-01 11:24:05', NULL, NULL, 'Product added'),
(7, 'Shampoo', 4, '1200', '2023-06-02 02:06:35', NULL, NULL, 'Product added'),
(8, 'Eye Shadow', 6, '5000', '2023-06-04 00:37:13', NULL, NULL, 'Product added'),
(9, 'Eye Shadow', 6, '5000', '2023-06-04 00:50:35', NULL, NULL, 'Product added'),
(10, 'Eye Shadow', 6, '5000', '2023-06-04 01:00:24', NULL, NULL, 'Product added'),
(11, 'Eye Shadow', 6, '5000', '2023-06-04 01:12:00', NULL, NULL, 'Product added'),
(12, 'Eye Shadow', 6, '5000', '2023-06-04 01:19:39', NULL, NULL, 'Product added'),
(13, 'Eye Shadow', 6, '5000', '2023-06-04 01:31:55', NULL, NULL, 'Product added'),
(14, 'Eye Shadow', 6, '5000', '2023-06-04 01:38:41', NULL, NULL, 'Product added'),
(15, 'Eye Shadow', 6, '500', '2023-06-04 01:43:31', NULL, NULL, 'Product added'),
(16, 'Eye Shadow', 6, '5000', '2023-06-04 01:50:05', NULL, NULL, 'Product added'),
(17, 'test', 1, '86876', '2023-06-05 03:05:02', NULL, NULL, 'Product added'),
(18, 'Test', 1, '87678', '2023-06-05 03:06:18', NULL, NULL, 'Product added'),
(19, 'test', 1, '1000', '2023-06-05 03:10:01', NULL, NULL, 'Product added'),
(20, 'test', 1, '1000', '2023-06-05 11:38:02', NULL, NULL, 'Product added'),
(21, 'test2', 1, '1000', '2023-06-05 11:39:18', NULL, NULL, 'Product added'),
(22, 'Lipsticks', 1, '1000', NULL, '2023-06-09 11:50:35', NULL, 'Product Updated'),
(23, 'Cleanser', 9, '1000', '2023-06-09 12:09:36', NULL, NULL, 'Product added');

-- --------------------------------------------------------

--
-- Table structure for table `audit_user`
--

CREATE TABLE `audit_user` (
  `aud_usr_id` int(255) NOT NULL,
  `aud_usr_name` varchar(255) NOT NULL,
  `aud_usr_email` varchar(255) NOT NULL,
  `aud_usr_contact` varchar(255) NOT NULL,
  `aud_usr_joindate` varchar(255) NOT NULL,
  `aud_usr_leavedate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_user`
--

INSERT INTO `audit_user` (`aud_usr_id`, `aud_usr_name`, `aud_usr_email`, `aud_usr_contact`, `aud_usr_joindate`, `aud_usr_leavedate`) VALUES
(1, 'test', 'test', 'test', '2023-05-22 01:12:10', NULL),
(2, 'Umair', 'eng.umair.a@gmail.com', '0321-2782593', '2023-05-22 01:14:56', NULL),
(3, 'Khizar Ahmed', 'khizar@gmail.com', '0321-1234567', '2023-05-22 01:16:44', NULL),
(4, 'Laiba Waqar', 'laiba@gmail.com', '0321-1234567', '2023-05-26 02:49:45', NULL),
(5, 'Umair Ahmed', 'umair@gmail.com', '0321-2782593', '2023-06-06 19:27:27', NULL),
(6, 'Sumair Ahmed', 'sumair@gmail.com', '03041234567', '2023-06-08 01:18:47', NULL),
(7, 'Umair Ahmed', 'eng.umair.a@gmail.com', '0321-1234567', '2023-06-08 17:24:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_category` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_category`) VALUES
(1, 'Miss Rose', 2),
(2, 'Glamours', 2),
(3, 'Etude', 2),
(4, 'Loreal', 2),
(5, 'Huda Beauty', 2),
(6, 'ST London', 2),
(9, 'None', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(255) NOT NULL,
  `cart_user` int(255) NOT NULL,
  `cart_product` int(255) NOT NULL,
  `cart_quantity` int(255) NOT NULL,
  `cart_total` int(255) DEFAULT NULL,
  `cart_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_user`, `cart_product`, `cart_quantity`, `cart_total`, `cart_price`) VALUES
(87, 6, 9, 1, 1200, 1200),
(88, 6, 24, 1, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(255) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Jewelry'),
(2, 'Cosmetics'),
(5, 'Shoes'),
(6, 'Shirts');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `contact_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_email`, `contact_number`, `contact_message`) VALUES
(1, 'khizar', 'khizar@gmail.com', '0321-1234567', 'lkjsjadiojas89dj8a9sjd9a8smd');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(255) NOT NULL,
  `ord_user` int(255) NOT NULL,
  `ord_product` int(255) NOT NULL,
  `ord_quantity` int(255) NOT NULL,
  `ord_amount` int(11) NOT NULL,
  `ord_status` int(255) NOT NULL,
  `ord_receipt_no` varchar(255) NOT NULL,
  `ord_create_date` varchar(255) NOT NULL,
  `ord_remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_user`, `ord_product`, `ord_quantity`, `ord_amount`, `ord_status`, `ord_receipt_no`, `ord_create_date`, `ord_remarks`) VALUES
(76, 5, 1, 2, 2000, 1, '20230609/5/18', '2023-06-09 14:26:18', ''),
(77, 5, 2, 3, 3000, 1, '20230609/5/18', '2023-06-09 14:26:18', ''),
(78, 5, 3, 1, 400, 1, '20230609/5/18', '2023-06-09 14:26:18', '');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `insert_order` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
INSERT INTO audit_orders VALUES(Null,NEW.ord_user,NEW.ord_product,NEW.ord_quantity,NEW.ord_amount,NEW.ord_receipt_no,CURRENT_TIMESTAMP,Null);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `os_id` int(255) NOT NULL,
  `os_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`os_id`, `os_status`) VALUES
(1, 'Pending'),
(2, 'In-process'),
(3, 'Delivered'),
(4, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_brand` int(255) NOT NULL,
  `prod_category` int(255) NOT NULL,
  `prod_subcategory` int(255) NOT NULL,
  `prod_price` int(255) NOT NULL,
  `prod_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_brand`, `prod_category`, `prod_subcategory`, `prod_price`, `prod_image`) VALUES
(1, 'Lipsticks', 1, 2, 3, 1000, 'img/1685572524miss_rose_lipstick_550x750.jpg'),
(2, 'Face Powder', 4, 2, 3, 1000, 'img/1685600086loreal facepowd1.png'),
(3, 'Nail Polish', 6, 2, 3, 400, 'img/1685600138st np2.png'),
(4, 'Eye Liner', 1, 2, 3, 500, 'img/1684270942eye linerpic.jpg'),
(6, 'Foundation', 1, 2, 3, 1500, 'img/1685565036foundation pic1.jpg'),
(7, 'Foundation', 4, 2, 3, 2000, 'img/1685565096loreal found3.png'),
(8, 'Bangles', 9, 1, 1, 1000, 'img/1685600645bangles.jpg'),
(9, 'Shampoo', 4, 2, 6, 1200, 'img/1685653595loreal shampoo3.png'),
(18, 'Eye Shadow', 6, 2, 3, 5000, 'img/1685825405steyeshadow2.png'),
(22, 'test', 1, 2, 3, 1000, 'img/1685947082loreal shampoo2.png'),
(23, 'test2', 1, 2, 3, 1000, 'img/1685947158loreal shampoo2.png'),
(24, 'Cleanser', 9, 2, 9, 1000, 'img/1686294576cleanser_pic_550x750.jpg');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `insert_product` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
    INSERT INTO audit_product VALUES(Null,NEW.prod_name,NEW.prod_brand,NEW.prod_price,CURRENT_TIMESTAMP,Null,Null,'Product added');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product` BEFORE UPDATE ON `products` FOR EACH ROW BEGIN
INSERT INTO audit_product VALUES(Null,NEW.prod_name,NEW.prod_brand,NEW.prod_price,Null,CURRENT_TIMESTAMP,Null,'Product Updated');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `pi_id` int(255) NOT NULL,
  `pi_product` int(255) NOT NULL,
  `pi_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`pi_id`, `pi_product`, `pi_image`) VALUES
(1, 9, 'img/loreal shampoo.png'),
(2, 9, 'img/loreal shampoo1.png'),
(3, 9, 'img/loreal shampoo2.png'),
(4, 9, 'img/loreal shampoo4.png'),
(5, 18, 'img/st eye shadow1.png'),
(6, 18, 'img/st eye shadow4.png'),
(7, 18, 'img/st eyeshadow3.png'),
(8, 18, 'img/st eyeshadow4.png'),
(9, 2, 'img/loreal facepowd2.png'),
(10, 2, 'img/loreal facepowd3.png'),
(11, 2, 'img/loreal facepowd4.png'),
(12, 2, 'img/loreal facepowder.png'),
(13, 1, 'img/lipstick.jpg'),
(14, 1, 'img/lipstick1.jpg'),
(15, 1, 'img/lipstick2.jpg'),
(16, 1, 'img/lipstick3.jpg'),
(17, 3, 'img/st nailpolish.png'),
(18, 3, 'img/st np1.png'),
(19, 3, 'img/st np3.png'),
(20, 3, 'img/st np4.png'),
(21, 4, 'img/liner2.png'),
(22, 4, 'img/liner3.png'),
(23, 4, 'img/liner4.png'),
(24, 4, 'img/liner5.png');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `slider_id` int(255) NOT NULL,
  `slider_name` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`slider_id`, `slider_name`, `slider_image`) VALUES
(14, 'Slider 1', '../user/assets/img/slider/16862911132.jpg'),
(15, 'Slider 2', '../user/assets/img/slider/1686291126slider-04.jpg'),
(16, 'Slider 3', '../user/assets/img/slider/1686291140slider-05.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stk_id` int(11) NOT NULL,
  `stk_product` int(11) NOT NULL,
  `stk_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stk_id`, `stk_product`, `stk_quantity`) VALUES
(1, 1, 900),
(2, 2, 10),
(3, 3, 10),
(4, 4, 100),
(5, 6, 10),
(6, 7, 10),
(9, 8, 200),
(10, 9, 100),
(19, 18, 10000),
(24, 23, 1000),
(25, 24, 100);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `subcat_id` int(255) NOT NULL,
  `subcat_maincat` int(255) NOT NULL,
  `subcat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`subcat_id`, `subcat_maincat`, `subcat_name`) VALUES
(1, 1, 'Earrings'),
(2, 1, 'Necklace'),
(3, 2, 'MakeUp'),
(4, 1, 'Bangles'),
(5, 1, 'Rings'),
(6, 2, 'Hair Care'),
(8, 6, 'T-Shirt'),
(9, 2, 'Skin-Care');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_dob` varchar(255) NOT NULL,
  `user_contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_dob`, `user_contact`) VALUES
(1, 'test', 'test', 'test', 'test', 'test'),
(2, 'test', 'test', 'test', 'test', 'test'),
(3, 'Umair', 'eng.umair.a@gmail.com', '$2y$10$t4HUIVjtiAPrkSpoyZ50lOUxtAKMbAWxygFYXnzLZO2cxLvXdXP2O', '1991-07-14', '0321-2782593'),
(4, 'Khizar Ahmed', 'khizar@gmail.com', '$2y$10$iV7iP5Pwggb353KygjhkLuHVtToaa/hPeu0HG.xjVv1paRUe1LZBG', '2019-02-03', '0321-1234567'),
(5, 'Laiba Waqar', 'laiba@gmail.com', '$2y$10$OoyxEpypd0dckpFlSfi0m.MdJvBZeupKsGqAZsX/gNlKHuUP0JdPG', '2023-05-26', '0321-1234567'),
(6, 'Umair Ahmed', 'umair@gmail.com', '$2y$10$o7Mn6XWSrksmZbUhTKC9..aaTMRVAgNas3mo65kAoIiP50hrcpM6q', '2018-01-01', '0321-2782593'),
(7, 'Sumair Ahmed', 'sumair@gmail.com', '$2y$10$09pPb/357l19XNsn/I9YuetLyain3yoBWiu//ftGkAGeilhAin27e', '2015-01-01', '03041234567');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `insert_user` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
INSERT INTO audit_user VALUES(Null,NEW.user_name,NEW.user_email,NEW.user_contact,CURRENT_TIMESTAMP,Null);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `dt_id` int(255) NOT NULL,
  `dt_user` int(255) NOT NULL,
  `dt_address` varchar(255) NOT NULL,
  `dt_workphone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`dt_id`, `dt_user`, `dt_address`, `dt_workphone`) VALUES
(2, 4, 'House # 123, ABC, KHI, Pakistan', '0313-1234567'),
(3, 3, 'lkjaosijdap98sdj89asd', '0313-1234567'),
(7, 5, 'ABCD 1234568', '0313-1234567'),
(8, 6, 'House # 123, XYZ area, City, Country', '0300-1234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`au_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `audit_admin`
--
ALTER TABLE `audit_admin`
  ADD PRIMARY KEY (`aud_adm_id`);

--
-- Indexes for table `audit_category`
--
ALTER TABLE `audit_category`
  ADD PRIMARY KEY (`aud_cat_id`);

--
-- Indexes for table `audit_orders`
--
ALTER TABLE `audit_orders`
  ADD PRIMARY KEY (`aud_ord_id`),
  ADD KEY `FK_AUD_ORD_USER` (`aud_ord_user`),
  ADD KEY `FK_AUD_ORD_PRODUCT` (`aud_ord_product`);

--
-- Indexes for table `audit_product`
--
ALTER TABLE `audit_product`
  ADD PRIMARY KEY (`aud_prod_id`);

--
-- Indexes for table `audit_user`
--
ALTER TABLE `audit_user`
  ADD PRIMARY KEY (`aud_usr_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD KEY `FK_Brand_Category` (`brand_category`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `FK_Cart_User` (`cart_user`),
  ADD KEY `FK_Cart_Product` (`cart_product`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `FK_Order_product` (`ord_product`),
  ADD KEY `FK_Order_User` (`ord_user`),
  ADD KEY `FK_Order_Status` (`ord_status`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`os_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `FK_Product_Category` (`prod_category`),
  ADD KEY `FK_Product_brand` (`prod_brand`),
  ADD KEY `FK_Product_SubCategory` (`prod_subcategory`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`pi_id`),
  ADD KEY `FK_PI_Product` (`pi_product`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stk_id`),
  ADD KEY `FK_Stock_Product` (`stk_product`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`subcat_id`),
  ADD KEY `FK_SubCat_MainCat` (`subcat_maincat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`dt_id`),
  ADD KEY `FK_detail_user` (`dt_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `au_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `audit_admin`
--
ALTER TABLE `audit_admin`
  MODIFY `aud_adm_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `audit_category`
--
ALTER TABLE `audit_category`
  MODIFY `aud_cat_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_orders`
--
ALTER TABLE `audit_orders`
  MODIFY `aud_ord_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `audit_product`
--
ALTER TABLE `audit_product`
  MODIFY `aud_prod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `audit_user`
--
ALTER TABLE `audit_user`
  MODIFY `aud_usr_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `os_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `pi_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `slider_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `subcat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `dt_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_orders`
--
ALTER TABLE `audit_orders`
  ADD CONSTRAINT `FK_AUD_ORD_PRODUCT` FOREIGN KEY (`aud_ord_product`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `FK_AUD_ORD_USER` FOREIGN KEY (`aud_ord_user`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `FK_Brand_Category` FOREIGN KEY (`brand_category`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_Cart_Product` FOREIGN KEY (`cart_product`) REFERENCES `products` (`prod_id`),
  ADD CONSTRAINT `FK_Cart_User` FOREIGN KEY (`cart_user`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Order_Status` FOREIGN KEY (`ord_status`) REFERENCES `order_status` (`os_id`),
  ADD CONSTRAINT `FK_Order_User` FOREIGN KEY (`ord_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK_Order_product` FOREIGN KEY (`ord_product`) REFERENCES `products` (`prod_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_Product_Category` FOREIGN KEY (`prod_category`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `FK_Product_SubCategory` FOREIGN KEY (`prod_subcategory`) REFERENCES `sub_category` (`subcat_id`),
  ADD CONSTRAINT `FK_Product_brand` FOREIGN KEY (`prod_brand`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `FK_PI_Product` FOREIGN KEY (`pi_product`) REFERENCES `products` (`prod_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_Stock_Product` FOREIGN KEY (`stk_product`) REFERENCES `products` (`prod_id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `FK_SubCat_MainCat` FOREIGN KEY (`subcat_maincat`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `FK_detail_user` FOREIGN KEY (`dt_user`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
