-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 08:08 AM
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
-- Database: `bus_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `contact_number`) VALUES
(1, 'Bob Johnson', 'bob.johnson@example.com', 'bob.j', '1122334455'),
(2, 'Michael Brown', 'michael.brown@example.com', 'michael.b', '6677889900');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `seat_count` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `bus_id`, `seat_count`, `total_price`, `booking_date`) VALUES
(16, 1, 17, 2, 1000.00, '2024-12-05 16:41:59'),
(17, 1, 23, 1, 750.00, '2024-12-05 16:41:59'),
(18, 2, 25, 3, 750.00, '2024-12-05 16:41:59'),
(19, 11, 27, 2, 1200.00, '2024-12-05 16:41:59'),
(23, 11, 22, 1, 450.00, '2024-12-06 06:22:04'),
(25, 11, 17, 2, 1000.00, '2024-12-06 06:31:48'),
(26, 13, 18, 2, 600.00, '2024-12-06 06:36:09'),
(27, 11, 17, 2, 1000.00, '2024-12-06 10:06:35'),
(28, 14, 25, 3, 1200.00, '2024-12-06 10:30:37'),
(29, 11, 17, 3, 1500.00, '2024-12-07 15:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `bus_id` int(11) NOT NULL,
  `bus_type` varchar(100) NOT NULL,
  `source` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `driver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`bus_id`, `bus_type`, `source`, `destination`, `contact`, `ticket_price`, `driver_id`) VALUES
(17, 'AC Sleeper', 'Mumbai', 'Pune', '1234567890', 500.00, 101),
(18, 'Non-AC', 'Delhi', 'Agra', '0987654321', 300.00, 102),
(19, 'Volvo', 'Bangalore', 'Chennai', '1122334455', 750.00, 103),
(20, 'Luxury', 'Kolkata', 'Digha', '9988776655', 1000.00, 104),
(21, 'Mini Bus', 'Hyderabad', 'Vijayawada', '8877665544', 250.00, 105),
(22, 'Superfast', 'Chennai', 'Madurai', '9988774455', 450.00, 106),
(23, 'Deluxe', 'Kochi', 'Trivandrum', '9845327812', 600.00, 107),
(24, 'Express', 'Jaipur', 'Udaipur', '9922334455', 350.00, 108),
(25, 'Volvo', 'Ahmedabad', 'Surat', '9611223344', 400.00, 109),
(26, 'AC Sleeper', 'Goa', 'Mangalore', '9988771122', 550.00, 110),
(27, 'Non-AC', 'Pune', 'Nasik', '9876543210', 300.00, 111),
(28, 'Luxury', 'Lucknow', 'Agra', '9123456789', 800.00, 112),
(29, 'Superfast', 'Patna', 'Bhubaneswar', '9432167890', 600.00, 113),
(30, 'Mini Bus', 'Bhopal', 'Indore', '9876123456', 250.00, 114),
(31, 'Deluxe', 'Chandigarh', 'Shimla', '9876543210', 700.00, 115),
(32, 'Express', 'Delhi', 'Manali', '9898989898', 900.00, 116),
(36, 'Deluxe', 'pune', 'chennai', '9785372614', 2500.00, 109);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `name`, `email`, `password`, `contact_number`, `created_at`) VALUES
(101, 'Raj Sharma', 'raj.sharma@example.com', 'raj.s', '9876543210', '2024-12-06 16:30:09'),
(102, 'Aman Verma', 'aman.verma@example.com', 'hashed_password_102', '9988776655', '2024-12-06 16:30:09'),
(103, 'Priya Singh', 'priya.singh@example.com', 'hashed_password_103', '9123456789', '2024-12-06 16:30:09'),
(104, 'Ravi Kumar', 'ravi.kumar@example.com', 'hashed_password_104', '9012345678', '2024-12-06 16:30:09'),
(105, 'Sneha Gupta', 'sneha.gupta@example.com', 'hashed_password_105', '9876543120', '2024-12-06 16:30:09'),
(106, 'Karan Mehta', 'karan.mehta@example.com', 'hashed_password_106', '9823456781', '2024-12-06 16:30:09'),
(107, 'Deepak Yadav', 'deepak.yadav@example.com', 'hashed_password_107', '9967543210', '2024-12-06 16:30:09'),
(108, 'Anjali Desai', 'anjali.desai@example.com', 'hashed_password_108', '9012765432', '2024-12-06 16:30:09'),
(109, 'Suraj Patil', 'suraj.patil@example.com', 'suraj.p', '9876123450', '2024-12-06 16:30:09'),
(110, 'Nisha Reddy', 'nisha.reddy@example.com', 'hashed_password_110', '9023456781', '2024-12-06 16:30:09'),
(111, 'krish tandel', 'tandelkrish628@gmail.com', '$2y$10$rx/57QguAK7n6O1CfswGgu3.NaL9eHdQ.65vpZTOWn9KnWFw/c8DW', '9587462185', '2024-12-06 17:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '$2y$10$PQQL/aXUMUur0KSLK9Li4.5QtSH/MHBY9aIQ2fUDF60ozApYpOPni'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '$2y$10$PXgHZYX7wXSycDfoQ1A6juPS0fB1MN0/7n1MmqklcOWgiDwISOtlG'),
(11, 'darpan', 'meher', 'darpanmeher1346@gmail.com', '$2y$10$EIzL9tDQmS7zV1rfTMt2UucBQ50w9HoEqeXFKefy5nNNSRPHHcVpu'),
(13, 'tanvi', 'meher', 'tanvi1@gmail.com', '$2y$10$wh.utlIyTt1jaDw.4l/8M.XvcLgA33r6f3ddtwYIEJmxyNPekE.Aq'),
(14, 'laksh', 'salvi', 'laksh26@gmail.com', '$2y$10$yq7YXvR3nSkpLgSPOynJDOzd2fG9d9SYt5/2DhDsVl1pUj.z3PI6S');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`bus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
