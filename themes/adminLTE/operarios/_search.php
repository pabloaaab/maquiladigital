<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OperariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_operario') ?>

    <?= $form->field($model, 'id_tipo_documento') ?>

    <?= $form->field($model, 'documento') ?>

    <?= $form->field($model, 'nombres') ?>

    <?= $form->field($model, 'apellidos') ?>

    <?php // echo $form->field($model, 'iddepartamento') ?>

    <?php // echo $form->field($model, 'idmunicipio') ?>

    <?php // echo $form->field($model, 'celular') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'usuariosistema') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
