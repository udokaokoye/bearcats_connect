-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2023 at 08:42 AM
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
(112, '101', '95', 'Bro i\'m telling you!!!  mine is Mon, Tues, Fridays from 10am to 6pm, that tragic bro!', 'null', '2022-11-12 17:40:05'),
(114, '101', '96', 'Welcome, you will love it', 'null', '2022-11-12 17:53:21'),
(115, '101', '120', 'okay', 'null', '2022-11-18 22:41:23'),
(117, '105', '120', 'yeah man', '115', '2022-11-19 07:59:53'),
(119, '105', '95', 'what year are you in?', '112', '2022-11-19 10:42:20'),
(120, '101', '95', 'i\'m a freshman', '119', '2022-11-19 10:43:19'),
(121, '105', '128', 'You guys look so lovely!!', 'null', '2022-11-19 23:36:03'),
(122, '101', '128', 'Where was this place, it looks so beautiful!', 'null', '2022-11-19 23:37:12'),
(123, '107', '128', 'oh, it was San Juan, Puerto Rico 🇵🇷 ', '122', '2022-11-19 23:38:58'),
(125, '101', '128', 'i think i\'ve been there once', '123', '2022-12-14 22:01:33'),
(126, '101', '147', 'loveky', 'null', '2022-12-25 10:00:52'),
(127, '101', '147', 'Hello guys ', 'null', '2022-12-25 14:17:12'),
(129, '101', '147', 'Yes', 'null', '2022-12-25 14:18:51'),
(132, '101', '152', 'Hello', 'null', '2022-12-25 15:21:40'),
(133, '101', '152', 'Yep', 'null', '2022-12-25 15:21:48'),
(134, '101', '94', 'Yessirrr!!!', 'null', '2022-12-25 15:37:26'),
(135, '101', '152', 'Hey nigga ', 'null', '2022-12-26 12:08:23'),
(138, '101', '172', 'I could tell you were tired 😂', 'null', '2022-12-27 10:24:16'),
(139, '107', '172', 'Balablu 😂', 'null', '2022-12-27 10:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `following_user_id` varchar(50) NOT NULL,
  `followed_user_id` varchar(50) NOT NULL,
  `datedFollowed` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `following_user_id`, `followed_user_id`, `datedFollowed`) VALUES
(41, '105', '101', '2022-11-19 10:12:02'),
(44, '101', '107', '2022-11-20 00:09:02'),
(46, '101', '105', '2022-12-14 22:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

CREATE TABLE `hashtags` (
  `id` int(11) NOT NULL,
  `count` text NOT NULL,
  `tag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hashtags`
--

INSERT INTO `hashtags` (`id`, `count`, `tag`) VALUES
(1, '200000', 'bearcat'),
(2, '100000', 'proudlyBearcat');

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
(94, 101, 'New year!!! #UCBA', '', 'null', '2022-11-12 17:34:55'),
(95, 101, 'The spring semester schedule is messed up already!!!', '2', 'null', '2022-11-12 17:39:05'),
(96, 105, 'Hey guys I\'m new here!', '1', 'null', '2022-11-12 17:52:30'),
(118, 101, 'Thisis me tagging @101 ma bwoyyyy', '', 'null', '2022-11-18 22:14:23'),
(120, 101, 'This is me being great, have a great day @101', '', 'null', '2022-11-18 22:39:18'),
(128, 107, 'Hey it\'s Samuel here, i just wan to say i\'m loving this app so far, it\'s something i\'ve been wanting since for a very long time.', '', 'null', '2022-11-14 23:34:59'),
(144, 101, '661', '', 'null', '2022-12-25 03:42:50'),
(147, 101, 'yess', '', 'null', '2022-12-25 03:45:44'),
(152, 101, 'hello Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,', '', 'null', '2022-12-25 12:39:41'),
(169, 107, 'New Update ooo', '', 'null', '2022-12-27 07:42:29'),
(172, 101, 'How I showed up to work today 😂', '', 'null', '2022-12-27 10:21:56'),
(173, 101, 'Happy New year everybody!!!!\n', '', 'null', '2023-01-04 20:51:09'),
(174, 101, 'Hmmm', '', 'null', '2023-01-04 20:52:32'),
(175, 101, 'Ujj', '', 'null', '2023-01-04 20:52:51'),
(176, 101, 'Bsshh', '', 'null', '2023-01-04 20:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `postTags`
--

CREATE TABLE `postTags` (
  `counter` int(11) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tagged_userid` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postTags`
--

INSERT INTO `postTags` (`counter`, `post_id`, `user_id`, `tagged_userid`) VALUES
(5, '118', '101', '101'),
(7, '120', '101', '101'),
(9, '124', '105', '105');

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
(79, '95', 'a:1:{i:0;s:93:\"http://192.168.1.51/bearcats_connect/Images/101_D0DAE67D-FA71-4FE8-8A32-5CBB86AFCC36.jpg.jpeg\";}', 's:1:\"p\";'),
(80, '96', 'a:1:{i:0;s:95:\"http://192.168.1.51/bearcats_connect/Images/105_julian-gentilezza-9qd0iQ8otbU-unsplash.jpg.jpeg\";}', 's:1:\"p\";'),
(81, '120', 'a:1:{i:0;s:91:\"http://192.168.1.51/bearcats_connect/Images/101_hello-i-m-nik-z1d-LP8sjuI-unsplash.jpg.jpeg\";}', 's:1:\"p\";'),
(83, '128', 'a:1:{i:0;s:66:\"http://192.168.1.51/bearcats_connect/Images/107_IMG_0568.jpeg.jpeg\";}', 's:1:\"l\";'),
(95, '144', 'a:1:{i:0;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_6d12aca7-25a9-4c30-b54d-26995a81a3f5_.jpeg\";}', 's:1:\"l\";'),
(97, '147', 'a:1:{i:0;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_56b56d3e-3737-4964-8f03-c4db2f0b28c5_.jpeg\";}', 's:1:\"l\";'),
(100, '152', 'a:4:{i:0;s:58:\"http://192.168.1.51/bearcats_connect/Images/101_bcnet.jpeg\";i:1;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_2f7c011a-166b-45dd-96d9-a8e287a90073_.jpeg\";i:2;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_2ea85bc7-809f-4d5a-b0be-30b961e62e4a_.jpeg\";i:3;s:90:\"http://192.168.1.51/bearcats_connect/Images/101_6e36e5b2-4f34-4958-bd18-520f5df11c02_.jpeg\";}', 's:7:\"l,l,l,p\";'),
(107, '169', 'a:1:{i:0;s:93:\"http://192.168.1.51/bearcats_connect/Images/107_B4F5AE9A-E5EC-4EE7-A71E-64A7400BA23E.png.jpeg\";}', 's:3:\"p,p\";'),
(110, '172', 'a:2:{i:0;s:93:\"http://192.168.1.51/bearcats_connect/Images/101_D2452C30-FA8C-4AFB-84B6-283493E36F3F.jpg.jpeg\";i:1;s:93:\"http://192.168.1.51/bearcats_connect/Images/101_38173DA3-130E-48F4-A306-35B082EB2A01.jpg.jpeg\";}', 's:3:\"p,p\";'),
(111, '173', 'a:1:{i:0;s:93:\"http://192.168.1.51/bearcats_connect/Images/101_D6D75E21-44B7-42CC-B31D-E9941583602D.jpg.jpeg\";}', 'a:1:{i:0;s:1:\"p\";}'),
(112, '174', 'a:1:{i:0;s:93:\"http://192.168.1.51/bearcats_connect/Images/101_CA337575-600F-4BE8-AD14-E4393AA392E9.jpg.jpeg\";}', 'a:1:{i:0;s:1:\"p\";}'),
(113, '176', 'a:2:{i:0;s:93:\"http://192.168.1.51/bearcats_connect/Images/101_BAA74679-5BE8-40A5-ACF3-92D67BF4E6D3.jpg.jpeg\";i:1;s:93:\"http://192.168.1.51/bearcats_connect/Images/101_C4FFD9C6-4378-407A-ACC0-739FD2056B4A.jpg.jpeg\";}', 'a:1:{i:0;s:3:\"p,p\";}');

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
(101, 'Udoka', 'Okoye', 'okoyeul', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_101__MG_2599.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_104_cover1.jpg', '5135555555', 'okoyeul@mail.uc.edu', '$2y$10$EOo7cm1xy8dpa6lNBK63f.nwozRYG1OXBTyGFmm9zdaa00CHtHvyi', '2022-10-18 22:27:11', 'Hey I\'m 6\'7 from Nigeria', 'defalult2', 'CLIF'),
(105, 'James', 'Couch', 'onlyjamescouch', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_105_ludovic-migneault-EZ4TYgXPNWk-unsplash.jpg', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_105_ludovic-migneault-EZ4TYgXPNWk-unsplash.jpg', '5152268897', 'couchjames@mail.uc.edu', '$2y$10$9IFb9l6knXl2hY6ITmZR/.Y.0PNQKcwJxyoQWLn7/V96JyTDkha6.', '2022-11-12 17:48:23', 'I\'m a philanthropist looking forward to move to the uptown campus when I\'m done at blueish college', 'defalult2', 'UCBA'),
(107, 'Samuel', 'John', 'sasmueljohn', 'http://192.168.1.51/bearcats_connect/Images/profile_images/pp_107_IMG_4044.JPEG', 'http://192.168.1.51/bearcats_connect/Images/cover_images/cc_107_photo-1486406146926-c627a92ad1ab.jpg', '5132138308', 'samueljohn@mail.uc.edu', '$2y$10$F49OcRqOjV7pUTia1IyVmebuy9PP0mFHN0T9ntKQPB2UrcLpF3eG2', '2022-11-19 12:17:43', 'I\'m a computer science major, and also a techyyy guy!', 'defalult3', 'UCBA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postTags`
--
ALTER TABLE `postTags`
  ADD PRIMARY KEY (`counter`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `postTags`
--
ALTER TABLE `postTags`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_media`
--
ALTER TABLE `post_media`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
