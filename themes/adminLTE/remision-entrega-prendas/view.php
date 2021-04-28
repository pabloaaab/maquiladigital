<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\ComprobanteEgreso */

$this->title = 'Detalle remision';
$this->params['breadcrumbs'][] = ['label' => 'Detalle remision', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id_remision;
$view = 'remision-entrega-prendas';
?>
<div class="remision-entrega-prendas-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['index', 'id' => $model->id_remision], ['class' => 'btn btn-primary btn-sm']) ?>
        <?php if ($model->autorizado == 0) { ?>

            <?= Html::a('<span class="glyphicon glyphicon-ok"></span> Autorizar', ['autorizado', 'id' => $model->id_remision], ['class' => 'btn btn-default btn-sm']); }
        else { 
            
            if($model->nro_remision > 0){
                echo Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['imprimir', 'id' => $model->id_remision], ['class' => 'btn btn-default btn-sm']);            
                echo Html::a('<span class="glyphicon glyphicon-folder-open"></span> Archivos', ['archivodir/index','numero' => 16, 'codigo' => $model->id_remision,'view' => $view], ['class' => 'btn btn-default btn-sm']);                                                         
            }else{
                echo Html::a('<span class="glyphicon glyphicon-remove"></span> Desautorizar', ['autorizado', 'id' => $model->id_remision], ['class' => 'btn btn-default btn-sm']);
               echo Html::a('<span class="glyphicon glyphicon-check"></span> Generar', ['generarnro', 'id' => $model->id_remision], ['class' => 'btn btn-default btn-sm']);
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
                <tr style="font-size: 85%;">
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'id_remision') ?>:</th>
                    <td><?= Html::encode($model->id_remision) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Numero') ?>:</th>
                    <td><?= Html::encode($model->nro_remision) ?></td>
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td align="left"><?= Html::encode($model->cliente->nombrecorto) ?></td>
                       <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Valor_Remision') ?>:</th>
                    <td align="right"><?= Html::encode('$ '.number_format($model->valor_total,0)) ?></td>
                   
                </tr>
                 <tr style="font-size: 85%;">
                  <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Usuario') ?>:</th>
                    <td><?= Html::encode($model->usuariosistema) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_Entrega') ?>:</th>
                    <td><?= Html::encode($model->fecha_entrega) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Fecha_registro') ?>:</th>
                    <td><?= Html::encode($model->fecha_registro) ?></td>
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Total_pagar') ?>:</th>
                      <td align="right"><?= Html::encode('$ '.number_format($model->valor_pagar,0)) ?></td>
                </tr>
                <tr style="font-size: 85%;">
                  <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Unidades') ?>:</th>
                    <td><?= Html::encode($model->cantidad) ?></td>
                    <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Estado') ?>:</th>
                    <td><?= Html::encode($model->estadoRemision) ?></td>
                     <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Facturado') ?>:</th>
                    <td><?= Html::encode($model->estadoFacturado) ?></td>
                      <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'Autorizado') ?>:</th>
                      <td><?= Html::encode($model->estadoAutorizado) ?></td>
                </tr>
                
                <tr style="font-size: 85%;">
                   
                   <th style='background-color:#F0F3EF;'><?= Html::activeLabel($model, 'observacion') ?></th>
                    <td colspan="7"><?= Html::encode($model->observacion) ?></td>
                </tr>
              
            </table>
        </div>
    </div>
    <div class="table-responsive">
        <div class="panel panel-success ">
            <div class="panel-heading">
                Listado de productos <span class="badge"><?= count($remisiondetalle)?> </span>
            </div>
            <div class="panel-body">
               <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col" style='background-color:#B9D5CE;'>Código</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Descrición</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Cant.</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Vr. Unitario</th>
                        <th scope="col" style='background-color:#B9D5CE;'>% Dcto</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Vr. Dcto</th>
                        <th scope="col" style='background-color:#B9D5CE;'>Vr. pagar</th>
                        <th style='background-color:#B9D5CE;'></th>
                        <th style='background-color:#B9D5CE;'></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($remisiondetalle as $val): ?>
                       <tr style="font-size: 85%;">
                            <td><?= $val->codigo_producto ?></td>
                            <td><?= $val->referencias->descripcion ?></td>
                            <td><?= $val->cantidad ?></td>
                            <td style="text-align: right"><?= '$ '.number_format($val->valor_unitario,2) ?></td>
                            <td style="text-align: right"><?= $val->porcentaje_descuento ?></td>
                            <td style="text-align: right"><?= '$ '.number_format($val->valor_descuento,0) ?></td>
                            <td style="text-align: right"><?= '$ '.number_format($val->total_linea,0) ?></td>
                            
                        <?php if ($model->autorizado == 0) { ?>
                            <td style="width: 15px;">
                               <p>
                                <!-- parametros -->
                                 <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>',            
                                     ['/remision-entrega-prendas/editardetalleremisiontallas','id_detalle' => $val->id_detalle, 'id' => $model->id_remision, 'id_referencia' => $val->id_referencia],
                                     [
                                         'title' => 'Editar tallas',
                                         'data-toggle'=>'modal',
                                         'data-target'=>'#modaleditardetalleremisiontallas'.$val->id_detalle, 'id' => $model->id_remision, 'id_referencia' => $val->id_referencia,
                                         'class' => 'btn btn-info btn-xs'
                                     ]
                                 );
                                 ?>
                                <div class="modal remote fade" id="modaleditardetalleremisiontallas<?= $val->id_detalle ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content"></div>
                                    </div>
                                </div>
                            </p>    
                            </td>
                            <td style="width: 40px;">
                                <!-- Eliminar modal detalle -->
                                <a href="#" data-toggle="modal" data-target="#iddetalleremision<?= $val->id_detalle ?>"><span class="glyphicon glyphicon-trash"></span></a>
                                <div class="modal fade" role="dialog" aria-hidden="true" id="iddetalleremision<?= $val->id_detalle ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Eliminar Detalle</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente deseas eliminar el registro con ID:  <?= $val->id_detalle ?>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <?= Html::beginForm(Url::toRoute("remision-entrega-prendas/eliminardetalle"), "POST") ?>
                                                <input type="hidden" name="iddetalle" value="<?= $val->id_detalle ?>">
                                                <input type="hidden" name="idremision" value="<?= $model->id_remision ?>">
                                                <input type="hidden" name="id_referencia" value="<?= $val->id_referencia ?>">
                                                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Cerrar</button>
                                                <button type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                                <?= Html::endForm() ?>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        <?php }else{ ?>
                            <td></td>   
                            <td></td>   
                        <?php } ?>     
                    </tr>                    
                    </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php if ($model->autorizado == 0) { ?>
                <div class="panel-footer text-right">
                    
                        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo detalle', ['remision-entrega-prendas/nuevodetalle', 'id' => $model->id_remision], ['class' => 'btn btn-success btn-sm']) ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
