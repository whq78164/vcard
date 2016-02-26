<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2015-10-05
 * Time: 10:34
 */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\Mobile_Detect;
$mobile=new Mobile_Detect();
$this->title = '名片制作';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', '名片首页'), 'url' => ['vcards/index']];
$this->params['breadcrumbs'][] = $this->title;
$qrcodeurl=Url::to(['vcards/index', 'uid'=>Yii::$app->user->id], true);
?>

<div class="row">

        <div class="col-sm-12 col-lg-5">


        <div class=" panel panel-primary">
            <div class="panel-heading ">名片设置：</div>
<div class="panel-body">
    <?=Html::a('名片信息', ['user/user'], ['class'=>'btn btn-success btn-block'])?>

    <?=Html::a('个性设置', ['user/specialsetting'], ['class'=>'btn btn-info btn-block'])?>

</div>

            </div>
        </div>

        <div class="col-sm-12 col-lg-5 ">
        <div class="panel panel-primary">
            <div class="panel-heading">名片功能：</div>
            <div class="panel-body">
            <?=Html::a('微链接', ['microlink/index'], ['class'=>'btn btn-warning btn-block'])?>

            <?= Html::a('微单页', ['micropage/onepage'], ['class' => 'btn btn-success btn-block']) ?>
            </div>
        </div>
        </div>
<?
if (!$mobile->isMobile()){
?>
    <div class="col-sm-12 col-lg-2">
        <div class=" panel panel-primary">
            <div class="panel-heading ">
                我的微名片
            </div>
            <a href="<?=Url::to(['vcards/index', 'uid'=>Yii::$app->user->id],true)?>" target="_blank">
<?=Html::img(genqrcode($qrcodeurl), ['class'=>'thumbnail'])?>

                <!--img class="thumbnail" style="width: 100%; height: 100%" src="http://www.vcards.top/qrcode.php?value=<?//=urlencode($qrcodeurl)?>"-->

            </a>
        </div>
    </div>

<?
}else{
?>
    <div class="col-sm-12 col-lg-2">

            <?=Html::a('我的微名片', ['vcards/index', 'uid'=>Yii::$app->user->id], ['target'=>'_blank', 'class'=>'btn btn-success btn-block'])?>

        <br/>

    </div>


<?
}?>

</div>


<?php
if ($role>=20) {
    ?>
    <div class="col-sm-12 col-md-5">
        <div class="panel panel-primary">
            <div class="panel-heading ">VIP专享：</div>
            <div class="panel-body">
            <?=Html::a('新增字段', ['label/index'], ['class'=>'btn btn-info btn-block'])?>

            <?=Html::a('微网页', ['micropage/index'], ['class'=>'btn btn-warning btn-block'])?>
            </div>

        </div>
    </div>
    <?
}
?>



