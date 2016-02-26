<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Traceabilityinfo */

$this->title = Yii::t('tbhome', 'Add');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Traceabilityinfo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traceabilityinfo-create col-md-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
