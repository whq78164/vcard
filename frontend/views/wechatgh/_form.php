<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Wechatgh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wechatgh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'id')->textInput() ?>

    <?//= $form->field($model, 'uid')->textInput() ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'email')->textInput()->label('登录邮箱') ?>
    <?= $form->field($model, 'appid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'appsecret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mchid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mchsecret')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'token')->textInput() ?>

    <?= $form->field($model, 'aeskey')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
