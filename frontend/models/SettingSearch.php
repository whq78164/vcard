<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Setting;

/**
 * SettingSearch represents the model behind the search form about `frontend\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'tpl', 'vip', 'upline', 'status', 'leader'], 'integer'],
            [['bg_image'], 'safe'],
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
        $query = Setting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'uid' => $this->uid,
            'tpl' => $this->tpl,
            'vip' => $this->vip,
            'upline' => $this->upline,
            'status' => $this->status,
            'leader' => $this->leader,
        ]);

        $query->andFilterWhere(['like', 'bg_image', $this->bg_image]);

        return $dataProvider;
    }
}
