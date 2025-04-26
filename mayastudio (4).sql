-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 06:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mayastudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$bNyJdRpiM70hvECn3KL.kOF3NT3gnmqPHeOG.9mvt50lnxxYdtQ/q', '2025-03-26 09:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` time NOT NULL,
  `service` varchar(100) NOT NULL,
  `package` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_refunded` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `full_name`, `email`, `phone`, `preferred_date`, `preferred_time`, `service`, `package`, `amount`, `status`, `created_at`, `is_refunded`) VALUES
(10, 17, 'dhairya', 'dhairya0331@gmail.com', '9638904702', '2025-04-01', '21:18:00', 'wedding', 'premium', 3499.00, 'confirmed', '2025-03-30 15:43:47', 1),
(13, 18, 'Prakash Vaghela', 'pako@gmail.com', '09054328209', '2025-04-12', '19:10:00', 'modeling', 'premium', 3499.00, 'pending', '2025-04-10 13:37:19', 0),
(14, 18, 'Rajat Baraiya', 'mohit1353@gmail.com', '09054328209', '2025-04-19', '19:54:00', 'modeling', 'premium', 3499.00, 'cancelled', '2025-04-10 14:21:44', 1),
(15, 19, 'Rajat Baraiya', 'rajatbaraiya18@gmail.com', '09054328209', '2025-04-18', '10:36:00', 'portrait', 'premium', 3499.00, 'confirmed', '2025-04-11 05:06:44', 1),
(16, 19, 'Rajat Baraiya', 'rajatbaraiya18@gmail.com', '09054328209', '2025-04-12', '12:53:00', 'family', 'basic', 1499.00, 'pending', '2025-04-11 07:21:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(10, 'Rajat Baraiya', 'rajat26@gmail.com', 'for wedding photography inquiry', 'i loved your work ', '2025-03-28 08:19:35'),
(11, 'dhairya', 'dhairya0331@gmail.com', 'for wedding photography inquiry', 'cmncjd', '2025-03-30 15:46:21'),
(12, 'Prakash Vaghela', 'pako@gmail.com', 'for wedding photography inquiry', 'please accept  my request fast', '2025-04-10 13:38:08'),
(13, 'Rajat Baraiya', 'rajatbaraiya18@gmail.com', 'for wedding photography inquiry', 'i want more information', '2025-04-11 05:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `E_ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  `Location` varchar(100) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`E_ID`, `U_ID`, `Type`, `Date`, `Location`, `Status`) VALUES
(3, 2, 'hjhhikhihihj', '2020-12-01', 'jhksshdkfkfnk', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image_path`, `category`, `created_at`) VALUES
(610, 'portraits (1)', 'uploads/67e42cd83a9ec_0.jpg', 'Portraits', '2025-03-26 16:35:36'),
(611, 'portraits (2)', 'uploads/67e42cd83dc80_1.jpg', 'Portraits', '2025-03-26 16:35:36'),
(612, 'portraits (3)', 'uploads/67e42cd840d92_2.jpg', 'Portraits', '2025-03-26 16:35:36'),
(613, 'portraits (4)', 'uploads/67e42cd84465f_3.jpg', 'Portraits', '2025-03-26 16:35:36'),
(614, 'portraits (5)', 'uploads/67e42cd847af1_4.jpg', 'Portraits', '2025-03-26 16:35:36'),
(615, 'portraits (6)', 'uploads/67e42cd84ab88_5.jpg', 'Portraits', '2025-03-26 16:35:36'),
(616, 'portraits (7)', 'uploads/67e42cd84d95f_6.jpg', 'Portraits', '2025-03-26 16:35:36'),
(617, 'portraits (8)', 'uploads/67e42cd8505e0_7.jpg', 'Portraits', '2025-03-26 16:35:36'),
(618, 'portraits (9)', 'uploads/67e42cd85696e_8.jpg', 'Portraits', '2025-03-26 16:35:36'),
(619, 'portraits (10)', 'uploads/67e42cd859cfb_9.jpg', 'Portraits', '2025-03-26 16:35:36'),
(620, 'portraits (11)', 'uploads/67e42cd85ca2c_10.jpg', 'Portraits', '2025-03-26 16:35:36'),
(621, 'portraits (12)', 'uploads/67e42cd85f866_11.jpg', 'Portraits', '2025-03-26 16:35:36'),
(622, 'portraits (13)', 'uploads/67e42cd86250b_12.jpg', 'Portraits', '2025-03-26 16:35:36'),
(623, 'portraits (14)', 'uploads/67e42cd8656f0_13.jpg', 'Portraits', '2025-03-26 16:35:36'),
(624, 'portraits (15)', 'uploads/67e42cd8683d8_14.jpg', 'Portraits', '2025-03-26 16:35:36'),
(625, 'portraits (16)', 'uploads/67e42cd86b345_15.jpg', 'Portraits', '2025-03-26 16:35:36'),
(626, 'portraits (17)', 'uploads/67e42cd86deae_16.jpg', 'Portraits', '2025-03-26 16:35:36'),
(627, 'portraits (18)', 'uploads/67e42cd870a8e_17.jpg', 'Portraits', '2025-03-26 16:35:36'),
(628, 'portraits (19)', 'uploads/67e42cd8734a8_18.jpg', 'Portraits', '2025-03-26 16:35:36'),
(629, 'portraits (20)', 'uploads/67e42cd8760a0_19.jpg', 'Portraits', '2025-03-26 16:35:36'),
(630, 'maternity (1)', 'uploads/67e42d06e8f07_0.jpg', 'Maternity', '2025-03-26 16:36:22'),
(631, 'maternity (2)', 'uploads/67e42d06ec132_1.jpg', 'Maternity', '2025-03-26 16:36:22'),
(632, 'maternity (3)', 'uploads/67e42d06ef1ca_2.jpg', 'Maternity', '2025-03-26 16:36:22'),
(633, 'maternity (4)', 'uploads/67e42d06f1cab_3.jpg', 'Maternity', '2025-03-26 16:36:23'),
(634, 'maternity (5)', 'uploads/67e42d070070d_4.jpg', 'Maternity', '2025-03-26 16:36:23'),
(635, 'maternity (6)', 'uploads/67e42d0703634_5.jpg', 'Maternity', '2025-03-26 16:36:23'),
(636, 'maternity (7)', 'uploads/67e42d0706b4d_6.jpg', 'Maternity', '2025-03-26 16:36:23'),
(637, 'maternity (8)', 'uploads/67e42d070a129_7.jpg', 'Maternity', '2025-03-26 16:36:23'),
(638, 'maternity (9)', 'uploads/67e42d070daf1_8.jpg', 'Maternity', '2025-03-26 16:36:23'),
(639, 'maternity (10)', 'uploads/67e42d07112f6_9.jpg', 'Maternity', '2025-03-26 16:36:23'),
(640, 'maternity (11)', 'uploads/67e42d0714918_10.jpg', 'Maternity', '2025-03-26 16:36:23'),
(641, 'maternity (12)', 'uploads/67e42d0718736_11.jpg', 'Maternity', '2025-03-26 16:36:23'),
(642, 'maternity (13)', 'uploads/67e42d071c1ff_12.jpg', 'Maternity', '2025-03-26 16:36:23'),
(643, 'maternity (14)', 'uploads/67e42d071f9b6_13.jpg', 'Maternity', '2025-03-26 16:36:23'),
(644, 'maternity (15)', 'uploads/67e42d07234d5_14.jpg', 'Maternity', '2025-03-26 16:36:23'),
(645, 'maternity (16)', 'uploads/67e42d0726a3e_15.jpg', 'Maternity', '2025-03-26 16:36:23'),
(646, 'maternity (17)', 'uploads/67e42d072a56e_16.jpg', 'Maternity', '2025-03-26 16:36:23'),
(647, 'wedding (1)', 'uploads/67e42d2e66b06_0.jpg', 'Wedding', '2025-03-26 16:37:02'),
(648, 'wedding (2)', 'uploads/67e42d2e6c0a8_1.jpg', 'Wedding', '2025-03-26 16:37:02'),
(649, 'wedding (3)', 'uploads/67e42d2e71f3f_2.jpg', 'Wedding', '2025-03-26 16:37:02'),
(650, 'wedding (4)', 'uploads/67e42d2e77fe6_3.jpg', 'Wedding', '2025-03-26 16:37:02'),
(651, 'wedding (5)', 'uploads/67e42d2e7dc4d_4.jpg', 'Wedding', '2025-03-26 16:37:02'),
(652, 'wedding (6)', 'uploads/67e42d2e846bf_5.jpg', 'Wedding', '2025-03-26 16:37:02'),
(653, 'wedding (7)', 'uploads/67e42d2e8a13f_6.jpg', 'Wedding', '2025-03-26 16:37:02'),
(654, 'wedding (8)', 'uploads/67e42d2e906c9_7.jpg', 'Wedding', '2025-03-26 16:37:02'),
(655, 'wedding (9)', 'uploads/67e42d2e95ffa_8.jpg', 'Wedding', '2025-03-26 16:37:02'),
(656, 'wedding (10)', 'uploads/67e42d2e9c555_9.jpg', 'Wedding', '2025-03-26 16:37:02'),
(657, 'wedding (11)', 'uploads/67e42d2ea25e0_10.jpg', 'Wedding', '2025-03-26 16:37:02'),
(658, 'wedding (12)', 'uploads/67e42d2ea9838_11.jpg', 'Wedding', '2025-03-26 16:37:02'),
(659, 'wedding (13)', 'uploads/67e42d2eafbe5_12.jpg', 'Wedding', '2025-03-26 16:37:02'),
(660, 'wedding (14)', 'uploads/67e42d2eb591d_13.jpg', 'Wedding', '2025-03-26 16:37:02'),
(661, 'wedding (15)', 'uploads/67e42d2ebb419_14.jpg', 'Wedding', '2025-03-26 16:37:02'),
(662, 'wedding (16)', 'uploads/67e42d2ec12a6_15.jpg', 'Wedding', '2025-03-26 16:37:02'),
(663, 'wedding (17)', 'uploads/67e42d2ec6d31_16.jpg', 'Wedding', '2025-03-26 16:37:02'),
(664, 'wedding (18)', 'uploads/67e42d2ecc852_17.jpg', 'Wedding', '2025-03-26 16:37:02'),
(665, 'wedding (19)', 'uploads/67e42d2ed25ef_18.jpg', 'Wedding', '2025-03-26 16:37:02'),
(666, 'wedding (20)', 'uploads/67e42d2ed770f_19.jpg', 'Wedding', '2025-03-26 16:37:02'),
(667, 'wedding (1)', 'uploads/67e42d4a692a2_0.jpg', 'Wedding', '2025-03-26 16:37:30'),
(668, 'wedding (2)', 'uploads/67e42d4a6c261_1.jpg', 'Wedding', '2025-03-26 16:37:30'),
(669, 'wedding (3)', 'uploads/67e42d4a6ec01_2.jpg', 'Wedding', '2025-03-26 16:37:30'),
(670, 'wedding (4)', 'uploads/67e42d4a71711_3.jpg', 'Wedding', '2025-03-26 16:37:30'),
(671, 'engagement (1)', 'uploads/67e42d7b3d373_0.jpg', 'Engagement', '2025-03-26 16:38:19'),
(672, 'engagement (2)', 'uploads/67e42d7b3fcaa_1.jpg', 'Engagement', '2025-03-26 16:38:19'),
(673, 'engagement (3)', 'uploads/67e42d7b4280b_2.jpg', 'Engagement', '2025-03-26 16:38:19'),
(674, 'engagement (4)', 'uploads/67e42d7b4574e_3.jpg', 'Engagement', '2025-03-26 16:38:19'),
(675, 'engagement (5)', 'uploads/67e42d7b49845_4.jpg', 'Engagement', '2025-03-26 16:38:19'),
(676, 'engagement (6)', 'uploads/67e42d7b4c608_5.jpg', 'Engagement', '2025-03-26 16:38:19'),
(677, 'engagement (7)', 'uploads/67e42d7b4fc0e_6.jpg', 'Engagement', '2025-03-26 16:38:19'),
(678, 'engagement (8)', 'uploads/67e42d7b535c4_7.jpg', 'Engagement', '2025-03-26 16:38:19'),
(679, 'engagement (9)', 'uploads/67e42d7b573dc_8.jpg', 'Engagement', '2025-03-26 16:38:19'),
(680, 'engagement (10)', 'uploads/67e42d7b5ad58_9.jpg', 'Engagement', '2025-03-26 16:38:19'),
(681, 'engagement (11)', 'uploads/67e42d7b5e614_10.jpg', 'Engagement', '2025-03-26 16:38:19'),
(682, 'engagement (12)', 'uploads/67e42d7b619d2_11.jpg', 'Engagement', '2025-03-26 16:38:19'),
(683, 'engagement (13)', 'uploads/67e42d7b64fb2_12.jpg', 'Engagement', '2025-03-26 16:38:19'),
(684, 'engagement (14)', 'uploads/67e42d7b68592_13.jpg', 'Engagement', '2025-03-26 16:38:19'),
(685, 'engagement (15)', 'uploads/67e42d7b6bc57_14.jpg', 'Engagement', '2025-03-26 16:38:19'),
(686, 'engagement (16)', 'uploads/67e42d7b6f407_15.jpg', 'Engagement', '2025-03-26 16:38:19'),
(687, 'engagement (17)', 'uploads/67e42d7b72ced_16.jpg', 'Engagement', '2025-03-26 16:38:19'),
(688, 'engagement (18)', 'uploads/67e42d7b761dc_17.jpg', 'Engagement', '2025-03-26 16:38:19'),
(689, 'engagement (19)', 'uploads/67e42d7b796d1_18.jpg', 'Engagement', '2025-03-26 16:38:19'),
(727, 'prewedding (1)', 'uploads/67e42e9003e62_0.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(728, 'prewedding (2)', 'uploads/67e42e9009266_1.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(729, 'prewedding (3)', 'uploads/67e42e900d8bd_2.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(730, 'prewedding (4)', 'uploads/67e42e9012037_3.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(731, 'prewedding (5)', 'uploads/67e42e901651d_4.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(732, 'prewedding (6)', 'uploads/67e42e901b42b_5.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(733, 'prewedding (7)', 'uploads/67e42e901fb80_6.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(734, 'prewedding (8)', 'uploads/67e42e9022e3c_7.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(735, 'prewedding (9)', 'uploads/67e42e9025fe2_8.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(736, 'prewedding (10)', 'uploads/67e42e90292ee_9.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(737, 'prewedding (11)', 'uploads/67e42e902c3ed_10.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(738, 'prewedding (12)', 'uploads/67e42e9030f75_11.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(739, 'prewedding (13)', 'uploads/67e42e9038b0d_12.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(740, 'prewedding (14)', 'uploads/67e42e903fec1_13.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(741, 'prewedding (15)', 'uploads/67e42e904788a_14.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(742, 'prewedding (16)', 'uploads/67e42e904dd48_15.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(743, 'prewedding (17)', 'uploads/67e42e9053dd1_16.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(744, 'prewedding (18)', 'uploads/67e42e90598f5_17.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(745, 'prewedding (19)', 'uploads/67e42e905ff9e_18.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(746, 'prewedding (20)', 'uploads/67e42e906555d_19.jpg', 'Pre-Wedding', '2025-03-26 16:42:56'),
(747, 'modelling (1)', 'uploads/67e42ebb09dab_0.jpg', 'Modeling', '2025-03-26 16:43:39'),
(748, 'modelling (2)', 'uploads/67e42ebb0cad1_1.jpg', 'Modeling', '2025-03-26 16:43:39'),
(749, 'modelling (3)', 'uploads/67e42ebb10484_2.jpg', 'Modeling', '2025-03-26 16:43:39'),
(750, 'modelling (4)', 'uploads/67e42ebb13695_3.jpg', 'Modeling', '2025-03-26 16:43:39'),
(751, 'modelling (5)', 'uploads/67e42ebb1614e_4.jpg', 'Modeling', '2025-03-26 16:43:39'),
(752, 'modelling (6)', 'uploads/67e42ebb18a56_5.jpg', 'Modeling', '2025-03-26 16:43:39'),
(753, 'modelling (7)', 'uploads/67e42ebb1b99b_6.jpg', 'Modeling', '2025-03-26 16:43:39'),
(754, 'modelling (8)', 'uploads/67e42ebb1e625_7.jpg', 'Modeling', '2025-03-26 16:43:39'),
(755, 'modelling (9)', 'uploads/67e42ebb21385_8.jpg', 'Modeling', '2025-03-26 16:43:39'),
(756, 'modelling (10)', 'uploads/67e42ebb23f35_9.jpg', 'Modeling', '2025-03-26 16:43:39'),
(757, 'modelling (11)', 'uploads/67e42ebb26d01_10.jpg', 'Modeling', '2025-03-26 16:43:39'),
(758, 'modelling (12)', 'uploads/67e42ebb29726_11.jpg', 'Modeling', '2025-03-26 16:43:39'),
(759, 'modelling (13)', 'uploads/67e42ebb2c4c3_12.jpg', 'Modeling', '2025-03-26 16:43:39'),
(760, 'modelling (14)', 'uploads/67e42ebb2f35c_13.jpg', 'Modeling', '2025-03-26 16:43:39'),
(761, 'modelling (15)', 'uploads/67e42ebb32608_14.jpg', 'Modeling', '2025-03-26 16:43:39'),
(762, 'modelling (16)', 'uploads/67e42ebb35a67_15.jpg', 'Modeling', '2025-03-26 16:43:39'),
(763, 'modelling (17)', 'uploads/67e42ebb38a22_16.jpg', 'Modeling', '2025-03-26 16:43:39'),
(764, 'modelling (18)', 'uploads/67e42ebb3bbbc_17.jpg', 'Modeling', '2025-03-26 16:43:39'),
(765, 'modelling (19)', 'uploads/67e42ebb3e7c9_18.jpg', 'Modeling', '2025-03-26 16:43:39'),
(766, 'modelling (20)', 'uploads/67e42ebb4133a_19.jpg', 'Modeling', '2025-03-26 16:43:39'),
(767, 'modeling (1)', 'uploads/67e42edda9087_0.jpg', 'Modeling', '2025-03-26 16:44:13'),
(768, 'modeling (2)', 'uploads/67e42eddabc8f_1.jpg', 'Modeling', '2025-03-26 16:44:13'),
(769, 'modeling (3)', 'uploads/67e42eddae67c_2.jpg', 'Modeling', '2025-03-26 16:44:13'),
(770, 'modeling (4)', 'uploads/67e42eddb078f_3.jpg', 'Modeling', '2025-03-26 16:44:13'),
(771, 'modeling (5)', 'uploads/67e42eddb2b62_4.jpg', 'Modeling', '2025-03-26 16:44:13'),
(772, 'modeling (6)', 'uploads/67e42eddb4ebc_5.jpg', 'Modeling', '2025-03-26 16:44:13'),
(773, 'modeling (7)', 'uploads/67e42eddb723b_6.jpg', 'Modeling', '2025-03-26 16:44:13'),
(774, 'modeling (8)', 'uploads/67e42eddb9263_7.jpg', 'Modeling', '2025-03-26 16:44:13'),
(775, 'modeling (9)', 'uploads/67e42eddbb48a_8.jpg', 'Modeling', '2025-03-26 16:44:13'),
(776, 'modeling (10)', 'uploads/67e42eddbd5bd_9.jpg', 'Modeling', '2025-03-26 16:44:13'),
(777, 'modeling (11)', 'uploads/67e42eddbf8f3_10.jpg', 'Modeling', '2025-03-26 16:44:13'),
(778, 'child (1)', 'uploads/67e42efc589c9_0.jpg', 'Child', '2025-03-26 16:44:44'),
(779, 'child (2)', 'uploads/67e42efc5bfe9_1.jpg', 'Child', '2025-03-26 16:44:44'),
(780, 'child (3)', 'uploads/67e42efc60c59_2.jpg', 'Child', '2025-03-26 16:44:44'),
(781, 'child (4)', 'uploads/67e42efc6687d_3.jpg', 'Child', '2025-03-26 16:44:44'),
(782, 'child (5)', 'uploads/67e42efc6bf14_4.jpg', 'Child', '2025-03-26 16:44:44'),
(783, 'child (6)', 'uploads/67e42efc71965_5.jpg', 'Child', '2025-03-26 16:44:44'),
(784, 'child (7)', 'uploads/67e42efc76edb_6.jpg', 'Child', '2025-03-26 16:44:44'),
(785, 'child (8)', 'uploads/67e42efc7d214_7.jpg', 'Child', '2025-03-26 16:44:44'),
(786, 'child (9)', 'uploads/67e42efc828fe_8.jpg', 'Child', '2025-03-26 16:44:44'),
(787, 'child (10)', 'uploads/67e42efc87f06_9.jpg', 'Child', '2025-03-26 16:44:44'),
(788, 'child (11)', 'uploads/67e42efc8d8ea_10.jpg', 'Child', '2025-03-26 16:44:44'),
(789, 'child (12)', 'uploads/67e42efc939ad_11.jpg', 'Child', '2025-03-26 16:44:44'),
(790, 'child (13)', 'uploads/67e42efc99330_12.jpg', 'Child', '2025-03-26 16:44:44'),
(791, 'child (14)', 'uploads/67e42efc9ed92_13.jpg', 'Child', '2025-03-26 16:44:44'),
(792, 'child (15)', 'uploads/67e42efca4432_14.jpg', 'Child', '2025-03-26 16:44:44'),
(793, 'child (16)', 'uploads/67e42efca9c5d_15.jpg', 'Child', '2025-03-26 16:44:44'),
(794, 'child (17)', 'uploads/67e42efcaf642_16.jpg', 'Child', '2025-03-26 16:44:44'),
(795, 'child (18)', 'uploads/67e42efcb4e2b_17.jpg', 'Child', '2025-03-26 16:44:44'),
(796, 'child (19)', 'uploads/67e42efcba9a1_18.jpg', 'Child', '2025-03-26 16:44:44'),
(797, 'child (20)', 'uploads/67e42efcc0563_19.jpg', 'Child', '2025-03-26 16:44:44'),
(798, 'child (1)', 'uploads/67e42f1a7b1b9_0.jpg', 'Child', '2025-03-26 16:45:14'),
(799, 'child (2)', 'uploads/67e42f1a7dee4_1.jpg', 'Child', '2025-03-26 16:45:14'),
(800, 'child (3)', 'uploads/67e42f1a8070f_2.jpg', 'Child', '2025-03-26 16:45:14'),
(801, 'child (4)', 'uploads/67e42f1a83042_3.jpg', 'Child', '2025-03-26 16:45:14'),
(802, 'child (5)', 'uploads/67e42f1a85910_4.jpg', 'Child', '2025-03-26 16:45:14'),
(803, 'child (6)', 'uploads/67e42f1a881c9_5.jpg', 'Child', '2025-03-26 16:45:14'),
(804, 'product (1)', 'uploads/67e42f3a044c1_0.jpg', 'Product', '2025-03-26 16:45:46'),
(805, 'product (2)', 'uploads/67e42f3a07488_1.jpg', 'Product', '2025-03-26 16:45:46'),
(806, 'product (3)', 'uploads/67e42f3a09f53_2.jpg', 'Product', '2025-03-26 16:45:46'),
(807, 'product (4)', 'uploads/67e42f3a0cc62_3.jpg', 'Product', '2025-03-26 16:45:46'),
(808, 'product (5)', 'uploads/67e42f3a0f9ba_4.jpg', 'Product', '2025-03-26 16:45:46'),
(809, 'product (6)', 'uploads/67e42f3a137a7_5.jpg', 'Product', '2025-03-26 16:45:46'),
(810, 'product (7)', 'uploads/67e42f3a19c4e_6.jpg', 'Product', '2025-03-26 16:45:46'),
(811, 'product (8)', 'uploads/67e42f3a1fdc3_7.jpg', 'Product', '2025-03-26 16:45:46'),
(812, 'product (9)', 'uploads/67e42f3a255ed_8.jpg', 'Product', '2025-03-26 16:45:46'),
(813, 'product (10)', 'uploads/67e42f3a2b949_9.jpg', 'Product', '2025-03-26 16:45:46'),
(814, 'product (11)', 'uploads/67e42f3a3109c_10.jpg', 'Product', '2025-03-26 16:45:46'),
(815, 'product (12)', 'uploads/67e42f3a36c7d_11.jpg', 'Product', '2025-03-26 16:45:46'),
(816, 'product (13)', 'uploads/67e42f3a3c853_12.jpg', 'Product', '2025-03-26 16:45:46'),
(817, 'product (14)', 'uploads/67e42f3a41ed4_13.jpg', 'Product', '2025-03-26 16:45:46'),
(818, 'product (15)', 'uploads/67e42f3a49a97_14.jpg', 'Product', '2025-03-26 16:45:46'),
(819, 'product (16)', 'uploads/67e42f3a4faa0_15.jpg', 'Product', '2025-03-26 16:45:46'),
(820, 'product (17)', 'uploads/67e42f3a54e97_16.jpg', 'Product', '2025-03-26 16:45:46'),
(821, 'product (18)', 'uploads/67e42f3a5a8da_17.jpg', 'Product', '2025-03-26 16:45:46'),
(822, 'product (19)', 'uploads/67e42f3a604fe_18.jpg', 'Product', '2025-03-26 16:45:46'),
(823, 'product (20)', 'uploads/67e42f3a65f57_19.jpg', 'Product', '2025-03-26 16:45:46'),
(824, 'family (1)', 'uploads/67e42f6624519_0.jpg', 'Family', '2025-03-26 16:46:30'),
(825, 'family (2)', 'uploads/67e42f6627a25_1.jpg', 'Family', '2025-03-26 16:46:30'),
(826, 'family (3)', 'uploads/67e42f662b34c_2.jpg', 'Family', '2025-03-26 16:46:30'),
(827, 'family (4)', 'uploads/67e42f662ee38_3.jpg', 'Family', '2025-03-26 16:46:30'),
(828, 'family (5)', 'uploads/67e42f6631e10_4.jpg', 'Family', '2025-03-26 16:46:30'),
(829, 'family (6)', 'uploads/67e42f6634df2_5.jpg', 'Family', '2025-03-26 16:46:30'),
(830, 'family (7)', 'uploads/67e42f6637b60_6.jpg', 'Family', '2025-03-26 16:46:30'),
(831, 'family (8)', 'uploads/67e42f663aa1f_7.jpg', 'Family', '2025-03-26 16:46:30'),
(832, 'family (9)', 'uploads/67e42f663db9e_8.jpg', 'Family', '2025-03-26 16:46:30'),
(833, 'family (10)', 'uploads/67e42f664072b_9.jpg', 'Family', '2025-03-26 16:46:30'),
(834, 'family (11)', 'uploads/67e42f6642cc6_10.jpg', 'Family', '2025-03-26 16:46:30'),
(835, 'engagement (1)', 'uploads/67e42f862aec2_0.jpg', 'Engagement', '2025-03-26 16:47:02'),
(836, 'engagement (2)', 'uploads/67e42f862d652_1.jpg', 'Engagement', '2025-03-26 16:47:02'),
(837, 'engagement (3)', 'uploads/67e42f862f896_2.jpg', 'Engagement', '2025-03-26 16:47:02'),
(838, 'engagement (4)', 'uploads/67e42f86318fa_3.jpg', 'Engagement', '2025-03-26 16:47:02'),
(839, 'engagement (5)', 'uploads/67e42f86339f7_4.jpg', 'Engagement', '2025-03-26 16:47:02'),
(840, 'engagement (6)', 'uploads/67e42f8635ab0_5.jpg', 'Engagement', '2025-03-26 16:47:02'),
(841, 'engagement (7)', 'uploads/67e42f863809c_6.jpg', 'Engagement', '2025-03-26 16:47:02'),
(842, 'engagement (8)', 'uploads/67e42f863abb5_7.jpg', 'Engagement', '2025-03-26 16:47:02'),
(843, 'engagement (9)', 'uploads/67e42f863d88a_8.jpg', 'Engagement', '2025-03-26 16:47:02'),
(844, 'engagement (10)', 'uploads/67e42f8640a16_9.jpg', 'Engagement', '2025-03-26 16:47:02'),
(845, 'engagement (11)', 'uploads/67e42f86437d9_10.jpg', 'Engagement', '2025-03-26 16:47:02'),
(846, 'engagement (12)', 'uploads/67e42f8646589_11.jpg', 'Engagement', '2025-03-26 16:47:02'),
(847, 'engagement (13)', 'uploads/67e42f86495ea_12.jpg', 'Engagement', '2025-03-26 16:47:02'),
(848, 'engagement (14)', 'uploads/67e42f864c350_13.jpg', 'Engagement', '2025-03-26 16:47:02'),
(849, 'engagement (15)', 'uploads/67e42f864f0c3_14.jpg', 'Engagement', '2025-03-26 16:47:02'),
(850, 'engagement (16)', 'uploads/67e42f8651acd_15.jpg', 'Engagement', '2025-03-26 16:47:02'),
(851, 'engagement (17)', 'uploads/67e42f86548a0_16.jpg', 'Engagement', '2025-03-26 16:47:02'),
(852, 'engagement (18)', 'uploads/67e42f8657401_17.jpg', 'Engagement', '2025-03-26 16:47:02'),
(853, 'engagement (19)', 'uploads/67e42f8659f03_18.jpg', 'Engagement', '2025-03-26 16:47:02'),
(854, 'prewedding (1)', 'uploads/67e4314e65712_0.jpg', 'Pre-Wedding', '2025-03-26 16:54:38'),
(855, 'prewedding (2)', 'uploads/67e4314e6734e_1.jpg', 'Pre-Wedding', '2025-03-26 16:54:38'),
(856, 'prewedding (1)', 'uploads/67e4319521d95_0.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(857, 'prewedding (2)', 'uploads/67e4319523c4d_1.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(858, 'prewedding (3)', 'uploads/67e4319525312_2.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(859, 'prewedding (4)', 'uploads/67e4319526c7e_3.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(860, 'prewedding (5)', 'uploads/67e43195284b9_4.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(861, 'prewedding (6)', 'uploads/67e431952a081_5.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(862, 'prewedding (7)', 'uploads/67e431952b839_6.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(863, 'prewedding (8)', 'uploads/67e431952d30f_7.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(864, 'prewedding (9)', 'uploads/67e431952eb72_8.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(865, 'prewedding (10)', 'uploads/67e431953060c_9.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(866, 'prewedding (11)', 'uploads/67e431953200b_10.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(867, 'prewedding (12)', 'uploads/67e4319533850_11.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(868, 'prewedding (13)', 'uploads/67e43195350c4_12.jpg', 'Pre-Wedding', '2025-03-26 16:55:49'),
(870, 'modeling', 'uploads/67e4c0a766456_0.jpg', 'Modeling', '2025-03-27 03:06:15'),
(878, 'products (1)', 'uploads/67f8a3fece3bd_0.jpg', 'Product', '2025-04-11 05:09:18'),
(879, 'products (2)', 'uploads/67f8a3fed22bf_1.jpg', 'Product', '2025-04-11 05:09:18'),
(880, 'products (3)', 'uploads/67f8a3fed5f44_2.jpg', 'Product', '2025-04-11 05:09:18'),
(881, 'wedding (1)', 'uploads/67f8c5354d143_0.jpg', 'Portraits', '2025-04-11 07:31:01'),
(882, 'wedding (2)', 'uploads/67f8c535581ee_1.jpg', 'Portraits', '2025-04-11 07:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Pay_id` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `E_ID` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Pay_Status` varchar(20) NOT NULL DEFAULT 'pending',
  `Method` varchar(20) NOT NULL,
  `Pay_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Pay_id`, `U_ID`, `E_ID`, `Amount`, `Pay_Status`, `Method`, `Pay_date`) VALUES
(1, 1, 5, 399.00, 'success', '0', '2025-03-24'),
(2, 1, 12, 999.00, 'success', '0', '2025-03-25'),
(3, 1, 13, 2999.00, 'success', '0', '2025-03-25'),
(4, 1, 15, 1799.00, 'success', '0', '2025-03-25'),
(5, 6, 16, 1799.00, 'success', '0', '2025-03-25'),
(6, 6, 17, 2999.00, 'success', '0', '2025-03-25'),
(7, 6, 18, 2999.00, 'success', '0', '2025-03-26'),
(8, 5, 19, 2999.00, 'success', '0', '2025-03-26'),
(9, 5, 20, 2999.00, 'success', '0', '2025-03-26'),
(10, 5, 21, 999.00, 'success', '0', '2025-03-26'),
(11, 5, 4, 3499.00, 'success', '0', '2025-03-26'),
(12, 8, 5, 3499.00, 'success', '0', '2025-03-26'),
(13, 9, 6, 3499.00, 'success', '0', '2025-03-26'),
(14, 9, 7, 3499.00, 'success', '0', '2025-03-27'),
(15, 9, 8, 2499.00, 'success', '0', '2025-03-27'),
(16, 14, 9, 3499.00, 'success', '0', '2025-03-28'),
(17, 17, 10, 3499.00, 'success', '0', '2025-03-30'),
(18, 16, 11, 3499.00, 'success', '0', '2025-04-04'),
(19, 17, 12, 3499.00, 'success', '0', '2025-04-05'),
(20, 18, 13, 3499.00, 'success', '0', '2025-04-10'),
(21, 19, 15, 3499.00, 'success', '0', '2025-04-11'),
(22, 19, 16, 1499.00, 'success', '0', '2025-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `photographer`
--

CREATE TABLE `photographer` (
  `U_ID` int(11) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Phone_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_requests`
--

CREATE TABLE `photo_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_paths` text NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo_requests`
--

INSERT INTO `photo_requests` (`id`, `user_id`, `photo_paths`, `message`, `status`, `created_at`, `updated_at`) VALUES
(11, 15, '[\"uploads\\/67e43367007cf_0.png\"]', 'album create', 'approved', '2025-03-29 08:11:25', '2025-03-29 08:11:40'),
(12, 15, '[\"uploads\\/67e6647db7f26_0.png\",\"uploads\\/67e4c0a766456_0.jpg\"]', 'awesome photography', 'approved', '2025-03-29 10:52:59', '2025-03-29 10:53:13'),
(13, 16, '[\"uploads\\/67e7aba0477aa_0.png\",\"uploads\\/67e42f1a7dee4_1.jpg\",\"uploads\\/67e42efc60c59_2.jpg\"]', 'for album', 'approved', '2025-03-30 02:20:16', '2025-03-30 02:20:46'),
(14, 17, '[\"uploads\\/67e7aba0477aa_0.png\"]', 'ugugy', 'approved', '2025-03-30 15:47:48', '2025-03-30 15:48:14'),
(15, 16, '[\"uploads\\/67e4319525312_2.jpg\",\"uploads\\/67e4319523c4d_1.jpg\"]', 'egegg', 'approved', '2025-04-04 17:03:29', '2025-04-04 17:03:40'),
(16, 17, '[\"uploads\\/67e7aba0477aa_0.png\",\"uploads\\/67e43367007cf_0.png\"]', 'fgftfgt', 'approved', '2025-04-05 03:56:11', '2025-04-05 03:56:36'),
(17, 18, '[\"uploads\\/67f0aa1866017_0.png\",\"uploads\\/67f011063d17a_0.png\",\"uploads\\/67e7aba0477aa_0.png\"]', 'photos for frame', 'approved', '2025-04-10 13:41:49', '2025-04-10 13:41:59'),
(18, 19, '[\"uploads\\/67e4319521d95_0.jpg\",\"uploads\\/67e431952b839_6.jpg\",\"uploads\\/67e431952a081_5.jpg\",\"uploads\\/67e431953200b_10.jpg\",\"uploads\\/67e4319525312_2.jpg\"]', 'i want frame of this photos', 'approved', '2025-04-11 05:10:25', '2025-04-11 05:10:36'),
(19, 19, '[\"uploads\\/67f8a3fed22bf_1.jpg\",\"uploads\\/67f8a3fece3bd_0.jpg\",\"uploads\\/67f8a3fed5f44_2.jpg\"]', 'album', 'approved', '2025-04-11 07:29:55', '2025-04-11 07:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `selectedphotos`
--

CREATE TABLE `selectedphotos` (
  `selection_id` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `SelectedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `selectedphotos_details`
--

CREATE TABLE `selectedphotos_details` (
  `selection_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_albums`
--

CREATE TABLE `user_albums` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `sent_by_admin_id` int(11) NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_albums`
--

INSERT INTO `user_albums` (`id`, `user_id`, `image_id`, `sent_by_admin_id`, `sent_date`) VALUES
(341, 15, 870, 1, '2025-03-29 10:52:04'),
(343, 15, 870, 1, '2025-03-29 10:53:13'),
(345, 16, 799, 1, '2025-03-30 02:19:51'),
(346, 16, 780, 1, '2025-03-30 02:19:51'),
(347, 16, 781, 1, '2025-03-30 02:19:51'),
(348, 16, 783, 1, '2025-03-30 02:19:51'),
(349, 16, 784, 1, '2025-03-30 02:19:51'),
(350, 16, 785, 1, '2025-03-30 02:19:51'),
(352, 16, 799, 1, '2025-03-30 02:20:46'),
(353, 16, 780, 1, '2025-03-30 02:20:46'),
(355, 17, 859, 1, '2025-03-30 15:47:23'),
(357, 16, 857, 1, '2025-04-04 17:02:25'),
(358, 16, 858, 1, '2025-04-04 17:02:25'),
(359, 16, 858, 1, '2025-04-04 17:03:40'),
(360, 16, 857, 1, '2025-04-04 17:03:40'),
(369, 18, 870, 1, '2025-04-10 13:39:18'),
(371, 18, 856, 1, '2025-04-10 13:39:18'),
(372, 18, 857, 1, '2025-04-10 13:39:18'),
(373, 18, 858, 1, '2025-04-10 13:39:18'),
(378, 19, 856, 1, '2025-04-11 05:08:15'),
(379, 19, 857, 1, '2025-04-11 05:08:15'),
(380, 19, 858, 1, '2025-04-11 05:08:15'),
(381, 19, 860, 1, '2025-04-11 05:08:15'),
(382, 19, 861, 1, '2025-04-11 05:08:15'),
(383, 19, 862, 1, '2025-04-11 05:08:15'),
(384, 19, 863, 1, '2025-04-11 05:08:15'),
(385, 19, 865, 1, '2025-04-11 05:08:15'),
(386, 19, 866, 1, '2025-04-11 05:08:15'),
(387, 19, 867, 1, '2025-04-11 05:08:15'),
(388, 19, 856, 1, '2025-04-11 05:10:36'),
(389, 19, 862, 1, '2025-04-11 05:10:36'),
(390, 19, 861, 1, '2025-04-11 05:10:36'),
(391, 19, 866, 1, '2025-04-11 05:10:36'),
(392, 19, 858, 1, '2025-04-11 05:10:36'),
(393, 19, 878, 1, '2025-04-11 07:29:18'),
(394, 19, 879, 1, '2025-04-11 07:29:18'),
(395, 19, 880, 1, '2025-04-11 07:29:18'),
(396, 19, 870, 1, '2025-04-11 07:29:18'),
(397, 19, 879, 1, '2025-04-11 07:30:21'),
(398, 19, 878, 1, '2025-04-11 07:30:21'),
(399, 19, 880, 1, '2025-04-11 07:30:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `security_answer` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `wallet_balance` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `security_answer`, `image`, `wallet_balance`) VALUES
(15, 'Radhika Paramar', 'radha@gmail.com', '0280a430e35fee634f01cbc5a8178864', 'pink', 'c11.jpg', 0.00),
(16, 'Rajat Baraiya', 'rajatbaraiya26@gmail.com', '93279e3308bdbbeed946fc965017f67a', 'black', 'Screenshot (14).png', 0.00),
(17, 'dhairya', 'dhairya0331@gmail.com', 'ed798f8422b27e744cededabf35c9c23', 'pink', 'Screenshot (3).png', 6998.00),
(18, 'prakash', 'pako@gmail.com', '3c527bee5820275fb36a388d49ee1152', 'black', 'Screenshot (3).png', 3499.00),
(19, 'Rajt', 'rajatbaraiya18@gmail.com', 'a45e1d4532220c34b4c1aba189a93bc4', 'black', 'IMG_20230615_083555 - Copy.jpg', 3499.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`E_ID`),
  ADD KEY `U_ID` (`U_ID`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Pay_id`),
  ADD KEY `U_ID` (`U_ID`),
  ADD KEY `E_ID` (`E_ID`);

--
-- Indexes for table `photographer`
--
ALTER TABLE `photographer`
  ADD PRIMARY KEY (`U_ID`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone_no` (`Phone_no`);

--
-- Indexes for table `photo_requests`
--
ALTER TABLE `photo_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `selectedphotos`
--
ALTER TABLE `selectedphotos`
  ADD PRIMARY KEY (`selection_id`),
  ADD KEY `U_ID` (`U_ID`);

--
-- Indexes for table `selectedphotos_details`
--
ALTER TABLE `selectedphotos_details`
  ADD PRIMARY KEY (`selection_id`,`photo_id`);

--
-- Indexes for table `user_albums`
--
ALTER TABLE `user_albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `sent_by_admin_id` (`sent_by_admin_id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `E_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=883;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `photographer`
--
ALTER TABLE `photographer`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_requests`
--
ALTER TABLE `photo_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `selectedphotos`
--
ALTER TABLE `selectedphotos`
  MODIFY `selection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_albums`
--
ALTER TABLE `user_albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photo_requests`
--
ALTER TABLE `photo_requests`
  ADD CONSTRAINT `photo_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_albums`
--
ALTER TABLE `user_albums`
  ADD CONSTRAINT `user_albums_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_form` (`id`),
  ADD CONSTRAINT `user_albums_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `gallery` (`id`),
  ADD CONSTRAINT `user_albums_ibfk_3` FOREIGN KEY (`sent_by_admin_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
