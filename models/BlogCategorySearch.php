<?php
/**
 * @module yii2-blog
 * @description powerful blog module for yii2
 * @author akiraz2
 * @email akiraz@bk.ru
 * Copyright (c) 2018.
 */

namespace akiraz2\blog\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BlogCategorySearch represents the model behind the search form about `akiraz2\blog\models\BlogCategory`.
 */
class BlogCategorySearch extends BlogCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'is_nav', 'sort_order', 'page_size', 'status'], 'integer'],
            [['title', 'slug', 'banner', 'template', 'redirect_url', 'created_at', 'updated_at'], 'safe'],
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
    public function search($params)
    {
        $query = BlogCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'is_nav' => $this->is_nav,
            'sort_order' => $this->sort_order,
            'page_size' => $this->page_size,
            'status' => $this->status,
            'created_at' => $this->create_time,
            'updated_at' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'template', $this->template]);

        return $dataProvider;
    }
}
