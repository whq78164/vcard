<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Module */

$this->title = Yii::t('tbhome', 'Create Module');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
