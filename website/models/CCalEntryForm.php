<?php 
namespace website\models;

use Yii;
use yii\base\Model; 
use GLS\Audit\Logger;

class CCalEntryForm extends Model 
{
    // Model values --------
	public $title;
	public $description;
    public $notes;
    public $startTimeHour;
    public $startTimeDayVal;
    public $endTimeHour;
    public $endTimeDayVal;
    // -----------------------

    // rules for form in entry.php
	public function rules() 
	{
		return [
			[['title', 'description', 'startTimeDayVal', 'startTimeHour', 'endTimeHour', 'endTimeDayVal'], 'required'],		
		];
	}	

    public function createEntry() 
    {

      //  if (is_null($title)) {
        //    echo "it is null";
       // }
       // echo "test";
        echo $this->title;
        echo "\n";
        echo $this->description;
        echo "\n";
        echo $this->notes;
        echo "\n";
        echo $this->startTimeHour;
        echo $this->startTimeDayVal;
        echo "\n";
        echo $this->endTimeHour;
        echo $this->endTimeDayVal;

        return;
    }
}
