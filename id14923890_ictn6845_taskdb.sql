SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS id14923890_ictn6845_taskdb;
use id14923890_ictn6845_taskdb;
-- --------------------------------------------------------
--
-- Database: `id14923890_ictn6845_taskdb`                      
--
-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `volunteerID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255),
  `email` varchar(255),
  `first_name` varchar(50),
  `last_name` varchar(50),
  `is_admin` boolean NOT NULL DEFAULT FALSE,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
   PRIMARY KEY (`volunteerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Table structure for table `tasks`
--
CREATE TABLE `tasks` (
  `taskID` int(11) NOT NULL AUTO_INCREMENT,
  `volunteerID` int(11),
  `assignerID` int(11),
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8_unicode_ci,
  `personsNeeded` int(2) NOT NULL,
  `scheduledTime` timestamp NOT NULL,
  `location` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`taskID`),
  FOREIGN KEY (`volunteerID`) REFERENCES users(`volunteerID`),
  FOREIGN KEY (`assignerID`) REFERENCES users(`volunteerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

