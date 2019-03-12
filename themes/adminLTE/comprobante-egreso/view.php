<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = 'Detalle Comprobante Egreso';
$this->params['breadcrumbs'][] = ['label' => 'Comprobante Egresos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_comprobante_egreso;
$view = 'comprobante-egreso';
?>
<div class="comprobante-egreso-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->autorizado == 0) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->id_comprobante_egreso], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Esta seguro de eliminar el registro?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['autorizado', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-default']); }
        else {
            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['autorizado', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-default']);
            echo Html::a('<span class="glyphicon glyphicon-check"></span> Pagar', ['pagar', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-default']);
            if ($model->numero > 0){
                    echo Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['imprimir', 'id' => $model->id_comprobante_egreso], ['class' => 'btn btn-default']);            
                    echo Html::a('<span class="glyphicon glyphicon-folder-open"></span> Archivos', ['archivodir/index','numero' => 8, 'codigo' => $model->id_comprobante_egreso,'view' => $view], ['class' => 'btn btn-default']);                                                         
            }
        }
        ?>
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
                            <td>
                                <a href="#" data-toggle="modal" data-target="#iddetallecomprobante2<?= $val->id_comprobante_egreso_detalle ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <!-- Editar modal detalle -->
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetallecomprobante2<?= $val->id_comprobante_egreso_detalle ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Editar detalle <?= $val->id_comprobante_egreso_detalle ?></h4>
                                            </div>
                                            <?= Html::beginForm(Url::toRoute("comprobante-egreso/editardetalle"), "POST") ?>
                                            <div class="modal-body">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        Información Comprobante Egreso Detalle
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-lg-2">
                                                            <label>Abono:</label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input type="text" name="vlr_abono" value="<?= $val->vlr_abono ?>" class="form-control" required>
                                                        </div>
                                                        <input type="hidden" name="id_comprobante_egreso_detalle" value="<?= $val->id_comprobante_egreso_detalle ?>">
                                                        <input type="hidden" name="id_comprobante_egreso" value="<?= $val->id_comprobante_egreso ?>">
                                                        <input type="hidden" name="total" value="<?= $val->vlr_abono ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Guardar</button>
                                            </div>
                                            <?= Html::endForm() ?>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- Eliminar modal detalle -->
                                <a href="#" data-toggle="modal" data-target="#iddetallecomprobante<?= $val->id_comprobante_egreso_detalle ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetallecomprobante<?= $val->id_comprobante_egreso_detalle ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar Detalle</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente deseas eliminar el registro con código <?= $val->id_comprobante_egreso_detalle ?>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?= Html::beginForm(Url::toRoute("comprobante-egreso/eliminardetalle"), "POST") ?>
                                                <input type="hidden" name="id_comprobante_egreso_detalle" value="<?= $val->id_comprobante_egreso_detalle ?>">
                                                <input type="hidden" name="id_comprobante_egreso" value="<?= $model->id_comprobante_egreso ?>">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                                <?= Html::endForm() ?>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
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
            <?php if ($model->autorizado == 0) { ?>
                <div class="panel-footer text-right">
                    <?php if ($model->libre == 1){ ?>
                        <!-- Inicio Nuevo Detalle proceso -->
                        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo Libre',
                            ['/comprobante-egreso/nuevodetallelibre','id' => $model->id_comprobante_egreso],
                            [
                                'title' => 'Nuevo Detalle Comprobante Egreso',
                                'data-toggle'=>'modal',
                                'data-target'=>'#modaldetallenuevolibre',
                                'class' => 'btn btn-success'
                            ])                                    

                        ?>
                        <div class="modal remote fade" id="modaldetallenuevolibre">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content"></div>
                            </div>
                        </div>
                        <!-- Fin Nuevo Detalle proceso -->
                    <?php  }else{ ?>
                        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['comprobante-egreso/nuevodetalles', 'id_comprobante_egreso' => $model->id_comprobante_egreso,'id_proveedor' => $model->id_proveedor], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['comprobante-egreso/editardetalles', 'id_comprobante_egreso' => $model->id_comprobante_egreso],[ 'class' => 'btn btn-success']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['comprobante-egreso/eliminardetalles', 'id_comprobante_egreso' => $model->id_comprobante_egreso], ['class' => 'btn btn-danger']) ?>                    
                    <?php } ?>                                                            
                </div>
            <?php } ?>
        </div>
    </div>
</div>