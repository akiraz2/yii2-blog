<?php

namespace funson86\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use funson86\blog\models\BlogPost;

/**
 * BlogPostSearch represents the model behind the search form about `funson86\blog\models\BlogPost`.
 */
class BlogPostSearch extends BlogPost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'catalog_id', 'click', 'user_id', 'status'], 'integer'],
            [['title', 'content', 'tags', 'surname', 'created_at', 'updated_at'], 'safe'],
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
        $query = BlogPost::find();
        
        $query->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'catalog_id' => $this->catalog_id,
            'click' => $this->click,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'surname', $this->surname]);

        return $dataProvider;
    }
}
