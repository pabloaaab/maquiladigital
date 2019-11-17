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

$this->title = 'Contratos';
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
    "action" => Url::toRoute("contrato/index"),
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
	
    <div class="panel-body" id="filtrocontrato" style="display:none">
        <div class="row" >
            <?= $formulario->field($form, "identificacion")->input("search") ?>            
            <?= $formulario->field($form, 'activo')->dropDownList(['0' => 'NO', '1' => 'SI'], ['prompt' => 'Seleccione una opcion...']) ?>
        </div>
        <div class="panel-footer text-right">
            <?= Html::submitButton("<span class='glyphicon glyphicon-search'></span> Buscar", ["class" => "btn btn-primary",]) ?>
            <a align="right" href="<?= Url::toRoute("contrato/index") ?>" class="btn btn-primary"><span class='glyphicon glyphicon-refresh'></span> Actualizar</a>
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
                <th scope="col">Tipo Contrato</th>
                <th scope="col">Tiempo</th>
                <th scope="col">Identificación</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Final</th>
                <th scope="col">Cargo</th>
                <th scope="col">Contratado</th>
                <th scope="col"></th>                               
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $val): ?>
            <tr>                
                <td><?= $val->id_contrato ?></td>
                <td><?= $val->tipoContrato->contrato ?></td>
                <td><?= $val->tiempo_contrato ?></td>
                <td><?= $val->identificacion ?></td>
                <td><?= $val->empleado->nombrecorto ?></td>
                <td><?= $val->fecha_inicio ?></td>
                <td><?= $val->fecha_final ?></td>
                <td><?= $val->cargo->cargo ?></td>
                <td><?= $val->activo ?></td>
                <td>				
                <a href="<?= Url::toRoute(["contrato/view", "id" => $val->id_contrato]) ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                <a href="<?= Url::toRoute(["contrato/update", "id" => $val->id_contrato])?>" ><span class="glyphicon glyphicon-pencil"></span></a>
		<?= Html::a('', ['eliminar', 'id' => $val->id_contrato], [
        'class' => 'glyphicon glyphicon-trash',
        'data' => [
            'confirm' => 'Esta seguro de eliminar el registro?',
            'method' => 'post',
        ],
    ]) ?>
                </td>
            </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <div class="panel-footer text-right" >
            <a align="right" href="<?= Url::toRoute("contrato/create") ?>" class="btn btn-success"><span class='glyphicon glyphicon-plus'></span> Nuevo</a>
        </div>
    </div>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>