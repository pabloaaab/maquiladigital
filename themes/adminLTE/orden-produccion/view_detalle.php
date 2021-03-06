<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Ordenproducciondetalle;
use app\models\Ordenproducciondetalleproceso;
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
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Ficha de operaciones detalle';
$this->params['breadcrumbs'][] = ['label' => 'Ficha Operaciones', 'url' => ['proceso']];
$this->params['breadcrumbs'][] = $model->idordenproduccion;
?>
<div class="ordenproduccionproceso-view">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['proceso'], ['class' => 'btn btn-primary btn-sm']) ?>
    </p>

    <div class="panel panel-success">
        <div class="panel-heading">
            Ficha Operaciones Detalle
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'idordenproduccion') ?></th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Cliente') ?></th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'ordenproduccion') ?></th>
                    <td><?= Html::encode($model->ordenproduccion) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'fechallegada') ?></th>
                    <td><?= Html::encode($model->fechallegada) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'fechaprocesada') ?></th>
                    <td><?= Html::encode($model->fechaprocesada) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'fechaentrega') ?></th>
                    <td><?= Html::encode($model->fechaentrega) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'cantidad') ?></th>
                    <td><?= Html::encode($model->cantidad) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Progreso') ?></th>
                    <td><div class="progress"><b>Operación:&nbsp;</b>
                            <progress id="html5" max="100" value="<?= $model->porcentaje_proceso ?>"></progress>
                            <span><b><?= Html::encode(round($model->porcentaje_proceso,1)).' %' ?></b></span>
                            <b>&nbsp;Faltante:&nbsp;</b><progress id="html5" max="100" value="<?= 100 - $model->porcentaje_proceso ?>"></progress>
                            <span><b><?= Html::encode(round(100 - $model->porcentaje_proceso,1)).' %' ?></b></span>
                        </div>
                        <div class="progress"><b>Cantidad:&nbsp;&nbsp;&nbsp;</b>
                            <progress id="html5" max="100" value="<?= $model->porcentaje_cantidad ?>"></progress>
                            <span><b><?= Html::encode(round($model->porcentaje_cantidad,1)).' %' ?></b></span>
                            <b>&nbsp;Faltante:&nbsp;</b><progress id="html5" max="100" value="<?= 100 - $model->porcentaje_cantidad ?>"></progress>
                            <span><b><?= Html::encode(round(100 - $model->porcentaje_cantidad,1)).' %' ?></b></span>
                        </div>
                    </td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'tipo') ?></th>
                    <td><?= Html::encode($model->tipo->tipo) ?></td>
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
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Producto</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Código</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Cantidad</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Progreso</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Cantidad confeccionada</th>
                        <th style='background-color:#B9D5CE;'></th>
                        <th style='background-color:#B9D5CE;'></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modeldetalles as $val): ?>
                    <tr style="font-size: 85%;">
                        <td><?= $val->iddetalleorden ?></td>
                        <td><?= $val->productodetalle->prendatipo->prenda.' / '.$val->productodetalle->prendatipo->talla->talla ?></td>
                        <td><?= $val->codigoproducto ?></td>
                        <td><?= $val->cantidad ?></td>
                        <td><div class="progress"><b>Operación:&nbsp;</b>
                                <progress id="html5" max="100" value="<?= $val->porcentaje_proceso ?>"></progress>
                                <span><b><?= Html::encode(round($val->porcentaje_proceso,1)).' %' ?></b></span>&nbsp;&nbsp;-&nbsp;&nbsp;<b>Cantidad:</b>
                                <progress id="html5" max="100" value="<?= $val->porcentaje_cantidad ?>"></progress>
                                <span><b><?= Html::encode(round($val->porcentaje_cantidad,1)).' %' ?></b></span>
                            </div>
                        </td>
                        <td><?= $val->cantidad_operada ?></td>
                        <?php if($model->cerrar_orden == 0){?>
                            <td style="width: 25px;">

                                    <?= Html::a('<span class="glyphicon glyphicon-log-in"></span>', ['/orden-produccion/nuevo_detalle_proceso','id' => $model->idordenproduccion,'iddetalleorden' => $val->iddetalleorden]) ?>
                                    <!-- Inicio Vista,Eliminar,Editar -->
                            </td>
                        <?php }else{?>
                            <td style="width: 25px;">
                            </td>
                        <?php }?>    
                        <td style="width: 25px;">
                                <?php echo Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                    ['/orden-produccion/detalle_proceso','idordenproduccion' => $model->idordenproduccion,'iddetalleorden' => $val->iddetalleorden],
                                    [
                                        'title' => 'Detalle Proceso',
                                        'data-toggle'=>'modal',
                                        'data-target'=>'#modaldetalleproceso'.$val->iddetalleorden,
                                    ]
                                );
                                ?>
                                <div class="modal remote fade" id="modaldetalleproceso<?= $val->iddetalleorden ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                                <!-- Fin Vista,Eliminar,Editar -->

                            </td>

                    </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
