<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Wechatgh;
use frontend\models\WechatghSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WechatghController implements the CRUD actions for Wechatgh model.
 */

class WechatghController extends Controller
{
  public  $layout='user';
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
     * Lists all Wechatgh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WechatghSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wechatgh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    private function createNonceStr($length = 25) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }





    /**
     * Creates a new Wechatgh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $uid=Yii::$app->user->id;
        $modelwechat=Wechatgh::findAll(['uid'=>$uid]);
        if (count($modelwechat)>=1){
            Yii::$app->getSession()->setFlash('danger', '您的账户只能创建一个公众号！');
            return $this->redirect(['index']);
        }else{
            $model = new Wechatgh();
            $model->uid=$uid;
            $model->token=$this->createNonceStr();
            $model->aeskey=$this->createNonceStr(60);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', '设置成功！');
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        }

    }

    /**
     * Updates an existing Wechatgh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uid=Yii::$app->user->id;


        if($model->load(Yii::$app->request->post())){
            $model->uid=$uid;
            $model->save();
            if($model->save()){
                Yii::$app->getSession()->setFlash('success', '设置成功！');
                return $this->redirect(['index']);
            }else{
                Yii::$app->getSession()->setFlash('danger', '设置失败，请稍后重试！');
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Wechatgh model.
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
     * Finds the Wechatgh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wechatgh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wechatgh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTest(){
        $uid=Yii::$app->user->id;
        $res=Wechatgh::findOne(['uid'=>$uid]);
       // var_dump($res);
        echo $res->name;
    }
}
