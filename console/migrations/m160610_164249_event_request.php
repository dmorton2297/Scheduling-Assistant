<?php

use yii\db\Migration;
use yii\db\Schema;

class m160610_164249_event_request extends Migration
{
    public function up()
    {
        $this->createTable('event_request', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_BIGINT,
            'requested_user_id' => Schema::TYPE_BIGINT,
            'created_at' => Schema::TYPE_TIMESTAMP . ' with time zone NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' with time zone NOT NULL',
            'start' => Schema::TYPE_DATETIME,
            'end' => Schema::TYPE_DATETIME,
            'title' => Schema::TYPE_STRING.'(32) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'notes' => Schema::TYPE_TEXT,    
        ]);

        
         $this->addForeignKey("fk_user", "event_request", "user_id", "users", "id", "CASCADE", "RESTRICT");
         $this->addForeignKey("fk_requested_user", "event_request", "requested_user_id", "users", "id", "CASCADE", "RESTRICT"); 
    }

    public function down()
    {
        $this->dropTable('event_request');
        return true;
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
