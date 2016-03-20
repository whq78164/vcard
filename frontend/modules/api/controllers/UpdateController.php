<?php

namespace frontend\modules\api\controllers;

use yii\web\Controller;
use Yii;
use frontend\tbhome\Update;
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
            foreach($updateFiles as $value){
                $zipFiles[]= $frontend.'/'.$value;
            }

           \frontend\tbhome\FileTools::createZipFromArr($updateZip, $zipFiles,$frontend.'/');


/*
            $zip = new \ZipArchive();
                if ($zip->open($updateZip, \ZipArchive::CREATE) === TRUE) {
                    //必须为CREATE, OVERWRITE为覆盖，不可用。
                    foreach($updateFiles as $value){
                        $file=$frontend.'/'.$value;
                        $zip->addFile($file);
                    }
                    //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
                    $zip->close(); //关闭处理的zip文件
                }
*/
            //文件的类型
            header('Content-type: application/zip');
//下载显示的名字
            header('Content-Disposition: attachment; filename="update.zip"');
            readfile($updateZip);
            unlink($updateZip);
      //     \frontend\tbhome\FileTools::delDirAndFile($updateZip);

            exit();




        }
    }








}
