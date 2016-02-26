<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Usermodule */

$this->title = Yii::t('tbhome', 'Create Usermodule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Usermodules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usermodule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listModules' => $listModules,
        'listUsers'=> $listUsers
    ]) ?>

</div>
