<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LabelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '新增字段';//Yii::t('tbhome', 'Labels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="label-index col-md-10">

    <h1><?//= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('tbhome', 'create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
        //    'uid',
            'card_label',
            'card_value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
