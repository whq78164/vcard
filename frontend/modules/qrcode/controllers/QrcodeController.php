<?php
namespace frontend\modules\qrcode\controllers;
use frontend\modules\qrcode\models\QrcodeLog;
use frontend\models\Product;
use Yii;
use common\models\User;
use frontend\modules\qrcode\models\QrcodeReply;
use frontend\modules\qrcode\models\QrcodeData;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\db\Schema;



class QrcodeController extends \yii\web\Controller
{
    protected function tableExist($table){//不支持前缀。故而{{%table}}无效！
        $Prefix=Yii::$app->db->tablePrefix;
        $table=str_replace(['{{%', '}}'],[$Prefix, ''],$table);
        $sql="SHOW TABLES LIKE '".$table."'";
        //     $sql="SHOW TABLE LIKE $table";
        //   $sql="SELECT COUNT(*) FROM $table";
        //  $sql="SHOW TABLES LIKE $table";
        $ta=\Yii::$app->db->createCommand($sql)->queryOne();

        if(!$ta){
            return false;
        }else {
            return true;
            //echo $table."数据表已存在，已跳过。</br>";
        }
    }


    public function init(){
 //       parent::init();

        $uid=Yii::$app->user->id;
        $table='tbhome_qrcode_data_'.$uid;
        $ta=$this->tableExist($table);
        if(!$ta){

            $Connection = \Yii::$app->db;
            $uid=Yii::$app->user->id;

            $data = '`tbhome_qrcode_data_'.$uid.'`';
            $moban = '`tbhome_qrcode_data`';
            $sql = 'CREATE TABLE IF NOT EXISTS '.$data.' LIKE '.$moban;
            $command=$Connection->createCommand($sql);
            $command->execute();

            $logmoban='`tbhome_qrcode_log`';
            $log='`tbhome_qrcode_log_'.$uid.'`';
            $logsql = 'CREATE TABLE IF NOT EXISTS '.$log.' LIKE '.$logmoban;
            $command=$Connection->createCommand($logsql);
            $command->execute();
        }

    }


    public $layout='@frontend/views/layouts/user';


    protected function addColumn($table, $column, $type){

        $sql="Describe $table $column";
        $con=Yii::$app->db->createCommand($sql)->queryOne();
        if($con['Field']==null){
            Yii::$app->db->createCommand()->addColumn($table, $column, $type)->execute();
        }

}

    public function actionIndex($replyid=1)
    {
     //   $qrcodereply=new QrcodeReply();
        $qrcodereply=QrcodeReply::findOne($replyid);
        if (!$qrcodereply || $qrcodereply==null) {$qrcodereply= new QrcodeReply();};

        return $this->renderPartial(
            'index',
           [
               'qrcodereply'=>$qrcodereply,
               'replyid'=>$replyid,
           ]
        );

    }

    public function random($length, $type = NULL, $special = FALSE){
        $str = "";
        switch ($type) {
            case 1:
                $str = "0123456789";
                break;
            case 2:
                $str = "abcdefghijklmnopqrstuvwxyz";
                break;
            case 3:
                $str = "abcdefghijklmnopqrstuvwxyz0123456789";
                break;
            default:
                $str = "abcdefghijklmnopqrstuvwxyz0123456789";
                break;
        }
        return substr(str_shuffle(($special != FALSE) ? '!@#$%^&*()_+' . $str : $str), 0, $length);
    }

    public function actionModifycode(){
        $model=new QrcodeData();
        $Connection = Yii::$app->db;
       $uid=Yii::$app->user->id;
        $table='tbhome_qrcode_data_'.$uid;
		$product=Product::find()->where(['uid'=>$uid])->all();
        $listProduct=ArrayHelper::map($product, 'id', 'name');
        $reply=QrcodeReply::find()->where(['uid'=>$uid])->all();
        $listReply=ArrayHelper::map($reply, 'id', 'tag');

        if(Yii::$app->request->isPost){

            $idend=intval($_POST['QrcodeData']['idend']);
            $model->load(Yii::$app->request->post());
            $idstart=intval($model->id);

            $updateColumn=[
                'prize'=>$model->prize,
                'remark'=>$model->remark,
                'replyid'=>$model->replyid,
                'productid'=>$model->productid,
            ];

            if (!empty($model->dataColumns())){
                $Mycolumn=$model->dataColumns();
                $addColumn=array();
                foreach($Mycolumn as $key => $value){
                    $tempAddColumn=[$key=>$model->$key];
                    $addColumn=array_merge($addColumn,$tempAddColumn);
                }
                $updateColumn=array_merge($updateColumn,$addColumn);
            }


            $exe=$Connection->createCommand()->update($table, $updateColumn, "id>=$idstart AND id<=$idend")->execute();


            if($exe){
            $successMsg='成功修改'.$exe.'条数据！';
            Yii::$app->getSession()->setFlash('success', $successMsg);
            return $this->redirect(['qrcode/modifycode']);
            }else{
                Yii::$app->getSession()->setFlash('success', '数据未修改，修改失败！');
                return $this->redirect(['qrcode/modifycode']);
            }

        }else{
 return $this->render('_form_modifycode', [
            'model' => $model,
			 'listProduct'=>$listProduct,
            'listReply'=>$listReply,
]);
        }
    }

    public function actionGencode()
    {

        $uid=Yii::$app->user->id;
        $product=Product::find()->where(['uid'=>$uid])->all();
        $listData1=ArrayHelper::map($product, 'id', 'name');
        $listData2=ArrayHelper::map($product, 'id', 'specification');
        $listData=array();
        foreach($listData1 as $key1=>$value1){

            $listData[$key1]=$value1.' '.$listData2[$key1];
        }



        $reply=QrcodeReply::find()->where(['uid'=>$uid])->all();
        $listReply=ArrayHelper::map($reply, 'id', 'tag');




        $model = new QrcodeData();
        if (!$listReply){
            Yii::$app->getSession()->setFlash('danger', '回复语未填写！');
            return $this->redirect(['qrcodereply/onereply']);
        }
        if (!$listData){
            Yii::$app->getSession()->setFlash('danger', '请先添加产品！');
            return $this->redirect(['product/index']);
        }



        return $this->render('_form_gencode', [
            'model' => $model,
            'listData'=>$listData,
            'listReply'=>$listReply,

        ]);
    }


    public function actionPostgencode()
    {
      // require(__DIR__ . '/../assets/phpqrcode/qrlib.php');

        $Connection = \Yii::$app->db;
        $table='tbhome_qrcode_data_'.Yii::$app->user->id;


        $model = new QrcodeData();
        if ($model->load(Yii::$app->request->post())) {
        //    print_r($model);
            $uid=Yii::$app->user->id;

            $productid= intval($model->productid)? intval($model->productid) : 1;
            $replyid= intval($model->replyid)? intval($model->replyid) : 1;

            $create_time=time();
            $prize =  isset($model->prize) ? $model->prize : '';
            $remark =  isset($model->remark) ? $model->remark : '';


            $insertColumn=[
                'uid',
                'code',
                'productid',
                'replyid',
                'prize',
                'create_time',
                'query_time',
                'clicks',
                'status',
                'url',
                'remark'
            ];

            if (!empty($model->dataColumns())){
                $Mycolumn=$model->dataColumns();

                foreach($Mycolumn as $key => $value){
                    $diyColumn[]=$key;
                    $insertValue[]=isset($model->$key) ? $model->$key : '';
                }

                $insertColumn=array_merge($insertColumn,$diyColumn);

        //        print_r($insertColumn);
          //      print_r($insertValue);

            }







            //'query_time', 'clicks', 'status', 'traceabilityid', 'url', 'remark'

      //      if ($model->validate()) {

                $date=date('Y_m_d_Hms', time());
                $dirPath='Uploads/'.Yii::$app->user->id.'/GenQRcode/'.$date.'/';
                if (!file_exists($dirPath)) {mkdir($dirPath, 0777, true);}

                $tableColumn=array();
                for ($i=0; $i<=(intval($_POST['sNum'])-1); $i++) {
                    $code = $this->random(intval($_POST['slen']), $_POST['rule'], false);
                    $url=Url::to([
                        '/qrcode/qrcode/qrcodepage',
                        'replyid'=>$replyid,
                  //      'productid'=>intval($model->productid),
                        'code'=>$_POST['sStr'].$code
                    ], true);

                    $tableColumn[$i]=[
                        $uid,
                        $_POST['sStr'].$code,
                        $productid,
                        $replyid,
                        $prize,
                        $create_time,
                        0,//querytime
                        0,//clicks
                        10,//status
                        $url,
                        $remark
                    ];

                    $tableColumn[$i]=array_merge($tableColumn[$i],$insertValue);

                }


            $result=$Connection->createCommand()->batchInsert($table, $insertColumn, $tableColumn)->execute();


                if (!$result){
                    $Msg='数据插入失败！';
                    //$i++;
                }else{
                    $Msg='成功生成'.$_POST['sNum'].'条数据！';
                }



                $logData= QrcodeData::find()->where(['create_time'=>$create_time])->all();
              $startid=$logData[0]->id;
                $endid=$logData[intval($_POST['sNum'])-1]->id;
               // var_dump($startid);
                //var_dump($endid);
                $log=new QrcodeLog();
                $log->time=time();
                $log->startid=$startid;
                $log->endid=$endid;
                $log->remark=$model->remark;
                $log->save();



  //     }else{
   //             $Msg='数据无效！';
   //         }
         //   Yii::$app->session->setFlash('danger', '数据未设置');
         //
        }else{
           $Msg='数据未设置';
        }
      Yii::$app->session->setFlash('info', $Msg);


 return $this->redirect(['qrcode/gencode']);

    }

    public function actionCheckstr(){
        header('Content-Type:text/html;charset=UTF-8');
        $uid=Yii::$app->user->id;
        $sStr = $_POST['sStr'];
        $connection=Yii::$app->db;
        $table='tbhome_qrcode_data_'.$uid;
        $sql = "SELECT COUNT(*) FROM ".$table." where code = '".$sStr."'";
        $command = $connection->createCommand($sql);
        $rows=$command->queryScalar();
        //var_dump($rows);
echo $rows;


    }

    protected function codeQuery($code='798904845', $replyid=1){
    //    header('Content-Type:text/html;charset=UTF-8');
        $connection=Yii::$app->db;
        $reply=QrcodeReply::findOne($replyid);
        $uid=$reply->uid;
        $table='tbhome_qrcode_data_'.$uid;

        $sql="SELECT * FROM ".$table." WHERE code='".$code."'";
        $command = $connection->createCommand($sql);
        $codeData=$command->queryOne();//返回数组，表qrcode_data_uid
        if (!$codeData){
            $reply=QrcodeReply::findOne($replyid);
            $queryReply=$reply->fail;
            return $queryReply;
        }else{
            $productid=$codeData['productid'];
            $reply=QrcodeReply::findOne($replyid);
            $product=Product::findOne($productid);

      //      $tabletracea='tbhome_traceability_info_'.$uid;
        //    $ta=Yii::$app->db->createCommand("SHOW TABLES LIKE '".$tabletracea."'")->queryAll();
            $productImage=Html::img($product->image);

            $userip=get_client_ip();
            $clicks=intval($codeData['clicks']);
            Yii::$app->db->createCommand()->update($table, ['clicks' => $clicks+1, 'query_area'=>$userip, 'query_time'=>time()], "code ='".$code."'")->execute();

            $query_time=date('Y/m/d  H:m:s', $codeData['query_time']);
            if ($codeData['query_time']==0){$query_time='现为首次查询';}


            $userArea=($codeData['query_area']=='0.0.0.0') ? '无' : get_ip_data($codeData['query_area']);//查询地区

            $diypage=$reply->content;//自定义网页

            $urlval=Url::to([
                'qrcode/qrcode/qrcodepage',
                'code'=>$code,
                'replyid'=>$replyid,
            //    'productid'=>$productid
            ], true);
            $src=genqrcode($urlval);
            $qrcodeimg= Html::img($src, ['width'=>'100px']);//查询结果页的二维码图片


          //  $model = QrcodeData::findOne(['code'=>$code]);
            $remarkform=$this->renderPartial('_remarkform', [
                'codeData' => $codeData,
                'replyid' =>$replyid
            ]);//备注字段修改





            $sql="SELECT * FROM {{%column}} WHERE uid=$uid AND type='qrcode'";
            $qrcodeColumns=Yii::$app->db->createCommand($sql)->queryAll();

            if (!empty($qrcodeColumns)) {
                $diyColumns = array();
                $replaceDiyColumns=array();
                foreach ($qrcodeColumns as $key => $value) {//$qrcodeColumns as $qrcodeColumn
                    $tempLabel='{{'.$value['label'].'}}';
                    $diyColumns[]=$tempLabel;//或array_merge
                    $tempColumn=isset($codeData[$value['column']]) ? $codeData[$value['column']] : '';
                    $replaceDiyColumns[]=$tempColumn;
                }

            }else{
                $diyColumns = array();
                $replaceDiyColumns=array();
            }


                $inputArr=[
                '{{防伪码}}', '{{查询次数}}', '{{生产备注}}', '{{奖品}}', '{{查询时间}}', '{{产品厂家}}', '{{产品名称}}', '{{产品品牌}}', '{{产品规格}}', '{{产品价格}}', '{{产品图片}}', '{{产品详情}}', '{{计量单位}}', '{{自定义网页}}', '{{二维码}}', '{{地区}}','{{修改备注}}'
            ];
        //    $inputArr[]=$diyColumns;
            //$inputArr=$inputArr+$diyColumns;
            $inputArr=array_merge($inputArr,$diyColumns);


            $replaceArr=[
                $code, $codeData['clicks'], $codeData['remark'], $codeData['prize'], $query_time, $product->factory, $product->name, $product->brand, $product->specification, $product->price, $productImage, $product->describe, $product->unit,  $diypage, $qrcodeimg, $userArea, $remarkform
            ];
            $replaceArr=array_merge($replaceArr,$replaceDiyColumns);;

         //   print_r($inputArr);

            $reply->success=str_replace($inputArr, $replaceArr, $reply->success);


           /////////////////////查询失败回复语
            $reply->fail=str_replace([
                '{{防伪码}}', '{{查询次数}}', '{{生产备注}}', '{{奖品}}', '{{查询时间}}', '{{产品厂家}}', '{{产品名称}}', '{{产品品牌}}', '{{产品规格}}', '{{产品价格}}', '{{产品图片}}', '{{产品详情}}', '{{计量单位}}', '{{自定义网页}}'
            ], [
                $code, $codeData['clicks'], $codeData['remark'], $codeData['prize'], $query_time, $product->factory, $product->name, $product->brand, $product->specification, $product->price, $productImage, $product->describe, $product->unit,  $diypage
            ], $reply->fail);
             /////////////////////查询失败回复语

            $validClicks=$reply->valid_clicks;
            if ($codeData['clicks']>=$validClicks){
                $queryResult=$reply->fail;
                return $queryResult;
            }else{
             //   $reply->success .= $tempform;
                $queryResult=$reply->success;
                return $queryResult;
            }


        }

    }




    public function actionQrcodepage($code='798904845', $replyid=1 )
    {
    //    header('Content-Type:text/html;charset=UTF-8');

        $queryResult=$this->codeQuery($code, $replyid);
        $reply=QrcodeReply::findOne($replyid);
        return $this->renderPartial(
            'qrcodepage',
            [
                'qrcodereply'=>$reply,
                'queryResult'=>$queryResult,
            ]
        );


    }


    public function actionQrcodequery()
    {
        header('Content-Type:text/html;charset=UTF-8');

        $securityCode=$_POST['FWcode'];//echo $FWcode; 只能传递数字类型的数据
  //      $uid=intval($_POST['FWuid']);
        $replyid = intval($_POST['replyid']);//回复语

        $queryResult=$this->codeQuery($securityCode, $replyid);
        echo '<div class="" >';
        echo $queryResult;
        echo '</div>';
    }


    public function actionUpdateremark($id, $replyid)
    {
        $remark=trim($_POST['remark']);

        $reply=QrcodeReply::findOne($replyid);
        $uid=$reply->uid;
        $table='tbhome_qrcode_data_'.$uid;

        $connection=Yii::$app->db;
        $result=$connection->createCommand()->update($table, [
            'remark' => $remark,
        ],
            "id =".$id)->execute();

        //       $model->uid=Yii::$app->user->id;
        if ($result) {
            Yii::$app->getSession()->setFlash('success', '谢谢！已收到您的提交！');
            return   $this->goBack(\Yii::$app->request->headers['Referer']);
        } else {
            Yii::$app->getSession()->setFlash('danger', '提交失败，请稍后再试！');
            return   $this->goBack(\Yii::$app->request->headers['Referer']);
        }
    }





}
