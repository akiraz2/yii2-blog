<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

/**
 * Common Status Class
 * User: akiraz2
 * Date: 2014/06/25
 * Time: 9:50
 */

namespace akiraz2\blog\models;

use akiraz2\blog\Module;

/**
 * Class Status
 * @package akiraz2\blog\models
 */
class Status
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = -1;

    public $id;
    public $label;

    public function __construct($id = null)
    {
        if ($id !== null) {
            $this->id = $id;
            $this->label = $this->getLabel($id);
        }
    }

    public static function labels()
    {
        return [
            self::STATUS_ACTIVE => Module::t('blog', 'STATUS_ACTIVE'),
            self::STATUS_INACTIVE => Module::t('blog', 'STATUS_INACTIVE'),
            self::STATUS_DELETED => Module::t('blog', 'STATUS_DELETED'),
        ];
    }

    public function getLabel($id)
    {
        $labels = self::labels();
        return isset($labels[$id]) ? $labels[$id] : null;
    }

}
