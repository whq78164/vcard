<?php

namespace frontend\controllers;
use frontend\models\Site;
use frontend\models\UserSearch;
use Yii;
use common\models\User;
use yii\web\NotFoundHttpException;
//use linslin\yii2\curl;
//use frontend\tbhome\ArrayTools;
use frontend\tbhome\Curl;
use frontend\tbhome\Update;
class AdminController extends \yii\web\Controller
{

    public $layout='admin';
    public $remoteMsg;
   // public $postSite='http://www.vcards.top/index.php?r=cloud/site';

    public function init(){
        parent :: init();

        $url=Yii::$app->params['updateApi'];
        $response=httpGet($url);
        $response=json_decode($response);//转码成对象数据；
        $this->remoteMsg=$response;

        if (Yii::$app->user->identity->role!==100) {
            Yii::$app->getSession()->setFlash('danger', '您不是管理员');
            return $this->goBack(['/site/login']);
        }

    }


    public function actionSite()
    {
        $url=Yii::$app->params['postSite'];
        $response=httpGet($url);
 //       $curl = new curl\Curl();
   //     $response = $curl->get($url);

        $response=json_decode($response);
        $modelRemote=$response;

        $model=Site::findOne(['id'=>1]);
if($model==null){
    $model = new Site();
}

        $model->sitetitle=$modelRemote->sitetitle;
        $model->company=$modelRemote->company;
        $model->tel= $modelRemote->tel;
        $model->qq=$modelRemote->qq;
        $model->email=$modelRemote->email;
        $model->siteurl=$modelRemote->siteurl;
        $model->copyright=$modelRemote->copyright;
        $model->icp=$modelRemote->icp;
        $model->ip=$modelRemote->ip;


        if (Yii::$app->request->post()) {

          //  $model = new Site();
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
              $curl = new Curl();
                $response=$curl->setOption(
                    CURLOPT_POSTFIELDS,
                    http_build_query([
                        'Site' => $_POST['Site'],
                        /*            'admin_user' => $model->admin_user,
                                    'user_password' => $model->user_password,
                                    'sitetitle' => $model->sitetitle,
                                    'tel' => $model->tel,
                                    'qq' => $model->qq,
                                    'email' => $model->email,
                                    'siteurl' => $model->siteurl,
                                    'copyright' => $model->copyright,
                                    'icp' => $model->icp,
                            */
                    ])
                )->post($url);
                $model->id=1;
                if($model->save()){
                    Yii::$app->getSession()->setFlash('success', $response);
                    return $this->goBack(['admin/index']);//redirect(['user/user']);
                };// form inputs are valid, do something here

            }
        }else{
            return $this->render('site', ['model' => $model,]);

        }



    }



    public function actionIndex()
    {

        $diffFiles=Update::filesList();

       // foreach($dirs as $key=>$value){echo $key.' => '.$value.'<br/>';}

            $response = $this->remoteMsg;
        $site=Site::findOne(['id'=>1]);

            return $this->render('index', [
                'model'=>$response,
                'site'=>$site,
                'diffFiles'=>$diffFiles,
            ]);

    }


    public function actionIndexuser()
    {

   //

            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('/user/indexuser', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);


    }

    public function actionView($id)
    {
        //   if (Yii::$app->user->identity->role!==100) {
        //       $this->goBack();
        //    }
        return $this->render('/user/view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['admin/indexuser']);
    }

    protected function findModel($uid)
    {
        if (($model = User::findOne($uid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionUpdate($id)
    {

        //$model = User::findIdentity($id);

        $model = new User();

        $request = Yii::$app->request;
        $model = $model->findIdentity($id);
        if ($request->isPost) {
            $password=$_POST['User']['password'];
            $model->load($request->post());
            if (strlen($password)>5){
                $password_hash = Yii::$app->security->generatePasswordHash($password);
                $model->password_hash=$password_hash;
            }else{
                Yii::$app->getSession()->setFlash('danger', '密码未修改');
            }
            //  var_dump($model);

            $model->save();
            $this->redirect(['admin/view', 'id' => $model->uid]);
            //     var_dump($password);
        } else {
            return $this->render('/user/update', [
                'model' => $model,
            ]);
        }
    }


    public function actionCreate()
    {

        //$model = User::findIdentity($id);

        $model = new User();

        $request = Yii::$app->request;
        if ($request->isPost) {

            $password=$_POST['User']['password'];

            $model->load($request->post());
            if (strlen($password)>5){
                $password_hash = Yii::$app->security->generatePasswordHash($password);
                $model->password_hash=$password_hash;
            }else{
                Yii::$app->getSession()->setFlash('danger', '密码长度不够');
            }
            //  var_dump($model);

            $model->save();
            $this->redirect(['admin/view', 'id' => $model->uid]);
            //     var_dump($password);
        } else {
            return $this->render('/user/create', [
                'model' => $model,
            ]);
        }
    }





}
