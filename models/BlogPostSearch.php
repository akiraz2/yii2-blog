<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\models;

use akiraz2\blog\traits\IActiveStatus;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use akiraz2\blog\models\BlogPost;

/**
 * BlogPostSearch represents the model behind the search form about `akiraz2\blog\models\BlogPost`.
 */
class BlogPostSearch extends BlogPost
{
    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_USER = 'user';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'click', 'user_id', 'status'], 'integer'],
            [['title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN] = ['id', 'category_id', 'click', 'user_id', 'status', 'title'];
        $scenarios[self::SCENARIO_USER] = ['category_id', 'title'];
        return $scenarios;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BlogPost::find();
        $query->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->module->blogPostPageCount,
            ]
        ]);

        if (!($this->load($params,($this->scenario== self::SCENARIO_USER)?'': 'BlogPostSearch') && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'click' => $this->click,
            'user_id' => $this->user_id,
            'status' => ($this->scenario== self::SCENARIO_USER)? IActiveStatus::STATUS_ACTIVE : $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
