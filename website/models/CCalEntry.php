<?php 
namespace website\models;

use Yii;
use yii\db\ActiveRecord;
use GLS\Audit\Logger;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
class CCalEntry extends ActiveRecord 
{

//---- Value parallel with database ------
    public $id;
    public $user_id;
    public $title;
    public $description;
    public $notes;
    public $start;
    public $end;
    public $updated_at;
    public $created_at;
// ---------------------------------------

    public static function tableName()
    {  
        return 'calendar_event';
    }
    


    // updates the timestamps 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }   
}
