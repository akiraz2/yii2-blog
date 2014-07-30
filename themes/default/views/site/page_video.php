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
		<h3><span>视频教程</span></h3>

		<div class="video">
			<div class="vido_title">挖金微卡使用视频教程</div>
			<object class id="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="750" height="500">
				<param name="movie" value="/statics/js/flvplayer.swf">
				<param name="quality" value="high">
				<param name="allowFullScreen" value="true">
				<param name="FlashVars" value="vcastr_file=http://115.29.201.67/ppt/images/waging.flv&BufferTime=3&IsAutoPlay=1">
				<embed src="<?php echo Yii::app()->theme->baseUrl; ?>/js/flvplayer.swf" allowfullscreen="true" flashvars="vcastr_file=http://115.29.201.67/ppt/images/waging.flv&IsAutoPlay=1" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="800" height="600"></embed>
			</object>

		</div>



	</div>

</div><!--video END-->


