<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('tbhome', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create col-md-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    //    'submitbutton' => $submitbutton,
    ]) ?>

</div>
