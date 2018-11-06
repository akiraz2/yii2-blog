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
use akiraz2\blog\traits\ModuleTrait;
use akiraz2\blog\traits\StatusTrait;
use himiklab\sortablegrid\SortableGridBehavior;
use Yii;
use yii\helpers\ArrayHelper;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $banner
 * @property integer $is_nav
 * @property integer $sort_order
 * @property integer $page_size
 * @property string $template
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BlogPost[] $blogPosts
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    use StatusTrait, ModuleTrait;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_ARCHIVE = -1;

    const IS_NAV_YES = 1;
    const IS_NAV_NO = 0;

    const PAGE_TYPE_LIST = 'list';
    const PAGE_TYPE_PAGE = 'page';

    public $slug;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_category}}';
    }

    /**
     * @inheritdoc
     */
    public static function getArrayIsNav()
    {
        return [
            self::IS_NAV_YES => Module::t('blog', 'YES'),
            self::IS_NAV_NO => Module::t('blog', 'NO'),
        ];
    }

    public static function getList($not_id = null)
    {
        $parentCategory = BlogCategory::find()->andFilterWhere(['!=', 'id', $not_id])->all();
        return ArrayHelper::map($parentCategory, 'id', 'title');
    }

    /**
     * @inheritdoc
     * @return BlogCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogCategoryQuery(get_called_class());
    }

    /**
     * created_at, updated_at to now()     *
     */
    public function behaviors()
    {
        return [
            //TimestampBehavior::class,
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'sort_order'
            ],
            /*[
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],*/
            [
                'class' => ImageUploadBehavior::class,
                'attribute' => 'banner',
                'thumbs' => [
                    'thumb' => [
                        'width' => $this->getModule()->categoryBannerThumbWidth,
                        'height' => $this->getModule()->categoryBannerThumbHeight
                    ]
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
            [['parent_id', 'is_nav', 'sort_order', 'page_size', 'status'], 'integer'],
            [['title'], 'required'],
            ['title', 'unique'],
            ['sort_order', 'default', 'value' => 0],
            ['page_size', 'default', 'value' => 20],
            [['title', 'template'], 'string', 'max' => 255],
            [['banner'], 'file', 'extensions' => 'jpg, png, webp', 'mimeTypes' => 'image/jpeg, image/png, image/webp',],
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
            'parent_id' => Module::t('blog', 'Parent ID'),
            'title' => Module::t('blog', 'Title'),
            'banner' => Module::t('blog', 'Banner'),
            'is_nav' => Module::t('blog', 'Is Nav'),
            'sort_order' => Module::t('blog', 'Sort Order'),
            'page_size' => Module::t('blog', 'Page Size'),
            'template' => Module::t('blog', 'Template'),
            'status' => Module::t('blog', 'Status'),
            'created_at' => Module::t('blog', 'Created At'),
            'updated_at' => Module::t('blog', 'Updated At'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->lang = $this->lang ? $this->lang : Yii::$app->language;
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPosts()
    {
        return $this->hasMany(BlogPost::class, ['category_id' => 'id']);
    }

    /**
     * @return integer
     */
    public function getPostsCount()
    {
        return $this->count(BlogPost::class, ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(BlogCategory::class, ['id' => 'parent_id']);
    }
}
