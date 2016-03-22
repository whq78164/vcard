<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wechatgh */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Wechatghs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechatgh-view">



    <p>
        <?= Html::a(Yii::t('tbhome', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'uid',
            'appid',
            'appsecret',
            'mchid',
            'mchsecret',
        ],
    ]) ?>

</div>
