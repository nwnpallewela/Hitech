-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.24-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema hitech
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ hitech;
USE hitech;

--
-- Table structure for table `hitech`.`grn`
--

DROP TABLE IF EXISTS `grn`;
CREATE TABLE `grn` (
  `idgrn` int(11) NOT NULL AUTO_INCREMENT,
  `idsupplier` int(11) NOT NULL,
  `idcashier` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idgrn`),
  KEY `fk_grn_user1_idx` (`idsupplier`),
  KEY `fk_grn_user2_idx` (`idcashier`),
  CONSTRAINT `fk_grn_user1` FOREIGN KEY (`idsupplier`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grn_user2` FOREIGN KEY (`idcashier`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`grn`
--

/*!40000 ALTER TABLE `grn` DISABLE KEYS */;
/*!40000 ALTER TABLE `grn` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`grnitem`
--

DROP TABLE IF EXISTS `grnitem`;
CREATE TABLE `grnitem` (
  `idgrnitem` int(11) NOT NULL AUTO_INCREMENT,
  `idgrn` int(11) NOT NULL,
  `idinventory` int(11) NOT NULL,
  `qty` double DEFAULT NULL,
  PRIMARY KEY (`idgrnitem`),
  KEY `fk_grnitem_inventory1_idx` (`idinventory`),
  KEY `fk_grnitem_grn1_idx` (`idgrn`),
  CONSTRAINT `fk_grnitem_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`idinventory`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_grnitem_grn1` FOREIGN KEY (`idgrn`) REFERENCES `grn` (`idgrn`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`grnitem`
--

/*!40000 ALTER TABLE `grnitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `grnitem` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `idinventory` int(11) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(45) DEFAULT NULL,
  `barcode` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `brand` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idinventory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`inventory`
--

/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `idinvoice` int(11) NOT NULL AUTO_INCREMENT,
  `idbuyer` int(11) NOT NULL,
  `idcashier` int(11) NOT NULL,
  `datetime` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idinvoice`),
  KEY `fk_invoice_user1_idx` (`idbuyer`),
  KEY `fk_invoice_user2_idx` (`idcashier`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`idbuyer`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_user2` FOREIGN KEY (`idcashier`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`invoice`
--

/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`invoiceitem`
--

DROP TABLE IF EXISTS `invoiceitem`;
CREATE TABLE `invoiceitem` (
  `idinvoiceitem` int(11) NOT NULL AUTO_INCREMENT,
  `idinvoice` int(11) NOT NULL,
  `idinventory` int(11) NOT NULL,
  `qty` double DEFAULT NULL,
  PRIMARY KEY (`idinvoiceitem`),
  KEY `fk_invoiceitem_inventory1_idx` (`idinventory`),
  KEY `fk_invoiceitem_invoice1_idx` (`idinvoice`),
  CONSTRAINT `fk_invoiceitem_inventory1` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`idinventory`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoiceitem_invoice1` FOREIGN KEY (`idinvoice`) REFERENCES `invoice` (`idinvoice`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`invoiceitem`
--

/*!40000 ALTER TABLE `invoiceitem` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoiceitem` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`loghistory`
--

DROP TABLE IF EXISTS `loghistory`;
CREATE TABLE `loghistory` (
  `idloghistory` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `intime` datetime DEFAULT NULL,
  `outtime` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idloghistory`),
  KEY `fk_loghistory_user1_idx` (`iduser`),
  CONSTRAINT `fk_loghistory_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`loghistory`
--

/*!40000 ALTER TABLE `loghistory` DISABLE KEYS */;
INSERT INTO `loghistory` (`idloghistory`,`iduser`,`intime`,`outtime`,`ip`) VALUES 
 (1,1,'2015-07-01 12:21:39',NULL,'127.0.0.1'),
 (2,1,'2015-07-01 12:27:47',NULL,'127.0.0.1'),
 (3,1,'2015-07-01 12:30:16',NULL,'127.0.0.1'),
 (4,1,'2015-07-01 14:07:22',NULL,'127.0.0.1');
/*!40000 ALTER TABLE `loghistory` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`stack`
--

DROP TABLE IF EXISTS `stack`;
CREATE TABLE `stack` (
  `idstack` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  `idinventory` int(11) NOT NULL,
  `exp` datetime DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idstack`),
  KEY `fk_stack_inventory_idx` (`idinventory`),
  CONSTRAINT `fk_stack_inventory` FOREIGN KEY (`idinventory`) REFERENCES `inventory` (`idinventory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`stack`
--

/*!40000 ALTER TABLE `stack` DISABLE KEYS */;
/*!40000 ALTER TABLE `stack` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `idtype` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtype`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`type`
--

/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` (`idtype`,`type`) VALUES 
 (1,'Admin'),
 (2,'Manager'),
 (3,'Cashier'),
 (4,'Buyer'),
 (5,'Supplier'),
 (6,'Other');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;


--
-- Table structure for table `hitech`.`user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `idtype` int(11) NOT NULL,
  `nic` varchar(45) DEFAULT NULL,
  `name` varchar(75) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `address` text,
  `email` varchar(75) DEFAULT NULL,
  `mobile1` varchar(45) DEFAULT NULL,
  `mobile2` varchar(45) DEFAULT NULL,
  `fax1` varchar(45) DEFAULT NULL,
  `fax2` varchar(45) DEFAULT NULL,
  `pw` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  KEY `fk_user_type1_idx` (`idtype`),
  CONSTRAINT `fk_user_type1` FOREIGN KEY (`idtype`) REFERENCES `type` (`idtype`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitech`.`user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`iduser`,`idtype`,`nic`,`name`,`dob`,`gender`,`address`,`email`,`mobile1`,`mobile2`,`fax1`,`fax2`,`pw`,`status`) VALUES 
 (1,1,'923231196V','Chanaka Lakmal','1992-11-18 00:00:00','male','Kurunegala','ldclakmal@gmail.com','0775962256','','','','202cb962ac59075b964b07152d234b70',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
