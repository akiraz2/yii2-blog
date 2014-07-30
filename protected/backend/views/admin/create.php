<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'管理员管理'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'管理员管理', 'url'=>array('admin')),
);
?>

<h1>创建管理员</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>