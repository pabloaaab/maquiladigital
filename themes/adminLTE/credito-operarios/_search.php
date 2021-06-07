<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CreditoOperariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credito-operarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_credito') ?>

    <?= $form->field($model, 'id_operario') ?>

    <?= $form->field($model, 'codigo_credito') ?>

    <?= $form->field($model, 'vlr_credito') ?>

    <?= $form->field($model, 'vlr_cuota') ?>

    <?php // echo $form->field($model, 'numero_cuotas') ?>

    <?php // echo $form->field($model, 'numero_cuota_actual') ?>

    <?php // echo $form->field($model, 'validar_cuotas') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'saldo_credito') ?>

    <?php // echo $form->field($model, 'estado_credito') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
