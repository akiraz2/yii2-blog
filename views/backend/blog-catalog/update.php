<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use yii\helpers\Html;
use akiraz2\blog\Module;

/* @var $this yii\web\View */
/* @var $model akiraz2\blog\models\BlogCatalog */

$this->title = Module::t('blog', 'Update ') . Module::t('blog', 'Blog Catalog') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('blog', 'Update');
?>
<div class="blog-catalog-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
