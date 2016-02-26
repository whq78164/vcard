<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cloud;

/**
 * CloudSearch represents the model behind the search form about `frontend\models\Cloud`.
 */
class CloudSearch extends Cloud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qq', 'pageid1', 'pageid2', 'status'], 'integer'],
            [['sitetitle', 'siteurl', 'company', 'tel', 'email', 'address', 'copyright', 'icp', 'ip'], 'safe'],
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
        $query = Cloud::find();

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
            'qq' => $this->qq,
            'pageid1' => $this->pageid1,
            'pageid2' => $this->pageid2,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'sitetitle', $this->sitetitle])
            ->andFilterWhere(['like', 'siteurl', $this->siteurl])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'copyright', $this->copyright])
            ->andFilterWhere(['like', 'icp', $this->icp])
            ->andFilterWhere(['like', 'ip', $this->ip]);

        return $dataProvider;
    }
}
