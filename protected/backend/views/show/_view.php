<?php
/* @var $this ShowController */
/* @var $data Show */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catalog_id')); ?>:</b>
	<?php echo CHtml::encode($data->catalog_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_id')); ?>:</b>
	<?php echo CHtml::encode($data->admin_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_title')); ?>:</b>
	<?php echo CHtml::encode($data->seo_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_description')); ?>:</b>
	<?php echo CHtml::encode($data->seo_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seo_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->seo_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('banner')); ?>:</b>
	<?php echo CHtml::encode($data->banner); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('template')); ?>:</b>
	<?php echo CHtml::encode($data->template); ?>
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