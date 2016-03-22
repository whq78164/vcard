<?php

namespace frontend\modules\api\controllers;

use yii\web\Controller;
use Yii;
use frontend\tbhome\Update;
use \frontend\tbhome\FileTools;
use frontend\models\Cloud;
class UpdateController extends Controller
{
    public $enableCsrfValidation = false;//禁用CSRF

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCheckdiff(){
        ini_set("max_execution_time", "1800");

        $localFilesMd5=Update::filesMd5();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $clientFiles=$_POST;
            $diffMd5=\frontend\tbhome\ArrayTools::array_diff($localFilesMd5,$clientFiles);
            $diff=json_encode($diffMd5);
        }else{
            $diff=json_encode($localFilesMd5);
        }

       return $diff;

    }

    public function actionUpdatefiles(){
        $frontend=Yii::getAlias('@frontend');
        $updateZip=$frontend.'/runtime/'.date('Ymd_His',time()).'.zip';

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $version=$_POST['version'];
            $updateFiles=$_POST['files'];
            $zipFiles=[];

            $moduleDir=$_POST['type'];

            $ip=$_SERVER['REMOTE_ADDR'];

            if(isset($_SERVER["REMOTE_HOST"])){
                $serverName=$_SERVER["REMOTE_HOST"];
                $cloud=Cloud::findOne(['server_name'=>$serverName]);
            }else{
                $cloud=Cloud::findOne(['ip'=>$ip]);
            }


            if($moduleDir=='frontend'){
                $prifix=$frontend.'/';
                foreach($updateFiles as $value){
                    $zipFiles[]= $prifix.$value;
                }
                FileTools::createZipFromArr($updateZip, $zipFiles,$prifix);
            }

            if($moduleDir!=='frontend'){
                if($cloud){
                    $modulesJson=stripslashes($cloud->modules);
                    $moduleArr=json_decode($modulesJson, true);
                    $moduleArr=$moduleArr['modules'];
                    if(in_array($moduleDir,$moduleArr)){
                        $prifix=$frontend.'/modules/'.$moduleDir.'/';
                        foreach($updateFiles as $value){
                            $zipFiles[]= $prifix.$value;
                        }
                        FileTools::createZipFromArr($updateZip, $zipFiles,$prifix);
                    }
                }
            }



            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename="update.zip"');
            readfile($updateZip);
            unlink($updateZip);
            exit();


        }
    }

    public function actionCheckmodule(){
        ini_set("max_execution_time", "1800");

        if($_SERVER['REQUEST_METHOD']=='POST'){
        //    $serverName=isset($_SERVER["REMOTE_HOST"])?$_SERVER["REMOTE_HOST"]:'localhost';
            $clientFiles=$_POST['moduleFiles'];
            $moduleDir=$_POST['moduleDir'];

            $ip=$_SERVER['REMOTE_ADDR'];

            if(isset($_SERVER["REMOTE_HOST"])){
                $serverName=$_SERVER["REMOTE_HOST"];
                $cloud=Cloud::findOne(['server_name'=>$serverName]);
            }else{
                $cloud=Cloud::findOne(['ip'=>$ip]);
            }


    //        if($serverName=='localhost'){
    //            $diff=['error!'=>'未检测到您的域名或主机，不支持更新！'];
     //           $diff=json_encode($diff);
       //     }else{

                if(!$cloud){
                    $diff=['error!'=>'站点未注册，模块无法更新！'];
                    $diff=json_encode($diff);
                }else{



                    if(json_decode(stripslashes($cloud->modules), true)){
                     //   $modulesJson=stripslashes($cloud->modules);
                        $moduleArr=json_decode(stripslashes($cloud->modules), true);
                        $moduleArr=isset($moduleArr['modules'])?$moduleArr['modules']:'error!!!';
                    }else{
                        $moduleArr= 'error!!!';
                    };



                    if(in_array($moduleDir,$moduleArr)){
                        $localFilesMd5=Update::ModuleFilesMd5($moduleDir);
                        $diffMd5=\frontend\tbhome\ArrayTools::array_diff($localFilesMd5,$clientFiles);
                        $diff=json_encode($diffMd5);
                    }elseif($moduleArr=='error!!!'){
                        $diff=['error!'=>'模块未授权或不存在，请联系供应商提供升级!'];
                        $diff=json_encode($diff);
                    }else{
                        $diff=['error!'=>'模块未授权或不存在，请联系供应商提供升级!'];
                        $diff=json_encode($diff);
                    }



                }

        //    }



            return $diff;
        }


    }








}
