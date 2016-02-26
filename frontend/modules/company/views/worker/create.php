<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Worker */

$this->title = Yii::t('tbhome', 'Create Worker');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Workers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listCompanys'=>$listCompanys,
        'listDepartments'=>$listDepartments
    ]) ?>

</div>
