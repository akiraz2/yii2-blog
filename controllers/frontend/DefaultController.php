<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\controllers\frontend;

use akiraz2\blog\models\BlogPostSearch;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\BlogComment;
use akiraz2\blog\models\Status;
use akiraz2\blog\models\BlogTag;
use yii\widgets\ActiveForm;

class DefaultController extends Controller
{
    use ModuleTrait;

    public $mainMenu = [];
    //public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            //menu
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $rootId = ($id>0) ? BlogCategory::getRootCategoryId($id, BlogCategory::find()->all()) : 0;
            $allCategory = BlogCategory::findAll([
                'parent_id' => 0
            ]);
            foreach($allCategory as $category)
            {
                $item = ['label'=>$category->title, 'active'=>($category->id == $rootId)];
                if($category->redirect_url)
                {// redirect to other site
                    $item['url'] = $category->redirect_url;
                }
                else
                {
                    $item['url'] = Yii::$app->getUrlManager()->createUrl(['/blog/default/category/','id'=>$category->id, 'slug'=>$category->slug]);
                }

                if(!empty($item))
                    array_push($this->mainMenu, $item);
            }
            Yii::$app->params['mainMenu'] = $this->mainMenu;

            return true;  // or false if needed
        } else {
            return false;
        }
    }

    public function actionIndex()
    {
        $searchModel = new BlogPostSearch();
        $searchModel->scenario= BlogPostSearch::SCENARIO_USER;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $categories = BlogCategory::find()->where(['status' => IActiveStatus::STATUS_ACTIVE, 'is_nav' => BlogCategory::IS_NAV_YES])
            ->orderBy(['sort_order' => SORT_ASC])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories
        ]);
    }

    public function actionCategory()
    {
        if(Yii::$app->request->get('id') && Yii::$app->request->get('id') > 0)
        {
            $query = BlogPost::find();
            $query->where([
                'status' => Status::STATUS_ACTIVE,
                'category_id' => Yii::$app->request->get('id'),
            ]);
        }
        else
            $this->redirect(['blog/index']);

        if(Yii::$app->request->get('tag'))
            $query->andFilterWhere([
                'tags' => Yii::$app->request->get('tag'),
            ]);

        if(Yii::$app->request->get('keyword'))
        {
            //$keyword = '%'.strtr(Yii::$app->request->get('keyword'), array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%';
            $keyword = Yii::$app->request->get('keyword');

            $query->andFilterWhere([
                'title' => $keyword,
            ]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => Yii::$app->params['blogPostPageCount'],
            'totalCount' => $query->count(),
        ]);

        $posts = $query->orderBy('created_at desc')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
    }

    public function actionView()
    {
        if(Yii::$app->request->get('id') && Yii::$app->request->get('id') > 0)
        {
            $post = BlogPost::findOne(Yii::$app->request->get('id'));
            $post->updateCounters(['click' => 1]);
            $comments = BlogComment::find()->where(['post_id' => $post->id, 'status' => Status::STATUS_ACTIVE])->orderBy(['created_at' => SORT_ASC])->all();
            $comment = $this->newComment($post);
        }
        else
            $this->redirect(['blog']);

        //var_dump($post->comments);
        return $this->render('view', [
            'post' => $post,
            'comments' => $comments,
            'comment' => $comment,
        ]);
    }

    protected function newComment($post)
    {
        $comment = new BlogComment;
        if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
        {
            echo ActiveForm::validate($comment);
            Yii::app()->end();
        }

        if(Yii::$app->request->post('BlogComment'))
        {
            $comment->load(Yii::$app->request->post());
            if($post->addComment($comment))
            {
                if($comment->status == Status::STATUS_INACTIVE)
                    echo Yii::$app->formatter->asText('success');
            }
            else
            {
                echo 'failed';
            }
            die();
        }
        return $comment;
    }

}
