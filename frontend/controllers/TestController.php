<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2015-10-28
 * Time: 20:05
 */

namespace frontend\controllers;
use tbhome\wechat\Wechat;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\tbhome\WechatJssdk;
//use LaneWeChat\Core\ResponsePassive;

class TestController extends Controller
{
    public $enableCsrfValidation = false;


    public function actionTest()
    {
     /*   $jssdk = new WechatJssdk();
        $jssdk->appId='wx557961bca7599ff3';
        $jssdk->appSecret='0c6128189fa40439a955a8c6f7c51710';
        $signPackage = $jssdk->GetSignPackage();
        print_r($signPackage);
*/
        $jssdk=new Wechat();
        $jssdk->appId='wx557961bca7599ff3';
        $jssdk->appSecret='0c6128189fa40439a955a8c6f7c51710';
        $jsconfig=$jssdk->jsApiConfig();
        print_r(json_encode($jsconfig));



        /**
         * 生成js 必要的config
         * 只需在视图文件输出JS代码:
         *  wx.config(<?= json_encode($wehcat->jsApiConfig()) ?>); // 默认全权限
         *  wx.config(<?= json_encode($wehcat->jsApiConfig([ // 只允许使用分享到朋友圈功能
         *      'jsApiList' => [
         *          'onMenuShareTimeline'
         *      ]
         *  ])) ?>);
         * @param array $config
         * @param bool $debug
         * @return array
         * @throws HttpException
         */



    }


}