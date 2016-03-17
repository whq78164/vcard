<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = Yii::t('tbhome', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
