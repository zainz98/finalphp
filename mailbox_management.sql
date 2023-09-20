-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: ספטמבר 20, 2023 בזמן 06:34 PM
-- גרסת שרת: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mailbox_management`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mailbox` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`, `mailbox`, `phone`, `password`, `salt`) VALUES
(1, '', '', '', '', ''),
(6, 'Zain Alden Zoabi', 'zainalzoab', '0522684712', '', ''),
(8, 'Zain Alden Zoabi', 'ZA', '0522684712', 'e591594fc0b7c3bac0f36a059c90b6a4813fad5c12b6b9a038678da0fe11ba4d', '3f937583de66f21d31d386c42e17c42eee28286be04b6c283de6c245f61398b4'),
(19, 'Zain Alden Zoabi', 'zainaalzoa', '0522684712', '123', ''),
(20, 'zz', 'zainalzoaz', '0522684712', '170876f5a36ca1f06a38d0332cc2caea5eeff16aedbab9e3088818e0a25bbe13', '4120c4a81bbb7908a72e261a4de57f783485f5ca0c00c4740b110f584defa62b');

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mailbox_unique_idx` (`mailbox`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
