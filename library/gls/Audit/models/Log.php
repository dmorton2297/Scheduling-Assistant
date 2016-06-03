<?php
namespace GLS\Audit\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use common\models\User;

/**
 * Log model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $severity_id
 * @property integer $facility_id
 * @property string $message
 * @property string $created_at
 * @property LogFacility $facility
 * @property LogSeverity $severity
 */
class Log extends ActiveRecord
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
        return 'audit_log';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFacility()
    {
        return $this->hasOne(LogFacility::className(), ['id' => 'facility_id']);
    }

    public function getSeverity()
    {
        return $this->hasOne(LogSeverity::className(), ['id' => 'severity_id']);
    }
}
