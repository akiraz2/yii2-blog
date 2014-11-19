<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use funson86\blog\Module;

/* @var $this yii\web\View */
/* @var $model funson86\blog\models\BlogCatalog */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-catalog-view">

    <p>
        <?= Html::a(Module::t('blog', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('blog', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('blog', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'title',
            'surname',
            'banner',
            'is_nav',
            'sort_order',
            'page_size',
            'template',
            'redirect_url:url',
            'status',
            'create_time',
            'update_time',
        ],
    ]) ?>

</div>
