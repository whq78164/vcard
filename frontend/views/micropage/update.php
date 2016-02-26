<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Micropage */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => $model->page_title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Micropages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->page_title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
