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
use app\models\Recibocaja;
use app\models\Recibocajadetalle;
use app\models\RecibocajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\filters\AccessControl;


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
				<th scope="col">reteica</th>
				<th scope="col">idrecibo</th>
				<th scope="col">observacion</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ReciboCajaDetalle as $val): ?>
            <tr>                
                <td><?= $val->iddetallerecibo ?></td>
                <td><?= $val->nrofactura ?></td>
                <td><?= $val->vlrabono ?></td>
                <td><?= $val->vlrsaldo ?></td>
                <td><?= $val->retefuente ?></td>
				<td><?= $val->reteiva ?></td>
				<td><?= $val->reteica ?></td>
				<td><?= $val->idrecibo ?></td>
				<td><?= $val->observacion ?></td>
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
                                    <?=  $this->render('_formdetalle',['iddetallerecibo' => $val->iddetallerecibo]); ?>																		
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
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>		
                    <!-- Nuevo modal detalle -->
					<div class="modal fade" role="dialog" aria-hidden="true" id="idrecibo<?= $idrecibo ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Nuevo detalle</h4>
                                </div>
								<?= Html::beginForm(Url::toRoute("recibocaja/nuevodetalle"), "POST") ?>								
                                <div class="modal-body">
                                    <?=  $this->render('_formdetalle',['iddetallerecibo' => '', 'idrecibo' => $idrecibo]); ?>																			
                                </div>
                                <div class="modal-footer">                                                                                                          
                                    <?= Html::endForm() ?>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
        <div class="panel-footer text-right" >
			<!-- Nuevo boton modal detalle -->	
			<a href="#" data-toggle="modal" data-target="#idrecibo<?= $idrecibo ?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>			
        </div>
    </div>
</div>


<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>





