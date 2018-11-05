<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Recibocajadetalle;
use app\models\Recibocaja;
use app\models\Cliente;

use yii\filters\AccessControl;
use yii\db\ActiveQuery;
use kartik\select2\Select2;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;


?>

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
                <td><?= '$ '.number_format($val->vlrabono) ?></td>
                <td><?= '$ '.number_format($val->vlrsaldo) ?></td>
                <?php if ($estado == 0) { ?>
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
									<input type="hidden" name="idrecibo" value="<?= $idrecibo ?>">
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
    <?php if ($estado == 0) { ?>
    <div class="panel-footer text-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['recibocaja/nuevodetalles', 'idrecibo' => $idrecibo,'idcliente' => $idcliente], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['recibocaja/editardetalles', 'idrecibo' => $idrecibo],[ 'class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['recibocaja/eliminardetalles', 'idrecibo' => $idrecibo], ['class' => 'btn btn-danger']) ?>
    </div>
    <?php } ?>
    </div>
</div>
