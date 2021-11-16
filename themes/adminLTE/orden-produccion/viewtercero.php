 <?php

//modelos
use app\models\Ordenproducciondetalle;
use app\models\Ordenproduccion;
use app\models\Cliente;
use app\models\Color;
use app\models\Remision;
use app\models\Producto;
use app\models\Productodetalle;
//clase
use yii\helpers\Html;
use yii\widgets\DetailView;
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
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;


/* @var $this yii\web\View */
/* @var $model app\models\Ordenproduccion */

$this->title = 'Orden tercero';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Producción', 'url' => ['indextercero']];
$this->params['breadcrumbs'][] = $model->idordenproduccion;
?>

<div class="ordenproduccion-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['indextercero', 'id' => $model->id_orden_tercero], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php if ($model->autorizado == 0) { ?>
                   
                    <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['autorizadotercero', 'id' => $model->id_orden_tercero], ['class' => 'btn btn-default btn-sm']);
        }else {
                echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['autorizadotercero', 'id' => $model->id_orden_tercero], ['class' => 'btn btn-default btn-sm']);
                echo Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['imprimirtercero', 'id' => $model->id_orden_tercero], ['class' => 'btn btn-default btn-sm']);            
         }?>        
    <br>
    <br>    
    <div class="panel panel-success">
        <div class="panel-heading">
            Orden de Producción (Tercero)
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, "Nro_Orden") ?>:</th>
                    <td><?= Html::encode($model->id_orden_tercero) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Proveedor') ?>:</th>
                    <td><?= Html::encode($model->proveedor->nombrecorto) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Op_Cliente') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                    
                   
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Referencia') ?>:</th>
                    <td><?= Html::encode($model->codigo_producto) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td><?= Html::encode($model->cliente->nombrecorto) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_proceso') ?>:</th>
                    <td><?= Html::encode($model->fecha_proceso) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Autorizado') ?>:</th>
                    <td><?= Html::encode($model->autorizadoTercero) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Proceso') ?>:</th>
                    <td><?= Html::encode($model->tipo->tipo) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Usuario') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>                    
                </tr>
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'vlr_minuto') ?></th>
                    <td><?= Html::encode('$'.number_format($model->vlr_minuto,0)) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Cantidad_Minutos') ?>:</th>
                    <td><?= Html::encode($model->cantidad_minutos)?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Total_unidades') ?>:</th>
                     <td style="text-align: right;"><?= Html::encode(''.number_format($model->cantidad_unidades,0)) ?></td>
                </tr>
                <tr>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'observacion') ?></th>
                    <td colspan="3"><?= Html::encode($model->observacion) ?></td> 
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Total_Pagar') ?>:</th>
                    <td style="text-align: right;"><?= Html::encode('$'.number_format($model->total_pagar,0)) ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Detalles de la orden
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                         <th scope="col" style='background-color:#B9D5CE;'>Código</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Producto</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Vr. Minuto</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Cantidad</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Subtotal</th>
                        <th scope="col" style='background-color:#B9D5CE;'></th>
                        <th scope="col" style='background-color:#B9D5CE;'></th>
                           
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modeldetalles as $val): ?>
                    <tr style="font-size: 85%;">
                        <td><?= $val->id_detalle ?></td>
                        <td><?= $model->codigo_producto ?></td>
                        <td><?= $val->productodetalle->prendatipo->prenda.' / '.$val->productodetalle->prendatipo->talla->talla   ?></td>
                          <td style="text-align: right;"><?= '$ '.number_format($val->vlr_minuto,2) ?></td>
                          <td style="text-align: right;"><?= $val->cantidad ?></td>
                        <td style="text-align: right;"><?= '$ '.number_format($val->total_pagar,2) ?></td>
                        <?php if ($model->autorizado == 0) { ?>
                        <td style="width: 25px;">
                                <a href="#" data-toggle="modal" data-target="#iddetalleorden2<?= $val->id_detalle ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <!-- Editar modal detalle -->
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetalleorden2<?= $val->id_detalle ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Editar detalle <?= $val->id_detalle ?></h4>
                                            </div>
                                            <?= Html::beginForm(Url::toRoute("orden-produccion/editardetalletercero"), "POST") ?>
                                            <div class="modal-body">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h4>Unidades x talla</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-lg-2">
                                                            <label>Cantidad:</label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <input type="text" name="cantidad" value="<?= $val->cantidad ?>" class="form-control" required>
                                                        </div>
                                                      
                                                        <input type="hidden" name="id_detalle" value="<?= $val->id_detalle ?>">
                                                        <input type="hidden" name="id" value="<?= $model->id_orden_tercero ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                                                <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Guardar</button>
                                            </div>
                                             <?= Html::endForm() ?>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                        </td>
                        <td style="width: 25px;">
                                <!-- Eliminar modal detalle -->
                                <a href="#" data-toggle="modal" data-target="#iddetalleorden<?= $val->id_detalle ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetalleorden<?= $val->id_detalle ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar Detalle</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente deseas eliminar el registro Nro:  <?= $val->id_detalle ?>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?= Html::beginForm(Url::toRoute("orden-produccion/eliminardetalletercero"), "POST") ?>
                                                <input type="hidden" name="id_detalle_orden" value="<?= $val->id_detalle ?>">
                                                <input type="hidden" name="id" value="<?= $model->id_orden_tercero ?>">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                                                <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                                <?= Html::endForm() ?>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>                            
                                                       
                        <?php } else {?>
                            <th scope="col" style='background-color:#B9D5CE;'></th>
                            <th scope="col" style='background-color:#B9D5CE;'></th>
                        <?php }?>
                    </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
            
            <?php if ($model->autorizado == 0) { ?>
                <div class="panel-footer text-right">
                    <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['orden-produccion/nuevodetallestercero', 'idordenproduccion' => $model->idordenproduccion,'idcliente' => $model->idcliente, 'id' =>$model->id_orden_tercero], ['class' => 'btn btn-success btn-sm']) ?>
                    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['orden-produccion/editardetallestercero', 'id' =>$model->id_orden_tercero],[ 'class' => 'btn btn-success btn-sm']) ?>                                            
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['orden-produccion/eliminardetallesordenterceromasivo', 'id' => $model->id_orden_tercero], ['class' => 'btn btn-danger btn-sm']) ?>
                </div>
            
            <?php } ?>
        </div>
    </div>
    
</div>

<script type="text/javascript">
	function marcar(source) 
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>