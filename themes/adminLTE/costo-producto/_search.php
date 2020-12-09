<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CostoProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="costo-producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_producto') ?>

    <?= $form->field($model, 'codigo_producto') ?>

    <?= $form->field($model, 'id_tipo_producto') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'costo_sin_iva') ?>

    <?php // echo $form->field($model, 'costo_con_iva') ?>

    <?php // echo $form->field($model, 'porcentaje_iva') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
