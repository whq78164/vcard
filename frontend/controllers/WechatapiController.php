<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2015-10-28
 * Time: 20:05
 */

namespace frontend\controllers;
use tbhome\wechat\Wechat;
//use tbhome\LaneWechat\ResponsePassive;
use yii\web\Controller;
use yii\helpers\Url;
use frontend\modules\company\models\Worker;
use frontend\modules\company\models\Department;
use frontend\modules\company\models\Company;
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

    public function actionApi($uid = 1)
    {
        $wechat = new Wechat();
        $jobid=$wechat->keyWord;
        $worker=Worker::findOne(['job_id'=>$jobid, 'uid'=>$uid])->attributes;
        $department=Department::findOne($worker['department_id']);//->attributes;
        $company=Company::findOne($worker['company_id']);//->attributes;

        $mpUrl = Url::to(['/company/worker/mp', 'id' => $worker['id']], true);
    //  $picUrl='http://vcards.top/'.$company->image;
        $picUrl=\Yii::$app->request->hostInfo.\Yii::$app->request->baseUrl.'/'.$company->image;

   //     $picUrl='http://6.s.bama555.com/6/201601/28/34864e43493c73b2e81353c679aaab89_640_360.jpg';

        $newsList = array();


        $newsList[] = $wechat->newsItem([
            'title' => $company->company.': '.$worker['name'],
            'description' => '
            工号: '. $worker['job_id'].'
            '. $department->department. ' ' . $worker['position'],
            'picUrl' => $picUrl,
            'url' => $mpUrl
        ]);

        echo $wechat->replyNews(['item' => $newsList]);

        /*      //多公众号使用方式
              $wechat = \Yii::createObject([
                  'class' => 'tbhome\Wechat',
                  'appId' => 'appid',
                  'appSecret' => 'secret',
                  'token' => 'shuh201602'
              ]);
*/

    }

    public function actionTest($keyword='456789')
    {
        $wechat = new Wechat();
       $jobid=$wechat->keyWord;
       $worker=Worker::findOne(['job_id'=>$jobid])->attributes;
      $department=Department::findOne($worker['department_id']);//->attributes;
      $company=Company::findOne($worker['company_id']);//->attributes;

/*
        $con = \Yii::$app->db;
        $sql = "SELECT * FROM {{%user}} WHERE username=:username";
        $command = $con->createCommand($sql);
        $command->bindParam(':username', $username);
        $user = $command->queryOne();

        $sql = "SELECT * FROM {{%card_info}} WHERE uid=:uid";
        $command = $con->createCommand($sql);
        $command->bindParam(':uid', $user['uid']);
        $info = $command->queryOne();
*/
 //       $face_box = $info['face_box'];
  //      $host=\Yii::$app->request->hostInfo;
 //       $picUrl = $host . '/' . $face_box;

       $mpUrl = Url::to(['/company/worker/mp', 'id' => $worker['id']], true);
        $picUrl='http://6.s.bama555.com/6/201601/28/34864e43493c73b2e81353c679aaab89_640_360.jpg';

        $newsList = array();
 //       $newsList[] = ResponsePassive::newsItem('title', 'miaosu', $picUrl, $mpUrl);
 //       $newss=ResponsePassive::news('from', 'to', $newsList);
 //       echo $newss;


      $newsList[] = $wechat->newsItem([
            'title' => $company->company.': '.$worker['name'],

            'description' => '工号: '. $worker['job_id'].'
            '. $department->department. ' ' . $worker['position'] ,/*'工号：' . $worker['job'] . '
    姓名：' . $worker['name'] . '
    ' . $department->department. ' ' . $worker['position'],*/

            'picUrl' => $picUrl,

            'url' => $mpUrl
        ]);


        echo $wechat->replyNews(['item' => $newsList]);



    }


}