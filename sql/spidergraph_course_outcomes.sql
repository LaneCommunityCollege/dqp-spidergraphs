# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.225.0.97 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: dqp_new
# Generation Time: 2013-06-18 17:36:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table spidergraph_course_outcomes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spidergraph_course_outcomes`;

CREATE TABLE `spidergraph_course_outcomes` (
  `co_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `crs_id` int(11) DEFAULT NULL,
  `co_weight` decimal(12,9) DEFAULT NULL,
  `co_applied` decimal(12,9) DEFAULT NULL,
  `co_specialized` decimal(12,9) DEFAULT NULL,
  `co_intellectual` decimal(12,9) DEFAULT NULL,
  `co_broad` decimal(12,9) DEFAULT NULL,
  `co_civic` decimal(12,9) DEFAULT NULL,
  `co_outcome` text,
  `co_comments` text,
  `inst_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
