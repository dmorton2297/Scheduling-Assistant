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
			[['title', 'description', 'startTimeDayVal', 'startTimeHour', 'endTimeHour', 'endTimeDayVal', 'notes'], 'required'],		
		];
	}
}
