<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\grid\GridView;
//use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <!--div class="page-header">
            <h1><?//= Html::encode($this->title) ?></h1>
        </div-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('tbhome', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

 //           'id',
   //         'uid',
     //       'share',

            [
                'header'=>'产品图片', 'format' => 'html', 'value'=>function($data){
                return   //'&lt;img src="'.$src.'"&gt;';
                    Html::img($data->image, ['width'=>'150px']);
            },
            ],

            'factory',
             'name',
    //         'describe',
             'specification',
    //         'unit',
             'brand',
             'price',
            // 'hot',

            [
             'class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'
              /*  'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['product/view','id' => $model->id,'edit'=>'t']), [
                            'title' => Yii::t('yii', 'Edit'),
                        ]);}
                ],*/
            ],

            //           ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update}'],
        ],



    ]);?>



</div>
