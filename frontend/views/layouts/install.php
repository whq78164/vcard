<?php
/* @var $this yii\web\View */
use common\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);



/*
if($action == 'license') {
    if(Yii::$app->getRequest()->isPost) {
        setcookie('action', 'env');
        header('location: ?refresh');
        exit;
    }
    tpl_install_license();
}
*/

$classGo1 = isset($_COOKIE['steps'][0]) ? $_COOKIE['steps'][0]:'';
$classGo2 = isset($_COOKIE['steps'][1]) ? $_COOKIE['steps'][1]:'';
$classGo3 = isset($_COOKIE['steps'][2]) ? $_COOKIE['steps'][2]:'';
$classGo4 = isset($_COOKIE['steps'][3]) ? $_COOKIE['steps'][3]:'';








?>
<?php $this->beginPage() ?>
    <html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>安装系统 - 唯卡微名片 - 开源微商应用平台</title>
        <!--link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css"-->
        <?php $this->head() ?>
        <style>
            html,body{font-size:13px;font-family:"Microsoft YaHei UI", "微软雅黑", "宋体";}
            .pager li.previous a{margin-right:10px;}
            .header a{color:#FFF;}
            .header a:hover{color:#428bca;}
            .footer{padding:10px;}
            .footer a,.footer{color:#eee;font-size:14px;line-height:25px;}
        </style>
        <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background-color:#28b0e4;">
    <?php $this->beginBody() ?>
    <div class="container">
        <div class="header" style="margin:15px auto;">
            <ul class="nav nav-pills pull-right" role="tablist">
                <li role="presentation" class="active"><a href="javascript:;">安装系统</a></li>
                <li role="presentation"><a href="http://www.vcards.top">唯卡官网</a></li>
                <!--li role="presentation"><a href="http://bbs.vcards.top">访问论坛</a></li-->
            </ul>
            <img src="http://weixin.vcards.top/attachment/images/1/2015/10/wAr0fGUuqyV1shYqD5raHSs7CqJAoa.png" />
        </div>
        <div class="row well" style="margin:auto 0;">
            <div class="col-xs-3">
                <div class="progress" title="安装进度">
                    <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="<?=Yii::$app->session['progress']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=Yii::$app->session['progress']?>%;">
                        <?=Yii::$app->session['progress']?>%
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        安装步骤
                    </div>
                    <ul class="list-group">
                        <a href="javascript:;" class="list-group-item <?=$classGo1?>">
                            <span class="glyphicon glyphicon-copyright-mark"></span>
                            &nbsp; 许可协议
                        </a>
                        <a href="javascript:;" class="list-group-item <?=$classGo2?>">
                            <span class="glyphicon glyphicon-eye-open"></span>
                            &nbsp; 环境监测
                        </a>
                        <a href="javascript:;" class="list-group-item <?=$classGo3?>">
                            <span class="glyphicon glyphicon-cog"></span>
                            &nbsp; 参数配置
                        </a>
                        <a href="javascript:;" class="list-group-item <?=$classGo4?>">
                            <span class="glyphicon glyphicon-ok"></span>
                            &nbsp; 成功
                        </a>
                    </ul>
                </div>
            </div>
            <div class="col-xs-9">
                <?= Alert::widget() ?>

<?=$content?>

            </div>
        </div>
        <div  style="margin:15px auto;">
            <div  class="text-center">
                <a style="color:#eee;font-size:14px;line-height:25px;" href="http://www.vcards.top">关于我们</a> &nbsp; &nbsp; <!--a href="http://bbs.we7.cc">唯卡微名片帮助</a> &nbsp; &nbsp; <a href="http://www.we7.cc">购买授权</a-->
            </div>
            <div style="color:#eee;font-size:14px;line-height:25px;" class="text-center">
                Powered by <a style="color:#eee;font-size:14px;line-height:25px;" href="http://www.vcards.top"><b>通宝科技</b></a> v1.1 &copy; 2015 <a href="http://www.vcards.top">www.vcards.top</a>
            </div>
        </div>
    </div>
    <!--script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script-->
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>