<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\markdown\Markdown;
?>

<?php foreach($comments as $comment){ ?>
    <div class="comment" id="c<?php echo $comment->id; ?>">

        <div class="author">
            <?php echo Html::a("#{$comment->id}", $comment->getUrl($post), array(
                'class'=>'cid',
                'title'=>'Permalink to this comment',
            )); ?>
            <?php echo $comment->authorLink; ?>&nbsp;<span><?php echo $comment->create_time; ?></span>
        </div>

        <div class="content">
            <?php echo nl2br(Html::encode($comment->content)); ?>
        </div>

    </div><!-- comment -->
<?php } ?>
