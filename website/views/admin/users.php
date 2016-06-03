<?php
use yii\helpers\Html;
use yii\bootstrap\ButtonGroup;
use yii\grid\GridView;
use website\assets\admin\UsersAsset;

UsersAsset::register($this);

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel yii\data\ActiveDataProvider */

$this->title = 'User Management';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>

<div style="margin-bottom: 10px;">
    <?= Html::a(Yii::t('app', 'Create {modelClass}', [
        'modelClass' => 'User',
    ]), ['create-user'], ['class' => 'btn btn-success']) ?>

    <?=
    ButtonGroup::widget([
        'buttons' => [
            [
                'label' => 'Active',
                'options' => ['id' => 'btn-active-users', 'class' => 'btn-default' . (!isset($_GET['UserSearch']['active']) ? ' active' : $_GET['UserSearch']['active'] ? ' active' : '')],
            ],
            [
                'label' => 'Inactive',
                'options' => ['id' => 'btn-inactive-users', 'class' => 'btn-default' . (isset($_GET['UserSearch']['inactive']) && $_GET['UserSearch']['inactive'] ? ' active' : '')],
            ],
        ],

    ]);
    ?>
<!--    <input type="hidden" class="additional-filters" data-pjax="#gridPjax" id="hdn-active-users" name="UserSearch[active]" value="1" />-->
<!--    <input type="hidden" class="additional-filters" data-pjax="#gridPjax" id="hdn-inactive-users" name="UserSearch[inactive]" value="0" />-->
</div>

<div>
    <?php
    \yii\widgets\Pjax::begin(['id' => 'gridPjax', 'enablePushState' => false]);
    ?>
    <input type="hidden" class="additional-filters" data-pjax="#gridPjax" id="hdn-active-users" name="UserSearch[active]" value="1" />
    <input type="hidden" class="additional-filters" data-pjax="#gridPjax" id="hdn-inactive-users" name="UserSearch[inactive]" value="0" />
    <?php
    echo GridView::widget([
        'id' => 'usersGrid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterPosition' => yii\grid\GridView::FILTER_POS_HEADER,
        'filterSelector' => '.additional-filters',
        'rowOptions' => function($model, $key, $index, $grid) {
            if ($model->status == 0) {
                return ['class' => 'disabled'];
            } else {
                return [];
            }
        },
        'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover table-gls'],
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'integer',
                'label' => 'ID',
                'contentOptions' => ['style' => 'width: 50px;']
            ],
            'username:text:User',
            'firstname:text:First Name',
            'lastname:text:Last Name',
            'email:text:Email Address',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return $action . '-user?id=' . $key;
                },
                'contentOptions' => ['style' => 'width: 100px; text-align: center;'],
                'template' => '{edit} {toggle-active} {reset}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        if (array_key_exists('manageSystem', \Yii::$app->authManager->getPermissionsByUser($model->id)) && !Yii::$app->user->can('manageSystem')) return null;

                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                            'title' => Yii::t('yii', 'Edit User'),
                            'data-pjax' => '#gridPjax',
                        ]);
                    },
                    'toggle-active' => function ($url, $model, $key) {
                        if (array_key_exists('manageSystem', \Yii::$app->authManager->getPermissionsByUser($model->id)) && !Yii::$app->user->can('manageSystem')) return null;

                        if ($model->status) {
                            return Html::a('<span class="glyphicon glyphicon-minus"></span>', $url, [
                                'title' => Yii::t('yii', 'Deactivate'),
                                'data-pjax' => '0',
                            ]);
                        } else {
                            return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                'title' => Yii::t('yii', 'Activate'),
                                'data-pjax' => '0',
                            ]);
                        }
                    },
                    'reset' => function ($url, $model, $key) {
                        if (array_key_exists('manageSystem', \Yii::$app->authManager->getPermissionsByUser($model->id)) && !Yii::$app->user->can('manageSystem')) return null;

                        return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, [
                            'title' => Yii::t('yii', 'Reset Password'),
                            'data-pjax' => '#gridPjax',
                        ]);
                    }
                ]
            ],
        ],
    ]);

    yii\widgets\Pjax::end(); ?>


</div>
