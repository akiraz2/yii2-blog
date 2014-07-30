<?php
/* @var $this ShowController */
/* @var $model Show */

$this->breadcrumbs=array(
	'列表页'=>array('admin'),
	'管理',
);

$this->menu=array(
	array('label'=>'创建列表页', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#show-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>列表页管理</h1>

<p>
可在每列头部支持(<, <=, >, >=, <> or =)表达式进行搜索
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'show-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		array(
			'name'=>'catalog_id',
			'value'=>'Catalog::model()->findByPk($data->catalog_id)->title',
		),
		//'admin_id',
		//'author',
		//'brief',
		'template',
		array(
			'name'=>'status',
			'value'=>'F::getStatus2($data->status)',
		),
		/*
		'content',
		'seo_title',
		'seo_description',
		'seo_keywords',
		'banner',
		'template',
		'click',
		'status',
		'create_time',
		'update_time',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
