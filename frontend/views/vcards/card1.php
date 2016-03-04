<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
    <title><?=$user['card_title']?></title>

    <link rel="stylesheet" type="text/css" href="http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.css">
    <?php $this->head()?>
<style type="text/css">
#mcover {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: none;
    z-index: 20000;
}
#mcover img {
    position: fixed;
    right: 18px;
    top: 5px;
    width: 260px;
    height: 180px;
    z-index: 999;
}

</style>
</head>

<body weiba-type="businesscard/home" class="weiba-businesscard weiba-tpl-default" weiba-noweb="true" weiba-title="<?=$user['card_title']?>" weiba-icon="http://5.s.bama555.com/5/201601/28/343b209c78781dab6c453848e317d995_160_160.jpg" weiba-link="http://qzsjz.bama555.com/business_card?id=36265&amp;from=singlemessage&amp;isappinstalled=0" weiba-desc="
<?= $user['unit'].''.$user['department'].''.$user['position'] ?>">

<?php $this->beginBody()?>

<div class="weiba-page" style="display: block;">
    <div class="weiba-content">
        <a class="top-company-href" href="#"><div class="top-company">
            <span class="top-company-text"><?=$user['unit']?></span>
            <!--span class="top-company-tip"></span-->
        </div>
        </a>
        <div class="card-top" style="height: 527.333px;">
            <a class="tpl-bc-url" href="">
                <img class="tpl-bc-bg" src="http://wx.shuhua.cn/frontend/web/Uploads/1/company/company_1456823957.jpg<?//=$user['bg_image']?>">
            </a>
        </div>
        <div class="card-view">
            <div class="card-title">
                <div class="card-toux">
                    <img class="tpl-bc-avatar" src="<?=$user['face_box'] ? $user['face_box'] : 'Uploads/default_face.jpg'?>">
                </div>
                <div class="card-ins">
                    <div class="card-name-box">
                        <span class="card-name tpl-bc-name"><?=$user['name']?></span>
                    </div>
                    <div class="card-name-box">
                        <span class="card-depart tpl-bc-depart">
                            <?=$user['department']?>
                        </span>
                        <span class="card-post tpl-bc-post">
                            <?=$user['position']?>
                        </span>
                    </div>
                    <div class="card-sign tpl-bc-sign">

                    </div>
                </div>
            </div>
            <div class="card-content">
                <a class="tpl-bc-map card-company" href="/"><div class="tpl-bc-company"> <?=$user['unit']?></div></a>
                <ul class="card-content-view page-bc-con-view">
                <li class="card-content-item">
                    <span class="card-content-item-tips m_mobile"></span>
                    <a href="tel:<?=$user['mobile']?>" class="blud-font"><?=$user['mobile']?></a>
                </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_tele"></span>
                        <a href="tel:<?=$user['work_tel']?>" class="blud-font"><?=$user['work_tel']?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_email"></span>
                        <a href="mailto:<?=$user['email']?>" class="blud-font"><?=$user['email']?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_weixin"></span>
                        <a class="blud-font"><?=$user['wechat_account']?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_QQ"></span>
                        <a class="blud-font"><?=$user['qq']?></a>
                    </li>
                    <li class="card-content-item">

                        <a href="http://api.map.baidu.com/marker?location=<?=$user['location']?>&title=<?=$user['unit']?>&content=<?=$user['unit']?>&output=html">
                        <span class="card-content-item-tips m_address"></span>
                       <?=$user['address']?>
                        </a>


                    </li>
                </ul>
            </div>
           <div class="f-cb card-btn">
                <div class="weiba-frame-share">
                    <a id="modal-646104" href="#modal-container-646104" role="button" class="but first-but tpl-to-mark" data-toggle="modal">
                        <span class="card-btn-tip card-btn-tongxunlu"></span><span class="card-btn-font">名片二维码</span>
                    </a>
                    <a href="http://www.shuhua.cn/" class="but">
                        <span class="card-btn-tip card-btn-index"></span><span class="card-btn-font">官方网站</span>
                    </a>
                </div>


                <div class="weiba-frame-share">
                    <div class="weiba-button-share friend" onclick="document.getElementById('mcover').style.display='block';">
                        <span class="card-btn-tip card-btn-haoyou"></span><span class="card-btn-font">发送给好友</span>
                    </div>
                    <div class="weiba-button-share quan" onclick="document.getElementById('mcover').style.display='block';">
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


<div id="mcover" onclick="document.getElementById('mcover').style.display='';" style="display: none;">
    <img src="images/guide1.png">
</div>





<div class="row">

            <div class=" modal fade" id="modal-container-646104" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">
                                微信扫一扫，秒存名片信息。
                            </h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            $urlval0=Url::to(['/vcards/index', 'id'=>$user['uid']], true);

                            $vcardsmpqr="BEGIN:VCARD%0AVERSION:3.0%0AN:". $user['name'] .'%0AORG:'. $user['unit'] .'%0AEMAIL:'.$user['email'].'%0ATITLE:'.$user['position'].'%0ATEL;TYPE=WORK:'.$user['work_tel'].'%0ATEL;type=CELL:'. $user['mobile'].'%0AURL:'.urlencode($urlval0)."%0AEND:VCARD";
                            ?>
                            <?=Html::img(genqr($vcardsmpqr), ['class'=>'text-center img-thumbnail', //'style'=>'max-width:50%'
                            ])?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button> <!--button type="button" class="btn btn-primary">保存</button-->
                        </div>
                    </div>

                </div>

            </div>

</div>

<?php $this->endBody()?>
</body>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</html>
<?php $this->endPage()?>
