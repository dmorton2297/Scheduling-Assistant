<?php

use yii\db\Migration;
use yii\db\Schema;


/**
 * Handles the creation for table `calendar_event_table`.
 */
class m160609_180500_create_calendar_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('calendar_event', [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_TIMESTAMP . ' with time zone NOT NULL',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' with time zone NOT NULL',
            'start' => Schema::TYPE_DATETIME,
            'end' => Schema::TYPE_DATETIME,
            'title' => Schema::TYPE_STRING.'(32) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'notes' => Schema::TYPE_TEXT,         
            'user_id' => Schema::TYPE_INTEGER,
        ]);


         $this->addForeignKey("fk_user", "calendar_event", "user_id", "users", "id", "CASCADE", "RESTRICT");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('calendar_event');
    }
}
