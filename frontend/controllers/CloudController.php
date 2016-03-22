<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Site;
use frontend\models\Cloud;
use frontend\models\Micropage;
use common\models\User;

class CloudController extends \yii\web\Controller
{
    public $enableCsrfValidation=false;

    public function actionIndex()
    {


        if ($_SERVER['REQUEST_METHOD']=='GET'){

            $model=Cloud::findOne(['ip'=>$_SERVER['REMOTE_ADDR']]);//->attributes;
            if ($model==null){
                $Site['role']='免费用户(未注册，不可使用)';
                $Site['welcome']='<div class="alert alert-danger">首次使用，请设置您的站点信息！站点注册成功后，将成为免费用户。可免费试用和学习。未经许可的商业运营，我们不保证其稳定性，由此造成的运营数据损失等可能风险，请自行承担。如需商业化运营，请购买商业授权。我们将提供永久更新和售后支持。QQ：798904845。</div>';
                $Site['sitetitle']='唯卡微名片用户管理中心';
                $Site['tel']='15980016080';
                $Site['qq']='798904845';
                $Site['email']='798904845@qq.cm';
                $Site['siteurl']='http://www.vcards.top';
                $Site['ip']='';
                $Site['status']=9;
                $Site['copyright']='通宝科技';
                $Site['icp']='';
             //   $model=$Site;
                $Site['update']='您的产品不支持更新';
                $Site['page1']='您的站点是主控站';
                $Site['msg']='请先登录系统管理员后台，设置站点信息！';

//return $Site;
               return json_encode($Site);
            }else{
                //               $model= new Cloud();
                //             $model=$model->findOne(['ip'=>$_SERVER['REMOTE_ADDR']]);//->attributes;
                $model=Cloud::findOne(['ip'=>$_SERVER['REMOTE_ADDR']])->attributes;
                $pageid1=$model['pageid1'];
                $pageid2=$model['pageid2'];
                $page1=Micropage::findOne($pageid1);
                $page2=Micropage::findOne($pageid2);
                $model['page1']=$page1->page_content;

                switch($model['status']){
                    case 0 :  $model['msg']='该网站已被冻结！请联系官方人员解冻：QQ：798904845';
                        break;
                    case 9 :  $model['msg']='请先登录系统管理员后台，设置站点信息！';
                        break;
                    case 10 :
                        $model['role']='免费用户';
                        $model['welcome']='<div class="alert alert-info">恭喜！<br/>您的产品已可正常使用。<br/>如需商业化运营，请购买授权，获得商业运营支持。<br/>唯卡微名片系列产品，自动为每一位注册用户创建产品宣传和快速通讯的微网页，是以微名片CRM客户管理系统为核心，以满足特殊需求，定制扩展的开源项目。<br/>使用过程有任何疑问或建议。请随时反馈！如需特殊定制服务和程序设计开发，请联系我们。</div>';
                        break;
                    case 20 : $model['role']='微名片商业用户';
                        break;
                    case 30 : $model['role']='微防伪(基础)商业用户';
                        break;
                    case 40 : $model['role']='微防伪(高级)商业用户';
                        break;
                }

                $model['update']=$page2->page_content;




                return json_encode($model);
            }



        }


    }

    public function actionSite()
    {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $model=Cloud::findOne(['ip'=>$_SERVER['REMOTE_ADDR']]);
            if(!$model){$model=new Cloud();}
            //   $model=$model?$model:$modelnew;

            $model->company=$_POST['Site']['company'];
            $model->sitetitle=$_POST['Site'][ 'sitetitle'];
            $model->tel= $_POST['Site']['tel'];
            $model->qq=$_POST['Site']['qq'];
            $model->email=$_POST['Site']['email'];
            $model->siteurl=$_POST['Site']['siteurl'];
            $model->copyright=$_POST['Site']['copyright'];
            $model->icp=$_POST['Site']['icp'];
            $model->ip=$_SERVER['REMOTE_ADDR'];
            $model->server_name=isset($_SERVER["REMOTE_HOST"])?$_SERVER["REMOTE_HOST"]:'localhost';

            if ($model->validate()) {

                if($model->save()){

                    echo '站点设置成功！';
                }else{
                    echo '保存失败，请稍后再试';
                }

            }else{
                $error=$model->errors;
                $roror=json_encode($error);
                echo $roror.'注册失败，请检查输入是否正确！';
            }
        }



        if ($_SERVER['REQUEST_METHOD']=='GET'){

            $model=Cloud::findOne(['ip'=>$_SERVER['REMOTE_ADDR']]);//->attributes;
            if ($model==null){
                $Site['company']='泉州通宝科技';
                $Site['sitetitle']='唯卡微名片用户管理系统';
                $Site['tel']='';
                $Site['qq']='798904845';
                $Site['email']='798904845@qq.cm';
                $Site['siteurl']='http://www.vcards.top';
                $Site['copyright']='唯卡微名片© by 通宝科技 2015';
                $Site['icp']='';
                $Site['ip']=$_SERVER['REMOTE_ADDR'];
                $model=$Site;
            }else{
                $model=Cloud::findOne(['ip'=>$_SERVER['REMOTE_ADDR']])->attributes;
            }
            return json_encode($model);

        }




    }




}






