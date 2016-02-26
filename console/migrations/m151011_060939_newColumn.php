<?php

use yii\db\Schema;
use yii\db\Migration;

class m151011_060939_newColumn extends Migration
{
    public function up()
    {

        $this->addColumn('{{%setting}}', 'leader', Schema::TYPE_INTEGER.' NOT NULL ');
        $this->addColumn('{{%card_info}}', 'work_tel', Schema::TYPE_STRING.'(20) NOT NULL');
  //      $this->addColumn('{{%anti_reply}}', 'content', Schema::TYPE_TEXT . ' NOT NULL');
  //   $this->alterColumn('{{%anti_code}}', 'prize', Schema::TYPE_STRING.' NOT NULL');
        $this->alterColumn('{{%product}}', 'describe', Schema::TYPE_TEXT.' NOT NULL');
    }

    public function down()
    {
        echo "m151011_060939_newColumn cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
