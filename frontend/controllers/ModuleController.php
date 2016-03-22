<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Module;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\tbhome\DbTool;
use frontend\tbhome\Update;
use frontend\tbhome\FileTools;
//require dirname(__DIR__) . '/tbhome/DbTool.php';

/**
 * ModuleController implements the CRUD actions for Module model.
 */
class ModuleController extends DbController
{
    public $layout='admin';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //   'only' => ['logout', 'signup'],
                'rules' => [


                    [//   'actions' => ['index','update','logout',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionInstall()
    {

        $modulesDir = Yii::getAlias('@frontend/modules');
        $addmoduleFile=Yii::getAlias('@frontend/config/modules/addmodules.php');
        $request=Yii::$app->request->post();
        $online=Yii::$app->request->post('online');
        /*     if($request){
                 print_r($request);
                 print_r($oline);
             }else{
                 $model = new Module();
                 return $this->render('install', [
                     'model' => $model,
                 ]);
             }
     */
        /*         switch($step){
                   case 1 :
                       $render='step1';
                       break;
                   case 2:
                       $render='install';
                       break;
                   case 3:
                       // file_put_contents($frontend . '/config/db.php', $config)
                       break;
                default:
                       $render='install';
               }

           /*    if($step==1){
                   $render='install';
               }elseif($step==2){
                   $render='install';
               }elseif($step==3){
                   $render='install';
               }
       */

        $model = new Module();

        if ($request) {

            $model->load($request);
            $modulesDir=$modulesDir . '/' . $model->modulename;


            if (is_dir($modulesDir)) {
                $sqlFile=$modulesDir.'/'.$model->modulename.'.sql';
                if(is_file($sqlFile)){
                    /*            $dsn=Yii::$app->db->dsn;
                                $username=Yii::$app->db->username;
                                $password=Yii::$app->db->password;
                                $piecesDSN = explode(';', $dsn);//把字符串打散成数组，分割号：
                                $host=explode('=', $piecesDSN[0]);
                                $host=$host[1];
                                $dbname=explode('=', $piecesDSN[1]);
                                $dbname=$dbname[1];
                       */
                    if(is_file($modulesDir.'/install.lock')){
                        Yii::$app->getSession()->setFlash('danger','请删除模块目录install.lock文件后重新安装！');
                        return $this->refresh();

                    }

                    $sql=file_get_contents($sqlFile);
                    //  $sqlArr= $this->outputSql($sql);
                    $sqlArr= DbTool::outputSql($sql);
                    foreach($sqlArr as $eachSql){
                        Yii::$app->db->createCommand($eachSql)->execute();
                    }


                    if($model->save()){
                        $addmodule=$this->addmodulesConf();
                        $input=['{{module}}','{{class}}'];
                        $output=[$model->modulename,$_POST['class']];
                        $addmodule=str_replace($input,$output,$addmodule);
                        file_put_contents($addmoduleFile,$addmodule,FILE_APPEND|LOCK_EX);

                        $date=date('Y-m-d_H:i:s');
                        $string='安装时间：'.$date.'
                                    ';
                        $lockFile = fopen($modulesDir.'/install.lock', "a") or die("无法创建安装锁文件install.lock");

                        fwrite($lockFile, $string);
                        fclose($lockFile);

                        Yii::$app->getSession()->setFlash('success','模块安装成功！');
                        return $this->redirect(['/module']);
                    }else{
                        Yii::$app->getSession()->setFlash('danger','模块标识可能重名，模块安装失败！');
                        return $this->refresh();
                    }



                }else{
                    $error='模块目录未发现安装文件：'.$sqlFile;
                    Yii::$app->getSession()->setFlash('danger', $error);
                    return $this->refresh();
                }

            }elseif($online==2){
                echo $online.'在线安装';
                print_r($request);
            } else {
                $error = '模块目录不存在！：'.$modulesDir;
                Yii::$app->getSession()->setFlash('danger',$error);
                return $this->refresh();
            }

        }else {
            return $this->render('install', [
                'model' => $model,
            ]);
        }



    }


    protected function addmodulesConf() {
        $addmodule = <<<EOF

\$Moduleconfig['{{module}}']=['class' => '{{class}}'];

EOF;
        return $addmodule;
    }



    /**
     * Lists all Module models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Module::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Module model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $updateFiles=Update::moduleFilesList($model->modulename);

        return $this->render('view', [
            'model' => $model,
            'fileList'=>$updateFiles,
        ]);

    }

    /**
     * Creates a new Module model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Module();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Module model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Module model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Module model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Module the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Module::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionOnlineupdate(){
        header('Content-Type:text/html;charset=UTF-8');
        ini_set("max_execution_time", "1800");
        $frontend=Yii::getAlias('@frontend');
        $moduleInfo=Module::findOne($_POST['id']);
        $version=$moduleInfo->version;
        $modulename=$moduleInfo->modulename;
        $currentModuleDir=$frontend.'/modules/'.$modulename;
      //  print_r($moduleInfo);
        if(Yii::$app->request->isPost){

            if($version==0){//手动清除版本信息，重新升级
                $updateSql=$currentModuleDir.'/update.php';
                if(file_exists($updateSql)){
                    require $updateSql;
                }else{
                    echo '缺少文件：'.$updateSql;
                }

            }else{
                $backFilename=$frontend.'/backup/module_'.$modulename.date('Ymd_His',time());
                $updateZip=$frontend.'/runtime/module_'.$modulename.date('Ymd_His',time());
                $updateFilesList=Update::moduleFilesList($modulename);
                $updateSql=$frontend.'/modules/'.$modulename.'/update/'.$modulename.'_update_v'.strval($version).'.php';

                if(!$updateFilesList){
                    echo '恭喜！您的系统已是最新版本，无需升级！';
                }else{

          //          $fileList=[];
            //        foreach($updateFilesList as $value){$fileList[]=$currentModuleDir.'/'.$value;}
               //     FileTools::createZipFromArr($backFilename.'.zip', $fileList, $currentModuleDir);



                    if(array_key_exists('error!', $updateFilesList)){
                        echo '您的模块不支持升级！';
                        exit;
                    }else{
                        Update::backupFiles($backFilename,$modulename);
                        Update::downZip($updateZip.'.zip', $version, $modulename);

                        \frontend\tbhome\FileTools::extractZip($updateZip.'.zip', $currentModuleDir);
                        echo '<br/>文件更新成功！<br>';
                        foreach($updateFilesList as $dir){echo '<br>'.$dir;}
                        unlink($updateZip.'.zip');

                        if(!is_dir(dirname($updateSql))){//或file_exists
                            mkdir(dirname($updateSql), 0777, true);//true允许创建多级目录。
                        }
                        if(file_exists($updateSql)){
                            echo '<br/>升级数据库<br/>';
                            require $updateSql;
                            //     unlink($updateSql);
                        }
                    }









                }

            }

        }

        //   $this->update('{{%user}}', ['longitude'=>116.473259, 'latitude'=>39.86954], ['uid'=>1]);

    }




    public function actionClearv(){
        if(Yii::$app->request->isPost){
            $id=$_POST['id'];
            $this->update('{{%module}}', ['version'=>0.00], ['id'=>$id]);
            echo '<br/>版本号已清除！请刷新查看！';
        }
    }



}

