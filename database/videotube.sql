-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 07:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videotube`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(16, 'Film & Animation'),
(17, 'Autos & Vehicals'),
(18, 'Music'),
(19, 'Pets & Animals'),
(20, 'Sports'),
(21, 'Travel & Events'),
(22, 'Gaming'),
(23, 'People & Blogs'),
(24, 'Comedy'),
(25, 'Entertainment'),
(26, 'News & Politics'),
(27, 'Howto & style'),
(28, 'Education'),
(29, 'Science & Technology'),
(30, 'Nonprofits & Activism'),
(31, 'Film & Animation'),
(32, 'Autos & Vehicals'),
(33, 'Music'),
(34, 'Pets & Animals'),
(35, 'Sports'),
(36, 'Travel & Events'),
(37, 'Gaming'),
(38, 'People & Blogs'),
(39, 'Comedy'),
(40, 'Entertainment'),
(41, 'News & Politics'),
(42, 'Howto & style'),
(43, 'Education'),
(44, 'Science & Technology'),
(45, 'Nonprofits & Activism');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `commentId`, `videoId`) VALUES
(118, 'manohar', 0, 84),
(122, 'manohar', 0, 85);

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  `filepath` varchar(250) NOT NULL,
  `selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoid`, `filepath`, `selected`) VALUES
(49, 78, 'uploads/videos/thumbnails/78-5ede33ebb9c89.jpg', 1),
(50, 78, 'uploads/videos/thumbnails/78-5ede33ed237f9.jpg', 0),
(51, 78, 'uploads/videos/thumbnails/78-5ede33eda17f8.jpg', 0),
(52, 79, 'uploads/videos/thumbnails/79-5ede629b2420d.jpg', 1),
(53, 79, 'uploads/videos/thumbnails/79-5ede629c8ded9.jpg', 0),
(54, 79, 'uploads/videos/thumbnails/79-5ede629d0e19f.jpg', 0),
(55, 80, 'uploads/videos/thumbnails/80-5edf02b4b5b9b.jpg', 1),
(56, 80, 'uploads/videos/thumbnails/80-5edf02b5c8549.jpg', 0),
(57, 80, 'uploads/videos/thumbnails/80-5edf02b64c089.jpg', 0),
(58, 81, 'uploads/videos/thumbnails/81-5edf0764ccc6d.jpg', 1),
(59, 81, 'uploads/videos/thumbnails/81-5edf07654ed2c.jpg', 0),
(60, 81, 'uploads/videos/thumbnails/81-5edf0765e1610.jpg', 0),
(61, 82, 'uploads/videos/thumbnails/82-5edf07b4b8209.jpg', 1),
(62, 82, 'uploads/videos/thumbnails/82-5edf07b517bd4.jpg', 0),
(63, 82, 'uploads/videos/thumbnails/82-5edf07b5bb1ed.jpg', 0),
(64, 83, 'uploads/videos/thumbnails/83-5edf07d191d86.jpg', 1),
(65, 83, 'uploads/videos/thumbnails/83-5edf07d1e3101.jpg', 0),
(66, 83, 'uploads/videos/thumbnails/83-5edf07d26f254.jpg', 0),
(67, 84, 'uploads/videos/thumbnails/84-5edf084021c3d.jpg', 1),
(68, 84, 'uploads/videos/thumbnails/84-5edf0840793b8.jpg', 0),
(69, 84, 'uploads/videos/thumbnails/84-5edf0840ef80a.jpg', 0),
(70, 85, 'uploads/videos/thumbnails/85-5ee41ad23ed26.jpg', 1),
(71, 85, 'uploads/videos/thumbnails/85-5ee41ad3d3a10.jpg', 0),
(72, 85, 'uploads/videos/thumbnails/85-5ee41ad46b8d0.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `singUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `profilePic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `singUpDate`, `profilePic`) VALUES
(11, 'Manohar', 'Ys', 'manohar', 'manohar@gmail.com', '543eef871c3567d807be0608cc14de4b4b8e83655feac9e57c43b40d6ef50f9ff05f416b6de40a602a4931e3a35df3475ba79f658f05534d099d1f813fd5e99f', '2020-06-08 08:36:58', 'assets/images/profilePictures/default.png'),
(12, 'Manu', 'Ys', 'manu', 'manu@gmail.com', '543eef871c3567d807be0608cc14de4b4b8e83655feac9e57c43b40d6ef50f9ff05f416b6de40a602a4931e3a35df3475ba79f658f05534d099d1f813fd5e99f', '2020-06-13 05:44:55', 'assets/images/profilePictures/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` int(11) NOT NULL,
  `privacy` int(11) NOT NULL,
  `filePath` varchar(300) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uploadedBy`, `title`, `description`, `category`, `privacy`, `filePath`, `uploadDate`, `views`, `duration`) VALUES
(83, 'manohar', 'asdf', 'asdf', 0, 16, 'uploads/videos/5edf07d1687b5demo.flv', '2020-06-09 09:23:53', 3, '00:16'),
(84, 'manohar', 'sadf', 'sd', 0, 16, 'uploads/videos/5edf083fe38b3videoplayback.mp4', '2020-06-09 09:25:43', 243, '00:16'),
(85, 'manu', 'some random video', 'some random video', 1, 25, 'uploads/videos/5ee41ad0272c1videoplayback.mp4', '2020-06-13 05:46:16', 42, '00:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
