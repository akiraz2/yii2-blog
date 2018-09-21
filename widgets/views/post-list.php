<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use yii\helpers\Html;

?>
<section class="blog-list-widget">
    <div class="blog-list-widget__header">
        <h3 class="title title--3 blog-list-widget__title"><?= $title ?></h3>
    </div>
    <div class="blog-list-widget__content">
        <?php foreach ($posts as $post): ?>
            <div class="blog-list-widget__item blog-item">
                <div class="blog-item__img">
                    <?php echo Html::a(Html::img($post->getThumbFileUrl('banner', 'thumb'), ['alt' => $post->title]), $post->getUrl(), ['title' => $post->title]); ?>
                </div>
                <div class="blog-item__right">
                    <?php echo Html::a(Html::encode($post->title), $post->getUrl(), ['class' => 'blog-item__url']); ?>
                    <div class="blog-item__brief">
                        <?= \yii\helpers\StringHelper::truncate($post->brief, 45); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
