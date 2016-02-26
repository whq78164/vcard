<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WorkerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="worker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'qq') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'head_img') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'task') ?>

    <?php // echo $form->field($model, 'work_tel') ?>

    <?php // echo $form->field($model, 'wechat_account') ?>

    <?php // echo $form->field($model, 'wechat_qrcode') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'is_work') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('tbhome', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('tbhome', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
