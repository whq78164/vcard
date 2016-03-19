<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Worker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-8">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->dropDownList($listCompanys)->label('选择所属公司') ?>

    <?= $form->field($model, 'department_id')->dropDownList($listDepartments)->label('选择所属部门') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'head_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_tel')->textInput(
   //     ['maxlength' => true]
    ) ?>
    <?= $form->field($model, 'fax')->textInput(
   //     ['maxlength' => true]
    ) ?>

    <?= $form->field($model, 'wechat_account')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'wechat_qrcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_work')->dropDownList([10=>'在职',0=>'离职'])?>

    <?= $form->field($model, 'remark')->textarea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





