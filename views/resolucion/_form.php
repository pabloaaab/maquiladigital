<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resolucion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resolucion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nroresolucion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desde')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hasta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fechavencimiento')->textInput() ?>

    <?= $form->field($model, 'nitmatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
