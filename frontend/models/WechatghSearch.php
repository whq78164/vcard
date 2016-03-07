<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Wechatgh;

/**
 * WechatghSearch represents the model behind the search form about `frontend\models\Wechatgh`.
 */
class WechatghSearch extends Wechatgh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid'], 'integer'],
            [['appid', 'name', 'mchid', 'email'], 'safe'],
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
        $query = Wechatgh::find()->where(['uid' =>Yii::$app->user->id ]);

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
        ]);

        $query->andFilterWhere(['like', 'appid', $this->appid])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mchid', $this->mchid])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
