-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2024 at 05:43 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `40001xxxx`
--
CREATE DATABASE IF NOT EXISTS `40001xxxx` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `40001xxxx`;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `AppointmentID` int NOT NULL AUTO_INCREMENT,
  `DateTime` datetime DEFAULT NULL,
  `PetID` int DEFAULT NULL,
  `OwnerID` int DEFAULT NULL,
  PRIMARY KEY (`AppointmentID`),
  KEY `PetID` (`PetID`),
  KEY `OwnerID` (`OwnerID`)
) ENGINE=MyISAM AUTO_INCREMENT=6006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `DateTime`, `PetID`, `OwnerID`) VALUES
(6001, '2024-11-01 10:00:00', 2001, 1001),
(6002, '2024-11-02 11:00:00', 2002, 1002),
(6003, '2024-11-03 12:00:00', 2003, 1003),
(6004, '2024-11-04 13:00:00', 2004, 1004),
(6005, '2024-11-05 14:00:00', 2005, 1005);

-- --------------------------------------------------------

--
-- Table structure for table `kennelstay`
--

DROP TABLE IF EXISTS `kennelstay`;
CREATE TABLE IF NOT EXISTS `kennelstay` (
  `StayID` int NOT NULL AUTO_INCREMENT,
  `ReasonforStay` varchar(255) DEFAULT NULL,
  `CareDetails` text,
  `ArrivalDate` date DEFAULT NULL,
  `DepartureDate` date DEFAULT NULL,
  `RoomNum` varchar(10) DEFAULT NULL,
  `Deposit` decimal(10,2) DEFAULT NULL,
  `PetID` int DEFAULT NULL,
  PRIMARY KEY (`StayID`),
  KEY `PetID` (`PetID`)
) ENGINE=MyISAM AUTO_INCREMENT=4006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kennelstay`
--

INSERT INTO `kennelstay` (`StayID`, `ReasonforStay`, `CareDetails`, `ArrivalDate`, `DepartureDate`, `RoomNum`, `Deposit`, `PetID`) VALUES
(4001, 'Owner traveling', 'Special diet', '2024-10-20', '2024-10-30', 'A1', 150.00, 2001),
(4002, 'Under observation', 'Medication twice a day', '2024-10-21', '2024-10-25', 'B2', 200.00, 2002),
(4003, 'Owner on vacation', 'Regular feeding', '2024-10-22', '2024-10-31', 'C3', 100.00, 2003),
(4004, 'Post-surgery care', 'Medication twice a day', '2024-10-23', '2024-11-01', 'D4', 250.00, 2004),
(4005, 'Owner traveling', 'Special diet', '2024-10-24', '2024-11-02', 'E5', 200.00, 2005);

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `OwnerID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `phoneNum` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`OwnerID`)
) ENGINE=MyISAM AUTO_INCREMENT=1006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`OwnerID`, `firstName`, `lastName`, `Address`, `phoneNum`, `Email`) VALUES
(1001, 'John', 'Doe', '123 Main St', '555-1234', 'john@example.com'),
(1002, 'Jane', 'Smith', '456 Maple Ave', '555-5678', 'jane@example.com'),
(1003, 'Michael', 'Brown', '789 Oak St', '555-7890', 'michael@example.com'),
(1004, 'Emily', 'Davis', '321 Pine Rd', '555-0123', 'emily@example.com'),
(1005, 'David', 'Wilson', '654 Cedar Ln', '555-4567', 'david@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentID` int NOT NULL AUTO_INCREMENT,
  `AmountDue` decimal(10,2) DEFAULT NULL,
  `AmountPaid` decimal(10,2) DEFAULT NULL,
  `Balance` decimal(10,2) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `OwnerID` int DEFAULT NULL,
  `VisitID` int DEFAULT NULL,
  `StayID` int DEFAULT NULL,
  PRIMARY KEY (`PaymentID`),
  KEY `OwnerID` (`OwnerID`),
  KEY `VisitID` (`VisitID`),
  KEY `StayID` (`StayID`)
) ENGINE=MyISAM AUTO_INCREMENT=5006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `AmountDue`, `AmountPaid`, `Balance`, `PaymentDate`, `OwnerID`, `VisitID`, `StayID`) VALUES
(5001, 100.00, 100.00, 0.00, '2024-10-25', 1001, 3001, NULL),
(5002, 150.00, 50.00, 100.00, '2024-10-26', 1002, NULL, 4001),
(5003, 80.00, 80.00, 0.00, '2024-10-27', 1003, 3002, NULL),
(5004, 200.00, 100.00, 100.00, '2024-10-28', 1004, 3004, NULL),
(5005, 150.00, 150.00, 0.00, '2024-10-29', 1005, 3005, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `PetID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Species` varchar(30) DEFAULT NULL,
  `Breed` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Allergies` text,
  `MedicalHistory` text,
  `RegDate` date DEFAULT NULL,
  `OwnerID` int DEFAULT NULL,
  PRIMARY KEY (`PetID`),
  KEY `OwnerID` (`OwnerID`)
) ENGINE=MyISAM AUTO_INCREMENT=2006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`PetID`, `Name`, `Species`, `Breed`, `DateOfBirth`, `Allergies`, `MedicalHistory`, `RegDate`, `OwnerID`) VALUES
(2001, 'Rex', 'Dog', 'German Shepherd', '2020-01-01', 'None', 'None', '2024-01-01', 1001),
(2002, 'Whiskers', 'Cat', 'Siamese', '2019-02-02', 'Fish', 'Asthma', '2024-01-02', 1002),
(2003, 'Bella', 'Dog', 'Labrador', '2021-05-05', 'None', 'None', '2024-01-03', 1003),
(2004, 'Max', 'Dog', 'Poodle', '2020-08-10', 'Pollen', 'Skin rash', '2024-01-04', 1004),
(2005, 'Luna', 'Cat', 'Persian', '2018-11-12', 'None', 'None', '2024-01-05', 1005);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `StaffID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`StaffID`)
) ENGINE=MyISAM AUTO_INCREMENT=9005 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `firstName`, `lastName`, `Role`) VALUES
(9000, 'Alice', 'Johnson', 'Vet'),
(9001, 'Bob', 'Williams', 'Veterinary Assistant'),
(9002, 'Chris', 'Martin', 'Vet'),
(9003, 'Laura', 'Clark', 'Veterinary Assistant'),
(9004, 'Sophia', 'Taylor', 'Vet');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

DROP TABLE IF EXISTS `visit`;
CREATE TABLE IF NOT EXISTS `visit` (
  `VisitID` int NOT NULL AUTO_INCREMENT,
  `Notes` text,
  `Medications` text,
  `Outcome` varchar(100) DEFAULT NULL,
  `DateOfVisit` date DEFAULT NULL,
  `StaffID` int DEFAULT NULL,
  `PetID` int DEFAULT NULL,
  PRIMARY KEY (`VisitID`),
  KEY `StaffID` (`StaffID`),
  KEY `PetID` (`PetID`)
) ENGINE=MyISAM AUTO_INCREMENT=3006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`VisitID`, `Notes`, `Medications`, `Outcome`, `DateOfVisit`, `StaffID`, `PetID`) VALUES
(3001, 'Check-up', 'None', 'Healthy', '2024-10-25', 9000, 2001),
(3002, 'Vaccination', 'Vaccine A', 'Good', '2024-10-26', 9000, 2002),
(3003, 'Dental check-up', 'None', 'Teeth cleaning', '2024-10-27', 9003, 2003),
(3004, 'X-ray', 'Painkillers', 'Fractured leg', '2024-10-28', 9004, 2004),
(3005, 'Check-up', 'None', 'Healthy', '2024-10-29', 9002, 2005);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
