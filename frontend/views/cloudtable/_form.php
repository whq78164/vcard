<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cloud */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sitetitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siteurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput() ?>
    <?= $form->field($model, 'server_name')->textInput() ?>

    <br/>
    <div class="form-group field-cloud-modules">
        <?=Html::label('已开通的模块列表：', 'for_id',['class'=>'control-label'])?>

        <?= '<br>'.Html::encode($model->modules) ?>
<?php
$displyModules=json_decode(stripslashes($model->modules),true);
$displyModules=$displyModules['modules'];
?>
        <?= Html::checkboxList('modules', $displyModules, $listModules, [
            'class'=>'form-control',
            'id'=>'class',
        ]);?>
        <div class="help-block"></div>
    </div>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'copyright')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip')->textInput() ?>


    <?= $form->field($model, 'welcome')->textarea() ?>
    <?= $form->field($model, 'pageid1')->dropDownList($listPage) ?>

    <?= $form->field($model, 'pageid2')->dropDownList($listPage) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
