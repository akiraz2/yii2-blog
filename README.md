# Yii2 Super Blog [![Packagist Version](https://img.shields.io/packagist/v/akiraz2/yii2-blog.svg?style=flat-square)](https://packagist.org/packages/akiraz2/yii2-blog) [![Total Downloads](https://img.shields.io/packagist/dt/akiraz2/yii2-blog.svg?style=flat-square)](https://packagist.org/packages/akiraz2/yii2-blog) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Yii2 Super Blog is simple, configured yii2 Module with frontend and backend, cloned from unmaintained repo 
[funson86/yii2-blog](https://github.com/funson86/yii2-blog),
 fully reorganized and improved.


## Features:

* Blog Post with image banner, **seo** tags, [imperavi redactor 2 widget](https://github.com/yiidoc/yii2-redactor)
* Blog Category (nested) with image banner, seo tags
* Blog Tags
* Blog Comment (can be disabled), with [Math captcha](https://github.com/lesha724/yii2-math-captcha) (can be standard yii2-captcha OR [ReCaptcha2](https://packagist.org/packages/himiklab/yii2-recaptcha-widget))
* email in comments are masked (`a*i*a*@bk.ru`)
* all models has Status (_Inactive_, _Active_, _Archive_)
* Inactive comments are truncated (and strip tags)
* also added **semantic** [OpenGraph](http://ogp.me/)
 (via yii2 component [dragonjet/yii2-opengraph](https://packagist.org/packages/dragonjet/yii2-opengraph)),
  [Schema.org](http://schema.org/Article)
* backendControllers can be **protected** by your CustomAccessControl (roles or rbac)
* frontend and backend are translated (i18n)
* url rules with slug (for seo)

> **NOTE:** Module is in initial development. Anything may change at any time.


# Table of Contents
1. [Installation](#installation)
2. [Configuration](#configuration)
3. [Usage](#usage)
4. [TODO](#todo)
5. [Support](#support)
6. [Contributing](#contributing)



## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist akiraz2/yii2-blog "dev-master"
```

or add

```
"akiraz2/yii2-blog": "dev-master"
```

to the require section of your `composer.json` file.

## Configuration

By default, all images from Imperavi-widget module are uploaded to dir `@frontend/web/img/blog/upload`.
Be sure, this directory is created manually with proper file permissions (chmod).

Config *common* modules in `common/config/main.php`

```php
    'modules' => [
        'blog' => [
            'class' => akiraz2\blog\Module::class,
            'urlManager' => 'urlManager',// 'urlManager' by default, or maybe you can use own component urlManagerFrontend
            'imgFilePath' => '@frontend/web/img/blog/',
            'imgFileUrl' => '/img/blog/',
            'userModel' => \common\models\User::class,
            'userPK' => 'id', //default primary key for {{%user}} table
            'userName' => 'username', //uses in view (may be field `username` or `email` or `login`)
        ],
     ],    
```

Config *url rewrite* in `common/config/main.php` (or separately frontend/backend apps)
```php
    'timeZone' => 'Europe/Moscow', //time zone affect the formatter datetime format
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [               
            ],
        ],
        'formatter' => [ //for the showing of date datetime
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
        ],
    ],
```

Config *backend modules* in `backend/config/main.php`

```php
    'modules' => [
        'blog' => [
            'class' => 'akiraz2\blog\Module',
            'controllerNamespace' => 'akiraz2\blog\controllers\backend',
            //'adminAccessControl' => 'common\components\AdminAccessControl', // null - by default 
        ],
    ],
```

Config *frontend modules* in `frontend/config/main.php`

```php
    //'defaultRoute' => 'blog', //set blog as default route
    'modules' => [
        'blog' => [
            'class' => 'akiraz2\blog\Module',
            'controllerNamespace' => 'akiraz2\blog\controllers\frontend',
            'blogPostPageCount' => 6,
            'blogCommentPageCount' => 10, //20 by default
            'enableComments' => true, //false by default
            'schemaOrg' => [ // empty array [] by default! 
                'publisher' => [
                    'logo' => '/img/logo.png',
                    'logoWidth' => 191,
                    'logoHeight' => 74,
                    'name' => 'My Company',
                    'phone' => '+1 800 488 80 85',
                    'address' => 'City, street, house'
                ]
            ]
        ],
    ],
```
> **NOTE:** Module Yii2-Blog use model `common\models\User`

### Migration

> **NOTE:** Module uses table `{{%user}}` with PK `id` (You can use [own user model](#user-model) with table and PK) Make sure you have table before applying these migrations.

Migration run after config module

```php
./yii migrate --migrationPath=@akiraz2/blog/migrations
```

or full path:

```php
./yii migrate --migrationPath=@vendor/akiraz2/yii2-blog/migrations
```


### Access Url
1. backend : http://backend.you-domain.com/blog (Empty view)
   - Category : http://backend.you-domain.com/blog/blog-category (create first category)
   - Post : http://backend.you-domain.com/blog/blog-post
   - Comment : http://backend.you-domain.com/blog/blog-comment
   - Tag : http://backend.you-domain.com/blog/blog-tag
2. frontend : http://you-domain.com/blog



## Usage

### Overriding views

When you start using Yii2-blog you will probably find that you need to override the default views provided by the module.
Although view names are not configurable, Yii2 provides a way to override views using themes. To get started you should
configure your view application component as follows:

```php
...
'components' => [
    'view' => [
        'theme' => [
            'pathMap' => [
                '@akiraz2/yii2-blog/views/frontend/default' => '@app/views/blog'
            ],
        ],
    ],
],
...
```

In the above `pathMap` means that every view in `@akiraz2/yii2-blog/views/frontend/default` will be first searched under `@app/views/blog` and
if a view exists in the theme directory it will be used instead of the original view.

> **NOTE:** Just copy all necessary views from `@akiraz2/yii2-blog/views/frontend/default` to `@app/views/blog` and change!


### User model

You can use own user model, but need configure it in config.php

 For example, 
 ```php  
'modules' => [
        'blog' => [
            'class' => akiraz2\blog\Module::class,            
            'userModel' => \common\models\User::class,
            'userPK' => 'id', //default primary key for {{%user}} table
            'userName' => 'username', //uses in view (may be field `username` or `email` or `login`)
        ],
     ],   
 ```
 
### Imperavi Redactor

**How to change upload path Imperavi Redactor widget**

Yii2 blog module use imperavi redactor 2 Module [https://github.com/yiidoc/yii2-redactor](https://github.com/yiidoc/yii2-redactor) with moduleName "redactorBlog".

> **NOTE:** Embedded Module `redactorBlog` use own UploadController with AccessControl! and only in Backend! and only you don`t override default config

If you want change default config, you should add redactor module manually

Config backend modules in backend/config/main.php
 
 ```php
     'modules' => [
         'blog' => [
             'class' => 'akiraz2\blog\Module',
             'controllerNamespace' => 'akiraz2\blog\controllers\backend',
             'redactorModule' => 'redactor' // 'redactorBlog' - default, maybe you want use standard module 'redactor' with own config
         ],
         'redactor' => [
             'class' => 'yii\redactor\RedactorModule',
             'uploadDir' => '@frontend/web/img/upload/',
             'uploadUrl' => $params['frontendHost'] . '/img/upload',
             'imageAllowExtensions' => ['jpg', 'png', 'gif', 'svg']
         ],
     ],
 ```


### CustomAdminAccessControl for backend

For example, using [dektrium/yii2-user](https://github.com/dektrium/yii2-user)

 ```php
    'modules' => [
         'blog' => [
             'class' => akiraz2\blog\Module::class,
             ...
             'adminAccessControl' => 'common\components\AdminAccessControl',  
             ...      
         ],
     ], 
 ```

Create file `common\components\AdminAccessControl.php`  

 ```php 
    namespace common\components;
    
    use yii\filters\AccessControl;
    
    class AdminAccessControl extends AccessControl
    {    
        public function init()
        {
            $this->rules[] =[
                'allow' => true,
                'roles' => ['@'],
                'matchCallback' => function () {
                    return \Yii::$app->user->identity->getIsAdmin();
                }
            ];
            parent::init();
        }
    }
 ```

### Opengraph

Please, add component [dragonjet/yii2-opengraph](https://packagist.org/packages/dragonjet/yii2-opengraph) to your project.
```
php composer.phar require --prefer-dist dragonjet/yii2-opengraph "dev-master"
```

Configuration `common/config/main.php` or `frontend/config/main.php`

  ```php
    'components' => [
        'opengraph' => [
            'class' => 'dragonjet\opengraph\OpenGraph',
        ],
        //....
    ],
  ```


**How to change captcha in Comments**

Not yet... If you are using Recaptcha2 in your project with my yii2-blog, please PR me!
By default, we use [Math captcha](https://github.com/lesha724/yii2-math-captcha)
 
## TODO

* refactoring code (specially BlogCategory, BlogTag)
* create widgets (for backend and frontend)
* translate to many popular languages
* create multilang models
* change default design and styles for frontend blog
* add config Captcha

## Support

If you have any questions or problems with Yii2-Blog you can ask them directly
 by using following email address: `akiraz@bk.ru`.

Please translate to your language! Edit config (or copy to your path) `@vendor/akiraz2/yii2-blog/src/messages/config.php`, add your language and run script:
```php
php ./yii message/extract @akiraz2/blog/messages/config.php
```
translate file will be in `@vendor/akiraz2/yii2-blog/src/messages/` or your configured path


## Contributing

If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.
+PSR-2 style coding.
I can apply patch, PR in 2-3 days! If not, please write me `akiraz@bk.ru`

## Licensing

Yii2-Blog is released under the MIT License. See the bundled [LICENSE.md](LICENSE.md)
for details.
