<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\models;

use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use akiraz2\blog\traits\StatusTrait;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "blog_comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $content
 * @property string $author
 * @property string $email
 * @property string $url
 * @property string $captcha
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BlogPost $post
 */
class BlogComment extends \yii\db\ActiveRecord
{
    use StatusTrait, ModuleTrait;

    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_USER = 'user';

    public $captcha;

    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_comment}}';
    }

    /**
     * created_at, updated_at to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN] = ['post_id', 'content', 'author', 'email', 'status', 'url'];
        $scenarios[self::SCENARIO_USER] = ['content', 'author', 'email', 'captcha'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'content', 'author', 'email'], 'required'],
            ['email', 'email'],
            [['author', 'content'], 'filter', 'filter' => 'strip_tags'],
            [['author', 'captcha', 'email'], 'trim'],
            [['post_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['author', 'email', 'url'], 'string', 'max' => 128],
            ['captcha', 'captcha', 'captchaAction' => Url::to('/blog/default/captcha'), 'on' => self::SCENARIO_USER],
            ['captcha', 'required', 'on' => self::SCENARIO_USER]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('blog', 'ID'),
            'post_id' => Module::t('blog', 'Post ID'),
            'content' => Module::t('blog', 'Content'),
            'author' => Module::t('blog', 'Author'),
            'email' => Module::t('blog', 'Email'),
            'url' => Module::t('blog', 'Url'),
            'status' => Module::t('blog', 'Status'),
            'created_at' => Module::t('blog', 'Created At'),
            'updated_at' => Module::t('blog', 'Updated At'),
            'captcha' => Module::t('blog', 'Verify code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'post_id']);
    }

    /**
     * @return string
     */
    public function getAuthorLink()
    {
        if (!empty($this->url)) {
            return Html::a(Html::encode($this->author), $this->url);
        } else {
            return Html::encode($this->author);
        }
    }

    /**
     * @param null $post
     * @return string
     */
    public function getUrl($post = null)
    {
        if ($post === null) {
            $post = $this->post;
        }
        return $post->url . '#c' . $this->id;
    }

    /**
     * @param int $limit
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findRecentComments($limit = 10)
    {
        return self::find()->joinWith('blogPost')->where([
            '{{%blog_comment}}.status' => IActiveStatus::STATUS_ACTIVE,
            '{{%blog_post}}.status' => IActiveStatus::STATUS_ACTIVE,
        ])->orderBy([
            'created_at' => SORT_DESC
        ])->limit($limit)->all();
    }

    /**
     * @return string
     */
    public function getMaskedEmail()
    {
        list($email_username, $email_domain) = explode('@', $this->email);
        $masked_email_username = preg_replace('/(.)./', "$1*", $email_username);
        return implode('@', array($masked_email_username, $email_domain));
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return ($this->status == IActiveStatus::STATUS_ACTIVE) ? $this->content : StringHelper::truncate($this->content, 15);
    }
}
