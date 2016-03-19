<?php

namespace frontend\modules\api;

class apiModule extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\api\controllers';
//    public $layout = '123';
    public $defaultRoute='default';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
