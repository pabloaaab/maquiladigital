<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BancoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banco-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idbanco') ?>

    <?= $form->field($model, 'nitbanco') ?>

    <?= $form->field($model, 'entidad') ?>

    <?= $form->field($model, 'direccionbanco') ?>

    <?= $form->field($model, 'telefonobanco') ?>

    <?php // echo $form->field($model, 'producto') ?>

    <?php // echo $form->field($model, 'numerocuenta') ?>

    <?php // echo $form->field($model, 'nitmatricula') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
