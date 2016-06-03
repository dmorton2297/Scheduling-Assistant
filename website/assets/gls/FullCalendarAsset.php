<?php

namespace website\assets\gls;

use yii\web\AssetBundle;
use yii;

class FullCalendarAsset extends AssetBundle
{
    public function init() {
        $this->css[] = (YII_DEBUG ? 'css/fullcalendar.css' : 'css/fullcalendar.min.css');
        $this->js[] = (YII_DEBUG ? 'js/dev/moment.js' : 'js/moment.min.js');
        $this->js[] = (YII_DEBUG ? 'js/dev/fullcalendar.js' : 'js/fullcalendar.min.js');

        return parent::init();
    }
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [];

    public $js = [];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
