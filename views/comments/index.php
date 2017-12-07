<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
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
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'group'=>true,  
            ],
            [
                'attribute'=>'body', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->body;
                },
            ]
        ]
    ]); ?>
</div>
