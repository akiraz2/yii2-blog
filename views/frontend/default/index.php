<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\LinkPager;

$this->title = Yii::$app->params['blogTitle'] . ' - ' . Yii::$app->params['blogTitleSeo'];
$this->params['breadcrumbs'][] = '文章';

/*$this->breadcrumbs=[
    //$post->catalog->title => Yii::app()->createUrl('post/catalog', array('id'=>$post->catalog->id, 'surname'=>$post->catalog->surname)),
    '文章',
];*/

?>
<?php if(!empty($_GET['tag'])): ?>
    <h4>标签[<i><?= Html::encode($_GET['tag']); ?></i>]相关文章</h4>
<?php endif; ?>

<?php if(!empty($_GET['keyword'])): ?>
    <h4>搜索[<i><?= Html::encode($_GET['keyword']); ?></i>]相关文章</h4>
<?php endif; ?>

<?php
foreach($posts as $post)
{
    echo $this->render('_brief', [
        'data' => $post,
    ]);
}
?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
