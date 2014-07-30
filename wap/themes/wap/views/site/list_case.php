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

<div class="news_banner"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/case_banner.jpg" /></div>

<div class="case_list">
	<h3><?php echo $catalog->title; ?></h3>
	<ul>
		<?php
		foreach($model as $show)
		{
			echo '<li>';
			echo '<div class="img"><img src="'.$show->banner.'" width="90" height="90" alt="'.$show->title.'"></div>';
			echo '<p>'.$show->title.'</p>';
			echo '</li>';
		}
		?>
	</ul>

</div>

