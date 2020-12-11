-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2020 at 07:59 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `appointment_client_search` (IN `ci` INT(11))  READS SQL DATA
SELECT * FROM appointment WHERE client_id = ci$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `appointment_delete` (IN `ai` INT(11))  MODIFIES SQL DATA
DELETE FROM appointment WHERE appoint_id = ai$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `appointment_employee_search` (IN `ei` INT(11))  READS SQL DATA
SELECT * FROM appointment WHERE employee_id = ei$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `appointment_insert` (IN `d` VARCHAR(45), IN `m` VARCHAR(45), IN `y` VARCHAR(45), IN `t` VARCHAR(45), IN `ci` INT(11), IN `ei` INT(11), IN `sn` VARCHAR(45))  MODIFIES SQL DATA
INSERT INTO appointment SET day = d, month = m, year = y, time = t, client_id = ci, employee_id = ei, service_name = sn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `appointment_update` (IN `d` VARCHAR(45), IN `m` VARCHAR(45), IN `y` VARCHAR(45), IN `t` VARCHAR(45), IN `ci` INT(11), IN `ei` INT(11), IN `sn` VARCHAR(45), IN `ai` INT(11))  MODIFIES SQL DATA
UPDATE appointment SET day = d, month = m, year = y, time = t, client_id = ci, employee_id = ei, service_name = sn WHERE appoint_id = ai$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `appointment_view` ()  READS SQL DATA
SELECT * FROM appointment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bankaccount_delete` (IN `ei` INT(11))  MODIFIES SQL DATA
DELETE FROM bank_account WHERE employee_id = ei$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bankaccount_insert` (IN `an` INT(11), IN `at` VARCHAR(45), IN `ei` INT(11))  MODIFIES SQL DATA
INSERT INTO bank_account SET account_number = an, account_type = at, employee_id = ei$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bankaccount_search` (IN `ei` INT(11))  READS SQL DATA
SELECT * FROM bank_account WHERE employee_id = ei$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bankaccount_update` (IN `an` INT(11), IN `at` VARCHAR(45), IN `ei` INT(11))  MODIFIES SQL DATA
UPDATE bank_account SET account_number = an, account_type = at WHERE employee_id = ei$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bankaccount_view` ()  READS SQL DATA
SELECT * FROM bank_account$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calendar_delete` (IN `m` VARCHAR(45), IN `y` VARCHAR(45))  NO SQL
DELETE FROM calendar WHERE month = m AND year = y$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calendar_insert` (IN `m` VARCHAR(45), IN `y` VARCHAR(45))  MODIFIES SQL DATA
INSERT INTO calendar SET month = m, year = y$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calendar_search` (IN `y` VARCHAR(45))  READS SQL DATA
SELECT * FROM calendar WHERE year = y$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calendar_view` ()  READS SQL DATA
SELECT * FROM calendar$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_delete` (IN `ui` INT(11))  MODIFIES SQL DATA
DELETE FROM client WHERE user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_insert` (IN `fn` VARCHAR(45), IN `ln` VARCHAR(45), IN `p` VARCHAR(45), IN `bd` VARCHAR(45), IN `ad` VARCHAR(45), IN `pn` VARCHAR(45), IN `s` VARCHAR(45))  MODIFIES SQL DATA
INSERT INTO client SET first_name = fn, last_name = ln, password = p, birthdate = bd, address = ad, phone_number = pn, sex = s$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_search` (IN `ui` INT(11))  READS SQL DATA
SELECT first_name, last_name, birthdate, address, phone_number, sex FROM client WHERE user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_update` (IN `fn` VARCHAR(45), IN `ln` VARCHAR(45), IN `p` VARCHAR(45), IN `bd` VARCHAR(45), IN `ad` VARCHAR(45), IN `pn` VARCHAR(45), IN `s` VARCHAR(45), IN `ui` INT(11))  MODIFIES SQL DATA
UPDATE client SET first_name = fn, last_name = ln, password = p, birthdate = bd, address = ad, phone_number = pn, sex = s WHERE user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_view` ()  READS SQL DATA
SELECT user_id, first_name, last_name, birthdate, address, phone_number, sex FROM client$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `department_delete` (IN `dn` INT(11))  MODIFIES SQL DATA
DELETE FROM department WHERE dnumber = dn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `department_insert` (IN `t` VARCHAR(45))  MODIFIES SQL DATA
INSERT INTO department SET type = t$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `department_search` (IN `dn` INT(11))  READS SQL DATA
SELECT * FROM department WHERE dnumber = dn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `department_update` (IN `t` VARCHAR(45), IN `dn` INT(11))  MODIFIES SQL DATA
UPDATE department SET type = t WHERE dnumber = dn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `department_view` ()  READS SQL DATA
SELECT * FROM department$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_delete` (IN `ui` INT(11))  MODIFIES SQL DATA
DELETE FROM employee WHERE user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_insert` (IN `fn` VARCHAR(45), IN `ln` VARCHAR(45), IN `p` VARCHAR(45), IN `bd` VARCHAR(45), IN `ad` VARCHAR(45), IN `pn` VARCHAR(45), IN `s` VARCHAR(45), IN `sd` VARCHAR(45), IN `w` INT(11), IN `h` INT(11), IN `sin` INT(11))  MODIFIES SQL DATA
INSERT INTO employee SET first_name = fn, last_name = ln, password = p, birthdate = bd, address = ad, phone_number = pn, sex = s, start_date = sd, wage = w, hours = h, SIN = sin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_search` (IN `ui` INT(11))  READS SQL DATA
SELECT * FROM employee WHERE user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_update` (IN `fn` VARCHAR(45), IN `ln` VARCHAR(45), IN `p` VARCHAR(45), IN `bd` VARCHAR(45), IN `ad` VARCHAR(45), IN `pn` VARCHAR(45), IN `s` VARCHAR(45), IN `sd` VARCHAR(45), IN `w` INT(11), IN `h` INT(11), IN `sin` INT(11), IN `ui` INT(11))  MODIFIES SQL DATA
UPDATE employee SET first_name = fn, last_name = ln, password = p, birthdate = bd, address = ad, phone_number = pn, sex = s, start_date = sd, wage = w, hours = h, SIN = sin WHERE user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `employee_view` ()  READS SQL DATA
SELECT * FROM employee$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `healthreport_delete` (IN `ci` INT(11), IN `d` VARCHAR(45))  MODIFIES SQL DATA
DELETE FROM health_report WHERE client_id = ci AND date = d$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `healthreport_insert` (IN `ci` INT(11), IN `d` VARCHAR(45))  MODIFIES SQL DATA
INSERT INTO health_report SET client_id = ci, date = d$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `healthreport_search` (IN `ci` INT(11))  READS SQL DATA
SELECT * FROM health_report WHERE client_id = ci$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `healthreport_view` ()  READS SQL DATA
SELECT * FROM health_report$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productreceipt_delete` (IN `pi` INT(11), IN `rn` INT(11))  MODIFIES SQL DATA
DELETE FROM product_receipt WHERE product_id = pi AND receipt_number = rn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productreceipt_insert` (IN `pi` INT(11), IN `rn` INT(11))  MODIFIES SQL DATA
INSERT INTO product_receipt SET product_id = pi, receipt_number = rn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productreceipt_search` (IN `rn` INT(11))  READS SQL DATA
SELECT * FROM product_receipt WHERE receipt_number = rn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productreceipt_view` ()  READS SQL DATA
SELECT * FROM product_receipt$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_delete` (IN `pi` INT(11))  MODIFIES SQL DATA
DELETE FROM product WHERE product_id = pi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_insert` (IN `n` VARCHAR(45), IN `p` DOUBLE)  MODIFIES SQL DATA
INSERT INTO product SET name = n, price = p$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_search` (IN `pi` INT(11))  READS SQL DATA
SELECT * FROM product WHERE product_id = pi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_update` (IN `n` VARCHAR(45), IN `p` DOUBLE, IN `pi` INT(11))  MODIFIES SQL DATA
UPDATE product SET name = n, price = p WHERE product_id = pi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_view` ()  READS SQL DATA
SELECT * FROM product$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `purchasedby_delete` (IN `pi` INT(11), IN `ui` INT(11))  MODIFIES SQL DATA
DELETE FROM purchased_by WHERE product_id = pi AND user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `purchasedby_insert` (IN `pi` INT(11), IN `ui` INT(11))  MODIFIES SQL DATA
INSERT INTO purchased_by SET product_id = pi, user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `purchasedby_search` (IN `ui` INT(11))  READS SQL DATA
SELECT * FROM purchased_by WHERE user_id = ui$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `purchasedby_view` ()  READS SQL DATA
SELECT * FROM purchased_by$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `receipt_delete` (IN `n` INT(11))  MODIFIES SQL DATA
DELETE FROM receipt WHERE number = n$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `receipt_insert` (IN `d` VARCHAR(45))  MODIFIES SQL DATA
INSERT INTO receipt SET date = d$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `receipt_search` (IN `n` INT(11))  READS SQL DATA
SELECT * FROM receipt WHERE number = n$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `receipt_update` (IN `d` VARCHAR(45), IN `n` INT(11))  MODIFIES SQL DATA
UPDATE receipt SET date = d WHERE number = n$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `receipt_view` ()  READS SQL DATA
SELECT * FROM receipt$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sells_delete` (IN `dn` INT(11), IN `pi` INT(11))  MODIFIES SQL DATA
DELETE FROM sells WHERE dnumber = dn AND product_id = pi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sells_insert` (IN `dn` INT(11), IN `pi` INT(11))  MODIFIES SQL DATA
INSERT INTO sells SET dnumber = dn, product_id = pi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sells_search` (IN `dn` INT(11))  READS SQL DATA
SELECT * FROM sells WHERE dnumber = dn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sells_view` ()  READS SQL DATA
SELECT * FROM sells$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicereceipt_delete` (IN `sn` VARCHAR(45), IN `rn` INT(11))  MODIFIES SQL DATA
DELETE FROM service_receipt WHERE service_name = sn AND receipt_number = rn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicereceipt_insert` (IN `sn` VARCHAR(45), IN `rn` INT(11))  MODIFIES SQL DATA
INSERT INTO service_receipt SET service_name = sn, receipt_number = rn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicereceipt_search` (IN `rn` INT(11))  READS SQL DATA
SELECT * FROM service_receipt WHERE receipt_number = rn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicereceipt_view` ()  READS SQL DATA
SELECT * FROM service_receipt$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_delete` (IN `n` VARCHAR(45))  MODIFIES SQL DATA
DELETE FROM service WHERE name = n$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_insert` (IN `n` VARCHAR(45), IN `p` DOUBLE)  MODIFIES SQL DATA
INSERT INTO service SET name = n, price = p$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_search` (IN `n` VARCHAR(45))  READS SQL DATA
SELECT * FROM service WHERE name = n$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_update` (IN `p` DOUBLE, IN `n` VARCHAR(45))  MODIFIES SQL DATA
UPDATE service SET price = p WHERE name = n$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_view` ()  READS SQL DATA
SELECT * FROM service$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoint_id` int(11) NOT NULL,
  `day` varchar(45) NOT NULL,
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
(1, '1', '12', '2020', '15:00', 1, 2, 'Accupuncture');

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
(1, 'John', 'Johns', 'clientone', '01/01/1991', '111 Street', '111-111-1111', 'M'),
(2, 'Jane', 'Janes', 'clienttwo', '02/02/1992', '222 Street', '222-222-2222', 'F');

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
(0, 'Admin', 'Admin', 'iamadmin', '12/12/1991', '123 Street', '123-123-1234', 'M', '05/05/2005', 60, 40, 0),
(1, 'Jack', 'Jacks', 'workerone', '03/03/1993', '333 Street', '333-333-3333', 'M', '03/03/2003', 30, 15, 333333333),
(2, 'Jill', 'Jills', 'workertwo', '04/04/1994', '444 Street', '444-444-4444', 'F', '04/04/2004', 35, 20, 444444444);

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
(1, '01/01/2020'),
(2, '02/02/2020');

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
  ADD PRIMARY KEY (`employee_id`),
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
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
