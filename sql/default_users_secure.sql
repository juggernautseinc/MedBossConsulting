-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2021 at 04:21 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serenity`
--

--
-- Dumping data for table `users_secure`
--

INSERT INTO `users_secure` (`id`, `username`, `password`, `last_update_password`, `last_update`, `password_history1`, `password_history2`, `password_history3`, `password_history4`, `last_challenge_response`, `login_work_area`, `login_fail_counter`) VALUES
(1, 'IAB-admin-64', '$2y$10$FZ/JuzOq7vsRPMVqDZgREOJvt6uTUz1/bPYeSoz6jz37HBqmL/IZW', '2021-06-15 01:10:57', '2021-10-19 19:23:25', '$2y$10$5pJKVLFATQpxeFfx2Ig.kOC4pq2Vqmc/ZuWQ9IfYksFlCchHH2hG.', NULL, NULL, NULL, NULL, NULL, 0),
(4, 'Jana', '$2y$10$TQxqCKNzcND1aWPcnlGhRObv4R1xX9fXgw02Lgx4zx/5P72ilXIYW', '2021-05-07 02:46:15', '2021-07-22 14:06:07', '$2y$10$/9UjJgGjfNVZKmwseTbYX.eE6N0Rr/YB5MMfd86RVsevZiOplZM6m', '$2y$10$qKGN5ahFi1f1ZKlEd7M8guRokPWJYeiG1dfgIH2/QW4L3/MsZ2sTG', '$2y$10$nZ3uIs4HIV7rHyulaYGJn.NbFdH7OyA8WX4VBkLYsDMPv/uqFkrdC', '$2y$10$7eYDRO9MOIKlrRvm5QJ5EODolEopQoMvVetSULTezjdnCjz5r2rw6', NULL, NULL, 0),
(9, 'Joe', '$2y$10$qGIn6BFrLU670ntNXGJAJ.ohp2yq6FNnsSIpRrrG4DPgjU6PHerjm', '2021-08-21 08:01:26', '2021-11-01 19:55:23', '$2y$10$UUzhOhl3puLDxSwa9OtVruXenGaqZWw/tD6UuQfeZNzQvKGxDo5Ra', '$2y$10$U8DgmQyUD4IOGXZ2n0rNveFoMwZ4d8xrkqQcH2UwUEgw79uIiHeGG', NULL, NULL, NULL, NULL, 0),
(21, 'remoteowl1', '$2y$10$4PwuVH78ycMl4G/ydARDk.qh5vJLlht9T982bEG1pMw4O2mN85TKm', '2021-05-17 01:08:24', '2021-06-28 19:32:25', '$2y$10$V4FSP3NtnuCqIrmUPCiSL.DZItDNesKpryEf96NHVn.FF/tF0L0Oy', NULL, NULL, NULL, NULL, NULL, 0),
(24, 'remoteowl2', '$2y$10$jMPn4cU43tR71BWFi/zU.uFS95VbxCVMVjjUX9lJOd4R26SxXc7ZG', '2021-05-17 01:10:38', '2021-08-25 21:48:23', NULL, NULL, NULL, NULL, NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
