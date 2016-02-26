<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Microlink */

$this->title = Yii::t('tbhome', 'Create Microlink');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Microlinks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="microlink-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
