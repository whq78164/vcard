<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Label */

$this->title = Yii::t('tbhome', 'Create Label');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Labels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="label-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
