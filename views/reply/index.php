<?php

use yii\helpers\Html;
use kartik\grid\GridView;


$this->title = 'Replies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class'=>'kartik\grid\SerialColumn'],
            [
                'attribute'=>'thread_id', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->thread->title;
                },
                'group'=>true,  
            ],
            [
                'attribute'=>'comment_id', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->comment->body;
                },
                'group'=>true,  
            ],
            'reply'
        ]
    ]); ?>
</div>

