<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Info */
$this->title = Yii::t('tbhome', '二维码管理系统');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">


    <div class="col-sm-12 col-md-8 ">
        <div class=" panel panel-primary">
            <div class="panel-heading ">二维码工厂：</div>
            <?=Html::a('二维码管理', ['/qrcode/qrcodedata/index'], ['class'=>'btn btn-info btn-block'])?>
            <?=Html::a('批量生产', ['/qrcode/qrcode/gencode'], ['class'=>'btn btn-success btn-block'])?>
            <?=Html::a('批量修改', ['/qrcode/qrcode/modifycode'], ['class'=>'btn btn-warning btn-block'])?>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">

        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> 提示!</h4>
            巧用<strong>回复语模板</strong>, 配合使用自定义字段，可以让您的二维码应用更加强大！
        </div>

    </div>
    <div class="col-sm-12 col-md-8 ">
        <div class="panel panel-primary">
            <div class="panel-heading">回复语模板：</div>
            <?=Html::a('回复语快捷设置', ['/qrcode/qrcodereply/onereply'], ['class'=>'btn btn-warning btn-block'])?>
            <?php
            $role=Yii::$app->user->identity->role;
            if($role>=50) {
                echo Html::a('回复语模板管理', ['/qrcode/qrcodereply/index'], ['class'=>'btn btn-info btn-block']);
            }
            ?>
        </div>
    </div>


    <div class="col-sm-12 col-md-8 ">
        <div class="panel panel-primary">
            <div class="panel-heading">产品管理：</div>
            <?=Html::a('我的产品', ['/product/index'], ['class'=>'btn btn-info btn-block'])?>

        </div>
    </div>


</div>
