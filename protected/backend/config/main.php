<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
$backend = dirname(dirname(__FILE__));
$frontend = dirname($backend);
Yii::setPathOfAlias('backend', $backend);
Yii::setPathOfAlias('frontend', $frontend);
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>$frontend,
	'name'=>'Hikecms',
	'language' => 'zh_cn',
	'timeZone'=>'Asia/Chongqing',
	'controllerPath' => $backend . '/controllers',
	'viewPath' => $backend . '/views',
	'runtimePath' => $backend . '/runtime',

	// preloading 'log' component
	'preload'=>array('log', 'bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'backend.models.*',
		'backend.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),


		'backup' => array(
			'class' => 'backend.modules.backup.BackupModule',
			'path' => $backend .'/../_backup/',
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=hikecms',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'tablePrefix' => 'hike_',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),

		'cache'=>array(
			'class'=>'system.caching.CFileCache',
		),
		'settings'=>array(
			'class'                 => 'CmsSettings',
			'cacheComponentId'  => 'cache',
			'cacheId'           => 'global_website_settings',
			'cacheTime'         => 84000,
			'tableName'     => '{{settings}}',
			'dbComponentId'     => 'db',
			'createTable'       => true,
			'dbEngine'      => 'InnoDB',
		),
		'file'=>array(
			'class'=>'application.extensions.file.CFile',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);