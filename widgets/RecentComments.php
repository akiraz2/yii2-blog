<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\widgets;

use akiraz2\blog\models\BlogComment;
use yii\base\Widget;

class RecentComments extends Widget
{
    public $title;
    public $maxComments = 5;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'title';
        }
    }

    public function run()
    {
        //$comments = Comment::find()->where(['status' => Comment::STATUS_ACTIVE])->orderBy(['create_time' => SORT_DESC])->limit($this->maxComments)->all();
        $comments = BlogComment::findRecentComments($this->maxComments);

        return $this->render('recentComments', [
            'title' => $this->title,
            'comments' => $comments,
        ]);
    }
}