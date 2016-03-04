<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiCode */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Anti Codes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">


    <p>
        <?= Html::a(Yii::t('tbhome', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a(Yii::t('tbhome', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('tbhome', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>
<?php
$urlval=yii\helpers\Url::to([
    '/anti/antipage',
    'code'=>$model->code,
    'replyid'=>$model->replyid,
  //  'productid'=>$model->productid
], true);
//$urlval=urlencode($urlval);
//$src='http://www.vcards.top/qrcode.php?value='.$urlval;
$src=genqrcode($urlval);
$img= Html::img($src, ['width'=>'200px']);

?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           'id',
 //           'uid',
            'code',
            'replyid',
            'productid',
            'traceabilityid',
         //   'query_time:datetime',
            ['attribute' => 'create_time', 'format' => ['date', 'php:Y年m月d日']],
            ['attribute' => 'query_time', 'format' => ['date', 'php:Y年m月d日']],
            'clicks',
            'prize',
            'remark',
            [

                'attribute'=>'二维码', 'format' => 'html', 'value'=> $img,
//$model->code,

            ],
        ],
    ]) ?>

</div>
