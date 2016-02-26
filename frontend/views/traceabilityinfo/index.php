<?php

use yii\helpers\Html;
//use kartik\grid\GridView;
//use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TraceabilityinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Traceabilityinfo');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="traceabilityinfo-index col-md-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
  //          'uid',
            'code',
            'label',
 //           'describe:html',
             'remark',

            // 'create_time:datetime',
            // 'status',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],
    ]); ?>

</div>
