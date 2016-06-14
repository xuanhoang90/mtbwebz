-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2016 at 04:51 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtbwebz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_attachment`
--

CREATE TABLE `xmtb_attachment` (
  `xid` double NOT NULL,
  `object_id` double NOT NULL,
  `attachment` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_comments`
--

CREATE TABLE `xmtb_comments` (
  `xid` double NOT NULL,
  `object_id` double NOT NULL,
  `parent` double NOT NULL,
  `content` text COLLATE utf32_unicode_ci NOT NULL,
  `post_time` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `post_by` double NOT NULL,
  `liked` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `liked_data` text COLLATE utf32_unicode_ci NOT NULL,
  `unliked` varchar(50) COLLATE utf32_unicode_ci NOT NULL,
  `unliked_data` text COLLATE utf32_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_config`
--

CREATE TABLE `xmtb_config` (
  `xid` double NOT NULL,
  `xkey` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `xvalue` text COLLATE utf8_unicode_ci NOT NULL,
  `config_by` double NOT NULL,
  `time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `backup` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_language`
--

CREATE TABLE `xmtb_language` (
  `xid` double NOT NULL,
  `xkey` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `xvalue` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `default_set` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `xmtb_language`
--

-- INSERT INTO `xmtb_language` (`xid`, `xkey`, `xvalue`, `default_set`, `icon`, `status`, `delete`) VALUES
-- (1, 'vi', 'Tiếng Việt', 1, '', 1, 0),
-- (2, 'en', 'English', 0, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_media`
--

CREATE TABLE `xmtb_media` (
  `xid` double NOT NULL,
  `parent` double NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` double NOT NULL,
  `lastmodify_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modify_by` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_media_folder`
--

CREATE TABLE `xmtb_media_folder` (
  `xid` double NOT NULL,
  `parent` double NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `item_count` int(11) NOT NULL,
  `create_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` double NOT NULL,
  `lastmodify_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modify_by` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_menu`
--

CREATE TABLE `xmtb_menu` (
  `xid` double NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `config` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastmodify_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` double NOT NULL,
  `modify_by` double NOT NULL,
  `backup` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_object`
--

CREATE TABLE `xmtb_object` (
  `xid` double NOT NULL,
  `parents` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `object_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post',
  `create_by` double NOT NULL,
  `create_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modify_by` double NOT NULL,
  `lastmodify_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_object_description`
--

CREATE TABLE `xmtb_object_description` (
  `xid` double NOT NULL,
  `object_id` double NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `backup` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'vi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_object_product`
--

CREATE TABLE `xmtb_object_product` (
  `xid` double NOT NULL,
  `object_id` double NOT NULL,
  `price` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `limit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `schedule` tinyint(1) NOT NULL DEFAULT '0',
  `time_start` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time_end` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantity_per_order` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `width` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `show_price` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_object_thumbnail`
--

CREATE TABLE `xmtb_object_thumbnail` (
  `xid` double NOT NULL,
  `object_id` double NOT NULL,
  `media_id` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_order`
--

CREATE TABLE `xmtb_order` (
  `xid` double NOT NULL,
  `product_id` double NOT NULL,
  `user_id` double NOT NULL,
  `quantity` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `feedback` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` double NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `ship_type` double NOT NULL,
  `ship_status` tinyint(1) NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `secret_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_payment_setting`
--

CREATE TABLE `xmtb_payment_setting` (
  `xid` double NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_permission`
--

CREATE TABLE `xmtb_permission` (
  `xid` double NOT NULL,
  `user_id` double NOT NULL,
  `setting` text COLLATE utf8_unicode_ci NOT NULL,
  `modify_by` double NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_ship_setting`
--

CREATE TABLE `xmtb_ship_setting` (
  `xid` double NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `fee` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_slider`
--

CREATE TABLE `xmtb_slider` (
  `xid` double NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `config` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastmodify_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `create_by` double NOT NULL,
  `modify_by` double NOT NULL,
  `backup` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_user`
--

CREATE TABLE `xmtb_user` (
  `xid` double NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_first` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_last` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_display` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `other_data` text COLLATE utf8_unicode_ci NOT NULL,
  `register_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `infomodify_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `backup` text COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `xmtb_webdata`
--

CREATE TABLE `xmtb_webdata` (
  `xid` double NOT NULL,
  `xkey` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `xvalue` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `config_by` double NOT NULL,
  `lastmodify_time` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `backup` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xmtb_attachment`
--
ALTER TABLE `xmtb_attachment`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_comments`
--
ALTER TABLE `xmtb_comments`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_config`
--
ALTER TABLE `xmtb_config`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_language`
--
ALTER TABLE `xmtb_language`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_media`
--
ALTER TABLE `xmtb_media`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_media_folder`
--
ALTER TABLE `xmtb_media_folder`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_menu`
--
ALTER TABLE `xmtb_menu`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_object`
--
ALTER TABLE `xmtb_object`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_object_description`
--
ALTER TABLE `xmtb_object_description`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_object_product`
--
ALTER TABLE `xmtb_object_product`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_object_thumbnail`
--
ALTER TABLE `xmtb_object_thumbnail`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_order`
--
ALTER TABLE `xmtb_order`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_payment_setting`
--
ALTER TABLE `xmtb_payment_setting`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_permission`
--
ALTER TABLE `xmtb_permission`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_ship_setting`
--
ALTER TABLE `xmtb_ship_setting`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_slider`
--
ALTER TABLE `xmtb_slider`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_user`
--
ALTER TABLE `xmtb_user`
  ADD PRIMARY KEY (`xid`);

--
-- Indexes for table `xmtb_webdata`
--
ALTER TABLE `xmtb_webdata`
  ADD PRIMARY KEY (`xid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xmtb_attachment`
--
ALTER TABLE `xmtb_attachment`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_comments`
--
ALTER TABLE `xmtb_comments`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_config`
--
ALTER TABLE `xmtb_config`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_language`
--
ALTER TABLE `xmtb_language`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `xmtb_media`
--
ALTER TABLE `xmtb_media`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_media_folder`
--
ALTER TABLE `xmtb_media_folder`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_menu`
--
ALTER TABLE `xmtb_menu`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_object`
--
ALTER TABLE `xmtb_object`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_object_description`
--
ALTER TABLE `xmtb_object_description`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_object_product`
--
ALTER TABLE `xmtb_object_product`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_object_thumbnail`
--
ALTER TABLE `xmtb_object_thumbnail`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_order`
--
ALTER TABLE `xmtb_order`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_payment_setting`
--
ALTER TABLE `xmtb_payment_setting`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_permission`
--
ALTER TABLE `xmtb_permission`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_ship_setting`
--
ALTER TABLE `xmtb_ship_setting`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_slider`
--
ALTER TABLE `xmtb_slider`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_user`
--
ALTER TABLE `xmtb_user`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xmtb_webdata`
--
ALTER TABLE `xmtb_webdata`
  MODIFY `xid` double NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
