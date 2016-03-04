<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CloudSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Clouds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-md-10">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('tbhome', 'Create Cloud'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sitetitle',
            'siteurl:url',
            'company',
            'tel',
             'qq',
            // 'email:email',
            // 'address',
            // 'copyright',
            // 'icp',
            // 'ip',
            // 'pageid1',
            // 'pageid2',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>