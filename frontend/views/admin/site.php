<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Site */
/* @var $form ActiveForm */
?>
<div class="row">
<div class="col-sm-12 col-md-8">


        <h1><?= Html::encode('站点设置') ?></h1>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'sitetitle')->textInput(['placeholder'=>'必填'])?>
        <?= $form->field($model, 'tel')->textInput(['placeholder'=>'必填']) ?>
        <?= $form->field($model, 'qq')->textInput(['placeholder'=>'必填']) ?>
        <?= $form->field($model, 'email')->textInput(['placeholder'=>'必填']) ?>
        <?= $form->field($model, 'siteurl')->textInput(['placeholder'=>'必填']) ?>
        <?//= $form->field($model, 'logo') ?>
        <?//= $form->field($model, 'keywords') ?>
        <?//= $form->field($model, 'ip') ?>
        <?//= $form->field($model, 'status') ?>
        <?= $form->field($model, 'company') ?>
        <?//= $form->field($model, 'address') ?>
        <?= $form->field($model, 'copyright') ?>
        <?= $form->field($model, 'icp') ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('tbhome', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    <!-- admin-site -->
</div>
</div>