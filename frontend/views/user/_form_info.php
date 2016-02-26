<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Info */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="am-form am-form-horizontal">

    <?php $form = ActiveForm::begin([
     //   'id' => "article-form",
     //   'enableAjaxValidation' => false,
     //   'options' => ['enctype' => 'multipart/form-data'],
        'action'=>['user/info']

    ]); ?>

    <?= $form->field($info, 'card_title')->textInput( ['placeholder'=>'选填。微信转发和分享时，显示该标题。不填为默认。', 'maxlength' => true])->hint('例：通宝科技张三山的二维码微名片！') ?>

    <?= $form->field($info, 'unit')->textInput(['placeholder'=>'必填','maxlength' => true])->hint('XX公司，XX协会') ?>

    <?//= $form->field($info, 'face_box')->textInput(['maxlength' => true]) ?>

    <?= $form->field($info, 'department')->textInput(['placeholder'=>'选填', 'maxlength' => true])->hint('宣传部')?>

    <?= $form->field($info, 'position')->textInput(['placeholder'=>'', 'maxlength' => true])->hint('总经理') ?>

    <?= $form->field($info, 'address')->textInput(['placeholder'=>'', 'maxlength' => true])//->hint('推荐填写') ?>

    <?= $form->field($info, 'business')->textarea(['placeholder'=>'必填。经营和服务范围等。我们对该信息，进行大数据数据智能匹配，定向推广。请尽可能包含客户能搜到的关键词。', 'rows' => 6])//->hint('必填。内容为经营范围等信息。我们针对该内容，进行数据匹配，智能推广。') ?>

    <?= $form->field($info, 'signature')->textarea(['placeholder'=>'选填.个性签名, 商业标语，公司简介，座右铭等...', 'rows' => 6])->hint('')  ?>

    <?= $form->field($info, 'wechat_account')->textInput(['placeholder'=>'推荐填写，并上传微信二维码图片','maxlength' => true]) ?>
<!--img src="<?=$info->wechat_qrcode?>"-->
    <?//= $form->field($info, 'wechat_qrcode')->fileInput() ?>
    <?= $form->field($info, 'fax')->textInput(['maxlength' => true])->hint('选填')  ?>
    <?= $form->field($info, 'work_tel')->textInput(['maxlength' => true])->hint('选填')  ?>

    <?//= $form->field($info, 'location')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($info->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $info->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

        <a href="<?=yii\helpers\Url::to(['vcards/index', 'uid'=>Yii::$app->user->id],true)?>">
        <?= Html::button('查看名片', ['class' => 'btn btn-success pull-right' ]) ?>
        </a>

    </div>


    <?php ActiveForm::end(); ?>

</div>