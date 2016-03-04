<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\company\models\Department;
use frontend\modules\company\models\Company;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WorkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Workers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

   //         'id',
            'job_id',

          [

                'attribute' =>  'company_id',
                'label' => '公司名',
            //    'format' =>'html',
                'filter' => Html::activeDropDownList($searchModel, 'company_id', $listCompanys, ['class' => 'form-control']),
                'value' => function ($model) {
                    $company_id=$model->company_id;
                    $company=Company::findOne($company_id);
                    return Html::encode($company->company);
                },
            ],

 //           'company_id',


            [

                'attribute' =>  'department_id',
                'label' => '部门',
                //    'format' =>'html',
                'filter' => Html::activeDropDownList($searchModel, 'department_id', $listDepartments, ['class' => 'form-control']),
                'value' => function ($model) {
                    $department_id=$model->department_id;
                    $department=Department::findOne($department_id);
                    return Html::encode($department->department);
                },
            ],




            'name',
            // 'mobile',
            // 'qq',
            // 'email:email',
            // 'head_img',
            // 'position',
            // 'task',
            // 'work_tel',
            // 'wechat_account',
            // 'wechat_qrcode',
            // 'fax',
            // 'is_work',
            // 'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
