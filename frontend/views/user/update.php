<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . ' ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Users'), 'url' => ['indexuser']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="row">
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       // 'submitbutton' => $submitbutton,
    ]) ?>

</div>
</div>