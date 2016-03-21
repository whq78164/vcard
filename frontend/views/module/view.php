<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View ****/
/* @var $model frontend\models\Module */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">

    <div class="col-sm-12 col-md-8">
        <div class="container">


        <p>
            <?= Html::a(Yii::t('tbhome', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'modulename',
                'version',
                'module_label',
                'icon',
                'mark',
                'markclass',
                'module_des:ntext',
            ],
        ]) ?>

    </div>


        <div class="row">
            <div class="col-md-4">
                <?= Html::button('一键更新', ['id' => 'update', 'class' => ' btn btn-success']) ?>
            </div>

            <div class="col-md-4">
                <?= Html::button('清除版本信息', ['id' => 'clearv', 'class' => 'btn btn-danger']) ?>
            </div>
        </div>


        <div id="ReturnResult">  </div>
    </div>


    <div class="col-sm-12 col-md-4">
        <?php
        if($fileList){
            echo '<div class="alert alert-danger">';
            echo '您的系统文件有更新，请升级！';
            foreach($fileList as $value){echo ' <br/>'.$value;}
            echo '</div>';
        }else{
            echo '<div class="alert alert-info">';
            echo '恭喜！您的系统为最新版，无需升级';
            echo '</div>';
        }
        ?>
    </div>

</div>




<script Charset="UTF-8" type="text/javascript">

    $(document).ready(function(){
        $("#update").click(function(){
            if(confirm("升级前，请做好数据备份！")) {

                var url = "<?=Url::to(['onlineupdate'],true)?>";
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var data = {
                    _csrf: csrfToken,
                    id: <?=$model->id?>
                    //              FWuid: FWuid
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

                var url="<?=Url::to(['clearv'],true)?>";
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                var data={
                    _csrf: csrfToken,
                    id: <?=$model->id?>
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