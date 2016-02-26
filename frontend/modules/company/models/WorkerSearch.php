<?php

namespace frontend\modules\company\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WorkerSearch represents the model behind the search form about `frontend\company\models\Worker`.
 */
class WorkerSearch extends Worker
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'company_id', 'department_id', 'qq', 'is_work'], 'integer'],
            [['job_id', 'name', 'mobile', 'email', 'head_img', 'position', 'task', 'work_tel', 'wechat_account', 'wechat_qrcode', 'fax', 'remark'], 'safe'],
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
        $query = Worker::find()->where(['uid'=>$uid]);//->all();

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
            'company_id' => $this->company_id,
            'department_id' => $this->department_id,
            'qq' => $this->qq,
            'is_work' => $this->is_work,
        ]);

        $query->andFilterWhere(['like', 'job_id', $this->job_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'head_img', $this->head_img])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'task', $this->task])
            ->andFilterWhere(['like', 'work_tel', $this->work_tel])
            ->andFilterWhere(['like', 'wechat_account', $this->wechat_account])
            ->andFilterWhere(['like', 'wechat_qrcode', $this->wechat_qrcode])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
