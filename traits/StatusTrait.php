<?php

/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\traits;

use akiraz2\blog\Module;

trait StatusTrait
{
    public static function getStatusList()
    {
        return [
            self::STATUS_INACTIVE => Module::t('blog', 'InActive'),
            self::STATUS_ACTIVE => Module::t('blog', 'Active'),
            self::STATUS_ARCHIVE => Module::t('blog', 'Archive')
        ];
    }

    public function getStatusList2()
    {
        return self::getStatusList();
    }

    public function getStatus($nullLabel = '')
    {
        $statuses = static::getStatusList();
        return (isset($this->status) && isset($statuses[$this->status])) ? $statuses[$this->status] : $nullLabel;
    }
}
