

CREATE TABLE `bookings` (
  `bookingID` int(11) NOT NULL,
  `hospitalID` int(11) DEFAULT NULL,
  `patientName` varchar(255) DEFAULT NULL,
  `patientContact` varchar(15) DEFAULT NULL,
  `appointmentDate` date DEFAULT NULL,
  `appointmentTime` time DEFAULT NULL,
  `doctorAssigned` varchar(255) DEFAULT NULL,
  `reasonForVisit` text DEFAULT NULL
);

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`bookingID`, `hospitalID`, `patientName`, `patientContact`, `appointmentDate`, `appointmentTime`, `doctorAssigned`, `reasonForVisit`) VALUES
(1, 1, 'veronica Obenewaa', '0268376848', '2024-12-25', '10:30:00', NULL, 'orthopedic review');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospitalID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `locationID` int(11) DEFAULT NULL,
  `establishedYear` int(11) DEFAULT NULL
);

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospitalID`, `name`, `address`, `phoneNumber`, `locationID`, `establishedYear`) VALUES
(1, 'New York General Hospital', '123 Main St', '555-1234', 1, 1950),
(2, 'Los Angeles Medical Center', '456 Elm St', '555-5678', 2, 1960),
(3, 'Chicago Healthcare Institute', '789 Oak St', '555-9101', 3, 1970),
(4, 'Houston Medical Plaza', '101 Maple St', '555-1123', 4, 1980),
(5, 'Phoenix Regional Hospital', '202 Pine St', '555-1415', 5, 1990),
(6, 'Toronto Wellness Hospital', '21 Queen St', '555-2000', 6, 1985),
(7, 'Vancouver Central Clinic', '67 King St', '555-3000', 7, 1995),
(8, 'London City Hospital', '45 London Rd', '555-4000', 8, 1920),
(9, 'Manchester Royal Infirmary', '12 Manchester Rd', '555-5000', 9, 1945),
(10, 'Birmingham Community Hospital', '78 Birmingham Ave', '555-6000', 10, 1930),
(11, 'Sydney Regional Medical Center', '34 Harbour Rd', '555-7000', 11, 1965),
(12, 'Melbourne General Hospital', '89 Yarra St', '555-8000', 12, 1975),
(13, 'Brisbane Health Clinic', '56 Brisbane Rd', '555-9000', 13, 1982),
(14, 'Mumbai City Hospital', '99 Gateway St', '555-1235', 14, 1998),
(15, 'Delhi National Hospital', '88 Red Fort Rd', '555-2345', 15, 2002),
(16, 'Bangalore Health Care', '22 Tech Park Rd', '555-3456', 16, 2000),
(17, 'Paris Medical Institute', '33 Champs Elysees', '555-4567', 17, 1969),
(18, 'Lyon General Hospital', '44 Rhone Rd', '555-5678', 18, 1974),
(19, 'Berlin Community Health', '11 Berlin Rd', '555-6789', 19, 1992),
(20, 'Munich Health Plaza', '66 Bavaria Rd', '555-7890', 20, 1989),
(21, 'Tokyo Health Center', '77 Tokyo St', '555-8901', 21, 1955),
(22, 'Osaka Medical Clinic', '88 Osaka Rd', '555-9012', 22, 1963),
(23, 'Beijing People’s Hospital', '55 Tiananmen Rd', '555-2346', 23, 1988),
(24, 'Shanghai General Hospital', '44 Bund Rd', '555-3457', 24, 1991),
(25, 'Cape Town City Clinic', '99 Table Rd', '555-4568', 25, 1994),
(26, 'Johannesburg Wellness Center', '66 Mandela Rd', '555-5679', 26, 1997),
(27, 'Rio de Janeiro Health Hub', '33 Sugarloaf Rd', '555-6780', 27, 1980),
(28, 'São Paulo Medical Center', '22 Paulista Ave', '555-7891', 28, 1983),
(29, 'Mexico City Regional Hospital', '55 Chapultepec Rd', '555-8902', 29, 1987),
(30, 'Guadalajara Central Clinic', '66 Jalisco Rd', '555-9013', 30, 1993),
(31, 'Dubai Wellness Hospital', '77 Palm Rd', '555-2347', 31, 2005),
(32, 'Abu Dhabi National Hospital', '88 Corniche Rd', '555-3458', 32, 2008),
(33, 'Rome General Hospital', '99 Colosseum Rd', '555-4569', 33, 2000),
(34, 'Milan City Medical Center', '66 Duomo Rd', '555-5670', 34, 1999),
(35, 'Madrid Health Institute', '55 Prado Rd', '555-6781', 35, 1995),
(36, 'Barcelona Wellness Plaza', '33 Sagrada Rd', '555-7892', 36, 1996),
(37, 'Moscow Central Hospital', '44 Kremlin Rd', '555-8903', 37, 2003),
(38, 'St. Petersburg Medical Center', '22 Neva Rd', '555-9014', 38, 2007),
(39, 'Singapore General Hospital', '11 Marina Rd', '555-3459', 39, 2006),
(40, 'Singapore Health Plaza', '88 Orchard Rd', '555-4560', 40, 2004);

-- --------------------------------------------------------

--
-- Table structure for table `hospitalspecialities`
--

CREATE TABLE `hospitalspecialities` (
  `hospitalID` int(11) NOT NULL,
  `specialityID` int(11) NOT NULL
);

--
-- Dumping data for table `hospitalspecialities`
--

INSERT INTO `hospitalspecialities` (`hospitalID`, `specialityID`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 5),
(4, 6),
(5, 7),
(6, 2),
(6, 8),
(7, 4),
(8, 1),
(8, 6),
(9, 2),
(10, 3),
(11, 4),
(12, 5),
(13, 6),
(14, 1),
(15, 7),
(16, 8),
(17, 1),
(18, 2),
(19, 3),
(20, 4),
(21, 5),
(22, 6),
(23, 7),
(24, 8),
(25, 1),
(26, 2),
(27, 3),
(28, 4),
(29, 5),
(30, 6),
(31, 7),
(32, 8),
(33, 1),
(34, 2),
(35, 3),
(36, 4),
(37, 5),
(38, 6),
(39, 7),
(40, 8);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationID` int(11) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zipCode` varchar(10) DEFAULT NULL
);

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationID`, `city`, `state`, `country`, `zipCode`) VALUES
(1, 'New York', 'NY', 'USA', '10001'),
(2, 'Los Angeles', 'CA', 'USA', '90001'),
(3, 'Chicago', 'IL', 'USA', '60601'),
(4, 'Houston', 'TX', 'USA', '77001'),
(5, 'Phoenix', 'AZ', 'USA', '85001'),
(6, 'Toronto', 'ON', 'Canada', 'M5A 1A1'),
(7, 'Vancouver', 'BC', 'Canada', 'V5K 0A1'),
(8, 'London', 'England', 'UK', 'E1 6AN'),
(9, 'Manchester', 'England', 'UK', 'M1 1AE'),
(10, 'Birmingham', 'England', 'UK', 'B1 1AA');

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
);

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medicationID`, `name`, `description`, `price`, `stockQuantity`, `pictureURL`, `category`, `manufacturer`, `addedDate`) VALUES
(1, 'Paracetamol', 'Pain reliever and fever reducer.', 5.99, 100, 'http://localhost/telesalud/assets/images/Paracetamol.jpg', 'Pain Relief', 'Pharma Inc.', '2024-12-12 11:20:10'),
(2, 'Ibuprofen', 'Anti-inflammatory medication for pain relief', 7.49, 200, 'http://localhost/telesalud/assets/images/ibuprofen.jpeg', 'Pain Relief', 'HealthMed', '2024-12-12 11:20:10'),
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
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `specialityID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
);

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`specialityID`, `name`) VALUES
(1, 'Cardiology'),
(2, 'Neurology'),
(3, 'Orthopedics'),
(4, 'Pediatrics'),
(5, 'Dermatology'),
(6, 'General Surgery'),
(7, 'Radiology'),
(8, 'Oncology');

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
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `phoneNumber`, `address`, `registrationDate`) VALUES
(1, 'Doris Korantemaa', 'doris@gmail.com', '$2y$10$DocS.ai2X4ATY60hsh30bupludhYg5r8pfhMViyzGRlKxNSAv6jPC', '055-995-0155', 'Madina Street', '2024-12-17 10:21:03'),
(2, 'veronica obenewaa', 'obenewaaveronica@gmail.com', '$2y$10$H1IHZ6BE7L5JQxeYx91aB.rnxWzLAysAU5Dt.e0qTc71a/zKOHuMa', '026-837-6848', 'banana In', '2024-12-17 10:22:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`medicationID`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

