<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RemisionEntregaPrendasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="remision-entrega-prendas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_remision') ?>

    <?= $form->field($model, 'idcliente') ?>

    <?= $form->field($model, 'nro_remision') ?>

    <?= $form->field($model, 'fecha_entrega') ?>

    <?= $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'valor_total') ?>

    <?php // echo $form->field($model, 'valor_pagar') ?>

    <?php // echo $form->field($model, 'estado_remision') ?>

    <?php // echo $form->field($model, 'autorizado') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
