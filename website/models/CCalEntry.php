<?php 
namespace website\models;

use Yii;
use yii\db\ActiveRecord;
use GLS\Audit\Logger;

class CCalEntry extends ActiveRecord 
{

//---- Value parallel with database ------
    public $id;
    public $user_id;
    public $title;
    public $description;
    public $notes;
    public $start_time;
    public $end_time;
// ---------------------------------------

    public static function tableName()
    {   
        return 'calendar_event_table';
    }   
}
