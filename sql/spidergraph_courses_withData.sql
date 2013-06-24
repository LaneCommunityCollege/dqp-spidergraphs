# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.225.0.97 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: test
# Generation Time: 2013-06-18 19:54:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table spidergraph_courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spidergraph_courses`;

CREATE TABLE `spidergraph_courses` (
  `crs_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `crs_number` varchar(255) DEFAULT NULL,
  `crs_comments` text,
  `inst_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`crs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `spidergraph_courses` WRITE;
/*!40000 ALTER TABLE `spidergraph_courses` DISABLE KEYS */;

INSERT INTO `spidergraph_courses` (`crs_id`, `crs_number`, `crs_comments`, `inst_id`)
VALUES
	(82,'Retail test 1','',0),
	(83,'Retail Accounting','',0),
	(524,'ENGR 221','Electrical Circuits I',0),
	(525,'AM-129 Electrical Systems','\r\nIncludes basic electricity, introduction\r\nto semiconductors, electrical measurement,\r\nschematics, wiring repair, service\r\nof batteries, cranking, charging, lighting\r\nand distributor ignition systems.',0),
	(526,'AM-130 Brake Systems','\r\nTheory and lab course covers basic\r\nhydraulics, brake fluids, friction material,\r\nseals, disc and drum brakes, disc\r\nand drum brake servicing equipment,\r\nhydraulic and vacuum brake boosters\r\nand anti-lock braking systems.',0),
	(527,'AM-131 Chassis Systems','Includes design, construction, and service\r\nof front and rear suspension systems. Also\r\ncovers wheels and tires, steering, and\r\nwheel alignment.',0),
	(528,'AM-228 Service Shop Management','Course designed to familiarize students\r\nwith the responsibilities of the parts\r\nmanager, service manager and service\r\nwriter.',0),
	(1472,'AM-133 - Engine Systems','	This page is for adding courses for your institution. A simple number, name and description or comments about the course are all that is required. You will be asked to link this course to a program and add outcomes and weights in that program connection after you submit this very basic information.             ',0),
	(1681,'CLA 100 - Introduction to Healthcare','Introduction to healthcare systems and\r\ntrends, ethical and legal responsibilities,\r\npersonal and workplace safety, infection\r\ncontrol, professionalism, life-long\r\nlearning, and communication.	            ',0),
	(1682,'CLA 101 - Clinical laboratory Assistant Skills I','Includes state and federal regulations,\r\nquality assurance practices, laboratory\r\nterminology, staffing, and a basic understanding\r\nof quality laboratory testing\r\nin the clinical laboratory. Required:\r\nInstructor consent.	            ',0),
	(1683,'CLA 102 - Clinical Laboratory Assistant Skills II','Addresses hematology and urinalysis.\r\nStudents will be required to perform\r\nvarious waived tests and demonstrate an\r\nunderstanding of the necessity of accuracy\r\nand attention to detail. Required:\r\nInstructor consent.	            ',0),
	(1684,'CLA 103 - Clinical Laboratory Assisant III','Continuation of CLA-102. Focuses\r\non clinical chemistry, immunology,\r\nand microbiology. Required: Instructor\r\nconsent. Prerequisite: Pass	            ',0),
	(1685,'CLA 115 - Laboratory Administrative skills','Designed for the clinical laboratory assistant\r\nstudents employed in the ambulatory\r\ncare setting. Laboratory billing, administrative\r\nduties, vital signs, and EKG\r\ntechniques will be discussed.	            ',0),
	(1686,'CLA 119 - Phlebotomy Laboratory practicum I','Supervised unpaid assignment in area\r\nmedical center laboratories to gain practical\r\nexperience.	            ',0),
	(1687,'CLA 120 - Phlebotomy','	            ',0),
	(1688,'CLA 125 - Introduction to Clinical Research','Overview of research as applied through\r\nclinical studies. Includes the elements of\r\nproper research techniques as conducted\r\nunder the            ',0);

/*!40000 ALTER TABLE `spidergraph_courses` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
