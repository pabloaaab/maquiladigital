<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoProduccion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proceso-produccion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proceso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
