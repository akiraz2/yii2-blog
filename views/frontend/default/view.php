<?php
use yii\helpers\Html;
use yii\widgets\ListView;

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
            <?php echo $post->commentsCount . Yii::t('blog', 'Unit comments'); ?>
        </h3>

        <?php $this->render('_comments',array(
            'post' => $post,
            'comments' => $post->comments,
        )); ?>
    <?php endif; ?>

    <div id='reply'>
        <h4><?php echo Yii::t('blog', 'Leave a Comment'); ?></h4>
<?php $this->render('_form', [
    'model' => $comment,
]);?>
<?php if(Yii::$app->session->hasFlash('commentSubmitted')): ?>
            <div class="flash-success">
                <?php echo Yii::$app->session->getFlash('commentSubmitted'); ?>
            </div>
        <?php else: ?>
            <?php /*$this->render('_form', array(
                'model' => $comments,
            ));*/ ?>
        <?php endif; ?>
    </div>

</div><!-- comments -->


