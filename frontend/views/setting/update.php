<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Setting */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Setting',
]) . ' ' . $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
