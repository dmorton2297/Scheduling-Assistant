<?php

namespace website\assets\admin;

use yii\web\AssetBundle;

class UsersAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/admin/users.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
