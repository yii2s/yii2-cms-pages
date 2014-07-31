<?php

namespace infoweb\pages\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use infoweb\pages\models\Page;
use infoweb\pages\models\PageLang;

/**
 * PageSearch represents the model behind the search form about `app\models\Page`.
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active'], 'integer'],
            [['title', 'content', 'time_created', 'time_updated'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Page::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'time_created' => $this->time_created,
            'time_updated' => $this->time_updated,
        ]);

        //$query->innerJoin(PageLang::tableName(), 'page_id = id');
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
