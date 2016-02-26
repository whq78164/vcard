<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Setting */
/* @var $form ActiveForm */
?>

<?php $form = ActiveForm::begin([
        'id' => "article-form",
        'enableAjaxValidation' => false,
       'action'=> ['user/specialsetting'],
        'method'=>'post'

    ]); ?>


        <?//= $form->field($model, 'upline') ?>
        <?//= $form->field($model, 'status') ?>
        <?//= $form->field($model, 'leader') ?>
        <?/*= $form->field($model, 'bg_image', ['inputOptions'=>[
            'id'=>'image_select',
            'onchange'=>"image_view.src=this.value"
        ]])->dropDownList([
            'Uploads/bg_image/tbhome.jpg'=>'默认',
            'Uploads/bg_image/mpbg1.jpg'=>'背景1',
            'Uploads/bg_image/mpbg3.jpg'=>'背景3',
            'Uploads/bg_image/soqi.jpg'=>'梦幻',
            $model->bg_image => '自定义',
            ]) */?>
<div class="panel panel-primary">
    <div class="panel panel-heading">背景图片：</div>
    <div class="panel panel-body">
    <?= $form->field($model, 'bg_image', ['inputOptions'=>[
        'id'=>'image_text',
     //   'onchange'=>"image_view.src=this.value",
        'class'=>"form-control"
    ]])->textInput()->label('图片链接地址(支持http远程资源调用)：') ?>

    <label>快速选择：</label>
    <select id = "select1"  onchange="changeselect1()" name="bgimg_url" class="form-control">
        <option value="Uploads/bg_image/tbhome.jpg">默认(通宝科技)
        <option value="Uploads/bg_image/mpbg11.jpg">热气球
        <option value="Uploads/bg_image/mpbg1.jpg">典雅红
        <option value="Uploads/bg_image/mpbg3.jpg">magic
        <option value="Uploads/bg_image/soqi.jpg">soqi
        <option id="selected" value="<?=$model->bg_image?>">自定义
    </select>
        </div>
    <script>
        document.getElementById("select1").value=document.getElementById("selected").value;
        document.getElementById("image_text").value=document.getElementById("select1").value;
        function changeselect1(){
            document.getElementById("image_text").value=document.getElementById("select1").value;
            document.getElementById("image_view").src=document.getElementById("select1").value;
        }
    </script>

</div>

    <?= $form->field($model, 'tpl')->dropDownList([
        '0'=>'默认',
        '1'=>'舒华'
    ]) ?>

    <div class="form-group">
        <br/>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>



    <?php ActiveForm::end(); ?>


