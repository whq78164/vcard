<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = Yii::t('tbhome', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="am-g">


<div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
    <div class="am-u-md-8">
        <img class="am-img-circle am-img-thumbnail" src="<?=$model->image ?>" alt=""/>
    </div>

</div>
    <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

    </div>