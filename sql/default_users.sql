-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2021 at 04:22 PM
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `password`, `authorized`, `info`, `source`, `fname`, `mname`, `lname`, `suffix`, `federaltaxid`, `federaldrugid`, `upin`, `facility`, `facility_id`, `see_auth`, `active`, `npi`, `title`, `specialty`, `billname`, `email`, `email_direct`, `url`, `assistant`, `organization`, `valedictory`, `street`, `streetb`, `city`, `state`, `zip`, `street2`, `streetb2`, `city2`, `state2`, `zip2`, `phone`, `fax`, `phonew1`, `phonew2`, `phonecell`, `notes`, `cal_ui`, `taxonomy`, `calendar`, `abook_type`, `default_warehouse`, `irnpool`, `state_license_number`, `weno_prov_id`, `newcrop_user_role`, `cpoe`, `physician_type`, `main_menu_role`, `patient_menu_role`, `portal_user`, `supervisor_id`, `google_signin_email`) VALUES
(1, 0x92f829380bca4bc9b44229c0b7b830cc, 'IAB-admin-64', 'NoLongerUsed', 0, NULL, NULL, 'Sherwin', NULL, 'Administrator', NULL, NULL, NULL, NULL, 'Serenity Counseling Services Hawaii', 3, 1, 1, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'serenity', 3, '207Q00000X', 0, '', '', '', NULL, NULL, '', NULL, NULL, 'standard', 'standard', 1, 0, NULL),
(4, 0x92f82938177d40ed99700300be0eeaa5, 'Jana', 'NoLongerUsed', 0, '', NULL, 'Jana', '', 'Smith', NULL, '', '', '', 'Serenity Counseling Services Hawaii', 3, 1, 1, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'serenity', 1, '207Q00000X', 0, '', '', '', '', '', '', NULL, '', 'standard', 'standard', 1, 0, NULL),
(9, 0x92f829382b184c9e95c679d45f1440cf, 'Joe', 'NoLongerUsed', 0, '', NULL, 'Joe', '', 'Scoggins', NULL, '', '', '', 'Serenity Counseling Services Hawaii', 3, 1, 1, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'serenity', 1, '207Q00000X', 0, '', '', '', '', '', '', NULL, '', 'standard', 'standard', 1, 0, NULL),
(21, 0x93600d671e6f4927bbafcc6cd6d4cb2c, 'remoteowl1', 'NoLongerUsed', 0, '', NULL, 'Remote', '', 'Owl', NULL, '', '', '', 'Serenity Counseling Services Hawaii', 3, 3, 1, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'serenity', 1, '207Q00000X', 0, '', '', '', '', '', '', NULL, '', 'standard', 'standard', 0, 0, NULL),
(24, 0x9373feb555c344e088ae0ca8959b2284, 'remoteowl2', 'NoLongerUsed', 0, '', NULL, 'Remote', '', 'Owl2', NULL, '', '', '', 'Serenity Counseling Services Hawaii', 3, 3, 1, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'serenity', 1, '207Q00000X', 0, '', '', '', '', '', '', NULL, '', 'standard', 'standard', 0, 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
