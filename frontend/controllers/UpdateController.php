<?php

namespace frontend\controllers;
use Yii;
use yii\db\Schema;
use frontend\tbhome\DatabaseTool;
//use frontend\tbhome\Curl;
use frontend\tbhome\Update;
//$frontend=dirname(__DIR__);
class UpdateController extends DbController
{
    public $layout='user';

    public function init(){
        parent::init();
        if(Yii::$app->user->identity->role!==100){
            Yii::$app->session->setFlash('danger', '您不是管理员！');
            $this->redirect(['/user/index']);
        }
    }

    private function getVersion(){
        $table='sys';
        $sql="SELECT * FROM {{%$table}} WHERE id=1";
        $sys=Yii::$app->db->createCommand($sql)->queryOne();
        return $sys['version'];
    }

    public function actionIndex(){
        header('Content-Type:text/html;charset=UTF-8');
        ini_set("max_execution_time", "1800");
        $frontend=Yii::getAlias('@frontend');
        $table='sys';
        $sql="SELECT * FROM {{%$table}} WHERE id=1";
        $sys=Yii::$app->db->createCommand($sql)->queryOne();
        $version=$sys['version'];

        if(Yii::$app->request->isPost){


            if(!isset($sys['version'])){
                //        $this->renameColumn('{{%usermodule}}', 'module_satus', 'module_status');


                require $frontend.'/update.php';


            }elseif($sys['version']<1.0){//手动清除版本信息，重新升级


                require $frontend.'/update.php';

            }else{




                //$version=
                //   echo '您的系统已升级成功！版本：1.10，请勿重复升级！';

                $backFilename=$frontend.'/backup/'.date('Ymd_His',time());
                $updateZip=$frontend.'/runtime/'.date('Ymd_His',time());
                $updateFilesArr=Update::filesList();
                $update=$frontend.'/update/update_v'.strval($version).'.php';
             //   echo $update;


                if(!$updateFilesArr){
                    echo '恭喜！您的系统已是最新版本，无需升级！';
                }else{
                    Update::backupFiles($backFilename);
                    //     if($this->actionBackupdb()){  }
                    Update::downZip($updateZip.'.zip', $this->getVersion());

                    \frontend\tbhome\FileTools::extractZip($updateZip.'.zip', $frontend);
                    echo '<br/>升级文件成功！<br>';
                    foreach($updateFilesArr as $dir){echo '<br>'.$dir;}
                    unlink($updateZip.'.zip');

                    if(file_exists($update)){
                        echo '<br/>升级数据库<br/>';
                        require $update;
                    }


                }




            }

        }

        //   $this->update('{{%user}}', ['longitude'=>116.473259, 'latitude'=>39.86954], ['uid'=>1]);

    }



    public function actionBackupdb(){
        if(Yii::$app->request->isPost){
            $frontend=Yii::getAlias('@frontend');
            $backFilename=$frontend.'/backup/'.date('Ymd_His',time());

            $dsn=Yii::$app->db->dsn;
            $username=Yii::$app->db->username;
            $password=Yii::$app->db->password;
            $piecesDSN = explode(';', $dsn);//把字符串打散成数组，分割号：
            $host=explode('=', $piecesDSN[0]);
            $host=$host[1];
            $dbname=explode('=', $piecesDSN[1]);
            $dbname=$dbname[1];

            $sqlFile=$backFilename.'.sql';
            $config = array(
                'host' => $host,
                'port' => 3306,
                'user' => $username,
                'password' => $password,
                'database' => $dbname,
                'charset' => 'utf-8',
                'target' => $sqlFile//'sql.sql'//
            );

            $dbtool=new DatabaseTool($config);
            if($dbtool->backup()){
                return true;
            }
        }

    }



    public function actionClearv(){
        if(Yii::$app->request->isPost){
            $this->update('{{%sys}}', ['version'=>0.00], ['id'=>1]);
            echo '<br/>版本号已清除！请刷新查看！';
        }
    }

}
