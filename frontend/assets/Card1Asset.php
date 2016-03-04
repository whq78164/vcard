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
       "css/custom_tpl_css.css",
      'font-awesome/css/font-awesome.min.css',
  //   'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
    ];
    public $js = [
       "js/jquery-2.0.3.min.js",
        "js/jquery.mobile.events.min.js",
        "js/pure.min.js",
        "js/weiba.js",
  //      "js/weiba.ui.js",
  //      "/assets/public/js/jDialog/jquery.drag.js",
    //    "/assets/public/js/jDialog/jquery.mask.js",
  //      "/assets/public/js/jDialog/jquery.dialog.js",
        "js/weiba.tpl.js",
        "js/index.js",
        'http://res.wx.qq.com/open/js/jweixin-1.0.0.js',
//请注意，如果你的页面启用了https，务必引入.否则将无法在iOS9.0以上系统中成功使用JSSDK
//'https://res.wx.qq.com/open/js/jweixin-1.0.0.js',
//如需使用摇一摇周边功能，请引入 jweixin-1.1.0.js

    ];
    /*
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    */
}
