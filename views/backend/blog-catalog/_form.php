<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \funson86\blog\models\BlogCatalog;
use funson86\blog\Module;

/* @var $this yii\web\View */
/* @var $model funson86\blog\models\BlogCatalog */
/* @var $form yii\widgets\ActiveForm */

//fix the issue that it can assign itself as parent
$parentCatalog = ArrayHelper::merge([0 => Module::t('blog', 'Root Catalog')], ArrayHelper::map(BlogCatalog::get(0, BlogCatalog::find()->all()), 'id', 'str_label'));
unset($parentCatalog[$model->id]);

?>

<div class="blog-catalog-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'parent_id')->dropDownList($parentCatalog) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'banner')->fileInput() ?>

    <?= $form->field($model, 'is_nav')->dropDownList(BlogCatalog::getArrayIsNav()) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'page_size')->textInput() ?>

    <?= $form->field($model, 'template')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->dropDownList(\funson86\blog\models\Status::labels()) ?>

    <div class="form-group">
        <label class="col-lg-2 control-label" for="">&nbsp;</label>
        <?= Html::submitButton($model->isNewRecord ? Module::t('blog', 'Create') : Module::t('blog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
