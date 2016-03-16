<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCode */
/* @var $form ActiveForm */
?>

<div class="row">
<div class="col-md-8">
    <h1><?= Html::encode('批量修改') ?></h1>

    <?php $form = ActiveForm::begin(
        ['action'=>['qrcode/modifycode']]
    ); ?>

        <?= $form->field($model, 'id')->label('起始序号') ?>


    <div class="form-group field-anticodenew-id">
        <label class="control-label" for="anticodenew-id">结束序号</label>
        <input type="text" id="anticodenew-id" class="form-control" name="QrcodeData[idend]">

        <div class="help-block"></div>
    </div>



    <?= $form->field($model, 'productid')->dropDownList($listProduct)->label('产品选择') ?>
        <?= $form->field($model, 'replyid')->dropDownList($listReply)->label('回复语选择') ?>





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

            <?= $form->field($model, 'prize')->label('奖品')->hint('选填')->textarea()  ?>
            <?= $form->field($model, 'remark')->label('备注')->hint('选填')->textarea() ?>




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
            <?= Html::submitButton(Yii::t('tbhome', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- anti-_form_gencode -->


<div class="col-md-4">
    <br>  <br>  <br>  <br>
    <p>
    <?=Html::a('历史记录',['qrcodelog/index'], ['class'=>'btn btn-success'])?>
</p>
</div>


</div>