<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\assets\MapAsset;
MapAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-8">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'address')->textInput([
        'placeholder'=>'',
        'id'=>'lbsaddress',
    ])->hint('<span class="help-inline">输入地址后，点击“自动定位”按钮可以在地图上定位。</span><br>
    <span class="help-inline">（如果输入地址后无法定位，请在地图上直接点击选择地点）</span>') ?>

    <?=Html::button('自动定位(搜索)', ['id'=>'locate-btn', 'class'=>'btn btn-success '])?>
    <span class="fa fa-compass fa-2x text-info"></span><br>


    <div id="map" style="width: 100%;height: 300px;"></div>

    <?=$form->field($model, 'latitude')->textInput(['id'=>'latitude'])?>
    <?=$form->field($model, 'longitude')->textInput(['id'=>'longitude'])?>


    <?//= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpl')->dropDownList([0=>'默认', 1=>'舒华']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


