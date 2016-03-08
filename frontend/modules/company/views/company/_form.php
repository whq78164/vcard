<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-8">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'address')->textInput([
        'placeholder'=>'',
        'id'=>'lbsaddress',
    ])->hint('<span class="help-inline">输入地址后，点击“自动定位”按钮可以在地图上定位。</span><br>
    <span class="help-inline">（如果输入地址后无法定位，请在地图上直接点击选择地点）</span>') ?>

    <?=Html::button('自动定位(搜索)', ['id'=>'locate-btn', 'class'=>'btn btn-success '])?>
    <span class="fa fa-compass fa-2x text-info"></span><br>


    <div id="map" style="width: 100%;height: 300px;"></div>

    <?=$form->field($model, 'latitude')->textInput(['id'=>'latitude'])?>
    <?=$form->field($model, 'longitude')->textInput(['id'=>'longitude'])?>


    <?//= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpl')->dropDownList([0=>'默认', 1=>'舒华']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<script Charset="UTF-8" type="text/javascript">
    /**
     * Created by admin on 2016-03-06.
     */
//是否从未保存过定位信息，如果从未保存过，并且有填地址信息，那么进入页面后自动定位
    var located = true;
    //定位坐标
    var destPoint = new BMap.Point($('#longitude').val(),$('#latitude').val());
    $(function(){
        /**开始处理百度地图**/
        var map = new BMap.Map("map");
        map.centerAndZoom(new BMap.Point(destPoint.lng, destPoint.lat), 12);//初始化地图
        map.enableScrollWheelZoom();
        map.addControl(new BMap.NavigationControl());
        var marker = new BMap.Marker(destPoint);
        map.addOverlay(marker);//添加标注
        map.addEventListener("click", function(e){
            if(confirm("确认选择这个位置？")){
                destPoint = e.point;
                $('#longitude').val(destPoint.lng);
                $('#latitude').val(destPoint.lat);
                map.clearOverlays();
                var marker1 = new BMap.Marker(destPoint);  // 创建标注
                map.addOverlay(marker1);
            }
        });



        var myValue;

        var local;
        function setPlace(){
            map.clearOverlays();    //清除地图上所有覆盖物
            local = new BMap.LocalSearch(map, { //智能搜索
                renderOptions:{ map: map}
            });
            located = true;
            local.setMarkersSetCallback(callback);
            local.search(myValue);
        }

        function addEventListener(marker){
            marker.addEventListener("click", function(data){
                destPoint = data.target.getPosition(0);
            });
        }
        function callback(posi){
            $("#locate-btn").removeAttr("disabled");
            for(var i=0;i<posi.length;i++){
                if(i==0){
                    destPoint = posi[0].point;
                }
                posi[i].marker.addEventListener("click", function(data){
                    destPoint = data.target.getPosition(0);
                });
            }
        }

        $("#lbsl_xianqu").change(function(){
            $("#locate-btn").attr("disabled","disabled");
            local = new BMap.LocalSearch(map, { //智能搜索
                renderOptions:{ map: map}
            });
            located = true;
            local.setMarkersSetCallback(callback);
            local.search($("#lbsl_xianqu").find('option:selected').text());
            return false;
        });
        $("#lbsl_shi").change(function(){
            $("#locate-btn").attr("disabled","disabled");
            local = new BMap.LocalSearch(map, { //智能搜索
                renderOptions:{ map: map}
            });
            located = true;
            local.setMarkersSetCallback(callback);
            local.search($("#lbsl_shi").find('option:selected').text());
            return false;
        });
        $("#locate-btn").click(function(){
            if($("#lbsaddress").val() == ""){
                alert("请输入门店地址！");
                return false;
            }
            $("#locate-btn").attr("disabled","disabled");
            local = new BMap.LocalSearch(map, { //智能搜索
                renderOptions:{ map: map}
            });
            located = true;
            local.setMarkersSetCallback(callback);
            local.search($("#lbsaddress").val());
            return false;
        });
        /**结束百度地图处理**/
    });
</script>