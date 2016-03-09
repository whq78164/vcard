<?php

namespace frontend\controllers;

use Yii;
use frontend\models\AntiCode;
use frontend\models\AntiReply;
use frontend\models\AntiCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\AntiCodenew;
use yii\helpers\ArrayHelper;
use frontend\models\Product;
use yii\helpers\Url;
//use yii\db\Schema;
use frontend\models\TraceabilityInfonew;


/**
 * AnticodeController implements the CRUD actions for AntiCode model.
 */
class AnticodeController extends Controller
{
    public $layout='user';
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
      //  $tableCode='{{%anti_code_'.$uid.'}}';
        //$column='query_area';
   //     $type=Schema::TYPE_DOUBLE.'(10,6) NOT NULL';
     ///   $this->addColumn($tableCode,$column,$type);
    }

    protected function addColumn($table, $column, $type){

        $sql="Describe $table $column";
        $con=Yii::$app->db->createCommand($sql)->queryOne();
        if($con['Field']==null){
            Yii::$app->db->createCommand()->addColumn($table, $column, $type)->execute();
        }

    }

    /**
     * Lists all AntiCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $uid=Yii::$app->user->id;
        $dirPath = 'Uploads/' . $uid . '/GenQRcode/';
        if (!file_exists($dirPath)) {
            mkdir($dirPath, 0777, true);
        }


        $table='tbhome_anti_code_'.$uid;
        $ta=Yii::$app->db->createCommand("SHOW TABLES LIKE '".$table."'")->queryAll();
        if($ta==null){
            Yii::$app->getSession()->setFlash('danger', '请先生成防伪码！');
            return $this->redirect(['anti/gencode']);
        }else{
            $product=Product::find()->where(['uid'=>$uid])->all();





            $listProduct1=ArrayHelper::map($product, 'id', 'name');
            $listProduct2=ArrayHelper::map($product, 'id', 'specification');
            $listProduct=array();
            foreach($listProduct1 as $key1=>$value1){

                $listProduct[$key1]=$value1.' '.$listProduct2[$key1];
            }
            $listProduct['']='全部';




            $searchModel = new AntiCodeSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'listProduct' => $listProduct,
            ]);
        }
    }

    /**
     * Displays a single AntiCode model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function listTraceability(){
        $uid=Yii::$app->user->id;
        $role=Yii::$app->user->identity->role;

        if ($role>=60){
            $traceaInfo='tbhome_traceability_info_'.$uid;
            $mobanInfo = 'tbhome_traceability_info';
            $sqlInfo = 'CREATE TABLE IF NOT EXISTS '.$traceaInfo.' LIKE '.$mobanInfo;
            $commandInfo=Yii::$app->db->createCommand($sqlInfo);
            $commandInfo->execute();

            $traceabiliy=TraceabilityInfonew::find()->all();
            $listTraceability=ArrayHelper::map($traceabiliy, 'id', 'label');
            if (!$listTraceability){
                Yii::$app->getSession()->setFlash('danger', '请先添加追溯信息！');
                return $this->redirect(['traceabilityinfo/create']);
            }else{
                return $listTraceability;
            }

        }else{
           return array();
        }


    }

    /**
     * Creates a new AntiCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new AntiCodenew();
        $uid=Yii::$app->user->id;
        $model->uid=$uid;
        $model->create_time=time();
        //     $model->clicks=3;
        //    $model->query_time=time()-(3600*24);



        $reply=AntiReply::find()->where(['uid'=>$uid])->all();
        $listReply=ArrayHelper::map($reply, 'id', 'tag');
//        $list2=ArrayHelper::map($reply, 'id', 'specification');
        //      $listReply=array();
//        foreach($list1 as $key1=>$value1){
        //          $listReply[$key1]=$value1.' '.$list2[$key1];
        //       }

        //>=60质量追溯
     $listTraceability=$this->listTraceability();




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
                'listTraceability'=>$listTraceability,
            ]);
        }
    }

    /**
     * Updates an existing AntiCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uid=Yii::$app->user->id;
        $model->uid=$uid;

        $reply=AntiReply::find()->where(['uid'=>$uid])->all();
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

        //>=60质量追溯
        $listTraceability=$this->listTraceability();




        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'listReply'=>$listReply,
                'listProduct'=>$listProduct,
                'listTraceability'=>$listTraceability,
            ]);
        }
    }

    /**
     * Deletes an existing AntiCode model.
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
     * Finds the AntiCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AntiCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AntiCodenew::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionExcelall(){

        $objPHPExcel=new \PHPExcel();
        $objPHPExcel->getProperties()  //获得文件属性对象，给下文提供设置资源
        ->setCreator( "798904845")                 //设置文件的创建者
        ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
        ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
        ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
        ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
        ->setKeywords( "office 2007 openxml php")        //设置标记
        ->setCategory( "Test result file");

        $objPHPExcel->setActiveSheetIndex(0);
        $objActivSheet=$objPHPExcel->getActiveSheet();
        $objActivSheet->setCellValue('A1', '防伪码')
            ->setCellValue('B1', '创建时间')
            ->setCellValue('C1', '查询时间')
            ->setCellValue('D1', '点击量')
            ->setCellValue('E1', '奖品')
            ->setCellValue('F1', '备注')
            ->setCellValue('G1', '网址')
            ->setCellValue('H1', '序号');


        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $start=$_POST['start'];
            $end=$_POST['end'];
            $data=AntiCodenew::find()->where('id>='.$start.' AND id<='.$end);
            $num=$data->count();
            $data= $data->all();
        }else{

            $data=AntiCodenew::find();//->asArray();
            $num=$data->count();
            $data= $data->all();
        }
        for($i=2; $i<($num+2); $i++){
            $arrid=$i-2;
            $createTime=date('Y-m-d H:m:s', $data[$arrid]->create_time);
            $queryTime =$data[$arrid]->query_time==0 ? 0 : date('Y-m-d H:m:s', $data[$arrid]->query_time);

            $url=Url::to([
                '/anti/antipage',
                'replyid'=>$data[$arrid]->replyid,
              //  'productid'=>$data[$arrid]->productid,
                'code'=>$data[$arrid]->code
            ], true);


            $objActivSheet->setCellValue('A'.$i, $data[$arrid]->code)
                ->setCellValue('B'.$i, $createTime)
                ->setCellValue('C'.$i, $queryTime)
                ->setCellValue('D'.$i, $data[$arrid]->clicks)
                ->setCellValue('E'.$i, $data[$arrid]->prize)
                ->setCellValue('F'.$i, $data[$arrid]->remark)
                ->setCellValue('G'.$i, $url)//->setCellValue('G'.$i, $data[$arrid]->url)
                ->setCellValue('H'.$i, $data[$arrid]->id);
        }



        $objActivSheet->setTitle('AntiCode');
        $name='Anticode';
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
            $data = AntiCodenew::find()->where('id>=' . $start . ' AND id<=' . $end);
            $num = $data->count();
            $data = $data->all();

            for ($i = 0; $i < $num; $i++) {
                //   $url = $data[$i]->url;
                $url=Url::to([
                    '/anti/antipage',
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
