<?php

use yii\db\Migration;

class m160602_170743_add_engineer_auth_item extends Migration
{
    public function up()
    {
	$this->insert('auth_item', array(
		'name'=>'Engineer',
		'type'=>1,
		'description'=>'Allowed to check and update schedule(WILL BE UPDATED)',
		'rule_name'=>null,
		'data'=>null,
		'created_at'=>Schema::CURRENT_TIMESTAMP,
		'updated_at'=>Schema::CURRENT_TIMESTAMP,
	));
    }

    public function down()
    {
        echo "m160602_170743_add_engineer_auth_item cannot be reverted.\n";
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
