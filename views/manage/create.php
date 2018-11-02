<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */

$this->title = Module::t('blog', 'Create ') . Module::t('blog', 'Blog Post');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
