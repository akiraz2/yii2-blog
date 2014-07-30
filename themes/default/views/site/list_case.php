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
	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/case_banner.jpg">
</div><!--广告结束-->

<div class="main"><!--新闻内容开始-->

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
		<div class="clear"></div>

		<div class="case_list"><!--案例列表开始-->
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
			<div class="clear"></div>
		</div><!--案例列表结束-->
	</div>

</div><!--新闻内容结束-->



<div id="pager">
<?php
$this->widget('CLinkPager',array(
		'header'=>'',
		'firstPageLabel' => '首页',
		'lastPageLabel' => '末页',
		'prevPageLabel' => '上一页',
		'nextPageLabel' => '下一页',
		'pages' => $pages,
		'maxButtonCount'=>13
	)
);
?>
</div>
