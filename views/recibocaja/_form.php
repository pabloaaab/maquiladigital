<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recibocaja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecharecibo')->textInput() ?>

    <?= $form->field($model, 'fechapago')->textInput() ?>

    <?= $form->field($model, 'idtiporecibo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idmunicipio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valorpagado')->textInput() ?>

    <?= $form->field($model, 'valorletras')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'idcliente')->textInput() ?>

    <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usuariosistema')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
