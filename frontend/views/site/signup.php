<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/*
use linslin\yii2\curl;
$curl = new curl\Curl();
$url='http://www.vcards.top/index.php?r=cloud/site';
$response = $curl->get($url);
$response=json_decode($response);
*/
use frontend\models\Site;
$response=Site::findOne(['id'=>1]);

$this->title = Yii::t('tbhome', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>填写表单创建新用户。<br>若您的信息已被他人创建占用，请联系我们！QQ：<?=$response->qq?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->hint('用于登录后台，中英文任意填写！') ?>
            <?= $form->field($model, 'mobile')?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('tbhome', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
