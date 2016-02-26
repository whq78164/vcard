	
		<!-- 左侧栏 -->
		

<!-- 侧栏已登陆 -->

<aside class="flexbox flex-vertical m-sidebox" id="j-m-aside" data-action="aside-menu2">
	
 <?php
 use frontend\models\Info;
 $loginuid=Yii::$app->user->id;
 $loginuser= Info::findOne($loginuid);
 ?>
	
		
			<div class="m-side-member">
<!--头像	-->
				<a href="<?=yii\helpers\Url::to(['user/index'], true)?>" class="m-facebox fixed">
					<div class="m-face iconfont">
					<img src="<?= $loginuser->face_box ? $loginuser->face_box : 'Uploads/default_face.jpg'?>" onerror="this.style.display='none'">
					</div>
				</a>
				
<!--通知				<a href="http://mp.soqi.cn/mpCompany/systemMsg.xhtml" class="iconfont i-msg"><!-- <i class="i-circle"></i> -></a>-->


<!--姓名-->				
          <a href="<?=yii\helpers\Url::to(['user/index'], true)?>">
		  <div class="m-name ui-elli">
		  <span style="color: #c5c9d2;">
		  	<?= $loginuser->unit ? $loginuser->unit : '单位名未填写' ?>
		  </span>
		  </div>
		  </a>
				
			</div>
			
			<div class="m-side-nav">
				<ul class="navgrounp">
					<li><a href="<?=yii\helpers\Url::to(['vcards/index', 'uid'=>Yii::$app->user->id], true)?>" target = "_blank"><i class="iconfont i-card"></i>我的名片</a></li>
<!--					
					<li><a href="http://mp.soqi.cn/mprs/contact.xhtml"><i class="iconfont i-tx"></i>名片通讯录</a></li>
-->					
					<li><a href="<?=yii\helpers\Url::to(['user/vcards'], true)?>"><i class="iconfont i-edit"></i>编辑名片</a></li>
<!--					
					<li><a href="http://mp.soqi.cn/mpPersonal/accSys.xhtml"><i class="iconfont i-wallet"></i>我的钱包</a></li>
					
					<li><a href="http://mp.soqi.cn/vd/tooneclickpay.xhtml"><i class="iconfont i-pay"></i>一键支付</a></li>
					
					<li><a href="http://mp.soqi.cn/vip/tominishopfunction.xhtml?type=1"><i class="iconfont i-shop"></i>我的V店</a></li>
					
					<li><a href="http://mp.soqi.cn/vip/findCPs.xhtml"><i class="iconfont i-wei"></i>微单页</a></li>
					
					<li><a href="http://mp.soqi.cn/vip/findMPMLs.xhtml"><i class="iconfont i-wlink"></i>微链接</a></li>
-->					
					<li>
					<!--a href="http://mp.soqi.cn/mpServiceServices/installUM.xhtml"-->
					<a href="<?=yii\helpers\Url::to(['user/setting'], true)?>">
					<i class="iconfont i-set"></i>设置</a>
					</li>
					
					<li>
					<a href="<?=yii\helpers\Url::to(['user/index'], true)?>">
					<i class="iconfont i-more"></i>更多</a></li>
					
					
				</ul>
			</div>
			
			<div class="m-side-ft">
				<!--
				<a href="" class="iconfont i-search">企业搜索</a>
				-->
				<a href="<?=yii\helpers\Url::to(['vcards/logout'], true)?>" class="iconfont i-out">退出</a>
			</div>

</aside>