<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id'); ?>

	<?php echo $form->textFieldRow($model,'name',array('size'=>20,'maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'real_name',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'shop',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'ip',array('size'=>15,'maxlength'=>15)); ?>

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