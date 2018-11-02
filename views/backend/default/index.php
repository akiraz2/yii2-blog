<?php

use akiraz2\blog\Module;
use yii\helpers\Html;

?>
<section class="blog-default-index">
    <h1>
        <?= Module::t('blog', 'Welcome to Blog Module'); ?>
    </h1>
    <ul>
        <li><?= Html::a(Module::t('blog', 'Blog Categorys'), ['blog-category']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Posts'), ['blog-post']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Comments'), ['blog-comment']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Tags'), ['blog-tag/index']); ?></li>
    </ul>
</section>
