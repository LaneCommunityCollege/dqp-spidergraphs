# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.225.0.97 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: test
# Generation Time: 2013-06-18 19:55:40 +0000
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

LOCK TABLES `spidergraph_course_outcomes` WRITE;
/*!40000 ALTER TABLE `spidergraph_course_outcomes` DISABLE KEYS */;

INSERT INTO `spidergraph_course_outcomes` (`co_id`, `crs_id`, `co_weight`, `co_applied`, `co_specialized`, `co_intellectual`, `co_broad`, `co_civic`, `co_outcome`, `co_comments`, `inst_id`)
VALUES
	(423,82,0.500000000,40.000000000,30.000000000,20.000000000,10.000000000,0.000000000,'Determine appropriate interview and hiring practices','',0),
	(424,82,0.500000000,50.000000000,50.000000000,0.000000000,0.000000000,0.000000000,'Understand basic concepts of accounting','',0),
	(425,83,0.500000000,30.000000000,60.000000000,10.000000000,0.000000000,0.000000000,'Use Accounting principles in retail decision making','',0),
	(426,83,0.500000000,20.000000000,80.000000000,0.000000000,0.000000000,0.000000000,'Use Accounting programs proficiently','',0),
	(2312,524,0.333000000,70.000000000,25.000000000,5.000000000,0.000000000,0.000000000,'explain how currents and voltages are produced and illustrate the mathematical and scientific relationship between them ','',0),
	(2313,524,0.333000000,70.000000000,25.000000000,5.000000000,0.000000000,0.000000000,'apply the basic laws of electrical circuits ','',0),
	(2314,524,0.333000000,70.000000000,25.000000000,0.000000000,5.000000000,0.000000000,'apply the concepts of circuits in order to create and analyze complex circuit structures ','',0),
	(2315,525,0.333000000,30.000000000,30.000000000,30.000000000,10.000000000,0.000000000,'Understand and apply the fundamental tenets of basic electricity','',0),
	(2316,525,0.333000000,30.000000000,30.000000000,30.000000000,10.000000000,0.000000000,'Understand and repair basic automotive power distribution systems','',0),
	(2317,525,0.333000000,30.000000000,30.000000000,40.000000000,0.000000000,0.000000000,'Interpret basic schematics and demonstrate an understanding of terminology','',0),
	(2318,526,0.250000000,20.000000000,40.000000000,30.000000000,10.000000000,0.000000000,'Understand basic hydraulic theory and schematics used in the automotive industry','',0),
	(2319,526,0.200000000,40.000000000,30.000000000,30.000000000,0.000000000,0.000000000,'Understand ABS system functionality','',0),
	(2320,526,0.300000000,40.000000000,35.000000000,20.000000000,5.000000000,0.000000000,'Apply proper techniques in disc and drum brake servicing equipment','',0),
	(2321,526,0.250000000,10.000000000,30.000000000,30.000000000,15.000000000,15.000000000,'Apply safe practices and procedures in dealing with brake friction materials','',0),
	(2322,527,0.333000000,40.000000000,35.000000000,20.000000000,5.000000000,0.000000000,'Demonstrate an understanding of front and rear suspension systems','',0),
	(2323,527,0.333000000,40.000000000,40.000000000,20.000000000,0.000000000,0.000000000,'Apply proper wheel alignment techniques','',0),
	(2324,527,0.333000000,40.000000000,30.000000000,30.000000000,0.000000000,0.000000000,'Diagnose and correct improper tire wear patterns','',0),
	(2326,528,0.500000000,15.000000000,35.000000000,30.000000000,10.000000000,10.000000000,'Describe parts procurement and supplier chains','',0),
	(2563,528,0.500000000,15.000000000,35.000000000,30.000000000,10.000000000,10.000000000,'This is to replace the outcome I accidentally deleted...	      		      ','		      		      ',0),
	(2564,1472,0.500000000,0.000000000,100.000000000,0.000000000,0.000000000,0.000000000,'		This page is for adding courses for your institution. A simple number, name and description or comments about the course are all that is required. You will be asked to link this course to a program and add outcomes and weights in that program connection after you submit this very basic information.       		      ','	test	      		      ',0),
	(2565,1472,0.000000000,0.000000000,0.000000000,0.000000000,0.000000000,0.000000000,'		      ','		      ',0),
	(2566,1682,0.330000000,50.000000000,45.000000000,0.000000000,0.000000000,5.000000000,'		      		      		      ','		      		      		      ',0),
	(2568,1683,0.150000000,50.000000000,45.000000000,0.000000000,0.000000000,5.000000000,'		      		      		      		      ','		      		      		      		      ',0),
	(2569,1684,0.000000000,50.000000000,45.000000000,0.000000000,0.000000000,5.000000000,'		      ','		      ',0),
	(2571,1685,0.000000000,45.000000000,50.000000000,0.000000000,0.000000000,5.000000000,'		      ','		      ',0),
	(2572,1686,0.000000000,50.000000000,50.000000000,0.000000000,0.000000000,0.000000000,'		      ','		      ',0),
	(2573,1687,0.000000000,50.000000000,50.000000000,0.000000000,0.000000000,0.000000000,'		      ','		      ',0),
	(2574,1688,0.050000000,25.000000000,25.000000000,20.000000000,20.000000000,10.000000000,'		      		      ','		      		      ',0),
	(2579,1682,0.330000000,45.000000000,50.000000000,0.000000000,0.000000000,5.000000000,'		      		      		      ','		      		      		      ',0),
	(2580,1688,0.000000000,40.000000000,40.000000000,0.000000000,10.000000000,0.000000000,'		      ','		      ',0),
	(2581,1681,0.000000000,25.000000000,25.000000000,5.000000000,25.000000000,20.000000000,'Introduction to healthcare systems and\r\ntrends, ethical and legal responsibilities,\r\npersonal and workplace safety, infection\r\ncontrol, professionalism, life-long\r\nlearning, and communication.\r\n		      ','		      ',0),
	(2582,1682,0.340000000,50.000000000,50.000000000,0.000000000,0.000000000,0.000000000,'CLA-101 Clinical Laboratory Assistant\r\nSkills I\r\n4 credits, Fall\r\nIncludes state and federal regulations,\r\nquality assurance practices, laboratory\r\nterminology, staffing, and a basic understanding\r\nof quality laboratory testing\r\nin the clinical laboratory. Required:\r\nInstructor consent.	      		      		      		      ','		      		      		      		      ',0);

/*!40000 ALTER TABLE `spidergraph_course_outcomes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
