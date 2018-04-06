<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\controllers\backend;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends BaseAdminController
{
    public function actionIndex()
    {
        //if(!Yii::$app->user->can('readPost')) throw new HttpException(403, 'No Auth');

        return $this->render('index');
    }
}
