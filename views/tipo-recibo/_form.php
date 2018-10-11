<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoRecibo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-recibo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idtiporecibo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
