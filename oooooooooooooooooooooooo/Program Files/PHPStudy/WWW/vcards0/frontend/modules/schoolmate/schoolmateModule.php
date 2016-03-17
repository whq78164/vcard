<?php

namespace frontend\modules\schoolmate;

class schoolmateModule extends \yii\base\Module
{
    /*
     * 对于模块中的控制器，可配置模块的 yii\base\Module::layout 属性指定布局文件应用到模块的所有控制器。
     * */
 //   public $layout = '123';
    public $defaultRoute='schoolmate';
    public $controllerNamespace = 'frontend\modules\schoolmate\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
