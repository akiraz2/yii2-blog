<?php

use yii\helpers\Html;
use funson86\blog\Module;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogComment */

$this->title = Module::t('blog', 'Create ') . Module::t('blog', 'Blog Comment');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-comment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
