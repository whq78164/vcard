<?php

namespace frontend\modules\api\controllers;

//require(__DIR__ . '/../../../assets/phpqrcode/qrlib.php');

//Yii::import('application.assets.phpqrcode.qrlib.php');
//$qrlibpath=Yii::getAlias('@app/assets/phpqrcode/qrlib.php');
//require($qrlibpath);

class QrcodeController extends \yii\web\Controller
{


    public function actionIndex()
    {
     //   QRcode::png($value,false,'M',6,1);
        return $this->render('index');

    }

}
