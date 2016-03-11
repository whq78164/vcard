<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Modules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-8">
        <?//= Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-sm-12 col-md-4">
        <?= Html::a(
            '<i class="glyphicon glyphicon-plus"></i> '.'安装向导',
            ['install'], ['class' => 'btn btn-success']) ?>
    </div>

</div>


<div class="row">

    <div class="col-md-8">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'modulename',
            'module_label',

            [
                'header'=>'图标样式',
                'format' => 'html',
              'value'=>function($data){
                return Html::tag('span','',['class'=>$data->icon]);//"<span class='".$data->icon."'></span>";
            },
            ],

            [
                'header'=>'标记和样式',
                'format' => 'html',
                'value'=>function($data){
                    return Html::tag('span',$data->mark,['class'=>$data->markclass]);//"<span class='".$data->icon."'></span>";
                },
            ],


            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}{update}'],
        ],
    ]); ?>

</div>
    <div class="col-sm-12 col-md-4">
        <p></p>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> 已安装的模块：</h4>

        </div>

    </div>

</div>