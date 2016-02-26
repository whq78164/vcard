<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = Yii::t('tbhome', 'Update') . '： ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="row">

    <div class="col-sm-12 col-md-8">

        <?= $this->render('_form', [
            'model' => $model,
        //    'image'=>$image,
        ]) ?>

    </div>

    <div class="col-sm-12 col-md-4">
        <?= $this->render('/user/_form_face', [
            'title' => '上传产品图片',
            'image' => $image,
            'thumImage'=>$model->image,
            'model'=>$model,
            'defaultImage'=>'Uploads/default_face.jpg',
            'action' => ['product/upload'],
        ]) ?>

    </div>

</div>