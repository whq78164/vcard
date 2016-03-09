<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    //public $css = [
//        'assets/amaze/css/amazeui.flat.min.css',
  //  ];
    public $js = [
        "http://api.map.baidu.com/api?v=1.5&ak=ULZzR8MYgQwHvkOeFTk0Or0l",
        'tbhome/map/locate.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',//jQuery,bootstrap.css,bootstrap.js
    ];

}
