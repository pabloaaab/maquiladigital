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
        <h4>Información Cliente</h4>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <tr>
                <th >Código</th>
                <td >Código</td>
                <th >Cedula/Nit</th>
                <td >Cedula/Nit</td>
                <th >Código</th>
                <td >Código</td>
                <th >Cedula/Nit</th>
                <td >Cedula/Nit</td>
            </tr>
            <tr>
                <th >Código</th>
                <td >Código</td>
                <th >Cedula/Nit</th>
                <td >Cedula/Nit</td>
                <th >Código</th>
                <td >Código</td>
                <th >Cedula/Nit</th>
                <td >Cedula/Nit</td>
            </tr>
            <tr>
                <th >Código</th>
                <td >Código</td>
                <th >Cedula/Nit</th>
                <td >Cedula/Nit</td>
                <th >Código</th>
                <td >Código</td>
                <th >Cedula/Nit</th>
                <td >Cedula/Nit</td>
            </tr>


        </table>
    </div>
    <div class="panel-heading">
        <h4>Información Contacto</h4>
    </div>
    <div class="panel-body">
    </div>
    <div class="panel-heading">
        <h4>Información Tributaria</h4>
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

