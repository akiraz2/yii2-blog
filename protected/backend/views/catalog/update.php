<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
	'栏目管理'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'修改',
);

$this->menu=array(
	array('label'=>'栏目管理', 'url'=>array('admin')),
);
?>

<h1>修改栏目 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'data'=>$data)); ?>