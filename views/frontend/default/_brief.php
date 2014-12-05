<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\markdown\Markdown;
?>

<div class="post">
    <div class="title">
        <?php echo Html::a(Html::encode($data->title), $data->url); ?>
    </div>
    <div class="nav">
        <i class="icon-date"></i><?php echo substr($data->create_time, 0, 10); ?>
        <i class="icon-edit"></i><?php echo 'By ' . $data->user->username; ?>
        <i class="icon-cat"></i><?php echo '<a href="'. Yii::$app->getUrlManager()->createUrl(['/blog/default/catalog/', 'id'=>$data->catalog->id, 'surname'=>$data->catalog->surname]) .'">' . $data->catalog->title . '</a>'; ?>
        <i class="icon-comment"></i><?php echo Html::a("评论{$data->commentsCount}条", $data->url.'#comments'); ?>
        <i class="icon-smiley"></i>阅读<?php echo $data->click; ?>次
    </div>
    <div class="content">
        <?php
        $parser = new \cebe\markdown\GithubMarkdown();
        echo $parser->parse($data->content);
        ?>
    </div>
    <span class="tag"><i class="icon-views"></i><?php echo implode(' ', $data->tagLinks); ?> <?php echo '<a href="'. Yii::$app->getUrlManager()->createUrl(['/blog/default/catalog/', 'id'=>$data->catalog->id, 'surname'=>$data->catalog->surname]) .'">' . $data->catalog->title . '</a>'; ?></span>
    <span class="more"><?php echo Html::a('阅读全文', $data->url, array('target'=>'_blank', 'title'=>Html::encode($data->title))); ?></span>
    <div class="clear"></div>
</div>