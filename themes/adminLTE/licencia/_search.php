<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LicenciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="licencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_licencia_pk') ?>

    <?= $form->field($model, 'codigo_licencia') ?>

    <?= $form->field($model, 'id_empleado') ?>

    <?= $form->field($model, 'id_contrato') ?>

    <?= $form->field($model, 'id_grupo_pago') ?>

    <?php // echo $form->field($model, 'fecha_desde') ?>

    <?php // echo $form->field($model, 'fecha_hasta') ?>

    <?php // echo $form->field($model, 'fecha_proceso') ?>

    <?php // echo $form->field($model, 'fecha_aplicacion') ?>

    <?php // echo $form->field($model, 'dias_licencia') ?>

    <?php // echo $form->field($model, 'afecta_transporte') ?>

    <?php // echo $form->field($model, 'cobrar_administradora') ?>

    <?php // echo $form->field($model, 'aplicar_adicional') ?>

    <?php // echo $form->field($model, 'pagar_empleado') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
