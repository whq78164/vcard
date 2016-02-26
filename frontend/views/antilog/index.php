<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AntiLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', '生产记录');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anti-log-index col-md-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a(Yii::t('tbhome', 'Create Anti Log'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       //     'id',
            'startid',
            'endid',
         //   'url:url',
         //   'time:datetime',
            ['attribute' => 'time', 'format' => ['date', 'php:Y-m-d_H:m:s']],
            'remark',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'下载数据',
                'buttons' => [
                    'view'=> function(){},
                    'delete'=>function(){},
                    'update' => function ($url, $model) {
                     return Html::a('', ['excel','start' => $model->startid,'end'=>$model->endid], [
                         'title' => Yii::t('yii', '下载表格'), 'class'=>"glyphicon glyphicon-download-alt"
                         ]
                     );}
             ],
            ],
        ],
    ]); ?>

</div>
