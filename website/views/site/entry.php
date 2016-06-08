<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrop\DropDownList;
?>

<?php $form = ActiveForm::begin(['id' => 'c-cal-entry-form']); ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'description') ?>
    <div>
        <h4> Start Time </h4>
        <?= Html::activeDropDownList($model, 'title', $times) ?>
    </div>
    <?= Html::submitButton('Create Entry', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>

<?php ActiveForm::end(); ?>
