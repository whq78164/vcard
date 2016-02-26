<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Cloud */

$this->title = Yii::t('tbhome', 'Create Cloud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Clouds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cloud-create col-md-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listPage'=> $listPage,
    ]) ?>

</div>
