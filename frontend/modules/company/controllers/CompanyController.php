<?php

namespace frontend\modules\company\controllers;

use Yii;
use frontend\modules\company\models\Company;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Upload;
use yii\web\UploadedFile;
use frontend\tbhome\ArrayTools;

/**
 * CompanyController implements the CRUD actions for Company model.
 */


class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $uid=Yii::$app->user->id;
        $dataProvider = new ActiveDataProvider([
            'query' => Company::find()->where(['uid'=>$uid]),//->all(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $uid=\Yii::$app->user->id;
        $model = new Company();

        if ($model->load(Yii::$app->request->post())) {
            $model->uid=$uid;
             $model->save();
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $uid=\Yii::$app->user->id;
        $model = $this->findModel($id);

        $image=new Upload();

        if ($model->load(Yii::$app->request->post())) {
            $model->uid=$uid;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'image'=>$image,
            ]);
        }
    }






    public function actionUploadimage($id)
    {
        $image = new Upload();
        $uid = Yii::$app->user->id;
        if (Yii::$app->request->isPost) {
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');//上传!
            $filename = 'company_' . time();
            $dir = 'Uploads/'.$uid.'/company/';
            //     if (!file_exists($dir)) mkdir($dir, true);//is_dir
            if ($image->upload($filename, $dir)) {//新建目录和文件信息保存！
                // 文件上传成功
                $url = $dir. $filename . '.' . $image->imageFile->extension;

                $model=$this->findModel($id);
                $model->uid = $uid;
                $model->image = $url;

                if($model->validate()){
                    $model->save();
                    $msg='上传成功！';
                }else{
                    $errors = $model->errors;
                    $msg='验证失败：'.ArrayTools::arrayToString($errors);
                  //  $msg='验证失败：'.json_encode($errors);
                }

                Yii::$app->getSession()->setFlash('success', $msg);
                return $this->redirect(['update', 'id'=>$model->id]);
            } else {
                Yii::$app->getSession()->setFlash('danger', '上传失败！');
                return $this->redirect(['update']);
            }

        }
    }







    /**
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
