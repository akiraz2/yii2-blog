<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel akiraz2\blog\models\BlogCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Categorys');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Admin'), 'url' => ['/blog/backend/default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Category')];
?>
<div class="blog-category-index">
    <p>
        <?= Html::a(Module::t('blog', 'Create ') . Module::t('blog', 'Blog Category'), ['create'],
            ['class' => 'btn btn-success']) ?>
    </p>
    <?= \himiklab\sortablegrid\SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'attribute' => 'banner',
                'value' => function ($model) {
                    return Html::img($model->getThumbFileUrl('banner', 'thumb'),
                        ['class' => 'img-responsive', 'width' => 100]);
                },
                'format' => 'raw',
                'filter' => false
            ],
            'title',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->status === BlogCategory::STATUS_ACTIVE) {
                        $class = 'label-success';
                    } elseif ($model->status === BlogCategory::STATUS_INACTIVE) {
                        $class = 'label-warning';
                    } else {
                        $class = 'label-danger';
                    }
                    return '<span class="label ' . $class . '">' . $model->getStatus() . '</span>';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    BlogCategory::getStatusList(),
                    ['class' => 'form-control', 'prompt' => Module::t('blog', 'Please Filter')]
                )
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>

</div>
