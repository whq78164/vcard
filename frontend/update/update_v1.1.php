<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-14
 * Time: 1:08
 */
use yii\db\Schema;


$tableOptions = null;
if (Yii::$app->db->driverName === 'mysql') {
    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';//ENGINE=InnoDB DEFAULT CHARSET=utf8;
}


/////////////////v1.2
$this->addColumn('{{%module}}', 'version', Schema::TYPE_FLOAT.' NOT NULL DEFAULT 1.10');//更新字段类型
$this->update('{{%sys}}', ['version'=>1.2], ['id'=>1]);
echo '恭喜！系统已更新成功！版本v1.2';                              