<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoProduccion */

$this->title = 'Detalle Proceso Producción';
$this->params['breadcrumbs'][] = ['label' => 'Proceso Produccions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proceso-produccion-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idproceso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idproceso], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idproceso], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Operación producción
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idproceso') ?>:</th>
                    <td><?= Html::encode($model->idproceso) ?></td>                    
                    <th><?= Html::activeLabel($model, 'proceso') ?>:</th>
                    <td><?= Html::encode($model->proceso) ?></td>
                    <th><?= Html::activeLabel($model, 'estado') ?>:</th>
                    <td><?= Html::encode($model->estado) ?></td>                    
                </tr>                               
            </table>
        </div>    
</div>
