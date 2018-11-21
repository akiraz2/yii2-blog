<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog;

use akiraz2\blog\traits\ModuleTrait;
use yii\base\BootstrapInterface;
use yii\console\Application as ConsoleApp;
use yii\i18n\PhpMessageSource;

/**
 * Blogs module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if (!$app->hasModule('blog')) {
            $app->setModule('blog', [
                'class' => 'akiraz2\blog\Module',
            ]);
        }

        if ($app instanceof ConsoleApp) {
            $app->controllerMap['migrate-blog'] = [
                'class' => 'yii\console\controllers\MigrateController',
                'migrationPath' => null,
                'migrationTable' => 'migration_blog',
                'migrationNamespaces' => [
                    'akiraz2\blog\migrations',
                ],
            ];
        }
        // Add module URL rules.
        $app->getUrlManager()->addRules(
            [
                '<_m:blog>/cat/<category_id:\d+>-<slug:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/default/index',
                '<_m:blog>/<id:\d+>-<slug:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/default/view',
                '<_m:blog>' => '<_m>/default/index',
            ]
        );

        // Add module I18N category.
        if (!isset($app->i18n->translations['akiraz2/blog'])) {
            $app->i18n->translations['akiraz2/blog'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'akiraz2/blog' => 'blog.php',
                ]
            ];
        }

        // Add redactor module if not exist (in my case - only in backend)
        $redactorModule = $this->getModule()->redactorModule;
        if (!($app instanceof ConsoleApp)) {
            if (!$app->hasModule($redactorModule)) {
                $app->setModule($redactorModule, [
                    'class' => 'yii\redactor\RedactorModule',
                    'imageUploadRoute' => ['/blog/upload/image'],
                    'uploadDir' => $this->getModule()->imgFilePath . '/upload/',
                    'uploadUrl' => $this->getModule()->getImgFullPathUrl() . '/upload',
                    'imageAllowExtensions' => ['jpg', 'png', 'gif', 'svg']
                ]);
            }
            if(!$app->has('imagemanager')) {
                $app->set('imagemanager', [
                    'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
                    //set media path (outside the web folder is possible)
                    'mediaPath' => '@app/media/imagemanager',
                    //path relative web folder. In case of multiple environments (frontend, backend) add more paths
                    'cachePath' => ['assets/images'],
                    //use filename (seo friendly) for resized images else use a hash
                    'useFilename' => true,
                    //show full url (for example in case of a API)
                    'absoluteUrl' => false,
                    'databaseComponent' => 'db' // The used database component by the image manager, this defaults to the Yii::$app->db component
                ]);
            }
            if (!$app->hasModule('imagemanager')) {
                $app->setModule('imagemanager', [
                    'class' => 'noam148\imagemanager\Module',
                    //set accces rules ()
                    'canUploadImage' => true,
                    'canRemoveImage' => function(){
                        return true;
                    },
                    'deleteOriginalAfterEdit' => false, // false: keep original image after edit. true: delete original image after edit
                    // Set if blameable behavior is used, if it is, callable function can also be used
                    'setBlameableBehavior' => false,
                    //add css files (to use in media manage selector iframe)
                    'cssFiles' => [
                        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
                    ],
                ]);
            }
        }
        \Yii::setAlias('@akiraz2', \Yii::getAlias('@vendor') . '/akiraz2');
    }
}
