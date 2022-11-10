-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 10, 2022 at 01:04 PM
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
(83, '101', '75', 'Manually entered comment for post 75', NULL, '2022-11-08 19:32:07'),
(84, '101', '75', 'dummy com,ment', NULL, '2022-11-08 19:32:47');

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
(72, 101, 'ss', '', 'null', '2022-10-30 21:10:25'),
(73, 101, 'hey', '', 'null', '2022-10-30 21:13:42'),
(74, 101, 'My Sister\'s wedding!', '', 'null', '2022-10-30 21:43:59'),
(75, 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with', 'Muntz Hall', 'null', '2022-10-30 23:02:01'),
(77, 101, 'dfsdfsd', '', 'null', '2022-11-08 16:30:22'),
(78, 101, 'Hello Post', '', 'null', '2022-11-08 16:33:47'),
(79, 101, 'Test Post again', '', 'null', '2022-11-08 16:34:27'),
(85, 101, 'hmmm', '', 'null', '2022-11-08 17:07:39'),
(86, 101, 'The same thing for all posts ', '', 'null', '2022-11-08 17:08:16'),
(87, 101, 'New Post Guys', '3', 'null', '2022-11-08 19:06:28'),
(88, 101, '6 pictures', '', 'null', '2022-11-08 19:08:09'),
(89, 101, 'Hello', '', 'null', '2022-11-08 19:26:20');

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
  `media_url` text NOT NULL,
  `orientation` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_media`
--

INSERT INTO `post_media` (`counter`, `post_id`, `media_url`, `orientation`) VALUES
(61, '70', 'a:1:{i:0;s:63:\"http://192.168.1.51/bearcats_connect/Images/101_1667172802_blob\";}', 's:1:\"l\";'),
(62, '71', 'a:1:{i:0;s:56:\"http://192.168.1.51/bearcats_connect/Images/101_bConnect\";}', 's:1:\"l\";'),
(63, '72', 'a:1:{i:0;s:57:\"http://192.168.1.51/bearcats_connect/Images/101_blob.jpeg\";}', 's:1:\"l\";'),
(64, '73', 'a:1:{i:0;s:95:\"http://192.168.1.51/bearcats_connect/Images/101_image_processing20211205-14945-1wmbvl4.png.jpeg\";}', 's:1:\"l\";'),
(65, '74', 'a:2:{i:0;s:77:\"http://192.168.1.51/bearcats_connect/Images/101_Jaqueline&Stephen-60.jpg.jpeg\";i:1;s:78:\"http://192.168.1.51/bearcats_connect/Images/101_Jaqueline&Stephen-146.jpg.jpeg\";}', 's:3:\"l,l\";'),
(66, '75', 'a:1:{i:0;s:89:\"http://192.168.1.51/bearcats_connect/Images/100_elizeu-dias-2EGNqazbAMk-unsplash.jpg.jpeg\";}', 'a:2:{i:0;s:1:\"l\";i:1;s:1:\"l\";}'),
(68, '77', 'a:1:{i:0;s:90:\"http://192.168.1.51/bearcats_connect/Images/101__123824568_gettyimages-1239417642.jpg.jpeg\";}', 's:1:\"l\";'),
(74, '85', 'a:4:{i:0;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_de868b05-1533-458a-8a59-cc5b46e101c5_.jpeg\";i:1;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_20559709-f234-46ca-8f3f-025c8fc791c7_.jpeg\";i:2;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_a22c1763-3e4d-4d9d-b480-d25185b7a161_.jpeg\";i:3;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_c3bc9d56-b5e9-45fb-9ae3-825f72da0327_.jpeg\";}', 's:7:\"l,l,l,l\";'),
(75, '86', 'a:3:{i:0;s:63:\"http://192.168.1.51/bearcats_connect/Images/101_cover1.jpg.jpeg\";i:1;s:92:\"http://192.168.1.51/bearcats_connect/Images/101_emanuel-kionke-5SGn7Q1rYI0-unsplash.jpg.jpeg\";i:2;s:66:\"http://192.168.1.51/bearcats_connect/Images/101_image (1).jpg.jpeg\";}', 's:5:\"l,l,l\";'),
(76, '87', 'a:3:{i:0;s:66:\"http://192.168.1.51/bearcats_connect/Images/101_IMG_3295.jpeg.jpeg\";i:1;s:94:\"http://192.168.1.51/bearcats_connect/Images/101_b7bf937c-e9ab-4c19-a6ba-276635fb6f50.jpeg.jpeg\";i:2;s:94:\"http://192.168.1.51/bearcats_connect/Images/101_a518d79b-6386-4580-bd61-c60b2fdbfe9e.jpeg.jpeg\";}', 's:5:\"p,p,p\";'),
(77, '88', 'a:6:{i:0;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_66835072-aab2-4f38-9d42-b391d1210f35_.jpeg\";i:1;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_77664b22-1949-445b-be48-64fad0287950_.jpeg\";i:2;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_e6a1ba5e-dbd1-4101-9fa5-8d0fba229701_.jpeg\";i:3;s:89:\"http://192.168.1.51/bearcats_connect/Images/101_alison-wang-mou0S7ViElQ-unsplash.jpg.jpeg\";i:4;s:103:\"http://192.168.1.51/bearcats_connect/Images/101_ali-pazani-CUKJMaLX68s-unsplash_adobe_express.jpeg.jpeg\";i:5;s:74:\"http://192.168.1.51/bearcats_connect/Images/101_casual_ccexpress.jpeg.jpeg\";}', 's:11:\"l,l,l,l,l,p\";');

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
  `major` varchar(50) DEFAULT NULL,
  `campus` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `profile_picture`, `cover_picture`, `mobile`, `email`, `password`, `registerdAt`, `bio`, `major`, `campus`) VALUES
(27, 'Udoka', 'Okoye', 'asd', NULL, NULL, NULL, 'leviokoye@mail.uc.edu', '$2y$10$UMiGcRS2DgkI.g/cwlp2Fe4HBzvSJDHs9JCgoq6QYZZeebEqBKOae', '2022-10-18 19:08:14', NULL, NULL, NULL),
(28, 'Udoka', 'Okoye', 'user', NULL, NULL, NULL, 'leviokoye@mail.uc.edu', '$2y$10$2s7eZuVnrHIVlUPcwDrcyuGH5qMPKkHl1hlBYZMxn56yePkYkI3uC', '2022-10-18 19:10:07', NULL, NULL, NULL),
(100, 'Udoka', 'Okoye', 'user656', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_100__MG_2599.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_100__MG_2599.jpg', '5136656547', 'leviokoyhhhe@mail.uc.edu', '$2y$10$TvOdDfckFDvTyT1LmxyShu9v3//6yKkugEltMSiM4GV5HWQtf7X0K', '2022-10-18 21:50:06', 'This Is Me', 'defalult2', NULL),
(101, 'Udoka', 'Okoye', 'okoyeul', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_101__MG_2599.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_104_cover1.jpg', '5135555555', 'okoyeul@mail.uc.edu', '$2y$10$EOo7cm1xy8dpa6lNBK63f.nwozRYG1OXBTyGFmm9zdaa00CHtHvyi', '2022-10-18 22:27:11', 'Hey I\'m 6\'7 from Nigeria', 'defalult2', NULL),
(102, 'Peter', 'Okoye', 'udoka', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_102_IMG_2992.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_102_IMG_2992.jpg', '5135555589', 'udoka@mail.uc.edu', '$2y$10$/nvbNex8JN/UD5yEqOqIk.M2vHV4L9LBhI..Jb8rbooGYfTRciri2', '2022-10-19 09:48:20', 'THIS IS ME', 'defalult3', 'UCBA'),
(103, 'Udoka', 'Okoye', 'levi', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_103_ali-pazani-CUKJMaLX68s-unsplash_adobe_express.jpeg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_103_ali-pazani-CUKJMaLX68s-unsplash_adobe_express.jpeg', '5132138888', 'levi@mail.uc.edu', '$2y$10$m9unGZkUEBfdvs93Du/o6u6G2pvHkrfmVSo.BfTyWvH.ouqWbIOOy', '2022-10-19 10:01:19', 'my bio', 'defalult3', 'CLEM'),
(104, 'negro1', 'nigga2', 'negro', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_104_cover1.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_104_cover1.jpg', '6133377', 'dumbnegro@mail.uc.edu', '$2y$10$8oKwU.GBWJjPByYnvL/56.PlksvWnocKF.AGJwhxDxyU3wo7kp4NW', '2022-10-19 19:48:56', 'i am a niger that plays soccer ', 'defalult2', 'UCBA');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
