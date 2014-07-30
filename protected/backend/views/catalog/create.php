<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
	'栏目管理'=>array('admin'),
	'创建',
);

$this->menu=array(
	array('label'=>'栏目管理', 'url'=>array('admin')),
);
?>

<h1>创建栏目</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'data'=>$data)); ?>