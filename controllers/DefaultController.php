<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\controllers;

use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\models\BlogComment;
use akiraz2\blog\models\BlogCommentSearch;
use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\BlogPostSearch;
use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'lesha724\MathCaptcha\MathCaptchaAction',
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BlogPostSearch();
        $searchModel->scenario = BlogPostSearch::SCENARIO_USER;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories = BlogCategory::find()->active()->isNavYes()->addOrderBy(['sort_order' => SORT_ASC])->all();
        $catItems = ArrayHelper::toArray($categories, [
            'akiraz2\blog\models\BlogCategory' => [
                'label' => 'title',
                'url' => function ($cat) {
                    return ['default/index', 'category_id' => $cat->id, 'slug' => $cat->title];
                },
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'catItems' => $catItems
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $post = BlogPost::find()->withCategoryName()
            ->published()->byId($id)->one();
        if ($post === null) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        $post->updateCounters(['click' => 1]);

        $searchModel = new BlogCommentSearch();
        $searchModel->scenario = BlogComment::SCENARIO_USER;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        $comment = new BlogComment();
        $comment->scenario = BlogComment::SCENARIO_USER;

        if ($comment->load(Yii::$app->request->post()) && $post->addComment($comment)) {
            Yii::$app->session->setFlash('success', Module::t('blog', 'A comment has been added and is awaiting validation'));
            return $this->redirect(['view', 'id' => $post->id, '#' => $comment->id]);
        }

        return $this->render('view', [
            'post' => $post,
            'dataProvider' => $dataProvider,
            'comment' => $comment,
        ]);
    }
}
