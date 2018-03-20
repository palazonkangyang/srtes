-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2018 at 03:34 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srcusers`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `idsrc_departments` int(11) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `deptdesc` text,
  `dept_head` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `dept_ro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`idsrc_departments`, `department`, `deptdesc`, `dept_head`, `updated_at`, `created_at`, `dept_ro`) VALUES
(1, 'BDRP', 'Blood Donor Recruitment Programme', 121, '2016-07-25 11:53:05', NULL, 21),
(2, 'CCM', 'Corporate Communications & Marketing', 88, '2016-07-25 11:53:13', NULL, 118),
(3, 'FR', 'Fund Raising', 189, '2016-07-25 11:54:47', NULL, 118),
(4, 'IS', 'International Services', 117, '2016-07-25 11:54:54', NULL, 21),
(5, 'RCHD', 'Red Cross Home for the Disabled', 65, '2016-07-25 11:55:02', NULL, 21),
(6, 'SRCA', 'Singapore Red Cross Academy', 78, '2016-07-25 11:55:08', NULL, 21),
(7, 'MVD', 'Membership & Volunteer Development', 74, '2016-07-25 11:55:14', NULL, 45),
(8, 'SGO', 'Secretariat Office', 21, '2016-07-25 11:55:24', NULL, 118),
(9, 'HR', 'Human Resource', 239, '2017-11-07 17:16:04', NULL, 118),
(10, 'CS', 'Community Services', 206, '2017-01-11 10:07:10', NULL, 45),
(11, 'RCY', 'Red Cross Youth', 235, '2017-03-14 15:16:54', NULL, 236),
(12, 'FIN', 'Finance', 237, '2017-12-29 11:01:23', NULL, 237),
(13, 'ADM', 'Administration and IT', 19, '2016-07-26 17:11:20', NULL, 118),
(14, 'PUD', 'Purchasing Department', 172, '2017-01-16 17:46:33', '2017-01-16 17:46:33', 118);

-- --------------------------------------------------------

--
-- Table structure for table `temp_approver_users`
--

CREATE TABLE `temp_approver_users` (
  `id` int(11) NOT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `temp_approver_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_approver_users`
--

INSERT INTO `temp_approver_users` (`id`, `start_datetime`, `end_datetime`, `user_id`, `temp_approver_id`, `created_at`, `updated_at`) VALUES
(1, '2018-01-15 18:19:05', '2018-01-15 18:19:13', 237, 145, '2018-01-15 18:19:05', '2018-01-15 18:19:13'),
(2, '2018-01-16 09:41:47', '2018-01-16 09:42:10', 237, 2, '2018-01-16 09:41:47', '2018-01-16 09:42:10'),
(3, '2018-01-16 10:03:11', '2018-01-25 09:40:26', 237, 212, '2018-01-16 10:03:11', '2018-01-25 09:40:26'),
(4, '2018-01-25 09:46:14', '2018-02-14 16:43:53', 237, 2, '2018-01-25 09:46:14', '2018-02-14 16:43:53'),
(5, '2018-02-14 16:45:33', NULL, 2, 212, '2018-02-14 16:45:33', '2018-02-14 16:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idsrc_login` int(11) NOT NULL,
  `loginid` varchar(80) NOT NULL DEFAULT '',
  `passwd` varchar(64) DEFAULT NULL,
  `pwsalt` varchar(10) DEFAULT NULL,
  `loginname` varchar(100) DEFAULT NULL,
  `emailadd` varchar(100) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `isactive` smallint(6) DEFAULT NULL,
  `modby` varchar(80) DEFAULT NULL,
  `remarks` text,
  `islocal` smallint(6) DEFAULT NULL,
  `roleid` int(6) DEFAULT NULL,
  `deptid` int(11) DEFAULT NULL,
  `pwdreset` tinyint(4) DEFAULT '0',
  `inoffice` tinyint(4) DEFAULT '0',
  `temp_approver_id` int(11) DEFAULT NULL,
  `postlogin` datetime DEFAULT NULL,
  `employeeid` varchar(255) DEFAULT NULL,
  `moddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idsrc_login`, `loginid`, `passwd`, `pwsalt`, `loginname`, `emailadd`, `lastlogin`, `isactive`, `modby`, `remarks`, `islocal`, `roleid`, `deptid`, `pwdreset`, `inoffice`, `temp_approver_id`, `postlogin`, `employeeid`, `moddate`) VALUES
(2, 'madmin', '$2y$10$n8WEb0FdisEAoD7ODQzdO.JH9.cf140wdTeo4UsZv1ueFmErQ/p92', NULL, 'Super Administrator', 'palazon@redcross.sg', '2018-02-13 18:10:38', 1, 'madmin', NULL, 1, -1, 12, 2, 1, 212, '2018-02-20 09:34:29', 'PALA000', '2018-02-20 09:34:29'),
(19, 'jerry.tan', '$2y$10$X4ydUFliwf6ObuPz8TV2aOYGNYXKHIk7UBdrdBEJdX2BmHb1s1U52', NULL, 'Jerry Tan', 'jerry.tan@redcross.sg', '2017-04-20 17:28:00', 1, 'madmin', NULL, 1, 3, 13, 9, 1, 120, '2017-06-12 16:34:08', 'SRC172', '2017-08-07 15:26:28'),
(21, 'benjamin.william', '$2y$10$Trd51NyqRKAlR3C2RqgpC.qx/5hk19V1f.U0goLd20u95dUDcehky', NULL, 'Benjamin William', 'benjamin.william@redcross.sg', '2016-08-22 16:50:57', 1, 'admin', '', 1, 2, 8, 1, NULL, NULL, NULL, 'SRC044', '2017-01-24 10:13:12'),
(22, 'elsie.tan', '$2y$10$eWAlOCrFrW84nZ4jLHIhY.OxzAUQ63cNeiyaUDwkuTi9hDbJGbxrq', NULL, 'Elsie Tan', 'elsie.tan@redcross.sg', '2015-10-28 03:36:48', 1, 'admin', '', 1, 5, 8, 2, NULL, NULL, NULL, 'SRC008', '2017-01-24 10:10:05'),
(45, 'sahari.ani', '$2y$10$ed1MAwcprxPQh3uvgvGoEeTd2kQXX.NFsrQRKB/4xg6v0tDvrZjLe', NULL, 'Sahari Ani', 'sahari.ani@redcross.sg', '2016-10-31 15:42:19', 1, 'admin', NULL, 1, 4, 8, 2, NULL, NULL, NULL, 'SRC088', '2017-01-24 09:57:33'),
(57, 'sherlee.c', '$2y$10$gpO1Zeemyx6X.qR2T8Hgk.2fPeKvK9Lv5jeCCWn3PdkxbMn9Xrvhq', NULL, 'Sherlee Choliluddin', 'sherlee.c@redcross.sg', '2016-08-04 12:51:13', 1, 'admin', NULL, 1, 3, 9, 1, 0, NULL, NULL, 'SRC126', '2017-01-24 09:55:34'),
(59, 'july.deleon', '$2y$10$dfDFBvFQSqrhQLfUKNN9ousyn0FfGSH9ZSpPYW2Ei5J6vMaX6jYsm', NULL, 'De Leon July Reyes', 'july.deleon@redcross.sg', '2016-08-19 17:10:06', 1, 'admin', NULL, 1, 4, 9, 1, NULL, NULL, NULL, 'SRC089', '2017-01-24 09:55:25'),
(61, 'layteng.chua', '$2y$10$YlAXr1jn3OQCwxWH9OPOf.hzqfSZlTZgSBIYqnbqTyQsAm0cEg/vW', NULL, 'Chua Lay Teng', 'layteng.chua@redcross.sg', '2016-11-17 11:24:33', 1, 'admin', NULL, 1, 4, 7, 2, NULL, NULL, NULL, 'SRC052', '2017-01-24 10:03:31'),
(65, 'serene.chia', '$2y$10$t6q8W9M9qSmiySyOygNpUOd49H3W..EuClRgXXPHISEez8y4DL382', NULL, 'Serene Chia', 'serene.chia@redcross.sg', '2017-01-20 16:26:39', 1, 'admin', NULL, 1, 4, 8, 5, NULL, NULL, NULL, 'SRC021', '2017-01-24 10:05:51'),
(67, 'kenneth.ng', '$2y$10$n.sHsZ2.my3zSbqN1IT6euHjfc89wX93KnNRDJp/gygx4u.AajkXi', NULL, 'Kenneth Ng', 'kenneth.ng@redcross.sg', '2017-01-23 10:13:04', 1, 'admin', NULL, 1, 4, 5, 1, NULL, NULL, NULL, 'SRC085', '2017-01-24 10:06:11'),
(74, 'angeline.yong', '$2y$10$mc78ppEGqEvUATsUmRcy/OlaVtZb7oUHmuFmFSVBNKbG7H3r3pakW', NULL, 'Angeline Yong', 'angeline.yong@redcross.sg', '2016-08-31 11:30:56', 1, 'admin', NULL, 1, 3, 7, 5, 0, NULL, NULL, 'SRC082', '2017-01-24 10:03:50'),
(78, 'faiszah.ahamid', '$2y$10$aewQ./DiPTyP.F/cgsaM9.NQUKWk7k21cRueRaugdLbvqHDv0uLAm', NULL, 'Faiszah Binte Abdul Hamid', 'faiszah.ahamid@redcross.sg', '2016-02-01 10:08:06', 1, 'admin', NULL, 1, 3, 6, 1, NULL, NULL, NULL, 'SRC034', '2017-01-24 10:14:15'),
(84, 'george.tai', '$2y$10$sGgOk8zdVkrJAfhmZYUHLeNUqto.fVsWwwNoCTFQ7OokemBVAtcaq', NULL, 'Tai Keong Wei, George', 'george.tai@redcross.sg', '2016-08-31 11:29:25', 1, 'admin', NULL, 1, 4, 7, 1, NULL, NULL, NULL, 'SRC155', '2017-01-24 10:04:21'),
(85, 'nadiya.mohdnoor', '$2y$10$9bKLdSrfbojwbF6R/zAGce.7YYp0WPtzdTrsZEjx7jFQaPAZ8p7We', NULL, 'Nadiya Binte Mohd Noor', 'nadiya.mohdnoor@redcross.sg', '2015-09-18 03:54:45', 1, 'admin', NULL, 1, 5, 6, 1, NULL, NULL, NULL, 'SRC129', '2017-01-24 10:14:31'),
(86, 'nurul.labib', '$2y$10$jUTCjaCBpN67ZIUBMwzhF.lQ5nkW1MLCYDGbrDav90nAMrkgyUGKi', NULL, 'Nurulazhana Labib', 'nurul.labib@redcross.sg', '2017-01-13 11:47:51', 1, 'admin', NULL, 1, 5, 6, 1, NULL, NULL, NULL, 'SRC063', '2017-01-24 10:15:52'),
(88, 'eileen.cher', '$2y$10$dMR84eApRX90eCVytYK2xeZHFMKcPgGGJH1YLXsjNXNArntqxXVcW', NULL, 'Eileen Cher', 'eileen.cher@redcross.sg', '2017-01-04 10:17:05', 1, 'admin', NULL, 1, 3, 2, 4, NULL, NULL, NULL, 'SRC031', '2017-01-24 09:50:11'),
(89, 'nanting.hsu', '$2y$10$zRW6YKgAenIDJUPm7UDFd.ofh3RZqyIxbtNCQfsEzupnAttk1OGiq', NULL, 'Hsu Nan-Ting', 'nanting.hsu@redcross.sg', '2017-01-20 16:10:37', 1, 'admin', NULL, 1, 3, 2, 4, NULL, NULL, NULL, 'SRC075', '2017-01-24 09:50:31'),
(90, 'sondra.foo', '$2y$10$g6Ne3NJInEnuxxDsEh8Aju8lFhOAYbg8oVQ.7MhqizMGXOJaGnykO', NULL, 'Sondra Foo', 'sondra.foo@redcross.sg', '2015-10-08 08:20:35', 1, 'admin', NULL, 1, 4, 2, 1, NULL, NULL, NULL, 'SRC033', '2017-01-24 09:50:20'),
(94, 'candace.zhou', '$2y$10$j0ngRNXUgUFApf5hmCPYNOqJRaGvb6cXjSungqLqpbxHxsNB0ZeD.', NULL, 'Zhou Shuyi, Candace', 'candace.zhou@redcross.sg', NULL, 1, 'admin', NULL, 1, 5, 1, 2, NULL, NULL, NULL, 'SRC150', '2017-01-24 09:45:44'),
(96, 'azhveena.sabikon', '$2y$10$P7bCz7/o/.OGIqcESw1M.ugAS3sv5Lpw27coPVHPn7ipuO0b4f.T2', NULL, 'Azhveena Shakin Jan', 'azhveena.sabikon@redcross.sg', '2017-01-04 10:04:26', 1, 'admin', NULL, 1, 5, 3, 1, NULL, NULL, NULL, 'SRC099', '2017-01-24 09:52:32'),
(99, 'kartini.saat', '$2y$10$yBW89NstNtjJnyKo/87Gk.LMd6/XLSgRb90piR6Ob9aIUhwwKmu8u', NULL, 'Kartini Binte Saat', 'kartini.saat@redcross.sg', '2017-01-05 14:23:48', 1, 'admin', NULL, 1, 5, 10, 4, NULL, NULL, NULL, 'SRC032', '2017-01-24 09:49:21'),
(100, 'fara.roslan', '$2y$10$e95i9RO75urRNaSCWFpfFuc6fffu.RD9TkX7Xai0bgNiz265agXt2', NULL, 'Fara Roslan', 'fara.roslan@redcross.sg', '2017-01-19 11:43:14', 1, 'admin', NULL, 1, 4, 10, 2, NULL, NULL, NULL, 'SRC023', '2017-01-24 09:47:50'),
(102, 'celesta.chee', '$2y$10$vOn7yTsMeph.jYGAoZ0hLuah0DKF8CvVNUKeuVhC2Q5Q.gA3Ge8yO', NULL, 'Celesta Chee', 'celesta.chee@redcross.sg', '2015-10-21 02:15:50', 1, 'admin', NULL, 1, 4, 10, 1, NULL, NULL, NULL, 'SRC097', '2017-01-24 09:48:30'),
(104, 'peishan.lim', '$2y$10$ZipnxYc4jF6ds3eg5x9lOehB0Fy/YMt9ImXSFizAppYwOSS6q5e26', NULL, 'Lim Pei Shan', 'peishan.lim@redcross.sg', '2016-12-06 17:37:50', 1, 'admin', NULL, 1, 4, 4, 1, NULL, NULL, NULL, 'SRC057', '2017-01-24 09:56:39'),
(105, 'karine.tan', '$2y$10$B4hxc22zidB7EzvxY0.Y5.XzmxAw/u7kw23AwRsF/DdBqC2cO7aU6', NULL, 'Karine Tan', 'karine.tan@redcross.sg', '2016-10-21 09:30:34', 1, 'admin', NULL, 1, 4, 3, 1, NULL, NULL, NULL, 'SRC128', '2017-01-24 09:53:03'),
(106, 'selene.ong', '$2y$10$jLq/s1NPDQX1RNQ/EP0nE.t8E8l3OXCm23w3BosihcNF09WwGBYf2', NULL, 'Selene Ong', 'selene.ong@redcross.sg', '2016-11-02 17:33:56', 1, 'admin', NULL, 1, 4, 10, 1, NULL, NULL, NULL, 'SRC149', '2017-01-24 09:53:25'),
(107, 'faridah.tengku', '$2y$10$2C3lx.T1KcmzHe53h0umbexTgh8R/hVvh/IZiIwzEO6fukk/gGvSK', NULL, 'Faridah Binte Tengku Ariffin', 'faridah.tengku@redcross.sg', '2017-01-17 14:57:33', 1, 'admin', NULL, 1, 5, 3, 3, 0, NULL, NULL, 'SRC125', '2017-01-24 09:52:42'),
(108, 'shirley.ng', '$2y$10$haF.NvjcROViMfXwF.eveuWdGWwyJc4Q90OE7Y.SCTIgMtWcUSq.y', NULL, 'Shirley Ng', 'shirley.ng@redcross.sg', '2017-01-19 18:15:03', 1, 'admin', NULL, 1, 4, 1, 2, NULL, NULL, NULL, 'SRC116', '2017-01-24 09:45:09'),
(110, 'michael.lim', '$2y$10$HINIuMVK.7cdjLZcK1tDd.S/MHsA.bL/mb017cvMUJOHB6X3m7Ia2', NULL, 'Michael Lim', 'michael.lim@redcross.sg', '2016-11-24 17:36:11', 1, 'admin', NULL, 1, 4, 7, 1, NULL, NULL, NULL, 'SRC161', '2017-01-24 10:04:47'),
(113, 'sitihumaira.sumri', '$2y$10$W9b6Jfe0An1fnKNLNPc6F.I4OljGhuR/u90krVGvkRdSVtVn4MNjS', NULL, 'Siti Humaira Binte Sumri', 'sitihumaira.sumri@redcross.sg', '2016-09-21 11:59:11', 1, 'admin', NULL, 1, 4, 6, 2, NULL, NULL, NULL, 'SRC141', '2017-01-24 10:17:03'),
(115, 'rose.toh', '$2y$10$NLqIRB4oHlhpBz/YVa9pNeWFReqgvHTmaAUcAOjr.sx1.mye6tr2C', NULL, 'Rose Toh', 'rose.toh@redcross.sg', '2016-09-19 17:50:50', 1, 'admin', NULL, 1, 5, 6, 1, NULL, NULL, NULL, 'SRC048', '2017-01-24 10:17:34'),
(116, 'khairani.kamil', '$2y$10$Rdz.YUIBHBBo4MJfVPvRXeP1N3o6jVlSwb45DrQub.9CHz7mvLZ0i', NULL, 'Khairani Kamil', 'khairani.kamil@redcross.sg', '2016-11-10 11:56:09', 1, 'admin', NULL, 1, 5, 6, 4, NULL, NULL, NULL, 'SRC169', '2017-01-24 10:18:13'),
(117, 'charis.chan', '$2y$10$rPF.iOGRcW7SLDHQ8/6W8.94lQJBjgRFVkx9UpH6iYezPOlqWOK4C', NULL, 'Charis Chan', 'charis.chan@redcross.sg', '2016-09-20 09:58:34', 1, 'admin', NULL, 1, 3, 4, 2, NULL, NULL, NULL, 'SRC051', '2017-01-24 09:56:28'),
(118, 'steven.choo', '$2y$10$/wOkV7KAvCuf.SVqODA/oee.DZ6EurFFeYxecnlsdga8YE0MuhD2C', NULL, 'Steven Choo', 'steven.choo@redcross.sg', '2015-09-01 07:16:09', 1, 'admin', NULL, 1, 2, 8, 3, NULL, NULL, NULL, 'SRC167', '2017-01-24 10:13:36'),
(120, 'simonjoshua.tang', '$2y$10$oXcwuCe.n09GQlRonFdIm.rg.0Gr6mmiWKLLqAXKVd146.TqNH96O', NULL, 'Simon Joshua Tang', 'simonjoshua.tang@redcross.sg', NULL, 1, 'admin', NULL, 1, 4, 13, 2, NULL, NULL, NULL, 'SRC143', '2017-01-24 09:43:33'),
(121, 'robert.teo', '$2y$10$SCxkMBnQQZ.L3bVawx9CkeoysDbJVk4czMp90iW2T.VlxKgr3lEVG', NULL, 'Robert Teo', 'robert.teo@redcross.sg', '2017-01-20 13:34:32', 1, 'admin', NULL, 1, 3, 1, 2, NULL, NULL, NULL, 'SRC159', '2017-01-24 09:46:05'),
(122, 'vincent.toh', '$2y$10$M3qO8NF9ErXHF1kn06sP8eXBiuL4ZhpKYceIdzwV5tN7eReUAv07K', NULL, 'Vincent Toh', 'vincent.toh@redcross.sg', '2016-05-17 11:19:21', 1, 'admin', NULL, 1, 4, 11, 3, NULL, NULL, '2017-03-20 01:12:44', 'SRC146', '2017-03-20 01:12:44'),
(124, 'ambrose.lee', '$2y$10$ndV6GXPx4080b8YkF.4vf.P87vPYI3V4Fn6EH/Kd/x2wkDKTGQ0SO', NULL, 'Ambrose Lee', 'ambrose.lee@redcross.sg', '2016-02-18 10:18:10', 1, 'admin', NULL, 1, 3, 6, 1, NULL, NULL, NULL, 'SRC122', '2017-01-24 10:18:49'),
(125, 'alex.chan', '$2y$10$nxehZJyyUw7WY8VR6UIG6uohBrYlDA/JuMCAl1s4unimUEEGJtMoG', NULL, 'Alex Chan', 'alex.chan@redcross.sg', '2017-01-04 18:07:41', 1, 'admin', NULL, 1, 5, 5, 2, NULL, NULL, NULL, 'SRC103', '2017-01-24 10:06:43'),
(129, 'michelle.seah', '$2y$10$N5XspWt.uG11UesIM3IBuuR4d3phzdeHJmGWGEdxeRG8DoNB9QhfG', NULL, 'Seah Mi Xuan Michelle', 'michelle.seah@redcross.sg', '2017-01-10 14:23:17', 1, 'admin', NULL, 1, 5, 6, 1, NULL, NULL, NULL, 'SRC177', '2017-01-24 10:20:37'),
(131, 'zakirah.johari', '$2y$10$Yfj5Zfc277oI82NHkbb6yuXn3zHQSkK35akwYI7udPQZERzHeqbsK', NULL, 'Zakirah Binte Johari', 'zakirah.johari@redcross.sg', '2016-11-21 16:01:04', 1, 'admin', NULL, 1, 5, 5, 1, NULL, NULL, NULL, 'SRC174', '2017-01-24 10:07:02'),
(133, 'huichun.ng', '$2y$10$Bq.WfU7G6/10BvSUHKupkOGQRXAjaGMR9RbcWgmEPUZ99ljViIjOa', NULL, 'Ng Hui Chun', 'huichun.ng@redcross.sg', '2016-04-28 15:55:33', 1, 'admin', NULL, 1, 4, 11, 1, 0, NULL, '2017-03-14 15:11:11', 'SRC068', '2017-03-14 15:11:11'),
(134, 'sweekim.chia', '$2y$10$S0Uu5B6NG5BpK9RvDJhJA.yyUaVudAK4/rI9fZQMVvZ9JGzt6.ARO', NULL, 'Chia Swee Kim', 'sweekim.chia@redcross.sg', '2017-01-18 09:50:29', 1, 'admin', NULL, 1, 4, 4, 1, NULL, NULL, NULL, 'SRC022', '2017-01-24 09:56:11'),
(135, 'siewhong.aw', '$2y$10$a1vZ8Htdk/p/cDv5YWJ6ueok.Q2jah458.QsuZ42BE84TjQHcCnRK', NULL, 'Aw Siew Hong', 'siewhong.aw@redcross.sg', '2017-01-20 11:14:13', 1, 'admin', NULL, 1, 5, 5, 1, NULL, NULL, NULL, 'SRC060', '2017-01-24 10:08:00'),
(137, 'khairani.rahman', '$2y$10$menS//EQ651oS2Y5tRktkeCca69ccNVOfbNulj4ceKjc7htysqOJO', NULL, 'Khairani Bte Abdul Rahman', 'khairani.rahman@redcross.sg', '2017-01-13 17:23:29', 1, 'admin', NULL, 1, 5, 11, 2, NULL, NULL, NULL, 'SRC011', '2017-01-24 10:08:49'),
(138, 'adeline.chong', '$2y$10$hVWvWjdrqxSTBYNRej96Ee0YKn8UYaRzjGl50ybwDiqGoROPiNFFG', NULL, 'Adeline Chong', 'adeline.chong@redcross.sg', '2017-01-03 13:41:56', 1, 'admin', NULL, 1, 5, 13, 1, NULL, NULL, NULL, 'SRC062', '2017-01-24 09:42:47'),
(139, 'irene.ho', '$2y$10$6h2e2FmrqFnhyZZZ77L1CeRKDjoUQDIjDA6Vb8fqnkbRd5qD3BGWa', NULL, 'Irene Ho', 'irene.ho@redcross.sg', '2016-03-30 14:38:50', 1, 'admin', NULL, 1, 5, 13, 3, NULL, NULL, NULL, 'SRC105', '2017-01-24 09:43:07'),
(140, 'tianwei.tan', '$2y$10$/hXUVAXtPrEu0KxU17EV8u3uttV/ySOFNmlcF61LRo.8xnnSoJgR2', NULL, 'Tan Tian Wei', 'tianwei.tan@redcross.sg', '2017-01-20 13:56:21', 1, 'admin', NULL, 1, 5, 1, 1, NULL, NULL, NULL, 'SRC157', '2017-01-24 09:45:55'),
(141, 'stephanie.dewitt', '$2y$10$t51v24TVUzWNHAufnhsDQeOyWSfZIX3V1O.Pzl9eHYGj8/Ah7fsBK', NULL, 'Stephanie Sheila De Witt', 'stephanie.dewitt@redcross.sg', '2017-01-23 09:37:35', 1, 'admin', NULL, 1, 5, 4, 1, NULL, NULL, NULL, 'SRC039', '2017-01-24 09:56:20'),
(144, 'william.ng', '$2y$10$n18NXjtwO5s2qrRmVQC5D.2F8f3KDGqazHgjgiAxRekTZA3JHHFLO', NULL, 'William Ng', 'william.ng@redcross.sg', '2016-11-25 15:37:10', 1, 'admin', NULL, 1, 5, 12, 1, 1, 145, '2017-06-20 12:40:16', 'SRC002', '2017-06-20 12:40:16'),
(145, 'serene.chew', '$2y$10$eE1Fs9xmPZQbxmkWvaUlW.uQEkU2b8EyFdA981e/THL30HpwZAcIG', NULL, 'Serene Chew', 'serene.chew@redcross.sg', '2016-11-11 16:51:07', 1, 'admin', NULL, 1, 4, 12, 1, NULL, NULL, NULL, 'SRC001', '2017-01-24 09:51:39'),
(147, 'isaac.tiong', '$2y$10$XTH5eKbp6UIXXcnVq/aePusHVxX.vc5yKh6vgdC4UrqXvmc6Sa5pK', NULL, 'Isaac Tiong', 'isaac.tiong@redcross.sg', '2017-01-20 09:45:56', 1, 'admin', NULL, 1, 3, 12, 1, NULL, NULL, '2017-07-27 11:08:00', 'SRC189', '2017-07-27 11:08:00'),
(148, 'christopher.goh', '$2y$10$jr0OBwux8tRKzTRTD7x9nuQNJipllJSlWID1CEx.L8ygSUlVgichu', NULL, 'Christopher Goh', 'christopher.goh@redcross.sg', '2017-01-20 10:32:43', 1, 'admin', NULL, 1, 4, 13, 2, NULL, NULL, NULL, 'SRC183', '2017-01-24 09:43:57'),
(150, 'account.palazon', '$2y$10$XoSU5youHd3R81B7rcLtWOxJlN5l5JDRfuUS/1.NsZSyuYz/H2Hgy', NULL, 'Account Palazon', 'account@palazon.com', '2016-09-28 18:50:36', 1, 'admin', NULL, 1, 1, 13, 3, 0, NULL, NULL, 'NA002', '2017-01-24 10:18:30'),
(151, 'gillian.chong', '$2y$10$7E8NVJLaG2eR/Yc7NSsSAOTLN5iA2jPXB3Gt27C/qcyuG3tcobrIG', NULL, 'Gillian Chong', 'gillian.chong@redcross.sg', '2016-12-20 16:26:43', 1, 'admin', NULL, 1, 4, 4, 1, 0, NULL, NULL, 'SRC182', '2017-01-24 09:56:52'),
(152, 'lipeng.chin', '$2y$10$bq38WxZCrUVLe38K.Tjw7.Q6ZUuklxgHaeMFjyv2YOLI3PsRV5inS', NULL, 'Lipeng Chin', 'lipeng.chin@redcross.sg', '2016-12-28 13:56:34', 1, 'admin', NULL, 1, 5, 1, 1, 0, NULL, NULL, 'SRC127', '2017-01-24 09:45:24'),
(153, 'guoxing.lee', '$2y$10$25mjbDB15iQZgxCL9vfDtu.fxE8SYvrQx2SIzitgj0fW9MA04SYYC', NULL, 'Guoxing Lee', 'guoxing.lee@redcross.sg', '2016-10-21 20:17:59', 1, 'admin', NULL, 1, 4, 5, 1, 0, NULL, NULL, 'SRC190', '2017-01-24 10:07:19'),
(154, 'beelee.kua', '$2y$10$JtKH4KENJ5cY6IsFWlIPSuYY/cBioPk9Yj1C6MlcMTsWNhRNHo/56', NULL, 'Beelee Kua', 'beelee.kua@redcross.sg', '2017-01-11 11:35:28', 1, 'admin', NULL, 1, 4, 5, 1, 0, NULL, NULL, 'SRC133', '2017-01-24 10:05:30'),
(156, 'simon.ng', '$2y$10$Jxil5I5knzdmRS06lTA9JuygWlJ8rE7BuCIMsDPGXpRtZm0kvlGjG', NULL, 'Simon Ng', 'simon.ng@redcross.sg', '2017-01-23 10:26:20', 1, 'admin', NULL, 1, 4, 13, 2, 0, NULL, NULL, 'SRC070', '2017-01-24 11:13:43'),
(158, 'donald.ho', '$2y$10$eYQ80jPGjyTZAIPrSkoCTe31Ay0rBh98xCdNYz2a4dyz4G5bdPfIK', NULL, 'Donald Ho', 'donald.ho@redcross.sg', '2016-01-14 09:42:33', 1, 'admin', NULL, 1, 5, 10, 1, 0, NULL, NULL, 'SRC013', '2017-01-24 09:49:41'),
(161, 'roslan.ibrahim', '$2y$10$nyB9h54iui7pe2Uy8FFJl.I3iG31KYEzql2IBELgBswWjreRH3QYm', NULL, 'Roslan Bin Ibrahim', 'roslan.ibrahim@redcross.sg', '2017-01-20 14:15:38', 1, 'admin', NULL, 1, 5, 10, 1, 0, NULL, NULL, 'SRC019', '2017-01-24 11:14:06'),
(164, 'elaine.taylor', '$2y$10$FZAntT0nj6uLhF/QpEShPOQEJo9zuHDeGpcfENrG1pDg9Ak3kD7Lq', NULL, 'Elaine Taylor', 'elaine.taylor@redcross.sg', '2016-02-01 13:34:25', 1, 'admin', NULL, 1, 5, 10, 2, 0, NULL, NULL, 'SRC196', '2017-01-24 09:48:49'),
(165, 'daryl.ee', '$2y$10$FETKmV6GXQDB3t6t1QaPR.Q1xM6scB9xPxzRSOtj8bpYmWdch8YJa', NULL, 'Daryl Ee', 'daryl.ee@redcross.sg', '2017-01-03 15:12:22', 1, 'admin', NULL, 1, 5, 11, 1, 0, NULL, NULL, 'SRC279', '2017-01-24 11:14:19'),
(167, 'kenneth.tan', '$2y$10$dc3BshCh99SlMNOd6EDnYeX36A4Kx3Y7pSwv.Plrzlu8PUUKjmUHW', NULL, 'Kenneth Tan', 'kenneth.tan@redcross.sg', '2016-12-28 14:14:32', 1, 'admin', NULL, 1, 5, 10, 4, 0, NULL, NULL, 'SRC007', '2017-01-24 09:48:16'),
(169, 'tester1', '$2y$10$yG.P/Vi2TebBYRYeX6hUk.DWKtLgznNy9F5GATAtcRlkBvgeXeySO', NULL, 'test', 'tester0@redcross.sg', '2017-10-02 10:38:58', 1, 'admin', NULL, NULL, 3, 11, 4, 0, NULL, '2017-10-02 10:26:44', 'NA001', '2017-10-02 10:38:58'),
(170, 'glynn.maung', '$2y$10$opW6pco312TXjCkYKX0GEOgAnFtirBik7eC60xrDvRKPhkUs90sxm', NULL, 'Glynn Maung Kan Ming', 'glynn.maung@redcross.sg', '2016-11-01 16:52:50', 1, 'admin', NULL, NULL, 4, 5, 1, 0, NULL, NULL, 'SRC100', '2017-01-24 10:06:27'),
(172, 'agnes.lam', '$2y$10$3pB9lQpuhJ52Em5JG4BW1u5jZvq9fLZvGJr8P1oF.5Mo70IR18Vu6', NULL, 'Agnes Lam', 'agnes.lam@redcross.sg', '2016-11-02 16:18:37', 1, 'admin', NULL, NULL, 4, 13, 0, 0, NULL, NULL, 'SRC213', '2017-01-24 09:44:07'),
(173, 'julie.khabir', '$2y$10$MYOM7PSzTqs/ZNi4o27yGeuc6MfpRuhIYPqxfDOxIwTj06FJ2chOa', NULL, 'Julie Bte Khabir', 'julie.khabir@redcross.sg', '2016-12-09 10:58:10', 1, 'admin', NULL, NULL, 5, 10, 0, 0, NULL, NULL, 'SRC015', '2017-01-24 09:47:41'),
(174, 'aidil.arsad', '$2y$10$lrLjQVAditKsvDsK9R.3deqWufspj08NGgiPfZKeX90ldkKRTt63O', NULL, 'Muhammad Aidil Bin Arsad', 'aidil.arsad@redcross.sg', NULL, 1, 'admin', NULL, NULL, 5, 5, 2, 0, NULL, NULL, 'SRC211', '2017-01-24 10:22:52'),
(176, 'zhenghui.zhuo', '$2y$10$MlaG3KcUFUgN5jC2HGZ7xeO5EVKtkmOXuv3iorluc9WFZbRFEaZCO', NULL, 'Zhuo Zheng Hui', 'zhenghui.zhuo@redcross.sg', '2016-09-29 14:43:40', 1, 'admin', NULL, NULL, 5, 13, 0, 0, NULL, NULL, 'SRC216', '2017-01-24 09:44:18'),
(178, 'katherine.tan', '$2y$10$m1t/gW1/FUN2qADcqX8Zge0YYL4W4aqWCyEtph60AclWwv78Zt3Cq', NULL, 'Katherine Tan', 'katherine.tan@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 6, 1, 0, NULL, NULL, 'SRC204', '2017-01-24 10:23:15'),
(179, 'garry.gan', '$2y$10$Jlc7B7B6JnzYJUrQXXXSzeO5h68D1dUUd/DjjJ3Wy1BdEhhPBGvku', NULL, 'Garry Gan', 'garry.gan@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 3, 1, 0, NULL, NULL, 'SRC203', '2017-01-24 09:53:34'),
(180, 'mindy.chng', '$2y$10$jcsOrAxIg6lP8yCnki9rqOA1EZZ0UP6.tEhCXcFp2cqQG60KzNJDG', NULL, 'Mindy Chng', 'mindy.chng@redcross.sg', '2016-05-10 17:20:43', 1, 'admin', NULL, NULL, 4, 9, 0, 0, NULL, NULL, 'SRC219', '2017-01-24 09:55:48'),
(182, 'agnotti.kassim', '$2y$10$6VrfJldtn.Tq5asPFVVJwelZB08St2tGdSLZG7m3yQIQlRC.5nOHq', NULL, 'Agnotti Mohamed Kassim', 'agnotti.kassim@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 2, 0, 0, NULL, NULL, 'SRC222', '2017-01-24 09:50:47'),
(184, 'rosnani.razak', '$2y$10$tn9oO7JecFnQnIEDG8xH9.DfbDHDtbZL2FTEPmF6Yrkyzi/aN2ps2', NULL, 'Rosnani Bte Razak', 'rosnani.razak@redcross.sg', '2017-01-20 09:31:17', 1, 'admin', NULL, NULL, 5, 1, 1, 0, NULL, NULL, 'SRC024', '2017-01-24 09:44:39'),
(185, 'admin', '$2y$10$RtoVIbsEa2JurH7ICxD8sOuyn9XceGEBeIM.ZUtK4m9V2d1pKcx2G', NULL, 'Administrator', 'it@redcross.sg', '2017-04-20 17:31:16', 1, 'admin', NULL, NULL, 1, 13, 0, 0, NULL, '2017-04-20 17:28:04', NULL, '2017-04-20 17:31:16'),
(188, 'sitinadhrah.mazlan', '$2y$10$VldPiDr7w9W9Ng4tzQqpHO8QTxMunLYQ9svL5AjCnGE1.23YJSAtC', NULL, 'Siti Nadhrah Binte Mazlan', 'sitinadhrah.mazlan@redcross.sg', '2016-06-01 13:19:36', 1, 'admin', NULL, NULL, 5, 6, 0, 0, NULL, NULL, 'SRC227', '2017-01-24 10:23:50'),
(189, 'christabel.koh', '$2y$10$eh92IeEiWLzlgNczVUSFKew6EvPhcr0w5JaQr9Z5NA70NbXxDbKu.', NULL, 'Christabel Koh', 'christabel.koh@redcross.sg', '2016-11-29 18:38:01', 1, 'admin', NULL, NULL, 4, 6, 0, 0, NULL, NULL, 'SRC223', '2017-01-24 10:26:39'),
(192, 'lina.mustafa', '$2y$10$.xowLFbPLjX59lfdoOlkSeeUMNB6J9k7YaFNOWY1Xo7GwFK3Gi8m.', NULL, 'Lina Farhana Mohd Mustafa', 'lina.mustafa@redcross.sg', '2016-06-07 17:53:17', 1, 'admin', NULL, NULL, 5, 1, 0, 0, NULL, NULL, 'SRC228', '2017-01-24 10:26:14'),
(193, 'chenghong.lim', '$2y$10$mEI2TNCSjQOwM9FWMD0LSuef4Jit4I.tVdSJ6D3OD.c1ZZeBp59Ui', NULL, 'Lim Cheng Hong', 'chenghong.lim@redcross.sg', '2017-01-18 08:19:53', 1, 'admin', NULL, NULL, 4, 1, 4, 0, NULL, NULL, 'SRC059', '2017-01-24 09:44:54'),
(194, 'leelin.loh', '$2y$10$PfjQjsMxqm3FghlQHpnGgebuqoDlR4wQkipsNe6c9Vb6U98MuXkra', NULL, 'Loh Lee Lin', 'leelin.loh@redcross.sg', '2016-09-16 15:05:30', 1, 'admin', NULL, NULL, 5, 1, 1, 0, NULL, NULL, 'SRC199', '2017-01-24 09:46:30'),
(196, 'stephen.desouza', '$2y$10$aKYuNPszT00j/UFS3v20FuFoesJLemq2SU27mLLgHYZxQLPqGM4.S', NULL, 'Stephen De Souza', 'stephen.desouza@redcross.sg', '2016-06-23 16:30:37', 1, 'admin', NULL, NULL, 4, 6, 1, 0, NULL, NULL, 'SRC017', '2017-01-24 10:25:48'),
(198, 'ruth.lim', '$2y$10$UcFgGXwQOPBdSU2rlY7aFufw.yMfe3I5jszxixXk1xFvPrqxL055y', NULL, 'Ruth Lim', 'ruth.lim@redcross.sg', '2016-08-25 09:39:58', 1, 'admin', NULL, NULL, 5, 1, 0, 0, NULL, NULL, 'SRC218', '2017-01-24 09:46:39'),
(199, 'kenny.liang@redcross.sg', '$2y$10$NR9Wm8j0HuPj2swFJeRzyOeJQBVK8H0xD8ssN8yvd1CjkZ5/utpu6', NULL, 'Kenny Liang', 'kenny.liang@redcross.sg', NULL, 1, 'admin', NULL, NULL, 5, 5, 0, 0, NULL, NULL, 'SRC231', '2017-01-24 10:25:26'),
(201, 'hamizah.mdnoor', '$2y$10$KH35jQv9qcusWM7iimv6meAVFrmGNzduAx3fQ/EiDSsA2nQUfHPOC', NULL, 'Hamizah Binte Mohamed Noor', 'hamizah.mdnoor@redcross.sg', '2016-12-08 17:29:31', 1, 'admin', NULL, NULL, 5, 7, 0, 0, NULL, NULL, 'SRC235', '2017-01-24 10:05:07'),
(202, 'atiqah.aminudin@redcross.sg', '$2y$10$aqDMdtooVGcBCf3IOoWJ2uW7Sdd3StPRCWH7x/nVdH8HHocoHmVCO', NULL, 'Siti Nur Atiqah Bte Aminudin', 'atiqah.aminudin@redcross.sg', '2016-11-11 17:16:15', 1, 'admin', NULL, NULL, 4, 11, 0, 0, NULL, '2017-03-14 15:10:14', 'SRC236', '2017-03-14 15:10:14'),
(203, 'yeethai.yip', '$2y$10$yUu2nAr4reigahKA7Pd8w.AaraxxCW8eo/KMg1njdLdNp4525IFwi', NULL, 'Yip Yee Thai', 'yeethai.yip@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 8, 0, 0, NULL, NULL, 'SRC240', '2017-01-24 10:13:50'),
(204, 'lukman.kasmani', '$2y$10$xmEjiaYeM4CfXj9G5yz/XeC8RZbNI3jFQ0lzLRQPbO//gOl/qcopy', NULL, 'Lukman Bin Kasmani Minhad', 'lukman.kasmani@redcross.sg', '2016-12-20 16:43:45', 1, 'admin', NULL, NULL, 4, 10, 0, 0, NULL, NULL, 'SRC237', '2017-01-24 09:50:00'),
(205, 'lilet.gonzaga', '$2y$10$0R0wkw7CrRhJw4PTW2CmouFoHWsZVHcUGAV0Ahyv/5GK383sqyS5W', NULL, 'Lilet Gonzaga', 'lilet.gonzaga@redcross.sg', NULL, 1, 'admin', NULL, NULL, 5, 1, 0, 0, NULL, NULL, 'SRC242', '2017-01-24 10:24:55'),
(206, 'sysadmin', '$2y$10$8907U2OBt2dBrX9R7reIc.aBK8hueT9ULcpqsLJ9SOGrUeDpfgZyS', NULL, 'sysadmin', 'allen.wong@palazon.com', '2016-08-17 15:27:18', 1, 'admin', NULL, NULL, 1, 13, 0, 0, NULL, NULL, 'NA003', '2017-01-24 10:24:16'),
(207, 'yuping.low', '$2y$10$.cvJ360hlLsJeocneUcYPe4ow1WDalar9dR4g/LDFTRwThXQ1YRZy', NULL, 'Low Yu Ping', 'yuping.low@redcross.sg', '2017-01-10 14:22:33', 1, 'admin', NULL, NULL, 5, 6, 2, 0, NULL, NULL, 'SRC243', '2017-01-24 10:24:35'),
(208, 'adele.tan', '$2y$10$qEasUxNKmtakND6pUBBF5OudWuq2RXwMnVeLXWgJhRCVjKErkCJ..', NULL, 'Adele Tan', 'adele.tan@redcross.sg', '2016-08-15 10:49:12', 1, 'admin', NULL, NULL, 4, 2, 0, 0, NULL, NULL, 'SRC245', '2017-01-24 09:51:00'),
(210, 'huiting.su', '$2y$10$1fRxqpkJTQzj4386LIWcGO8RU/bzjk0zsl/f1zqK5cYIM7boYwokG', NULL, 'Su Huiting', 'huiting.su@redcross.sg', NULL, 1, 'admin', NULL, NULL, 5, 10, 0, 0, NULL, NULL, 'SRC239', '2017-01-24 09:49:31'),
(211, 'prakash.menon', '$2y$10$nBjP9DQwHEC670jkgnoYM.SmlsJzDukYDGus5.MeOt./mDpNPgM/S', NULL, 'Prakash Menon Srikumaran', 'prakash.menon@redcross.sg', '2017-01-19 15:44:46', 1, 'admin', NULL, NULL, 3, 10, 1, 0, NULL, NULL, 'SRC238', '2017-01-24 09:48:02'),
(212, 'kimlin.ee', '$2y$10$3nIpyVro7te3eAzOQp2ie.R1GnhQCbMT0SKT2s1mF9OwMSvefCtwi', NULL, 'Ee Kim Lin', 'kimlin.ee@redcross.sg', '2016-11-11 16:41:43', 1, 'admin', NULL, NULL, 5, 12, 2, 0, NULL, NULL, 'SRC253', '2017-01-24 09:52:19'),
(214, 'nicholas.boon', '$2y$10$uYcWjW3b9rAB.5de1hAg1uLYJvmmpIkBklGuYj5jbEfV8DpMTYQBa', NULL, 'Nicholas Boon', 'nicholas.boon@redcross.sg', '2016-12-08 18:41:22', 1, 'admin', NULL, NULL, 5, 4, 0, 0, NULL, NULL, 'SRC255', '2017-01-24 09:57:05'),
(215, 'sheikh.marshar', '$2y$10$c3XGM6r6iU70ttRA16hv7u0TvsyM9ctuKYV1C4uUG019qq0Mxy6uq', NULL, 'Sheikh Marshar', 'sheikh.marshar@redcross.sg', '2016-09-16 09:52:38', 1, 'admin', NULL, NULL, 5, 3, 0, 0, NULL, NULL, 'SRC256', '2017-01-24 09:53:51'),
(217, 'dawn.pereira', '$2y$10$jruR7NpSNOTUZa3oSIhMC.z0CEjgNeO9k.ZnSH1DkmSkXdeuybcJ2', NULL, 'Dawn Gerardine Pereira', 'dawn.pereira@redcross.sg', '2017-01-13 15:46:29', 1, 'admin', NULL, NULL, 5, 1, 0, 0, NULL, NULL, 'SRC257', '2017-01-24 09:47:01'),
(218, 'ruslan.arif', '$2y$10$mXzfSLxNwhGaFC9M4rjzouwzYgS/wmA/1w0ZuWmfld.sR8JCIqmIi', NULL, 'Ruslan Bin Arif', 'ruslan.arif@redcross.sg', '2017-01-10 18:06:23', 1, 'admin', NULL, NULL, 5, 1, 2, 0, NULL, NULL, 'SRC261', '2017-01-24 10:28:53'),
(220, 'ace.woo', '$2y$10$z640GfnKsXWT4veagSjzduqtGIUk4cMNo90.HZtbuIQW.lone9yli', NULL, 'Ace Woo', 'ace.woo@redcross.sg', '2016-12-12 09:52:25', 1, 'admin', NULL, NULL, 4, 2, 0, 0, NULL, NULL, 'SRC265', '2017-01-24 09:51:14'),
(221, 'cindy.chen', '$2y$10$7nhqZ4renquznAEKaEv9iOHC9sC84UknPbNpy77kV/IlEGu8KqSdq', NULL, 'Cindy Chen', 'cindy.chen@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 9, 0, 0, NULL, NULL, 'SRC266', '2017-01-24 09:55:58'),
(222, 'clarinda.lim', '$2y$10$2s0.4i/CgMROJphCABTbxO.YxIDPS6OMQ8lPS4l5Gtpn7.YQsaDmK', NULL, 'Clarinda Lim', 'clarinda.lim@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 3, 0, 0, NULL, NULL, 'SRC267', '2017-01-24 09:54:04'),
(223, 'jenny.qui', '$2y$10$2Bu4roqxU206SdbHBBch6uK6cDgVmL9BAin4ZuLi5.l5GGzovKLLW', NULL, 'Jenny Qui Lee Yoong', 'jenny.qui@redcross.sg', '2016-11-14 13:35:55', 1, 'admin', NULL, NULL, 5, 1, 0, 0, NULL, NULL, 'SRC270', '2017-01-24 09:47:27'),
(224, 'rachel.heng', '$2y$10$XqnUYsTJiS3z5mngZAhqmOiIWzeuKEirfqvu6EhnkzX5YqQQa4EqC', NULL, 'Rachel Heng', 'rachel.heng@redcross.sg', '2016-12-06 10:07:49', 1, 'admin', NULL, NULL, 4, 3, 0, 0, NULL, NULL, 'SRC268', '2017-01-24 09:54:34'),
(225, 'gladys.senica', '$2y$10$RVQTy95Iw4sOqpdUSgQE9Ouj9yRQ0M0W43cevLMCgZrKccZww.x2y', NULL, 'Senica Gladys Gabuya', 'gladys.senica@redcross.sg', '2016-11-18 16:21:47', 1, 'admin', NULL, NULL, 5, 5, 0, 0, NULL, NULL, 'SRC262', '2017-01-24 10:27:45'),
(226, 'cassandra.chia', '$2y$10$Bdv8qRpQl.Irn9WIegT8oeximdlrJRVLcwBenfRNIgDQBhRWlRL1W', NULL, 'Cassandra Chia', 'cassandra.chia@redcross.sg', '2016-11-14 18:27:45', 1, 'admin', NULL, NULL, 5, 5, 3, 0, NULL, NULL, 'SRC263', '2017-01-24 10:08:27'),
(228, 'wanling.tan', '$2y$10$azFH3uy5gOGCKoto5AKFHetP.Otky/81OA7Caw2AXwNAQhQMqxLai', NULL, 'Tan Wan Ling', 'wanling.tan@redcross.sg', '2017-01-18 22:38:06', 1, 'admin', NULL, NULL, 4, 3, 0, 0, NULL, NULL, 'SRC272', '2017-01-24 09:54:47'),
(229, 'patricia.ler', '$2y$10$bJq/IZtHAr7xIVZmvqKob.utyeEl3bHBmJuZBdgMYDSIpcFg6ujhK', NULL, 'Patricia Ler', 'patricia.ler@redcross.sg', NULL, 1, 'admin', NULL, NULL, 5, 2, 0, 0, NULL, NULL, 'SRC276', '2017-01-24 09:51:28'),
(230, 'norman.ng', '$2y$10$2tVTAMqH/rAMnl9imXr4C.ZtpnWAo4wqrl6SbCRqUBEa6XSvd0Hde', NULL, 'Norman Ng', 'norman.ng@redcross.sg', NULL, 1, 'admin', NULL, NULL, 3, 5, 2, 0, NULL, NULL, 'SRC275', '2017-01-24 10:07:40'),
(231, 'caroline.lim', '$2y$10$vCQJz.imw8ShEo11rAHFT.l/nL2jMmMHxDG7MxloYAEi5TBHEiFzG', NULL, 'Caroline Lim', 'caroline.lim@redcross.sg', '2017-01-03 11:55:01', 1, 'admin', NULL, NULL, 5, 6, 0, 0, NULL, NULL, 'SRC280', '2017-01-24 11:14:48'),
(232, 'aaron.ann', '$2y$10$5PVOC5zyIRYqDQB/4WbM6eejO7dNm8BS/j2wW2sYxq4dRd6EcoqOO', NULL, 'Aaron Ann', 'aaron.ann@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 3, 0, 0, NULL, NULL, 'SRC273', '2017-01-24 09:55:00'),
(233, 'rais.wun', '$2y$10$Uc2PT/oTTcLIjnvEWOgpa./FEcPx.y7jEenP0r014fTZknpvt4oTS', NULL, 'Rais Wun', 'rais.wun@redcross.sg', NULL, 1, 'admin', NULL, NULL, 4, 3, 0, 0, NULL, NULL, 'SRC277', '2017-01-24 09:55:14'),
(234, 'finance', '$2y$10$HcPVIfKhP0C7zKesxQwHIe6ikzqk6RZOdP72fQLyneBubjq3a1wwe', NULL, 'Finance Department', 'finance@redcross.sg', NULL, 1, 'admin', NULL, NULL, 3, 12, 0, 0, NULL, NULL, 'NA004', '2017-02-01 11:09:44'),
(235, 'tester3', '$2y$10$LzeVKE.v05DTBh74X6u3qOQIVSiJN2nC5AjtcG.OXbGy.eAz.eFn2', NULL, 'Tester (RCY HOD)', 'tester3@redcross.sg', NULL, 1, 'admin', NULL, NULL, 3, 11, 0, 0, NULL, NULL, 'NA005', '2017-03-14 15:17:37'),
(236, 'tester4', '$2y$10$dC/iASWo3139n2NXcRkT1.BykISpVxVd3nbq4YgsiEH.mSAHuvCVK', NULL, 'Tester (Director of Services)', 'tester4@redcross.sg', NULL, 1, 'admin', NULL, NULL, 2, 8, 0, 0, NULL, NULL, 'NA006', '2017-03-14 15:24:46'),
(237, 'tester2', '$2y$10$0clzP7HSdCH1WaEMJ4vWeOjffMhKoqVDzzmQreNSbjsY2lRkXdnge', NULL, 'Tester (Finance HoD)', 'tester1@redcross.sg', '2018-02-14 09:28:08', 1, 'admin', NULL, NULL, 3, 12, 0, 1, 2, '2018-02-20 10:18:45', 'NA007', '2018-02-20 10:18:45'),
(238, 'test', '$2y$10$gxAeJmZBzNInusmcCPazcuKeRgaAd1vU87i5CMx7Wn3T8f9/CjbzC', NULL, 'test', 'testcp@palazon.com', NULL, 0, 'madmin', NULL, NULL, 1, 1, 0, 0, NULL, NULL, '12312', '2017-08-07 15:29:14'),
(239, 'iris.choong', '$2y$10$gSv7Q8uo.hYRFbrcl9jOnORbug983EyXo0lZfFzbtRsLJR6PNw3Xq', NULL, 'iris.choong', 'iris.choong@redcross.sg', NULL, 1, 'madmin', NULL, NULL, 3, 9, 0, 0, NULL, '2017-11-07 17:50:32', 'RC300', '2017-11-07 17:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `users_group`
--

CREATE TABLE `users_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_group`
--

INSERT INTO `users_group` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Privilege Viewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Head', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Executive', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Support', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`idsrc_departments`),
  ADD UNIQUE KEY `department_UNIQUE` (`department`);

--
-- Indexes for table `temp_approver_users`
--
ALTER TABLE `temp_approver_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idsrc_login`),
  ADD UNIQUE KEY `UNIQUELOGINID` (`loginid`);

--
-- Indexes for table `users_group`
--
ALTER TABLE `users_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `idsrc_departments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `temp_approver_users`
--
ALTER TABLE `temp_approver_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idsrc_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `users_group`
--
ALTER TABLE `users_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
