-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 05:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `section_title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `section_title`, `description`, `email`, `phone`, `location`, `created_at`) VALUES
(2, 'Ways to Connect', 'Feel free to reach out via phone or email for academic inquiries, collaborations, or internship opportunities.', 'akt.ramirez@gmail.com', '+63-936-467-5727', 'Baliwasan Billiard Drive, Zamboanga City, Philippines', '2025-05-12 14:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_links`
--

CREATE TABLE `contact_links` (
  `id` int(11) NOT NULL,
  `platform_name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `icon_class` varchar(100) DEFAULT NULL,
  `contact_info_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_section`
--

CREATE TABLE `hero_section` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hero_section`
--

INSERT INTO `hero_section` (`id`, `image_path`, `heading`, `description`, `name`) VALUES
(1, 'uploads/profile.jpg', 'An Aspiring Developer', 'Hi! I am Adel Kristan Ramirez. I’m a 21-year-old IT student who enjoys coding, working out at home, and slowly grinding through Japanese lessons. That is why my design is related to cherry blossoms LOL. This portfolio is a collection of projects I&#39;ve worked on, both for school and personal growth. I&#39;m still learning ,  but every project here reflects the kind of work I aim to level up from.', 'Adel Kristan M. Ramirez');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `created_at`) VALUES
(2, 'test', '$2y$10$wA359w9/YUHy2wRPF1cAQOrvRv1VPefjhjXJTApMiohfkspMp6P7K', '2025-04-23 15:58:34'),
(3, 'test2', '$2y$10$2w4/pq9byDji/eNzSNwFoehePqKCUy7901yBeEM4TQjYsRxtTxMIu', '2025-04-23 16:02:28'),
(4, 'admin@gmail.com', '$2y$10$aFIpibBvmeSiTiSvOSIuY.ljX/gdc9cIb5Q094eztxFjgyl6eJH1e', '2025-04-24 11:11:45'),
(5, 'Adel', '$2y$10$HvYvzTQgfegrsjMl8DsRH.Aab3Qh3U6HxAyGzBnb28XWOz8amTGii', '2025-05-13 20:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `projects_section`
--

CREATE TABLE `projects_section` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `media_type` enum('image','video') NOT NULL,
  `media_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects_section`
--

INSERT INTO `projects_section` (`id`, `title`, `description`, `media_type`, `media_path`) VALUES
(6, 'AquaAction (Website)', 'Aqua Action is an interactive UI designed to promote awareness about the importance of water conservation. It combines modern design elements with natural features, making it easy for users to explore water-related challenges, solutions, and real-time data. ', 'image', 'uploads/projects/Screenshot 2025-04-24 212853.png'),
(7, 'LinggoHub (Application)', 'LinggoHub is a modern, user-friendly app designed to make learning Filipino languages accessible and engaging. The UI embraces vibrant, culturally inspired designs. It includes elements like word games, flashcards, and progress tracking to ensure a comprehensive learning experience. \r\n\r\n', 'image', 'uploads/projects/bc6c0b66-54cd-4203-a2f4-b2acf52ccaab.jpg'),
(8, 'Blue Thunder Agriventure (Website)', 'Blue Thunder Agriventure is a dynamic platform for animal feeds and medicine suppliers. The UI is designed to streamline inventory management, order processing, and client communication. It features a clean, professional layout that emphasizes efficiency, with intuitive product listings, category filtering, and order tracking. This website is accessible online.', 'image', 'uploads/projects/Screenshot_2025-05-14_071028.png'),
(10, 'My Portfolio (Webite)', 'The Portfolio UI is a personalized showcase of creative projects and professional achievements. It highlights each project with great visuals, smooth animations, and engaging interactions.', 'image', 'uploads/projects/portfolio.jpg'),
(12, 'Space Mission Log ', 'My vision with this website was to make a news relating to space mission because I really have a huge fascination with learning about the cosmos.', 'image', 'uploads/projects/space.jpg'),
(13, 'Personal Kanji Manager ', 'In this, I created a similar themed website and it&#39;s all about learning Kanji which is a 日本語 (Japanese) alphabet since I&#39;m learning the Language, why not make connect it to coding? :D', 'image', 'uploads/projects/kanji.jpg'),
(14, 'Dashboard ', 'This was an activity where we made a dashboard.', 'image', 'uploads/projects/dashboard.jpg'),
(15, 'SADWASAFD', 'FAWFDA', 'image', 'uploads/projects/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `resume_section`
--

CREATE TABLE `resume_section` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume_section`
--

INSERT INTO `resume_section` (`id`, `title`, `content`, `icon`) VALUES
(13, 'Languages', 'Filipino (Native) – Great written and spoken communication, including formal and informal contexts. Mildly good in technical writing and project collaboration.\r\n\r\nChavacano (Native) – Good in both conversational and professional use. Strong cultural understanding for effective communication.\r\n\r\nEnglish (Fluent) – Proficient in technical documentation, presentations, and collaborative work in diverse teams.\r\n\r\nJapanese (Beginner) – Basic reading, writing, and conversational skills. Actively expanding vocabulary and grammar through self-study and practice.', '🌐'),
(14, 'Education', 'I study at Western Mindanao State University (WMSU), Zamboanga City\r\nBachelor of Science in Information Technology (BSIT) — 3rd Year', '🎓'),
(15, 'Soft-Skills', 'Active Listening – I pay close attention to others and ensure I understand their points before responding.\r\n\r\nReliability – I can be counted on to complete tasks accurately and on time, even when working independently.\r\n\r\nAdaptability – I adjust to changes in the work environment or team dynamics, and I’m always open to learning new things.', '📝'),
(16, 'Certifications', 'Currently working towards certifications in areas such as programming, web development, and data analysis to further enhance technical skills and knowledge in Information Technology.', '📃');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_links`
--
ALTER TABLE `contact_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_info_id` (`contact_info_id`);

--
-- Indexes for table `hero_section`
--
ALTER TABLE `hero_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `projects_section`
--
ALTER TABLE `projects_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_section`
--
ALTER TABLE `resume_section`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_links`
--
ALTER TABLE `contact_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_section`
--
ALTER TABLE `hero_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects_section`
--
ALTER TABLE `projects_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `resume_section`
--
ALTER TABLE `resume_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_links`
--
ALTER TABLE `contact_links`
  ADD CONSTRAINT `contact_links_ibfk_1` FOREIGN KEY (`contact_info_id`) REFERENCES `contact_info` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
