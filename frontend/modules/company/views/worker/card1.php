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
    <title><?=$worker['name'].'的微名片'?></title>
    <?php $this->head()?>
<style type="text/css">
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;right:18px;top:5px;z-index:19999;}
#guide img{width:260px;height:180px;}
</style>
</head>

<body weiba-type="businesscard/home" class="weiba-businesscard weiba-tpl-default" weiba-noweb="true" weiba-title="<?=$worker['name'].'的微名片'?>" weiba-icon="http://5.s.bama555.com/5/201601/28/343b209c78781dab6c453848e317d995_160_160.jpg" weiba-link="http://qzsjz.bama555.com/business_card?id=36265&amp;from=singlemessage&amp;isappinstalled=0" weiba-desc="
<?= $worker['company'].''.$worker['department'].''.$worker['position'] ?>">

<?php $this->beginBody()?>

<div class="weiba-page" style="display: block;">
    <div class="weiba-content">
        <a class="top-company-href" href="/"><div class="top-company">
            <span class="top-company-text"><?=$worker['company']?></span>
            <span class="top-company-tip"></span>
        </div>
        </a>
        <div class="card-top" style="height: 527.333px;">
            <a class="tpl-bc-url" href="<?=$worker['url']?>">
                <img class="tpl-bc-bg" src="<?=$worker['image']?>">
            </a>
        </div>
        <div class="card-view">
            <div class="card-title">
                <div class="card-toux">
                    <img class="tpl-bc-avatar" src="<?=$worker['head_img'] ? $worker['head_img'] : 'Uploads/default_face.jpg'?>">
                </div>
                <div class="card-ins">
                    <div class="card-name-box">
                        <span class="card-name tpl-bc-name"><?=$worker['name']?></span>
                    </div>
                    <div class="card-name-box">
                        <span class="card-depart tpl-bc-depart">
                            <?=$worker['department']?>
                        </span>
                        <span class="card-post tpl-bc-post">
                            <?=$worker['position']?>
                        </span>
                    </div>
                    <div class="card-sign tpl-bc-sign">

                    </div>
                </div>
            </div>
            <div class="card-content">
                <a class="tpl-bc-map card-company" href="/"><div class="tpl-bc-company"> <?=$worker['company']?></div></a>
                <ul class="card-content-view page-bc-con-view">
                <li class="card-content-item">
                    <span class="card-content-item-tips m_mobile"></span>
                    <a href="tel:<?=$worker['mobile']?>" class="blud-font"><?=$worker['mobile']?></a>
                </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_tele"></span>
                        <a href="tel:<?=$worker['work_tel']?>" class="blud-font"><?=$worker['work_tel']?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_email"></span>
                        <a href="mailto:<?=$worker['email']?>" class="blud-font"><?=$worker['email']?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_weixin"></span>
                        <a class="blud-font"><?=$worker['wechat_account']?></a>
                    </li>
                    <li class="card-content-item">
                        <span class="card-content-item-tips m_QQ"></span>
                        <a class="blud-font"><?=$worker['qq']?></a>
                    </li>
                    <li class="card-content-item">

                        <a href="http://api.map.baidu.com/marker?location=<?=$worker['location']?>&title=<?=$worker['company']?>&content=<?=$worker['company']?>&output=html">
                        <span class="card-content-item-tips m_address"></span>
                       <?=$worker['address']?>
                        </a>


                    </li>
                </ul>
            </div>
           <div class="f-cb card-btn">
                <div class="weiba-frame-share">
                    <a class="but first-but tpl-to-mark">
                        <span class="card-btn-tip card-btn-tongxunlu"></span><span class="card-btn-font">名片二维码</span>
                    </a>
                    <a href="http://www.shuhua.cn/" class="but">
                        <span class="card-btn-tip card-btn-index"></span><span class="card-btn-font">官方网站</span>
                    </a>
                </div>
                





                
                
                <div class="weiba-frame-share">
                    <div class="weiba-button-share friend" onclick="_system._guide(true)">
                        <span class="card-btn-tip card-btn-haoyou"></span><span class="card-btn-font">发送给好友</span>
                    </div>
                    <div class="weiba-button-share quan" onclick="_system._guide(true)">
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



<script type="text/javascript">

    var _system={

        $:function(id){return document.getElementById(id);},

   _client:function(){

      return {w:document.documentElement.scrollWidth,h:document.documentElement.scrollHeight,bw:document.documentElement.clientWidth,bh:document.documentElement.clientHeight};

   },

   _scroll:function(){

      return {x:document.documentElement.scrollLeft?document.documentElement.scrollLeft:document.body.scrollLeft,y:document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop};

   },

   _cover:function(show){

      if(show){

     this.$("cover").style.display="block";

     this.$("cover").style.width=(this._client().bw>this._client().w?this._client().bw:this._client().w)+"px";

     this.$("cover").style.height=(this._client().bh>this._client().h?this._client().bh:this._client().h)+"px";

  }else{

     this.$("cover").style.display="none";

  }

   },

   _guide:function(click){

      this._cover(true);

      this.$("guide").style.display="block";

      this.$("guide").style.top=(_system._scroll().y+5)+"px";

      window.onresize=function(){_system._cover(true);_system.$("guide").style.top=(_system._scroll().y+5)+"px";};

  if(click){_system.$("cover").onclick=function(){

         _system._cover();

         _system.$("guide").style.display="none";

 _system.$("cover").onclick=null;

 window.onresize=null;

  };}

   },

   _zero:function(n){

      return n<0?0:n;

   }

}

</script>

<div id="cover"></div>
<div id="guide"><img src="images/guide1.png"></div>


<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
