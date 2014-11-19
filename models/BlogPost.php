<?php

namespace funson86\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use funson86\blog\Module;

/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $surname
 * @property integer $click
 * @property integer $user_id
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 *
 * @property BlogComment[] $blogComments
 * @property BlogCatalog $catalog
 */
class BlogPost extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = -1;
    private $_statusLabel;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * create_time, update_time to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'title', 'content', 'tags', 'surname', 'user_id'], 'required'],
            [['catalog_id', 'click', 'user_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['title', 'tags', 'surname'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('blog', 'ID'),
            'catalog_id' => Module::t('blog', 'Catalog ID'),
            'title' => Module::t('blog', 'Title'),
            'content' => Module::t('blog', 'Content'),
            'tags' => Module::t('blog', 'Tags'),
            'surname' => Module::t('blog', 'Surname'),
            'click' => Module::t('blog', 'Click'),
            'user_id' => Module::t('blog', 'User ID'),
            'status' => Module::t('blog', 'Status'),
            'create_time' => Module::t('blog', 'Create Time'),
            'update_time' => Module::t('blog', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(BlogCatalog::className(), ['id' => 'catalog_id']);
    }

    /**
     * Before save.
     * create_time update_time
     */
    /*public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            // add your code here
            return true;
        }
        else
            return false;
    }*/

    /**
     * After save.
     *
     */
    /*public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // add your code here
    }*/

    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_INACTIVE => Module::t('app', 'STATUS_INACTIVE'),
            self::STATUS_ACTIVE => Module::t('app', 'STATUS_ACTIVE'),
            self::STATUS_DELETED => Module::t('app', 'STATUS_DELETED'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) 
        {
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }


}
