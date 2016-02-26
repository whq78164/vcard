<?php

namespace frontend\modules\schoolmate\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SchoolmateSearch represents the model behind the search form about `frontend\modules\schoolmate\models\Schoolmate`.
 */
class SchoolmateSearch extends Schoolmate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'sex', 'grade', 'major', 'studentid', 'idcardnum', 'address', 'city', 'job', 'jobtitle', 'honour', 'worktel', 'hometel', 'mobile', 'email', 'qq', 'comment'], 'safe'],
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
        $query = Schoolmate::find();

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'major', $this->major])
            ->andFilterWhere(['like', 'studentid', $this->studentid])
            ->andFilterWhere(['like', 'idcardnum', $this->idcardnum])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'job', $this->job])
            ->andFilterWhere(['like', 'jobtitle', $this->jobtitle])
            ->andFilterWhere(['like', 'honour', $this->honour])
            ->andFilterWhere(['like', 'worktel', $this->worktel])
            ->andFilterWhere(['like', 'hometel', $this->hometel])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'qq', $this->qq])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
