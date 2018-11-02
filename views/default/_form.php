<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
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

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::class, [
        'captchaAction' => \yii\helpers\Url::to('/blog/default/captcha'),
    ])->hint(Module::t('blog', 'Math, for example, 45-12 = 33')) ?>

    <?= Html::submitButton(Module::t('blog', 'Add comments'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>
</div>
