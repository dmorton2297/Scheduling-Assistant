<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $role \yii\rbac\Role */

$this->title = 'Edit Role';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'Role Management', 'url' => 'roles'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edit-role-form">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'edit-role-form']); ?>
            <div class="form-group field-role-name">
                <label class="control-label" for="role-name">Role Name:</label>
                <input type="text" id="role-name" class="form-control" name="Role[name]" value="<?= $role->name ?>" />
                <p class="help-block help-block-error"></p>
            </div>
            <div class="form-group field-role-description">
                <label class="control-label" for="role-description">Description:</label>
                <input type="text" id="role-description" class="form-control" name="Role[description]" value="<?= $role->description ?>" />
                <p class="help-block help-block-error"></p>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Save Role', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
