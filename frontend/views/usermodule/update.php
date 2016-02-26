<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usermodule */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Usermodule',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Usermodules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="usermodule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listModules' => $listModules,
        'listUsers'=> $listUsers
    ]) ?>

</div>
