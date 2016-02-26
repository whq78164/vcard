<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\AmazeAsset;
use frontend\assets\AppAsset;

//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use frontend\assets\Mobile_Detect;

use linslin\yii2\curl;
$curl = new curl\Curl();
$url='http://www.vcards.top/index.php?r=cloud/site';
$response = $curl->get($url);
$response=json_decode($response);

AmazeAsset::register($this);
AppAsset::register($this);
$mobile=new Mobile_Detect();
$role=Yii::$app->user->identity->role;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="这是一个 user 页面">
  <meta name="keywords" content="user">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <title><?= Html::encode($response->sitetitle) ?></title>
    <?php $this->head() ?>
</head>
<style type="text/css" xmlns="http://www.w3.org/1999/html">
    h1, h2 {font-family:"微软雅黑"; line-height:1.5em;}<!-- font-size: 16px; -->
    body p{font-family:"楷体"; line-height:1.5em;}
</style>
<body>
<?php $this->beginBody() ?>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->


<header class="am-topbar admin-header">
    <div class="am-topbar-brand">
        <a href="<?=yii\helpers\Url::to(['site/index'], true)?>">
            <span class="am-icon-home am-icon-md"></span>
        <strong><?=$response->sitetitle?></strong>

        <!--a href="<?=yii\helpers\Url::to(['user/index'], true)?>">
            <small>用户首页</small>
        </a-->

            </a>

    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">



            <li>

                    <a href="<?=yii\helpers\Url::to(['vcards/index', 'uid'=>Yii::$app->user->id],true)?>" target="_blank">
        <span class="am-icon-credit-card"></span>
      我的名片
                    </a>
            </li>

            <!--li>
                <a href="javascript:;">
                    <span class="am-icon-envelope-o"></span>
                    收件箱
                    <span class="am-badge am-badge-warning">0</span>
                </a>
            </li-->

            <!--li class="am-dropdown" data-am-dropdown-->
               <li>
                <!--a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;"-->
                   <a href="<?=yii\helpers\Url::to(['user/index'], true)?>">
                    <span class="am-icon-user"></span>
                    <?= Yii::$app->user->identity->username . '&nbsp;'.Yii::t('tbhome', 'hello') .'！'?> <!--span class="am-icon-caret-down">
                    </span-->
                </a>
                <!--ul class="am-dropdown-content">
                    <li>
                        <a href="<?=yii\helpers\Url::to(['user/info'], true)?>">
                            <span class="am-icon-user"></span>
                            资料
                        </a></li>
                    <li>
                        <a href="<?=yii\helpers\Url::to(['user/setting'], true)?>">
                            <span class="am-icon-cog"></span>
                            设置
                        </a>
                    </li>
                </ul-->
            </li>

            <li class="am-hide-sm-only">
                <a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span>
                </a>
            </li>
            <li>
                <a href="<?=yii\helpers\Url::to(['site/logout'], true)?>">
                    <span class="am-icon-power-off"></span>
                    退出
                </a>
            </li>
        </ul>
    </div>

</header>

<div class="wrap am-cf admin-main">
    <!-- sidebar start -->
 <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">


        <div class="am-offcanvas-bar admin-offcanvas-bar">



            <ul class="am-list admin-sidebar-list">



                <li>
                    <a href="<?=yii\helpers\Url::to(['user/index'], true)?>">
                        <span class="am-icon-university am-icon"></span>
                        账户首页
                    </a>
                </li>

                <!--li>

                    <a href="<?=yii\helpers\Url::to(['vcards/index', 'uid'=>Yii::$app->user->id],true)?>" target="_blank">
                        <span class="am-icon-credit-card"></span>
                        我的名片
                    </a>
                </li-->


                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{target: '#collapse-nav3'}">
                        <span class="am-icon-gear am-icon"></span>
                        用户设置
                        <span class="am-icon-angle-right am-fr am-margin-right"></span>
                    </a>
                    <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav3">

                        <li>
                            <a href="<?=yii\helpers\Url::to(['user/setting'], true)?>" class="am-cf">
                                <span class="am-icon-gear am-icon"></span>
                                <?//=$this->title?>安全设置
                            </a>
                        </li>
                        <li>
                            <a href="<?=yii\helpers\Url::to(['user/specialsetting'], true)?>">
                                <span class="am-icon-server"></span>
                                个性设置
                            </a>
                        </li>
                    </ul>
                </li>

                <!--li>
                    <a href="<?=yii\helpers\Url::to(['user/user'], true)?>" class="am-cf">
                        <span class="am-icon-check"></span>
                        我的账户

                    </a>
                </li-->

                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}">
                        <span class="am-icon-user am-icon"></span>
                        个人资料
                        <span class="am-icon-angle-right am-fr am-margin-right"></span>
                    </a>
                    <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">

                    <li>
                    <a href="<?=yii\helpers\Url::to(['user/user'], true)?>">
                        <span class="am-icon-info"></span>
                        基本信息
                        <span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span>
                    </a>
                    </li>
              <!--          <li>
                            <a href="<?=yii\helpers\Url::to(['user/info'], true)?>">
                                <span class="am-icon-server"></span>
                                详细信息
                            </a>
                        </li>
               <!--         <li>
                            <a href="admin-gallery.html">
                                <span class="am-icon-th"></span>
                                相册页面
                                <span class="am-badge am-badge-secondary am-margin-right am-fr">24</span>
                            </a>
                        </li>

                        <li>
                            <a href="admin-404.html">
                                <span class="am-icon-bug"></span> 404
                            </a>
                        </li>
                  -->
                    </ul>
                </li>

           <!--     <li>
                    <a href="admin-table.html">
                        <span class="am-icon-table"></span>
                        表格
                    </a>
                </li>
                <li>
                    <a href="admin-form.html">
                        <span class="am-icon-pencil-square-o"></span>
                        表单
                    </a>
                </li>
          -->

                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{target: '#collapse-nav1'}">
                        <span class="am-icon-cubes am-icon"></span>
                        扩展模块
                        <span class="am-icon-angle-right am-fr am-margin-right"></span>
                    </a>
                    <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav1">

                        <li>
                            <a href="<?=yii\helpers\Url::to(['user/vcards'], true)?>" >
                                <span class="am-icon-credit-card"></span>
                                二维码微名片
                            </a>
                        </li>
                        <?php
                        if($role>=40) {
                            ?>

                            <li>
                                <a href="<?= yii\helpers\Url::to(['user/anti'], true) ?>">
                                    <span class="am-icon-shield"></span>
                                    二维码管理系统
                                </a>
                            </li>
							<?php 
						}
							?>
                           
                             <!--li>
                                     <a href="admin-gallery.html">
                                         <span class="am-icon-th"></span>
                                         相册页面
                                         <span class="am-badge am-badge-secondary am-margin-right am-fr">24</span>
                                     </a>
                                 </li>

                                 <li>
                                     <a href="admin-404.html">
                                         <span class="am-icon-bug"></span> 404
                                     </a>
                                 </li-->


                    </ul>
                </li>


                <li>
                    <a href="<?=yii\helpers\Url::to(['site/logout'], true)?>">
                        <span class="am-icon-sign-out"></span>
                        注销
                    </a>
                </li>

                <li>
                    <a href="<?=yii\helpers\Url::to(['site/index'], true)?>">
                        <span class="am-icon-reply"></span>
                        网站首页
                    </a>
                </li>



            </ul>





            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-bookmark"></span> 公告</p>
                    <p>在使用的过程中，有任何问题或建议，希望大家能积极反馈，我们全力解决。<br>唯卡微名片，做人人用得起的网络应用平台。<br><span class="pull-right">—— Vcards</span></p>
                </div>
            </div>


            <?php
            if (!$mobile->isMobile()) {
                ?>

                <div class="am-u-md-10 am-panel am-panel-default admin-sidebar-panel">
                    <div class="  panel panel-primary">

                        <div class="panel-heading ">
                            我的微名片
                        </div>

                        <?php
                        $urlval0=yii\helpers\Url::to(['vcards/index', 'uid'=>Yii::$app->user->id], true);
                        $urlval='http://www.vcards.top/qrcode.php?value='.urlencode($urlval0);
                        ?>

                        <a href="<?= $urlval0 ?>" target="_blank">
                            <img class="am-img-circle am-img-thumbnail"
                                 src="<?= $urlval ?>">
                        </a>

                    </div>

                </div>

            <?php } ?>

<!--
            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-tag"></span> wiki</p>
                    <p>需要定制开发功能，有行业特殊需求，请联系我们。</p>
                </div>
            </div>
-->


        </div>

    </div>
    <!-- sidebar end -->

<!--div class="wrap"-->

  <!-- content start -->
 
    <div class="admin-content">
 <!--               <span style="float: right;">
        <a style="" href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'zh-CN']);?>">中文</a> /
        <a style="" href="<?php echo Yii::$app->urlManager->createUrl(['/site/language','lang'=>'en-US']);?>">English</a>
        </span>
-->
        <?= Breadcrumbs::widget([
           'homeLink'=>[
  //             'class' =>'am-text-primary am-text-lg',
               'label' => '用户首页','url' => yii\helpers\Url::to(['user/index'], true),//Yii::$app->homeUrl
           ],
            'options' => ['class' => 'am-breadcrumb'],
              'links' =>
 //                 [
 //             'label' =>
                  isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
 //             ],
        ]) ?>
        <?php

        ?>
        <?= Alert::widget() ?>
        <!--div class="am-cf am-padding">
            <div class="am-fl am-cf">
                <strong class="am-text-primary">
                 <h2>   <?= Html::encode($this->title) ?></h2>
                </strong>
            </div>
        </div-->

        <?= $content ?>
	</div>

  <!-- content end -->

</div>



<a href="#" class="am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}">
    <span class="am-icon-btn am-icon-th-list"></span>
</a>

<!--footer>
    <hr>
    <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
</footer-->

<footer class="footer">
    <div class="container">
        <p class="pull-left"><?= $response->copyright ?></p>

        <p class="pull-right"><?= $response->icp ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

