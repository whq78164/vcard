<?php
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap\BootstrapAsset;////
//BootstrapAsset::register($this);
?>


<h1><?=$model->sitetitle?></h1>


<div class="row">

    <div class="col-sm-12 col-md-8 ">
        <?=$model->welcome?>
        <br/>
        <?//=$model->page1?>



        <!--div class="col-sm-12 col-md-8 "-->

       
                <div class="row">
                    <div class="col-md-4">
                        <?= Html::button('一键更新', ['id' => 'update', 'class' => ' btn btn-success']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= Html::button('备份数据库', ['id' => 'backup', 'class' => 'btn btn-primary']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= Html::button('清除版本信息', ['id' => 'clearv', 'class' => 'btn btn-danger']) ?>
                    </div>
                </div>
    
            <br/>

            <div id="ReturnResult">
            </div>
        <!--/div-->



        <!--div class="col-sm-12 col-md-8"-->
            <?php
            if($diffFiles){
                echo '<div class="alert alert-danger">';
                echo '您的系统文件有更新，请升级！';
                foreach($diffFiles as $value){echo ' <br/>'.$value;}
                echo '</div>';
            }else{
                echo '<div class="alert alert-success">';
                echo '恭喜！您的系统为最新版，无需升级';
                echo '</div>';
            }
            ?>
        <!--/div-->








    </div>

    <div class="col-sm-12 col-md-4">
        当前版本：
        <strong>v<?php
            if (isset($site->version)){
                echo $site->version;//sprintf('%.2f', $site->version);
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
            if(confirm("升级前，请做好数据备份！")) {

                //        var FWcode = document.getElementById('FWcode').value;
                //       var FWcode = $("#FWcode").val();

                var url = "<?=Url::to(['update/index'],true)?>";
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var data = {
                    _csrf: csrfToken
                };

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function (data, status) {
                        document.getElementById('ReturnResult').innerHTML = data;//+status;
                    }
                    //   dataType: html
                });

            }

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

        $("#backup").click(function(){
            //    if(confirm("确认清除？提示：请在技术人员指导下操作！")){

            var url="<?=Url::to(['update/backupdb'],true)?>";
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

            //        }

        });















    });
</script>