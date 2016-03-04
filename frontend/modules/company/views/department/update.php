<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Department */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Department',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="department-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
