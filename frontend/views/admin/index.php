<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>


<h1><?=$model->sitetitle?></h1>


<div class="row">



    <div class="col-sm-12 col-md-8 ">


<?=$model->welcome?>
        <br/>
        <?//=$model->page1?>


        <?php
        if($model->status>9) {
            ?>

            <?= Html::button('一键更新', ['id' => 'update', 'class' => 'pull-left btn btn-success']) ?>
            <?= Html::button('清除版本信息', ['id' => 'clearv', 'class' => 'pull-right btn btn-danger']) ?>
            <br>
            <?php
       }
        ?>
        <div class="alert " id="ReturnResult">
            <?php
            print_r($diffFiles);
            ?>
        </div>

        <!--input name="_csrf" type="hidden" id="_csrf" value="<?//= Yii::$app->request->csrfToken ?>"-->

    </div>


    <div class="col-sm-12 col-md-4">
        当前版本：
        <strong>v<?php
        if (isset($site->version)){
            echo sprintf('%.2f', $site->version);
        }
        ?>
            </strong>
        <br/><br/>

        <strong>更新记录：</strong>

        <br/>
        <?=$model->update?>

    </div>




</div>




<script Charset="UTF-8" type="text/javascript">

    $(document).ready(function(){

        $("#update").click(function(){

  //        var FWcode = document.getElementById('FWcode').value;

     //       var FWcode = $("#FWcode").val();
   //         var FWuid = $("#FWuid").val();
    //        var replyid = $("#replyid").val();
            var url="<?=Url::to(['update/index'],true)?>";
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
           var data={
               _csrf: csrfToken
 //               FWcode: FWcode,
   //             replyid: replyid,
  //              FWuid: FWuid
            };

            $.ajax({
                type: 'POST',
                url: url ,
                data: data ,
                success: function(data,status){
                    document.getElementById('ReturnResult').innerHTML = data;//+status;
                }
                //   dataType: html
            });

        });

        $("#clearv").click(function(){
            if(confirm("确认清除？提示：请在技术人员指导下操作！")){

                var url="<?=Url::to(['update/clearv'],true)?>";
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var data={
                    _csrf: csrfToken
                };
                    $.ajax({
                        type: 'POST',
                        url: url ,
                        data: data ,
                        success: function(data,status){
                            document.getElementById('ReturnResult').innerHTML = data;//+status;
                        }
                    });

                }



        });















    });
</script>