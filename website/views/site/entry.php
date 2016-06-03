<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(['id' => 'create-calendar-entry-form']); ?>
<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'description') ?>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
