<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Worker */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Worker',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Workers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="row">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listCompanys'=>$listCompanys,
        'listDepartments'=>$listDepartments
    ]) ?>





    <div class="col-md-4">

        <?= $this->render('_form_headimg', [
            'title' => '上传头像',
            'image' => $head_img,
            'thumImage'=>$model->head_img,
    //        'model'=>$model,
            'defaultImage'=>'Uploads/default_face.jpg',
            'action' => ['uploadheadimg', 'id'=>$model->id],
        ]) ?>

        <?/*= $this->render('_form_face', [
        'title' => '上传微信二维码',
        'image' => $qrcode,
        'thumImage'=>$info->wechat_qrcode,
        'defaultImage'=>'Uploads/default_qrcode.jpg',
        'action' => ['user/wechatqr'],
    ])*/ ?>

    </div><!-- /.col -->



</div>
