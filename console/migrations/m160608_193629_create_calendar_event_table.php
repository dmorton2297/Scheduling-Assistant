<?php

use yii\db\Migration;
USE yii\db\Schema;
/**
 * Handles the creation for table `calendar_event_table`.
 */
class m160608_193629_create_calendar_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('calendar_event_table', [
            'id' => $this->primaryKey(),
            'user_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . '(32) NOT NULL',
            'descrption' => Schema::TYPE_STRING, 
            'notes' => Schema::TYPE_STRING, 
            'start_time' => Schema::TYPE_INTEGER, 
            'end_time' => Schema::TYPE_INTEGER,
        ]);

        $this->addForeignKey("fk_user", "calendar_event_table", "user_id", "users", "id", "CASCADE", "RESTRICT");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('calendar_event_table');
    }
}
