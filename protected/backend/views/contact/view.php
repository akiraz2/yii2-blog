<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	'产品预定'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'产品预定管理', 'url'=>array('admin')),
	array('label'=>'创建产品预定', 'url'=>array('create')),
	array('label'=>'修改产品预定', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除产品预定', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>查看产品预定 #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'real_name',
		'phone',
		'shop',
		'ip',
		'create_time',
		'update_time',
	),
)); ?>
