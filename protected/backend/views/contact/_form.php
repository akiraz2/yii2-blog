<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">带<span class="required">*</span>为必填项</p>

	<?php echo $form->errorSummary($model); ?>

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
			'label'=>$model->isNewRecord ? '创建' : '保存',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->