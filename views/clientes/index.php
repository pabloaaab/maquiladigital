<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Clientes';
?>

    <h1>Clientes</h1>
<?php $f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("clientes/index"),
    "enableClientValidation" => true,
]);
?>

<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>

<div class="row" >
    <div class="col-lg-4">
        <?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
        <a align="right" href="<?= Url::toRoute("clientes/index") ?>" class="btn btn-primary">Actualizar</a>
    </div>
</div>
<?php $f->end() ?>

<h3><?= $search ?></h3>

    <div class = "form-group" align="right">
        <a align="right" href="<?= Url::toRoute("clientes/nuevo") ?>" class="btn btn-primary">Nuevo Cliente</a>
    </div>

    <div class="container-fluid">
        <div class="col-lg-2">

        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Tipo</th>
                <th scope="col">Cedula/Nit</th>
                <th scope="col">Razon Social</th>
                <th scope="col">Fecha Ingreso</th>
                <th scope="col">Teléfono</th>
                <th scope="col">direccion</th>
                <th scope="col">Municipio</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>
                <th scope="row"><?= $val->idcliente ?></th>
                <td><?= $val->idtipo ?></td>
                <td><?= $val->cedulanit ?></td>
                <td><?= $val->razonsocial ?></td>
                <td><?= $val->fechaingreso ?></td>
                <td><?= $val->telefonocliente ?></td>
                <td><?= $val->direccioncliente ?></td>
                <td><?= $val->idmunicipio ?></td>
                <td><a href="<?= Url::toRoute(["clientes/editar", "idcliente" => $val->idcliente]) ?>" ><img src="svg/si-glyph-document-edit.svg" align="center" width="20px" height="20px" title="Editar"></a></td>
                <td><a href="<?= Url::toRoute(["clientes/firma_estudiante", "idcliente" => $val->idcliente]) ?>" ><img src="svg/si-glyph-pencil.svg" align="center" width="20px" height="20px" title="Firma Estudiante"></a></td>
                <td><a href="<?= Url::toRoute(["clientes/firma_acudiente", "idcliente" => $val->idcliente]) ?>" ><img src="svg/si-glyph-pencil.svg" align="center" width="20px" height="20px" title="Firma Acudiente"></a></td>
                <td><a href="<?= Url::toRoute(["clientes/imprimir", "idcliente" => $val->idcliente]) ?>" ><img src="svg/si-glyph-print.svg" align="center" width="20px" height="20px" title="Imprimir"></a></td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>

        <div class = "form-group" align="right">
            <a href="<?= Url::toRoute("clientes/nuevo") ?>" class="btn btn-primary">Nuevo Cliente</a>
        </div>
        <div class = "form-group" align="left">
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
    </div>

