<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'密码至少应包含6个字符！'])//->hint('管理员请注意！新密码至少应包含6个字符，否则账户将被锁死！') ?>


    <?= $form->field($model, 'qq')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'status')->textInput() ?>

    <?//= $form->field($model, 'login')->textInput() ?>

    <?//= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'role')->dropDownList([
        '10'=>'普通会员',
        '20'=>'VIP会员',
       // '30'=>'企业版会员',
        '40'=>'微防伪会员',
        '50'=>'微防伪白金会员',
        '60'=>'质量追溯会员',
       // '80'=>'至尊会员',
        '100'=>'系统管理员'
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([10=>'启用', 0=>'禁用']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
