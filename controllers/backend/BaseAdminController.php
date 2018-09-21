<?php
/**
 * Copyright (c) 2018
 * cms Smetana
 * project: alt-money
 *
 */

namespace akiraz2\blog\controllers\backend;

use akiraz2\blog\traits\ModuleTrait;
use dektrium\user\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BaseAdminController extends Controller
{

    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ]
        ];
    }

    public function init()
    {
        if ($this->module->adminAccessControl) {
            $this->attachBehavior('access', [
                'class' => $this->module->adminAccessControl,
            ]);
        }

        parent::init();
    }
}
