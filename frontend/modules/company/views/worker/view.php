<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\company\models\Department;
use frontend\modules\company\models\Company;
use yii\helpers\Url;

$company_id=$model->company_id;
$company=Company::findOne($company_id);

$department_id=$model->department_id;
$department=Department::findOne($department_id);

/* @var $this yii\web\View */
/* @var $model frontend\models\Worker */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Workers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$mpurl=Url::to(['/company/worker/mp', 'id'=>$model->id], true);
?>
<div class="worker-view">

    <p>
        <?= Html::a(Yii::t('tbhome', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('tbhome', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('tbhome', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'head_img', 'format' => 'html', 'value'=> Html::img($model->head_img, ['style'=>'width:100px']),],
   //         'id',
            'job_id',


  //          'company_id',
            [
                'attribute'=> '名片网址',
                'format' => 'html',
                'value'=>Html::a($mpurl,$mpurl,['target'=>'_blank']),

            ],


            [
                'attribute'=> Yii::t('tbhome', 'Company'),
           //    'format' => 'html',
                'value'=>Html::encode($company->company),

            ],


            [
                'attribute'=> Yii::t('tbhome', 'Department'),
                'value'=> Html::encode($department->department),
            ],


 //           'department_id',
            'name',
            'mobile',
            'qq',
            'email:email',

      //      'head_img:html',



            'position',
            'task',
            'work_tel',
            'wechat_account',
      //      'wechat_qrcode',
            'fax',

            [
                'attribute'=> 'is_work',
                'value'=> $model->is_work ? '在职' : '离职',
            ],



            'remark',
        ],
    ]) ?>

</div>
