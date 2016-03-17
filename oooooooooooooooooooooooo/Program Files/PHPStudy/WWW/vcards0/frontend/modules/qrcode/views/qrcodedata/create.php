<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCode */

$this->title = Yii::t('tbhome', '创建二维码数据');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Anti Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">


    <?= $this->render('_form', [
        'model' => $model,
        'listReply'=>$listReply,
        'listProduct'=>$listProduct,

    ]) ?>

</div>
