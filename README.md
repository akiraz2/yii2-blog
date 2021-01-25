# Yii2 Super Blog v2 [![Packagist Version](https://img.shields.io/packagist/v/akiraz2/yii2-blog.svg?style=flat-square)](https://packagist.org/packages/akiraz2/yii2-blog) [![Total Downloads](https://img.shields.io/packagist/dt/akiraz2/yii2-blog.svg?style=flat-square)](https://packagist.org/packages/akiraz2/yii2-blog) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Yii2 Super Blog is simple, configured yii2 Module.


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

## Installation

`composer require --prefer-source akiraz2/yii2-blog "dev-develop"`

Add module to `config/web.php` and `config/console.php`

section bootstrap:
```
'bootstrap' => ['log', \akiraz2\blog\Bootstrap::class],
```
section modules:
```
'modules' => [
        'blog' => [
            'class' => akiraz2\blog\Module::class,
            //'urlManager' => 'urlManager',// 'urlManager' by default, or maybe you can use own component urlManagerFrontend
            'imgFilePath' => '@app/web/img/blog/',
            'imgFileUrl' => '/img/blog/',
            'userModel' => app\models\User::class,
            'userPK' => 'id', //default primary key for {{%user}} table
            'userName' => 'username', //uses in view (may be field `username` or `email` or `login`)
        ],
    ],
```

Run 
`yii migrate`


## TODO
* module for yii2-basic
* post new statuses + date to publish
* post: featured, sticky, page
* post revisions with parent_id
* seo meta tags
* redirect param 301/302 if url was changed
* rbac role author to create/update post, role moderator accept/reject posts, CRUD category/tags, role administrator super power
* refactoring code (specially BlogCategory, BlogTag)
* create widgets (for backend and frontend)
* translate to many popular languages
* create multilang models (post, tag, category) ru, en
* change default design and styles for frontend blog
* add config Captcha
* add API controller (json output)

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
