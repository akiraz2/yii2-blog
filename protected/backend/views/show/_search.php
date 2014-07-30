<?php
/* @var $this ShowController */
/* @var $model Show */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('size'=>10,'maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'catalog_id'); ?>

	<?php echo $form->textFieldRow($model,'admin_id',array('size'=>10,'maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'author',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'title',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'brief',array('size'=>60,'maxlength'=>1022)); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50)); ?>

	<?php echo $form->textFieldRow($model,'seo_title',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'seo_description',array('size'=>60,'maxlength'=>1022)); ?>

	<?php echo $form->textFieldRow($model,'seo_keywords',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'banner',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'template',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'redirect_url',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'click',array('size'=>10,'maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'status'); ?>

	<?php echo $form->textFieldRow($model,'create_time'); ?>

	<?php echo $form->textFieldRow($model,'update_time'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->