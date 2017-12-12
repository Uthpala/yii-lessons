<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Threads;



$this->title = 'Replies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'columns' => [
            [
                'attribute'=>'thread_id', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->thread->title;
                },
                'group'=>true,  
            ],
            [
                'attribute'=>'created_at',
                'filterType'=>GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
            ],
            [
                'attribute'=>'comment_id', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->comment->body;
                },
                'group'=>true,  
                'pageSummary'=>true
            ],
            [
                'attribute'=>'reply',
                'width'=>'150px',
                'hAlign'=>'right',
                'format'=>['decimal', 2],
                'pageSummary'=>true
            ]
        ]
    ]); ?>
</div>

