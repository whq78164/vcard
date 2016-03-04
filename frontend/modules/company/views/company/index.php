<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <p>
        <?= Html::a(Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'uid',
            'company',
            'address',
            'location',
             'tpl',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}{update}'],
        ],
    ]); ?>



    <p>微信接口（公众号内，回复工号，即可获取名片）：
        <?= Html::label(Url::to(['/wechatapi/api', 'uid'=>Yii::$app->user->id], true)) ?>
    </p>

</div>
