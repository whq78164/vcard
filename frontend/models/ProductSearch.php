<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `frontend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'share', 'hot'], 'integer'],
            [['image', 'factory', 'name', 'describe', 'specification', 'unit', 'brand', 'price'], 'safe'],
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
    //    $query = Product::find();
        $query = Product::find()->where(['uid' =>Yii::$app->user->id ]);

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
            'share' => $this->share,
            'hot' => $this->hot,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'factory', $this->factory])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'specification', $this->specification])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }
}
