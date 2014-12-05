<?php

namespace funson86\blog\controllers\frontend;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use funson86\blog\models\BlogCatalog;
use funson86\blog\models\BlogPost;
use funson86\blog\models\BlogComment;
use funson86\blog\models\BlogTag;
use yii\widgets\ActiveForm;

class DefaultController extends Controller
{
    public $mainMenu = [];
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            //menu
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $rootId = ($id>0) ? BlogCatalog::getRootCatalogId($id, BlogCatalog::find()->all()) : 0;
            $allCatalog = BlogCatalog::findAll([
                'parent_id' => 0
            ]);
            foreach($allCatalog as $catalog)
            {
                $item=array();
                if($catalog->redirect_url)
                {// redirect to other site
                    $item=array('label'=>$catalog->title, 'url'=>$catalog->redirect_url, 'active'=>($catalog->id==$rootId));
                }
                else
                {
                    $item=array('label'=>$catalog->title, 'url'=>array('/blog/catalog/','id'=>$catalog->id, 'surname'=>$catalog->surname), 'active'=>($catalog->id==$rootId));
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
        $query = BlogPost::find();
        $query->where([
            'status' => BlogPost::STATUS_ACTIVE,
        ]);

        if(Yii::$app->request->get('tag'))
            $query->andFilterWhere([
                'tags' => Yii::$app->request->get('tag'),
            ]);

        if(Yii::$app->request->get('keyword'))
        {
            $keyword = strtr(Yii::$app->request->get('keyword'), array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\'));
            $keyword = Yii::$app->formatter->asText($keyword);
            echo $keyword;

            $query->andFilterWhere([
                'or', ['like', 'title', $keyword], ['like', 'content', $keyword]
            ]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => Yii::$app->params['postPageCount'],
            'totalCount' => $query->count(),
        ]);

        $posts = $query->orderBy('create_time desc')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
    }

    public function actionCatalog()
    {
        if(Yii::$app->request->get('id') && Yii::$app->request->get('id') > 0)
        {
            $query = BlogPost::find();
            $query->where([
                'status' => BlogPost::STATUS_ACTIVE,
                'catalog_id' => Yii::$app->request->get('id'),
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
            'defaultPageSize' => Yii::$app->params['postPageCount'],
            'totalCount' => $query->count(),
        ]);

        $posts = $query->orderBy('create_time desc')
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
            $comment = $this->newComment($post);
        }
        else
            $this->redirect(['blog/index']);

        //var_dump($post->comments);
        return $this->render('view', [
            'post' => $post,
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
        if(isset($_POST['Comment']))
        {
            $comment->attributes = $_POST['Comment'];
            if($post->addComment($comment))
            {
                if($comment->status==CONSTANT::STATUS_INACTIVE)
                    Yii::$app->session->setFlash('commentSubmitted', Yii::t('blog', 'Thanks for comment'));
                $this->refresh();
            }
        }
        return $comment;
    }

}
