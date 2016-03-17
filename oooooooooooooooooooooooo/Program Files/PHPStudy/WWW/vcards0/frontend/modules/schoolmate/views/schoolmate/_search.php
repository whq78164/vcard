<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\schoolmate\models\SchoolmateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schoolmate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sex') ?>

    <?= $form->field($model, 'grade') ?>

    <?= $form->field($model, 'major') ?>

    <?php // echo $form->field($model, 'studentid') ?>

    <?php // echo $form->field($model, 'idcardnum') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'job') ?>

    <?php // echo $form->field($model, 'jobtitle') ?>

    <?php // echo $form->field($model, 'honour') ?>

    <?php // echo $form->field($model, 'worktel') ?>

    <?php // echo $form->field($model, 'hometel') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'qq') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tbhome', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tbhome', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
