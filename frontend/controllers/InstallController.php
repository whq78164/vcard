<?php

namespace frontend\controllers;
use Yii;


class InstallController extends DbController
{
 //   public $frontend=Yii::getAlias('@frontend');
    public $layout='install';
    public $enableCsrfValidation = false;
  //  public $steps=array();


    public function init(){
        $frontend=Yii::getAlias('@frontend');

        if(file_exists($frontend . '/install.lock')) {
        //   header('location: ./index.php');//判断程序是否安装，跳转
            Yii::$app->getSession()->setFlash('danger', '请勿重复安装！');
            return    $this->redirect(['/site/login']);

        }
    }


    function tpl_frame() {

        Yii::$app->session['actions']=[0=>'license', 1=>'env', 2=>'db', 3=>'finish'];
        $actions = array('license', 'env', 'db', 'finish');
        //    $action = $_COOKIE['action'];
        Yii::$app->session['action'] = in_array(Yii::$app->session['action'], $actions) ? Yii::$app->session['action'] : 'license';
        //in_array() 函数搜索数组中是否存在指定的值。


        $action = Yii::$app->session['action'];
        $step = array_search($action, $actions);
        //array_search() 函数在数组中搜索某个键值，并返回对应的键名。
     //   Yii::$app->session['steps'] = array();
        $_COOKIE['steps']=array();
        for($i = 0; $i <= $step; $i++) {
            if($i == $step) {
                $_COOKIE['steps'][$i] = ' list-group-item-info';
            } else {
                $_COOKIE['steps'][$i] = ' list-group-item-success';
            }
        }
        Yii::$app->session['progress']=$step * 25 + 25;;

    }


    public function actionLicense(){
        if(Yii::$app->getRequest()->isPost){
         //   Yii::$app->session['action']='env';
         //   $this->tpl_frame();
            return $this->redirect(['/install/env']);
        }
        return  $this->render('license',[
            'progress'=>25
        ]);
    }


    public function actionEnv(){
        $frontend=Yii::getAlias('@frontend');
      //  $common=Yii::getAlias('@common');
        if(Yii::$app->getRequest()->isPost){
            Yii::$app->session['action']='db';
            $this->tpl_frame();
            return $this->redirect(['/install/db']);
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
        $ret['server']['dir']['value'] = $frontend;
        if(function_exists('disk_free_space')) {
            $ret['server']['disk']['value'] = floor(disk_free_space($frontend) / (1024*1024)).'M';
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



        $ret['php']['fileinfo']['ok'] = extension_loaded('fileinfo');
        if($ret['php']['fileinfo']['ok']) {
            $ret['php']['fileinfo']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['fileinfo']['class'] = 'success';
        } else {
            $ret['php']['fileinfo']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['fileinfo']['class'] = 'danger';
            $ret['php']['fileinfo']['failed'] = true;
            $ret['php']['fileinfo']['remark'] = '没有启用fileinfo, 不能识别上传文件类型, 无法上传头像. <!--a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58109">详情</a-->';
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


        $ret['write']['root']['ok'] = $this->local_writeable($frontend . '/');
        if($ret['write']['root']['ok']) {
            $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['write']['root']['class'] = 'success';
        } else {
            $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['write']['root']['class'] = 'danger';
            $ret['write']['root']['failed'] = true;
            $ret['write']['root']['remark'] = '本地目录无法写入, 将无法使用自动更新功能, 系统无法正常运行.  <!--a href="http://bbs.we7.cc/">详情</a-->';
        }

        $ret['write']['data']['ok'] = $this->local_writeable($frontend . '/data');
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
            if(isset($opt['failed'])) {
                $ret['continue'] = false;
                break;
            }
        }
        if(isset($ret['write']['failed'])) {
            $ret['continue'] = false;
        }

        return  $this->render('env',[
            'progress'=>50,
            'ret'=>$ret
        ]);
    }


   public function actionDb(){
        $frontend=Yii::getAlias('@frontend');
        $common=Yii::getAlias('@common');

        if(Yii::$app->getRequest()->isPost){
            Yii::$app->session['action']='finish';
            $this->tpl_frame();

            if($_POST['do'] != 'continue') {
                Yii::$app->session['action']='env';
                return $this->redirect(['/install/env']);

            }

            $db = $_POST['db'];
        //    $user = $_POST['user'];
            $pieces = explode(':', $db['server']);//把字符串打散成数组，分割号：
            $db['port'] = !empty($pieces[1]) ? $pieces[1] : '3306';
            // $link = mysqli_connect($db['server'], $db['username'], $db['password']);
            $link = @new \mysqli($db['server'], $db['username'], $db['password'] //$db['name'], $db['port']
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



                $config = $this->local_config();

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

                file_put_contents($frontend . '/config/db.php', $config);
                file_put_contents($common . '/config/db.php', $config);



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
                Yii::$app->session['action']='finish';
                $this->tpl_frame();
                return $this->redirect(['/install/finish']);

            }

        }
        $error=isset($error)?$error:null;
        $message=isset($message)?$message:'';
        return  $this->render('db',[
            'error'=>$error,
            'message'=>$message,
            'progress'=>75,
        ]);
    }


    public function actionFinish()
    {
        $frontend=Yii::getAlias('@frontend');

        if(file_exists($frontend . '/tbhome/install.lock')) {
            //   header('location: ./index.php');//判断程序是否安装，跳转
            Yii::$app->getSession()->setFlash('danger', '请勿重复安装！');
        return    $this->redirect(['/site/login']);
          //  exit;
        }else{
            return  $this->render('finish',[
                'progress'=>100,
            ]);
        }


    }


    public function actionIndex()
    {
    //   echo '<br/>'.Yii::getAlias('@frontend').'</br>';
        Yii::$app->session['action']='license';
        $this->tpl_frame();
     return  $this->redirect(['license']);

    }

    public function actionInstall(){
        $frontend=Yii::getAlias('@frontend');
        if(file_exists($frontend . '/install.lock')) {
            //   header('location: ./index.php');//判断程序是否安装，跳转
            Yii::$app->getSession()->setFlash('danger', '请勿重复安装！');
            return    $this->redirect(['/site/login']);
        }else{
            require 'installall.php';

            echo '</br></br>恭喜您!已成功安装“微名片&二维码管理系统”，您现在可以: ';
            touch($frontend . '/install.lock');
        }

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
            'tablePrefix' => '{db-tablepre}',

];

EOF;
        return trim($cfg);
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













}
