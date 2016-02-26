<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TraceabilityInfonew;

/**
 * TraceabilityinfoSearch represents the model behind the search form about `frontend\models\Traceabilityinfo`.
 */
class TraceabilityinfoSearch extends TraceabilityInfonew
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'label', 'create_time', 'status'], 'integer'],
            [['code', 'describe', 'remark'], 'safe'],
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
        $query = TraceabilityInfonew::find();//->where(['uid' =>Yii::$app->user->id ]);

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
            'uid' => $this->uid,
            'label' => $this->label,
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
