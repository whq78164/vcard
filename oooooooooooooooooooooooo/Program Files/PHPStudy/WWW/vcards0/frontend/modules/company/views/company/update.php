<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = Yii::t('tbhome', 'Update {modelClass}: ', [
    'modelClass' => 'Company',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('tbhome', 'Update');
?>
<div class="row">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>



    <div class="col-md-4">

        <?= $this->render('_form_image', [
            'title' => '微信回复图片(900 X 450)',
            'image' => $image,
            'thumImage'=>$model->image,
            //        'model'=>$model,
            'defaultImage'=>'Uploads/default_face.jpg',
            'action' => ['uploadimage', 'id'=>$model->id],
        ]) ?>

    </div>


</div>
