<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="blog-comment-form">
    <?php $form = ActiveForm::begin([
        'id' => 'comment-form',
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'author')->textInput((['maxlength' => 32])); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput((['maxlength' => 32])); ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->textarea(['rows' => 3]); ?>

    <?= Html::submitButton(Module::t('blog', 'Add comments'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>
</div>
