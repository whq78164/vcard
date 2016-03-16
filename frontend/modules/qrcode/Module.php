<?php

namespace frontend\modules\qrcode;

class Module extends \yii\base\Module//类名必须和文件名一样，如qrcodeModule类，qrcodeModule.php
{
    public $controllerNamespace = 'frontend\modules\qrcode\controllers';
   // public $defaultRoute='qrcode';
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
