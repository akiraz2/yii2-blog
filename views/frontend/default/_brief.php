<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use yii\helpers\Html;

?>

<div class="blog-brief">
    <div class="blog-brief__img">
        <?= Html::img($model->getImageFileUrl('banner')); ?>
    </div>
    <div class="blog-brief__wrap">
        <div class="blog-brief__cat">
            <?= $model->category->title; ?>
        </div>
        <h4 class="blog-brief__title title title--4">
            <?= Html::a(Html::encode($model->title), $model->url); ?>
        </h4>
        <div class="blog-brief__content">
            <?php
            echo \yii\helpers\HtmlPurifier::process($model->brief);
            ?>
        </div>
        
        <div class="blog-brief__nav">
            <span>
                <i class="fa fa-calendar"></i><?= Yii::$app->formatter->asDate($model->created_at); ?>
            </span>
            <span>
                <i class="fa fa-eye"></i><?= $model->click; ?>
            </span>
        </div>
    </div>
</div>