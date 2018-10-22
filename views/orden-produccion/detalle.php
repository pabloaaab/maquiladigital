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
use app\models\Cliente;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
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
                <td><?= $val->iddetalleorden ?></td>
                <td><?= $val->producto->producto ?></td>
                <td><?= $val->codigoproducto ?></td>
                <td><?= $val->cantidad ?></td>
                <td><?= $val->vlrprecio ?></td>
                <td><?= $val->subtotal ?></td>
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
									<input type="hidden" name="idordenproduccion" value="<?= $idordenproduccion ?>">
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
    <div class="panel-footer text-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['orden-produccion/nuevodetalles', 'idordenproduccion' => $idordenproduccion,'idcliente' => $idcliente], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Editar', ['orden-produccion/editardetalles', 'idordenproduccion' => $idordenproduccion], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Eliminar', ['orden-produccion/eliminardetalles', 'idordenproduccion' => $idordenproduccion], ['class' => 'btn btn-danger']) ?>

    </div>

    </div>
</div>


<?= Html::button('Create List', ['id' => 'modelButton', 'value' => \yii\helpers\Url::to(['clientes/index']), 'class' => 'btn btn-success']) ?>

<?php

Modal::begin([
    'header' => '<h4>Destination</h4>',
    'id'     => 'model',
    'size'   => 'model-lg',
]);

echo "<div id='modelContent'></div>";

Modal::end();

?>

<script>
    $(function(){
    $('#modelButton').click(function(){
    $('.modal').modal('show')
    .find('#modelContent')
    .load($(this).attr('value'));
    });
    });
</script>




