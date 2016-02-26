<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Usermodule;
use frontend\models\UsermoduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use frontend\models\Module;
use common\models\User;

/**
 * UsermoduleController implements the CRUD actions for Usermodule model.
 */
class UsermoduleController extends Controller
{
    public $layout='admin';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //   'only' => ['logout', 'signup'],
                'rules' => [

                    // 允许认证用户

                    // 默认禁止其他用户
                    [//   'actions' => ['index','update','logout',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usermodule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsermoduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $users=User::find()->where('role>10')->all();
        $listUsers=ArrayHelper::map($users, 'uid', 'username');
        $listUsers['']='全部';
      //  $listUsers[]=[''=>'全部用户'];

        $allModules = Module::find()->all();
        $listModules=ArrayHelper::map($allModules, 'id', 'module_label');
        $listModules['']='全部模块';


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listUsers'=> $listUsers,
             'listModules' => $listModules,
        ]);
    }

    /**
     * Displays a single Usermodule model.
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
     * Creates a new Usermodule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $allModules = Module::find()->all();
        $listModules=ArrayHelper::map($allModules, 'id', 'module_label');

        $users=User::find()->where('role>10')->all();
        $listUsers=ArrayHelper::map($users, 'uid', 'username');

        $model = new Usermodule();



        if ($model->load(Yii::$app->request->post())) {
            $userModuleExist=Usermodule::findOne(['uid'=>$model->uid, 'moduleid'=>$model->moduleid]);

            if ($userModuleExist){
                Yii::$app->getSession()->setFlash('warning', '用户模块已使用,请勿重复创建');
               // return $this->goBack(['/usermodule/index']);
                return $this->refresh();
            }else{
                Yii::$app->getSession()->setFlash('info', '创建成功');
                   $model->save();
                  return $this->redirect(['view', 'id' => $model->id]);

            }


        } else {
            return $this->render('create', [
                'model' => $model,
                'listModules' => $listModules,
                'listUsers'=> $listUsers
            ]);
        }
    }

    /**
     * Updates an existing Usermodule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $allModules = Module::find()->all();
        $listModules=ArrayHelper::map($allModules, 'id', 'module_label');

        $users=User::find()->where('role>10')->all();
        $listUsers=ArrayHelper::map($users, 'uid', 'username');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'listModules' => $listModules,
                'listUsers'=> $listUsers
            ]);
        }
    }

    /**
     * Deletes an existing Usermodule model.
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
     * Finds the Usermodule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usermodule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usermodule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
