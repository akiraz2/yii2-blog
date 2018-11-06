<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model akiraz2\blog\models\BlogCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-category-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(BlogCategory::getList($model->id), ['prompt' => Module::t('blog', 'Select parent Category')]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'banner')->fileInput() ?>

    <?= $form->field($model, 'is_nav')->dropDownList(BlogCategory::getArrayIsNav()) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'page_size')->textInput() ?>

    <?= $form->field($model, 'template')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->dropDownList(BlogCategory::getStatusList()) ?>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Module::t('blog', 'Create') : Module::t('blog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
