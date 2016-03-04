<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Wechatgh */

$this->title = Yii::t('tbhome', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Wechatghs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechatgh-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
