<?php

use yii\helpers\Html;


/* @var $model frontend\modules\schoolmate\models\Schoolmate */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Schoolmate',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Schoolmates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="schoolmate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
