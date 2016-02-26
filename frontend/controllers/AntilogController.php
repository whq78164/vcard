<?php

namespace frontend\controllers;

use Yii;
use frontend\models\AntiLog;
use frontend\models\AntiLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\AntiCodenew;
use yii\helpers\Url;

/**
 * AntiLogController implements the CRUD actions for AntiLog model.
 */
class AntilogController extends Controller
{
    public $layout='user';
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
     * Lists all AntiLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AntiLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/antilog/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AntiLog model.
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
     * Creates a new AntiLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AntiLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AntiLog model.
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
     * Deletes an existing AntiLog model.
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
     * Finds the AntiLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AntiLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AntiLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    public function actionExcel($start, $end){

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

            $data=AntiCodenew::find()->where('id>='.$start.' AND id<='.$end);
            $num=$data->count();
            $data= $data->all();

        for($i=2; $i<($num+2); $i++){
            $arrid=$i-2;
            $createTime=date('Y-m-d H:m:s', $data[$arrid]->create_time);
            $queryTime =$data[$arrid]->query_time==0 ? 0 : date('Y-m-d H:m:s', $data[$arrid]->query_time);

            $url=Url::to(['/anti/antipage', 'replyid'=>$data[$arrid]->replyid, 'productid'=>$data[$arrid]->productid, 'code'=>$data[$arrid]->code], true);


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

}
