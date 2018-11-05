<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReciboCajaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recibocaja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idrecibo') ?>

    <?= $form->field($model, 'fecharecibo') ?>

    <?= $form->field($model, 'fechapago') ?>

    <?= $form->field($model, 'idtiporecibo') ?>

    <?= $form->field($model, 'idmunicipio') ?>

    <?php // echo $form->field($model, 'valorpagado') ?>

    <?php // echo $form->field($model, 'valorletras') ?>

    <?php // echo $form->field($model, 'idcliente') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
