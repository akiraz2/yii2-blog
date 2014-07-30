<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
	'栏目管理'=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>'栏目管理', 'url'=>array('admin')),
	array('label'=>'创建栏目', 'url'=>array('create')),
	array('label'=>'修改栏目', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除栏目', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>查看栏目 #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'title',
		'brief',
		'content',
		'seo_title',
		'seo_keywords',
		'seo_description',
		'banner',
		'is_nav',
		'sort_order',
		'page_type',
		'page_size',
		'template_list',
		'template_show',
		'template_page',
		'redirect_url',
		'click',
		'status',
		'create_time',
		'update_time',
	),
)); ?>
