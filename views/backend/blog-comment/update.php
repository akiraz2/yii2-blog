<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogComment */

$this->title = Yii::t('blog', 'Update ') . Yii::t('blog', 'Blog Comment') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('blog', 'Update');
?>
<div class="blog-comment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
