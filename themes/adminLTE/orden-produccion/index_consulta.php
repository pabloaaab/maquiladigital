<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use app\models\Cliente;
use app\models\Ordenproducciontipo;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\data\Pagination;
use kartik\depdrop\DepDrop;

$this->title = 'Consulta Ordenes de Producción';
$this->params['breadcrumbs'][] = $this->title;


?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtro");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<!--<h1>Lista Facturas</h1>-->
<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("orden-produccion/indexconsulta"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);

$clientes = ArrayHelper::map(Cliente::find()->all(), 'idcliente', 'nombreClientes');
$tipos = ArrayHelper::map(Ordenproducciontipo::find()->all(), 'idtipo', 'tipo');
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtro" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, 'idcliente')->widget(Select2::classname(), [
                'data' => $clientes,
                'options' => ['prompt' => 'Seleccione un cliente ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
            <?= $formulario->field($form, "codigoproducto")->input("search") ?>
            <?= $formulario->field($form, 'desde')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
            <?= $formulario->field($form, 'hasta')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-m-d',
                    'todayHighlight' => true]])
            ?>
            <?= $formulario->field($form, 'facturado')->dropDownList(['0' => 'NO', '1' => 'SI'],['prompt' => 'Seleccione una opcion ...']) ?>
            <?= $formulario->field($form, "ordenproduccionint")->input("search") ?>
            <?= $formulario->field($form, "ordenproduccionext")->input("search") ?>
            <?= $formulario->field($form, 'tipo')->dropDownList($tipos, ['prompt' => 'Seleccione un tipo...']) ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("orden-produccion/indexconsulta") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>

<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Registros: <?= $pagination->totalCount ?>
    </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>                
                <th scope="col">Id</th>
                <th scope="col">Cedula/Nit</th>
                <th scope="col">Cliente</th>
                <th scope="col">Cod Producto</th>                
                <th scope="col">Orden Prod Int</th>
                <th scope="col">Orden Prod Ext</th>
                <th scope="col">Fecha LLegada</th>
                <th scope="col">Total</th>                
                <th scope="col">Autorizado</th>
                <th scope="col">Facturado</th>
                <th scope="col">Tipo</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>                
                <td><?= $val->idordenproduccion ?></td>
                <td><?= $val->cliente->cedulanit ?></td>
                <td><?= $val->cliente->nombrecorto ?></td>
                <td><?= $val->codigoproducto ?></td>
                <td><?= $val->ordenproduccion ?></td>
                <td><?= $val->ordenproduccionext ?></td>
                <td><?= date("Y-m-d", strtotime("$val->fechallegada")) ?></td>
                <td><?= number_format($val->totalorden,0) ?></td>                
                <td><?= $val->autorizar ?></td>
                <td><?= $val->facturar ?></td>
                <td><?= $val->tipo->tipo ?></td>
                <td>				
                <a href="<?= Url::toRoute(["orden-produccion/viewconsulta", "id" => $val->idordenproduccion]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>                
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
                <?= Html::submitButton("<span class='glyphicon glyphicon-export'></span> Excel", ['name' => 'excel','class' => 'btn btn-primary ']); ?>
            <?php $form->end() ?>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>







