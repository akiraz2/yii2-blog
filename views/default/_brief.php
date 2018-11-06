<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

/**
 * @var $model \akiraz2\blog\models\BlogPost
 */

use yii\helpers\Html;

?>
<div class="blog-brief">
    <div class="row">
        <div class="col-md-4">
            <div class="blog-brief__img">
                <?= Html::a(Html::img($model->getImageFileUrl('banner'), ['alt' => $model->title]), $model->url); ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="blog-brief__wrap">
                <div class="blog-brief__info">
                    <span><i class="fa fa-calendar"></i> <b><?= Yii::$app->formatter->asTime($model->created_at); ?></b>
                        <?= Yii::$app->formatter->asDate($model->created_at); ?></span>
                    <em><?= $model->categoryName; ?></em>
                </div>
                <h4 class="blog-brief__title">
                    <?= Html::a(Html::encode($model->title), $model->url); ?>
                </h4>
                <div class="blog-brief__content">
                    <?php echo \yii\helpers\HtmlPurifier::process($model->brief); ?>
                </div>
                <div class="blog-brief__stat">
                    <span><i class="fa fa-eye"></i> <?= $model->click; ?></span>
                    <span><i class="fa fa-comments"></i> <?= $model->commentsCount; ?></span>
                    <span><i class="fa fa-bar-chart"></i> <?= $model->rate; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>