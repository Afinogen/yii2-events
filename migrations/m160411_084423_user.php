<?php

use yii\db\Migration;
use yii\db\Schema;

class m160411_084423_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING.'(32) NOT NULL',
            'email' => Schema::TYPE_STRING.'(32) NOT NULL',
            'password' => Schema::TYPE_STRING.'(60) NOT NULL',
            'auth_key' => Schema::TYPE_STRING.'(32) NOT NULL',
            'access_token' => Schema::TYPE_STRING,
            'role_id' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT ' . \app\models\User::ROLE_USER,
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->insert('user', [
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'role_id' => \app\models\User::ROLE_ADMIN,
        ]);
        
        $this->insert('user', [
            'username' => 'user',
            'email' => 'user@user.com',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('user'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'role_id' => \app\models\User::ROLE_USER,
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
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
