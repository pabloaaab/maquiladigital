<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentoEquivalenteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-equivalente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'consecutivo') ?>

    <?= $form->field($model, 'identificacion') ?>

    <?= $form->field($model, 'nombre_completo') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'idmunicipio') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'valor') ?>

    <?php // echo $form->field($model, 'subtotal') ?>

    <?php // echo $form->field($model, 'retencion_fuente') ?>

    <?php // echo $form->field($model, 'porcentaje') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
