<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Infos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a(Yii::t('tbhome', 'Create Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
       //     ['class' => 'yii\grid\SerialColumn'],

            'uid',
      //      'card_title',
            'unit',
       //     'face_box',
 //           'department',
             'position',
             'address',
         //    'business:ntext',
      //       'signature:ntext',
            // 'fax',
            // 'location',
             'wechat_account',
            // 'wechat_qrcode',
             'work_tel',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
