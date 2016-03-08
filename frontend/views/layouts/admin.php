<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\AdminlteAsset;
/*
use linslin\yii2\curl;
$curl = new curl\Curl();
$url='http://www.vcards.top/index.php?r=cloud/index';
$response = $curl->get($url);
$response=json_decode($response);
*/
$url=Yii::$app->params['updateApi'];
$response=httpGet($url);
$response=json_decode($response);

switch ($response->status){
    case 9 :// header('location: '.Yii::$app->homeUrl);
        Yii::$app->getSession()->setFlash('danger', $response->msg);
        break;
    case 0 :  Yii::$app->getSession()->setFlash('danger', $response->msg);
        header('location: '.Yii::$app->homeUrl);
        break;
}


AdminlteAsset::register($this);
$userInfo=Yii::$app->user->identity;
$role=$userInfo->role;
$loginuid=$userInfo->id;

if (Yii::$app->user->isGuest) {
    $redirecturl=Yii::$app->request->baseUrl;
    header("location: $redirecturl");
    Yii::$app->getSession()->setFlash('danger', '请登录账户！');
    exit;
}


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <style>
        .thumbnail {max-width:100%; max-height:100%}
        body{font-family:"微软雅黑"; }
        h1, h2 {font-family:"微软雅黑"; line-height:1.5em;}<!-- font-size: 16px; -->
        body p{font-family:"楷体"; line-height:1.5em;}
    </style>
    <?php $this->head() ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，系统不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->

<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?=Url::to(['/user/index'], true)?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>V</b>C</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?=$response->sitetitle?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">


                            <?=Html::img(isset($headImg) ? $headImg : 'Uploads/default_face.jpg', ['class'=>'user-image'])?>
                            <span class="hidden-xs"><?= Yii::$app->user->identity->username . '&nbsp;'.Yii::t('tbhome', 'hello') .'！'?> </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">


                                <?=Html::img(isset($headImg) ? $headImg : 'Uploads/default_face.jpg', ['class'=>'img-circle'])?>

                                <p>
                                    <?= $userInfo->username?>
                                    <small>最近登录时间：<?= date('Y-m-d H:i  A', $userInfo->updated_at)?> <br/>最近登录地区: <span id="sina_ip_info"><?=\Yii::$app->session['area']?></span></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center ">
                                        <?=Html::a('我的名片',['vcards/index', 'uid'=>$loginuid],['class'=>'', 'target'=>'_blank'])?>

                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="row user-footer">
                                <div class="col-xs-4 pull-left">
                                    <a href="<?=Url::to(['user/setting'], true)?>" class="btn btn-default btn-flat">设置</a>
                                </div>

                                <?php
                                if (Yii::$app->user->identity->role==100) {
                                    ?>
                                    <div class="col-xs-4 text-center">
                                        <?=Html::a('管理员',['admin/index'],['class'=>'btn btn-default btn-flat', 'target'=>'_blank'])?>
                                    </div>
                                    <?

                                }

                                ?>
                                <div class="col-xs-4 pull-right">


                                    <?=Html::a('退出',['site/logout'],['class'=>'btn btn-default btn-flat'])?>
                                </div>
                            </li>
                        </ul>
                    </li>

                    </ul>

            </div>
        </nav>
    </header>



    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">

                <div class="pull-left image">
                    <?=Html::img(isset($headImg) ? $headImg : 'Uploads/default_face.jpg', ['class'=>'img-circle'])?>

                </div>

                <div class="pull-left info">
                    <p><?=$userInfo->username?></p>
                    <a href="<?=Url::to(['/user/index'], true)?>"><i class="fa fa-circle text-success"></i> 在线</a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">主菜单</li>
                <li >
                    <a href="<?=Url::to(['/admin/index'], true)?>">
                        <i class="fa fa-user"></i> 后台首页
                        <!--small class="label pull-right bg-red">3</small-->
                    </a>
                </li>

                <li >
                    <a href="<?=Url::to(['/user/index'], true)?>">
                        <i class="fa fa-user"></i> 用户首页
                        <!--small class="label pull-right bg-red">3</small-->
                    </a>
                </li>

                <li >
                    <a href="<?=Url::to(['/admin/site'], true)?>">
                        <i class="fa fa-cog"></i> 站点设置
                        <!--small class="label pull-right bg-red">3</small-->
                    </a>
                </li>

                <li >
                    <a href="<?=Url::to(['/module/index'], true)?>">
                        <i class="fa fa-cog"></i> 模块列表
                        <!--small class="label pull-right bg-red">3</small-->
                    </a>
                </li>

                <li >
                    <a href="<?=Url::to(['/usermodule/index'], true)?>">
                        <i class="fa fa-cog"></i> 模块授权
                        <!--small class="label pull-right bg-red">3</small-->
                    </a>
                </li>


                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>用户管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="<?=Url::to(['/admin/indexuser'], true)?>">
                                <i class="fa fa-circle-o"></i> 用户列表
                            </a>
                        </li>

                        <li>
                            <a href="<?=Url::to(['/setting/index'], true)?>">
                                <i class="fa fa-circle-o"></i> 用户设置
                            </a>
                        </li>

                        <li>
                            <a href="<?=Url::to(['/info/index'], true)?>">
                                <i class="fa fa-circle-o"></i> 用户详情
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="header">快捷操作</li>

                <li>
                    <a target="_blank" href="<?=Url::to(['/vcards/index','uid'=>$loginuid], true)?>">
                        <i class="fa fa-credit-card text-blue"></i> <span>我的名片</span>
                    </a>


                </li>

                <li>
                    <a href="<?=Url::to(['/site/logout'], true)?>">
                        <i class="fa fa-sign-out text-red"></i> <span>退出</span>
                    </a>
                </li>



            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">



            <h1>
                <?=Html::encode($this->title)?>
                <!--small>Control panel</small-->
            </h1>
            <!--ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol-->


            <?= Breadcrumbs::widget([
                'homeLink'=>[
                    //'class' =>'fa fa-dashboard',
                    'label' => '用户首页','url' => Url::to(['/user/index'], true),//Yii::$app->homeUrl
                ],
                'options' => ['class' => 'breadcrumb'],
                'links' => //[
                //    'label' =>
                    isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                //  'class'=>'active',
                //  ],
            ]) ?>

        </section>
        <?= Alert::widget() ?>
        <!-- Main content -->
        <section class="content">

            <!-- Main row -->


            <?= $content ?>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b><?= $response->icp ?></b>
        </div>
        <strong><?= $response->copyright ?></strong>
    </footer>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

