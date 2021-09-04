-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2021 at 05:53 PM
-- Server version: 5.7.32-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evestng_sydani`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `number_of_pages` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `release_date` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `isbn`, `authors`, `country`, `number_of_pages`, `publisher`, `release_date`, `created_at`, `updated_at`) VALUES
(1, 'My First Book', '123-3213243567', 'John Doe', 'United States', '350', 'Acme Books', '2019-08-01', '2021-09-04 16:11:06', '2021-09-04 16:11:06'),
(2, 'My Third Book', '23343545i67', 'ife ife', 'Nigeria', '222', 'ife', '01-02-2202', '2021-09-04 16:39:44', '2021-09-04 16:39:44'),
(3, 'My Third Book', '23343545i67', 'ife ife', 'Nigeria', '222', 'ife', '01-02-2202', '2021-09-04 16:39:53', '2021-09-04 16:39:53'),
(4, 'My Third Book', '23343545i67', 'ife ife', 'nigeria', '222', 'ife', '01-02-2202', '2021-09-04 16:41:09', '2021-09-04 16:41:09'),
(5, 'My Third Book', '23343545i67', 'ife ife', 'Nigeria', '222', 'ife', '01-02-2202', '2021-09-04 16:41:40', '2021-09-04 16:41:40'),
(6, 'My Third Book', '23343545i67', 'ife ife', 'Nigeria', '222', 'ife', '01-02-2202', '2021-09-04 16:42:28', '2021-09-04 16:42:28'),
(7, '.env', '23343545i67', 'ife ife', 'Nigeria', '222', 'ife', '01-02-2202', '2021-09-04 16:43:36', '2021-09-04 16:43:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
