<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/reset-password', 'token' => $user->password_reset_token]);
?>

Hello <?= Html::encode($user->firstname) ?>,<br />
<br />
We received a request to reset the password associated with this email address. If you made this request, please follow
the instructions below.<br />
<br />
If you did not request to have your password reset, you can safely ignore this email.<br />
<br />
<strong>Click the link below to reset your password:</strong><br />
<br />
<?= Html::a(Html::encode($resetLink), $resetLink) ?><br />
<br />
If clicking the link above doesn't work, you can copy and paste the link into your browser's address bar, or retype it
there.