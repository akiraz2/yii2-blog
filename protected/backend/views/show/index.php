<?php
/* @var $this ShowController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'列表页',
);

$this->menu=array(
	array('label'=>'创建列表页', 'url'=>array('create')),
	array('label'=>'列表页管理', 'url'=>array('admin')),
);
?>

<h1>列表页</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
