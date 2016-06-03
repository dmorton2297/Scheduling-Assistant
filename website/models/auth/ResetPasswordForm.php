<?php
namespace website\models\auth;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $newPassword1;
    public $newPassword2;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
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
    public function resetPassword()
    {
        if ($this->newPassword1 != $this->newPassword2) {
            Yii::$app->getSession()->setFlash('error', 'New passwords do not match.');
            return false;
        }
        $user = $this->_user;
        $user->password = $this->newPassword1;
        $user->removePasswordResetToken();

        return $user->save();
    }
}
