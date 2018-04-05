<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\widgets;

use yii\base\Widget;

class Search extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('search');
    }
}