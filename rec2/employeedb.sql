-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 01:12 PM
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
-- Database: `employeedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `publications_23`
--

CREATE TABLE `publications_23` (
  `Si_no` int(11) NOT NULL,
  `indexing` varchar(50) DEFAULT NULL,
  `Emp_id` int(100) DEFAULT NULL,
  `paper_title` text DEFAULT NULL,
  `journal_name` text DEFAULT NULL,
  `authors` text DEFAULT NULL,
  `indexing_type` varchar(255) DEFAULT NULL,
  `impact_factor` float DEFAULT NULL,
  `snip` varchar(50) DEFAULT NULL,
  `issn_no` varchar(50) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `Year_of_publication` year(4) DEFAULT NULL,
  `listed_ugc` tinyint(1) DEFAULT NULL,
  `link_wos` varchar(1000) DEFAULT NULL,
  `link_of_scopus` varchar(1000) DEFAULT NULL,
  `ugc_link` varchar(1000) DEFAULT NULL,
  `Q1234NA` varchar(100) DEFAULT NULL,
  `title_of_conference` varchar(1000) DEFAULT NULL,
  `name_of_conference` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publications_23`
--

INSERT INTO `publications_23` (`Si_no`, `indexing`, `Emp_id`, `paper_title`, `journal_name`, `authors`, `indexing_type`, `impact_factor`, `snip`, `issn_no`, `publication_date`, `Year_of_publication`, `listed_ugc`, `link_wos`, `link_of_scopus`, `ugc_link`, `Q1234NA`, `title_of_conference`, `name_of_conference`) VALUES
(1, 'SCI', 101, 'Advances in Machine Learning', 'Journal of AI Research', 'John Doe, Jane Smith', 'A1', 2.5, '1.23', '1234-5678', '2024-03-15', '2024', 1, 'https://woslink.com/paper1', 'https://scopuslink.com/paper1', 'https://ugclink.com/paper1', 'Q1', 'International ML Conference', 'AI Conference 2024'),
(2, 'Scopus', 102, 'Deep Learning for Healthcare', 'Journal of Medical AI', 'Alice Green, Bob Brown', 'A2', 3.2, '2.11', '2345-6789', '2023-12-22', '2023', 0, 'https://woslink.com/paper2', 'https://scopuslink.com/paper2', 'https://ugclink.com/paper2', 'Q2', 'Global Health AI Conference', 'Medical AI 2023'),
(3, 'UGC', 103, 'Big Data Analytics in Finance', 'Finance Data Journal', 'Eve White, Charlie Black', 'A3', 1.8, '0.89', '3456-7890', '2022-08-10', '2022', 1, 'https://woslink.com/paper3', 'https://scopuslink.com/paper3', 'https://ugclink.com/paper3', 'Q3', 'Finance Big Data Summit', 'Finance Analytics 2022'),
(4, 'SCI', 104, 'Blockchain Security', 'Journal of Cryptography', 'David Gray, Fiona Blue', 'A1', 4, '3.01', '4567-8901', '2024-06-30', '2024', 1, 'https://woslink.com/paper4', 'https://scopuslink.com/paper4', 'https://ugclink.com/paper4', 'Q1', 'Blockchain Conference', 'CryptoCon 2024'),
(5, 'Scopus', 105, 'Quantum Computing Algorithms', 'Quantum Tech Journal', 'Gary Orange, Hannah Violet', 'A2', 3.8, '2.67', '5678-9012', '2023-09-14', '2023', 0, 'https://woslink.com/paper5', 'https://scopuslink.com/paper5', 'https://ugclink.com/paper5', 'Q2', 'Quantum Tech Conference', 'Quantum Leap 2023'),
(6, 'UGC', 106, 'Cloud Computing in Industry', 'Industry Cloud Journal', 'Ian Red, Julie Yellow', 'A3', 2.1, '1.45', '6789-0123', '2022-05-20', '2022', 1, 'https://woslink.com/paper6', 'https://scopuslink.com/paper6', 'https://ugclink.com/paper6', 'Q3', 'Cloud Expo', 'CloudTech 2022'),
(7, 'SCI', 107, 'AI Ethics in Autonomous Systems', 'Journal of Robotics AI', 'Karen Pink, Liam Gold', 'A1', 4.5, '4.12', '7890-1234', '2024-01-05', '2024', 1, 'https://woslink.com/paper7', 'https://scopuslink.com/paper7', 'https://ugclink.com/paper7', 'Q1', 'Robotics AI Conference', 'Autonomous Systems 2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `publications_23`
--
ALTER TABLE `publications_23`
  ADD PRIMARY KEY (`Si_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `publications_23`
--
ALTER TABLE `publications_23`
  MODIFY `Si_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
