<?php

use yii\db\Schema;
use yii\db\Migration;

/*防伪系统数据表*/
class m130524_201443_init extends Migration
{
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';//ENGINE=InnoDB DEFAULT CHARSET=utf8;
        }



        $this->createTable('{{%anti_setting}}', [
            'uid' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(20) NOT NULL',
            'image' => Schema::TYPE_STRING . ' NOT NULL',
            'api_select' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'api_parameter' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'brand' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
 //       $this->createIndex('uid', '{{%anti_setting}}', ['uid'],true);



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
      /*******************************************************************/

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

        $this->createTable('{{%product}}', [
            'id' => Schema::TYPE_PK,
            'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
            'share' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'image' => Schema::TYPE_STRING . ' NOT NULL',
            'factory' => Schema::TYPE_STRING . '(30) NOT NULL',
            'name' => Schema::TYPE_STRING . '(10) NOT NULL',
            'describe' => Schema::TYPE_TEXT . ' NOT NULL',
            'specification' => Schema::TYPE_STRING . ' NOT NULL',
            'unit' => Schema::TYPE_STRING . '(10) NOT NULL',
            'brand' => Schema::TYPE_STRING . '(20) NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(9,2) NOT NULL',
            'traceability' => Schema::TYPE_INTEGER . ' NOT NULL',//追溯
            'hot' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('uid', '{{%product}}', ['uid']);
        $this->createIndex('hot', '{{%product}}', ['hot']);


        $this->createTable('{{%anti_code}}', [
            'id' => Schema::TYPE_PK,
            'uid' => Schema::TYPE_INTEGER . ' NOT NULL',
            'code' => Schema::TYPE_STRING . ' NOT NULL',
            'replyid' => Schema::TYPE_INTEGER . ' NOT NULL',
            'productid' => Schema::TYPE_INTEGER . ' NOT NULL',
            'traceabilityid' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',//追溯
            'query_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'clicks' => Schema::TYPE_INTEGER . ' NOT NULL',
            'prize' => Schema::TYPE_STRING . ' NOT NULL',
            'remark' => Schema::TYPE_STRING . ' NOT NULL',
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

/***************/
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
            'content' => '该信息为DIY网页，用百度编辑器，设计精彩图文内容',
            'valid_clicks' => 10,
        ]);



    }

//    public function down()
    public function safeDown()
    {

 //   $this->dropTable('{{%setting}}');
    }
}
