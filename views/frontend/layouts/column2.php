<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="span-19">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span-5 last">
        <div id="sidebar">

            <?php $this->widget('TagCloud', array(
                'maxTags'=>Yii::app()->params['recentCommentCount'],
            )); ?>

            <?php $this->widget('RecentComments', array(
                'maxComments'=>Yii::app()->params['recentCommentCount'],
            )); ?>

            <?php $this->widget('RecentPosts', array(
                'maxPosts'=>Yii::app()->params['recentPostCount'],
            )); ?>

            <?php $this->widget('Links', array(
                'links'=>Yii::app()->params['linksFriend'],
            )); ?>

            <?php $this->widget('Links', array(
                'links'=>Yii::app()->params['linksTools'],
            )); ?>

            <?php $this->widget('SiteStat'); ?>
        </div>
    </div>
<?php $this->endContent(); ?>