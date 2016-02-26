<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Info */
$this->title = Yii::t('tbhome', '产品防伪');

$this->params['breadcrumbs'][] = $this->title;

?>


    <div class="row">


<div class="col-sm-12 col-md-8 ">
    <div class=" panel panel-primary">
<div class="panel-heading ">二维码工厂：</div>

        <?=Html::a('二维码管理', ['anticode/index'], ['class'=>'btn btn-info btn-block'])?>
        <?=Html::a('批量生产', ['anti/gencode'], ['class'=>'btn btn-success btn-block'])?>
        <?=Html::a('批量修改', ['anti/modifycode'], ['class'=>'btn btn-warning btn-block'])?>

    </div>
</div>

<div class="col-sm-12 col-md-8 ">
        <div class="panel panel-primary">
            <div class="panel-heading">回复语模板：</div>
            <?=Html::a('回复语快捷设置', ['antireply/onereply'], ['class'=>'btn btn-warning btn-block'])?>
<?php
$role=Yii::$app->user->identity->role;
if($role>=50) {
    echo Html::a('回复语模板管理', ['antireply/index'], ['class'=>'btn btn-info btn-block']);
}
?>

        </div>
</div>


        <div class="col-sm-12 col-md-8 ">
            <div class="panel panel-primary">
                <div class="panel-heading">产品管理：</div>
                <?=Html::a('我的产品', ['product/index'], ['class'=>'btn btn-info btn-block'])?>

            </div>
        </div>

        <?php
        if($role>=60) {
            ?>
        <div class="col-sm-12 col-md-8 ">
            <div class="panel panel-primary">
                <div class="panel-heading">追溯信息：</div>

               <?= Html::a('追溯信息管理', ['traceabilityinfo/index'], ['class' => 'btn btn-info btn-block'])?>

            </div>
        </div>

        <?php
        }
        ?>


    </div>



