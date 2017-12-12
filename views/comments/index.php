<?php

use yii\helpers\Html;
use kartik\grid\GridView;
$this->title = 'Auth Item Children';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Auth Item Child', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'body',
            ['class' => 'yii\grid\ActionColumn'],
        ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>true,
        'columns' => $columns,
    ]); ?>
</div>
