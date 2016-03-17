<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Info */
$this->title = Yii::t('tbhome', '自定义字段管理');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">

    <div class="col-sm-12 col-md-8 ">
        <div class=" panel panel-primary">
            <div class="panel-heading ">字段管理：</div>

            <?=Html::a('字段列表', ['/column/column'], ['class'=>'btn btn-info btn-block'])?>

        </div>
    </div>

</div>



