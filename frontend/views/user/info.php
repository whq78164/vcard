<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Info $qrcode*/
$this->title = Yii::t('tbhome', '详细信息');
//$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
//        'modelClass' => 'Info',
//    ]) . ' ' . $model->uid;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Infos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', '微名片'), 'url' => ['user/vcards']];
$this->params['breadcrumbs'][] = $this->title;

?>

<!--div class="info-update"-->

    <h1><?= Html::encode($this->title) ?></h1>



<div class="am-g">


        <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">

        <?= $this->render('_form_face', [
            'title' => '上传微信二维码，方便客户联系您！',
            'image' => $qrcode,
            'thumImage'=>$info->wechat_qrcode,
            'defaultImage'=>'Uploads/default_qrcode.jpg',
            'action' => ['user/wechatqr'],
        ]) ?>



            <div class="am-panel am-panel-default ">
                <a style="" href="<?= yii\helpers\Url::to(['vcards/index', 'uid' => Yii::$app->user->id], true) ?>" target="_blank">
                <button type="button" class="am-btn am-btn-success am-btn-block">

                        我的微名片

                </button>
                </a>
            </div>


            <div class="am-panel am-panel-default ">
            <a href="<?=yii\helpers\Url::to(['user/user'],true)?>">
                <button type="button" class="am-btn am-btn-secondary am-btn-block">
                    基本信息
                </button>
            </a>
            </div>



        </div>

    <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">

    <?= $this->render('_form_info', [
        'info' => $info,
    ]) ?>
</div>


</div>





<!--/div-->