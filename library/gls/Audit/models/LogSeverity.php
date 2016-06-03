<?php
namespace GLS\Audit\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Log model
 *
 * @property integer $id
 * @property integer $name
 */
class LogSeverity extends ActiveRecord
{
    public

    function __construct($config = []) {
        return parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audit_log_severities';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['severity_id' => 'id']);
    }
}
