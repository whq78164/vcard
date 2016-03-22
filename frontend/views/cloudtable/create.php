<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Cloud */

$this->title = Yii::t('tbhome', 'Create Cloud');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Clouds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'listPage'=> $listPage,
            'listModules'=>$listModules,
        ]) ?>

    </div>

</div>

