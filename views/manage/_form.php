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
use kartik\markdown\MarkdownEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-post-form">
    <?php $form = ActiveForm::begin([]); ?>
    <?= $form->errorSummary($model); ?>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#main" aria-controls="main" role="tab" data-toggle="tab">
                <?= Module::t('blog', 'Content'); ?>
            </a>
        </li>
        <li role="presentation">
            <a href="#image" aria-controls="image" role="tab" data-toggle="tab">
                <?= Module::t('blog', 'Image'); ?>
            </a>
        </li>
        <li role="presentation">
            <a href="#seo" aria-controls="seo" role="tab" data-toggle="tab">
                <?= Module::t('blog', 'SEO'); ?>
            </a>
        </li>
        <li role="presentation">
            <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                <?= Module::t('blog', 'Settings'); ?>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="main">
            <?= $form->field($model, 'category_id')->dropDownList(BlogCategory::getList(), ['prompt' => Module::t('blog', 'Select category')]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

            <?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::class, [
                'moduleId' => $model->module->redactorModule,
                'clientOptions' => [
                    'plugins' => ['clips', 'fontcolor', 'imagemanager']
                ]
            ]); ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="image">
            <?= $form->field($model, 'banner')->fileInput() ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="seo">
            <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 128]) ?>
            <?= $form->field($model, 'seo_description')->textarea() ?>
            <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 128]) ?>
            <?= $form->field($model, 'seo_img')->textInput(['maxlength' => 128]) ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="settings">

        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Module::t('blog', 'Create') : Module::t('blog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
