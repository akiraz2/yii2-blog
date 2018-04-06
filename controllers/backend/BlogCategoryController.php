<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\controllers\backend;

use Yii;
use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\models\BlogCategorySearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * BlogCategoryController implements the CRUD actions for BlogCategory model.
 */
class BlogCategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all BlogCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        //if(!Yii::$app->user->can('readPost')) throw new HttpException(403, 'No Auth');

        $searchModel = new BlogCategorySearch();
        $dataProvider = BlogCategory::get(0, BlogCategory::find()->all());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        //if(!Yii::$app->user->can('readPost')) throw new HttpException(401, 'No Auth');
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //if(!Yii::$app->user->can('createPost')) throw new HttpException(401, 'No Auth');

        $model = new BlogCategory();
        $model->loadDefaultValues();

        if(isset($_GET['parent_id']) && $_GET['parent_id'] > 0)
        $model->parent_id = $_GET['parent_id'];

        if ($model->load(Yii::$app->request->post())) {
            $model->banner = UploadedFile::getInstance($model, 'banner');
            if ($model->validate()) {
                if ($model->banner) {
                    $bannerName = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->banner->extension;
                    $model->banner->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $bannerName);
                    $model->banner = $bannerName;
                }
                $model->save(false);

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BlogCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //if(!Yii::$app->user->can('updatePost')) throw new HttpException(401, 'No Auth');

        $model = $this->findModel($id);
        $oldBanner = $model->banner;

        if ($model->load(Yii::$app->request->post())) {
            $model->banner = UploadedFile::getInstance($model, 'banner');
            if ($model->validate()) {
                if($model->banner){
                    $bannerName = Yii::$app->params['blogUploadPath'] . date('Ymdhis') . rand(1000, 9999) . '.' . $model->banner->extension;
                    $model->banner->saveAs(Yii::getAlias('@frontend/web') . DIRECTORY_SEPARATOR . $bannerName);
                    $model->banner = $bannerName;
                } else {
                    $model->banner = $oldBanner;
                }

                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BlogCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //if(!Yii::$app->user->can('deletePost')) throw new HttpException(401, 'No Auth');

        $this->findModel($id)->delete();
        //$model = $this->findModel($id);
        //$model->status = BlogCategory::STATUS_DELETED;
        //$model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*protected function getAllTemplates()
    {
        $arrayTpl = FileHelper::findFiles(dirname(Yii::$app->BasePath).'/frontend/themes/'.Yii::$app->params['template'].'/',['fileTypes'=>['php']]);
        $arrTpl = ['page' => [], 'list' => [], 'show' =>[]];
        foreach($arrayTpl as $tpl)
        {
            $tplName = substr(pathinfo($tpl, PATHINFO_BASENAME), 0, strpos(pathinfo($tpl, PATHINFO_BASENAME), '.'));
            if(strpos($tplName, 'post') !== false)
                $arrTpl['page'][$tplName] = $tplName;
            elseif(strpos($tplName, 'list') !== false)
                $arrTpl['list'][$tplName] = $tplName;
            elseif(strpos($tplName, 'show') !== false)
                $arrTpl['show'][$tplName] = $tplName;
        }

        return $arrTpl;
    }*/

}
