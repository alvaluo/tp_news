-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.12 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.0.0.4464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tp_news
DROP DATABASE IF EXISTS `tp_news`;
CREATE DATABASE IF NOT EXISTS `tp_news` /*!40100 DEFAULT CHARACTER SET gb2312 */;
USE `tp_news`;


-- Dumping structure for table tp_news.logs
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `createtime` datetime NOT NULL,
  `agent` varchar(100) NOT NULL,
  `comment` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table tp_news.logs: ~8 rows (approximately)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `username`, `ip`, `createtime`, `agent`, `comment`) VALUES
	(1, 'admin', '127.0.0.1', '2013-08-07 14:30:22', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login'),
	(2, 'admin', '127.0.0.1', '2013-08-07 14:55:38', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login'),
	(4, 'admin', '127.0.0.1', '2013-08-07 14:58:37', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login'),
	(6, 'alva', '127.0.0.1', '2013-08-07 15:02:44', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login'),
	(7, 'admin', '127.0.0.1', '2013-08-07 22:47:13', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;


-- Dumping structure for table tp_news.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `createtime` datetime NOT NULL,
  `lasttime` datetime NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table tp_news.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `realname`, `createtime`, `lasttime`, `email`, `locked`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2013-08-07 09:40:04', '2013-08-07 09:40:04', 'luowei6@qq.com', 1),
	(3, 'alva', '08c9371ae005cdefed132f2606c7e7f3', 'alva', '2013-08-07 14:57:43', '2013-08-07 14:57:43', 'luowei6@qq.com', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

DROP TABLE IF EXISTS `enterprise`;
CREATE TABLE IF NOT EXISTS `enterprise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyname` varchar(50) NOT NULL,
  `englishname` varchar(50) NULL,
  `companynature` varchar(50) NOT NULL,
  `companytype` varchar(50)  NULL,
  `address` varchar(100) NULL,
  `regname` varchar(100) NULL,
  `companyPic` varchar(150) NULL,
  `logo` varchar(150) NULL,
  `phone` varchar(30) NULL,
  `fax` varchar(30) NULL,
  `mobile` varchar(11) NULL,
  `email` varchar(100) NULL,
  `qq`  varchar(13)  NULL,
  `insertDate`  datetime  NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
