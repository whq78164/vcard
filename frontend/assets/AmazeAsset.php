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
class AmazeAsset extends AssetBundle
{
 //   public $basePath = '@webroot';
//    public $baseUrl = '@web';
	public $sourcePath='@webroot/tbhome/amazeui';
//    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
//        'assets/amaze/css/amazeui.flat.min.css',
        'css/amazeui.min.css',

        'css/admin.css',

//        'http://cdn.amazeui.org/amazeui/2.4.2/css/cssamazeui.min.css',
    ];
    public $js = [
    //    'assets/amaze/js/jquery.min.js',
'http://cdn.amazeui.org/amazeui/2.4.2/js/amazeui.min.js',
        'assets/amaze/js/app.js',
//'http://cdn.amazeui.org/amazeui/2.4.2/js/amazeui.ie8polyfill.min.js',

//'http://cdn.amazeui.org/amazeui/2.4.2/js/amazeui.widgets.helper.min.js',

    ];
    /*
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    */
}
