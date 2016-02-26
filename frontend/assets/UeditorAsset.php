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
class UeditorAsset extends AssetBundle
{
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public function init()
    {
//        $this->sourcePath =$_SERVER['DOCUMENT_ROOT'].\Yii::getAlias('@web').'/assets/ueditor'; //设置资源所处的目录
        $this->sourcePath =\Yii::getAlias('@webroot').'/tbhome/ueditor';
    }

    public $js = [
        'ueditor.config.js',
        'ueditor.all.js',
    ];
    public $css = [
    ];

    
/*     
    public $js = [
        'assets/ueditor/ueditor.config.js',
        'assets/ueditor/ueditor.all.min.js',

    ];

   public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ]; */
}
