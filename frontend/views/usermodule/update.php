<?php

//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usermodule */

$this->title = Yii::t('tbhome', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Usermodules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="usermodule-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listModules' => $listModules,
        'listUsers'=> $listUsers
    ]) ?>

</div>
