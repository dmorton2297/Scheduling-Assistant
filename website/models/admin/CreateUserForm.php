<?php
namespace website\models\admin;

use Yii;
use yii\base\Model;
use common\models\User;
use GLS\Audit\Logger;

/**
 * Login form
 */
class CreateUserForm extends Model
{
    public $username;
    public $firstname;
    public $lastname;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'firstname', 'lastname', 'email'], 'required'],
        ];
    }

    public function createUser()
    {
        $user = new User();
        $user->username = $this->username;
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->email = $this->email;
        $user->setPassword(Yii::$app->security->generateRandomString(15));
        $user->generateAuthKey();

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        }

        if ($user->save()) {
            \Yii::$app->mailer->compose('newAccountCreated', ['user' => $user])
                    ->setFrom([\Yii::$app->params['passwordEmail'] => \Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('New ' . \Yii::$app->name . ' Account')
                    ->send();

            Logger::log(sprintf("User %s created.", $user->username), Logger::LOG_USERS, Logger::LOG_NOTICE);
        }
        return true;
    }
}
