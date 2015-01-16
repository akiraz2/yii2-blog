Yii2 Blog
=========
Yii2 Blog for other application, especially for [Yii2 Adminlte](https://github.com/funson86/yii2-adminlte)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist funson86/yii2-blog "dev-master"
```

or add

```
"funson86/yii2-blog": "*"
```

to the require section of your `composer.json` file.



### Migration

Migration run

```php
yii migrate --migrationPath=@funson86/blog/migrations
```

### Config url rewrite in /common/config/main.php
```php
    'timeZone' => 'Asia/Shanghai', //time zone affect the formatter datetime format
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
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],
    ],
```

### Config backend modules in backend/config/main.php

```php
    'modules' => [
        'blog' => [
            'class' => 'funson86\blog\Module',
            'controllerNamespace' => 'funson86\blog\controllers\backend'
        ],
    ],
```

### Config frontend modules in frontend/config/main.php

```php
    'defaultRoute' => 'blog', //set blog as default route
    'modules' => [
        'blog' => [
            'class' => 'funson86\blog\Module',
            'controllerNamespace' => 'funson86\blog\controllers\frontend'
        ],
    ],
```

### Add yii2-blog params in /common/config/params.php.
```php
return [
    'blogTitle' => 'HikeBlog',
    'blogTitleSeo' => 'Simple Blog based on Yii2',
    'blogFooter' => 'Copyright &copy; ' . date('Y') . ' by ahuasheng on Yii2. All Rights Reserved.',
    'blogPostPageCount' => '10',
    'blogLinks' => [
        'Google' => 'http://www.google.com',
        'Funson86 Blog' => 'http://github.com/funson86/yii2-blog',
    ],
    'blogUploadPath' => 'upload/', //default to frontend/web/upload
];
```

### Access Url
1. backend : http://you-domain/backend/web/blog
   - Catalog : http://you-domain/backend/web/blog/blog-catalog
   - Post : http://you-domain/backend/web/blog/blog-post
   - Comment : http://you-domain/backend/web/blog/blog-comment
   - Tag : http://you-domain/backend/web/blog/blog-tag
2. frontend : http://you-domain/fontend/web/blog
