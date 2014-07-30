<?php
/* @var $this AdminController */
/* @var $model Admin */

$this->breadcrumbs=array(
	'管理员管理'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'管理员管理', 'url'=>array('admin')),
	array('label'=>'创建管理员', 'url'=>array('create')),
	array('label'=>'修改管理员', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除管理员', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>查看管理员 #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		//'password',
		'email',
		'profile',
		'create_time',
		'login_time',
	),
)); ?>
