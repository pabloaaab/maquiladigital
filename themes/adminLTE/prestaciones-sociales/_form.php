<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrestacionesSociales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prestaciones-sociales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_empleado')->textInput() ?>

    <?= $form->field($model, 'id_contrato')->textInput() ?>

    <?= $form->field($model, 'documento')->textInput() ?>

    <?= $form->field($model, 'nro_pago')->textInput() ?>

    <?= $form->field($model, 'id_grupo_pago')->textInput() ?>

    <?= $form->field($model, 'fecha_inicio_contrato')->textInput() ?>

    <?= $form->field($model, 'fecha_termino_contrato')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'dias_primas')->textInput() ?>

    <?= $form->field($model, 'ibp_prima')->textInput() ?>

    <?= $form->field($model, 'dias_ausencia_prima')->textInput() ?>

    <?= $form->field($model, 'dias_cesantias')->textInput() ?>

    <?= $form->field($model, 'ibp_cesantias')->textInput() ?>

    <?= $form->field($model, 'dias_ausencia_primas')->textInput() ?>

    <?= $form->field($model, 'interes_cesantia')->textInput() ?>

    <?= $form->field($model, 'porcentaje_intreres')->textInput() ?>

    <?= $form->field($model, 'dias_vacaciones')->textInput() ?>

    <?= $form->field($model, 'ibp_vacaciones')->textInput() ?>

    <?= $form->field($model, 'dias_ausencia_vacaciones')->textInput() ?>

    <?= $form->field($model, 'total_deduccion')->textInput() ?>

    <?= $form->field($model, 'total_devengado')->textInput() ?>

    <?= $form->field($model, 'total_pagar')->textInput() ?>

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usuariosistema')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
