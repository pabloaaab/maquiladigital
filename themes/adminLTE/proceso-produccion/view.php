<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoProduccion */

$this->title = 'Detalle operació';
$this->params['breadcrumbs'][] = ['label' => 'Operaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proceso-produccion-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idproceso], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idproceso], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idproceso], [
            'class' => 'btn btn-danger btn-sm   ',
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
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'idproceso') ?>:</th>
                    <td><?= Html::encode($model->idproceso) ?></td>                    
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'proceso') ?>:</th>
                    <td><?= Html::encode($model->proceso) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Activo') ?>:</th>
                    <td><?= Html::encode($model->activoRegistro) ?></td>                    
                </tr>  
                 <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Segundos') ?>:</th>
                    <td><?= Html::encode($model->segundos) ?></td>                    
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Minutos') ?>:</th>
                    <td><?= Html::encode($model->minutos) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Estandar') ?>:</th>
                    <td><?= Html::encode($model->estandar) ?></td>                    
                </tr>      
            </table>
        </div>    
</div>
