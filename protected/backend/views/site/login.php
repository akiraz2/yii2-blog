<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle='后台登录'.Yii::app()->name;// . ' - 登录';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>登录</h1>

<!--p>Please fill out the following form with your login credentials:</p-->

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->textFieldRow($model,'username'); ?>

	<?php echo $form->passwordFieldRow($model,'password',array(
		'hint'=>'',
	)); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaRow($model,'verifyCode',array(
			'hint'=>'请输入上面的字符.<br/>不区分大小写.',
		)); ?>
	<?php endif; ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'登录',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
