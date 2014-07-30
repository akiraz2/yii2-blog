<?php
/* @var $this ShowController */
/* @var $model Show */

$this->breadcrumbs=array(
	'列表页'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'列表页管理', 'url'=>array('admin')),
);
?>

<h1>修改列表页 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'data'=>$data)); ?>