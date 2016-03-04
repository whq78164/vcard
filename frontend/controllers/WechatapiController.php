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
//use frontend\models\Wechatgh;
//use LaneWeChat\Core\ResponsePassive;

class WechatapiController extends Controller
{
    public $enableCsrfValidation = false;



    public function actionApi($uid = 1)
    {
  //      $wechatgh=Wechatgh::findOne(['uid'=>$uid]);
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
            'title' => $company->company,
            'description' => $worker['name'].'    '. $department->department. ' ' . $worker['position'],
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




}