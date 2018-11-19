<?php

namespace akiraz2\blog\models;

use Yii;

/**
 * This is the model class for table "blog_rating".
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property int $rating
 * @property int $created_at
 *
 * @property BlogPost $post
 */
class BlogRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id', 'rating', 'created_at'], 'required'],
            [['post_id', 'user_id', 'rating', 'created_at'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogPost::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'rating' => 'Rating',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(BlogPost::className(), ['id' => 'post_id']);
    }
}
