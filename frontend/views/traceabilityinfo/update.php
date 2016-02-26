<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Traceabilityinfo */

$this->title = Yii::t('tbhome', $model->label);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Traceabilityinfo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="traceabilityinfo-update col-md-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
