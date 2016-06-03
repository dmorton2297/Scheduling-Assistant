<?php
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel yii\data\ActiveDataProvider */

$this->title = 'Access Logs';
$this->params['breadcrumbs'][] = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <?php
    $formatter = new yii\i18n\Formatter();
    $formatter->nullDisplay = '<span class="not-set">(system)</span>';
    $formatter->datetimeFormat = 'medium';
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterPosition' => yii\grid\GridView::FILTER_POS_HEADER,
        'layout' => "{summary}{pager}\n{items}\n{pager}",
        'summaryOptions' => ['style' => 'float: left; display: inline-block; margin-top: 10px;'],
        'pager' => ['options' => ['class' => 'pagination', 'style' => 'float: right; display: inline-block; margin: 0 0 20px 0;']],
        'formatter' => $formatter,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-condensed table-hover table-gls', 'style' => 'clear: both;'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            if ($model->severity->id <= 3) {
                return ['class' => 'danger'];
            } elseif ($model->severity->id <= 4) {
                return ['class' => 'warning'];
            } else {
                return [];
            }
        },
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'integer',
                'label' => 'ID',
                'contentOptions' => ['style' => 'width: 50px;']
            ],
            [
                'attribute' => 'user.username',
                'label' => 'User',
            ],
            [
                'attribute' => 'facility.name',
                'label' => 'Facility',
            ],
            [
                'attribute' => 'severity.name',
                'label' => 'Severity',
            ],
            'message:text:Message',
            'created_at:datetime:Timestamp',
        ],
    ]);

    Pjax::end(); ?>
</div>