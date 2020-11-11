<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */

$this->title = 'Detalle Compra';
$this->params['breadcrumbs'][] = ['label' => 'Consulta Compras', 'url' => ['indexconsulta']];
$this->params['breadcrumbs'][] = $model->id_compra;
$view = 'facturaventa';
?>
<div class="compra-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indexconsulta', 'id' => $model->id_compra], ['class' => 'btn btn-primary']) ?>        
    </p>
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'id_compra') ?>:</th>
                    <td><?= Html::encode($model->id_compra) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Proveedor') ?>:</th>
                    <td><?= Html::encode($model->proveedor->nombrecorto) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'subtotal') ?>:</th>
                    <td><?= Html::encode('$ '.number_format($model->subtotal,0)) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'concepto') ?>:</th>
                    <td><?= Html::encode($model->compraConcepto->concepto) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'porcentajeAiu') ?>:</th>
                    <td><?= Html::encode($model->porcentajeaiu) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'baseAiu') ?>:</th>
                    <td><?= Html::encode('$ '.number_format($model->base_aiu,0)) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'factura') ?>:</th>
                    <td><?= Html::encode($model->factura) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'porcentajeiva') ?>:</th>
                    <td><?= Html::encode($model->porcentajeiva) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'impuestoiva') ?>: +</th>
                    <td><?= Html::encode('$ '.number_format($model->impuestoiva,0)) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'numero') ?>:</th>
                    <td><?= Html::encode($model->numero) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'porcentajereteiva') ?>:</th>
                    <td><?= Html::encode($model->porcentajereteiva) ?></td>                    
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'retencioniva') ?>: -</th>
                    <td><?= Html::encode('$ '.number_format($model->retencioniva,0)) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'fechainicio') ?>:</th>
                    <td><?= Html::encode($model->fechainicio) ?></td>                    
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'porcentajefuente') ?>:</th>
                    <td><?= Html::encode($model->porcentajefuente) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'retencionfuente') ?>: -</th>
                    <td><?= Html::encode('$ '.number_format($model->retencionfuente,0)) ?></td>
                </tr> 
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'fechavencimiento') ?>:</th>
                    <td><?= Html::encode($model->fechavencimiento) ?></td>                    
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'usuariosistema') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'total') ?>:</th>
                    <td><?= Html::encode('$ '.number_format($model->total,0)) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="5"><?= Html::encode($model->observacion) ?></td>
                </tr>
            </table>
        </div>
    </div>
    
</div>
