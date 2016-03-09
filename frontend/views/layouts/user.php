<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\AdminlteAsset;
//use frontend\assets\AppAsset;

//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use frontend\assets\Mobile_Detect;
//use mdm\admin\components\MenuHelper;
//use linslin\yii2\curl;
use frontend\models\Site;

/*
$url=Yii::$app->params['updateApi'];
$response=httpGet($url);
$response=json_decode($response);
*/
$response=Site::findOne(['id'=>1]);
if (Yii::$app->user->isGuest) {
    $redirecturl=Yii::$app->request->baseUrl;
    header("location: $redirecturl");
    Yii::$app->getSession()->setFlash('danger', '请登录账户！');
    exit;
}

$uid=Yii::$app->user->id;
$sql="SELECT * FROM {{%usermodule}} WHERE uid=$uid AND module_status=10";
$modules=Yii::$app->db->createCommand($sql)->queryAll();
//print_r($modules);
$usermodule=array();
foreach($modules as $module){
    $sql="SELECT * FROM {{%module}} WHERE id=".$module['moduleid'];
    $usermodule[]= Yii::$app->db->createCommand($sql)->queryOne();
}
//print_r(count($usermodule));
//print_r($usermodule);

AdminlteAsset::register($this);
//$mobile=new Mobile_Detect();
$userInfo=Yii::$app->user->identity;
$role=$userInfo->role;
$loginuid=$userInfo->id;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($response->sitetitle) ?></title>


    <!--meta charset="utf-8"-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $this->head() ?>
    <!-- Bootstrap 3.3.5 ->
    <link rel="stylesheet" href="bower_components/AdminLTE/">
    <!-- Font Awesome ->
    <link rel="stylesheet" href="">
    <!-- Ionicons ->
    <link rel="stylesheet" href="">
    <!-- Theme style ->
    <link rel="stylesheet" href="bower_components/AdminLTE/">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. ->
    <link rel="stylesheet" href="bower_components/AdminLTE/">
    <!-- iCheck ->
    <link rel="stylesheet" href="bower_components/AdminLTE/plugins/iCheck/flat/blue.css">
    <!-- Morris chart ->
    <link rel="stylesheet" href="bower_components/AdminLTE/plugins/morris/morris.css">
    <!-- jvectormap ->
    <link rel="stylesheet" href="bower_components/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker ->
    <link rel="stylesheet" href="bower_components/AdminLTE/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker ->
    <link rel="stylesheet" href="bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor ->
    <link rel="stylesheet" href="bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
    <!--script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script-->
    <!--[endif]-->

<style>
.thumbnail {max-width:100%; max-height:100%}
body{font-family:"微软雅黑"; }
</style>



</head>
<body class="hold-transition skin-purple sidebar-mini">
<?php $this->beginBody() ?>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，系统不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->





<?php
/*
$callback = function($menu){
    $data = eval($menu['data']);
    return [
        'label' => $menu['name'],
        'url' => [$menu['route']],
        'options' => $data,
        'items' => $menu['children']
    ];
};
$items = MenuHelper::getAssignedMenu(Yii::$app->user->id);//, null, $callback);

NavBar::begin([
    'brandLabel' => $response->sitetitle,//Yii::t('tbhome', 'Vcards').'微名片',
//        'brandLabel' => ['label' => Yii::t('tbhome', 'Vcards'), 'class' => 'h1'],

    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
        //       'class' => 'nav nav-tabs nav-stacked',
        //      'id'=>'main-nav'
    ],
]);
//

    // $menuItems = [
    $items = [
        ['label' => \Yii::t('tbhome', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('tbhome', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('tbhome', 'Contact'), 'url' => ['/site/contact']],
    ];
    //   $menuItems[] = ['label' => Yii::t('tbhome', 'Signup'), 'url' => ['/site/signup']];
    // $menuItems[] = ['label' => Yii::t('tbhome', 'Login'), 'url' => ['/site/login']];
    $items[] = ['label' => Yii::t('tbhome', 'Signup'), 'url' => ['/site/signup']];
    $items[] = ['label' => Yii::t('tbhome', 'Login'), 'url' => ['/site/login']];

    //  $menuItems[] = [
    $items[] = [
        'label' => Yii::t('tbhome', 'Login').':'. Yii::$app->user->identity->username,
        'url' => ['user/index'],
        'linkOptions' => ['data-method' => 'post']
    ];
*/
//  $items[]=$items;

//NavBar::end();

?>




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
     <?//php
     /*echo Nav::widget([

                'options' => [
              //  'class' => 'navbar-nav navbar-right',
                'class' => 'nav navbar-nav',
                //   'id'=>'main-nav'
                ],

                'items' => $items
                ]);
     */?>
<ul class="nav navbar-nav">

    <!-- Messages: style can be found in dropdown.less->
    <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">4</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have 4 messages</li>
            <li>
                <!-- inner menu: contains the actual data ->
                <ul class="menu">
                    <li><!-- start message ->
                        <a href="#">
                            <div class="pull-left">
                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                                Support Team
                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                        </a>
                    </li>
                    <!-- end message ->
                    <li>
                        <a href="#">
                            <div class="pull-left">
                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                                AdminLTE Design Team
                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="pull-left">
                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                                Developers
                                <small><i class="fa fa-clock-o"></i> Today</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="pull-left">
                                <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                                Sales Department
                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="pull-left">
                                <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                            </div>
                            <h4>
                                Reviewers
                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                            </h4>
                            <p>Why not buy a new awesome theme?</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
        </ul>
    </li>
    <!-- Notifications: style can be found in dropdown.less ->
    <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
                <!-- inner menu: contains the actual data ->
                <ul class="menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                            page and may cause design problems
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                    </li>
                </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
        </ul>
    </li>
    <!-- Tasks: style can be found in dropdown.less ->
    <li class="dropdown tasks-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-flag-o"></i>
            <span class="label label-danger">9</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have 9 tasks</li>
            <li>
                <!-- inner menu: contains the actual data ->
                <ul class="menu">
                    <li><!-- Task item ->
                        <a href="#">
                            <h3>
                                Design some buttons
                                <small class="pull-right">20%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item ->
                    <li><!-- Task item ->
                        <a href="#">
                            <h3>
                                Create a nice theme
                                <small class="pull-right">40%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">40% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item ->
                    <li><!-- Task item ->
                        <a href="#">
                            <h3>
                                Some task I need to do
                                <small class="pull-right">60%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item ->
                    <li><!-- Task item ->
                        <a href="#">
                            <h3>
                                Make beautiful transitions
                                <small class="pull-right">80%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item ->
                </ul>
            </li>
            <li class="footer">
                <a href="#">View all tasks</a>
            </li>
        </ul>
    </li>
    <!-- User Account: style can be found in dropdown.less -->
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
                        <?=Html::a('我的名片',['/vcards/index', 'uid'=>$loginuid],['class'=>'', 'target'=>'_blank'])?>

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
                    <a href="<?=yii\helpers\Url::to(['/user/setting'], true)?>" class="btn btn-default btn-flat">设置</a>
                </div>

                <?php
                if (Yii::$app->user->identity->role==100) {
                ?>
                <div class="col-xs-4 text-center">
                    <?=Html::a('管理员',['/admin/index'],['class'=>'btn btn-default btn-flat', 'target'=>'_blank'])?>
                </div>
                    <?

                }

                ?>
                <div class="col-xs-4 pull-right">


                    <?=Html::a('退出',['/site/logout'],['class'=>'btn btn-default btn-flat'])?>
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
            <!-- search form ->
            <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                      </button>
                    </span>
              </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">主菜单</li>
                <!--li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                        <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                    </ul>
                </li-->
                <li >
                    <a href="<?=Url::to(['/user/index'], true)?>">
                        <i class="fa fa-user"></i> 用户首页
                        <!--small class="label pull-right bg-red">3</small-->
                    </a>
                </li>


                <!--li>
                   <a href="pages/calendar.html">
                       <i class="fa fa-calendar"></i> <span>Calendar</span>
                       <small class="label pull-right bg-red">3</small>
                   </a>
               </li-->



                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span>用户设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class=""><a href="<?=Url::to(['/user/setting'], true)?>"><i class="fa fa-circle-o"></i> 安全设置</a></li>
                        <li><a href="<?=Url::to(['/user/specialsetting'], true)?>"><i class="fa fa-circle-o"></i> 个性设置</a></li>

                        <li><a href="<?=Url::to(['/user/user'], true)?>"><i class="fa fa-circle-o"></i> 基本信息</a></li>


                    </ul>
                </li>




                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-weixin"></i>
                        <span>微信公众号</span>
                        <small class="label pull-right bg-red">New</small>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class=""><a href="<?=Url::to(['/wechatgh/index'], true)?>"><i class="fa fa-circle-o"></i> 公众号设置</a></li>

                    </ul>
                </li>


                <li>
                    <a href="<?=Url::to(['/product'], true)?>">
                        <i class="fa fa-circle"></i> <span>产品管理</span>

                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(['/column'], true)?>">
                        <i class="fa fa-th"></i> <span>自定义字段</span>
                        <small class="label pull-right bg-red">New</small>
                    </a>
                </li>


                <li>
                    <a href="<?=Url::to(['/user/vcards'], true)?>">
                        <i class="fa fa-circle-o"></i>
                        二维码微名片
                    </a>
                </li>

                <?php
                if($role>=40) {
                    ?>

                    <li>
                        <a href="<?= Url::to(['/user/anti'], true) ?>">
                            <i class="fa fa-circle-o"></i> 二维码管理系统
                        </a>
                    </li>
                    <?php
                }
                ?>






                <!--li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>个人资料</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?//=yii\helpers\Url::to(['/user/user'], true)?>"><i class="fa fa-circle-o"></i> 基本信息</a></li>

                    </ul>
                </li-->




                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>扩展模块</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">

                        <?php
                        foreach($usermodule as $module){?>
                            <li>
                                <a href="<?=Url::to(['/'.$module['modulename']], true)?>">
                                    <i class="fa fa-circle-o"></i>
                                    <?=$module['module_label']?>
                                </a>
                            </li>

                            <?php
                        }
                        ?>


<!--
                        <li>
                            <a href="#">
                                <i class="fa fa-circle-o"></i>
                                企业名片(员工管理)
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>

                            <ul class="treeview-menu">

                                <li><a href="<?= Url::to(['/company/company/index'], true) ?>">
                                        <i class="fa fa-circle-o"></i>公司信息</a>

                                </li>

                                <li>
                                    <a href="<?= Url::to(['/company/department/index'], true) ?>">
                                        <i class="fa fa-circle-o"></i>部门管理
                                    </a>

                                </li>

                                <li>
                                    <a href="<?= Url::to(['/company/worker/index'], true) ?>">
                                        <i class="fa fa-circle-o"></i>职员列表
                                    </a>
                                </li>


                                <li>
                                    <a href="#">
                                        <i class="fa fa-circle-o"></i>
                                        Level Two
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i>
                                                Level Three
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-circle-o"></i>
                                                Level Three
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </li>
-->

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
                    'label' => '用户首页','url' => yii\helpers\Url::to(['/user/index'], true),//Yii::$app->homeUrl
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


<!--footer class="footer">
    <div class="container">
        <p class="pull-left"></p>

        <p class="pull-right"></p>
    </div>
</footer-->




<?php $this->endBody() ?>
</body>


<!-- jQuery 2.1.4 ->
<script src="bower_components/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 ->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip ->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 ->
<script src="bower_components/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts ->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline ->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap ->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart ->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker ->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker ->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 ->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll ->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick ->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App ->
<script src="bower_components/AdminLTE/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) ->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes ->
<script src="dist/js/demo.js"></script>
<!---->

<!--script type="text/javascript">
    var uip = "<?//=$userInfo->updated_ip?>";
    $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='+uip, function(_result){
        var ipData = ""; //初始化保存内容变量
        if (remote_ip_info.ret == '1'){
            ipData += remote_ip_info.province ;
            ipData +=  remote_ip_info.city;
        //    ipData += "区：" + remote_ip_info.district + "<br>";
          //  ipData += "ISP：" + remote_ip_info.isp + "<br>";
  //          ipData += "类型：" + remote_ip_info.type + "<br>";
    //        ipData += "其他：" + remote_ip_info.desc + "<br>";
            $("#sina_ip_info").html(ipData); //显示处理后的数据
        } else {
            alert('错误', '没有找到匹配的 IP 地址信息！');
        }
    });

</script-->
</html>
<?php $this->endPage() ?>

