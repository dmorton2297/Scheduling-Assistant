<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(['id' => 'c-cal-entry-form']); ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'description') ?>

    <?= Html::submitButton('Create Entry', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>

<?php ActiveForm::end(); ?>
