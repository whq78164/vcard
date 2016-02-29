<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Product;
use frontend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Upload;
use yii\web\UploadedFile;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public $layout='user';

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $uid=Yii::$app->user->id;
        $model->uid = $uid;
        $image=new Upload();

        if ($model->load(Yii::$app->request->post()) ) {
            if($model->price==null) $model->price=0;
            if($model->image==null) $model->image='Uploads/default_face.jpg';
            if($model->traceability==null) $model->traceability=1;
            if($model->hot==null) $model->hot=1;

			$model->save();
                    Yii::$app->getSession()->setFlash('success', '保存成功！');
                    return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
               'image'=>$image,
            ]);
        }
    }




    public function actionNewupload(){
        $con=Yii::$app->getDb();
        $sql="SELECT max(id) FROM tbhome_product";
        $command = $con->createCommand($sql);
        $codeData=$command->queryScalar();//返回数组，表anti_code_uid
        $id=$codeData+1;

        $image = new Upload();
        $uid = Yii::$app->user->id;

        if (Yii::$app->request->isPost) {
            $productid=$id;
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');//上传!
            $filename = 'product_'.$productid .'_'. time();
            $dir = 'Uploads/'.$uid.'/products/';
            //     if (!file_exists($dir)) mkdir($dir, true);//is_dir
            if ($image->upload($filename, $dir)) {//新建目录和文件信息保存！
                // 文件上传成功
                $url = $dir. $filename . '.' . $image->imageFile->extension;
                $product = new Product();
                $product->id = $productid;
                $product->uid=$uid;
                $product->image = $url;
                $product->save();
                Yii::$app->getSession()->setFlash('success', '上传成功！');
                return $this->redirect(['product/update', 'id'=>$id]);
            } else {
                Yii::$app->getSession()->setFlash('danger', '上传失败！');
                return $this->redirect(['user']);
            }

        }




    }


    public function actionUpload()
    {
        $image = new Upload();
        $uid = Yii::$app->user->id;

        if (Yii::$app->request->isPost) {
           // $model->load(Yii::$app->request->post());
            $id=$_POST['id'];
            $productid=$id;

            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');//上传!
            $filename = 'product_'.$productid .'_'. time();
            $dir = 'Uploads/'.$uid.'/products/';
            //     if (!file_exists($dir)) mkdir($dir, true);//is_dir
            if ($image->upload($filename, $dir)) {//新建目录和文件信息保存！
                // 文件上传成功
                $url = $dir. $filename . '.' . $image->imageFile->extension;
                $product = Product::findOne($productid);
                $product->id = $productid;
                $product->image = $url;
                $product->save();
                Yii::$app->getSession()->setFlash('success', '上传成功！');
                return $this->redirect(['product/update', 'id'=>$id]);
            } else {
                Yii::$app->getSession()->setFlash('danger', '上传失败！');
                return $this->redirect(['user']);
            }

        }
    }



    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image= new Upload();
        $request=Yii::$app->request;
        if ($request->isPost) {
                $model->load($request->post());

                if($model->save()){
                    Yii::$app->getSession()->setFlash('success', '保存成功！');
                             return $this->redirect(['view', 'id'=>$model->id]);

                }else{
                    Yii::$app->getSession()->setFlash('danger', '保存失败！');
                    return $this->redirect(['product/update', 'id'=>$model->id]);
                }

        } else {
            return $this->render('update', [
                'model' => $model,
                'image'=>$image,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
