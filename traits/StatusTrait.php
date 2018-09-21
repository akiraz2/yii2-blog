<?php

/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\traits;

use akiraz2\blog\Module;

interface IActiveStatus
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_ARCHIVE = -1;
}

trait StatusTrait
{
    public static function getStatusList()
    {
        return [
            IActiveStatus::STATUS_INACTIVE => Module::t('blog', 'STATUS_INACTIVE'),
            IActiveStatus::STATUS_ACTIVE => Module::t('blog', 'STATUS_ACTIVE'),
            IActiveStatus::STATUS_ARCHIVE => Module::t('blog', 'STATUS_DELETED')
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
