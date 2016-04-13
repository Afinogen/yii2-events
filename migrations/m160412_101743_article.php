<?php

use yii\db\Migration;
use \yii\db\Schema;

class m160412_101743_article extends Migration
{
    public function up()
    {
        $this->createTable('article', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'anons' => Schema::TYPE_STRING,
            'body' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER.' NOT NULL'            
        ]);
    }

    public function down()
    {
        $this->dropTable('article');
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
