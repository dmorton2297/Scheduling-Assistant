<?php

use yii\db\Schema;
use yii\db\Migration;
use GLS\Audit\models\LogFacility as AuditLogFacility;
use GLS\Audit\models\LogSeverity as AuditLogSeverity;

class m150120_184833_log_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('audit_log_facilities', [
            'id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . '(32) NOT NULL',
            'PRIMARY KEY (id)',
        ], $tableOptions);

        $this->createTable('audit_log_severities', [
            'id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . '(32) NOT NULL',
            'PRIMARY KEY (id)',
        ], $tableOptions);

        $this->createTable('audit_log', [
            'id' => Schema::TYPE_BIGPK,
            'user_id' => Schema::TYPE_INTEGER,
            'facility_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'severity_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'message' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP . ' with time zone NOT NULL',
            'FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE RESTRICT ON UPDATE CASCADE',
            'FOREIGN KEY (facility_id) REFERENCES audit_log_facilities (id) ON DELETE RESTRICT ON UPDATE CASCADE',
            'FOREIGN KEY (severity_id) REFERENCES audit_log_severities (id) ON DELETE RESTRICT ON UPDATE CASCADE',
        ], $tableOptions);

        $this->db->createCommand()->batchInsert('audit_log_facilities', ['id', 'name'], [
            [0, 'System'],
            [1, 'Users'],
        ])->execute();

        $this->db->createCommand()->batchInsert('audit_log_severities', ['id', 'name'], [
            [0, 'Emergency'],
            [1, 'Alert'],
            [2, 'Critical'],
            [3, 'Error'],
            [4, 'Warning'],
            [5, 'Notice'],
            [6, 'Info'],
            [7, 'Debug'],
        ])->execute();

        GLS\Audit\Logger::log('Database initialized.', GLS\Audit\Logger::LOG_SYSTEM, GLS\Audit\Logger::LOG_INFO);
    }

    public function safeDown()
    {
        $this->dropTable('audit_log');
        $this->dropTable('audit_log_facilities');
        $this->dropTable('audit_log_severities');

        return true;
    }
}
