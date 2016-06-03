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
class LogFacility extends ActiveRecord
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
        return 'audit_log_facilities';
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
        return $this->hasMany(Log::className(), ['facility_id' => 'id']);
    }
}
