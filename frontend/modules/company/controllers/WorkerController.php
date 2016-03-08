<?php

namespace frontend\modules\company\controllers;

use Yii;
use frontend\modules\company\models\Worker;
use frontend\modules\company\models\WorkerSearch;
use frontend\modules\company\models\Department;
use frontend\modules\company\models\Company;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\models\Upload;
use yii\web\UploadedFile;
use frontend\models\Wechatgh;
use tbhome\wechat\Wechat;

/**
 * WorkerController implements the CRUD actions for Worker model.
 */
class WorkerController extends Controller
{
    public $layout='@frontend/views/layouts/user';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function init(){
        parent::init();

    }

    /**
     * Lists all Worker models.
     * @return mixed
     */
    public function actionIndex()
    {
        $uid=Yii::$app->user->id;

      //  $listCompanys=array();
        $companys=Company::find()->where(['uid'=>$uid])->all();
        $listCompanys=ArrayHelper::map($companys, 'id', 'company');
        $listCompanys['']='全部';



    //    $listDepartments=array();
        $departments=Department::find()->where(['uid'=>$uid])->all();
        $listDepartments=ArrayHelper::map($departments, 'id', 'department');
        $listDepartments['']='全部';



        $searchModel = new WorkerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listCompanys'=>$listCompanys,
            'listDepartments'=>$listDepartments
        ]);
    }

    /**
     * Displays a single Worker model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Worker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $uid=Yii::$app->user->id;

        $companys=Company::find()->where(['uid'=>$uid])->all();
        $listCompanys=ArrayHelper::map($companys, 'id', 'company');

        $departments=Department::find()->where(['uid'=>$uid])->all();
        $listDepartments=ArrayHelper::map($departments, 'id', 'department');

        $model = new Worker();

        if ($model->load(Yii::$app->request->post())) {
            $model->uid=$uid;


            if($model->save()){
                Yii::$app->getSession()->setFlash('success', '职员信息创建成功，请上传图片！');
                return $this->redirect(['update', 'id' => $model->id]);
            }else{
                Yii::$app->getSession()->setFlash('success', '创建失败，请稍后重试！');
                return $this->refresh();
            }



        } else {
            return $this->render('create', [
                'model' => $model,
                'listCompanys'=>$listCompanys,
                'listDepartments'=>$listDepartments
            ]);
        }
    }

    /**
     * Updates an existing Worker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $uid=Yii::$app->user->id;

        $worker_img = new Upload();

        $companys=Company::find()->where(['uid'=>$uid])->all();
        $listCompanys=ArrayHelper::map($companys, 'id', 'company');

        $departments=Department::find()->where(['uid'=>$uid])->all();
        $listDepartments=ArrayHelper::map($departments, 'id', 'department');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->uid=$uid;

            if($model->save()){
                Yii::$app->getSession()->setFlash('success', '职员信息修改成功！');
                return $this->refresh();
            //    return $this->redirect(['update', 'id' => $model->id]);
            }else{
                Yii::$app->getSession()->setFlash('danger', '保存失败，请稍后重试！');
                return $this->refresh();
            }


        } else {
            return $this->render('update', [
                'model' => $model,
                'listCompanys'=>$listCompanys,
                'listDepartments'=>$listDepartments,
                'head_img'=>$worker_img,
            ]);
        }
    }

    /**
     * Deletes an existing Worker model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Worker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Worker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
   //     if (($model = Worker::findOne(['job_id'=>$jobid])) !== null) {
        if (($model = Worker::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionUploadheadimg($id)
    {
        $worker_img = new Upload();
        $uid = Yii::$app->user->id;
        if (Yii::$app->request->isPost) {
            $worker_img->imageFile = UploadedFile::getInstance($worker_img, 'imageFile');//上传!
            $filename = 'worker_img' . time();
            $dir = 'Uploads/'.$uid.'/company/workers/';
            //     if (!file_exists($dir)) mkdir($dir, true);//is_dir
            if ($worker_img->upload($filename, $dir)) {//新建目录和文件信息保存！
                // 文件上传成功
                $url = $dir. $filename . '.' . $worker_img->imageFile->extension;

                $model=$this->findModel($id);
                $model->uid = $uid;
                $model->head_img = $url;

                if($model->save()){
                    Yii::$app->getSession()->setFlash('success', '图片上传成功！');
                    return $this->redirect(['update', 'id'=>$model->id]);
                }else{
                    Yii::$app->getSession()->setFlash('danger', '保存失败，请稍后重试！');
                //    return $this->redirect(['update']);
                    return $this->refresh();
                }



            } else {
                Yii::$app->getSession()->setFlash('danger', '上传失败，请稍后重试！');
                return $this->redirect(['update']);
            }

        }
    }



    public function actionMp($id=1)
    {


        $wechatgh=Wechatgh::findOne(['uid'=>Yii::$app->user->id]);
        if ($wechatgh==null){
            Yii::$app->getSession()->setFlash('danger','请设置公众号信息！');
            return $this->redirect(['/wechatgh/create']);
        }



        $workerObjet=$this->findModel($id);//Worker::findOne($id);
        $worerArr=$workerObjet->attributes;
        $company=Company::findOne($workerObjet->company_id)->attributes;
        $department=Department::findOne($workerObjet->department_id)->attributes;
        $worerInfo=ArrayHelper::merge($company,$department,$worerArr);
        //$user = array_merge($user1, $user2);

        ////////////////////////////微信公众号分享接口start
        $uid=$worerInfo['uid'];
        $wechatgh=Wechatgh::findOne(['uid'=>$uid]);

        $jssdk=new Wechat();
        $jssdk->appId=$wechatgh->appid;
        $jssdk->appSecret=$wechatgh->appsecret;
        $jsconfig=$jssdk->jsApiConfig([
            'debug' => false,
            'jsApiList' => [
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                  ]
        ]);//// wx.config(..= json_encode($wehcat->jsApiConfig()) );.. // 默认全权限


        ///////////////////////////微信公众号分享接口end
        if($worerInfo['tpl']==1){
            return $this->renderPartial('card1', [
                'worker'=>$worerInfo,
                'jsconfig'=>$jsconfig
            ]);
        }else{
            return $this->renderPartial('card1', [
                'worker'=>$worerInfo
            ]);
        }


    }


}
