<?php

namespace frontend\controllers;
use Yii;
use yii\db\Schema;

class UpdateController extends \yii\web\Controller
{
    public $layout='user';

    public function init(){
        parent::init();
        if(Yii::$app->user->identity->role!==100){
            Yii::$app->session->setFlash('danger', '您不是管理员！');
            $this->redirect(['/user/index']);
        }
    }






    protected function createTable($table, $columns, $options = null)
    {
        echo "    > 创建 table $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->createTable($table, $columns, $options)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    protected function addColumn($table, $column, $type)
    {
        echo "    > add column $column $type to table $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->addColumn($table, $column, $type)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
  //      var_dump($res);
    }

    protected function insert($table, $columns)
    {
        echo "    > 添加数据 into $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->insert($table, $columns)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }



    protected function update($table, $columns, $condition = '', $params = [])
    {
        echo "    > 更新 $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->update($table, $columns, $condition, $params)->execute();
        echo '成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    protected function alterColumn($table, $column, $type)
    {
        echo "    > 修改字段 $column in table $table to $type ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->alterColumn($table, $column, $type)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    protected function createIndex($name, $table, $columns, $unique = false)
    {
        echo '    > 创建' . ($unique ? ' unique' : '') . " index $name on $table (" . implode(',', (array) $columns) . ') ...';
        $time = microtime(true);
        Yii::$app->db->createCommand()->createIndex($name, $table, $columns, $unique)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }


    public function renameColumn($table, $name, $newName)
    {
        echo "    > 重命名字段 $name in table $table to $newName ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->renameColumn($table, $name, $newName)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    public function dropTable($table)
    {
        echo "    > drop table $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->dropTable($table)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)\n";
    }



    public function actionIndex(){
        header('Content-Type:text/html;charset=UTF-8');
        $table='sys';
        $sql="SELECT * FROM {{%$table}} WHERE id=1";
        $sys=Yii::$app->db->createCommand($sql)->queryOne();
        if(!isset($sys['version'])){
    //        $this->renameColumn('{{%usermodule}}', 'module_satus', 'module_status');
            $this->addColumn('{{%sys}}', 'version', Schema::TYPE_FLOAT.' NOT NULL DEFAULT 1.0');
        //    $this->addColumn('{{%card_info}}', 'latitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');
        //    $this->addColumn('{{%card_info}}', 'longitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');
        //    $this->actionCreatetable('{{%wechatgh}}');
            $this->update('{{%sys}}', ['version'=>1.10], ['id'=>1]);
            echo '恭喜！系统已更新成功！版本v1.10';
        }elseif($sys['version']==1.10){
            echo '您的系统已升级成功！版本：1.10，请勿重复升级！';
        }else{
            echo 'version字段已设置！';
        }



   //     print_r($sys);
   //     $this->actionCreatetable();
    //    $this->actionAddcolumn();
   //     $this->actionUpdatevalue();
     //   $this->update('{{%user}}', ['longitude'=>116.473259, 'latitude'=>39.86954], ['uid'=>1]);

    }



    public function actionCreatetable($table)
    {
        $tableOptions = null;
        if (Yii::$app->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';//ENGINE=InnoDB DEFAULT CHARSET=utf8;
        }
        switch($table){
            case '{{%wechatgh}}':
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
                break;
            default :
                echo '没有新建数据表';



        }














    }


    public function actionAddcolumn(){

           $this->addColumn('{{%card_info}}', 'latitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');
        $this->addColumn('{{%card_info}}', 'longitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');

        //    $this->update('{{%sys}}', ['version'=>1.11], ['id'=>1]);

        //   return $this->render('update');
    }

    public function actionUpdatevalue(){
        $this->update('{{%sys}}', ['version'=>1.10], ['id'=>1]);
        $this->update('{{%sys}}', ['version'=>1.11], ['id'=>2]);

    }

    public function actionAlterColumn(){
            $this->alterColumn('{{%sys}}', 'version', Schema::TYPE_FLOAT.' NOT NULL DEFAULT 1.10');

    }





}
