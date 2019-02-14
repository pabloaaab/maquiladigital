<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\db\ActiveQuery;
/* @var $this yii\web\View */
/* @var $model app\models\Remision */

$this->title = 'Remision de Entrega';
$this->params['breadcrumbs'][] = ['label' => 'Orden Produccion', 'url' => ['orden-produccion/view', 'id' => $idordenproduccion]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Fichatiempo-view">

    <!--<?= Html::encode($this->title) ?>-->

    <p>
       <?= Html::a('<span class="glyphicon glyphicon-circle-arrow-left"></span> Regresar', ['/orden-produccion/view', 'id' => $idordenproduccion], ['class' => 'btn btn-primary']) ?>         
       <?= Html::a('<span class="glyphicon glyphicon-check"></span> Generar Nro', ['generarnro', 'id' => $model->id_remision], ['class' => 'btn btn-default']); ?>
       <?php if ($model->numero > 0) { ?> 
            <?= Html::a('<span class="glyphicon glyphicon-print"></span> Imprimir', ['imprimir', 'id' => $model->id_remision], ['class' => 'btn btn-default']); ?>
       <?php } ?> 
    </p>
    <div class="panel panel-success">
        <div class="panel-heading">
            Remision de Entrega
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th><?= Html::activeLabel($model, 'id_remision') ?>:</th>
                    <td><?= Html::encode($model->id_remision) ?></td>
                    <th><?= Html::activeLabel($model, 'idordenproduccion') ?>:</th>
                    <td><?= Html::encode($model->idordenproduccion) ?></td>
                    <th><?= Html::activeLabel($model, 'total_tulas') ?>:</th>
                    <td><?= Html::encode($model->total_tulas) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'fechacreacion') ?>:</th>
                    <td><?= Html::encode($model->fechacreacion) ?></td>
                    <th><?= Html::activeLabel($model, 'numero') ?>:</th>
                    <td><?= Html::encode($model->numero) ?></td>
                    <th><?= Html::activeLabel($model, 'total_exportacion') ?>:</th>
                    <td><?= Html::encode($model->total_exportacion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'ordenProdInterna') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->ordenproduccion) ?></td>
                    <th><?= Html::activeLabel($model, 'ordenProdExterna') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->ordenproduccion) ?></td>
                    <th><?= Html::activeLabel($model, 'totalsegundas') ?>:</th>
                    <td><?= Html::encode($model->totalsegundas) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'Cliente') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->cliente->nombrecorto) ?></td>
                    <th><?= Html::activeLabel($model, 'Contacto') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->cliente->contacto) ?></td>
                    <th><?= Html::activeLabel($model, 'total_colombia') ?>:</th>
                    <td><?= Html::encode($model->total_colombia) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'Direccion') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->cliente->direccioncliente) ?></td>
                    <th><?= Html::activeLabel($model, 'Ciudad') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->cliente->municipio->municipio) ?></td>
                    <th><?= Html::activeLabel($model, 'total_confeccion') ?>:</th>
                    <td><?= Html::encode($model->total_confeccion) ?></td>
                </tr>
                <tr>
                    <th><?= Html::activeLabel($model, 'TipoOrden') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->tipo->tipo) ?></td>
                    <th><?= Html::activeLabel($model, 'Cantidad') ?>:</th>
                    <td><?= Html::encode($model->ordenproduccion->cantidad) ?></td>
                    <th><?= Html::activeLabel($model, 'total_despachadas') ?>:</th>
                    <td><?= Html::encode($model->total_despachadas) ?></td>
                </tr>
            </table>
        </div>
    </div>
    

</div>
<?php
$form = ActiveForm::begin([
            'options' => ['class' => 'form-horizontal condensed', 'role' => 'form'],
            'fieldConfig' => [
                'template' => '{label}<div class="col-sm-5 form-group">{input}{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
                'options' => []
            ],
        ]);
?>
<?php
$colores = ArrayHelper::map(app\models\Color::find()->all(), 'color', 'color');

?>
<div class="panel panel-success ">
    <div class="panel-heading">
        Detalle Remision de Entrega - <?= $count ?> Registros
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Color</th>
                    <th scope="col">OC</th>
                    <th scope="col">Tula</th>
                    <th scope="col">XS</th>
                    <th scope="col">S</th>
                    <th scope="col">M</th>
                    <th scope="col">L</th>
                    <th scope="col">Xl</th>                    
                    <th scope="col">ESTADO</th>
                    <th scope="col">UNIDAD X TULA</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php                    
                    $ttula = 0;
                    $tunidades = 0;
                    $txs = 0;
                    $ts = 0;
                    $tm = 0;
                    $tl = 0;
                    $txl = 0;
                ?>
                <?php foreach ($remisiondetalle as $val): ?>                
                    <tr>                                            
                        <td style="padding-left: 1;padding-right: 1;"><?= Html::dropdownList('color[]', $val->color ,$colores, ['class' => 'col-sm-13','prompt' => 'Seleccione...','required' => true]) ?>
                        <td style="padding-left: 1;padding-right: 1;"><?= Html::dropdownList('oc[]', $val->oc ,['0' => 'Colombia', '1' => 'Exportacion'], ['class' => 'col-sm-13','prompt' => 'Seleccione...','required' => true]) ?>
                        <td style="padding-left: 1;padding-right: 1;"><?= $val->tula ?></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="text" name="xs[]" value="<?= $val->xs ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="text" name="s[]" value="<?= $val->s ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="text" name="m[]" value="<?= $val->m ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="text" name="l[]" value="<?= $val->l ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 1;"><input type="text" name="xl[]" value="<?= $val->xl ?>" size="4" onkeypress="return esInteger(event)" required></td>
                        <td style="padding-left: 1;padding-right: 1;"><?= Html::dropdownList('estado[]', $val->estado ,['0' => 'Primera', '1' => 'Segunda'], ['class' => 'col-sm-13','prompt' => 'Seleccione...','required' => true]) ?>
                        <td style="padding-left: 1;padding-right: 1;"><?= $val->unidades ?></td>
                        <td style="padding-left: 0;padding-right: 0;"><input type="hidden" name="id_remision_detalle[]" value="<?= $val->id_remision_detalle ?>"></td>
                        <td><?=
                            Html::a('<span class="glyphicon glyphicon-trash"></span> ', ['eliminar', 'id' => $model->idordenproduccion, 'iddetalle' => $val->id_remision_detalle], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Esta seguro de eliminar el registro?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </td>
                    </tr>
                </tbody>
                <?php                    
                    $txs = $txs + $val->xs;
                    $ts = $ts + $val->s;
                    $tm = $tm + $val->m;
                    $tl = $tl + $val->l;
                    $txl = $txl + $val->xl;
                    $ttula = $ttula + $val->tula;
                    $tunidades = $tunidades + $val->unidades;
                ?>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <th scope="col">Totales:</th>
                <th scope="col"><?= $ttula ?></th>
                <th scope="col"><?= $txs ?></th>
                <th scope="col"><?= $ts ?></th>
                <th scope="col"><?= $tm ?></th>
                <th scope="col"><?= $tl ?></th>
                <th scope="col"><?= $txl ?></th>                
                <th scope="col"></th>
                <th scope="col"><?= $tunidades ?></th>
                <td></td>
                <td></td>
            </tr>    
        </table>        
    </div>
    <div class="panel-footer text-right">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> Nuevo', ['remision/nuevodetalle', 'id' => $model->id_remision, 'idordenproduccion' => $idordenproduccion], ['class' => 'btn btn-success']); ?>
        <?= Html::submitButton("<span class='glyphicon glyphicon-floppy-disk'></span> Actualizar", ["class" => "btn btn-success",]) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
    function esInteger(e) {
        var charCode
        charCode = e.keyCode
        status = charCode
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false
        }
        return true
    }
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>