<?php
namespace frontend\modules\qrcode\controllers;

use Yii;
use frontend\modules\qrcode\models\QrcodeLog;
use frontend\modules\qrcode\models\QrcodeLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\qrcode\models\QrcodeData;
use yii\helpers\Url;

/**
 * QrcodeLogController implements the CRUD actions for QrcodeLog model.
 */
class QrcodelogController extends Controller
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

    /**
     * Lists all QrcodeLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QrcodeLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QrcodeLog model.
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
     * Creates a new QrcodeLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QrcodeLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QrcodeLog model.
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
     * Deletes an existing QrcodeLog model.
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
     * Finds the QrcodeLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QrcodeLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QrcodeLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionExcel($start, $end){
        $uid=Yii::$app->user->id;
        $sql="SELECT * FROM {{%column}} WHERE uid=$uid AND type='qrcode'";
        $qrcodeColumns=Yii::$app->db->createCommand($sql)->queryAll();
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
            $i='I';
            foreach($qrcodeColumns as $key => $value){//$qrcodeColumns as $qrcodeColumn
                $objActivSheet->setCellValue($i.'1', $value['label']);
                $i++;
            }
        }

     //   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // $data=QrcodeData::find();//->asArray();
            $data=QrcodeData::find()->where('id>='.$start.' AND id<='.$end);
            $num=$data->count();
            $data= $data->all();
     //   }

        for($i=2; $i<($num+2); $i++){
            $arrid=$i-2;
            $createTime=date('Y-m-d H:m:s', $data[$arrid]->create_time);
            $queryTime =$data[$arrid]->query_time==0 ? 0 : date('Y-m-d H:m:s', $data[$arrid]->query_time);

            $url=Url::to([
                '/qrcode/qrcode/qrcodepage',
                'replyid'=>$data[$arrid]->replyid,
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





}
