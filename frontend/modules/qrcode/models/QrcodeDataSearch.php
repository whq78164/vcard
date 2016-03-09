<?php

namespace frontend\modules\qrcode\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AntiCode;

/**
 * AntiCodeSearch represents the model behind the search form about `frontend\models\AntiCode`.
 */
class QrcodeDataSearch extends QrcodeData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'replyid', 'create_time', 'productid', 'query_time', 'clicks'], 'integer'],
            [['code'], 'safe'],
           [['prize', 'remark'], 'string'],
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
 //       $connection=Yii::$app->db;
 //       $uid=Yii::$app->user->id;
 //       $table='tbhome_anti_code_'.$uid;
 //       $sql='SELECT * FROM '.$table;
 //       $command = $connection->createCommand($sql);
 //       $query=$command->queryAll();;

        $query = QrcodeData::find();//->where(['uid' =>Yii::$app->user->id ]);

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
         //   'id' => $this->id,
            'uid' => $this->uid,
            'replyid' => $this->replyid,
            'productid' => $this->productid,
            'query_time' => $this->query_time,
            'clicks' => $this->clicks,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'prize', $this->prize]);

        return $dataProvider;
    }
}
