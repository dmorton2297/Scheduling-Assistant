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
