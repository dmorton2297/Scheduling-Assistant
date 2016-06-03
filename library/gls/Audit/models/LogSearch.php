<?php
namespace GLS\Audit\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class LogSearch extends Log
{
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['id', 'user.username', 'facility.name', 'severity.name', 'message', 'created_at'], 'safe'],
        ];
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['facility.name', 'severity.name', 'user.username']);
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $query->joinWith('user');
        $query->joinWith('facility');
        $query->joinWith('severity');

        $dataProvider->sort->attributes['user.username'] = [
            'asc' => ['users.username' => SORT_ASC],
            'desc' => ['users.username' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['facility.name'] = [
            'asc' => ['audit_log_facilities.name' => SORT_ASC],
            'desc' => ['audit_log_facilities.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['severity.name'] = [
            'asc' => ['audit_log_severities.name' => SORT_ASC],
            'desc' => ['audit_log_severities.name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['=', 'audit_log.id', $this->id]);
        $query->andFilterWhere(['ILIKE', 'message', $this->message]);
        $query->andFilterWhere(['ILIKE', 'users.username', $this->getAttribute('user.username')]);
        $query->andFilterWhere(['ILIKE', 'audit_log_facilities.name', $this->getAttribute('facility.name')]);
        $query->andFilterWhere(['ILIKE', 'audit_log_severities.name', $this->getAttribute('severity.name')]);

        return $dataProvider;
    }
}