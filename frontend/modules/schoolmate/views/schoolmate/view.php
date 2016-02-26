<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\schoolmate\models\Schoolmate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Schoolmates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schoolmate-view">

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
            'name',
            'sex',
            'grade',
            'major',
            'studentid',
            'idcardnum',
            'address',
            'city',
            'job',
            'jobtitle',
            'honour:ntext',
            'worktel',
            'hometel',
            'mobile',
            'email:email',
            'qq',
//            'comment:ntext',
        ],
    ]) ?>
    <?php
/*    $config = HTMLPurifier_Config::createDefault();
    $config->set('HTML.SafeObject',true);
    $config->set('HTML.SafeEmbed',true);
    $purifier = new HTMLPurifier($config);
    $purifier->process($model->comment,$config);
*/
//    HtmlPurifier::process($model->comment) ?>
    <?//= Html::encode($model->comment) ?>
    <?= $model['comment'] ?>

</div>
