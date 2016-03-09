<?php

namespace frontend\modules\qrcode\controllers;

use Yii;
use frontend\modules\qrcode\models\QrcodeReply;
use frontend\modules\qrcode\models\QrcodeReplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QrcodereplyController implements the CRUD actions for QrcodeReply model.
 */
class QrcodereplyController extends Controller
{
    public $layout='@frontend/views/layouts/user';
    /**
     * Lists all QrcodeReply models.
     * @return mixed
     */
    public function actionIndex()
    {
   //     $role=Yii::$app->user->identity->role;
   //     if ($role<50){return $this->goBack(['user/Qrcode']);}

        $searchModel = new QrcodeReplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QrcodeReply model.
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
     * Creates a new QrcodeReply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new QrcodeReply();
        $uid=Yii::$app->user->id;
        $model->uid=$uid;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function  actionOnereply()
    {

        $uid=Yii::$app->user->id;
        $qrcodereply = QrcodeReply::find()->where(['uid' => $uid])->all();

        if ($qrcodereply == null) {
            $model = new QrcodeReply();
            $model->uid = $uid;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        $model=$qrcodereply[0];
        $model->uid = $uid;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //  return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Updates an existing QrcodeReply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing QrcodeReply model.
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
     * Finds the QrcodeReply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QrcodeReply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QrcodeReply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
