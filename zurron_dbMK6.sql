-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2021 at 09:22 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zurron_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `subject`, `body`, `sender`) VALUES
(1, 'Odin se presenta', 'Hola soy Odin y me presento como Odin Allfather', 1),
(2, 'Loki se presenta', 'Hola soy Loki y me presento como Loki Laufeyson', 2),
(3, 'Thor se presenta', 'Hola soy Thor y me presento como Thor Odinson', 3),
(4, 'Martillo', 'Hola thor te voy a dar este martillo forjado por los enanos, es un regalo mio.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `tmessage_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `targets`
--

INSERT INTO `targets` (`tmessage_id`, `target_id`, `read`) VALUES
(2, 1, 0),
(3, 1, 0),
(1, 2, 0),
(3, 2, 0),
(1, 3, 0),
(2, 3, 0),
(4, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nick` varchar(40) NOT NULL,
  `passwd` varchar(70) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `age` int(200) NOT NULL,
  `pfp` int(40) NOT NULL DEFAULT 99
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nick`, `passwd`, `name`, `surname`, `email`, `direccion`, `age`, `pfp`) VALUES
(1, 'odin', '$2y$10$39Fqlr2Im5E6zFNATNgyL.IFF4ZlKNA9mHn8yiGvxDeCw1VFRfPqm', 'odin', 'allfather', 'alfather@bifrost.asg', 'Assgard 24', 10827, 11),
(2, 'loki', '$2y$10$39Fqlr2Im5E6zFNATNgyL.IFF4ZlKNA9mHn8yiGvxDeCw1VFRfPqm', 'loki', 'laufeyson', 'loki@xn--bifrst-zxa.asg', 'Asgard 45', 5267, 14),
(3, 'thor', '$2y$10$39Fqlr2Im5E6zFNATNgyL.IFF4ZlKNA9mHn8yiGvxDeCw1VFRfPqm', 'thor', 'odinson', 'thor@bifrost.asg', 'asgard 97', 6812, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_sender_fk` (`sender`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`target_id`,`tmessage_id`),
  ADD KEY `targets_tmessage_fk` (`tmessage_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_sender_fk` FOREIGN KEY (`sender`) REFERENCES `users` (`id`);

--
-- Constraints for table `targets`
--
ALTER TABLE `targets`
  ADD CONSTRAINT `targets_target_fk` FOREIGN KEY (`target_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `targets_tmessage_fk` FOREIGN KEY (`tmessage_id`) REFERENCES `message` (`message_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
