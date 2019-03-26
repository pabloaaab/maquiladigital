<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = 'Detalle Consulta Comprobante Egreso';
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos', 'url' => ['indexconsulta']];
$this->params['breadcrumbs'][] = $model->id_comprobante_egreso;
$view = 'comprobante-egreso';
?>
<div class="comprobante-egreso-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indexconsulta', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-primary']) ?>        
    </p>
    <?php
    if ($mensaje != ""){
        ?> <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $mensaje ?>
    </div> <?php
    }
    ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5><?= Html::encode($this->title) ?></h5>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_comprobante_egreso') ?>:</th>
                    <td><?= Html::encode($model->id_comprobante_egreso) ?></td>
                    <th><?= Html::activeLabel($model, 'Proveedor') ?>:</th>
                    <?php if ($model->id_proveedor){ ?>
                        <td><?= Html::encode($model->proveedor->nombrecorto) ?></td>
                    <?php } ?>
                    
                    <th><?= Html::activeLabel($model, 'id_comprobante_egreso_tipo') ?>:</th>
                    <td><?= Html::encode($model->comprobanteEgresoTipo->concepto) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'id_banco') ?>:</th>
                    <td><?= Html::encode($model->banco->entidad) ?></td>
                    <th><?= Html::activeLabel($model, 'Cuenta') ?>:</th>
                    <td><?= Html::encode($model->banco->producto) ?></td>
                    <th><?= Html::activeLabel($model, 'numeroComprobante') ?>:</th>
                    <td><?= Html::encode($model->numero) ?></td>                    
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fecha_comprobante') ?>:</th>
                    <td><?= Html::encode($model->fecha_comprobante) ?></td>
                    <th><?= Html::activeLabel($model, 'Municipio') ?>:</th>
                    <td><?= Html::encode($model->municipio->municipioCompleto) ?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fecha') ?>:</th>
                    <td><?= Html::encode($model->fecha) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'valor') ?>:</th>
                    <td align="right"><?= Html::encode('$ '.number_format($model->valor,0)) ?></td>
                </tr>
                <tr>
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
                        <th scope="col">Factura</th>
                        <th scope="col">Rete Fuente</th>
                        <th scope="col">Rete Iva</th>
                        <th scope="col">Base Aiu</th>
                        <th scope="col">Valor Abono</th>
                        <th scope="col">Valor Saldo</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $calculo = 0; ?>
                    <?php foreach ($modeldetalles as $val): ?>
                        <?php $calculo = $calculo + $val->vlr_abono; ?>
                    <tr>
                        <td><?= $val->id_comprobante_egreso_detalle ?></td>
                        <?php if($val->id_compra){ ?>
                            <td><?= $val->compra->factura ?></td>
                        <?php }else{ ?>
                            <td><?= "No Aplica" ?></td>
                        <?php } ?>
                        
                        <td><?= '$ '.number_format($val->retefuente,0) ?></td>
                        <td><?= '$ '.number_format($val->reteiva,0) ?></td>
                        <td><?= '$ '.number_format($val->base_aiu,0) ?></td>
                        <td><?= '$ '.number_format($val->vlr_abono,0) ?></td>
                        <td><?= '$ '.number_format($val->vlr_saldo,0) ?></td>
                        <?php if ($model->autorizado == 0) { ?>
                            
                        <?php } ?>
                    </tr>                    
                    </tbody>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>                        
                        <td align="right"><b>Total:</b></td>
                        <td><?= '$ '.number_format($calculo,0); ?></td>
                    </tr>
                </table>
            </div>
            
        </div>
    </div>
</div>
