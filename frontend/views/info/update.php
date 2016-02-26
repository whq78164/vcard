<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Info */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Info',
]) . ' ' . $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->uid, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
