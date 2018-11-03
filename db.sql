/* 8:57:34 AM localhost crm */ CREATE DATABASE `blog_test` DEFAULT CHARACTER SET = `utf8`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `comment` varchar(300) DEFAULT '',
  `date` datetime DEFAULT NULL,
  `parent_comment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
