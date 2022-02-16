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
use yii\helpers\ArrayHelper;

$this->title = 'Reprocesos';
$this->params['breadcrumbs'][] = $this->title;
$operarios = ArrayHelper::map(\app\models\Operarios::find()-> orderBy ('nombrecompleto ASC')->all(), 'id_operario','nombrecompleto');
$operaciones = ArrayHelper::map(\app\models\ProcesoProduccion::find()-> orderBy ('proceso ASC')->all(), 'idproceso','proceso');
$indicador = 2;
?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtroproceso");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("orden-produccion/searchreprocesos"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => '{label}<div class="col-sm-4 form-group">{input}</div>',
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'options' => [ 'tag' => false,]
    ],

]);
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>

<div class="panel-body" id="filtroproceso" style="display:none">
        <div class="row">
             <?= $formulario->field($form, 'id_operario')->widget(Select2::classname(), [
                'data' => $operarios,
                'options' => ['prompt' => 'Seleccione el operario...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, "id_balanceo")->input("search") ?>
            <?= $formulario->field($form, 'fecha_inicio')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
        
            <?= $formulario->field($form, 'fecha_final')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
            <?= $formulario->field($form, 'id_proceso')->widget(Select2::classname(), [
                'data' => $operaciones,
                'options' => ['prompt' => 'Seleccione la operación...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
             <?= $formulario->field($form, "idordenproduccion")->input("search") ?>
           
        </div>
        
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary btn-sm",]) ?>
            <a align="right" href="<?= Url::toRoute("orden-produccion/searchreprocesos") ?>" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>

<div class="table-responsive">
    <div class="panel panel-success ">
        <div class="panel-heading">
            Registros <span class="badge"><?= number_format($pagination->totalCount,0) ?></span>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col" style='background-color:#B9D5CE;'>Id</th>  
                <th scope="col" style='background-color:#B9D5CE;'><span title="Orden produccion interna">Op.</span></th>
                 <th scope="col" style='background-color:#B9D5CE;'>Ref.</th>
                <th scope="col" style='background-color:#B9D5CE;'><span title="Numero del balanceo"># Bal.</span></th>
                <th scope="col" style='background-color:#B9D5CE;'>Operario</th>
                <th scope="col" style='background-color:#B9D5CE;'>Operaciones</th>
                <th scope="col" style='background-color:#B9D5CE;'>Producto/Talla</th>
                <th scope="col" style='background-color:#B9D5CE;'>Cliente</th>
                <th scope="col" style='background-color:#B9D5CE;'>Cant.</th>
                <th scope="col" style='background-color:#B9D5CE;'>Tiempo</th>
                <th scope="col" style='background-color:#B9D5CE;'>Proceso</th>
                <th scope="col" style='background-color:#B9D5CE;'>F. registro</th>
                 <th scope="col" style='background-color:#B9D5CE;'></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
                <tr style="font-size: 85%;">
                <td><?= $val->id_reproceso ?></td>
                <td><?= $val->idordenproduccion ?></td>
                 <td><?= $val->ordenproduccion->codigoproducto ?></td>
                <td><?= $val->id_balanceo ?></td>
                <td><?= $val->operario->nombrecompleto ?></td>
                <td><?= $val->proceso->proceso ?></td>
                <td><?= $val->productodetalle->prendatipo->prenda.' / '.$val->productodetalle->prendatipo->talla->talla ?></td>
                <td><?= $val->ordenproduccion->cliente->nombrecorto ?></td>
                <td><?= $val->cantidad ?></td>
                <td><?= $val->detalle->minutos ?></td>
                <?php if ($val->tipo_reproceso == 1){ ?>
                     <td><?=  'CONFECCION' ?></td>
                <?php }else {?>
                     <td><?=  'TERMINACION' ?></td>
                <?php } ?>     
                <td><?= $val->fecha_registro ?></td>
                <td>
                    <a href="<?= Url::toRoute(["balanceo/viewconsultabalanceo", "id" => $val->id_balanceo, 'idordenproduccion' => $val->balanceo->ordenproduccion->idordenproduccion, 'indicador' => $indicador]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                    
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right" >            
            <?php
                $form = ActiveForm::begin([
                            "method" => "post",                            
                        ]);
                ?>    
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary btn-sm']); ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
