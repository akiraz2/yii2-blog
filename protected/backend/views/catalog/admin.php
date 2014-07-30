<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
	'栏目管理'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'创建栏目', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#catalog-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>栏目管理</h1>

<?php
$this->widget('system.web.widgets.CTreeView',array(
	'collapsed'=>false,
	'animated'=>'slow',
	'data'=>$dataProvider,
));
?>

