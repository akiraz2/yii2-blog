<?php
/* @var $this AdminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'管理员管理',
);

$this->menu=array(
	array('label'=>'创建管理员', 'url'=>array('create')),
	array('label'=>'管理员管理', 'url'=>array('admin')),
);
?>

<h1>管理员管理</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
