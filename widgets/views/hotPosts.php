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
            <?php foreach($posts as $post): ?>
                <li>
                    <?php echo Html::a(Html::encode($post->title), $post->getUrl()); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
