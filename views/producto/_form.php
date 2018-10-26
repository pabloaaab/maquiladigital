<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigoproducto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'producto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'costoconfeccion')->textInput() ?>

    <?= $form->field($model, 'vlrventa')->textInput() ?>

    <?= $form->field($model, 'idcliente')->textInput() ?>

    <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'fechaproceso')->textInput() ?>

    <?= $form->field($model, 'usuariosistema')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idprendatipo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
