<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\widgets;

use Yii;
use akiraz2\blog\models\BlogTag;
use yii\base\Widget;
use yii\helpers\Html;

class TagCloud extends Widget
{
    public $title;
    public $maxTags = 20;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'title';
        }
    }

    public function run()
    {
        $tags = BlogTag::findTagWeights();
        $str = '';
        foreach($tags as $tag=>$weight)
        {
            $link = Html::a(Html::encode($tag), Yii::$app->getUrlManager()->createUrl(['blog/default/index','tag'=>$tag]));
            $str .= Html::tag('span', $link, [
                    'class'=>'tag',
                    'style'=>"font-size:{$weight}pt",
                ])."\n";
        }

        return $this->render('portal', [
            'title' => $this->title,
            'content' => $str,
        ]);
    }
}