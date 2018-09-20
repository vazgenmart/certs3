<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'authority_certificate' => $this->text()->notNull(),
            'body_data' => $this->text()->notNull(),
            'active_from' => $this->string()->notNull(),
            'active_to' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('user',[
            'username' => 'admin',
            'name' => 'admin',
            'surname' => 'adminyan',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin55'),
            'email' => 'admin@admin.com',
            'authority_certificate' => 'test',
            'body_data' => 'test',
            'active_from' => 'test',
            'active_to' => 'test',
            'status' => '20'

        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
