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
                    <th><?= Html::activeLabel($model, 'fechaprocesada') ?></th>
                    <td><?= Html::encode($model->fechaprocesada) ?></td>
                    <th><?= Html::activeLabel($model, 'fechaentrega') ?></th>
                    <td><?= Html::encode($model->fechaentrega) ?></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                    <th><?= Html::activeLabel($model, 'Progreso') ?></th>
                    <td><div class="progress"><b>Operación:&nbsp;</b>
                            <progress id="html5" max="100" value="<?= $model->porcentaje_proceso ?>"></progress>
                            <span><b><?= Html::encode($model->porcentaje_proceso).' %' ?></b></span>
                        </div>
                        <div class="progress"><b>Cantidad:&nbsp;&nbsp;&nbsp;</b>
                            <progress id="html5" max="100" value="<?= $model->porcentaje_cantidad ?>"></progress>
                            <span><b><?= Html::encode(number_format($model->porcentaje_cantidad),1).' %' ?></b></span>
                        </div>
                    </td>
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
                        <th scope="col">Cantidad Operada</th>
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
                        <td><div class="progress"><b>Operación:&nbsp;</b>
                                <progress id="html5" max="100" value="<?= $val->porcentaje_proceso ?>"></progress>
                                <span><b><?= Html::encode($val->porcentaje_proceso).' %' ?></b></span>&nbsp;&nbsp;-&nbsp;&nbsp;<b>Cantidad:</b>
                                <progress id="html5" max="100" value="<?= number_format($val->porcentaje_cantidad,1) ?>"></progress>
                                <span><b><?= Html::encode($val->porcentaje_cantidad).' %' ?></b></span>
                            </div>
                        </td>
                        <td><?= $val->cantidad_operada ?></td>
                            <td>
                                <!-- Inicio Nuevo Detalle proceso -->
                                <?php echo Html::a('<span class="glyphicon glyphicon-log-in"></span>',
                                    ['/orden-produccion/nuevo_detalle_proceso','id' => $model->idordenproduccion,'iddetalleorden' => $val->iddetalleorden],
                                    [
                                        'title' => 'Nuevo Detalle Proceso',
                                        'data-toggle'=>'modal',
                                        'data-target'=>'#modaldetallenuevo',
                                    ]
                                );
                                ?>
                                <div class="modal remote fade" id="modaldetallenuevo">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                                <!-- Fin Nuevo Detalle proceso -->
                                <!-- Inicio Vista,Eliminar,Editar -->
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
<script language="JavaScript">
    function mostrarf(r) {
        divC = document.getElementById("detalleproceso"+r);
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>
<script type="text/javascript">

    window.onload = function() {

        animateprogress("#html5",91);
        animateprogress("#php",72);
        animateprogress("#css",86);
        animateprogress("#python",52);
        animateprogress("#javascript",79);
        animateprogress("#nodejs",36);

    }
    document.querySelector ("#boton").addEventListener ("click", function() {
        animateprogress("#html5",91);
        animateprogress("#php",72);
        animateprogress("#css",86);
        animateprogress("#python",52);
        animateprogress("#javascript",79);
        animateprogress("#nodejs",36);

    });
</script>