<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cloud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cloud-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sitetitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siteurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'copyright')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'welcome')->textarea() ?>
    <?= $form->field($model, 'pageid1')->dropDownList($listPage) ?>

    <?= $form->field($model, 'pageid2')->dropDownList($listPage) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
