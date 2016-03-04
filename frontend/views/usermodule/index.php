<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsermoduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Usermodules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usermodule-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
         //   ['class' => 'yii\grid\SerialColumn'],

     //       'id',

            [
           //     'headerOptions' => ['width' => '170'],
                'attribute' => 'uid',
                'label' => '用户',
                'format' =>'html',
                'filter' => Html::activeDropDownList($searchModel, 'uid', $listUsers, ['class' => 'form-control']),
                'value' => function ($model) {
                    $uid=$model->uid;
                    $user=\common\models\User::findOne($uid);
                       return Html::a($user->username, ['/vcards/index', 'uid'=>$uid]);
                },
            ],

            [

                'attribute' => 'moduleid',
                'label' => '模块',
                'format' =>'html',
                'filter' => Html::activeDropDownList($searchModel, 'moduleid', $listModules, ['class' => 'form-control']),
                'value' => function ($model) {
                    $moduleid=$model->moduleid;
                    $module=\frontend\models\Module::findOne($moduleid);
                    return Html::a($module->module_label, ['/module/view', 'id'=>$moduleid]);
                },
            ],






            [

                'attribute' =>  'module_status',
                'label' => '是否启用',
                'filter' => Html::activeDropDownList($searchModel, 'module_status', [''=>'全部', 10=>'启用', 0=>'未启用'], ['class' => 'form-control']),
                'value' => function ($model) {
                    $status=$model->module_status;
                    return $status ? '启用' : '未启用';
                },
            ],


            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}{update}{delete}'],
        ],
    ]); ?>

</div>
