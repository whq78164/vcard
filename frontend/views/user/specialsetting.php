<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Info $qrcode*/

$this->title = Yii::t('tbhome', '个性设置');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Infos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', '微名片'), 'url' => ['user/vcards']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">

    <div class="col-md-8">

        <?= $this->render('_form_setting', [
            'model' => $model,
        ]) ?>
    </div>


        <div class="col-md-4">
            <?php
            if ($role!==10){
            echo $this->render('_form_background', [
                'image' => $image,
                'action' => ['user/postbackground'],
            ]);} ?>



            <div  class="panel panel-primary">
                <div class="panel-heading">背景</div>
                <?=Html::img($model->bg_image, ['id'=>'image_view', 'style'=>'width:100%; height:100%', 'class'=>'thumbnail'])?>
            </div>

            <!--script>
              //  $(document).ready(function(){
 //                   $("bgSelect").onChange(function(){
                    //    document.getElementById("select").value="{$data.bgimg_url}";
  //                      document.getElementById("image_view").src=document.getElementById("image_select").value;
  //                  });

            //    });

            </script-->


        </div>








</div>

