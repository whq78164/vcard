<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\Info;
//use frontend\models\SignupForm;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\AntiReply;
use frontend\models\AntiSetting;
use frontend\models\Setting;
use yii\web\UploadedFile;
use frontend\models\Upload;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public $layout='user';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
             //   'only' => ['logout', 'signup'],
 /*only 选项指定了当前 ACF 只应被应用在 login、logout 和 signup 这三个动作上。*/
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
 /*roles 选项 ? 是一个特殊的标识，代表”访客用户”。*/
                    ],
                    [
                     //   'actions' => ['index','update','logout',],
                        'allow' => true,
                        'roles' => ['@'],
    /*允许已认证用户执行 logout 操作。@是另一个特殊标识， 代表”已认证用户”。*/
                    ],
                ],
            ],
            'verbs' => [
  /*VerbFilter检查请求动作的HTTP请求方式是否允许执行，如果不允许，会抛出HTTP 405异常。*/
                'class' => VerbFilter::className(),
                'actions' => [
               //     'delete' => ['post'],
               //  'update' => ['get', 'put', 'post'],

                ],
            ],
        ];
    }

    public function actionUpload()
    {
        $face = new Upload();
        $uid = Yii::$app->user->id;

        $info = Info::findOne($uid);
        if ($info == null) {
            $info = new Info();
        }


        if (Yii::$app->request->isPost) {
            $face->imageFile = UploadedFile::getInstance($face, 'imageFile');//上传!
            $filename = 'face_' . time();
            $dir = 'Uploads/'.$uid.'/face/';
       //     if (!file_exists($dir)) mkdir($dir, true);//is_dir
            if ($face->upload($filename, $dir)) {//新建目录和文件信息保存！
                // 文件上传成功
                $url = $dir. $filename . '.' . $face->imageFile->extension;
                $info->uid = $uid;
                $info->face_box = $url;
                $info->save();
                Yii::$app->getSession()->setFlash('success', '上传成功！');
                return $this->redirect(['user']);
            } else {
                Yii::$app->getSession()->setFlash('danger', '上传失败！');
                return $this->redirect(['user']);
            }

        }
    }



    public function actionWechatqr()
    {
        $qrcode = new Upload();
        $uid = Yii::$app->user->id;

        $info = Info::findOne($uid);
        if ($info == null) {
            $info = new Info();
        }

        //上传文件。参数：表单对象模型，field表单域name.//返回一个文件对象。

        if (Yii::$app->request->isPost) {
            $qrcode->imageFile = UploadedFile::getInstance($qrcode, 'imageFile');//上传!
            $filename = 'wechatqr_' . time();
            $dir = 'Uploads/'.$uid.'/wechatqr/';
            //     if (!file_exists($dir)) mkdir($dir, true);//is_dir
            if ($qrcode->imageFile) {
                $qrcode->upload($filename, $dir);//新建目录和文件信息保存！
                // 文件上传成功
                $url = $dir. $filename . '.' . $qrcode->imageFile->extension;
                $info->uid = $uid;
                $info->wechat_qrcode = $url;
                if($info->save()){
                    Yii::$app->getSession()->setFlash('success', '上传成功！');
                    return $this->redirect(['user/user']);
                }else{
                    Yii::$app->getSession()->setFlash('danger', '保存失败！');
                    return $this->redirect(['user/info']);
                }

            } else {
                Yii::$app->getSession()->setFlash('danger', '上传失败！');
                return $this->redirect(['user']);
            }

        }


    }


    public function actionIndex()
       {
        //   return $this->redirect(['user/user']);
           $this->redirect(['/user/user']);
       }




    protected function saveform($model,$redirect,$render){
        $request1=Yii::$app->request;
        if($request1->isPost){
      //      $model->uid=$id;
            $model->load($request1->post());
            $model->save();//insert to
            //  Yii::$app->user->setFlash('success', '详细信息设置成功！');
            Yii::$app->getSession()->setFlash('success', '设置成功！');
            return $this->redirect($redirect);
        }else{
            return $this->render($render, [
                'model' => $model,
            ]);
        }
    }

    public function actionUser()
    {
        $uid=Yii::$app->user->id;
        $model = $this->findModel($uid);
        $face= new Upload();
        $qrcode = new Upload();
        // $info = Info::findOne($uid);
        $info = Info::findOne($uid);
        if ($info==null) {$info = new Info();}

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', '设置成功！');
            return $this->redirect(['user/user']);
        } else {

            return $this->render('user', [
                'model' => $model,
                'info' => $info,
                'face' => $face,
                'qrcode' =>$qrcode,
            ]);}
    }

    public function actionInfo()
    {
        $uid=Yii::$app->user->id;
        $info=Info::findOne($uid);
        $qrcode = new Upload();
        if ($info==null){$info=new Info();}
        $info->uid=$uid;
        $request=Yii::$app->request;
        if($request->isPost){


            $info->load($request->post());

            $info->save();//insert to
            //  Yii::$app->user->setFlash('success', '详细信息设置成功！');
            Yii::$app->getSession()->setFlash('success', '设置成功！');
            return $this->redirect(['user/user']);
        }else{
            return $this->render('info', [
                'info' => $info,
                'qrcode' =>$qrcode,
            ]);
        }

    }


    public function actionAnti()
    {
     //   $id=Yii::$app->user->id;
     //   $tmpmodel_setting=AntiSetting::findOne($id);
     //   $tmpmodel_reply=AntiReply::findOne(['uid'=>$id]);
        return $this->render('anti');
    }

    public function actionTraceability()
    {
        return $this->render('traceability');
    }

    public function actionVcards()
    {

        $uid=Yii::$app->user->id;
        $user = User::findOne($uid);
        $role=$user->role;

        return $this->render('vcards',[
            'role' =>$role
        ]);
    }

public function actionAntisetting()
{

    $uid=Yii::$app->user->id;
    $model=AntiSetting::findOne($uid);


    if ($model==null){
        $model = new AntiSetting();
        $model->uid=$uid;//必填！
    }

        $request=Yii::$app->request;
        if($request->isPost){
            $model->load($request->post());
            if (!$model->load($request->post())){
                die('赋值失败！');
            }
            $model->save();
            if (!$model->save()){
                die('保存失败！');
            }else{
            Yii::$app->getSession()->setFlash('success', '设置成功！');
            return $this->redirect(['antisetting']);}
        }else{
            return $this->render('_form_antisetting', [
                'model' => $model,
            ]);
        }

}

    public function actionAntireply()
    {

        $id=Yii::$app->user->id;
        $tempmodel=AntiReply::findOne(['uid'=>$id]);

        if ($tempmodel==null){
            $model = new AntiReply();
            $model->uid=$id;
            $request=Yii::$app->request;
            if($request->isPost){
                $model->load($request->post());
                if($model->save()){
                Yii::$app->getSession()->setFlash('success', '设置成功！');
                return $this->redirect(['anti']);
                }else{
                    Yii::$app->getSession()->setFlash('danger', '保存失败！');
                    return $this->redirect(['anti']);
                }
            }else{
                return $this->render('_form_antireply', [
                    'model' => $model,
                ]);
            }
        }

        if(isset($tempmodel)){
            $model=$tempmodel;
//        $model->uid=$id;
            $request=Yii::$app->request;
            if($request->isPost){
                $model->load($request->post());
                $model->save();//insert to
                Yii::$app->getSession()->setFlash('success', '设置成功！');
                return $this->redirect(['anti']);
            }else{
                return $this->render('_form_antireply', [
                    'model' => $model,
                ]);
            }

        }
    }



    public function actionSetting()
    {

 //       $model = $this->findModel($id);
        $model = Yii::$app->user->identity;
            return $this->render('setting', [
                'model' => $model,
            ]);
    }


    public function actionSpecialsetting()
    {
        $uid=Yii::$app->user->id;
        $model = Setting::findOne($uid);
        $user=User::findOne($uid);
        $image=new Upload();
        if ($model==null) {
            $model = new Setting();
        $model->uid=$uid;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();

                Yii::$app->getSession()->setFlash('success', '设置成功！');
               return $this->redirect(['specialsetting']);
                // form inputs are valid, do something here
             //   return;
            }
        }

        return $this->render('specialsetting', [
            'role'=>$user->role,
            'model' => $model,
            'image' => $image,
        ]);
    }

    public function actionPostbackground(){
        $bg_image=new Upload();
        $uid=Yii::$app->user->id;

        $bg_image->imageFile = UploadedFile::getInstance($bg_image, 'imageFile');
        if ($bg_image->imageFile){
            $filename='bg_'.$uid.'_'.time();
            $filepath='Uploads/bg_image/user_image/';
            if ($bg_image->upload($filename, $filepath)){
                $model=Setting::findOne($uid);
                if ($model==null){
                    $model=new Setting();
                    $model->uid=$uid;
                }
                $model->bg_image=$filepath.$filename.'.'.$bg_image->imageFile->extension;
                if ($model->save()){
                Yii::$app->getSession()->setFlash('success', '上传成功！');
                $this->redirect(['specialsetting']);
                }
            }
        }else{
            Yii::$app->getSession()->setFlash('danger', '上传失败！');
            $this->goBack(['user/specialsetting']);
        }



    }


    public function actionPassword()
    {

        $uid = Yii::$app->user->id;
        $model = new User();
        $model = $model->findIdentity($uid);

        //      $model = Yii::$app->user->identity;
        $request = Yii::$app->request;
        $post = $request->post();
        $password_hash = Yii::$app->security->generatePasswordHash($post['password']);

        if ($request->isPost) {
            //   var_dump($post);
            //   echo $model->validatePassword($post['oldpassword']);
            //   Yii::$app->security->validatePassword($password, $this->password_hash);

            if (!$model->validatePassword(trim($post['oldpassword']))) {
                Yii::$app->getSession()->setFlash('danger', '原密码输入错误！');
                return $this->redirect(['setting']);

            } elseif ($post['password'] !== $post['repassword']) {
                Yii::$app->getSession()->setFlash('danger', '两次输入的新密码不一致！');
                return $this->redirect(['setting']);
            } elseif($password_hash) {
                $model->password_hash=$password_hash;//$password_hash
                $model->save();

                Yii::$app->getSession()->setFlash('success', '密码设置成功！');
                return $this->redirect(['setting']);
            /*    return $this->render('setting', [
                    'model' => $model,
                    'passwordstatus' => '数据提交成功',
                ]);*/
            }else{
                echo '未知错误！';
                var_dump($post['password']);
                echo $post['password'];
                var_dump($model->setPassword($post['password']));
            }
        } else {
            echo '数据提交失败！';
        }

    }

    protected function findModel($uid)
    {
        if (($model = User::findOne($uid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}



/**
 * @inheritdoc
 * http://www.yiichina.com/doc/guide/2.0/security-authorization
 * http://www.yiichina.com/doc/guide/2.0/structure-filters
 */

/*
 * 存取控制过滤器（ACF）是一种通过 yii\filters\AccessControl 类来实现的简单授权方法， 非常适用于仅需要简单的存取控制的应用。正如其名称所指，ACF 是一个种行动（action）过滤器 filter，可在控制器或者模块中使用。当一个用户请求一个 action 时， ACF会检查 yii\filters\AccessControl::rules 列表，判断该用户是否允许执 行所请求的action。
 *
 *
 *
 * ACF 自顶向下逐一检查存取规则，直到找到一个与当前 欲执行的操作相符的规则。 然后该匹配规则中的 allow 选项的值用于判定该用户是否获得授权。如果没有找到匹配的规则， 意味着该用户没有获得授权。
 *
 * yii\filters\AccessRule::allow： 指定该规则是 "允许" 还是 "拒绝" 。（译者注：true是允许，false是拒绝）

yii\filters\AccessRule::actions：指定该规则用于匹配哪些操作。 如果该选项为空，或者不使用该选项， 意味着当前规则适用于所有的操作。

yii\filters\AccessRule::controllers：指定该规则用于匹配哪些控制器。 它的值应为控制器ID数组。匹配比较是大小写敏感的。如果该选项为空，或者不使用该选项， 则意味着当前规则适用于所有的操作。（译者注：这个选项一般是在控制器的自定义父类中使用才有意义）

yii\filters\AccessRule::roles：指定该规则用于匹配哪些用户角色。 系统自带两个特殊的角色，通过 yii\web\User::isGuest 来判断：

?： 用于匹配访客用户 （未经认证）
@： 用于匹配已认证用户
使用其他角色名时，将触发调用 yii\web\User::can()，这时要求 RBAC 的支持 （在下一节中阐述）。 如果该选项为空或者不使用该选项，意味着该规则适用于所有角色。
 * **/
