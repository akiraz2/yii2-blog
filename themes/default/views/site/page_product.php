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

<div class="banner"><!--广告开始-->
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/case_banner.jpg" width="1000">
</div><!--广告结束-->


<div class="products"><!--产品开始-->

	<div class="micard">
		<ul>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_02.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_03.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_04.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_05.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_06.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_07.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_08.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_09.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_10.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_11.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_12.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_13.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_14.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_15.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_16.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_17.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_18.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_20.jpg" width="1000"></li>
			<li><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/MiCard_19.jpg" width="1000"></li>
		</ul>
	</div>
	<div class="clear"></div>

</div><!--产品结束-->

<p id="back-to-top"><a href="#top"><span></span>返回顶部</a></p>
<script type="text/javascript">
	$(function(){
		$(window).scroll(function(){
			if($(window).scrollTop()>100){
				$("#back-to-top").fadeIn(800);
			}else{
				$("#back-to-top").fadeOut(800);
			}
		});

		$("#back-to-top").click(function(){
			$('body,html').animate({scrollTop:0},1000);
			return false;
		});
	});

</script>