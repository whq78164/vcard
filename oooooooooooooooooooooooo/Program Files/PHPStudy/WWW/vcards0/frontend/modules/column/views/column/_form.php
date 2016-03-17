<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Column */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-10">

    <?php $form = ActiveForm::begin(); ?>

    <?= $model->isNewRecord ? $form->field($model, 'column')->textInput()->hint('必填：只能包含小写英文字母，数字，下划线，并且小写字母开头，3-20位字符'): '' ?>

    <?= $form->field($model, 'type')->dropDownList([
        'qrcode'=>'二维码数据字段',
        'vcards'=>'微名片字段',
    ]) ?>
    <?= $form->field($model, 'label')->textInput(['maxlength' => true])->hint('必填') ?>

    <?= $form->field($model, 'value')->textarea()->hint('选填') ?>

    <?= $form->field($model, 'remark')->textarea()->hint('选填') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
