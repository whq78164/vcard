<?php

namespace frontend\modules\company\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WorkerSearch represents the model behind the search form about `frontend\company\models\Worker`.
 */
class DepartmentSearch extends Department
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid'], 'integer'],
            [['department'], 'safe'],
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
        $uid=Yii::$app->user->id;
        $query = Department::find()->where(['uid'=>$uid]);//->all();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

   /*     $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'qq' => $this->qq,
            'is_work' => $this->is_work,
        ]);
*/
        $query->andFilterWhere(['like', 'department', $this->department]);

        return $dataProvider;
    }
}
