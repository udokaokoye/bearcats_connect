-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2022 at 10:30 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bearcats_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `reply_id` varchar(20) DEFAULT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `reply_id`, `dateCreated`) VALUES
(1, '1', '17', 'Hey this is my first comment', '', '2022-10-08 08:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `following_user_id` varchar(50) NOT NULL,
  `followed_user_id` varchar(50) NOT NULL,
  `datedFollowed` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`following_user_id`, `followed_user_id`, `datedFollowed`) VALUES
('1', '2', '2022-10-04 21:10:43'),
('4', '1', '2022-10-04 21:15:00'),
('1', '3', '2022-10-04 21:15:09'),
('1', '5', '2022-10-04 21:15:15'),
('7', '3', '2022-10-14 22:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `Intrest`
--

CREATE TABLE `Intrest` (
  `userId` varchar(20) NOT NULL,
  `intrest` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `caption` text NOT NULL,
  `location` varchar(80) NOT NULL,
  `type` varchar(20) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `caption`, `location`, `type`, `createdDate`) VALUES
(48, 3, 'Hey New', '1', 'null', '2022-10-14 23:33:13'),
(49, 3, 'Hey latest', '', 'null', '2022-10-14 23:34:40'),
(50, 3, 'Hey guys anyone done the English 1001 assignment yet?', '1', 'null', '2022-10-14 23:37:21'),
(51, 3, 'Hey guys anyone done the English 1001 assignment yet?', '1', 'null', '2022-10-14 23:37:44'),
(52, 3, '2020', '7', 'null', '2022-10-14 23:39:45'),
(53, 3, '2020', '7', 'null', '2022-10-14 23:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `postUserTags`
--

CREATE TABLE `postUserTags` (
  `post_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post_media`
--

CREATE TABLE `post_media` (
  `counter` int(11) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `media_url` varchar(200) NOT NULL,
  `orientation` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_media`
--

INSERT INTO `post_media` (`counter`, `post_id`, `media_url`, `orientation`) VALUES
(43, '48', 'a:0:{}', 's:0:\"\";'),
(44, '49', 'a:2:{i:0;s:32:\"Images/3_1665804880__MG_2599.jpg\";i:1;s:43:\"Images/3_alec-krum-5GagtDqyCm8-unsplash.jpg\";}', 's:3:\"p,p\";'),
(45, '50', 'a:1:{i:0;s:32:\"Images/3_1665805041__MG_2599.jpg\";}', 's:1:\"p\";'),
(46, '52', 'a:1:{i:0;s:56:\"Images/3_d3a2b791-ed13-4183-81af-f576ba135314_image.jpeg\";}', 's:1:\"l\";');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `post_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `date_reacted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `cover_picture` varchar(200) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registerdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `bio` varchar(255) DEFAULT NULL,
  `major` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `profile_picture`, `cover_picture`, `mobile`, `email`, `password`, `registerdAt`, `bio`, `major`) VALUES
(1, 'Levi', 'Okoye', 'leviokoye21', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_1_ali-pazani-CUKJMaLX68s-unsplash_adobe_express.jpeg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_1_cover1.jpg', '513-111-6659', 'okoyeul@mail.uc.edu', '$2y$10$vvg0SlnxieJJpvV3CENLYe8LWCn4S4FnEmd.nCEkCIPpwabSY96eG', '2022-10-02 16:40:08', 'Hey I\', levi I\'. 6\'7 Tall From Nigeria!', 'Information Technology'),
(15, 'Udoka', '', 'techguru001', '', '', '0907756123', 'techguru@mail.uc.edu', '$2y$10$YOaW4bEn6/2DjapkLGWdyOL3Nv7LUjVZJm4oqVC20AdwQ/tn3iE6C', '2022-10-17 18:53:30', 'This Is My Bio', 'defalult1'),
(17, 'Fourth', 'User', 'sampleUserssss', NULL, NULL, NULL, 'fourthuserss@gmail.comss', '$2y$10$Tf/is8f4dWtOQ4vFirIesO/UPrxlqNFgw3aF7d/hc2nzYRwyzNLRy', '2022-10-17 18:56:36', NULL, NULL),
(18, 'Udoka', 'Okoye', 'techguru', NULL, NULL, NULL, 'techguru@mail.uc.edu', '$2y$10$SsVYx3KuMGEAi/T2Y0PmL.hwZ604jZA6V8g.kWiDajWgAALx/qrvm', '2022-10-17 18:57:33', NULL, NULL),
(19, 'Udoka', 'Okoye', 'qwer', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_19__MG_2599.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_19__MG_2599.jpg', '12345678', 'leviokoye@mail.uc.edu', '$2y$10$TJAq2bDdLcJb8w6mOtW8f.Mb5fcagYRjTo02BXwQCASf867QXmUM6', '2022-10-17 19:05:01', 'This is my bio', 'defalult3'),
(20, 'Udoka', 'Okoye', 'tech', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_20__MG_2599.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_20__MG_2599.jpg', '14477896', 'tech@mail.uc.edu', '$2y$10$U8RCfETV0V4pVWrzNpbAbuMAq7MLflJjTdBAQ4NbLqrLHU6nQxPd6', '2022-10-17 19:26:37', 'Hello Guy', 'defalult3'),
(21, 'Udoka', 'Okoye', 'cxvxcv', NULL, NULL, NULL, 'lcvxceviokoye@mail.uc.edu', '$2y$10$VF8aSvZyksbMPtQMzF8WCevBnSvmvrF5NTTJVOTP8BYG6Etcps5L6', '2022-10-17 19:40:10', NULL, NULL),
(22, 'Udoka', 'Okoye', 'asdas', NULL, NULL, NULL, 'sadasda@mail.uc.edu', '$2y$10$MH07hmBeMpHwUsPQ7hyFJOksE7j8.JPwfEilPZFNHSWUXS2fTtIVu', '2022-10-17 19:44:44', NULL, NULL),
(23, 'dfsdf', 'sdfsdf', 'adasd', NULL, NULL, NULL, 'dfs@mail.uc.edu', '$2y$10$zxpIwhErzKX7pqn8DRe85.bQ.A1p52Kp1EK2bR7c7NXieOsmtPgQ6', '2022-10-17 19:45:18', NULL, NULL),
(24, 'Udoka', 'Okoye', 'username', NULL, NULL, NULL, 'user@mail.uc.edu', '$2y$10$Xw5c/wuXKFgBLxXjzBH32uQ7VQ4.xOthInzJ/7TmI/h.V88xMVqt6', '2022-10-17 20:17:34', NULL, NULL),
(25, 'Udoka', 'Okoye', 'asdffffff', NULL, NULL, NULL, 'aaaaaa@mail.uc.edu', '$2y$10$EP9XVdb211hGqrp7KOW9neHG3djy34ggALmSJ5loca/5dg7UzdhLu', '2022-10-17 20:18:42', NULL, NULL),
(26, 'Udochukwuka', 'Okoye', 'udokaokoye', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_26__MG_2599.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_26__MG_2599.jpg', '5112112238', 'udoka@mail.uc.edu', '$2y$10$ZaIdUp61gCn3p7AvWi1fY.X5yREXtjoyLJV8z3.MT3tdYYjakYffy', '2022-10-17 21:05:39', '6\"7 Nigeria...Not a basketball player', 'defalult2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_media`
--
ALTER TABLE `post_media`
  ADD PRIMARY KEY (`counter`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mobile` (`mobile`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
