<?php
namespace frontend\controllers;
use frontend\models\AntiLog;
use frontend\models\Product;
use Yii;
use common\models\User;
//use frontend\models\Info;
use frontend\models\AntiReply;
use frontend\models\AntiCode;
use frontend\models\AntiCodenew;
use frontend\models\TraceabilityInfonew;
//use frontend\models\AntiCodetable;
//use frontend\models\AntiCodenew;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;



class AntiController extends \yii\web\Controller
{

    public function beforeAction($action)
    {

        if (parent::beforeAction($action)) {
            $Connection = \Yii::$app->db;
            $data = '`tbhome_anti_code_'.\Yii::$app->user->id.'`';
    //        $this->table=$data;
            $moban = '`tbhome_anti_code`';
            $sql = 'CREATE TABLE IF NOT EXISTS '.$data.' LIKE '.$moban;
            $command=$Connection->createCommand($sql);
            $command->execute();
            $logmoban='`tbhome_anti_log`';
            $log='`tbhome_anti_log_'.\Yii::$app->user->id.'`';
            $logsql = 'CREATE TABLE IF NOT EXISTS '.$log.' LIKE '.$logmoban;
            $command=$Connection->createCommand($logsql);
            $command->execute();


            if ($this->enableCsrfValidation && Yii::$app->getErrorHandler()->exception === null && !Yii::$app->getRequest()->validateCsrfToken()) {
                throw new BadRequestHttpException(Yii::t('yii', 'Unable to verify your data submission.'));
            }
            return true;
        }

        return false;
    }

    public $layout='user';
//    public $data;

    public function actionIndex($replyid=1)
    {
        $antireply=new AntiReply();
        $antireply=$antireply::findOne($replyid);
        if (!$antireply || $antireply==null) {$antireply= new AntiReply();};

        return $this->renderPartial(
            'index',
           ['antireply'=>$antireply,'replyid'=>$replyid,]
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
        $model=new AntiCodenew();
        $Connection = Yii::$app->db;
       $uid=Yii::$app->user->id;
        $table='tbhome_anti_code_'.$uid;
		$product=Product::find()->where(['uid'=>$uid])->all();
        $listProduct=ArrayHelper::map($product, 'id', 'name');
        $reply=AntiReply::find()->where(['uid'=>$uid])->all();
        $listReply=ArrayHelper::map($reply, 'id', 'tag');

        if(Yii::$app->request->isPost){
            $idend=intval($_POST['AntiCodenew']['idend']);
            $model->load(Yii::$app->request->post());
            $idstart=intval($model->id);
            $exe=$Connection->createCommand()->update($table, ['prize'=>$model->prize, 'remark'=>$model->remark], "id>=$idstart AND id<=$idend")->execute();
            if($exe){
            $successMsg='成功修改'.$exe.'条数据！';
            Yii::$app->getSession()->setFlash('success', $successMsg);
            return $this->redirect(['anti/modifycode']);
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
        $role=Yii::$app->user->identity->role;
        $product=Product::find()->where(['uid'=>$uid])->all();
        $listData=ArrayHelper::map($product, 'id', 'name');
        $reply=AntiReply::find()->where(['uid'=>$uid])->all();
        $listReply=ArrayHelper::map($reply, 'id', 'tag');




        $model = new AntiCode();
        if (!$listReply){
            Yii::$app->getSession()->setFlash('danger', '回复语未填写！');
            return $this->redirect(['antireply/onereply']);
        }
        if (!$listData){
            Yii::$app->getSession()->setFlash('danger', '请先添加产品！');
            return $this->redirect(['product/index']);
        }


        //>=60质量追溯
        if ($role>=60){
            $traceaInfo='tbhome_traceability_info_'.\Yii::$app->user->id;
            $mobanInfo = 'tbhome_traceability_info';
            $sqlInfo = 'CREATE TABLE IF NOT EXISTS '.$traceaInfo.' LIKE '.$mobanInfo;
            $commandInfo=Yii::$app->db->createCommand($sqlInfo);
            $commandInfo->execute();

            $traceabiliy=TraceabilityInfonew::find()->all();
            $listTraceability=ArrayHelper::map($traceabiliy, 'id', 'label');
            if (!$listTraceability){
                Yii::$app->getSession()->setFlash('danger', '请先添加追溯信息！');
                return $this->redirect(['traceabilityinfo/create']);
            }

        }else{
            $listTraceability=array();
        }


        return $this->render('_form_gencode', [
            'model' => $model,
            'listData'=>$listData,
            'listReply'=>$listReply,
            'listTraceability'=>$listTraceability,
            'role'=>$role,


        ]);
    }


    public function actionPostgencode()
    {
      // require(__DIR__ . '/../assets/phpqrcode/qrlib.php');

        $Connection = \Yii::$app->db;
        $table='tbhome_anti_code_'.Yii::$app->user->id;


        $model = new AntiCode();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                $date=date('Y_m_d_Hms', time());
                $dirPath='Uploads/'.Yii::$app->user->id.'/GenQRcode/'.$date.'/';
                if (!file_exists($dirPath)) {mkdir($dirPath, 0777, true);}
                $traceabilityid=intval($model->traceabilityid) ? intval($model->traceabilityid) : 1;

                $time=time();
                for ($i=0; $i<=(intval($_POST['sNum'])-1); $i++) {
                    $code = $this->random(intval($_POST['slen']), $_POST['rule'], false);
                    $url=Url::to(['/anti/antipage', 'replyid'=>intval($model->replyid), 'productid'=>intval($model->productid), 'code'=>$_POST['sStr'].$code], true);
                    $tableColumn[$i]=[Yii::$app->user->id, $_POST['sStr'].$code, intval($model->productid), intval($model->replyid), $model->prize, $time, 0, 0, 10, $traceabilityid, $url, $model->remark];

   //                 \QRcode::png($url,$dirPath.$_POST['sStr'].$code.'.png','M',6,1);
                }


                $result=$Connection->createCommand()->batchInsert($table, ['uid', 'code', 'productid', 'replyid', 'prize', 'create_time', 'query_time', 'clicks', 'status', 'traceabilityid', 'url', 'remark'], $tableColumn)->execute();
                $logData= AntiCodenew::find()->where(['create_time'=>$time])->all();
              $startid=$logData[0]->id;
                $endid=$logData[intval($_POST['sNum'])-1]->id;
               // var_dump($startid);
                //var_dump($endid);
                $log=new AntiLog();
                $log->time=time();
                $log->startid=$startid;
                $log->endid=$endid;
                $log->remark=$model->remark;
                $log->save();
                if (!$result){echo '数据插入失败！';}
                //$i++;
            }else{echo '数据无效';}
        }

       $successMsg='成功生成'.$_POST['sNum'].'条数据！';

        Yii::$app->getSession()->setFlash('success', $successMsg);
     return $this->redirect(['anti/gencode']);

    }

    public function actionCheckstr(){
        header('Content-Type:text/html;charset=UTF-8');
        $uid=Yii::$app->user->id;
        $sStr = $_POST['sStr'];
        $connection=Yii::$app->db;
        $table='tbhome_anti_code_'.$uid;
        $sql = "SELECT COUNT(*) FROM ".$table." where code LIKE '".$sStr."%'";
        $command = $connection->createCommand($sql);
        $rows=$command->queryScalar();
        //var_dump($rows);
echo $rows;


//        if (!empty($list)) {
  //          echo count($list);
    //    }else{
      //      echo '0';
      //  }



    }

    protected function codeQuery($code='798904845', $replyid=1){
    //    header('Content-Type:text/html;charset=UTF-8');
        $connection=Yii::$app->db;
        $reply=AntiReply::findOne($replyid);
        $uid=$reply->uid;
        $table='tbhome_anti_code_'.$uid;

        $sql="SELECT * FROM ".$table." WHERE code='".$code."'";
        $command = $connection->createCommand($sql);
        $codeData=$command->queryOne();//返回数组，表anti_code_uid
        if (!$codeData){
            $reply=AntiReply::findOne($replyid);
            $queryReply=$reply->fail;
            return $queryReply;
        }else{
            $productid=$codeData['productid'];
            $reply=AntiReply::findOne($replyid);
            $product=Product::findOne($productid);

            $tabletracea='tbhome_traceability_info_'.$uid;
            $ta=Yii::$app->db->createCommand("SHOW TABLES LIKE '".$tabletracea."'")->queryAll();
            $productImage=Html::img($product->image);
////////////////////////////////////追溯信息start

            if($ta==null){
                $traceaReply='';
            }else{
                $traceabilityid=$codeData['traceabilityid'];
                if($traceabilityid){
                    $sqltracea="SELECT * FROM ".$tabletracea." WHERE id=".intval($traceabilityid);
                    $commandtracea = $connection->createCommand($sqltracea);
                    $traceabilityinfo=$commandtracea->queryOne();
                        if ($traceabilityinfo){

                        $describe=$traceabilityinfo['describe'];

                            //     $productImage='<img src="'.$product->image.'" >';
                        $traceaReply=str_replace([
                            '{{点击量}}', '{{生产备注}}', '{{产品厂家}}', '{{产品名称}}', '{{产品品牌}}', '{{产品规格}}', '{{产品价格}}', '{{产品图片}}', '{{产品详情}}', '{{计量单位}}',
                        ], [
                            $codeData['clicks'], $codeData['remark'], $product->factory, $product->name, $product->brand, $product->specification, $product->price, $productImage, $product->describe, $product->unit,
                        ], $describe);
                    }else{
                        $traceaReply='';
                    }

                }else{$traceaReply='';}//$codeData['traceabilityid']==0

            }
////////////////////////////////////追溯信息end

            $userip=get_client_ip();
            $clicks=intval($codeData['clicks']);
            Yii::$app->db->createCommand()->update($table, ['clicks' => $clicks+1, 'query_area'=>$userip, 'query_time'=>time()], "code ='".$code."'")->execute();

            $query_time=date('Y/m/d  H:m:s', $codeData['query_time']);
            if ($codeData['query_time']==0){$query_time='现为首次查询';}

//查询地区
            $userArea=($codeData['query_area']=='0.0.0.0') ? '无' : get_ip_data($codeData['query_area']);

            $diypage=$reply->content;

            $urlval=Url::to(['anti/antipage', 'code'=>$code, 'replyid'=>$replyid, 'productid'=>$productid], true);
            $src=genqrcode($urlval);
            $qrcodeimg= Html::img($src, ['width'=>'100px']);

            $reply->success=str_replace([
                '{{防伪码}}', '{{查询次数}}', '{{生产备注}}', '{{奖品}}', '{{查询时间}}', '{{产品厂家}}', '{{产品名称}}', '{{产品品牌}}', '{{产品规格}}', '{{产品价格}}', '{{产品图片}}', '{{产品详情}}', '{{计量单位}}', '{{追溯信息}}', '{{自定义网页}}', '{{二维码}}', '{{地区}}'
            ], [
                $code, $codeData['clicks'], $codeData['remark'], $codeData['prize'], $query_time, $product->factory, $product->name, $product->brand, $product->specification, $product->price, $productImage, $product->describe, $product->unit, $traceaReply, $diypage, $qrcodeimg, $userArea
            ], $reply->success);

            $reply->fail=str_replace([
                '{{防伪码}}', '{{查询次数}}', '{{生产备注}}', '{{奖品}}', '{{查询时间}}', '{{产品厂家}}', '{{产品名称}}', '{{产品品牌}}', '{{产品规格}}', '{{产品价格}}', '{{产品图片}}', '{{产品详情}}', '{{计量单位}}', '{{追溯信息}}', '{{自定义网页}}'
            ], [
                $code, $codeData['clicks'], $codeData['remark'], $codeData['prize'], $query_time, $product->factory, $product->name, $product->brand, $product->specification, $product->price, $productImage, $product->describe, $product->unit, $traceaReply,  $diypage
            ], $reply->fail);

            $validClicks=$reply->valid_clicks;
            if ($codeData['clicks']>=$validClicks){
                $queryResult=$reply->fail;
                return $queryResult;
            }else{
                $queryResult=$reply->success;
                return $queryResult;
            }

        }

    }

    public function actionAntipage($code='798904845', $replyid=1 )
    {
    //    header('Content-Type:text/html;charset=UTF-8');

        $queryResult=$this->codeQuery($code, $replyid);
        $reply=AntiReply::findOne($replyid);
        return $this->renderPartial(
            'antipage',
            [
                'antireply'=>$reply,
                'queryResult'=>$queryResult,
            ]
        );



    }


    public function actionAntiquery()
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














}
