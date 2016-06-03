<?php 
namespace website\models;

use Yii;
use yii\base\Model; 
use GLS\Audit\Logger;

class CCalEntryForm extends Model 
{
	public $title;
	public $description;
	public function rules() 
	{
		return [
			[['title', 'description'], 'required'],		
		];
	}	
}
