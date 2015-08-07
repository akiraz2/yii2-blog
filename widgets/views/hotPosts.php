<?php
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
