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
/* @var $model backend\modules\blog\models\BlogComment */

$this->title = Module::t('blog', 'Create ') . Module::t('blog', 'Blog Comment');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
