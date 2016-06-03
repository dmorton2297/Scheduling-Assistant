<?php

use yii\db\Migration;

class m160602_174617_manager_pm_auth_item extends Migration
{
    public function up()
    {
	$this->insert('auth_item', array(
                'name'=>'Project Manager',
                'type'=>1,
                'description'=>'Allowd to check and request time from engineers scheudles',
                'rule_name'=>null,
                'data'=>null,
                'created_at'=> time(),
                'updated_at'=> time(),
        ));

	$this->insert('auth_item', array(
                'name'=>'Management',
                'type'=>1,
                'description'=>'Ability to override scheduels for engineers',
                'rule_name'=>null,
                'data'=>null,
                'created_at'=> time(),
                'updated_at'=> time(),
        ));

    }

    public function down()
    {
        echo "m160602_174617_manager_pm_auth_item cannot be reverted.\n";

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
