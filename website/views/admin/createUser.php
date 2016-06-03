<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => 'users'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'create-user-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'firstname') ?>
                <?= $form->field($model, 'lastname') ?>
                <?= $form->field($model, 'email') ?>

                <div class="form-group">
                    <?= Html::submitButton('Create User', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
