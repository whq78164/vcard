<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cloud */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Cloud',
]) . ' ' . $model->sitetitle;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Clouds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sitetitle, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="cloud-update col-md-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listPage'=> $listPage,
    ]) ?>

</div>
