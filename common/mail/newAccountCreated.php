<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset-password', 'token' => $user->password_reset_token]);
?>

Hello <?= Html::encode($user->firstname) ?>,<br />
<br />
Your <?= Yii::$app->name ?> account has been created. Your username is "<?= $user->username ?>".<br />
<br />
<strong>Click the link below to set your password:</strong><br />
<br />
<?= Html::a(Html::encode($resetLink), $resetLink) ?><br />
<br />
If clicking the link above doesn't work, you can copy and paste the link into your browser's address bar, or retype it
there.