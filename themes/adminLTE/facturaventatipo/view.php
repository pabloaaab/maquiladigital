<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventatipo */

$this->title = 'Detalle Factura Venta Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Facturas Venta Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_factura_venta_tipo;
?>
<div class="factura_venta_tipo-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_factura_venta_tipo], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_factura_venta_tipo], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_factura_venta_tipo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro de eliminar el registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Factura Venta Tipo
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_factura_venta_tipo') ?>:</th>
                    <td><?= Html::encode($model->id_factura_venta_tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'concepto') ?>:</th>
                    <td><?= Html::encode($model->concepto) ?></td>
                    <th><?= Html::activeLabel($model, 'activo') ?>:</th>
                    <td><?= Html::encode($model->estados) ?></td>                    
                </tr>                
            </table>
        </div>
    </div>   
</div>