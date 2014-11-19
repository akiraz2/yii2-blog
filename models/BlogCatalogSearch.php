<?php

namespace funson86\blog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use funson86\blog\models\BlogCatalog;

/**
 * BlogCatalogSearch represents the model behind the search form about `funson86\blog\models\BlogCatalog`.
 */
class BlogCatalogSearch extends BlogCatalog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'is_nav', 'sort_order', 'page_size', 'status'], 'integer'],
            [['title', 'surname', 'banner', 'template', 'redirect_url', 'create_time', 'update_time'], 'safe'],
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
        $query = BlogCatalog::find();
        
        $query->orderBy(['sort_order' => SORT_ASC, 'create_time' => SORT_DESC]);

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
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'redirect_url', $this->redirect_url]);

        return $dataProvider;
    }
}
