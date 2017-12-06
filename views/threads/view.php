<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Threads */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="threads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php 
        if ($model->belongsToLoggedInUser()) { ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php  } ?> 
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'body:ntext',
        ],
    ]) ?>
    <ul id="comments-list">
    <?php 
    $commentArray = $model->comments;
    foreach( $commentArray as $comment ){
        echo "<li>".$comment->body."</li>";
    }
    ?>
    </ul>
    <h1 id="comment-error"></h1>
    <?= $this->render('/comments/create',[
            'model'=>$comments, 
        ]);
    ?>
    <?php 
    $images = $model->images;
    foreach( $images as $image ){
        echo "<img src='".$image->image_path."' />";
    }
    ?>
</div>
