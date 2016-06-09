<?php

use yii\db\Migration;

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
        $this->createTable('calendar_event_table', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('calendar_event_table');
    }
}
