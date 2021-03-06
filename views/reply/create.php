<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reply */

$this->title = 'Create Reply';
$this->params['breadcrumbs'][] = ['label' => 'Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'threads' => $threads
    ]) ?>

</div>
