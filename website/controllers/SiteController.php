<?php
namespace website\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use website\models\CCalEntryForm;
use website\models\CCalEntry;
use common\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * Site controller
 */
class SiteController extends Controller
{
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
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['auth/login']);
        }
        return $this->render('index');
    }

    public function actionCalendar()
    {
        return $this->render('calendar');
    }
    
    public function actionCalendarEntry() 
    {
        $times = array('1000' => '1:00', 
            '2000' => '2:00',
            '3000' => '3:00', 
            '4000' => '4:00', 
            '5000' => '5:00', 
            '6000' => '6:00',
            '7000' => '7:00',  
            '8000' => '8:00', 
            '9000' => '9:00',
            '1000' => '10:00',
            '1100' => '11:00',
            '1200' => '12:00' );
        $model = new CCalEntryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //echo "we are here";
            $record = new CCalEntry();
            $record->title = $model->title;
            $record->description = $model->description;
            $record->notes = $model->notes;

            //figuring out military times NEED TO ADD MINUTES
           /* if ($model -> startTimeDayVal === 'pm') { 
                $model -> startTimeHour = $model -> startTimeHour + 1200;
            }
            
            if ($model -> endTimeDayVal === 'pm') { 
                $model -> endTimeHour = $model -> endTimeHour + 1200;
            }  

            $record -> start_time = $model -> startTimeHour;
            $record -> end_time = $model -> endTimeHour;
            */

            $record -> start = date("Y-m-d H:i:s");
            $record -> end = date("Y-m-d H:i:s");
            $record -> created_at = date("Y-m-d H:i:s");   
            $record -> updated_at = date("Y-m-d H:i:s");  
            $record -> id = 1;  
            $user = Yii::$app->user; 
            $record -> user_id = $user->id;

           // echo $record -> id;
           //echo $record -> user_id;
            //echo $record -> title;
          // echo $record -> description;
           echo $record -> notes;
           //echo $record -> start;
          // echo $record -> end;
           //echo $record -> updated_at;
          // echo $record -> created_at;
           if ($record -> save()) {
            } else {
                echo $record->getErrors();
            } 
            return;
        }
       return $this->render('entry', ['model'=> $model, 'times'=> $times]); 
    }
	
}
