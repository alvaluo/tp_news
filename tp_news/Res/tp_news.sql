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
CREATE DATABASE IF NOT EXISTS `tp_news` /*!40100 DEFAULT CHARACTER SET gb2312 */;
USE `tp_news`;


-- Dumping structure for table tp_news.enterprise
CREATE TABLE IF NOT EXISTS `enterprise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyname` varchar(50) NOT NULL,
  `englishname` varchar(50) DEFAULT NULL,
  `companynature` varchar(50) NOT NULL,
  `companytype` varchar(50) DEFAULT NULL,
  `introduction` varchar(5000) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `regname` varchar(100) DEFAULT NULL,
  `companyPic` varchar(150) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `qq` varchar(13) DEFAULT NULL,
  `insertDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table tp_news.enterprise: ~0 rows (approximately)
/*!40000 ALTER TABLE `enterprise` DISABLE KEYS */;
/*!40000 ALTER TABLE `enterprise` ENABLE KEYS */;


-- Dumping structure for table tp_news.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `createtime` datetime NOT NULL,
  `agent` varchar(100) NOT NULL,
  `comment` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=gb2312;

-- Dumping data for table tp_news.logs: ~20 rows (approximately)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `username`, `ip`, `createtime`, `agent`, `comment`) VALUES
	(1, 'admin', '127.0.0.1', '2013-08-07 14:30:22', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login'),
	(2, 'admin', '127.0.0.1', '2013-08-15 00:39:28', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;


-- Dumping structure for table tp_news.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(50) NOT NULL,
  `moduleurl` varchar(50) DEFAULT NULL,
  `mrid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=gb2312 COMMENT='模块表';

-- Dumping data for table tp_news.modules: ~6 rows (approximately)
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`, `modulename`, `moduleurl`, `mrid`) VALUES
	(1, '用户管理', '__APP__/Admin/Users/lists', 4),
	(2, '日志管理', '__APP__/Admin/Logs/lists', 4),
	(3, '权限管理', '__APP__/Admin/Rules/lists', 4),
	(4, '系统管理', NULL, 0),
	(5, '站点管理', NULL, 0),
	(6, '分类管理', 'http://www.baidu.com', 5);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;


-- Dumping structure for table tp_news.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `mid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=gb2312 COMMENT='角色表';

-- Dumping data for table tp_news.roles: ~4 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `rolename`, `comment`, `mid`) VALUES
	(2, '超级管理员', '最高权限管理员', '4,1,2,3,5,6'),
	(9, '管理员', '管理员', '1'),
	(10, '来宾', '来宾', ''),
	(11, '测试员', '测试员', '');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table tp_news.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `createtime` datetime NOT NULL,
  `lasttime` datetime NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `roleid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=gb2312;

-- Dumping data for table tp_news.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `realname`, `createtime`, `lasttime`, `email`, `locked`, `roleid`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2013-08-07 09:40:04', '2013-08-07 09:40:04', 'luowei6@qq.com', 1, 2),
	(3, 'alva', '08c9371ae005cdefed132f2606c7e7f3', 'alva', '2013-08-07 14:57:43', '2013-08-07 14:57:43', 'luowei6@qq.com', 1, 9);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
