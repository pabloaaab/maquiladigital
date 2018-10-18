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
use app\models\Ordenproducciondetalle;
use app\models\OrdenproduccionSearch;
use app\models\Ordenproduccion;
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
                <th scope="col">iddetalleorden</th>
                <th scope="col">idproducto</th>
                <th scope="col">cantidad</th>
                <th scope="col">vlrprecio</th>
                <th scope="col">subtotal</th>
				<th scope="col">idordenproduccion</th>				
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($modeldetalle as $val): ?>
            <tr>                
                <td><?= $val->iddetalleorden ?></td>
                <td><?= $val->idproducto ?></td>
                <td><?= $val->cantidad ?></td>
                <td><?= $val->vlrprecio ?></td>
                <td><?= $val->subtotal ?></td>
				<td><?= $val->idordenproduccion ?></td>				
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
                                    <?=  $this->render('_formdetalle',['iddetalleorden' => $val->iddetalleorden]); ?>																		
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
									<input type="hidden" name="idordenproduccion" value="<?= $id ?>">
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

    </div>
</div>
