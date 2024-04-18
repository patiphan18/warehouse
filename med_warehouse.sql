-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 04:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `med_warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `wh_employee`
--

CREATE TABLE `wh_employee` (
  `emp_id` int(11) NOT NULL COMMENT 'ไอดีพนักงาน',
  `emp_code` int(11) NOT NULL COMMENT 'รหัสพนักงาน',
  `emp_name` varchar(255) NOT NULL COMMENT 'ชื่อ-นามสกุล',
  `emp_email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `emp_password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wh_employee`
--

INSERT INTO `wh_employee` (`emp_id`, `emp_code`, `emp_name`, `emp_email`, `emp_password`) VALUES
(1, 63160248, 'ปฏิภาณ ปั้นสง่า', '63160248@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
(2, 63160999, 'เอเรน เยเกอร์', '63160999@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4');

-- --------------------------------------------------------

--
-- Table structure for table `wh_lot`
--

CREATE TABLE `wh_lot` (
  `lot_id` int(11) NOT NULL COMMENT 'ไอดีล็อต',
  `med_id` int(11) NOT NULL COMMENT 'ไอดียา',
  `lot_qty` int(11) NOT NULL COMMENT 'จำนวน',
  `lot_msg` date NOT NULL COMMENT 'วันที่ผลิต',
  `lot_exp` date NOT NULL COMMENT 'วันหมดอายุ',
  `lot_price` float NOT NULL COMMENT 'ราคารวม',
  `stat_id` int(11) NOT NULL COMMENT 'ไอดีสถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wh_lot`
--

INSERT INTO `wh_lot` (`lot_id`, `med_id`, `lot_qty`, `lot_msg`, `lot_exp`, `lot_price`, `stat_id`) VALUES
(1, 1, 500, '2022-03-08', '2025-03-08', 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wh_medicine`
--

CREATE TABLE `wh_medicine` (
  `med_id` int(11) NOT NULL COMMENT 'ไอดียา',
  `med_name` varchar(255) NOT NULL COMMENT 'ชื่อยา',
  `med_img` varchar(255) NOT NULL COMMENT 'ชื่อภาพยา',
  `med_price` float NOT NULL COMMENT 'ราคายา',
  `type_id` int(11) NOT NULL COMMENT 'ไอดีหมวดหมู่ยา',
  `med_code` varchar(255) NOT NULL COMMENT 'รหัสยา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wh_medicine`
--

INSERT INTO `wh_medicine` (`med_id`, `med_name`, `med_img`, `med_price`, `type_id`, `med_code`) VALUES
(1, 'ซาร่า เม็ดกลม', '1645187625_2ff3e7150015c3dc0306.jpg', 200, 1, '8851473001443'),
(2, 'พอนสแตน 500', '1645879204_1e5dc1f2cbd80ba3d41b.jpg', 50, 1, '8850339110527'),
(3, 'CA-R-BON ยาผงถ่าน', '1645879204_1e5dc1f2cbd80ba3d41d.jpeg', 150, 3, '8852294358013'),
(4, 'แอนตาซิล เยล เฮช เฮช', '1646816555_c8886182a1db9151c4c8.jpg', 50, 2, '8851473009159'),
(5, 'Air-x แอร์-เอ็กซ์ รสส้ม', '1646816957_ef08854c829c84f58af7.jpeg', 15, 1, '8852673000205'),
(6, 'NAVAMED แก้เมารถ เมาเรือ', '1646817560_ac4320c247985465a30d.jpg', 5, 1, '8852294176013');

-- --------------------------------------------------------

--
-- Table structure for table `wh_moving`
--

CREATE TABLE `wh_moving` (
  `move_id` int(11) NOT NULL COMMENT 'ไอดีการเคลื่อนย้าย',
  `lot_id` int(11) NOT NULL COMMENT 'ไอดีล็อตยา',
  `emp_id` int(11) NOT NULL COMMENT 'ไอดีพนักงาน',
  `stat_id` int(11) NOT NULL COMMENT 'ไอดีสถานะ',
  `move_date` datetime NOT NULL COMMENT 'วันที่บันทึก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wh_moving`
--

INSERT INTO `wh_moving` (`move_id`, `lot_id`, `emp_id`, `stat_id`, `move_date`) VALUES
(1, 1, 1, 1, '2022-03-09 16:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `wh_status_lot`
--

CREATE TABLE `wh_status_lot` (
  `stat_id` int(11) NOT NULL COMMENT 'ไอดีสถานะ',
  `stat_name` varchar(255) NOT NULL COMMENT 'ชื่อสถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wh_status_lot`
--

INSERT INTO `wh_status_lot` (`stat_id`, `stat_name`) VALUES
(1, 'นำเข้า'),
(2, 'จำหน่าย'),
(3, 'หมดอายุ'),
(4, 'เสียหาย');

-- --------------------------------------------------------

--
-- Table structure for table `wh_type_medicine`
--

CREATE TABLE `wh_type_medicine` (
  `type_id` int(11) NOT NULL COMMENT 'ไอดีหมวดหมู่',
  `type_name` varchar(255) NOT NULL COMMENT 'ชื่อหมวดหมู่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wh_type_medicine`
--

INSERT INTO `wh_type_medicine` (`type_id`, `type_name`) VALUES
(1, 'ยาเม็ด'),
(2, 'ยาน้ำ'),
(3, 'ยาแคปซูล');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wh_employee`
--
ALTER TABLE `wh_employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `wh_lot`
--
ALTER TABLE `wh_lot`
  ADD PRIMARY KEY (`lot_id`);

--
-- Indexes for table `wh_medicine`
--
ALTER TABLE `wh_medicine`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `wh_moving`
--
ALTER TABLE `wh_moving`
  ADD PRIMARY KEY (`move_id`);

--
-- Indexes for table `wh_status_lot`
--
ALTER TABLE `wh_status_lot`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `wh_type_medicine`
--
ALTER TABLE `wh_type_medicine`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wh_employee`
--
ALTER TABLE `wh_employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีพนักงาน', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wh_lot`
--
ALTER TABLE `wh_lot`
  MODIFY `lot_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีล็อต', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wh_medicine`
--
ALTER TABLE `wh_medicine`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดียา', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wh_moving`
--
ALTER TABLE `wh_moving`
  MODIFY `move_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีการเคลื่อนย้าย', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wh_status_lot`
--
ALTER TABLE `wh_status_lot`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีสถานะ', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wh_type_medicine`
--
ALTER TABLE `wh_type_medicine`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีหมวดหมู่', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
