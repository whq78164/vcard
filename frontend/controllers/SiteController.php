<?php
namespace frontend\controllers;

use common\models\User;
use Faker\Provider\File;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;

use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use frontend\models\Usermodule;
//use yii\helpers\ArrayHelper;


/**
 * Site controller
 */
//define('LOGINUID', Yii::$app->user->id);

class SiteController extends Controller
{
    /**
     * @inheritdoc
     * http://www.yiichina.com/doc/guide/2.0/security-authorization
     */

    /*例如，如下代码使 post 控制器渲染视图时使用 @app/views/layouts/post.php 作为布局文件， 假如 layout 属性没改变，控制器默认使用 @app/views/layouts/main.php 作为布局文件。
    namespace app\controllers;

    use yii\web\Controller;

    class PostController extends Controller
    {
        public $layout = 'post';

        // ...
    }
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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                /*only 选项指定了当前 ACF 只应被应用在 login、logout 和 signup 这三个动作上。*/
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                        /*roles 选项包含的问号 ? 是一个特殊的标识，代表”访客用户”。*/
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                        /*允许已认证用户执行 logout 操作。@是另一个特殊标识， 代表”已认证用户”。*/
                    ],
                ],
            ],
            'verbs' => [//VerbFilter检查请求动作的HTTP请求方式是否允许执行，如果不允许，会抛出HTTP 405异常。
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionLanguage()
    {
        $language = \Yii::$app->request->get('lang');

        if (isset($language)) {
            \Yii::$app->session['language'] = $language;
        }
        $this->goBack(\Yii::$app->request->headers['Referer']);

        /*        if(isset($language)){
                $_SESSION['language']=$language;
            }
        */
        //切换完语言哪来的返回到哪里

    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDemo()
    {
        return $this->renderPartial('demo');
        // return $this->render('demo');
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                //     if (Yii::$app->params['adminEmail']) {
                //       Yii::$app->session->setFlash('success', Yii::t('tbhome', Yii::$app->params['adminEmail']));
                Yii::$app->session->setFlash('success', Yii::t('tbhome', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */


    function findLocation($ip = "114.114.114.114")
    {

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=" . $ip);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $location = curl_exec($curl);
        $location = json_decode($location);
        if (is_object($location)) {
            return $location->province . $location->city;
        } else {
            return '本地';
        }


        //
        //     return empty($location->desc) ? $location->province.$location->city.$location->district.$location->isp : $location->desc;


    }


    public function actionArea($ip = "114.114.114.114")
    {
        $area = $this->findLocation($ip);
        var_dump($area);

    }

    public function actionLogin()
    {

   //     if (!\Yii::$app->user->isGuest) {
     //       return $this->goHome();
       // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $lastIp = \Yii::$app->user->identity->updated_ip;
            $area = $this->findLocation($lastIp);
            \Yii::$app->session['area'] = $area;

            return $this->redirect(['user/index']);
        }elseif(!Yii::$app->user->isGuest){
            return $this->redirect(['/user/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();


        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $uid = Yii::$app->user->id;

                    $setting = new \frontend\models\Setting;
                    $info = new \frontend\models\Info;

                    $setting->uid = $uid;
                    $info->uid = $uid;
                    $setting->save();
                    $info->save();
                    //                   return $this->goHome();
                    //                    $this->redirect('@web/index.php?r=user/index');
                    $this->redirect(['user/index']);

                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);

    }

    public function actionLogout()
    {
        $uid = Yii::$app->user->id;
        $user = User::findOne($uid);
        //      $user->updated_at=time();
        $user->updated_ip = Yii::$app->request->userIP;
        $user->save();

        Yii::$app->session->destroy();

        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('tbhome', 'Check your email for further instructions.'));

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }





    public function actionQrcode($value = 'http://baidu.com')
    {
        //     require(__DIR__ . '/../../vendor/tbhome/phpqrcode/qrlib.php');
             header ("Content-type: image/png");
//        if(!isset($filename)){
  //          \QRcode::png($value,false,'M',8,1);
    //    }else{
      //      $filename=$_GET['filename'];
        //    \QRcode::png($value,$filename,'M',6,1);
          //  echo '<img src="'.$filename.'">';
 //       }
        $qrurl= genqrcode($value);
           echo '<img src="'.$qrurl.'">';

    }

    public function actionTest(){
        $frontend=\Yii::getAlias('@frontend');
        $excludeFrontend=[
            $frontend.'/web',
            $frontend.'/.idea',
            $frontend.'/config',
            $frontend.'/assets/phpqrcode',
            $frontend.'/runtime',
            $frontend.'/modules',
            $frontend.'/controllers/CloudController.php',
            $frontend.'/controllers/CloudtableController.php',
            $frontend.'/views/cloud',
            $frontend.'/views/cloudtable',
        ];
$dirs=\frontend\tbhome\FileTools::md5Files($frontend, $frontend, $frontend, $excludeFrontend);
$ziplist=array_flip($dirs);
        //print_r($ziplist);
        echo $frontend;
        \frontend\tbhome\FileTools::createZipFromArr($frontend.'/runtime/mmmhhhmm.zip', $ziplist,$frontend.'/');










        //basename()
   //     print_r($_SERVER['SERVER_ADDR']);
     //   print_r($_SERVER["HTTP_HOST"]);
       // print_r($_SERVER["SERVER_NAME"]);//域名为vcards.top 时输出www.vcards.top

  //$res=httpGet('http://www.vcards.top/index.php?r=cloud/index');
    //    $res=json_decode($res);
      //  print_r($res);



  /*     if(empty($dirs)){
           echo '全目录可写！';
       }else{
           foreach($dirs as $dir){echo $dir.'<br>';}
       }
*/
     //   $file=$rootDir.'/frontend/modules.zip';
   //   \frontend\tbhome\FileTools::readDir($zipDir);


    }










}
