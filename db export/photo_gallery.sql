-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2016 at 02:27 PM
-- Server version: 10.1.11-MariaDB-log
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo_gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'Пейзажи'),
(2, 'Забавни'),
(3, 'Храни и напитки'),
(4, 'Животни'),
(5, 'Архитектурни'),
(6, 'Филми'),
(7, 'Абстрактни');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(11) NOT NULL,
  `file_type` varchar(5) NOT NULL,
  `title_name` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id_photo`, `file_type`, `title_name`, `description`, `date`, `id_category`) VALUES
(1, 'jpg', 'Качулат ястребов орел', '', '2016-02-16 15:46:50', 4),
(2, 'jpg', 'Южноафрикански лъв', '', '2016-02-16 15:53:30', 4),
(3, 'jpg', 'Игра на тронове', 'Лого от 4ти сезон', '2016-02-16 15:57:00', 6),
(4, 'jpg', 'Планини в Нова Зеландия', '', '2016-02-17 14:59:10', 1),
(5, 'jpg', '300: Rise of an Empire', 'Американска продукция от 2014', '2016-02-17 15:00:34', 6),
(6, 'jpg', 'Хобит: Битката на петте армии', '(The Hobbit: The Battle of the Five Armies) Американска продукция от 2014', '2016-02-17 16:03:35', 6),
(7, 'jpeg', 'Връх K2', 'Надморската височина- 8 611 m. Намира се в планината Каракорум', '2016-02-18 15:08:43', 1),
(9, 'jpg', 'Interstellar', 'Американска продукция от 2014', '2016-02-18 15:12:05', 6),
(10, 'jpg', 'Южните полярни сияния', '', '2016-02-18 15:16:13', 1),
(11, 'jpg', 'Keep Calm And Conquer The World wallpaper', '', '2016-02-18 15:20:50', 2),
(12, 'jpg', 'Емпайър Стейт Билдинг', '', '2016-02-18 15:24:33', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_categorie` (`id_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
