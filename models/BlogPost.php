<?php

namespace funson86\blog\models;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use funson86\blog\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $surname
 * @property string $banner
 * @property integer $click
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BlogComment[] $blogComments
 * @property BlogCatalog $catalog
 */
class BlogPost extends \yii\db\ActiveRecord
{
    private $_oldTags;

    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post';
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
    public function rules()
    {
        return [
            [['catalog_id', 'title', 'content', 'tags', 'surname', 'user_id'], 'required'],
            [['catalog_id', 'click', 'user_id', 'status'], 'integer'],
            [['brief', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['banner'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
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
            'brief' => Module::t('blog', 'Brief'),
            'content' => Module::t('blog', 'Content'),
            'tags' => Module::t('blog', 'Tags'),
            'surname' => Module::t('blog', 'Surname'),
            'banner' => Module::t('blog', 'Banner'),
            'click' => Module::t('blog', 'Click'),
            'user_id' => Module::t('blog', 'User ID'),
            'status' => Module::t('blog', 'Status'),
            'created_at' => Module::t('blog', 'Created At'),
            'updated_at' => Module::t('blog', 'Updated At'),
            'commentsCount' => Module::t('blog', 'Comments Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComment::className(), ['post_id' => 'id']);
    }

    public function getCommentsCount()
    {
        return $this->hasMany(BlogComment::className(), ['post_id' => 'id'])->count('post_id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(BlogCatalog::className(), ['id' => 'catalog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getComments()
    {
        return $this->hasMany(BlogComment::className(), ['post_id' => 'id']);
    }

    public function getStatus()
    {
        if ($this->_status === null) {
            $this->_status = new Status($this->status);
        }
        return $this->_status;
    }

    /**
     * Before save.
     * created_at updated_at
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
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // add your code here
        BlogTag::updateFrequency($this->_oldTags, $this->tags);
    }

    /**
     * After save.
     *
     */
    public function afterDelete()
    {
        parent::afterDelete();
        // add your code here
        BlogTag::updateFrequencyOnDelete($this->_oldTags);
    }

    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
    }

    /**
     * Normalizes the user-entered tags.
     */
    public static function getArrayCatalog()
    {
        return ArrayHelper::map(BlogCatalog::find()->all(), 'id', 'title');
    }

    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute,$params)
    {
        $this->tags = BlogTag::array2string(array_unique(array_map('trim', BlogTag::string2array($this->tags))));
    }

    /**
     *
     */
    public function getUrl()
    {
        return Yii::$app->getUrlManager()->createUrl(['blog/default/view', 'id' => $this->id, 'surname' => $this->surname]);
    }

    /**
     *
     */
    public function getTagLinks()
    {
        $links = [];
        foreach(BlogTag::string2array($this->tags) as $tag)
            $links[] = Html::a($tag, Yii::$app->getUrlManager()->createUrl(['blog/default/index', 'tag'=>$tag]));

        return $links;
    }

    /**
     * comment need approval
     */
    public function addComment($comment)
    {
        $comment->status = Status::STATUS_INACTIVE;
        $comment->post_id = $this->id;
        return $comment->save();
    }

}
