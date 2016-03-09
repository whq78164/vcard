<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Info */
$this->title = Yii::t('tbhome', '企业名片');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">

    <div class="col-sm-12 col-md-8 ">
        <div class=" panel panel-primary">
            <div class="panel-heading ">员工管理：</div>

            <?=Html::a('公司信息', ['/company/company'], ['class'=>'btn btn-info btn-block'])?>
            <?=Html::a('部门管理', ['/company/department'], ['class'=>'btn btn-success btn-block'])?>
            <?=Html::a('职员列表', ['/company/worker'], ['class'=>'btn btn-warning btn-block'])?>

        </div>
    </div>

</div>



