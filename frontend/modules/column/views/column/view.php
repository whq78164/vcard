<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Column */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Column'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-10">

    <p>
        <?= Html::a(Yii::t('tbhome', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        //    'id',
       //     'uid',
            'type',
            'column',
            'label',
            'remark',
        ],
    ]) ?>

</div>
