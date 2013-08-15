-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.10 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             7.0.0.4389
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tp_news
DROP DATABASE IF EXISTS `tp_news`;
CREATE DATABASE IF NOT EXISTS `tp_news` /*!40100 DEFAULT CHARACTER SET gb2312 */;
USE `tp_news`;


-- Dumping structure for table tp_news.enterprise
DROP TABLE IF EXISTS `enterprise`;
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
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `createtime` datetime NOT NULL,
  `agent` varchar(100) NOT NULL,
  `comment` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=gb2312;

-- Dumping data for table tp_news.logs: ~39 rows (approximately)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `username`, `ip`, `createtime`, `agent`, `comment`) VALUES
	(1, 'admin', '127.0.0.1', '2013-08-07 14:30:22', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login'),
	(2, 'admin', '127.0.0.1', '2013-08-15 00:39:28', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3', 'Login'),
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;


-- Dumping structure for table tp_news.modules
DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(50) NOT NULL,
  `moduleurl` varchar(50) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `mrid` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=gb2312 COMMENT='模块表';

-- Dumping data for table tp_news.modules: ~6 rows (approximately)
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`, `modulename`, `moduleurl`, `createtime`, `mrid`, `sort`) VALUES
	(1, '用户管理', '__APP__/admin/users/lists', '2013-08-15 11:13:49', 4, 1),
	(2, '日志管理', '__APP__/admin/logs/lists', '2013-08-15 11:13:52', 4, 2),
	(3, '权限管理', '__APP__/admin/rules/lists', '2013-08-15 11:13:54', 4, 3),
	(4, '系统管理', NULL, '2013-08-15 11:13:55', 0, 2),
	(5, '站点管理', NULL, '2013-08-15 11:13:57', 0, 1),
	(6, '分类管理', 'http://www.baidu.com', '2013-08-15 11:14:00', 5, 1);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;


-- Dumping structure for table tp_news.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `mid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=gb2312 COMMENT='角色表';

-- Dumping data for table tp_news.roles: ~4 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `rolename`, `comment`, `mid`) VALUES
	(2, '超级管理员', '最高权限管理员', '1,2,3,6,13,14'),
	(9, '管理员', '管理员', '1'),
	(10, '来宾', '来宾', '1,2'),
	(11, '测试员', '测试员', '');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


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
  `roleid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=gb2312;

-- Dumping data for table tp_news.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `realname`, `createtime`, `lasttime`, `email`, `locked`, `roleid`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2013-08-07 09:40:04', '2013-08-07 09:40:04', 'luowei6@qq.com', 1, 2),
	(3, 'alva', '08c9371ae005cdefed132f2606c7e7f3', 'alva', '2013-08-07 14:57:43', '2013-08-07 14:57:43', 'luowei6@qq.com', 1, 9);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
