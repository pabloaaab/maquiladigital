<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

    <h3><?= $msg ?></h3>

    <h1>Registro de Usuarios</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
    'id' => 'formulario',
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]);
?>

    <div class="row" id="registro">
        <div class="col-lg-5">
            <?= $form->field($model, "username")->input("text") ?>
            <?= $form->field($model, "password")->input("password") ?>
            <?= $form->field($model, "password_repeat")->input("password") ?>
            <?= $form->field($model, "role")->input("text") ?>
            <?= $form->field($model, "emailusuario")->input("email") ?>
            <?= $form->field($model, "nombrecompleto")->input("text") ?>
            <?= $form->field($model, "documentousuario")->input("text") ?>

        </div>

    </div>

<?= Html::submitButton("Registro", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>