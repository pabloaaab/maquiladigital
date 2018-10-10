<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Banco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banco-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idbanco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nitbanco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccionbanco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefonobanco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'producto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numerocuenta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nitmatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
