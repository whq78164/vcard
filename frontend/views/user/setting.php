<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('tbhome', '安全设置');
$setting=$this->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Users'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->uid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">


    <div class="col-sm-12 col-md-8 ">
        <div class="panel panel-primary">
            <div class="panel-heading">修改密码</div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin(['action'=> ['user/password']]); ?>

        <!--input type="hidden" name="_csrf" value="<?//= Yii::$app->request->csrfToken ?>"-->


        <div class="form-group">
            <?=Html::label('原密码', 'oldpassword', ['class'=>'control-label'])?>
                <?=Html::input('password', 'oldpassword', '', ['class'=>'form-control', 'placeholder'=>"输入原密码"])?>
        </div>


        <div class="form-group">
           <?=Html::label('新密码', 'password')?>
        <?=Html::input('password', 'password','',['class'=>'form-control'])?>


        </div>

        <div class="form-group">
           <?=Html::label('重复新密码')?>
          <?=Html::input('password', 'repassword', '', ['class'=>'form-control'])?>
        </div>

                <div class="form-group">
<?=Html::submitButton('提交', ['class'=>'btn btn-success'])?>
</div>

    <? ActiveForm::end()?>

                </div>
        </div>

</div>


</div>