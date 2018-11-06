<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\controllers;

use yii\web\Controller;
use yii\web\Response;

class UploadController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function init()
    {
        parent::init();
        $this->module = \Yii::$app->getModule(\Yii::$app->getModule('blog')->redactorModule);
        $this->attachBehavior('content', [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ],
        ]);
    }

    public function actions()
    {
        return [
            'file' => 'yii\redactor\actions\FileUploadAction',
            'image' => 'yii\redactor\actions\ImageUploadAction',
            'image-json' => 'yii\redactor\actions\ImageManagerJsonAction',
            'file-json' => 'yii\redactor\actions\FileManagerJsonAction',
        ];
    }
}
