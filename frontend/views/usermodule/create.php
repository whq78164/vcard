<?php

//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Usermodule */

$this->title = Yii::t('tbhome', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Usermodules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usermodule-create">



    <?= $this->render('_form', [
        'model' => $model,
        'listModules' => $listModules,
        'listUsers'=> $listUsers
    ]) ?>

</div>
