SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE IF NOT EXISTS `module_prior_authorizations`
(
    `id`  INT NOT NULL PRIMARY KEY auto_increment,
    `pid` INT NULL,
    `auth_num` VARCHAR,
    `start_date` DATE,
    `end_data` DATE,
    `cpt` TEXT,
    `init_units` INT,
    `remaining_units` INT
) ENGINE = InnoDB COMMENT = 'Store authorizations';
