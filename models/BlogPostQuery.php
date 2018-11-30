<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\models;

use akiraz2\blog\components\AdvancedActiveQuery;
use akiraz2\blog\traits\IActiveStatus;

/**
 * This is the ActiveQuery class for [[BlogPost]].
 *
 * @see BlogPost
 */
class BlogPostQuery extends AdvancedActiveQuery
{
    public function init()
    {
        $this->addOrderBy(['created_at' => SORT_DESC]);
        parent::init();
    }

    public function lang($code = null)
    {
        if ($code === null) {
            $code = \Yii::$app->language;
        }
        return $this->byField('lang', $code);
    }

    /**
     * @return $this
     */
    public function published()
    {
        return $this->byField('status', BlogPost::STATUS_PUBLISHED);
    }

    public function byId($id)
    {
        return $this->byField('id', $id);
    }

    /**
     * @param $user_id
     *
     * @return $this
     */
    public function byUser($user_id = null)
    {
        if ($user_id === null) {
            $user_id = \Yii::$app->user->id;
        }
        return $this->byField('user_id', $user_id);
    }

    public function withCategoryName()
    {
        return $this->addSelect(['{{%blog_post}}.*', '{{%blog_category}}.title as categoryName'])
            ->joinWith('category', false, 'INNER JOIN');
    }

    public function withCommentCount()
    {
        return $this->addSelect(['{{%blog_post}}.*', 'COUNT({{%blog_comment}}.id) as commentsCount'])
            ->joinWith('comments', false, 'LEFT JOIN')
            ->addGroupBy(['{{%blog_comment}}.post_id', '{{%blog_post}}.id']);
    }

    public function withCategoryStatusActive()
    {
        return $this->withCategoryStatus(BlogCategory::STATUS_ACTIVE);
    }

    /**
     * @param $status
     *
     * @return $this
     */
    public function withCategoryStatus($status)
    {
        return $this->joinWith(
            [
                'category' => function (BlogCategoryQuery $query) use ($status) {
                    $query->byStatus($status);
                },
            ],
            false,
            'INNER JOIN'
        );
    }

    /**
     * @inheritdoc
     * @return BlogPost[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BlogPost|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
