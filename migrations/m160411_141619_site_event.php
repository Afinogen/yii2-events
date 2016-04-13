<?php

use yii\db\Migration;
use yii\db\Schema;

class m160411_141619_site_event extends Migration
{
    public function up()
    {
        $this->createTable(
            'event_code', [
                'name' => Schema::TYPE_STRING.'(32)',
                'title' => Schema::TYPE_STRING,
                'description' => Schema::TYPE_TEXT
            ]
        );
        $this->addPrimaryKey('pk_event_code_name', 'event_code', 'name');

        $this->insert(
            'event_code', [
                'name' => 'new_user',
                'title' => 'Создание нового пользователя',
            ]
        );
        $this->insert(
            'event_code', [
                'name' => 'new_article',
                'title' => 'Добавление новой статьи',
            ]
        );


        $this->createTable(
            'event_type', [
                'id' => Schema::TYPE_SMALLINT.'  NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'name' => Schema::TYPE_STRING,
                'description' => Schema::TYPE_TEXT
            ]
        );

        $this->insert(
            'event_type', [
                'name' => 'email',
                'description' => 'Отправка сообщения на E-mail'
            ]
        );
        $this->insert(
            'event_type', [
                'name' => 'browser',
                'description' => 'Отправка сообщения в браузере'
            ]
        );


        $this->createTable(
            'event', [
                'id' => Schema::TYPE_PK,
                'code' => Schema::TYPE_STRING.'(32) NOT NULL',
                'from_user_id' => Schema::TYPE_INTEGER.' NOT NULL',
                'to' => Schema::TYPE_INTEGER.' DEFAULT NULL',
                'subject' => Schema::TYPE_STRING.' NOT NULL',
                'body' => Schema::TYPE_TEXT.' NOT NULL',
                'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',
            ]
        );
        $this->addForeignKey('fk_event_from_user_id', 'event', 'from_user_id', 'user', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_event_code', 'event', 'code', 'event_code', 'name', 'cascade', 'cascade');


        $this->createTable(
            'event_has_type', [
                'event_id' => Schema::TYPE_INTEGER,
                'type_id' => Schema::TYPE_SMALLINT
            ]
        );
        $this->addPrimaryKey('pk_event_has_type', 'event_has_type', ['event_id', 'type_id']);
        $this->addForeignKey('fk_event_has_type', 'event_has_type', 'type_id', 'event_type', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_event_has_type_event_id', 'event_has_type', 'event_id', 'event', 'id', 'cascade', 'cascade');


        $this->createTable(
            'user_event', [
                'id' => Schema::TYPE_PK,
                'user_id' => Schema::TYPE_INTEGER,
                'event_id' => Schema::TYPE_INTEGER,
                'type_id' => Schema::TYPE_SMALLINT,
                'is_read' => Schema::TYPE_BOOLEAN,
                'subject' => Schema::TYPE_STRING.' NOT NULL',
                'body' => Schema::TYPE_TEXT.' NOT NULL',
                'created_at' => Schema::TYPE_INTEGER.' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER.' NOT NULL',
            ]
        );

        $this->addForeignKey('fk_user_event_user_id', 'user_event', 'user_id', 'user', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_user_event_event_id', 'user_event', 'event_id', 'event', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_user_event_type_id', 'user_event', 'type_id', 'event_type', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_event_user_id', 'user_event');
        $this->dropForeignKey('fk_user_event_event_id', 'user_event');
        $this->dropForeignKey('fk_user_event_type_id', 'user_event');
        $this->dropForeignKey('fk_event_has_type_event_id', 'event_has_type');
        $this->dropForeignKey('fk_event_has_type', 'event_has_type');
        $this->dropForeignKey('fk_event_code', 'event');
        $this->dropForeignKey('fk_event_from_user_id', 'event');
        
        $this->dropTable('user_event');
        $this->dropTable('event');
        $this->dropTable('event_has_type');
        $this->dropTable('event_type');
        $this->dropTable('event_code');
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
