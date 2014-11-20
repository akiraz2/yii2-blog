<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogComment */

$this->title = Yii::t('blog', 'Create ') . Yii::t('blog', 'Blog Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
