<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogCatalog */

$this->title = Yii::t('blog', 'Update ') . Yii::t('blog', 'Blog Catalog') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'Update');
?>
<div class="blog-catalog-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
