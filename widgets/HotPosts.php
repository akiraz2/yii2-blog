<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\widgets;

use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\Status;
use yii\base\Widget;
use yii\helpers\Html;

class HotPosts extends Widget
{
    public $title;
    public $maxPosts = 5;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'title';
        }
    }

    public function run()
    {
        $posts = BlogPost::find()->where(['status' => Status::STATUS_ACTIVE])->orderBy(['click' => SORT_DESC])->limit($this->maxPosts)->all();

        return $this->render('recentPosts', [
            'title' => $this->title,
            'posts' => $posts,
        ]);
    }
}
