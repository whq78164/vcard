<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Cloud;
use frontend\models\CloudSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Micropage;
use yii\helpers\ArrayHelper;
use frontend\models\Module;

/**
 * CloudtableController implements the CRUD actions for Cloud model.
 */
class CloudtableController extends Controller
{
    public $layout='admin';
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
     * Lists all Cloud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CloudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cloud model.
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
     * Creates a new Cloud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cloud();
        $uid=Yii::$app->user->id;
        $mypage=Micropage::find()->where(['uid'=>$uid])->all();
        $listPage=ArrayHelper::map($mypage, 'id', 'page_title');

        $modules=Module::find()->all();
        $listModules=ArrayHelper::map($modules, 'modulename', 'module_label');

        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $model->save();
                $msg='保存成功！';
            }else{
               $msg=json_encode($model->errors);
            }
            Yii::$app->getSession()->setFlash('success', $msg);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'listPage'=> $listPage,
                'listModules'=>$listModules,
            ]);
        }
    }

    /**
     * Updates an existing Cloud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $uid=Yii::$app->user->id;
        $mypage=Micropage::find()->where(['uid'=>$uid])->all();
        $listPage=ArrayHelper::map($mypage, 'id', 'page_title');

        $modules=Module::find()->all();
        $listModules=ArrayHelper::map($modules, 'modulename', 'module_label');


if($model->load(Yii::$app->request->post())){


    if ( $model->validate()) {
        $modules=$_POST['modules'];
        $modulesSave=['modules'=>$modules];
        $modulesSave=addslashes(json_encode($modulesSave));
        $model->modules=$modulesSave;

        $model->save();
        $msg='保存成功！';

    }else{
        $msg=json_encode($model->errors);
    }
    return $this->redirect(['update', 'id' => $model->id]);

}else{
        return $this->render('update', [
            'model' => $model,
            'listPage'=> $listPage,
            'listModules'=>$listModules,
        ]);
    }



    }


    /**
     * Deletes an existing Cloud model......
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
     * Finds the Cloud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cloud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cloud::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
