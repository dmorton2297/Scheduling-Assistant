<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
/* @var $userId integer */

$this->registerJsFile(\Yii::$app->homeUrl . 'js/admin/editUser.js', ['depends' => ['yii\web\JqueryAsset']]);

$this->title = 'Edit User';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = ['label' => 'User Management', 'url' => 'users'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="edit-user-form">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'edit-user-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'firstname') ?>
                <?= $form->field($model, 'lastname') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password_expire_after')->input('text',
                    ['style' => 'width: 100px;'])->label('Expire Password Every (days):') ?>
                <?= $form->field($model, 'password_warn_before')->input('text',
                    ['style' => 'width: 100px;'])->label('Warn Days Before Expiry:') ?>
                <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-5">
            <div class="form-group field-roleList">
                <label class="control-label" for="roleList" style="display: block;">Available Roles:</label>
                <?php
                $data = [];
                foreach (\Yii::$app->authManager->getRoles() as $role) {
                    if ($role->name == 'System Admin' && !Yii::$app->user->can('manageSystem')) continue;
                    $data = array_merge($data, [$role->name => $role->name]);
                }
                echo Select2::widget([
                    'id' => 'roleList',
                    'name' => 'roleList',
                    'value' => '',
                    'data' => array_merge(["" => ""], $data),
                    'language' => 'en',
                    'options' => [
                        'placeholder' => 'Select a role...',
                        'style' => 'width: 300px; display: inline-block; clear: left; margin-right: 10px;'
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
                echo \yii\bootstrap\Button::widget([
                    'id' => 'assignRole',
                    'label' => 'Add Role',
                    'options' => ['class' => 'btn-info'],
                ]);
                ?>
                <input type="hidden" id="userId" value="<?= $userId ?>" />
            </div>
            <div class="form-group field-roleList">
                <label class="control-label">Assigned Roles:</label>
                <?php
                $userRoles = \Yii::$app->authManager->getRolesByUser($userId);
                $data = [];
                foreach ($userRoles as $role) {
                    $data[] = ['roleName' => $role->name, 'userId' => $userId];
                }
                $provider = new \yii\data\ArrayDataProvider([
                    'allModels' => $data,
                    'sort' => [
                        'attributes' => ['roleName'],
                        'defaultOrder' => ['roleName' => SORT_ASC],
                    ],
                    'pagination' => [
                        'pageSize' => 5,
                    ],
                ]);
                echo \yii\grid\GridView::widget([
                    'columns' => [
                        [
                            'attribute' => 'roleName',
                            'format' => 'text',
                            'label' => 'Role',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'urlCreator' => function ($action, $model, $key, $index) {
                                return $action . '?id=' . $model['userId'] . '&role=' . $model['roleName'];
                            },
                            'contentOptions' => ['style' => 'width: 50px; text-align: center;'],
                            'template' => '{remove-user-role}',
                            'buttons' => [
                                'remove-user-role' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-minus"></span>', $url, [
                                        'title' => Yii::t('yii', 'Remove Role'),
                                        'data-pjax' => '0',
                                    ]);
                                },
                            ]
                        ],
                    ],
                    'dataProvider' => $provider,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
