<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Facturaventadetalle;
use app\models\Facturaventa;
use yii\db\ActiveQuery;

$this->title = 'Descargar Stock';
$this->params['breadcrumbs'][] = $this->title;
?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtroproductostock");
        if (divC.style.display == "none") {
            divC.style.display = "block";
        } else {
            divC.style.display = "none";
        }
    }
</script>

<?php
$formulario = ActiveForm::begin([
            "method" => "get",
            "action" => Url::toRoute("producto/productostock"),
            "enableClientValidation" => true,
            'options' => ['class' => 'form-horizontal'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-4 form-group">{input}</div>',
                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'options' => ['tag' => false,]
            ],
        ]);
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>

    <div class="panel-body" id="filtroproductostock" style="display:none">
        <div class="row">
            <?=
            $formulario->field($form, 'idcliente')->widget(Select2::classname(), [
                'data' => $clientes,
                'options' => ['prompt' => 'Seleccione un cliente...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
            <?=
            $formulario->field($form, 'idtipo')->widget(Select2::classname(), [
                'data' => $tipos,
                'options' => ['prompt' => 'Seleccione un tipo...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="row" >
<?= $formulario->field($form, "idproducto")->input("search") ?>
        </div>

        <div class="panel-footer text-right">
<?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("producto/productostock") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>

<div class="table-responsive">
    <div class="panel panel-success ">
        <div class="panel-heading">
            Registros: <?= $pagination->totalCount ?>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id Producto</th>                
                    <th scope="col">Cliente</th>                
                    <th scope="col">Tipo</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                </tr>
            </thead>
    <tbody>
    <?php foreach ($model as $val): ?>
            <tr>
                <td><?= $val->idproducto ?></td>                
                <td><?= $val->cliente->nombrecorto ?></td>
                <td><?= $val->ordenproducciontipo->tipo ?></td>                
                <td><?= $val->cantidad ?></td>
                <td><?= $val->stock ?></td>                
                <td>
                    <?php
                    $dato = 0;
                    $factura = 0;
                    $facturas = Facturaventadetalle::find()->where(['=', 'idproducto', $val->idproducto])->orderBy('idfactura desc')->all();
                    foreach ($facturas as $value) {
                        $factura = Facturaventa::findOne($value);                        
                    }    
                    ?>
                    <a href="#" data-toggle="modal" data-target="#idproducto<?= $val->idproducto ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                    <!-- Editar modal -->
                    <div class="modal fade" role="dialog" aria-hidden="true" id="idproducto<?= $val->idproducto ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Editar Item <?= $val->idproducto ?></h4>
                                </div>
                                    <?= Html::beginForm(Url::toRoute("producto/descargarstock"), "POST") ?>
                                <div class="modal-body">
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            Información
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Última factura: <?= $factura->nrofactura ?></label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Cantidad: <?= $value->cantidad ?></label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>Orden Producción: <?= $factura->idordenproduccion ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <label>Stock:</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label><?= $val->stock ?></label>
                                                </div>
                                            </div>
                                            <div class="row">                                            
                                                <div class="col-lg-2">
                                                    <label>Observación:</label>
                                                </div>
                                                <div class="col-lg-4">
                                                    <textarea rows="4" cols="50" name="observacion"></textarea>
                                                </div>
                                            </div>    
                                            <input type="hidden" name="idproducto" value="<?= $val->idproducto ?>">
                                            <input type="hidden" name="stock" value="<?= $val->stock ?>">
                                            <input type="hidden" name="nrofactura" value="<?= $factura->nrofactura ?>">
                                            <input type="hidden" name="idfactura" value="<?= $factura->idfactura ?>">
                                            <input type="hidden" name="idordenproduccion" value="<?= $factura->idordenproduccion ?>">
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
                </td>
            </tr>
        </tbody>
<?php endforeach; ?>
        </table>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
