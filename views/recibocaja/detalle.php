<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;

?>



<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Detalles	
    </div>
        <table class="table table-hover">
            <thead>
            <tr>                
                <th scope="col">iddetallerecibo</th>
                <th scope="col">idfactura</th>
                <th scope="col">vlrabono</th>
                <th scope="col">vlrsaldo</th>
                <th scope="col">retefuente</th>
				<th scope="col">reteiva</th>
				<th scope="col">idrecibo</th>
				<th scope="col">observacion</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ReciboCajaDetalle as $val): ?>
            <tr>                
                <td><?= $val->iddetallerecibo ?></td>
                <td><?= $val->idfactura ?></td>
                <td><?= $val->vlrabono ?></td>
                <td><?= $val->vlrsaldo ?></td>
                <td><?= $val->retefuente ?></td>
				<td><?= $val->reteiva ?></td>
				<td><?= $val->idrecibo ?></td>
				<td><?= $val->observacion ?></td>
                <td>				
                
                <a href="<?= Url::toRoute(["clientes/editar", "iddetallerecibo" => $val->iddetallerecibo])?>" ><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" data-toggle="modal" data-target="#iddetallerecibo<?= $val->iddetallerecibo ?>"><span class="glyphicon glyphicon-trash"></span></a>
                    <div class="modal fade" role="dialog" aria-hidden="true" id="iddetallerecibo<?= $val->iddetallerecibo ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Detalle</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Realmente deseas eliminar al cliente con código <?= $val->iddetallerecibo ?>?</p>
                                </div>
                                <div class="modal-footer">
                                    <?= Html::beginForm(Url::toRoute("clientes/eliminar"), "POST") ?>
                                    <input type="hidden" name="iddetallerecibo" value="<?= $val->iddetallerecibo ?>">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                    <?= Html::endForm() ?>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right" >
            <a align="right" href="<?= Url::toRoute("clientes/nuevo") ?>" class="btn btn-success"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
        </div>
    </div>
</div>








