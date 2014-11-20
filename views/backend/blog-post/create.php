<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */

$this->title = Yii::t('blog', 'Create ') . Yii::t('blog', 'Blog Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
