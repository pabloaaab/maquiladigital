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
use yii\data\Pagination;
use kartik\depdrop\DepDrop;


$this->title = 'Control de Acceso Covid';
$this->params['breadcrumbs'][] = $this->title;


?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtrocontrolacceso");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<!--<h1>Lista proveedor</h1>-->
<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("control-acceso/index"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtrocontrolacceso" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, "documento")->input("search") ?>            
            <?= $formulario->field($form, 'tipo_personal')->dropDownList(['Empleado' => 'Empleado', 'Visitante' => 'Visitante'], ['prompt' => 'Seleccione una opcion...']) ?>
            <?=
            $formulario->field($form, 'fecha')->widget(DatePicker::className(), ['name' => 'check_issue_date',
                'value' => date('Y-m-d', strtotime('+2 days')),
                'options' => ['placeholder' => 'Seleccione una fecha ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true]])
            ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("control-acceso/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
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
                <th scope="col">Documento</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha Ingreso</th>
                <th scope="col">Fecha Salida</th>
                <th scope="col">Temperatura Inicial</th>
                <th scope="col">Temperatura Final</th>
                <th scope="col">Tipo Personal</th>
                <th scope="col">Tiene Sintomas</th>
                <th scope="col">Observaciones</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>                
                <td><?= $val->documento ?></td>
                <td><?= $val->registroPersonal->nombrecompleto ?></td>
                <td><?= $val->fecha_ingreso ?></td>
                <td><?= $val->fecha_salida ?></td>
                <td><?= $val->temperatura_inicial ?></td>
                <td><?= $val->temperatura_final ?></td>
                <td><?= $val->tipo_personal ?></td>
                <td><?= $val->tieneSintomas ?></td>
                <td><?= $val->observacion ?></td>
                <td>				
                <a href="<?= Url::toRoute(["control-acceso/view", "id" => $val->id]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>                		
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