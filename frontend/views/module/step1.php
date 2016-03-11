<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Module */

$this->title = '模块安装向导：第'.$step.'步';
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-md-8">
        <strong>
            请先将模块文件夹拷贝至<code>frontend/modules/</code>目录内
        </strong>
        <br/> <br/>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'modulename')->textInput(['placeholder'=>'填写模块目录名'])->hint('模块标识（模块目录名），请以小写英文字母开头'); ?>

        <?= $form->field($model, 'module_label')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'module_des')->textarea(['rows' => 5]) ?>

        <?//= $form->field($model, 'icon')->textInput()->hint('选填') ?>
        <?//= $form->field($model, 'mark')->textInput()->hint('选填') ?>
        <?//= $form->field($model, 'markclass')->textInput()->hint('选填') ?>



        <div class="form-group">
            <?= Html::submitButton('下一步', ['class'=>'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div><!-- module-install -->