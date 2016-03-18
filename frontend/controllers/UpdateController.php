<?php

namespace frontend\controllers;
use Yii;
use yii\db\Schema;

class UpdateController extends DbController
{
    public $layout='user';

    public function init(){
        parent::init();
        if(Yii::$app->user->identity->role!==100){
            Yii::$app->session->setFlash('danger', '您不是管理员！');
            $this->redirect(['/user/index']);
        }
    }

    public function actionIndex(){
        header('Content-Type:text/html;charset=UTF-8');


        if(Yii::$app->request->isPost){
            $table='sys';
            $sql="SELECT * FROM {{%$table}} WHERE id=1";
            $sys=Yii::$app->db->createCommand($sql)->queryOne();

            if(!isset($sys['version'])){
                //        $this->renameColumn('{{%usermodule}}', 'module_satus', 'module_status');

                $frontend=Yii::getAlias('@frontend');
                require $frontend.'/update.php';


            }elseif($sys['version']==1.10){
                //$version=
                echo '您的系统已升级成功！版本：1.10，请勿重复升级！';
            }elseif($sys['version']<1.0){//手动清除版本信息，重新升级

                $frontend=Yii::getAlias('@frontend');
                require $frontend.'/update.php';

            }else{



                echo 'version字段已设置！';
            }

        }

     //   $this->update('{{%user}}', ['longitude'=>116.473259, 'latitude'=>39.86954], ['uid'=>1]);

    }

    public function actionClearv(){
        if(Yii::$app->request->isPost){
            $this->update('{{%sys}}', ['version'=>0.00], ['id'=>1]);
            echo '<br/>版本号已清除！请刷新查看！';
        }
    }



    public function actionCreatetable($table='table')
    {
        $tableOptions = null;
        if (Yii::$app->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';//ENGINE=InnoDB DEFAULT CHARSET=utf8;
        }
   //     switch($table){
  //          case '{{%wechatgh}}':
       // $wechatgh='tbhome_wechatgh';


if(!$this->tableExist('{{%wechatgh}}')){
    $this->createTable('{{%wechatgh}}', [
        'id' => Schema::TYPE_PK,
        'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
        'appid' => Schema::TYPE_STRING . '(18) NOT NULL',
        'appsecret' => Schema::TYPE_STRING . '(32) NOT NULL',
        'mchid' => Schema::TYPE_STRING . '(20) NOT NULL',
        'mchsecret' => Schema::TYPE_STRING . '(50) NOT NULL',
        'name' => Schema::TYPE_STRING . '(20) NOT NULL',
        'email' => Schema::TYPE_STRING . '(50) NOT NULL',
        'token' => Schema::TYPE_STRING . '(50) NOT NULL',
        'aeskey' => Schema::TYPE_STRING . '(43) NOT NULL',
        'create_time' => Schema::TYPE_INTEGER.' NOT NULL',
        'update_at' => Schema::TYPE_TIMESTAMP.' NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP',
        'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
    ], $tableOptions);
    $this->createIndex('uid', '{{%wechatgh}}', ['uid']);
    $this->createIndex('appid', '{{%wechatgh}}', ['appid']);
}else{
    echo'wechatgh数据表已存在！无需创建';
}

    //            break;
      //      default :
        //        echo '没有新建数据表';

        if(!$this->tableExist('{{%column}}')){
            $this->createTable('{{%column}}', [
                'id' => Schema::TYPE_PK,
                'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
                'type' => Schema::TYPE_STRING . '(20) NOT NULL',
                'column' => Schema::TYPE_STRING . '(30) NOT NULL',
                'label' => Schema::TYPE_STRING . '(50) NOT NULL',
                 'value' => Schema::TYPE_STRING . ' NOT NULL',
                'remark' => Schema::TYPE_STRING . ' NOT NULL',
            ], $tableOptions);
            $this->createIndex('uid', '{{%column}}', ['uid']);
        }else{
            echo'column数据表已存在！无需创建';
        }

        $this->createTable('{{%qrcode_data}}', [
            'id' => Schema::TYPE_PK,
            'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
            'code' => Schema::TYPE_STRING . ' NOT NULL',
            'replyid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            'productid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',

            'query_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'clicks' => Schema::TYPE_INTEGER . ' NOT NULL',
            'prize' => Schema::TYPE_STRING . ' NOT NULL',
            'remark' => Schema::TYPE_STRING . ' NOT NULL',
            'query_area' => Schema::TYPE_STRING . '(20) NOT NULL DEFAULT 127',
            'url' => Schema::TYPE_STRING . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER.' NOT NULL',
            'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
        ], $tableOptions);
        $this->createIndex('uid', '{{%qrcode_data}}', ['uid']);
        $this->createIndex('code', '{{%qrcode_data}}', ['code'],true);

    }



}
