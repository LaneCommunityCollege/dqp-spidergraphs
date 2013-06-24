# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.225.0.97 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: dqp_new
# Generation Time: 2013-06-18 20:44:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table spidergraph_inst_outcomes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spidergraph_inst_outcomes`;

CREATE TABLE `spidergraph_inst_outcomes` (
  `io_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `inst_id` int(11) DEFAULT NULL,
  `io_weight` decimal(12,9) DEFAULT NULL,
  `io_applied` decimal(12,9) DEFAULT NULL,
  `io_specialized` decimal(12,9) DEFAULT NULL,
  `io_intellectual` decimal(12,9) DEFAULT NULL,
  `io_broad` decimal(12,9) DEFAULT NULL,
  `io_civic` decimal(12,9) DEFAULT NULL,
  `io_outcome` text,
  `io_comments` text,
  PRIMARY KEY (`io_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `spidergraph_inst_outcomes` WRITE;
/*!40000 ALTER TABLE `spidergraph_inst_outcomes` DISABLE KEYS */;

INSERT INTO `spidergraph_inst_outcomes` (`io_id`, `inst_id`, `io_weight`, `io_applied`, `io_specialized`, `io_intellectual`, `io_broad`, `io_civic`, `io_outcome`, `io_comments`)
VALUES
	(1,0,0.500000000,50.000000000,10.000000000,15.000000000,10.000000000,15.000000000,'Details about the outcome go here.  Maybe something like &quot;Focus on providing a clear path to transfer to a 4 year university&quot;.','Any comments you would like to describe the outcome.  These are private comments and will not be displayed to the general public.'),
	(2,0,0.500000000,50.000000000,12.000000000,18.000000000,9.000000000,11.000000000,'Details about the outcome go here.  Maybe something like &quot;Provide a solid 2 year path to family wage employment in the medical industry&quot;.','Any comments you would like to describe the outcome.  These are private comments and will not be displayed to the general public.');

/*!40000 ALTER TABLE `spidergraph_inst_outcomes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
