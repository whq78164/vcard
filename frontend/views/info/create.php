<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Info */

$this->title = Yii::t('tbhome', 'Create Info');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Infos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
