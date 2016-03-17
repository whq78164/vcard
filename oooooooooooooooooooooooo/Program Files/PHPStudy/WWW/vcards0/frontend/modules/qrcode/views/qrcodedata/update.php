<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCode */

$this->title = '修改二维码信息';
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Anti Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="row">

    <h1><?//= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listReply'=>$listReply,
        'listProduct'=>$listProduct,

    ]) ?>

</div>
