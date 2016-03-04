<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wechatgh */

$this->title = Yii::t('tbhome', 'Wechatgh');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Wechatgh'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="wechatgh-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
