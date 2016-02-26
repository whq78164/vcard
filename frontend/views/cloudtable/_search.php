<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CloudSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cloud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sitetitle') ?>

    <?= $form->field($model, 'siteurl') ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'qq') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'copyright') ?>

    <?php // echo $form->field($model, 'icp') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'pageid1') ?>

    <?php // echo $form->field($model, 'pageid2') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tbhome', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tbhome', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
