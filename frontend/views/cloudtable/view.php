<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cloud */

$this->title = $model->sitetitle;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Clouds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cloud-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('tbhome', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('tbhome', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('tbhome', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sitetitle',
            'siteurl:url',
            'company',
            'tel',
            'qq',
            'email:email',
            'address',
            'copyright',
            'icp',
            'ip',
            'pageid1',
            'pageid2',
            'status',
        ],
    ]) ?>

</div>
