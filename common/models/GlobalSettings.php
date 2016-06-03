<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * GlobalSettings model
 *
 * @property string $key
 * @property string $value
 */
class GlobalSettings extends ActiveRecord
{
    const DEFAULT_PW_EXPIRE_AFTER = 'defaultPwExpireAfter';
    const DEFAULT_PW_WARN_BEFORE = 'defaultPwWarnBefore';

    /**
     * @inheritdoc
     */
    function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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

    /**
     * Finds setting value by key name
     *
     * @param string $key
     * @return string
     */
    public static function getValueByKey($key)
    {
        return static::findOne(['key' => $key])->value;
    }

    public static function setValueByKey($key, $value)
    {
        $setting = static::findOne(['key' => $key]);
        if (!$setting) return false;

        $setting->value = $value;
        $setting->save();
        return true;
    }
}
