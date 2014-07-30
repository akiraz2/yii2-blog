<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=($catalog->seo_title ? $catalog->seo_title : $catalog->title) . ' - ' . Yii::app()->name;
$this->seoKeywords=($catalog->seo_keywords ? $catalog->seo_keywords : F::sg('site', 'siteKeywords'));
$this->seoDescription=($catalog->seo_description ? $catalog->seo_description : F::sg('site', 'siteDescription'));
$this->breadcrumbs=array(
	$catalog->title,
);
?>
<div class="banner"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/about.jpg"></div>
<div class="container">
	<div class="about_title"><?php echo $catalog->title; ?></span></div>
	<div class="about_content">
		<span style="font-size:14px;">招聘岗位：<strong>PHP高级工程师</strong></span><br />
		工作地点：深圳罗湖<br />
		学历：本科及以上<br />
		工作年限：3年及以上<br />
		月薪：10000-15000元<br />
		招聘人数：2人<br />
		岗位要求：<br />
		1、精通php+mysql开发，从事过php开源程序开发工作；&nbsp;<br />
		2、熟练掌握html，javascript，jquery，div，css，xml代码；&nbsp;<br />
		3、熟悉mysql数据库的配置、维护和性能优化；具有mysql索引优化、查询优化和存储优化经验、php缓存技术。<br />
		4、积极的工作态度。<br />
		5、良好的团队合作精神。<br />
		&nbsp;<br />
		<br />
		<span style="font-size:14px;">招聘岗位：<strong>品牌专员</strong></span><br />
		工作地点：深圳罗湖<br />
		学历：本科及以上<br />
		工作年限：3年及以上<br />
		月薪：8000-10000元<br />
		招聘人数：2人<br />
		岗位要求：<br />
		1、市场营销、管理类、广告类或相关专业本科以上学历。<br />
		2、具有互联网行业的从业背景，有三年以上品牌宣传、媒介推广等相关经验。<br />
		3、熟悉公关媒体品牌推广运作，具有出色的品牌策略能力及整合传播技巧。<br />
		4、品牌意识强，具有出色提案撰写能力和沟通商谈技巧。<br />
		5、对市场有灵敏的触觉和较强的资讯搜集能力，能独力操作品牌营销工作。<br />
		6、熟悉微博、微信，能熟练使用微博、微信进行图文信息发布，至少一年以上微博、微信运营经验。
	</div>
</div>

