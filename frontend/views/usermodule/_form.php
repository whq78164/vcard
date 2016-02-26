<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usermodule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usermodule-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->dropDownList($listUsers) ?>

    <?= $form->field($model, 'moduleid')->dropDownList($listModules) ?>

    <?= $form->field($model, 'module_status')->dropDownList([
        10=>'开启',
        0=>'关闭'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
