<?php
/* @var $this yii\web\View */
//use frontend\assets\AmazeAsset;
//AmazeAsset::register($this);
//use yii\helpers\Html;
//use common\widgets\Alert;

use frontend\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>">
    <title><?=$antireply->tag?></title>
    <!-- Bootstrap core CSS -->
    <script Charset="UTF-8" type="text/javascript">
        /*
        $(document).ready(function(){
            $("button").click(function(){

//                var FWcode = document.getElementById('FWcode').value;
            var FWcode = $("#FWcode").val();
//                var FWuid = document.getElementById('FWuid').value;
            var FWuid = $("#FWuid").val();
                $.post("<?=yii\helpers\Url::to(['anti/antiquery'],true)?>", {
                    FWcode: FWcode,
                    FWuid: FWuid
                }, function(data,status){
                    document.getElementById('ReturnResult').innerHTML = data;
                });
          });

        });
         */
        function fwcx() {
//var FWcode = document.getElementById('FWcode').value;
            var FWcode = $("#FWcode").val();
//var FWuid = document.getElementById('FWuid').value;
            var FWuid = $("#FWuid").val();
            var replyid = $("#replyid").val();

//alert (FWcode1);
            $.post("<?=yii\helpers\Url::to(['anti/antiquery'],true)?>", {
                FWcode: FWcode,
                replyid: replyid,
                FWuid: FWuid
            }, function(data,status){
                document.getElementById('ReturnResult').innerHTML = data;
                //alert("Data: " + data + "\nStatus: " + status);
            });
        }

    </script>

    <style type = "text/css">
        img{max-width:100%;}


    </style>
    <!--body{font-family:"微软雅黑,宋体"; line-height:1.5em; font-size: 18px; }-->
    <?php $this->head() ?>
</head>

<body style="background-color: #eee;padding-top: 40px; padding-bottom: 40px;">
<?php $this->beginBody() ?>
<h3 class="form-signin-heading text-center"><?=$antireply->tag?></h3>

<div class="container">

    <br/>
    <label class="pull-left">请输入防伪编码：</label>
    <input type="text" class="form-control" placeholder="请输入防伪密码" name="FWcode" id="FWcode">
    <br>
    <INPUT type="hidden" id="replyid" name="replyid" value="<?=$replyid?>" />
    <INPUT type="hidden" id="FWuid" name="FWuid" value="<?=$antireply->uid?>" />
    <button id="button" class="btn btn-lg btn-primary btn-block" onclick="fwcx()" >点击验证</button>
    <br>
    <div class="alert alert-info" id="ReturnResult">

    </div>
    <label class="pull-right"><?//=$setting->brand?></label>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>