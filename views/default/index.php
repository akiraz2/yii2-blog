<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\widgets\ListView;

\akiraz2\blog\assets\AppAsset::register($this);

$this->title = Module::t('blog', 'Blog');
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => Yii::$app->name . ' ' . Module::t('blog', 'Blog')
]);
Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => Yii::$app->name . ', ' . Module::t('blog', 'Blog')
]);

if (Yii::$app->get('opengraph', false)) {
    Yii::$app->opengraph->set([
        'title' => $this->title,
        'description' => Module::t('blog', 'Blog'),
        //'image' => '',
    ]);
}

?>
<div class="blog-index">
    <div class="blog-index__header">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="title">
                        <?= \yii\helpers\Html::a(Module::t('blog', 'Add post'), ['manage/create'], ['class' => 'pull-right btn btn-primary']); ?>
                        <h1 style="margin: 0"><?= Module::t('blog', 'Blog'); ?>
                            <small>Simple. Powerful. Easy customize.</small>
                        </h1>
                    </div>
                    <div class="page-seo">

                    </div>

                    <?php
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_brief',
                        'options' => [
                            'class' => 'blog-list-view'
                        ],
                        'layout' => '{items}{pager}{summary}'
                    ]);
                    ?>

                </div>
                <div class="col-md-4">
                    <div class="blog-index__search">
                        <?= \yii\widgets\Menu::widget([
                            'items' => $catItems,
                            'options' => [
                                'class' => 'blog-index__cat'
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


