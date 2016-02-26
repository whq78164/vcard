<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCode */
/* @var $form ActiveForm */
?>

<div class="row">
<div class="col-md-8">
    <h1><?= Html::encode('批量修改') ?></h1>

    <?php $form = ActiveForm::begin(
        ['action'=>['anti/modifycode']]
    ); ?>

        <?= $form->field($model, 'id')->label('起始序号') ?>


    <div class="form-group field-anticodenew-id">
        <label class="control-label" for="anticodenew-id">结束序号</label>
        <input type="text" id="anticodenew-id" class="form-control" name="AntiCodenew[idend]">

        <div class="help-block"></div>
    </div>



    <?= $form->field($model, 'productid')->dropDownList($listProduct)->label('产品选择') ?>
        <?= $form->field($model, 'replyid')->dropDownList($listReply)->label('回复语选择') ?>
		
        <?= $form->field($model, 'prize')->label('奖品')->widget('frontend\assets\UeditorWidget',[
            'serverparam'=>[
                'myuploadpath'=> Yii::getAlias('@web/Uploads/').$model['uid'],
            ],
            'options'=>[///&lt;br/&gt;为换行符号。
                'focus'=>true,
                'toolbars'=> [
                    ['fullscreen', 'source', 'undo', 'redo','paragraph','fontfamily','fontsize', 'justifyleft', 'justifyright', 'justifycenter','link','unlink','emotion', 'simpleupload', 'insertimage', 'map','print', 'spechars','horizontal'],
                    ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'cleardoc','drafts', 'background', 'preview']
                ],
            ],

            'attributes'=>[
                'style'=>'height:80px'
            ]
        ]); ?>
    <?= $form->field($model, 'remark')->label('备注')->hint('选填')->textarea() ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('tbhome', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- anti-_form_gencode -->


<div class="col-md-4">
    <br>  <br>  <br>  <br>
    <p>
    <?=Html::a('历史记录',['/antilog/index'], ['class'=>'btn btn-success'])?>
</p>
</div>


</div>