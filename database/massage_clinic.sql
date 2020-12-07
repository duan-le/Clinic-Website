-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2020 at 04:40 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `massage_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoint_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `client_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `service_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoint_id`, `day`, `month`, `year`, `time`, `client_id`, `employee_id`, `service_name`) VALUES
(1, 1, '12', '2020', '15:00', 1, 2, 'Accupuncture');

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `account_number` int(11) NOT NULL,
  `account_type` varchar(45) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`account_number`, `account_type`, `employee_id`) VALUES
(1, 'Chequing', 1),
(2, 'Savings', 2);

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `month` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`month`, `year`) VALUES
('01', '2020'),
('01', '2021'),
('02', '2020'),
('02', '2021'),
('03', '2020'),
('03', '2021'),
('04', '2020'),
('04', '2021'),
('05', '2020'),
('05', '2021'),
('06', '2020'),
('06', '2021'),
('07', '2020'),
('07', '2021'),
('08', '2020'),
('08', '2021'),
('09', '2020'),
('09', '2021'),
('10', '2020'),
('10', '2021'),
('11', '2020'),
('11', '2021'),
('12', '2020'),
('12', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `birthdate` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `phone_number` varchar(45) NOT NULL,
  `sex` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`user_id`, `first_name`, `last_name`, `password`, `birthdate`, `address`, `phone_number`, `sex`) VALUES
(1, 'Kyle', 'Lowry', 'phat', '05/05/1980', '312 Phat Blvd', '1324657980', 'M'),
(2, 'Serge', 'Ibaka', 'hellothere', '01/01/2000', '159 Clippers Lane', '9876543210', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dnumber` int(11) NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dnumber`, `type`) VALUES
(1, 'Massage'),
(2, 'Spa'),
(3, 'Clinical');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `birthdate` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `phone_number` varchar(45) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `start_date` varchar(45) NOT NULL,
  `wage` int(11) NOT NULL,
  `hours` int(11) NOT NULL,
  `SIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`user_id`, `first_name`, `last_name`, `password`, `birthdate`, `address`, `phone_number`, `sex`, `start_date`, `wage`, `hours`, `SIN`) VALUES
(1, 'Pascal', 'Siakam', 'rapsin4', '01/01/2001', '123 Raps Street', '1234567890', 'M', '12/01/2020', 30, 15, 123456789),
(2, 'Big', 'Boi', 'hello', '02/02/1999', '321 Boi Street', '0987654321', 'F', '10/10/2020', 32, 20, 987654321);

-- --------------------------------------------------------

--
-- Table structure for table `health_report`
--

CREATE TABLE `health_report` (
  `client_id` int(11) NOT NULL,
  `date` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `health_report`
--

INSERT INTO `health_report` (`client_id`, `date`) VALUES
(1, '12/01/2020'),
(2, '11/10/2020');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `price`) VALUES
(1, 'Lotion', 10.95),
(2, 'Diffuser Blend', 24.95),
(3, 'Massage Oil', 10),
(4, 'Diffuser', 49.99),
(5, 'Candle', 2.99),
(6, 'Green Tea', 9.99);

-- --------------------------------------------------------

--
-- Table structure for table `product_receipt`
--

CREATE TABLE `product_receipt` (
  `product_id` int(11) NOT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_receipt`
--

INSERT INTO `product_receipt` (`product_id`, `receipt_number`) VALUES
(1, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `purchased_by`
--

CREATE TABLE `purchased_by` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchased_by`
--

INSERT INTO `purchased_by` (`product_id`, `user_id`) VALUES
(1, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `number` int(11) NOT NULL,
  `date` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`number`, `date`) VALUES
(1, '12/01/2020'),
(2, '11/20/2020'),
(3, '11/21/2020');

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `dnumber` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`dnumber`, `product_id`) VALUES
(1, 1),
(2, 2),
(1, 3),
(2, 4),
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `name` varchar(45) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`name`, `price`) VALUES
('Accupuncture', 50),
('Cupping Therapy', 25),
('Hot Stone Massage', 30),
('Reflexology', 40);

-- --------------------------------------------------------

--
-- Table structure for table `service_receipt`
--

CREATE TABLE `service_receipt` (
  `service_name` varchar(45) NOT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service_receipt`
--

INSERT INTO `service_receipt` (`service_name`, `receipt_number`) VALUES
('Reflexology', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoint_id`),
  ADD KEY `fk_client_id_idx` (`client_id`),
  ADD KEY `fk_employee_id_idx` (`employee_id`),
  ADD KEY `fk_month_idx` (`month`,`year`),
  ADD KEY `fk_service_name_idx` (`service_name`);

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`account_number`),
  ADD KEY `fk_employee_id_idx` (`employee_id`),
  ADD KEY `fk_employee_id_bank_idx` (`employee_id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`month`,`year`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dnumber`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `health_report`
--
ALTER TABLE `health_report`
  ADD PRIMARY KEY (`client_id`,`date`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_receipt`
--
ALTER TABLE `product_receipt`
  ADD PRIMARY KEY (`product_id`,`receipt_number`),
  ADD KEY `fk_receipt_number_pr_idx` (`receipt_number`);

--
-- Indexes for table `purchased_by`
--
ALTER TABLE `purchased_by`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `fk_user_id_idx` (`user_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`dnumber`,`product_id`),
  ADD KEY `fk_product_id_idx` (`product_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `service_receipt`
--
ALTER TABLE `service_receipt`
  ADD PRIMARY KEY (`service_name`,`receipt_number`),
  ADD KEY `fk_receipt_number_idx` (`receipt_number`),
  ADD KEY `fk_service_name_idx` (`service_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `account_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_appoint_name_appoint` FOREIGN KEY (`service_name`) REFERENCES `service` (`name`),
  ADD CONSTRAINT `fk_calendar` FOREIGN KEY (`month`,`year`) REFERENCES `calendar` (`month`, `year`),
  ADD CONSTRAINT `fk_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`user_id`),
  ADD CONSTRAINT `fk_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`user_id`);

--
-- Constraints for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `fk_employee_id_bank` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`user_id`);

--
-- Constraints for table `health_report`
--
ALTER TABLE `health_report`
  ADD CONSTRAINT `fk_client_user_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`user_id`);

--
-- Constraints for table `product_receipt`
--
ALTER TABLE `product_receipt`
  ADD CONSTRAINT `fk_product_id_pr` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `fk_receipt_number_pr` FOREIGN KEY (`receipt_number`) REFERENCES `receipt` (`number`);

--
-- Constraints for table `purchased_by`
--
ALTER TABLE `purchased_by`
  ADD CONSTRAINT `fk_product_id_pur` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `client` (`user_id`);

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `fk_dnumber` FOREIGN KEY (`dnumber`) REFERENCES `department` (`dnumber`),
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `service_receipt`
--
ALTER TABLE `service_receipt`
  ADD CONSTRAINT `fk_receipt_number` FOREIGN KEY (`receipt_number`) REFERENCES `receipt` (`number`),
  ADD CONSTRAINT `fk_service_name` FOREIGN KEY (`service_name`) REFERENCES `service` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
