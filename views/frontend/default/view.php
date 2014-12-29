<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use funson86\blog\Module;

$this->title = Yii::$app->params['blogTitle'] . ' - ' . Yii::$app->params['blogTitleSeo'];
$this->params['breadcrumbs'][] = '文章';

/*$this->breadcrumbs=[
    //$post->catalog->title => Yii::app()->createUrl('post/catalog', array('id'=>$post->catalog->id, 'surname'=>$post->catalog->surname)),
    '文章',
];*/

?>

<?php
echo $this->render('_view', [
    'data' => $post,
]);
?>

<div id="comments">
    <?php if($post->commentsCount >= 1): ?>
        <h3>
            <?= $post->commentsCount . Module::t('blog', 'Unit comments'); ?>
        </h3>

        <?=$this->render('_comments',array(
            'post' => $post,
            'comments' => $comments,
        )); ?>
    <?php endif; ?>

    <div id='reply'>
        <h3><?= Module::t('blog', 'Write comments'); ?></h3>
        <?= $this->render('_form', [
            'model' => $comment,
        ]);?>
    </div>

</div><!-- comments -->


