<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>用户注册</title>
	<link rel="stylesheet" type="text/css" href="http://fonts.useso.com/css?family=RobotoDraft:300,500">
	<link rel="stylesheet" type="text/css" href="assets/glogin/css/default.css">
	<link rel="stylesheet" type="text/css" href="assets/glogin/css/account.css" />
	<!--[if IE]>
		<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="htmleaf-container">
		<header class="htmleaf-header bgcolor-10">
			<h1>用户注册</h1>

		</header>

		<div class="login">


		
								<?php
			use yii\helpers\Html;
			use yii\widgets\ActiveForm;
			?>
		
		
		
		
			<div class="photo">
			
			</div>
	

	
	        <!--div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->label(Yii::t('tbhome', 'username')) ?>

                <?= $form->field($model, 'email')->label(Yii::t('tbhome', 'Email')) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div-->
	
	
	
			<span style="text-align:center;">注册账号：</span><!--style="font-size: 18px;"-->
			
			<!--form method="post" id="form-signup" action="<?=yii\helpers\Url::to(['vcards/signup'])?>" role="form"-->
			

			<?php
						$form = ActiveForm::begin([
							'action' => ['vcards/signup'],
							'method'=>'post',
								'id' => 'form-signup',
							//	'options' => ['class' => 'form-horizontal'],
						//	'fieldConfig' => [
						//		'labelOptions' => ['class' => 'col-lg-1 float-label'],
						//		'inputOptions' => ['class' => 'col-lg-1 input'],
						//	],

						]); 
			?>
			
		
				<!--input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>"-->



				<div id="u" class="form-group">
				  <input id="username" spellcheck=false class="form-control" name="SignupForm[username]" placeholder="" type="text" size="18" alt="Signup" required=""><!--name=SignupForm[username]-->
				  
				  				  <?/*= $form->field($model, 'username',
								[
									

									'inputOptions' => [
										'class' => 'form-control',
										'placeholder'=>"",
										'id'=>"username",
										'spellcheck'=> false,
										'size' => 18,
										'alt'=>"login",
										'required'=> '',
									],
									
									'labelOptions' => [
									'label' => Yii::t('tbhome', 'username').':',
									'class' => 'col-lg-1 float-label',
										],

								])*/?>
								
				  <span class="form-highlight"></span>
				  <span class="form-bar"></span>
				  <label for="username" class="float-label">账号：</label>
				  <erroru>
				  	请填写未被注册过的任意账号(昵称)！
				  	<i>		
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						    <path d="M0 0h24v24h-24z" fill="none"/>
						    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
						</svg>
				  	</i>
				  </erroru>
				</div>



				<div id="m" class="form-group">
				
					<!--input  id="mobile" class="form-control" spellcheck=false name="SignupForm[mobile]" size="18" type="text" alt="手机" required=""><!--id="signupform-mobile"-->
									  				  <?= $form->field($model, 'mobile',
								[
									

									'inputOptions' => [
										'class' => 'form-control',
										'placeholder'=>"",
										'id'=>"mobile",
										'spellcheck'=> false,
										'size' => 18,
										'alt'=>"login",
										'required'=> '',
									],
									
									'labelOptions' => [
									'label' => Yii::t('tbhome', 'Mobile').':',
									'class' => 'col-lg-1 float-label',
										],

								])?>
					<span class="form-highlight"></span>
					<span class="form-bar"></span>
					<!--label for="mobile" class="float-label">手机：</label-->
					<errorp>
						请输入您的手机号码！
						<i>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M0 0h24v24h-24z" fill="none"/>
								<path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
							</svg>
						</i>
					</errorp>
				</div>
				
				
				<div id="e" class="form-group">
					<!--input  id="email" class="form-control" spellcheck=false name="SignupForm[email]" size="18" type="text" alt="邮箱" required=""><!--SignupForm[password]-->
				
					
				  				  <?= $form->field($model, 'email',
								[


									'inputOptions' => [
										'class' => 'form-control',
										'placeholder'=>"",
										'id'=>"email",
										'spellcheck'=> false,
										'size' => 18,
										'alt'=>"login",
										'required'=> '',

									],
									
									'labelOptions' => [
									'label' => Yii::t('tbhome', '邮箱：').':',
									'class' => 'col-lg-1 float-label',
										],

								])//->label('电邮：')?>
								
					
					<span class="form-highlight"></span>
					<span class="form-bar"></span>
					<!--label for="email" class="float-label">邮箱：</label-->
					<errorp>
						请输入您的电子邮箱！
						<i>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M0 0h24v24h-24z" fill="none"/>
								<path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
							</svg>
						</i>
					</errorp>
				</div>



				<div id="p" class="form-group">
					  
				  <input id="password" class="form-control" spellcheck=false name="SignupForm[password]"  type="password" size="18" alt="密码" required=""><!--LoginForm[password]-->
				  <span class="form-highlight"></span>
				  <span class="form-bar"></span>
			<label for="password" class="float-label">密码：</label>
				  <errorp>
				  	请输入密码：
				  	<i>		
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						    <path d="M0 0h24v24h-24z" fill="none"/>
						    <path d="M1 21h22l-11-19-11 19zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
						</svg>
				  	</i>
				  </errorp>
				</div>


<!--style="float:left"-->
				<div class="form-group">
				<!--input type="checkbox" id="rem">
				<label for="rem">Stay Signed in</label-->
				<a href="<?=\yii\helpers\Url::to(['vcards/index'], true)?>">
				<span class="form-button" style="float:left"  ripple>返回</span>
				</a>
				<!--button name="signup-button" type="submit" ripple>注册</button-->
				
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            

				</div>
				
			<?php
					ActiveForm::end(); 
			?>
		
			
			
			<!--/form-->
		</div>

	</div>

	<script src='http://libs.useso.com/js/jquery/1.11.0/jquery.min.js'></script>
	<script>
	
	$(document).ready(function () {
	    $(function () {
	        var animationLibrary = 'animate';
	        $.easing.easeOutQuart = function (x, t, b, c, d) {
	            return -c * ((t = t / d - 1) * t * t * t - 1) + b;
	        };
	        $('[ripple]:not([disabled],.disabled)').on('mousedown', function (e) {
	            var button = $(this);
	            var touch = $('<touch><touch/>');
	            var size = button.outerWidth() * 1.8;
	            var complete = false;
	            $(document).on('mouseup', function () {
	                var a = { 'opacity': '0' };
	                if (complete === true) {
	                    size = size * 1.33;
	                    $.extend(a, {
	                        'height': size + 'px',
	                        'width': size + 'px',
	                        'margin-top': -size / 2 + 'px',
	                        'margin-left': -size / 2 + 'px'
	                    });
	                }
	                touch[animationLibrary](a, {
	                    duration: 500,
	                    complete: function () {
	                        touch.remove();
	                    },
	                    easing: 'swing'
	                });
	            });
	            touch.addClass('touch').css({
	                'position': 'absolute',
	                'top': e.pageY - button.offset().top + 'px',
	                'left': e.pageX - button.offset().left + 'px',
	                'width': '0',
	                'height': '0'
	            });
	            button.get(0).appendChild(touch.get(0));
	            touch[animationLibrary]({
	                'height': size + 'px',
	                'width': size + 'px',
	                'margin-top': -size / 2 + 'px',
	                'margin-left': -size / 2 + 'px'
	            }, {
	                queue: false,
	                duration: 500,
	                'easing': 'easeOutQuart',
	                'complete': function () {
	                    complete = true;
	                }
	            });
	        });
	    });
	    var username = $('#username'), email = $('#email'), mobile = $('#mobile'), password = $('#password'), erroru = $('erroru'), errorp = $('errorp'), submit = $('#submit'), udiv = $('#u'), pdiv = $('#p'), ediv = $('#e'), mdiv = $('#m');
	    username.blur(function () {
	        if (username.val() == '') {
	            udiv.attr('errr', '');
	        } else {
	            udiv.removeAttr('errr');
	        }
	    });
	    password.blur(function () {
	        if (password.val() == '') {
	            pdiv.attr('errr', '');
	        } else {
	            pdiv.removeAttr('errr');
	        }
	    });
			    email.blur(function () {
	      if (email.val() == '') {
	           ediv.attr('errr', '');
	       } else {
	           ediv.removeAttr('errr');
	        }
	    });
		
			    mobile.blur(function () {
	        if (mobile.val() == '') {
	            mdiv.attr('errr', '');
	        } else {
	            mdiv.removeAttr('errr');
	        }
	    });
		
	    submit.on('click', function (event) {
	        event.preventDefault();
	        if (username.val() == '') {
	            udiv.attr('errr', '');
	        } else {
	            udiv.removeAttr('errr');
	        }
	        if (password.val() == '') {
	            pdiv.attr('errr', '');
	        } else {
	            pdiv.removeAttr('errr');
	        }
	    });
	});
	
	</script>
</body>
</html>