-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2024 at 01:37 AM
-- Server version: 10.6.17-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starlingbagsni`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentication`
--

CREATE TABLE `authentication` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `expiry_time` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authentication`
--

INSERT INTO `authentication` (`id`, `username`, `email_id`, `password`, `reset_token`, `expiry_time`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'info@starlingbagsni.co.uk', 'starling@ni', '2eb0f3ca5289afda0c2b308331a7e6e1', '2023-07-13', '2023-02-23 05:56:33', '2023-07-13 09:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `bags_collection`
--

CREATE TABLE `bags_collection` (
  `id` int(11) NOT NULL,
  `name_of_bag` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `crated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `id` int(11) NOT NULL,
  `name_of_category` varchar(100) NOT NULL,
  `image_of_category` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`id`, `name_of_category`, `image_of_category`, `created_at`, `deleted_at`) VALUES
(1, 'bag', 'categoryimages/Screenshot 2024-02-03 at 7.49.18 PM.png', '2024-02-03 14:19:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_tbl`
--

CREATE TABLE `contact_tbl` (
  `id` int(11) NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `contact_mail` varchar(100) NOT NULL,
  `facebook_link` varchar(100) DEFAULT NULL,
  `instagram_link` varchar(100) DEFAULT NULL,
  `youtube_link` varchar(100) DEFAULT NULL,
  `twitter_link` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_tbl`
--

INSERT INTO `contact_tbl` (`id`, `email_id`, `phone_number`, `contact_mail`, `facebook_link`, `instagram_link`, `youtube_link`, `twitter_link`, `address`) VALUES
(1, 'info@starlingbagsni.co.uk', '+919876543210', 'info@starlingbagsni.co.uk', 'https://facebook.com', 'https://instagram.com', 'https://youtube.com', 'https://twitter.com/', '');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_request`
--

CREATE TABLE `enquiry_request` (
  `id` int(11) NOT NULL,
  `ctc_person_name` varchar(100) NOT NULL,
  `ctc_person_email` varchar(100) NOT NULL,
  `ctc_person_phno` varchar(50) NOT NULL,
  `ctc_person_msg` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry_request`
--

INSERT INTO `enquiry_request` (`id`, `ctc_person_name`, `ctc_person_email`, `ctc_person_phno`, `ctc_person_msg`, `created_at`) VALUES
(26, 'Milan Klein', 'kevin.groot@projectmy.net', '2054967611', '', '2023-07-10 16:52:51'),
(27, 'Luciano Emmerich', 'thalia91@projectmy.net', '2054967611', '', '2023-07-10 16:54:50'),
(28, 'Geoffrey Beier', 'deshaun37@projectmy.net', '2054967611', '', '2023-07-10 16:57:00'),
(29, 'dfgdg', 'dgd@fdsfa', 'sdfa', 'ddd', '2023-07-11 04:52:37'),
(30, 'dfgdg', 'dgd@fdsfa', '78945555454', '', '2023-07-11 04:53:19'),
(31, 'Regu', 'reguramachandran007@gmail.com', '78956123111', '', '2023-07-11 04:57:26'),
(32, 'Sandhanabarathy', 'sandhanam556074@gmail.com', '8248354024', 'HI', '2023-07-11 04:58:55'),
(33, 'Sandhanabarathy', 'sandhanam556074@gmail.com', '8248354024', '', '2023-07-11 04:59:30'),
(34, 'dfgdg', 'dgd@fdsfa', '23131313131', '', '2023-07-11 05:00:03'),
(35, 'dfgdg', 'dgd@fdsfa', '8248354024', '', '2023-07-11 05:00:50'),
(36, 'dfgdg', 'sandhanam556074@gmail.com', '8248354024', '', '2023-07-11 05:01:15'),
(37, 'Regu', 'regu@gan', '78956123111', '', '2023-07-11 05:07:39'),
(38, 'Regu', 'reguramachandran007@yahoo.com', '78956123111', '', '2023-07-11 05:08:09'),
(39, 'Regu', 'regu@yahoo.com', '78956123111', '', '2023-07-11 05:20:56'),
(40, 'Regu', 'reguramachandran007@yahoo.com', '78956123111', '', '2023-07-14 07:37:35'),
(41, 'Jhehhe', 'reguramachandran007@gmail.com', '7550367917', 'Hi', '2023-07-17 05:35:58'),
(42, 'Regu', 'reguramachandran007@gmail.com', '78956123111', 'hi its working', '2023-07-17 07:39:37'),
(43, 'Elaine D.', 'pat@aneesho.com', '8102440753', 'Just wanted to ask if you would be interested in getting external help with graphic design? We do al', '2023-07-20 09:27:29'),
(44, 'Regu', 'reguramachandran007@gmail.com', '78956123111', 'dfsgsd', '2023-07-28 11:37:06'),
(45, 'janmn', 'janani8#jh.com', '87987h98798', 'juyjhkjhj', '2023-08-02 10:11:35'),
(46, 'janmn', 'janani8#jh.com', '87987h98798', 'jklkjl', '2023-08-02 10:11:56'),
(47, 'janmn', 'janani8@jh.com', '87987h98798', 'drgt', '2023-08-02 10:12:35'),
(48, 'janmn', 'janani8#jh.com', '87987h98798', ' gfct', '2023-08-02 10:13:04'),
(49, 'janmnhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 'janani8#jh.com', '87987h98798', 'hjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2023-08-02 10:14:37'),
(50, 'janmnhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 'janani8#jh.com', '87987h98798', 'hjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2023-08-02 10:14:46'),
(51, 'janmnhjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 'janani8#jh.com', '87987h98798', 'hjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2023-08-02 10:14:55'),
(52, 'janmn', 'jhkj#jh.com', '87987h98798', 'dffffffffffffffffffffffffffffffffffffffffffffffffff', '2023-08-02 10:17:08'),
(53, 'Regu', 'reguramachandran007@gmail.com', '78956123111', 'hi', '2023-08-07 11:02:32'),
(54, '56', '56456', '5464', '56456', '2023-09-05 07:32:08'),
(55, 'rte', 'gf', 'gfdg', 'dgh', '2023-09-05 07:32:39'),
(56, 'Gowtham ', 'gprassanaa@gmail.com', '9786774909', 'Testing ', '2023-11-29 15:12:31'),
(57, 'gowtham ', 'gprassanaa@gmail.com', '9786774909', 'testing', '2024-02-03 14:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `listing_tbl`
--

CREATE TABLE `listing_tbl` (
  `id` int(11) NOT NULL,
  `name_of_list` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listing_tbl`
--

INSERT INTO `listing_tbl` (`id`, `name_of_list`, `created_at`, `update_at`, `deleted_at`) VALUES
(9, 'Best Seller', '2023-07-10 09:46:54', '2023-09-05 04:59:52', '1'),
(10, 'Newly added', '2023-07-24 21:18:49', '2023-09-05 04:59:58', '1'),
(11, 'title test', '2023-08-15 22:00:04', NULL, NULL),
(12, 'cotton bag', '2024-02-03 14:15:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `pro_id` int(11) NOT NULL,
  `prod_id` varchar(200) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_category` varchar(50) DEFAULT NULL,
  `product_listing` varchar(50) DEFAULT NULL,
  `product_image` text NOT NULL,
  `product_images` text DEFAULT NULL,
  `editable_lable` varchar(200) DEFAULT NULL,
  `editable_input` varchar(2000) DEFAULT NULL,
  `pro_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_info_tbl`
--

CREATE TABLE `quotation_info_tbl` (
  `id` int(11) NOT NULL,
  `order_id` varchar(200) DEFAULT NULL,
  `name_of_company` varchar(100) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_email` varchar(100) NOT NULL,
  `cust_phno` varchar(100) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `bag_qty` varchar(100) NOT NULL,
  `additonal_input_groups` varchar(200) NOT NULL,
  `bag_printing_text` text NOT NULL,
  `colors` varchar(200) DEFAULT NULL,
  `cust_message` text DEFAULT NULL,
  `referance_image` text NOT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `product_code` varchar(100) DEFAULT NULL,
  `crated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `additional_label_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotation_info_tbl`
--

INSERT INTO `quotation_info_tbl` (`id`, `order_id`, `name_of_company`, `cust_name`, `cust_email`, `cust_phno`, `cust_address`, `bag_qty`, `additonal_input_groups`, `bag_printing_text`, `colors`, `cust_message`, `referance_image`, `product_id`, `seen`, `product_code`, `crated_at`, `additional_label_info`) VALUES
(85, 'ORD-240203-85', 'gowtham', 'gowtham', 'gprassanaa@gmail.com', '9786774909', '', '1000000', '', '', NULL, '', '[]', '1', 1, '#BAG326', '2024-02-03 07:26:05', '[\"Zipper\"]');

-- --------------------------------------------------------

--
-- Table structure for table `quote_form_tbl`
--

CREATE TABLE `quote_form_tbl` (
  `id` int(11) NOT NULL,
  `type` varchar(124) DEFAULT NULL,
  `form_structure_json` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quote_form_tbl`
--

INSERT INTO `quote_form_tbl` (`id`, `type`, `form_structure_json`, `created_at`) VALUES
(2, 'normal', '[{\"inputContainer\":{\"elementName\":\"div\",\"elementNameAttribute\":{\"class\":\"form-quote_option w-100 mb-4 my-3 position-relative\"}},\"inputTags\":{\"name\":\"select\",\"inputAttribute\":{\"id\":\"Fabrictype\",\"name\":\"additonal_input_groups[]\"},\"optionTagValue\":[\"\",\"Cotton\",\"Jute\",\"Canvas\",\"nylon\"]},\"inputLable\":{\"lab\":\"label\",\"labelName\":\"Fabric type\",\"labelAttribute\":{\"class\":\" \",\"for\":\"Fabrictype\"}},\"removeBtn\":{\"elementName\":\"button\",\"elementNameAttribute\":{\"class\":\"btn delete-btn shadow-none\",\"type\":\"button\",\"data-input-Value\":\"Fabrictype\"},\"nestedElement\":{\"elementName\":\"i\",\"elementNameAttribute\":{\"class\":\"fa-solid fa-circle-xmark\"}}},\"editBtn\":{\"elementName\":\"button\",\"elementNameAttribute\":{\"class\":\"btn select-option-add-btn shadow-none\",\"type\":\"button\",\"data-input-Value\":\"Fabrictype\"},\"nestedElement\":{\"elementName\":\"i\",\"elementNameAttribute\":{\"class\":\"fa-solid fa-square-plus\"}}}},{\"inputContainer\":{\"elementName\":\"div\",\"elementNameAttribute\":{\"class\":\"form-quote_input w-100 my-3 mb-4 position-relative\"}},\"inputTags\":{\"name\":\"input\",\"inputAttribute\":{\"placeholder\":\" \",\"type\":\"text\",\"class\":\" \",\"id\":\"Nylon\",\"name\":\"additonal_input_groups[]\"}},\"inputLable\":{\"lab\":\"label\",\"labelName\":\"Nylon\",\"labelAttribute\":{\"class\":\" \",\"for\":\"Nylon\"}},\"removeBtn\":{\"elementName\":\"button\",\"elementNameAttribute\":{\"class\":\"btn delete-btn shadow-none\",\"type\":\"button\",\"data-input-Value\":\"Nylon\"},\"nestedElement\":{\"elementName\":\"i\",\"elementNameAttribute\":{\"class\":\"fa-solid fa-circle-xmark\"}}}}]', '2023-08-07 10:04:23'),
(3, 'product', '[{\"inputContainer\":{\"elementName\":\"div\",\"elementNameAttribute\":{\"class\":\"form-quote_option w-100 mb-4 my-3 position-relative\"}},\"inputTags\":{\"name\":\"select\",\"inputAttribute\":{\"id\":\"Zipper\",\"name\":\"additonal_input_groups[]\"},\"optionTagValue\":[\"\",\"Metal\",\"Brass\",\"Antique Brass\",\"Aluminum\",\"Zinc\",\"Molded Plastic\",\"Delrin Molded Plastic\",\"Plastic Extruded\",\"L-Type\",\"Nylon\",\"Woven-in Coil\"]},\"inputLable\":{\"lab\":\"label\",\"labelName\":\"Zipper\",\"labelAttribute\":{\"class\":\" \",\"for\":\"Zipper\"}},\"removeBtn\":{\"elementName\":\"button\",\"elementNameAttribute\":{\"class\":\"btn delete-btn shadow-none\",\"type\":\"button\",\"data-input-Value\":\"Zipper\"},\"nestedElement\":{\"elementName\":\"i\",\"elementNameAttribute\":{\"class\":\"fa-solid fa-circle-xmark\"}}},\"editBtn\":{\"elementName\":\"button\",\"elementNameAttribute\":{\"class\":\"btn select-option-add-btn shadow-none\",\"type\":\"button\",\"data-input-Value\":\"Zipper\"},\"nestedElement\":{\"elementName\":\"i\",\"elementNameAttribute\":{\"class\":\"fa-solid fa-square-plus\"}}}}]', '2023-08-07 10:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `rating_tbl`
--

CREATE TABLE `rating_tbl` (
  `id` int(11) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `selling_count` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bags_collection`
--
ALTER TABLE `bags_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_request`
--
ALTER TABLE `enquiry_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing_tbl`
--
ALTER TABLE `listing_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `quotation_info_tbl`
--
ALTER TABLE `quotation_info_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quote_form_tbl`
--
ALTER TABLE `quote_form_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_tbl`
--
ALTER TABLE `rating_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authentication`
--
ALTER TABLE `authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bags_collection`
--
ALTER TABLE `bags_collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_tbl`
--
ALTER TABLE `contact_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiry_request`
--
ALTER TABLE `enquiry_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `listing_tbl`
--
ALTER TABLE `listing_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_info_tbl`
--
ALTER TABLE `quotation_info_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `quote_form_tbl`
--
ALTER TABLE `quote_form_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rating_tbl`
--
ALTER TABLE `rating_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
