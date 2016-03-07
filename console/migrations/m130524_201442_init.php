<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
//    const TBL_NAME = '{{%user}}';
//    public function up()
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';//ENGINE=InnoDB DEFAULT CHARSET=utf8;
        }

//        $this->createTable(self::TBL_NAME, [
          $this->createTable('{{%user}}', [
//            'uid' => $this->primaryKey(),
//            'username' => $this->string()->notNull()->unique(),
              'uid' => Schema::TYPE_PK,
              'username' => Schema::TYPE_STRING . '(20) NOT NULL',
              'name' => Schema::TYPE_STRING . '(20) NOT NULL',
              'mobile' => Schema::TYPE_STRING . '(20) NOT NULL',
              'qq' => Schema::TYPE_INTEGER . ' NOT NULL',
              'email' => Schema::TYPE_STRING . ' NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL', //密码
              'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
//            'auth_key' => $this->string(32)->notNull(),
//            'password_hash' => $this->string()->notNull(),
//            'password_reset_token' => $this->string()->unique(),
//            'email' => $this->string()->notNull()->unique(),
              'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
              'login' => $this->integer()->notNull(),
              'password_reset_token' => Schema::TYPE_STRING,

              'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
//            'status' => $this->smallInteger()->notNull()->defaultValue(10),
//            'created_at' => $this->integer()->notNull(),
              'created_ip' => $this->string(30)->notNull(),
//            'updated_at' => $this->integer()->notNull(),
              'updated_ip' => $this->string(30)->notNull(),
              'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
              'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('username', '{{%user}}', ['username'],true);
        $this->createIndex('email', '{{%user}}', ['email'],true);
//        $this->createIndex('mobile', '{{%user}}', ['mobile'],true);

//        $this->createIndex('username', '{{%user}}', ['username'],true);
//        $this->createIndex('email', '{{%user}}', ['email'],true);


/*********************************************************************************/

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
            'latitude' => Schema::TYPE_DOUBLE . '(30) NOT NULL',
            'longitude' => Schema::TYPE_DOUBLE . '(30) NOT NULL',
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
        ], $tableOptions);
      //  $this->createIndex('admin_user', '{{%sys}}', ['admin_user']);
        $this->createIndex('ip', '{{%sys}}', ['ip']);

                $this->insert('{{%sys}}', [
                    'id' => 1,
                    'admin_user' => 'admin',
            //        'user_password' => 'admin',
                    'qq' =>'798904845',
                    'company' =>'通宝科技',
                    'email' =>'admin@tbhome.com.cn',
                    'sitetitle' =>'唯卡微名片',
                    'siteurl' => 'http://www.vcards.top',
                    'ip' =>'127.0.0.1',
                ]);

        $this->insert('{{%user}}', [
               'uid' => 1,
            'username' => 'admin',
            'password_hash' => '$2y$13$SlenslU25pIng3zGfdPdNus8um0U3yim5Z/I7a3GN47gPKj0xsmsW',//密码adminadmin
            'name' => 'www.vcards.top',
            'qq' =>'798904845',
            'role'=>100,
            'mobile' =>'15980016080',
            'email' =>'admin@tbhome.com.cn',
        ]);


        /*********************************************************************************/

    }

//    public function down()
    public function safeDown()
    {

    $this->dropTable('{{%user}}');
    }
}
