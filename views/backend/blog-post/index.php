<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use funson86\blog\Module;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('blog', 'Blog Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('blog', 'Create ') . Yii::t('blog', 'Blog Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'catalog_id',
                'value'=>function ($model) {
                        return $model->catalog->title;
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'catalog_id',
                        \funson86\blog\models\BlogPost::getArrayCatalog(),
                        ['class' => 'form-control', 'prompt' => Module::t('blog', 'PROMPT_CATALOG')]
                    )
            ],
            'title',
            // 'content:ntext',
            // 'tags',
            // 'surname',
            // 'click',
            // 'user_id',
            'commentsCount',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                        if ($model->status === $model::STATUS_ACTIVE) {
                            $class = 'label-success';
                        } elseif ($model->status === $model::STATUS_INACTIVE) {
                            $class = 'label-warning';
                        } else {
                            $class = 'label-danger';
                        }

                        return '<span class="label ' . $class . '">' . $model->statusLabel . '</span>';
                    },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        \funson86\blog\models\BlogPost::getArrayStatus(),
                        ['class' => 'form-control', 'prompt' => Module::t('blog', 'PROMPT_STATUS')]
                    )
            ],
            'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
