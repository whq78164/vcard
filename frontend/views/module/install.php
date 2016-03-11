<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Module */

$this->title = '模块安装向导';
$this->params['breadcrumbs'][] = ['label' => Yii::t('tbhome', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">


<div class="col-sm-12 col-md-8">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>


    <div class="col-sm-12 col-md-4">

        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i> 提示!</h4>
            <strong>
                请先将模块拷贝至目录：<code>frontend/modules/</code><br/><br/>
                建立SQL安装文件：模块标识.sql 到模块内根目录。如：<code>frontend/modules/qrcode/qrcode.sql</code>
            </strong>
        </div>

    </div>


</div><!-- module-install -->
