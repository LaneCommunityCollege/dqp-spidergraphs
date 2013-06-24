# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.225.0.97 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: test
# Generation Time: 2013-06-18 19:55:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table spidergraph_course_to_program
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spidergraph_course_to_program`;

CREATE TABLE `spidergraph_course_to_program` (
  `ctp_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `crs_id` int(11) DEFAULT NULL,
  `prog_id` int(11) DEFAULT NULL,
  `inst_id` int(11) DEFAULT NULL,
  `ctp_weight` decimal(12,9) DEFAULT NULL,
  PRIMARY KEY (`ctp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `spidergraph_course_to_program` WRITE;
/*!40000 ALTER TABLE `spidergraph_course_to_program` DISABLE KEYS */;

INSERT INTO `spidergraph_course_to_program` (`ctp_id`, `crs_id`, `prog_id`, `inst_id`, `ctp_weight`)
VALUES
	(91,82,29,0,0.500000000),
	(92,83,29,0,0.500000000),
	(536,524,98,0,1.000000000),
	(537,525,101,0,0.200000000),
	(538,526,101,0,0.200000000),
	(539,527,101,0,0.200000000),
	(540,528,101,0,0.200000000),
	(867,1472,101,0,0.200000000),
	(868,1681,116,0,0.050000000),
	(869,1682,116,0,0.150000000),
	(870,1683,116,0,0.150000000),
	(871,1684,116,0,0.150000000),
	(872,1685,116,0,0.150000000),
	(873,1686,116,0,0.150000000),
	(874,1687,116,0,0.150000000),
	(875,1688,116,0,0.050000000);

/*!40000 ALTER TABLE `spidergraph_course_to_program` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
