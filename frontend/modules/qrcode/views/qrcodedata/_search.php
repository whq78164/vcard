<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anti-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?//= $form->field($model, 'id') ?>

    <?//= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'replyid') ?>

    <?= $form->field($model, 'productid') ?>

    <?php  echo $form->field($model, 'query_time') ?>

    <?php // echo $form->field($model, 'clicks') ?>

    <?php  echo $form->field($model, 'prize') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tbhome', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tbhome', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
