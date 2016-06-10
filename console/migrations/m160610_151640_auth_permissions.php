<?php

use yii\db\Migration;
use yii\db\Schema;
use yii\rbac\DbManager;

class m160610_151640_auth_permissions extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $createEvent = $auth->createPermission('createEvent');
        $createEvent->description = 'Able to create calendar events for the current user';
        $auth->add($createEvent);

        $approveEvent = $auth->createPermission('approveEvent');
        $approveEvent->description = 'Able to approve a requested event to the current users calendar';
        $auth->add($approveEvent);

        $requestEvent = $auth->createPermission('requestEvent');
        $requestEvent->description = 'Able to request an event for a user to accept';
        $auth->add($requestEvent);

        $createEventForUser = $auth->createPermission('createEventForUser');
        $createEventForUser->description = 'Able to create an event for a certain user';
        $auth->add($createEventForUser);
        
        $overrideScheduledEvent = $auth->createPermission('overrideScheduledEvent');
        $overrideScheduledEvent->description = 'Able to override a scheduled event for a user';
        $auth->add($overrideScheduledEvent);

        $viewCalendarOfUser = $auth->createPermission('viewCalendarOfUser');
        $viewCalendarOfUser->description = 'Able to view calendar of a certain user';
        $auth->add($viewCalendarOfUser);
        
        $viewCalendar = $auth->createPermission('viewCalendar');
        $viewCalendar->description = 'Can view calendar of current user';
        $auth->add($viewCalendar);

        $deleteEvent = $auth->createPermission('deleteEvent');
        $deleteEvent->description = 'Can delete an event from the current user';
        $auth->add($deleteEvent);

        $editEvent = $auth->createPermission('editEvent');
        $editEvent->description = 'Can Edit and event for a user';
        $auth->add($editEvent);

        $engineer = $auth->createRole('Engineer');
        $engineer->description = 'Able to create, edit, delete, and view their calendar';
        $auth->add($engineer);
        $auth->addChild($engineer, $createEvent);
        $auth->addChild($engineer, $deleteEvent);
        $auth->addChild($engineer, $editEvent);
        $auth->addChild($engineer, $viewCalendar);

        $projectManager = $auth->createRole('Project Manager');
        $projectManager->description = 'Able to view calendar of different users,  request events, create event for user, as well as all of the permissions of a user';
        $auth->add($projectManager);
        $auth->addChild($projectManager, $engineer);
        $auth->addChild($projectManager, $requestEvent);
        $auth->addChild($projectManager, $createEventForUser);
        $auth->addChild($projectManager, $viewCalendarOfUser);

        $management = $auth->createRole('management');
        $management->description = 'Can view the calendars of any employee on server';
        $auth->add($management);
        $auth->addChild($management, $viewCalendarOfUser);

   } 

    public function down()
    {
        echo "m160610_151640_auth_permissions cannot be reverted.\n";

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
