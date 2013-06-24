# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.225.0.97 (MySQL 5.5.31-0ubuntu0.12.04.1)
# Database: test
# Generation Time: 2013-06-18 19:46:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table spidergraph_program_outcomes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spidergraph_program_outcomes`;

CREATE TABLE `spidergraph_program_outcomes` (
  `po_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `prog_id` int(11) DEFAULT NULL,
  `po_weight` decimal(12,9) DEFAULT NULL,
  `po_applied` decimal(12,9) DEFAULT NULL,
  `po_specialized` decimal(12,9) DEFAULT NULL,
  `po_intellectual` decimal(12,9) DEFAULT NULL,
  `po_broad` decimal(12,9) DEFAULT NULL,
  `po_civic` decimal(12,9) DEFAULT NULL,
  `po_outcome` text,
  `po_comments` text,
  `inst_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `spidergraph_program_outcomes` WRITE;
/*!40000 ALTER TABLE `spidergraph_program_outcomes` DISABLE KEYS */;

INSERT INTO `spidergraph_program_outcomes` (`po_id`, `prog_id`, `po_weight`, `po_applied`, `po_specialized`, `po_intellectual`, `po_broad`, `po_civic`, `po_outcome`, `po_comments`, `inst_id`)
VALUES
	(141,29,0.300000000,25.000000000,25.000000000,25.000000000,20.000000000,5.000000000,'Use communication skills in relating to customers and colleagues in retail settings','',0),
	(142,29,0.250000000,20.000000000,70.000000000,10.000000000,0.000000000,0.000000000,'Apply basic accounting theory in managing a retail operation','',0),
	(143,29,0.150000000,50.000000000,40.000000000,10.000000000,0.000000000,0.000000000,'Apply math and computer skills in a retail establishment','',0),
	(309,98,0.500000000,60.000000000,20.000000000,15.000000000,5.000000000,0.000000000,'Students develop skills to solve problems by applying calculus to mechanical and/or electrical systems ','',0),
	(310,98,0.500000000,50.000000000,20.000000000,10.000000000,10.000000000,10.000000000,'Test 2','',0),
	(311,29,0.300000000,30.000000000,30.000000000,30.000000000,5.000000000,5.000000000,'Apply 3d constructs to model forecasting in retail','',0),
	(312,99,0.500000000,10.000000000,30.000000000,40.000000000,15.000000000,5.000000000,'WR 1: Read actively, think critically, and write purposefully and capably for academic and, in some cases, professional audiences.\r\n','',0),
	(313,100,0.500000000,30.000000000,20.000000000,30.000000000,20.000000000,0.000000000,'Interpret and engage in the Arts &amp; Letters, making use of the creative process to enrich\r\nthe quality of life','',0),
	(314,100,0.500000000,0.000000000,0.000000000,60.000000000,30.000000000,10.000000000,'Critically analyze values and ethics within a range of human experience and expression\r\nto engage more fully in local and global issues.','',0),
	(315,101,0.200000000,30.000000000,30.000000000,25.000000000,5.000000000,10.000000000,'Apply ASE service standards to automotive diagnosis and repair.		      		      		      		      		      		      ','		      		      		      		      		      		      ',0),
	(316,101,0.200000000,20.000000000,10.000000000,30.000000000,30.000000000,10.000000000,'Understand modern automotive repair business protocol.		      ','		      ',0),
	(317,101,0.050000000,25.000000000,30.000000000,20.000000000,15.000000000,10.000000000,'Apply environmental preservation concepts in all aspects of automotive service.		      		      ','		      		      ',0),
	(318,99,0.500000000,10.000000000,30.000000000,40.000000000,15.000000000,5.000000000,'WR 2: Locate, evaluate, and ethically utilize information to communicate effectively.','',0),
	(319,102,0.200000000,0.000000000,0.000000000,0.000000000,0.000000000,0.000000000,'Apply technical skills to successfully produce a variety of food crops.','',0),
	(320,102,0.200000000,0.000000000,0.000000000,0.000000000,0.000000000,0.000000000,'Manage crop production shcedules to achieve year round, saleable food products.','',0),
	(321,102,0.200000000,0.000000000,0.000000000,0.000000000,0.000000000,0.000000000,'Manage environmental inputs ot maximize crop production in a sustainable manner.','',0),
	(322,102,0.200000000,0.000000000,0.000000000,0.000000000,0.000000000,0.000000000,'Communicate effectively about questions, ideas, concepts and practices in organic food production.','',0),
	(323,102,0.200000000,0.000000000,0.000000000,0.000000000,0.000000000,0.000000000,'Apply business and marketing knowledge to successfully operate a profitable small business.','',0),
	(361,101,0.200000000,25.000000000,25.000000000,25.000000000,15.000000000,10.000000000,'To prepare students for entry-level employment in automotive service technology.	      		      		      		      		      ','		      		      		      		      		      ',0),
	(362,101,0.050000000,25.000000000,25.000000000,25.000000000,15.000000000,10.000000000,'To prepare students to sit for ASE exams	      		      		      		      ','		      		      		      		      ',0),
	(393,116,0.060000000,34.000000000,33.000000000,0.000000000,0.000000000,33.000000000,'Preform administrative, data entry, laboratory billing practices, and the performance of ambulatory assistant- level testing according to standard operating procedures.		      		      		      		      ','		      		      		      		      ',0),
	(394,116,0.300000000,50.000000000,50.000000000,0.000000000,0.000000000,0.000000000,'Preform in lab all medical\r\nlaboratory support tasks such as, phlebotomy,\r\nspecimen processing, quality control, laboratory orientation,\r\nand regulation.      		      		      		      ','		      		      		      		      ',0),
	(395,116,0.310000000,45.000000000,50.000000000,0.000000000,0.000000000,5.000000000,'Preform in the clinical setting all medical\r\nlaboratory support tasks such as, phlebotomy,\r\nspecimen processing, quality control, laboratory orientation,\r\nand regulation.      		      		      		      		      		      ','		      		      		      		      ',0),
	(396,116,0.330000000,0.000000000,100.000000000,0.000000000,0.000000000,0.000000000,'Pass NAACLS industry clinical lab certification. 		      		      		      ','		      		      		      ',0);

/*!40000 ALTER TABLE `spidergraph_program_outcomes` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
