<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\models;

use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use akiraz2\blog\traits\ModuleTrait;
use dosamigos\taggable\Taggable;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yiidreamteam\upload\ImageUploadBehavior;


/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property string $brief
 * @property string $banner
 * @property integer $click
 * @property integer $rate
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BlogComment[] $blogComments
 * @property BlogCategory $category
 */
class BlogPost extends \yii\db\ActiveRecord
{
    use ModuleTrait;

    const STATUS_DELETED = -100;
    const STATUS_REJECTED = -1;
    const STATUS_DRAFT = 0;
    const STATUS_PENDING_REVIEW = 1;
    const STATUS_PLANNING_TO_PUBLISH = 10;
    const STATUS_PUBLISHED = 50;
    const STATUS_ARCHIVED = 100;

    const SCENARIO_USER = 'user';
    const SCENARIO_MODERATOR = 'moderator';
    const SCENARIO_ADMIN = 'admin';

    public $slug;
    public $commentsCount;
    public $categoryName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_post}}';
    }

    /**
     * @inheritdoc
     * @return BlogPostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogPostQuery(get_called_class());
    }

    /**
     * created_at, updated_at to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::class,
            'class' => Taggable::className(),
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug'
            ],
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id'
                ],
                'value' => function ($event) {
                    return Yii::$app->user->getId();
                },
            ],
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'banner',
                'thumbs' => [
                    'thumb' => ['width' => 400, 'height' => 300]
                ],
                'filePath' => $this->module->imgFilePath . '/[[model]]/[[pk]].[[extension]]',
                'fileUrl' => $this->module->getImgFullPathUrl() . '/[[model]]/[[pk]].[[extension]]',
                'thumbPath' => $this->module->imgFilePath . '/[[model]]/[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => $this->module->getImgFullPathUrl() . '/[[model]]/[[profile]]_[[pk]].[[extension]]',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'content'], 'required'],
            [['category_id', 'click', 'user_id', 'status'], 'integer'],
            [['brief', 'content'], 'string'],
            [['banner'], 'file', 'extensions' => 'jpg, png, webp', 'mimeTypes' => 'image/jpeg, image/png, image/webp',],
            [['title', 'seo_title', 'seo_keywords', 'seo_img'], 'string', 'max' => 128],
            [['seo_description'], 'string', 'max' => 255],
            ['click', 'default', 'value' => 0],
            ['title', 'unique'],
            ['status', 'default', 'value' => static::STATUS_DRAFT],
            ['lang', 'default', 'value' => Yii::$app->language],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('blog', 'ID'),
            'category_id' => Module::t('blog', 'Category ID'),
            'title' => Module::t('blog', 'Title'),
            'brief' => Module::t('blog', 'Brief'),
            'content' => Module::t('blog', 'Content'),
            'tags' => Module::t('blog', 'Tags'),
            'slug' => Module::t('blog', 'Slug'),
            'banner' => Module::t('blog', 'Banner'),
            'click' => Module::t('blog', 'Click'),
            'user_id' => Module::t('blog', 'User ID'),
            'status' => Module::t('blog', 'Status'),
            'created_at' => Module::t('blog', 'Created At'),
            'updated_at' => Module::t('blog', 'Updated At'),
            'commentsCount' => Module::t('blog', 'Comments Count'),
            'seo_title' => Module::t('blog', 'SEO Title'),
            'seo_keywords' => Module::t('blog', 'SEO keywords'),
            'seo_description' => Module::t('blog', 'SEO Description'),
            'seo_img' => Module::t('blog', 'SEO image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Yii::$container->get(BlogCategory::className()), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $userModel = $this->getModule()->userModel;
        return $this->hasOne($userModel::className(), [$this->getModule()->userPK => 'user_id']);
    }

    public function getComments()
    {
        return $this->hasMany(Yii::$container->get(BlogComment::class), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(BlogTag::className(), ['id' => 'tag_id'])->viaTable('{{%blog_post_tag_assn}}', ['post_id' => 'id']);
    }

    public function getStatus($nullLabel = '---')
    {
        $statuses = static::getStatusList();
        return (isset($this->status) && isset($statuses[$this->status])) ? $statuses[$this->status] : $nullLabel;
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_DELETED => Module::t('blog', 'Deleted'),
            self::STATUS_REJECTED => Module::t('blog', 'Rejected'),
            self::STATUS_DRAFT => Module::t('blog', 'Draft'),
            self::STATUS_PENDING_REVIEW => Module::t('blog', 'Pending review'),
            self::STATUS_PLANNING_TO_PUBLISH => Module::t('blog', 'Planning to Publish'),
            self::STATUS_PUBLISHED => Module::t('blog', 'Published'),
            self::STATUS_ARCHIVED => Module::t('blog', 'Archived'),
        ];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return Yii::$app->getUrlManager()->createUrl(['blog/default/view', 'id' => $this->id, 'slug' => $this->slug]);
    }

    /**
     * @return string
     */
    public function getAbsoluteUrl()
    {
        return Yii::$app->getUrlManager()->createAbsoluteUrl(['blog/default/view', 'id' => $this->id, 'slug' => $this->slug]);
    }

    /**
     * comment need approval
     */
    public function addComment($comment)
    {
        $comment->status = BlogComment::STATUS_INACTIVE;
        $comment->post_id = $this->id;
        return $comment->save();
    }
}
