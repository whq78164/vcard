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
class Card1Asset extends AssetBundle
{
 //   public $basePath = '@webroot';
 //   public $baseUrl = '@web';
    public $sourcePath = '@webroot/tbhome/card1';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        "css/weiba.ui.css",
        "css/tpl.css",
        "css/custom_tpl_css",
    ];
    public $js = [
       "js/jquery-2.0.3.min.js",
        "js/jquery.mobile.events.min.js",
        "js/pure.min.js",
        "js/weiba.js",
        "js/weiba.ui.js",
        "/assets/public/js/jDialog/jquery.drag.js",
        "/assets/public/js/jDialog/jquery.mask.js",
        "/assets/public/js/jDialog/jquery.dialog.js",
        "js/weiba.tpl.js",
        "js/index.js"
    ];
    /*
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    */
}
