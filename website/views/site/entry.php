<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrop\DropDownList;
?>

<?php $form = ActiveForm::begin(['id' => 'c-cal-entry-form']); ?>
    <?= $form->field($model, 'title') ?>
    <?= $form->field($model, 'description') ?>
    <?= $form->field($model, 'notes') ?>
    <div>
        <h4> Start Time</h4>
        <div style="float: left; margin-right:10px;">
            <?= Html::activeDropDownList($model, 'title', $times) ?>
        </div>
        <div style="margin-right:30px;">
            <?= Html::activeDropDownList($model, 'title', array('am'=>'AM', 'pm'=>'PM')) ?>
        </div>
    
        <h4> End Time </h4>
        <div style="float: left; margin-right:10px;">
            <?= Html::activeDropDownList($model, 'title', $times) ?>
        </div>
        
        <div style="margin-right:30px;margin-bottom:30px;">
            <?= Html::activeDropDownList($model, 'title', array('am'=>'AM', 'pm'=>'PM')) ?>
        </div>



    </div>
    <?= Html::submitButton('Create Entry', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>

<?php ActiveForm::end(); ?>
