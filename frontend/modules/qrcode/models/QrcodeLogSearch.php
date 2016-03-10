<?php

namespace frontend\modules\qrcode\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AntiLog;

/**
 * AntiLogSearch represents the model behind the search form about `frontend\models\AntiLog`.
 */
class QrcodeLogSearch extends AntiLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'startid', 'endid', 'time'], 'integer'],
            [['url', 'remark'], 'safe'],
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
        $query = AntiLog::find();

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
            'id' => $this->id,
            'startid' => $this->startid,
            'endid' => $this->endid,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}