<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idproducto') ?>

    <?= $form->field($model, 'codigoproducto') ?>

    <?= $form->field($model, 'producto') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'costoconfeccion') ?>

    <?php // echo $form->field($model, 'vlrventa') ?>

    <?php // echo $form->field($model, 'idcliente') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'fechaproceso') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <?php // echo $form->field($model, 'idprendatipo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
