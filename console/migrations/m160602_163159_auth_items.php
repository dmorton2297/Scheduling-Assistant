<?php

use yii\db\Migration;

class m160602_163159_auth_items extends Migration
{
    public function up()
    {
	$this->createTable('auth_items', array(
		'name' => 'string NOT NULL',
		'type' => 'pk',
		'description' => 'text',
		'rule_name' => 'string',
		'data' => 'string',
	));
    }

    public function down()
    {

	$this->dropTable('auth_items');
        //echo "m160602_163159_auth_items cannot be reverted.\n";

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
