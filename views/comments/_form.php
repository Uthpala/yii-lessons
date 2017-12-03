<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(['id'=>'commentsForm']); ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'thread_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


