-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2013 at 08:19 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `billingretail8`
--

-- --------------------------------------------------------

--
-- Table structure for table `dccustomerinward_details`
--

CREATE TABLE IF NOT EXISTS `dccustomerinward_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `dccustomerinward_tax`
--

CREATE TABLE IF NOT EXISTS `dccustomerinward_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `dccustomer_details`
--

CREATE TABLE IF NOT EXISTS `dccustomer_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `dccustomer_tax`
--

CREATE TABLE IF NOT EXISTS `dccustomer_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `dcsupplieroutward_details`
--

CREATE TABLE IF NOT EXISTS `dcsupplieroutward_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `dcsupplieroutward_tax`
--

CREATE TABLE IF NOT EXISTS `dcsupplieroutward_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `dcsupplier_details`
--

CREATE TABLE IF NOT EXISTS `dcsupplier_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `dcsupplier_tax`
--

CREATE TABLE IF NOT EXISTS `dcsupplier_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `details_login`
--

CREATE TABLE IF NOT EXISTS `details_login` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `logintime` datetime NOT NULL,
  `logouttime` datetime NOT NULL,
  `sessionid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `openingcash` decimal(13,2) NOT NULL,
  `closingcash` decimal(13,2) NOT NULL,
  `sales` decimal(13,2) NOT NULL,
  `expenses` decimal(13,2) NOT NULL,
  `deposit` decimal(13,2) NOT NULL,
  `withdrawal` decimal(13,2) NOT NULL,
  `cashmrc` decimal(13,2) NOT NULL,
  `salesreturn` decimal(13,2) NOT NULL,
  `customercollection` decimal(13,2) NOT NULL,
  `supplierpayment` decimal(13,2) NOT NULL,
  `useropeningcash` decimal(13,2) NOT NULL,
  `userclosingcash` decimal(13,2) NOT NULL,
  `usersales` decimal(13,2) NOT NULL,
  `userexpenses` decimal(13,2) NOT NULL,
  `userdeposit` decimal(13,2) NOT NULL,
  `userwithdrawal` decimal(13,2) NOT NULL,
  `usercashmrc` decimal(13,2) NOT NULL,
  `usersalesreturn` decimal(13,2) NOT NULL,
  `usercustomercollection` decimal(13,2) NOT NULL,
  `usersupplierpayment` decimal(13,2) NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `rs1000` int(255) NOT NULL,
  `rs500` int(255) NOT NULL,
  `rs100` int(255) NOT NULL,
  `rs50` int(255) NOT NULL,
  `rs20` int(255) NOT NULL,
  `rs10` int(255) NOT NULL,
  `rs5` int(255) NOT NULL,
  `rs2` int(255) NOT NULL,
  `rs1` int(255) NOT NULL,
  `rscoins` decimal(13,2) NOT NULL,
  `denominationtotal` decimal(13,2) NOT NULL,
  `lastupdate` datetime NOT NULL,
  `lastupdateipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdateusername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `expensesub_details`
--

CREATE TABLE IF NOT EXISTS `expensesub_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `expensemainanum` int(255) NOT NULL,
  `expensemainname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `expensesubanum` int(255) NOT NULL,
  `expensesubname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactiondate` datetime NOT NULL,
  `particulars` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionmode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactiontype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionmodule` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionamount` decimal(13,2) NOT NULL,
  `cashamount` decimal(13,2) NOT NULL,
  `onlineamount` decimal(13,2) NOT NULL,
  `creditamount` decimal(13,2) NOT NULL,
  `chequeamount` decimal(13,2) NOT NULL,
  `cardamount` decimal(13,2) NOT NULL,
  `adjustmentamount` decimal(13,2) NOT NULL,
  `chequenumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chequedate` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bankbranch` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense_details`
--

CREATE TABLE IF NOT EXISTS `expense_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `transactiondate` datetime NOT NULL,
  `particulars` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionmode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactiontype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionmodule` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionamount` decimal(13,2) NOT NULL,
  `cashamount` decimal(13,2) NOT NULL,
  `onlineamount` decimal(13,2) NOT NULL,
  `creditamount` decimal(13,2) NOT NULL,
  `chequeamount` decimal(13,2) NOT NULL,
  `cardamount` decimal(13,2) NOT NULL,
  `adjustmentamount` decimal(13,2) NOT NULL,
  `chequenumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chequedate` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bankbranch` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_restriction`
--

CREATE TABLE IF NOT EXISTS `login_restriction` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `logintime` datetime NOT NULL,
  `logouttime` datetime NOT NULL,
  `sessionid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `lastupdateipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdateusername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_backupdatabase`
--

CREATE TABLE IF NOT EXISTS `master_backupdatabase` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `backupfilename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `backupfiledate` datetime NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_backupsoftware`
--

CREATE TABLE IF NOT EXISTS `master_backupsoftware` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `backupfilename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `backupfiledate` datetime NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_bank`
--

CREATE TABLE IF NOT EXISTS `master_bank` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `branchname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `accounttype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `accountnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` text COLLATE latin1_general_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `currentbalance` decimal(13,2) NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `bankcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactpersonname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactpersonphone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `netbankinglogin` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `swiftcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `branchcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `commissionpercentage` decimal(13,2) NOT NULL,
  `mobilenumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bankstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `lastupdateusername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdateipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_billtitleheader`
--

CREATE TABLE IF NOT EXISTS `master_billtitleheader` (
  `auto_number` int(15) NOT NULL AUTO_INCREMENT,
  `billtitleheader` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_billtype`
--

CREATE TABLE IF NOT EXISTS `master_billtype` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `listorder` decimal(13,2) NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_category`
--

CREATE TABLE IF NOT EXISTS `master_category` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_city`
--

CREATE TABLE IF NOT EXISTS `master_city` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1153 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_company`
--

CREATE TABLE IF NOT EXISTS `master_company` (
  `auto_number` int(13) NOT NULL AUTO_INCREMENT,
  `companycode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `area` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `country` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `faxnumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `faxnumber2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dateposted` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companystatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `currencyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `currencydecimalname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `currencycode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `stockmanagement` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_contact`
--

CREATE TABLE IF NOT EXISTS `master_contact` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactperson1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `designation1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `department1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mobilenumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `faxnumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dateposted` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_contact_supplier`
--

CREATE TABLE IF NOT EXISTS `master_contact_supplier` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactperson1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `designation1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `department1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mobilenumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `faxnumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dateposted` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_country`
--

CREATE TABLE IF NOT EXISTS `master_country` (
  `auto_number` int(15) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=239 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_creditcard`
--

CREATE TABLE IF NOT EXISTS `master_creditcard` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `creditcardcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `insertdate` datetime NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `lastupdateusername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdateipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_customer`
--

CREATE TABLE IF NOT EXISTS `master_customer` (
  `auto_number` int(13) NOT NULL AUTO_INCREMENT,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `typeofcustomer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `area` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `country` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `faxnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mobilenumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `openingbalance` decimal(13,2) NOT NULL,
  `remarks` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=234 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_dccustomer`
--

CREATE TABLE IF NOT EXISTS `master_dccustomer` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `customertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_dccustomerinward`
--

CREATE TABLE IF NOT EXISTS `master_dccustomerinward` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `customertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_dcsupplier`
--

CREATE TABLE IF NOT EXISTS `master_dcsupplier` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `suppliertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_dcsupplieroutward`
--

CREATE TABLE IF NOT EXISTS `master_dcsupplieroutward` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `suppliertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_deliverymode`
--

CREATE TABLE IF NOT EXISTS `master_deliverymode` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_department`
--

CREATE TABLE IF NOT EXISTS `master_department` (
  `auto_number` int(15) NOT NULL AUTO_INCREMENT,
  `department` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_designation`
--

CREATE TABLE IF NOT EXISTS `master_designation` (
  `auto_number` int(15) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_edition`
--

CREATE TABLE IF NOT EXISTS `master_edition` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `productcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `edition` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `allowed` int(255) NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `users` int(255) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_employee`
--

CREATE TABLE IF NOT EXISTS `master_employee` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `employeecode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `employeename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `lastupdateusername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdateipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_employeerights`
--

CREATE TABLE IF NOT EXISTS `master_employeerights` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `employeecode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mainmenuid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `submenuid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastupdateipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdateusername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2115 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_expense`
--

CREATE TABLE IF NOT EXISTS `master_expense` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `expensename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_expensemain`
--

CREATE TABLE IF NOT EXISTS `master_expensemain` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `expensemainname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_expensesub`
--

CREATE TABLE IF NOT EXISTS `master_expensesub` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `expensemainanum` int(255) NOT NULL,
  `expensemainname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `expensesubname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_item`
--

CREATE TABLE IF NOT EXISTS `master_item` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `categoryname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `unitname_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rateperunit` decimal(12,2) NOT NULL,
  `expiryperiod` int(255) NOT NULL,
  `taxanum` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  `description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `purchaseprice` decimal(13,2) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=136 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_menumain`
--

CREATE TABLE IF NOT EXISTS `master_menumain` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `mainmenuid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mainmenuorder` decimal(13,2) NOT NULL,
  `mainmenutext` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mainmenulink` text COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_menusub`
--

CREATE TABLE IF NOT EXISTS `master_menusub` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `mainmenuid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `submenuid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `submenuorder` int(255) NOT NULL,
  `submenutext` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `submenulink` text COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=200 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_printer`
--

CREATE TABLE IF NOT EXISTS `master_printer` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `papersize` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_production`
--

CREATE TABLE IF NOT EXISTS `master_production` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billdate` datetime NOT NULL,
  `enditemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `enditemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `totalunitsproduced` decimal(13,2) NOT NULL,
  `costperunit` decimal(13,2) NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_proformainvoice`
--

CREATE TABLE IF NOT EXISTS `master_proformainvoice` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `customertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cashgivenbycustomer` decimal(13,2) NOT NULL,
  `cashgiventocustomer` decimal(13,2) NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotalamountdiscountpercent` decimal(13,2) NOT NULL,
  `subtotalamountdiscountamount` decimal(13,2) NOT NULL,
  `subtotalaftercombinediscount` decimal(13,2) NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,2) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_purchase`
--

CREATE TABLE IF NOT EXISTS `master_purchase` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `suppliertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cashgivenbysupplier` decimal(13,2) NOT NULL,
  `cashgiventosupplier` decimal(13,2) NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotalamountdiscountpercent` decimal(13,2) NOT NULL,
  `subtotalamountdiscountamount` decimal(13,2) NOT NULL,
  `subtotalaftercombinediscount` decimal(13,2) NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,6) NOT NULL,
  `creditdays` int(255) NOT NULL,
  `creditdaysstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_purchaseorder`
--

CREATE TABLE IF NOT EXISTS `master_purchaseorder` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `suppliertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotalamountdiscountpercent` decimal(13,2) NOT NULL,
  `subtotalamountdiscountamount` decimal(13,2) NOT NULL,
  `subtotalaftercombinediscount` decimal(13,2) NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,6) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_purchaserequest`
--

CREATE TABLE IF NOT EXISTS `master_purchaserequest` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `suppliertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,2) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_purchasereturn`
--

CREATE TABLE IF NOT EXISTS `master_purchasereturn` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `suppliertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cashgivenbysupplier` decimal(13,2) NOT NULL,
  `cashgiventosupplier` decimal(13,2) NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotalamountdiscountpercent` decimal(13,2) NOT NULL,
  `subtotalamountdiscountamount` decimal(13,2) NOT NULL,
  `subtotalaftercombinediscount` decimal(13,2) NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,6) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_quotation`
--

CREATE TABLE IF NOT EXISTS `master_quotation` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `customeranum` int(255) NOT NULL,
  `customernameprefix1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactperson1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `designation1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `department1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` text COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lumpsum` decimal(13,2) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `totaldiscountpercent` decimal(13,2) NOT NULL,
  `totaldiscountamount` decimal(13,2) NOT NULL,
  `totalafterdiscount` decimal(13,2) NOT NULL,
  `totaltax` decimal(13,2) NOT NULL,
  `totalaftertax` decimal(13,2) NOT NULL,
  `transportation` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactperson2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `designation2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `department2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `contactperson3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `title3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `designation3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `department3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `quotationnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `quotationnumber` int(255) NOT NULL,
  `quotationdate` date NOT NULL,
  `deartext` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtext` text COLLATE latin1_general_ci NOT NULL,
  `reftext` text COLLATE latin1_general_ci NOT NULL,
  `quotationstarttext` text COLLATE latin1_general_ci NOT NULL,
  `tcline1` text COLLATE latin1_general_ci NOT NULL,
  `tcline2` text COLLATE latin1_general_ci NOT NULL,
  `tcline3` text COLLATE latin1_general_ci NOT NULL,
  `tcline4` text COLLATE latin1_general_ci NOT NULL,
  `tcline5` text COLLATE latin1_general_ci NOT NULL,
  `tcline6` text COLLATE latin1_general_ci NOT NULL,
  `tcline7` text COLLATE latin1_general_ci NOT NULL,
  `tcline8` text COLLATE latin1_general_ci NOT NULL,
  `quotationendtext` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_renewal`
--

CREATE TABLE IF NOT EXISTS `master_renewal` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `renewalmonths` int(255) NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_roundoff`
--

CREATE TABLE IF NOT EXISTS `master_roundoff` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `roundoff` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_sales`
--

CREATE TABLE IF NOT EXISTS `master_sales` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `customertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cashgivenbycustomer` decimal(13,2) NOT NULL,
  `cashgiventocustomer` decimal(13,2) NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `financialyear` year(4) NOT NULL,
  `subtotalamountdiscountpercent` decimal(13,2) NOT NULL,
  `subtotalamountdiscountamount` decimal(13,2) NOT NULL,
  `subtotalaftercombinediscount` decimal(13,2) NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,6) NOT NULL,
  `creditdays` int(255) NOT NULL,
  `creditdaysstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_salesorder`
--

CREATE TABLE IF NOT EXISTS `master_salesorder` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `customertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cashgivenbycustomer` decimal(13,2) NOT NULL,
  `cashgiventocustomer` decimal(13,2) NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotalamountdiscountpercent` decimal(13,2) NOT NULL,
  `subtotalamountdiscountamount` decimal(13,2) NOT NULL,
  `subtotalaftercombinediscount` decimal(13,2) NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,6) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_salesreturn`
--

CREATE TABLE IF NOT EXISTS `master_salesreturn` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billdate` datetime NOT NULL,
  `customertype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `location` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `delivery` decimal(13,2) NOT NULL,
  `packaging` decimal(13,2) NOT NULL,
  `roundoff` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `totalquantity` decimal(13,2) NOT NULL,
  `billtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cash` decimal(13,2) NOT NULL,
  `credit` decimal(13,2) NOT NULL,
  `online` decimal(13,2) NOT NULL,
  `creditcard` decimal(13,2) NOT NULL,
  `creditcardname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creditcardbankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtotaldiscountrupees` decimal(13,2) NOT NULL,
  `subtotaldiscountpercent` decimal(13,2) NOT NULL,
  `subtotaldiscounttotal` decimal(13,2) NOT NULL,
  `subtotalafterdiscount` decimal(13,2) NOT NULL,
  `subtotalaftertax` decimal(13,2) NOT NULL,
  `deliverymode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cashgivenbycustomer` decimal(13,2) NOT NULL,
  `cashgiventocustomer` decimal(13,2) NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deliveryaddress` text COLLATE latin1_general_ci NOT NULL,
  `subtotalamountdiscountpercent` decimal(13,2) NOT NULL,
  `subtotalamountdiscountamount` decimal(13,2) NOT NULL,
  `subtotalaftercombinediscount` decimal(13,2) NOT NULL,
  `subtotaldiscountpercentapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply1` decimal(13,2) NOT NULL,
  `subtotaldiscountamountonlyapply2` decimal(13,6) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_settings`
--

CREATE TABLE IF NOT EXISTS `master_settings` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `companycode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `modulename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `submodulename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `settingsname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `settingsvalue` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultvalue` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_settings_primaryvalues`
--

CREATE TABLE IF NOT EXISTS `master_settings_primaryvalues` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companyanum` int(255) NOT NULL,
  `companycode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `modulename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `submodulename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `settingsname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `settingsvalue` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `defaultvalue` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_state`
--

CREATE TABLE IF NOT EXISTS `master_state` (
  `auto_number` int(15) NOT NULL AUTO_INCREMENT,
  `state` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_stock`
--

CREATE TABLE IF NOT EXISTS `master_stock` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `transactiondate` date NOT NULL,
  `transactionmodule` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionparticular` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billautonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `rateperunit` decimal(13,2) NOT NULL,
  `totalrate` decimal(13,2) NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `customercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `financialyear` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_supplier`
--

CREATE TABLE IF NOT EXISTS `master_supplier` (
  `auto_number` int(13) NOT NULL AUTO_INCREMENT,
  `suppliercode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `typeofsupplier` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `address2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `area` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `city` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `state` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `country` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phonenumber2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `faxnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mobilenumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `emailid2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tinnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `openingbalance` decimal(13,2) NOT NULL,
  `remarks` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=234 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_tax`
--

CREATE TABLE IF NOT EXISTS `master_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,4) NOT NULL,
  `defaulttax` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_taxsub`
--

CREATE TABLE IF NOT EXISTS `master_taxsub` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `taxparentanum` int(255) NOT NULL,
  `taxparentname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxsubname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxsubpercent` decimal(13,4) NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_titlename`
--

CREATE TABLE IF NOT EXISTS `master_titlename` (
  `auto_number` int(15) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `titlename` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_transaction`
--

CREATE TABLE IF NOT EXISTS `master_transaction` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `transactioncode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactiondate` datetime NOT NULL,
  `particulars` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customeranum` int(255) NOT NULL,
  `customername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `supplieranum` int(255) NOT NULL,
  `suppliername` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionmode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactiontype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionmodule` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `transactionamount` decimal(13,2) NOT NULL,
  `cashamount` decimal(13,2) NOT NULL,
  `onlineamount` decimal(13,2) NOT NULL,
  `creditamount` decimal(13,2) NOT NULL,
  `chequeamount` decimal(13,2) NOT NULL,
  `cardamount` decimal(13,2) NOT NULL,
  `tdsamount` decimal(13,2) NOT NULL,
  `writeoffamount` decimal(13,2) NOT NULL,
  `balanceamount` decimal(13,2) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billanum` int(255) NOT NULL,
  `openingbalance` decimal(13,2) NOT NULL,
  `closingbalance` decimal(13,2) NOT NULL,
  `chequenumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `chequedate` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bankname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `bankbranch` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `remarks` text COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `collectionnumber` int(13) NOT NULL,
  `approvalstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_units`
--

CREATE TABLE IF NOT EXISTS `master_units` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `unitname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `unitname_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_updatesregistry`
--

CREATE TABLE IF NOT EXISTS `master_updatesregistry` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `update_id` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `update_release_date` date NOT NULL,
  `update_tablename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `update_fieldname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `update_applied_date` datetime NOT NULL,
  `update_applied_status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_wishes`
--

CREATE TABLE IF NOT EXISTS `master_wishes` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `wishesontop` text COLLATE latin1_general_ci NOT NULL,
  `wishesonbottom` text COLLATE latin1_general_ci NOT NULL,
  `showontop` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `showonbottom` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `production_details`
--

CREATE TABLE IF NOT EXISTS `production_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `production_tax`
--

CREATE TABLE IF NOT EXISTS `production_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `proformainvoice_details`
--

CREATE TABLE IF NOT EXISTS `proformainvoice_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `proformainvoice_print_dump`
--

CREATE TABLE IF NOT EXISTS `proformainvoice_print_dump` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `serialnumber` int(255) NOT NULL,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `proformainvoice_tax`
--

CREATE TABLE IF NOT EXISTS `proformainvoice_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_details`
--

CREATE TABLE IF NOT EXISTS `purchaseorder_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billdate` date NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_print_dump`
--

CREATE TABLE IF NOT EXISTS `purchaseorder_print_dump` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `serialnumber` int(255) NOT NULL,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder_tax`
--

CREATE TABLE IF NOT EXISTS `purchaseorder_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billdate` date NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest_details`
--

CREATE TABLE IF NOT EXISTS `purchaserequest_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchaserequest_tax`
--

CREATE TABLE IF NOT EXISTS `purchaserequest_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchasereturn_details`
--

CREATE TABLE IF NOT EXISTS `purchasereturn_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchasereturn_tax`
--

CREATE TABLE IF NOT EXISTS `purchasereturn_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billdate` datetime NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE IF NOT EXISTS `purchase_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_print_dump`
--

CREATE TABLE IF NOT EXISTS `purchase_print_dump` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `serialnumber` int(255) NOT NULL,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_tax`
--

CREATE TABLE IF NOT EXISTS `purchase_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billdate` datetime NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_details`
--

CREATE TABLE IF NOT EXISTS `quotation_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `quotationanum` int(255) NOT NULL,
  `categoryanum` int(255) NOT NULL,
  `categoryname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `additionaltext` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rateperunit` decimal(13,2) NOT NULL,
  `quantity` decimal(13,2) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountpercent` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `cstid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_tax`
--

CREATE TABLE IF NOT EXISTS `quotation_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `quotation_autonumber` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesorder_details`
--

CREATE TABLE IF NOT EXISTS `salesorder_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesorder_print_dump`
--

CREATE TABLE IF NOT EXISTS `salesorder_print_dump` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `serialnumber` int(255) NOT NULL,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesorder_tax`
--

CREATE TABLE IF NOT EXISTS `salesorder_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesreturn_details`
--

CREATE TABLE IF NOT EXISTS `salesreturn_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salesreturn_tax`
--

CREATE TABLE IF NOT EXISTS `salesreturn_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billdate` datetime NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,2) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE IF NOT EXISTS `sales_details` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,4) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_print_dump`
--

CREATE TABLE IF NOT EXISTS `sales_print_dump` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `serialnumber` int(255) NOT NULL,
  `bill_autonumber` int(255) NOT NULL,
  `companyanum` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` text COLLATE latin1_general_ci NOT NULL,
  `itemdescription` text COLLATE latin1_general_ci NOT NULL,
  `unit_abbreviation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `rate` decimal(13,2) NOT NULL,
  `quantity` decimal(13,4) NOT NULL,
  `subtotal` decimal(13,2) NOT NULL,
  `free` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemtaxpercentage` decimal(13,2) NOT NULL,
  `itemtaxamount` decimal(13,2) NOT NULL,
  `discountpercentage` decimal(13,2) NOT NULL,
  `discountrupees` decimal(13,2) NOT NULL,
  `openingstock` int(255) NOT NULL,
  `closingstock` int(255) NOT NULL,
  `totalamount` decimal(13,2) NOT NULL,
  `discountamount` decimal(13,2) NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `entrydate` datetime NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_tax`
--

CREATE TABLE IF NOT EXISTS `sales_tax` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `bill_autonumber` int(255) NOT NULL,
  `billnumber` int(255) NOT NULL,
  `billdate` datetime NOT NULL,
  `itemanum` int(255) NOT NULL,
  `itemcode` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `itemrate` decimal(13,2) NOT NULL,
  `itemquantity` decimal(13,2) NOT NULL,
  `amountbeforetax` decimal(13,2) NOT NULL,
  `taxtype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `tax_autonumber` int(255) NOT NULL,
  `taxname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `taxpercent` decimal(13,4) NOT NULL,
  `taxamount` decimal(13,2) NOT NULL,
  `amountaftertax` decimal(13,2) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `recordstatus` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `financialyear` year(4) NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_approval`
--

CREATE TABLE IF NOT EXISTS `settings_approval` (
  `auto_number` int(15) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `approvalrequired` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_bill`
--

CREATE TABLE IF NOT EXISTS `settings_bill` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `f1` text COLLATE latin1_general_ci NOT NULL,
  `f2` text COLLATE latin1_general_ci NOT NULL,
  `f3` text COLLATE latin1_general_ci NOT NULL,
  `f4` text COLLATE latin1_general_ci NOT NULL,
  `f5` text COLLATE latin1_general_ci NOT NULL,
  `f6` text COLLATE latin1_general_ci NOT NULL,
  `f7` text COLLATE latin1_general_ci NOT NULL,
  `f8` text COLLATE latin1_general_ci NOT NULL,
  `f9` text COLLATE latin1_general_ci NOT NULL,
  `f10` text COLLATE latin1_general_ci NOT NULL,
  `f11` text COLLATE latin1_general_ci NOT NULL,
  `f12` text COLLATE latin1_general_ci NOT NULL,
  `f13` text COLLATE latin1_general_ci NOT NULL,
  `f14` text COLLATE latin1_general_ci NOT NULL,
  `f15` text COLLATE latin1_general_ci NOT NULL,
  `f16` text COLLATE latin1_general_ci NOT NULL,
  `f17` text COLLATE latin1_general_ci NOT NULL,
  `f18` text COLLATE latin1_general_ci NOT NULL,
  `f19` text COLLATE latin1_general_ci NOT NULL,
  `f20` text COLLATE latin1_general_ci NOT NULL,
  `f21` text COLLATE latin1_general_ci NOT NULL,
  `f22` text COLLATE latin1_general_ci NOT NULL,
  `f23` text COLLATE latin1_general_ci NOT NULL,
  `f24` text COLLATE latin1_general_ci NOT NULL,
  `f25` text COLLATE latin1_general_ci NOT NULL,
  `f26` text COLLATE latin1_general_ci NOT NULL,
  `f27` text COLLATE latin1_general_ci NOT NULL,
  `f28` text COLLATE latin1_general_ci NOT NULL,
  `f29` text COLLATE latin1_general_ci NOT NULL,
  `f30` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f31` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f32` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f9size` int(255) NOT NULL,
  `f27size` int(255) NOT NULL,
  `f28size` int(255) NOT NULL,
  `f9color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f10color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f25color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedby` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companylogo` text COLLATE latin1_general_ci NOT NULL,
  `showlogo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `letterheadprinting` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_deliverychallan`
--

CREATE TABLE IF NOT EXISTS `settings_deliverychallan` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `f1` text COLLATE latin1_general_ci NOT NULL,
  `f2` text COLLATE latin1_general_ci NOT NULL,
  `f3` text COLLATE latin1_general_ci NOT NULL,
  `f4` text COLLATE latin1_general_ci NOT NULL,
  `f5` text COLLATE latin1_general_ci NOT NULL,
  `f6` text COLLATE latin1_general_ci NOT NULL,
  `f7` text COLLATE latin1_general_ci NOT NULL,
  `f8` text COLLATE latin1_general_ci NOT NULL,
  `f9` text COLLATE latin1_general_ci NOT NULL,
  `f10` text COLLATE latin1_general_ci NOT NULL,
  `f11` text COLLATE latin1_general_ci NOT NULL,
  `f12` text COLLATE latin1_general_ci NOT NULL,
  `f13` text COLLATE latin1_general_ci NOT NULL,
  `f14` text COLLATE latin1_general_ci NOT NULL,
  `f15` text COLLATE latin1_general_ci NOT NULL,
  `f16` text COLLATE latin1_general_ci NOT NULL,
  `f17` text COLLATE latin1_general_ci NOT NULL,
  `f18` text COLLATE latin1_general_ci NOT NULL,
  `f19` text COLLATE latin1_general_ci NOT NULL,
  `f20` text COLLATE latin1_general_ci NOT NULL,
  `f21` text COLLATE latin1_general_ci NOT NULL,
  `f22` text COLLATE latin1_general_ci NOT NULL,
  `f23` text COLLATE latin1_general_ci NOT NULL,
  `f24` text COLLATE latin1_general_ci NOT NULL,
  `f25` text COLLATE latin1_general_ci NOT NULL,
  `f26` text COLLATE latin1_general_ci NOT NULL,
  `f27` text COLLATE latin1_general_ci NOT NULL,
  `f28` text COLLATE latin1_general_ci NOT NULL,
  `f29` text COLLATE latin1_general_ci NOT NULL,
  `f30` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f31` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f32` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f9size` int(255) NOT NULL,
  `f27size` int(255) NOT NULL,
  `f28size` int(255) NOT NULL,
  `f9color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f10color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f25color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedby` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companylogo` text COLLATE latin1_general_ci NOT NULL,
  `showlogo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `letterheadprinting` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_proformainvoice`
--

CREATE TABLE IF NOT EXISTS `settings_proformainvoice` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `f1` text COLLATE latin1_general_ci NOT NULL,
  `f2` text COLLATE latin1_general_ci NOT NULL,
  `f3` text COLLATE latin1_general_ci NOT NULL,
  `f4` text COLLATE latin1_general_ci NOT NULL,
  `f5` text COLLATE latin1_general_ci NOT NULL,
  `f6` text COLLATE latin1_general_ci NOT NULL,
  `f7` text COLLATE latin1_general_ci NOT NULL,
  `f8` text COLLATE latin1_general_ci NOT NULL,
  `f9` text COLLATE latin1_general_ci NOT NULL,
  `f10` text COLLATE latin1_general_ci NOT NULL,
  `f11` text COLLATE latin1_general_ci NOT NULL,
  `f12` text COLLATE latin1_general_ci NOT NULL,
  `f13` text COLLATE latin1_general_ci NOT NULL,
  `f14` text COLLATE latin1_general_ci NOT NULL,
  `f15` text COLLATE latin1_general_ci NOT NULL,
  `f16` text COLLATE latin1_general_ci NOT NULL,
  `f17` text COLLATE latin1_general_ci NOT NULL,
  `f18` text COLLATE latin1_general_ci NOT NULL,
  `f19` text COLLATE latin1_general_ci NOT NULL,
  `f20` text COLLATE latin1_general_ci NOT NULL,
  `f21` text COLLATE latin1_general_ci NOT NULL,
  `f22` text COLLATE latin1_general_ci NOT NULL,
  `f23` text COLLATE latin1_general_ci NOT NULL,
  `f24` text COLLATE latin1_general_ci NOT NULL,
  `f25` text COLLATE latin1_general_ci NOT NULL,
  `f26` text COLLATE latin1_general_ci NOT NULL,
  `f27` text COLLATE latin1_general_ci NOT NULL,
  `f28` text COLLATE latin1_general_ci NOT NULL,
  `f29` text COLLATE latin1_general_ci NOT NULL,
  `f30` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f31` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f32` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f9size` int(255) NOT NULL,
  `f27size` int(255) NOT NULL,
  `f28size` int(255) NOT NULL,
  `f9color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f10color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f25color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedby` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companylogo` text COLLATE latin1_general_ci NOT NULL,
  `showlogo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `letterheadprinting` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_purchase`
--

CREATE TABLE IF NOT EXISTS `settings_purchase` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `f1` text COLLATE latin1_general_ci NOT NULL,
  `f2` text COLLATE latin1_general_ci NOT NULL,
  `f3` text COLLATE latin1_general_ci NOT NULL,
  `f4` text COLLATE latin1_general_ci NOT NULL,
  `f5` text COLLATE latin1_general_ci NOT NULL,
  `f6` text COLLATE latin1_general_ci NOT NULL,
  `f7` text COLLATE latin1_general_ci NOT NULL,
  `f8` text COLLATE latin1_general_ci NOT NULL,
  `f9` text COLLATE latin1_general_ci NOT NULL,
  `f10` text COLLATE latin1_general_ci NOT NULL,
  `f11` text COLLATE latin1_general_ci NOT NULL,
  `f12` text COLLATE latin1_general_ci NOT NULL,
  `f13` text COLLATE latin1_general_ci NOT NULL,
  `f14` text COLLATE latin1_general_ci NOT NULL,
  `f15` text COLLATE latin1_general_ci NOT NULL,
  `f16` text COLLATE latin1_general_ci NOT NULL,
  `f17` text COLLATE latin1_general_ci NOT NULL,
  `f18` text COLLATE latin1_general_ci NOT NULL,
  `f19` text COLLATE latin1_general_ci NOT NULL,
  `f20` text COLLATE latin1_general_ci NOT NULL,
  `f21` text COLLATE latin1_general_ci NOT NULL,
  `f22` text COLLATE latin1_general_ci NOT NULL,
  `f23` text COLLATE latin1_general_ci NOT NULL,
  `f24` text COLLATE latin1_general_ci NOT NULL,
  `f25` text COLLATE latin1_general_ci NOT NULL,
  `f26` text COLLATE latin1_general_ci NOT NULL,
  `f27` text COLLATE latin1_general_ci NOT NULL,
  `f28` text COLLATE latin1_general_ci NOT NULL,
  `f29` text COLLATE latin1_general_ci NOT NULL,
  `f30` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f31` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f32` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f9size` int(255) NOT NULL,
  `f27size` int(255) NOT NULL,
  `f28size` int(255) NOT NULL,
  `f9color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f10color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f25color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedby` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companylogo` text COLLATE latin1_general_ci NOT NULL,
  `showlogo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `letterheadprinting` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_purchaseorder`
--

CREATE TABLE IF NOT EXISTS `settings_purchaseorder` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `f1` text COLLATE latin1_general_ci NOT NULL,
  `f2` text COLLATE latin1_general_ci NOT NULL,
  `f3` text COLLATE latin1_general_ci NOT NULL,
  `f4` text COLLATE latin1_general_ci NOT NULL,
  `f5` text COLLATE latin1_general_ci NOT NULL,
  `f6` text COLLATE latin1_general_ci NOT NULL,
  `f7` text COLLATE latin1_general_ci NOT NULL,
  `f8` text COLLATE latin1_general_ci NOT NULL,
  `f9` text COLLATE latin1_general_ci NOT NULL,
  `f10` text COLLATE latin1_general_ci NOT NULL,
  `f11` text COLLATE latin1_general_ci NOT NULL,
  `f12` text COLLATE latin1_general_ci NOT NULL,
  `f13` text COLLATE latin1_general_ci NOT NULL,
  `f14` text COLLATE latin1_general_ci NOT NULL,
  `f15` text COLLATE latin1_general_ci NOT NULL,
  `f16` text COLLATE latin1_general_ci NOT NULL,
  `f17` text COLLATE latin1_general_ci NOT NULL,
  `f18` text COLLATE latin1_general_ci NOT NULL,
  `f19` text COLLATE latin1_general_ci NOT NULL,
  `f20` text COLLATE latin1_general_ci NOT NULL,
  `f21` text COLLATE latin1_general_ci NOT NULL,
  `f22` text COLLATE latin1_general_ci NOT NULL,
  `f23` text COLLATE latin1_general_ci NOT NULL,
  `f24` text COLLATE latin1_general_ci NOT NULL,
  `f25` text COLLATE latin1_general_ci NOT NULL,
  `f26` text COLLATE latin1_general_ci NOT NULL,
  `f27` text COLLATE latin1_general_ci NOT NULL,
  `f28` text COLLATE latin1_general_ci NOT NULL,
  `f29` text COLLATE latin1_general_ci NOT NULL,
  `f30` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f31` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f32` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f9size` int(255) NOT NULL,
  `f27size` int(255) NOT NULL,
  `f28size` int(255) NOT NULL,
  `f9color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f10color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f25color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedby` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companylogo` text COLLATE latin1_general_ci NOT NULL,
  `showlogo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `letterheadprinting` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_quotation`
--

CREATE TABLE IF NOT EXISTS `settings_quotation` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `companytitle` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `headerline1left` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `headerline2left` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `headerline3left` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `headerline1right` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `headerline2right` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `headerline3right` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `quotationtitle` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `quotationnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `quotationnumber` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customernameprefix1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `addressline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `kindattntext` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `deartext` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `subtext` text COLLATE latin1_general_ci NOT NULL,
  `reftext` text COLLATE latin1_general_ci NOT NULL,
  `quotationstarttext` text COLLATE latin1_general_ci NOT NULL,
  `tcline1` text COLLATE latin1_general_ci NOT NULL,
  `tcline2` text COLLATE latin1_general_ci NOT NULL,
  `tcline3` text COLLATE latin1_general_ci NOT NULL,
  `tcline4` text COLLATE latin1_general_ci NOT NULL,
  `tcline5` text COLLATE latin1_general_ci NOT NULL,
  `tcline6` text COLLATE latin1_general_ci NOT NULL,
  `tcline7` text COLLATE latin1_general_ci NOT NULL,
  `tcline8` text COLLATE latin1_general_ci NOT NULL,
  `quotationendtext` text COLLATE latin1_general_ci NOT NULL,
  `footerline1` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline2` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline3` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline4` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline5` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `footerline6` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `fontsize1` int(255) NOT NULL,
  `fontsize2` int(255) NOT NULL,
  `fontsize3` int(255) NOT NULL,
  `fontsize4` int(255) NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cstname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_salesorder`
--

CREATE TABLE IF NOT EXISTS `settings_salesorder` (
  `auto_number` int(255) NOT NULL AUTO_INCREMENT,
  `f1` text COLLATE latin1_general_ci NOT NULL,
  `f2` text COLLATE latin1_general_ci NOT NULL,
  `f3` text COLLATE latin1_general_ci NOT NULL,
  `f4` text COLLATE latin1_general_ci NOT NULL,
  `f5` text COLLATE latin1_general_ci NOT NULL,
  `f6` text COLLATE latin1_general_ci NOT NULL,
  `f7` text COLLATE latin1_general_ci NOT NULL,
  `f8` text COLLATE latin1_general_ci NOT NULL,
  `f9` text COLLATE latin1_general_ci NOT NULL,
  `f10` text COLLATE latin1_general_ci NOT NULL,
  `f11` text COLLATE latin1_general_ci NOT NULL,
  `f12` text COLLATE latin1_general_ci NOT NULL,
  `f13` text COLLATE latin1_general_ci NOT NULL,
  `f14` text COLLATE latin1_general_ci NOT NULL,
  `f15` text COLLATE latin1_general_ci NOT NULL,
  `f16` text COLLATE latin1_general_ci NOT NULL,
  `f17` text COLLATE latin1_general_ci NOT NULL,
  `f18` text COLLATE latin1_general_ci NOT NULL,
  `f19` text COLLATE latin1_general_ci NOT NULL,
  `f20` text COLLATE latin1_general_ci NOT NULL,
  `f21` text COLLATE latin1_general_ci NOT NULL,
  `f22` text COLLATE latin1_general_ci NOT NULL,
  `f23` text COLLATE latin1_general_ci NOT NULL,
  `f24` text COLLATE latin1_general_ci NOT NULL,
  `f25` text COLLATE latin1_general_ci NOT NULL,
  `f26` text COLLATE latin1_general_ci NOT NULL,
  `f27` text COLLATE latin1_general_ci NOT NULL,
  `f28` text COLLATE latin1_general_ci NOT NULL,
  `f29` text COLLATE latin1_general_ci NOT NULL,
  `f30` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f31` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f32` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f9size` int(255) NOT NULL,
  `f27size` int(255) NOT NULL,
  `f28size` int(255) NOT NULL,
  `f9color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f10color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `f25color` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedby` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `updatedate` datetime NOT NULL,
  `companyanum` int(255) NOT NULL,
  `companyname` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `companylogo` text COLLATE latin1_general_ci NOT NULL,
  `showlogo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `letterheadprinting` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberprefix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `billnumberpostfix` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`auto_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
