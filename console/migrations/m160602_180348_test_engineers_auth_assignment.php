<?php

use yii\db\Migration;

class m160602_180348_test_engineers_auth_assignment extends Migration
{
    public function up()
    {
	$this->insert('auth_assignment', array( 

	));
    }

    public function down()
    {
        echo "m160602_180348_test_engineers_auth_assignment cannot be reverted.\n";

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
