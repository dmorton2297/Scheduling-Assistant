<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \website\models\ResetPasswordForm */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">


    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'newPassword1')->passwordInput(array('autocomplete' => 'off'))->label('New Password') ?>
                <?= $form->field($model, 'newPassword2')->passwordInput(array('autocomplete' => 'off'))->label('Confirm New Password') ?>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
