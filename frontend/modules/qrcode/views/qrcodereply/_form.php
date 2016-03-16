<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AntiReply */
/* @var $form yii\widgets\ActiveForm */

?>




    <div class="col-sm-12 col-md-8">

        <?php $form = ActiveForm::begin(); ?>

        <?//= $form->field($model, 'uid')->textInput() ?>

        <?= $form->field($model, 'tag')->textInput([
            'placeholder'=>'',
            //   'maxlength' => true
        ])->hint('请填写防伪查询页标题，如：友臣肉松饼防伪查询系统') ?>



        <?= $form->field($model,'success')->widget('frontend\assets\UeditorWidget',[
            'serverparam'=>[
                'myuploadpath'=> Yii::getAlias('@web/Uploads/').Yii::$app->user->id,
            ],
            'options'=>[
                'focus'=>true,
                'toolbars'=> [
                    ['fullscreen', 'source', 'undo', 'redo','paragraph','fontfamily','fontsize', 'justifyleft', 'justifyright', 'justifycenter','link','unlink','emotion', 'simpleupload', 'insertimage', 'map','print', 'spechars','horizontal'],
                    ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'cleardoc','drafts', 'background', 'preview']
                ],
            ],

            'attributes'=>[
                'style'=>'height:80px'
            ]
        ])->label('查询成功回复：')->hint('
例：<br/>
您好！您所查询的商品为原装正品！<br/>
产品名称：{{产品名称}}<br/>
生产厂家：{{产品厂家}}<br/>
品牌：{{产品品牌}}<br/>
之前已被查询：{{查询次数}}次，<br/>
上次查询时间：{{查询时间}}<br/>
<br/>
(<strong>注：替换变量为：{{生产备注}}，{{防伪码}}， {{查询次数}}, {{产品厂家}}， {{产品名称}}， {{产品品牌}}， {{产品规格}}， {{奖品}}， {{查询时间}}， {{产品价格}}， {{产品图片}}， {{产品详情}}， {{计量单位}}， {{追溯信息}}, {{自定义网页}}, {{二维码}}, {{地区}}, {{修改备注}}</strong>)
') ; ?>

        <?= $form->field($model, 'content')->textarea(['rows'=>3])->label('自定义网页（选填，支持代码编辑）')?>

        <?= $form->field($model, 'fail')->textarea(['rows' => 3])->label('查询失败回复语：')->hint('例：您所查询的记录不存在，请谨防假冒！') ?>
        <?= $form->field($model, 'valid_clicks')->textInput()->hint('查询次数超过有效数后，将显示查询失败回复语')?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

            <?= Html::a(Yii::t('tbhome', '查看防伪页'), ['qrcode/index', 'replyid'=>$model->id], ['class' => 'btn btn-success pull-right', 'target'=>'_blank']) ?>

        </div>
        <?php ActiveForm::end(); ?>

    </div>



<div class="col-sn-12 col-md-4">

    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> 提示!</h4>
        查询成功回复：二维码查询结果为：成功，则触发该回复语。<br/><br/>
        支持图文编辑和HTML网页自定义。<br/><br/>
        请记得在编辑器内<strong>变量：格式为{{变量}}</strong><br/><br/>
        自定义字段模块中的变量，请填 <br/><strong>字段标签</strong> 里的内容。现可用自定义字段标签如下：<br/><br/>

<?php
$uid=Yii::$app->user->id;
$sql="SELECT * FROM {{%column}} WHERE uid=$uid AND type='qrcode'";
$qrcodeColumns=Yii::$app->db->createCommand($sql)->queryAll();

if (!empty($qrcodeColumns)){

    $qrcodeColumn=array();
    $listDiyColumns=array();
    foreach($qrcodeColumns as $key => $value){//$qrcodeColumns as $qrcodeColumn
        echo '{{'.$value['label'].'}}<br/>';

    }

}
?>

    </div>
</div>

