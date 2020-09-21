<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\Modal;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
//modelos
use app\models\GrupoPago;
use app\models\Empleado;
use app\models\TiempoServicio;

$this->title = 'Parametros de contratos';
$this->params['breadcrumbs'][] = $this->title;


?>
<script language="JavaScript">
    function mostrarfiltro() {
        divC = document.getElementById("filtrocontrato");
        if (divC.style.display == "none"){divC.style.display = "block";}else{divC.style.display = "none";}
    }
</script>

<!--<h1>Lista Contratos</h1>-->
<?php $formulario = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("contrato/parametrocontrato"),
    "enableClientValidation" => true,
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
                    'template' => '{label}<div class="col-sm-4 form-group">{input}{error}</div>',
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'options' => []
                ],

]);
$grupo = ArrayHelper::map(GrupoPago::find()->orderBy ('grupo_pago ASC')->all(), 'id_grupo_pago', 'grupo_pago');
$empleado = ArrayHelper::map(Empleado::find()->orderBy ('nombrecorto ASC')->all(), 'id_empleado', 'nombrecorto');
$tiempo = ArrayHelper::map(TiempoServicio::find()->orderBy ('id_tiempo ASC')->all(), 'id_tiempo', 'tiempo_servicio');
?>

<div class="panel panel-success panel-filters">
    <div class="panel-heading" onclick="mostrarfiltro()">
        Filtros de busqueda <i class="glyphicon glyphicon-filter"></i>
    </div>
	
    <div class="panel-body" id="filtrocontrato" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, "identificacion")->input("search") ?>            
            <?= $formulario->field($form, 'id_empleado')->widget(Select2::classname(), [
                'data' => $empleado,
                'options' => ['prompt' => 'Seleccione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
             <?= $formulario->field($form, 'id_grupo_pago')->widget(Select2::classname(), [
                'data' => $grupo,
                'options' => ['prompt' => 'Seleccione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
              <?= $formulario->field($form, 'id_tiempo')->widget(Select2::classname(), [
                'data' => $tiempo,
                'options' => ['prompt' => 'Seleccione...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>
        </div>   
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("contrato/parametrocontrato") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
        </div>
    </div>
</div>

<?php $formulario->end() ?>

<div class="table-responsive">
<div class="panel panel-success ">
    <div class="panel-heading">
        Registros: <span class="badge"><?= $pagination->totalCount ?></span>
    </div>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>                
                <th scope="col" style='background-color:#B9D5CE;'>Id</th>
                <th scope="col" style='background-color:#B9D5CE;'>Tipo Contrato</th>
                <th scope="col" style='background-color:#B9D5CE;'>Tiempo</th>
                <th scope="col" style='background-color:#B9D5CE;'>Identificación</th>
                <th scope="col" style='background-color:#B9D5CE;'>Nombre</th>
                <th scope="col" style='background-color:#B9D5CE;'>Fecha Inicio</th>
                <th scope="col" style='background-color:#B9D5CE;'>Fecha Final</th>
                <th scope="col" style='background-color:#B9D5CE;'>Cargo</th>
                <th scope="col" style='background-color:#B9D5CE;'>Act.</th>
                <th scope="col" style='background-color:#B9D5CE;'></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr style ='font-size:85%;'>                
                <td><?= $val->id_contrato ?></td>
                <td><?= $val->tipoContrato->contrato ?></td>
                <td><?= $val->tiempoServicio->tiempo_servicio ?></td>
                <td><?= $val->identificacion ?></td>
                <td><?= $val->empleado->nombrecorto ?></td>
                <td><?= $val->fecha_inicio ?></td>
                <?php
                if($val->fecha_final == '2099-12-31'){?>
                   <td>INDEFINIDO </td>
                <?php }else{ ?>
                   <td><?= $val->fecha_final ?></td>
                <?php } ?>   
                <td><?= $val->grupoPago->grupo_pago ?></td>
                <td><?= $val->activo ?></td>
                <td style="width: 25px;">				
                    <a href="<?= Url::toRoute(["contrato/viewparameters", "id" => $val->id_contrato]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>