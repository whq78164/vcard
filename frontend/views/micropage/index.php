<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Micropage;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MicropageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Micropages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">

    <h1><?//= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('tbhome', 'Create Micropage'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
       // 'uid',

            'page_title',

       //     'page_content:ntext',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
