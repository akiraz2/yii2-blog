<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use yii\helpers\Html;

?>
<div class="portlet">
    <div class="portlet-decoration">
        <div class="portlet-title"><?= $title ?></div>
    </div>
    <div class="portlet-content">
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li><strong><?php echo $comment->authorLink; ?></strong> 评论了
                    <?php echo Html::a(Html::encode($comment->post->title), $comment->getUrl()); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
