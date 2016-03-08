<?php
namespace frontend\controllers;
use Yii;


class DbController extends \yii\web\Controller
{

    protected function createTable($table, $columns, $options = null)
    {
        echo "    > 创建 table $table ...";
        $exist=$this->tableExist($table);
        if(!$exist){
            $time = microtime(true);
            Yii::$app->db->createCommand()->createTable($table, $columns, $options)->execute();
            echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
        }else{
            echo $table."数据表已存在，已跳过。</br>";
        }
    }


    protected function addColumn($table, $column, $type)
    {
        echo "    > add column $column $type to table $table ...";

        $sql="Describe $table $column";
        $con=Yii::$app->db->createCommand($sql)->queryOne();
        if($con['Field']==null){
            $time = microtime(true);
            Yii::$app->db->createCommand()->addColumn($table, $column, $type)->execute();
            echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
        }else{
            echo ' 字段已存在, 跳过。</br> ';
        }
    }

    protected function tableExist($table){
      //  $sql="SHOW TABLES LIKE '".$table."'";
    $sql="SELECT COUNT(*) FROM $table";
        $ta=Yii::$app->db->createCommand($sql)->query();
    if($ta==null){
       return false;
    }else {
        return true;
        //echo $table."数据表已存在，已跳过。</br>";
    }
    }

    
    protected function createIndex($name, $table, $columns, $unique = false)
    {
        echo '    > 创建索引' . ($unique ? ' unique' : '') . " index $name on $table (" . implode(',', (array) $columns) . ') ...';


        $exist=$this->tableExist($table);
        if(!$exist){
            $time = microtime(true);
            Yii::$app->db->createCommand()->createIndex($name, $table, $columns, $unique)->execute();
            echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";

        }else{
            echo $table."数据表已存在，已跳过。</br>";
        }






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



    protected function renameColumn($table, $name, $newName)
    {
        echo "    > 重命名字段 $name in table $table to $newName ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->renameColumn($table, $name, $newName)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)</br>";
    }

    protected function dropTable($table)
    {
        echo "    > drop table $table ...";
        $time = microtime(true);
        Yii::$app->db->createCommand()->dropTable($table)->execute();
        echo ' 成功 (耗时: ' . sprintf('%.3f', microtime(true) - $time) . "s)\n";
    }




}
