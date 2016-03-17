<?php

namespace frontend\modules\qrcode\controllers;

use Yii;
use frontend\modules\qrcode\models\QrcodeData;
use frontend\modules\qrcode\models\QrcodeReply;
use frontend\modules\qrcode\models\QrcodeDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\models\Product;
use yii\helpers\Url;
//use yii\db\Schema;

/**
 * QrcodecodeController implements the CRUD actions for QrcodeCode model.
 */
class QrcodedataController extends Controller
{
    public $layout='@frontend/views/layouts/user';
 /*   public function behaviors()
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
*/

    public function init(){
    //    $uid=Yii::$app->user->id;
      //  $tableCode='{{%Qrcode_code_'.$uid.'}}';
        //$column='query_area';
   //     $type=Schema::TYPE_DOUBLE.'(10,6) NOT NULL';
     ///   $this->addColumn($tableCode,$column,$type);
    }

    protected function tableExist($table){//不支持前缀。故而{{%table}}无效！
        $Prefix=Yii::$app->db->tablePrefix;
        $table=str_replace(['{{%', '}}'],[$Prefix, ''],$table);
        $sql="SHOW TABLES LIKE '".$table."'";
        //     $sql="SHOW TABLE LIKE $table";
        //   $sql="SELECT COUNT(*) FROM $table";
        //  $sql="SHOW TABLES LIKE $table";
        $ta=\Yii::$app->db->createCommand($sql)->queryOne();

        if(!$ta){
            return false;
        }else {
            return true;
            //echo $table."数据表已存在，已跳过。</br>";
        }
    }

    protected function addColumn($table, $column, $type){

        $sql="Describe $table $column";
        $con=Yii::$app->db->createCommand($sql)->queryOne();
        if($con['Field']==null){
            Yii::$app->db->createCommand()->addColumn($table, $column, $type)->execute();
        }

    }

    /**
     * Lists all QrcodeCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $uid=Yii::$app->user->id;
        $dirPath = 'Uploads/' . $uid . '/GenQRcode/';
        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0777, true);
        }


        $table='tbhome_qrcode_data_'.$uid;

        $ta=$this->tableExist($table);
        if(!$ta){

            $Connection = \Yii::$app->db;
            $uid=Yii::$app->user->id;

            $data = '`tbhome_qrcode_data_'.$uid.'`';
            $moban = '`tbhome_qrcode_data`';
            $sql = 'CREATE TABLE IF NOT EXISTS '.$data.' LIKE '.$moban;
            $command=$Connection->createCommand($sql);
            $command->execute();

            $logmoban='`tbhome_qrcode_log`';
            $log='`tbhome_qrcode_log_'.$uid.'`';
            $logsql = 'CREATE TABLE IF NOT EXISTS '.$log.' LIKE '.$logmoban;
            $command=$Connection->createCommand($logsql);
            $command->execute();
        }
            $product=Product::find()->where(['uid'=>$uid])->all();

            $listProduct1=ArrayHelper::map($product, 'id', 'name');
            $listProduct2=ArrayHelper::map($product, 'id', 'specification');
            $listProduct=array();
            foreach($listProduct1 as $key1=>$value1){

                $listProduct[$key1]=$value1.' '.$listProduct2[$key1];
            }
            $listProduct['']='全部';


            $searchModel = new QrcodeDataSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'listProduct' => $listProduct,
            ]);

    }

    /**
     * Displays a single QrcodeCode model.
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
     * Creates a new QrcodeCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new QrcodeData();
        $uid=Yii::$app->user->id;
        $model->uid=$uid;
        $model->create_time=time();
        //     $model->clicks=3;
        //    $model->query_time=time()-(3600*24);



        $reply=QrcodeReply::find()->where(['uid'=>$uid])->all();
        $listReply=ArrayHelper::map($reply, 'id', 'tag');




        $product=Product::find()->where(['uid'=>$uid])->all();
        $listData1=ArrayHelper::map($product, 'id', 'name');
        $listData2=ArrayHelper::map($product, 'id', 'specification');
        $listProduct=array();
        foreach($listData1 as $key1=>$value1){
            $listProduct[$key1]=$value1.' '.$listData2[$key1];
        }



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'listReply'=>$listReply,
                'listProduct'=>$listProduct,
            ]);
        }
    }

    /**
     * Updates an existing QrcodeCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uid=Yii::$app->user->id;
        $model->uid=$uid;

        $reply=QrcodeReply::find()->where(['uid'=>$uid])->all();
        $listReply=ArrayHelper::map($reply, 'id', 'tag');
//        $list2=ArrayHelper::map($reply, 'id', 'specification');
  //      $listReply=array();
//        foreach($list1 as $key1=>$value1){
  //          $listReply[$key1]=$value1.' '.$list2[$key1];
//        }

        $product=Product::find()->where(['uid'=>$uid])->all();
        $listData1=ArrayHelper::map($product, 'id', 'name');
        $listData2=ArrayHelper::map($product, 'id', 'specification');
        $listProduct=array();
        foreach($listData1 as $key1=>$value1){

            $listProduct[$key1]=$value1.' '.$listData2[$key1];
        }




        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'listReply'=>$listReply,
                'listProduct'=>$listProduct,

            ]);
        }
    }

    /**
     * Deletes an existing QrcodeCode model.
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
     * Finds the QrcodeCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QrcodeCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QrcodeData::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionExcelall(){

        $uid=Yii::$app->user->id;
        $sql="SELECT * FROM {{%column}} WHERE uid=$uid AND type='qrcode'";
        $qrcodeColumns=Yii::$app->db->createCommand($sql)->queryAll();

/*
        if (!empty($qrcodeColumns)){
            $i='I';
            foreach($qrcodeColumns as $key => $value){//$qrcodeColumns as $qrcodeColumn
              echo $value['label'].$i;
                $i++;
            }
        }
*/

        $objPHPExcel=new \PHPExcel();
        $objPHPExcel->getProperties()  //获得文件属性对象，给下文提供设置资源
        ->setCreator( "tbhome")                 //设置文件的创建者
        ->setLastModifiedBy( "wuhanqing")          //设置最后修改者
        ->setTitle( "QRcode infomation" )    //设置标题
        ->setSubject( "QRcodeData" )  //设置主题
        ->setDescription( "Think you to usage！") //设置备注
        ->setKeywords( "office 2007 openxml php")        //设置标记
        ->setCategory( "Test result file");

        $objPHPExcel->setActiveSheetIndex(0);
        $objActivSheet=$objPHPExcel->getActiveSheet();

        $objActivSheet->setCellValue('A1', '序号')
            ->setCellValue('B1', '防伪码')
            ->setCellValue('C1', '创建时间')
            ->setCellValue('D1', '查询时间')
            ->setCellValue('E1', '点击量')
            ->setCellValue('F1', '网址')
            ->setCellValue('G1', '奖品')
            ->setCellValue('H1', '备注');


        if (!empty($qrcodeColumns)){
          //  $listDiyColumns=array();
            $i='I';
            foreach($qrcodeColumns as $key => $value){//$qrcodeColumns as $qrcodeColumn
                $objActivSheet->setCellValue($i.'1', $value['label']);
                $i++;
               // $listDiyColumns=$listDiyColumns+[$value['column']=>$value['label']];
            }

        }
   //     print_r($listDiyColumns);

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $start=$_POST['start'];
            $end=$_POST['end'];
            $data=QrcodeData::find()->where('id>='.$start.' AND id<='.$end);
            $num=$data->count();
            $data= $data->all();
        }else{
            $data=QrcodeData::find();//->asArray();
            $num=$data->count();
            $data= $data->all();
        }
        for($i=2; $i<($num+2); $i++){
            $arrid=$i-2;
            $createTime=date('Y-m-d H:m:s', $data[$arrid]->create_time);
            $queryTime =$data[$arrid]->query_time==0 ? 0 : date('Y-m-d H:m:s', $data[$arrid]->query_time);

            $url=Url::to([
                '/qrcode/qrcode/qrcodepage',
                'replyid'=>$data[$arrid]->replyid,
              //  'productid'=>$data[$arrid]->productid,
                'code'=>$data[$arrid]->code
            ], true);

            $objActivSheet->setCellValue('A'.$i, $data[$arrid]->id)
                ->setCellValue('B'.$i, $data[$arrid]->code)
                ->setCellValue('C'.$i, $createTime)
                ->setCellValue('D'.$i, $queryTime)
                ->setCellValue('E'.$i, $data[$arrid]->clicks)
                ->setCellValue('F'.$i, $url)
                ->setCellValue('G'.$i, $data[$arrid]->prize)
                ->setCellValue('H'.$i,$data[$arrid]->remark);

            if (!empty($qrcodeColumns)){
                //  $listDiyColumns=array();
                $j='I';
                foreach($qrcodeColumns as $key => $value){
                    $objActivSheet->setCellValue($j.$i, $data[$arrid]->$value['column']);
                 $j++;
                }
            }

        }



        $objActivSheet->setTitle('QrcodeCode');
        $name='Qrcodecode';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;

    }

    public function actionGenimage(){

    //    require(__DIR__ . '/../assets/phpqrcode/qrlib.php');
        $uid = Yii::$app->user->id;

        if (is_numeric($_POST['start']) && is_numeric($_POST['end']) && ($_POST['end'] > $_POST['start'])) {

            $date = date('Y_m_d_Hms_', time());
            $rand = rand();
            $dirPath = 'Uploads/' . $uid . '/GenQRcode/' . $date . $rand . '/';
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $start = $_POST['start'];
            $end = $_POST['end'];
            $data = QrcodeData::find()->where('id>=' . $start . ' AND id<=' . $end);
            $num = $data->count();
            $data = $data->all();

            for ($i = 0; $i < $num; $i++) {
                //   $url = $data[$i]->url;
                $url=Url::to([
                    '/qrcode/qrcode/qrcodepage',
                    'replyid'=>$data[$i]->replyid,
                 //   'productid'=>$data[$i]->productid,
                    'code'=>$data[$i]->code
                ], true);

                $id = $data[$i]->id;
                \QRcode::png($url, $dirPath . $id . '.png', 'M', 6, 1);
            }

            //         $dirPath = 'Uploads/' . $uid . '/GenQRcode/' . $date . $rand. '/';


            $dir = opendir($dirPath);
            $filename = 'Uploads/' . $uid . '/GenQRcode/' . 'image' . time() . '_' . $rand . '.zip';
            $zip = new \ZipArchive;
           // $file = readdir($dir);
            if ($zip->open($filename, \ZipArchive::CREATE) === TRUE) {
                while (($file = readdir($dir)) !== false) {
              //  while ($file) {
                    if ($file !== "." && $file !== "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
                        $zip->addFile($dirPath.$file);//假设加入的文件名是image.txt，在当前路径下
                    }
                }

            }

            $zip->close();
     //    while(($file = readdir($dir)) !== false){unlink($dirPath.$file);}
          //  rmdir($dirPath);
            closedir($dir);

            //循环删除目录和文件函数
            function delDirAndFile( $dirName )
            {
                if ( $handle = opendir( "$dirName" ) ) {
                    while ( false !== ( $item = readdir( $handle ) ) ) {
                        if ( $item != "." && $item != ".." ) {
                            if ( is_dir( "$dirName/$item" ) ) {
                                delDirAndFile( "$dirName/$item" );
                            } else {
                                if( unlink( "$dirName/$item" ) )echo "成功删除文件： $dirName/$item<br />\n";
                            }
                        }
                    }
                    closedir( $handle );
                    if( rmdir( $dirName ) )echo "成功删除目录： $dirName<br />\n";
                }
            }

       //     $uid = Yii::$app->user->id;
       //     $dirPath = 'Uploads/' . $uid . '/GenQRcode';
          

//文件的类型
            header('Content-type: application/zip');
//下载显示的名字
            header('Content-Disposition: attachment; filename="QRcodeImage.zip"');
            readfile($filename);
  delDirAndFile($dirPath);
            //  $this->redirect(['index']);
            //    Yii::$app->getSession()->setFlash('success', '已生产二维码图片' . $num . '张, 目录' . $dirPath);
            exit();


        }else{
            Yii::$app->getSession()->setFlash('danger', '防伪码序号输入错误');

        }


    }


}
