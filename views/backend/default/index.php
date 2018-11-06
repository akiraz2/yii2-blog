<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\helpers\Html;

$this->title = Module::t('blog', 'Blog Admin');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="blog-default-index">
    <h1>
        <?= Module::t('blog', 'Welcome to Blog Module'); ?>
    </h1>
    <ul>
        <li><?= Html::a(Module::t('blog', 'Blog Category'), ['/blog/backend/blog-category']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Posts'), ['/blog/backend/blog-post']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Comments'), ['/blog/backend/blog-comment']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Tags'), ['/blog/backend/blog-tag']); ?></li>
    </ul>
</section>
