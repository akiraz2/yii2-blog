<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'产品预定'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'产品预定管理', 'url'=>array('admin')),
);
?>

<h1>创建产品预定</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>