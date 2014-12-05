<?php
namespace funson86\blog\widgets;

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