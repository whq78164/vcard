<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
$webPath=Yii::getAlias('@web');
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
          //  'enableAjaxValidation' => false,
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => Url::to(['import'])
        ]) ?>
        <?= $form->field($file, 'file')->fileInput(['id'=>'excelFile'])->label('Excel表格')?>
        <?=Html::radioList('overwrite', [2], [2=>'追加&修改'],['class'=>'form-group']);?>
        <div class="form-group">
            <?=Html::submitButton('导入Excel', [
                'id'=>'uploadExcel',
                'class' => 'btn btn-primary',
                'data' => ['confirm' => Yii::t('tbhome', '
                清空重写：会清除之前的数据，请先导出备份！
                追加&修改：不存在的记录：追加；已存在的记录：修改'),],
            ])?>
        </div>

        <?php ActiveForm::end() ?>
    </div>

    <div class="col-md-6">
        <?=Html::a('下载数据导入模板', $webPath.'/Uploads/'.Yii::$app->user->id.'/company/company.zip', ['class'=>'btn btn-info'])?>
        <br/><br/>
<?=Html::a('导出数据', Url::to(['download']), ['class'=>'btn btn-success'])?>
    </div>


</div>


