<?php
namespace funson86\blog\widgets;

use funson86\blog\models\BlogComment;
use yii\base\Widget;
use yii\helpers\Html;

class RecentComments extends Widget
{
    public $title;
    public $maxComments = 5;

    public function init()
    {
        parent::init();

        if ($this->title === null) {
            $this->title = 'title';
        }
    }

    public function run()
    {
        //$comments = Comment::find()->where(['status' => Comment::STATUS_ACTIVE])->orderBy(['create_time' => SORT_DESC])->limit($this->maxComments)->all();
        $comments = BlogComment::findRecentComments($this->maxComments);

        return $this->render('recentComments', [
            'title' => $this->title,
            'comments' => $comments,
        ]);
    }
}