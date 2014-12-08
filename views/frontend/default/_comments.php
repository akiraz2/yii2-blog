<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\markdown\Markdown;
?>

<?php foreach($comments as $comment){ ?>
    <div class="comment" id="c<?= $comment->id; ?>">

        <div class="author">
            <?= Html::a("#{$comment->id}", $comment->getUrl($post), array(
                'class'=>'cid',
                'title'=>'Permalink to this comment',
            )); ?>
            <?= $comment->authorLink; ?>&nbsp;<span><?= Yii::$app->formatter->asDate($comment->created_at); ?>
        </div>

        <div class="content">
            <?= nl2br(Html::encode($comment->content)); ?>
        </div>

    </div><!-- comment -->
<?php } ?>
