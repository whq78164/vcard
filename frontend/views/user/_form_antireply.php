<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiReply */
/* @var $form ActiveForm */
?>
<div class="anti-_form_antireply col-md-8">

    <?php $form = ActiveForm::begin(); ?>

        <?//= $form->field($model, 'uid') ?>
        <?//= $form->field($model, 'tag')->label('标签') ?>
        <?= $form->field($model, 'success')->textarea()->label('查询成功回复：')->hint('用于返回查询结果，动态变量：[SecurityCode](防伪码)、[number](次数)、[Factory](生产厂家)、[Effedate](有效日期)、[Products](产品名称)、[Brand](产品品牌)、[Spec](规格参数)、[Weight](产品重量)、[Remarks](备注)、[CreditName](积分名称)、[CreditNum](积分数)') ?>
        <?= $form->field($model, 'fail')->textarea()->label('查询失败回复语：') ?>
    <?= $form->field($model, 'content')->widget('frontend\assets\UeditorWidget',[
        'serverparam'=>[
            'myuploadpath'=> Yii::getAlias('@web/Uploads/').Yii::$app->user->id,
        ],
        'options'=>[
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
        <?//= $form->field($model, 'valid_clicks') ?>
    
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?//= Html::submitButton(Yii::t('tbhome', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- anti-_form_antireply -->
