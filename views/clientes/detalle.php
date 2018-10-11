<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Municipio;
use app\models\Departamentos;
use app\models\TipoDocumento;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
?>

<?php

$this->title = 'Detalle Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Detalle del Cliente</h1>

<div class="panel panel-success">
    <div class="panel-heading">
        <h4>Información Cliente</h4>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>Código:</th>
                <td><?= $table->idcliente ?></td>
                <th>Tipo Identificación:</th>
                <td><?= $table->idTipoFk->tipo ?></td>
                <th>Cedula/Nit:</th>
                <td><?= $table->cedulanit ?></td>
                <th >DV:</th>
                <td><?= $table->dv ?></td>
            </tr>
            <tr>
                <?php if ($table->idtipo == 1){ ?>
                <th>Nombres:</th>
                <td><?= $table->nombrecliente ?></td>
                <th>Apellidos:</th>
                <td><?= $table->apellidocliente ?></td>
                <?php } elseif ($table->idtipo == 5) { ?>
                <th>Razon Social:</th>
                <td><?= $table->razonsocial ?></td>
                <th></th>
                <td></td>
                <?php } else { ?>
                <th>Nombres:</th>
                <td><?= $table->nombrecliente ?></td>
                <th>Apellidos:</th>
                <td><?= $table->apellidocliente ?></td>    
                <?php }?>
                <th>Email:</th>
                <td><?= $table->emailcliente ?></td>
                <th >Dirección:</th>
                <td><?= $table->direccioncliente ?></td>
            </tr>
            <tr>
                <th>Teléfono:</th>
                <td><?= $table->telefonocliente ?></td>
                <th>Celular:</th>
                <td><?= $table->celularcliente ?></td>
                <th>Departamento:</th>
                <td><?= $table->idDepartamentoFk->nombredepartamento ?></td>
                <th >Municipio:</th>
                <td><?= $table->idMunicipioFk->municipio ?></td>
            </tr>
        </table>
    </div>
    <div class="panel-heading">
        <h4>Información Contacto</h4>
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
        <h4>Información Tributaria</h4>
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
                <td><?= $table->tiporegimen ?></td>
                <th>AutoRetenedor:</th>
                <td><?= $table->autoretenedor ?></td>
                <th>Retención Fuente:</th>
                <td><?= $table->retencionfuente ?></td>
                <th>Retención Iva:</th>
                <td><?= $table->retencioniva ?></td>
            </tr>
        </table>
    </div>
    <div class="panel-heading">
        <h4>Observaciones</h4>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <td><?= $table->observacion ?></td>
            </tr>
        </table>
    </div>
    <div class="panel-footer text-left">
        <a href="<?= Url::toRoute("clientes/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
    </div>
</div>

