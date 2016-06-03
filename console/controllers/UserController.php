<?php
namespace console\controllers;

use Yii;
use \yii\console\Controller;
use \yii\helpers\Console;
use \yii\validators\EmailValidator;
use common\models\User;
use GLS\Audit\Logger;

/**
 * Manage system users.
 */
class UserController extends Controller
{
    /**
     * Create a new user.
     * @param string $uname the message to be echoed.
     * @returns integer Return value
     */
    public function actionCreate($uname)
    {
        $this->stdout("Create User: $uname\n\n", Console::BOLD);

        $genPass = Yii::$app->security->generateRandomString(15);

        $email = trim($this->prompt("Enter email address:",
            array('required' => true, 'validator' => array($this, 'validateEmail'))));

        $firstname = trim($this->prompt("First Name:", array('required' => true)));
        $lastname = trim($this->prompt("Last Name:", array('required' => true)));

        $this->stdout("\nName: ", Console::BOLD);
        $this->stdout("$firstname $lastname\n");
        $this->stdout("User: ", Console::BOLD);
        $this->stdout($uname . "\n");
        $this->stdout("Email: ", Console::BOLD);
        $this->stdout($email . "\n");
        $contResponse = substr(strtolower(trim($this->prompt("Do you wish to continue (y/n)?",
        array('required' => true)))), 0, 1);

        if ($contResponse === 'y') {
            $user = new User();
            $user->username = $uname;
            $user->email = $email;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->setPassword($genPass);
            $user->generateAuthKey();
            if (!$user->validate()) {
                foreach ($user->getErrors() as $error) {
                    $this->stdout($error[0] . "\n", Console::FG_RED, Console::BOLD);
                }
                return Controller::EXIT_CODE_ERROR;
            }
            $user->save();
            Logger::log(sprintf("User %s created via system console.", $user->username), Logger::LOG_USERS, Logger::LOG_NOTICE);
            $this->stdout("User Created with Temporary Password: ");
            $this->stdout($genPass, Console::BOLD);
            $this->stdout("\n");
        } else {
            $this->stdout("Not saving (per request)....\n");
        }

        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * Remove a user from the database.
     * @param string $uname the message to be echoed.
     * @returns integer Return value
     */
    public function actionDelete($uname)
    {
        /* @var $user \common\models\User */
        $user = User::findByUsername($uname);

        if (!$user) {
            $this->stdout("Unable to find user.\n", Console::FG_RED);

            return Controller::EXIT_CODE_ERROR;
        }

        $confirmDelete = strtolower(trim($this->prompt("Are you sure you want to delete $uname? (yes/no) ",
            array('required' => true,))));
        if ($confirmDelete != 'yes') {
            $this->stdout("Not removing.\n", Console::FG_RED);

            return Controller::EXIT_CODE_NORMAL;
        }

        Logger::log(sprintf("User %s deleted via system console.", $user->username), Logger::LOG_USERS, Logger::LOG_NOTICE);
        $user->delete();
        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * Promote a user to administrator.
     * @param string $uname the message to be echoed.
     * @returns integer Return value
     */
    public function actionPromote($uname)
    {
        $auth = \Yii::$app->authManager;
        $admin = $auth->getRole('System Admin');
        /* @var $user \common\models\User */
        $user = User::findByUsername($uname);

        if (!$user) {
            $this->stdout("Unable to find user.\n", Console::FG_RED);

            return Controller::EXIT_CODE_ERROR;
        }

        Logger::log(sprintf("User %s promoted to system admin via system console.", $user->username), Logger::LOG_USERS, Logger::LOG_NOTICE);
        $auth->assign($admin, $user->getId());

        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * Demote a user to a normal user.
     * @param string $uname the message to be echoed.
     * @returns integer Return value
     */
    public function actionDemote($uname)
    {
        $auth = \Yii::$app->authManager;
        $admin = $auth->getRole('admin');
        /* @var $user \common\models\User */
        $user = User::findByUsername($uname);

        if (!$user) {
            $this->stdout("Unable to find user.\n", Console::FG_RED);

            return Controller::EXIT_CODE_ERROR;
        }

        Logger::log(sprintf("User %s demoted via system console.", $user->username), Logger::LOG_USERS, Logger::LOG_NOTICE);
        $auth->revoke($admin, $user->getId());

        return Controller::EXIT_CODE_NORMAL;

    }

    /**
     * List all users in the database.
     */
    public function actionList()
    {
        $users = User::find()->asArray()->all();

        $this->stdout(sprintf("%4s  %-15s %-15s %-15s %-25s\n", "ID", "User", "First Name", "Last Name", "Email Address"), Console::BOLD);
        foreach ($users as $user) {
            $this->stdout(sprintf("%4s  %-15s %-15s %-15s %-25s\n", $user['id'], $user['username'], $user['firstname'], $user['lastname'], $user['email']));
        }

        return Controller::EXIT_CODE_NORMAL;
    }

    /**
     * Verify an email address it valid.  Used in actionCreate.
     * @param string $input the message to be echoed.
     * @param string &$error the error to echo, if any.
     * @returns boolean Return value
     */
    public static function validateEmail($input, &$error)
    {
        $emailValidator = new EmailValidator;
        if ($emailValidator->validate($input, $error)) {
            return true;
        } else {
            $error = "Invalid Email Address!";

            return false;
        }
    }
}
