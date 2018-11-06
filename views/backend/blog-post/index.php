<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\Status;
use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Posts');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Admin'), 'url' => ['/blog/backend/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-index">
    <p>
        <?= Html::a(Module::t('blog', 'Create Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->title;
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    \akiraz2\blog\models\BlogCategory::getList(),
                    ['class' => 'form-control', 'prompt' => Module::t('blog', 'Please Filter')]
                )
            ],
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
            'click',
            'rate',
            'commentsCount',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    switch ($model->status) {
                        case BlogPost::STATUS_PUBLISHED:
                            $class = 'label-success';
                            break;
                        case BlogPost::STATUS_DRAFT:
                        case BlogPost::STATUS_PLANNING_TO_PUBLISH:
                            $class = 'label-warning';
                            break;
                        case BlogPost::STATUS_REJECTED:
                        case BlogPost::STATUS_DELETED:
                            $class = 'label-danger';
                            break;
                        default:
                            $class = 'label-info';
                    }
                    return '<span class="label ' . $class . '">' . $model->getStatus() . '</span>';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    BlogPost::getStatusList(),
                    ['class' => 'form-control', 'prompt' => Module::t('blog', 'Please Filter')]
                )
            ],
            'created_at:date',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]); ?>

</div>
