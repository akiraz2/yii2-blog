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
/* @var $model backend\modules\blog\models\BlogPost */

$this->title = Module::t('blog', 'Update ') . Module::t('blog', 'Blog Post') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('blog', 'Update');
?>
<div class="blog-post-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
