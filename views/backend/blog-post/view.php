<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-view">

    <p>
        <?= Html::a(Yii::t('blog', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('blog', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('blog', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'catalog_id',
            'title',
            'content:ntext',
            'tags',
            'surname',
            'click',
            'user_id',
            'status',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
