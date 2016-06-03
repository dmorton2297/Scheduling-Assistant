<?php
namespace website\models\auth;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;
use yii\db\Expression;

/**
 * Password reset form
 */
class PasswordChangeForm extends Model
{
    public $oldPassword;
    public $newPassword1;
    public $newPassword2;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($config = [])
    {
        $this->_user = User::findIdentity(\Yii::$app->user->id);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['oldPassword', 'required'],
            ['oldPassword', 'string', 'min' => 6],
            ['newPassword1', 'required'],
            ['newPassword1', 'string', 'min' => 8],
            ['newPassword2', 'required'],
            ['newPassword2', 'string', 'min' => 8],
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function changePassword()
    {
        /**
         * @var \common\models\User
         */
        $user = $this->_user;

        if (!$user->validatePassword($this->oldPassword)) {
            Yii::$app->getSession()->setFlash('error', 'Incorrect Password.');
            return false;
        }
        if ($this->newPassword1 != $this->newPassword2) {
            Yii::$app->getSession()->setFlash('error', 'New passwords do not match.');
            return false;
        }
        $user->password = $this->newPassword1;
        $user->removePasswordResetToken();
        $user->password_last_change = new Expression('NOW()');

        return $user->save();
    }
}
