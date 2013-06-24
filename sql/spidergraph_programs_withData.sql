# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.225.0.97 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: test
# Generation Time: 2013-06-18 19:45:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table spidergraph_programs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spidergraph_programs`;

CREATE TABLE `spidergraph_programs` (
  `prog_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inst_id` int(11) unsigned NOT NULL,
  `prog_name` varchar(255) DEFAULT NULL,
  `prog_comments` text,
  `prog_active` char(1) DEFAULT NULL,
  PRIMARY KEY (`prog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `spidergraph_programs` WRITE;
/*!40000 ALTER TABLE `spidergraph_programs` DISABLE KEYS */;

INSERT INTO `spidergraph_programs` (`prog_id`, `inst_id`, `prog_name`, `prog_comments`, `prog_active`)
VALUES
	(29,0,'Test Retail','A student will be able to: Retail','y'),
	(98,0,'Test Engineering','','y'),
	(99,0,'test: AAOT','','y'),
	(100,0,'Test ASOT in Business','','y'),
	(101,0,'Test Automotive Technology AAS','Shell for department to begin their mapping work','y'),
	(102,0,'Test Urban Ag','Urban Agriculture Certificate','y'),
	(116,0,'Clinical Lab Assistant','	            ','y');

/*!40000 ALTER TABLE `spidergraph_programs` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
