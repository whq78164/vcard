<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-10">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'uid')->hiddenInput()->label('') ?>

    <?= $form->field($model, 'code')->textInput([
        'id'=>'code',
        'onchange'=>"checkstr(this.value)"
    ])->label('唯一码(防伪码、追溯码)') ?>
    <!--input class="form-control" id="sStr" name="sStr" type="text" placeholder="" onchange="checkstr(this.value)" -->
    <div class="form-group" id="txtHint"></div>



    <?= $form->field($model, 'replyid')->dropDownList($listReply)->label('回复语模板') ?>
    <?= $form->field($model, 'traceabilityid')->textInput() ?>

    <?= $form->field($model, 'productid')->dropDownList($listProduct)->label('选择产品') ?>

    <?= $form->field($model, 'query_time')->textInput() ?>

    <?= $form->field($model, 'clicks')->textInput() ?>

    <?= $form->field($model, 'prize')->textarea() ?>
    <?= $form->field($model, 'remark')->widget('frontend\assets\UeditorWidget',[
        'serverparam'=>[
            'myuploadpath'=> Yii::getAlias('@web/Uploads/').Yii::$app->user->id,
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script type="text/javascript">
/*
    $(document).ready(function(){

        $("#code").onchange(function(){
            //                var FWcode = document.getElementById('FWcode').value;
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            var code = $("#code").val();
            var url="<?=Url::to(['/anti/checkstr'],true)?>";
            var data={
                sStr:code,
                _csrf:csrfToken
            };

//         $.post(url, data, function(data,status){
            //           document.getElementById('ReturnResult').innerHTML = data;});

            $.ajax({
                type: 'POST',
                url: url ,
                data: data ,
                dataType: "json",
                success: function(data,status){
                    if (data >= '1') {
                        document.getElementById("txtHint").innerHTML='<span class="alert alert-danger">数据库中已存在相同的唯一码'+data+'条,请修改</span>';
                    }else{
                        document.getElementById("txtHint").innerHTML='<span class="alert alert-success">唯一码可用</span>';
                    }//+status;
                }
                //   dataType: html
            });

        });


    });
*/


    function checkstr(sStr){
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        //  var dat='';
        $.ajax({
            type: "POST",
            url: "<?=Url::to(['/anti/checkstr'], true)?>",
            data: {
                sStr:sStr,
                _csrf:csrfToken
            },
            dataType: "json",
            success: function(data){
//        document.getElementById("txtHint").innerHTML='<span class="alert alert-success">前缀'+data+'可用</span>';

                if (data >= '1') {
                    document.getElementById("txtHint").innerHTML='<span class="alert alert-danger">数据库中已存在相同的唯一码'+data+'条,请修改</span>';
                }else{
                    document.getElementById("txtHint").innerHTML='<span class="alert alert-success">唯一码可用</span>';
                }//+status;

            }

        });


    }
</script>
