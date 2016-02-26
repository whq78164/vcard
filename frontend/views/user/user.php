<?php

//use yii\helpers\Html;
//use yii\grid\GridView;

//use frontend\assets\AmazeAsset;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', '微名片'), 'url' => ['user/vcards']];
$this->title = Yii::t('tbhome', '我的账户');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <div class="col-md-8">

        <div class="panel panel-primary">
            <div class="panel-heading ">账户信息：</div>
            <div class="panel-body">
        <?= $this->render('_form_user', [
            'model' => $model,
        ]) ?>
                </div>
            </div>




        <div class="panel panel-primary">
            <div class="panel-heading ">名片信息：</div>
            <div class="panel-body">
            <?= $this->render('_form_info', [
                'info' => $info,
            ]) ?>
            </div>
        </div>

    </div>



    <div class="col-md-4">



        <?= $this->render('_form_face', [
            'title' => '上传微信二维码，方便客户联系您！',
            'image' => $qrcode,
            'thumImage'=>$info->wechat_qrcode,
            'defaultImage'=>'Uploads/default_qrcode.jpg',
            'action' => ['user/wechatqr'],
        ]) ?>



        <?= $this->render('_form_face', [
            'title' => '上传头像',
            'image' => $face,
            'thumImage'=>$info->face_box,
            'defaultImage'=>'Uploads/default_face.jpg',
            'action' => ['user/upload'],
        ]) ?>




</div>

</div>