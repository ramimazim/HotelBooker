-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 03:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_hotelbooker`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `BOOKINGID` int(11) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Pending',
  `uid` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `room_count` int(11) NOT NULL,
  `room_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`BOOKINGID`, `start`, `end`, `status`, `uid`, `hid`, `total_cost`, `room_count`, `room_type`) VALUES
(36, '2024-09-01', '2024-09-11', 'Completed', 0, 27, 1100, 2, 'suite');

-- --------------------------------------------------------

--
-- Table structure for table `hotelfilter`
--

CREATE TABLE `hotelfilter` (
  `uid` int(11) NOT NULL,
  `hid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `HOTELID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `bks_count` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `stars` int(11) NOT NULL,
  `single` int(11) NOT NULL,
  `dbl` int(11) NOT NULL,
  `suite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`HOTELID`, `Name`, `bks_count`, `city`, `country`, `stars`, `single`, `dbl`, `suite`) VALUES
(1, 'Oceanview Resort', 350, 'New York City', 'USA', 3, 18, 34, 52),
(2, 'Alpine Lodge', 280, 'Los Angeles', 'USA', 3, 15, 31, 54),
(3, 'Cityscape Hotel', 500, 'Chicago', 'USA', 5, 19, 32, 53),
(4, 'Grand Plaza', 410, 'New York City', 'USA', 2, 16, 30, 55),
(5, 'Seaside Retreat', 290, 'Los Angeles', 'USA', 1, 17, 33, 51),
(6, 'Mountain Haven', 180, 'Chicago', 'USA', 4, 20, 35, 50),
(7, 'Riverside Inn', 320, 'Paris', 'France', 3, 19, 34, 52),
(8, 'Sunflower Suites', 230, 'Lyon', 'France', 5, 15, 30, 54),
(9, 'Sky High Hotel', 470, 'Marseille', 'France', 2, 18, 31, 53),
(10, 'Downtown Deluxe', 380, 'Paris', 'France', 4, 17, 33, 55),
(11, 'Beachfront Paradise', 420, 'Lyon', 'France', 3, 16, 32, 50),
(12, 'Snowy Peaks Lodge', 160, 'Marseille', 'France', 5, 20, 35, 51),
(13, 'Urban Elegance', 330, 'Rome', 'Italy', 1, 19, 30, 54),
(14, 'Blue Lagoon Resort', 290, 'Milan', 'Italy', 2, 15, 34, 53),
(15, 'Desert Oasis Hotel', 200, 'Naples', 'Italy', 4, 18, 33, 52),
(16, 'Lakeside Inn', 260, 'Rome', 'Italy', 3, 20, 31, 55),
(17, 'Royal Castle Hotel', 550, 'Milan', 'Italy', 5, 17, 32, 50),
(18, 'Safari View Lodge', 300, 'Naples', '', 2, 16, 35, 51),
(19, 'Sydney Skies', 190, 'Sydney', 'Australia', 1, 19, 30, 54),
(20, 'The Urban Nest', 360, 'Melbourne', 'Australia', 3, 15, 34, 53),
(21, 'Gardenia Hotel', 310, 'Brisbane', 'Australia', 4, 18, 31, 55),
(22, 'The Sunset Villa', 290, 'Sydney', 'Australia', 5, 20, 32, 50),
(23, 'Maplewood Inn', 250, 'Melbourne', 'Australia', 2, 17, 33, 51),
(24, 'Coral Reef Resort', 270, 'Brisbane', 'Australia', 3, 16, 30, 54),
(25, 'Royal Orchid Suites', 220, 'Tokyo', 'Japan', 1, 19, 35, 52),
(26, 'Meadowbrook Lodge', 160, 'Osaka', 'Japan', 4, 15, 34, 53),
(27, 'Golden Sands Hotel', 420, 'Kyoto', 'Japan', 5, 18, 31, 55),
(28, 'Horizon View Hotel', 310, 'Tokyo', 'Japan', 2, 20, 32, 50),
(29, 'The Heritage Grand', 530, 'Osaka', 'Japan', 3, 17, 33, 51),
(30, 'Island Breeze Resort', 340, 'Kyoto', 'Japan', 1, 16, 30, 54),
(31, 'Velvet Sky Suites', 280, 'New York City', 'USA', 4, 19, 35, 52),
(32, 'Canyon Ridge Lodge', 150, 'Los Angeles', 'USA', 5, 15, 34, 53),
(33, 'Crystal Shores Hotel', 400, 'Chicago', 'USA', 2, 18, 31, 55),
(34, 'Pacific Wave Resort', 270, 'New York City', 'USA', 3, 20, 32, 50),
(35, 'Evergreen Mountain Lodge', 230, 'Los Angeles', 'USA', 1, 17, 33, 51),
(36, 'Diamond Hill Hotel', 380, 'Chicago', 'USA', 4, 16, 30, 54),
(37, 'Grand Oasis Hotel', 310, 'Paris', 'France', 5, 19, 35, 52),
(38, 'Azure Sky Suites', 210, 'Lyon', 'France', 2, 15, 34, 53),
(39, 'Pearl Sands Hotel', 300, 'Marseille', 'France', 3, 18, 31, 55),
(40, 'Ocean Pearl Resort', 400, 'Paris', 'France', 1, 20, 32, 50),
(41, 'The Summit Hotel', 440, 'Lyon', 'France', 4, 17, 33, 51),
(42, 'Tropical Breeze Inn', 290, 'Marseille', 'France', 5, 16, 30, 54),
(43, 'The Sapphire Grand', 320, 'Rome', 'Italy', 2, 19, 35, 52),
(44, 'Golden Bay Resort', 280, 'Milan', 'Italy', 3, 15, 34, 53),
(45, 'Desert Mirage Hotel', 170, 'Naples', 'Italy', 1, 18, 31, 55),
(46, 'Highland Retreat', 200, 'Rome', 'Italy', 4, 20, 32, 50),
(47, 'Sunset Horizon Resort', 350, 'Milan', 'Italy', 5, 17, 33, 51),
(48, 'Forest Haven Lodge', 210, 'Naples', 'Italy', 2, 16, 30, 54),
(49, 'The Royal Palm Hotel', 500, 'Sydney', 'Australia', 3, 19, 35, 52),
(50, 'White Sands Resort', 230, 'Melbourne', 'Australia', 1, 15, 34, 53);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PID` int(11) NOT NULL,
  `date_paid` date DEFAULT NULL,
  `pmethod` varchar(1) NOT NULL,
  `credit_card` varchar(100) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PID`, `date_paid`, `pmethod`, `credit_card`, `cost`, `uid`, `bid`) VALUES
(16, '2024-09-23', 'E', 'NULL', 1100, 0, 36);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `REVIEWID` int(11) NOT NULL,
  `stars` int(11) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`REVIEWID`, `stars`, `text`, `uid`, `hid`, `bid`) VALUES
(4, 2, 'asdf', 0, 27, 36);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USERID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Nationality` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `E-Wallet_bal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USERID`, `Name`, `Age`, `Nationality`, `Gender`, `Password`, `Email`, `Phone`, `E-Wallet_bal`) VALUES
(1, 'asd', 12, 'bd', 'male', 'asd', 'asdf@asdf.com', 1778338146, 2000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`BOOKINGID`),
  ADD KEY `hid` (`hid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `hotelfilter`
--
ALTER TABLE `hotelfilter`
  ADD PRIMARY KEY (`uid`,`hid`),
  ADD KEY `hid` (`hid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`HOTELID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PID`),
  ADD KEY `uid` (`uid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`REVIEWID`),
  ADD KEY `uid` (`uid`),
  ADD KEY `hid` (`hid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `BOOKINGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `REVIEWID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`hid`) REFERENCES `hotels` (`HOTELID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`USERID`);

--
-- Constraints for table `hotelfilter`
--
ALTER TABLE `hotelfilter`
  ADD CONSTRAINT `hotelfilter_ibfk_1` FOREIGN KEY (`hid`) REFERENCES `hotels` (`HOTELID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hotelfilter_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`USERID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `bookings` (`BOOKINGID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`hid`) REFERENCES `hotels` (`HOTELID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`bid`) REFERENCES `bookings` (`BOOKINGID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
