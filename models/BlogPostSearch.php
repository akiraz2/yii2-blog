<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\models;

use akiraz2\blog\traits\IActiveStatus;
use yii\data\ActiveDataProvider;

/**
 * BlogPostSearch represents the model behind the search form about `akiraz2\blog\models\BlogPost`.
 */
class BlogPostSearch extends BlogPost
{
    const SCENARIO_ADMIN = 'admin';
    const SCENARIO_USER = 'user';
    const SCENARIO_OWNER = 'owner';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'user_id', 'status'], 'integer'],
            [['title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN] = ['id', 'category_id', 'user_id', 'status', 'title'];
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
        $query->withCategoryName();//->withCommentCount();
        if ($this->scenario == self::SCENARIO_USER) {
            $query->lang()->published()->withCategoryStatusActive();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->module->postPageCount,
            ]
        ]);

        if (!($this->load($params, ($this->scenario == self::SCENARIO_USER) ? '' : 'BlogPostSearch') && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'category_id' => $this->category_id,
        ]);

        if ($this->scenario == self::SCENARIO_ADMIN) {
            $query->andFilterWhere([
                'id' => $this->id,
                'status' => $this->status,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]);
            $query->andFilterWhere(['like', 'title', $this->title]);
        }

        return $dataProvider;
    }
}
