<?php

namespace frontend\modules\company\controllers;

use Yii;
use frontend\modules\company\models\Department;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\Uploadfile;
use frontend\modules\company\models\DepartmentSearch;


/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends Controller
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
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {
        $uid=Yii::$app->user->id;
        $dataProvider = new ActiveDataProvider([
            'query' => Department::find()->where(['uid'=>$uid]),//->all(),
        ]);
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $file=new Uploadfile();
                   return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel'=>$searchModel,
                'file'=>$file,
            ]);
   //     }

    }

    public function actionImport(){
        $uid=Yii::$app->user->id;
        $file=new Uploadfile();
        if(Yii::$app->getRequest()->isPost){
            $filename='departmentsData_'.time();
            $dir="Uploads/".$uid.'/company/department/';
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
                $columnArr=[];////第N栏的数据
                $modelColumn=[];/////第一栏，数据表字段名



                for ($i=0; $i<$allColumn; $i++){
                    $modelColumn[$i]=$currentSheet->getCellByColumnAndRow($i, 1)->getValue();
                    //      echo $modelColumn[$i];
                    ///////Excel第一栏，数据表字段名
                }




                for ($currentRow = 2; $currentRow <= $allRow; $currentRow = $currentRow + 1) {
                    $departmentModel=new Department();

                    for ($i=0; $i<$allColumn; $i++){
                        $columnValue[$i]=trim($currentSheet->getCellByColumnAndRow($i, $currentRow)->getValue());/////$columnValue[$i]： 第$currentRow栏，第$i列的数据值。

                        $columnArr[$modelColumn[$i]]=$columnValue[$i];//数组键值对，
                        //     print_r($columnArr[$modelColumn[$i]]);
                        //     echo '<br/>';

                        $departmentModel->$modelColumn[$i]=$columnValue[$i];
                        //echo $currentSheet->getCellByColumnAndRow($i, $currentRow)->getValue();
                        //     echo ' <br/>  ';
                    }
                    //   if (!isset($departmentModel->company_id)){$departmentModel->company_id=1;}
                    //        $departmentModel->status=10;
                    $departmentModel->uid=$uid;
                    $departmentModel->save();
                    //echo ' <br/>  ';
                    //    echo $currentSheet->getCellByColumnAndRow(1, $currentRow)->getValue();

                }
                Yii::$app->getSession()->setFlash('success', ($currentRow-1).'条数据导入成功！'.$filePath);
                return $this->redirect(['index']);
            }

        }


        }


    public function actionDownload()
    {

        $uid=Yii::$app->user->id;
        $departments=Department::find()->where(['uid'=>$uid]);
        $num=$departments->count();
        $departments=$departments->all();
    //    print_r($departments);




        $objPHPExcel=new \PHPExcel();
        $objPHPExcel->getProperties()  //获得文件属性对象，给下文提供设置资源
        ->setCreator( "tbhome")                 //设置文件的创建者
        ->setLastModifiedBy( "wuhanqing")          //设置最后修改者
        ->setTitle( "Department infomation" )    //设置标题
        ->setSubject( "Departments" )  //设置主题
        ->setDescription( "Think you to usage！") //设置备注
        ->setKeywords( "office 2007 openxml php")        //设置标记
        ->setCategory( "Test result file");

        $objPHPExcel->setActiveSheetIndex(0);
        $objActivSheet=$objPHPExcel->getActiveSheet();

        $objActivSheet->setCellValue('A1', 'id')
            ->setCellValue('B1', 'uid')
            ->setCellValue('C1', 'department');
           // ->setCellValue('D1', 'status');

        for($i=2; $i<($num+2); $i++){
            $arrid=$i-2;

            $objActivSheet->setCellValue('A'.$i, $departments[$arrid]->id)
                ->setCellValue('B'.$i, $departments[$arrid]->uid)
                ->setCellValue('C'.$i, $departments[$arrid]->department);
              //  ->setCellValue('D'.$i, $departments[$arrid]->status);

        }

        $objActivSheet->setTitle('Departments');
        $name='Departments';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;

    }

    /**
     * Displays a single Department model.
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
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $uid=\Yii::$app->user->id;
        $model = new Department();




        if ($model->load(Yii::$app->request->post())) {
            $model->uid=$uid;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
         //       'listcompanys'=>$listCompanys
            ]);
        }
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $uid=\Yii::$app->user->id;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->uid=$uid;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Department model.
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
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
