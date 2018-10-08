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
?>

<h1>Detalle del Cliente</h1>

<div class="panel panel-info">
    <div class="panel-heading">
        <h4>Informaci贸n Cliente</h4>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>C贸digo:</th>
                <td><?= $table->idcliente ?></td>
                <th>Tipo Identificaci髇:</th>
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
                <th >Direcci髇:</th>
                <td><?= $table->direccioncliente ?></td>
            </tr>
            <tr>
                <th>Tel閒ono:</th>
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
        <h4>Informaci贸n Contacto</h4>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th>Contacto:</th>
                <td><?= $table->contacto ?></td>
                <th>Tel閒ono:</th>
                <td><?= $table->telefonocontacto ?></td>
                <th>Celular:</th>
                <td><?= $table->celularcontacto ?></td>
                <th></th>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="panel-heading">
        <h4>Informaci贸n Tributaria</h4>
    </div>
    <div class="panel-body">
    </div>
    <div class="panel-heading">
        <h4>Observaciones</h4>
    </div>
    <div class="panel-body">
    </div>
    <div class="panel-footer text-left">
        <a href="<?= Url::toRoute("clientes/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-left'></span> Regresar</a>
    </div>
</div>

