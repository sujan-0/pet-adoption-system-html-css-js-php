-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 02:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `addproducts`
--

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `query` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `firstname`, `lastname`, `email`, `phone`, `query`, `submission_date`) VALUES
(9, 'Sujan Khatiwoda', 'Khatiwoda', 'sujankhatiwoda0206@gmail.com', '9840139274', 'I need an Labrador', '2024-05-02 02:21:48'),
(10, 'Sujan Khatiwoda', 'Khatiwoda', 'sujankhatiwoda0206@gmail.com', '9840139274', 'I need an Labrador', '2024-05-02 02:22:57'),
(11, 'Sujan Khatiwoda', 'Khatiwoda', 'sujankhatiwoda0206@gmail.com', '9840139274', 'I need an Labrador', '2024-05-02 02:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `pet_items`
--

CREATE TABLE `pet_items` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(255) DEFAULT NULL,
  `itemDescription` text DEFAULT NULL,
  `itemType` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `available_quantity` int(11) DEFAULT NULL,
  `itemImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_items`
--

INSERT INTO `pet_items` (`itemID`, `itemName`, `itemDescription`, `itemType`, `price`, `available_quantity`, `itemImage`) VALUES
(11, 'FOOD2', '77KG', 'food', 8000.00, 50, 'uploads/redVelvet.jpg'),
(13, 'Biscuit', 'Wheat Biscuit 1kg', 'food', 800.00, 5, 'uploads/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` text NOT NULL,
  `productCategory` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `itemsWeight` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `comparePrice` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productName`, `productDescription`, `productCategory`, `gender`, `itemsWeight`, `price`, `comparePrice`, `image`) VALUES
(4, 'Dog A', 'hdiashd', 'Dog', 'Male', 8.00, 1800.00, 1200.00, '2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_items`
--
ALTER TABLE `pet_items`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_product_name` (`productName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pet_items`
--
ALTER TABLE `pet_items`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
