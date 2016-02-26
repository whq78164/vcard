<?php
define('IA_ROOT', str_replace("\\",'/', dirname(__FILE__)));
if(file_exists(IA_ROOT . '/data/install.lock')) {
    header('Location:frontend/web/index.php');//判断程序是否安装，跳转
    exit;
}
if(!file_exists(dirname(__FILE__).'/data/install.lock'))
{
    header('Location:install.php');
    exit();
}

?>
