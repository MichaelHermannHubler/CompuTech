-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Mai 2018 um 21:10
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `computecherp`
--
CREATE DATABASE IF NOT EXISTS `computecherp` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `computecherp`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accountingrecord`
--

DROP TABLE IF EXISTS `accountingrecord`;
CREATE TABLE IF NOT EXISTS `accountingrecord` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WarehouseLocationSrcID` int(11) DEFAULT NULL,
  `WarehouseLocationDestID` int(11) DEFAULT NULL,
  `ArticleID` int(11) NOT NULL,
  `QuantityMoved` int(11) DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Street` varchar(100) COLLATE utf8_bin NOT NULL,
  `City` varchar(50) COLLATE utf8_bin NOT NULL,
  `PostalCode` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CountryCode` varchar(3) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `ID` int(11) NOT NULL,
  `Number` varchar(50) COLLATE utf8_bin NOT NULL,
  `Name` varchar(200) COLLATE utf8_bin NOT NULL,
  `DefaulWarehouseLocationID` int(11) DEFAULT NULL,
  `MinimalStorage` int(11) DEFAULT NULL,
  `PurchasePrice` decimal(18,2) DEFAULT NULL,
  `SupplierID` int(11) DEFAULT NULL,
  `RetailPrice` decimal(18,2) DEFAULT NULL,
  `Surcharge` decimal(18,2) DEFAULT NULL,
  `ArticleGroupID` int(11) NOT NULL,
  `Unit` varchar(50) COLLATE utf8_bin NOT NULL,
  `PackingType` varchar(150) COLLATE utf8_bin NOT NULL,
  `PackingQuantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `articlegroup`
--

DROP TABLE IF EXISTS `articlegroup`;
CREATE TABLE IF NOT EXISTS `articlegroup` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `offer`
--

DROP TABLE IF EXISTS `offer`;
CREATE TABLE IF NOT EXISTS `offer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Number` varchar(50) COLLATE utf8_bin NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `SysDateCreated` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `offerarticle`
--

DROP TABLE IF EXISTS `offerarticle`;
CREATE TABLE IF NOT EXISTS `offerarticle` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(18,2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `Number` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orderarticle`
--

DROP TABLE IF EXISTS `orderarticle`;
CREATE TABLE IF NOT EXISTS `orderarticle` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ArticleID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `QuantityOrdered` int(11) NOT NULL,
  `QuantityDelivered` int(11) DEFAULT NULL,
  `Price` int(11) NOT NULL,
  `Defective` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `purchaseorder`
--

DROP TABLE IF EXISTS `purchaseorder`;
CREATE TABLE IF NOT EXISTS `purchaseorder` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferID` int(11) DEFAULT NULL,
  `SuplierID` int(11) NOT NULL,
  `SysDateCreated` datetime NOT NULL,
  `OrderDate` datetime NOT NULL,
  `DeliveryStatus` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'accepted[A]/dienied[D]',
  `DeliveryType` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Complete[C]/Part[P]',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `salesorder`
--

DROP TABLE IF EXISTS `salesorder`;
CREATE TABLE IF NOT EXISTS `salesorder` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerID` int(11) NOT NULL,
  `DeliveryAddressID` int(11) NOT NULL,
  `InvoiceAddressID` int(11) NOT NULL,
  `SysDateCreated` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `AddressID` int(11) NOT NULL,
  `VATNumber` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) COLLATE utf8_bin NOT NULL,
  `PasswortMD5` varchar(32) COLLATE utf8_bin NOT NULL,
  `FirstName` varchar(100) COLLATE utf8_bin NOT NULL,
  `LastName` varchar(100) COLLATE utf8_bin NOT NULL,
  `AddressID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userpermission`
--

DROP TABLE IF EXISTS `userpermission`;
CREATE TABLE IF NOT EXISTS `userpermission` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `PermissionCode` varchar(5) COLLATE utf8_bin NOT NULL COMMENT 'bitCoded Permissions',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warehouselocation`
--

DROP TABLE IF EXISTS `warehouselocation`;
CREATE TABLE IF NOT EXISTS `warehouselocation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Rack` varchar(25) COLLATE utf8_bin NOT NULL,
  `Position` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warehouselocationarticle`
--

DROP TABLE IF EXISTS `warehouselocationarticle`;
CREATE TABLE IF NOT EXISTS `warehouselocationarticle` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WarehouseLocationID` int(11) NOT NULL,
  `ArticleID` int(11) NOT NULL,
  `QuantityStored` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
