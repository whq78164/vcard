<?php
use yii\db\Schema;
$tableOptions = null;
if (Yii::$app->db->driverName === 'mysql') {
    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';//ENGINE=InnoDB DEFAULT CHARSET=utf8;
}
//     switch($table){
//          case '{{%wechatgh}}':
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
//               break;
//           default :
//               echo '没有新建数据表';




//        $this->createTable(self::TBL_NAME, [
$this->createTable('{{%user}}', [
//            'uid' => self::primaryKey(),
//            'username' => self::string()->notNull()->unique(),
    'uid' => Schema::TYPE_PK,
    'username' => Schema::TYPE_STRING . '(20) NOT NULL',
    'name' => Schema::TYPE_STRING . '(20) NOT NULL',
    'mobile' => Schema::TYPE_STRING . '(20) NOT NULL',
    'qq' => Schema::TYPE_INTEGER . ' NOT NULL',
    'email' => Schema::TYPE_STRING . ' NOT NULL',
    'password_hash' => Schema::TYPE_STRING . ' NOT NULL', //密码
    'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
//            'password_reset_token' => self::string()->unique(),
//            'email' => self::string()->notNull()->unique(),
    'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
    'login' => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT 0',
    'password_reset_token' => Schema::TYPE_STRING,

    'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
//            'status' => self::smallInteger()->notNull()->defaultValue(10),
//            'created_at' => self::integer()->notNull(),
    'created_ip' => Schema::TYPE_STRING . '(30) NOT NULL',
//            'updated_at' => self::integer()->notNull(),
    'updated_ip' => Schema::TYPE_STRING . '(30) NOT NULL',
    'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
    'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
], $tableOptions);
$this->createIndex('username', '{{%user}}', ['username'],true);
$this->createIndex('email', '{{%user}}', ['email'],true);

$this->createTable('{{%setting}}', [
    'uid' => Schema::TYPE_PK,
    'bg_image' => Schema::TYPE_STRING . ' NOT NULL',
    'tpl' => Schema::TYPE_INTEGER . ' NOT NULL',
    'vip' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
    'upline' => Schema::TYPE_INTEGER . ' NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
    'leader' => Schema::TYPE_INTEGER . ' NOT NULL',
], $tableOptions);

$this->createTable('{{%card_info}}', [
    'uid' => Schema::TYPE_PK,
    'card_title' => Schema::TYPE_STRING . '(50) NOT NULL',
    'unit' => Schema::TYPE_STRING . '(80) NOT NULL',
    'face_box' => Schema::TYPE_STRING . ' NOT NULL',
    'department' => Schema::TYPE_STRING . '(50) NOT NULL',
    'position' => Schema::TYPE_STRING . '(50) NOT NULL',
    'address' => Schema::TYPE_STRING . ' NOT NULL',
    'business' => Schema::TYPE_TEXT . ' NOT NULL',
    'signature' => Schema::TYPE_STRING . ' NOT NULL',
    'fax' => Schema::TYPE_STRING . '(20) NOT NULL',
    'location' => Schema::TYPE_STRING . '(30) NOT NULL',
    'wechat_account' => Schema::TYPE_STRING . '(20) NOT NULL',
    'wechat_qrcode' => Schema::TYPE_STRING . ' NOT NULL',
    'work_tel' => Schema::TYPE_STRING . '(20) NOT NULL',
    'latitude' => Schema::TYPE_DOUBLE.'(10,6) NOT NULL',
    'longitude' => Schema::TYPE_DOUBLE.'(10,6) NOT NULL',

], $tableOptions);

$this->createTable('{{%tel}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'tel_label' => Schema::TYPE_STRING . '(10) NOT NULL',
    'tel_number' => Schema::TYPE_STRING . '(20) NOT NULL',
], $tableOptions);
$this->createIndex('uid', '{{%tel}}', ['uid']);

$this->createTable('{{%label}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'card_label' => Schema::TYPE_STRING . '(20) NOT NULL',
    'card_value' => Schema::TYPE_STRING . ' NOT NULL',
], $tableOptions);
$this->createIndex('uid', '{{%label}}', ['uid']);

$this->createTable('{{%microlink}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'link_title' => Schema::TYPE_STRING . '(20) NOT NULL',
    'link_url' => Schema::TYPE_STRING . ' NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%microlink}}', ['uid']);

$this->createTable('{{%micropage}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'page_title' => Schema::TYPE_STRING . '(100) NOT NULL',
    'page_content' => Schema::TYPE_TEXT . ' NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%micropage}}', ['uid']);

$this->createTable('{{%relation}}', [
    'id' => Schema::TYPE_PK,
    'uid1' => Schema::TYPE_INTEGER . ' NOT NULL',
    'uid2' => Schema::TYPE_INTEGER . ' NOT NULL',
], $tableOptions);
$this->createIndex('uid1', '{{%relation}}', ['uid1','uid2']);
//     $this->createIndex('uid2', '{{%relation}}', ['uid2']);

$this->createTable('{{%module}}', [
    'id' => Schema::TYPE_PK,
    'modulename' => Schema::TYPE_STRING . '(20) NOT NULL',
    'module_label' => Schema::TYPE_STRING . '(20) NOT NULL',
    'module_des' => Schema::TYPE_TEXT . ' NOT NULL',
], $tableOptions);

$this->createTable('{{%usermodule}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'moduleid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'module_status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%usermodule}}', ['uid']);
$this->createIndex('moduleid', '{{%usermodule}}', ['moduleid']);

$this->createTable('{{%sys}}', [
    'id' => Schema::TYPE_PK,
    'admin_user' => Schema::TYPE_STRING . '(20) NOT NULL',
    'user_password' => Schema::TYPE_STRING . ' NOT NULL',
    'sitetitle' => Schema::TYPE_STRING . ' NOT NULL',
    'company' => Schema::TYPE_STRING . '(50) NOT NULL',
    'tel' => Schema::TYPE_STRING . '(20) NOT NULL',
    'qq' => Schema::TYPE_INTEGER . ' NOT NULL',
    'email' => Schema::TYPE_STRING . '(50) NOT NULL',
    'address' => Schema::TYPE_STRING . ' NOT NULL',
    'logo' => Schema::TYPE_STRING . ' NOT NULL',
    'keywords' => Schema::TYPE_STRING . ' NOT NULL',
    'siteurl' => Schema::TYPE_STRING . ' NOT NULL',
    'copyright' => Schema::TYPE_STRING . '(20) NOT NULL',
    'icp' => Schema::TYPE_STRING . '(20) NOT NULL',
    'ip' => Schema::TYPE_STRING . '(30) NOT NULL',
    'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
    'version' => Schema::TYPE_FLOAT.' NOT NULL DEFAULT 1.0',
], $tableOptions);
//  $this->createIndex('admin_user', '{{%sys}}', ['admin_user']);
//     $this->createIndex('ip', '{{%sys}}', ['ip']);



////////////////////////////////二维码管理系统
$this->createTable('{{%product}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'share' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
    'image' => Schema::TYPE_STRING . ' NOT NULL',
    'factory' => Schema::TYPE_STRING . '(30) NOT NULL',
    'name' => Schema::TYPE_STRING . '(10) NOT NULL',
    'describe' => Schema::TYPE_TEXT . ' NOT NULL',//产品描述
    'specification' => Schema::TYPE_STRING . ' NOT NULL',
    'unit' => Schema::TYPE_STRING . '(10) NOT NULL',
    'brand' => Schema::TYPE_STRING . '(20) NOT NULL',
    'price' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL',
    'traceability' => Schema::TYPE_INTEGER . ' NOT NULL',//追溯
    'hot' => Schema::TYPE_INTEGER . ' NOT NULL',
], $tableOptions);
$this->createIndex('uid', '{{%product}}', ['uid']);
$this->createIndex('hot', '{{%product}}', ['hot']);
/*
        $this->createTable('{{%anti_setting}}', [
            'uid' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(20) NOT NULL',
            'image' => Schema::TYPE_STRING . ' NOT NULL',
            'api_select' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'api_parameter' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'brand' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);

         $this->createTable('{{%anti_prize}}', [
            'id' =>  Schema::TYPE_PK,
            'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
            'share' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'grade' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'hot' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('uid', '{{%anti_prize}}', ['uid']);
        $this->createIndex('hot', '{{%anti_prize}}', ['hot']);

 */
$this->createTable('{{%anti_reply}}', [
    'id' =>  Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'tag' => Schema::TYPE_STRING . '(30) NOT NULL',
    'success' => Schema::TYPE_TEXT . ' NOT NULL',
    'fail' => Schema::TYPE_STRING . ' NOT NULL',
    'content' => Schema::TYPE_TEXT . ' NOT NULL',
    'valid_clicks' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%anti_reply}}', ['uid']);

$this->createTable('{{%anti_log}}', [
    'id' =>  Schema::TYPE_PK,
    'startid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'endid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'url' => Schema::TYPE_STRING . '(255) NOT NULL',
    'time' => Schema::TYPE_INTEGER . ' NOT NULL',
    'remark' => Schema::TYPE_STRING . '(255) NOT NULL',
], $tableOptions);

$this->createTable('{{%anti_code}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'code' => Schema::TYPE_STRING . ' NOT NULL',
    'replyid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
    'productid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
    'traceabilityid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',//追溯
    'query_time' => Schema::TYPE_INTEGER . ' NOT NULL',
    'clicks' => Schema::TYPE_INTEGER . ' NOT NULL',
    'prize' => Schema::TYPE_STRING . ' NOT NULL',
    'remark' => Schema::TYPE_STRING . ' NOT NULL',
    'query_area' => Schema::TYPE_STRING . '(20) NOT NULL DEFAULT 127',
    'url' => Schema::TYPE_STRING . ' NOT NULL',
    'create_time' => Schema::TYPE_INTEGER.' NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%anti_code}}', ['uid']);
$this->createIndex('code', '{{%anti_code}}', ['code'],true);

$this->createTable('{{%traceability_info}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'code' => Schema::TYPE_STRING . ' NOT NULL',
    'label' => Schema::TYPE_STRING . ' NOT NULL',
    'describe' => Schema::TYPE_TEXT . ' NOT NULL',
    'remark' => Schema::TYPE_STRING . ' NOT NULL',
    'create_time' => Schema::TYPE_INTEGER.' NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%traceability_info}}', ['uid']);
$this->createIndex('code', '{{%traceability_info}}', ['code']);


$this->createTable('{{%traceability_data}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'url' => Schema::TYPE_STRING . ' NOT NULL',
    'productid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'traceabilityid' => Schema::TYPE_INTEGER . ' NOT NULL',//追溯
    'query_time' => Schema::TYPE_INTEGER . ' NOT NULL',
    'clicks' => Schema::TYPE_INTEGER . ' NOT NULL',
    'remark' => Schema::TYPE_STRING . ' NOT NULL',
    'localremark' => Schema::TYPE_STRING . ' NOT NULL',
    'create_time' => Schema::TYPE_INTEGER.' NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%traceability_data}}', ['uid']);



////////////////////////模块扩展
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
$this->createIndex('uid', '{{%company}}', ['uid']);

$this->createTable('{{%company_department}}', [
    'id' => Schema::TYPE_PK,
    'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
    'department' => Schema::TYPE_STRING . '(30) NOT NULL',
    'status' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
], $tableOptions);
$this->createIndex('uid', '{{%company_department}}', ['uid']);

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
$this->createIndex('uid', '{{%company_worker}}', ['uid']);
$this->createIndex('job_id', '{{%company_worker}}', ['job_id']);
$this->createIndex('company_id', '{{%company_worker}}', ['company_id']);
$this->createIndex('department_id', '{{%company_worker}}', ['department_id']);



/////////////////////////添加数据
$this->insert('{{%sys}}', [
    'id' => 1,
    'admin_user' => 'admin',
    'user_password' => 'adminpd',
    'sitetitle' =>'二维码平台',
    'company' =>'通宝科技',
    'tel'=>'059588888888',
    'qq' =>'798904845',
    'email' =>'admin@tbhome.com.cn',
    'address' =>'公司地址',
    'logo' =>'/pic/sdf.png',
    'keywords'=>'二维码',
    'siteurl' => 'http://www.vcards.top',
    'copyright' =>'power by 通宝科技',
    'icp' => '备案号',
    'ip' =>'127.0.0.1',
    'status' => 10,
    'version' => 1.10,

]);

$this->insert('{{%user}}', [
    'uid' => 1,
    'username' => 'admin',
    'name'=>'通宝科技',
    'mobile' =>'15980016080',
    'qq' =>'798904845',
    'email' =>'admin@tbhome.com.cn',
    'password_hash' => '$2y$13$SlenslU25pIng3zGfdPdNus8um0U3yim5Z/I7a3GN47gPKj0xsmsW',//密码adminadmin
    'auth_key'=>'',
    'status' => 10,
    'login'=>0,
    'password_reset_token'=>null,
    'role'=>100,
    'created_ip'=>'127.0.0.1',
    'updated_ip'=>'127.0.0.1',
    'created_at'=>time(),
    'updated_at'=>time(),
]);

$this->insert('{{%product}}', [
    'id' => 1,
    'uid' => 1,
    'share' => 10,
    'image' => 'http://www.vcards.top/Uploads/default_face.jpg',
    'factory' => '二维码轻工厂',
    'name' => '二维码贴纸',
    'describe' => '百度编辑器，编辑产品精彩图文详情',
    'specification' => '50mm*70mm',
    'unit' => '张',
    'brand' => '唯卡',
    'price' => 0.1,
    'traceability' => 1,//追溯
    'hot' => 0,

]);

$this->insert('{{%anti_reply}}', [
    'id' => 1,
    'uid' => 1,
    'success' => '您好！您所查询的商品为{{产品品牌}}正品！<br/>产品名称：{{产品名称}}<br/>生产厂家：{{产品厂家}}<br/>之前已被查询：{{查询次数}}次，<br/>上次查询时间：{{查询时间}}',
    'tag' => '唯卡微防伪',
    'fail' => '您所查询的防伪码不存在，请谨防假冒',
    'content' => '（选填）该信息为DIY网页，为HTML，CSS代码视觉高手准备！',
    'valid_clicks' => 10,
]);

$this->insert('{{%card_info}}', [
    'uid' => 1,
    'card_title' => '我的微名片',
    'unit' => '我的工作单位',
    'face_box' => 'Upload/default_face.jpg',
    'department' => '工作部门',
    'position' => '职位',
    'address' => '福建省泉州市鲤城区仙塘工业园',
    'business' => '我的产品和服务',
    'signature' =>  '',
    'fax' => '0595-88888888',
    'location' => '',
    'wechat_account' => 'wechat',
    'wechat_qrcode' => '',
    'work_tel' => '0595-88888888',
    'latitude' => 24.923982,
    'longitude' => 118.518197,

]);

$this->insert('{{%module}}',[
    'id'=>1, //id字段如不设置，则默认自增
    'modulename'=>'company',
    'module_label'=>'公司',
    'module_des'=>'公司职员管理'
]);


$this->insert('{{%usermodule}}',[
    'id'=>1, //id字段如不设置，则默认自增
    'uid'=>1,
    'moduleid'=>1,
    'module_status'=>10
]);
