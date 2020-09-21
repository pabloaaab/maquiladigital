<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstudioEmpleadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudio-empleado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idmunicipio') ?>

    <?= $form->field($model, 'id_empleado') ?>

    <?= $form->field($model, 'documento') ?>

    <?= $form->field($model, 'id_tipo_estudio') ?>

    <?php // echo $form->field($model, 'institucion_educativa') ?>

    <?php // echo $form->field($model, 'titulo_obtenido') ?>

    <?php // echo $form->field($model, 'anio_cursado') ?>

    <?php // echo $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'fecha_terminacion') ?>

    <?php // echo $form->field($model, 'graduado') ?>

    <?php // echo $form->field($model, 'fecha_vencimiento') ?>

    <?php // echo $form->field($model, 'registro') ?>

    <?php // echo $form->field($model, 'validar_vencimiento') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
