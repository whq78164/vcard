<?php

namespace frontend\modules\api\controllers;

use yii\web\Controller;
use Yii;
use frontend\tbhome\Update;
use \frontend\tbhome\FileTools;
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

            if($_POST['type']=='frontend'){
                $prifix=$frontend.'/';
            }else{
                $prifix=$frontend.'/modules/'.$_POST['type'].'/';
            }

            foreach($updateFiles as $value){
                $zipFiles[]= $prifix.$value;
            }
           FileTools::createZipFromArr($updateZip, $zipFiles,$prifix);



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
            $clientFiles=$_POST['moduleFiles'];
            $moduleDir=$_POST['moduleDir'];

            if($moduleDir!=='api'){
                $localFilesMd5=Update::ModuleFilesMd5($moduleDir);
                $diffMd5=\frontend\tbhome\ArrayTools::array_diff($localFilesMd5,$clientFiles);
                $diff=json_encode($diffMd5);
            }else{
                $diff=['error!'=>'模块标识"api"已被注册，请更换!'];
                $diff=json_encode($diff);
            }

            return $diff;
        }


    }








}
