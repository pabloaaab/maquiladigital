<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoEquivalente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-equivalente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'identificacion')->textInput() ?>

    <?= $form->field($model, 'nombre_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'idmunicipio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'subtotal')->textInput() ?>

    <?= $form->field($model, 'retencion_fuente')->textInput() ?>

    <?= $form->field($model, 'porcentaje')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
