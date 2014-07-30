<?php
/* @var $this CatalogController */
/* @var $data Catalog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brief')); ?>:</b>
	<?php echo CHtml::encode($data->brief); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_title')); ?>:</b>
	<?php echo CHtml::encode($data->seo_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->seo_keywords); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_description')); ?>:</b>
	<?php echo CHtml::encode($data->seo_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banner')); ?>:</b>
	<?php echo CHtml::encode($data->banner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_nav')); ?>:</b>
	<?php echo CHtml::encode($data->is_nav); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort_order')); ?>:</b>
	<?php echo CHtml::encode($data->sort_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_type')); ?>:</b>
	<?php echo CHtml::encode($data->page_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_size')); ?>:</b>
	<?php echo CHtml::encode($data->page_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('template_list')); ?>:</b>
	<?php echo CHtml::encode($data->template_list); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('template_show')); ?>:</b>
	<?php echo CHtml::encode($data->template_show); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('template_page')); ?>:</b>
	<?php echo CHtml::encode($data->template_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('redirect_url')); ?>:</b>
	<?php echo CHtml::encode($data->redirect_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('click')); ?>:</b>
	<?php echo CHtml::encode($data->click); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	*/ ?>

</div>