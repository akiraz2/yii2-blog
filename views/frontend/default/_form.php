<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\markdown\Markdown;
use yii\widgets\ActiveForm;
?>

<div class="form">

    <?php $form = ActiveForm::begin([
        'id'=>'comment-form',
        'enableAjaxValidation'=>true,
    ]); ?>

    <div class="note"><?php echo Yii::t('common', 'Fields Required'); ?></div>

    <div class="row">
        <?php echo $form->field($model,'author')->textInput()->label('Author'); ?>
    </div>



    <?php ActiveForm::end(); ?>

</div><!-- form -->