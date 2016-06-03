<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['id'], 'integer'],
            [['username', 'firstname', 'lastname', 'email'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if (!isset($params['UserSearch'])) {
            $query->andFilterWhere(['status' => 10]);
        }

        // load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['ilike', 'username', $this->username]);
        $query->andFilterWhere(['ilike', 'firstname', $this->firstname]);
        $query->andFilterWhere(['ilike', 'lastname', $this->lastname]);
        $query->andFilterWhere(['ilike', 'email', $this->email]);
        if ($params['UserSearch']['active'] && !$params['UserSearch']['inactive']) {
            $query->andFilterWhere(['status' => 10]);
        } elseif (!$params['UserSearch']['active'] && $params['UserSearch']['inactive']) {
            $query->andFilterWhere(['status' => 0]);
        } elseif (!$params['UserSearch']['active'] && !$params['UserSearch']['inactive']) {
            $query->andFilterWhere(['status' => -1]);
        }

        // $query->andFilterWhere(['status' => ($params['UserSearch']['active'] ? 10 : 0)]);

        return $dataProvider;
    }
}
