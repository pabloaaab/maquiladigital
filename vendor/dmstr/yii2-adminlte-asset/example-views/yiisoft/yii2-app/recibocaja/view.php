<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Recibocaja */

$this->title = 'Detalle Recibo de Caja';
$this->params['breadcrumbs'][] = ['label' => 'Recibos de Caja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idrecibo;
?>
<div class="recibocaja-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idrecibo], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->autorizado == 0) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idrecibo], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idrecibo], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Esta seguro de eliminar el registro?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['autorizado', 'id' => $model->idrecibo], ['class' => 'btn btn-default']); }
        else {
            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['autorizado', 'id' => $model->idrecibo], ['class' => 'btn btn-default']);
            echo Html::a('<span class="glyphicon glyphicon-remove"></span> Pagar', ['pagar', 'id' => $model->idrecibo], ['class' => 'btn btn-default']);
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
                    <th><?= Html::activeLabel($model, 'idrecibo') ?>:</th>
                    <td><?= Html::encode($model->idrecibo) ?></td>
                    <th><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'idtiporecibo') ?>:</th>
                    <td><?= Html::encode($model->tiporecibo->concepto) ?></td>
                </tr>

                <tr>
                    <th><?= Html::activeLabel($model, 'fecharecibo') ?>:</th>
                    <td><?= Html::encode($model->fecharecibo) ?></td>
                    <th><?= Html::activeLabel($model, 'Municipio') ?>:</th>
                    <td><?= Html::encode($model->municipio->municipioCompleto) ?></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechapago') ?>:</th>
                    <td><?= Html::encode($model->fechapago) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'valorpagado') ?>:</th>
                    <td align="right"><?= Html::encode('$ '.number_format($model->valorpagado,2)) ?></td>
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
                        <th scope="col">Id Factura</th>
                        <th scope="col">Rete Fuente</th>
                        <th scope="col">Rete Iva</th>
                        <th scope="col">Valor Abono</th>
                        <th scope="col">Valor Saldo</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modeldetalles as $val): ?>
                    <tr>
                        <td><?= $val->iddetallerecibo ?></td>
                        <td><?= $val->idfactura ?></td>
                        <td><?= $val->retefuente ?></td>
                        <td><?= $val->reteiva ?></td>
                        <td><?= '$ '.number_format($val->vlrabono,2) ?></td>
                        <td><?= '$ '.number_format($val->vlrsaldo,2) ?></td>
                        <?php if ($model->autorizado == 0) { ?>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#iddetallerecibo2<?= $val->iddetallerecibo ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <!-- Editar modal detalle -->
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetallerecibo2<?= $val->iddetallerecibo ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Editar detalle <?= $val->iddetallerecibo ?></h4>
                                            </div>
                                            <?= Html::beginForm(Url::toRoute("recibocaja/editardetalle"), "POST") ?>
                                            <div class="modal-body">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h4>Información Recibo Caja Detalle</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-lg-2">
                                                            <label>Abono:</label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input type="text" name="vlrabono" value="<?= $val->vlrabono ?>" class="form-control" required>
                                                        </div>
                                                        <input type="hidden" name="iddetallerecibo" value="<?= $val->iddetallerecibo ?>">
                                                        <input type="hidden" name="idrecibo" value="<?= $val->idrecibo ?>">
                                                        <input type="hidden" name="total" value="<?= $val->vlrabono ?>">
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
                                <a href="#" data-toggle="modal" data-target="#iddetallerecibo<?= $val->iddetallerecibo ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetallerecibo<?= $val->iddetallerecibo ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar Detalle</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente deseas eliminar el registro con código <?= $val->iddetallerecibo ?>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?= Html::beginForm(Url::toRoute("recibocaja/eliminardetalle"), "POST") ?>
                                                <input type="hidden" name="iddetallerecibo" value="<?= $val->iddetallerecibo ?>">
                                                <input type="hidden" name="idrecibo" value="<?= $model->idrecibo ?>">
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
                </table>
            </div>
            <?php if ($model->autorizado == 0) { ?>
                <div class="panel-footer text-right">
                    <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['recibocaja/nuevodetalles', 'idrecibo' => $model->idrecibo,'idcliente' => $model->idcliente], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['recibocaja/editardetalles', 'idrecibo' => $model->idrecibo],[ 'class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['recibocaja/eliminardetalles', 'idrecibo' => $model->idrecibo], ['class' => 'btn btn-danger']) ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
