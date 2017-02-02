<?php 
namespace website\controllers;

use Yii;
use yii\web\Controller;
use GLS\Audit\Logger;

//all methods in this controller are exclusive to the engineer role

class EngineerController extends Controller 
{
    // allow engineer to view pending requests
    // for calendar event from PM's 
    public function actionViewCalendarRequests() 
    {

    }
    
    // allow and engineer to accept a request for a calendar entry
    // from a project manager
    public function actionApproveCalendarRequests()
    {

    }   
} 
