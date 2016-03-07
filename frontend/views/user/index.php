<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('tbhome', '用户中心');
$this->params['breadcrumbs'][] = $this->title;
$userInfo=Yii::$app->user->identity;
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>0<sup style="font-size: 20px">元</sup></h3>

                <p>总收入</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>0<sup style="font-size: 20px">元</sup></h3>

                <p>可用余额</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>0<sup style="font-size: 20px">元</sup></h3>

                <p>已提现</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                职员<sup style="font-size: 30px">10%</sup>
                </h3>

                <p>级别&分润</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">



    <div class="col-md-9">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li ><a href="#activity" data-toggle="tab">帮助</a></li>
                <li class="active"><a href="#timeline" data-toggle="tab">名片信息</a></li>
                <li><a href="#settings" data-toggle="tab">设置</a></li>
            </ul>


            <div class="tab-content">
                <div class=" tab-pane" id="activity">




                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <?php
                            echo Html::img(
                                $info->face_box ? $info->face_box : 'Uploads/default_face.jpg',
                                ['class'=>'profile-user-img img-responsive img-circle']
                            );
                            ?>


                            <h3 class="profile-username text-center"><?=$userInfo->name?></h3>
                            <p class="text-muted text-center">
                                <span><?=$info->department?>&nbsp;</span><?=$info->position?>
                            </p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Q Q</b> <a class="pull-right"><?=$userInfo->qq?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right"><?=$userInfo->email?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>手机</b> <a class="pull-right"><?=$userInfo->mobile?></a>
                                </li>
                            </ul>
                            <?=Html::a('<b>微名片</b>',
                                ['vcards/index', 'uid'=>Yii::$app->user->id], ['class'=>'btn btn-success btn-block', 'target'=>'_blank'])?>

                        </div><!-- /.box-body -->
                    </div>
                    <!-- /.box -->









                </div><!-- /.tab-pane -->
                <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">名片信息</div>
                            <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>
                                <?= $form->field($baseuser, 'name')->textInput(['placeholder'=>'输入姓名，让我们记住您!', 'maxlength' => true])->label('姓名 / Name')?>
                                <?= $form->field($baseuser, 'email')->textInput(['placeholder'=>'798904845@qq.com', 'maxlength' => true])->label('电子邮箱 / Email')?>
                                <?= $form->field($baseuser, 'mobile')->textInput()->label('手机')?>

                                <?= $form->field($baseuser, 'qq')->textInput()->label('QQ')?>

<hr/>


                                <?= $form->field($info, 'card_title')->textInput( ['placeholder'=>'选填。微信转发和分享时，显示该标题。不填为默认。', 'maxlength' => true])->hint('例：通宝科技张三山的二维码微名片！') ?>

                                <?= $form->field($info, 'unit')->textInput(['placeholder'=>'必填','maxlength' => true])->hint('XX公司，XX协会') ?>

                                <?//= $form->field($info, 'face_box')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($info, 'department')->textInput(['placeholder'=>'选填', 'maxlength' => true])->hint('宣传部')?>

                                <?= $form->field($info, 'position')->textInput(['placeholder'=>'', 'maxlength' => true])->hint('总经理') ?>

                                <?= $form->field($info, 'address')->textInput([
                                    'placeholder'=>'',
                                    'id'=>'lbsaddress',
                                ])->hint('<span>输入地址后，点击“自动定位”按钮可以在地图上定位。</span><br>
    <span>（如果输入地址后无法定位，请在地图上直接点击选择地点）</span>') ?>

                                <?=Html::button('自动定位(搜索)', ['id'=>'locate-btn', 'class'=>'btn btn-success '])?>
                                <span class="fa fa-compass fa-2x text-info"></span><br>

                                <div id="map" style="width: 100%;height: 300px;"></div>

                                <?=$form->field($info, 'latitude')->textInput(['id'=>'latitude'])?>
                                <?=$form->field($info, 'longitude')->textInput(['id'=>'longitude'])?>

                                <?= $form->field($info, 'business')->textarea(['placeholder'=>'必填。经营和服务范围等。我们对该信息，进行大数据数据智能匹配，定向推广。请尽可能包含客户能搜到的关键词。', 'rows' => 6])//->hint('必填。内容为经营范围等信息。我们针对该内容，进行数据匹配，智能推广。') ?>

                                <?= $form->field($info, 'signature')->textarea(['placeholder'=>'选填.个性签名, 商业标语，公司简介，座右铭等...', 'rows' => 6])->hint('')  ?>

                                <?= $form->field($info, 'wechat_account')->textInput(['placeholder'=>'推荐填写，并上传微信二维码图片','maxlength' => true]) ?>
                                <?//= $form->field($info, 'wechat_qrcode')->fileInput() ?>
                                <?= $form->field($info, 'fax')->textInput(['maxlength' => true])->hint('选填')  ?>
                                <?= $form->field($info, 'work_tel')->textInput(['maxlength' => true])->hint('选填')  ?>





                    <?=Html::submitButton('确定', ['class'=>'btn btn-success'])?>

                    <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>

                </div><!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                    <div class="col-sm-12">
                        <div class="panel panel-info">
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


                    <div class="col-sm-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">名片设置</div>
                            <div class="panel-body">
                                <?php $form = ActiveForm::begin([
                                    'id' => "article-form",
                                    'enableAjaxValidation' => false,
                                    'action'=> ['user/specialsetting'],
                                    'method'=>'post'

                                ]); ?>
                                <?= $form->field($model, 'tpl')->dropDownList([
                                    '0'=>'默认',
                                    '1'=>'舒华'
                                ]) ?>

                                <div class="form-group">
                                    <br/>
                                    <?= Html::submitButton($model->isNewRecord ? Yii::t('tbhome', 'Create') : Yii::t('tbhome', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                                </div>



                                <?php ActiveForm::end(); ?>

                            </div>
                        </div>
                    </div>



                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->


        </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->

    <div class="col-md-3">






        <?= $this->render('_form_face', [
            'title' => '上传微信二维码',
            'image' => $qrcode,
            'thumImage'=>$info->wechat_qrcode,
            'defaultImage'=>'Uploads/default_qrcode.jpg',
            'action' => ['user/wechatqr'],
        ]) ?>



        <?= $this->render('_form_face', [
            'title' => '上传头像',
            'image' => $face,
            'thumImage'=>$info->face_box,
            'defaultImage'=>'Uploads/default_face.jpg',
            'action' => ['user/upload'],
        ]) ?>




    </div><!-- /.col -->

</div><!-- /.row -->








