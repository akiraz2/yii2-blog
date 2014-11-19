<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogCatalog */

$this->title = Yii::t('blog', 'Create ') . Yii::t('blog', 'Blog Catalog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('blog', 'Blog Catalogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-catalog-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
