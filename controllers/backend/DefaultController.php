<?php

namespace funson86\blog\controllers\backend;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
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

    public function actionIndex()
    {
        //if(!Yii::$app->user->can('readPost')) throw new HttpException(403, 'No Auth');

        return $this->render('index');
    }
}
