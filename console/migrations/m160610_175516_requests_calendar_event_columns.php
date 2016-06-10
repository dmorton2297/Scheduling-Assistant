<?php

use yii\db\Migration;
use yii\db\Schema;
class m160610_175516_requests_calendar_event_columns extends Migration
{
    public function up()
    {
        $this->addColumn('calendar_event', 'approved', Schema::TYPE_BOOLEAN); 
        $this->addColumn('calendar_event', 'requested_user_id', Schema::TYPE_BIGINT); 
    
        $this->addForeignKey("fk_request_user", "calendar_event", "requested_user_id", "users", "id", "CASCADE", "RESTRICT");    
    }

    public function down()
    {
        echo "m160610_175516_requests_calendar_event_columns cannot be reverted.\n";

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
