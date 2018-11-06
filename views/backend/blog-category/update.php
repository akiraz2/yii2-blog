<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;

/* @var $this yii\web\View */
/* @var $model akiraz2\blog\models\BlogCategory */

$this->title = Module::t('blog', 'Update') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Admin'), 'url' => ['/blog/backend/default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title];
$this->params['breadcrumbs'][] = Module::t('blog', 'Update');
?>
<div class="blog-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
