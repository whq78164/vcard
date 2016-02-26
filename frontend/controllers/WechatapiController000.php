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
//use LaneWeChat\Core\ResponsePassive;

class WechatapiController extends Controller
{
    public $enableCsrfValidation = false;
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = file_get_contents("php://input");//$GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if (!empty($keyword)) {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "Input something...";
            }

        } else {
            echo "";
            exit;
        }
    }


    private function checkSignature()
    {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    public function actionApi($id = 1)
    {
        //多公众号使用方式
        $wechat = \Yii::createObject([
            'class' => 'tbhome\Wechat',
            'appId' => 'appid',
            'appSecret' => 'secret',
            'token' => 'shuhua201602'
        ]);
        /*
        //        $wechat=new Wechat();
                $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
                libxml_disable_entity_loader(true);
                // 将推送的XML消息解析为对象；
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();

                $articles = [
                 'title' => 'Happy Day',
                   'description' => 'Is Really A Happy Day',
                    'url' => 'URL',
                  'picurl' => 'PIC_URL'
                 ];
                $wechat->sendNews($fromUsername);

        */

    }

    public function actionTest()
    {
        $wechat = new Wechat();
        $username = $wechat->keyWord;

        $picUrl = 'http://6.s.bama555.com/6/201601/28/34864e43493c73b2e81353c679aaab89_640_360.jpg';
        $mpUrl = Url::to(['/vcards/index', 'uid' => $user['uid']], true);

        $newsList = array();
        $newsList[] = $wechat->newsItem([
            'title' => $user['name'] . ' 的微名片',
            'description' => '工号：' . $username . '
    姓名：' . $user['name'] . '
    ' . $info['department'] . ' ' . $info['position'],
            'picUrl' => $picUrl,
            'url' => $mpUrl
        ]);

        echo $wechat->replyNews([
            'item' => $newsList
        ]);



    }


}