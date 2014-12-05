<?php
namespace funson86\blog\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Links extends Widget
{
    public $title;
    public $links;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'title';
        }
    }

    public function run()
    {
        $str = '';
        foreach($this->links as $title=>$url)
        {
            $link = Html::a(Html::encode($title), $url, ['target' => '_blank']);
            $str .= Html::tag('div', $link, [
                    'class' => 'links',
                ])."\n";
        }

        return $this->render('portal', [
            'title' => $this->title,
            'content' => $str,
        ]);
    }
}