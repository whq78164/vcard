<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\InfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'card_title') ?>

    <?= $form->field($model, 'unit') ?>

    <?= $form->field($model, 'face_box') ?>

    <?= $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'business') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'wechat_account') ?>

    <?php // echo $form->field($model, 'wechat_qrcode') ?>

    <?php // echo $form->field($model, 'work_tel') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tbhome', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tbhome', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
