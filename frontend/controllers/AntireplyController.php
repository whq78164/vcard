<?php

namespace frontend\controllers;

use Yii;
use frontend\models\AntiReply;
use frontend\models\AntireplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AntireplyController implements the CRUD actions for AntiReply model.
 */
class AntireplyController extends Controller
{
    public $layout= 'user';
    /**
     * Lists all AntiReply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $role=Yii::$app->user->identity->role;
        if ($role<50){return $this->goBack(['user/anti']);}
        $searchModel = new AntireplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AntiReply model.
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
     * Creates a new AntiReply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $Connection = \Yii::$app->db;
        $sql = "ALTER TABLE  tbhome_anti_reply CHANGE success success text";
        $command=$Connection->createCommand($sql);
        $command->execute();

        $model = new AntiReply();
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
        $Connection = \Yii::$app->db;
        $sql = "ALTER TABLE  tbhome_anti_reply CHANGE success success text";
        $command=$Connection->createCommand($sql);
        $command->execute();

        $uid=Yii::$app->user->id;
        $antireply = AntiReply::find()->where(['uid' => $uid])->all();

        if ($antireply == null) {
            $model = new AntiReply();
            $model->uid = $uid;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        $model=$antireply[0];
        $model->uid = $uid;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Updates an existing AntiReply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $Connection = \Yii::$app->db;
        $sql = "ALTER TABLE  tbhome_anti_reply CHANGE success success text";
        $command=$Connection->createCommand($sql);
        $command->execute();

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
     * Deletes an existing AntiReply model.
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
     * Finds the AntiReply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AntiReply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AntiReply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
