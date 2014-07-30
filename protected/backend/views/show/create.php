<?php
/* @var $this ShowController */
/* @var $model Show */

$this->breadcrumbs=array(
	'列表页'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'列表页管理', 'url'=>array('admin')),
);
?>

<h1>创建列表页</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'data'=>$data)); ?>