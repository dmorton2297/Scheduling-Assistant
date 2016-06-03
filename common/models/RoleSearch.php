<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Role model
 *
 * @property string $name
 * @property string $description
 */
class RoleSearch extends ActiveRecord
{
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['name', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * Finds role by name
     *
     * @param string $rolename
     * @return static|null
     */
    public static function findByRolename($rolename)
    {
        return static::findOne(['name' => $rolename]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public static function find()
    {
        $object = parent::find();
        $object->andFilterWhere(['type' => 1]);

        return $object;
    }

    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        // load the seach form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['ILIKE', 'name', $this->name]);
        $query->andFilterWhere(['ILIKE', 'description', $this->description]);

        return $dataProvider;
    }
}
