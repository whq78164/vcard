<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <p>
        <?= Html::a(Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
        //    'company_id',
            'department',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}{update}'],
        ],
    ]); ?>
    <div class="col-md-6">

        <?php $form = ActiveForm::begin([
       //     'enableAjaxValidation' => false,
            'action'=>Url::to(['import']),
            'options' => ['enctype' => 'multipart/form-data'],
        ]) ?>
        <!--input type="file" id="user-pic"-->
        <?= $form->field($file, 'file')->fileInput(['id'=>'excelFile'])->label('Excel表格')?>
        <div class="form-group">
            <?=Html::submitButton('导入Excel', ['id'=>'uploadExcel','class' => 'btn btn-primary'])?>
        </div>

        <?php ActiveForm::end() ?>
    </div>

    <div class="col-md-6">
<?=Html::a('导出数据', Url::to(['download']), ['class'=>'btn btn-success'])?>
    </div>


</div>


