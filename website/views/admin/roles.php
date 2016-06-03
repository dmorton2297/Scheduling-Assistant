<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel yii\data\ActiveDataProvider */

$this->title = 'Role Management';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="margin-bottom: 10px;">
    <?= Html::a(Yii::t('app', 'Create {modelClass}', [
        'modelClass' => 'Role',
    ]), ['create-role'], ['class' => 'btn btn-success']) ?>
</div>
<div>
    <?php
    echo GridView::widget([
        'id' => 'rolesGrid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterPosition' => yii\grid\GridView::FILTER_POS_HEADER,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover table-gls'],
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'text',
                'label' => 'Role Name',
                'contentOptions' => ['style' => 'width: 200px;']
            ],
            [
                'attribute' => 'description',
                'format' => 'text',
                'label' => 'Description'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return $action . '-role?name=' . $key;
                },
                'contentOptions' => ['style' => 'width: 50px; text-align: center;'],
                'template' => '{edit} {remove}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        if (in_array($key, ['System Admin', 'User Admin'])) return null;

                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                            'title' => Yii::t('yii', 'Edit Role'),
                            'data-pjax' => '#gridPjax',
                        ]);
                    },
                    'remove' => function ($url, $model, $key) {
                        if (in_array($key, ['System Admin', 'User Admin'])) return null;

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Remove Role'),
                            'data-pjax' => '0',
                        ]);
                    },
                ]
            ],
        ],
    ]);
    ?>
</div>
