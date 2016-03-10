<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Module */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'modulename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'module_label')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'module_des')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'icon')->textInput()->hint('选填') ?>
    <?= $form->field($model, 'mark')->textInput()->hint('选填') ?>
    <?= $form->field($model, 'markclass')->textInput()->hint('选填') ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
