-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 12:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtualpharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `cartItemID` int(11) NOT NULL,
  `cartID` int(11) NOT NULL,
  `medicationID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cartID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `medicationID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `pictureURL` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `addedDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medicationID`, `name`, `description`, `price`, `stockQuantity`, `pictureURL`, `category`, `manufacturer`, `addedDate`) VALUES
(1, 'Paracetamol', 'Pain reliever and fever reducer.', 5.99, 100, 'http://localhost/telesalud/assets/images/Paracetamol.jpg', 'Pain Relief', 'Pharma Inc.', '2024-12-12 11:20:10'),
(2, 'Ibuprofen', 'Anti-inflammatory medication for pain relief.', 7.49, 200, 'http://localhost/telesalud/assets/images/ibuprofen.jpeg', 'Pain Relief', 'HealthMed', '2024-12-12 11:20:10'),
(3, 'Cough Syrup', 'Relieves cough and sore throat.', 6.25, 150, 'http://localhost/telesalud/assets/images/coughsyrup.jpg', 'Cold & Flu', 'CureWell', '2024-12-12 11:20:10'),
(4, 'Vitamin C', 'Boosts immune system.', 10.00, 250, 'http://localhost/telesalud/assets/images/vitamin_c.jpeg', 'Supplements', 'NutriHealth', '2024-12-12 11:20:10'),
(5, 'Antacid Tablets', 'Relieves heartburn and indigestion.', 4.50, 300, 'http://localhost/telesalud/assets/images/antacid.jpeg', 'Digestive Health', 'PharmaLife', '2024-12-12 11:20:10'),
(6, 'Aspirin', 'Reduces pain, fever, and inflammation.', 4.99, 120, 'http://localhost/telesalud/assets/images/aspirin.jpeg', NULL, 'MediCare', '2024-12-12 11:20:10'),
(7, 'Naproxen', 'Effective for long-lasting pain relief.', 6.99, 80, 'http://localhost/telesalud/assets/images/naprox.png', NULL, 'HealthCorp', '2024-12-12 11:20:10'),
(8, 'Decongestant Tablets', 'Relieves nasal congestion.', 3.99, 150, 'http://localhost/telesalud/assets/images/Telfast.png', NULL, 'CureWell', '2024-12-12 11:20:10'),
(9, 'Throat Lozenges', 'Soothes sore throat and cough.', 2.50, 200, 'http://localhost/telesalud/assets/images/logenzes.jpeg', NULL, 'WellnessLabs', '2024-12-12 11:20:10'),
(10, 'Probiotic Capsules', 'Supports digestive health and immunity.', 15.99, 60, 'http://localhost/telesalud/assets/images/probiotics.jpg', NULL, 'GutCare', '2024-12-12 11:20:10'),
(11, 'Laxative Syrup', 'Relieves occasional constipation.', 5.49, 100, 'http://localhost/telesalud/assets/images/laxative.jpeg', NULL, 'PharmaLife', '2024-12-12 11:20:10'),
(12, 'Antihistamine Tablets', 'Relieves allergy symptoms like sneezing and itching.', 7.25, 180, 'http://localhost/telesalud/assets/images/antihistamin.jpeg', NULL, 'AllergyEase', '2024-12-12 11:20:10'),
(13, 'Eye Drops', 'Relieves itchy and red eyes caused by allergies.', 9.00, 70, 'http://localhost/telesalud/assets/images/eyedrop.jpg', NULL, 'VisionCare', '2024-12-12 11:20:10'),
(14, 'Omega-3 Capsules', 'Supports heart and brain health.', 19.99, 50, 'http://localhost/telesalud/assets/images/omega3.jpeg', NULL, 'NutriHealth', '2024-12-12 11:20:10'),
(15, 'Vitamin D Tablets', 'Promotes bone health and immune function.', 12.50, 110, 'http://localhost/telesalud/assets/images/vitamind.jpg', NULL, 'HealthyLife', '2024-12-12 11:20:10'),
(16, 'Antiseptic Cream', 'Prevents infection in minor cuts and burns.', 4.99, 90, 'http://localhost/telesalud/assets/images/savlon.jpeg', NULL, 'CarePlus', '2024-12-12 11:20:10'),
(17, 'Band-Aid Pack', 'Protects minor wounds.', 3.99, 300, 'http://localhost/telesalud/assets/images/band.jpeg', NULL, 'QuickHeal', '2024-12-12 11:20:10'),
(18, 'Sunscreen Lotion', 'Protects skin from harmful UV rays.', 8.50, 140, 'http://localhost/telesalud/assets/images/sunscreen.jpeg', NULL, 'SunSafe', '2024-12-12 11:20:10'),
(19, 'Mouthwash', 'Freshens breath and kills bacteria.', 6.50, 180, 'http://localhost/telesalud/assets/images/listerine.jpg', NULL, 'CleanSmile', '2024-12-12 11:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderItemID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `medicationID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderDate` datetime DEFAULT current_timestamp(),
  `totalAmount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `registrationDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`cartItemID`),
  ADD KEY `cartID` (`cartID`),
  ADD KEY `medicationID` (`medicationID`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`medicationID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderItemID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `medicationID` (`medicationID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `cartItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `medicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD CONSTRAINT `cartitems_ibfk_1` FOREIGN KEY (`cartID`) REFERENCES `carts` (`cartID`),
  ADD CONSTRAINT `cartitems_ibfk_2` FOREIGN KEY (`medicationID`) REFERENCES `medications` (`medicationID`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`medicationID`) REFERENCES `medications` (`medicationID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
