<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'产品预定'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'产品预定管理', 'url'=>array('admin')),
);
?>

<h1>修改产品预定 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>