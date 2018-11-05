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
use app\models\Facturaventadetalle;
use app\models\FacturaventaSearch;
use app\models\Facturaventa;
use app\models\Cliente;
use app\models\Producto;
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
                <td><?= $val->producto->producto ?></td>
                <td><?= $val->codigoproducto ?></td>
                <td><?= $val->cantidad ?></td>
                <td><?= '$ '.number_format($val->preciounitario) ?></td>
                <td><?= '$ '.number_format($val->total) ?></td>
                <?php if ($estado == 0) { ?>
                <td>
				<a href="#" data-toggle="modal" data-target="#iddetallefactura2<?= $val->iddetallefactura ?>"><span class="glyphicon glyphicon-pencil"></span></a>
				<!-- Editar modal detalle -->
				<div class="modal fade" role="dialog" aria-hidden="true" id="iddetallefactura2<?= $val->iddetallefactura ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Editar detalle <?= $val->iddetallefactura ?></h4>
                                </div>
								<?= Html::beginForm(Url::toRoute("facturaventa/editardetalle"), "POST") ?>
                                <div class="modal-body">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4>Información Factura Venta Detalle</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-lg-2">
                                                <label>Cantidad:</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" name="cantidad" value="<?= $val->cantidad ?>" class="form-control" required>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Costo:</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="text" name="preciounitario" value="<?=  $val->preciounitario ?>" class="form-control" required>
                                            </div>
                                            <input type="hidden" name="iddetallefactura" value="<?= $val->iddetallefactura ?>">
                                            <input type="hidden" name="idfactura" value="<?= $val->idfactura ?>">
                                            <input type="hidden" name="total" value="<?= $val->total ?>">
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
				<a href="#" data-toggle="modal" data-target="#iddetallefactura<?= $val->iddetallefactura ?>"><span class="glyphicon glyphicon-trash"></span></a>
                    <div class="modal fade" role="dialog" aria-hidden="true" id="iddetallefactura<?= $val->iddetallefactura ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Detalle</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Realmente deseas eliminar el registro con código <?= $val->iddetallefactura ?>?</p>
                                </div>
                                <div class="modal-footer">
                                    <?= Html::beginForm(Url::toRoute("facturaventa/eliminardetalle"), "POST") ?>
                                    <input type="hidden" name="iddetallefactura" value="<?= $val->iddetallefactura ?>">
									<input type="hidden" name="idfactura" value="<?= $idfactura ?>">
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
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['facturaventa/nuevodetalles', 'idfactura' => $idfactura,'idordenproduccion' => $idordenproduccion], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['facturaventa/editardetalles', 'idfactura' => $idfactura],[ 'class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['facturaventa/eliminardetalles', 'idfactura' => $idfactura], ['class' => 'btn btn-danger']) ?>
    </div>
    <?php } ?>
    </div>
</div>
