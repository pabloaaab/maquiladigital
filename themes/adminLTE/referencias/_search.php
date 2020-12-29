<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReferenciasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referencias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_referencia') ?>

    <?= $form->field($model, 'id_producto') ?>

    <?= $form->field($model, 'codigo_producto') ?>

    <?= $form->field($model, 'existencias') ?>

    <?= $form->field($model, 'total_existencias') ?>

    <?php // echo $form->field($model, 'precio_costo') ?>

    <?php // echo $form->field($model, 'porcentaje_mayorista') ?>

    <?php // echo $form->field($model, 'porcentaje_deptal') ?>

    <?php // echo $form->field($model, 'precio_venta_mayorista') ?>

    <?php // echo $form->field($model, 'precio_venta_deptal') ?>

    <?php // echo $form->field($model, 'id_proveedor') ?>

    <?php // echo $form->field($model, 'estado_existencia') ?>

    <?php // echo $form->field($model, 'autorizado') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <?php // echo $form->field($model, 't2') ?>

    <?php // echo $form->field($model, 't4') ?>

    <?php // echo $form->field($model, 't6') ?>

    <?php // echo $form->field($model, 't8') ?>

    <?php // echo $form->field($model, 't10') ?>

    <?php // echo $form->field($model, 't12') ?>

    <?php // echo $form->field($model, 't14') ?>

    <?php // echo $form->field($model, 't16') ?>

    <?php // echo $form->field($model, 't18') ?>

    <?php // echo $form->field($model, 't20') ?>

    <?php // echo $form->field($model, 't22') ?>

    <?php // echo $form->field($model, 't24') ?>

    <?php // echo $form->field($model, 't26') ?>

    <?php // echo $form->field($model, 't28') ?>

    <?php // echo $form->field($model, 't30') ?>

    <?php // echo $form->field($model, 't32') ?>

    <?php // echo $form->field($model, 't34') ?>

    <?php // echo $form->field($model, 't36') ?>

    <?php // echo $form->field($model, 't38') ?>

    <?php // echo $form->field($model, 't40') ?>

    <?php // echo $form->field($model, 't42') ?>

    <?php // echo $form->field($model, 't44') ?>

    <?php // echo $form->field($model, 'xs') ?>

    <?php // echo $form->field($model, 's') ?>

    <?php // echo $form->field($model, 'm') ?>

    <?php // echo $form->field($model, 'l') ?>

    <?php // echo $form->field($model, 'xl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
