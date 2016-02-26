<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Label */

$this->title = Yii::t('tbhome', 'Update') . ' ' . $model->card_label;

$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Labels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->card_label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="label-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
