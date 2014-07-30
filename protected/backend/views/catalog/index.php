<?php
/* @var $this CatalogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'栏目',
);

$this->menu=array(
	array('label'=>'创建栏目', 'url'=>array('create')),
	array('label'=>'栏目管理', 'url'=>array('admin')),
);
?>

<h1>栏目</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
