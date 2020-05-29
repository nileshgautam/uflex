-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 08:31 AM
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
  `enerd_date_time` datetime NOT NULL,
  `entered_by` varchar(50) NOT NULL,
  `send_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_invoice`
--

INSERT INTO `master_invoice` (`id`, `invoice_number`, `doi`, `product_code`, `product_description`, `product_qty`, `product_rate`, `product_amount`, `enerd_date_time`, `entered_by`, `send_status`) VALUES
(23, 'INV280520200001', '2020-05-28', 'P001', 'Lorem epsum', 1, 2, 10, '2020-05-28 16:38:07', '2', 0),
(24, 'INV290520200001', '2020-05-29', 'P002', 'Lorem epsum', 5, 2, 10, '2020-05-28 16:54:06', '2', 0),
(25, 'INV290520200001', '2020-05-29', 'P003', 'Lorem epsum', 50, 500, 25000, '2020-05-28 16:54:06', '2', 0),
(26, 'INV270520200001', '2020-05-27', 'P002', 'Lorem epsum', 10, 2000, 20000, '2020-05-28 17:47:11', '2', 0),
(27, 'INV2705200003', '2020-05-27', 'P002', 'lorem epsum', 10, 5, 2, '2020-05-28 17:49:19', '2', 0);

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
-- AUTO_INCREMENT for table `master_invoice`
--
ALTER TABLE `master_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
