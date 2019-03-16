<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Ordenproducciondetalle;
use yii\helpers\Url;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;

/* @var $this yii\web\View */
/* @var $model app\models\Facturaventa */

$this->title = 'Detalle Consulta Factura de Venta';
$this->params['breadcrumbs'][] = ['label' => 'Consulta Facturas de ventas', 'url' => ['indexconsulta']];
$this->params['breadcrumbs'][] = $model->idfactura;
$view = 'facturaventa';
?>
<div class="facturaventa-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indexconsulta', 'id' => $model->idfactura], ['class' => 'btn btn-primary']) ?>        
    </p>
    
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idfactura') ?>:</th>
                    <td><?= Html::encode($model->idfactura) ?></td>
                    <th><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'idordenproduccion') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'nrofactura') ?>:</th>
                    <td><?= Html::encode($model->nrofactura) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentajeiva') ?>:</th>
                    <td><?= Html::encode($model->porcentajeiva) ?></td>
                    <th><?= Html::activeLabel($model, 'subtotal') ?>:</th>
                    <td><?= Html::encode('$ '.number_format($model->subtotal,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechainicio') ?>:</th>
                    <td><?= Html::encode($model->fechainicio) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentajefuente') ?>:</th>
                    <td><?= Html::encode($model->porcentajefuente) ?></td>
                    <th><?= Html::activeLabel($model, 'impuestoiva') ?>: +</th>
                    <td><?= Html::encode('$ '.number_format($model->impuestoiva,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechavcto') ?>:</th>
                    <td><?= Html::encode($model->fechavcto) ?></td>
                    <th><?= Html::activeLabel($model, 'porcentajereteiva') ?>:</th>
                    <td><?= Html::encode($model->porcentajereteiva) ?></td>
                    <th><?= Html::activeLabel($model, 'retencioniva') ?>: -</th>
                    <td><?= Html::encode('$ '.number_format($model->retencioniva,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'plazopago') ?>:</th>
                    <td><?= Html::encode($model->plazopago) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'retencionfuente') ?>: -</th>
                    <td><?= Html::encode('$ '.number_format($model->retencionfuente,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'formapago') ?>:</th>
                    <td><?= Html::encode($model->formadePago) ?></td>
                    <th><?= Html::activeLabel($model, 'saldo') ?>:</th>
                    <td><?= Html::encode('$ '.number_format($model->saldo,0)) ?></td>
                    <th><?= Html::activeLabel($model, 'totalpagar') ?>:</th>
                    <td><?= Html::encode('$ '.number_format($model->totalpagar,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'tipoServicio') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->tipo->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'observacion') ?>:</th>
                    <td colspan="5"><?= Html::encode($model->observacion) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Detalles
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Código</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Subtotal</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modeldetalles as $val): ?>
                    <tr>
                        <td><?= $val->iddetallefactura ?></td>
                        <td><?= $val->productodetalle->prendatipo->prenda.' / '.$val->productodetalle->prendatipo->talla->talla ?></td>
                        <td><?= $val->codigoproducto ?></td>
                        <td><?= $val->cantidad ?></td>
                        <td><?= '$ '.number_format($val->preciounitario,0) ?></td>
                        <td><?= '$ '.number_format($val->total,0) ?></td>                        
                    </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>            
        </div>
    </div>
</div>
