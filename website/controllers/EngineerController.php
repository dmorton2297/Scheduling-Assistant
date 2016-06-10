<?php 
namespace website\controllers;

use yii;
use yii\web\Controller;
use GLS\Audit\Logger;

//all methods in this controller are exclusive to the engineer role

class EngineerController extends Controller 
{


    // allows engineer to edit an existing
    // calendar entry
    public function actionEditCalendarEvent() 
    {

    }
    
    // allows engineer to delete existing calendar
    // entry
    public function actionDeleteCalendarEvent() 
    {
        
    } 

    // allow engineer to view pending requests
    // for calendar event from PM's 
    public function actionViewCalendarRequests() 
    {

    }   
} 
