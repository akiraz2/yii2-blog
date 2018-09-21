<?php

use akiraz2\blog\Module;
use yii\helpers\Html;

?>
<section class="blog-default-index">
    <h1>
        <?= Module::t('blog', 'Welcome to Blog Module'); ?>
    </h1>
    <ul>
        <li><?= Html::a(Module::t('blog', 'Blog Categorys'), ['/blog/blog-category']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Posts'), ['/blog/blog-post']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Comments'), ['/blog/blog-comment']); ?></li>
        <li><?= Html::a(Module::t('blog', 'Blog Tags'), ['/blog/blog-tag']); ?></li>
    </ul>
</section>
