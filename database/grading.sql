-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2020 at 08:02 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14541207_grading`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `sem` varchar(50) NOT NULL,
  `teacher` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `SY` varchar(20) NOT NULL,
  `room` varchar(50) NOT NULL,
  `day` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `status`) VALUES
(12, 'BSCS', 0),
(13, 'TEST', 0),
(14, 'BSCS', 0),
(15, 'Computer eng', 0),
(16, 'hsus', 0),
(17, 'cass', 0),
(18, 'bscs', 1),
(19, 'BSCS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--

CREATE TABLE `criteria` (
  `id` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `term` varchar(50) NOT NULL,
  `criteria` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `criteria_class`
--

CREATE TABLE `criteria_class` (
  `id` int(11) NOT NULL,
  `criteriaid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `criteria_teacher`
--

CREATE TABLE `criteria_teacher` (
  `id` int(11) NOT NULL,
  `teacherid` varchar(50) NOT NULL,
  `criteria` varchar(50) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradingsystem`
--

CREATE TABLE `gradingsystem` (
  `id` int(11) NOT NULL,
  `teacherid` varchar(50) NOT NULL,
  `prelim` float NOT NULL,
  `midterm` float NOT NULL,
  `finals` float NOT NULL,
  `student_point` float NOT NULL DEFAULT 0,
  `bonus_point` float NOT NULL DEFAULT 0,
  `act` float NOT NULL DEFAULT 10,
  `hoe` float NOT NULL DEFAULT 10,
  `ass` float NOT NULL DEFAULT 10,
  `att` float NOT NULL DEFAULT 10,
  `exam` float NOT NULL DEFAULT 30,
  `quiz` float NOT NULL DEFAULT 10,
  `project` float NOT NULL DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `activity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date`, `activity`) VALUES
(115, '07-28-2020 09:14:07 AM', 'add new section  '),
(116, '07-28-2020 09:14:55 AM', 'delete  from course'),
(117, '07-28-2020 09:14:59 AM', 'add new course  '),
(118, '07-28-2020 09:15:04 AM', 'delete  from section'),
(119, '07-28-2020 09:17:26 AM', 'add new subject SC123 - Computer Programming'),
(120, '07-28-2020 09:22:38 AM', 'add new subject  - '),
(121, '07-28-2020 09:22:45 AM', 'delete  from subject'),
(122, '07-28-2020 09:32:08 AM', 'add new subject SC332 - Nail Toe Worx'),
(123, '07-28-2020 09:36:50 AM', 'delete SC123 from subject'),
(124, '07-28-2020 09:36:51 AM', 'delete SC332 from subject'),
(125, '07-28-2020 09:37:02 AM', 'add new subject test - asd'),
(126, '07-28-2020 09:42:30 AM', 'create new class BSCS III - testsec with the subject of test'),
(127, '07-28-2020 09:45:28 AM', 'update subject SC123 - Computer Programming'),
(128, '07-28-2020 09:46:33 AM', 'update subject AS - asd'),
(129, '07-28-2020 09:47:00 AM', 'update subject as - asd'),
(130, '07-28-2020 09:47:57 AM', 'update subject SC3 - Computer Programming'),
(131, '07-28-2020 09:47:57 AM', 'update subject SC3 - Computer Programming'),
(132, '07-28-2020 09:48:22 AM', 'add new student Clarence Andaya'),
(133, '07-28-2020 09:48:42 AM', 'assign teacher Clarence Andaya to class BSCS III-testsec with the subject of test'),
(134, '07-28-2020 09:48:52 AM', 'assign teacher Clarence Andaya to class BSCS III-testsec with the subject of test'),
(135, '07-28-2020 09:49:12 AM', 'add new teacher Juan Dela Cruz'),
(136, '07-28-2020 09:49:47 AM', 'assign teacher Juan Dela Cruz to class BSCS III-testsec with the subject of test'),
(137, '07-28-2020 09:50:52 AM', 'add student Clarence Andaya to class BSCS III-testsec with the subject of test'),
(138, '07-28-2020 10:11:12 AM', 'admin logged out.'),
(139, '07-28-2020 10:13:07 AM', '123456 logged out.'),
(140, '07-28-2020 10:13:35 AM', 'add account with the username of 123457'),
(141, '07-28-2020 10:13:38 AM', 'admin logged out.'),
(142, '07-28-2020 10:16:05 AM', '123457 logged out.'),
(143, '07-28-2020 10:21:17 AM', '123457 logged out.'),
(144, '07-28-2020 10:22:18 AM', 'admin logged out.'),
(145, '07-28-2020 10:26:18 AM', 'add new subject 123 - st'),
(146, '07-28-2020 10:26:23 AM', 'update subject 1234 - st'),
(147, '07-28-2020 10:37:30 AM', 'add new section  '),
(148, '07-28-2020 10:37:35 AM', 'add new course  '),
(149, '07-28-2020 10:37:59 AM', 'update class asd III - testsec with the subject of 1234'),
(150, '07-28-2020 10:40:17 AM', 'create new class asd II - asda with the subject of SC3'),
(151, '07-28-2020 10:40:29 AM', 'update class asd II - asda with the subject of SC3'),
(152, '07-28-2020 10:41:22 AM', 'admin logged out.'),
(153, '07-28-2020 10:41:53 AM', 'update class asd III - testsec with the subject of 1234'),
(154, '07-28-2020 10:42:01 AM', 'admin logged out.'),
(155, '07-28-2020 10:51:59 AM', '123457 calculated the grades of Clarence Andaya in 1234 in midterm'),
(156, '07-28-2020 11:12:09 AM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(157, '07-28-2020 11:12:24 AM', '123457 calculated the grades of Clarence Andaya in 1234 in final'),
(158, '07-28-2020 11:12:33 AM', '123457 calculated the grades of Clarence Andaya in 1234 in midterm'),
(159, '07-28-2020 11:13:16 AM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(160, '07-28-2020 11:13:53 AM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(161, '07-28-2020 12:01:20 PM', '123457 logged out.'),
(162, '07-28-2020 12:05:09 PM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(163, '07-28-2020 12:12:35 PM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(164, '07-28-2020 12:19:38 PM', '123457 logged out.'),
(165, '07-28-2020 12:23:52 PM', 'admin logged out.'),
(166, '07-28-2020 12:24:06 PM', 'admin logged out.'),
(167, '07-28-2020 12:37:02 PM', '123457 logged out.'),
(168, '07-28-2020 12:37:33 PM', 'add new teacher Maria Osawa'),
(169, '07-28-2020 12:38:00 PM', 'delete Maria from teacher'),
(170, '07-28-2020 12:38:24 PM', 'add new teacher Maria Osawa'),
(171, '07-28-2020 12:43:53 PM', 'delete Maria from teacher'),
(172, '07-28-2020 12:44:15 PM', 'admin logged out.'),
(173, '07-28-2020 01:10:51 PM', '123457 logged out.'),
(174, '07-28-2020 02:26:26 PM', '123457 logged out.'),
(175, '07-28-2020 02:31:27 PM', '123457 logged out.'),
(176, '07-28-2020 02:32:58 PM', '123457 logged out.'),
(177, '07-28-2020 02:33:26 PM', 'add new teacher S MK'),
(178, '07-28-2020 02:33:37 PM', 'add account with the username of 2131-123'),
(179, '07-28-2020 02:33:41 PM', 'admin logged out.'),
(180, '07-28-2020 02:37:05 PM', '123-457 logged out.'),
(181, '07-28-2020 02:37:22 PM', 'add new teacher sda nn'),
(182, '07-28-2020 02:37:48 PM', 'delete sda from teacher'),
(183, '07-28-2020 02:38:02 PM', 'add new teacher asd '),
(184, '07-28-2020 02:38:15 PM', 'delete asd from teacher'),
(185, '07-28-2020 02:38:45 PM', 'add new teacher adf '),
(186, '07-28-2020 02:39:03 PM', 'admin logged out.'),
(187, '07-28-2020 02:39:20 PM', 'add account with the username of asdsa'),
(188, '07-28-2020 02:39:23 PM', 'admin logged out.'),
(189, '07-28-2020 02:42:07 PM', 'asdsa logged out.'),
(190, '07-28-2020 02:42:16 PM', 'admin logged out.'),
(191, '07-28-2020 03:06:38 PM', '123457 calculated the grades of Clarence Andaya in 1234 in midterm'),
(192, '07-28-2020 03:15:37 PM', '123457 calculated the grades of Clarence Andaya in 1234 in final'),
(193, '07-28-2020 03:15:46 PM', '123457 calculated the grades of Clarence Andaya in 1234 in final'),
(194, '07-28-2020 03:15:53 PM', '123457 calculated the grades of Clarence Andaya in 1234 in final'),
(195, '07-28-2020 03:16:00 PM', '123457 calculated the grades of Clarence Andaya in 1234 in final'),
(196, '07-28-2020 03:17:52 PM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(197, '07-28-2020 03:18:17 PM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(198, '07-28-2020 03:18:35 PM', '123457 calculated the grades of Clarence Andaya in 1234 in prelim'),
(199, '07-28-2020 03:27:56 PM', '123457 logged out.'),
(200, '07-28-2020 03:28:14 PM', 'add account with the username of 16-00402'),
(201, '07-28-2020 03:28:17 PM', 'admin logged out.'),
(202, '07-28-2020 03:28:36 PM', '16-00402 logged out.'),
(203, '07-28-2020 03:29:01 PM', 'assign teacher Clarence Andaya to class asd II-asda with the subject of SC3'),
(204, '07-28-2020 03:29:12 PM', 'add student Clarence Andaya to class asd II-asda with the subject of SC3'),
(205, '07-28-2020 03:29:20 PM', 'admin logged out.'),
(206, '07-28-2020 05:01:20 PM', '16-00402 logged out.'),
(207, '07-28-2020 05:01:20 PM', ' logged out.'),
(208, '07-28-2020 05:08:31 PM', '16-00402 logged out.'),
(209, '07-28-2020 05:08:57 PM', '123457 logged out.'),
(210, '07-28-2020 05:09:42 PM', 'update class asd III - testsec with the subject of SC3'),
(211, '07-28-2020 05:10:35 PM', 'update class asd III - testsec with the subject of 1234'),
(212, '07-28-2020 05:10:52 PM', 'assign teacher Juan Dela Cruz to class asd II-asda with the subject of SC3'),
(213, '07-28-2020 05:10:55 PM', 'admin logged out.'),
(214, '07-28-2020 05:11:30 PM', '123457 calculated the grades of Clarence Andaya in SC3 in final'),
(215, '07-28-2020 05:11:33 PM', '123457 logged out.'),
(216, '07-28-2020 05:15:02 PM', '16-00402 logged out.'),
(217, '07-28-2020 05:15:36 PM', 'add new student Maria Andaya'),
(218, '07-28-2020 05:15:41 PM', 'add account with the username of 16-00403'),
(219, '07-28-2020 05:15:50 PM', 'admin logged out.'),
(220, '07-28-2020 05:15:56 PM', '16-00403 logged out.'),
(221, '07-28-2020 05:16:13 PM', 'add student Maria Andaya to class asd II-asda with the subject of SC3'),
(222, '07-28-2020 05:16:27 PM', 'admin logged out.'),
(223, '07-28-2020 05:26:08 PM', '123457 calculated the grades of Maria Andaya in SC3 in midterm'),
(224, '07-28-2020 05:26:26 PM', '123457 calculated the grades of Maria Andaya in SC3 in final'),
(225, '07-28-2020 05:26:33 PM', '16-00403 logged out.'),
(226, '07-28-2020 05:26:52 PM', '16-00402 logged out.'),
(227, '07-28-2020 05:33:53 PM', '16-00402 logged out.'),
(228, '07-28-2020 05:37:13 PM', '16-00403 logged out.'),
(229, '07-28-2020 05:44:42 PM', '16-00402 logged out.'),
(230, '07-28-2020 05:47:26 PM', '16-00403 logged out.'),
(231, '07-28-2020 05:55:11 PM', '16-00402 logged out.'),
(232, '07-28-2020 05:55:52 PM', '123457 calculated the grades of Maria Andaya in SC3 in prelim'),
(233, '07-28-2020 05:55:58 PM', '123457 logged out.'),
(234, '07-28-2020 05:56:41 PM', '16-00402 logged out.'),
(235, '07-28-2020 05:56:57 PM', 'add student Maria Andaya to class asd III-testsec with the subject of 1234'),
(236, '07-28-2020 05:57:02 PM', 'admin logged out.'),
(237, '07-28-2020 05:57:18 PM', '16-00403 logged out.'),
(238, '07-28-2020 05:58:04 PM', '123457 calculated the grades of Maria Andaya in 1234 in prelim'),
(239, '07-28-2020 05:58:13 PM', '123457 calculated the grades of Maria Andaya in 1234 in midterm'),
(240, '07-28-2020 05:58:25 PM', '123457 calculated the grades of Maria Andaya in 1234 in final'),
(241, '07-28-2020 05:58:29 PM', '123457 logged out.'),
(242, '07-28-2020 06:03:35 PM', '16-00403 logged out.'),
(243, '07-28-2020 06:04:00 PM', '123457 calculated the grades of Maria Andaya in SC3 in final'),
(244, '07-28-2020 06:04:04 PM', '123457 logged out.'),
(245, '07-28-2020 06:04:53 PM', '16-00403 logged out.'),
(246, '07-28-2020 06:09:59 PM', 'remove student Maria Andaya from class asd II-asda with the subject of SC3'),
(247, '07-28-2020 06:10:02 PM', 'admin logged out.'),
(248, '07-28-2020 06:10:16 PM', '16-00403 logged out.'),
(249, '07-28-2020 06:10:42 PM', 'add student Clarence Andaya to class asd II-asda with the subject of SC3'),
(250, '07-28-2020 07:10:27 PM', 'add student bbn nb to class asd II-asda with the subject of SC3'),
(251, '07-28-2020 07:11:00 PM', 'add student enrile dcruz to class asd II-asda with the subject of SC3'),
(252, '07-28-2020 07:19:27 PM', 'add student jn njn to class  - with the subject of '),
(253, '07-28-2020 07:19:54 PM', 'add student njnjn nnjnj to class asd III-testsec with the subject of 1234'),
(254, '07-28-2020 07:20:07 PM', 'add student nmnmnm mnmnm to class asd II-asda with the subject of SC3'),
(255, '07-28-2020 07:20:25 PM', 'add student BJJ NJN to class asd II-asda with the subject of SC3'),
(256, '07-28-2020 07:20:55 PM', 'add student NMN NMN to class asd III-testsec with the subject of 1234'),
(257, '07-28-2020 07:23:28 PM', 'add student asd asd to class asd II-asda with the subject of SC3'),
(258, '07-28-2020 07:23:43 PM', 'add student   to class asd III-testsec with the subject of 1234'),
(259, '07-28-2020 07:28:32 PM', 'add student jj bjbj to class asd II-asda with the subject of SC3'),
(260, '07-28-2020 07:29:08 PM', '123457 calculated the grades of Clarence Andaya in SC3 in midterm'),
(261, '07-28-2020 07:31:41 PM', '123457 calculated the grades of Clarence Andaya in SC3 in final'),
(262, '07-28-2020 07:34:41 PM', '123457 logged out.'),
(263, '07-28-2020 07:35:12 PM', '123457 logged out.'),
(264, '07-28-2020 07:35:46 PM', '16-00403 logged out.'),
(265, '07-28-2020 07:36:27 PM', '16-00402 logged out.'),
(266, '07-28-2020 07:37:55 PM', 'admin logged out.'),
(267, '07-28-2020 07:38:12 PM', '123457 logged out.'),
(268, '07-28-2020 07:42:39 PM', 'admin logged out.'),
(269, '07-28-2020 07:43:26 PM', '123457 logged out.'),
(270, '07-28-2020 07:49:12 PM', 'admin logged out.'),
(271, '07-28-2020 07:52:22 PM', 'add account with the username of njn'),
(272, '07-28-2020 07:52:22 PM', 'add student jn nmnn to class asd III-testsec with the subject of 1234'),
(273, '07-28-2020 07:52:42 PM', 'add account with the username of awit'),
(274, '07-28-2020 07:52:42 PM', 'add student awit awit to class asd III-testsec with the subject of 1234'),
(275, '07-28-2020 07:52:50 PM', '123457 logged out.'),
(276, '07-28-2020 07:53:09 PM', 'awit changes his/her password.'),
(277, '07-28-2020 07:53:27 PM', 'awit logged out.'),
(278, '07-28-2020 07:54:02 PM', '123457 logged out.'),
(279, '07-28-2020 07:55:35 PM', 'add new student mnmn mnn'),
(280, '07-28-2020 07:56:10 PM', 'admin logged out.'),
(281, '07-28-2020 07:58:43 PM', '123457 logged out.'),
(282, '07-28-2020 07:59:50 PM', 'admin logged out.'),
(283, '07-28-2020 08:07:13 PM', 'delete  from studentsubject'),
(284, '07-28-2020 08:07:13 PM', 'delete  from studentsubject'),
(285, '07-28-2020 08:07:27 PM', 'delete  from studentsubject'),
(286, '07-28-2020 08:07:33 PM', 'delete  from studentsubject'),
(287, '07-28-2020 08:08:11 PM', 'delete  from studentsubject'),
(288, '07-28-2020 08:08:18 PM', 'delete  from studentsubject'),
(289, '07-28-2020 08:08:41 PM', 'delete  from studentsubject'),
(290, '07-28-2020 08:08:51 PM', 'delete  from studentsubject'),
(291, '07-28-2020 08:28:53 PM', 'add account with the username of 160000'),
(292, '07-28-2020 08:28:53 PM', 'add student enrile dcruz to class asd II-asda with the subject of SC3'),
(293, '07-28-2020 08:38:19 PM', 'add account with the username of 16-00403'),
(294, '07-28-2020 08:38:19 PM', 'add student Maria Andaya to class asd III-testsec with the subject of 1234'),
(295, '07-28-2020 08:38:27 PM', 'add account with the username of 16-00403'),
(296, '07-28-2020 08:38:27 PM', 'add student Maria Andaya to class asd III-testsec with the subject of 1234'),
(297, '07-28-2020 08:42:23 PM', 'add account with the username of mnsmd'),
(298, '07-28-2020 08:42:23 PM', 'add student nmn nmn to class asd III-testsec with the subject of 1234'),
(299, '07-28-2020 08:42:35 PM', 'add account with the username of 16-00403'),
(300, '07-28-2020 08:42:36 PM', 'add student Maria Andaya to class asd III-testsec with the subject of 1234'),
(301, '07-28-2020 08:42:42 PM', 'add account with the username of 16-00404'),
(302, '07-28-2020 08:42:42 PM', 'add student   to class asd III-testsec with the subject of 1234'),
(303, '07-28-2020 08:43:35 PM', 'add account with the username of 16-00402'),
(304, '07-28-2020 08:43:35 PM', 'add student mnmn mnn to class asd III-testsec with the subject of 1234'),
(305, '07-28-2020 08:45:58 PM', 'add account with the username of 16-00402'),
(306, '07-28-2020 08:45:58 PM', 'add student Clarence Andaya to class asd III-testsec with the subject of 1234'),
(307, '07-28-2020 08:46:09 PM', 'add account with the username of 16-00402'),
(308, '07-28-2020 08:46:09 PM', 'add student Clarence Andaya to class asd III-testsec with the subject of 1234'),
(309, '07-28-2020 08:46:17 PM', 'add account with the username of 16-00402'),
(310, '07-28-2020 08:46:17 PM', 'add student Clarence Andaya to class asd III-testsec with the subject of 1234'),
(311, '07-28-2020 08:46:24 PM', 'add account with the username of 16-00403'),
(312, '07-28-2020 08:46:24 PM', 'add student Maria Andaya to class asd III-testsec with the subject of 1234'),
(313, '07-28-2020 08:46:39 PM', 'add account with the username of 160000'),
(314, '07-28-2020 08:46:39 PM', 'add student enrile dcruz to class asd III-testsec with the subject of 1234'),
(315, '07-28-2020 08:46:49 PM', 'add account with the username of mmmmm'),
(316, '07-28-2020 08:46:49 PM', 'add student  mm bh to class asd III-testsec with the subject of 1234'),
(317, '07-28-2020 09:11:24 PM', '123457 logged out.'),
(318, '07-28-2020 09:11:48 PM', '123456 logged out.'),
(319, '07-28-2020 09:16:33 PM', 'delete sad from subject'),
(320, '07-28-2020 09:34:54 PM', 'update class BSCS II - asda with the subject of SC3'),
(321, '07-28-2020 09:35:31 PM', 'update class BSCS II - asda with the subject of SC3'),
(322, '07-28-2020 09:35:40 PM', 'update class BSCS II - asda with the subject of SC3'),
(323, '07-28-2020 09:36:29 PM', 'update class asd III - testsec with the subject of 1234'),
(324, '07-28-2020 09:37:22 PM', 'update class BSCS II - asda with the subject of SC3'),
(325, '07-28-2020 09:40:01 PM', 'delete SC3 from class'),
(326, '07-28-2020 09:41:03 PM', 'update class BSCS II - testsec with the subject of SC3'),
(327, '07-28-2020 09:41:14 PM', 'delete SC3 from class'),
(328, '07-29-2020 09:16:39 AM', '16-00402 logged out.'),
(329, '07-29-2020 09:21:23 AM', '123457 logged out.'),
(330, '07-29-2020 09:22:27 AM', 'admin logged out.'),
(331, '07-29-2020 09:25:31 AM', '123457 logged out.'),
(332, '07-29-2020 09:27:26 AM', 'admin logged out.'),
(333, '07-29-2020 09:28:06 AM', 'add account with the username of 16-00402'),
(334, '07-29-2020 09:28:06 AM', 'add student Clarence Andaya to class asd II-asda with the subject of SC3'),
(335, '07-29-2020 11:54:12 AM', '123457 logged out.'),
(336, '07-29-2020 12:05:17 PM', 'delete  from quiz'),
(337, '07-29-2020 12:06:40 PM', 'delete  from quiz'),
(338, '07-29-2020 12:16:43 PM', 'delete  from quiz'),
(339, '07-29-2020 12:56:35 PM', 'delete  from quiz'),
(340, '07-29-2020 12:59:06 PM', 'delete  from quiz'),
(341, '07-29-2020 12:59:42 PM', 'delete  from quiz'),
(342, '07-29-2020 02:55:49 PM', 'delete  from quiz'),
(343, '07-29-2020 02:55:53 PM', 'delete  from quiz'),
(344, '07-29-2020 02:59:31 PM', 'add account with the username of 1323'),
(345, '07-29-2020 02:59:31 PM', 'add student b bjb to class asd II-asda with the subject of SC3'),
(346, '07-29-2020 03:15:41 PM', 'delete  from exam'),
(347, '07-29-2020 03:16:57 PM', 'delete  from exam'),
(348, '07-30-2020 07:42:04 AM', '123457 logged out.'),
(349, '07-30-2020 07:42:42 AM', 'admin logged out.'),
(350, '07-30-2020 08:31:51 AM', 'add account with the username of 16-00403'),
(351, '07-30-2020 08:31:51 AM', 'add student Maria Andaya to class asd III-testsec with the subject of 1234'),
(352, '07-30-2020 11:33:10 AM', '123457 logged out.'),
(353, '07-30-2020 11:33:23 AM', 'add new teacher bb bnbn'),
(354, '07-30-2020 11:34:37 AM', 'add new teacher dbb nb'),
(355, '07-30-2020 11:37:06 AM', 'add new teacher jg ghg'),
(356, '07-30-2020 11:37:29 AM', 'add new teacher dj hjh'),
(357, '07-30-2020 11:37:50 AM', 'add account with the username of clarence'),
(358, '07-30-2020 11:37:53 AM', 'admin logged out.'),
(359, '07-30-2020 11:40:25 AM', 'clarence logged out.'),
(360, '07-30-2020 02:41:36 PM', '123457 logged out.'),
(361, '07-30-2020 02:45:50 PM', 'admin logged out.'),
(362, '07-30-2020 02:46:45 PM', '123457 logged out.'),
(363, '07-30-2020 02:46:58 PM', '16-00402 logged out.'),
(364, '07-30-2020 02:51:35 PM', '123457 logged out.'),
(365, '07-30-2020 03:43:52 PM', '16-00402 logged out.'),
(366, '07-30-2020 03:47:38 PM', '16-00402 logged out.'),
(367, '07-30-2020 03:49:44 PM', '123457 logged out.'),
(368, '07-30-2020 03:49:51 PM', '16-00402 logged out.'),
(369, '07-30-2020 03:50:13 PM', 'add account with the username of 16-00402'),
(370, '07-30-2020 03:50:13 PM', 'add student Clarence Andaya to class asd II-asda with the subject of SC3'),
(371, '07-30-2020 03:51:01 PM', 'add account with the username of 16-00402'),
(372, '07-30-2020 03:51:01 PM', 'add student Clarence Andaya to class BSCS I-asda with the subject of SC3'),
(373, '07-30-2020 03:52:58 PM', 'add account with the username of 1323'),
(374, '07-30-2020 03:52:59 PM', 'add student b bjb to class BSCS I-asda with the subject of SC3'),
(375, '07-30-2020 03:53:40 PM', 'add account with the username of 1323'),
(376, '07-30-2020 03:53:40 PM', 'add student b bjb to class asd III-testsec with the subject of 1234'),
(377, '07-30-2020 04:06:04 PM', '123457 logged out.'),
(378, '07-30-2020 04:08:10 PM', '16-00402 logged out.'),
(379, '07-30-2020 05:00:02 PM', '16-00402 logged out.'),
(380, '07-30-2020 05:02:14 PM', ' logged out.'),
(381, '07-30-2020 05:08:34 PM', 'admin logged out.'),
(382, '07-30-2020 05:08:45 PM', 'admin logged out.'),
(383, '07-30-2020 05:11:09 PM', '123457 logged out.'),
(384, '07-30-2020 05:14:23 PM', 'delete  from section'),
(385, '07-30-2020 05:14:25 PM', 'delete  from section'),
(386, '07-30-2020 05:26:25 PM', 'add new student jkh jhhj'),
(387, '07-30-2020 05:40:19 PM', 'add new teacher Juan Dela Cruz'),
(388, '07-30-2020 05:55:12 PM', 'admin logged out.'),
(389, '07-30-2020 05:55:32 PM', 'add account with the username of T12345'),
(390, '07-30-2020 05:57:57 PM', 'admin logged out.'),
(391, '07-30-2020 06:01:05 PM', 'T12345 logged out.'),
(392, '07-30-2020 06:03:04 PM', 'admin logged out.'),
(393, '07-30-2020 06:13:12 PM', 'admin logged out.'),
(394, '07-30-2020 06:13:53 PM', 'T12345 logged out.'),
(395, '07-30-2020 06:14:12 PM', 'add new course  '),
(396, '07-30-2020 06:14:20 PM', 'add new course  '),
(397, '07-30-2020 06:14:26 PM', 'add new course  '),
(398, '07-30-2020 06:14:44 PM', 'add new section  '),
(399, '07-30-2020 06:14:53 PM', 'add new section  '),
(400, '07-30-2020 06:15:02 PM', 'add new section  '),
(401, '07-30-2020 06:15:14 PM', 'admin logged out.'),
(402, '07-30-2020 06:16:23 PM', 'add account with the username of 16-00402'),
(403, '07-30-2020 06:16:23 PM', 'add student jkh jhhj to class BSCS II-A2-1AM with the subject of SC123'),
(404, '07-30-2020 06:22:20 PM', 'add account with the username of 16-00403'),
(405, '07-30-2020 06:22:21 PM', 'add student Juan Dela Cruz to class BSCS II-A2-1AM with the subject of SC123'),
(406, '07-30-2020 06:23:29 PM', 'T12345 logged out.'),
(407, '07-30-2020 06:23:49 PM', 'add account with the username of T12345'),
(408, '07-30-2020 06:24:02 PM', 'remove student Juan Dela Cruz from class BSCS II-A2-1AM with the subject of SC123'),
(409, '07-30-2020 06:30:54 PM', 'admin logged out.'),
(410, '07-30-2020 06:31:13 PM', 'add account with the username of 16-00403'),
(411, '07-30-2020 06:31:14 PM', 'add student Juan Dela Cruz to class BSCS II-A2-1AM with the subject of SC123'),
(412, '07-30-2020 06:31:30 PM', 'add account with the username of 16-00402'),
(413, '07-30-2020 06:31:30 PM', 'add student jkh jhhj to class BSCS II-A2-1AM with the subject of SC123'),
(414, '07-30-2020 06:36:20 PM', 'admin logged out.'),
(415, '07-30-2020 06:39:51 PM', 'T12345 logged out.'),
(416, '07-30-2020 06:40:20 PM', 'admin logged out.'),
(417, '07-30-2020 06:43:56 PM', 'admin logged out.'),
(418, '07-30-2020 06:46:54 PM', 'T12345 logged out.'),
(419, '07-30-2020 06:47:11 PM', 'admin logged out.'),
(420, '07-30-2020 06:47:34 PM', 'T12345 logged out.'),
(421, '07-30-2020 06:48:26 PM', 'admin logged out.'),
(422, '07-30-2020 06:48:51 PM', 'T12345 logged out.'),
(423, '07-30-2020 06:49:05 PM', '16-00402 logged out.'),
(424, '07-30-2020 06:50:30 PM', 'T12345 logged out.'),
(425, '07-30-2020 06:52:42 PM', '16-00403 logged out.'),
(426, '07-30-2020 06:53:02 PM', 'admin logged out.'),
(427, '07-30-2020 06:53:53 PM', ' logged out.'),
(428, '07-30-2020 07:08:40 PM', 'T12345 logged out.'),
(429, '07-30-2020 07:09:08 PM', 'admin logged out.'),
(430, '07-30-2020 07:09:49 PM', 'T12345 logged out.'),
(431, '07-30-2020 07:40:51 PM', 'delete SC123 from class'),
(432, '07-30-2020 07:46:30 PM', 'add account with the username of 16-00402'),
(433, '07-30-2020 07:46:30 PM', 'add student Clarence Andaya to class BSCS II-A3-5AM with the subject of SC123'),
(434, '07-31-2020 06:13:00 PM', 'T12345 logged out.'),
(435, '07-31-2020 06:17:27 PM', '16-00402 logged out.'),
(436, '07-31-2020 06:17:37 PM', '16-00403 logged out.'),
(437, '07-31-2020 06:18:59 PM', 'T12345 logged out.'),
(438, '07-31-2020 06:20:08 PM', '16-00402 logged out.'),
(439, '07-31-2020 06:20:36 PM', 'add new teacher Grace Bandagosa'),
(440, '07-31-2020 06:20:57 PM', 'add account with the username of 12345'),
(441, '07-31-2020 06:20:59 PM', 'admin logged out.'),
(442, '07-31-2020 06:22:22 PM', 'add account with the username of 16-00404'),
(443, '07-31-2020 06:22:22 PM', 'add student Maria Dela Cruz to class BSIT II-A3-5AM with the subject of CS213'),
(444, '07-31-2020 06:22:28 PM', '12345 logged out.'),
(445, '07-31-2020 06:22:44 PM', '16-00404 logged out.'),
(446, '07-31-2020 06:22:53 PM', '16-00403 logged out.'),
(447, '07-31-2020 06:33:16 PM', '16-00404 logged out.'),
(448, '07-31-2020 06:42:44 PM', '16-00404 logged out.'),
(449, '07-31-2020 06:42:55 PM', '16-00402 logged out.'),
(450, '07-31-2020 06:43:07 PM', '16-00404 logged out.'),
(451, '07-31-2020 06:52:30 PM', '16-00403 logged out.'),
(452, '07-31-2020 06:52:38 PM', '16-00404 logged out.'),
(453, '07-31-2020 06:53:45 PM', '16-00404 logged out.'),
(454, '07-31-2020 07:07:11 PM', '16-00402 logged out.'),
(455, '07-31-2020 07:08:36 PM', '16-00404 logged out.'),
(456, '07-31-2020 07:10:48 PM', '16-00404 logged out.'),
(457, '07-31-2020 07:11:34 PM', 'add new teacher Juan Dela Cruz'),
(458, '07-31-2020 07:11:38 PM', 'add account with the username of T12345'),
(459, '07-31-2020 07:11:40 PM', 'admin logged out.'),
(460, '07-31-2020 07:13:21 PM', 'add account with the username of 16-00402'),
(461, '07-31-2020 07:13:21 PM', 'add student Clarence Andaya to class BSCS I-A2-1AM with the subject of SC321'),
(462, '07-31-2020 07:17:34 PM', 'T12345 logged out.'),
(463, '07-31-2020 07:18:23 PM', 'add account with the username of 16-00402'),
(464, '07-31-2020 07:18:23 PM', 'add student Grace Bandagosa to class BSIT II-A3-5AM with the subject of SC321'),
(465, '07-31-2020 07:18:31 PM', 'T12345 logged out.'),
(466, '07-31-2020 07:18:41 PM', '16-00402 logged out.'),
(467, '07-31-2020 07:21:03 PM', 'T12345 logged out.'),
(468, '07-31-2020 07:21:17 PM', '16-00402 logged out.'),
(469, '07-31-2020 07:21:51 PM', 'add account with the username of 16-00403'),
(470, '07-31-2020 07:21:52 PM', 'add student Maria Juana to class BSIT II-A3-5AM with the subject of SC321'),
(471, '07-31-2020 07:21:58 PM', 'T12345 logged out.'),
(472, '07-31-2020 07:22:06 PM', '16-00402 logged out.'),
(473, '07-31-2020 07:22:16 PM', '16-00403 logged out.'),
(474, '07-31-2020 07:29:06 PM', 'update subject SC321 - Literature 12'),
(475, '07-31-2020 07:29:23 PM', 'delete SC321 from subject'),
(476, '07-31-2020 07:31:45 PM', 'update subject PHP12 - 234'),
(477, '07-31-2020 07:32:56 PM', 'update subject PHP12 - 234'),
(478, '07-31-2020 07:33:33 PM', 'update subject PHP12 - 234'),
(479, '07-31-2020 07:33:59 PM', 'T12345 logged out.'),
(480, '07-31-2020 07:34:43 PM', '16-00402 logged out.'),
(481, '07-31-2020 07:35:18 PM', 'delete SC321 from class'),
(482, '07-31-2020 07:36:54 PM', 'add account with the username of 16-00402'),
(483, '07-31-2020 07:36:54 PM', 'add student Grace Bandagosa to class BSIT II-A3-5AM with the subject of PHP12'),
(484, '07-31-2020 07:36:57 PM', 'T12345 logged out.'),
(485, '07-31-2020 07:42:01 PM', '16-00402 logged out.'),
(486, '07-31-2020 07:42:16 PM', 'delete PHP12 from class'),
(487, '07-31-2020 07:42:20 PM', 'delete PHP12 from subject'),
(488, '07-31-2020 07:42:23 PM', 'T12345 logged out.'),
(489, '07-31-2020 07:47:12 PM', '16-00402 logged out.'),
(490, '07-31-2020 07:49:06 PM', 'T12345 logged out.'),
(491, '07-31-2020 07:51:39 PM', '16-00402 logged out.'),
(492, '07-31-2020 07:51:57 PM', '16-00402 logged out.'),
(493, '07-31-2020 07:52:38 PM', 'add account with the username of 16-00402'),
(494, '07-31-2020 07:52:38 PM', 'add student Grace Bandagosa to class BSCS III-A4-2AM with the subject of PHP'),
(495, '07-31-2020 07:52:41 PM', 'T12345 logged out.'),
(496, '07-31-2020 07:52:52 PM', '16-00402 logged out.'),
(497, '07-31-2020 07:53:04 PM', 'delete PHP from subject'),
(498, '07-31-2020 07:53:06 PM', 'T12345 logged out.'),
(499, '07-31-2020 07:53:47 PM', '16-00402 logged out.'),
(500, '07-31-2020 08:00:34 PM', 'delete PHP from class'),
(501, '07-31-2020 08:00:52 PM', 'delete jkjhjk from subject'),
(502, '07-31-2020 08:02:44 PM', 'T12345 logged out.'),
(503, '07-31-2020 08:03:05 PM', '16-00402 logged out.'),
(504, '07-31-2020 08:03:23 PM', 'delete PHP from subject'),
(505, '07-31-2020 08:03:26 PM', 'delete THESIS from subject'),
(506, '07-31-2020 08:03:32 PM', 'T12345 logged out.'),
(507, '07-31-2020 08:03:44 PM', '16-00402 logged out.'),
(508, '07-31-2020 08:10:58 PM', 'delete PHP from class'),
(509, '07-31-2020 08:11:51 PM', 'add account with the username of 16-00402'),
(510, '07-31-2020 08:11:51 PM', 'add student Grace Bandagosa to class BSCS I-A2-1AM with the subject of PHP'),
(511, '08-01-2020 07:43:00 AM', 'admin logged out.'),
(512, '08-01-2020 09:25:39 AM', 'T12345 logged out.'),
(513, '08-01-2020 09:46:43 AM', 'admin logged out.'),
(514, '08-01-2020 09:47:38 AM', 'add new teacher Juan Dela Cruz'),
(515, '08-01-2020 09:47:59 AM', 'add account with the username of T12345'),
(516, '08-01-2020 09:48:18 AM', 'add new course  '),
(517, '08-01-2020 09:48:31 AM', 'add new course  '),
(518, '08-01-2020 09:48:39 AM', 'add new section  '),
(519, '08-01-2020 09:48:47 AM', 'add new section  '),
(520, '08-01-2020 09:49:00 AM', 'update course  '),
(521, '08-01-2020 09:49:49 AM', 'delete Juan from teacher'),
(522, '08-01-2020 09:49:55 AM', 'delete  from course'),
(523, '08-01-2020 09:49:57 AM', 'delete  from course'),
(524, '08-01-2020 09:50:03 AM', 'delete  from section'),
(525, '08-01-2020 09:50:04 AM', 'delete  from section'),
(526, '08-01-2020 09:50:08 AM', 'admin logged out.'),
(527, '08-01-2020 09:50:22 AM', 'delete T12345 from userdata'),
(528, '08-01-2020 09:50:25 AM', 'admin logged out.'),
(529, '08-01-2020 09:51:08 AM', 'add new teacher Juan Dela Cruz'),
(530, '08-01-2020 09:51:42 AM', 'update teacher Juana Dela Cruz'),
(531, '08-01-2020 09:52:00 AM', 'add new course  '),
(532, '08-01-2020 09:52:06 AM', 'update course  '),
(533, '08-01-2020 09:52:18 AM', 'add new section  '),
(534, '08-01-2020 09:52:25 AM', 'add new section  '),
(535, '08-01-2020 09:52:33 AM', 'add account with the username of T12345'),
(536, '08-01-2020 09:52:53 AM', 'admin logged out.'),
(537, '08-01-2020 09:56:21 AM', 'update class BSCS III - A4-1AM with the subject of SC123'),
(538, '08-01-2020 09:56:50 AM', 'add account with the username of 16-00402'),
(539, '08-01-2020 09:56:50 AM', 'add student Grace Bandagosa to class BSCS III-A4-1AM with the subject of SC123'),
(540, '08-01-2020 09:59:14 AM', 'add account with the username of 16-00403'),
(541, '08-01-2020 09:59:14 AM', 'add student Clarence Andaya to class BSCS III-A4-1AM with the subject of SC123'),
(542, '08-01-2020 10:10:06 AM', 'T12345 logged out.'),
(543, '08-01-2020 10:10:28 AM', '16-00403 logged out.'),
(544, '08-01-2020 01:32:40 PM', 'admin logged out.'),
(545, '08-01-2020 06:59:08 PM', 'T12345 logged out.'),
(546, '08-02-2020 03:28:30 AM', 'add account with the username of T12345'),
(547, '08-02-2020 03:28:40 AM', 'admin logged out.'),
(548, '08-02-2020 03:29:08 AM', 'add account with the username of 16-00404'),
(549, '08-02-2020 03:29:08 AM', 'add student Roseanna Ace to class BSCS III-A4-1AM with the subject of SC123'),
(550, '08-02-2020 04:55:35 AM', 'add account with the username of 567h'),
(551, '08-02-2020 04:55:36 AM', 'add student hg hg to class BSCS III-A4-1AM with the subject of SC123'),
(552, '08-02-2020 05:36:44 AM', 'T12345 logged out.'),
(553, '08-02-2020 05:36:58 AM', 'add new teacher gj ghkj'),
(554, '08-02-2020 05:58:50 AM', 'add account with the username of 123458'),
(555, '08-02-2020 05:58:52 AM', 'admin logged out.'),
(556, '08-02-2020 05:59:12 AM', '123458 logged out.'),
(557, '08-02-2020 06:37:24 AM', 'admin logged out.'),
(558, '08-02-2020 06:40:40 AM', 'add account with the username of 16-00403'),
(559, '08-02-2020 06:40:40 AM', 'add student Clarence Andaya to class BSCS III-A4-1AM with the subject of SC123'),
(560, '08-02-2020 09:35:44 PM', 'add account with the username of 16-00402'),
(561, '08-02-2020 09:35:45 PM', 'add student Grace Bandagosa to class BSCS I-A4-2AM with the subject of PHP'),
(562, '08-02-2020 09:57:19 PM', 'T12345 logged out.'),
(563, '08-02-2020 08:28:12 PM', 'delete gj from teacher'),
(564, '08-02-2020 08:28:15 PM', 'delete bn from teacher'),
(565, '08-02-2020 08:28:18 PM', 'delete RoseannaAce from teacher'),
(566, '08-02-2020 08:28:20 PM', 'delete jh from teacher'),
(567, '08-02-2020 08:28:22 PM', 'delete hjh from teacher'),
(568, '08-02-2020 08:28:39 PM', 'add new teacher Google Mind'),
(569, '08-02-2020 08:28:50 PM', 'add account with the username of T11111'),
(570, '08-02-2020 08:31:05 PM', 'admin logged out.'),
(571, '08-02-2020 08:35:55 PM', 'T11111 logged out.'),
(572, '08-02-2020 08:36:17 PM', 'T12345 logged out.'),
(573, '08-02-2020 08:39:26 PM', 'T12345 logged out.'),
(574, '08-02-2020 08:40:14 PM', 'T12345 logged out.'),
(575, '08-02-2020 08:49:28 PM', 'add account with the username of 16-00405'),
(576, '08-02-2020 08:49:28 PM', 'add student Grace Bandagosa to class BSCS III-A4-1AM with the subject of DS123'),
(577, '08-02-2020 08:49:59 PM', 'T11111 logged out.'),
(578, '08-03-2020 06:43:14 AM', 'T12345 logged out.'),
(579, '08-03-2020 06:44:56 AM', 'admin logged out.'),
(580, '08-03-2020 07:01:42 AM', 'T12345 logged out.'),
(581, '08-03-2020 07:15:08 AM', 'add account with the username of 16-00405'),
(582, '08-03-2020 07:15:08 AM', 'add student Grace Bandagosa to class BSCS III-A4-2AM with the subject of DS321'),
(583, '08-03-2020 07:17:30 AM', 'add account with the username of 16-00402'),
(584, '08-03-2020 07:17:31 AM', 'add student Grace Bandagosa to class BSCS III-A4-2AM with the subject of DS321'),
(585, '08-03-2020 07:18:26 AM', 'add account with the username of 16-00406'),
(586, '08-03-2020 07:18:26 AM', 'add student Ben Tambling to class BSCS III-A4-2AM with the subject of DS321'),
(587, '08-03-2020 07:18:42 AM', 'T12345 logged out.'),
(588, '08-03-2020 07:19:14 AM', '16-00406 logged out.'),
(589, '08-03-2020 07:29:17 AM', 'add new teacher anding estribo'),
(590, '08-03-2020 07:29:37 AM', 'add account with the username of T11111'),
(591, '08-03-2020 07:29:55 AM', 'add account with the username of T12432'),
(592, '08-03-2020 07:31:55 AM', 'admin logged out.'),
(593, '08-03-2020 07:48:28 AM', 'T12432 logged out.'),
(594, '08-03-2020 07:48:54 AM', 'add account with the username of T12432'),
(595, '08-03-2020 07:49:23 AM', 'add account with the username of T12432'),
(596, '08-03-2020 07:50:33 AM', 'T12345 logged out.'),
(597, '08-03-2020 07:51:23 AM', 'add account with the username of T12345'),
(598, '08-03-2020 07:52:00 AM', 'admin logged out.'),
(599, '08-03-2020 07:53:39 AM', 'admin logged out.'),
(600, '08-03-2020 07:55:44 AM', 'admin logged out.'),
(601, '08-03-2020 08:19:30 AM', 'T12432 logged out.'),
(602, '08-03-2020 08:20:49 AM', 'admin logged out.'),
(603, '08-03-2020 08:28:58 AM', 'T12432 logged out.'),
(604, '08-03-2020 08:37:19 AM', 'admin logged out.'),
(605, '08-03-2020 08:41:38 AM', 'T12432 logged out.'),
(606, '08-03-2020 08:42:17 AM', 'admin logged out.'),
(607, '08-03-2020 08:49:16 AM', 'T12345 logged out.'),
(608, '08-03-2020 08:56:50 AM', 'admin logged out.'),
(609, '08-03-2020 08:59:22 AM', 'add account with the username of T12345'),
(610, '08-03-2020 08:59:22 AM', 'add student anding estribo to class BSCS I-A4-1AM with the subject of ajdjgir123'),
(611, '08-03-2020 09:01:06 AM', 'add account with the username of 16-00405'),
(612, '08-03-2020 09:01:07 AM', 'add student Grace Bandagosa to class BSCS III-A4-2AM with the subject of DS321'),
(613, '08-03-2020 09:27:59 AM', 'add account with the username of T23454'),
(614, '08-03-2020 09:28:00 AM', 'add student dj fhtui to class BSCS I-A4-1AM with the subject of ajdjgir123'),
(615, '08-03-2020 09:31:56 AM', 'add account with the username of T23454'),
(616, '08-03-2020 09:31:56 AM', 'add student dj fhtui to class BSCS I-A4-1AM with the subject of ajdjgir123'),
(617, '08-03-2020 09:47:26 AM', 'T12345 logged out.'),
(618, '08-03-2020 09:48:00 AM', 'admin logged out.'),
(619, '08-03-2020 09:54:58 AM', 'delete ajdjgir123 from class'),
(620, '08-03-2020 09:55:05 AM', 'delete ajdjgir123 from class'),
(621, '08-03-2020 09:55:16 AM', 'T12432 logged out.'),
(622, '08-03-2020 09:55:59 AM', 'delete anding from teacher'),
(623, '08-03-2020 09:56:22 AM', 'T12432 logged out.'),
(624, '08-03-2020 09:58:28 AM', 'T12432 logged out.'),
(625, '08-03-2020 09:59:47 AM', 'admin logged out.'),
(626, '08-03-2020 10:33:23 AM', 'admin logged out.'),
(627, '08-03-2020 01:00:28 PM', 'admin logged out.'),
(628, '08-03-2020 01:39:56 PM', 'add new course  '),
(629, '08-03-2020 01:40:33 PM', 'add new section  '),
(630, '08-03-2020 01:40:57 PM', 'add new section  '),
(631, '08-03-2020 01:44:43 PM', 'add new section  '),
(632, '08-03-2020 01:44:59 PM', 'admin logged out.'),
(633, '08-03-2020 01:48:49 PM', 'add account with the username of T11111'),
(634, '08-03-2020 01:49:00 PM', 'admin logged out.'),
(635, '08-03-2020 01:49:29 PM', 'T11111 logged out.'),
(636, '08-03-2020 01:49:55 PM', 'admin logged out.'),
(637, '08-03-2020 02:38:51 PM', 'admin logged out.'),
(638, '08-03-2020 02:41:56 PM', 'admin logged out.'),
(639, '08-03-2020 10:35:34 PM', 'add account with the username of T12345'),
(640, '08-03-2020 10:36:36 PM', 'delete T12432 from userdata'),
(641, '08-03-2020 10:36:42 PM', 'delete T23454 from userdata'),
(642, '08-03-2020 10:37:30 PM', 'add new teacher andrea estribo'),
(643, '08-03-2020 10:38:14 PM', 'add new course  '),
(644, '08-03-2020 10:39:02 PM', 'add new section  '),
(645, '08-03-2020 10:40:22 PM', 'admin logged out.'),
(646, '08-03-2020 10:42:27 PM', 'admin logged out.'),
(647, '08-03-2020 10:44:24 PM', 'admin logged out.'),
(648, '08-03-2020 10:47:10 PM', 'update teacher andrea estribo'),
(649, '08-03-2020 10:47:22 PM', 'admin logged out.'),
(650, '08-03-2020 10:48:40 PM', 'update teacher andrea estribo'),
(651, '08-03-2020 10:48:52 PM', 'admin logged out.'),
(652, '08-03-2020 10:50:20 PM', 'add new teacher andrea estribo'),
(653, '08-03-2020 10:50:35 PM', 'admin logged out.'),
(654, '08-03-2020 10:51:44 PM', 'admin logged out.'),
(655, '08-03-2020 10:52:12 PM', 'T12345 logged out.'),
(656, '08-03-2020 10:52:50 PM', 'add account with the username of T20401'),
(657, '08-03-2020 10:53:23 PM', 'admin logged out.'),
(658, '08-03-2020 11:00:46 PM', 'T20401 logged out.'),
(659, '08-03-2020 11:01:39 PM', 'add new course  '),
(660, '08-03-2020 11:02:27 PM', 'admin logged out.'),
(661, '08-03-2020 11:02:46 PM', 'add new teacher Grace Bandagosa'),
(662, '08-03-2020 11:03:15 PM', 'admin logged out.'),
(663, '08-03-2020 11:05:05 PM', 'admin logged out.'),
(664, '08-03-2020 11:05:36 PM', 'T20401 logged out.'),
(665, '08-03-2020 11:06:05 PM', 'admin logged out.'),
(666, '08-03-2020 11:06:54 PM', 'add account with the username of T1614'),
(667, '08-03-2020 11:06:57 PM', 'add account with the username of T1614'),
(668, '08-03-2020 11:07:05 PM', 'admin logged out.'),
(669, '08-03-2020 11:07:54 PM', 'admin logged out.'),
(670, '08-03-2020 11:14:20 PM', 'T1614 logged out.'),
(671, '08-03-2020 11:15:29 PM', 'admin logged out.'),
(672, '08-03-2020 11:26:10 PM', 'T20401 logged out.'),
(673, '08-03-2020 11:26:40 PM', 'admin logged out.'),
(674, '08-03-2020 11:28:34 PM', 'delete SC123 from class'),
(675, '08-03-2020 11:29:15 PM', 'T12345 logged out.'),
(676, '08-03-2020 11:34:40 PM', 'admin logged out.'),
(677, '08-03-2020 11:46:06 PM', 'T1614 logged out.'),
(678, '08-03-2020 11:48:55 PM', 'admin logged out.'),
(679, '08-04-2020 02:35:50 AM', 'admin logged out.'),
(680, '08-04-2020 02:36:32 AM', 'T1614 logged out.'),
(681, '08-04-2020 02:44:02 AM', 'T12345 logged out.'),
(682, '08-04-2020 02:45:14 AM', 'add new course  '),
(683, '08-04-2020 02:45:34 AM', 'add new course  '),
(684, '08-04-2020 02:45:52 AM', 'add new section  '),
(685, '08-04-2020 02:46:16 AM', 'admin logged out.'),
(686, '08-04-2020 02:47:59 AM', 'add account with the username of g to ihh g'),
(687, '08-04-2020 02:48:00 AM', 'add student ygy tyy to class BSCS IV-Irregular with the subject of SC123'),
(688, '08-04-2020 02:51:41 AM', 'T20401 logged out.'),
(689, '08-04-2020 02:53:18 AM', 'admin logged out.'),
(690, '08-04-2020 02:55:08 AM', 'T1614 logged out.'),
(691, '08-04-2020 03:00:13 AM', 'T12345 logged out.'),
(692, '08-04-2020 03:05:20 AM', 'add account with the username of T2345'),
(693, '08-04-2020 03:05:20 AM', 'add student Andrea Estribo to class BSCS III-Irregular with the subject of CS12'),
(694, '08-04-2020 03:12:56 AM', 'T1614 logged out.'),
(695, '08-04-2020 03:15:04 AM', 'admin logged out.'),
(696, '08-04-2020 03:25:49 AM', 'T12345 logged out.'),
(697, '08-04-2020 03:27:22 AM', '16-00405 logged out.'),
(698, '08-04-2020 03:30:29 AM', 'admin logged out.'),
(699, '08-04-2020 03:32:30 AM', 'admin logged out.'),
(700, '08-04-2020 03:35:26 AM', 'T12345 logged out.'),
(701, '08-04-2020 03:36:29 AM', '16-00405 logged out.'),
(702, '08-04-2020 06:49:55 AM', 'delete 16-00405 from userdata'),
(703, '08-04-2020 06:50:06 AM', 'delete 16-00402 from userdata'),
(704, '08-04-2020 06:50:08 AM', 'delete T12345 from userdata'),
(705, '08-04-2020 06:50:09 AM', 'delete  from userdata'),
(706, '08-04-2020 06:50:16 AM', 'delete T2345 from userdata'),
(707, '08-04-2020 06:53:13 AM', 'add account with the username of T20401'),
(708, '08-04-2020 06:53:54 AM', 'admin logged out.'),
(709, '08-04-2020 06:55:05 AM', 'admin logged out.'),
(710, '08-04-2020 07:00:25 AM', 'T20401 logged out.'),
(711, '08-04-2020 07:01:13 AM', 'add new section  '),
(712, '08-04-2020 07:01:41 AM', 'add new section  '),
(713, '08-04-2020 07:02:17 AM', 'admin logged out.'),
(714, '08-04-2020 07:05:37 AM', 'T20401 logged out.'),
(715, '08-04-2020 07:06:41 AM', 'update section  '),
(716, '08-04-2020 07:06:51 AM', 'update section  '),
(717, '08-04-2020 07:07:15 AM', 'add new course  '),
(718, '08-04-2020 07:07:26 AM', 'admin logged out.'),
(719, '08-04-2020 07:09:55 AM', 'add account with the username of T23454'),
(720, '08-04-2020 07:09:55 AM', 'add student dj fhtui to class bscs I-Irregular with the subject of asddf4'),
(721, '08-04-2020 07:28:22 AM', 'T20401 logged out.'),
(722, '08-04-2020 07:32:37 AM', 'delete T20401 from userdata'),
(723, '08-04-2020 07:36:43 AM', 'add new teacher Ron Mameng'),
(724, '08-04-2020 07:37:56 AM', 'delete T23454 from userdata'),
(725, '08-05-2020 08:42:27 AM', 'admin logged out.'),
(726, '08-05-2020 10:31:30 AM', 'add new teacher Grace Bandagosa'),
(727, '08-05-2020 10:32:43 AM', 'add new course  '),
(728, '08-05-2020 10:33:49 AM', 'add account with the username of T0816'),
(729, '08-05-2020 10:34:36 AM', 'admin logged out.'),
(730, '08-05-2020 07:24:06 PM', 'add new teacher pusa miming ko'),
(731, '08-05-2020 07:24:06 PM', 'add account with the username of meow'),
(732, '08-05-2020 07:24:16 PM', 'update teacher pusa miming ko'),
(733, '08-05-2020 07:24:24 PM', 'update teacher pusa miming ko'),
(734, '08-05-2020 07:30:11 PM', 'update teacher Grace Bandagosa'),
(735, '08-05-2020 07:30:40 PM', 'update student Rose Ace'),
(736, '08-05-2020 07:31:03 PM', 'add new student hghgh gh'),
(737, '08-05-2020 07:31:28 PM', 'add new student bvb bv'),
(738, '08-05-2020 07:31:51 PM', 'add new subject miming - bvb'),
(739, '08-05-2020 07:34:05 PM', 'add new subject meowlko - bhb'),
(740, '08-05-2020 07:34:28 PM', 'add new subject meowlko - dbs'),
(741, '08-05-2020 07:36:22 PM', 'add new subject 4 - hbh'),
(742, '08-05-2020 07:37:37 PM', 'add new subject hbhb - bh'),
(743, '08-05-2020 07:39:04 PM', 'add new subject hbhb - bh'),
(744, '08-05-2020 07:42:05 PM', 'add new subject hbhb - bh'),
(745, '08-05-2020 07:42:30 PM', 'add new subject mik - 12'),
(746, '08-05-2020 07:43:03 PM', 'add new student g gh'),
(747, '08-05-2020 07:43:29 PM', 'create new class bscs II - Irregular with the subject of ajdjgir123'),
(748, '08-05-2020 07:43:58 PM', 'create new class bscs IV - Irregular with the subject of ajdjgir123'),
(749, '08-05-2020 07:44:29 PM', 'assign teacher Juana Dela Cruz to class bscs II-Irregular with the subject of ajdjgir123'),
(750, '08-05-2020 07:44:48 PM', 'add student anding estribo to class bscs I-Irregular with the subject of asddf4'),
(751, '08-05-2020 07:49:21 PM', 'update class bscs I - Irregular with the subject of asddf4'),
(752, '08-05-2020 07:49:38 PM', 'admin logged out.'),
(753, '08-05-2020 07:53:26 PM', 'admin logged out.'),
(754, '08-05-2020 07:54:06 PM', 'meow changed his/her password.'),
(755, '08-05-2020 07:54:27 PM', 'meow logged out.'),
(756, '08-05-2020 07:55:45 PM', 'admin logged out.'),
(757, '08-05-2020 08:02:37 PM', 'delete asddf4 from class'),
(758, '08-05-2020 08:02:43 PM', 'delete ajdjgir123 from class'),
(759, '08-05-2020 08:02:48 PM', 'delete ajdjgir123 from class'),
(760, '08-05-2020 08:03:34 PM', 'add new subject awit lods - meow'),
(761, '08-05-2020 08:03:49 PM', 'delete bvb from student'),
(762, '08-05-2020 08:03:57 PM', 'delete ygy from student'),
(763, '08-05-2020 08:04:20 PM', 'delete dj from student'),
(764, '08-05-2020 08:04:24 PM', 'delete g from student'),
(765, '08-05-2020 08:04:29 PM', 'delete hghgh from student'),
(766, '08-05-2020 08:05:27 PM', 'add account with the username of T12345'),
(767, '08-05-2020 08:05:43 PM', 'admin logged out.'),
(768, '08-05-2020 08:06:42 PM', 'T12345 changed his/her password.'),
(769, '08-05-2020 08:06:48 PM', 'T12345 logged out.'),
(770, '08-05-2020 08:10:18 PM', ' logged out.'),
(771, '08-05-2020 08:20:05 PM', 'T12345 logged out.'),
(772, '08-05-2020 08:22:19 PM', 'update password of username T12345'),
(773, '08-05-2020 08:22:26 PM', 'admin logged out.'),
(774, '08-05-2020 08:22:50 PM', 'T12345 changed his/her password.'),
(775, '08-05-2020 08:23:05 PM', 'T12345 changed his/her password.'),
(776, '08-05-2020 08:23:19 PM', 'T12345 logged out.'),
(777, '08-06-2020 01:51:18 AM', 'update password of username T12345'),
(778, '08-06-2020 01:51:28 AM', 'admin logged out.'),
(779, '08-06-2020 01:52:02 AM', 'T12345 changed his/her password.'),
(780, '08-06-2020 01:52:29 AM', 'T12345 changed his/her password.'),
(781, '08-06-2020 03:03:02 AM', 'T12345 logged out.'),
(782, '08-06-2020 03:03:36 AM', 'add new teacher Grace Bandagosa'),
(783, '08-06-2020 03:03:36 AM', 'add account with the username of T123'),
(784, '08-06-2020 03:04:06 AM', 'update teacher Gracia Bandagosa'),
(785, '08-06-2020 07:17:23 AM', 'admin logged out.'),
(786, '08-06-2020 07:18:45 AM', 'admin logged out.'),
(787, '08-06-2020 07:20:15 AM', 'admin logged out.'),
(788, '08-06-2020 07:25:21 AM', 'T123 changed his/her password.'),
(789, '08-06-2020 07:25:46 AM', 'add account with the username of T12345'),
(790, '08-06-2020 07:25:57 AM', 'admin logged out.'),
(791, '08-06-2020 07:26:12 AM', 'T123 logged out.'),
(792, '08-06-2020 07:26:55 AM', 'T12345 changed his/her password.'),
(793, '08-06-2020 07:29:21 AM', 'T12345 logged out.'),
(794, '08-06-2020 07:29:41 AM', 'admin logged out.'),
(795, '08-06-2020 07:37:41 AM', 'admin logged out.'),
(796, '08-06-2020 07:39:57 AM', 'T123 logged out.'),
(797, '08-06-2020 07:49:08 AM', 'assign teacher Gracia Bandagosa to class BSCS III-A4-1AM with the subject of DS123'),
(798, '08-06-2020 07:49:41 AM', 'add student anding estribo to class BSCS III-A4-1AM with the subject of DS123'),
(799, '08-06-2020 07:59:01 AM', 'admin logged out.'),
(800, '08-06-2020 10:10:26 AM', 'update password of username T12345'),
(801, '08-06-2020 10:10:31 AM', 'admin logged out.'),
(802, '08-07-2020 09:05:28 PM', 'admin logged out.'),
(803, '08-08-2020 10:22:48 AM', 'T123 logged out.'),
(804, '08-08-2020 08:05:22 PM', 'add student Gracia Bandagosa to class BSCS III-A4-1AM with the subject of DS123'),
(805, '08-08-2020 08:19:40 PM', 'admin logged out.'),
(806, '08-09-2020 06:33:17 AM', 'admin logged out.'),
(807, '08-09-2020 06:33:45 AM', 'T12345 logged out.'),
(808, '08-09-2020 06:34:13 AM', 'T12345 logged out.'),
(809, '08-09-2020 06:35:01 AM', 'admin logged out.'),
(810, '08-09-2020 06:37:56 AM', 'add student Rose Ace to class BSCS III-Irregular with the subject of CS12'),
(811, '08-09-2020 06:44:31 AM', 'admin logged out.'),
(812, '08-09-2020 06:51:27 AM', 'admin logged out.'),
(813, '08-09-2020 06:52:12 AM', 'admin logged out.'),
(814, '08-09-2020 07:29:03 AM', 'T123 logged out.');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `status`) VALUES
(11, 'A4-1AM', 0),
(12, 'A4-2AM', 0),
(13, 'Quiz1', 0),
(14, 'Irregular', 0),
(15, 'test', 0),
(16, 'Irregular', 1),
(17, 'A4-AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `xname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `studid`, `fname`, `mname`, `lname`, `xname`) VALUES
(55, '16-00402', 'Maria', '', 'Fuente', ''),
(57, '16-00404', 'Rose', 'anna', 'Ace', 'jr'),
(59, '16-00405', 'Grace', '', 'Bandagosa', ''),
(60, '16-00406', 'Ben', '', 'Tambling', ''),
(61, 'T12345', 'anding', 'Maneclang', 'estribo', ''),
(64, 'T2345', 'Andrea', '', 'Estribo', ''),
(68, 'sad', 'Gracia', '', 'Bandagosa', '');

-- --------------------------------------------------------

--
-- Table structure for table `studentsubject`
--

CREATE TABLE `studentsubject` (
  `id` int(11) NOT NULL,
  `studid` varchar(50) NOT NULL,
  `classid` int(11) NOT NULL,
  `act1` float DEFAULT NULL,
  `act2` float DEFAULT NULL,
  `act3` float DEFAULT NULL,
  `hoe1` float DEFAULT NULL,
  `hoe2` float DEFAULT NULL,
  `hoe3` float DEFAULT NULL,
  `ass1` float DEFAULT NULL,
  `ass2` float DEFAULT NULL,
  `ass3` float DEFAULT NULL,
  `att1` float DEFAULT NULL,
  `att2` float DEFAULT NULL,
  `att3` float DEFAULT NULL,
  `exam1` float DEFAULT NULL,
  `exam2` float DEFAULT NULL,
  `exam3` float DEFAULT NULL,
  `quiz1` float DEFAULT NULL,
  `quiz2` float DEFAULT NULL,
  `quiz3` float DEFAULT NULL,
  `project1` float DEFAULT NULL,
  `project2` float DEFAULT NULL,
  `project3` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `unit` int(11) NOT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `code`, `title`, `unit`, `teacherid`, `status`) VALUES
(28, 'DS123', 'Data Structure', 3, 30, 1),
(29, 'DS321', 'Data Structure', 3, 24, 0),
(30, 'SC123', 'Social Science', 3, 24, 1),
(31, 'ajdjgir123', 'Software eng', 3, 31, 0),
(32, 'hsus', '1sz', 1, 24, 0),
(33, '8', 'j', 3, 24, 0),
(34, 'adjkjfr', 'math', 1, 33, 0),
(35, 'jzjs', 'jsus', 3, 24, 0),
(36, 'jzjs', 'jsus', 3, 24, 0),
(37, 'meoe', 'mroww', 5, 24, 0),
(38, 'CS12', 'Database', 3, 34, 1),
(39, 'asddf4', 'software', 3, 33, 0),
(40, 'hbhb', 'bh', 2, NULL, 0),
(41, 'mik', '12', 4, NULL, 0),
(42, 'awit lods', 'meow', 2, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `teachid` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `xname` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `username`, `password`, `fname`, `lname`, `level`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria_class`
--
ALTER TABLE `criteria_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria_teacher`
--
ALTER TABLE `criteria_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gradingsystem`
--
ALTER TABLE `gradingsystem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentsubject`
--
ALTER TABLE `studentsubject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `criteria_class`
--
ALTER TABLE `criteria_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `criteria_teacher`
--
ALTER TABLE `criteria_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `gradingsystem`
--
ALTER TABLE `gradingsystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=815;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `studentsubject`
--
ALTER TABLE `studentsubject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
