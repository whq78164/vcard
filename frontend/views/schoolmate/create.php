<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\schoolmate\models\Schoolmate */

$this->title = Yii::t('tbhome', 'Create Schoolmate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Schoolmates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schoolmate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
