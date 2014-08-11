CREATE TABLE IF NOT EXISTS `hike_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL COMMENT '帐号',
  `password` varchar(128) NOT NULL COMMENT '密码',
  `email` varchar(128) NOT NULL COMMENT '电子邮箱',
  `profile` text COMMENT '备注',
  `create_time` datetime DEFAULT NULL COMMENT '录入时间',
  `login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `hike_catalog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '上级名称',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `brief` varchar(1022) DEFAULT '' COMMENT '摘要',
  `content` text COMMENT '内容',
  `seo_title` varchar(255) DEFAULT '' COMMENT 'SEO标题',
  `seo_keywords` varchar(255) DEFAULT '' COMMENT 'SEO关键字',
  `seo_description` varchar(1022) DEFAULT '' COMMENT 'SEO描述',
  `banner` varchar(255) DEFAULT '' COMMENT 'Banner图片',
  `is_nav` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否导航显示',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '50' COMMENT '排序',
  `page_type` enum('list','page') DEFAULT 'page' COMMENT '类型',
  `page_size` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '每页显示数量',
  `template_list` varchar(255) NOT NULL DEFAULT 'list' COMMENT '列表模板',
  `template_show` varchar(255) NOT NULL DEFAULT 'show' COMMENT '内容页模板',
  `template_page` varchar(255) NOT NULL DEFAULT 'page' COMMENT '单页模板',
  `redirect_url` varchar(255) DEFAULT '' COMMENT '外部链接',
  `click` int(10) unsigned NOT NULL DEFAULT '368' COMMENT '查看次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1正常，0禁用',
  `create_time` datetime DEFAULT NULL COMMENT '录入时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='目录' AUTO_INCREMENT=21 ;


CREATE TABLE IF NOT EXISTS `hike_show` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catalog_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类',
  `admin_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '用户',
  `author` varchar(255) NOT NULL DEFAULT '' COMMENT '作者',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `brief` varchar(1022) DEFAULT '' COMMENT '摘要',
  `content` text COMMENT '内容',
  `seo_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `seo_description` varchar(1022) DEFAULT '' COMMENT 'SEO描述',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO关键字',
  `banner` varchar(255) DEFAULT '' COMMENT 'banner图片',
  `template` varchar(255) DEFAULT '' COMMENT '模板',
  `click` int(10) unsigned NOT NULL DEFAULT '368' COMMENT '查看次数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1正常，0禁用',
  `create_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  `redirect_url` varchar(255) DEFAULT '' COMMENT '外部链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='内容页' AUTO_INCREMENT=13 ;

CREATE TABLE IF NOT EXISTS `hike_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='设置' AUTO_INCREMENT=22 ;

insert  into `settings`(`id`,`category`,`key`,`value`) values 
(1,'site','name','s:12:\"Hikecms Site\";'),
(2,'site','domain','s:11:\"hikecms.com\";'),
(3,'site','googleAPIKey','s:0:\"\";'),
(4,'site','numSearchResults','s:0:\"\";'),
(5,'site','defaultLanguage','s:0:\"\";'),
(6,'site','template','s:0:\"\";'),
(7,'site','about','s:0:\"\";'),
(8,'site','statistics','s:0:\"\";'),
(9,'seo','siteTitle','s:7:\"Hikecms\";'),
(10,'seo','siteKeywords','s:7:\"Hikecms\";'),
(11,'seo','siteDescription','s:7:\"Hikecms\";'),
(12,'mail','adminEmail','s:0:\"\";'),
(13,'mail','fromReply','s:0:\"\";'),
(14,'mail','fromNoReply','s:0:\"\";'),
(15,'mail','server','s:0:\"\";'),
(16,'mail','port','s:0:\"\";'),
(17,'mail','user','s:0:\"\";'),
(18,'mail','password','s:0:\"\";'),
(19,'mail','ssl','s:0:\"\";'),
(20,'filter','filter1','s:0:\"\";'),
(21,'filter','filter2','s:0:\"\";')
;

