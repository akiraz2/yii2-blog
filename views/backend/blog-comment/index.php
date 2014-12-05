<?php

use yii\helpers\Html;
use funson86\blog\Module;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\BlogCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('blog', 'Create ') . Module::t('blog', 'Blog Comment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            [
                'attribute'=>'post_id',
                'value'=>function ($model) {
                    return mb_substr($model->post->title, 0, 15, 'utf-8') . '...';
                },
                /*'filter' => Html::activeDropDownList(
                    $searchModel,
                    'post_id',
                    \funson86\blog\models\BlogPost::getArrayCatalog(),
                    ['class' => 'form-control', 'prompt' => Module::t('blog', 'Please Filter')]
                )*/
            ],
            [
                'attribute'=>'content',
                'value'=>function ($model) {
                    return mb_substr(Yii::$app->formatter->asText($model->content), 0, 30, 'utf-8') . '...';
                },
            ],
            'author',
            'email:email',
            // 'url:url',
            // 'status',
            // 'create_time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
