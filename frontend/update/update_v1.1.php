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

$this->createTable('{{%column}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'type' => Schema::TYPE_STRING . '(20) NOT NULL',
    'column' => Schema::TYPE_STRING . '(30) NOT NULL',
    'label' => Schema::TYPE_STRING . '(50) NOT NULL',
    'value' => Schema::TYPE_STRING . ' NOT NULL',
    'remark' => Schema::TYPE_STRING . ' NOT NULL',
], $tableOptions);



///////////二维码管理系统
$this->createTable('{{%qrcode_reply}}', [
    'id' =>  Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'tag' => Schema::TYPE_STRING . '(50) NOT NULL',
    'success' => Schema::TYPE_TEXT . ' NOT NULL',
    'wechat_reply' => Schema::TYPE_STRING . ' NOT NULL',
    'fail' => Schema::TYPE_STRING . ' NOT NULL',
    'content' => Schema::TYPE_TEXT . ' NOT NULL',
    'valid_clicks' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
    'remark'=>Schema::TYPE_STRING . ' NOT NULL',

], $tableOptions);
//$this->createIndex('uid', '{{%qrcode_reply}}', ['uid']);

$this->createTable('{{%qrcode_log}}', [
    'id' =>  Schema::TYPE_PK,
    'startid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'endid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'url' => Schema::TYPE_STRING . '(255) NOT NULL',
    'time' => Schema::TYPE_INTEGER . ' NOT NULL',
    'remark' => Schema::TYPE_STRING . '(255) NOT NULL',
], $tableOptions);

$this->createTable('{{%qrcode_data}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'code' => Schema::TYPE_STRING . ' NOT NULL',
    'replyid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
    'productid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
  //  'traceabilityid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',//追溯
    'query_time' => Schema::TYPE_INTEGER . ' NOT NULL',
    'clicks' => Schema::TYPE_INTEGER . ' NOT NULL',
    'prize' => Schema::TYPE_STRING . ' NOT NULL',
    'remark' => Schema::TYPE_STRING . ' NOT NULL',
    'query_area' => Schema::TYPE_STRING . '(20) NOT NULL DEFAULT 127',
    'url' => Schema::TYPE_STRING . ' NOT NULL',
    'create_time' => Schema::TYPE_INTEGER.' NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
//$this->createIndex('uid', '{{%qrcode_data}}', ['uid']);
//$this->createIndex('code', '{{%qrcode_data}}', ['code'],true);
///////////二维码管理系统

///////////////企业名片模块
$this->createTable('{{%company}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'company' => Schema::TYPE_STRING . '(30) NOT NULL',
    'address' => Schema::TYPE_STRING . '(80) NOT NULL',
    'tpl' => Schema::TYPE_INTEGER . ' NOT NULL',
    'image' => Schema::TYPE_STRING . ' NOT NULL',
    'url' => Schema::TYPE_STRING . ' NOT NULL',
    'latitude' => Schema::TYPE_DOUBLE.'(10,6) NOT NULL',
    'longitude'=> Schema::TYPE_DOUBLE.'(10,6) NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
//$this->createIndex('uid', '{{%company}}', ['uid']);

$this->createTable('{{%company_department}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'department' => Schema::TYPE_STRING . '(30) NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
//$this->createIndex('uid', '{{%company_department}}', ['uid']);

$this->createTable('{{%company_worker}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
    'job_id' => Schema::TYPE_STRING . '(30) NOT NULL',
    'company_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
    'department_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
    'name' => Schema::TYPE_STRING . ' NOT NULL',
    'mobile' => Schema::TYPE_STRING . ' NOT NULL',
    'qq' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
    'email' => Schema::TYPE_STRING . ' NOT NULL',
    'head_img' => Schema::TYPE_STRING . ' NOT NULL',
    'position' => Schema::TYPE_STRING . '(50) NOT NULL',
    'task' => Schema::TYPE_STRING . ' NOT NULL',
    'wechat_account' => Schema::TYPE_STRING . '(20) NOT NULL',
    'wechat_qrcode' => Schema::TYPE_STRING . ' NOT NULL',
    'work_tel' => Schema::TYPE_STRING . '(20) NOT NULL',
    'fax' => Schema::TYPE_STRING . '(20) NOT NULL',
    'is_work' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
    'remark' => Schema::TYPE_STRING . ' NOT NULL',
], $tableOptions);
//$this->createIndex('uid', '{{%company_worker}}', ['uid']);
//$this->createIndex('job_id', '{{%company_worker}}', ['job_id']);
//$this->createIndex('company_id', '{{%company_worker}}', ['company_id']);
//$this->createIndex('department_id', '{{%company_worker}}', ['department_id']);

$this->dropTable('{{%module}}');
$this->dropTable('{{%usermodule}}');
$this->createTable('{{%module}}', [
    'id' => Schema::TYPE_PK,
    'modulename' => Schema::TYPE_STRING . '(20) NOT NULL',
    'module_label' => Schema::TYPE_STRING . '(20) NOT NULL',
    'module_des' => Schema::TYPE_TEXT . ' NOT NULL',
    'icon' => Schema::TYPE_STRING." NOT NULL DEFAULT '"."fa fa-external-link'",
    'mark' => Schema::TYPE_STRING." NOT NULL DEFAULT '"."New'",
    'markclass' => Schema::TYPE_STRING." NOT NULL DEFAULT '"."label pull-right bg-green'",
], $tableOptions);
$this->createTable('{{%usermodule}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'moduleid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'module_status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',

], $tableOptions);


$this->addColumn('{{%module}}', 'icon', Schema::TYPE_STRING." NOT NULL DEFAULT '"."fa fa-circle-o'");
$this->addColumn('{{%module}}', 'mark', Schema::TYPE_STRING." NOT NULL DEFAULT '"."New'");
$this->alterColumn('{{%module}}', 'markclass', Schema::TYPE_STRING." NOT NULL DEFAULT '"."label pull-right bg-green'");

//$this->alterColumn('{{%sys}}', 'version', Schema::TYPE_FLOAT.' NOT NULL DEFAULT 1.10');//更新字段类型
//  $this->addColumn('{{%column}}', 'value', Schema::TYPE_STRING.' NOT NULL');
// $this->insert('{{%module}}',['id'=>1, 'modulename'=>'company','module_label'=>'公司', 'module_des'=>'公司职员管理']);//id字段如不设置，则默认自增
$this->addColumn('{{%sys}}', 'version', Schema::TYPE_FLOAT.' NOT NULL DEFAULT 1.0');
$this->addColumn('{{%card_info}}', 'latitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');
$this->addColumn('{{%card_info}}', 'longitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');
//$this->addColumn('{{%company}}', 'longitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');
//$this->addColumn('{{%company}}', 'latitude', Schema::TYPE_DOUBLE.'(10,6) NOT NULL');

$this->alterColumn('{{%company_worker}}', 'qq', Schema::TYPE_STRING." NOT NULL DEFAULT '"."798904845'");


$this->insert('{{%module}}',[
    'id'=>1, //id字段如不设置，则默认自增
    'modulename'=>'company',
    'module_label'=>'公司',
    'module_des'=>'公司职员管理，微信员工导航名片',
    'icon'=>'fa fa-university',
    'mark'=>'New',
    'markclass'=>'label pull-right bg-green',
]);
$this->insert('{{%module}}',[
    'id'=>2, //id字段如不设置，则默认自增
    'modulename'=>'qrcode',
    'module_label'=>'二维码管理系统',
    'module_des'=>'防伪、追溯，自定义字段添加...',
    'icon'=>'fa fa-qrcode',
    'mark'=>'Hot',
    'markclass'=>'label pull-right bg-red',
]);
$this->insert('{{%module}}',[
    'id'=>3, //id字段如不设置，则默认自增
    'modulename'=>'column',
    'module_label'=>'自定义字段',
    'module_des'=>'用于自定义表单，预约，追溯字段，自定义名片模板等......',
    'icon'=>'fa fa-th',
    'markclass'=>'label pull-right bg-green',
]);

$this->insert('{{%usermodule}}',[
    'id'=>1, //id字段如不设置，则默认自增
    'uid'=>1,
    'moduleid'=>1,
    'module_status'=>10,
]);
$this->insert('{{%usermodule}}',[
    'id'=>2, //id字段如不设置，则默认自增
    'uid'=>1,
    'moduleid'=>2,
    'module_status'=>10,
]);
$this->insert('{{%usermodule}}',[
    'id'=>3, //id字段如不设置，则默认自增
    'uid'=>1,
    'moduleid'=>3,
    'module_status'=>10,
]);


$this->update('{{%sys}}', ['version'=>1.10], ['id'=>1]);
echo '恭喜！系统已更新成功！版本v1.10';


/////////////////v1.11
$this->addColumn('{{%module}}', 'version', Schema::TYPE_FLOAT.' NOT NULL DEFAULT 1.10');//更新字段类型
$this->update('{{%sys}}', ['version'=>1.11], ['id'=>1]);
echo '恭喜！系统已更新成功！版本v1.11';                              