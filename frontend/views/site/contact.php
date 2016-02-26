<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('tbhome', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        如果您有需要或疑问，请填写下面表单，提交给我们。感谢您提出的宝贵建议！

    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->label(Yii::t('tbhome', 'Name')) ?>

                <?= $form->field($model, 'email')->label(Yii::t('tbhome', 'Email')) ?>

                <?= $form->field($model, 'subject')->label(Yii::t('tbhome', 'Subject')) ?>

                <?= $form->field($model, 'body')->label(Yii::t('tbhome', 'Body'))->textArea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->label(Yii::t('tbhome', 'Verification Code'))->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('tbhome', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
