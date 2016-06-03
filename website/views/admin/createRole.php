<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Create Role';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'Role Management', 'url' => 'roles'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'create-role-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'description') ?>

                <div class="form-group">
                    <?= Html::submitButton('Create Role', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
