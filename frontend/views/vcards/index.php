<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Micropage;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use frontend\assets\QRCardAsset;
//use common\widgets\Alert;

QRCardAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />

        <?= Html::csrfMetaTags() ?>

        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="format-detection" content="telephone=no, email=no" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <!--公司的LOGO-->
        <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
        <!--
        <link rel="apple-touch-icon-precomposed" href="../images/touch-icon-ipad-144.png">
        -->
        <meta name="renderer" content="webkit"> <!-- 360浏览器指定默认极速模式 -->
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" > <!-- 优先用Chrome渲染 -->
        <!--
                <link rel="stylesheet" type="text/css" href="http://cdn.amazeui.org/amazeui/2.4.2/css/amazeui.min.css">
                <link rel="stylesheet" type="text/css" href="css/theme.css">
        -->

        <!--div id='wx_pic' style='margin:0 auto;display:none;'>
            <img src="<?=$userdata['face_box'] ? $userdata['face_box'] : 'Uploads/default_face.jpg'?>" onerror="this.style.display='none'" />
        </div-->

        <img src="<?=$userdata['face_box'] ? $userdata['face_box'] : 'Uploads/default_face.jpg'?>" width="0" height="0">



        <?php $this->title = $userdata['card_title'] ? $userdata['card_title']:$userdata['name'].'的二维码智能名片'; ?>

        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>


    <style type="text/css">
        html,body,.loadbox{height:100%;}
        .loadbox{position:relative;z-index:2111;}
        .loadUp{height:50%;width:100%;background-color:#fff;top:0px;left:0px;}
        .slideUp{-webkit-animation: slideUp 0.5s  linear;-webkit-transition: all 0.5s;opacity:0; }
        .slideDown{-webkit-animation: slideDown 0.5s  linear;-webkit-transition: all 0.5s;opacity:0;}
        .loadDown{height:50%;width:100%;background-color:#fff;bottom:0px;left:0px;}
        @-webkit-keyframes slideUp{
            0%{-webkit-transform:translate(0,0);}
            100%{-webkit-transform:translate(0,-100%);}
        }
        @-webkit-keyframes slideDown{
            0%{-webkit-transform:translate(0,0);}
            100%{-webkit-transform:translate(0,100%);}
        }
        .game_time{width:100px;height:100px;position:absolute;top:20%;left:50%;margin-left:-80px;text-align:center;}
        /* time scroll*/
        .pie{width:160px;height:160px;background-color:blue;border-radius:160px;position:absolute;}
        .pie1{clip:rect(0px,160px,160px,80px);-o-transform:rotate(0deg);-moz-transform:rotate(0deg);-webkit-transform:rotate(0deg);background-color:#fff;}
        .pie2{clip:rect(0px,80px,160px,0px);-o-transform:rotate(0deg);-moz-transform:rotate(0deg);-webkit-transform:rotate(0deg);background-color:#fff;}
        .hold{width:160px;height:160px;position:absolute;z-index:1;}
        .bg100{width:160px;height:160px;border-radius:160px;position:absolute;background-color:#d13c36;}
        .whiteBg{width:150px;height:150px;margin:5px 0 0 5px;background-color:#fff;border-radius:160px;position:absolute;z-index:1;}
        .time{width:160px;margin: 185px 0 0 0;position:absolute;z-index:1;text-align:center;font-size:36px;}
        .headImg{width:120px;height:120px;margin:20px 0 0 20px;background-color:#fff;border-radius:160px;position:absolute;z-index:1;}
        .headImg img{width:100%;}
        .m-level-gif{display: inline-block; width: 24px; height: 24px; overflow: hidden; text-align: center;
            -webkit-border-radius: 100%;
            border-radius: 100%;
            border: solid 2px rgba(255,255,255,0.8);
            vertical-align: top;
            position: absolute;
            bottom: 0;
            right: 15px;
            border: solid 2px #fff;
            color: #fff;
            line-height: 19px;
            font-size: 1.1rem;}
    </style>

    <!--
     <script type="text/javascript" src="js/zepto.min.js"></script>
      <script type="text/javascript" src="js/time_js.js"></script>
    -->
    <!----loading------>
    <div class="loadbox">
        <div class="loadUp"></div>
        <div class="loadDown"></div>
        <div class="game_time">
            <div class="hold">
                <div class="pie pie1"></div>
            </div>
            <div class="hold">
                <div class="pie pie2"></div>
            </div>
            <div class="bg100"></div>
            <div class="whiteBg"></div>
            <div class="headImg">
                <section >
                    <div ><img style=" border-radius: 60px;" src="<?=$userdata['face_box'] ? $userdata['face_box'] : 'Uploads/default_face.jpg'?>" onerror="this.style.display='none'"></div>
                </section>

            </div>
            <div class="time"></div>
        </div>
    </div>
    <!----loading--positon:relative width:100px;height:80px;position:absolute;top:50%;left:50%;margin-left:50px; end---->

    <div class="m-content m-screen">
        <div style="" class="m-wrapbox" id="j-m-wrapbox">
            <header style="" class="m-head">
                <a style="" class="m-btn-menu iconfont" data-action="aside-menu" href="javascript:void(0)"></a>
                <h1 style="margin-top:1px" class="ui-elli">
					<span >
					<?= $userdata['unit'] ?>
			    	</span>
                </h1>
            </header>
            <div class="m-wrap">
                <div class="m-infobox">
                    <!-- 头像等 -->
                    <section class="m-infos">
                        <a href="<?=yii\helpers\Url::to(['user/user'], true)?>" class="m-face-box">
                            <div class="m-face iconfont"><img src="<?=$userdata['face_box']?>"></div>
                        </a>
                        <div class="m-infos-cont">
                            <div class="m-name ui-elli"><span>
							<?= $userdata['name'] ?>
							</span></div>
                            <div class="m-post ui-elli"><span>
								<?= $userdata['department'] ?>
							</span>&nbsp;&nbsp;<span><?= $userdata['position'] ?></span></div>
                        </div>
                    </section>
                    <!-- 访客 -->
                    <section class="m-visitors">



                        <i class="iconfont i-visitor"></i>
                        <div class="m-num">
                            <!--统计浏览量-->
                        </div>


                    </section>
                    <!-- section 访客 end -->
                    <i data-action="aside2" class="iconfont m-rside-btn"></i>
                </div>
                <!-- 个人信息  -->
                <div class="m-scroll">
                    <div class="m-modbox">
                        <div class="m-modbox-inner">
                            <section class="m-mod fixed">
                                <ul class="m-personalinfo fixed">
                                    <li class="fixed">
                                        <i data-action="dailog-qr" class="iconfont i-qrcode"></i>
                                        <a data-action="popUp" class="m-tel" href="javascript:void(0)">
                                            <i class="iconfont i-tel"></i>
                                            <span><?= $userdata['mobile'] ?></span>
                                        </a>
                                    </li>
<?php
if ($userdata['address']){
    $addr = <<<EFO
<li>
                                        <i class="iconfont i-arrow"></i>
                                        <div class="cont">
                                            <div class="m-address num">
                                              ==add

                                            </div>
                                        </div>
                                    </li>;

EFO;
    echo str_replace('==add', $userdata['address'], $addr);
}

?>

<?php

function labelecho($label, $value){
    $labeltpl= <<<EOF
                                    <li>
                                        <span class="m-tle">++label</span>
                                        <div class="cont">
                                            <div class="ui-elli num" style="">
                                                ++value
                                            </div>
                                        </div>


                                    </li>
EOF;
    $labelout=str_replace( ['++label','++value'],[$label,$value],$labeltpl);
if ($value){
    echo $labelout;
}
}

labelecho('传真', $userdata['fax']);
labelecho('E-Mail', $userdata['email']);
labelecho('QQ', $userdata['qq']);

?>


<?php
$labelcount=$label->count();
$label=$label->all();
                                    for($i=0; $i<$labelcount; $i++){
                                    ?>
                                    <li>
                                        <span class="m-tle"><?= $label[$i]->card_label ?></span>

                                        <div class="cont">
                                            <div class="ui-elli num" style=""><?= $label[$i]->card_value ?></div>
                                        </div>
                                    </li>
                                    <?php
                                    }
?>







                                    <?php
                                    if ($userdata['wechat_account']){
                                        $wechat_acc = <<<EFO

                                    <li>
                                        <span class="m-tle">微信</span>
                                        <div class="cont">
                                            <div class="ui-elli num" style="padding-right: 80px;">
                                             ++account
                                            </div>
                                        </div>

                                        <a href="#" class="addfriends" data-action="dailog-addfriends" data-type="weixin">加微信</a>


                                    </li>

EFO;
 echo str_replace('++account', $userdata['wechat_account'], $wechat_acc);
                                    }

                                    ?>




                                    <!--
                                                                                  <li>
                                                                                      <span class="m-tle">新浪微博</span>
                                                                                      <div class="cont">
                                                                                          <div class="ui-elli num" style="padding-right: 80px;">whq78164</div>
                                                                                      </div>



                                                                                        <a href="#" class="addfriends" data-action="dailog-addfriends" data-type="weibo">关注</a>

                                                                                  </li>
                                    -->

                                    <!--



                                                                                  <li>
                                                                                      <span class="m-tle">新字段</span>
                                                                                      <div class="cont">
                                                                                          <div class="ui-elli num" style="">心内容找我哦哦摸摸大部分985686646546618946464994646946434833866835564656</div>
                                                                                      </div>



                                                                                  </li>

                                    -->
                                </ul>
                            </section>
                            <!--  -->

                            <section class="m-mod fixed">
                                <ul class="m-personalinfo fixed">
                                    <div class="m-signature">
                                        <h3>产品&服务</h3>
                                        <div class="m-cont">
                                            <?= $userdata['business'] ?>


                                        </div>
                                    </div>
                                </ul>
                            </section>

<?php
if (strlen($userdata['signature'])>1) {
    ?>
    <section class="m-mod fixed">
        <ul class="m-personalinfo fixed">
            <div class="m-signature">
                <h3>我的签名</h3>

                <div class="m-cont">
                    <?= $userdata['signature'] ?>

                </div>
            </div>
            <ul class="m-personalinfo fixed">
    </section>
    <?php
}
?>



                        </div>
                    </div>
                </div>
                <!-- 贴片 我要创建 -->

                <div class="m-cardadd" id="j-m-cardadd">
                    <i class="iconfont i-close" data-action="adclose"></i>
                    <a href="<?=yii\helpers\Url::to(['site/signup'], true)?>" class="cardadd-btn">我也要创建</a>
                </div>

            </div>
            /*底部菜单*/
            <footer class="m-foot flexbox">
                <a href="javascript:void(0);" class="flex" data-action="popUp">
                    <i class="am-icon-phone-square am-icon-lg am-icon-md"></i>
                </a>
                <!--a href="javascript:mapSkip();" class="flex"-->
                <a href="sms:<?=$userdata['mobile']?>" class="flex">
                    <i class="am-icon-lg am-icon-envelope-o"></i>
                </a>
                <a href="javascript:void(0)" data-action="custom3" class="flex">
                    <i class="am-icon-plus-circle am-icon-lg" id="j-customMore"></i>
                </a>
<?
//$tmpnemu = Url::to(['vcards/micropage', 'id'=>$micropage[0]->id], true);
$menupic= isset($micropage[0]) ? Url::to(['vcards/micropage', 'id'=>$micropage[0]->id], true) : Url::to(['vcards/micropage', 'id'=>1], true);
?>
                <a href="<?=$menupic?>" class="flex">
                    <i class="am-icon-file-image-o am-icon-lg"></i>
                </a>
                <a href="javascript:void(0)" class="flex" data-action="custom2">
                    <i class="am-icon-external-link-square am-icon-lg"></i>
                </a>
            </footer>
            <!-- 标签栏弹出层-微单页 -->
            <section class="m-custommenu" id="j-custom1">
                <ul class="m-rootweb-list fixed">




                    <li><a href="http://chong.qq.com" target="_blank"><span class="am-icon-cny am-icon-lg "></span><span >充值缴费</span></a></li>

                    <li><a href="http://m.kuaidi100.com" target="_blank"><span class=" am-icon-lg am-icon-search"></span><span >快递查询</span></a></li>

                    <li><a href="http://touch.qunar.com" target="_blank"><span class="am-icon-lg am-icon-send-o"></span><span>出行订票</span></a></li>

                    <li><a href="http://music.baidu.com"><span class="am-icon-lg am-icon-music"></span><span>音乐</span></a></li>
                    <?php
                    $pagePart= <<<EOF
<li>
<a href="--url--" target="_blank">
<span class="am-icon-file-text-o am-icon-lg"></span>
<span>--title--</span>
</a>
</li>
EOF;

                    if ($micropage){//!==null
                        foreach($micropage as $il_part){
                            $part_il=str_replace(
                                ['--url--','--title--'],
                                [Url::to(['vcards/micropage', 'id'=>$il_part->id], true),$il_part->page_title],
                                $pagePart);
                            echo $part_il;
                        }
                    }
                    ?>



                    <!--		<li><a href="http://zuoche.com/"><i class="toolicon"></i><span >公交</span></a></li>

                            <li><a href="http://api.kuaidadi.com:9898/taxi/h5/index.htm?source=ucbrowser&amp;key=iweuriojvi32u98usadjfkldsj"><i class="toolicon"></i><span class="ui-elli">打车</span></a></li>

                            <li><a href="http://i.meituan.com"><i class="toolicon"></i><span class="ui-elli">团购</span></a></li>

                            <li><a href="http://m.maoyan.com"><i class="toolicon"></i><span class="ui-elli">电影</span></a></li>

                            <li><a href="http://m.dianping.com"><i class="toolicon"></i><span class="ui-elli">美食</span></a></li>

                            <li><a href="http://h5.m.taobao.com/dd/index.htm"><i class="toolicon"></i><span class="ui-elli">外卖</span></a></li>

                            <li><a href="http://music.baidu.com"><i class="toolicon"></i><span class="ui-elli">音乐</span></a></li>
        -->
                </ul>
            </section>
            <!--link rel="stylesheet" type="text/css" href="http://cdn.amazeui.org/amazeui/2.4.2/css/amazeui.min.css"-->
            <div id="j-custom-overlay1" class="m-custommenu-overlay" data-action="custom"></div>
            <!-- 标签栏弹出层-微链接 -->
            <section class="m-custommenu" id="j-custom2">

                <ul class="m-custommenu-ul fixed">
<?php
$linkPart= <<<EOF
<li>
<a href="_URL%_" target="_blank">
<span class="am-icon-external-link am-icon-lg"></span>
<div class="m-tle ui-elli">
_TITLE%_
</div>
</a>
</li>
EOF;

if ($microlink){//!==null
foreach($microlink as $il_part){
    $part_il=str_replace(
        ['_URL%_','_TITLE%_'],
        [$il_part->link_url,$il_part->link_title],
        $linkPart);
        echo $part_il;
}
                    }
?>
                </ul>


            </section>
            <div id="j-custom-overlay2" class="m-custommenu-overlay" data-action="custom2"></div>
            <!-- 背景层 -->
            <!--
                        <section class="m-bgbox" style="background-image:url(images/otg=.jpg)"></section>
            -->
            <section class="m-bgbox" style="background-image:url(
            <?=isset($bg_image) ? $bg_image : 'Uploads/bg_image/tbhome.jpg' ?>)"></section>
            <!-- 弹出层  begin-->



            <!-- 弹出-二维码 begin -->
            <style>
                .bar1 {-moz-transform:rotate(0deg) translate(0, -40px);-webkit-transform:rotate(0deg) translate(0, -40px);opacity:0.12;  }
                .bar2 {-moz-transform:rotate(45deg) translate(0, -40px);-webkit-transform:rotate(45deg) translate(0, -40px);opacity:0.25;  }
                .bar3 {-moz-transform:rotate(90deg) translate(0, -40px);-webkit-transform:rotate(90deg) translate(0, -40px);opacity:0.37;  }
                .bar4 {-moz-transform:rotate(135deg) translate(0, -40px); -webkit-transform:rotate(135deg) translate(0, -40px);opacity:0.50;  }
                .bar5 {-moz-transform:rotate(180deg) translate(0, -40px);-webkit-transform:rotate(180deg) translate(0, -40px);opacity:0.62;  }
                .bar6 {-moz-transform:rotate(225deg) translate(0, -40px);  -webkit-transform:rotate(225deg) translate(0, -40px);opacity:0.75;  }
                .bar7 {-moz-transform:rotate(270deg) translate(0, -40px);  -webkit-transform:rotate(270deg) translate(0, -40px);opacity:0.87;  }
                .bar8 {-moz-transform:rotate(315deg) translate(0, -40px);  -webkit-transform:rotate(315deg) translate(0, -40px);opacity:1;  }
                .loading-qr {position:relative;width:100px;height:100px;  margin-bottom:1.5em;  margin-right:1.5em;  -moz-border-radius:100px;  margin:0 auto;  -moz-transform:scale(0.5);  -webkit-transform:scale(0.5);  }
                .loading-qr  div {width:10px; height:30px; border-radius: 10px;  background:#000;  position:absolute;  top:35px;  left:45px; }
                @-webkit-keyframes rotateThis {
                    from {-webkit-transform:scale(0.5) rotate(0deg);}
                    to {-webkit-transform:scale(0.5) rotate(360deg);}
                }
            </style>
            <div class="m-qrpopmask" id="j-m-qrpop" >
                <section class="m-qrpop" style="min-width:90%;">
                    <div class="tab-hd">
                        <span name="twoCode" class="item flex-center active" data-type='0'>导入通讯录</span>
                        <span  name="twoCode" class="item flex-center" data-type="1">名片二维码</span>
                    </div>
                    <div id="j-link-qr" class="tab-cont" style="display: none;">
					<?php
					$urlval0=yii\helpers\Url::to(['vcards/index', 'uid'=>$userdata['uid']], true);
		//			$urlval='http://www.vcards.top/qrcode.php?value='.urlencode($urlval0);
                    $urlval=genqrcode($urlval0);
					?>
					<!---->
                        <input type="hidden" id="mpLinkQRCodeUrl" value="<?=$urlval?>">
                        <div class="tc" ><img id="mpLinkQRCode" style="width:80%;"  src=""/></div>
                        <div class="tc mt-5">扫描二维码，访问TA的名片</div>
                    </div>
<?php
$vcardsmpqr="BEGIN:VCARD%0AVERSION:3.0%0AN:". $userdata['name'] .'%0AORG:'. $userdata['unit'] .'%0AEMAIL:'.$userdata['email'].'%0ATITLE:'.$userdata['position'].'%0ATEL;TYPE=WORK:'.$userdata['work_tel'].'%0ATEL;type=CELL:'. $userdata['mobile'].'%0AURL:'.urlencode($urlval0)."%0AEND:VCARD";
?>
                    <div id="j-content-qr" class="tab-cont">
                        <input type="hidden" id="mpContentQRCodeUrl"
                               value="<?=genqr($vcardsmpqr)?>">
                        <div class=" tc" ><img id="mpContentQRCode" style="width:80%;" src=""/></div>
                        <div class="fs-16 tc mt-10">
                            两种方法保存至通讯录：
                            <br>1.微信扫一扫，秒存名片信息。
                            <br/>2.按住图片，识别图中二维码。
                        </div>

                        <!--div class="tc mt-10">
                            <a class="btn-vcf" href="http://localhost/vcards/frontend/web/qrcode.php?vcards=<?//=$vcards?>">导入手机通讯录</a>
                        </div-->
                    </div>
                    <div class="link-content-qr" style="padding-top: 40px;">
                        <div class="loading-qr ">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                            <div class="bar4"></div>
                            <div class="bar5"></div>
                            <div class="bar6"></div>
                            <div class="bar7"></div>
                            <div class="bar8"></div>
                        </div>
                        <div style="text-align: center;  padding-bottom: 20px;">二维码加载中...</div>
                    </div>
                    <div class="m-close" data-action="dailog-close"><span class="iconfont">&#xe60f;</span></div>
                </section>
            </div>
            <div class="m-qrpopmask" id="j-m-addfriendsqrpop">
                <section class="m-qrpop" style="width: 80%;min-height: 30%;position: relative">
                    <span class="iconfont" id="closeaddfriendsqrpop" style="position:absolute;top:10px;right:10px;font-size:2rem;">&#xe60f;</span>





                    <input type="hidden" id="weixin_addfriendsqr" value="<?=$userdata['wechat_qrcode']?>" >
                    <img style="display: none;" data-type="weixinQr" src = "<?=$userdata['wechat_qrcode']?>" onerror="javascript:qrimgerror(this);">


                    <div class="tc mt-15">
                        <h1 style="font-size: 1.8rem;color: #000;  padding-top: 15px;">长按二维码</h1>
                        <p style="margin-top: 10px;font-size: 1.4rem;color: #000;">选择“识别图中二维码”</p>
                    </div>
                    <div class="tc addfriendsqrimg" style="padding: 10px 0 40px 0;"><img id="addfriendsqr" style="width:80%;"  src=""/></div>
                    <div class="loading-qr-addfriendsqr">
                        <div class="loading-qr ">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                            <div class="bar4"></div>
                            <div class="bar5"></div>
                            <div class="bar6"></div>
                            <div class="bar7"></div>
                            <div class="bar8"></div>
                        </div>
                        <div style="text-align: center; padding-bottom: 20px;">二维码加载中...</div>
                    </div>

                </section>
            </div>
            <!-- 弹出-二维码 end -->
            <!-- Toast通知 begin -->
            <div class="ui-toast ui-toast-icon" id="j-toast-icon">
                <div class="toast-cont">
                    <i class="iconfont"></i>已收藏
                </div>
            </div>
            <!-- Toast通知 end -->
            <!-- ui-popup 拨号弹出 begin-->
            <section class="ui-popup-mask flex-center" id="j-popupTel">
                <div class="ui-popup">
                    <ul class="m-tellist">
<?php
function telecho($label, $number){
    $teltpl= <<<EOF
<li>
                            <a class="m-link" href="tel:==number">
                                <div class="m-des">==label</div>
                                <i class="iconfont"></i>
                                <span class="m-tel">==number</span>
                            </a>
                        </li>
EOF;
    $telpart= str_replace(['==label','==number'], [$label, $number], $teltpl);
    if ($number) echo $telpart;

}
telecho('手机', $userdata['mobile']);

?>


                    </ul>
                    <div class="ui-popup-close iconfont" data-action="popUpClose"></div>
                </div>
            </section>


            <!-- 箭头提醒 -->
            <div class="m-moveiconup">
                <i class="iconfont i-up"></i>
            </div>
        </div>

        <!-- 右侧栏开始 -->
        <?= $this->render('_rside') ?>
        <!-- 右侧栏结束 -->


        <!-- 左侧栏 开始-->
        <!-- 侧栏 -->
<?php
if (!Yii::$app->user->isGuest)
{
   echo $this->render('_lsidelogin');
         } else {
    echo $this->render('_lsideguest');
}
?>
        <!--左侧栏结束--->

        <div class="m-side-overlay2"  data-action="aside2"></div>
    </div>

    <input type="hidden" id="id" value="12471800">
    <input type="hidden" id="applyId" value="">
    <input type="hidden" id="phoneIdEcr" value="12138C1D641F71957CB0BCD31B48A3E7">

    <div class="ui-toast" id="j-toast-default">
        <div class="toast-cont">默认的Toast通知</div>
    </div>
    <div class="ui-toast ui-toast-icon" id="j-toast-icon">
        <div class="toast-cont"><i class="iconfont"></i>图标通知</div>
    </div>
    <section class="ui-popup-mask flex-center" id="j-fail-close" >
        <div class="ui-popup">
            <div class="ui-popup-cont">
                <div class="ui-popup-tip">
                    <div class="tip-err"><i class="iconfont i-err"></i></div>
                    <div class="tip-txt">
                        <p class="fs-20" data-action="j-fail-close-tip">对不起，设置失败!</p>
                        <p class="fs-14 mt-10" data-action="j-fail-close-content">有可能是您未设置身份证</p>
                    </div>
                </div>
            </div>
            <div class="ui-popup-close iconfont" data-action="popUpClose"></div>
        </div>
    </section>
    <section class="ui-popup-mask flex-center" data-action="j-confirm-default">
        <div class="ui-popup">
            <div class="ui-popup-cont">
                <p class="tc pad-20" data-action="j-confirm-default-content">这里是内容</p>
            </div>
            <div class="ui-popup-btns flexbox">
                <a class="flex" href="javascript:void(0)" data-action="popUpClose">取消</a>
                <a class="flex" href="javascript:void(0)" data-action="j-confirm-default-true">确定</a>
            </div>
        </div>
    </section>
    <section class="ui-popup-mask flex-center" id="j-confirm-tip" >
        <div class="ui-popup">
            <div class="ui-popup-hd"><h3 data-action="j-confirm-tip-tip">普通对话框</h3></div>
            <div class="ui-popup-cont">
                <p class="tc pad-20" data-action="j-confirm-tip-content">这里是内容</p>
            </div>
            <div class="ui-popup-btns flexbox">
                <a class="flex" href="javascript:void(0)" data-action="popUpClose">取消</a>
                <a class="flex" href="javascript:void(0)" data-action="j-confirm-tip-true">确定</a>
            </div>
        </div>
    </section>
    <section class="ui-popup-mask flex-center" id="j-confirm-fail-operation" >
        <div class="ui-popup">
            <div class="ui-popup-cont">
                <div class="ui-popup-tip">
                    <div class="tip-err"><i class="iconfont i-err"></i></div>
                    <div class="tip-txt">
                        <p class="fs-20" data-action="j-confirm-fail-operation-tip">对不起，设置失败!</p>
                        <p class="fs-14 mt-10" data-action="j-confirm-fail-operation-content">有可能是您未设置身份证</p>
                    </div>
                </div>
            </div>
            <div class="ui-popup-btns flexbox">
                <a class="flex" href="javascript:void(0)" data-action="popUpClose">取消</a>
                <a class="flex" href="javascript:void(0)" data-action="j-confirm-fail-operation-reset">重新设置</a>
            </div>
        </div>
    </section>
    <section class="ui-popup-mask flex-center" id="popup-while-defalut" >
        <div class="ui-popup">
            <div class="ui-popup-cont"  data-action="j-while-content">
            </div>
            <div class="ui-popup-close iconfont" data-action="popUpClose"></div>
        </div>
    </section>
    <!--
        <script type="text/javascript" src="js/zepto.min.js"></script>


        <script type="text/javascript" src="js/zepto.touch.min.js"></script>

        <script type="text/javascript" src="js/util.js"></script>
    -->
    <!--
    <link rel="stylesheet" href="css/shareandshowtips.css">
    -->
    <!--
    <script src="js/shareandsavetips.js"></script>
    -->
    <div id="favor_Info" class="favor_info">
        <p id="float_knowed" class="float_knowed ">知道了</p>
    </div>

    <div id="favor_Info_Other" class="favor_info" style="background-color: black;opacity: 0.8;">
        <p id="float_knowed" class="float_knowed float_konwed_top" style="top: 45%;border: none;left: 10%;width: 80%">添加快捷方式至手机桌面，建议您使用uc浏览器，或者360浏览器</p>
        <p id="downLoadUC" class="float_knowed float_konwed_top" style="top: 65%;">下载uc浏览器</p>
        <p id="downLoad360" class="float_knowed float_konwed_top" style="top: 75%;">下载360浏览器</p>
    </div>


    <div id="favor_Info_teach" class="favor_info teach-common" >
        <span id="teachText" class="teach_text_common"></span>
    </div>
    <!--
        <script type="text/javascript" src="js/basic.js"></script>

        <script type="text/javascript" src="js/themes_common.js"></script>
    -->
    <script type="text/javascript">
        $(function () {
            //获取屏幕宽高
            var bodyWidth = $(window).width();
            var bodyHeight = $(window).height();

            //滚动提示
            $('.m-scroll').on('touchmove',function(){
                if ( $('.m-scroll').scrollTop() > 10)
                {
                    $('.m-moveiconup').hide();
                }else{
                }
            });

            //foot 标签栏弹出层
            var ctmH = bodyHeight - 100
            $('.m-custommenu').css({
                "max-height":ctmH
            })

            $("[data-action='custom3']").on('touchend mouseup',function(){
                var load = $('.m-rootweb-list').html();
                if(load.length == 0){
                    var id = $("#id").val();//获取名片id
                    var vistorId = $("#vistorId").val();//访问者id
                    $.ajax({
                        type: "post",
                        dataType:"json",
                        data:{"id":id},
                        url: path+"/mpCompany/getRootWebSite.xhtml",
                        success:function(msg){
                            var html = "";
                            $.each(msg.sites,function(index,item){
                                html +='<li><a href="'+item.siteUrl+'"><i class="toolicon">'+item.siteIconName+'</i><span class="ui-elli">'+item.siteName+'</span></a></li>';
                            });
                            $('.m-rootweb-list').html(html);
                        },
                    });
                }

                $('#j-custom1,#j-customMore').toggleClass('active');
                $('#j-custom1,#j-customMore').addClass('m-anim');
                $('#j-custom-overlay1').toggleClass('active');
                $('#j-custom-overlay2,#j-custom2').removeClass('active');
                event.preventDefault();// 阻止默认行为
            });
        });
    </script>





    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
