/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.6.14 : Database - tp_news
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tp_news` /*!40100 DEFAULT CHARACTER SET gb2312 */;

USE `tp_news`;

/*Table structure for table `enterprise` */

DROP TABLE IF EXISTS `enterprise`;

CREATE TABLE `enterprise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyname` varchar(50) NOT NULL,
  `englishname` varchar(50) DEFAULT NULL,
  `companynature` varchar(50) NOT NULL,
  `companytype` varchar(50) DEFAULT NULL,
  `introduction` text,
  `address` varchar(100) DEFAULT NULL,
  `regname` varchar(100) DEFAULT NULL,
  `companypic` varchar(150) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `qq` varchar(13) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `enterprise` */

LOCK TABLES `enterprise` WRITE;

insert  into `enterprise`(`id`,`companyname`,`englishname`,`companynature`,`companytype`,`introduction`,`address`,`regname`,`companypic`,`logo`,`phone`,`fax`,`mobile`,`email`,`qq`,`createtime`,`type`,`copyright`) values (1,'深圳科特研科技公司','Kent Tech','科特研科技','单片机',' 杭州某某工程项目管理咨询有限公司是一家由建筑转型的专业性较强的工程项目管理咨询公司。公司注册资本2050 万元。下设市场部、咨询部、财务部、综合管理部、规划报建部、招标代理部、项目管理部、工程监理部等八个部门。为了顺应现代企业的发展，公司还专门设立了信息研发中心，从事信息数据集成管理及远程和现场的监控。 公司拥有注册造价工程师、注册咨询工程师、注册会计师、高级经济师、注册监理工程师、注册结构工程师78余人，配设有土建、安装、园林、水电、房地产经济、会计、技术经济、法律、统计等各专业人员。公司本着“诚信为本、顶天立地做人、客户至上、创造最大价值”的理念，以规范、专业的服务质量，以科学、高效、严谨的服务态度为客户提供专业优质的服务，更大限度地实现“客户利益最大化”。\r\n      下设市场部、咨询部、财务部、综合管理部、规划报建部、招标代理部、项目管理部、工程监理部等八个部门。为了顺应现代企业的发展，公司还专门设立了信息研发中心，从事信息数据集成管理及远程和现场的监控。 公司拥有注册造价工程师、注册咨询工程师、注册会计师、高级经济师、注册监理工程师、注册结构工程师78余人，配设有土建、安装、园林、水电、房地产经济、会计、技术经济、法律、统计等各专业人员。公司本着“诚信为本、顶天立地做人、客户至上、创造最大价值”的理念，以规范、专业的服务质量，以科学、高效、严谨的服务态度为客户提供专业优质的服务，更大限度地实现“客户利益最大化”。','广东省深圳市','何亚龙 ',NULL,NULL,'13510316030',NULL,NULL,NULL,NULL,'2013-08-19 15:25:20',0,'版权所有 Copyright(C)2009-2010');

UNLOCK TABLES;

/*Table structure for table `logs` */

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `createtime` datetime NOT NULL,
  `agent` varchar(100) NOT NULL,
  `comment` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=gb2312;

/*Data for the table `logs` */

LOCK TABLES `logs` WRITE;

insert  into `logs`(`id`,`username`,`ip`,`createtime`,`agent`,`comment`) values (1,'admin','127.0.0.1','2013-08-07 14:30:22','Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3','Login'),(2,'admin','127.0.0.1','2013-08-15 00:39:28','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.3','Login'),(189,'admin','127.0.0.1','2014-03-22 22:52:26','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(190,'admin','127.0.0.1','2014-03-22 23:31:49','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(191,'admin','127.0.0.1','2014-03-22 23:39:00','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(192,'admin','127.0.0.1','2014-03-22 23:40:15','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(193,'admin','127.0.0.1','2014-03-22 23:40:21','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(194,'admin','127.0.0.1','2014-03-22 23:55:03','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(195,'admin','127.0.0.1','2014-03-23 00:33:24','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(196,'admin','127.0.0.1','2014-03-23 00:54:03','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(197,'admin','127.0.0.1','2014-03-23 00:55:38','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(198,'admin','127.0.0.1','2014-03-23 01:02:43','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(199,'admin','127.0.0.1','2014-03-23 01:09:58','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(200,'admin','127.0.0.1','2014-03-23 01:10:41','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(201,'admin','127.0.0.1','2014-03-23 01:27:44','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(202,'admin','127.0.0.1','2014-03-23 01:37:44','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(203,'admin','127.0.0.1','2014-03-23 01:40:31','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(204,'admin','127.0.0.1','2014-03-23 01:42:45','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(205,'admin','127.0.0.1','2014-03-23 01:49:05','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(206,'admin','127.0.0.1','2014-03-23 01:50:27','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(207,'admin','127.0.0.1','2014-03-23 01:59:43','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(208,'admin','127.0.0.1','2014-03-23 02:06:39','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(209,'admin','127.0.0.1','2014-03-23 02:07:11','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login'),(210,'admin','127.0.0.1','2014-03-23 02:25:10','Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.','Login');

UNLOCK TABLES;

/*Table structure for table `medias` */

DROP TABLE IF EXISTS `medias`;

CREATE TABLE `medias` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `filetype` varchar(50) NOT NULL,
  `filesize` varchar(50) DEFAULT NULL,
  `url` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `rentext` varchar(50) DEFAULT NULL,
  `explain` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `createtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

/*Data for the table `medias` */

LOCK TABLES `medias` WRITE;

UNLOCK TABLES;

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `modulename` varchar(50) NOT NULL,
  `moduleurl` varchar(50) DEFAULT NULL,
  `createtime` datetime DEFAULT NULL,
  `mrid` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=gb2312 COMMENT='模块表';

/*Data for the table `modules` */

LOCK TABLES `modules` WRITE;

insert  into `modules`(`id`,`modulename`,`moduleurl`,`createtime`,`mrid`,`sort`) values (1,'用户管理','__APP__/admin/users/lists','2013-08-15 11:13:49',4,1),(2,'日志管理','__APP__/admin/logs/lists','2013-08-15 11:13:52',4,2),(3,'权限管理','__APP__/admin/rules/lists','2013-08-15 11:13:54',4,3),(4,'系统管理',NULL,'2013-08-15 11:13:55',0,2),(5,'站点管理',NULL,'2013-08-15 11:13:57',0,1),(6,'页面管理','__APP__/admin/pages/lists','2013-08-15 11:14:00',5,1),(7,'企业信息','__APP__/admin/enterprise/lists','2013-08-15 11:14:00',5,2),(8,'媒体管理','__APP__/admin/medias/lists',NULL,5,3),(9,'新闻管理','__APP__/admin/news/lists',NULL,5,4);

UNLOCK TABLES;

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `time` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `parent` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=gb2312;

/*Data for the table `pages` */

LOCK TABLES `pages` WRITE;

insert  into `pages`(`id`,`title`,`url`,`content`,`author`,`time`,`status`,`sort`,`parent`) values (1,'网站首页','http://localhost/index.php','111','admin','2013-08-16 15:16:36',1,1,0),(2,'产品展示','http://localhost/index.php/home/page/page_id/=14','111','admin','2013-08-16 15:17:36',1,2,0),(3,'联系我们','http://localhost/index.php/home/page/page_id/=14','111','admin','2013-08-16 15:17:47',1,6,0),(12,'公司简介','http://localhost/index.php/home/page/page_id/=14','11','admin','2013-08-19 14:50:09',1,4,0),(13,'在线留言','http://localhost/index.php/home/page/page_id/=14','','admin','2013-08-19 14:50:45',1,5,0),(14,'新闻中心','http://localhost/index.php/home/page/page_id/=14','','admin','2013-08-19 15:11:17',1,3,0);

UNLOCK TABLES;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `mid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=gb2312 COMMENT='角色表';

/*Data for the table `roles` */

LOCK TABLES `roles` WRITE;

insert  into `roles`(`id`,`rolename`,`comment`,`mid`) values (2,'超级管理员','最高权限管理员','4,1,2,3,5,6,7,8,9'),(9,'管理员','管理员','1'),(10,'来宾','来宾','1,2'),(11,'测试员','测试员','');

UNLOCK TABLES;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=gb2312;

/*Data for the table `users` */

LOCK TABLES `users` WRITE;

insert  into `users`(`id`,`username`,`password`,`realname`,`createtime`,`lasttime`,`email`,`locked`,`roleid`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','2013-08-07 09:40:04','2013-08-07 09:40:04','luowei6@qq.com',1,2),(3,'alva','08c9371ae005cdefed132f2606c7e7f3','alva','2013-08-07 14:57:43','2013-08-07 14:57:43','luowei6@qq.com',1,9);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
