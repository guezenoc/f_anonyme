-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 09:18 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f_anonyme`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `ip_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_reponse` int(11) DEFAULT NULL,
  `id_likes` int(11) DEFAULT NULL,
  `ip_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `titre`, `contenu`, `date`, `id_reponse`, `id_likes`, `ip_user`) VALUES
(10, 'Hello', 'comment allez vous ?', '2020-11-06 10:31:19', NULL, NULL, '192.168.64.1'),
(11, '', 'Très bien et vous ?', '2020-11-06 10:31:47', 10, NULL, '192.168.64.1'),
(22, 'Salut axel', 'Ca va ?', '2020-11-07 11:23:44', NULL, NULL, '192.168.64.1'),
(23, 'fsdgb', 'qfdgn', '2020-11-07 12:44:03', NULL, NULL, '195.195.195.195'),
(24, 'aaaaaa', 'bbbbbbbb', '2020-11-07 13:17:42', NULL, NULL, '1.1.1.1.1'),
(25, 'ccccc', 'dddddd', '2020-11-07 13:18:22', NULL, NULL, '127.0.0.1'),
(26, 'eeef', 'ffff', '2020-11-07 13:49:04', NULL, NULL, '127.0.0.1'),
(27, 'gggg', 'hhhhhhh', '2020-11-07 13:50:52', NULL, NULL, '127.0.0.1'),
(28, '', '', '2020-11-07 13:55:37', NULL, NULL, '127.0.0.1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_reponse` (`id_reponse`),
  ADD KEY `ID_likes` (`id_likes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_reponse`) REFERENCES `messages` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_likes`) REFERENCES `likes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
