<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=($catalog->seo_title ? $catalog->seo_title : $catalog->title) . ' - ' . Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	$catalog->title,
);
?>

<h1><?php echo $catalog->title; ?></h1>

<?php
foreach($model as $show)
{
	echo $show->title.'<br>';
}
;?>

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
