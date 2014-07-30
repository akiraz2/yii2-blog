<?php
/* @var $this ShowController */
/* @var $model Show */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'show-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">带<span class="required">*</span>为必填项</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'catalog_id',CHtml::listData(Catalog::get(0, Catalog::model()->findAll()), 'id', 'str_label')); ?>

	<?php echo $form->textFieldRow($model,'author',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'title',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'brief',array('size'=>60,'maxlength'=>1022)); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50)); ?>

	<?php echo $form->textFieldRow($model,'seo_title',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'seo_description',array('size'=>60,'maxlength'=>1022)); ?>

	<?php echo $form->textFieldRow($model,'seo_keywords',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->fileFieldRow($model,'banner',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->dropDownListRow($model,'template',$data['show']); ?>

	<?php echo $form->textFieldRow($model,'redirect_url',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'click',array('size'=>10,'maxlength'=>10)); ?>

	<?php echo $form->dropDownListRow($model,'status',F::getStatus2()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? '创建' : '保存',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->