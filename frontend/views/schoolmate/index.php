<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SchoolmateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Schoolmates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schoolmate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('tbhome', 'Create Schoolmate'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //    'id',
            'name',
            'mobile',
            'qq',
            'job',
            //    'sex',
            'grade',
            'major',
            'studentid',
            // 'idcardnum',
            //     'address',
            //    'city',

            // 'jobtitle',
            // 'honour:ntext',
            // 'worktel',
            // 'hometel',

            // 'email:email',

            // 'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
