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
class QRCardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        'css/base.css',
        'css/theme.css',
        'css/shareandshowtips.css',
        'css/amazeui.min.css',
//        'http://cdn.amazeui.org/amazeui/2.4.2/css/cssamazeui.min.css',
    ];
    public $js = [
       "js/zepto.min.js",
        "js/time_js.js",
 //       "js/zepto.min.js",
        "js/zepto.touch.min.js",
        "js/util.js",
        "js/shareandsavetips.js",
        "js/basic.js",
        "js/themes_common.js",

    ];
    /*
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    */
}
