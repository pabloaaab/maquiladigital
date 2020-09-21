<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrestacionesSocialesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestaciones-sociales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_prestacion') ?>

    <?= $form->field($model, 'id_empleado') ?>

    <?= $form->field($model, 'id_contrato') ?>

    <?= $form->field($model, 'documento') ?>

    <?= $form->field($model, 'nro_pago') ?>

    <?php // echo $form->field($model, 'id_grupo_pago') ?>

    <?php // echo $form->field($model, 'fecha_inicio_contrato') ?>

    <?php // echo $form->field($model, 'fecha_termino_contrato') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'dias_primas') ?>

    <?php // echo $form->field($model, 'ibp_prima') ?>

    <?php // echo $form->field($model, 'dias_ausencia_prima') ?>

    <?php // echo $form->field($model, 'dias_cesantias') ?>

    <?php // echo $form->field($model, 'ibp_cesantias') ?>

    <?php // echo $form->field($model, 'dias_ausencia_primas') ?>

    <?php // echo $form->field($model, 'interes_cesantia') ?>

    <?php // echo $form->field($model, 'porcentaje_intreres') ?>

    <?php // echo $form->field($model, 'dias_vacaciones') ?>

    <?php // echo $form->field($model, 'ibp_vacaciones') ?>

    <?php // echo $form->field($model, 'dias_ausencia_vacaciones') ?>

    <?php // echo $form->field($model, 'total_deduccion') ?>

    <?php // echo $form->field($model, 'total_devengado') ?>

    <?php // echo $form->field($model, 'total_pagar') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
