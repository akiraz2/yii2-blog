<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
?>

<div class="post">
    <div class="title">
        <?= Html::a(Html::encode($data->title), $data->url); ?>
    </div>
    <div class="nav">
        <i class="icon-date"></i><?= Yii::$app->formatter->asDate($data->created_at); ?>
        <i class="icon-edit"></i><?= 'By ' . $data->user->username; ?>
        <i class="icon-cat"></i><?= '<a href="'. Yii::$app->getUrlManager()->createUrl(['/blog/default/catalog/', 'id'=>$data->catalog->id, 'surname'=>$data->catalog->surname]) .'">' . $data->catalog->title . '</a>'; ?>
        <i class="icon-comment"></i><?= Html::a("评论{$data->commentsCount}条", $data->url.'#comments'); ?>
        <i class="icon-smiley"></i>阅读<?= $data->click; ?>次
    </div>
    <div class="content">
        <?php
        $parser = new \cebe\markdown\GithubMarkdown();
        echo $parser->parse($data->content);
        ?>
    </div>
    <span class="tag"><i class="icon-views"></i><?= implode(' ', $data->tagLinks); ?> <?= '<a href="'. Yii::$app->getUrlManager()->createUrl(['/blog/default/catalog/', 'id'=>$data->catalog->id, 'surname'=>$data->catalog->surname]) .'">' . $data->catalog->title . '</a>'; ?></span>
    <span class="more"><?= Html::a('阅读全文', $data->url, array('target'=>'_blank', 'title'=>Html::encode($data->title))); ?></span>
    <div class="clear"></div>
</div>