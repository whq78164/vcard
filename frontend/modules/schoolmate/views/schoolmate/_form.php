<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use ;
/* @var $this yii\web\View */
/* @var $model frontend\modules\schoolmate\models\Schoolmate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schoolmate-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'major')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'studentid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idcardnum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jobtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'honour')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'worktel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hometel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->widget('frontend\assets\UeditorWidget',[
    'serverparam'=>[
        'myuploadpath'=> Yii::getAlias('@web/Uploads/').$model['id'],
    ],
    'options'=>[
        'focus'=>true,
//        'myuploadpaht'=> Yii::getAlias('@web/Uploads/').$model['id'],
        'toolbars'=> [
            ['fullscreen', 'source', 'undo', 'redo','paragraph','fontfamily','fontsize', 'justifyleft', 'justifyright', 'justifycenter','link','unlink','emotion', 'simpleupload', 'insertimage', 'map','print', 'spechars','horizontal'],
            ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'cleardoc','drafts', 'background', 'preview']
        ],
    ],

        'attributes'=>[
            'style'=>'height:80px'
        ]
    ]); ?>

    <?//= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>


    <!--
    <script id="editor3" type="text/plain" name="Schoolmate[comment]" style="width:100%; height: ;">
<?//= HTMLSpecialChars($model['comment']); ?>
<?//= $model['comment'] ?>
</script>
    <script type="text/javascript">
        var ue3 = UE.getEditor('editor3',{
                toolbars: [
                    ['fullscreen', 'source', 'undo', 'redo','paragraph','fontfamily','fontsize', 'justifyleft', 'justifyright', 'justifycenter','link','unlink','emotion', 'simpleupload', 'insertimage', 'map','print', 'spechars','horizontal'],
                    ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'cleardoc','drafts', 'background', 'preview']
                ]
//,initialStyle:'p{line-height:1em; font-size: 20px; }' $model->id
            }
        );

        ue3.ready(function(){
            ue3.execCommand('serverparam', {'uid': '<?//= $model['id'] ?>'
            });
        });

    </script>
-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
