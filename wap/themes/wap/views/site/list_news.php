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
<div class="news_banner"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/report.jpg" /></div>
<div class="news_list">
	<ul>
		<?php
		foreach($model as $show)
		{
			$url = isset($show->redirect_url) ? $show->redirect_url : '/site/show/'.$show->id.'.html';
			echo '<li><a href="'.$url.'" target="_blank">';
			echo '<div class="pic"><img src="'.($show->banner ? $show->banner : '<?php echo Yii::app()->theme->baseUrl; ?>/images/defaultshare.jpg').'" /></div>';
			echo '<h2>'.$show->title.'</h2>';
			echo '<p>'.$show->brief.'</p>';
			echo '</a></li>';
		}
		?>
	</ul>

</div>



