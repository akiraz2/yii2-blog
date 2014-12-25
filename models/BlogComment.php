<?php

namespace funson86\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use funson86\blog\Module;
use yii\helpers\Html;

/**
 * This is the model class for table "blog_comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $content
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BlogPost $post
 */
class BlogComment extends \yii\db\ActiveRecord
{
    private $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comment';
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
            [['post_id', 'content', 'author', 'email'], 'required'],
            [['post_id', 'status'], 'integer'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['author', 'email', 'url'], 'string', 'max' => 128]
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
    /*public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // add your code here
    }*/

    public function getAuthorLink()
    {
        if(!empty($this->url))
            return Html::a(Html::encode($this->author), $this->url);
        else
            return Html::encode($this->author);
    }

    public function getUrl($post=null)
    {
        if($post === null)
            $post = $this->post;
        return $post->url . '#c' . $this->id;
    }

    public static  function findRecentComments($limit=10)
    {
        return self::find()->joinWith('blogPost')->where([
            'blog_comment.status' => Status::STATUS_ACTIVE,
            'blog_post.status' => Status::STATUS_ACTIVE,
        ])->orderBy([
            'created_at' => SORT_DESC
        ])->limit($limit)->all();
        /*return $this->with('post')->findAll(array(
            'condition'=>'t.status='.CONSTANT::STATUS_ACTIVE .' AND post.status='.CONSTANT::STATUS_ACTIVE,
            'order'=>'t.created_at DESC',
            'limit'=>$limit,
        ));*/
    }
}
