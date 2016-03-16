<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Module;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\tbhome\DbTool;
//require dirname(__DIR__) . '/tbhome/DbTool.php';

/**
 * ModuleController implements the CRUD actions for Module model.
 */
class ModuleController extends Controller
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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




/*
    protected function outputSql($sqlStr,$delimiter = '(;\n)|((;\r\n))|(;\r)',$prefix = '',$commenter = array('#','--'))
    {
        //通过sql语法的语句分割符进行分割
        $segment = explode(";",trim($sqlStr));
        //var_dump($segment);
        ///去掉注释和多余的空行
        foreach($segment as & $statement):
            $sentence = explode("\n",$statement);
            $newStatement = array();
            foreach($sentence as $subSentence):
                if(''!= trim($subSentence)):
                    //判断是会否是注释
                    $isComment = false;
                    foreach($commenter as $comer):
                        //  if(eregi("^(".$comer.")",trim($subSentence))):
                        if(preg_match('/^\('.$comer.'\)/i',trim($subSentence))):
                            $isComment = true;
                            break;
                        endif;
                    endforeach;
                    //如果不是注释，则认为是sql语句
                    if(!$isComment)
                        $newStatement[] = $subSentence;
                endif;
            endforeach;
            $statement = $newStatement;
        endforeach;
        //对表名加前缀
        if('' != $prefix)://只有表名在第一行出现时才有效，例如 CREATE TABLE talbeName
            $regxTable = "^[\`\'\"]{0,1}[\_a-zA-Z]+[\_a-zA-Z0-9]*[\`\'\"]{0,1}$";//处理表名的正则表达式
            $regxLeftWall = "^[\`\'\"]{1}";
            $sqlFlagTree = array
            (
                "CREATE" => array("TABLE" => array("$regxTable" => 0)),
                "INSERT" => array("INTO" => array("$regxTable" => 0))
            );

            foreach($segment as & $statement):
                $tokens = split(" ",$statement[0]);
                $tableName = array();
                $this->findTableName($sqlFlagTree,$tokens,0,$tableName);
                if(empty($tableName['leftWall'])):
                    $newTableName = $prefix.$tableName['name'];
                else:
                    $newTableName = $tableName['leftWall'].$prefix.substr($tableName['name'],1);
                endif;
                $statement[0] = str_replace($tableName['name'],$newTableName,$statement[0]);
            endforeach;
        endif;
        //组合sql语句
        foreach($segment as & $statement):
            $newStmt = '';
            foreach($statement as $sentence):
                $newStmt = $newStmt.trim($sentence)."\n";
            endforeach;
            $statement = $newStmt;
        endforeach;
       return $segment;

    }

    private function findTableName($sqlFlagTree,$tokens,$tokensKey=0,$tableName = array())
    {
        $regxLeftWall = "^[\`\'\"]{1}";
        if(count($tokens)<=$tokensKey)
            return false;
        if('' == trim($tokens[$tokensKey])):
            return self::findTableName($sqlFlagTree,$tokens,$tokensKey+1,$tableName);
        else:
            foreach($sqlFlagTree as $flag => $v):
                //    if(eregi($flag,$tokens[$tokensKey])):
                if(preg_match('/'.$flag.'/i',$tokens[$tokensKey])):
                    if(0==$v):
                        $tableName['name'] = $tokens[$tokensKey];
                        //    if(eregi($regxLeftWall,$tableName['name'])):
                        if(preg_match('/'.$regxLeftWall.'/i',$tableName['name'])):
                            $tableName['leftWall'] = $tableName['name']{0};
                        endif;
                        return true;
                    else:
                        return self::findTableName($v,$tokens,$tokensKey+1,$tableName);
                    endif;
                endif;
            endforeach;
        endif;
        return false;
    }








*/






}

