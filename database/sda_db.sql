-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql307.infinityfree.com
-- Generation Time: Sep 04, 2024 at 03:53 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36995740_SDA`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'sda@admin', 'sda123');

-- --------------------------------------------------------

--
-- Table structure for table `fb_embeds`
--

CREATE TABLE `fb_embeds` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `embed_code` varchar(999) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fb_embeds`
--

INSERT INTO `fb_embeds` (`id`, `category`, `embed_code`) VALUES
(2, 'news', '<iframe src=\"https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FSDAFinancialAdvisors%2Fposts%2Fpfbid02iJGTS8MoPfEn2Bmq31yvSS7oC5shbB9G1cUGA6rN9vPMG7ZUe7o2rkkogPxdtzP6l&show_text=true&width=500\" width=\"500\" height=\"728\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share\"></iframe>'),
(3, 'events', '<iframe src=\"https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FSDAFinancialAdvisors%2Fposts%2Fpfbid02LMyDCHLVj89zrHX1WZGzufVukge1rBGRu577HyvBS9zaszbuBGKe2Eq4wNjPj48hl&show_text=true&width=500\" width=\"500\" height=\"518\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share\"></iframe>'),
(4, 'achievements', '<iframe src=\"https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FSDAFinancialAdvisors%2Fposts%2Fpfbid0VbY7wPTRtATKhkyVuVRosJS3jdD1F7wRnsGMW9cz15Ac3wvEzhVoJUYg8WGPRuhsl&show_text=true&width=500\" width=\"500\" height=\"645\" style=\"border:none;overflow:hidden\" scrolling=\"no\" frameborder=\"0\" allowfullscreen=\"true\" allow=\"autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(128) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `category`, `name`, `filename`) VALUES
(24, 'makati', 'Gregoio Tongko', 'Gregorio_Tongko_Red.png'),
(25, 'bohol', 'Adoracion Penales', 'Adoracion_Penales_Red.png'),
(32, 'cebu', 'Lily Beth dela Cruz', 'Lily_Beth_dela_Cruz.png'),
(29, 'pampanga', 'Herminia Perez', 'Herminia_Perez_Red.png'),
(22, 'makati', 'Marilyn Rotap', 'Marilyn_Rotap_UnitManager.png'),
(30, 'pampanga', 'Edna Liza Damaso', 'Edna_LizaDamaso_REd.png'),
(31, 'makati', 'Edna Liza Damaso', 'Edna_LizaDamaso_.png');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `category`, `name`, `filename`) VALUES
(95, 'Edna Liza Damaso - P', 'Mary Grace Reyes', 'Mary_Grace_Reyes_Re.png'),
(94, 'Herminia Perez', 'Thelma Carlos', 'Thelma_Carlos_Red.png'),
(126, 'Lily Beth dela Cruz', 'Keith Vincent Burca', 'Keith_Vincent_Burca.png'),
(63, 'Marilyn Rotap', 'Justin Ray Rotap', 'Justin_Ray_Rotap.png'),
(93, 'Herminia Perez', 'Lilia Ressurection Perez', 'Lilia_Resurrection_Perez_Red.png'),
(11, '', 'Ramilyn Cagampang', 'Ramilyn_Cagampang.jpg'),
(86, 'Adoracion Penales', 'Eulalia Lampira', 'Eulalia_Lampira_Red.png'),
(85, 'Adoracion Penales', 'Claudia Fuentes', 'Claudia_Fuentes_Red.png'),
(134, 'Lily Beth dela Cruz', 'Letecia Davilla', 'Letecia_Davilla_Red.png'),
(84, 'Adoracion Penales', 'Chevyneil Chavez', 'Chevyneil_Chavez_Red.png'),
(83, 'Adoracion Penales', 'Adelina Mantilla', 'Adelina_Mantilla_Red.png'),
(82, 'Gregoio Tongko', 'Rene Cristina Cuartero', 'Rene_Cristina_Cuartero_Red.png'),
(81, 'Gregoio Tongko', 'Patricia Sardalla', 'Patricia_Sardalla_Red.png'),
(80, 'Gregoio Tongko', 'Merla dela Cruz', 'Merla_dela_Cruz_Red.png'),
(92, 'Herminia Perez', 'Cipriano Dalupang', 'Cipriano_Dalupang_Red.png'),
(91, 'Herminia Perez', 'Angelita Mandani', 'Angelita_Mandani_Red.png'),
(90, 'Edna Liza Damaso - P', 'Ma Wilma Joaquin', 'Ma_Wilma_Joaquin_Re.png'),
(89, 'Edna Liza Damaso - P', 'Ma Wilma Joaquin', 'Ma_Wilma_Joaquin.png'),
(77, 'Gregoio Tongko', 'Anna Marie Manalo', 'Anna_Marie_Manalo_Red.png'),
(78, 'Gregoio Tongko', 'Edna Parreno', 'Edna_Parreno_Red.png'),
(79, 'Gregoio Tongko', 'Marilou Cabatuando', 'Marilou_Cabatuando_Re.png'),
(133, 'Lily Beth dela Cruz', 'Ma Josefa Lucero', 'Ma_Josefa_David_Lucero_Red.png'),
(131, 'Lily Beth dela Cruz', 'Jeshel Villaver', 'Jeshel_Villaver_Red.png'),
(132, 'Lily Beth dela Cruz', 'Josefino Yocte', 'Josefino_Yocte_Red.png'),
(130, 'Lily Beth dela Cruz', 'Ryan Baguio', 'Ryan_Baguio_Red.png'),
(129, 'Lily Beth dela Cruz', 'Rudiville Cabrales', 'Rudiville_Cabrales_Red.png'),
(127, 'Lily Beth dela Cruz', 'Jerah Tanudra', 'Jerah_Tanudra_Red.png'),
(128, 'Lily Beth dela Cruz', 'Marilou Villamor', 'Marilou_Villamor_Red.png'),
(87, 'Adoracion Penales', 'Gerissa Gia Comahig', 'Gerissa_Gia_Comahig_Red.png'),
(88, 'Adoracion Penales', 'Narcisa Comahig', 'Narcisa_Comahig_Red.png'),
(96, 'Edna Liza Damaso', 'Ermina Pantasan', 'Ermina_Pantasan_Red.png'),
(97, 'Edna Liza Damaso', 'Josefino Sto Domingo', 'Josefino_Sto_Domingo.png'),
(98, 'Edna Liza Damaso', 'Portia Sto Domingo', 'Portia_StoDomingo.png'),
(99, 'Edna Liza Damaso', 'Patrick Arce', 'Patrick_Arce.png'),
(100, 'Edna Liza Damaso', 'Michelle Arce', 'Michelle_Arce_Red.png'),
(101, 'Edna Liza Damaso', 'Maria Elena Ocampo', 'Maria_Elena_Ocampo_Red.png'),
(102, 'Edna Liza Damaso', 'Merle Rivera', 'Merle_Rivera_Red.png'),
(103, 'Edna Liza Damaso', 'Joanne Ricamata', 'Joanne_Mendoza_Ricamata_Red.png'),
(104, 'Edna Liza Damaso', ' Ma Wilma Joaquin', 'Ma_WilmaJoaquin.png'),
(105, 'Edna Liza Damaso', 'Mary Grace Reyes', 'Mary_GraceReyes.png'),
(125, 'Lily Beth dela Cruz', 'Jhadien Heyrosa', 'Jhadien_Heyrosa.png'),
(124, 'Lily Beth dela Cruz', 'Gabriel Barroso', 'Gabriel_Barroso.png'),
(110, 'Marilyn Rotap', 'Jayve Joshua dela Cruz', 'Jayve_Joshua_dela_Cruz.png'),
(111, 'Edna Liza Damaso', 'Pio Arugay', 'Pio_Arugay.png'),
(113, 'Gregoio Tongko', 'Ana Margarita Tongko', 'Ana_Margarita_Tongko.png'),
(114, 'Gregoio Tongko', 'Maria Georgette Tan', 'Maria_Georgette_Tan.png'),
(122, 'Lily Beth dela Cruz', 'Jocyln Aurelio', 'Jocyln_Aurelio_Red.png'),
(116, 'Marilyn Rotap', 'Ma Aurora Papa', 'Ma_Aurora_Papa.png'),
(123, 'Lily Beth dela Cruz', 'Ramilyn Cagampang', 'Ramilyn_Cagampang.png'),
(120, 'Edna Liza Damaso', 'Rosario Almario', 'Rosario_Almario.png'),
(121, 'Edna Liza Damaso', 'Mary Anne Sarte', 'Female_SDA_Placeholder.png'),
(135, 'Lily Beth dela Cruz', 'Jessy Rigor', 'Male_SDA_Placeholder.png'),
(136, 'Lily Beth dela Cruz', 'Ivy Alo', 'Female_SDA_Placeholder_1.png'),
(137, 'Lily Beth dela Cruz', 'Shirly Tan', 'Female_SDA_Placeholder_2.png'),
(138, 'Adoracion Penales', 'Joni Mae Apit', 'Female_SDA_Placeholder_3.png'),
(139, 'Herminia Perez', 'Teresita See', 'Female_SDA_Placeholder_4.png'),
(140, 'Herminia Perez', 'Marjorie Manaloto', 'Female_SDA_Placeholder_5.png'),
(141, 'Herminia Perez', 'Elyssa Capulong', 'Female_SDA_Placeholder_7.png'),
(142, 'Gregoio Tongko', 'Gaudelia Villanueva', 'Female_SDA_Placeholder_8.png'),
(143, 'Gregoio Tongko', 'Helena Tack', 'Female_SDA_Placeholder_9.png'),
(144, 'Gregoio Tongko', 'Recel Manalang', 'Female_SDA_Placeholder_10.png'),
(145, 'Gregoio Tongko', 'Jan Erick Lugo', 'Male_SDA_Placeholder_1.png'),
(146, 'Gregoio Tongko', 'Jose Martin Bertol', 'Male_SDA_Placeholder_2.png'),
(147, 'Gregoio Tongko', 'Elvira Aquino', 'Female_SDA_Placeholder_11.png'),
(148, 'Gregoio Tongko', 'Hedy Bautista', 'Female_SDA_Placeholder_12.png'),
(149, 'Marilyn Rotap', 'Evelyn Limos', 'Female_SDA_Placeholder_13.png'),
(150, 'Marilyn Rotap', 'Ma Jessie Embol', 'Female_SDA_Placeholder_14.png'),
(151, 'Marilyn Rotap', 'Maria Fatima Domingo', 'Female_SDA_Placeholder_15.png'),
(152, 'Marilyn Rotap', 'Aristotle Amican', 'Male_SDA_Placeholder_3.png'),
(153, 'Edna Liza Damaso', 'Bernard Thelmo', 'Male_SDA_Placeholder_4.png'),
(154, 'Edna Liza Damaso', 'Chester Damaso', 'Male_SDA_Placeholder_5.png'),
(155, 'Edna Liza Damaso', 'Maria Victoria Lopez', 'Female_SDA_Placeholder_16.png'),
(156, 'Edna Liza Damaso', 'Visitacion Racpan', 'Female_SDA_Placeholder_17.png'),
(157, 'Edna Liza Damaso', 'Maricris Bernarte ', 'Female_SDA_Placeholder_18.png'),
(158, 'Edna Liza Damaso', 'Reynaldo Mallari', 'Male_SDA_Placeholder_6.png'),
(159, 'Edna Liza Damaso', 'Silvano Ortega', 'Male_SDA_Placeholder_7.png'),
(160, 'Edna Liza Damaso', 'Maria Fatima Rodriguez', 'Female_SDA_Placeholder_19.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `fb_embeds`
--
ALTER TABLE `fb_embeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fb_embeds`
--
ALTER TABLE `fb_embeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
