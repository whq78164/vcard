<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiSetting */
/* @var $form ActiveForm */
?>

<div class="anti-_form_antisetting col-md-8">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'brand') ?>
        <?//= $form->field($model, 'image') ?>
        <?= $form->field($model, 'api_parameter')->label('对接参数') ?>
        <?= $form->field($model, 'api_select')->label('第三方系统对接')->dropDownList(['20'=>'唯卡微信平台']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>




    <?php ActiveForm::end(); ?>
</div>
<!-- anti-_form_antisetting -->
