<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\models;

use akiraz2\blog\traits\IActiveStatus;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BlogCommentSearch represents the model behind the search form about `akiraz2\blog\models\BlogComment`.
 */
class BlogCommentSearch extends BlogComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'status'], 'integer'],
            [['content', 'author', 'email', 'url', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $post_id = null)
    {
        $query = BlogComment::find();

        $query->orderBy(['created_at' => SORT_DESC]);

        if ($this->scenario == self::SCENARIO_USER) {
            $query->andWhere(['post_id' => $post_id, 'status' => [IActiveStatus::STATUS_INACTIVE, IActiveStatus::STATUS_ACTIVE]]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->module->blogCommentPageCount,
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'post_id' => $post_id ? $post_id : $this->post_id,
            'status' => ($this->scenario == self::SCENARIO_USER) ? IActiveStatus::STATUS_ACTIVE : $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
