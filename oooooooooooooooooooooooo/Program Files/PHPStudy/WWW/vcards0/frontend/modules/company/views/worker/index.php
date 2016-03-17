<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\company\models\Department;
use frontend\modules\company\models\Company;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WorkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('tbhome', 'Workers');
$this->params['breadcrumbs'][] = $this->title;

//$frontend=Yii::getAlias('@frontend');
//$head=$frontend.'/Uploads/'.Yii::$app->user->


?>
<div class="row">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

            <?= Html::a(Yii::t('tbhome', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>


    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

   //         'id',
            [
                'header'=>'个人头像', 'format' => 'html', 'value'=>function($data){
                if(!file_exists($data->head_img)){
                    $data->head_img='Uploads/shuhualogo.jpg';
                }
                return Html::img($data->head_img, ['width'=>'70px']);
            },
            ],
            'job_id',

          [

                'attribute' =>  'company_id',
                'label' => '公司名',
            //    'format' =>'html',
                'filter' => Html::activeDropDownList($searchModel, 'company_id', $listCompanys, ['class' => 'form-control']),
                'value' => function ($model) {
                    $company_id=$model->company_id;
                    $company=Company::findOne($company_id);
                    return Html::encode($company->company);
                },
            ],

 //           'company_id',


            [

                'attribute' =>  'department_id',
                'label' => '部门',
                //    'format' =>'html',
                'filter' => Html::activeDropDownList($searchModel, 'department_id', $listDepartments, ['class' => 'form-control']),
                'value' => function ($model) {
                    $department_id=$model->department_id;
                    $department=Department::findOne($department_id);
                    return Html::encode($department->department);
                },
            ],




            'name',
            // 'mobile',
            // 'qq',
            // 'email:email',
            // 'head_img',
            // 'position',
            // 'task',
            // 'work_tel',
            // 'wechat_account',
            // 'wechat_qrcode',
            // 'fax',
            // 'is_work',
            // 'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <div class="col-md-6">

        <?php $form = ActiveForm::begin([
            //        'id' => "uploadExcel",
            'enableAjaxValidation' => false,
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => Url::to(['import'])
            //      'class' =>'am-form',
        ]) ?>
        <!--input type="file" id="user-pic"-->
        <?= $form->field($file, 'file')->fileInput(['id'=>'excelFile'])->label('Excel表格')?>
        <div class="form-group">
            <?=Html::submitButton('导入Excel', ['id'=>'uploadExcel','class' => 'btn btn-primary'])?>
        </div>

        <?php ActiveForm::end() ?>
    </div>
</div>

<?=Html::a('导出全部数据', ['download'], ['class'=>'btn btn-success'])?>

<script Charset="UTF-8" type="text/javascript">
/*
    $(document).ready(function(){

        $("#uploadExcel").click(function(){
            //                var FWcode = document.getElementById('FWcode').value;

            var FWcode = $("#FWcode").val();
            var FWuid = $("#FWuid").val();
            var replyid = $("#replyid").val();
            var url="<?//=Url::to(['anti/antiquery'],true)?>";
            var data={
                FWcode: FWcode,
                replyid: replyid,
                FWuid: FWuid
            };

            $.ajax({
                type: 'POST',
                url: url ,
                data: data ,
                success: function(data,status){
                    document.getElementById('ReturnResult').innerHTML = data;//+status;
                }
                //   dataType: html
            });


        });



    });

*/
</script>