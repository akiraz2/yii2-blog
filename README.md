Yii2 Blog
=========
Yii2 Blog for other application, cloned from https://github.com/funson86/yii2-blog



Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist akiraz2/yii2-blog "dev-master"
```

or add

```
"akiraz2/yii2-blog": "*"
```

to the require section of your `composer.json` file.



### Migration

Migration run

```php
yii migrate --migrationPath=@akiraz2/blog/migrations
```

### Config url rewrite in /common/config/main.php
```php
    'timeZone' => 'Europe/Moscow', //time zone affect the formatter datetime format
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'formatter' => [ //for the showing of date datetime
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RUB',
        ],
    ],
```

### Config backend modules in backend/config/main.php

```php
    'modules' => [
        'blog' => [
            'class' => 'akiraz2\blog\Module',
            'controllerNamespace' => 'akiraz2\blog\controllers\backend'
        ],
    ],
```

### Config frontend modules in frontend/config/main.php

```php
    'defaultRoute' => 'blog', //set blog as default route
    'modules' => [
        'blog' => [
            'class' => 'akiraz2\blog\Module',
            'controllerNamespace' => 'akiraz2\blog\controllers\frontend'
        ],
    ],
```

### Add yii2-blog params in /common/config/params.php.
```php
return [
    'blogTitle' => 'SimpleBlog',
    'blogTitleSeo' => 'Simple Blog based on Yii2',
    'blogFooter' => 'Copyright &copy; ' . date('Y') . ' by akiraz on Yii2. All Rights Reserved.',
    'blogPostPageCount' => '10',
    'blogLinks' => [
        'Google' => 'http://www.google.com',
        'akiraz2 Blog' => 'http://github.com/akiraz2/yii2-blog',
    ],
    'blogUploadPath' => '/img/blog/upload/', //default to frontend/web/upload
];
```

### Access Url
1. backend : http://backend.you-domain/blog
   - Category : http://backend.you-domain/blog/blog-category
   - Post : http://backend.you-domain/blog/blog-post
   - Comment : http://backend.you-domain/blog/blog-comment
   - Tag : http://backend.you-domain/blog/blog-tag
2. frontend : http://you-domain/blog
