<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'share') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'factory') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'describe') ?>

    <?php // echo $form->field($model, 'specification') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'hot') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tbhome', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tbhome', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
