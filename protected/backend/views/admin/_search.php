<?php
/* @var $this AdminController */
/* @var $model Admin */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id'); ?>

	<?php echo $form->textFieldRow($model,'username',array('size'=>60,'maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'profile',array('rows'=>6, 'cols'=>50)); ?>

	<?php echo $form->textFieldRow($model,'create_time'); ?>

	<?php echo $form->textFieldRow($model,'login_time'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'ËÑË÷',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->