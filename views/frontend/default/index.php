<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use yii\helpers\Html;
use yii\widgets\ListView;

//$this->title = Yii::$app->params['blogTitle'] . ' - ' . Yii::$app->params['blogTitleSeo'];
//$this->params['breadcrumbs'][] = '文章';

/*$this->breadcrumbs=[
    //$post->category->title => Yii::app()->createUrl('post/category', array('id'=>$post->category->id, 'slug'=>$post->category->slug)),
    '文章',
];*/

?>
<div class="blog-index">
    <div class="blog-index__header">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="title title--1"><?= \akiraz2\blog\Module::t('blog', 'Blog'); ?></h1>
                </div>
                <div class="col-md-5">
                    <div class="blog-index__search">
                        <ul class="blog-index__cat-list">
                            <?php
                            $items = [];

                            for ($i = 0; $i < count($categories); $i++) {
                                $category = $categories[$i];
                                $items[] = [
                                    'label' => $category->title,
                                    'url' => ['default/index', 'BlogPostSearch[category_id]' => $category->id]
                                ];
                                //echo "<li>" . Html::a($category->title, ['index', 'BlogPostSearch[category_id]' => $category->id]) . "</li>";
                            } ?>
                        </ul>
                        <?= \yii\widgets\Menu::widget([
                            'items' => $items,
                            'route' => 'blog/default/index',
                            //'params' => ['BlogPostSearch[category_id]' => 1]
                        ]);
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
        </div>
    </div>
</div>


