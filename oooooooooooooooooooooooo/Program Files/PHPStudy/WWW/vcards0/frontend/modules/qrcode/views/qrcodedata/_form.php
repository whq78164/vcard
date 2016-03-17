<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-8">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'uid')->hiddenInput()->label('') ?>

    <?= $form->field($model, 'code')->textInput([
        'id'=>'code',
        'onchange'=>"checkstr(this.value)"
    ])->label('唯一码(防伪码、追溯码)') ?>
    <!--input class="form-control" id="sStr" name="sStr" type="text" placeholder="" onchange="checkstr(this.value)" -->
    <div class="form-group" id="txtHint"></div>



    <?= $form->field($model, 'replyid')->dropDownList($listReply)->label('回复语模板') ?>


    <?= $form->field($model, 'productid')->dropDownList($listProduct)->label('选择产品') ?>

    <?= $form->field($model, 'query_time')->textInput() ?>

    <?= $form->field($model, 'clicks')->textInput() ?>



        <div class="box box-info collapsed-box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">数据字段</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> 提示!</h4>
                    回复语模板中设置的变量字段，将被该选项替换
                </div>

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



                <?php

                if (!empty($model->dataColumns())){
                    $Mycolumn=$model->dataColumns();
                    
                    foreach($Mycolumn as $key => $value){

                        echo $form->field($model, $key)->textarea();
                    }

                }

              ?>







            </div>
            <!-- /.box-body -->
        </div>









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
            url: "<?=Url::to(['/qrcode/qrcode/checkstr'], true)?>",
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
