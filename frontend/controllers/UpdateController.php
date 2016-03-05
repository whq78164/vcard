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






    private function createTable($table, $columns, $options = null)
    {
        echo "    > create table $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->createTable($table, $columns, $options)->execute();
        echo ' 升级成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    private function addColumn($table, $column, $type)
    {
        echo "    > add column $column $type to table $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->addColumn($table, $column, $type)->execute();
        echo ' 升级成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
  //      var_dump($res);
    }

    private function insert($table, $columns)
    {
        echo "    > insert into $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->insert($table, $columns)->execute();
        echo ' 升级成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }



    private function update($table, $columns, $condition = '', $params = [])
    {
        echo "    > update $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->update($table, $columns, $condition, $params)->execute();
        echo '升级成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    private function alterColumn($table, $column, $type)
    {
        echo "    > alter column $column in table $table to $type ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->alterColumn($table, $column, $type)->execute();
        echo ' 完成 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    private function createIndex($name, $table, $columns, $unique = false)
    {
        echo '    > create' . ($unique ? ' unique' : '') . " index $name on $table (" . implode(',', (array) $columns) . ') ...';
        $time = microtime(true);
        Yii::$app->db->createCommand()->createIndex($name, $table, $columns, $unique)->execute();
        echo ' 完成 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }


    public function renameColumn($table, $name, $newName)
    {
        echo "    > rename column $name in table $table to $newName ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->renameColumn($table, $name, $newName)->execute();
        echo ' 完成 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    public function dropTable($table)
    {
        echo "    > drop table $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->dropTable($table)->execute();
        echo ' 完成 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)\n";
    }



    public function actionIndex(){
   //     $this->renameColumn('{{%usermodule}}', 'module_satus', 'module_status');
        header('Content-Type:text/html;charset=UTF-8');
        $this->actionCreatetable();
    //    $this->actionAddcolumn();
   //     $this->actionUpdatevalue();
     //   $this->update('{{%user}}', ['longitude'=>116.473259, 'latitude'=>39.86954], ['uid'=>1]);



    }





    public function actionCreatetable()
    {
        $tableOptions = null;
        if (Yii::$app->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';//ENGINE=InnoDB DEFAULT CHARSET=utf8;
        }

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












    }


    public function actionAddcolumn(){

           $this->addColumn('{{%user}}', 'latitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');
        $this->addColumn('{{%user}}', 'longitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');

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
