<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgresoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comprobante-egreso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_comprobante_egreso') ?>

    <?= $form->field($model, 'id_municipio') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'fecha_comprobante') ?>

    <?= $form->field($model, 'numero') ?>

    <?php // echo $form->field($model, 'id_comprobante_egreso_tipo') ?>

    <?php // echo $form->field($model, 'valor') ?>

    <?php // echo $form->field($model, 'id_proveedor') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'autorizado') ?>

    <?php // echo $form->field($model, 'libre') ?>

    <?php // echo $form->field($model, 'id_banco') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
