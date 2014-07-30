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
		<strong>深圳市挖金科技有限公司</strong>（简称“挖金科技”）是一家专注于汽车行业移动互联的高科技公司，位于广东深圳罗湖。公司员工全部拥有本科及以上学历，20%以上拥有硕士学历，5%拥有海归经历，大部分员工来自北大、清华、中科大等国内重点院校。<br>
		<strong>挖金-MiCard</strong>是挖金科技开发的一款汽车4S移动互联成交利器。Ta源自移动互联网思维，整合奔驰、比亚迪等12个厂家管理 ，融入丰田、长城等17个品牌终端运营，来自谷歌、华为平均智商超过128的天才团队历经200多个日夜开发出来的。Ta是移动互联技术与销售实战经验的完美结合。<br>
		一起挖金。
	</div>
</div>

