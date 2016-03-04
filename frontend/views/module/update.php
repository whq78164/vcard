<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Module */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Module',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="module-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
