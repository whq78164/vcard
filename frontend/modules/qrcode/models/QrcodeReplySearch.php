<?php

namespace frontend\modules\qrcode\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\qrcode\models\QrcodeReply;

/**
 * AntireplySearch represents the model behind the search form about `frontend\models\AntiReply`.
 */
class QrcodereplySearch extends QrcodeReply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'valid_clicks'], 'integer'],
            [['tag', 'success', 'fail', 'content'], 'safe'],
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
   //     $query = AntiReply::find();
        $query = QrcodeReply::find()->where(['uid' =>Yii::$app->user->id ]);

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
            'valid_clicks' => $this->valid_clicks,
        ]);

        $query->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'success', $this->success])
            ->andFilterWhere(['like', 'fail', $this->fail])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
