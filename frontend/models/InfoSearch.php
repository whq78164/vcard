<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Info;

/**
 * InfoSearch represents the model behind the search form about `frontend\models\Info`.
 */
class InfoSearch extends Info
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['card_title', 'unit', 'face_box', 'department', 'position', 'address', 'business', 'signature', 'fax', 'location', 'wechat_account', 'wechat_qrcode', 'work_tel'], 'safe'],
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
        $query = Info::find();

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
        ]);

        $query->andFilterWhere(['like', 'card_title', $this->card_title])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'face_box', $this->face_box])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'business', $this->business])
            ->andFilterWhere(['like', 'signature', $this->signature])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'wechat_account', $this->wechat_account])
            ->andFilterWhere(['like', 'wechat_qrcode', $this->wechat_qrcode])
            ->andFilterWhere(['like', 'work_tel', $this->work_tel]);

        return $dataProvider;
    }
}
