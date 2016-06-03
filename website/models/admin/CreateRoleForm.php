<?php
namespace website\models\admin;

use Yii;
use yii\base\Model;
use GLS\Audit\Logger;

/**
 * Login form
 */
class CreateRoleForm extends Model
{
    public $name;
    public $description;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
        ];
    }

    public function createRole()
    {
        $auth = Yii::$app->authManager;

        $role = $auth->createRole($this->name);
        $role->description = $this->description;

        if ($auth->add($role)) {
            Logger::log(sprintf("Role %s created.", $role->name), Logger::LOG_USERS, Logger::LOG_NOTICE);
            return true;
        }
        return false;
    }
}
