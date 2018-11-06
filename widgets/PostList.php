<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\widgets;

use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\Status;
use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use yii\base\Widget;
use yii\db\Expression;

class PostList extends Widget
{
    const TYPE_RANDOM = 'random';
    const TYPE_POPULAR = 'hot';
    const TYPE_RECENT = 'recent';

    public $title;
    public $maxPosts = 6;
    public $type;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = Module::t('blog', 'Blog Posts');
        }
    }

    public function run()
    {
        $posts = BlogPost::find()->where(['status' => IActiveStatus::STATUS_ACTIVE])->orderBy($this->getOrderFromType())->limit($this->maxPosts)->all();

        return $this->render('post-list', [
            'title' => $this->title,
            'posts' => $posts,
        ]);
    }

    protected function getOrderFromType()
    {
        switch ($this->type) {
            case self::TYPE_RANDOM:
                return new Expression('rand()');
            case self::TYPE_RECENT:
                return ['created_at' => SORT_DESC];
            case self::TYPE_POPULAR:
                return ['click' => SORT_DESC];
            default:
                return [];
        }
    }
}