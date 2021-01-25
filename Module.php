<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog;

use Yii;

class Module extends \yii\base\Module
{
    public $onlyAdmin = false;

    public $urlManager = 'urlManager';

    public $imgFilePath = '@app/web/img/blog';

    public $imgFileUrl = '/img/blog';

    public $adminAccessControl = null;

    public $postPageCount = 10;

    public $commentPageCount = 20;

    public $enableComments = true;

    public $schemaOrg = [];

    /** @var string Name of Component for editing posts */
    public $redactorModule = 'redactorBlog';

    /** @var linked user (for example, 'common\models\User::class' */
    public $userModel;// = \common\models\User::class;

    /** @var string Primary Key for user table, by default 'id' */
    public $userPK = 'id';

    /** @var string username uses in view (may be field `username` or `email` or `login`) */
    public $userName = 'username';

    public $theme;

    public $categoryBannerThumbWidth = 400;

    public $categoryBannerThumbHeight = 300;

    protected $_isBackend;

    /**
     * Translates a message to the specified language.
     *
     * This is a shortcut method of [[\yii\i18n\I18N::translate()]].
     *
     * The translation will be conducted according to the message category and the target language will be used.
     *
     * You can add parameters to a translation message that will be substituted with the corresponding value after
     * translation. The format for this is to use curly brackets around the parameter name as you can see in the following example:
     *
     * ```php
     * $username = 'Alexander';
     * echo \Yii::t('app', 'Hello, {username}!', ['username' => $username]);
     * ```
     *
     * Further formatting of message parameters is supported using the [PHP intl extensions](http://www.php.net/manual/en/intro.intl.php)
     * message formatter. See [[\yii\i18n\I18N::translate()]] for more details.
     *
     * @param string $category the message category.
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     *
     * @return string the translated message.
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('akiraz2/' . $category, $message, $params, $language);
    }

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Check if module is used for backend application.
     *
     * @return boolean true if it's used for backend application
     */
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }

        return $this->_isBackend;
    }

    /**
     * Need correct Full IMG URL for Backend
     *
     * @return string
     */
    public function getImgFullPathUrl()
    {
        return \Yii::$app->get($this->urlManager)->getHostInfo() . $this->imgFileUrl;
    }

    public static function postInstall($event)
    {
        $dirPath= \Yii::getAlias('@app/media/imagemanager');
        try {
            if (!is_dir(dirname($dirPath))) {
                mkdir(dirname($dirPath), 0666, true);
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}
