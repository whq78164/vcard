<?php
use yii\helpers\Html;
use frontend\assets\Card1Asset;
Card1Asset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--//tpl：businesscard-default-->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1">
    <meta name="format-detection" content="telephone=no"/>
    <title><?=$user02->card_title?></title>
    <?php $this->head()?>
    <!--link rel="stylesheet" type="text/css" href="css/weiba.ui.css"/>
    <link rel="stylesheet" type="text/css" href="css/tpl.css"/>
    <link rel="stylesheet" type="text/css" href="css/custom_tpl_css"/>
    <script type="text/javascript" src="js/jquery-2.0.3.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.mobile.events.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/pure.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/weiba.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/weiba.ui.js" charset="utf-8"></script>
    
    <script src="/assets/public/js/jDialog/jquery.drag.js" type="text/javascript"></script>
    <script src="/assets/public/js/jDialog/jquery.mask.js" type="text/javascript"></script>
    <script src="/assets/public/js/jDialog/jquery.dialog.js" type="text/javascript"></script>
    
    
    <script type="text/javascript" src="js/weiba.tpl.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/index.js" charset="utf-8"></script-->

</head>

<body weiba-type="businesscard/home" class="weiba-businesscard weiba-tpl-default" weiba-noweb="true" weiba-title="<?=$user02->card_title?>" weiba-icon="http://5.s.bama555.com/5/201601/28/343b209c78781dab6c453848e317d995_160_160.jpg" weiba-link="http://qzsjz.bama555.com/business_card?id=36265&amp;from=singlemessage&amp;isappinstalled=0" weiba-desc="舒华股份有限公司 品牌部 数字营销课 ">

<?php $this->beginBody()?>

<div class="weiba-page" style="display: block;">
    <div class="weiba-content">
        <a class="top-company-href" href="/"><div class="top-company">
            <span class="top-company-text"><?=$user02->unit?></span>
            <span class="top-company-tip"></span>
        </div>
        </a>
        <div class="card-top" style="height: 527.333px;">
            <a class="tpl-bc-url" href="https://mp.weixin.qq.com/s?__biz=MzAwODA1NzE5NQ==&amp;mid=209854755&amp;idx=1&amp;sn=8f3f3232d388f52704cc3be9cbf201ca&amp;scene=1&amp;srcid=0129k5UHrDLNsSTH8UdYriBk&amp;key=710a5d99946419d96eab5641c727bee302dd8d94c5fcca3ae55bb6f6cf047d9c014fa7647fe4d954affe5c0eaa03639b&amp;ascene=1&amp;">
                <img class="tpl-bc-bg" src="http://6.s.bama555.com/6/201601/28/34864e43493c73b2e81353c679aaab89_640_360.jpg">
            </a>
        </div>
        <div class="card-view">
            <div class="card-title">
                <div class="card-toux">
                    <img class="tpl-bc-avatar" src="<?=$user02->face_box?>">
                </div>
                <div class="card-ins">
                    <div class="card-name-box">
                        <span class="card-name tpl-bc-name"><?=$user01->name?></span>
                    </div>
                    <div class="card-name-box">
                        <span class="card-depart tpl-bc-depart">
                            <?=$user02->department?>
                        </span>
                        <span class="card-post tpl-bc-post">
                            <?=$user02->position?>
                        </span>
                    </div>
                    <div class="card-sign tpl-bc-sign">

                    </div>
                </div>
            </div>
            <div class="card-content">
                <a class="tpl-bc-map card-company" href="/"><div class="tpl-bc-company"> <?=$user02->unit?></div></a>
                <ul class="card-content-view page-bc-con-view">
                <li class="card-content-item">
                    <span class="card-content-item-tips m_mobile"></span>
                    <a href="tel:13788823901" class="blud-font"><?=$user01->mobile?></a>
                </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_tele"></span>
                        <a href="tel:<?=$user02->work_tel?>" class="blud-font"><?=$user02->work_tel?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_email"></span>
                        <a href="mailto:<?=$user01->email?>" class="blud-font"><?=$user01->email?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_weixin"></span>
                        <a class="blud-font"><?=$user02->wechat_account?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_QQ"></span>
                        <a class="blud-font"><?=$user01->qq?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_address"></span>
                        <?=$user02->address?>
                    </li>
                </ul>
            </div>
            <div class="f-cb card-btn">
                <div class="weiba-frame-share">
                    <a class="but first-but tpl-to-mark">
                        <span class="card-btn-tip card-btn-tongxunlu"></span><span class="card-btn-font">名片二维码</span>
                    </a>
                    <!--a href="/" class="but">
                        <span class="card-btn-tip card-btn-index"></span><span class="card-btn-font">企业微网站</span>
                    </a-->
                </div>
                <div class="weiba-frame-share">
                    <div class="weiba-button-share friend">
                        <span class="card-btn-tip card-btn-haoyou"></span><span class="card-btn-font">发送给好友</span>
                    </div>
                    <div class="weiba-button-share quan">
                        <span class="card-btn-tip card-btn-quan"></span><span class="card-btn-font">分享到朋友圈</span>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="bottom-box">
            <div class="bottom-top">微名片-微信时代您的新名片</div>
            <div class="bottom-bottom">
                &copy2013 <a class="weiba-name"></a>
            </div>
            <div class="bottom-bottom">
                技术支持 <a class="jishuzhichi blud-font"></a>
            </div>
        </div>-->
    </div>
</div>


<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
