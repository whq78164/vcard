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
use frontend\models\Uploadfile;

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

        $file=new Uploadfile();

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'listCompanys'=>$listCompanys,
                'listDepartments'=>$listDepartments,
                'file'=>$file,
            ]);


    }

    public function actionImport(){
        if(Yii::$app->getRequest()->isPost){
            $uid=Yii::$app->user->id;
            $file=new Uploadfile();

            $filename='workersData'.time();
            $dir="Uploads/".$uid.'/company/workers/';
            $file->file = UploadedFile::getInstance($file, 'file');//上传!
            if($file->upload($dir, $filename)){
                $filePath = $dir. $filename . '.' . $file->file->extension;
                //  $excel=file_get_contents($url);
                //header('Content-Type:text/html;charset=UTF-8');

                //       $PHPExcel = new \PHPExcel();

                /**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
                $PHPReader = new \PHPExcel_Reader_Excel2007();
                if (!$PHPReader->canRead($filePath)) {
                    $PHPReader = new \PHPExcel_Reader_Excel5();
                    if (!$PHPReader->canRead($filePath)) {
                        Yii::$app->getSession()->setFlash('danger', '文件读取错误！'.$filePath);
                        return $this->refresh();
                    }
                }
                $PHPExcel = $PHPReader->load($filePath);
                $currentSheet = $PHPExcel->getSheet(0); /* * 读取excel文件中的第一个工作表 */
                $allColumn = $currentSheet->getHighestColumn();/**取得最大的列号*/
                $allRow = $currentSheet->getHighestRow(); /* * 取得一共有多少行 */
                $allColumn = \PHPExcel_Cell::columnIndexFromString($allColumn); //字母列转换为数字列 如:AA变为27

                $columnValue=[];////第N栏M列数据值
        //        $columnArr=[];////第N栏的数据
                $modelColumn=[];/////第一栏，数据表字段名
                for ($i=0; $i<$allColumn; $i++){
                    $modelColumn[$i]=trim($currentSheet->getCellByColumnAndRow($i, 1)->getValue());
                    ///////Excel第一栏，数据表字段名
                }



                for ($currentRow = 2; $currentRow <= $allRow; $currentRow = $currentRow + 1) {
                    //   $workerModel=Worker::findOne(['job_id'=>$columnArr['job_id']]);
                    //    if ($workerModel==null){
                   $workerModel=new Worker();
                    //   }




                    for ($i=0; $i<$allColumn; $i++){
                        $columnValue[$i]=trim($currentSheet->getCellByColumnAndRow($i, $currentRow)->getValue());
                        /////$columnValue[$i]： 第$currentRow栏，第$i列的数据值。
                       if($modelColumn[$i]=='department_id'){
                           $modelDepartment=Department::findOne(['department'=>$columnValue[$i]]);
                            $columnValue[$i]=$modelDepartment->id;
                        }


                      if($modelColumn[$i]=='company_id'){
                            $modelCompany=Company::findOne(['company'=>$columnValue[$i]]);
                            $columnValue[$i]=$modelCompany->id;
                        }

                //        $columnArr[$modelColumn[$i]]=$columnValue[$i];//数组键值对，
                 //       echo $modelColumn[$i].'  ';//.$columnValue[$i].'  ';

                                $workerModel->$modelColumn[$i]=$columnValue[$i];
                        //echo $currentSheet->getCellByColumnAndRow($i, $currentRow)->getValue();

                    }




                    //       print_r($columnArr);
          //          print_r($workerModel);
   //           echo ' <br/>  ';
                  if (!isset($workerModel->company_id)){$workerModel->company_id=1;}
                               $workerModel->head_img='Uploads/'.$uid.'/company/workers/'.$workerModel->job_id.'.jpg';
                                   $workerModel->uid=$uid;
                          $workerModel->save();
                    //echo ' <br/>  ';
                    //    echo $currentSheet->getCellByColumnAndRow(1, $currentRow)->getValue();

                }



                //     echo \PHPExcel_Cell::columnIndexFromString($allColumn);


                Yii::$app->getSession()->setFlash('success', $allRow.'条数据导入成功！'.$filePath);
                return $this->redirect(['index']);
            }

        }
    }



    public function actionDownload()
    {

        $uid=Yii::$app->user->id;
        $workers=Worker::find()->where(['uid'=>$uid]);
        $num=$workers->count();
        $workers=$workers->all();//$workers数组，键为数据表字段
        //    print_r($departments);

        $objPHPExcel=new \PHPExcel();
        $objPHPExcel->getProperties()  //获得文件属性对象，给下文提供设置资源
        ->setCreator( "tbhome")                 //设置文件的创建者
        ->setLastModifiedBy( "wuhanqing")          //设置最后修改者
        ->setTitle( "Workers infomation" )    //设置标题
        ->setSubject( "Workers" )  //设置主题
        ->setDescription( "Think you to usage！") //设置备注
        ->setKeywords( "office 2007 openxml php")        //设置标记
        ->setCategory( "Test result file");

        $objPHPExcel->setActiveSheetIndex(0);
        $objActivSheet=$objPHPExcel->getActiveSheet();

        $objActivSheet->setCellValue('A1', 'job_id')
            ->setCellValue('B1', 'department_id')
            ->setCellValue('C1', 'name')
            ->setCellValue('D1', 'mobile')
            ->setCellValue('E1', 'qq')
            ->setCellValue('F1', 'email')
            ->setCellValue('G1', 'position')
            ->setCellValue('H1', 'work_tel')
            ->setCellValue('I1', 'wechat_account')
            ->setCellValue('J1', 'fax')
            ->setCellValue('K1', 'company_id');

        for($i=2; $i<($num+2); $i++){
            $arrid=$i-2;

            $departmentid=$workers[$arrid]->department_id;
            $departmentTemp=Department::findOne(['id'=>$departmentid]);
            $departmentid=$departmentTemp->department;

            $companyid=$workers[$arrid]->company_id;
            $companyTemp=Company::findOne(['id'=>$companyid]);
            $companyid=$companyTemp->company;

            $objActivSheet->setCellValue('A'.$i, $workers[$arrid]->job_id)
                ->setCellValue('B'.$i, $departmentid)
                ->setCellValue('C'.$i, $workers[$arrid]->name)
                ->setCellValue('D'.$i, $workers[$arrid]->mobile)
                ->setCellValue('E'.$i, $workers[$arrid]->qq)
                ->setCellValue('F'.$i, $workers[$arrid]->email)
                ->setCellValue('G'.$i, $workers[$arrid]->position)
                ->setCellValue('H'.$i, $workers[$arrid]->work_tel)
                ->setCellValue('I'.$i, $workers[$arrid]->wechat_account)
                ->setCellValue('J'.$i, $workers[$arrid]->fax)
                ->setCellValue('K'.$i, $companyid);
        }

        $objActivSheet->setTitle('Workers');
        $name='Workers';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;




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
        $workerObjet=$this->findModel($id);//Worker::findOne($id);
        $worerArr=$workerObjet->attributes;
        $uid=$worerArr['uid'];

        $company=Company::findOne($workerObjet->company_id)->attributes;
        $department=Department::findOne($workerObjet->department_id)->attributes;
        $worerInfo=ArrayHelper::merge($company,$department,$worerArr);
        //$user = array_merge($user1, $user2);

        ////////////////////////////微信公众号分享接口start
        $wechatgh=Wechatgh::findOne(['uid'=>$uid]);
        if ($wechatgh==null){
            Yii::$app->getSession()->setFlash('danger','请设置公众号信息！');
            return $this->redirect(['/wechatgh/create']);
        }

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
                'worker'=>$worerInfo,
                'jsconfig'=>$jsconfig,
            ]);
        }


    }


}
