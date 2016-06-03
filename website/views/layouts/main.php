<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use website\assets\AppAsset;
use website\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?= Html::cssFile(YII_DEBUG ? '@web/css/common.css' : '@web/css/common.min.css?v=' . filemtime(Yii::getAlias('@webroot/css/common.min.css'))) ?>
    <title>GLS Scheduling - <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-gls navbar-fixed-top',
                ],
            ]);
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                if (Yii::$app->user->can('manageUsers') || Yii::$app->user->can('manageSystem')) {
                    $adminItems = [];
                    if (Yii::$app->user->can('manageUsers')) {
                        $adminItems[] = ['label' => 'Manage Users', 'url' => ['/admin/users']];
                    }
                    if (Yii::$app->user->can('manageSystem')) {
                        $adminItems[] = ['label' => 'Manage Roles', 'url' => ['/admin/roles']];
                        $adminItems[] = ['label' => 'Access Logs', 'url' => ['/admin/logs']];
                    }

                    $menuItems[] = [
                        'label' => 'Admin',
                        'items' => $adminItems
                    ];
                }

                $menuItems[] = [
                    'label' => Yii::$app->user->identity->firstname,
                    'items' => [
                            ['label' => 'Change Password', 'url' => ['/auth/change-password']],
                            ['label' => 'Logout', 'url' => ['/auth/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ]
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container" style="position: absolute; top: 0; bottom: 0;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div style="position: relative; width: 100%; height: 100%;">
            <?= $content ?>
        </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left small-text">&copy; <?= date('Y') ?> GLS, Inc.</p>
        <p class="pull-right small-text">
            This site, and any contents or web pages attached, contains confidential and proprietary<br />
            information that is intended for the exclusive use of GLS employees and authorized users.<br />
            Any unauthorized use of this system is unlawful.
        </p>
        </div>
    </footer>

    <?= Html::jsFile(YII_DEBUG ? '@web/js/dev/common.js' : '@web/js/common.min.js?v=' . filemtime(Yii::getAlias('@webroot/js/common.min.js'))) ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
