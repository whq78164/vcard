<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Module */
/* @var $form yii\widgets\ActiveForm */
$action=Yii::$app->controller->action->id;
$fa=Html::a('图标样式参考','http://fontawesome.dashgame.com/', ['target'=>'blank']);
?>

<div class="module-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=$action=='install'?Html::label('模块命名空间，例：<code>frontend\modules\qrcode\Module</code>', 'class'):''?>
<?=$action=='install' ? Html::input('text', 'class','',[
    'class'=>'form-control',
    'id'=>'class',
]) : ''?>
    <br/>
    <?= $form->field($model, 'modulename')->textInput(['placeholder'=>'column'])->label('模块目录（模块标识），例：<code>qrcode</code>') ?>

    <?= $form->field($model, 'module_label')->textInput()->label('模块名，例：<code>二维码管理系统</code>') ?>
    <?= $form->field($model, 'module_des')->textarea(['rows' => 5]) ?>








    <div class="box box-info collapsed-box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">选填 >>>更多</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <!--div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> 提示!</h4>
                回复语模板中设置的变量字段，将被该选项替换
            </div-->

            <?= $form->field($model, 'icon')->textInput()->hint('选填（版本：Font Awesome 4.5.0），例：<code>fa fa-qrcode</code>'.$fa) ?>
            <?= $form->field($model, 'mark')->textInput()->hint('选填, 例：<code>New</code>') ?>
            <?= $form->field($model, 'markclass')->textInput()->hint('选填，例：<code>label pull-right bg-red</code>') ?>


        </div>
        <!-- /.box-body -->
    </div>















    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
