<?php
namespace website\controllers;

use Yii;
use website\models\CCalEntryForm;
use common\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
            echo "Entry Created";
            return $this->render('calendar');
        }
       return $this->render('entry', ['model'=> $model, 'times'=> $times]); 
    }
	
}
