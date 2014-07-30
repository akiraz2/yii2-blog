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
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/about_adv.jpg" width="1000">
</div><!--广告结束-->

<div class="main"><!--关于挖金开始-->

	<div class="main_left">
		<h1><?php echo $portletTitle; ?></h1>
		<ul>
			<?php
			foreach($portlet as $item)
			{
				$url = $this->createUrl('/site/'.$item->page_type,array('id'=>$item->id));
				echo ($catalog->id == $item->id) ? '<li class="current"><a href="'.$url.'">'.$item->title.'</a></li>' : '<li><a href="'.$url.'">'.$item->title.'</a></li>';
			}
			?>
		</ul>
	</div>

	<div class="main_right">
		<h3><span><?php echo $catalog->title; ?></span></h3>
		<div class="about_content">
			<?php echo $catalog->content; ?>
		</div>



	</div>

</div><!--关于挖金结束-->


</div><!-- form -->

