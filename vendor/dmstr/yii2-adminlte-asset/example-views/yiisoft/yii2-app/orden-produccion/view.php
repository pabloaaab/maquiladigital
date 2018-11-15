<?php


use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Ordenproducciondetalle;
use yii\helpers\Url;
use yii\web\Session;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Ordenproduccion;
use app\models\Cliente;
use app\models\Producto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;


/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Detalle Orden de Producción';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Producción', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->idordenproduccion;
?>
<div class="ordenproduccion-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->idordenproduccion], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->autorizado == 0) { ?>
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['update', 'id' => $model->idordenproduccion], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['delete', 'id' => $model->idordenproduccion], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Esta seguro de eliminar el registro?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['autorizado', 'id' => $model->idordenproduccion], ['class' => 'btn btn-default']);
        }
            else {
                echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['autorizado', 'id' => $model->idordenproduccion], ['class' => 'btn btn-default']);
            }
        ?>
    </p>

    <div class="panel panel-success">
        <div class="panel-heading">
            Orden de Producción
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'idordenproduccion') ?></th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                    <th><?= Html::activeLabel($model, 'Cliente') ?></th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'ordenproduccion') ?></th>
                    <td><?= Html::encode($model->ordenproduccion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechallegada') ?></th>
                    <td><?= Html::encode($model->fechallegada) ?></td>
                    <th><?= Html::activeLabel($model, 'fechallegada') ?></th>
                    <td><?= Html::encode($model->fechaprocesada) ?></td>
                    <th><?= Html::activeLabel($model, 'fechallegada') ?></th>
                    <td><?= Html::encode($model->fechaentrega) ?></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                    <th></th>
                    <td></td>
                    <th><?= Html::activeLabel($model, 'tipo') ?></th>
                    <td><?= Html::encode($model->tipo->tipo) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'autorizado') ?></th>
                    <td><?= Html::encode($model->autorizado) ?></td>
                    <th><?= Html::activeLabel($model, 'usuariosistema') ?></th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th><?= Html::activeLabel($model, 'totalorden') ?></th>
                    <td><?= Html::encode('$ '.number_format($model->totalorden,0)) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'observacion') ?></th>
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
                        <td><?= $val->iddetalleorden ?></td>
                        <td><?= $val->producto->nombreProducto ?></td>
                        <td><?= $val->codigoproducto ?></td>
                        <td><?= $val->cantidad ?></td>
                        <td><?= '$ '.number_format($val->vlrprecio,0) ?></td>
                        <td><?= '$ '.number_format($val->subtotal,0) ?></td>
                        <?php if ($model->autorizado == 0) { ?>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#iddetalleorden2<?= $val->iddetalleorden ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <!-- Editar modal detalle -->
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetalleorden2<?= $val->iddetalleorden ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Editar detalle <?= $val->iddetalleorden ?></h4>
                                            </div>
                                            <?= Html::beginForm(Url::toRoute("orden-produccion/editardetalle"), "POST") ?>
                                            <div class="modal-body">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h4>Información Orden Producción Detalle</h4>
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
                                                            <input type="text" name="vlrprecio" value="<?=  $val->vlrprecio ?>" class="form-control" required>
                                                        </div>
                                                        <input type="hidden" name="iddetalleorden" value="<?= $val->iddetalleorden ?>">
                                                        <input type="hidden" name="idordenproduccion" value="<?= $val->idordenproduccion ?>">
                                                        <input type="hidden" name="subtotal" value="<?= $val->subtotal ?>">
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
                                <a href="#" data-toggle="modal" data-target="#iddetalleorden<?= $val->iddetalleorden ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetalleorden<?= $val->iddetalleorden ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar Detalle</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente deseas eliminar el registro con código <?= $val->iddetalleorden ?>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?= Html::beginForm(Url::toRoute("orden-produccion/eliminardetalle"), "POST") ?>
                                                <input type="hidden" name="iddetalleorden" value="<?= $val->iddetalleorden ?>">
                                                <input type="hidden" name="idordenproduccion" value="<?= $model->idordenproduccion ?>">
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
                    <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['orden-produccion/nuevodetalles', 'idordenproduccion' => $model->idordenproduccion,'idcliente' => $model->idcliente], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['orden-produccion/editardetalles', 'idordenproduccion' => $model->idordenproduccion],[ 'class' => 'btn btn-success']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['orden-produccion/eliminardetalles', 'idordenproduccion' => $model->idordenproduccion], ['class' => 'btn btn-danger']) ?>
                </div>
            <?php } ?>
        </div>
    </div>


</div>
