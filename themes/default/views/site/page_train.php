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

<div class="main"><!--video START-->

	<div class="main_left">
		<h1>在线培训</h1>
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
		<h3><span>培训题库</span></h3>

		<div class="video">
			<div class="vido_title">挖金-MiCard 题库</div>
			<?php echo $catalog->content; ?>
		</div>

</div><!--video END-->


