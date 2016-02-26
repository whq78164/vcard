<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$micropage->page_title?></title>
		<meta content="telephone=no" name="format-detection" />
	<meta content="email=no" name="format-detection" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href=" ">
	<!-- 新 Bootstrap 核心 CSS 文件 -->
<link href="http://apps.bdimg.com/libs/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<style type = "text/css">
    p img{max-width:100%;}
body{font-family:"微软雅黑,宋体"; line-height:1.5em; font-size: 18px; }
</style>

</head>
<body>
<ol class="breadcrumb">
  <li><a href="<?=yii\helpers\Url::to(['vcards/index', 'uid'=>$micropage->uid], true)?>">名片首页</a></li>

  <li class="active"><?=$micropage->page_title?></li>
</ol>
<div class="container">

<h3 class="text-center"><?=$micropage->page_title?></h3>
<hr/>
    <?=$micropage->page_content?>



</div>
<ul class="nav nav-tabs">
   <li class="active"><a href="<?=yii\helpers\Url::to(['vcards/index', 'uid'=>$micropage->uid], true)?>">返回首页</a></li>
   <!--li navbar-fixed-bottom ><a href="#">SVN</a></li>
   <li><a href="#">iOS</a></li-->
</ul>
</body>
</html>
<?php $this->endPage() ?>