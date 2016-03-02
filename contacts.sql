-- phpMyAdmin SQL Dump
-- version 4.3.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2016 at 02:13 AM
-- Server version: 5.5.47-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id_entity` int(11) NOT NULL,
  `login` varchar(11) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='user administrators';

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id_entity`, `login`, `pass`) VALUES
(1, 'admin', 'fce2471795d73afcbd2b80d2eef074b6');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_role`
--

CREATE TABLE IF NOT EXISTS `admin_user_role` (
  `entity_id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contacts_attribute`
--

CREATE TABLE IF NOT EXISTS `contacts_attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type_input` varchar(32) NOT NULL,
  `required` text,
  `placeholder` varchar(30) NOT NULL,
  `show_in_greed` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_attribute`
--

INSERT INTO `contacts_attribute` (`id`, `name`, `type_input`, `required`, `placeholder`, `show_in_greed`) VALUES
(12, 'First name', 'text', 'required', 'Your first name', 1),
(13, 'stnstnstn', 'text', 'required', 'stn', 1),
(31, 'create attribute for testing', 'email', 'required', '1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts_attribute_value`
--

CREATE TABLE IF NOT EXISTS `contacts_attribute_value` (
  `id` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_attribute_value`
--

INSERT INTO `contacts_attribute_value` (`id`, `id_contact`, `id_attribute`, `value`) VALUES
(0, 49, 12, '234'),
(0, 49, 13, '23'),
(0, 50, 12, 'stnsn'),
(0, 50, 13, 'stnstn'),
(0, 53, 12, 'stnstns'),
(0, 53, 13, 'stnstn'),
(0, 54, 12, 'stnstn'),
(0, 54, 13, 'stn'),
(0, 54, 31, 'stn@tsna.ru');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_entity`
--

CREATE TABLE IF NOT EXISTS `contacts_entity` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_entity`
--

INSERT INTO `contacts_entity` (`id`, `name`) VALUES
(1, 'Testing contact'),
(2, 'Testing contact'),
(3, 'Testing contact'),
(4, 'Testing contact'),
(5, 'Testing contact'),
(6, 'Testing contact'),
(7, 'Testing contact'),
(8, 'Testing contact'),
(9, 'Testing contact'),
(10, 'Testing contact'),
(11, 'Testing contact'),
(12, 'Testing contact'),
(49, 'testing2'),
(50, 'stnsn'),
(53, 'tsstnstn'),
(54, 'stnstn');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id_entity` int(11) NOT NULL,
  `title` text,
  `description` text,
  `content` text,
  `menu_id` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='cms page';

-- --------------------------------------------------------

--
-- Table structure for table `url_rewrite`
--

CREATE TABLE IF NOT EXISTS `url_rewrite` (
  `id` int(11) NOT NULL,
  `from_url` text,
  `to_url` text,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `url_rewrite`
--

INSERT INTO `url_rewrite` (`id`, `from_url`, `to_url`, `type`) VALUES
(1, 'create.html', 'contact/create/index', 0),
(2, 'attribute.html', 'contact/create/addAttribute', 0),
(3, 'test.html', 'create.html', 1),
(4, 'contact/create/index', 'create.html', 1),
(5, 'contact/create/addAttribute', 'attribute.html', 1),
(6, 'contact/create', 'create.html', 1),
(7, 'index/index', '/', 1),
(8, '/index/index', '/', 1),
(9, 'index.html', 'index/index/index', 0),
(10, 'index.html', 'index/index', 0),
(11, '/', 'index.html', 1),
(12, 'blogs.html', 'pages/view/blog', 0),
(13, 'pages.html', 'pages/view/blog', 0),
(15, 'pages/view/blog', 'pages.html', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id_entity`);

--
-- Indexes for table `admin_user_role`
--
ALTER TABLE `admin_user_role`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `contacts_attribute`
--
ALTER TABLE `contacts_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts_entity`
--
ALTER TABLE `contacts_entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_entity`);

--
-- Indexes for table `url_rewrite`
--
ALTER TABLE `url_rewrite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id_entity` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_user_role`
--
ALTER TABLE `admin_user_role`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts_attribute`
--
ALTER TABLE `contacts_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `contacts_entity`
--
ALTER TABLE `contacts_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id_entity` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `url_rewrite`
--
ALTER TABLE `url_rewrite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
