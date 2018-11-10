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

/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Orden de Producción Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Producción Procesos', 'url' => ['proceso']];
$this->params['breadcrumbs'][] = $model->idordenproduccion;
?>
<div class="ordenproduccionproceso-view">
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['proceso'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="panel panel-success">
        <div class="panel-heading">
            Orden de Producción Procesos
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
                    <th><?= Html::activeLabel($model, 'Progreso') ?></th>
                    <td><?= Html::encode($model->porcentaje_proceso).' %' ?></td>
                    <th><?= Html::activeLabel($model, 'tipo') ?></th>
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
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Código</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Progreso</th>
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
                        <td><?= $val->porcentaje_proceso.' %' ?></td>
                        <?php if ($model->porcentaje_proceso <= 0) { ?>
                            <td>
                                <!-- Inicio Nuevo Detalle proceso -->
                                <?php echo Html::a('<span class="glyphicon glyphicon-log-in"></span>',
                                    ['/orden-produccion/nuevo_detalle_proceso','id' => $model->idordenproduccion,'iddetalleorden' => $val->iddetalleorden],
                                    [
                                        'title' => 'Nuevo Detalle Proceso',
                                        'data-toggle'=>'modal',
                                        'data-target'=>'#modaldetalleproceso',
                                    ]
                                );
                                ?>
                                <div class="modal remote fade" id="modaldetalleproceso">
                                    <div class="modal-dialog">
                                        <div class="modal-content loader-lg"></div>
                                    </div>
                                </div>
                                <!-- Fin Nuevo Detalle proceso -->
                                <!-- Inicio Vista,Eliminar,Editar -->
                                <?php echo Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                    ['/orden-produccion/detalle_proceso','id' => $model->idordenproduccion,'iddetalleorden' => $val->iddetalleorden],
                                    [
                                        'title' => 'Detalle Proceso',
                                        'data-toggle'=>'modal',
                                        'data-target'=>'#modaldetalleproceso2',
                                    ]
                                );
                                ?>
                                <div class="modal remote fade" id="modaldetalleproceso2">
                                    <div class="modal-dialog">
                                        <div class="modal-content loader-lg"></div>
                                    </div>
                                </div>
                                <!-- Fin Vista,Eliminar,Editar -->
                                <!-- Inicio vista 2 -->
                                <a href="#" onclick="mostrarf(<?= $val->iddetalleorden ?>)"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <div id="detalleproceso<?= $val->iddetalleorden ?>" style="display:none">
                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Proceso</th>
                                            <th scope="col">Duración</th>
                                            <th scope="col">Ponderación</th>
                                            <th scope="col">Total</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $procesos = Ordenproducciondetalleproceso::find()->Where(['=', 'iddetalleorden', $val->iddetalleorden])->all();
                                        ?>
                                        <?php foreach ($procesos as $val): ?>
                                        <tr>
                                            <td><?= $val->idproceso ?></td>
                                            <td><?= $val->proceso ?></td>
                                            <td><input type="checkbox" name="idproceso[]" value="<?= $val->idproceso ?>"></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <th scope="col">Total</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </table>
                                </div>
                                <!-- Fin vista 2 -->
                            </td>
                        <?php } ?>
                    </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<script language="JavaScript">
    function mostrarf(r) {
        divC = document.getElementById("detalleproceso"+r);
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>