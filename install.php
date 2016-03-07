<?php

error_reporting(E_ALL ^ E_NOTICE);
@set_time_limit(0);
@set_magic_quotes_runtime(0);
ob_start();
define('IA_ROOT', str_replace("\\",'/', dirname(__FILE__)));
//define('APP_URL', 'http://v2.addons.we7.cc/web/');
//define('APP_STORE', 'http://v2.addons.we7.cc/web/index.php?c=store&a=home&');
/*
if($_GET['res']) {
    $res = $_GET['res'];
    $reses = tpl_resources();
    if(array_key_exists($res, $reses)) {
        if($res == 'css') {
            header('content-type:text/css');
        } else {
            header('content-type:image/png');
        }
        echo base64_decode($reses[$res]);
        exit();
    }
}
*/
$actions = array('license', 'env', 'db', 'finish');
$action = $_COOKIE['action'];
$action = in_array($action, $actions) ? $action : 'license';
$ispost = strtolower($_SERVER['REQUEST_METHOD']) == 'post';

if(file_exists(IA_ROOT . '/data/install.lock') && $action != 'finish') {
    header('location: ./index.php');//判断程序是否安装，跳转
    exit;
}
header('content-type: text/html; charset=utf-8');

if($action == 'license') {
    if($ispost) {
        setcookie('action', 'env');
        header('location: ?refresh');
        exit;
    }
    tpl_install_license();
}

//echo IA_ROOT.'<br/>';
//echo IA_ROOT.'/../';

if($action == 'env') {
    if($ispost) {
        setcookie('action', $_POST['do'] == 'continue' ? 'db' : 'license');
        header('location: ?refresh');
        exit;
    }
    $ret = array();
    $ret['server']['os']['value'] = php_uname();
    if(PHP_SHLIB_SUFFIX == 'dll') {
        $ret['server']['os']['remark'] = '建议使用 Linux 系统以提升程序性能';
        $ret['server']['os']['class'] = 'warning';
    }
    $ret['server']['sapi']['value'] = $_SERVER['SERVER_SOFTWARE'];
    if(PHP_SAPI == 'isapi') {
        $ret['server']['sapi']['remark'] = '建议使用 Nginx 或 Apache 以提升程序性能';
        $ret['server']['sapi']['class'] = 'warning';
    }
    $ret['server']['php']['value'] = PHP_VERSION;
    $ret['server']['dir']['value'] = IA_ROOT;
    if(function_exists('disk_free_space')) {
        $ret['server']['disk']['value'] = floor(disk_free_space(IA_ROOT) / (1024*1024)).'M';
    } else {
        $ret['server']['disk']['value'] = 'unknow';
    }
    $ret['server']['upload']['value'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow';

    $ret['php']['version']['value'] = PHP_VERSION;
    $ret['php']['version']['class'] = 'success';
    if(version_compare(PHP_VERSION, '5.4.0') == -1) {//修改php满足5.4
        $ret['php']['version']['class'] = 'danger';
        $ret['php']['version']['failed'] = true;
        $ret['php']['version']['remark'] = 'PHP版本必须为 5.4.0 以上. <!--a href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58062">详情</a-->';
    }

    $ret['php']['mysql']['ok'] = function_exists('mysql_connect');
    if($ret['php']['mysql']['ok']) {
        $ret['php']['mysql']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
    } else {
        $ret['php']['mysql']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
    }

    $ret['php']['pdo']['ok'] = extension_loaded('pdo') && extension_loaded('pdo_mysql');
    if($ret['php']['pdo']['ok']) {
        $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['pdo']['class'] = 'success';
        if(!$ret['php']['mysql']['ok']) {
            $ret['php']['pdo']['remark'] = '您的PHP环境虽然不支持 mysql_connect, 但已经支持了PDO, 这样系统是可以正常高效运行的, 不需要额外处理. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58073">详情</a-->';
        }
    } else {
        if($ret['php']['mysql']['ok']) {
            $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-remove text-warning"></span>';
            $ret['php']['pdo']['class'] = 'warning';
            $ret['php']['pdo']['remark'] = '您的PHP环境不支持PDO, 但支持 mysql_connect, 这样系统虽然可以运行, 但还是建议你开启PDO以提升程序性能和系统稳定性. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58074">详情</a-->';
        } else {
            $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['pdo']['class'] = 'danger';
            $ret['php']['pdo']['remark'] = '您的PHP环境不支持PDO, 也不支持 mysql_connect, 系统无法正常运行. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58074">详情</a-->';
            $ret['php']['pdo']['failed'] = true;
        }
    }

    $ret['php']['fopen']['ok'] = @ini_get('allow_url_fopen') && function_exists('fsockopen');
    if($ret['php']['fopen']['ok']) {
        $ret['php']['fopen']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
    } else {
        $ret['php']['fopen']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
    }

    $ret['php']['curl']['ok'] = extension_loaded('curl') && function_exists('curl_init');
    if($ret['php']['curl']['ok']) {
        $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['curl']['class'] = 'success';
        if(!$ret['php']['fopen']['ok']) {
            $ret['php']['curl']['remark'] = '您的PHP环境虽然不支持 allow_url_fopen, 但已经支持了cURL, 这样系统是可以正常高效运行的, 不需要额外处理. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58076">详情</a-->';
        }
    } else {
        if($ret['php']['fopen']['ok']) {
            $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-remove text-warning"></span>';
            $ret['php']['curl']['class'] = 'warning';
            $ret['php']['curl']['remark'] = '您的PHP环境不支持cURL, 但支持 allow_url_fopen, 这样系统虽然可以运行, 但还是建议你开启cURL以提升程序性能和系统稳定性. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58086">详情</a-->';
        } else {
            $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['curl']['class'] = 'danger';
            $ret['php']['curl']['remark'] = '您的PHP环境不支持cURL, 也不支持 allow_url_fopen, 系统无法正常运行. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58086">详情</a-->';
            $ret['php']['curl']['failed'] = true;
        }
    }

    $ret['php']['ssl']['ok'] = extension_loaded('openssl');
    if($ret['php']['ssl']['ok']) {
        $ret['php']['ssl']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['ssl']['class'] = 'success';
    } else {
        $ret['php']['ssl']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['ssl']['class'] = 'danger';
        $ret['php']['ssl']['failed'] = true;
        $ret['php']['ssl']['remark'] = '没有启用OpenSSL, 将无法访问公众平台的接口, 系统无法正常运行. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58109">详情</a-->';
    }

    $ret['php']['gd']['ok'] = extension_loaded('gd');
    if($ret['php']['gd']['ok']) {
        $ret['php']['gd']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['gd']['class'] = 'success';
    } else {
        $ret['php']['gd']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['gd']['class'] = 'danger';
        $ret['php']['gd']['failed'] = true;
        $ret['php']['gd']['remark'] = '没有启用GD, 将无法正常上传和压缩图片, 系统无法正常运行. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58110">详情</a-->';
    }

    $ret['php']['dom']['ok'] = class_exists('DOMDocument');
    if($ret['php']['dom']['ok']) {
        $ret['php']['dom']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['dom']['class'] = 'success';
    } else {
        $ret['php']['dom']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['dom']['class'] = 'danger';
        $ret['php']['dom']['failed'] = true;
        $ret['php']['dom']['remark'] = '没有启用DOMDocument, 将无法正常安装使用模块, 系统无法正常运行. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58111">详情</a-->';
    }

    $ret['php']['session']['ok'] = ini_get('session.auto_start');
    if($ret['php']['session']['ok'] == 0 || strtolower($ret['php']['session']['ok']) == 'off') {
        $ret['php']['session']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['php']['session']['class'] = 'success';
    } else {
        $ret['php']['session']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['php']['session']['class'] = 'danger';
        $ret['php']['session']['failed'] = true;
        $ret['php']['session']['remark'] = '系统session.auto_start开启, 将无法正常注册会员, 系统无法正常运行. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58111">详情</a-->';
    }


    $ret['write']['root']['ok'] = local_writeable(IA_ROOT . '/');
    if($ret['write']['root']['ok']) {
        $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['write']['root']['class'] = 'success';
    } else {
        $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['write']['root']['class'] = 'danger';
        $ret['write']['root']['failed'] = true;
        $ret['write']['root']['remark'] = '本地目录无法写入, 将无法使用自动更新功能, 系统无法正常运行.  <!--a href="http://bbs.we7.cc/">详情</a-->';
    }

    $ret['write']['data']['ok'] = local_writeable(IA_ROOT . '/data');
    if($ret['write']['data']['ok']) {
        $ret['write']['data']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        $ret['write']['data']['class'] = 'success';
    } else {
        $ret['write']['data']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        $ret['write']['data']['class'] = 'danger';
        $ret['write']['data']['failed'] = true;
        $ret['write']['data']['remark'] = 'data目录无法写入, 将无法写入配置文件, 系统无法正常安装. ';
    }

    $ret['continue'] = true;
    foreach($ret['php'] as $opt) {
        if($opt['failed']) {
            $ret['continue'] = false;
            break;
        }
    }
    if($ret['write']['failed']) {
        $ret['continue'] = false;
    }
    tpl_install_env($ret);
}



if($action == 'db') {
    if($ispost) {

        if($_POST['do'] != 'continue') {
            setcookie('action', 'env');
            header('location: ?refresh');
            exit();
        }

        $db = $_POST['db'];
        $user = $_POST['user'];
        //$user['username']
        //$user['password']
        $pieces = explode(':', $db['server']);//把字符串打散成数组，分割号：
        $db['port'] = !empty($pieces[1]) ? $pieces[1] : '3306';
       // $link = mysqli_connect($db['server'], $db['username'], $db['password']);
        $link = @new mysqli($db['server'], $db['username'], $db['password'] //$db['name'], $db['port']
        );
       // $error=mysqli_connect_errno();
        $error=$link->connect_error;//不可用error属性！

        if($error) {
         //   $error = mysqli_error($link);
            if (strpos($error, 'Access denied for user') == 0) {//!==false
       //strpos(),返回值int,返回字符串在另一字符串中第一次出现的位置，如果没有找到字符串则返回 FALSE。
        //        var_dump($error);
                $error = '您数据库的访问用户名或密码错误. <br />';
            }else{$error = iconv('gbk', 'utf8', $error);}
        }

        if($error==null) {
        //    var_dump($error); $error=null,empty($error)==true



                $query = $link->query("SHOW DATABASES LIKE  '{$db['name']}';");
            $row1=$query->fetch_assoc();
                if (!$row1) {
                    if($link->server_info > '4.1') {
                        $link->query("CREATE DATABASE IF NOT EXISTS `{$db['name']}` DEFAULT CHARACTER SET utf8");
                    } else {
                        echo 'Mysql版本太低，请使用v5.0以上版本';
                        mysql_query("CREATE DATABASE IF NOT EXISTS `{$db['name']}`", $link);
                    }
                }
                $query = $link->query("SHOW DATABASES LIKE  '{$db['name']}';");
                if (!$query->fetch_assoc()) {
                    $error .= "数据库不存在且创建数据库失败. <br />";
                }
                if($link->connect_errno) {
                    $error .= $link->connect_errno;
                }



            // mysqli_select_db($link,$db['name']);
        //    $link->select_db($db['name']);
        //    $query1 = mysqli_query($link,"SHOW TABLES LIKE '{$db['prefix']}%';");

        //    if (mysqli_fetch_assoc($query1)) {
        //        $error = '您的数据库不为空，请重新建立数据库或是清空该数据库或更改表前缀！';
        //    }



            $config = local_config();
			$commonconfig=common_config();
      //      $cookiekey = make_password();
            //     $authkey = local_salt(8);
            $config = str_replace(
                array(
                '{db-server}', '{db-username}', '{db-password}', '{db-port}', '{db-name}', '{db-tablepre}'//, '{cookiekey}'
            ),
                array(
                $db['server'], $db['username'], $db['password'], $db['port'], $db['name'], $db['prefix']//, $cookiekey
            ),
                $config
            );
			
			$commonconfig=str_replace(
                array(
                '{db-server}', '{db-username}', '{db-password}', '{db-port}', '{db-name}', '{db-tablepre}'//, '{cookiekey}'
            ),
                array(
                $db['server'], $db['username'], $db['password'], $db['port'], $db['name'], $db['prefix']//, $cookiekey
            ),
                $commonconfig
            );
            //  local_mkdirs(IA_ROOT . '/data');
            file_put_contents(IA_ROOT . '/frontend/config/db.php', $config);
            file_put_contents(IA_ROOT . '/common/config/db.php', $config);//$commonconfig);



/*
            $link->query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary");
            $link->query("SET sql_mode=''");
            $link->query('set names "utf8"');
     //       $link->query('INSERT INTO tbhome_sys (admin_user, user_password) VALUES ('.$user['username'].',' .$user['password'].')');

            require("data/DBmanager.php");
            $DBmanager = new DBManager($db['server'], $db['username'], $db['password'],$db['name']);
            $DBmanager->executeFromFile("data/db.sql");
            $DBmanager->close();
    setcookie('action', 'finish');
    touch(IA_ROOT . '/data/install.lock');
    header('location: ?refresh');
    exit();
*/
            touch(IA_ROOT . '/data/install.lock');
            header('location: frontend/web/index.php?r=install/finish');

        }


        }



    tpl_install_db($error);
}

if($action == 'finish') {
 /*   setcookie('action', '', -10);
    $dbfile = IA_ROOT . '/data/db.php';
    @unlink($dbfile);
    define('IN_SYS', true);
    require IA_ROOT . '/framework/bootstrap.inc.php';
    require IA_ROOT . '/web/common/bootstrap.sys.inc.php';
    $_W['uid'] = $_W['isfounder'] = 1;
    load()->web('common');
    load()->web('template');
    load()->model('setting');
    load()->model('cache');

    cache_build_setting();
    cache_build_modules();
    cache_build_users_struct();
    */
   // setcookie('action', 'finish');
    setcookie('action', 'license');
  //  header('location: ?refresh');
    tpl_install_finish();
}

function tpl_frame() {
    //Yii::$app->session['mymodule'] = $modulemap;
    global $action, $actions;
    $action = $_COOKIE['action'];
    $step = array_search($action, $actions);
    //array_search() 函数在数组中搜索某个键值，并返回对应的键名。
    $steps = array();
    for($i = 0; $i <= $step; $i++) {
        if($i == $step) {
            $steps[$i] = ' list-group-item-info';
        } else {
            $steps[$i] = ' list-group-item-success';
        }
    }
    $progress = $step * 25 + 25;
    $content = ob_get_contents();
    ob_clean();
    $tpl = <<<EOF
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>安装系统 - 唯卡微名片 - 开源微商应用平台</title>
		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css">
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
						<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="{$progress}" aria-valuemin="0" aria-valuemax="100" style="width: {$progress}%;">
							{$progress}%
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							安装步骤
						</div>
						<ul class="list-group">
							<a href="javascript:;" class="list-group-item{$steps[0]}"><span class="glyphicon glyphicon-copyright-mark"></span> &nbsp; 许可协议</a>
							<a href="javascript:;" class="list-group-item{$steps[1]}"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; 环境监测</a>
							<a href="javascript:;" class="list-group-item{$steps[2]}"><span class="glyphicon glyphicon-cog"></span> &nbsp; 参数配置</a>
							<a href="javascript:;" class="list-group-item{$steps[3]}"><span class="glyphicon glyphicon-ok"></span> &nbsp; 成功</a>
						</ul>
					</div>
				</div>
				<div class="col-xs-9">
					{$content}
				</div>
			</div>
			<div class="footer" style="margin:15px auto;">
				<div class="text-center">
					<a href="http://www.vcards.top">关于我们</a> &nbsp; &nbsp; <!--a href="http://bbs.we7.cc">唯卡微名片帮助</a> &nbsp; &nbsp; <a href="http://www.we7.cc">购买授权</a-->
				</div>
				<div class="text-center">
					Powered by <a href="http://www.vcards.top"><b>唯卡微名片</b></a> v1.8 &copy; 2015 <a href="http://www.vcards.top">www.vcards.top</a>
				</div>
			</div>
		</div>
		<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>
EOF;
    echo trim($tpl);
}

function tpl_install_license() {
    echo <<<EOF
		<div class="panel panel-default">
			<div class="panel-heading">阅读许可协议</div>
			<div class="panel-body" style="overflow-y:scroll;max-height:400px;line-height:20px;">
				<h3>版权所有 (c)2015，唯卡团队保留所有权利。 </h3>
				<p>
					感谢您选择唯卡微名片 - 微商自助营销平台（基于 PHP + MySQL的技术开发，全部源码开放。 <br />
					为了使你正确并合法的使用本软件，请你在使用前务必阅读清楚下面的协议条款：
				</p>
				<p>
					<strong>一、本授权协议适用且仅适用于唯卡微名片系统(vcards. 以下简称唯卡)任何版本，唯卡官方对本授权协议的最终解释权。</strong>
				</p>
				<p>
					<strong>二、协议许可的权利 </strong>
					<ol>
						<li>您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途，而不必支付软件版权授权费用。</li>
						<li>您可以在协议规定的约束和限制范围内修改唯卡微名片源代码或界面风格以适应您的网站要求。</li>
						<li>您拥有使用本软件构建的网站全部内容所有权，并独立承担与这些内容的相关法律义务。</li>
						<li>获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。</li>
					</ol>
				</p>
				<p>
					<strong>三、协议规定的约束和限制 </strong>
					<ol>
						<li>未获商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目的或实现盈利的网站）。</li>
						<li>未经官方许可，不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。</li>
						<li>未经官方许可，禁止在唯卡微名片的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。</li>
						<li>如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。</li>
					</ol>
				</p>
				<p>
					<strong>四、有限担保和免责声明 </strong>
					<ol>
						<li>本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。</li>
						<li>用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。</li>
						<li>电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装  vcards，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</li>
						<li>如果本软件带有其它软件的整合API示范例子包，这些文件版权不属于本软件官方，并且这些文件是没经过授权发布的，请参考相关软件的使用许可合法的使用。</li>
					</ol>
				</p>
			</div>
		</div>
		<form class="form-inline" role="form" method="post">
			<ul class="pager">
				<li class="pull-left" style="display:block;padding:5px 10px 5px 0;">
					<div class="checkbox">
						<label>
							<input type="checkbox"> 我已经阅读并同意此协议
						</label>
					</div>
				</li>
				<li class="previous"><a href="javascript:;" onclick="if(jQuery(':checkbox:checked').length == 1){jQuery('form')[0].submit();}else{alert('您必须同意软件许可协议才能安装！')};">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
			</ul>
		</form>
EOF;
    tpl_frame();
}

function tpl_install_env($ret = array()) {
    if(empty($ret['continue'])) {
        $continue = '<li class="previous disabled"><a href="javascript:;">请先解决环境问题后继续</a></li>';
    } else {
        $continue = '<li class="previous"><a href="javascript:;" onclick="$(\'#do\').val(\'continue\');$(\'form\')[0].submit();">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>';
    }
    echo <<<EOF
		<div class="panel panel-default">
			<div class="panel-heading">服务器信息</div>
			<table class="table table-striped">
				<tr>
					<th style="width:150px;">参数</th>
					<th>值</th>
					<th></th>
				</tr>
				<tr class="{$ret['server']['os']['class']}">
					<td>服务器操作系统</td>
					<td>{$ret['server']['os']['value']}</td>
					<td>{$ret['server']['os']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['sapi']['class']}">
					<td>Web服务器环境</td>
					<td>{$ret['server']['sapi']['value']}</td>
					<td>{$ret['server']['sapi']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['php']['class']}">
					<td>PHP版本</td>
					<td>{$ret['server']['php']['value']}</td>
					<td>{$ret['server']['php']['remark']}</td>
				</tr>
				<!--tr class="{$ret['server']['dir']['class']}">
					<td>程序安装目录</td>
					<td>{$ret['server']['dir']['value']}</td>
					<td>{$ret['server']['dir']['remark']}</td>
				</tr-->
				<tr class="{$ret['server']['disk']['class']}">
					<td>磁盘空间</td>
					<td>{$ret['server']['disk']['value']}</td>
					<td>{$ret['server']['disk']['remark']}</td>
				</tr>
				<tr class="{$ret['server']['upload']['class']}">
					<td>上传限制</td>
					<td>{$ret['server']['upload']['value']}</td>
					<td>{$ret['server']['upload']['remark']}</td>
				</tr>
			</table>
		</div>

		<div class="alert alert-info">PHP环境要求必须满足下列所有条件，否则系统或系统部份功能将无法使用。</div>
		<div class="panel panel-default">
			<div class="panel-heading">PHP环境要求</div>
			<table class="table table-striped">
				<tr>
					<th style="width:150px;">选项</th>
					<th style="width:180px;">要求</th>
					<th style="width:50px;">状态</th>
					<th>说明及帮助</th>
				</tr>
				<tr class="{$ret['php']['version']['class']}">
					<td>PHP版本</td>
					<td>5.4或者5.4以上</td>
					<td>{$ret['php']['version']['value']}</td>
					<td>{$ret['php']['version']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['pdo']['class']}">
					<td>MySQL</td>
					<td>支持(建议支持PDO)</td>
					<td>{$ret['php']['mysql']['value']}</td>
					<td rowspan="2">{$ret['php']['pdo']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['pdo']['class']}">
					<td>PDO_MYSQL</td>
					<td>支持(强烈建议支持)</td>
					<td>{$ret['php']['pdo']['value']}</td>
				</tr>
				<tr class="{$ret['php']['curl']['class']}">
					<td>allow_url_fopen</td>
					<td>支持(建议支持cURL)</td>
					<td>{$ret['php']['fopen']['value']}</td>
					<td rowspan="2">{$ret['php']['curl']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['curl']['class']}">
					<td>cURL</td>
					<td>支持(强烈建议支持)</td>
					<td>{$ret['php']['curl']['value']}</td>
				</tr>
				<tr class="{$ret['php']['ssl']['class']}">
					<td>openSSL</td>
					<td>支持</td>
					<td>{$ret['php']['ssl']['value']}</td>
					<td>{$ret['php']['ssl']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['gd']['class']}">
					<td>GD2</td>
					<td>支持</td>
					<td>{$ret['php']['gd']['value']}</td>
					<td>{$ret['php']['gd']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['dom']['class']}">
					<td>DOM</td>
					<td>支持</td>
					<td>{$ret['php']['dom']['value']}</td>
					<td>{$ret['php']['dom']['remark']}</td>
				</tr>
				<tr class="{$ret['php']['session']['class']}">
					<td>session.auto_start</td>
					<td>关闭</td>
					<td>{$ret['php']['session']['value']}</td>
					<td>{$ret['php']['session']['remark']}</td>
				</tr>
			</table>
		</div>

		<div class="alert alert-info">系统要求唯卡微名片整个安装目录必须可写, 才能使用所有功能。</div>
		<div class="panel panel-default">
			<div class="panel-heading">目录权限监测</div>
			<table class="table table-striped">
				<tr>
					<th style="width:150px;">目录</th>
					<th style="width:180px;">要求</th>
					<th style="width:50px;">状态</th>
					<th>说明及帮助</th>
				</tr>
				<tr class="{$ret['write']['root']['class']}">
					<td>/</td>
					<td>整目录可写</td>
					<td>{$ret['write']['root']['value']}</td>
					<td>{$ret['write']['root']['remark']}</td>
				</tr>
				<tr class="{$ret['write']['data']['class']}">
					<td>/</td>
					<td>data目录可写</td>
					<td>{$ret['write']['data']['value']}</td>
					<td>{$ret['write']['data']['remark']}</td>
				</tr>
			</table>
		</div>
		<form class="form-inline" role="form" method="post">
			<input type="hidden" name="do" id="do" />
			<ul class="pager">
				<li class="previous"><a href="javascript:;" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
				{$continue}
			</ul>
		</form>
EOF;
    tpl_frame();
}

function tpl_install_db($error = '') {
    if(!empty($error)) {
        $message = '<div class="alert alert-danger">发生错误: ' . $error . '</div>';
    }
    echo <<<EOF
	{$message}
	<form class="form-horizontal" method="post" role="form">

		<div class="panel panel-default">
			<div class="panel-heading">数据库选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库主机</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[server]" value="127.0.0.1">
						<p>默认端口为3306，如需更改，请在主机名后加冒号。<br/>如127.0.0.1:3399或msqlrds.vcards.top:3399</p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库用户</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[username]" value="root">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">数据库密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[password]">
					</div>
				</div>

				<!--div class="form-group">
					<label class="col-sm-2 control-label">表前缀</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[prefix]" value="ims_">
					</div>
				</div-->

				<div class="form-group">
					<label class="col-sm-2 control-label">数据库名称</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="db[name]" value="vcards">
					</div>
				</div>
			</div>
		</div>

		<!--div class="panel panel-default">
			<div class="panel-heading">管理选项</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员账号</label>
					<div class="col-sm-4">
						<input class="form-control" type="username" name="user[username]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">管理员密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="password" name="user[password]">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">确认密码</label>
					<div class="col-sm-4">
						<input class="form-control" type="password"">
					</div>
				</div>
			</div>
		</div-->

		<input type="hidden" name="do" id="do" />
		<ul class="pager">
			<li class="previous"><a href="javascript:;" onclick="$('#do').val('back');$('form')[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
			<li class="previous"><a href="javascript:;" onclick="if(check(this)){jQuery('#do').val('continue');$('form')[0].submit();}">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
		</ul>

	</form>

	<script>
		var lock = false;
		function check(obj) {
			if(lock) {
				return;
			}
			$('.form-control').parent().parent().removeClass('has-error');
			var error = false;
			$('.form-control').each(function(){
				if($(this).val() == '') {
					$(this).parent().parent().addClass('has-error');
					this.focus();
					error = true;
				}
			});
/*			if(error) {
				alert('请检查未填项');
				return false;
			}
*/			if($(':password').eq(0).val() != $(':password').eq(1).val()) {
				$(':password').parent().parent().addClass('has-error');
				alert('确认密码不正确.');
				return false;
			}
			lock = true;
			$(obj).parent().addClass('disabled');
			$(obj).html('正在执行安装');
			return true;
		}
	</script>
EOF;
    tpl_frame();
}

function tpl_install_finish() {
 //   $modules = get_store_module(9);
 //   $themes = get_store_theme(5);
    echo <<<EOF
	<div class="page-header"><h3>安装完成</h3></div>
	<div class="alert alert-success">
		恭喜您!已成功安装“唯卡微名片 - 公众平台自助开源引擎”系统，您现在可以:
		<br><br><br><br>
		<p>
		
		<span>
<a target="_blank" class="pull-right btn btn-success" href="./admin/">访问系统后台</a>
        </span>
		
		<span>
		<a target="_blank" class="btn btn-success" href="./frontend/web/index.php">访问网站首页</a>
		</span>

</p>
	</div>
	
		<div class="alert alert-danger">
		<h1>注意！该内容只显示一遍。</h1>
		<br>
<p>
初始系统管理员登录名：admin
<br/>初始密码：adminadmin
<br/>请尽快修改默认设置或添加新系统管理员！！！
</p>

	</div>
	

	<!--div class="form-group">
		<h5><strong>微擎应用商城</strong></h5>
		<span class="help-block">应用商城特意为您推荐了一批优秀模块、主题，赶紧来安装几个吧！</span>
		<table class="table table-bordered">
			<tbody>
				{$modules}
				{$themes}
			</tbody>
		</table>
	</div>

	<div class="alert alert-warning">
		我们强烈建议您立即注册云服务，享受“在线更新”等云服务。
		<a target="_blank" class="btn btn-success" href="./web/index.php?c=cloud&a=profile">马上去注册</a>
		<a target="_blank" class="btn btn-success" href="http://v2.addons.we7.cc" target="_blank">访问应用商城首页</a>
	</div-->
EOF;
    tpl_frame();
}

function tpl_resources() {
    static $res = array(
        	'logo' => 'http://weixin.tbhome.com.cn/uploads/a/admin/5/6/9/a/thumb_55790313af011.png',
    );
    return $res;
}


function local_writeable($dir) {
    $writeable = 0;
    if(!is_dir($dir)) {
        @mkdir($dir, 0777);
    }
    if(is_dir($dir)) {
        if($fp = fopen("$dir/test.txt", 'w')) {
            fclose($fp);
            unlink("$dir/test.txt");
            $writeable = 1;
        } else {
            $writeable = 0;
        }
    }
    return $writeable;
}

function local_salt($length = 8) {
    $result = '';
    while(strlen($result) < $length) {
        $result .= sha1(uniqid('', true));
    }
    return substr($result, 0, $length);
}

//数据库配置文件
function local_config() {
    $cfg = <<<EOF
<?php

return [
            'class' => 'yii\db\Connection',
            'dsn'=>'mysql:host={db-server};dbname={db-name};port={db-port}',
            'username' => '{db-username}',
            'password' => '{db-password}',
            'charset' => 'utf8',
            'tablePrefix' => 'tbhome_',

];

EOF;
    return trim($cfg);
}

function common_config() {
    $cfg = <<<EOF
<?php
\$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn'=>'mysql:host={db-server};dbname={db-name};port={db-port}',
            'username' => '{db-username}',
            'password' => '{db-password}',
            'charset' => 'utf8',
            'tablePrefix' => 'tbhome_',
        ],
         'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],

    ],
];
return \$config;

EOF;
    return trim($cfg);
}

//上面是数据库配置文件内容。
function local_mkdirs($path) {
    if(!is_dir($path)) {
        local_mkdirs(dirname($path));
        mkdir($path);
    }
    return is_dir($path);
}

function local_run($sql) {
    global $link, $db;

    if(!isset($sql) || empty($sql)) return;

    $sql = str_replace("\r", "\n", str_replace(' ims_', ' '.$db['prefix'], $sql));
    $sql = str_replace("\r", "\n", str_replace(' `ims_', ' `'.$db['prefix'], $sql));
    $ret = array();
    $num = 0;
    foreach(explode(";\n", trim($sql)) as $query) {
        $ret[$num] = '';
        $queries = explode("\n", trim($query));
        foreach($queries as $query) {
            $ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
        }
        $num++;
    }
    unset($sql);
    foreach($ret as $query) {
        $query = trim($query);
        if($query) {
            if(!mysql_query($query, $link)) {
                echo mysql_errno() . ": " . mysql_error() . "<br />";
                exit($query);
            }
        }
    }
}

function local_create_sql($schema) {
    $pieces = explode('_', $schema['charset']);
    $charset = $pieces[0];
    $engine = $schema['engine'];
    $sql = "CREATE TABLE IF NOT EXISTS `{$schema['tablename']}` (\n";

    return $sql;
}

function showerror($errno, $message = '') {
    return array(
        'errno' => $errno,
        'error' => $message,
    );
}
/*
function get_store_module($number) {
    load()->func('communication');
    $response = ihttp_request(APP_STORE . 'type=module&category=&orderby=purchases&sc=desc');
    $content = $response['content'];
    preg_match('/<ul class="biz-module clearfix">[\s\S]+<\/ul>/i', $content, $match);
    $match = explode('</li>', $match[0]);
    $result = array();
    for ($length = 0; $length < $number; ++$length) {
        preg_match('/title=\"[\S]+\"/i', $match[$length], $title);
        $result[$length]['title'] = $title[0];
        preg_match('/<img[\s]+src=\"[\S]+\"/i', $match[$length], $image);
        $result[$length]['image'] = $image[0];
        preg_match('/<em>[\s\S]+<\/em>[\d]+/i', $match[$length], $purchases);
        $result[$length]['purchases'] = $purchases[0];
        preg_match('/href=\"[\S]+\"/i', $match[$length], $link);
        $result[$length]['link'] = $link[0];
    }

    $modules = '';
    foreach ($result as $key => $module) {
        if ($key % 3 < 1) {
            $modules .= '</tr><tr>';
        }
        $modules .= '<td>';
        $modules .= '<div class="col-sm-4">';
        $result[$key]['title'] = substr($result[$key]['title'], 7, -1);
        $result[$key]['link'] = substr($result[$key]['link'], strpos($result[$key]['link'], '.'));
        $result[$key]['link'] = '<a href="' . APP_URL . $result[$key]['link'] . '" target="_blank">';
        $modules .= $result[$key]['link'];
        $modules .= $result[$key]['image'] . ' width="50" height="50" ' . $result[$key]['title'] . '" /></a>';
        $modules .= '</div>';
        $modules .= '<div class="col-sm-8">';
        $result[$key]['purchases'] = str_replace('em', 'span', $result[$key]['purchases']);
        $result[$key]['purchases'] = str_replace('</span>', '<span class="text-danger">', $result[$key]['purchases']);
        $modules .= '<p>' . $result[$key]['link'] . $result[$key]['title'] . '</a></p>';
        $modules .= '<p>' . $result[$key]['purchases'] . '</span></p>';
        $modules .= '</div>';
        $modules .= '</td>';
    }
    $modules = substr($modules, 5) . '</tr>';

    return $modules;
}

function get_store_theme($number) {
    load()->func('communication');
    $response = ihttp_request(APP_STORE . 'type=template&category=&orderby=purchases&sc=desc');
    $content = $response['content'];
    preg_match_all('/<div class="items col-md-4 col-sm-4 col-xs-4 col-lg-3 clearfix">[\s\S]+<div class="items col-md-4 col-sm-4 col-xs-4 col-lg-3 clearfix">/', $content, $match);
    $match = explode('clearfix', $match[0][0]);
    $result = array();
    for ($length = 1; $length <= $number; ++$length) {
        preg_match('/title=\"[\S]+\"/', $match[$length], $title);
        $result[$length]['title'] = $title[0];
        preg_match('/<img[\s]+src=\"[\S]+\"/i', $match[$length], $image);
        $result[$length]['image'] = $image[0];
        preg_match('/<em>购买[\s\S]+<\/em>[\d]+/i', $match[$length], $purchases);
        $result[$length]['purchases'] = $purchases[0];
        preg_match('/href=\"[\S]+\"/i', $match[$length], $link);
        $result[$length]['link'] = $link[0];
    }

    $themes = '<tr><td colspan="' . $number . '">';
    $themes .= '<div class="form-group">';
    foreach ($result as $key => $theme) {
        $themes .= '<div class="col-sm-2" style="padding-left: 7px;margin-right: 25px;">';
        $result[$key]['link'] = substr($result[$key]['link'], strpos($result[$key]['link'], '.'));
        $result[$key]['link'] = '<a href="' . APP_URL . $result[$key]['link'] . '" target="_blank">';
        $themes .= $result[$key]['link'] . $result[$key]['image'] .  $result[$key]['title'] . ' target="_blank" /></a>';
        $result[$key]['title'] = substr($result[$key]['title'], 7, -1);
        $themes .= '<p></p><p class="text-right">' . $result[$key]['link'] . $result[$key]['title'] . '</a></p>';
        $themes .= '</div>';
    }
    $themes .= '</div>';

    return $themes;
}
*/

function make_password( $length = 15 )
{

// 密码字符集，可任意添加你需要的字符
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',
'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!',
'@','#', '$', '%', '^', '&', '*', '(', ')', '-', '_',
'[', ']', '{', '}', '<', '>', '~', '`', '+', '=', ',',
'.', ';', ':', '/', '?', '|');

// 在 $chars 中随机取 $length 个数组元素键名
$keys = array_rand($chars, $length);
$password = '';
for($i = 0; $i < $length; $i++)
{
// 将 $length 个数组元素连接成字符串
$password .= $chars[$keys[$i]];
}
return $password;
}