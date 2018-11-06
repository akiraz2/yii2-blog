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

trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('blog');
    }

}
