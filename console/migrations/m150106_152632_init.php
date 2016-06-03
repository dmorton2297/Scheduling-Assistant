<?php

use yii\db\Schema;
use yii\db\Migration;
use common\models\User;
use common\models\GlobalSettings;

class m150106_152632_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(User::tableName(), [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . '(32) NOT NULL',
            'firstname' => Schema::TYPE_STRING . '(32) NOT NULL',
            'lastname' => Schema::TYPE_STRING . '(32) NOT NULL',
            'email' => Schema::TYPE_STRING . '(128) NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . '(60) NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . '(47)',
            'password_last_change' => Schema::TYPE_TIMESTAMP . ' with time zone',
            'password_expire_after' => Schema::TYPE_INTEGER,
            'password_warn_before' => Schema::TYPE_INTEGER,
            'last_login' => Schema::TYPE_TIMESTAMP . ' with time zone',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_TIMESTAMP . ' with time zone NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' with time zone NOT NULL',
        ], $tableOptions);

        $this->createTable(GlobalSettings::tableName(), [
            'key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'value' => Schema::TYPE_STRING . '(64) NOT NULL',
            'PRIMARY KEY (key)',
        ], $tableOptions);

        $this->db->createCommand()->batchInsert(GlobalSettings::tableName(), ['key', 'value'], [
            [GlobalSettings::DEFAULT_PW_EXPIRE_AFTER, '60'],
            [GlobalSettings::DEFAULT_PW_WARN_BEFORE, '7'],
        ])->execute();
    }

    public function safeDown()
    {
        $this->dropTable(User::tableName());
        $this->dropTable(GlobalSettings::tableName());
    }
}
