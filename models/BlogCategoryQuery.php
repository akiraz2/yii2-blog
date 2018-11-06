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

/**
 * This is the ActiveQuery class for [[BlogCategory]].
 *
 * @see BlogCategory
 */
class BlogCategoryQuery extends AdvancedActiveQuery
{
    public function init()
    {
        $this->addOrderBy(['sort_order' => SORT_ASC]);
        parent::init();
    }

    public function lang($code = null)
    {
        if ($code === null) {
            $code = \Yii::$app->language;
        }
        return $this->byField('lang', $code);
    }

    public function active()
    {
        return $this->byStatus(BlogCategory::STATUS_ACTIVE);
    }

    public function byStatus($status)
    {
        return $this->byField('status', $status);
    }

    public function isNavYes()
    {
        return $this->isNav(BlogCategory::IS_NAV_YES);
    }

    public function isNav($state)
    {
        return $this->byField('is_nav', $state);
    }

    /**
     * @inheritdoc
     * @return BlogCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BlogCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
