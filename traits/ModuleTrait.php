<?php

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
