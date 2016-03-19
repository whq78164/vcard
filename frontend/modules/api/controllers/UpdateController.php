<?php

namespace frontend\modules\api\controllers;

use yii\web\Controller;
use Yii;
class UpdateController extends Controller
{
    public $enableCsrfValidation = false;//禁用CSRF

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCheckdiff(){
        ini_set("max_execution_time", "1800");

        $frontend=Yii::getAlias('@frontend');
        $webDir=Yii::getAlias('@frontend/web');

        $exclude=[
            $webDir,
            $frontend.'/.idea',
            $frontend.'/config',
            $frontend.'/assets/phpqrcode',
            $frontend.'/runtime',
        ];

        $filesMd5=\frontend\tbhome\FileTools::md5Files($frontend,$frontend.'/','',$exclude);

    $clientFiles=$_POST;
     //   $diffMd5=\frontend\tbhome\ArrayTools::array_diff($filesMd5,$clientFiles);
        $diffMd5=array_diff($filesMd5,$clientFiles);

//print_r($filesMd5);
        foreach($diffMd5 as $key=>$value){echo $key.'<br/>';}
       // $diff=json_encode($filesMd5);
      // return $diff;



    }








}
