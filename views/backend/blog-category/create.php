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

$this->title = Module::t('blog', 'Create');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Admin'), 'url' => ['/blog/backend/default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
