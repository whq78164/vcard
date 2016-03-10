<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Column');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="column-index">


    <p>
        <?= Html::a(Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

     //       'id',
       //     'uid',
            'type',
            'value',
            'label',
             'remark',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}'],
        ],
    ]); ?>

</div>
