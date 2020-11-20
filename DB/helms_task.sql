-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 10:55 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helms_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(3) NOT NULL,
  `sector_name` varchar(80) NOT NULL,
  `main_sector_id` int(3) NOT NULL,
  `sub_sub_sector_id` int(3) NOT NULL,
  `sub_cat_level` int(2) NOT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `sector_name`, `main_sector_id`, `sub_sub_sector_id`, `sub_cat_level`, `is_parent`) VALUES
(1, 'Construction materials', 80, 0, 0, 0),
(2, 'Electronics and Optics', 80, 0, 0, 0),
(3, 'Food and Beverage', 80, 0, 1, 0),
(4, 'Bakery & confectionery products', 80, 3, 0, 0),
(5, 'Beverages', 80, 3, 0, 0),
(6, 'Fish & fish products', 80, 3, 0, 0),
(7, 'Meat & meat products', 80, 3, 0, 0),
(8, 'Milk & dairy products', 80, 3, 0, 0),
(9, 'Other', 80, 3, 0, 0),
(10, 'Sweets & snack food', 80, 3, 0, 0),
(11, 'Furniture', 80, 0, 1, 0),
(12, 'Bathroom/sauna', 80, 11, 0, 0),
(13, 'Bedroom', 80, 11, 0, 0),
(14, 'Childrenâ€™s room', 80, 11, 0, 0),
(15, 'Kitchen', 80, 11, 0, 0),
(16, 'Living room', 80, 11, 0, 0),
(17, 'Office', 80, 11, 0, 0),
(18, 'Other (Furniture)', 80, 11, 0, 0),
(19, 'Outdoor', 80, 11, 0, 0),
(20, 'Project furniture', 80, 11, 0, 0),
(21, 'Machinery', 80, 0, 1, 0),
(22, 'Machinery components', 80, 21, 0, 0),
(23, 'Machinery equipment/tools', 80, 21, 0, 0),
(24, 'Manufacture of machinery', 80, 21, 0, 0),
(25, 'Maritime', 80, 21, 2, 0),
(26, 'Aluminium and steel workboats', 80, 25, 0, 0),
(27, 'Boat/Yacht building', 80, 25, 0, 0),
(28, 'Ship repair and conversion', 80, 25, 0, 0),
(29, 'Metal structures', 80, 21, 0, 0),
(30, 'Other', 80, 21, 0, 0),
(31, 'Repair and maintenance service', 80, 21, 0, 0),
(32, 'Metalworking', 80, 0, 1, 0),
(33, 'Construction of metal structures', 80, 32, 0, 0),
(34, 'Houses and buildings', 80, 32, 0, 0),
(35, 'Metal products', 80, 32, 0, 0),
(36, 'Metal works', 80, 32, 2, 0),
(37, 'CNC-machining', 80, 36, 0, 0),
(38, 'Forgings, Fasteners', 80, 36, 0, 0),
(39, 'Gas, Plasma, Laser cutting', 80, 36, 0, 0),
(40, 'MIG, TIG, Aluminum welding', 80, 36, 0, 0),
(41, 'Plastic and Rubber', 80, 0, 1, 0),
(42, 'Packaging', 80, 41, 0, 0),
(43, 'Plastic goods', 80, 41, 0, 0),
(44, 'Plastic processing technology', 80, 41, 2, 0),
(45, 'Blowing', 80, 44, 0, 0),
(46, 'Moulding', 80, 44, 0, 0),
(47, 'Plastics welding and processing', 80, 44, 0, 0),
(48, 'Plastic profiles', 80, 41, 0, 0),
(49, 'Printing', 80, 0, 1, 0),
(50, 'Advertising', 80, 49, 0, 0),
(51, 'Book/Periodicals printing', 80, 49, 0, 0),
(52, 'Labelling and packaging printing', 80, 49, 0, 0),
(53, 'Textile and Clothing', 80, 0, 1, 0),
(54, 'Clothing', 80, 53, 0, 0),
(55, 'Textile', 80, 53, 0, 0),
(56, 'Wood', 80, 0, 1, 0),
(57, 'Other (Wood)', 80, 56, 0, 0),
(58, 'Wooden building materials', 80, 56, 0, 0),
(59, 'Wooden houses', 80, 56, 0, 0),
(60, 'Creative industries', 82, 0, 0, 0),
(61, 'Energy technology', 82, 0, 0, 0),
(62, 'Environment', 82, 0, 0, 0),
(63, 'Business services', 81, 0, 0, 0),
(64, 'Engineering', 81, 0, 0, 0),
(65, 'Information Technology and Telecommunications', 81, 0, 1, 0),
(66, 'Data processing, Web portals, E-marketing', 81, 65, 0, 0),
(67, 'Programming, Consultancy', 81, 65, 0, 0),
(68, 'Software, Hardware', 81, 65, 0, 0),
(69, 'Telecommunications', 81, 65, 0, 0),
(70, 'Tourism', 81, 0, 0, 0),
(71, 'Translation services', 81, 0, 0, 0),
(72, 'Transport and Logistics', 81, 0, 1, 0),
(73, 'Air', 81, 72, 0, 0),
(74, 'Rail', 81, 72, 0, 0),
(75, 'Road', 81, 72, 0, 0),
(76, 'Water', 81, 72, 0, 0),
(80, 'Manufacturing', 0, 0, 0, 1),
(81, 'Service', 0, 0, 0, 1),
(82, 'Other', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `user_name` varchar(70) NOT NULL,
  `sector_id` int(2) NOT NULL,
  `user_terms_agree` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `sector_id`, `user_terms_agree`) VALUES
(1, 'Soumen Banerjee', 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_sector_id` (`main_sector_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
