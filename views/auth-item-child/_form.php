<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-child-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent')->textInput();?>  
    <hr/>

    <?= $form->field($model, 'children')->checkboxlist(ArrayHelper::map($allAuthItems, 'name', 'name'));?>  

    <?php ActiveForm::end(); ?>

</div>
