<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->seoKeywords=F::sg('site', 'siteKeywords');
$this->seoDescription=F::sg('site', 'siteDescription');
?>

<div class="banner"><!--广告开始-->
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/index_banner.jpg" width="1000" height="184">
</div><!--广告结束-->

<div class="item"><!--产品特性开始-->
	<ul>
		<li><a href="/product/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/item_01.jpg" width="306" height="335"></a></li>
		<li><a href="/product/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/item_02.jpg" width="300" height="335"></a></li>
		<li style="border:none;"><a href="/product/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/item_03.jpg" width="296" height="335"></a></li>
	</ul>
	<div class="clear"></div>
</div><!--产品特性结束-->


