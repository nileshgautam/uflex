-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 02:48 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uflex`
--

-- --------------------------------------------------------

--
-- Table structure for table `london_stock`
--

CREATE TABLE `london_stock` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `item_description` longtext NOT NULL,
  `qty` double NOT NULL,
  `amount` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `last_updated` datetime NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `london_stock`
--

INSERT INTO `london_stock` (`id`, `invoice_number`, `item_code`, `item_description`, `qty`, `amount`, `rate`, `update_by`, `last_updated`, `invoice_date`) VALUES
(49, 'INVC200202106', 'YLG500V4', 'TILDA LONG GRAN 500G', 200, 6000, 30, 'London- outlet ', '2020-06-05 15:28:09', '2020-05-28'),
(50, 'INVC200202105', 'YLG500V4', 'TILDA LONG GRAN 500G', 200, 6000, 30, 'London- outlet ', '2020-06-05 15:28:09', '2020-05-31'),
(51, 'INVC200202100', 'YLG500V4', 'TILDA LONG GRAN 500G', 500, 2000, 40, 'London- outlet ', '2020-06-05 16:18:36', '2020-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `master_invoice`
--

CREATE TABLE `master_invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `doi` date NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_description` text NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_rate` float NOT NULL,
  `product_amount` float NOT NULL,
  `entery_datetime` datetime NOT NULL,
  `entered_by` varchar(50) NOT NULL,
  `send_status` int(11) NOT NULL DEFAULT 0,
  `reject_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_invoice`
--

INSERT INTO `master_invoice` (`id`, `invoice_number`, `doi`, `product_code`, `product_description`, `product_qty`, `product_rate`, `product_amount`, `entery_datetime`, `entered_by`, `send_status`, `reject_reason`) VALUES
(429, 'INVC200202100', '2020-05-28', 'YLG500V4', 'TILDA LONG GRAN 500G', 500, 40, 2000, '2020-06-05 15:24:36', 'India outlet', 30, ''),
(430, 'INVC200202100', '2020-05-28', 'YELG500V4', 'TILDA EASY COOK LONG GRAN 500G', 1000, 60, 60000, '2020-06-05 15:24:37', 'India outlet', 20, 'weight not matched'),
(431, 'INVC200202102', '2020-05-29', 'YLG500V4', 'TILDA LONG GRAN 500G', 200, 30, 6000, '2020-06-05 15:24:37', 'India outlet', 0, ''),
(432, 'INVC200202102', '2020-05-29', 'YELG500V4', 'TILDA EASY COOK LONG GRAN 500G', 500, 40, 20000, '2020-06-05 15:24:37', 'India outlet', 0, ''),
(433, 'INVC200202103', '2020-05-30', 'YELG500V4', 'TILDA EASY COOK LONG GRAN 500G', 200, 70, 14000, '2020-06-05 15:24:37', 'India outlet', 10, ''),
(434, 'INVC200202104', '2020-05-31', 'YLG500V4', 'TILDA LONG GRAN 500G', 200, 30, 6000, '2020-06-05 15:24:37', 'India outlet', 10, ''),
(435, 'INVC200202105', '2020-05-31', 'YLG500V4', 'TILDA LONG GRAN 500G', 200, 30, 6000, '2020-06-05 15:24:37', 'India outlet', 30, ''),
(436, 'INVC200202106', '2020-05-28', 'YLG500V4', 'TILDA LONG GRAN 500G', 200, 30, 6000, '2020-06-05 15:24:37', 'India outlet', 30, ''),
(437, 'INV2705200003', '2020-07-01', 'Y0002', 'Lorem epsum', 15, 10, 150, '2020-06-05 15:26:43', 'India outlet', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `master_product`
--

CREATE TABLE `master_product` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_product`
--

INSERT INTO `master_product` (`id`, `code`, `description`, `status`) VALUES
(1, 'YLG500V4', 'TILDA LONG GRAN 500G', 1),
(2, 'YELG500V4', 'TILDA EASY COOK LONG GRAN 500G', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `code` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `code`, `active`, `first_name`, `last_name`, `role`) VALUES
(1, 'london', '123456', 'london@uflex.com', '', 0, 'London- outlet', '', 'ldn'),
(2, 'india', 'india', 'india@uflex.com', '', 0, 'India', 'outlet', 'ind'),
(3, 'Manager', 'manager', 'manager@uflex.com', '', 0, 'UFlex', 'Manager', 'manager'),
(4, 'admin', 'admin', 'admin@uflex.com', '', 0, 'admin', '', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `london_stock`
--
ALTER TABLE `london_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_invoice`
--
ALTER TABLE `master_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_product`
--
ALTER TABLE `master_product`
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
-- AUTO_INCREMENT for table `london_stock`
--
ALTER TABLE `london_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `master_invoice`
--
ALTER TABLE `master_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT for table `master_product`
--
ALTER TABLE `master_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
