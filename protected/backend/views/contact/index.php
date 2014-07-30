<?php
/* @var $this ContactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'产品预定',
);

$this->menu=array(
	array('label'=>'创建产品预定', 'url'=>array('create')),
	array('label'=>'产品预定管理', 'url'=>array('admin')),
);
?>

<h1>产品预定</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
