<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ThreadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Threads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="threads-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Threads', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class'=>'kartik\grid\SerialColumn'],
            [
                'attribute'=>'id', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->title;
                },
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'group'=>true,  // enable grouping
            ],
            [
                'class' => '\kartik\grid\DataColumn', 
                'attribute'=>'comment_id', 
                'width'=>'250px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->comments->id;
                },
                'group'=>true,  // enable grouping
                'subGroupOf'=>1 // supplier column index is the parent group
            ],
            'user_id'
        ]
    ]); ?>
</div>
