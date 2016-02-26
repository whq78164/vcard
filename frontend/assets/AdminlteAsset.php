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
class AdminlteAsset extends AssetBundle
{

//	public $sourcePath='@webroot/bower_components/AdminLTE';
    public $basePath = '@webroot/bower_components/AdminLTE';
    public $baseUrl = '@web/bower_components/AdminLTE';
//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
   //    'bootstrap/css/bootstrap.min.css',//Bootstrap 3.3.5
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
//        'font-awesome.min.css',
  //      'ionicons.min.css',
        'dist/css/AdminLTE.min.css',
        'dist/css/skins/_all-skins.min.css',

//        'http://cdn.amazeui.org/amazeui/2.4.2/css/cssamazeui.min.css',
    ];
    public $js = [
   //     'plugins/jQuery/jQuery-2.1.4.min.js',
  //      'bootstrap/js/bootstrap.min.js',//3.3.5
        'dist/js/app.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',//jQuery,bootstrap.css,bootstrap.js
    ];

}
