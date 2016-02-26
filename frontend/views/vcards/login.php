<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>翻转式用户登录注册界面设计|DEMO_jQuery之家-自由分享jQuery、html5、css3的插件库</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel='stylesheet prefetch' href='http://fonts.useso.com/css?family=Open+Sans:600'>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!--[if IE]>
		<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="htmleaf-container">
		<!--header class="htmleaf-header">
			<h1>翻转式用户登录注册界面设计 <span></span></h1>
			<div class="htmleaf-links">
				<a class="htmleaf-icon icon-htmleaf-home-outline" href="http://www.htmleaf.com/" title="jQuery之家" target="_blank"><span> jQuery之家</span></a>
				<a class="htmleaf-icon icon-htmleaf-arrow-forward-outline" href="http://www.htmleaf.com/css3/ui-design/201508122403.html" title="返回下载页" target="_blank"><span> 返回下载页</span></a>
			</div>
		</header-->
		<div class="login-wrap">

			<div class="login-html">


				<div class="htmleaf-links" style="float:right;" ><!--text-align:left; / text-align:center; / text-align:right;-->
				<a class="htmleaf-icon icon-htmleaf-home-outline" href="<?=yii\helpers\Url::to(['vcards/index'], true)?>" title="首页" target="_blank"><!--span> 首页</span--></a>
				<a class="htmleaf-icon icon-htmleaf-arrow-forward-outline" href="<?=yii\helpers\Url::to(['vcards/index'], true)?>" title="返回" target="_blank"><!--span> 返回</span--></a>
			</div>

			<br/>

				<input id="tab-1" type="radio" name="tab" class="sign-in" <?= $checked1 ?>>
				<label for="tab-1" class="tab">登陆</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up" <?= $checked2 ?>>
				<label for="tab-2" class="tab">注册</label>


				<div class="login-form">


					<div class="sign-in-htm">

						<?php
						use yii\helpers\Html;
						use yii\widgets\ActiveForm;
						?>

						<!--form method="post" action="<?=yii\helpers\Url::to([''], true)?>"-->
						<?php
						$form = ActiveForm::begin([
							'action' => ['vcards/login'],
							'method'=>'post',
							//	'id' => 'login-form',
							//	'options' => ['class' => 'form-horizontal'],
							'fieldConfig' => [
								'labelOptions' => ['class' => 'col-lg-1 label'],
								'inputOptions' => ['class' => 'col-lg-1 input'],
							],

						]); ?>

						<div class="group">
							<?= $form->field($model, 'username',
								[
									'labelOptions' => [
									'label' => Yii::t('tbhome', 'username').':',
										'class' => 'label'],

									'inputOptions' => [
										'class' => 'input',
										'placeholder'=>"请填写手机号码登录",
									],

								])//->label() ?>
							<!--label for="user" class="label">用户名：</label>
							<input name = "username" id="user" type="text" class="input"-->
						</div>

						<div class="group">
							<?= $form->field($model, 'password')->passwordInput()->label('密码：') ?>
							<!--label for="pass" class="label">密码：</label>
							<input name="password" id="pass" type="password" class="input" data-type="password"-->
						</div>

						<!--div class="group">
						<?//= $form->field($model, 'rememberMe')->checkbox() ?>
							<input id="check" type="checkbox" class="check" checked>
							<label for="check"><span class="icon"></span> 保持登陆</label>
						</div-->



						<div class="group">
							<?= Html::submitButton('登陆', ['class' => 'button']) ?>
						</div>


						<div class="hr"></div>

						<div class="foot-lnk">
							<a href="">忘记密码?</a>
						</div>

					</div>

					<?php
					ActiveForm::end(); ?>
						<!--/form-->


					<div class="sign-up-htm">

						<div class="group">
							<label for="user" class="label">用户名：</label>
							<input id="user" type="text" class="input">
						</div>

						<div class="group">
							<label for="pass" class="label">密码：</label>
							<input id="pass" type="password" class="input" data-type="password">
						</div>

						<div class="group">
							<label for="pass" class="label">Repeat 密码</label>
							<input id="pass" type="password" class="input" data-type="password">
						</div>

						<div class="group">
							<label for="pass" class="label">Email ：</label>
							<input id="pass" type="text" class="input">
						</div>

						<div class="group">
							<input type="submit" class="button" value="注册">
						</div>

						<div class="hr"></div>

						<div class="foot-lnk">
							<label for="tab-1"><a>已有账号，请登录</a></label>
						</div>

					</div>

				</div>


			</div>

			
		</div>
	
</body>
</html>