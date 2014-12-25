<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use funson86\blog\models\BlogCatalog;
use funson86\blog\Module;

/* @var $this yii\web\View */
/* @var $searchModel funson86\blog\models\BlogCatalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Catalogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-catalog-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Module::t('blog', 'Create ') . Module::t('blog', 'Blog Catalog'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>排序</th>
            <th>模板</th>
            <th>顶级目录</th>
            <th>状态</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($dataProvider as $item){ ?>
        <tr data-key="1">
            <td><?= $item['id']; ?></td>
            <td><?= $item['str_label']; ?></td>
            <td><?= $item['sort_order']; ?></td>
            <td><?= $item['template']; ?></td>
            <td><?= BlogCatalog::getOneIsNavLabel($item['is_nav']); ?></td>
            <td><?= \funson86\blog\models\Status::labels()[$item['status']]; ?></td>
            <td>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['blog/blog-catalog/create','parent_id'=>$item['id']]); ?>" title="增加子栏目" data-pjax="0"><span class="glyphicon glyphicon-plus-sign"></span></a>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['blog/blog-catalog/view','id'=>$item['id']]); ?>"" title="查看" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['blog/blog-catalog/update','id'=>$item['id']]); ?>"" title="更新" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="<?= \Yii::$app->getUrlManager()->createUrl(['blog/blog-catalog/delete','id'=>$item['id']]); ?>"" title="删除" data-confirm="您确定要删除此项吗？" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
