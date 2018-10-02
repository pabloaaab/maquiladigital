<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamentos;
use app\models\TipoDocumento;

$this->title = 'Nuevo Cliente';
?>

<h1>Nuevo Cliente</h1>
<?php if ($tipomsg == "danger") { ?>
    <h3 class="alert-danger"><?= $msg ?></h3>
<?php } else{ ?>
    <h3 class="alert-success"><?= $msg ?></h3>
<?php } ?>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'id' => 'formulario',
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]);
?>

<?php
$departamento= ArrayHelper::map(Departamentos::find()->all(), 'iddepartamento','nombredepartamento');
$municipio = ArrayHelper::map(Municipio::find()->all(), 'idmunicipio','municipio');
$tipodocumento = ArrayHelper::map(TipoDocumento::find()->all(), 'idtipo','descripcion');
?>

<h3>Información Cliente</h3>
<div class="row" id="personal">
    <div class="col-lg-3">
        <?= $form->field($model, 'idtipo')->dropDownList($tipodocumento,['prompt' => 'Seleccione...' ]) ?>
        <?= $form->field($model, 'cedulanit')->input("text") ?>
        <?= $form->field($model, 'razonsocial')->input("text") ?>

    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'nombrecliente')->input("text") ?>
        <?= $form->field($model, 'apellidocliente')->input("text") ?>
        <?= $form->field($model, 'emailcliente')->input("text") ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($model, 'telefonocliente')->input("text") ?>
        <?= $form->field($model, 'celularcliente')->input("text") ?>
        <?= $form->field($model, 'direccioncliente')->input("text") ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'iddepartamento')->dropDownList($departamento,['prompt' => 'Seleccione...' ]) ?>
        <?= $form->field($model, 'idmunicipio')->dropDownList($municipio,['prompt' => 'Seleccione...' ]) ?>

    </div>
</div>
<h3>Información Contacto</h3>
<div class="row" id="contacto">
    <div class="col-lg-4">
        <?= $form->field($model, 'contacto')->input("text") ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'telefonocontacto')->input("text") ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'celularcontacto')->input("text") ?>
    </div>
</div>
<h3>Información Tributaria</h3>
<div class="row" id="tributaria">
    <div class="col-lg-2">
        <?= $form->field($model, 'nitmatricula')->input("text") ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'formapago')->dropdownList(['1' => 'Contado', '2' => 'Credito'], ['prompt' => 'Seleccione...']) ?>
    </div>
    <div class="col-lg-1">
        <?= $form->field($model, 'plazopago')->input("text") ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'tiporegimen')->dropdownList(['1' => 'Cómun', '2' => 'Simpplificado'], ['prompt' => 'Seleccione...']) ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'autoretenedor')->dropdownList(['si' => 'Si', 'no' => 'No'], ['prompt' => 'Seleccione...']) ?>
    </div>
    <div class="col-lg-1">
        <?= $form->field($model, 'retencioniva')->input("text") ?>
    </div>
    <div class="col-lg-1">
        <?= $form->field($model, 'retencionfuente')->input("text") ?>
    </div>
</div>
<h3>Obervaciones</h3>
<div class="row" id="estudios">
    <div class="col-lg-2">
        <?= $form->field($model, 'observacion')->textarea(['rows' => '3']) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <?= Html::submitButton("Crear", ["class" => "btn btn-primary"])?>
        <a href="<?= Url::toRoute("clientes/index") ?>" class="btn btn-primary">Regresar</a>
    </div>
</div>

<?php $form->end() ?>
