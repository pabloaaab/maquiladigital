<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamento;
use app\models\TipoDocumento;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
?>

<?php

$this->title = 'Detalle Proveedor';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$view = 'proveedor';
?>

<p>
    <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['editar', 'id' => $table->idproveedor], ['class' => 'btn btn-success']) ?>
    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['eliminar', 'id' => $table->idproveedor], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Esta seguro de eliminar el registro?',
            'method' => 'post',
        ],
    ]) ?>
    <?= Html::a('<span class="glyphicon glyphicon-folder-open"></span> Archivos', ['archivodir/index','numero' => 5, 'codigo' => $table->idproveedor,'view' => $view], ['class' => 'btn btn-default']) ?>
</p>

<div class="panel panel-success">
    <div class="panel-heading">
        Información Proveedor
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>Código:</th>
                <td><?= $table->idproveedor ?></td>
                <th>Tipo Identificación:</th>
                <td><?= $table->tipo->tipo ?></td>
                <th>Cedula/Nit:</th>
                <td><?= $table->cedulanit ?></td>
                <th >DV:</th>
                <td><?= $table->dv ?></td>
            </tr>
            <tr>
                <?php if ($table->idtipo == 1){ ?>
                <th>Nombres:</th>
                <td><?= $table->nombreproveedor ?></td>
                <th>Apellidos:</th>
                <td><?= $table->apellidoproveedor ?></td>
                <?php } elseif ($table->idtipo == 5) { ?>
                <th>Razon Social:</th>
                <td><?= $table->razonsocial ?></td>
                <th></th>
                <td></td>
                <?php } else { ?>
                <th>Nombres:</th>
                <td><?= $table->nombreproveedor ?></td>
                <th>Apellidos:</th>
                <td><?= $table->apellidoproveedor ?></td>    
                <?php }?>
                <th>Email:</th>
                <td><?= $table->emailproveedor ?></td>
                <th >Dirección:</th>
                <td><?= $table->direccionproveedor ?></td>
            </tr>
            <tr>
                <th>Teléfono:</th>
                <td><?= $table->telefonoproveedor ?></td>
                <th>Celular:</th>
                <td><?= $table->celularproveedor ?></td>
                <th>Departamento:</th>
                <td><?= $table->departamento->departamento ?></td>
                <th >Municipio:</th>
                <td><?= $table->municipio->municipio ?></td>
            </tr>
            <tr>
                <th>Entidad Bancaria:</th>
                <td><?= $table->banco ?></td>
                <th>Tipo Cuenta:</th>
                <td><?= $table->tcuenta ?></td>
                <th>Numero Cuenta:</th>
                <td><?= $table->cuentanumero ?></td>
                <th></th>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="panel-heading">
        Información Contacto
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>Contacto:</th>
                <td><?= $table->contacto ?></td>
                <th>Teléfono:</th>
                <td><?= $table->telefonocontacto ?></td>
                <th>Celular:</th>
                <td><?= $table->celularcontacto ?></td>
                <th></th>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="panel-heading">
        Información Tributaria
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>Nit/Matricula:</th>
                <td><?= $table->nitmatricula ?></td>
                <th>Forma de Pago:</th>
                <td><?php if ($table->formapago = 1){echo "Contado";} else {echo "Crédito";}  ?></td>
                <th>Plazo:</th>
                <td><?= $table->plazopago ?></td>
                <th></th>
                <td></td>
            </tr>
            <tr>
                <th>Tipo Regimen:</th>
                <td><?= $table->regimen ?></td>
                <th>AutoRetenedor:</th>
                <td><?= $table->autoretener ?></td>
                <th>Naturaleza:</th>
                <td><?= $table->naturalezas ?></td>
                <th>Sociedad:</th>
                <td><?= $table->sociedades ?></td>
            </tr>
        </table>
    </div>
    <div class="panel-heading">
        Observaciones
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <td><?= $table->observacion ?></td>
            </tr>
        </table>
    </div>    
</div>

