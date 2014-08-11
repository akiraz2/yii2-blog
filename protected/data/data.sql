INSERT INTO `hike_admin` (`id`, `username`, `password`, `email`, `profile`, `create_time`, `login_time`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'lifasheng@hikecms.com', '', '2014-06-03 10:45:10', '0000-00-00 00:00:00'),
(2, 'demo', '21232f297a57a5a743894a0e4a801fc3', 'demo@hikecms.com', '', '2014-06-05 11:03:25', '0000-00-00 00:00:00'),
(6, 'test3', 'e10adc3949ba59abbe56e057f20f883e', 'ssdf@qq.com', 'test3', '2014-06-09 16:24:32', NULL);


INSERT INTO `hike_catalog` (`id`, `parent_id`, `title`, `brief`, `content`, `seo_title`, `seo_keywords`, `seo_description`, `banner`, `is_nav`, `sort_order`, `page_type`, `page_size`, `template_list`, `template_show`, `template_page`, `redirect_url`, `click`, `status`, `create_time`, `update_time`) VALUES
(1, 0, 'Micard', '', '', 'seo c1 title', 'seo c1 keywords', 'seo c1 desc', '', 1, 50, 'page', 10, 'list', 'show', 'page_product', '', 368, 1, NULL, '2014-07-28 07:27:26'),
(4, 0, '购买与下载', '', '', '', '', '', '', 1, 50, 'page', 10, 'list', 'show', 'page', '/site/page/5', 368, 1, NULL, '2014-07-29 03:37:20'),
(5, 4, '产品购买', '', '', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page_buy', '', 368, 1, NULL, '2014-07-28 07:37:24'),
(6, 4, '产品下载', '', '', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page_download', '', 368, 1, '2014-07-03 14:27:09', '2014-07-28 07:37:30'),
(9, 0, '案例资讯', '', '', '', '', '', '', 1, 50, 'list', 10, 'list', 'show', 'page', '/site/list/10', 368, 1, '2014-07-05 15:53:57', '2014-07-29 03:37:27'),
(10, 9, '经典案例', '', '', '', '', '', '', 0, 50, 'list', 10, 'list_case', 'show', 'page', '', 368, 1, '2014-07-05 15:58:33', '2014-07-28 08:07:13'),
(11, 9, '新闻资讯', '', '', '', '', '', '', 0, 50, 'list', 10, 'list_news', 'show', 'page', '', 368, 1, '2014-07-05 16:01:26', '2014-07-28 08:29:13'),
(12, 9, '干货分享', '', '', '', '', '', '', 0, 50, 'list', 10, 'list_news', 'show', 'page', '', 368, 1, '2014-07-05 16:07:34', '2014-07-28 09:54:22'),
(13, 0, '会员中心', '', '', '', '', '', '', 1, 50, 'page', 10, 'list', 'show', 'page_member', '', 368, 1, NULL, '2014-07-28 09:07:39'),
(14, 13, '进入系统', '', '', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page', 'http://web.waging.cn', 368, 1, NULL, '2014-07-28 09:07:40'),
(15, 13, '培训视频', '', '', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page_video', '', 368, 1, NULL, '2014-07-28 09:07:41'),
(16, 13, '培训题库', '', '1.新增客户与已有客户（待完善客户/本日客户）有什么区别？<br />\r\n某客户进店，在MiCard中没有该客户的任何资料记录，就属于新增客户；反之，则属于已有客户/待完善客户/本日客户。<br />\r\n2.本日客户、已有客户与待完善客户有什么区别？<br />\r\n若创建时间为当天，则属于本日客户；<br />\r\n若创建时间为当天之前有电话号码且至少有一条营业记录，则属于已有客户；<br />\r\n若创建时间为当天之前有电话号码但营业记录为空，则属于待完善客户。<br />\r\n3.有营业记录但没有电话号码的客户，为什么在MiCard中找不到记录？<br />\r\n无电话号码的客户属于无效客户，只在每日新增中显示并计入留档率，第二天系统自动<br />\r\n删除该客户。<br />\r\n4、&ldquo;提醒&rdquo;中的任务如何消除？<br />\r\n在&ldquo;提醒&rdquo;中找到需完成任务的客户条目栏，新增一条营业记录即可。<br />\r\n5、&ldquo;保有增购&rdquo;是什么意思？与&ldquo;已有客户&rdquo;有什么区别？<br />\r\nMiCard中的保有客户想要再买一台车，须在&ldquo;保有增购&rdquo;中找到该客户，点击添加车辆资料及营业记录即可。&nbsp;<br />\r\n6、录入新增客户时，系统提示&ldquo;号码同店/同地已存在&rdquo;为什么？<br />\r\n&nbsp;&nbsp;&nbsp;出现&ldquo;号码同店已存在&rdquo;，说明该客户已被同店里其他销售顾问录入为已有客户；<br />\r\n出现&ldquo;号码同地已存在&rdquo;，说明该客户已被同地其他销售顾问录入为已有客户。<br />\r\n7、在录入过程中，发现没有想要选择的车型/型号/颜色，怎么办？<br />\r\n联系所在店面的系统管理员，在后台增加。<br />\r\n8、录入新增客户时，有哪些营业结果可以选择？<br />\r\n新增客户，只能选择H/A/B/C/O/X<br />\r\n9、一个客户级别为O，在进行第二次营业记录时，可以选择哪些营业结果？<br />\r\nD、LO、RO、<br />\r\n10、一个客户级别为D，在进行第二次营业记录时，可以选择哪些营业结果？<br />\r\nLD、RD<br />\r\n11、当客户为LD时，营业结果还可选择哪些？<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;LD、RD、X<br />\r\n12、当客户为LO时，营业结果还可选择哪些？<br />\r\nLO、RO、D<br />\r\n13、无电话号码的新增客户，可以选择哪些营业结果？<br />\r\n只能选择X<br />\r\n14、营业记录中，什么情况下有试驾记录的选择？<br />\r\n只有在营业类型中选择了&ldquo;进店&rdquo;，才有试驾记录的选项，&ldquo;通讯&rdquo;和&ldquo;拜访&rdquo;则没有。<br />\r\n15、MiCard是否可以在PC上登录？&nbsp;<br />\r\n可以，登录网址为<a href="http://www.web.waging.cn/">http://web.web.waging.cn</a>', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page_train', '', 368, 1, NULL, '2014-07-29 07:46:00'),
(17, 0, '关于挖金', '', '', '', '', '', '', 1, 50, 'page', 10, 'list', 'show', 'page', '/site/page/18', 368, 1, NULL, '2014-07-29 05:54:03'),
(18, 17, '挖金简介', '', '<p style="float:left; margin-right:15px;;margin-top:25px;"><img height="165" src="/themes/default/images/about_pic.jpg" width="246" /></p>\r\n<p style="line-height:30px;"><strong>深圳市挖金科技有限公司</strong>（简称&ldquo;挖金科技&rdquo;）是一家专注于汽车行业移动互联的高科技公司，位于广东深圳罗湖。公司员工全部拥有本科及以上学历，20%以上拥有硕士学历，5%拥有海归经历，大部分员工来自北大、清华、中科大等国内重点院校。<br />\r\n<strong>挖金-MiCard</strong>是挖金科技开发的一款汽车4S移动互联成交利器。Ta源自移动互联网思维，整合奔驰、比亚迪等12个厂家管理 ，融入丰田、长城等17个品牌终端运营，来自谷歌、华为平均智商超过128的天才团队历经200多个日夜开发出来的。Ta是移动互联技术与销售实战经验的完美结合。</p>\r\n', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page_about', '', 368, 1, NULL, '2014-07-29 05:59:50'),
(19, 17, '招聘信息', '', '<span style="font-size:14px;">招聘岗位：<strong>PHP高级工程师</strong></span><br />\r\n工作地点：深圳罗湖<br />\r\n学历：本科及以上<br />\r\n工作年限：3年及以上<br />\r\n月薪：10000-15000元<br />\r\n招聘人数：2人<br />\r\n岗位要求：<br />\r\n1、精通php+mysql开发，从事过php开源程序开发工作；&nbsp;<br />\r\n2、熟练掌握html，javascript，jquery，div，css，xml代码；&nbsp;<br />\r\n3、熟悉mysql数据库的配置、维护和性能优化；具有mysql索引优化、查询优化和存储优化经验、php缓存技术。<br />\r\n4、积极的工作态度。<br />\r\n5、良好的团队合作精神。<br />\r\n&nbsp;<br />\r\n<br />\r\n<span style="font-size:14px;">招聘岗位：<strong>品牌专员</strong></span><br />\r\n工作地点：深圳罗湖<br />\r\n学历：本科及以上<br />\r\n工作年限：3年及以上<br />\r\n月薪：8000-10000元<br />\r\n招聘人数：2人<br />\r\n岗位要求：<br />\r\n1、市场营销、管理类、广告类或相关专业本科以上学历。<br />\r\n2、具有互联网行业的从业背景，有三年以上品牌宣传、媒介推广等相关经验。<br />\r\n3、熟悉公关媒体品牌推广运作，具有出色的品牌策略能力及整合传播技巧。<br />\r\n4、品牌意识强，具有出色提案撰写能力和沟通商谈技巧。<br />\r\n5、对市场有灵敏的触觉和较强的资讯搜集能力，能独力操作品牌营销工作。<br />\r\n6、熟悉微博、微信，能熟练使用微博、微信进行图文信息发布，至少一年以上微博、微信运营经验。', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page_hr', '', 368, 1, NULL, '2014-07-29 06:59:21'),
(20, 17, '联系方式', '', '', '', '', '', '', 0, 50, 'page', 10, 'list', 'show', 'page_contact', '', 368, 1, NULL, '2014-07-28 09:07:48');


INSERT INTO `hike_contact` (`id`, `name`, `real_name`, `phone`, `shop`, `ip`, `create_time`, `update_time`) VALUES
(1, 'test', '', '1234', '', '', NULL, NULL),
(2, 'a', 'a', '1234', '', '', '2014-07-30 14:15:04', NULL),
(3, 'a', 'a', '1234', '', '', '2014-07-30 14:17:55', NULL),
(4, '1', '1', '12345', '', '', '2014-07-30 14:22:19', NULL),
(5, '1', '1', '123456', '', '', '2014-07-30 14:23:14', NULL),
(6, '1', '1', '12342', '', '', '2014-07-30 14:36:05', NULL);


INSERT INTO `hike_show` (`id`, `catalog_id`, `admin_id`, `author`, `title`, `brief`, `content`, `seo_title`, `seo_description`, `seo_keywords`, `banner`, `template`, `click`, `status`, `create_time`, `update_time`, `redirect_url`) VALUES
(2, 10, 1, '', '力帆佛山安迪通', '', '力帆佛山安迪通', 's3 testtst', 's3 dsfs', '', '/assets/upload/2014/0728/201407281612174010.jpg', 'show', 368, 1, '2014-07-05 16:04:47', NULL, ''),
(7, 10, 1, '', '北汽广州安迪嘉', '', '北汽广州安迪嘉', '', '', '', '/assets/upload/2014/0728/201407281617349231.jpg', 'show', 368, 1, '2014-07-28 16:17:34', NULL, ''),
(8, 10, 1, '', '比亚迪南海宇翔', '比亚迪南海宇翔', '比亚迪南海宇翔', '', '', '', '/assets/upload/2014/0728/201407281618081343.jpg', 'show', 368, 1, '2014-07-28 16:18:08', NULL, ''),
(10, 11, 1, '', '挖金-MiCard豹变出炉，耀世登场', '', '', '', '', '', '', 'show', 368, 1, '2014-05-06 09:09:36', '2014-07-28 08:48:46', 'http://mp.weixin.qq.com/s?__biz=MzA3NzQyMjExMg==&mid=200091451&idx=1&sn=cdf8991b4871ca3dcb2524c0f06cbad4'),
(11, 11, 1, '', '行业朋友题词力挺挖金', '', '', '', '', '', '', 'show', 368, 1, '2014-05-06 09:09:45', '2014-07-28 08:48:38', 'http://mp.weixin.qq.com/s?__biz=MzA3NzQyMjExMg==&mid=200091451&idx=2&sn=2f551345dc9bbfbfa5b9385b9fc4444d'),
(12, 12, 1, '', '企业级移动CRM或迎普及风暴', '', NULL, '', '', '', '', 'show', 368, 1, '2014-05-06 09:09:36', '2014-07-28 10:01:19', 'http://mp.weixin.qq.com/s?__biz=MzA3NzQyMjExMg==&mid=200092570&idx=1&sn=4605cad3fbeb4d4694a9d66e5e400bec');
