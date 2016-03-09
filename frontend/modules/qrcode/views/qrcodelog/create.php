<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AntiLog */

$this->title = Yii::t('tbhome', 'Create Anti Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Anti Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anti-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
