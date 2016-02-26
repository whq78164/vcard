<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Department */

$this->title = Yii::t('tbhome', 'Create Department');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
