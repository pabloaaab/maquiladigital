<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VacacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_vacacion') ?>

    <?= $form->field($model, 'id_empleado') ?>

    <?= $form->field($model, 'id_contrato') ?>

    <?= $form->field($model, 'id_grupo_pago') ?>

    <?= $form->field($model, 'fecha_desde') ?>

    <?php // echo $form->field($model, 'fecha_hasta') ?>

    <?php // echo $form->field($model, 'fecha_proceso') ?>

    <?php // echo $form->field($model, 'fecha_ingreso') ?>

    <?php // echo $form->field($model, 'fecha_inicio_disfrute') ?>

    <?php // echo $form->field($model, 'fecha_final_disfrute') ?>

    <?php // echo $form->field($model, 'dias_disfrutados') ?>

    <?php // echo $form->field($model, 'dias_pagados') ?>

    <?php // echo $form->field($model, 'dias_total_vacacion') ?>

    <?php // echo $form->field($model, 'dias_real_disfrutados') ?>

    <?php // echo $form->field($model, 'salario_contrato') ?>

    <?php // echo $form->field($model, 'salario_promedio') ?>

    <?php // echo $form->field($model, 'total_pago_vacacion') ?>

    <?php // echo $form->field($model, 'vlr_vacacion_disfrute') ?>

    <?php // echo $form->field($model, 'vlr_vacacion_dinero') ?>

    <?php // echo $form->field($model, 'vlr_recargo_nocturno') ?>

    <?php // echo $form->field($model, 'dias_ausentismo') ?>

    <?php // echo $form->field($model, 'descuento_eps') ?>

    <?php // echo $form->field($model, 'descuento_pension') ?>

    <?php // echo $form->field($model, 'total_descuentos') ?>

    <?php // echo $form->field($model, 'total_bonificaciones') ?>

    <?php // echo $form->field($model, 'estado_autorizado') ?>

    <?php // echo $form->field($model, 'estado_cerrado') ?>

    <?php // echo $form->field($model, 'estado_anulado') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <?php // echo $form->field($model, 'nro_pago') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
