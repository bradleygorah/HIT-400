-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 28, 2021 at 01:45 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccination`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

DROP TABLE IF EXISTS `chatbot`;
CREATE TABLE IF NOT EXISTS `chatbot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queries` varchar(300) DEFAULT NULL,
  `replies` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `queries`, `replies`) VALUES
(1, 'hi|hello|hey|hy|how are you|ndeipi|zvirisei|murisei|hud|how are you doing|hi?|hello?|hey?|hy?|how are you?|ndeipi?|zvirisei?|murisei?|hud?|how are you doing?', 'hello,how are you?'),
(2, 'what is your name|what\'s your name|unonzani|unonzi ani|zita|name|your name|what is your name?|what\'s your name?|unonzani?|unonzi ani?|zita?|name?|your name?', 'My name is Maya.'),
(3, 'hi maya wasup|hi maya wasup?|wasup|wasup?|wasup maya|wasup maya?', 'I am well, thanks how are you doing today?'),
(4, 'I am good thanks|I am good thanks.|I am great.|great|I am great|well|I am well|good|I am good', 'That is awesome to hear. Do you want to check your next visit for tests and collection?'),
(5, 'hesi|wadii|apo|mukuita sei|hesi?|wadii?|apo?|mukuita sei?', 'zvirisei, ini ndiri bho.\r\n'),
(6, 'baby|immunisation|polio', 'My system allows me to monitor your baby for his/her immunisation program for such diseases as polio'),
(7, 'date|schedule|dte|scedul', NULL),
(8, 'whats your name?|whats your name|name|\r\n\r\n', 'my name is Maya, I am a immmunisation chatbot'),
(9, 'when is my next collection date|collection date|date|collection|when is my next collection date?|collection date?|date?|collection?', 'Click <a href=\'profile.php\' style=\'color:yellow\'>here</a> to check your next collection date or visit the home page.');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `collectionperiod` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `code`, `description`, `collectionperiod`, `status`, `date`) VALUES
(1, 'Course 1', 'ctq76781289j', 'medication is collected from the clinics after every 7 days ', 7, 1, '2021-06-17 08:30:13'),
(2, 'course 2\r\n', 'ji2j92u9u09', 'medication collected from the clinics after every 2 weeks ', 14, 1, '2021-06-25 10:42:06'),
(3, 'course 3', 'abcdef1234', 'medication is collected from the clinics after every 3 weeks', 21, 1, '2021-06-26 15:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attendee` int(11) DEFAULT NULL,
  `patient` int(11) DEFAULT NULL,
  `hospitalname` varchar(255) DEFAULT NULL,
  `checkups` varchar(500) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `lastdate` date DEFAULT NULL,
  `nextdate` date DEFAULT NULL,
  `course` int(11) DEFAULT NULL,
  `validation` int(11) DEFAULT NULL,
  `status` enum('waiting','visited','missed') DEFAULT NULL,
  `alert` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `attendee`, `patient`, `hospitalname`, `checkups`, `date`, `lastdate`, `nextdate`, `course`, `validation`, `status`, `alert`) VALUES
(5, NULL, 5, NULL, 'test', '2021-07-05', '2021-06-28', '2021-07-12', 1, 1, 'visited', 2),
(6, 5, 5, NULL, 'tapiwa you missed your collection', '2021-07-12', '2021-07-05', '2021-07-19', 1, 1, 'missed', 1),
(7, NULL, 5, NULL, NULL, '2021-07-19', '2021-07-12', '2021-07-26', 1, NULL, 'waiting', 1),
(8, NULL, 6, NULL, NULL, '2021-06-27', '2021-06-12', '2021-07-04', 1, NULL, 'waiting', 2),
(9, 8, 8, NULL, 'Thank you for collecting your medication, please make sure that you don&amp;#x2019;t skip the daily medication regime', '2021-07-02', '2021-06-20', '2021-07-09', 1, 1, 'visited', 1),
(10, NULL, 8, NULL, NULL, '2021-07-09', '2021-07-02', '2021-07-16', 1, NULL, 'waiting', 1),
(11, 8, 17, NULL, 'thank you for coming to collect your medication , please dont skip your daily medication routine', '2021-06-28', '2021-05-02', '2021-07-05', 1, 1, 'visited', 1),
(12, NULL, 17, NULL, NULL, '2021-07-05', '2021-06-28', '2021-07-12', 1, NULL, 'waiting', 1),
(13, NULL, 16, NULL, NULL, '2021-07-17', '2021-06-18', '2021-08-07', 3, NULL, 'waiting', 1),
(14, NULL, 18, NULL, NULL, '2021-07-04', '2021-06-25', '2021-07-11', 1, NULL, 'waiting', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tips`
--

DROP TABLE IF EXISTS `tips`;
CREATE TABLE IF NOT EXISTS `tips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` int(11) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `tip` text DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tips`
--

INSERT INTO `tips` (`id`, `course`, `title`, `tip`, `image`, `status`, `date`) VALUES
(1, 1, 'Follow doctors orders about your prescriptions', 'Follow doctors orders about your prescriptions. It is crucial to take your HIV medication exactly as prescribed by your doctor. Skipping even one day of medication can give the virus an opportunity to become resistant to the drugs, making them ineffective against the virus. Be sure to take prescriptions at the same time every day, and always have your medication with you so that if you are away from home, you wont have to miss a dose.', 'images/images173258789160d70e16e773e.jpg', 1, '2021-06-25 05:19:20'),
(2, 1, 'Exercise mind and body', 'Exercise mind and body. Physical and mental exercise can keep your mind and body strong. Regular physical exercise, such as walking, biking, running, swimming, or another activity you enjoy, keeps you physically fit and can keep both stress and depression in check. Physical exercise significantly helps the immune system as well. Mental exercise ,doing a daily crossword puzzle or playing brain-challenging games can help maintain your cognitive health. Exercise your memory, concentration, and attention, all of which can be affected by HIV.', 'images/images106058251560d730fd80680.png', 1, '2021-06-25 10:22:36'),
(3, 2, 'avoid drug abuse', 'Don\'t abuse drugs or alcohol. Alcohol and drug overuse can contribute to feelings of depression. Avoid illegal drugs and take prescription drugs as directed by your doctor to help protect your immune system. Avoiding drug abuse can also help to prevent cognitive (thinking and reasoning) impairment, which is important in minimizing HIV-related dementia.', 'images/images158500739760d729e25ce02.png', 1, '2021-06-25 10:50:56'),
(4, 3, 'Get tested for other STDs', ' Get tested for other STDs. If you have another STD, also known as sexually transmitted infections, or STIs, you may be more likely to transmit both HIV and your other STD to someone else. STDs can also worsen HIV and make the disease progress more rapidly. And HIV can make STDs more difficult to treat, so you&rsquo;ll want to address an STD as soon as possible. Getting tested is a must because many STDs don&amp;#x2019;t cause any symptoms &mdash; without testing, you may not even realize you have one.', 'images/images196621182560d732ff1422b.jpg', 1, '2021-06-26 16:00:31'),
(5, 2, 'Practice safe sex', ' Practice safe sex. This is paramount on the list. Says Dr. Englund, &quot;Practicing safe sex is essential.&rdquo; Understand how the virus is transmitted to reduce the risk of infecting others. Use condoms not only to avoid the spread of HIV, but also to protect both you and your partner against other sexually transmitted diseases (STDs) and other types of infections.', 'images/images146395241560d73db4b8dff.jpg', 1, '2021-06-26 16:46:12'),
(6, 2, 'Manage physical and emotional health problems', ' Manage physical and emotional health problems. Depression is common among people with HIV, and the stress associated with having HIV can worsen depression symptoms. What&rsquo;s more, both stress and depression can worsen physical pain associated with HIV. Keeping stress, depression, and pain under control can help improve your physical and emotional health, making life with HIV easier. See a mental health professional if you feel you&rsquo;re experiencing depression, and be sure to mention that you&rsquo;re taking medication for HIV to avoid potential drug interactions between depression and HIV medicines.', 'images/images86433873460d7409728452.jpg', 1, '2021-06-26 16:58:31'),
(7, 1, 'Prevent infections and illnesses', 'Prevent infections and illnesses. Since HIV makes your immune system less effective, you become more susceptible to every virus, bacteria, and germ you&amp;#x2019;re exposed to. Wash your hands frequently, and stay away from sick people to stay as healthy as possible. Also stay up-to-date on all of your vaccinations to reduce your risk of preventable illnesses.', 'images/images166860781460d74273e8c9e.jpg', 1, '2021-06-26 17:06:27'),
(8, 1, 'food tips', 'Eat plenty of fruits and vegetables\r\nGo for lean protein eg lean beef, poultry, fish, eggs, beans, and nuts\r\nChoose whole grains\r\nLimit your sugar and salt\r\nDrink plenty of fluids\r\nEat the right amount of calories\r\n', 'images/images102582988060d7445d56352.jpg', 1, '2021-06-26 17:14:37'),
(9, 2, 'food stuffs', 'Eat plenty of fruits and vegetables\r\nGo for lean protein eg lean beef, poultry, fish, eggs, beans, and nuts\r\nChoose whole grains\r\nLimit your sugar and salt\r\nDrink plenty of fluids\r\nEat the right amount of calories\r\n', 'images/images19088219660d744b98a1ce.jpg', 1, '2021-06-26 17:16:09'),
(10, 1, 'food tips', 'Eat plenty of fruits and vegetables\r\nGo for lean protein eg lean beef, poultry, fish, eggs, beans, and nuts\r\nChoose whole grains\r\nLimit your sugar and salt\r\nDrink plenty of fluids\r\nEat the right amount of calories\r\n', 'images/images129768512660d745b251eab.jpg', 1, '2021-06-26 17:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `User_image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Terms` enum('agree','disagree') DEFAULT NULL,
  `type` enum('patient','nurse','admins','doctor') DEFAULT NULL,
  `course` int(11) DEFAULT NULL,
  `payment_method` enum('ecocash','bank') DEFAULT 'ecocash',
  `status` enum('active','inactive') NOT NULL,
  `joined_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `User_image`, `password`, `email`, `Address`, `City`, `country`, `Phone`, `Terms`, `type`, `course`, `payment_method`, `status`, `joined_date`) VALUES
(5, 'keyplayer', 'Tapiwanashe', 'Vincent', '', '$2y$10$dLG0ABLx7EKy4on6dZOGe.jdbiQDCt5o0Rsrw/XT8fOqoWsUh52Ii', 'tkufarimani@yahoo.com', '2941 Southlea Park  Waterfalls', NULL, NULL, '0776933994', 'agree', 'admins', 1, 'ecocash', 'active', '2021-06-17 05:19:12'),
(6, 'Tapiwa', 'Tapiwanashe', 'Vincent', '', '$2y$10$ZO5h63PQ1kXIN63jplCUfe.tJRX3OTZDigDSLQNTYMLd/bxRLq/MC', 'info@autosoft.co.zw', '2941 Southlea Park  Waterfalls', NULL, NULL, '0776933995', 'agree', 'patient', NULL, 'ecocash', 'active', '2021-06-25 10:16:36'),
(8, 'messi', 'Ronald', 'Hwandi', '', '$2y$10$j66ll92zWge70d0UifO40O6vmVPxh2cIpgtB810L/C05xb0o4X6Ei', 'ronaldhwandi90@gmail.com', '1178 Glen Norah A , Harare', NULL, NULL, '263786612420', 'agree', 'admins', NULL, 'ecocash', 'active', '2021-06-25 15:30:53'),
(16, 'flecka', 'Innocent', 'Zinhu', '', '$2y$10$TyT8s5qSHVrCYXmPcIY8tu90/UBrYbqEdPxmzUNVu/xvqJVBtFBk2', 'innocentmawana3@gmail.com', 'hit campus', NULL, NULL, '263778027609', 'agree', 'admins', NULL, 'ecocash', 'inactive', '2021-06-26 13:03:52'),
(17, 'Chipo', 'Chipo', 'Mataka', '', '$2y$10$81bnYn.e2vlmnNeMd.0EyeFwbds1uZai1ruGG1A4FZCK86nM9mV8.', 'chipomataka@gmail.com', '1234', NULL, NULL, '263775945983', 'agree', 'patient', NULL, 'ecocash', 'active', '2021-06-26 13:57:44'),
(18, 'vin', 'Vincent', 'Kufarimani', '', '$2y$10$izohe2kXBeXLMtY5eSRRU.WR/4pwyy.o2hZTABY9stHXofAaXk9C6', 'tkufarimani@gmail.com', '2941 Southlea Park  Waterfalls', NULL, NULL, '0776933994', 'agree', 'patient', 1, 'ecocash', 'active', '2021-06-27 09:57:16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
