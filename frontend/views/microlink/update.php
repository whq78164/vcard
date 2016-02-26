<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Microlink */

$this->title = Yii::t('tbhome', "$model->link_title");
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Microlinks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->link_title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="microlink-update">

    <h1><?//= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
