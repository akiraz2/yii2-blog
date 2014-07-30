<?php
/* @var $this ShowController */
/* @var $model Show */

$this->breadcrumbs=array(
	'列表页'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'列表页管理', 'url'=>array('admin')),
	array('label'=>'创建列表页', 'url'=>array('create')),
	array('label'=>'修改列表页', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除列表页', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>查看列表页 #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'catalog_id',
		'admin_id',
		'author',
		'title',
		'brief',
		'content',
		'seo_title',
		'seo_description',
		'seo_keywords',
		'banner',
		'template',
		'redirect_url',
		'click',
		'status',
		'create_time',
		'update_time',
	),
)); ?>
