<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

    <div class="panel panel-info">
        <div class="panel-heading ">
            <strong><?=Html::encode(isset($title) ? $title : '图片')?></strong>
        </div>


        <div class="panel-body">



                <?=Html::img($thumImage ? $thumImage : $defaultImage, ['class'=>'col-md-8 thumbnail'])?>



            <!--image-->
                <div class="col-md-12">


<?php
if (!isset($model)){
    $modelid=0;
}else{
    $modelid=$model->id;
}
?>

                    <!--p>你可以使用<a href="#">gravatar.com</a>提供的头像或者使用本地上传头像。 </p-->
                    <?php $form = ActiveForm::begin([
                        'id' => "article-form",
                        'enableAjaxValidation' => false,
                        'options' => ['enctype' => 'multipart/form-data'],
                        'action' => $action,
                        'class' =>'am-form',
                    ]) ?>

                            <!--input type="file" id="user-pic"-->
                            <?= $form->field($image, 'imageFile')->fileInput() ?>
                            <!--input name="id" type="hidden" value="<?//= $modelid ?>"-->

                    <?//=$form->field($model, 'id')->textInput() ?>
                            <div class="form-group">
                                <?//= Html::submitButton('上传'$model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                                <?=Html::submitButton('上传', ['class' => 'btn btn-primary'])?>
                            </div>

                    <?php ActiveForm::end() ?>
                </div>

        </div>
    </div>