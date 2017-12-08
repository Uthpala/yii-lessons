<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\Depdrop;
?>

<div class="reply-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'thread_id')
        ->dropDownList(ArrayHelper::map($threads,'id','title'), ['id'=>'thread-id', 'prompt' => 'Select Thread']) ?>

    <?= $form->field($model, 'comment_id')->widget(DepDrop::classname(), [
            'options'=>['id'=>'comment-id'],
            'pluginOptions'=>[
                'depends'=>['thread-id'],
                'placeholder'=>'Select Comment',
                'url'=>Url::to(['/comments/thread'])
            ]
        ]); ?>

    <?= $form->field($model, 'reply')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
