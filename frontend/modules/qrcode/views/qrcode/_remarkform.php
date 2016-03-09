<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Alert;
/* @var $this yii\web\View */
/* @var $model frontend\models\QrcodeCode */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
<div class="col-md-10">
    <?= Alert::widget() ?>
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'action' => [
            '/qrcode/qrcode/updateremark',
            'id'=>$codeData['id'],
            'replyid'=>$replyid,
        ],
    ]); ?>


    <div class="form-group field-contactform-body required">
        <label class="control-label" for="contactform-body">提交内容</label>
        <textarea id="contactform-body" class="form-control" name="remark" rows="6"><?=$codeData['remark']?></textarea>

        <p class="help-block help-block-error"></p>
    </div>


    <div class="form-group">
        <?= Html::submitButton('提交', ['class' =>  'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    </div>
