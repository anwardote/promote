/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.6.32-1+deb.sury.org~xenial+0.1 : Database - advertisement
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`advertisement` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `advertisement`;

/*Table structure for table `cms_categories` */

DROP TABLE IF EXISTS `cms_categories`;

CREATE TABLE `cms_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `lft` int(10) unsigned DEFAULT NULL,
  `rgt` int(10) unsigned DEFAULT NULL,
  `depth` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cms_categories` */

insert  into `cms_categories`(`id`,`parent_id`,`lft`,`rgt`,`depth`,`name`,`created_at`,`updated_at`,`deleted_at`) values (1,0,NULL,NULL,NULL,'home','2016-11-30 20:03:20','2016-11-30 20:03:20',NULL),(2,0,NULL,NULL,NULL,'firmware','2016-11-30 20:03:47','2016-11-30 20:03:47',NULL),(3,0,NULL,NULL,NULL,'driver','2016-11-30 20:04:00','2016-11-30 20:04:00',NULL),(4,0,NULL,NULL,NULL,'tools','2016-11-30 20:04:18','2016-11-30 20:04:18',NULL),(5,0,NULL,NULL,NULL,'tutorials','2016-11-30 20:04:40','2016-11-30 20:04:40',NULL),(6,1,NULL,NULL,NULL,'slider_home','2016-11-30 20:07:26','2016-11-30 20:07:26',NULL),(7,2,NULL,NULL,NULL,'slider_firmware','2016-12-03 07:30:57','2016-12-03 07:30:57',NULL),(8,5,NULL,NULL,NULL,'slider_tutorial','2016-12-05 22:57:17','2016-12-05 22:57:17',NULL),(9,3,NULL,NULL,NULL,'slider_driver','2016-12-08 21:57:16','2016-12-08 21:57:16',NULL),(10,4,NULL,NULL,NULL,'slider_tool','2016-12-12 01:02:04','2016-12-12 01:02:04',NULL);

/*Table structure for table `cms_pages` */

DROP TABLE IF EXISTS `cms_pages`;

CREATE TABLE `cms_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `banner_type` enum('hero_image','slider') COLLATE utf8_unicode_ci NOT NULL,
  `extras` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cms_pages` */

insert  into `cms_pages`(`id`,`template`,`name`,`title`,`slug`,`content`,`banner_type`,`extras`,`created_at`,`updated_at`,`deleted_at`) values (1,'home','Home Page','Everything you need to drive engagement. All in one place. ','home','<p>We are&nbsp;committed to providing you with the capabilities, expertise and tools required to drive modern android and symbian phone. On this site you will find strategies and tools that were developed based on the best practices in consumer behavior, phone promotion with very rare firmware, tools, drivers and tutorials for easy understand.we ask you to be our partners and to use these tools frequently. Your team is always welcome here to help along the way.</p>','slider','{\"banner_title\":\"nimbuzz\",\"banner_image\":\"uploads\\/engagement4.jpg\"}','2016-11-30 19:41:14','2016-12-04 12:57:58',NULL),(2,'firmware','Firmware Page','Virtual Care  Firmware','virtual-care-firmware','','slider','{\"banner_title\":\"\",\"banner_image\":\"\",\"banner_description\":\"\"}','2016-12-03 07:44:58','2016-12-03 07:44:58',NULL),(3,'tutorial','Tutorial Page','tutorial','tutorial','<p>.</p>','slider','{\"banner_title\":\"\",\"banner_image\":\"\",\"banner_description\":\"\"}','2016-12-05 22:56:45','2016-12-05 22:56:45',NULL),(4,'driver','Driver page','driver','driver','<p>.</p>','slider','{\"banner_title\":\"\",\"banner_image\":\"\",\"banner_description\":\"\"}','2016-12-08 21:56:59','2016-12-08 21:56:59',NULL),(5,'tool','Tool page','Most popular Tool for 100% free  download forever.','most-popular-tool-for-100-free-download-forever','<p>Download 100% free tool for your device and share with your friends and familty...</p>','slider','{\"banner_title\":\"\",\"banner_image\":\"\",\"banner_description\":\"\"}','2016-12-12 01:00:11','2016-12-12 01:00:11',NULL);

/*Table structure for table `cms_posts` */

DROP TABLE IF EXISTS `cms_posts`;

CREATE TABLE `cms_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cms_category_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('PUBLISHED','DRAFT') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PUBLISHED',
  `date` date NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cms_posts` */

insert  into `cms_posts`(`id`,`cms_category_id`,`title`,`slug`,`content`,`image`,`status`,`date`,`featured`,`created_at`,`updated_at`,`deleted_at`,`source`) values (1,6,'.','home-slider','','uploads/cms/bigstock-Smartphones-and-mobile-applica-44827918.jpg','PUBLISHED','2016-11-30',1,'2016-11-30 20:08:57','2016-12-04 15:05:16',NULL,NULL),(2,6,'.','','','uploads/mobile_slide2.png','PUBLISHED','2016-11-30',0,'2016-11-30 21:32:17','2016-11-30 21:33:59',NULL,NULL),(3,6,'.','-1','','uploads/cms/117712-829-443.jpg','PUBLISHED','2016-11-30',0,'2016-11-30 21:32:41','2016-12-04 12:59:41',NULL,NULL),(4,7,'ভারচোয়ল','virtual-care-firmware','','uploads/cms/5.png','PUBLISHED','2016-12-03',0,'2016-12-03 07:48:21','2016-12-31 10:36:25',NULL,''),(5,7,'Smartphone Firmware','smartphone-firmware','','uploads/cms/117712-829-443.jpg','PUBLISHED','2016-12-03',0,'2016-12-03 07:49:31','2016-12-03 07:49:31',NULL,NULL),(6,8,'How to use the Free Firmware, Driver and Tools.','how-to-use-the-free-firmware-driver-and-tools','<p>Easily create, customize, and circulate high-quality promotional materials. We guide you through the process of creating beautiful HTML emails, flyers and social media posts to help you encourage activation and promote utilization, while marketing the MDLIVE brand people trust.</p>','uploads/cms/Mobile-phone-apps.jpg','PUBLISHED','2016-12-05',0,'2016-12-05 22:58:27','2016-12-05 22:58:27',NULL,NULL),(7,9,'Most popular free driver download ','most-popular-free-driver-download','<p>We have a lots of most popular driver for you totally free. It is easy to download and you also provide tutorial. You can get tutorial at the tutorial tab.</p>','uploads/cms/bigstock-Smartphones-and-mobile-applica-44827918.jpg','PUBLISHED','2016-12-08',0,'2016-12-08 22:00:19','2016-12-08 22:00:19',NULL,NULL),(8,10,'Most popular Tool for 100% free  download forever.','most-popular-tool-for-100-free-download-forever','<p>Download 100% free tool for your device and share with your friends and familty...</p>','','PUBLISHED','2016-12-12',0,'2016-12-12 01:05:48','2017-01-01 14:24:44',NULL,'https://www.youtube.com/watch?v=8Hxx1aY9_aU');

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_country_code_unique` (`country_code`),
  UNIQUE KEY `countries_country_name_unique` (`country_name`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `countries` */

insert  into `countries`(`id`,`country_code`,`country_name`) values (1,'','All Countries'),(2,'AF','Afghanistan'),(3,'AL','Albania'),(4,'DZ','Algeria'),(5,'DS','American Samoa'),(6,'AD','Andorra'),(7,'AO','Angola'),(8,'AI','Anguilla'),(9,'AQ','Antarctica'),(10,'AG','Antigua and Barbuda'),(11,'AR','Argentina'),(12,'AM','Armenia'),(13,'AW','Aruba'),(14,'AU','Australia'),(15,'AT','Austria'),(16,'AZ','Azerbaijan'),(17,'BS','Bahamas'),(18,'BH','Bahrain'),(19,'BD','Bangladesh'),(20,'BB','Barbados'),(21,'BY','Belarus'),(22,'BE','Belgium'),(23,'BZ','Belize'),(24,'BJ','Benin'),(25,'BM','Bermuda'),(26,'BT','Bhutan'),(27,'BO','Bolivia'),(28,'BA','Bosnia and Herzegovina'),(29,'BW','Botswana'),(30,'BV','Bouvet Island'),(31,'BR','Brazil'),(32,'IO','British Indian Ocean Territory'),(33,'BN','Brunei Darussalam'),(34,'BG','Bulgaria'),(35,'BF','Burkina Faso'),(36,'BI','Burundi'),(37,'KH','Cambodia'),(38,'CM','Cameroon'),(39,'CA','Canada'),(40,'CV','Cape Verde'),(41,'KY','Cayman Islands'),(42,'CF','Central African Republic'),(43,'TD','Chad'),(44,'CL','Chile'),(45,'CN','China'),(46,'CX','Christmas Island'),(47,'CC','Cocos (Keeling) Islands'),(48,'CO','Colombia'),(49,'KM','Comoros'),(50,'CG','Congo'),(51,'CK','Cook Islands'),(52,'CR','Costa Rica'),(53,'HR','Croatia (Hrvatska)'),(54,'CU','Cuba'),(55,'CY','Cyprus'),(56,'CZ','Czech Republic'),(57,'DK','Denmark'),(58,'DJ','Djibouti'),(59,'DM','Dominica'),(60,'DO','Dominican Republic'),(61,'TP','East Timor'),(62,'EC','Ecuador'),(63,'EG','Egypt'),(64,'SV','El Salvador'),(65,'GQ','Equatorial Guinea'),(66,'ER','Eritrea'),(67,'EE','Estonia'),(68,'ET','Ethiopia'),(69,'FK','Falkland Islands (Malvinas)'),(70,'FO','Faroe Islands'),(71,'FJ','Fiji'),(72,'FI','Finland'),(73,'FR','France'),(74,'FX','France, Metropolitan'),(75,'GF','French Guiana'),(76,'PF','French Polynesia'),(77,'TF','French Southern Territories'),(78,'GA','Gabon'),(79,'GM','Gambia'),(80,'GE','Georgia'),(81,'DE','Germany'),(82,'GH','Ghana'),(83,'GI','Gibraltar'),(84,'GK','Guernsey'),(85,'GR','Greece'),(86,'GL','Greenland'),(87,'GD','Grenada'),(88,'GP','Guadeloupe'),(89,'GU','Guam'),(90,'GT','Guatemala'),(91,'GN','Guinea'),(92,'GW','Guinea-Bissau'),(93,'GY','Guyana'),(94,'HT','Haiti'),(95,'HM','Heard and Mc Donald Islands'),(96,'HN','Honduras'),(97,'HK','Hong Kong'),(98,'HU','Hungary'),(99,'IS','Iceland'),(100,'IN','India'),(101,'IM','Isle of Man'),(102,'ID','Indonesia'),(103,'IR','Iran (Islamic Republic of)'),(104,'IQ','Iraq'),(105,'IE','Ireland'),(106,'IL','Israel'),(107,'IT','Italy'),(108,'CI','Ivory Coast'),(109,'JE','Jersey'),(110,'JM','Jamaica'),(111,'JP','Japan'),(112,'JO','Jordan'),(113,'KZ','Kazakhstan'),(114,'KE','Kenya'),(115,'KI','Kiribati'),(116,'KP','Korea, Democratic People\'s Republic of'),(117,'KR','Korea, Republic of'),(118,'XK','Kosovo'),(119,'KW','Kuwait'),(120,'KG','Kyrgyzstan'),(121,'LA','Lao People\'s Democratic Republic'),(122,'LV','Latvia'),(123,'LB','Lebanon'),(124,'LS','Lesotho'),(125,'LR','Liberia'),(126,'LY','Libyan Arab Jamahiriya'),(127,'LI','Liechtenstein'),(128,'LT','Lithuania'),(129,'LU','Luxembourg'),(130,'MO','Macau'),(131,'MK','Macedonia'),(132,'MG','Madagascar'),(133,'MW','Malawi'),(134,'MY','Malaysia'),(135,'MV','Maldives'),(136,'ML','Mali'),(137,'MT','Malta'),(138,'MH','Marshall Islands'),(139,'MQ','Martinique'),(140,'MR','Mauritania'),(141,'MU','Mauritius'),(142,'TY','Mayotte'),(143,'MX','Mexico'),(144,'FM','Micronesia, Federated States of'),(145,'MD','Moldova, Republic of'),(146,'MC','Monaco'),(147,'MN','Mongolia'),(148,'ME','Montenegro'),(149,'MS','Montserrat'),(150,'MA','Morocco'),(151,'MZ','Mozambique'),(152,'MM','Myanmar'),(153,'NA','Namibia'),(154,'NR','Nauru'),(155,'NP','Nepal'),(156,'NL','Netherlands'),(157,'AN','Netherlands Antilles'),(158,'NC','New Caledonia'),(159,'NZ','New Zealand'),(160,'NI','Nicaragua'),(161,'NE','Niger'),(162,'NG','Nigeria'),(163,'NU','Niue'),(164,'NF','Norfolk Island'),(165,'MP','Northern Mariana Islands'),(166,'NO','Norway'),(167,'OM','Oman'),(168,'PK','Pakistan'),(169,'PW','Palau'),(170,'PS','Palestine'),(171,'PA','Panama'),(172,'PG','Papua New Guinea'),(173,'PY','Paraguay'),(174,'PE','Peru'),(175,'PH','Philippines'),(176,'PN','Pitcairn'),(177,'PL','Poland'),(178,'PT','Portugal'),(179,'PR','Puerto Rico'),(180,'QA','Qatar'),(181,'RE','Reunion'),(182,'RO','Romania'),(183,'RU','Russian Federation'),(184,'RW','Rwanda'),(185,'KN','Saint Kitts and Nevis'),(186,'LC','Saint Lucia'),(187,'VC','Saint Vincent and the Grenadines'),(188,'WS','Samoa'),(189,'SM','San Marino'),(190,'ST','Sao Tome and Principe'),(191,'SA','Saudi Arabia'),(192,'SN','Senegal'),(193,'RS','Serbia'),(194,'SC','Seychelles'),(195,'SL','Sierra Leone'),(196,'SG','Singapore'),(197,'SK','Slovakia'),(198,'SI','Slovenia'),(199,'SB','Solomon Islands'),(200,'SO','Somalia'),(201,'ZA','South Africa'),(202,'GS','South Georgia South Sandwich Islands'),(203,'ES','Spain'),(204,'LK','Sri Lanka'),(205,'SH','St. Helena'),(206,'PM','St. Pierre and Miquelon'),(207,'SD','Sudan'),(208,'SR','Suriname'),(209,'SJ','Svalbard and Jan Mayen Islands'),(210,'SZ','Swaziland'),(211,'SE','Sweden'),(212,'CH','Switzerland'),(213,'SY','Syrian Arab Republic'),(214,'TW','Taiwan'),(215,'TJ','Tajikistan'),(216,'TZ','Tanzania, United Republic of'),(217,'TH','Thailand'),(218,'TG','Togo'),(219,'TK','Tokelau'),(220,'TO','Tonga'),(221,'TT','Trinidad and Tobago'),(222,'TN','Tunisia'),(223,'TR','Turkey'),(224,'TM','Turkmenistan'),(225,'TC','Turks and Caicos Islands'),(226,'TV','Tuvalu'),(227,'UG','Uganda'),(228,'UA','Ukraine'),(229,'AE','United Arab Emirates'),(230,'GB','United Kingdom'),(231,'US','United States'),(232,'UM','United States minor outlying islands'),(233,'UY','Uruguay'),(234,'UZ','Uzbekistan'),(235,'VU','Vanuatu'),(236,'VA','Vatican City State'),(237,'VE','Venezuela'),(238,'VN','Vietnam'),(239,'VG','Virgin Islands (British)'),(240,'VI','Virgin Islands (U.S.)'),(241,'WF','Wallis and Futuna Islands'),(242,'EH','Western Sahara'),(243,'YE','Yemen'),(244,'ZR','Zaire'),(245,'ZM','Zambia'),(246,'ZW','Zimbabwe');

/*Table structure for table `devices` */

DROP TABLE IF EXISTS `devices`;

CREATE TABLE `devices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introductions` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/default_mobile.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `devices` */

insert  into `devices`(`id`,`name`,`introductions`,`image`,`created_at`,`updated_at`) values (2,'Symphony','','uploads/device/Symphony','2016-12-04 13:46:40','2016-12-04 13:51:25'),(3,'Walton','Free Downloan Walton Firmware (All Models)','uploads/device/walton-logo-8655B6D7F3-seeklogo.com.gif.png','2016-12-04 14:27:26','2016-12-04 14:27:26'),(4,'Winstar','','uploads/device/winmax.jpg','2016-12-05 04:22:28','2016-12-05 04:31:56'),(5,'Winmax','','uploads/device/Winstar','2016-12-05 04:25:49','2016-12-05 04:25:49'),(6,'Strawberry','','uploads/device/Strawberry.png','2016-12-05 04:34:36','2016-12-05 04:34:36'),(7,'Telego','','uploads/device/thumb_logo_telego.gif.jpg','2016-12-05 04:37:20','2016-12-05 04:37:20'),(8,'Tinmo','','uploads/device/tinmo-20.png','2016-12-05 04:40:00','2016-12-05 04:40:00'),(9,'Western','','uploads/device/logo-western-star-320x240.jpg','2016-12-05 04:43:08','2016-12-05 04:43:08'),(10,'Ag-tel','','uploads/device/ag-2600.jpg','2016-12-05 04:54:13','2016-12-05 04:54:13'),(11,'Eliter','','uploads/device/Elite Mobiel Logo2.png','2016-12-05 04:56:04','2016-12-05 04:56:04'),(12,'Himax','','uploads/device/HIMX.jpg','2016-12-05 04:57:27','2016-12-05 04:57:27'),(13,'Itel','','uploads/device/hyaQwcpE.jpg','2016-12-05 05:00:07','2016-12-05 05:00:07'),(14,'Kingstar','','uploads/device/Kingstar.png','2016-12-05 05:01:22','2016-12-05 05:01:22'),(15,'Lava ','','uploads/device/lava_mobile.png','2016-12-05 05:02:41','2016-12-05 05:02:41'),(16,'Startel','','uploads/device/5c497480e260347e5f7aa20a5cc7e1af.png','2016-12-05 05:04:48','2016-12-05 05:04:48'),(17,'Syntax','','uploads/device/Logo-Syntax-Mobile.jpg','2016-12-05 05:08:08','2016-12-05 05:08:08'),(18,'Tecno ','','uploads/device/ccBPgkAP.jpg','2016-12-05 05:10:44','2016-12-05 05:10:44'),(19,'Utime','','uploads/device/31a882_6428deaaaa96c7a96e191b1c2a4d4393.png_srz_950_388_85_22_0.50_1.20_0.00_png_srz.jpg','2016-12-05 05:12:38','2016-12-05 05:12:38'),(20,'Vtech','','uploads/device/Logo---Vtech.jpg','2016-12-05 05:16:33','2016-12-05 05:16:33'),(21,'Zelta','','uploads/device/hqdefault.jpg','2016-12-05 05:21:12','2016-12-05 05:21:12'),(22,'Ztc','','uploads/device/logo_zte_3.jpg','2016-12-05 05:23:34','2016-12-05 05:23:34');

/*Table structure for table `driver_names` */

DROP TABLE IF EXISTS `driver_names`;

CREATE TABLE `driver_names` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introductions` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/default_driver.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `driver_names` */

insert  into `driver_names`(`id`,`name`,`introductions`,`image`,`created_at`,`updated_at`) values (1,'Western','','uploads/device/logo-western-star-320x240.jpg','2016-12-05 04:42:37','2016-12-05 04:42:37'),(2,'Symphony','','uploads/device/Symphony','2016-12-05 05:24:51','2016-12-05 05:24:51'),(3,'Walton','','uploads/device/walton-logo-8655B6D7F3-seeklogo.com.gif.png','2016-12-05 05:25:34','2016-12-05 05:26:05'),(4,'Winmax','','uploads/device/winmax.jpg','2016-12-05 05:26:36','2016-12-05 05:26:36'),(5,'Winmax','','uploads/device/6471eeeb1edfcc236d9218576f3f6b0b-250x100.png','2016-12-05 05:27:12','2016-12-05 05:27:12'),(6,'Ag-tel','','uploads/device/ag-2600.jpg','2016-12-05 05:27:36','2016-12-05 05:27:36'),(7,'Kingstar','','uploads/device/Kingstar.png','2016-12-05 05:28:15','2016-12-05 05:28:15'),(8,'Tecno','','uploads/device/ccBPgkAP.jpg','2016-12-05 05:29:22','2016-12-05 05:29:22'),(9,'Telego','','uploads/device/thumb_logo_telego.gif.jpg','2016-12-05 05:29:49','2016-12-05 05:29:49'),(10,'Tinmo','','uploads/device/tinmo-20.png','2016-12-05 05:30:13','2016-12-05 05:30:13'),(11,'Vtech','','uploads/device/Logo---Vtech.jpg','2016-12-05 05:30:44','2016-12-05 05:30:44'),(12,'Lava','','uploads/device/lava_mobile.png','2016-12-05 05:31:08','2016-12-05 05:31:08'),(13,'Zelta','','uploads/device/hqdefault.jpg','2016-12-05 05:31:39','2016-12-05 05:32:36'),(14,'Ztc','','uploads/device/logo_zte_3.jpg','2016-12-05 05:32:50','2016-12-05 05:32:50'),(15,'Himax','','uploads/device/HIMX.jpg','2016-12-05 05:33:20','2016-12-05 05:33:20'),(16,'Startel','','uploads/device/5c497480e260347e5f7aa20a5cc7e1af.png','2016-12-05 05:33:40','2016-12-05 05:33:40'),(17,'Strawberry','','uploads/device/Strawberry.png','2016-12-05 05:34:07','2016-12-05 05:34:07'),(18,'Syntax','','uploads/device/Logo-Syntax-Mobile.jpg','2016-12-05 05:34:24','2016-12-05 05:34:24'),(19,'Itel','','uploads/device/hyaQwcpE.jpg','2016-12-05 05:35:11','2016-12-05 05:35:11'),(20,'Eliter','','uploads/device/Elite Mobiel Logo2.png','2016-12-05 05:36:08','2016-12-05 05:36:08'),(21,'Utime','','uploads/device/31a882_6428deaaaa96c7a96e191b1c2a4d4393.png_srz_950_388_85_22_0.50_1.20_0.00_png_srz.jpg','2016-12-05 05:37:02','2016-12-05 05:37:02');

/*Table structure for table `driver_types` */

DROP TABLE IF EXISTS `driver_types`;

CREATE TABLE `driver_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `driver_types` */

insert  into `driver_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'Symphony','2016-12-06 14:40:45','2016-12-06 14:40:45');

/*Table structure for table `drivers` */

DROP TABLE IF EXISTS `drivers`;

CREATE TABLE `drivers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `st_instruct` text COLLATE utf8_unicode_ci,
  `driver_id` int(10) unsigned NOT NULL,
  `driver_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driver_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supports` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tutorial_id` int(10) unsigned DEFAULT NULL,
  `d_links` text COLLATE utf8_unicode_ci,
  `d_sizes` text COLLATE utf8_unicode_ci,
  `noted` text COLLATE utf8_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING','HIDDEN') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PUBLISHED',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view_category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `drivers_driver_id_foreign` (`driver_id`),
  KEY `drivers_tutorial_id_foreign` (`tutorial_id`),
  KEY `drivers_user_id_foreign` (`user_id`),
  KEY `drivers_view_categories_fk` (`view_category_id`),
  CONSTRAINT `drivers_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `driver_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drivers_tutorial_id_foreign` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`),
  CONSTRAINT `drivers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drivers_view_categories_fk` FOREIGN KEY (`view_category_id`) REFERENCES `view_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `drivers` */

insert  into `drivers`(`id`,`st_instruct`,`driver_id`,`driver_model`,`driver_type`,`supports`,`tutorial_id`,`d_links`,`d_sizes`,`noted`,`status`,`featured`,`user_id`,`created_at`,`updated_at`,`view_category_id`) values (1,NULL,2,'Symphony A50 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',2,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10 MB','','PUBLISHED',1,1,'2016-12-06 15:11:44','2016-12-19 08:21:49',13),(2,NULL,2,'Symphony E5 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro ',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',1,1,'2016-12-21 07:58:54','2016-12-21 08:22:29',13),(3,NULL,2,'Symphony E7 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 08:26:41','2016-12-21 08:26:41',13),(4,NULL,2,'Symphony E10 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 08:27:35','2016-12-21 08:27:35',13),(5,NULL,2,'Symphony E25 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 08:28:23','2016-12-21 08:28:23',13),(6,NULL,1,'Symphony E50 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro ',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 09:47:20','2016-12-21 10:09:33',13),(7,NULL,2,'Symphony E55 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 10:11:28','2016-12-21 10:11:28',13),(8,NULL,2,'Symphony E60 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 10:12:53','2016-12-21 10:12:53',13),(9,NULL,2,'Symphony E60 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','','','PUBLISHED',0,1,'2016-12-21 10:13:39','2016-12-21 10:13:39',13),(10,NULL,2,'Symphony E75 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','','','PUBLISHED',0,1,'2016-12-21 10:14:04','2016-12-21 10:14:04',13),(11,NULL,2,'Symphony E76 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','','','PUBLISHED',0,1,'2016-12-21 10:14:44','2016-12-21 10:14:44',13),(12,NULL,2,'Symphony F15 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 10:16:34','2016-12-21 10:16:34',13),(13,NULL,2,'Symphony H20 USB Driver','1','Windows Computer 7, 8.1, 10, 10 Pro',NULL,'https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','10MB','','PUBLISHED',0,1,'2016-12-21 10:21:56','2016-12-21 10:21:56',13);

/*Table structure for table `fcategories` */

DROP TABLE IF EXISTS `fcategories`;

CREATE TABLE `fcategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `fcategories` */

insert  into `fcategories`(`id`,`title`,`created_at`,`updated_at`) values (1,'Android Firmware',NULL,NULL),(2,'Normal Firmware',NULL,NULL),(3,'Driver',NULL,NULL),(4,'Tools',NULL,NULL);

/*Table structure for table `firmwares` */

DROP TABLE IF EXISTS `firmwares`;

CREATE TABLE `firmwares` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fcategory_id` int(10) unsigned NOT NULL,
  `st_instruct` text COLLATE utf8_unicode_ci,
  `device_id` int(10) unsigned NOT NULL,
  `device_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tutorial_id` int(10) unsigned DEFAULT NULL,
  `country_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d_links` text COLLATE utf8_unicode_ci,
  `d_sizes` text COLLATE utf8_unicode_ci,
  `noted` text COLLATE utf8_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING','HIDDEN') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PUBLISHED',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view_category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `firmwares_fcategory_id_foreign` (`fcategory_id`),
  KEY `firmwares_device_id_foreign` (`device_id`),
  KEY `firmwares_tutorial_id_foreign` (`tutorial_id`),
  KEY `firmwares_country_id_foreign` (`country_id`),
  KEY `firmwares_user_id_foreign` (`user_id`),
  KEY `firmwares_view_categories_fk` (`view_category_id`),
  CONSTRAINT `firmwares_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `firmwares_fcategory_id_foreign` FOREIGN KEY (`fcategory_id`) REFERENCES `fcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `firmwares_tutorial_id_foreign` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorials` (`id`),
  CONSTRAINT `firmwares_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `firmwares_view_categories_fk` FOREIGN KEY (`view_category_id`) REFERENCES `view_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `firmwares` */

insert  into `firmwares`(`id`,`fcategory_id`,`st_instruct`,`device_id`,`device_model`,`device_version`,`tutorial_id`,`country_id`,`d_links`,`d_sizes`,`noted`,`status`,`featured`,`user_id`,`created_at`,`updated_at`,`view_category_id`) values (3,2,NULL,2,'Symphony A86','update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvdmdJYkFRS2VndUU/view?usp=sharing','6MB','','PUBLISHED',1,1,'2016-12-04 14:05:14','2017-01-01 12:16:48',8),(4,1,NULL,2,'Symphony A50 Free Firmware',' 4.4.4',2,'1','https://drive.google.com/uc?id=0BzMDj7ugTrP1bUJzOVRFZURFTm8,https://docs.google.com/uc?id=0B9qXrBGQ-J6ORldsMU16TWFaTFk&export=download','517 MB+529 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process.','PUBLISHED',1,1,'2016-12-06 15:18:38','2016-12-21 07:39:52',12),(5,2,NULL,2,'Symphony B06','update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvaUFwLVM1REw4QXc/view?usp=sharing','1.5 MB','','PUBLISHED',0,1,'2016-12-07 04:07:51','2017-01-01 12:17:03',8),(6,2,NULL,2,'Symphony B10','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvZ1VYS0w3Z3hSd28/view?usp=sharing','2.56 MB',' Your Android Smartphone should have at-least 40-50 percent of battery to  preform the flashing process.','PUBLISHED',0,1,'2016-12-07 04:21:05','2017-01-01 12:17:33',8),(7,2,NULL,2,'Symphony B10i','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvekxORkdzRVJzbzA/view?usp=sharing','5.37 MB','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]','PUBLISHED',0,1,'2016-12-07 04:27:29','2017-01-01 12:17:55',8),(9,1,NULL,2,'Symphony E5 Free Firmware','E5_0_XXX_V01.7_V1.1.0',2,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OVFRtT1ZOSk1KT3c&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6ORUlmWDQyVGZZZW8&export=downloadhttps://docs.google.com/uc?id=0B9qXrBGQ-J6ORUlmWDQyVGZZZW8&export=download','115 +116 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process.','PUBLISHED',0,1,'2016-12-11 09:15:23','2016-12-21 07:39:39',12),(10,1,NULL,2,'Symphony E7 Free Firmware',' 4.4.2',3,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OMURRR3A4QVRYT0E&export=download','253 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process.','PUBLISHED',0,1,'2016-12-11 09:24:38','2016-12-21 07:39:05',12),(11,1,NULL,2,'Symphony E10 Free Firmware','4.4.2',2,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OSlVnVkxXejhmdzQ&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6OVG93UV9qMnk5STg&export=download','449+450 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process.','PUBLISHED',0,1,'2016-12-11 09:30:17','2016-12-21 07:38:41',12),(12,1,NULL,2,'Symphony E25 Free Firmware','4.4.2',3,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OWEctd0ZzRFNvMkE&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6ONnFUeU9hYi0zMkU&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6ONnFUeU9hYi0zMkU&export=download','640+596+596 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process. ','PUBLISHED',1,1,'2016-12-11 09:33:53','2016-12-21 07:38:20',12),(13,1,NULL,2,'Symphony E50 Free Firmware','4.4.2',2,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OTVBIS1BURTFScjg&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6OTDZIdjhqZG1EXzQ&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6OajcxWFFpeWJQVlE&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6OTHpJMmpnd3U1WkE&export=download','457+457+457+457 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process. ','PUBLISHED',0,1,'2016-12-11 10:19:14','2016-12-21 07:37:54',12),(14,1,NULL,2,'Symphony E55 Free Firmware','4.4.2',2,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OSGt5NG5iZ0FMUmc&export=download','299 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process.','PUBLISHED',0,1,'2016-12-11 10:21:51','2016-12-21 07:37:35',12),(15,1,NULL,2,'Symphony E60 Free Firmware','4.4.2',2,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OQzRoREdrajlDR2s&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6OT0NIMXJiNGFlUjQ&export=download,https://drive.google.com/file/d/0BzXyxATJZDXvTFNkMEU2Rm1mWEE/view?usp=sharing','456+456+449 MB','Your Android Smartphone should have at-least 40-50 percent of battery to preform the flashing process. ','PUBLISHED',1,1,'2016-12-11 10:49:56','2016-12-21 07:35:18',12),(16,1,NULL,2,'Symphony E75 Free Firmware','4.4.2',2,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OQzJhLVVyR2tIU2M&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6OZHVHTFZ0QjRwWEU&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6OamcwNEV6MkdGbnc&export=download','432+432+432 MB','','PUBLISHED',0,1,'2016-12-22 15:34:34','2016-12-22 15:34:34',12),(17,1,NULL,2,'Symphony E76Free Firmware','4.4.2',3,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OZDFlZWRrZGktT0U&export=download,https://docs.google.com/uc?id=0B9qXrBGQ-J6ON1NZZzY0OVRHLTg&export=download','508+508 MB','','PUBLISHED',0,1,'2016-12-30 14:30:43','2016-12-30 14:30:43',12),(18,1,NULL,2,'Symphony F15 Free Firmware','1.4',2,'1','https://docs.google.com/uc?id=0B9qXrBGQ-J6OblpEb0xDSnFJQ3c&export=download','255MB','','PUBLISHED',0,1,'2016-12-30 14:46:28','2016-12-30 14:46:28',12),(19,1,NULL,2,'Symphony H20 Free Firmware','4.4.2',3,'1','https://docs.google.com/uc?id=0B6L3YHsqPJM1ZE05V2Z5RzF6UUU&export=download','543MB','','PUBLISHED',0,1,'2016-12-30 14:57:07','2016-12-30 14:57:07',12),(20,1,NULL,2,'Symphony H50 Free Firmware','4.4.2',3,'1','https://docs.google.com/uc?id=0B6L3YHsqPJM1d0ltekVrUy0zQVE&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1aGJxaldObUFtMlk&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1WVdFMzlxZFZGYWM&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1MGNJeVJqS2RPYzA&export=download','629+634+629+429','','PUBLISHED',0,1,'2016-12-30 15:01:54','2016-12-30 15:01:54',12),(21,1,NULL,2,'Symphony H55 Free Firmware','4.4.2',3,'1','https://docs.google.com/uc?id=0B6L3YHsqPJM1VjdxdWFmZmgybm8&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1bzJqSnNqbWtWUVk&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1bzJqSnNqbWtWUVk&export=download','593+594+594MB','','PUBLISHED',0,1,'2016-12-30 15:04:07','2016-12-30 15:04:07',12),(22,1,NULL,2,'Symphony H60 Free Firmware','5.1',3,'1','https://docs.google.com/uc?id=0B6L3YHsqPJM1ajF0QnhIX1pNUVE&export=download','874MB','','PUBLISHED',0,1,'2016-12-30 15:07:39','2016-12-30 15:07:39',12),(23,1,NULL,2,'Symphony H100 Free Firmware','4.4.2',3,'1','https://docs.google.com/uc?id=0B6L3YHsqPJM1MkNua1k4b2ctNW8&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1V0pydjhvSGVaRXc&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1M1MwVGwxSWFIM1E&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1RU4xQ1N4a0FlLVU&export=download','638+633+638+636MB','','PUBLISHED',0,1,'2016-12-30 15:11:19','2016-12-30 15:11:19',12),(24,1,NULL,2,'Symphony H120 Free Firmware','5.1',2,'1','https://docs.google.com/uc?id=0B6L3YHsqPJM1RnEySW1pMDQ5SDQ&export=download','685MB','','PUBLISHED',0,1,'2016-12-30 15:14:18','2016-12-30 15:14:18',12),(25,1,NULL,2,'Symphony H150 Free Firmware','4.4.2',3,'1','https://docs.google.com/uc?id=0B6L3YHsqPJM1em5nWFQ5SjZBZlE&export=download,https://docs.google.com/uc?id=0B6L3YHsqPJM1bldsM3hVT1FiQW8&export=download','613+613MB','','PUBLISHED',0,1,'2016-12-30 15:16:49','2016-12-30 15:16:49',12),(26,2,NULL,5,'Winmax BD95 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvbFlWdnAwTDFmalE/view?usp=sharing','5MB','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]','PUBLISHED',0,1,'2016-12-31 04:10:49','2017-01-01 12:18:59',11),(27,2,NULL,5,'Winmax W10 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvdllqQ3Zzc1FmM3c/view?usp=sharing','10MB','Your Android Smartphone should have at-least 40-50 percent of battery to  preform the flashing process.','PUBLISHED',0,1,'2016-12-31 04:32:13','2017-01-01 12:19:31',11),(28,2,NULL,5,'Winmax W101 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvOGNzdHJpX3BSekE/view?usp=sharing','5MB','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]','PUBLISHED',0,1,'2016-12-31 04:45:28','2017-01-01 12:19:55',11),(29,1,NULL,5,'Winmax W10 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvLUJPQUNJTThfekU/view?usp=sharing','6MB','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]','PUBLISHED',0,1,'2016-12-31 04:49:14','2017-01-01 12:20:15',11),(30,2,NULL,5,'Winmax W207 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvNTkxREJySlZubms/view?usp=sharing','5MB','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]','PUBLISHED',0,1,'2016-12-31 04:50:10','2017-01-01 12:21:02',11),(31,2,NULL,5,'Winmax W208 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvaEo4aWppNGRLbVk/view?usp=sharing','5MB',' Your Android Smartphone should have at-least 40-50 percent of battery to  preform the flashing process.','PUBLISHED',0,1,'2016-12-31 04:51:16','2017-01-01 12:21:28',11),(32,2,NULL,5,'Winmax W3 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvelVDTm5qQlB0RUE/view?usp=sharing','6MB','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]','PUBLISHED',0,1,'2016-12-31 04:52:09','2017-01-01 12:21:52',11),(33,2,NULL,5,'Winmax W4 Free Firmware','Update',4,'1','https://drive.google.com/file/d/0BzXyxATJZDXvS1ROZUlpZ1FDMnM/view?usp=sharing','5MB','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]','PUBLISHED',0,1,'2016-12-31 05:06:18','2017-01-01 12:22:21',11);

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`permissions`,`protected`,`created_at`,`updated_at`) values (1,'superadmin','{\"_superadmin\":1,\"_user-editor\":1,\"_group-editor\":1,\"_permission-editor\":1,\"_profile-editor\":1,\"_tutorial-editor\":1,\"_firmware-editor\":1,\"_driver-editor\":1,\"_tool-editor\":1,\"_delete\":1,\"_setup\":1,\"_cms\":1,\"_category-editor\":1,\"_recharge-editor\":1}',0,'2016-11-07 14:09:39','2017-01-04 11:10:48'),(2,'admin','{\"_superadmin\":1}',0,'2016-11-07 14:09:39','2016-11-09 14:32:23'),(3,'editor','{\"_tool-editor\":1,\"_driver-editor\":1,\"_firmware-editor\":1,\"_tutorial-editor\":1}',0,'2016-11-07 14:09:39','2016-12-12 01:56:26'),(4,'manager','{\"_user-editor\":1,\"_profile-editor\":1,\"_setup\":1,\"_cms\":1}',0,'2016-11-09 14:20:09','2016-12-12 01:33:08'),(5,'Firmware Editor','{\"_firmware-editor\":1}',0,'2016-11-09 14:24:51','2016-12-12 01:54:01'),(6,'Driver Editor','{\"_driver-editor\":1}',0,'2016-11-09 14:25:00','2016-12-12 01:54:16'),(7,'Tutorial Editor','{\"_tutorial-editor\":1}',0,'2016-11-09 14:25:27','2016-12-12 01:54:34'),(8,'Tool Editor','{\"_tool-editor\":1}',0,'2016-11-09 14:25:47','2016-12-12 01:55:27'),(9,'CMS Editor','{\"_cms\":1}',0,'2016-11-09 14:26:03','2016-12-12 01:55:40'),(10,'banned',NULL,0,'2016-11-09 14:26:14','2016-11-09 14:26:14'),(11,'safe editor',NULL,0,'2016-11-11 18:47:57','2016-11-11 18:47:57');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2012_12_06_225988_migration_cartalyst_sentry_install_throttle',1),(2,'2014_02_19_095545_create_users_table',1),(3,'2014_02_19_095623_create_user_groups_table',1),(4,'2014_02_19_095637_create_groups_table',1),(5,'2014_02_19_160516_create_permission_table',1),(6,'2014_02_26_165011_create_user_profile_table',1),(7,'2014_05_06_122145_create_profile_field_types',1),(8,'2014_05_06_122155_create_profile_field',1),(9,'2014_10_12_100000_create_password_resets_table',1),(10,'2015_08_04_130507_create_article_tag_table',2),(11,'2015_08_04_130520_create_articles_table',2),(12,'2015_08_04_130551_create_categories_table',2),(13,'2015_08_04_131626_create_tags_table',2),(14,'2016_05_25_121918_create_pages_table',2),(15,'2016_07_24_060017_add_slug_to_categories_table',2),(16,'2016_07_24_060101_add_slug_to_tags_table',2),(17,'2016_11_09_194700_create_devices_table',3),(18,'2016_11_09_194710_create_tutorials_table',3),(19,'2016_11_09_194720_create_countries_table',3),(20,'2016_11_09_194725_create_fcategories_table',3),(21,'2016_11_09_194730_create_firmwares_table',3),(22,'2016_11_11_232256_add_user_id_to_tutorails_table',4),(23,'2016_11_12_073312_create_driver_names_table',5),(24,'2016_11_12_102925_create_drivers_table',6),(25,'2016_11_12_122553_create_driver_types_table',7),(26,'2016_11_12_193739_create_tools_table',8);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission` */

DROP TABLE IF EXISTS `permission`;

CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission` */

insert  into `permission`(`id`,`description`,`permission`,`protected`,`created_at`,`updated_at`) values (1,'superadmin','_superadmin',0,'2016-11-07 14:09:39','2016-11-07 14:09:39'),(2,'user editor','_user-editor',0,'2016-11-07 14:09:39','2016-11-07 14:09:39'),(3,'group editor','_group-editor',0,'2016-11-07 14:09:39','2016-11-07 14:09:39'),(4,'permission editor','_permission-editor',0,'2016-11-07 14:09:39','2016-11-07 14:09:39'),(5,'profile type editor','_profile-editor',0,'2016-11-07 14:09:39','2016-11-07 14:09:39'),(6,'tutorials editor','_tutorial-editor',0,'2016-11-07 14:10:12','2016-11-07 14:10:12'),(7,'firmware editor','_firmware-editor',0,'2016-11-07 14:10:12','2016-11-07 14:10:12'),(8,'driver editor','_driver-editor',0,'2016-11-07 14:10:12','2016-11-07 14:10:12'),(9,'tool editor','_tool-editor',0,'2016-11-09 14:36:05','2016-11-09 14:36:05'),(10,'delete','_delete',0,'2016-11-11 18:45:27','2016-11-11 18:51:06'),(11,'setup','_setup',0,'2016-11-12 00:08:24','2016-11-12 00:08:24'),(12,'cms','_cms',0,'2016-11-12 23:04:00','2016-11-12 23:04:00'),(13,'category-editor','_category-editor',0,'2016-12-03 06:47:17','2016-12-03 06:48:13'),(14,'recharge-editor','_recharge-editor',0,'2017-01-04 11:09:43','2017-01-04 11:09:43');

/*Table structure for table `profile_field` */

DROP TABLE IF EXISTS `profile_field`;

CREATE TABLE `profile_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `profile_field_type_id` int(10) unsigned NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profile_field_profile_id_profile_field_type_id_unique` (`profile_id`,`profile_field_type_id`),
  KEY `profile_field_profile_field_type_id_foreign` (`profile_field_type_id`),
  CONSTRAINT `profile_field_profile_field_type_id_foreign` FOREIGN KEY (`profile_field_type_id`) REFERENCES `profile_field_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `profile_field_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `user_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profile_field` */

/*Table structure for table `profile_field_type` */

DROP TABLE IF EXISTS `profile_field_type`;

CREATE TABLE `profile_field_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profile_field_type` */

/*Table structure for table `recharge_infos` */

DROP TABLE IF EXISTS `recharge_infos`;

CREATE TABLE `recharge_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recharge_type_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `ac_from` varchar(40) NOT NULL,
  `ac_to` varchar(40) NOT NULL,
  `trans_no` varchar(80) DEFAULT NULL,
  `admin_reply` text,
  `remark` text,
  `status` enum('approved','pending','cancel','invalid') NOT NULL DEFAULT 'pending',
  `user_id` int(10) unsigned NOT NULL,
  `requested_for` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_from_to` (`ac_from`,`ac_to`),
  KEY `recharge_type_fk` (`recharge_type_id`),
  KEY `requested_by_fk` (`user_id`),
  KEY `requested_to_fk` (`requested_for`),
  CONSTRAINT `recharge_type_fk` FOREIGN KEY (`recharge_type_id`) REFERENCES `recharge_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requested_by_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requested_to_fk` FOREIGN KEY (`requested_for`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `recharge_infos` */

insert  into `recharge_infos`(`id`,`recharge_type_id`,`amount`,`date`,`ac_from`,`ac_to`,`trans_no`,`admin_reply`,`remark`,`status`,`user_id`,`requested_for`,`created_at`,`updated_at`) values (4,5,5555,'2017-01-05','5555','5555','5555','5555',NULL,'approved',1,1,'2017-01-05 11:10:10','2017-01-05 11:10:10'),(5,5,4444,'2017-01-31','4444','4444','4444','anwar','','approved',1,2,'2017-01-05 11:12:08','2017-01-05 11:22:13'),(9,8,5000,'2017-01-05','7777sdfsdf','sdfsdf','sdfsdf',NULL,'sdf','pending',2,2,'2017-01-05 11:29:05','2017-01-05 11:29:05');

/*Table structure for table `recharge_types` */

DROP TABLE IF EXISTS `recharge_types`;

CREATE TABLE `recharge_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  `description` text,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ac_no` varchar(80) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `recharge_types` */

insert  into `recharge_types`(`id`,`type_name`,`description`,`updated_at`,`image`,`created_at`,`ac_no`) values (5,'Bkash','<p>[banking_name] is our bank.&nbsp;</p>\r\n<p>[bank_account] is our bank account.</p>\r\n<p>[banking_name] Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>[bank_account] is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>','2017-01-05 14:26:53','uploads/400x280_79158c1a617a59675bbf3a5614c1c3d8_bkash-logo.jpg','2017-01-05 20:26:53','01923020000'),(6,'Dutch Bangla','ss','2017-01-05 12:19:25','uploads/400x280_79158c1a617a59675bbf3a5614c1c3d8_bkash-logo.jpg','2017-01-05 18:19:25','01923020000'),(7,'Islami Bank Ltd','6546546','2017-01-05 12:19:35','uploads/400x280_79158c1a617a59675bbf3a5614c1c3d8_bkash-logo.jpg','2017-01-05 18:19:35','01923020000'),(8,'BRAC Bank','ddddddddddd','2017-01-05 12:19:53','uploads/engagement4.jpg','2017-01-05 18:19:53','01923020000');

/*Table structure for table `throttle` */

DROP TABLE IF EXISTS `throttle`;

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `throttle` */

insert  into `throttle`(`id`,`user_id`,`ip_address`,`attempts`,`suspended`,`banned`,`last_attempt_at`,`suspended_at`,`banned_at`) values (1,1,'127.0.0.1',0,0,0,NULL,NULL,NULL),(2,2,'127.0.0.1',0,0,0,NULL,NULL,NULL),(3,3,'127.0.0.1',0,0,0,NULL,NULL,NULL),(4,1,'192.168.10.1',0,0,0,NULL,NULL,NULL),(5,4,'127.0.0.1',0,0,0,NULL,NULL,NULL),(6,1,'43.245.234.11',0,0,0,NULL,NULL,NULL),(7,1,'117.58.246.154',0,0,0,NULL,NULL,NULL),(8,1,'172.98.79.135',0,0,0,NULL,NULL,NULL),(9,9,'43.245.234.11',0,0,0,NULL,NULL,NULL),(10,1,'103.231.228.138',0,0,0,NULL,NULL,NULL),(11,11,'103.231.228.138',0,0,0,NULL,NULL,NULL),(12,1,'43.245.234.10',0,0,0,NULL,NULL,NULL),(13,3,'43.245.234.10',0,0,0,NULL,NULL,NULL),(14,11,'43.245.234.10',1,0,0,'2016-12-14 20:22:45',NULL,NULL),(15,1,'157.119.48.10',0,0,0,NULL,NULL,NULL),(16,1,'119.30.38.90',0,0,0,NULL,NULL,NULL),(17,1,'114.130.55.19',0,0,0,NULL,NULL,NULL);

/*Table structure for table `tools` */

DROP TABLE IF EXISTS `tools`;

CREATE TABLE `tools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supports` enum('ALL VERSIONS','NA') COLLATE utf8_unicode_ci DEFAULT NULL,
  `instructions` text COLLATE utf8_unicode_ci,
  `d_links` text COLLATE utf8_unicode_ci,
  `d_sizes` text COLLATE utf8_unicode_ci,
  `noted` text COLLATE utf8_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING','HIDDEN') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PUBLISHED',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view_category_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tools_user_id_foreign` (`user_id`),
  KEY `tools_view_categories_fk` (`view_category_id`),
  CONSTRAINT `tools_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tools_view_categories_fk` FOREIGN KEY (`view_category_id`) REFERENCES `view_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tools` */

insert  into `tools`(`id`,`title`,`supports`,`instructions`,`d_links`,`d_sizes`,`noted`,`status`,`featured`,`user_id`,`created_at`,`updated_at`,`view_category_id`) values (3,'SPD Upgrade Tool','ALL VERSIONS','<p><img src=\"http://www.firmware.mse24.com/uploads/tools/01.png\" alt=\"\" width=\"832\" height=\"81\" /><img src=\"http://www.firmware.mse24.com/uploads/tools/1.png\" alt=\"\" width=\"809\" height=\"132\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/2.png\" alt=\"\" width=\"805\" height=\"580\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/3.png\" alt=\"\" width=\"819\" height=\"498\" /></p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/4.png\" alt=\"\" width=\"897\" height=\"562\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/5.png\" alt=\"\" width=\"867\" height=\"532\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/6.png\" alt=\"\" width=\"872\" height=\"523\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/7.png\" alt=\"\" width=\"902\" height=\"534\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/8.png\" alt=\"\" width=\"903\" height=\"620\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','https://drive.google.com/file/d/0BzXyxATJZDXvYjNRMjhFVVAzVlk/view?usp=sharing','10mb','','PUBLISHED',1,1,'2016-12-12 01:26:11','2016-12-19 08:16:53',NULL),(4,'Smart Phone Flash Tools','ALL VERSIONS','<h1><em><strong>&nbsp;How to Using Smart Flash Tools</strong></em></h1>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/1.PNG\" alt=\"\" width=\"798\" height=\"660\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/2.PNG\" alt=\"\" width=\"800\" height=\"565\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/3.PNG\" alt=\"\" width=\"800\" height=\"514\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/4.PNG\" alt=\"\" width=\"802\" height=\"502\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/5.PNG\" alt=\"\" width=\"797\" height=\"553\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/6.PNG\" alt=\"\" width=\"803\" height=\"547\" /></p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/7.PNG\" alt=\"\" width=\"797\" height=\"536\" /></p>\r\n<p>&nbsp;</p>\r\n<p><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/8.PNG\" alt=\"\" width=\"801\" height=\"506\" /></p>\r\n<p>&nbsp;</p>\r\n<h1><a title=\"How to using Smart Flash Tools\" href=\"https://www.youtube.com/watch?v=LDaJFdcjAIM\">How to using Smart Flash Tools</a></h1>\r\n<p>&nbsp;</p>\r\n<h1>Smart Flash Tools</h1>\r\n<p><a href=\"https://drive.google.com/file/d/0BzXyxATJZDXvaUFMNzRLREhYYkk/view?usp=sharing\"><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART FLASH TOOLS/Download-1.png\" alt=\"\" width=\"168\" height=\"35\" /></a></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>','https://drive.google.com/file/d/0BzXyxATJZDXvaUFMNzRLREhYYkk/view?usp=sharing','46  MB','','PUBLISHED',1,1,'2016-12-21 06:37:27','2016-12-21 08:01:45',NULL);

/*Table structure for table `tutorials` */

DROP TABLE IF EXISTS `tutorials`;

CREATE TABLE `tutorials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `st_instruct` text COLLATE utf8_unicode_ci,
  `requirements` text COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `noted` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tutorials_user_id_foreign` (`user_id`),
  CONSTRAINT `tutorials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tutorials` */

insert  into `tutorials`(`id`,`st_instruct`,`requirements`,`title`,`description`,`noted`,`user_id`,`created_at`,`updated_at`) values (2,'<h1><sup><strong>&nbsp;</strong></sup></h1>\r\n<h1 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong>&nbsp;How to Use Spreadtrum Upgrade Tool</strong></em></h1>','Your Android Smartphone should have at-least 40-50 percent of battery to  preform the flashing process.','How to Using Spreadtrum Upgrade Tool','<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/01.png\" alt=\"\" width=\"822\" height=\"80\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/1.png\" alt=\"\" width=\"809\" height=\"132\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/2.png\" alt=\"\" width=\"821\" height=\"591\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/3.png\" alt=\"\" width=\"817\" height=\"497\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/4.png\" alt=\"\" width=\"817\" height=\"512\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/5.png\" alt=\"\" width=\"815\" height=\"500\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/6.png\" alt=\"\" width=\"817\" height=\"490\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/7.png\" alt=\"\" width=\"818\" height=\"485\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/8.png\" alt=\"\" width=\"815\" height=\"560\" /></strong></em></h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\">&nbsp;</h2>\r\n<h2 class=\"watch-title-container\" style=\"text-align: left;\"><em><strong>Step 1:Download the firmware to your computer.<br />Step 2:Extract the file in desire driver to your computer.<br />Step 3:Download correct USB Driver.<br />Step 4:Extract file to your computer.<br />Step 5:Install USB Driver.<br />Step 6:Download Spreadtrum Upgrade Tool.<br />Step 7:Run Spreadtrum Upgrade Tool.<br />Step 8:Load (.pac) file from&nbsp; the extracted firmware folder.<br />Step 9:Connect your Driver using USB Cable.<br />Step 10:Now Click the Start Downloading button of Spreadtrum Upgrade Tool to start flashing.<br />Step 11: And wait for finish the process and please don\'t unplug your device before finish the process.<br />Step 12:If the flash success a green ring will show on the top of the display.<br />Step 13:If any error occurred feel free to contact form<br /></strong></em></h2>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h1><em><strong><a title=\"How to Flash Spreadtrum Upgrade Tool\" href=\"https://www.youtube.com/watch?v=mm7zyjH-JoA\">How to Flash Any Spreadtrum Android Mobiles </a></strong></em></h1>','',1,'2016-12-06 15:10:56','2016-12-21 07:20:09'),(3,'<h1><em><strong>How to using in Smart Flash Tools</strong></em></h1>','Your Android Smartphone should have at-least 40-50 percent of battery to  preform the flashing process.','Smart Phone Flash Tools','<h1><em><strong>How to using in Smart Flash Tools</strong></em></h1>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART FLASH TOOLS/Capture.PNG\" alt=\"\" width=\"797\" height=\"640\" /></strong></em></p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART FLASH TOOLS/yuk.PNG\" alt=\"\" width=\"804\" height=\"514\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/1.PNG\" alt=\"\" width=\"798\" height=\"660\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/2.PNG\" alt=\"\" width=\"802\" height=\"566\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/3.PNG\" alt=\"\" width=\"800\" height=\"514\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/4.PNG\" alt=\"\" width=\"800\" height=\"501\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/5.PNG\" alt=\"\" width=\"798\" height=\"554\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/6.PNG\" alt=\"\" width=\"803\" height=\"547\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/7.PNG\" alt=\"\" width=\"801\" height=\"539\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/8.PNG\" alt=\"\" width=\"797\" height=\"503\" /></strong></em><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/3.PNG\" alt=\"\" width=\"798\" height=\"181\" /></strong></em></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h1>Smart flash tools</h1>\r\n<p><a href=\"https://drive.google.com/file/d/0BzXyxATJZDXvaUFMNzRLREhYYkk/view?usp=sharing\"><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/Download-1.png\" alt=\"\" width=\"217\" height=\"45\" /></strong></em></a></p>\r\n<p>&nbsp;</p>\r\n<p><em><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART FLASH TOOLS/9.PNG\" alt=\"Noted\" width=\"800\" height=\"115\" /></strong></em></p>','',1,'2016-12-21 07:18:54','2017-01-01 15:22:10'),(4,'<h1><em>How to Flash Normal Mediatek Firmware</em></h1>',' Your Android Smartphone should have at-least 40-50 percent of battery to  preform the flashing process.','How to Flash Normal Mediatek Firmware','<h1>&nbsp;</h1>\r\n<h1><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART FLASH TOOLS/jguk.png\" alt=\"\" width=\"811\" height=\"416\" /></strong></h1>\r\n<h1>&nbsp;</h1>\r\n<h1><strong><img src=\"http://www.firmware.mse24.com/uploads/tools/SMART%20FLASH%20TOOLS/kjh.png\" alt=\"\" width=\"818\" height=\"414\" /></strong></h1>\r\n<h1><strong>Please carefuly flowing 7 staps.</strong><br /><br />1.Please first open your Chainese Miracle 2(CM2)......<br />2.Click SETTINGS Batton....<br />3.select CPU/platform/workmode<br />4.Click FLASH Batton....<br />5.Select Your device Bin flash file..<br />6.Click FLASH Batton....<br />7.thene wait and flash complet</h1>','[Keep all of your personal data (PHOTOS,MUSIC,VIDEOS,DOCUMENTS,APPS DATA OTHERS)  beeore flash your device.Flash your device at your own risk]',1,'2017-01-01 11:11:15','2017-01-01 15:24:27');

/*Table structure for table `user_profile` */

DROP TABLE IF EXISTS `user_profile`;

CREATE TABLE `user_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` blob,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profile_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_profile` */

insert  into `user_profile`(`id`,`user_id`,`code`,`vat`,`first_name`,`last_name`,`phone`,`state`,`city`,`country`,`zip`,`address`,`avatar`,`created_at`,`updated_at`) values (1,1,'',NULL,'Anwar','','','','','','','','ÿØÿà\0JFIF\0\0`\0`\0\0ÿþ\0;CREATOR: gd-jpeg v1.0 (using IJG JPEG v80), quality = 90\nÿÛ\0C\0\n\n\n\r\rÿÛ\0C		\r\rÿÀ\0\0ª\0ª\0ÿÄ\0\0\0\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0\0}\0!1AQa\"q2‘¡#B±ÁRÑð$3br‚	\n\Z%&\'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyzƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚáâãäåæçèéêñòóôõö÷øùúÿÄ\0\0\0\0\0\0\0\0	\nÿÄ\0µ\0\0w\0!1AQaq\"2B‘¡±Á	#3RðbrÑ\n$4á%ñ\Z&\'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz‚ƒ„…†‡ˆ‰Š’“”•–—˜™š¢£¤¥¦§¨©ª²³´µ¶·¸¹ºÂÃÄÅÆÇÈÉÊÒÓÔÕÖ×ØÙÚâãäåæçèéêòóôõö÷øùúÿÚ\0\0\0?\0Õñ>³ãÏŽÒÚkÛ¾»¼kA¤]h÷)¼¶ûœ\rÉ3;åÊñŽ¬Ãh¿>©SûB>Ù+¥Ùê¾BŒaZ.IIe¦Ëàû1q%†¹öû{™a¿º±K6\0Ky£Ê—(NwŒsŒ§–\n`«áæÔºÝ~¢¯û¥r¾¿£®™—{âKMzÚö´ZØ[ß³ÞÚ»Æk+x9ÆÒ8ùMpBr§VPtýä—½Ó¾ž‡4èû9ÝêÊ^¹²šñ¡ÒÜ•Š=2É\"®IÂgr†ÎëÐúœªBr÷T­r9[z¹iðêÛÆ7þ¼o\r%ŽŸyZÉmb’w˜ÎU™w]1rHŽ \rð®\n\n\rê´¾»þ¿#®\'UÚ[#Ó4ƒwúŠ!ñ¼óéÍca	ˆfØn·òÇ\r—•h˜(;·ùàõãÆÍ*VÂÁÓåv—Ú[}ý=\r\'JQ—*^éßÞ|@Ñ,tS>Ÿ}qkcw$k-»Fñ–ÉÚ¬«ÖE	ã<×ñ”VcÔ¤ÓQ’¿©Ÿ*iò+Kð¿Jº\'YÓ¬¢ÔlÃ«$Ä@“60T+r#\0\rÃŒ×ÐàférÒ©+ýžæp¦ý¥ŽÇâæ¹â\r7Ä¶znpúåôkçÙ\\Ã-ßu¤líà\00[\0ðp+Žž•9J\\ŽÉÞÒé÷ïc{ò6£YèZRÂÞ²Ò,Â¶©¼ÁnÖ<^É·%D‘b’˜‘Œrv†ïÀSÂb¥<<Ò\\»;Y;ôoO‘Õuhè|×ñóàLÞ\Z›G¼Ò=Iï£k{\"0\"´–=»ÐïËe>v!ˆ$±æ½ØQÝ¿…mò<üDœUö9=MÕ5/ÙjúÆ¿q­jwXg‘¦y˜€‡f#;Hã×¯Qka£RŒ£¿[ù˜^UUÙé>¸ñN‹¬ßÁ£Î×Z^œëÚt—¢#8²F1Uz’TŽ@#ÌÂàÝHÊ¤¡·}ÌíÂÔ+¦´<«Æß´ýõíÃCi>“Îµ¶ûC—¶`0BHNà9\'“ÜZô#€X‡Í$­åØS¯)Ë÷g®|ø¥âOêZ·Ä8t^òÕ-/%·?/ÝÉSh\0b‚¦·¡Bq§WêÓQº¶«ò1£9¹¹M~±ã›û-|RnôÍZû^I,-,níÖe–y’*˜g)d6Aa’<Ì§²ú«Q+Í½ìô¾æõ+I{Éèix×âü|4ðtº6©¤jþ$Ö\\›k9¡„­Ë2‡A\\\"¦y.I;NÞ+	í=”éYyú²åQJ	4|¥âø¯Fñå¤§[Ï§o·¼ºÓö)€e\02üª2£9ç$Õ*p„ù¹µzo¡ÅR¥£È£bÆ¯ª\\Ýhvº‚GenÚ–çXá`LhI\rÈù³÷»g§&³t•?qzÜã»Nçž=µ·ˆf°ŒKs4ÉÂ!Ã•ùWvãÇ8cëœú×]åMZû+ƒiê{7ìÿ\0à_í8ï!Mfx,4»¥Skä–É&å`å`|ÛÆ1Œƒž<ÌL¡7å¬»isjVm\\õi>­ëµÂ^øµÒRd\rhÿ\0¹ ó”Â·Ó\0qŽ+Í–mR-Å-wÙ¯ç_y§¢ü{oxF¾ð¬ú¥­í¬óÙù—\"7©2nÚI;¥reØ 0Q‚ÂÂ&±²JéÞßsÏ£EèÙcJðÍßÂ]æÖÓPñG…µ	¢ÜÃp’YÉ6Ì–0§s¹ów…)Ó?/ý¥[RÔ%£Õ§ø´uÆJ“q‘Î/ƒn\"ÿ\0\rmÚ&¾GÕ~×xc’î)v¼E¤®?z7;†N+/í*ØI:µµ¶Î×º~DÏ™MÊsÎ´éÒø‰¥³Ñâ°½óÌwZtóX%\Z¤›”\0–€x`„ƒÍK2t¦«o²ëó9bäê9[sé‹{ÝFð=í•ý‹ë×ÞIºÔï$	g¦®_rªl,TØž\0EqVÌ)bi7†ƒSŸÅÑ.ÖK¯âtI¤¹ºœwˆ¼cáÍEŽi/î,$)Òµ…Ì—SIX¹‰•x!‚‰#•+«ƒ«J§>#Ôd–^ï½ŽˆË–	Ôvò8¯\\jzÝ’ëÚ³qyá»$Œ´[@·1ÈÁ˜ád]ã9Ü‘Ü÷ôkbð5kû*—ºJÚZþ–vdVœ%ìr\nÖµÝÄ2êzTšeô·mÂ¥Ü2G²eÃo‚HùŠå[\'$ƒ]ñ¥Ô¨C™y=~ær)ÓW–çQñÆÞ+ñÿ\0‰4sÄ3é7VS%´ViÂ¬±£4#aHÆ:„%¿ÙSÇÃë\\²Å6›Ò×Õ~ÝZu\"¥s²Ò­HøkgñWÃÚ‚½Ý´ooªè’D|™&2®çE8Uj!!8UÉÜ	T©SQ¥*wåi½o½ÇR¬iÃ™3Ãõ¯ˆ:¿u»Ä¾ž(_PÜy1‘Ç…çhÉäªõ9àu®ª	Ê\\|°ìxõ1«ÔúÁú¶á•ðÎ§¬éz²ë1Ê³Åißkòâg]ìUö©;HÈ\0ämÛ»¦\"Œpî5ä”ù·ZíòØôhJ1I;jwºž‘àMcÀÚÄ^†çH³˜ªÚ[[ýžh|ÌâC¹v–^OsŽã­y™‚ÂZ5°ò|tú}çc³Ôð‹ÿ\0²¥µÞƒu©x6i®UPBtÙX(Ü$]±¹O	9ÇsÒ¼¬qW	YÐÅ/w£îŒ£\Zji­{y¼+¥½®§¥Â5í9%»i™šG ².3’Œ¸Ã±9Ü+è>°ë´é;A™â“zDçµ]VóÄ\ZÆ©3ÉisÈ¯$—\r÷IÀEÝ÷~ñ\'=yÆuÑÂF©„òå+;#Ð¿e\rø£Ä>&¸ñ&.™§iÞc,º¦¤ó<Õ*Ð†,Y7qž2;‘œ1x™Qq…/ŠW²Ùmæz8jnª»vHìþ øßÀú…ýöäÜÊ”°Žæ-Å²^G8;ñœ2çªÜ\Zð°Ø<LãûùëÑ-6ètT”yíHñ˜® ¸¼ƒI±—S[™¼ÝEU…»Âw;ÊÈÁv\02 ÷$gÞ‚åÃó»¦ôkvyÓŠ‹QÜäìE›jér¬€È±A\"yh‰ÚYAb­Áànä÷Åz´àš´´õ1pæ~GØ_t/xCJÔô;Ûû™üClu}>Ù§!í8˜¸™ŽIç\0õ“Ž­	RçM®«¡ÓN—–:³Íâñ¾¥IVo,H¡QÖY0ãé]Ô°ô=œn¯¢ìuýbkKà¿Ú‚ÆÇÆ>Ô³,më·lÅ£I$o\n@ÜSpœƒÉê<jøŠ•œãÎ¦ÚÑ=¾}ŽˆJnî:£Í~&üvÕ\Z[g´ñCë‘K*\\*Fp£Ùäxö \nð(åu#›óßî8ê:‘|ÍØ~$kúçŠŸUÕ¯tûq¡E¶ŽÑî¥\nã`’(\0À˜Ów\'#\rÐú0XlB•Cšß$ŸeczuÔýÙJæÿ\0‰ô†ð÷€m|S£áÏÙÍ2Ù0H÷lÇr¦ŽH,Ë³\'*8ã»Ur(â ¬öÕ¿Ô¨ÔP÷eV½´ðõž—lºåþ§¯X‹x®¬ô¸$#†7AÉŒ˜¸‚OËÍ|•jX¹Wxl<cNïâ¦åU—³Ž¿Âh>=³O\Z^ÇkáØ Óõ)Ú-/U˜ZÂ]—f1µ7dàõ8¯^žS*x~LEKÍuîyª²ºqØõ	ôõÓ-®î^;­.ÃRI/îå·‘•.AÝµV.CÀÜ¬ÃŒ|Ï¶ªëÆŒ5åÙ2ç9=‰œ—„õm#UÒî\"ÔÓv•>Ç–xãW’È™W®àF00HÏ­{˜š¸‡%J•ã4î»3š”¢¥fÎ£_øÛ£ü#ðŽœ—2¦§¤7–ÒÏ?—qyÌä†I^caT®væ¾Ö†&¤£\nUióOGu·™ÕV‹“Œ¢ý×¹äß´íÿ\0àïCsaàÏÅioxˆ/nï0²Hî\ny`O9êÖÊ(W|Ñ+}Ž‰Ð…E©ó%Ïí	$×ï-…ªØNÉ˜dÈÇ®1Éâ¶¥”S…žæPÃBÏü5ˆ&¹…íMº]A†*\\r£$Šê–”•¦´.zq—2G£ü<ýº¼ok¯ZI«\\Aª[•ÏÑ…Yw\\®öã§=;W•ŠÈ°˜˜¸´Ö¿,TyQ÷5ÿ\0ÆSøy¢øƒÃ:Z+Úõ£Žg¶Üê˜Ûv’Ç\0žG8¯‘ÌrW‡Œ9\'î¥ÕZ1’IjbøÛöxÐ|[%åªøªûMÖu6ÒYÉÓç‹dQ <\r»zÇ%€ Šù/í\n™f%a*|+fúß©¤©Å«C¸ù3â?€5oëpøgÆfãM6ò¹‹Ê€È’Â_>hpNü’q‘×hîqö´ñ2,:¾Ï.­9S­©¥ øâëÃºå¥¾œñé×›×O–rÖò¸+•)PÛ…D?*w\'=ëZt]~EY+­ßgäCXEGc–µ²ºŽÓXÕ4íN]*ÒÑ~Çs4K1,$6cµHT<‚Iù˜\0óŽîHF>òºx æ“œ]™Íø^úþúòÂ8îcH®A°7W¨$XÕØ‡a¹X®‰%AÛÉïUR&œg§R#))^á¸|]â›‹})¬t»7,“ÅòÊÏ’aÚŸ;nÉ\nIàzsËVª£ëjÞÈÒ<­ècáˆüâT¼Ñ5e‰­í“ä‘šYç•Úª	Á+–Î\0ÉßSš\rJ6ôÙMYó#Ùô\"Ý*Îá~YÈ²Â’A¹PrwsŸ¯5Î¨×jê*ß37^§sâ§‡tjVÞ&µžöÞâãÉžÆÒ \nH_NN\08aƒŸÆ¾;	Jª££RWù1¥«³Â¿hK}Ýø{ì¾\ZÕ|+«}’;U¦\nVâF;šTû¹Îã€0¤\01_i…Äá¥F4h}•m]õî]u¬a%dh|&Óf‹Å\ZWˆµ[û\r+°‚ãQ¼gŠ[cKD“…ÜaÐƒ•8N¬òýhÅ7¯â]5=¶<Í¼A©xcÅO&›3ÛOlû±‡g 7f8èj!z´ï%¹Ã*“‹|»Ã‹íKÇ1³ŽÙDº‹oE²›ÛšXâ~i2ì¸þ3€2Ë]¯\n±=ŠÖKUÿ\0\0ôhÎU—,ž¦ô/ªøOW¼Ðï¯¤m<M\Z[ðLëœŸ(ÊÈ(#•nì}ìf¸åU\\²VmkugrkR”wG´ü+ðfµñžÓVøu7ˆ¦Óíà	uoxPÉäm ÕK•†\nÃN@°Àå•+c!8YI-[ý…58Û¡wâOÁ/…?³ŸÃ[øËÆÓßëò…šÑ-TÃ\'\0mV‰Xç$Xà=~º¾_J7n\\Õz/óFœ=Þ§å§ÄÜø—[žo9ü€Åbˆ7Ê‹Ø\nú%eM&µêm¥Ê¶9[®kÐJÅ,“|À1<sLeøîaÓ¥`¿½˜*–®=‚ÒñQCïç<çµC‹Ú~øûÄ?o\Z6—\"Ü­çîä‚yÒ8:à— ÌWj1©­\n²{ŸSx—ã© xnÂèOÜ³Ú}‰ô«¼:\r¡ˆ>…‚:@zg?Ÿf9L”¹®žžjÝŽjŠkÞ¾‡âŸ—¿4Ë-;Uµ–ò-)þÓc;8ûEª„d[±ûÔÊäg=ðH­p\\°)rJê)éÐÉb[J<ûW’Yµ¹®lnn’	\"É4Ä˜™Ã\r¹è™€Iàu8&½jjS…äµò9¥VU¥to_ø¯ÄqxËB¿¾KÍR/ÝíÔ:ÉÑI—ÜíÀä\0tÂ8Å9Ê’I[ï4©SÜQS‡ŠëP·šxM¹‰nìÂÄ@,Ugr{Ïr}+ª¥T´ž¶w9]Ò³=÷à^¿àÿ\0ü<ñMÆ¯\rµ×ˆ.`eÓe‘V7”€¡¹ã ÷‰÷¯1§í›‹Om-²×Vß¡µ	E&å¹è¾øF>\'C+Çy¦kzôÖÉ¨ÜYØØ?˜Šä„?åFÙS¹[cpOôåÙtíÉ\rb•ï{êÎ¸Óç¢ÎK\\øâè5­B4†Î$K‰P]Ä€ÇŒn?Ì×©õJËNoÄº’|Eø›/‹¼Q¦º­¸k8c[8Ýã°)\\üÄïîFìŽÕùûÃ:õ½¢+Ñz%Úç,›æVFwÇ4¶Ðé’ê·ºÍÝ­Û[G$ð°tÈfX_÷…>WbËùq»Ž™éX_«â)«Åu4Ä59r\\§àÝ#I»ð5Å¶¡mÕ\"TŽ9Dm+²®o0¹\0çª\0\0¹4bj)4ÖÉ’½ºœGÄŸ/†üeþ‹¦<ŒñÕU¶–ù”…ÈöíŽ;W¡í’‹IiÐÂi\'fQŽhÞþÚçìæcœC….ª[HSŽƒŒæ±…j~âÔªPkÞƒ;í3ãÕÝ­­´\ZòZøŸNKxÕ-õ(Rð€8ßI‰#û¹\nŽ=³^¥:õlã^Óëª×ïZž,U“ŒÏU¶ñ™á­:_YxR}2úÊGp.Ú8Q]£$s+È¥ºˆËcåÜ2Œ¡Z–%FñpžûÝ1’©MékþÓ_5‰¾;¹kMï#„aåe`]ð7qÈÇÐWÕåx‡‹«&Ü¥Õ™8òh\rbÎzçs_C$(áqÞ¬aÊœŠ\0	.ìRßAJöÜ,ÙxØ:*DQ‡Ê]ÈüqJè«4jx2æ}/\\¶’)¤¶¸È1È§­EEÍf}í¢_Áã/ƒG[¾øuqâ(´¸Íö§e|ÊÐHrÂGŒ|Ç##ô¯Îqyf*ž#ÚÐ©hvzÿ\0ÃUŠ”v½ÎCÃ¦×~_ø·Mº²‚îÅ¥Ž[;‹³’Æ±ùŒÊ¸ñƒ=½0~Š†Ô å}zžBÃ)^IØñëË÷žé­Ø#Ê>_:FÚ¼xéÆ¨¦œ!n‡‹¾ŒîSÃwQÚZ‹½J/µcÏ{rÕÐc<7ôÇ½y-Âu[Q·™Œœ ––5?á½Ô®D66ñ^H\n³Çe\ZF˜Ûò€1×·S’rj¡‹åMG`÷æýâÍ‡Ã{û½vÆ+{%tŽg”ˆVÔ–\nLŒ\'9äôÁ8$WtTj¦©ëùj\\)ÎOEcôá&…¡~Ïßõz{ý\"ÔŠO‚F]Ú\"‚‚2åO>aö\\äŽµï`¡6Óµÿ\03Ù¦•(j|ƒ¬~ÐWwzµìðI§ÛÁ,îñÂ!‹÷jX¿s°â¾zUo&ùYÈêÆçc ü,¿ñÌž ‘,M™jR[ÿ\0gK%Ú«ä@#lóŒ`v¶þãŸš©‚N’¨ãeäûíêt:Q»•ÎcÁ)oª½ÝÄŒ—	avqiwl#+.B–/ØcŒÁà‘…:!hû©o}YæË•ú›‚Ym·éÖöZÌH¶¶0Ä¬6È¬Ñ€ˆ;“Â¨ùSœ‘^G\'°¨åÊÛnö}Ž”ù´µÙÄ¿ê°5Ý–©m9Óâ@Ö7™.IÝ˜Ãì$Æx÷&ºœ“K–6—¯N¥Ô¤¡KSÆ¡øu}â/j%u94EKY$·ŽXÞGdbP\'\0|§$áyš½J8…N	B<Ï­ºS¾_ø„h“Çö)m­ôI\rÑ›{Ž2\0°åFâÇÀã¢S…fº»kèÎ~YGsÔþjþ&ÔÆV²hï5Î¶MÕý²[7—²5ÝvÎäEi\0I*0Õ5\'ËGÙQ–Nö;ðóícó§Ä¬ã[½2¬iv~µú>ÚŒW‘Ù%i;šžðüwpý¢áwnûª}+:õœ=ØTi)+³ªƒÂ6—N¬Ñ Ðb¸ž&K©Ö°Ê]\ri’D3l¼s¸qP±S¾æ¯\rZÃ4]Ú%iRŽ6\'V“­+îè+øoÃÐ_k­Å`a{÷ü«YT|—9ãM{NVbx§E·ÒüAko´S2N„WE)ÊQ»0©Yè}Qð+âÞ¿àêº”,ÞÇ[G·¿–â‘bŒÇ´ÈÅŸ	–<üæ¸jûIK’:\'¹•y8Å4Ï>ñ<Ú†“£[;i‡L‚øI%½Ã²åA(Î€ðNARGLkÈå„ç¦nxÓçŽ®WLçtm_L·óîoš$	ärÎÜ}xéëž~•Ù$å¢W9¦¦ícÑßBû_…,µ[Øã¶µ»1ù]·¢“µX’AÏ¡\'t9ùÿ\0oâþ¯kËðDrÝÝ½Odøû/jßíÓÅ^µ·‚Â%ŠÜG©°e–_/cÉ°1à2ï9;¾l¨=+é)`¥Z›kgßþé*\\ÉJ,÷ÿ\0|!·M?Â_\n´íRá5ùßWÖî`›ÊE¶Ü±Ãø‰f\nƒÔ± qèap†Pæ»½Û:ãGÜ<öÇø­s­øÛUðµ¦¹,Ó–(c³¶•ÙUc^0„üù,	ÉéŒV8è©M[VŒk]û¨ñK}KÃ+o>IHQ—}Qƒ7N¯?êµž¼ç:¥çÑ‡PÔ|­èÍs„$ÚJÖ7k/•ËãÚŒìANâµò8\Z˜št…Nd»>ý.TªÚV¹Îêßt=sÆ°Þ%›øoJ½–1%¥¬Žëpë9C${Ä›—PI,¤Œ|µŽ­R”/Ék­êÿ\06\n0œÿ\0xºhv\ZŽ¦|5Ô´«‹ß:® ºÓâo9í]ÓƒµÙ£RWvFä*9èÃyTªÔÅÒŒ­k¯êæ’µt´2¼yaâ\r;Ã–skrO§\\È­ ¸„<°BPŠFSt‰‚0w{ÒqVr‚ººóÓ¡£§)SSl· Øê>\'ÔãÔ—F¶1Ùj\n@öóMâF‹ †S¸µ²[æ$c=ø<JŒÒ·»/_»Ðº:ÆËd]ðüv‹â_i·ÖP]ê6LmíôƒÌy¥ð?xsÂÌbŽ£oš½ïªÑÃª“›Õôü‚PŒ[MÞçMcñÍ,õ­{A½Ó—ÃÆÈšk@$v\n›\Z?Þ:Ùdê!Xàƒò¿S”\"âÝ¢Þ¶ºŒ§]ÁÙè~Gxÿ\0Oh¼k¨Á‚	ºtÁàŒ1×êX+G\rÙ.\\ï™u;\r*Ô[ZF˜Ç¸ªOšW=JJÊÇI¦Å`t9ÀÅrJLï¦—C¢‹GŠh¶I’„sÏZË˜ëQCŸBBmUà\0)ó=ÇÊXøwá#‰ïf¹FHœ)Ž§\' Wo´æ„R8Ý.Y7Ü»ñ·ÀvZv•õ´@3Íæ³w-ZÒ›„Ö§-Ux;ü8·›T¸Ñô¸n!³nÈóNû½cÝÛvÎG\\Íe‰©ìï+ìxõ¦¬¡Ôè~9ø^ÃÂ>\"\ZfŸ}¬‘ÛA/‹°Hê²4jIþäœç¨×NnRækæpÕ4#n‡áŸi‡MñÅà½ÌÖÛ,;xäÌˆÌÒå@BNSæä€Ç=ï\nO–g,j(§Ìlx·âšÖ…¥iEhVÎyÝ²0ƒzäóÁ9øŽ1ÐxÔ°®x™b·õ¹Œîôµxý~*ø÷ÃÞ&Õá±‚][F¼Ô-æmbŠ(ïWœ†pHÎxt¯°À·MrßC»\næ×+Øö…ø§âø;âŠñÅ“âj!-ä”6Ö±e`DYçL,¯¹p	=~\\Wmjò¥KÚ%©éÔ—,RGƒþÎŸ³õ¿íñóí2ÜZèVi,ÚŒœnû–CŸ˜î‰ ”Œt\'\ZT•kÍœj1Û>Ä°ý„<	gco\\ÞJÑF¨\\¤_1û•Þ©Å+%­cáŸ|CVð²Þ˜5I¤¿ºv:¦¡\"¤2°À!ÊðN\'(íùýžŸÕ#k.‡†öæêz·€~%ÙÅà¤Ó%Ó´ë™n\"ŠÄê3FåáO4>Y\ZLm\\’0\0\0t#ƒéVx|EJ¯ÅÑÿ\0ÃtjsZ/~ä(Ô|Kã/ÙAâ$†ÖÂÒQw§5Å”motÁX4™fUe;â Àô\0c,èBñZ~xVuñYÐXßk~:²ðåÝürÝhÚ•ô¶7kk]±™¦2£\n»‘@V˜g€®è:ÓÒ÷*6š«{£Ø¼-â|1uw¦Ûèñépjî$·ÒÀW‚ç \'Ë´–vF3ÐnÉ\"¾[,ÎÔ`Õ¥£Nïæz‘œ–·cç_Ž1Ô~jsh¾Ó,ôßµ£\rBòÌ,ÒÍ>w\0ÞY8$„<\0(MsJ^×[Y>ß.ÇYòÍ¨h¼¶ñ›i³˜­ö¤²Hø¸—qY1êpØ×ŠÑPœä¥þGœä¦Ïš~&éw6ÜÜ Vº˜N¡G_G·5÷8óá<Ñêá&§Ñ£â\rV-0\"\0ZB£júÖT`ên{>Ón‡ã‹{y#[¨;xÅi<%ÕâÍ©â¬õG¬i6ú¥¢Ëü§Ö¼©ÁÁÙžÍ:Š¢º¨ÝA£F%¹—\0ò\0ïDa)éÎ¢‚»áŸˆÚOÚÒ3.åfÚIÛ]ð¡8îpOlw,N¥à3äbçæŒÄÈwnÜF?2öŠæk•³\"÷ÂºF“eáÑ_inòýžòöq˜ÁVhˆÆpvžrÝÎ=OgRzÝw¹ó5*FRm£—ñe„Þ_&›¨Í¬E2‹¶«’m9Æï©ëÍcv£ŒQU´€û½VïJÔ$Áx¡­\'6—Xå;v“”bJž:Òªç9¸Ê69%åª=ÏàÇÂ¯\r?€ôßx‡L‚ú95uÌwQÆ‚ŒDù=]²¸$óÓ\0·ƒ©ŽÖt#î­ú¾¶ÿ\0;´¡&õeO‰kúÖ›©­ž•.ƒeniko‘CmkNõ–e˜óµ˜Œàæ·£ˆ‹”#^{[Kkÿ\0„¥	+íÜÊ¿I,¼5k¡Þê—Z´ŠÑhEÛHc´ùšvï*wìLûÌ@úÚó’§fýçù\nuUå¹÷§ì¦øGÂ	íeµ¸¶¶Ö®!ÚÃ\\1ŠE.ÌË¹_P\0œg’I¯[éÓ¥¦uAÅ¯t÷¸nb¸‰%ŠD’\'PÊèA ƒÜW]Ñgâ_„á¾:¥î¥kK>Ÿp L\Zhf*>R«\"†\r’Fàë_•â)B­¦×¼¶>}ÊþêG¨èº/‡ô­oIm3S½‚S¦­ÄÍ{p‰\\’XÕ¸ÀŽ‹×5ÔªOš¤KU¯c¢¤#£„eð¯Š4ÿ\0x>æ=SG·Ôì\"ŸÊ½Ôo.$—Q€I•ˆÆ¦uwA)C·%[æþ!Šô±–ØªN7odïúøW:«–¢ºîzŽ{cájþ½Šn’¬0C-‹“’vL8!erpÜ!¶:#œPxz7—òþ·:¤éÒNCÃ¼[gÄãÄ©­Ç…Ë\r½Án\ny`˜#F\rˆ÷»|Þ„äýÑ_#W0uä©Æ™~à¿»ÌÞ‡ã¯ÛÏáˆôfÕ-å¡¹åŽVªœônÛ‘]q§í½ûYß_C]¨rÇfyM§ƒüCâ]jÞ)¬ž+yäå[Diœ¾ƒ´$)8Jõ\"œbäžÞFPçf´<CÅšSÜxÊÒâQó¬ŽþíúWÑajÿ\0³»_V„báÈ´v¶ÀI¢ÝÎNîÂ®šæÒöE5mmv\\Žk¶ib{kGzÊƒƒÇ@É9Ï¥mì£kó;Ž3žÜ¦Ç…µu †0HÊŒWxµ³=:\Z›?.bO.(à1\0bAÇ58x¶÷{rÝ£#Âv÷vs]K¤¢¤M°´I‚[=89?€5ßQJ;Hóa8J\\®\'°é–í‚n|›}ÑÅ,G£#\"E8>ßýzçŒÚ|Óèi*7v]NÇRøƒÿ\0	×Œü9µ§é÷º~•f±Xi“…‚Þ1Œ†Ø#\'pÉÉ=r	ÌK\Zçvã{lÆRöŸbõHµ?À8<_q­Oa³BgŠC\Zjmh—+*¢;„S¸€6c,sYáš¯ÌÛ³û¾ãd©ÁÞ*Ç’ø7áÕ¡Õó©ÜI&Ÿ$Ëg’U-…R¤œ)\'wm½q^>a‰©¿eñtÔò}¥56Ï{:÷…¬Xø{ÃZL+gš·\"þîYãæLŸ5Üí% s&Tð3âá)ã*7W&ßN–ô7|¿òíœ.‡ñROj‘jV­öI\'mIYåv6Ìùd@ù‰Ã\nƒ‘ÁÅz4×³—µ‡½(ìs*¯›s—Óî/<Ow}¬}‡ûFîéÎé!Z,îû¸U]½àm?…{•ñ‹N«×ð¹“››r‘õ§‚¼?ª|-ðf•.·£é:½– ÆÚÒÒø]ùÞkH˜ÎXÅ\Zí\0—A‚ ¶yöéÁT¥V‚Ôô(ÁR…ÏD·ñGÃø %¹ÔôéU@{;d·’(9&W #¨´O\rwÚíækî1ñÌºSÚëK›¦Yè±ýŽêe“ž²’0p\0Íœ“ŠøiÔ•(ªªòÜâ§B	ë¹.—ðÂ}>ö=6âö=Jâ7šëÀñ+±v—pV …R0vœšˆ?­Fü¼²¶ßæ*êJÉlsÔ¼5s ørÓGÒ`Óµ!‰o\'¼¼˜YÜm‰cP«PÃƒ©fmŒI˜¼kJw­¢^–üJƒŒiòÓ–§ŒÜjºö³vÕå¼h\"f·­ 	oœMà\r¹Èç©çšõèÑ¦áÊàÕ¼Î*³u>-wáÇˆí¼5k«éÚ¬G[´žPc·’ç8}À;1Ub¤(P6²à’Ná\\xŒ<&®º=¿ÌÂ•/uìp>!ó<?ã+ÝL#½ ¬Vþb`È\'´g<qŸl×m*‰SnOaµg¾ç¡x3Â—gÂÚJ_C<Z¬òËoc,†[¹ŠJ]qÉXô\0œ+eº¥‡ýÒ©µéÔë¥(ò¨Ëv|½ñ_Ã’xsâ–¥¦Ë$2ˆîgÃ[¶èÈ9#iî0kÕÂJØ}ïcèå+¨êcZi13|ÀµkíN¸RLµ>û¬\0Êñ\Z~ÑÍ[QšªøÖY¹oZ‰·%©¥8ûÇ²øŸÀö·ºd7òfò—å=/sb¥£9}#L“N¹‰a·¤à¹lÕ©©;6e([D_‹FUÐ¢µˆy“ÜË\ZlQ’Nà@÷«•š²9âÚ¨ŸcÛþxH’×ÄZ/ˆ4¨t=Z‚KM1ŒF#Œ‹yrÅÄˆJHbÚƒÅøíá¡Jtíä|ôïRRœ·eOÚÛá¤žƒD“A¸K(ãÓ;¤¼¾ËÞ2«FH“ýd„Jÿ\07Ý pyqÔ}Ÿ¾¤”mª9ê4©´Þ‡É7Þ/¸ðõÄ×6ä=´P£Ì±n®åÆäÆ ×I\0×È¬7µ•äïÚèòbã\'ÜÈ×>:K¨ÜÉýe†,¯Uî>yXIÀWv,Ä¶Fî:\0ÄµÛ½s6þHé”¢•í©ÍRâî)omÒêhÌªæ‚É 9ËÜÈ8Œ‘ÎA®•EF*œŒ©Ó¼dõ=£á¬\Z÷‡\r´štÍs­ªëS4VË7“™Èp¿îžüf¹+ÑÃJ\\×»Ñ_ætFÍÃ[©?à[ß†>y­ån,ã¹[{Æ´!ÿ\0x‰œ„È# (Ï<×ÜÐ‚…(ÂÚ$v-µ¦Gu£é¶–	k-ÊÚÄ	åxÃÈÜÜu8Éªå‡ò•¡ùë¦[kÐÏ%œÓéW±@a¾3y’™‹cÊŠ´üÉÎoº~a_’OêÆ<ÑwnÖýNJ1„[¿Þv×^;Õmnô‹^E©Ü[D4ëèf°+<ŠáåÜ–T·\rò’1•å‰ç¯,^&rvi¥»ÿ\0/ÔušVçG]áýkAø«%þ‹âFÛQm.?´Û^LX!\0•Vlä¨RÍœàîæ¼Êôñô¢ñ,Ümx½}lßc\ZQTùž¨«¦êŸ¼!£ë2éÚÝ½š!ûLŸe–|Âwp\\”_1M§›ž*–79[’Ñ}t-ÄâšÕŸ.ø¿Æéâ\ZD|#7Øtýín²Á•;±¼²€¹Éãœs“_AÉEÊjëÈÆªOX»3Òt-,t/W–0º¬j£2Û[žO<ŒÓšQ„gKÚAk¶ÿ\0™Ç^^Îi³¾ðW‡õ¼AçIwk¡kðÛ-Å•ì›ÒÆc#«o;ymÀ>Im¥€rzéÎ~Ò4•K7ÑÚÇ}ù’iZç’þÖ¿\n†ÏŠîôø4íI%µµÓhŽàùN%”\"±\n»•B‘€@Èœž\"–%Ò“÷_õ¡êa«MÍS{#æ»	•WqzW°Ñôôf¬E«kp,\r°Éêkjp“ÖÆ²­£cü!âX-u#Ùnœ«“ŸÆµ•Öú™G“g«ÚøòéâÚæÙ-åSû¶Ÿ“°<\nÊq’VÜé§R\rÜèt{a¿˜Wzâ¹ÕÖæ’•ÏUø#Ô¼iizò¤i¥t×póŸ/ñ`ójæÅc¥¢ëÂ<Íl¼ÏYR…–ìúÍŽ¹¹©øˆÏvd’ø[ÙÀ!–	L,01b¤.Ò»€c¤×›G:­‡öugï:Žî1Ý=»³çšq\\ÎZö<öƒø“{ñC[·Ò4¹o!µ±´o*w±bo$·bADc½AÉÎTÝ~Ž¾-â’…ô·Þû3Ÿµ÷^Ç„üIø«_|4·Ôa°™µ[Iž+íî¥æUb~XÁ$``ƒüKó1ž*8štj{Ý¡MAêx?„Î›¥_4zÕÔ–0/Ì’En·p®Qˆgõé^µHJµ§I\ZJƒsWØ± xŽ×ûR‚æÍnîf}öòyŽ‚Õ‹°Pv¶TmÁp{UU£/vÚXßÙFé§±ôŸ‚¥ñï‹õHü3©iÒjSéñÃ7ÙK<­\"4ó6,o\' †ïšð_«AÊÝ˜ZI9@û/Ã´ý”ú,žñ<öÇÄ–°¥Ýéó-dÁãa\'#¡²©À§ÓSÍT¢”ã­×MZÇ?ÅA<‘Ï¯YyèÅdóõnÀ¶AÏZåx™7{õz¯[5éÚý×ü$ºåôÚÜööþ\\2AxË¶®f9û­ƒ…HÈÈê>SZâåUÝ½s).Y|yøßâ?ŠžÓdÕ.&™áÄ/4væ89$å8êp9­V\"µJŽUú-´Dâj)ÙÂêÇsàM*m{àîâûÈ,¬–ÃXŠÚ	á_²îŽßÌþ5êdfKžG–Ç¢’pœ*9F{%¥ËNR¦ª[_#•ø¹®iW:ž‰£Íi[ƒ®£lRD¬ØRAù¹K+·ªã¥pápôé:“¢ï&õMìÉ¼¦¯Êgø\"ëBÒln.u\r5ÏÝÝyÒ^]\\3D6vl.<Î€û³ž{WMOhí%o-Ç	òÝµwæwcÄ6úüÎÖÖ&ÌCI$6–»aUfT–\0zäzÖ”§\n4—3·ás–­\Z¸‰9#¬ñÍ­í—Ãˆt›?\rÇc\rÜwwz©›nÓ/Ëx`>wêUIáwcœ×ãO{BÎûþGMÔœ9ÈóOŒßìtŸÝ¶±«\\¦¹%«\\­·Ê‚d•FÍÇ†R¾aÈÆF	ïÃ¥\n±s›oµŽº)P«\'£>TF*¬9Ú{úWÒ%sê ÚZæ$’¶¾sËé]‰ß©1†º£KN³{„ùàP¤ýÅ8&¦ý™êRÃÆHîíaŸO²YZÉY@àÀÀ¸â¥™U¥½§c¦kM¥Æ¤“Î#ŸÆ¹j;³ž\rÅ÷†ôëë=/\'¹ŸCÒnŸûY­$tÇŸÝÆ@Ã>r0H¹¯Íå\n²)=ºyŸ?šNm¤–ˆôAãox?W½ðÕÔºÖ‘¤\\3Ãq:«ÜïnHÁù]ˆÛ¸œ‘Æ:â¸a«R›i5Ë¿£íúž49êÝßDp¶Þ&\ZG‹ô½_Y–KtVs=»Â$XÜáÉ+ÆX8{úsŸ_£…ŠI¦¿_ Œþ(ËCÐ5_x/RðŽ«=Ýµ¾´­”d-åI&QÛiÊFw7r\0ÜHÑ<c“VØéŒ)¸ÙŸ.xÃGÑ¾$j³ÜÛèkfÑ¤¯$ÖÑ_s#)oAž:òk_¯ÔÂ«ÅÚý¥ZirÁ^Ç;¢ü\n¼¼´¾¸Òµ‹š3¶×òä¹ ÊŒAMÃŽ‚sÇlû1ÌT’UV¬Ö{¥Í¡…àïxƒÂZ™“O{›I4-$Pýàqø~ z\níœ)M\'sGg#Ø>\ZxZïÇÐÞøƒTÕÞ	pûaEuÈ´‚q…Ï@HbÄŸZókbhá¡}»nbå\ZR÷V§¡Ÿ†öw$Íuà†žêOžYg¼HîyfoßIÉ<kÎþØÂõ‰~ÓÛð<‹ÁÞ5×4½NæÞ–¼¾Ô<Â~Õ+˜:6æÞÇnæÈêwÏo5*Q¤—\"å‰Ï4ä¹£º=^)lµë~ñF­g£]˜¢gžÉwHwÎå@c´ï|¼ÿ\0{Š«Èë)Ù)~å…å5\ZŒóïÃ§¥¯‡`ÓeÖn¥»¹g”Ácl¤´²ª«m%› €^º4ùeÍ¡RS„ý’ÔÙ³¸Ô<H-ç/%¼³ÉlÅœ™wr8Æ1¨^s^eFŽ^[soò0SŸ+C~ÈÞÖ]ËöâHï­[†3+nQ’0F\rMxÍÔµ7kŽ.iÝž·á?‰ô{k«»o\ri:4Æ)oìQMî¤òm>PGl\r«‘¸gor)â#WEBpIÅîzÔ¤Ú¼LvÙÃ÷V\Z–›\rºÌ ‘žé\\Ãæ¶ì‡m­!PA/Á\0AÚj¨ÆTã__Ìr”m¡ã<oš¦µb/®5xD’3ÜNÌÊóc™îA9Û@2¯VŽ\ZU-Vi\\ç•9Nq‚wØðgÕ\Z AŒà\Zú˜A4}b›‚±jÃPD$¿Ì™§(¾†‘¨ûKs}<F	Ú!)-7FÊrû,ïì!–Þßgž&;zµsN.ú\Zs®§oð«áÎ­ñ7Ä	¢è°‰åHÍÅÄÙaŒ¹Žzõ\0É&±ª§\Zrœ#v“v9êV8¹3èû/…/Öõ1áˆ4äð§†ãµk	5fˆ¾$†H÷#Ì2\09<\nø\\»V¬ž6¬§®«nÿ\0qòµjW«=´:ÿ\0†Bïöyñ•Þƒdb×|©mïãÛ\ZÁ7Ÿ©ÀØ1·Ô\'#5ôO<¡•ÕtÔ½¢}º…8{Ê–‡¡†>\rñÆ©6·s£éòi³Í†–òKJÑ·w\nrq9í^,ÅæøŸ­Nôpí»+¤ÿ\0¦t*q‹ºê|iñ¿Äº-÷ÄýgHÒ,¦m&ÚÕììE¤ºI¼¶Nª´lÌ¬~ñXÀçª…\n4#7¾[èÛèa&¹¬‘­ð×Àš§€&ðgŠ|Eýotgr.,|µ™¦b²Çs¾@G	‘ aˆì|¬Â¬qxz+™îµíÕ|÷:©FTm&`øïÂVÞð…šÛh‹~°ê2ÏoâÍ,þæuÌ¬þðãná‚@ûƒ\0÷êÂW§SgU¶’÷mo™ž\"	ÃÝŽýN_áï…ìµ]+PÔçÔežòA$éÄò»É$!l¤ÿ\0ŽIŽ\'RœÔ¹=Þçi9&ÉõÙïÅ÷_F…¦_Åq3D—–’™\n£BAÄ¥€ù	\0ç ÉÆu§^šI¨úù+)JÉÙŸJØøÃPÙ[¥÷Žµ™ïV5Yåc.^@>f?)êrkæê}yÍ¸ÐƒWÓTzÊ0KZŒøæçá=Î«ãOÉ¹Óômò´Éj—.ñÇ‘T|ì7m‰Éç3šúêxŠ5!.E¡æS•97›:wá^¯á(ô­B{t×`Õ/ÞÛMX.ŒÆüG!RÃå\0†ÇqÈ`qƒ\\Ü”ªNîë—ÉX™ÐŽ²nÅŠ_àøEá«N¥\r–¯¨ ŽîÊ+‚÷QÛ<lJH.ø×Ž¸~OJ?{Qº’·—ü*±Œ\\Þç˜E>…mes¢Å $„¾_§_þ·Ñ*/Ù¹%vÎnw¹ÞI.©â\rûS±ÕZÚIMÍ˜½!§	*Lc,Ì ¹3îk‰Jr²V·®§la*Ð´Z±’lïü7áó«>•râòÌE\rË£¢†çs)#\rŸ^¸Æ85xˆS¬ãÉQ$ž¾½ƒÙÔŠåz\"¿öÕö¥áCo.‡u%ÅÌjë+G±\\‚rÃ…äü½;ý:a‚œ«s\'t¾ó)BïG¡ãÚ·ˆ¢·šúÖ#—ßH¿0NŸ(>¿J÷!I´œºÎ´¥ÐÉ·²[ˆa’ku7}Šq³ cå±^Å}k©WVÕ®ƒ¾ŒÞÓt½QÄF$*Ù¥í)±ªußøkÃ\Z­ë¼[ÅÜ\',G¦k)T„V†Ñ¡9|Lúà×‰¯>Á«ÝhñYe¬Ú	Þúä[…ÙAeð®Ò	ÏCÇJòquêS¢å~ŸyÍ˜ES¦¬tžø³}o¬YËâ?Éz±Z\\%‹é–s_Gl¬ ùlÍ´³>ð\ròä`xñàåÉÌÓŠv~½,|ï2zsj]²×ô}wÀz$Þ\Z³›SÔt»ˆmïtÒÆ)\'C¤­Ûfá\'Þf\\¾˜?=jxÚ’Ç\rìÍ”ãÈÛÐéïüw®?Fð•†­áèî®àˆE{tòÄ‘™Uvù®[rÜþââ¾Ÿ	˜Çž^h¾—wù®R”’ƒ;Í.‡á½g[ð>¥ŸŸ.ÂïPŽi‘sÀU(Ac¹=ARK\0\rx®±ô%eÊõzíóëÑê¯²Z#ä¯üSÕõ¹ ·ø†_VÑ Yãv\n“•fR¤œ2Í×¯mÑ£J’†^÷ùþ§Ÿ,[ªýõ¡ôÀ½2\r#Ãö3·Ø®ô¿Ø›Kw¸ìîw2Éå…à©Ug89!zÂ¦©dÊ¤ëÅII;;nÖþgu©«-Ž[Å,>­­Ô¬š†i4¦-\"	ÌPÛoÚÍ#ÈP³ƒò3˜‚27çPÍgšá/KF×O»ó#IB:êü‰ì>)è×þ\'Ðí 3ÿ\0mM\Zéì†&,]C2ŒýåîÆ	<€p:wQ¡S–TªTøÕ–ÞO¹¶ƒå¶äßüC§^ÜZ>™m¾	\Z&ßk(9SŽFî¼W¸°”,¿Ì¯i#æ;-I|si¨ÛÚÛø¹…ÔÑÄÞÄ‹\"€ÉåÜpÇ*r1Ÿ®q¥5¿‘É:pPº*iŸ­-<am}i{©+ZÀË¤2\"ÛÃ7Îv‡#b³33Çlæž&•eO–‹Iu½Ù“œœ9o¡cEøòÂÿ\0H‡BZñ=Ôéso¨Ot#w‘Ø+DÌÎ¡Õ€8^¹rAìz£ÊåÜ(AT§(5wÐæ­´™.,ll0Ð¹E?\\pqèÏÂñÑåó9}›OS¹³°—K{k;¿\"{H³Ý™¬CÓ>™ÏLõükª–_YMUPæîc- õ+üIøÁ{«YØÙ6©s©=—ûq¼*\"ª‚FÐ:¾kÞŽKNrR«²èQFr_¼g•ê#Õõ½>{¯%X$ÜLq«“ì8ês_C\nP„y`¬k¢ù’<äh×:ƒG2=fµæÕ&‡¿Aªžò:m>ßAæIž’IšqZ…”q€j.Z]ŽãÃv¦\r«ü\'œY9¢vë Ž0‰ž}*/r¬uÞÕíü9a¨\\Þ\"ÉhãìÙÁuÆFO`p=Ï·½l-¡¬ºô811U#khzo…´ÍÄšLW–0GàÝN)!ºK½1è\rµ‹)œ‚1È \Zõêe¸zªü¶~GÊÊR¹Ýx§ÆØÓÇªýÖK±jK¢Æ¹FL“vŠÁ¸*pÉŽ8ùSùopî3>xÅrÇ­ÝŸª2t¢ÝÖ‡œxëÇVU¬u]OQÒµ¸îK`É%ÝæH¯2G$\0WÉá2ßgQJ¼ùgNß\nü/¥Å\ZVšnG›øöžµðå¦¿oq¥&£§HÖPÁnó>DÃrïàäÆ6îÀädŒakêªd°rz:^÷ó¿üOF3³ÖÆÇ¿ø_Pð®…màä·}.ê6‘ìcCöÒÞil–,Jó§iÇJ2¼-ñMÖ‹æ[èÐ«û\'(ê‹zÇ³£øsÂž³Ó­4)¥I\'Ó¥škÇžY¾O6=¨Í$8ŒrqÆsƒß^LDêÆMr¯-¾lÖ5à ¡÷h]þKíLž[–/u{v†ÒàÜïÞT\ròG‚@ÏLc\0Ž\n|øz+®Vî¬’ü{â+I.]îbü$øQ¥ëvÉâ{E¯oá_í(­|¹#`Mí½Â2@Ê·p2{¢œm«¶ÞÝ®sR ›»Üô›M?@Ô­a»›[ki®exC°³•Ç’zŽ¦‡R¤]”N¾j}SÃ-µ´›A³¿Ðt»{øKIs+_(.v‘ãV3&DÌA,â¤Ž>jPöIÉíé²ó9UGÉª</RðÜÚ}¦¾×H·vse¦N$,Ãã¾=q]0jvWLˆÊéÜë´»Kk\rFñŽº$@‹$Êªa¸Šé$|€laJàçAã8˜|%LL¬ôŠf”)ÉËh®Awã-*Úá–ÞÖ{ÕW-ÊárO=\0ä\\§\\û_Øøg>vß¡ÖèÅ»²„º´Úì¾eÙ—ÊA†^\0ôÆ1^ü`¢¬ŒU¢Œ)­ýËÈÒJœíUØÏ×?Ò®6‘e4¨!TO5K?ÌK+åOD	´x.ÐG,ð¹+ôùk)ÓXÙ£Zu%IÞ%sávŒfÛwî\rùm¯*x_ÝØö©ã¢Õ¤¬ËÖÚcž-ëÔ+üÀ¯:xyÇFz1­+£LePÛª:˜˜8–kšTjoceR/K›ÖšÊ˜¼ô‰¤*ÛcŒ.K·©ƒõ$vÍoF„ß½Ës:µc±¡§é×ºÄÁïÇ—	mÿ\0g-–‘‡?1ôïŠ÷0øGÏSsÇÄã—³¦z—†5P,ßÊbRÞ\\:€>dtÁÿ\0ÐkØGŒÍ‹ÜOgö6¹h®cs\npVAÌgñ}1WÒÀ×VpÚÖ½câ‹+èõ«YBá/’Ø~òÖ@Ã*txÉ\0•<‚\0È¯•á±^ý¹_uú“*iè0ñŸÂmLÓ,ïtÈF½ ÇûØµ\r1<Á“ÿ\0=Pä¯A÷†Hæ¼ª¹uJRºWG›,3Œœ¢aøGÂ^(ñ{ÏyáøXÜé2Ã+Ï4én!`ÌTe˜tÚÇŒýÜ×haåÌßü8E(»HgÆÑÆ¼“-ÍÅýì¥’ãS|:<¨Jæ	|ë³`9ç#¶p;Tn}é¸FQæV×M—Iðô±­½Ù½\0dGn¤4Dœu,CqŽÀqÔšæ’…Jžõ’·ÜÏ>n..Pg¬|4ñ¦¿§øyl§¼¹ÕŒ6Ö²1!]YJxù•˜×¯®IaÕ9sÁê—{+ú‹;Û¡ÐŸ\Z´d¡½0•àÆÅÉ_b|¾ÕäJ®2ïo»þÔbÕîsß<?¯x>óK²¸ñ<0x~ßÊ[híeÞÐG¸é>Xà»ƒ¸˜)*IQôp÷Ÿ,ÙNmÍ{ßxâÆãIÔ®u‹aoxÐA%©²Â,ÌcÛ†Û‚A9ÏÈÑÀJr,W/äkAJ£²<jq%ÑÚG?v1ùZû*T£MZ(ôì’²/Á¥%¸óH$ÜWR@$¬#ÒÞC…2•A°ýJÇís|©“°þô•ú‰‰34³<¥@ì zP¨4ö“\r£¯\'švêÙ‰\'uÚòƒNÅ6^·³P¼ÊÁ@ÀæÏ·4œSÜjMlÉ­ÐOðƒ?Ê§’+dW´“êoøz’ð´¥Š\"|÷ô­$+¾¦Œk—;`8ºv”{7Aôª¡ÐxJ°ëWv¬Ù†ér£#ï~´Ð´+¼×¸´,Rv&‘»H¼ÆßJ°zÿ\0‰õ)$šÃÄ¶‘¯Ú^6ƒP¶ÇG¤{ŽéIÛpK¡&ãkÏNƒL¸t¶œ	a`H§±÷ƒô¦Ÿ.‚jç­]&ƒñ+G¹³Ô¢‹NÔïáE—S·…HÀî_1H!†p{|W+K®ÕŸs9E3ç‰~\0»ø}ª¨#‡¸um¨¸´Ÿhb^0„e@ÁéÆJà`çåêRž~ÊQ²×QBNšqoC«ðWÄëøçMÒÏÚ<K«þæé&…ÞÕá\0ìÀÊ®ðOVÜ©^þ=j.MÅ%cÎ©Z4ÓvùÅ‰&·anð,-çù2LŒ6®X\0Ø9&¼åF£š³ÒÝL)K›W¡Ò4’»_\rO:“‘/ÙcùÇ¯\rŽ}ª~«}[üN»?\"\")¨i¾!’êÞöòÔ¢G¥]lœBb}Ë”\'‡ƒÈ ä‚s;ãVµ9Æé¿»C¥Â­–‡3ñ#ÇúÄMsíW¯•˜­âŠ$‰sžW’sÀ¯µÂÑöp×sª1ä™‡bˆòÆ²\0¡$}+ÒŠOvå ¸¶v\0€Jš»Ø[•o¬ÍÔZuš}éP1€÷ü¨\ZZê…[HŸeµ¸ÛŸR:šlZ²J“UK†Xü£}é%¨ÊEncœ`Õ@D°o>ÀfÜ‘F2ÍíL	UË¹_ºsëÀ¤\ZZ0™\0QŽÝèOÌ†3 ð\"ªÀYµ•£X$,aûÔÀÓÔ£þÒÎVÒF2yaÐÓ°ÎR [™YY¿y,`ô•8|¼§wáIŒæžÓË¸[e­´¢HN	ù·Ó8üêDÎ×Ãzœ±O«~à’€÷N0*µ&#Ô<SáK‹?®4¹ŸR°ïOtá·€r€ÿ\0´8ç¾ßJåÅÒöÔßtK[®çÉ·óÞèvÖZŒV¦£ûRödÞ¥UAhÈaŽŒ	ã}«ãÜ¢—%&­5yFÈèôÍB\r~Ý4ùmb‹X<£9tHç&Tí+€Y—nìà–…êxÚnVŠò)Ð‚wê{Þ—û6|EþÌ´Ç…odJaÆ£\ròŽ~õu}BoWE‚„l¯p?4/ø_Aišb[jr‚Yî B¤|„Ëµ¹Pãžk·ê5icR¼¾žGuUR²wG‡ÅÇó`Œž+è¢ŒK–À‹•_Ç\'ŠÙ+WR.÷*õ&Üúñýi‹CNîãì÷×7¢Þ!é€ªØG?q¯iö7qCu#ì<¾Zå±WN›©+\\‰ÉA\\Õ¼øÏ¦ÙC5–g)h>F-…èqÆ3ë^”p<Òk›c‘âyRvÜõ†ž\rÒ<oá˜5©î¦Iä8•7*¤g¸\'ä\ZË…ú¼’zÜ)b]etŽõ~x|Aæ[³ËÎ	ór\0Ç#ŒW2‡sohúÇð¿D†ŽÒY··qÞ“Œb¯\'drcô¿†\Z$š†HÝÝSÌtŽSÀçëÅpÐÅÐÄÊQ†Ë«rŽå±àCy\n.T’¥¿yÐŒ¼ÿ\0uRä¬Ú‹ØN£[‰ñáÞ—à½&ÿ\0P[Ë€–Ñ™eÚCžËœd‘]tpò­%ÔŠ¸•J.R[?Ä-?|~dR¬N€·GÇëË%®¾&yQÎ¨?‰4ki>6Óí¯Þ{ ,®FRGÈ®Iåx¸opÍ0µ6™±¨[¢Ëeu”–Þäì,ÈX}ÓÇb>†¼¹AÁòËsÔ‹RWLÄž×ì—èûp,ØÆä`îˆ‚Wõ©+sGD‡eÞ­`>í¼Þzúàõô¨Ö=À/>ñ˜²·în\\BN~îO_Àâ®.ú	«£Ê>8øcQðWÅ½VêÏ÷©./,ã|í\nFí˜@;”nµòxÏÝWöqÓ©Ž\"s©‘èÞøkg}ðîâ×Ä\Zjé·3\\Ç<zš´P2JÈGK0(u|6C\0qœü^7\n3qŒýå­»Ž„,•ÖýNRø¡ñcKÔn¬—Çzœ‚ÞW„;^Œ¶ÒFNN{wæª8Ê³JR½ß›2i]ÚG;ñoÅ2øÄA`aµS±Aã,?Ò¿SJç¯Y¤ìp’¯—\0l?JÓc’ä×‰¢˜1+Æ}ª¬LTê–Éü%üÂ}€ÏóÅÔC/]·ìR7.zu,i°Zèsÿ\0thô;8Ö\"2Ð¯ @\\Èx#\'ê8ïayg‡k¬|µ<š÷…u«wóÐó}:O´ê7·\nµ¤y9bqúUQå\':÷c3éïÙÏULñNƒrÊ¢òÁ®-ÓŸ0\'<’sØÿ\0Àk·M¨Æ¥Ž,-T¦ásÛ~˜ÓAˆ±]“[Ç þö@8ÿ\0ßUåbÙéEÙ´/‰> ?‡4µ{xîRü·”s…Evÿ\0<WÍæxiÖq¦¥hõ1­XHóZíœŸ†>\"OâmV;hÃ™|¦Nqøƒù×‰G,q¯{œK2–!¨Æ6g£\"3=Îâ^Ryc‘Ïµ}­\n¡H-èü*ûœ§íCâµ—ÃZ=„;D×Nîà¾ÞxŽäþ•îeQn¯5¯cÏÌ¤•&›>iµóníQ|¦C¤Ç\"0G9Áü«ì•Ý´·¡òåI»ßÖåëÝêÐ’LÇj³¯§·¡®jÉÑ‹«.ˆÚŒ£ZJ”U›>ƒ´´ŠãÂPÙJR0©þëùOéŠüÖ¬ÝI¹¾§étâ¡Ðäîck«‚ãý*¥¶vÏß!K)?UÁúƒXô5°í\näC$‡‹«›\'©\r+’ö+xŸT:tú_—*LCš°×™èß´íŸÚ­|âvTwg\"cŽ¹ß^qG™*‰jdáÏäg/Ží´›k{okQ[[ÜéÉ=š-Ð™¤ØI†6\0\0$,ìÅ°88îØü÷”Eb\\ªÅ;ëçSêrZû\ZüJøc¨D—ZŒÖpê¨’æ3jŒVSËŒ™pIç½ÇƒÕ˜Ù4..&•òX1$d{ñ_j¬¹¥q¬‚KgTá”ò5F|Ohˆ]§kM *@w_\rÄ~íÏ¯ùÅ%‰`¿iÕpX´vç{`}ç=0]Í_xjßUÑá–MÕÀU¹7&\'Vù”öç}EtP©É=v1©h¾ç„h¶ó<7L…PL¤rq»5ëáá>YI.§w(ÆO¡ê?<DºŠlõgcû©WzäóÒ¬?-_Fá\ZÔåoÐùîyÑ©Gn§Ò~éº|v)eˆ:Ç.2$MÇkz‡Í|ô×6çÑ_[Ç©­v’ü/m=´™îÑdÙpí³c;Hz7|t5Ç:jOTvF„*É*–gœ|\ZñaðV³¬_Oh×n!T\n[¡Û¨àç·¥béÆé¤z•ð4²ŠOÐ÷ÆñkÚ|¶R¸†ãr¨`%qÁëß?w+4xU)NŒ¹d|çñ‡Å#Ä^+”A1”Y•µÙ»•Hr?à[¿,×¹—Óöt”ÖíŸ=Ÿ=W²[œ¿†µhçSÉ1HÙÚdã8ú÷äW¿‡ÄFI)hÏžÅaçÍQét±¨Ü´å¦Ø-†Öî,þuãg˜…\ZJ’z¿Èõò,<¥UÕkDzì–‘X]Iko7Ú£¡lTÊª	ÛŽ£9Ú¾÷>îýÎþé´mVyBï·“”Ž ¡úâB¿AM6‹Ü£§ºÅ¬Ù•a˜­qî	†µC—ñm÷™«ZG»!cÞ£¨¬¦¾\"[.¯ð+M¼˜Å\ZÚÉo$²J	Úƒ(qƒ×\r\\™ŒS£v¯cž²N\r3æÛË}}\\ÉiLÓÆ¨——I¼&Ô*:`¶áÓ8ÛÐƒ_QÛâ|«ó<øTj<‘f½®‘«hz}ÑU\0ÎÖ2q÷úþ5ÍÎÿ\0™ÚÈóûn!8â¿B[ä÷c­Àó.?Ý©‘ÚÇÄã¶ÃÅRdOÛäú\nlEŸÝ^·s3äþ4†ö;;Ÿ\rÎ{•$Ÿ^M†xµâ…m€\0žs|£§Q_o„oÙDùlOñdZ½ù`]¼fYsŽü\Zé©¢¿™ÍGYYö>ºð|¡³’íöHFæäôàÖþ,½Ob—À\rAD:5ÈŒ\rfÛÆOšç{OóäO2¬Ž™Žô¡î{4µ‰ïº/ü“o\rÿ\0×Iÿ\0ôeøÎ_Ä|rŒÏâòÄ“æ’{î’½ü/ñ_¢>[ü?¼ÓÓ‰Û¶~a;\0{õëý£É·¸Ï§¾Dk>QNCg#¯ÌµòyçûÍ¼¢É?Ý~f­ÈÙt~Qæ/JùÃèºœf³ó=ÆyÃ[õÿ\0}ªõƒí{ã“‘ó5,däµ›Ä0gœIßëHq>˜ñC3~ÍúÀ$‘ºÜ`žßh‹Ô×63øç«±á>†3á]¥¨¼ƒåÇ²gó¯“œT£Ñæá5¨“ó>¤Ò|#¡>•dÍ¢éÅŒ(I6±äü£Ú¥S‡ò£k#ÿÙ','2016-11-07 14:09:39','2016-11-09 10:01:17'),(2,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-11-07 14:13:41','2016-11-07 14:13:41'),(3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-11-09 14:47:33','2016-11-09 14:47:33'),(4,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-11-11 13:48:00','2016-11-11 13:48:00'),(8,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-11-30 19:00:18','2016-11-30 19:00:18'),(11,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-11-30 19:29:18','2016-11-30 19:29:18');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `protected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_token` varchar(2555) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`permissions`,`activated`,`banned`,`activation_code`,`activated_at`,`last_login`,`persist_code`,`reset_password_code`,`protected`,`created_at`,`updated_at`,`user_token`) values (1,'admin@admin.com','$2y$10$wUX2fzzdJKYGw5URQ7naR.EAGe6C9086yGjnJQO6pXFjCCCax6R3a','',1,0,NULL,NULL,'2017-01-05 13:26:20','$2y$10$2/gE8QkPqES4yKqpXfbWu.jk5Acoc2UjrBxi5sz79tIOVgflg8gCG',NULL,0,'2016-11-07 14:09:39','2017-01-05 13:26:20',NULL),(2,'anwar@gmail.com','$2y$10$R8mjIX/s8DH.Hg6BmpRa4.WZtDRnTyeCu0yYA0GMWPnxsRX/jFtjq','{\"_profile-editor\":1,\"_recharge-editor\":1}',1,0,NULL,NULL,'2017-01-05 13:13:59','$2y$10$qlLnRc8oyGUvx5/D9R0iE.SNE5Ea0uWMBCvpCGa3M6/XylWG4Ucf2',NULL,0,'2016-11-07 14:13:41','2017-01-05 13:13:59','FtI14EfAaQYLkvcX8Aejp9eF1WuONj0nkxQ1No60'),(3,'user@gmail.com','$2y$10$a5NcRmYmI8pAyoM2tNir3uY3wJmVG30vnfTHSybAIiBU1zzgCto4a','{\"_superadmin\":1}',1,0,NULL,NULL,'2016-12-12 01:58:49','$2y$10$qRdccK4iPI0eu0zevQJsxuMnAaQH6MkDhpV1wRV9IFMY/Y.Z6TSwu',NULL,0,'2016-11-09 14:47:33','2016-12-12 01:58:49','tSzVdqLAVMTe3rTCRx0UtHj2f3goc89woQL8ffH4'),(4,'firmware@gmail.com','$2y$10$Err3RE6gym3WSR7Gn2YQtemD47qfmGgcleIst5gN269qx8bHV7As.',NULL,1,0,NULL,NULL,'2017-01-04 13:26:09','$2y$10$HdeTQjPjpjx4xJUQ3VkuA.9ZssB//tMHQI6hEYpQ/bPW4pO.kInQG',NULL,0,'2016-11-11 13:48:00','2017-01-04 13:26:09','AaSX94PYl7larK7DN7P6vmyZMvcoNLI0UCVlIiTz'),(8,'admin@admin.com1','$2y$10$fOn.fdcVZo6NNUW44STKNetz0UtQ9NOWvV7MOL/lWsEgs6xpwf2gC',NULL,0,0,NULL,NULL,NULL,NULL,NULL,0,'2016-11-30 19:00:18','2016-11-30 19:00:18',''),(11,'anwardote@gmail.com','$2y$10$4KsFSCGcMeRYOaMWCHY15.3P3Ulv91.8ZSa.5qs/eeUT2DRwrC1sG','',1,0,NULL,NULL,'2016-12-12 03:37:25','$2y$10$7BVmsMOaX3kL/6JnYV3cDegcHfKHGY4n0dcZ.btExD/QIm29hAvgO','sFJvw9PZ2zQRLJ8m3qW8LatyhT6VEMLmk250r17rTm',0,'2016-11-30 19:29:18','2016-12-14 20:23:01','tSzVdqLAVMTe3rTCRx0UtHj2f3goc89woQL8ffH4');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users_groups` */

insert  into `users_groups`(`user_id`,`group_id`) values (1,1),(2,9),(4,9),(11,1);

/*Table structure for table `view_categories` */

DROP TABLE IF EXISTS `view_categories`;

CREATE TABLE `view_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `fcategory_id` int(10) unsigned NOT NULL,
  `search_engine` text,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`title`),
  KEY `view_category_fk` (`fcategory_id`),
  CONSTRAINT `view_category_fk` FOREIGN KEY (`fcategory_id`) REFERENCES `fcategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `view_categories` */

insert  into `view_categories`(`id`,`title`,`description`,`fcategory_id`,`search_engine`,`updated_at`,`created_at`) values (8,'Downloan Symphony Firmware (All Models)','<p>Here you will fine all kinds of Symphony firmware(Symphony Original Rom) for all Symphony Normal Models and other devices. <em><strong>Feel free to Downloan Symphony Firmware</strong></em>. <img src=\"http://www.firmware.mse24.com/uploads/Logo.gif\" alt=\"\" width=\"89\" height=\"30\" /></p>\r\n<p>All the following Symphoony Stock Rom (zip file) contains original Winmax USB Driver, Flash TOOL and the Flash file.<br />&nbsp;After Downloading the firmware, follow the instruction manual to flash the firmware on your device.</p>',2,'<h1><em>Free Downloan Symphony Firmware (All Models)</em>Free symphony flash file, symphony file,symphony no password ,symphony normal flash file,symphony bin file ,symphony flash file without password,symphony free flash file, tested file,tested 100%ok file,100% ok file,no password</h1>','2016-12-07 04:51:05','2016-12-04 14:03:12'),(9,'Free Downloan Walton Firmware (All Models)','<p>Free Downloan Walton Firmware (All Models)Here you will fine all kinds of Walton firmware(Walton Original Rom) for all Walton Normal Models and other devices. <em><strong>Feel free to Downloa</strong></em><em><strong>n Walton Firmware.</strong></em><img src=\"http://www.firmware.mse24.com/uploads/Walton%20mobile%20logo.jpg\" alt=\"\" width=\"105\" height=\"24\" /></p>',2,'','2016-12-04 14:38:04','2016-12-04 14:30:57'),(10,'Free Downloan Winstar Firmware (All Models)','<p style=\"text-align: left;\">Here you will fine all kinds of Winstar firmware(Winstar Original Rom) for all Winstar Normal Models and other devices. <em><strong>Feel free to Downloan Winstar Firmware</strong></em>.<img style=\"float: left;\" src=\"http://www.firmware.mse24.com/uploads/L8814464080.jpg\" alt=\"\" width=\"100\" height=\"64\" /></p>\r\n<p style=\"text-align: left;\">&nbsp;All the following Winstar Stock Rom (zip file) contains original Winstar USB Driver, Flash TOOL and the Flash file. After Downloading the firmware, follow the instruction manual to flash the firmware on your device.</p>',2,'<p>Free Downloan Winstar Firmware,&nbsp; Winstar Firmware,Free Downloan Firmware Winstar ,free firmware</p>','2016-12-05 05:48:19','2016-12-05 04:14:10'),(11,'Downloan Winmax Firmware (All Models)','<p>Here you will fine all kinds of Winmax firmware(Winmaxr Original Rom) for all Winmax Normal Models and other devices. Feel free to Downloan Winmax Firmware. <img src=\"http://www.firmware.mse24.com/uploads/device/6471eeeb1edfcc236d9218576f3f6b0b-250x100.png\" alt=\"\" width=\"103\" height=\"41\" /></p>\r\n<p>All the following Winmax Stock Rom (zip file) contains original Winmax USB Driver, Flash TOOL and the Flash file. After Downloading the firmware, follow the instruction manual to flash the firmware on your device.</p>',2,'<h3><strong><a href=\"http://www.firmware.mse24.com/firmware/category/11\">Downloan Winmax Firmware (All Models)</a></strong></h3>','2016-12-31 04:01:55','2016-12-05 05:52:28'),(12,'Free Downloan Symphony Firmware (All Models)','<p style=\"padding-left: 30px;\">Here you will fine all kinds of Symphoony firmware(Symphoony Original Rom) for all Symphoony Normal Models and other devices. <em><strong>Feel free to Downloan Symphoony Firmware.<img src=\"http://www.firmware.mse24.com/uploads/device/sy.png\" alt=\"\" width=\"259\" height=\"79\" /></strong></em></p>\r\n<p style=\"padding-left: 30px;\"><em><strong>&nbsp;</strong></em></p>\r\n<p style=\"padding-left: 30px;\">All the following Symphoony Stock Rom (zip file) contains original Symphoony USB Driver, Flash TOOL and the Flash file. After Downloading the firmware, follow the instruction manual to flash the firmware on your device.</p>\r\n<p style=\"padding-left: 30px;\">&nbsp;</p>',1,'<p>Free symphony flash file, symphony file,symphony no password ,symphony normal flash file,symphony bin file ,symphony flash file without password,symphony free flash file, tested file,tested 100%ok file,100% ok file,no password</p>','2016-12-21 04:22:08','2016-12-06 13:58:14'),(13,'Symphony USB Driver (All Models)','<p style=\"text-align: left;\"><br /><em><strong>Symphony USB</strong> </em>driver helps you to connect your Symphony Smartphone and <br />Tablet to the Windows Computer and transfer data between the device and the computer.<br /><br /><br /><br /><br />It also allows you to flash Symphony stock rom on your Symphony&nbsp; device using the <br />preloader drivers.Here on the page we have managed to<br />share the official Symphony USB driver for all Symphony devices</p>',3,'<p>Symphony USB driver,Symphony USB driver download,</p>\r\n<p>Symphony USB driver free download</p>','2016-12-06 14:58:10','2016-12-06 14:58:10');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
