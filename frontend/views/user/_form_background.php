<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="panel panel-primary">
<div class="panel panel-heading">
自定义背景
</div>
        <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => "article-form",
                        'enableAjaxValidation' => false,
                        'options' => ['enctype' => 'multipart/form-data'],
                        'action' => $action,
                        'class' =>'am-form',
                    ]) ?>
                        <div class="form-group">
                            <!--input type="file" id="user-pic"-->
                            <?= $form->field($image, 'imageFile', ['inputOptions'=>['class'=>'form-control']])->fileInput() ?>
                                <?=Html::submitButton('上传', ['class' => 'btn btn-primary'])?>
                        </div>
                    <?php ActiveForm::end() ?>


        </div>
    </div>