<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bg_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpl')->dropDownList(['0'=>'默认']) ?>
    <?//= $form->field($model, 'vip')->dropDownList(['10'=>'默认', '20'=>'VIP', '30'=>'企业版']) ?>

    <?//= $form->field($model, 'upline')->textInput() ?>



    <?//= $form->field($model, 'leader')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
