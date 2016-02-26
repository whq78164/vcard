<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Traceabilitydata;

/**
 * TraceabilitydataSearch represents the model behind the search form about `frontend\models\Traceabilitydata`.
 */
class TraceabilitydataSearch extends TraceabilityDatanew
{
 //   public $code;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'productid', 'traceabilityid', 'query_time', 'clicks', 'create_time', 'status'], 'integer'],
            [['remark','localremark'], 'safe'],
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
        $query = TraceabilityDatanew::find()->where(['uid' =>Yii::$app->user->id ]);
    //    $query->joinWith(['TraceabilityInfo']);

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
            'productid' => $this->productid,
            'traceabilityid' => $this->traceabilityid,
            'query_time' => $this->query_time,
            'clicks' => $this->clicks,
            'create_time' => $this->create_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'localremark', $this->localremark]);
     //   ->andFilterWhere(['like', 'tbhome_traceability_info.code', $this->code]);



        return $dataProvider;
    }
}
