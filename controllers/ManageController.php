<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\controllers;

use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\BlogPostSearch;
use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ManageController extends Controller
{
    use ModuleTrait;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => !$this->getModule()->onlyAdmin,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = \Yii::createObject(['class' => BlogPostSearch::class, 'scenario' => 'owner',]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->byUser(Yii::$app->user->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new BlogPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = \Yii::createObject(BlogPost::class);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', Module::t('blog', 'Post has been created'));
            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing BlogPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', Module::t('blog', 'Post has been updated'));
            return $this->refresh();
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the BlogPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $post_class = Yii::$container->get(BlogPost::class);
        $post_model = $post_class::find()->byUser()->byId($id)->one();
        if ($post_model === null) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $post_model;
    }

    /**
     * Deletes an existing BlogPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->status != BlogPost::STATUS_DELETED) {
            $model->status = BlogPost::STATUS_DELETED;
            $model->save();
        } else {
            $model->delete();
        }
        return $this->redirect(['index']);
    }
}
