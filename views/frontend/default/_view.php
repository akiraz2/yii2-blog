<?php
use yii\helpers\Html;
use yii\helpers\StringHelper;
?>


<div class="post">
    <div class="title">
        <?php echo Html::a(Html::encode($data->title), $data->url); ?>
    </div>
    <div class="nav">
        <i class="icon-date"></i><?php echo substr($data->create_time, 0, 10); ?>
        <i class="icon-edit"></i><?php echo 'By ' . $data->user->username; ?>
        <i class="icon-cat"></i><?php echo '<a href="'. Yii::$app->getUrlManager()->createUrl(['/post/catalog/','id'=>$data->catalog->id]) .'">' . $data->catalog->title . '</a>'; ?>
        <i class="icon-comment"></i><?php echo Html::a("评论{$data->commentsCount}条",$data->url.'#comments'); ?>
        <i class="icon-smiley"></i>阅读<?php echo $data->click; ?>次
        <i class="icon-views"></i><?php echo implode(' ', $data->tagLinks); ?>
    </div>
    <div class="content">
        <?php
        $parser = new \cebe\markdown\GithubMarkdown();
        echo $parser->parse($data->content);
        ?>
    </div>
</div>