<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\helpers\Url;
?>
<?php $form = ActiveForm::begin([
    //   'id' => "article-form",
    //   'enableAjaxValidation' => false,
    //   'options' => ['enctype' => 'multipart/form-data'],
    'action'=>['user/user']

]); ?>

<?= $form->field($model, 'name')->textInput(['placeholder'=>'输入姓名，让我们记住您!', 'maxlength' => true])->label('姓名 / Name')?>

<?= $form->field($model, 'email')->textInput(['placeholder'=>'798904845@qq.com', 'maxlength' => true])->label('电子邮箱 / Email')?>

<?= $form->field($model, 'mobile')->textInput()->label('手机')?>

<?= $form->field($model, 'qq')->textInput()->label('QQ')?>
<?=Html::submitButton('确定', ['class'=>'btn btn-success'])?>

<?php ActiveForm::end(); ?>